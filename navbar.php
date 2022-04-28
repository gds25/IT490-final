<html>
<body>

<style>

.container {display: table-row;}

</style>
<center>

<div>
   
  <ul class = "container">
  <a class="active" href="/">Home</a>
  <a href="profile.php">Profile</a>
  <a href="forums.php">Forums</a>
  <a href="quiz.php">Quiz</a>
  <a href="login.php" align="right">Sign in</a>
  
</center>

</ul>

<br class = "container">
<center>

<body>
  
 <form action="search.php" method="post">
   <input id="animesearch" name="animesearch" type="text" style="Width: 200px;" align="center"/>
   <input type="submit" value="Search Anime">
</center>  

<center>

  <ul>
   <label for="filter">Filter by:</label>
   <select name="filter[]" id="filter">
    <option value="ascending">Title Ascending</option>
    <option value="descending">Title Descending</option>
    <option value="rating">Show Rating</option>
    <option value="genre">Show Genre</option>
   </select>
   </center>
</ul>
 </form>

</body>
</br>
</div>

</html>
</body>


