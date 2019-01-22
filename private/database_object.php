<?php

require_once('database.php');
// do i really need to call the file i'm in?? :S require_once('database_object2.php');

class DatabaseObject{
	
	// we will change all self to static so it is User object not a DatabaseObject
  public static function find_all_customers() {
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
  }
  
 
 public static function find_customer_by_id($cust_ID){
	global $db;

$sql = "SELECT * FROM customer ";
$sql .= "WHERE cust_ID='" . $cust_ID . "'";
//echo $sql; 
$result = mysqli_query($db,$sql);
$customer = mysqli_fetch_assoc($result);
mysqli_free_result($result);
return $customer;
}

 
  
  public static function find_by_sql($sql="") {
    global $db;
    $result_set = $db->query($sql);
    $object_array = array();
    while ($row = $result_set->fetch_assoc()) {
      $object_array[] = static::instantiate($row);
    }
    return $object_array;
  }
  private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new static;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = get_object_vars($this);
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}
}
?>