<?php
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('databasefilesNEW/publisher.php');
    
    if( !empty($_POST['Username']) && !empty($_POST['Password']) ){
        
        $query = "SELECT username FROM Users WHERE username = '" . $_POST['Username'] . "' and password = '" . md5($_POST['Password']) . "';";
        
        printf(publisher($query));
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
        <a href="signup.php">Sign up</a>
        </body>
    
    </html>