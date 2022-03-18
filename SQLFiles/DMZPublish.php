<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('SQLPublish.php');

//For Publishing from SQL to DMZ for Api Requests
function DMZPublish($title){

  //Creating empty array
  $animeNew = array();
  
  //creating client and sending requested anime
  $client = new rabbitMQClient("DMZServer.ini","DMZServer");
  $response = $client->send_request($title);

  //Printing out each individual animew
  echo "Sending to the database: " . PHP_EOL;
  foreach($response as $anime){
    echo "<br>";
    echo "<br>" . $anime['title'] . "</br>";
    print_r($anime);
    echo "</br>";
  }

  //Adding type flage to response
  $response['type'] = 'apiRequest';
  
  //Sending array back to SQL
  publisher($response);
}
?>
