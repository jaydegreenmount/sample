<?php
require_once('initialize.php');

include(SHARED_PATH.'/header.php');


error_reporting(E_ALL ^ E_DEPRECATED);
require_once("database.php");
require_once("user.php");
global $database;

/*if(isset($database)){echo "true";}
else{
	echo "false";
	}
echo "<br/>";
*/
//echo $database->mysqli_prep("It's me");

echo "<br/>";

$sql = "SELECT * FROM game ";
echo $sql;
$result_set = $database->query($sql);
$found_user = $database->fetch_array($result_set);
echo $found_user['user_name'];

echo "<br/>";

$found_user = User::find_by_id(1);

echo $found_user['user_name'];




/*
$user = User::find_by_id(1);
echo $user->full_name();


echo "<hr/>";

$user = User::find_all();
foreach($users as $user){
	echo "User :" .$user['user_name'] ."<br/>";
	echo "Name :" .$user['cust_firstname'] ." ".$user['cust_surname']."<br/><br/>";
}


$sql = "SELECT * FROM customer WHERE id=1";
$result_set = $database->query($sql);
$found_user = $database->fetch_array($result_set);
echo $found_user['user_name'];

/*

$record = User::find_by_id(1);
$user = new User();
$user->cust_firstname=$record['cust_firstname'];
$user->cust_surname=$record['cust_surname'];
$user->DOB=$record['DOB'];
$user->user_name=$record['user_name'];
$user->cust_password=$record['cust_password'];
$user->cust_email=$record['cust_email'];
$user->usertype=$record['usertype'];
$user->returning_cust=$record['returning_cust'];
$user->postcode=$record['postcode'];
$user->subscription=$record['subscription'];
$user->cust_ID=$record['cust_ID'];
$user->cust_active=$record['cust_active'];
echo $user->full_name();



///////////////////////
$user_set = User::find_all();
while($user = $database->fetch_array($user_set)){
	echo "User :" .$user['user_name'] ."<br/>";
	echo "Name :" .$user['cust_firstname'] ." ".$user['cust_surname']."<br/><br/>";
}
//////////////////////////////////
*/


?>