<?php 

include_once 'config/config.php';

//Off the error on production
if( $SHOW_ERROR ) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

//Start the session
session_start ();

//Initialize the result object.
$result = array();

if (!isset ( $_GET ['url'] )) {
	$result["status"] = "fail";
	$result["message"] = "Invalid request.";
	goto AT_THE_END;
}

//Get the url parameters.
$url = $_GET ['url'];

$urlData = explode ( "/", $url );

if( count($urlData) < 2 ) {
	$result["status"] = "fail";
	$result["message"] = "Invalid request.";
	goto AT_THE_END;
}

$entity = array_shift($urlData);
$entityFile = "entity/$entity.php";
if (!is_file ( $entityFile )) {
	$result["status"] = "fail";
	$result["message"] = "Invalid service.";
	goto AT_THE_END;	
}

require_once $entityFile;
$method = array_shift($urlData);

if( !function_exists($method)  ) {
	$result["status"] = "fail";
	$result["message"] = "Invallid function reference.";
	goto AT_THE_END;
}

$result = $method($urlData);

AT_THE_END:
echo json_encode($result);

?>