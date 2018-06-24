<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="js/Alert/myAlert.css" />
		
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/Alert/myAlert.js" ></script>
		
	</head>
	<body>
		<button onClick="$.myAlert('这里是提示框内的内容');">点击弹出提示框</button><br/><br/>
		<button onClick="$.myAlert({title:'Title',message:'message',callback:function(){alert(1)}});">点击弹出提示框(带有callback)</button><br/><br/>
		<button onClick="$.myConfirm({title:'确认框提示标题',message:'确认框提示内容',callback:function(){alert('callback')}})">点击弹出确认框</button><br/><br/>
		<button onClick="$.myToast('提示内容')">点击弹出自动消失的提示</button><br/><br/>
	</body>
</html>
