<?php
error_reporting(0); // Disable all errors.
error_reporting(E_ALL ^ E_DEPRECATED);
require_once('validation_function.php');  //shouldnt need to call this in this file butttt......

                                                                          //CUSTOMER


function find_all_customers(){

	global $db;
	
	$sql ="SELECT * FROM customer ";
	$sql .="ORDER BY cust_ID ASC";
	
	$result = mysqli_query($db, $sql);
	//confirm_result_set($result);
	return $result;
}



function find_customer_by_id($cust_ID){
	global $db;

$sql = "SELECT * FROM customer ";
$sql .= "WHERE cust_ID='" . $cust_ID . "'";
//echo $sql; 
$result = mysqli_query($db,$sql);
$customer = mysqli_fetch_assoc($result);
mysqli_free_result($result);
return $customer;
}


/*\
 /////////////// trying function below instead of this
  function validate_customer($customer, $options=[]) {

    $cust_password_required = $options['cust_password_required'] = true;
*/ 
    function validate_customer($customer, $options=[] ) {
        $errors = [];
   
    //$cust_password_required = $options['cust_password_required'] = true;

    if(is_blank($customer['cust_firstname'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($customer['cust_firstname'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($customer['cust_surname'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($customer['cust_surname'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($customer['DOB'])) {
        $errors[] = "please select date.";
    }



    if(is_blank($customer['user_name'])) {
      $errors[] = "username cannot be blank.";
    } elseif (!has_length($customer['user_name'], array('min' => 8, 'max' => 255))) {
      $errors[] = "username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($customer['user_name'], $customer['cust_ID'] = 0)) {
      $errors[] = "username not allowed. Try another.";
    }

   //if($cust_password_required) {
     if(is_blank($customer['cust_password'])) {
        $errors[] = "password cannot be blank.";
      } elseif (!has_length($customer['cust_password'], array('min' => 12))) {
        $errors[] = "password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $customer['cust_password'])) {
        $errors[] = "password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $customer['cust_password'])) {
        $errors[] = "password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $customer['cust_password'])) {
        $errors[] = "password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $customer['cust_password'])) {
        $errors[] = "password must contain at least 1 symbol";
      }
  /*if(is_blank($customer['confirm_cust_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($customer['cust_password'] !== $customer['confirm_cust_password']) {
        $errors[] = "Password and confirm password must match.";
      }
}*/


    if(is_blank($customer['cust_email'])) {
      $errors[] = "email cannot be blank.";
    } elseif (!has_length($customer['cust_email'], array('max' => 255))) {
      $errors[] = "email must be less than 255 characters.";
    } elseif (!has_valid_email_format($customer['cust_email'])) {
      $errors[] = "email not allowed. Try another.";
    }

    if(is_blank($customer['usertype'])) {
      $errors[] = "please select usertype.";
    }


    if(is_blank($customer['returning_cust'])) {
      $errors[] = "please select date.";
    }

    if(is_blank($customer['postcode'])) {
      $errors[] = "postcode cannot be blank.";
    } elseif (!has_length($customer['postcode'], array('min' => 4, 'max' => 255))) {
      $errors[] = "postcode must be atleast 4 characters.";
    } elseif (!has_unique_user_name($customer['postcode'], $customer['id'] = 0)) {
      $errors[] = "postcode not allowed. Try another.";
    }


    if(is_blank($customer['subscription'])) {
      $errors[] = "please select yes or no.";
    }

   return $errors;
  }

  function insert_customer($customer) {
    global $db;

   $hashed_password = password_hash($customer['cust_password'], PASSWORD_BCRYPT);


  // HELP!!!1                                 ///////////////////////////////////////////////////// i can't get this to work HELP!!!!!
 /* $errors = validate_customer($customer);
    if(!empty($errors)) {
      return $errors;
    }
*/
    $hashed_password = $customer['cust_password'];


$sql = "INSERT INTO customer ";
$sql .="(cust_firstname, cust_surname, DOB, user_name, cust_password, cust_email, usertype, returning_cust, postcode, subscription, cust_active) ";
$sql .="VALUES (";
$sql .="'" . $customer['cust_firstname'] . "',";
$sql .="'" . $customer['cust_surname'] . "',";
$sql .="'" . $customer['DOB'] . "',";
$sql .="'" . $customer['user_name'] . "',";
$sql .="'" . $customer['cust_password'] . "',";
$sql .="'" . $customer['cust_email'] . "',";
$sql .="'" . $customer['usertype'] . "',";
$sql .="'" . $customer['returning_cust'] . "',";
$sql .="'" . $customer['postcode'] . "',";
$sql .="'" . $customer['subscription'] . "',";
//$sql .="'" . $customer['cust_ID'] . "',";    
$sql .="'" . $customer['cust_active'] . "'";
$sql .=")";
echo $sql;
$result = mysqli_query($db,$sql);

if($result){
	return true;
}else{
	echo mysqli_error($db);
	db_disconnect($db);
	exit;
 }
}




  function update_customer($customer) {
    global $db;

/*
        $password_sent = !is_blank($cust_ID['cust_password']);

    $errors = validate_customer($customer, ['cust_password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }*/

    $hashed_password = password_hash($customer['cust_password'], PASSWORD_BCRYPT);

$sql = "UPDATE customer SET ";
$sql .= "cust_password='" . $customer['cust_password'] . "',";
$sql .= "cust_email='" . $customer['cust_email'] . "',";
$sql .= "postcode='" . $customer['postcode'] . "',";
$sql .= "subscription='" . $customer['subscription'] . "'";
$sql .= "WHERE cust_ID='" . $customer['cust_ID'] . "' ";
$sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

    function delete_customer($cust_ID) {
    global $db;

    $sql = "DELETE FROM customer ";
    $sql .= "WHERE cust_ID='" . $cust_ID . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed                        /// woohoo delete works!!
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }



  /////////// Subscribers

  // function to echo all email subcribers (as a subset of the Customers table.
  function find_all_subscribers() {

  global $db;
  
  // SQL query
  $sql ="SELECT * FROM customer WHERE subscription='yes'";
  $sql .="ORDER BY cust_ID ASC";
  
  $result = mysqli_query($db, $sql);
  //confirm_result_set($result);
  return $result;
}


  // function to display a specific email subscriber from a list.
  function find_subscriber_by_id($cust_ID){
    global $db;
    
    // SQL query
  $sql = "SELECT * FROM customer ";
  $sql .= "WHERE cust_ID='" . $cust_ID . "' AND subscription='yes'";
  //echo $sql; 
  $result = mysqli_query($db,$sql);
  $customer = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $customer;
  }

  
  
  

                                                       ///////////// validate customer is not working, need to fix to move forward
 
 
  
                                                                            //GAME
																		  
																		  

function find_all_games(){  // checking

	global $db;
	
	$sql ="SELECT * FROM game ";
	$sql .="ORDER BY game_ID DESC";
	//echo $sql;
	$result = mysqli_query($db, $sql);
	//confirm_result_set($result);
	return $result;
}

    function find_game_by_id($id) {
    global $db;

    $sql = "SELECT * FROM game ";
    $sql .= "WHERE game_ID='" . $id . "'"; 
	//echo $sql;
    $result = mysqli_query($db, $sql);
    //confirm_result_set($result);
    $game = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $game; // returns an assoc. array
  }


   function update_game($game) {
    global $db;
  
  $errors = validate_game($game);
    if(!empty($errors)) {
    return $errors;
    }
$file_name  = basename($game['media']);
    $sql = "UPDATE game SET ";
    $sql .= "game='" . $game['game'] . "', ";
    $sql .= "category='" . $game['category'] . "', ";
    $sql .= "media='" . $file_name   . "',";
    $sql .= "version='" . $game['version'] . "', ";
  $sql .= "game_update='" . $game['game_update'] . "', ";
  $sql .= "bugfix='" . $game['bugfix'] . "', ";
  $sql .= "rating='" . $game['rating'] . "', ";
  $sql .= "filesize='" . $game['filesize'] . "', ";
  $sql .= "developed_date='" . $game['developed_date'] . "', ";
  $sql .= "admin_comment='" . $game['admin_comment'] . "', ";
  $sql .= "customer_comment='" . $game['customer_comment'] . "', ";
  $sql .= "credit='" . $game['credit'] . "', ";
  $sql .= "approved='" . $game['approved'] . "' ";
    $sql .= "WHERE game_ID='" . $game['game_ID'] . "' ";
    $sql .= "LIMIT 1";
  //echo $sql;
    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

     function validate_game($game) {
    $errors = [];
    
    //admin
    if(is_blank($game['admin_ID'])) {
        $errors[] = "Admin ID cannot be blank.";
    }
    //game
    if(is_blank($game['game'])) {
        $errors[] = "Name cannot be blank.";
      } elseif(!has_length($game['game'], ['min' => 0, 'max' => 20])) {
        $errors[] = "Name must be between 1 and 20 characters.";
      }
    //category
    if(is_blank($game['category'])) {
        $errors[] = "please select category.";
    }
    //version
    $max = 100.00;
    if(is_blank($game['version'])) {
        $errors[] = "please select version.";
    } elseif(!has_length_less_than($game['version'], $max)) {
    $errors[] = "Version must be less than 100.00";
    }
    //game-update
    if(is_blank($game['game_update'])) {
        $errors[] = "please select update.";
    }
    //bugfix
    $bugfix_str = (string) $game['bugfix'];
    if(is_blank($game['bugfix'])) {
        $errors[] = "please select bugfix.";
    } elseif(!has_inclusion_of($bugfix_str, ["0","1"])) {
    $errors[] = "Bugfix must be true or false.";
    }
    //rating
    $rating_str = (string) $game['rating'];
    if(is_blank($game['rating'])) {
        $errors[] = "please select rating.";
      } elseif(!has_inclusion_of($rating_str, ["1","2","3","4","5"])) {
    $errors[] = "Rating must be between 1 and 5.";
    }
      //filesize
    if(is_blank($game['filesize'])) {
        $errors[] = "please select filesize.";
    } elseif(!has_length($game['filesize'], ['min' => 2, 'max' => 10])) {
        $errors[] = "Filesize must be between 3 and 10 characters.";
      }
      //developed_date
    if(is_blank($game['developed_date'])) {
        $errors[] = "please select developed_date.";
      }
      //admin comment
    if(is_blank($game['admin_comment'])) {
        $errors[] = "please select admin_comment.";
      } elseif(!has_length($game['admin_comment'], ['min' => 0, 'max' => 200])) {
        $errors[] = "Admin Comment must be between 1 and 200 characters.";
      }
      //customer_comment
    if(is_blank($game['customer_comment'])) {
        $errors[] = "please select customer_comment.";
      } elseif(!has_length($game['customer_comment'], ['min' => 0, 'max' => 200])) {
        $errors[] = "Customer Comment must be between 1 and 200 characters.";
      }
      //credit
    if(is_blank($game['credit'])) {
        $errors[] = "please select credit.";
      } elseif(!has_length($game['credit'], ['min' => 0, 'max' => 250])) {
        $errors[] = "Credit must be between 1 and 250 characters.";
      }
      //approved
    $approved_str = (string) $game['approved'];
    if(is_blank($game['approved'])) {
        $errors[] = "please select approved.";
      } elseif(!has_inclusion_of($approved_str, ["0","1"])) {
    $errors[] = "Approved must be true or false.";
    }
      //media
    $maxsize  = 1048576;
    $acceptable = array(
          'image/jpeg',
      'image/jpg',
      'image/png',
      'application/psd',
//      'application/mkv',
      'application/blend'
    );
    
    if(($_FILES['media']['size'] >= $maxsize) /*|| ($_FILES["media"]["size"] == 0)*/) {
    $errors[] = 'File too large. Must be less than 10MB.';
    }/* elseif(!in_array($_FILES['media']['type'] = $acceptable)) && (!empty($_FILES["media"]["type"])) {
    $errors[] = 'Invalid file type. Only JPG, PNG, PSD, MKV and BLEND types are accepted.';
    }*/
    return $errors;
  }



  
  
  
                                                                              //ADMIN
																			  
	  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM admin ";
    $sql .= "ORDER BY admin_name ASC";
   
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }																		  
  
  

?>