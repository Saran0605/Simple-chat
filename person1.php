<?php
include('db.php');

$query = "SELECT * FROM person1";

$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .chat-container {
            width: 350px;
            height: 500px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .messages {
            padding: 10px;
            overflow-y: auto;
            flex-grow: 1;
        }

        .message {
            margin: 10px 0;
            max-width: 80%;
            padding: 8px 12px;
            border-radius: 10px;
            clear: both;
        }

        .left {
            background-color: #e1ffc7;
            float: left;
        }

        .right {
            background-color: #dcf8c6;
            float: right;
        }

        .input-container {
            display: flex;
            border-top: 1px solid #ddd;
            padding: 10px;
            background-color: #fafafa;
        }

        .input-box {
            flex-grow: 1;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 10px;
            margin-right: 10px;
            outline: none;
            font-size: 14px;
        }

        .send-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    

<div class="chat-container" id="box">
    <div class="messages" id="messages">
    <?php

while($row = mysqli_fetch_assoc($result)) {
    
?>
        <div class="message right"><?php echo $row['chat']; ?></div>
<?php
}?>
        
        <div class="message left"></div>
    </div>

    <div class="input-container">
        <input type="text" class="input-box" id="messageInput" placeholder="Type a message">
        <button class="send-btn">Send</button>
    </div>
</div>

<script>

    $(document).on("click",".send-btn",function(e){
        e.preventDefault();
        var message = $("#messageInput").val();
        console.log(message);
        $.ajax({
            url:"backend.php",
            type:"POST",
            data:{
                p1_send:true,
                msg : message,
            },
            success:function(response){
                var res = jQuery.parseJSON(response);
                if(res.status == 200){
                    $("#messageInput").val("");
                    $('#box').load(location.href + "#box");

                }
                else{
                    alert("message not sent,Try again");
                }
            }
    });
});
</script>


</body>
</html>
