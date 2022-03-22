<?php
    require_once("apiScript.php");

    //$data_json = file_get_contents('https://api.jikan.moe/v4/schedules');
    
    // database credentials
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "users";

    // create connection with given credentials
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection
    if ($conn->connect_error){
        //kill connection + show on result
        die("connection failed: " . $conn->connect_error);
    }
    
    //GET TARGET USER ID FROM SOMEWHERE
    //$targetID = $_POST['somename'];

    $notificationenable = "UPDATE users
            SET notif = 1
            WHERE ID = $targetID";
    $notificationdisable = "UPDATE users
            SET notif = 0
            WHERE ID = $targetID";

    $result = $conn->query($notificationdisable);
    
?>