<?php

require_once('../../../private/initialize.php');
//require_login();
//  commented out so we can agree about how to send customer tp edit own information                    if (!$session->is_logged_in()) { redirect_to("login.php"); }

if(!isset($_GET['id'])) {
  redirect_to(url_for('../pages/customer/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php
  
$customer = [];
$customer['cust_ID'] = $id;
$customer['cust_password'] = $_POST['cust_password'] ;
$customer['cust_email'] = $_POST['cust_email'] ;
$customer['postcode'] = $_POST['postcode'] ;
$customer['subscription'] = $_POST['subscription'] ;

  $result = update_customer($customer);
  if($result === true) {
    $_SESSION['message'] = 'The customer was updated successfully.';
    redirect_to(url_for('/pages/customer/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $customer = find_customer_by_id($id);

}

$customer_set = find_all_customers();
$customer_count = mysqli_num_rows($customer_set);
mysqli_free_result($customer_set);

?>


<html lang="en">
	<head>
<!--Page Title -->	
		<title>Game Studio - Admin Area</title>
<!-- Meta Tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="withh=device-withh, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" /> <!--Changed-->
	</head>
	
<!-- Body -->
	<body>
	
	<!-- Page Wrapper -->
			<div class="page-wrap">

			<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.html"><span class="icon fa-home"></span></a></li>
							<li><a href="gallery.html"><span class="icon fa-camera-retro"></span></a></li>
							<li><a href="generic.html" class="active"><span class="icon fa-file-text-o"></span></a></li>
						</ul>
					</nav>
			<!-- End Nav -->

				<!-- Main -->
					<section id="main">

						<!-- Header -->
							<header id="header">
								<div>Game Studio Website: ADMINISTRATION</div>
							</header>

						<!-- Section -->
							<section>
								<div class="inner">
									<header>
							

<div id="content">


	<div class="tabs" id="Table_2">			
		 <a href="../../admin_index.php"><button class="tablinks" id="defaultOpen">Go Back</button></a>
	</div>



<?php $page_title = 'Edit Customer'; ?>


<div id="content">
   
  <div class="customer edit">
    <h1>Edit Customer</h1>

    <div class="errors">
    <?php echo display_errors($errors); ?>
	</div>

    <form action="<?php echo url_for('/pages/customer/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
				<dt>Password</dt>
				

			<!--	<dd><input type="password" name="confirm_password" value="" /></dd>  keep incase above password input is a mess around  ----------------------->
				<dd><input type="text" name="cust_password" value="<?php echo h($customer['cust_password']);?>" /></dd> 
			</dl>
			
			<dl>
				<dt>Email</dt>
				<dd><input type="text" name="cust_email" value="<?php echo h($customer['cust_email']);?>" /></dd>
			</dl>

			
			<dl>
				<dt>Postcode</dt>
				<dd><input type="text" name="postcode" value="<?php echo h($customer['postcode']);?>" /></dd>
			</dl>
			
			<dl>
				<dt>Email Subscription</dt>
				<dd>
					<select name="subscription" >
						<option value="">--</option>
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				</dd>
				
				
			</dl>
			<div id="operations">
				<input type="submit" value="Edit Customer"/>
				</div>
			</form>
		</div>
	</div>
	
