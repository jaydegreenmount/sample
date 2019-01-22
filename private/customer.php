<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.

class Customer extends DatabaseObject {
	
	protected static $table_name="admin";
	protected static $db_fields = array('cust_firstname', 'cust_surname', 'DOB', 'user_name', 'cust_password', 'cust_email', 'user_type', 'returning_cust', 'postcode', 'subscription', 'cust_active');
	
	public $cust_firstname;
	public $cust_surname;
	public $DOB;
	public $user_name;
	public $cust_password;
	public $cust_email;
	public $user_type;
	public $returning_cust;
	public $postcode;
	public $subscription;
	public $cust_active;
	//$sql .="() ";

	
  public function full_name() {
    if(isset($this->cust_firstname) && isset($this->cust_surname)) 
      return $this->cust_firstname . " " . $this->cust_surname;
    } /*else {
      return "";
    }*/
	

	public static function authenticate($user_name="", $cust_password="") {
    global $db;
   // $user_name = $db->escape_value($user_name);
    //$cust_password = $db->escape_value($cust_password);
//	$hashed_password = password_hash($admin_password,PASSWORD_BCRYPT,['hhh'=>10]);
    $sql  = "SELECT * FROM customer ";
    $sql .= "WHERE user_name = '{$user_name}' ";
    $sql .= "AND cust_password = '{$cust_password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}}
?>