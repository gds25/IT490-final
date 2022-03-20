<?php
    require('session.php');
   
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Please log in first!')</script>";
        header("Refresh: .1; url=index.php");
    }


    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "animedatabase";
    $user = "test";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT username, firstName, genreRecomended FROM Users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);//$_SESSION['username']
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
      //error message for logger
    }

    $stmt->execute();
    $stmt->bind_result($user, $firstName, $genres);
    $stmt->fetch();
    
?>

<!DOCTYPE html>
 <html>
 <body>
    
<head>
        <meta charset=UTF-8" />
        
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="page-wrap">

<div id="topnav">
        <?php include 'navbar.php';?>
</div>


 <h1 align="center">Profile</h1>
 <h3>Hey, <?php echo $user ?></h3>
 <h3>other info here</h3>

 <h3>Your Personal Genres:</h3>
    <p><?php echo $genres ?></p>


</div>
 </body>
 </html>

