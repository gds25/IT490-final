<?php
  require("session.php");
?>

<!DOCTYPE html>
<html>
<head>

        <!-- code snippet taken from
        https://www.w3schools.com/html/html_responsive.asp
        used for responsive webpages
        used in MULTIPLE files (cited here) -->

        <meta name="viewport" content="width=device-width, initial-scale=1" />  
        
        <!-- end citation -->
        
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>




<div class = "center" id="topnav">
        <?php include 'navbar.php';?>
</div>


<h1 align="center">Anime Database</h1>

<aside>
        <nav>
        <h3>Top Anime :</h3>
	<div>
  <?php
  include('SQLFiles/SQLPublish.php');
  $anime = publisher(array('type' => 'fetchTopAnime'));
  foreach ($anime as $row){
    echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
  }
  ?>
	</div>
	</nav>
</aside>
</div>

</body>
</html>

