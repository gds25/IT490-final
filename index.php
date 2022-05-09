<?php
  require("session.php");
?>

<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />   
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>




<div class = "center" id="topnav">
        <?php include 'navbar.php';?>
</div>


<h1 align="center">Anime Database</h1>

<div align = "center">
<aside align="center">
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
</div>
</body>
</html>

