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
  
include('SQLFiles/SQLPublish.php');

if(isset($_POST['upvote'])) {
  unset($_POST['upvote']);
  changeRating(1);
}else if(isset($_POST['downvote'])) {
  unset($_POST['downvote']);
  changeRating(-1);
}


if(isset($_GET['mal_id'])){
  $anime = publisher(array(
    'type' =>  'fetchAnime',
    'mal_id' => $_GET['mal_id']
  ));

  print_r($anime);
  $mal_id = $anime[1];
  $img = $anime[3];
  $title = $anime[2]; 
  $trailer = $anime[6];
  $rating = $anime[4];
  $synopsis = $anime[7];
  $userRatings = $anime[8];
  $crunchyRollTitle = $anime[2];
  
  $crunchyRollTitle = str_replace(':',"", $crunchyRollTitle);
  $crunchyRollTitle = str_replace(' ',"-", $crunchyRollTitle);
  echo "<pre>" . $crunchyRollTitle . "</pre>"; 
  $crunchyRollLink = "https://www.crunchyroll.com/" . $crunchyRollTitle;
  echo "<pre>" . $crunchyRollLink . "</pre>"; 
  
}

function changeRating($value) {
  global $mal_id, $userRatings;
  $userRatings += $value;
  publisher(array(
    'type' => 'changeRating',
    'value' => $userRatings,
    'mal_id' => $mal_id
  ));
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
    <p><b>Synopsis</b>: <?php echo $synopsis ?>...</p>
    <p><b>Rating</b>: <?php echo $rating ?></p>
    <p><b>Watch the trailer: <a href=<?php echo $trailer ?> target="_blank" rel="noopener noreferrer">Here</a></b> </p>
    <p><b>Watch on Crunchyroll: <a href=<?php echo $crunchyRollLink ?> target="_blank" rel="noopener noreferrer">Here</a></b> </p>
    


    
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