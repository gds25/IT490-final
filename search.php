<?php 
require('session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset=UTF-8" />
	
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="page-wrap">
<div id="topnav">
  <a href="/">Home</a>
  <a href="profile.php">Profile</a>
  <a href="forums.php">Forums</a>
  <a href="quiz.php">Quiz</a>
  <a href="login.php" align="right">Sign in</a>
</div>

<br><br><br>
 <form action="search.php" method="post">
   <input id="animesearch" name="animesearch" type="text" align="right"/>
   <input type="submit" name = "submit" value="Search Again"/>
  
   <label for="filter">Filter by:</label>
   <select name="filter[]" id="filter">
   <option value="ascending">Title Ascending</option>
   <option value="descending">Title Descending</option>
   <option value="rating">Show Rating</option>
   <option value="genre">Show Genre</option>  
   </select> 
 </form>

<?php 
include('SQLFiles/SQLPublish.php');
$search = $_POST['animesearch']; 

echo "Showing results for: " . $search . "<br><br>";

foreach ($_POST['filter'] as $select)
{
       $filter=$select;
}

$anime = publisher(array('type' => 'searchAnime', 'title' => $search));

if($filter == 'ascending'){
  sort($anime);
  foreach ($anime as $row){
    echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
  }
}
if($filter == 'descending'){
  rsort($anime);
  foreach ($anime as $row){
    echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
  }
}
if($filter == 'genre'){
  foreach ($anime as $row){
    echo $row['genre'] . "<br>";
    echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
    echo "<br>";
  }
}
if($filter == 'rating'){
  foreach ($anime as $row){
    echo $row['rating'] . "<br>";
    echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
    echo "<br>";
  }
}
?>

  <div id ="search">
  </div>
</div>
</body>
</html>
