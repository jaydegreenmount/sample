<?php

require_once('../../../private/initialize.php');
// if (!$session->is_logged_in()) { redirect_to("login.php"); } 
//require_login();



if(is_post_request()) {

$customer = [];
$customer['cust_firstname'] = $_POST['cust_firstname'];
$customer['cust_surname'] = $_POST['cust_surname'] ;
$customer['DOB'] = $_POST['DOB'] ;
$customer['user_name'] = $_POST['user_name'] ;
$customer['cust_password'] = $_POST['cust_password'] ;
$customer['cust_email'] = $_POST['cust_email'] ;
$customer['usertype'] = $_POST['usertype'] ;
$customer['returning_cust'] = $_POST['returning_cust'] ;
$customer['postcode'] = $_POST['postcode'] ;
$customer['subscription'] = $_POST['subscription'] ;
$customer['cust_active'] = $_POST['cust_active'] ;


  $result = insert_customer($customer);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'This customer was created successfully.';
    redirect_to(url_for('/pages/customer/show.php?id=' . $new_id));
	} else {
    $errors = $result;
	}

} else {

  $customer = [];
  $customer['cust_firstname'] = '';
  $customer['cust_surname'] = '';
  $customer['DOB'] = '';
  $customer['user_name'] = '';
  $customer['cust_password'] = '';
  $customer['cust_email'] = '';
  $customer['usertype'] = '';
  $customer['returning_cust'] = '';
  $customer['postcode'] = '';
  $customer['subscription'] = '';
  $customer['cust_active'] = '';

}




$customer_set = find_all_customers();
$customer_count = mysqli_num_rows($customer_set) + 1;
mysqli_free_result($customer_set);

?>

<?php $page_title = 'Create Customer'; ?>



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
								
<!-- END admin-header.php HERE -->	







<div id="content">


	<div class="tabs" id="Table_2">			
		 <a href="../../admin_index.php"><button class="tablinks" id="defaultOpen">Go Back</button></a>
	</div>
 

  <div class="customer new">
    <h1>Create Customer</h1>

	<div class="errors">
    <?php echo display_errors($errors); ?>
	</div>


    <form action="<?php echo url_for('/pages/customer/new.php'); ?>" method="post"> 
      <dl>
        <dt>First Name</dt>
				<dd><input type="text" name="cust_firstname" placeholder="First name" value="" /></dd>
			</dl>

			<dl>
				<dt>Surname</dt>
				<dd><input type="text" name="cust_surname" placeholder="Surname" value="" /></dd>
			</dl>
			
			<dl>
				<dt>Date of Birth</dt>
				<dd><input type="date" name="DOB" value="" /></dd>
			</dl>
			
			<dl>
				<dt>User Name</dt>
				<dd><input type="text" name="user_name" placeholder="Username" value="" /></dd>
			</dl>
			
			<dl>
				<dt>Password</dt>
				<!--	<dd><input type="password" name="cust_password" value="" /></dd>keep incase above password input is a mess around  ---------------->
			<dd><input type="password" name="cust_password" placeholder="Password" value="" /></dd>   
			</dl>
			
			<dl>
				<dt>Email</dt>
			    <dd><input type="text" name="cust_email" placeholder="Email" value="" /></dd>
			</dl>
			<dl>
				<dt>User Type</dt>
				<dd>
				  <select name="usertype">
					<option value="">--</option>
					<option value="Student">Student</option>
					<option value="Parent">Parent</option>
					<option value="Other">Other</option>
				  </select>
				</dd>
			</dl>
			<dl>
				<dt>Returning Customer</dt>
				<dd>
				  <select name="returning_cust">
					<option value="">--</option>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				  </select>
				</dd>
			</dl>
			<dl>
				<dt>Postcode</dt>
				<dd><input type="text" name="postcode" placeholder="Postcode" value="" /></dd>
			</dl>
			
			<dl>
				<dt>Subscription</dt>
				<dd>
				  <select name="subscription">
					<option value="">--</option>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				  </select>
				</dd>
			</dl>
			<dl>
				<dt>cust_active</dt>
				<dd>
				  <select name="cust_active">
				    <option value="">--</option>
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				  </select>
			     </dd>
			</dl>
			<div id="operations">
				<input type="submit" name="addcustomer" value="Create Customer"/>
				</div>
			</form>
		</div>
	</div>
				