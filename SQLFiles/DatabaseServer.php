<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function apiRequest($array){
  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }

  $stmt = $mysql->prepare("INSERT INTO anime (mal_id, title, img, rating, genre, trailer, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('ssssbss' ,$array['mal_id'], $array['title'], $array['img'], $array['rating'], $array['genre'], $array['trailer'], $array['synopsis']);
			
  if($stmt->execute()){
    return 1;
  }
  if(!$stmt->execute){
    return $stmt->error;
  }
}


function sqlLogIn($array){

  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }

  $query = "SELECT username, password FROM Users WHERE username = '" . $array['username'] . "' and password = '" . $array['password'] . "';";
  
  $result = $mysql->query($query);
  
  return $result->num_rows;

}


function sqlSignUp($array){

  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

    if ($mysql -> connect_errno){
        return "Could not connect to mysql: ". $mysql->connect_error;
        exit();
    }

  $stmt = $mysql->prepare("INSERT INTO Users (username, password, firstName, lastName, email) VALUES (?,?,?,?,?)");
  $stmt->bind_param('sssss', $array['username'], $array['password'], $array['firstName'], $array['lastName'], $array['email']);

  if($stmt->execute()){
    return 1;
  }
  if(!$stmt->execute()){
    return $stmt->error;
  }

}

function requestProcessor($array)
{

  if($array['type'] == 'login'){
      print_r($array);
      echo "Logging in" . PHP_EOL;
      return sqlLogIn($array);

  }

  if($array['type'] == 'signup'){
      print_r($array);
      echo "Signing up" . PHP_EOL;
      return sqlSignUp($array);
  }

  if($array['type'] == 'apiRequest'){
    foreach($array as $anime){
      if($anime != 'apiRequest' && $anime != ''){
        print_r($anime);
        echo apiRequest($anime);
      }
    }
  }

}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "SQL Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();

?>

