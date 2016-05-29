<?php

include_once 'helper/DBHelper.php';

function get($array) {
	$result = array();
	$result["status"] = "pass";
	$result["message"] = "Get method called";
	return $result;
}

function post($array) {
	$result = array();
	$result["status"] = "pass";
	$result["message"] = "POST method called";
	return $result;
}