<?php require_once('../../../private/initialize.php'); ?>
<?php	
    log_action('Customer', "{$session->cust_ID} logged out.");
	$session->logout();
	

    redirect_to("login.php");
?>
