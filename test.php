<?php

class DownLoad {

	private $data = [];

	private $belong_dir_data = [];

	private $basic_prefix = '';

	// 遍历出所有的文件   ===>  ok
	public function get_allfiles($path, $cal_count, &$files) {

		if(is_dir($path)){
			$dp = dir($path);

			while ($file = $dp ->read()){
				if($file !="." && $file !="..") {
					$this->get_allfiles($path."/".$file, $cal_count, $files);
				}
			}

			$dp ->close();
		}

		if(is_file($path) && substr($path, strrpos($path, '.')+1) == 'md') {

			$level = substr_count($path, '/') - 1 - $cal_count;

			$sort_value = $this->getSortValue($path, $level);
			array_push($this->data, [
				'path'		=>	$path,
				'sort_value'	=> $sort_value
			]);
		}
		return $this->data;

	}


	// 获取排序值 =>  ok
	private function  getSortValue($path, $level)
	{

		/*
		 * 从路径中获取层级信息
		 *
		 * */
		$sort_value = 0;

		$count = count(explode('/', $path));
		$mul_int = 100000000;
		for ($i = 0; $i < $level; $i++) {
			$index_file = substr($path, 0, $this->str_n_pos($path, '/', $count - ($level - $i))). '/_index.md';

			if (is_file($index_file)) {
				$sort_value += $this->getWeightPath($index_file) * $mul_int;
			}
			$mul_int =	$mul_int / 10;
		}

		// 补充进本身的 Weight
		if (substr($path, strpos($path, '/_index.md')) !== '/_index.md') {
			$content = file_get_contents($path);
			$sort_value += 	intval(substr($content, strripos($content, 'weight:')+8, 3));
		}

		return $sort_value;
	}

	// 获取权重
	private function getWeightPath($path)
	{
		$content = file_get_contents($path);
		return intval(substr($content, strripos($content, 'weight:')+8, 3));
	}

	// 获取标题
	private function getTitlePath($path)
	{
		$content = file_get_contents($path);
		$split_content = substr($content, strpos($content, 'title: ')+8);
		return substr($split_content, 0, strpos($split_content, '"'));
	}

	// 排序
	public function dealData()
	{


		usort($this->data, function($a, $b) {
			if ($a['sort_value'] > $b['sort_value']) {
				return 1;
			} else {
				return -1;
			}
		});

		foreach ($this->data as $k => $item) {
			$content = file_get_contents($item['path']);

			if (substr($item['path'], strpos($item['path'], '/_index.md')) == '/_index.md' || strstr($content, 'draft: true')) {
				unset($this->data[$k]);
			}

		}

		return $this->data;
	}

	// 写入最终的文件
	public function writeEndFile($output_file)
	{
		$index = 0;
		$this->title_index = 2;

		$dir_address = substr($output_file, 0, $this->str_n_pos($output_file, '/', count(explode('/', $output_file)) - 1));

		// 写入之前清空文件
		file_put_contents($output_file, "");
		foreach ($this->data as $item) {


			$content = file_get_contents($item['path']);

			$content = $this->optimizeConent($content, $item['path'], $index);

			// 获取文件路径名
			$dir_address = substr($output_file, 0, $this->str_n_pos($output_file, '/', count(explode('/', $output_file)) - 1));

			$this->mkdirs($dir_address);

			file_put_contents($output_file, $content, FILE_APPEND | LOCK_EX);

			$index++;
		}

		// 清空数据信息
		$this->data = [];
	}

	public function writePrivateFile($path)
	{
		$str = '---
			isPrivate: true
			not_show: true
			---
		';

	   return 	file_put_contents($path, $str);
	}


	public function setConfig($basic_prefix)
	{
		$this->basic_prefix = $basic_prefix;
	}

