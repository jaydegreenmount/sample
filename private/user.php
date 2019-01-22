<?php


class DataO{
	
	// we will change all self to static so it is User object not a DatabaseObject
  public static function find_all_customers() {
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
  }
  
 
 public static function find_by_id($cust_ID) {
	  global $database;
  $result_array = self::find_by_sql("SELECT * FROM customer WHERE cust_ID= " . $cust_ID . " LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }



class Customer {
	
	public static $table_name="customer";
	public static $db_fields = array('cust_firstname', 'cust_surname', 'DOB', 'user_name', 'cust_password', 'cust_email', 'usertype', 'returning_cust', 'postcode', 'subscription', 'cust_ID', 'cust_active');
	
	public $cust_firstname;
	public $cust_surname;
	public $DOB;
	public $user_name;
	public $cust_password;
	public $cust_email;
	public $usertype;
	public $returning_cust;
	public $postcode;
	public $subscription;
	public $cust_ID;
	public $cust_active;
	
	
  public function full_name() {
    if(isset($this->cust_firstname) && isset($this->cust_surname)) {
      return $this->cust_firstname . " " . $this->cust_surname;
    } else {
      return "";
    }
}}


?>