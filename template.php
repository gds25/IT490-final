<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
   /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
<?php
//how to post data for what we need
//https://stackoverflow.com/questions/426310/how-do-you-post-data-with-a-link

//temp for me
$id = $_GET['id'];

//Set up SQL Server info
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "anime-db";
$tablename = "anime";

//start sql stuff


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$stmt = $conn->prepare("SELECT * FROM anime WHERE mal_id = ?");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  //error message for logger
}

$stmt->bind_param("s", $id);
$stmt->execute();

$result = $stmt->get_result(); // get the mysqli result
$anime = $result->fetch_assoc(); // fetch data  - comes as array


$conn->close();

$mal_id = $anime['mal_id'];
$img = $anime['img'];
$title = $anime['title']; 
$trailer = $anime['trailer'];
$genres = $anime['genre'];
$rating = $anime['rating'];
$synopsis = $anime['synopsis'];
$userRatings = $anime['userRatings'];

$genres = substr($genres, 2, -2);
$genres = str_replace("\",\"", ", ", $genres);

 //updating user rating


if(isset($_POST['upvote'])) {
  unset($_POST['upvote']);
  changeRating(1);
}
else if(isset($_POST['downvote'])) {
  unset($_POST['downvote']);
  changeRating(-1);
}
function changeRating($value) {
  global $servername, $username, $password, $dbname, $userRatings, $id;
  $userRatings += $value;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  $stmt = $conn->prepare("UPDATE anime SET userRatings=$userRatings WHERE mal_id = $id");
  $stmt->execute();
  if (isset($_POST['upvote'])){
    echo '
    <script type="text/javascript">
    location.reload();
    </script>';
    }
  $conn->close();
}
?>
<html>
<head>
        <meta charset=UTF-8" />
        
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="page-wrap">

<div id="topnav">
        <?php include './navbar.php';?>
</div>

<h1 align="center">Anime Database</h1>

 

<div class="row">
  <div class="column">
  <img src=<?php echo $img ?> alt="anime image">  
  </div>
  <div class="column">
    <h2><?php echo $title ?></h2>
    <p><b>Synopsis</b>: <?php echo $synopsis ?></p>
    <p><b>Genres</b>: <?php print_r($genres) ?></p>
    <p><b>Rating</b>: <?php echo $rating ?></p>
    <p><b>Watch the trailer <a href=<?php echo $trailer ?> target="_blank" rel="noopener noreferrer">Here</a></b> </p>

    


    
  </div>
</div>
<br>
<div class="reviews">
  <h3>Community Rating: <?php echo $userRatings ?></h3>
    <h4>Did you watch this?</h4>
    <p>Leave a review for others</p>

    
    

    
    <form method="post">
        <input type="submit" name="upvote"
                value="Vote Up" />
          
        <input type="submit" name="downvote"
                value="Vote Down" />
    </form>
</div>


</div>

</div>

</body>
</html>