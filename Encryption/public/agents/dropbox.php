<?php

  require_once('../../private/initialize.php');

  if(!isset($_GET['id'])) {
    redirect_to('index.php');
  }

  $id = $_GET['id'];
  $agent_result = find_agent_by_id($id);
  // No loop, only one result
  $agent = db_fetch_assoc($agent_result);
	if($agent === Null){
		redirect_to('index.php');
	}

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Message Dropbox</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" media="all" href="<?php echo DOC_ROOT . '/includes/styles.css'; ?>" />
  </head>
  <body>
    
    <a href="<?php echo url_for('/agents/index.php') ?>">Back to List</a>
    <br/>

    <h1>Message Dropbox</h1>
    
    <div>
      <h2>Leave a Message for <?php echo h($agent['codename']); ?></h2>
      
      <p>Messages will be automatically encrypted using the recipient's public key, and signed using your private key.</p>
      
      <p>Messages may not exceed 245 characters.</p>
        
      <form action="<?php echo url_for('/agents/post_message.php?id=' . h(u($agent['id']))); ?>" method="post">
        <div>
          <textarea class="large" name="plain_text" maxlength="245"></textarea>
        </div>
        <div>
          <input type="submit" name="submit" value="Submit">
        </div>
				<input type="hidden" name="sender_id" value="<?php echo 1;?>"/>
				<input type="hidden" name="receiver_id" value="<?php echo h(u($agent['id']));?>"/>
      </form>
    
    </div>
    
  </body>
</html>
