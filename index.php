<?php
  require("session.php");
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
        <?php include 'navbar.php';?>
</div>


<h1 align="center">Anime Database</h1>

<script type = "text/javascript">
//let topAnime = "https://api.jikan.moe/v4/top/anime/";
    let topAnime = "https://api.jikan.moe/v3/top/anime/1/bypopularity";
    fetch(topAnime).then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error: ${response.status}`);
    }	    
      return response.json();
    }).then(data => {
      let animeList = document.getElementById("topanime");
      console.log(data.top);    
      for (let i = 0; i < 5; i++) {
          let div = document.createElement("div");
          let animeLink = document.createElement('a');
	        animeLink.setAttribute('href', 'template.php?id=' + data.top[i].mal_id);
	        animeLink.key = data.top[i].mal_id;
	        animeLink.innerText = data.top[i].title;	  
          div.appendChild(animeLink);
          animeList.appendChild(div);
      }   
      console.log(data);
    }).catch(err => {
      // Do something for an error here
      console.log('error: ' + err);
    });

	
</script>
 
<aside>
        <nav>
        <h3>Top Anime</h3>
	<div id = "topanime">
	</div>
	</nav>
</aside>
</div>

</body>
</html>
