<?php
require_once('../../../private/initialize.php');

$errors = array();
$salesperson = array(
	'first_name'  => '',
	'last_name'  => '',
	'phone_num'  => '',
	'email'  => ''
	);

if(is_post_request()){
	
}

?>


<?php $page_title = 'Staff: New Salesperson'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="show.php">Back to Salespeople List</a><br />

  <h1>New Salesperson</h1>

  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
