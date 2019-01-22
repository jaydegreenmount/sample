<?php 

// IMPORTANT .... line 23 needs a redirect page once user logs in


require_once("../../../private/initialize.php");

if($session->is_logged_in()) {
 redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $user_name = trim($_POST['user_name']);
  $cust_password = trim($_POST['cust_password']);

  
  // Check database to see if username/password exist.
	$found_user = Customer::authenticate($user_name, $cust_password);


  if ($found_user) {
	  
		$session->login($found_user);
			//log_action('Login', "{$found_user->user_name} logged in.");
			//TODO: FIX LOG_ACTIONS
		redirect_to("../../admin_index.php");	   // ??????? where do we want to send customer after log in??????????	
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $user_name = "";
  $cust_password = "";
}

?>

<html>
	<head>
		<title>Customer Login</title>
		<link href="../../stylesheets/global.css" media="all" rel="stylesheet" type="text/cdd" />
	</head>
	<body>
		<div id="header">
			<h1>Please login</h1>
		</div>
	<div id="main">
			<h2>Customer Login</h1>

			
			
	<form action="login.php" method="post">
		<table>
			<tr>
				<td>Username:</td>
				<td>
					<input type="text" name="user_name" maxlength="30" value="<?php echo h($user_name);?>"/>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td>
					<input type="text" name="cust_password" maxlength="30" value="<?php echo h($cust_password);?>"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" value="Login"/>
				</td>
			</tr>
		</table>
	</form>

	</div>
	</body>
</html>
