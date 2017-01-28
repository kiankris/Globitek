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

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value='') {
    // Function can be improved later to check for
    // more than just '@'.
    // include a check for .com or .edu or .gov
    return strpos($value, '@') !== false;
  }

  function is_unique_username($name=''){
    $count_usernames = find_username($name);
    $count = db_fetch_assoc($count_usernames);
    db_free_result($count_usernames);
    return (int) $count["count"] == 0;
  }

  function has_valid_number_format($value=''){
    $value = preg_replace('/\s+/', '',$value);
    $value = str_replace('-', '', $value);
    $result = preg_match("/^[0-9]{10,11}$/", $value);
    return $result;
  }

  function has_valid_name_format($name=''){
    return preg_match('#^\p{Lu}#u', $name);
  }

  function has_valid_code_format($code=''){
    return ctype_alpha($code) && ctype_upper($code);
  }

  function is_unique_code($code=''){
    $code_results = find_code($code);
    $count = db_fetch_assoc($code_results);
    db_free_result($code_results);
    return (int) $count['count'] == 0;
  }

?>
