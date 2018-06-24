<?php
/*
	File Name : BufferClass.php
	Function  : 写入/读取 缓存文件
	Last Edit : Jun 13,2018T15:04
	Programmer: MeetinaXD.
*/
	class RelayBuffer{
		private $basePath;
		private $fo;
		/*
			向Buffer末尾写入一段数据，需要指定写入数据，可用作下一次读取的开始读取位置。
			使用方法：AddToBuffer(待写入数据)
		*/
		function __construct(){//构造函数
			$this->basePath= './Buffer/Request';
			$this->fo = new FileOperate();
		}
		function AddToBuffer($filename,$data){
			$path = $this->basePath.$filename;
			do{
				$fp = $this->fo->OpenFile($path);
			}while($fp == false);
			$filesize = filesize($path);
			fwrite($fp, $data);
			fclose($fp);
			return $filesize;//返回写入前的文件大小，作为下一次的position使用
		}
		/*
			从Clientbuffer中读取一段数据，需要指定开始读取位置，并返回到文件尾之间的所有数据。
			使用方法：ReadFromBuffer(开始位置)
		*/
		function ReadFromBuffer($filename,$position){
			$path = $this->basePath.$filename;
			do{
				$fp = $this->fo->OpenFile($path);
			}while($fp == false);
			$filesize = filesize($path);
			fseek($fp, $position);//移动文件指针到position处
			$data = '';
			if ($filesize - $position >= 1){
				$data = fread($fp, $filesize - $position);
			}
			fclose($fp);
			return $data;//返回读取的数据
		}
		function ClearBuffer($filename,$position){
			$path = $this->basePath.$filename;
			do{
				$fp = $this->fo->OpenFile($path);
			}while($fp == false);
		}
	}
	class FileOperate{
		function OpenFile($filename){
			if (!file_exists(dirname($filename))){//如果目录不存在
				mkdir(dirname($filename),0777,true);//创建目录,0777最大权限
			}
			$fp = fopen($filename,"a+b") or die ("Unable to open file!");
			return $fp;
		}
	}
?>