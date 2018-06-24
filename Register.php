<?php
/*
	File Name : Register.php
	Function  : 用户注册
	Last Edit : Jun 14,2018T16:03
	Programmer: MeetinaXD.
*/
	error_reporting(E_ALL || ~E_NOTICE);
	include './src/AccountManager.php';
	$User = $_POST["username"];
	$Passwd = $_POST["password"];
	$Email = $_POST["email"];
	$Nickname = $_POST["nickname"];
	if (strlen($User) == 0){
		echo 'Username is not allowed to be empty.';
		exit;
	}
	if (strlen($Passwd) == 0){
		echo 'Password is not allowed to be empty.';
		exit;
	}
	if (strlen($Email) == 0){
		echo 'Email is not allowed to be empty.';
		exit;
	}
	if (strlen($Nickname) == 0){
		echo 'Nickname is not allowed to be empty.';
		exit;
	}
	if (strlen($User) < 5){
		echo 'Username is too short.(Length less than 5)';
		exit;
	}
	if (strlen($Passwd) < 5){
		echo 'Passwd is too short.(Length less than 5)';
		exit;
	}
	if (strlen($Email) < 5){
		echo 'Email is too short.(Length less than 5)';
		exit;
	}
	if (strlen($Nickname) < 5){
		echo 'Nickname is too short.(Length less than 5)';
		exit;
	}
	$Account = new Account();
	$res = $Account->Register($User,$Passwd,$Email,$Nickname);
	$resarr['OperateType'] = 'Register';
	$resarr['errCode'] = $res;
	return json_encode($resarr);

?>