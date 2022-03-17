<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('SQLPublish.php');

function DMZPublish($title){

  $animeNew = array();
  
  $client = new rabbitMQClient("DMZServer.ini","DMZServer");
  $response = $client->send_request($title);

  print_r($response);
  $response['type'] = 'apiRequest';
  publisher($response);
}

DMZPublish("assassination classroom");
