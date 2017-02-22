<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return is_null($value) || trim($value)  == '';
  }

  function taken_username($value=''){

    $count_usernames = find_username($value);
    $count = db_fetch_assoc ($count_usernames);
    db_free_result($count_usernames);
    return $count["count"] > 0;
  }
  function has_whitespace($value='')
  {
    return preg_match("/\s/", $value);
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } else {
      return true;
    } 
  }

  // has_valid_email_format('test@test.com')
  function has_invalid_email_format($value) {
    return !preg_match("/^[^@]+@[^@]+$/", $value);
  }

?>
