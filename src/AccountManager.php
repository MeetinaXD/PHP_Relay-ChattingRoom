<?php
/*
	File Name : AccountManager.php
	Function  : 用户管理
	Last Edit : Jun 14,2018T03:36
	Programmer: MeetinaXD.
*/
	//Profile save in Access
	include './src/Database.php';
	include './src/sstr.php';
	include './src/StatusCodes.php';
	Class Account{
		private $db;
		private $user_ueid;
		//private $con;
		function __construct(){//构造函数
			ini_set('date.timezone','Asia/Shanghai');
			$this->db = new Database();
			//$this->con = $this->db->Init();
		}

		function Login($User,$Passwd){//判断账号密码是否一致
			$sql = "SELECT * FROM bdm267988569_db.CR_users WHERE user_name='$User'";
			$result = $this->db->Execute($sql);
			if ($result->num_rows > 0) {
    			$row = $result->fetch_assoc();
    			if ($row["user_pass"] == $Passwd){
    				/*
    					生成AccessKey(UEID)
						进入CR_Logined表
						登记用户登录信息。
    				*/
					if ($this->CheckUserLogin($User)){//已经登录
						return STATUS_CODES('Login_UserHasLogined');
					}
					$AccessKey = new AccessKey($User);
					$ueid = $AccessKey->GetUeid();
					$ID = $this->db->GetAutoIncrementValue('bdm267988569_db.CR_Logined') + 1;
					$time = $AccessKey->GetTime();
					$this->user_ueid = $ueid;
					$sql = "INSERT INTO bdm267988569_db.CR_Logined (ID,user_name,user_ueid,user_login_time) VALUES ('$ID','$User','$ueid','$time')";
					$result = $this->db->Execute($sql);
					if($result){
						return STATUS_CODES('Login_LoginSucceed');//登录成功
					}
						return STATUS_CODES('Login_DatabaseError');//写入到数据库错误
    			}
    			return STATUS_CODES('Login_WrongPassword');//密码错误
			}else{
				return STATUS_CODES('Login_UserNotExist');//账号不存在
			}
			//echo $result;
			return STATUS_CODES('UnknownError');
		}
		function GetUeid(){
			return $this->user_ueid;
		}

		function Logout($User,$ueid){
			if (!$this->CheckUserExist($User)){//检查账号密码是否存在
    			return STATUS_CODES('Login_UserNotExist');//账号不存在
			}
			if (!$this->CheckUserLogin($User)){
				return STATUS_CODES('Logout_UserNoLogined');
			}
			if (!$this->CompareUeid($User,$ueid)){
				return STATUS_CODES('Access_IllegalUeid');
			}
			$sql = "DELETE FROM bdm267988569_db.CR_Logined WHERE user_ueid='$ueid';";
			$result = $this->db->Execute($sql);
			if ($result){
				return STATUS_CODES('Logout_LogoutSucceed');
			}
			return STATUS_CODES('UnknownError');
		}





		function Register($User,$Passwd,$email,$nickname){
			if ($this->CheckUserExist($User)){//检查账号密码是否存在
    			return STATUS_CODES('Register_UserExist');//账号已经存在
			}
			$ID = $this->db->GetAutoIncrementValue('bdm267988569_db.CR_users') + 1;
			//echo $ID;
			$email = strtolower($email);
			if(!$this->CheckEmailExist($email)){/*检查邮箱是否已经被注册*/
				$date = date('y/m/d h/i/s',time());
				$sql = "INSERT INTO bdm267988569_db.CR_users (ID,user_name,user_pass,user_nickname,user_email,user_registered,user_status) VALUES ('$ID', '$User', '$Passwd', '$nickname', '$email', '$date', '0')";
				$result = $this->db->Execute($sql);
				if ($result)return STATUS_CODES('Register_RegisterSucceed');
				return STATUS_CODES('Register_RegisterFailed');
			}else{
				return STATUS_CODES('Email_EmailExist');
			}
			return STATUS_CODES('UnknownError');
		}

		function CheckEmailExist($email){
			$sql = "SELECT * FROM bdm267988569_db.CR_users WHERE user_email='$email'";
			$result = $this->db->Execute($sql);
			if ($result->num_rows > 0){
    			return true;
			}
			return false;
		}


		function CheckUserExist($User){
			$sql = "SELECT * FROM bdm267988569_db.CR_users WHERE user_name='$User'";
			$result = $this->db->Execute($sql);
			if ($result->num_rows > 0){
    			return true;
			}
			return false;
		}


		function CheckUserLogin($User){
			$sql = "SELECT * FROM bdm267988569_db.CR_Logined WHERE user_name='$User'";
			$result = $this->db->Execute($sql);
			if ($result->num_rows > 0){
    			return true;
			}
			return false;
		}
		function CompareUeid($User,$ueid){
			$sql = "SELECT * FROM bdm267988569_db.CR_Logined WHERE user_ueid='$ueid'";
			$result = $this->db->Execute($sql);
			if ($result->num_rows > 0){
				$row = $result->fetch_assoc();
				if ($row['user_name'] == $User){
    				return true;
				}
				return false;
			}
			return false;
		}
	}
	Class AccessKey{
		private $DateAndTime;
		private $RandomStr;
		private $res;
		function __construct($User){
			$this->DateAndTime = date('y/m/d h/i/s',time());
			$this->RandomStr = CreateRandomStr();
			$this->res = $this->DateAndTime.$this->RandomStr.$User;
		}
		function GetUeid(){
			return md5($this->res);
		}
		function GetTime(){
			return $this->DateAndTime;
		}
	}
?>