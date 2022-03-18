<?php

    require('session.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('SQLFiles/SQLPublish.php');
    
    //Checks if form submissions are empty
    if( !empty($_POST['Username']) && !empty($_POST['Password']) ){
        
        //Creating array and attaching values to send to RabbitMQ
        $queryValues = array();

        $queryValues['type'] = 'login';
        $queryValues['username'] = $_POST['Username'];
        $queryValues['password'] = md5($_POST['Password']);
        
        //Print Array, Publiush to RabbitMQ and fetch Results
        print_r($queryValues);
        $result = publisher($queryValues);
        print_r($result);

        //Checks password to hashed password in databse. If okay, logs you in.
        if(password_verify($_POST['Password'], $result[1])){
            
            echo "Great, we found you: ";
            
            if(isset($_SESSION)){
                session_destroy();
                session_start();
            }else{
                session_start();
            }
            $_SESSION['username'] = $_POST['Username'];
            echo $_SESSION['username'];
            header("Refresh: 2; url=index.php");
        
        //Alerts if invalid log in credentials
        }else{
            echo "<script>alert('Please enter right credentials');</script>";
        }
    }
?>

<DOCTYPE! HTML>
    <html>
    <head>
        
        <title>AnimeList - Login</title>
        <link rel="stylesheet" href="signuplogin.css">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        
        </head>

        <body>
            <h1 class = "header">Log in!</h1>  

            <form method = 'post'>
                <label>Username</label>
                <input type = "text" name = "Username"></input><br><br>
                <label>Password</label>
                <input type = "text" name = "Password"></input><br><br>
                <input type = "submit" value = "Submit"></input>
            </form>
        
        <p1>Don't have an account?<p1>
        <a href="signup.php">Sign up</a><br>
        <a href="index.php">Home</a>
        </body>
    
    </html>