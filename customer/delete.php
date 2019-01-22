<?php

require_once('../../../private/initialize.php');

//require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/pages/customer/index.php'));
}
$cust_ID = $_GET['id'];

if(is_post_request()) {

  $result = delete_customer($cust_ID);
  $_SESSION['message'] = 'The order was deleted successfully.';
  redirect_to(url_for('/admin_index.php'));

} else {
  $customer = find_customer_by_id($cust_ID);
}

?>

<?php $page_title = 'Customer Delete'; ?>



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
              

                <div id="content">


         <div class="tabs" id="Table_2">     
            <a href="../../admin_index.php"><button class="tablinks" id="defaultOpen">Go Back</button></a>
          </div>

             <div id="content">

                  <div class="customer delete">
                     <h1>Delete Customer</h1>
                        <p>Are you sure you want to delete this customer?</p>
                        <p class="item"><?php echo h($customer['cust_firstname']); ?></p>
                 
                     <form action="<?php echo url_for('/pages/customer/delete.php?id=' . h(u($customer['cust_ID'])));                 ?>" method="post">
                           <div id="operations">
                                  <input type="submit" name="commit" value="Delete Customer" />
                          </div>
                      </form>
                   </div>
                  
              </div>

