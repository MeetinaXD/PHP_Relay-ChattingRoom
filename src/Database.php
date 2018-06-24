<?php
/*
	File Name : Database.php
	Function  : 数据库操作
	Last Edit : Jun 14,2018T-3:34
	Programmer: MeetinaXD.
*/
	//可以取出某行，或者一个一个取出某个数据
	Class Database{
		private $con;
		function __construct(){//构造函数
			$this->Init();
		}
		function Init(){
			$this->con = new mysqli('bdm267988569.my3w.com','bdm267988569','ca88af3a71');//连接数据库
			if($this->con->connect_errno){
				die('Failed to connect MySQL DataBase');
				exit;
			}
			//$sql = "set names utf8;SELECT * FROM bdm267988569_db;";
			//$this->con->query($sql);
			return $this->con;
		}

		function Execute($command){
			return $this->con->query($command);
		}
		function GetAutoIncrementValue($tablename){
			$sql = "select max(ID) from $tablename";
			$result = $this->Execute($sql);
			$row = $result->fetch_assoc();
			return $row['max(ID)'];
		}
		function __destruct(){//构析函数
			$this->con->close();
		}
	}
?>