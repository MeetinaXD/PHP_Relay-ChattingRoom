<?php
/*
	File Name : Logout.php
	Function  : 用户登出
	Last Edit : Jun 14,2018T16:04
	Programmer: MeetinaXD.
*/
	error_reporting(E_ALL || ~E_NOTICE);
	include './src/AccountManager.php';
	$User = $_POST["username"];
	$ueid = $_POST["ueid"];
	if (strlen($User) == 0){
		echo 'Username is not allowed to be empty.';
		exit;
	}
	if (strlen($ueid) == 0){
		echo 'ueid is not allowed to be empty.';
		exit;
	}
	if (strlen($User) < 5){
		echo 'Username is too short.(Length less than 5)';
		exit;
	}
	if (strlen($ueid) != 32){
		echo 'IllEgal Ueid Format!';
		exit;
	}
	$Account = new Account();
	$res = $Account->Logout($User,$ueid);
	$resarr['OperateType'] = 'Logout';
	$resarr['errCode'] = $res;
	return json_encode($resarr);

?>