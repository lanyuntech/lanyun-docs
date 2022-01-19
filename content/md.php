<?php
/**
* Class md
* @author batcom
*/
define('DS',DIRECTORY_SEPARATOR);
include 'file.php';
class md
{
	// 起始路径
	protected $read_path = '.';
	// 保存路径
	protected $write_path_prefix = './result';

	protected $resultFileHandle = null;

	protected $files = [];

	public function setReadPath($read_path)
	{
		$this->read_path = $read_path;
	}

	public function setWritePathPrefix($write_path_prefix)
	{
		$this->write_path_prefix = $write_path_prefix;
	}

	public function run()
	{

		if(is_file($this->write_path_prefix . '.md')) unlink($this->write_path_prefix . '.md');

		$this->resultFileHandle = fopen($this->write_path_prefix . '.txt','ab+');
		$this->listDirectory($this->read_path);
		$this->streamWrite($this->files);
		fclose($this->resultFileHandle);
		rename($this->write_path_prefix . '.txt', $this->write_path_prefix . '.md');
	}

	public function listDirectory($dir)
	{
		$sort_info = (new File($dir))->sortDirAndFile();


		foreach ($sort_info as $info) {
			if ($info['isFile'] && substr($info['path'], strpos($info['path'], '.md')) !== '.md') continue;

			if ($info['isFile']) {
				array_push($this->files, $info['path']);
			} else {
				$this->listDirectory($info['path']);
			}
		}
	}

	/**
	 *
	 * 写入文件
	 *
	 * @param $files
	 */
	public function streamWrite($files)
	{
		foreach($files as $k=>$file){

			if (!$this->checkNeedWriteFile($file)) continue;

			$fp = $this->adjustFileContent($file);

			stream_copy_to_stream($fp,$this->resultFileHandle);
			fclose($fp);
		}

	}

	/**
	 * 过滤一些没有必要写的文件
	 *
	 * @param $path
	 * @return bool
	 */
	public function checkNeedWriteFile($path)
	{

		$fileObj = new File($path);

		if ($path == './_index.md'
		||	$path == './features.md'
		|| $fileObj->checkIsDraft() === true
		|| $fileObj->getTitle() === '产品动态'
		) {
			return false;
		}

		return true;
	}

	/**
	 *
	 * 调整文件 => 1. 过滤掉文件中的  头部介绍
	 *
	 * @param $path
	 * @return bool|resource
	 */
	public function adjustFileContent($path)
	{
		$fp = fopen('php://memory', 'r+');

		$title = (new File($path))->getTitle();
		$content = '';

		if (substr($path, strpos($path, '_index.md')) === '_index.md') {

			$count =  substr_count(substr($path,strripos($path,"/content")), '/');

			if ($count > 2 && $title) {
				$content = PHP_EOL . str_repeat('#', $count - 1) . ' ' . $title . PHP_EOL;
			} else if ($title) {
				$content = PHP_EOL . '# '. $title . PHP_EOL;
			}

		} else {
			// 处理内容中的 # 
			$content = $this->dealWithContentBody($path);
			// 去掉 content 头部信息
			$content = $this->clearContentTop($content, $title, $path);
			// 处理图片展示
			$content = $this->dealWithContentPic($content, $path);
		}

		fputs($fp, $content);
		rewind($fp);

		return $fp;
	}

	/**
     *
     * 工具函数  =>  查找字符串中第几次出现字符的位置
     *
     *
     * @param $str
     * @param $find
     * @param $n
     * @return bool|int
     */
    private function str_n_pos($str, $find, $n)
    {
        $pos_val=0;
        for ($i=1;$i<=$n;$i++){

            $pos = strpos($str,$find);

            $str = substr($str,$pos+1);

            $pos_val=$pos+$pos_val+1;

        }
        return $pos_val-1;
    }

	/**
	 * @param $content
	 * @return mixed|string|string[]|null
	 */
	public function dealWithContentBody($path)
	{

		$content = file_get_contents($path);

		// 路径中的 count

		// $res = substr($path,strripos($path,"/content") - 1);

		$count_dir = substr_count(substr($path,strripos($path,"/content")), '/');
		// 获取内容中 # 需要添加的 基数
		$count_fill = $this->calAddBaseCount($content, $count_dir);
		
		
		$content = preg_replace_callback('~#(#| ).*~', function ($matches) use ($count_fill, $count_dir) {
			// 获取原始字符串
			$origin_str = $matches[0];
			// 获取原始字符串中 # 号数量
			$count_origin = substr_count(explode(" ", $origin_str)[0], '#');
			// 计算出最终需要的#
			$count_end = $this->calAddEndNum($count_origin, $count_fill, $count_dir);
			// 替换字符串
			return str_replace(str_repeat('#', $count_origin), str_repeat('#', $count_end), $matches[0]);
		}, $content);

		return $content;
	}

	private function calAddEndNum($count_origin, $count_fill, $count_dir)
	{
		// 存在一个判断 => 如果是内部的层级小于了最起始的 # , 则强制将里面的 # 提升
		$count_end = (($count_origin + $count_fill) < $count_dir) ? ($count_dir) : ($count_origin + $count_fill);

		return ($count_end > 6) ? 6 : $count_end;	
	}

	// 计算出内容需要添加的基数
	private function calAddBaseCount($content, $count_dir)
	{
		// 需要补充的 count
		$count_fill = 0;

		// 获取文章第一个 # 时候的个数， 以此作为后面添加的基数
		preg_match('~#(#| ).*~', $content, $matches);
		if (!empty($matches)) {
			// 获取原始字符串
			$origin_str = $matches[0];
			// 获取原始字符串中 # 号数量
			$count_fill = $count_dir - substr_count($origin_str, '#');
		}

		return $count_fill;
	}

	// 去掉头部  --- --- 中间的部分  => fix: 替换成文章标题
	private function clearContentTop($content, $title, $path)
	{
		return substr_replace($content,

			($title) ? PHP_EOL . str_repeat('#', substr_count($path, '/')) .' '. $title : '',

			$this->str_n_pos($content, '---', 1),
			$this->str_n_pos($content, '---', 2) + 3
		);
	}

	/**
     *
     * 处理图片
     *
     * @param $content
     * @param $path
     * @return mixed
     */
    private function dealWithContentPic($content, $path)
    {
        $preg = '~([/|.|\w|\s|\-|\+])*\.(?:jpg|png|gif)~';
        preg_match_all($preg, $content, $matches);

        if (!empty($matches[0])) {
            foreach($matches[0] as $url) {
                if (strpos($url, '../') === 0) {
                    $replace_path = substr($path,
                        strpos($path, './') + 1,
                        $this->str_n_pos(
                            $path,
                            '/',
                            count(explode('/', $path)) - substr_count($url, '../')
                        ) - strpos($path, './'));

                    $origin_str = str_repeat('../', substr_count($url, '../'));

                    $content = str_replace($origin_str, $replace_path, $content);

                }
            }
        }

        return $content;
    }

	
}

$md =  new Md();
// 设置读取路径 => 定位到 content 目录
// $md->setReadPath('./content');
// 设置写入路径 
// $md->setWritePathPrefix('./test');
$md->run();

?>
