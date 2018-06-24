//****
function sstrlen(str){
	return str.replace(/[\u0391-\uFFE5]/g,"aaa").length;  //先把中文替换成三个字节的英文，再计算长度
};
//*****
var BufferPosition = 0;
window.setInterval(GetMessage, 1000);
function GetMessage(){
	var username = getCookie('username');
	var ueid = getCookie('ueid');
	var RoomId = $("input#RoomIdInput").val();
	var postJson = JSON.stringify({"username" : username , "ueid" : ueid , "RoomId" : RoomId , "Position" : BufferPosition});
	alert(postJson);
	$.ajax({
		type : 'POST',
		url : './GetMsg.php',
		data : JSON.stringify({
				"username" : username,
				"ueid" : ueid,
				"roomId" : RoomId,
				"position" : BufferPosition
				}),//$("input#MessageInput").val()
		success : function(resData){
			BufferPosition += sstrlen(resData);//wrong
			if (sstrlen(resData) > 0){
				$("span#return").html('Now String size =' + sstrlen(resData));
				$("textarea#chatHistory").val($("textarea#chatHistory").val() +  resData);
			}
		}
	});
}
function PostMessage(){
	if ($("input#UserNameInput").val() != 'Press your username here!'){
		postJson['Data'] =$("input#MessageInput").val() + '\n';
		$.ajax({
			type : 'POST',
			url : './PostMsg.php',
			data : postJson,
			success : function(resData){
				BufferPosition == resData;
				$("span#return").html('Post Successfully!');
				//$("span#return").html('Now String size =' + $("input#MessageInput").val().length);
				$("input#MessageInput").val('')
			}
		});
	}else{
		alert('Please input your Username First!');
	}
}
$(document).ready(function(){
	var username = getCookie('username');
	var ueid = getCookie('ueid');
	var RoomId = $("input#RoomIdInput").val();

	$("button#submitButton").click(function(){
		PostMessage();
	});
	$("input#MessageInput").click(function(){
		if ($("input#MessageInput").val() == 'Press your message here!')
			$("input#MessageInput").val('');
	});
	$("input#MessageInput").blur(function(){
		if ($("input#MessageInput").val() == '')
			$("input#MessageInput").val('Press your message here!');
	});
	$("input#UserNameInput").click(function(){
		if ($("input#UserNameInput").val() == 'Press your username here!')
			$("input#UserNameInput").val('');
	});
	$("input#UserNameInput").blur(function(){
		if ($("input#UserNameInput").val() == '')
			$("input#UserNameInput").val('Press your username here!');
	});
	$('input#MessageInput').bind('keypress',function(event){
		var content = $(this).val();		
		if(event.keyCode == '13'){
			PostMessage();
		}
	});
});
/***********************************************************

    Cookies Function
    surl : http://www.w3school.com.cn/js/js_cookies.asp

***********************************************************/
function setCookie(c_name,value,expirehours){
    var timeStamp = Date.parse(new Date()) / 1000;
    var timeStamp = timeStamp + expirehours*3600;//add second
    var newDate = new Date();
    newDate.setTime(timeStamp * 1000);
    document.cookie=c_name+ "=" +escape(value)+((expirehours==null) ? "" : ";expires="+newDate.toGMTString());
}
function getCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return (arr[2]);
    else
        return null;
}