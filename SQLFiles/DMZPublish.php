<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//For Publishing from SQL to DMZ for Api Requests
function DMZPublish($link){
  
  //creating client and sending requested anime
  $client = new rabbitMQClient("DMZServer.ini","DMZServer");
  $response = $client->send_request($link);
  
  //Establish Connection
  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');
  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }

  //Sending array back
  foreach ($response as $array){
    print_r($array);
    //Preparing statement and binding the parameters
    $stmt = $mysql->prepare("INSERT INTO anime (mal_id, title, img, rating, genre, trailer, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss' ,$array['mal_id'], $array['title'], $array['img'], $array['rating'], $array['genre'], $array['trailer'], $array['synopsis']);
    //Returns 1 if the anime is put into databse. Otherwise, return error
    if($stmt->execute()){
      echo "Okay";
    }else{
      echo $stmt->error;
    }
  }
  $mysql->close();
}

//DMZPublish('https://api.jikan.moe/v4/anime?q=hunter+x+hunter&limit=20');
?>
