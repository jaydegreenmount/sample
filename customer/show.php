<?php require_once('../../../private/initialize.php'); ?>

<?php

//require_login();


$id = $_GET['id']; 

$customer = find_customer_by_id($id);

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
					
<!-- END admin-header.php HERE -->	







<div id="content">


	<div class="tabs" id="Table_2">			
		 <a href="../../admin_index.php"><button class="tablinks" id="defaultOpen">Go Back</button></a>
	</div>





<?php $page_title = 'Show Customers'; ?>
	

<div id="content">



	<div class="customer show">
	

	
	<h1>Customer: <?php echo h($customer['cust_ID']);?></h1>
	<div class ="attributes">
		<dl>
			<dt>First Name</dt>
			<dd>
			<?php echo h($customer['cust_firstname']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Surname</dt>
			<dd>
			<?php echo h($customer['cust_surname']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Date of Birth</dt>
			<dd>
			<?php echo h($customer['DOB']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>User Name</dt>
			<dd>
			<?php echo h($customer['user_name']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Password</dt>
			<dd>
			<?php echo h($customer['cust_password']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Email</dt>
			<dd>
			<?php echo h($customer['cust_email']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>User type</dt>
			<dd>
			<?php echo h($customer['usertype']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Returning Customer</dt>
			<dd>
			<?php echo h($customer['returning_cust']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Postcode</dt>
			<dd>
			<?php echo h($customer['postcode']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>Subscription</dt>
			<dd>
			<?php echo h($customer['subscription']);?>
			</dd>
		</dl>
		
		<dl>
			<dt>ID</dt>
			<dd>
			<?php echo h($customer['cust_ID']);?>
			</dd>
		</dl>

	</div>
</div>


