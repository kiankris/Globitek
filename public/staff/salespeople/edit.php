<?php
	require_once('../../../private/initialize.php');

	if(!isset($_GET['id'])) {
	  redirect_to('index.php');
	}
	$salespeople_result = find_salesperson_by_id($_GET['id']);
	// No loop, only one result
	$salesperson = db_fetch_assoc($salespeople_result);
	if($salesperson === NULL){
		redirect_to('index.php');
	}

	$errors = array();
	if(is_post_request()){
		// Confirm that values are present before accessing them.
		if(isset($_POST['first_name'])) { $user['first_name'] = h($_POST['first_name']); }
		if(isset($_POST['last_name'])) { $user['last_name'] = h($_POST['last_name']); }
		if(isset($_POST['phone'])) { $user['phone'] = h($_POST['phone']); }
		if(isset($_POST['email'])) { $user['email'] = h($_POST['email']); }


		$result = update_salesperson($salesperson);
		if($result === true) {
			redirect_to('show.php?id=' . $user['id']);
		} else {
			$errors = $result;
		}

	}
?>

<?php $page_title = 'Staff: Edit Salesperson ' . $salesperson['first_name'] . " " . $salesperson['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo $salesperson['first_name'] . " " . $salesperson['last_name']; ?></h1>

  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
