<?php

require("session.php");

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
<p align = "center";>Add Friend:<br>
  <input id="friend_user" size="7" type="text" /><br>
  <form>
   <p align = "center";><input type="submit" name="submit" value="submit"/></p>
</form>
  
  <br><br><br>

   <p><strong>Friend's List: </strong></p>
   
  


 </body>
 </html>