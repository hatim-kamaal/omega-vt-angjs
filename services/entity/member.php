<?php
include_once 'helper/Database.php';

function get($array) {
	
	$whereClause = "";
	if( isset($array[0]) ) {
		$email = $array[0];
		$whereClause = " WHERE member_email = '$email'";
	}
	
	$db = Database::getInst ();
	$rs = $db->getResultSet("SELECT member_id, member_name, member_email, member_code FROM member $whereClause");
	$record = array();
	$result = array();
	$result["status"] = "pass";
	$result["message"] = "Get method called";
	if( isset($rs) ) {
		while ( $row = mysqli_fetch_row ( $rs ) ) {
			$institute = $row [0];
			$course = $row [1];
			array_push($record , array("member_id" => $row[0], "member_name" => $row[1], "member_email" => $row[2], "member_code" => $row[3]));
		}
	} else {
		$result["status"] = "fail";
		$result["message"] = "Invalid credentials";
	}
	
	$result["data"] = $record;
	return $result;
}

function get_by_username($array) {
	
	$result = array();
	
	if( !isset($array[0]) ) {
		$result["status"] = "fail";
		$result["message"] = "No username";
		return $result;
	}
	
	$email = $array[0];
	
	$db = Database::getInst ();
	$rs = $db->getResultSet("SELECT member_id, member_name, member_email, member_code FROM member WHERE member_email = '$email'");
	$record = array();
	$result["status"] = "pass";
	$result["message"] = "Get method called";
	if( isset($rs) ) {
		while ( $row = mysqli_fetch_row ( $rs ) ) {
			$institute = $row [0];
			$course = $row [1];
			array_push($record , array("member_id" => $row[0], "member_name" => $row[1], "member_email" => $row[2], "member_code" => $row[3]));
		}
	} else {
		$result["status"] = "fail";
		$result["message"] = "Invalid credentials";
	}

	$result["data"] = $record;
	return $result;
}

function get_all_user($array) {
	$db = Database::getInst ();
	$rs = $db->getResultSet("SELECT member_id, member_name, member_email, member_code FROM member");
	$record = array();
	$result = array();
	$result["status"] = "pass";
	$result["message"] = "Get method called";
	if( isset($rs) ) {
		while ( $row = mysqli_fetch_row ( $rs ) ) {
			array_push($record , array("member_id" => $row[0], "member_name" => $row[1], "member_email" => $row[2], "member_code" => $row[3]));
		}
	} else {
		$result["status"] = "fail";
		$result["message"] = "Invalid credentials";
	}

	$result["data"] = $record;
	return $result;
}

function create_member($array) {
	$result = array();
	/* if( isset($array[0]) ) {
		$db = Database::getInst ();
		$id = $array[0];
		if( $db->update("DELETE FROM member WHERE member_id = $id") ) {
			$result["status"] = "pass";
			$result["message"] = "Deleted";
		} else {
			$result["status"] = "fail";
			$result["message"] = "Can't Deleted";
		}
	} else {
		$result["status"] = "fail";
		$result["message"] = "Incomplete information";
	} */
	
	//$data = $_POST["data"];
	
	var_dump ($_POST);
	
	
	$fname = $_POST["firstName"];
	$lname = $_POST["lastName"];
	$uname = $_POST["username"];
	$code = $_POST["password"];

	if( $db->update("INSERT INTO member (member_name, member_email, member_code) VALUES ('$fname', '$uname', '$code')") ) {
		$result["success"] = true;
	} else {
		$result["success"] = false;
		$result["message"] = "Something went wrong.";
	}
	
	return $result;
}

function delete_member($array) {
	$result = array();
	if( isset($array[0]) ) {
		$db = Database::getInst ();
		$id = $array[0];
		if( $db->update("DELETE FROM member WHERE member_id = $id") ) {
			$result["status"] = "pass";
			$result["message"] = "Deleted";
		} else {
			$result["status"] = "fail";
			$result["message"] = "Can't Deleted";				
		}
	} else {
		$result["status"] = "fail";
		$result["message"] = "Incomplete information";
	}
	
	return $result;
}

