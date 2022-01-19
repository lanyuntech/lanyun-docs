<?php

class File extends SplFileInfo{

	protected $path = '';
	protected $pFile = null;

	public function __construct($path)
	{
		$this->path = $path;	
		parent::__construct($path);
	}

	public function getWeight()
	{
		if($this->isDir()){
			$weight = $this->getDirectoryWeight();
		}else{
			$weight = $this->getFileWeight($this->path);
		}
		return $weight;
	}

	public function getTitle()
	{
		return $this->getFileTitle($this->path);
	}

	/*
	 *  获取是不是草稿
	 * TODO => 如果是上级文件为草稿， 子文件也不应该显示
	 */
	public function checkIsDraft()
	{
		$content = file_get_contents($this->path);
		preg_match('/draft: (\S+)/',$content,$dmatch);

		return (!empty($dmatch) && $dmatch[1] == 'true') ? true : false;
	}

	protected function getDirectoryWeight()
	{
		$files = $this->getFiles();
		foreach($files as $f){
			$fileObj =  new SplFileInfo($f);
			$fileName = $fileObj->getFileName();
			if($fileName==='_index.md'){
				$obj = new self($fileObj->getRealPath());
				return $obj->getWeight();
			}
		}
		return 0;
	}

	public function getFileTitle($filepath)
	{
		$content = file_get_contents($this->path);
		$split_content = substr($content, strpos($content, 'title: ')+8);
        return substr($split_content, 0, strpos($split_content, '"'));
	}

	public function getFileWeight($filepath)
	{
		if (!is_file($filepath)) return 0;
		$content = file_get_contents($filepath);
		preg_match('/weight: (\d+)/',$content,$wmatch);
		if(empty($wmatch[1])){
			// $this->error("文件%s:获取weight错误",[$filepath]);
			return  0 ;
		}
		return $wmatch[1];
	}

	public function sortDirAndFile()
	{
		$dir = $this->path;
		$returnDirs =$files = [];
		$rfp = opendir($dir);

		$ret = [];

		while(($file=readdir($rfp))!==false){
			if($file==='.'
			||$file==='..'
			||$file==='pdf'
			||$file === '.idea'
			||(is_file($file) && substr($file, strpos($file, '.md')) !== '.md')) continue;

			$path =  $dir . DS . $file;	

			$weight = (is_file($path)) ? $this->getFileWeight($path) : $this->getFileWeight($path. '/_index.md');

			$ret[] = [
				'weight'	=>	$weight,
				'path'		=>	$path,
				'isFile'	=>	(is_file($path)) ? true : false
			];

		}

		$ret = $this->arraySort($ret, 'weight', SORT_ASC);

		$index_info = [];

		foreach($ret as $k => $v) {
			if (substr($v['path'], strpos($v['path'], '_index.md')) === '_index.md') {
				$index_info = $v;
				unset($ret[$k]);
				break;
			}
		}
		if (!empty($index_info)) {
			array_unshift($ret, $index_info);
		}

		return $ret;
	}


	/**
	 * 二维数组根据某个字段排序
	 * @param array $array 要排序的数组
	 * @param string $keys   要排序的键字段
	 * @param string $sort  排序类型  SORT_ASC     SORT_DESC 
	 * @return array 排序后的数组
	 */
	function arraySort($array, $keys, $sort = SORT_DESC) {
		$keysValue = [];
		foreach ($array as $k => $v) {
			$keysValue[$k] = $v[$keys];
		}
		array_multisort($keysValue, $sort, $array);
		return $array;
	}

}


?>
