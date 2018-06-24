<?php
	include './src/AccountManager.php';
	$db = new Account();
	//echo $db->Login('Essssadsadsssssad','rB').'<br>';
	//echo $db->Register('testUser','12345678','anw7@qq.com','MeetinaXD').'<br>';
	echo $db->Logout('testUser','c0a25d2073b4cf4be183b3fe5669ed7c').'<br>';
	//$db->CheckEmailForRegister('anwin7@qq.com');
?>