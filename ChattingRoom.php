<html>
<head>
    <?php 
        $data = $_GET["RoomId"];
        if ($data == ''){
            echo '<script language="javascript" type="text/javascript">';
            echo "window.location.href='./ChattingRoom.php?RoomId=00001';</script>";
            //exit;
        }
    ?>
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/MyJavaScript.js"></script>
</head>
<body>
    <h3>This is a Chatting Room demo of PHP Relay.</h3>
    Message: <input type="text" name="MessageInput" id="MessageInput" value="Press your message here!"/>
    UserName: <input type="text" name="UserNameInput" id="UserNameInput" value="Press your username here!"/>
    RoomId: <input type="text" name="RoomIdInput" id="RoomIdInput" value="<?php echo $_GET["RoomId"]; ?>"/>
    <button type="button" id="submitButton">Click Me To POST!</button>
    <p>Return: <span id="return"></span></p>
    <textarea name="chatHistory" id="chatHistory" style="width: 100%;height: 70%" value=""></textarea>
</body>
</html>
