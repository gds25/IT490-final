<?php
require("session.php");
checkLogin();
include('SQLFiles/SQLPublish.php');
?>

<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <meta charset=UTF-8" /> 
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<!--
<body>

<style>

.container {display: table-row;}

</style>
<center>

<div>
   
  <ul class = "container">
  <a class="active" href="/">Home</a>
  <a href="profile.php">Profile</a>
  <a href="friends.php">Friends</a>
  <a href="forums.php">Forums</a>
  <a href="quiz.php">Quiz</a>
  <a href="login.php" align="right">Sign in</a>
  
</center>

</ul>
<br class = "container">

</div>
-->

<div id = "topnav">
<?php include 'navbar.php';?>
</div>

<body>
<div align = "center">
<p>Add Friend:<br>
  <form form method = post>
  <input name="friend" size="7" type="text" />
  <input type="submit" name="submit" value="submit"/></p>
  </form><br>
<p>
  
  <br><br><br>

   <p><strong>Friend's List: </strong></p>
   <?php
    if(!empty($_POST['friend'])){
      $friends = publisher(array(
        'type' => 'addFriend',
        'username' => $_SESSION['username'],
        'friend' => $_POST['friend']
      ));
      foreach ($friends as $row){
        echo $row['friend'] . "<br>";
      }
    }else{
      $friends = publisher(array(
        'type' => 'getFriends',
        'username' => $_SESSION['username']
      ));
      
      foreach ($friends as $row){
        echo $row['friend'] . "<br>";
      }
    }
   ?>
</div> 
  


 </body>
 </html>