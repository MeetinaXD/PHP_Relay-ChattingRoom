
jQuery(document).ready(function() {
    
    //$.myAlert({title:'Cookies',message:'cookies is:'+decodeURI(document.cookie)});
         $.myAlert({title:'Cookies',message:'username is:'+getCookie('username')+'<br>UEID is:'+getCookie('ueid')});
    
    $("button#submitButton").click(function(){
        var username = $('.page-container form').find('.username').val();
        var password = $('.page-container form').find('.password').val();
        if (sstrlen(username) < 5){
            $.myAlert({title:'Illegal Format',message:'username too short(Less than 5)'});
            return;
        }
        if (sstrlen(password) < 5){
            $.myAlert({title:'Illegal Format',message:'password too short(Less than 5)'});
            return;
        }
        $.ajax({
            type : 'POST',
            url : './Login.php',
            data : {username : username,
                    password : password},//$("input#MessageInput").val()
            success : function(resData){
                if (sstrlen(resData) > 0){
                    if (!isJSON(resData)){
                        $.myAlert({title:'Return From Server',message:resData});
                        return;
                    }
                    //alert(resData);
                    var resJson = JSON.parse(resData);
                    if (resJson.OperateType == 'Login'){
                        if(Login(resJson)){
                            setCookie('username',username,12);
                        }
                    }
                    //获取返回数据后，解析json
                    //弹出相应的提示，将ueid放入cookies
                    //转跳到ChattingRoom.php
                    //resJson.OperateType;
                }
            }
        });
    });

    $('.page-container form').click(function(){
        var username = $(this).find('.username').val();
        var password = $(this).find('.password').val();
        if(username == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '27px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.username').focus();
            });
            return false;
        }
        if(password == '') {
            $(this).find('.error').fadeOut('fast', function(){
                $(this).css('top', '96px');
            });
            $(this).find('.error').fadeIn('fast', function(){
                $(this).parent().find('.password').focus();
            });
            return false;
        }
    });

    $('.page-container form .username, .page-container form .password').keyup(function(){
        $(this).parent().find('.error').fadeOut('fast');
    });

});
function sstrlen(str){
    return str.replace(/[\u0391-\uFFE5]/g,"aaa").length;  //先把中文替换成三个字节的英文，再计算长度
};
function isJSON(str) {//https://www.cnblogs.com/lanleiming/p/7096973.html
    if (typeof str == 'string') {
        try {
            var obj=JSON.parse(str);
            if(typeof obj == 'object' && obj ){
                return true;
            }else{
                return false;
            }

        } catch(e) {
            console.log('error：'+str+'!!!'+e);
            return false;
        }
    }
    console.log('It is not a string!')
}
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