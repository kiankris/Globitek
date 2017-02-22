<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

// 
// Validation function
// 

  // altered from original check
  function has_valid_email_format($value='') {
    return filter_var($value, FILTER_VALIDATE_EMAIL) == true;
  }


  function has_valid_number_format($value=''){
    $value = preg_replace('/\s+/', '',$value);
    $value = str_replace('-', '', $value);
    $result = preg_match("/^[0-9]{10,11}$/", $value);
    return $result;
  }

  // ***Custom*** requires names for states to be capitalized
  function has_valid_name_format($name=''){
    return preg_match('#^\p{Lu}#u', $name);
  }

  // ***Custom*** requires codes for states to be capitalized
  // and alphabetical characters
  function has_valid_code_format($code=''){
    return ctype_alpha($code) && ctype_upper($code);
  }

  // ***Custom*** requires position for states to be strictly
  // numbers
  function has_valid_position_format($position){
    return ctype_digit($position);
  }

// 
//  Uniqueness checks 
// 

  // ***Custom*** requires usernames to be unique
  function is_unique_username($name=''){
    $count_usernames = find_username($name);
    $count = db_fetch_assoc($count_usernames);
    db_free_result($count_usernames);
    return (int) $count["count"] == 0;
  }

  // ***Custom*** requires state codes to be unique
  function is_unique_code($code=''){
    $code_results = find_code($code);
    $count = db_fetch_assoc($code_results);
    db_free_result($code_results);
    return (int) $count['count'] == 0;
  }

  // ***Custom*** requires territory positions to be unique
  // for that state
  function is_unique_position($position='', $state_id=''){
    $position_results = find_position($position, $state_id);
    $count = db_fetch_assoc($position_results);
    db_free_result($position_results);
    return (int) $count['count'] == 0;
  }

?>
