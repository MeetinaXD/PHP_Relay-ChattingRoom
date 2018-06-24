function Login(resJson){
	switch (resJson.errCode){
		case 0://Wrong Password
			$.myAlert({title:'Error',message:'message'});
			break;
		case 1://User Not Exist
			$.myAlert({title:'账号不存在',message:'该账号不存在，请重新输入'});
			break;
		case 2://User Banned
			$.myAlert({title:'禁止登录',message:'由于相关法律法规，该账号已被封禁'});
			break;
		case 3://User has logined
			$.myAlert({title:'账号已登录',message:'该账号已在其它设备登录，请先登出'});
			break;
		case 4://Login successfully
		//$.myAlert({title:'Error',message:'Login_UserNotExist'});
			setCookie('ueid',resJson.ueid,12);
			return true;
			break;
		case 16://Database Error
			$.myAlert({title:'后台错误',message:'数据库错误，请稍后重试。若重试失败，请联系系统管理员'});
			break;
		case -1://-1
			$.myAlert({title:'未知错误',message:'未知错误（错误代码：-1）'});
			break;
	}
	return false;
}