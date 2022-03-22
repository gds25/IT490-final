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
    <option value="title">Title</option>
    <option value="genre">Genre</option>
    <option value="rating">Rating</option> 
   </select>
 
</form>

<?php 
include('SQLFiles/SQLPublish.php');
$search = $_POST['animesearch']; 

echo "Showing results for: " . $search . "<br>";

foreach ($_POST['filter'] as $select)
{
       $filter=$select;
}



echo "Filter by: ";
echo $filter;
echo "<br><br>";
$anime = publisher(array('type' => 'searchAnime', 'title' => $search, 'filter' => $filter));
foreach ($anime as $row){
  /*
  foreach(json_decode($row['genre']) as $genre){
    echo $genre;
  }
  */
  echo "<a href=template.php?mal_id=" . $row['mal_id'] . ">" . $row['title'] . "</a><br>";
}
?>
  <div id ="search">
  </div>
</div>
</body>
</html>
