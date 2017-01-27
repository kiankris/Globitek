<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function display_errors($errors=array()) {
    $output = '';
    if (!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }

  function format_number($n = ''){
  	$number = str_replace('-','',$n);
		if(preg_match('/^(\d{1})(\d{3})(\d{3})(\d{4})$/', $number, $matches)){
			$number = $matches[1] . '-' .$matches[2] . '-' . $matches[3] . '-' . $matches[4];
		}

		elseif(preg_match('/^(\d{3})(\d{3})(\d{4})$/', $number, $matches)){
			$number = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
		}
		return $number;
  }

  function db_e($db, $array=array()){
    foreach ($array as $key => $value) {
      $array[$key] = db_escape($db, $value);
    }
    return $array;
  }

?>
