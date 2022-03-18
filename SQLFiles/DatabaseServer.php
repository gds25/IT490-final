<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//For SQL to ask for anime from API
function apiRequest($array){
  //Establish Connection
  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }

  //Preparing statement and binding the parameters
  $stmt = $mysql->prepare("INSERT INTO anime (mal_id, title, img, rating, genre, trailer, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('sssssss' ,$array['mal_id'], $array['title'], $array['img'], $array['rating'], $array['genre'], $array['trailer'], $array['synopsis']);
	
  //Returns 1 if the anime is put into databse. Otherwise, return error
  if($stmt->execute()){
    return 1;
  }else{
    return $stmt->error;
  }
}

//For Logging in to website by queuering User Table
function sqlLogIn($array){

  //Establishing connection
  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }

  //Select Query
  $query = "SELECT username, password FROM Users WHERE username = '" . $array['username'] . "';";
  
  //Executing Query
  $result = $mysql->query($query);

  //Retrieving Row
  return $result->fetch_row();
}

//For signing up from website and putting credentials into Database
function sqlSignUp($array){

  //Establishing connection
  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

    if ($mysql -> connect_errno){
        return "Could not connect to mysql: ". $mysql->connect_error;
        exit();
    }

  //Preparing statement and binding parameters
  $stmt = $mysql->prepare("INSERT INTO Users (username, password, firstName, lastName, email) VALUES (?,?,?,?,?)");
  $stmt->bind_param('sssss', $array['username'], $array['password'], $array['firstName'], $array['lastName'], $array['email']);

  //If executed correctly, return 1. Else, return the statement error
  if($stmt->execute()){
    return 1;
  }else{
    return $stmt->error;
  }

}

//Processes request from RabbitMQ Publisher
function requestProcessor($array)
{

  //For login
  if($array['type'] == 'login'){
      print_r($array);
      echo "Logging in" . PHP_EOL;
      return sqlLogIn($array);

  }

  //For signup
  if($array['type'] == 'signup'){
      print_r($array);
      echo "Signing up" . PHP_EOL;
      return sqlSignUp($array);
  }

  //For populating api
  if($array['type'] == 'apiRequest'){
    echo "New API Request" . PHP_EOL;
    foreach($array as $anime){
      if($anime != 'apiRequest' && $anime != ''){
        echo "Adding: " . PHP_EOL;
        print_r($anime);
        apiRequest($anime);
      }
    }
  }

}

//Establishing rabbitMQ Server
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "SQL Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();

?>

