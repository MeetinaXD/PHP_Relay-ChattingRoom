<?php
/*
	File Name : checkip.php
	Function  : 获取自身ip以及客户ip(前端)
	Last Edit : Jun 9,2018T11:37
	Programmer: MeetinaXD.
*/
$con = mysql_connect('bdm267988569.my3w.com','bdm267988569','ca88af3a71');

	ignore_user_abort(); //后台运行
	set_time_limit(0); //取消脚本运行时间的超时上限
	$interval=10; //10秒进行一次检测
	do{
		CheckWaitList();
		sleep($interval);
	}while(true);

function CheckWaitList(){
	$result = mysql_query("SELECT discription FROM game_waitlist where ip='CheckService'");
	if($result != 'Running'){
		mysql_query("UPDATE game_waitlist SET discription='Running' where ip='CheckService'");
		if($result == 'StopRunning'){
			mysql_query("UPDATE game_waitlist SET discription='NotRunning' where ip='CheckService'");
			exit();
		}
	}
}
?>