<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Request processor for calling API
function requestProcessor($request)
{
  echo "Request equals: " .  $request . PHP_EOL;
  
  $animeResults = array();
  
  $data_json = file_get_contents($request);
  $arr = json_decode($data_json, true);


  if($arr){
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

      $anime_array = array(
        "mal_id" => $mal_id,
        "img" => $img, 
        "title" => $title,
        "trailer" => $trailer,
        "rating" => $rating,
        "genre" => $genre,
        "synopsis" => $synopsis,
      );

      array_push($animeResults, $anime_array);
    }

    echo "Retrieved from API: " . PHP_EOL;
    print_r($animeResults);
    return $animeResults;
  }else{
    return "Couldn't find anything";
  }
}

$server = new rabbitMQServer("DMZServer.ini","DMZServer");

echo "Receiving API Requests".PHP_EOL;
$server->process_requests('requestProcessor');
echo "DMZ END".PHP_EOL;
exit();
?>

