<?php

$request = new HttpRequest();
$request->setUrl('url=createThread.php');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders([
	'content-type' => 'application/x-www-form-urlencoded',
	'x-rapidapi-host' => 'Anilistmikilior1V1.p.rapidapi.com',
	'x-rapidapi-key' => 'b7cc2bd809msh30912c0d897635dp1ef909jsnd949b6cad880'
]);

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields([
	'title' => '<REQUIRED>',
	'accessToken' => '<REQUIRED>',
	'body' => '<REQUIRED>'
]);

try {
	$response = $request->send();

	echo $response->getBody();
} catch (HttpException $ex) {
	echo $ex;
}