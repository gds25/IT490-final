<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


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

}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "SQL Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();

?>

