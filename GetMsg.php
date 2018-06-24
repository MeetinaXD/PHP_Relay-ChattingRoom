<?php
/*
	File Name : GetMsg.php
	Function  : 从缓存中读取信息(后端)
	Last Edit : Jun 13,2018T01:30
	Programmer: MeetinaXD.
*/
	include "./src/BufferClass.php";
	include './src/AccountManager.php';
	//从请求URL地址中获取 d 参数
	$data = file_get_contents('php://input');
	//echo 'data is'.$data;
	//$User = $_POST["User"];
	if (!is_null(json_decode($data))){
		$postJson = json_decode($data);
		$username = $postJson->{'username'};
		$ueid = $postJson->{'ueid'};
		$RoomId = $postJson->{'roomId'};
		$data = $postJson->{'position'};
		$resarr['OperateType'] = 'GetMessage';
		$Account = new Account();
		if (!$Account->CompareUeid($username,$ueid)){
			$resarr['errCode'] = STATUS_CODES('Access_IllegalUeid');
		}else{
			$resarr['errCode'] = STATUS_CODES('GetMsg_Succeed');
			$buffer = new RelayBuffer();
			$BufferFileName = "/$RoomId.txt";
			$posi = $buffer->ReadFromBuffer($BufferFileName,$data);
			$resarr['Message'] = $posi;
		}
		if (!$Account->CheckUserLogin($username)){
			$resarr['errCode'] = STATUS_CODES('User_UserNotLogin');
		}
		
	}else{
		$resarr['errCode'] = STATUS_CODES('IllegalFormat');
		//echo "illegal format.";
	}
	echo json_encode($resarr);
?>