	private function optimizeConent($content, $path, $index = 0)
	{
		$split_content = substr($content, strpos($content, 'title: ')+8);
		$title = substr($split_content, 0, strpos($split_content, '"'));

		if ($index > 0) {

			// 拼接标题
			// 需要处理的是, 如果是相同文件夹, 需要规划成一类
			// 思路1 : 就是 处理了之后, 将添加了的文件信息添加进一个数组, 然后数组里
			// 出现问题, 就是要从其实的位置来获取层级

			$belong_dir = substr($path, 0, strripos($path, '/'));

			$dir_count = substr_count(substr($path, strlen($this->basic_prefix)), '/');
			if (($dir_count == 1)) {
				$index_file_path = substr($path, 0, strripos($path, '/')) . '/_index.md';
				if (is_file($index_file_path)) {
					$parent_title  = $this->getTitlePath(substr($path, 0, strripos($path, '/')) . '/_index.md');
					$top_text = PHP_EOL . '# '. $this->title_index. '、' . $parent_title . PHP_EOL;
				}
				$this->belong_dir_data[] = $belong_dir;
				$this->title_index++;
			}

			// 除去掉文件中开头的部分
			$content = substr_replace($content,
				PHP_EOL . '# ' . $title,
				$this->str_n_pos($content, '---', 1),
				$this->str_n_pos($content, '---', 2) + 3
			);

			// 将内容中所有的 # 数量+1
			$content = preg_replace_callback('~#(#| ).*~', function ($matches) {
				$origin_str = $matches[0];
				$count = substr_count($origin_str, '#') . PHP_EOL;
				$replace = str_repeat($origin_str, $count);
				return str_replace(str_repeat('#', $count), str_repeat('#', $count + 1), $origin_str);
			}, $content);

			$content = $top_text . $content;

		} else {
			$content = str_replace($title, '1、'.$title, $content);
		}

		// 处理图片
		$content = $this->dealWithContentPic($content, $path);

		// 拼接上分割符号
		// $content = $content . PHP_EOL . '---'. PHP_EOL;

		return $content;

	}

	// 补全图片路径
	private function dealWithContentPic($content, $path)
	{
		$preg = '~([/|.|\w|\s|\-|\+])*\.(?:jpg|png|gif)~';
		preg_match_all($preg, $content, $matches);

		if (!empty($matches[0])) {
			foreach($matches[0] as $url) {
				if (strpos($url, '../') === 0) {
					$replace_path = substr($path,
							strpos($path, '/content') + 8,
							$this->str_n_pos(
								$path,
								'/',
								count(explode('/', $path)) - substr_count($url, '../')
								) - strpos($path, '/content') - 7);

					// 将字符串重复n 遍
					$origin_str = str_repeat('../', substr_count($url, '../'));
					$content = str_replace($origin_str, $replace_path, $content);
				}
			}
		}
		return $content;
	}

	// 创建文件夹
	private function mkdirs($a1, $mode = 0777)
	{

		if (is_dir($a1) || @mkdir($a1, $mode)) return TRUE;

		if (!$this->mkdirs(dirname($a1), $mode)) return FALSE;

		return @mkdir($a1, $mode);

	}

	// 查找字符串中第几次出现字符的位置
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
}

// 扫描当前文件的上级目录
$con = '.';

$filename = scandir($con . '/content');

$download = new DownLoad();

$download->setConfig($con . '/content');

$cal_count = substr_count($con .'/content/', '/');

foreach ($filename as $file) {
	if (count(explode('.', $file)) == 2 && $file != 'pdf') {
		// 获取此文件夹里面的文件夹
		$in_file_arr = scandir($con. '/content/'.$file);
		foreach ($in_file_arr as $in_file) {

			if (is_dir($con . '/content/'.$file .'/'. $in_file) && ($in_file != '.' && $in_file != '..' && $in_file != '_images')) {
				$download->get_allfiles($con . '/content/' . $file . '/'. $in_file, $cal_count,  $files);
			 	$download->dealData();
			 	$download->writeEndFile($con . '/content/pdf/'.$file. '/' . $in_file . '.md');

			}
		}
	}
}

$download->writePrivateFile($con . '/content/pdf/_index.md');