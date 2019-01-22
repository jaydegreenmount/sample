<?php
error_reporting(E_ALL ^ E_DEPRECATED);
require_once('db_credentials.php');

function db_connect(){
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	return $connection;
if(!$connection)

die('Could not connect: ' . mysql_error());
}


function db_disconnect(){
	if(isset($connection)){
		mysqli_close($connection);
	}
}

function confirm_db_connect(){
	if(mysqli_connect_errno()){
		$msg = "Database connection failed;";
		$msg .=mysqli_connect_error();
		$msg .="(".mysqli_connect_errno().")";
		exit($msg);
	}
}

function confirm_result_set($customer_set){
	if(!$customer_set){
		exit("database query failed");
	}
}
?>