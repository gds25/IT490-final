
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require('databasefilesNEW/publisher.php');
    
    if(!empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['First_Name']) && !empty($_POST['Last_Name']) && !empty($_POST['Email'])){
        
        $query = "INSERT INTO Users (username, password, firstName, lastName, email) VALUES ('" .
            $_POST['Username'] . "', '" . md5($_POST['Password']) . "', '" . $_POST['First_Name'] . "', '" . $_POST['Last_Name'] . "', '" . $_POST['Email'] . "');";

        echo publisher($query);

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
        <a href="login.php">Log in</a>
    </body>
</html>