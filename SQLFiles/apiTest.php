<?php
//Just to test for if SQL is populated by API request
include("SQLPublish.php");

print_r(publisher(array(
    'title' => 'naruto'
)));
?>