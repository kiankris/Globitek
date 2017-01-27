<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);

if($state === NULL){
  redirect_to('index.php');
}
$errors = array();

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['first_name'])) {$state['first_name'] = h($_POST['first_name']); }
  if(isset($_POST['last_name']))  {$state['last_name']  = h($_POST['last_name']);}
  if(isset($_POST['statename']))  {$state['statename']  = h($_POST['statename']);}
  if(isset($_POST['email']))      {$state['email']      = h($_POST['email']);}


  $result = update_state($state);
  if($result === true) {
    redirect_to('show.php?id=' . $state['id']);
  } else {
    $errors = $result;
  }
}
?
?>
<?php $page_title = 'Staff: Edit State ' . $state['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="#add_a_url">Back to States List</a><br />

  <h1>Edit State: <?php echo $state['name']; ?></h1>

  <!-- TODO add form -->

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
