<?php

include('db.php');

if(isset($_POST["p1_send"])){
    $msg = $_POST["msg"];

    $query = "INSERT INTO person1(chat)VALUES('$msg')";
    if(mysqli_query($conn, $query)){
        $res = [
            "status" => 200,
            "msg" => "Message sent successfully"
        ];
        echo json_encode($res);
    }
    else{
        $res = [
            "status" => 500,
            "msg" => "Failed to send message"
        ];
        echo json_encode($res);
    }

}

?>