<?php

require_once('../private/initialize.php');

// Set default values for all variables the page needs.

$inputs = array(NULL,NULL,NULL,NULL);
$errors = array ();

// if this is a POST request, process the form
// Hint: private/functions.php can help
// Confirm that POST values are present before accessing them.

if(is_post_request()){

// Perform Validations
// Hint: Write these in private/validation_functions.php

	$pos = 0;
	$inputs[0]=isset($_POST["firstname"]) ? h($_POST["firstname"]) : NULL;
	$inputs[1]=isset($_POST["lastname"])  ? h($_POST["lastname"])  : NULL;
	$inputs[2]=isset($_POST["email"])     ? h($_POST["email"])     : NULL;
	$inputs[3]=isset($_POST["username"])  ? h($_POST["username"])  : NULL;

	if(is_blank($_POST["firstname"])){
		$errors["firstname"] = "First name field cannot be empty";
	}elseif(!has_length(trim($_POST["firstname"]), array("min"=>2, "max"=>255))){
		$errors["firstname"]= "First name must be between 2 and 255 characters";
	}
	$pos++;

	if(is_blank($_POST["lastname"])){
		$errors["lastname"] = "Last name field cannot be empty";
	}elseif(!has_length(trim($_POST["lastname"]), array("min"=>2, "max"=>255))){
		$errors["lastname"]= "Last name must be between 2 and 255 characters";
	}
	$pos++;

	if(is_blank($_POST["email"])){
		$errors["email"] = "Email field cannot be empty";
	}elseif(has_invalid_email_format($_POST["email"])){
		$errors["email"]= "Invalid email address";	
	}elseif(!has_length(trim($_POST["email"]), array("min"=>2, "max"=>255))){
		$errors["email"]= "Email must be between 2 and 255 characters";
	}elseif(has_whitespace($_POST["email"])){
		$errors["email"]= "Email must not contain spaces";			
	}
	$pos++;

	if(is_blank($_POST["username"])){
		$errors["username"] = "Username field cannot be empty";
	}elseif(!has_length(trim($_POST["username"]), array("min"=>8, "max"=>255))){
		$errors["username"]= "Username must be at least 8 characters long and contain no spaces";
	}elseif(has_whitespace($_POST["username"])){
		$errors["username"]= "Username must not contain spaces";
	}
	elseif(taken_username($_POST["username"])){
    	$errors["username"] = "Username has been taken";
	}


// if there were no errors, submit data to database
	if(empty($errors)){
	// Write SQL INSERT statement
	    $sql = "INSERT INTO `users` " .
			"(first_name, last_name, email, username) " .
			"VALUES('". 
				db_escape($db, $inputs[0]) . "',' " .
				db_escape($db, $inputs[1]) . "',' " .
				db_escape($db, $inputs[2]) . "',' " .
				db_escape($db, $inputs[3]) . "')" ;
	// For INSERT statments, $result is just true/false
	// redirect user to success page
		$result = db_query($db, $sql);
		if($result) {
			db_close($db);
		redirect_to("registration_success.php");
		} 
	// The SQL INSERT statement failed.
	// Just show the error, not the form
		else {
			echo db_error($db);
			db_close($db);
			exit;
		}
	}
}

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
<h1>Register</h1>
<p>Register to become a Globitek Partner Today.</p>
<?php

 // TODO: display any form errors here
 // Hint: private/functions.php can help
 echo display_errors($errors);
?>

<!-- TODO: HTML form goes here -->


<form method="post" action="<?php echo h($_SERVER["PHP_SELF"]);?>">
First name:<br>
<input type="text" name="firstname" value="<?php echo h($inputs[0]); ?>">
<br>
Last name:<br>
<input type="text" name="lastname" value="<?php echo h($inputs[1]); ?>">
<br>
Email: <br>
<input type="text" name="email" value="<?php echo h($inputs[2]); ?>">
<br>
Username: <br>
<input type="text" name="username" value="<?php echo h($inputs[3]); ?>">
<br>
<br>

<input type="submit" value="Submit">
</form> 
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
