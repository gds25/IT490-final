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

session_start();

  if(isset($_SESSION ['username'])){
        echo "<p> Logged in as: " . $_SESSION['username']. "</p>";
        echo '<p><a href = "logout.php">Log Out </a></p>';
  }

if(isset($_GET['mal_id'])){
  if(isset($_POST['upvote'])) {
      if(!isset($_SESSION['username'])){
        echo "<script>alert('Please log in first!')</script>";
        header("Refresh: .1; url=template.php?mal_id=$_GET[mal_id]");
      }
      unset($_POST['upvote']);
      echo "up";
    echo $_POST['userRatings'];
      $anime = changeRating(1);
  }
  else if(isset($_POST['downvote'])) {
      if(!isset($_SESSION['username'])){
        echo "<script>alert('Please log in first!')</script>";
        header("Refresh: .1; url=template.php?mal_id=$_GET[mal_id]");
      }
      unset($_POST['downvote']);
      $anime = changeRating(-1);
  }
  else if (isset($_POST['add']) && isset($_POST['review_content']))
  {
      if(!isset($_SESSION['username'])){
            echo "<script>alert('Please log in first!')</script>";
      header("Refresh: .1; url=template.php?mal_id=$_GET[mal_id]");

      }
	    //add the review
      else{
      $anime= publisher(array(
      'type' => 'addReview',
      'mal_id' => $_POST['mal_id'],
      'review_content'=> $_POST['review_content'],
      'username' => $_SESSION['username']
      ));
      }
  }	    
  else {
      $anime = publisher(array(
      'type' =>  'fetchAnime',
      'mal_id' => $_GET['mal_id']
      ));
  } 
  //print_r($anime);
  
  $mal_id = $anime[1];
  $img = $anime[3];
  $title = $anime[2]; 
  $trailer = $anime[6];
  $rating = $anime[4];
  $synopsis = $anime[7];
  $userRatings = $anime[8];
  $reviews = $anime['reviews'];

  $crunchyRollTitle = $anime[2];

  $crunchyRollTitle = str_replace(':',"", $crunchyRollTitle);
  $crunchyRollTitle = str_replace(' ',"-", $crunchyRollTitle);
  echo "<pre>" . $crunchyRollTitle . "</pre>"; 
  $crunchyRollLink = "https://www.crunchyroll.com/" . $crunchyRollTitle;
  echo "<pre>" . $crunchyRollLink . "</pre>"; 

}  

function changeRating($value) {
  //global $mal_id;
	//global $userRatings;
  $ratings = $_POST['userRatings'] + $value;
  $anime = publisher(array(
    'type' => 'changeRating',
    'value' => $ratings,
    'mal_id' => $_POST['mal_id']
  ));
  return $anime;
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
    <p><b>Watch the trailer <a href=<?php echo $trailer ?> target="_blank" rel="noopener noreferrer">Here</a></b> </p>
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
        <input name="userRatings" value = "<?php echo $userRatings;?>" type="hidden"/>
        <input name="mal_id" value = "<?php echo $_GET['mal_id'];?>" type="hidden"/> 
   </form>

<p><?php echo $reviews; ?></p>
<form action="<?php echo "template.php?mal_id=$_GET[mal_id]"?>" method="post">
   <p><strong>Post Your Review</strong></p>

   <textarea name="review_content" rows=8 cols=40 wrap=virtual></textarea>

   <input name="add" value="addreview" type="hidden"/>
   <input name="mal_id" value = "<?php echo $_GET['mal_id'];?>" type="hidden"/>

   <P><input type="submit" name="submit" value="Post"/></p>
</div>

</div>

</body>
</html>
