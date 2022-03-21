<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require('DMZPublish.php');

//SQL Connection Parameters
$hostSQL = 'localhost';
$userSQL = 'dran';
$passSQL = 'pharmacy';
$dbSQL = 'animeDatabase';

function changeAnimeRating($array){
  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
  $stmt = $mysql->prepare("UPDATE anime SET userRatings = "  . $array['value'] . " WHERE mal_id = " . $array['mal_id'] . ";");
  $stmt->execute();
  $mysql->close();
  return 1;
}

function searchAnime($array){
  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }
  $query = "SELECT * FROM anime WHERE title LIKE '%" . $array['title'] . "%' LIMIT 50;";
  $result = $mysql->query($query);
  $mysql->close();
  $anime = array();
  foreach ($result as $row){
    echo "Found: " . PHP_EOL;
    print_r($row);
    array_push($anime, $row);
  }
  return $anime;
}

//Fetching anime for template.php
function fetchAnime($array){
  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  //Establishing connection
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }
  //Select anime by mal_id
  $query = "SELECT * FROM anime WHERE mal_id = " . $array['mal_id']. ";";
  $result = $mysql->query($query);
  $anime = $result->fetch_row();
  $mysql->close();
  return $anime;
}

//For SQL to ask for anime from API
function insertAnime($array){
  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  //Establish Connection
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }
  //Preparing statement and binding the parameters
  $stmt = $mysql->prepare("INSERT INTO anime (mal_id, title, img, rating, genre, trailer, synopsis) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('sssssss' ,$array['mal_id'], $array['title'], $array['img'], $array['rating'], $array['genre'], $array['trailer'], $array['synopsis']);
  //Returns 1 if the anime is put into databse. Otherwise, return error
  if($stmt->execute()){
    $mysql->close();
    return 1;
  }else{
    $error = $stmt->error;
    $mysql->close();
    return $error;
  }
}

//For Logging in to website by queuering User Table
function sqlLogIn($array){
  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  //Establishing connection
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
  if ($mysql -> connect_errno){
      return "Could not connect to mysql: ". $mysql->connect_error;
      exit();
  }
  //Select Query
  $query = "SELECT username, password FROM Users WHERE username = '" . $array['username'] . "';";
  //Executing Query
  $result = $mysql->query($query);
  //Retrieving Row
  $logInInfo = $result->fetch_row();
  $mysql->close();
  return $logInInfo;
}

//For signing up from website and putting credentials into Database
function sqlSignUp($array){

  global $hostSQL, $userSQL, $passSQL, $dbSQL;
  //Establishing connection
  $mysql = new mysqli($hostSQL, $userSQL, $passSQL, $dbSQL);
    if ($mysql -> connect_errno){
        return "Could not connect to mysql: ". $mysql->connect_error;
        exit();
    }
  //Preparing statement and binding parameters
  $stmt = $mysql->prepare("INSERT INTO Users (username, password, firstName, lastName, email) VALUES (?,?,?,?,?)");
  $stmt->bind_param('sssss', $array['username'], $array['password'], $array['firstName'], $array['lastName'], $array['email']);
  //If executed correctly, return 1. Else, return the statement error
  if($stmt->execute()){
    $mysql->close();
    return 1;
  }else{
    $error = $stmt->error;
    $mysql->close();
    return $error;
  }

}

//Processes request from RabbitMQ Publisher
function requestProcessor($array){
  
  if($array['type'] == 'changeRating'){
    echo "Changing rating for " . $array['mal_id'];
    print_r($array);
    return changeAnimeRating($array);
  }

  if($array['type'] == 'searchAnime'){
    echo "Searching for: " . PHP_EOL;
    print_r($array);
    DMZPublish('https://api.jikan.moe/v4/anime?q=' . urlencode($array['title']));
    $anime = searchAnime($array);
    if(!$anime){
      return  "No anime found";
    }else{
      return $anime;
    }
  }

  //Fetching anime for Template.php
  if($array['type'] == 'fetchAnime'){
    echo "Fetching: " . PHP_EOL;
    print_r($array);
    return fetchAnime($array);
  }

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
}

//Establishing rabbitMQ Server
$server = new rabbitMQServer("SQLServer.ini","SQLServer");

echo "SQL Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();

?>

