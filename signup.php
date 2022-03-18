
<?php
    require("session.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //To access Database RabbitMQ Publisher
    require('SQLFiles/SQLPublish.php');
    
    //Checks if form submissions are not empty
    if(!empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['First_Name']) && !empty($_POST['Last_Name']) && !empty($_POST['Email'])){

        //Setting array and its values to send to RabbitMQ
        $queryValues = array();
        
        $queryValues['type'] = 'signup';
        $queryValues['username'] = $_POST['Username'];
        $queryValues['password'] = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $queryValues['firstName'] = $_POST['First_Name'];
        $queryValues['lastName'] = $_POST['Last_Name'];
        $queryValues['email'] = $_POST['Email'];

        //Printing Array and executing SQL Publisher function
        print_r($queryValues);
        $result = publisher($queryValues);

        //If returned 1, it means it was pushed to the database. Otherwise, echo error
        if($result == 1){
            echo "Just signed up: ";
            
            if(isset($_SESSION)){
                session_destroy();
                session_start();
            }else{
                session_start();
            }

            $_SESSION['username'] = $_POST['Username'];
            echo $_SESSION['username'];
            header("Refresh: 2; url=index.php");
        }else{
            echo $result;
        }
    }

?>
<!DOCTYPE HTML>
<html>
    
    <head>
        <title>AnimeList - Signup</title>
        <link rel="stylesheet" href="signuplogin.css">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
    </head> 

    <body>
        <h1 class = "header">Sign up!</h1>
        <form method = 'post' >
                <label>Username</label>
                <input type = "text" name = "Username"></input><br><br>
                <label>Password</label>
                <input type = "password" name = "Password" required></input><br><br>
                <label>First Name</label>
                <input type = "text" name = "First Name"></input><br><br>
                <label>Last Name</label>
                <input type = "text" name = "Last Name"></input><br><br>
                <label>Email</label>
                <input type = "email" name = "Email"></input><br><br>
                <input type = "submit" value = "Submit"></input>
        </form><br>
        
        <p1>Have an account?<p1>
        <a href="login.php">Log in</a><br>
        <a href="index.php">Home</a>
    </body>
</html>