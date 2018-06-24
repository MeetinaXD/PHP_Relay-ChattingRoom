<?php
	$_StatusCodes['Access_IllegalUeid'] = 404;
	$_StatusCodes['UnknownError'] = -1;
	$_StatusCodes['IllegalFormat'] = -2;

	$_StatusCodes['Login_WrongPassword'] = 0;
	$_StatusCodes['Login_UserNotExist'] = 1;
	$_StatusCodes['Login_UserBanned'] = 2;
	$_StatusCodes['Login_UserHasLogined'] = 3;
	$_StatusCodes['Login_LoginSucceed'] = 4;
	$_StatusCodes['Login_DatabaseError'] = 16;

	$_StatusCodes['Logout_UserNoLogined'] = 17;
	$_StatusCodes['Logout_LogoutSucceed'] = 18;

	$_StatusCodes['Register_UserExist'] = 6;
	$_StatusCodes['Register_UserNotAllow'] = 7;
	$_StatusCodes['Register_PasswdNotAllow'] = 8;
	$_StatusCodes['Register_EmailExist'] = 9;
	$_StatusCodes['Register_EmailNotAllow'] = 10;
	$_StatusCodes['Register_RegisterSucceed'] = 11;
	$_StatusCodes['Register_RegisterFailed'] = 12;

	$_StatusCodes['Email_EmailExist'] = 14;
	$_StatusCodes['Email_EmailNotExist'] = 15;

	$_StatusCodes['User_UeidNotCompare'] = 19;
	$_StatusCodes['User_UserNotLogin'] = 20;

	$_StatusCodes['GetMsg_Succeed'] = 21;
	//$_StatusCodes[''] = ;
	function STATUS_CODES($status_string){
		global $_StatusCodes;
		return $_StatusCodes[$status_string];
	}
?>