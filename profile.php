<?php
    require('session.php');
    
    if(!isset($_SESSION['username'])){
        echo "<script>alert('Please log in first!')</script>";
        header("Refresh: .1; url=index.php");
    }


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
 <h3>Todo : populate profile page</h3>

</div>
 </body>
 </html>

