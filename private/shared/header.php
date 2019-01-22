<?php
//error_reporting(0); // Disable all errors.
  if(!isset($page_title)) { $page_title = 'Monster Fight'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>CUSTOMER HEADER|Monster Fight Website<?php echo h($page_title); ?></title>
    <meta charset="utf-8">
	<link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/main_page.css');?>"/>
  </head>

  <body>
    <header>
      <h1>Monster Fight</h1>
    </header>

    <navigation>
      <ul>
        <li>
			<a href="<?php echo url_for('/main_page.php');?>">HOME</a>
		</li>
      </ul>
    </navigation>
