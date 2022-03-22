<?php

require("session.php");

include('SQLFiles/SQLPublish.php');

echo $_POST['thread_title'];
echo $_POST['post_content'];



    //check for required items from form
    if (isset($_POST['add']) && isset($_POST['thread_title']) && isset($_POST['post_content']))
    { 
         $threads = publisher(array(
               'type' => 'addThread',
	       'thread_id' => '',
	       'thread_title' => $_POST['thread_title'],
               'post_content'=> $_POST['post_content'],
               'username' => $_SESSION['username']
	 ));
    }
    if (!isset($_POST['thread_title']) || !isset($_POST['post_content'])) {   
	    $threads = publisher(array(
              'type' => 'showThreads'
	    ));      
    }
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


<form action="forums.php" method="post">
   <p><strong>Create New Thread</strong></p>
  <p>Topic Title:<br>
  <input type="text" name="thread_title">
   <textarea name="post_content" rows=8 cols=40 wrap=virtual></textarea>
   <input name="add" value="addpost" type="hidden"/>

   <p><input type="submit" name="submit" value="submit"/></p>
</form>

<?php echo $threads; ?>

</div>
 </body>
 </html>

