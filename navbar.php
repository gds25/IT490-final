<html>
<body>

  <a class="active" href="/">Home</a>
  <a href="profile.php">Profile</a>
  <a href="forums.php">Forums</a>
  <a href="quiz.php">Quiz</a>
  <a href="login.php" align="right">Sign in</a>
 

  <br><br><br>


 <form action="search.php" method="post">
   <input id="animesearch" name="animesearch" type="text" style="Width:20%" align="right"/>
   <input type="submit" value="Search Anime">
    
   <label for="filter">Filter by:</label>
   <select name="filter[]" id="filter">
    <option value="ascending">Title Ascending</option>
    <option value="descending">Title Descending</option>
    <option value="rating">Show Rating</option>
    <option value="genre">Show Genre</option>
   </select>
 </form>

</html>
</body>

