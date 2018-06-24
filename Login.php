<?php
/*
	File Name : Login.php
	Function  : 用户登录
	Last Edit : Jun 14,2018T16:04
	Programmer: MeetinaXD.
*/
	error_reporting(E_ALL || ~E_NOTICE);
	include './src/AccountManager.php';
	include './src/ChromeConsole.php';
	$User = $_POST["username"];
	$Passwd = $_POST["password"];
	if (strlen($User) == 0){
		echo 'Username is not allowed to be empty.';
		exit;
	}
	if (strlen($Passwd) == 0){
		echo 'Password is not allowed to be empty.';
		exit;
	}
	if (strlen($User) < 5){
		echo 'Username is too short.(Length less than 5)';
		exit;
	}
	if (strlen($Passwd) < 5){
		echo 'Username is too short.(Length less than 5)';
		exit;
	}
	$Account = new Account();
	$res = $Account->Login($User,$Passwd);
	$resarr['OperateType'] = 'Login';
	$resarr['errCode'] = $res;
	if ($res == STATUS_CODES('Login_LoginSucceed')){
		$resarr['ueid'] = $Account->GetUeid();
	}
	echo json_encode($resarr);
	function console_log($data){
	    if (is_array($data) || is_object($data)){
	        echo("<script>console.log('".json_encode($data)."');</script>");
	    }else{
	        echo("<script>console.log('".$data."');</script>");
	    }
	}
?>