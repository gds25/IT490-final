<?php
require("session.php");
include('SQLFiles/SQLPublish.php');


if (isset($_POST['add']) && isset($_POST['thread_id']) && isset($_POST['post_content']))
    {
	    //add the post
       $thread = publisher(array(
	       'type' => 'addPost',
                'thread_id' => $_POST['thread_id'],
		'post_content'=> $_POST['post_content'],
		'username' => $_SESSION['username']
       ));
    }	    
 else {
    $thread = publisher(array(
               'type' => 'showPosts',
                'thread_id' => $_GET['thread_id']
       ));
 } 	   
echo $_GET['thread_id'];
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

 <?php echo $thread; ?>
 

<form action="<?php echo "threads.php?thread_id=$_GET[thread_id]"?>" method="post">
   <p><strong>Post Your Reply</strong></p>
   
   <textarea name="post_content" rows=8 cols=40 wrap=virtual></textarea>

   <input name="add" value="addpost" type="hidden"/>
   <input name="thread_id" value = "<?php echo $_GET['thread_id'];?>" type="hidden"/>
   
   <P><input type="submit" name="submit" value="Reply"/></p>
</form>

</div>
 </body>
 </html>

