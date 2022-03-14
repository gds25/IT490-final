<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($query)
{

  echo $query . PHP_EOL;

  $mysql = new mysqli('localhost', 'dran', 'pharmacy', 'animeDatabase');

    if ($mysql -> connect_errno){
        return "Could not connect to mysql: ". $mysql->connect_error;
        exit();
    }

    /*
    $stmt = $mysql->prepare($query);

    if($stmt->execute()){
      return "Okay";
    }
    if(!$stmt->execute()){
      return $stmt->error;
    }
    */
    
    $result = $mysql->query($query);
    return $result->num_rows;
    

}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "SQL Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

