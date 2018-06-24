<?php
/*
	File Name : PostMsg.php
	Function  : 投递信息到缓存中(后端)
	Last Edit : Jun 13,2018T01:30
	Programmer: MeetinaXD.
*/
	include "./src/BufferClass.php";
	//从请求URL地址中获取 d 参数
	$dat = $_POST["Data"];
	$username = $_POST["username"];
	$ueid = $_POST["ueid"];
	$RoomId = $_POST["RoomId"];
	if (strlen($dat) > 0){
		$buffer = new RelayBuffer();
		$BufferFileName = "/$RoomId.txt";
		$posi = $buffer->AddToBuffer($BufferFileName,$User.' : '.$dat);
		echo $posi;
	}else{
		echo "invaluable.";
	}
?>