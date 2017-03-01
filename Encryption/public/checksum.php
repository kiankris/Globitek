<?php

  require_once('../private/initialize.php');

  $message = '';
  $result_checksum = '';
  $checksum = '';
  $result_text = '';

  if(isset($_POST['submit'])) {
  
    if(!isset($_POST['checksum'])) {
    
      // This is a create checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : '';
      $result_checksum = create_checksum($message);
      $checksum = $result_checksum;
    
    } else {
      // This is a verify checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : '';
      $checksum = isset($_POST['checksum']) ? $_POST['checksum'] : '';
      $result = verify_checksum($message, $checksum);
      $result_text = $result == 1 ? 'Valid' : 'Not valid';
    }
  }

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Symmetric Encryption: Create/Verify Checksum</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" media="all" href="includes/styles.css" />
  </head>
  <body>
    
    <a href="index.php">Main menu</a>
    <br/>

    <h1>Symmetric Encryption</h1>
    
    <div id="creator">
      <h2>Create Checksum</h2>

      <form action="" method="post">
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h($message); ?></textarea>
        </div>
        <div>
          <input type="submit" name="submit" value="Create">
        </div>
      </form>
    
      <div class="result"><?php echo h($result_checksum); ?></div>
      <div style="clear:both;"></div>
    </div>
    
    <hr />
    
    <div id="verifier">
      <h2>Verify Checksum</h2>

      <form action="" method="post">
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h($message); ?></textarea>
        </div>
        <div>
          <label for="checksum">Checksum</label>
          <textarea name="checksum"><?php echo h($checksum); ?></textarea>
        </div>
        <div>
          <input type="submit" name="submit" value="Verify">
        </div>
      </form>

      <div class="result"><?php echo h($result_text); ?></div>
      <div style="clear:both;"></div>
    </div>
    
  </body>
</html>
