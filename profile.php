<?php
    require('session.php');
    checkLogin();
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
</div>
<div align ="center">
<?php
    require_once('SQLFiles/SQLPublish.php');
    $userInfo = publisher(array(
        'type' =>'fetchUserInfo',
        'username' => $_SESSION['username']
    ));
    echo "<strong>Hello: </strong><i>" . $userInfo[1] . "</i> <strong>!</strong><br><br>";
    echo "<strong>First Name: </strong>" . $userInfo[3] . "<br>";
    echo "<strong>Last Name: </strong>" . $userInfo[4] . "<br>";
    echo "<strong>Email: </strong>" . $userInfo[5] . "<br>";


?>     
</div>
 </body>
 </html>

