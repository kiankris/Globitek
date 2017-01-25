<?php
require_once('../../../private/initialize.php');

$errors = array();
$salesperson = array(
	'first_name'  => '',
	'last_name'  => '',
	'phone'  => '',
	'email'  => ''
	);

if(is_post_request()){
	
	// Confirm that values are present before accessing them.
  if(isset($_POST['first_name'])) { $salesperson['first_name'] = h($_POST['first_name']); }
  if(isset($_POST['last_name'])) { $salesperson['last_name'] = h($_POST['last_name']); }
  if(isset($_POST['phone'])) { $salesperson['phone'] = h($_POST['phone']); }
  if(isset($_POST['email'])) { $salesperson['email'] = h($_POST['email']); }

  $result = insert_user($user);
  if($result === true) {
    $new_id = db_insert_id($db);
    redirect_to('show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }
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
