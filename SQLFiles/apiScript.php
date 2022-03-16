<?php
//deal with API Call


//basic get top anime query
//$data_json = file_get_contents('https://api.jikan.moe/v4/top/anime');


//sample for search query
//$data_json = file_get_contents('https://api.jikan.moe/v4/anime?q=dragon%20ball&order_by=title&sort=asc&limit=12');

$arr = json_decode($data_json, true);

//Set up SQL Server info
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "anime-db";
$tablename = "anime";

//start sql stuff


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$stmt = $conn->prepare("INSERT INTO anime (mal_id, title, img, rating, genre, trailer, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?)");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  //error message for logger
}

foreach ($arr['data'] as $anime)
        {
			// set up each anime's array variables
			$mal_id = $anime['mal_id'];
			$img = $anime['images']['jpg']['image_url'];
			$title = $anime['title']; 
			$trailer = $anime['trailer']['url'];
			$rating = $anime['rating'];
			$synopsis = $anime['synopsis'];
			
			$genreTemp = array();
			//populate genres
			foreach ($anime['genres'] as $genres){
				array_push($genreTemp, $genres['name']);
			}
			$genre = json_encode($genreTemp);
			
			//prints the data in a pretty format
			print_r('mal_id: ' . $mal_id . '<br />');
			print_r('img: ' . $img . '<br />');
			print_r('title: ' . $title . '<br />');
			print_r('trailer: ' . $trailer . '<br />');
			print_r('rating: ' . $rating . '<br />');
			print_r('genres: ' . $genre . '<br />');
			
			print_r('<br />');
			
			
			//throw the values into an array(not sure if we actually need this)
			
			$anime_array = array(
				"mal_id" => $mal_id,
				"img" => $img, 
				"title" => $title,
				"trailer" => $trailer,
				"rating" => $rating,
				"genre" => $genre
			);
			//print_r($anime_array);
			
			
			$chkstmt = $conn->query('SELECT mal_id FROM anime WHERE mal_id = ' . $mal_id);

			if($chkstmt->num_rows == 0){
				// row not found, do stuff...
				$stmt->bind_param('sssssssi' ,$mal_id, $title, $img, $rating, $genre, $trailer, $synopsis, 0);
				$stmt->execute();
				
			} else {
				// do other stuff...
				print_r("already in db <br />");
			}
			
        }


$conn->close();

 

 
?>
