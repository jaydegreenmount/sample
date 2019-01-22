<?php require_once('../../../private/initialize.php'); ?>

<?php

 // require_login();

  $customer_set = find_all_customers();

?>

<?php $page_title = 'Customers'; ?>


<div id="content">
  <div class="customer listing">
    <h1>Customers</h1>

    <div class="actions">
      <a class="action" href="../../pages/customer/new.php">Create New Customer</a>
    </div>
	<table class="list">
		<tr>
			<th>First name</th>
			<th>Surname</th>		
			<th>DOB</th>
			<th>User name</th>	
			<th>Password</th>
			<th>Email</th>
			<th>Usertype</th>
			<th>Returning customer</th>
			<th>Postcode</th>
			<th>Subscription</th>
			<th>CustomerID</th>
			<th>Active</th>	
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>

		      <?php while($customer = mysqli_fetch_assoc($customer_set)) { ?>
			<tr>
				<td><?php echo h($customer['cust_firstname']);?></td>
				<td><?php echo h($customer['cust_surname']);?></td>
				<td><?php echo h($customer['DOB']);?></td>
				<td><?php echo h($customer['user_name']);?></td>
				<td><?php echo h($customer['cust_password']);?></td>
				<td><?php echo h($customer['cust_email']);?></td>
				<td><?php echo h($customer['usertype']);?></td>
				<td><?php echo h($customer['returning_cust']);?></td>
				<td><?php echo h($customer['postcode']);?></td>
				<td><?php echo h($customer['subscription']);?></td>
				<td><?php echo h($customer['cust_ID']);?></td>
				<td><?php echo h($customer['cust_active']);?></td>	
          <td><a class="action" href="<?php echo url_for('/pages/customer/show.php?id=' . h(u($customer['cust_ID']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/pages/customer/edit.php?id=' . h(u($customer['cust_ID']))); ?>">Edit</a></td>
		   <td><a class="action" href="<?php echo url_for('/pages/customer/delete.php?id=' . h(u($customer['cust_ID']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>
	<?php
	mysqli_free_result($customer_set);
	?>
  </div>
	
</div>
