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
  <a href="signin.php" align="right">Sign in</a>
</div>

<?php $search = $_POST['animesearch'];?>

<script>
    	let input = '<?php echo $search ?>';
        let searchAnime = "https://api.jikan.moe/v3/search/anime?q=${"+input+"}&order_by=title&sort=asc&limit=10";
        fetch(searchAnime).then(response => {
     if (!response.ok) {
       throw new Error(`HTTP error: ${response.status}`);
     }       
       return response.json();
     }).then(data => {
       let animeSearch = document.getElementById("search");
       console.log(data);
       
       let  searchResults = document.createElement("div");
       searchResults.innerText = "Showing results for '" + input + "'";
       animeSearch.appendChild(searchResults);
       
       for (let i = 0; i < data.results.length; i++) {                 
           let div = document.createElement("div");
	   let animeLink = document.createElement('a');

           animeLink.setAttribute('href', '/profile.php');    
           animeLink.key = data.results[i].mal_id;
           animeLink.innerText = data.results[i].title;        
           div.appendChild(animeLink);
           animeSearch.appendChild(div);
       }   
       console.log(data);
     }).catch(err => {
       // Do something for an error here
       console.log('error: ' + err);
     });  
</script>
<br><br><br>
 <form action="search.php" method="post">
   <input id="animesearch" name="animesearch" type="text" align="right"/>
   <input type="submit" value="Search Again"/>
  
   <label for="filter">Filter by:</label>
   <select name="orderby" id="filter">
    <option value="title">Title</option>
    <option value="genre">Genre</option>
    <option value="rating">Rating</option> 
   </select>
 
</form>

  <div id ="search">
  </div>
</div>
</body>
</html>
