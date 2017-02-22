<?php

  //
  // COUNTRY QUERIES
  //

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  //
  // STATE QUERIES
  //

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
    $country_id = db_escape($db, $country_id);
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE country_id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
    $id = db_escape($db, $id);
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  function validate_state($state, $errors=array()) {
    if (is_blank($state['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($state['name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($state['name'])) {
      $errors[] = "Name may not contain numbers, first letter must be capitalized";
    }

    if (is_blank($state['code'])) {
      $errors[] = "Code cannot be blank.";
    } elseif (!has_length($state['code'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Code must be between 2 and 255 characters.";
    } elseif (!has_valid_code_format($state['code'])) {
      $errors[] = "Code must contain only letters and must be capitalized";
    } elseif (isset($state['orig_code']) && strcmp($state['orig_code'], $state['code']) === 0) {
      // orig value == current, skip
    } elseif (!is_unique_code($state['code'])) {
      $errors[] = "State code already in use";
    }

    return $errors;
  }

  // Add a new state to the table
  // Either returns true or an array of errors
  function insert_state($state) {
    global $db;

    $state = db_e($db, $state);
    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO states"; 
    $sql .= "(name, code)";
    $sql .= "VALUES ('" . implode("','", $state) . "');";

    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a state record
  // Either returns true or an array of errors
  function update_state($state) {
    global $db;

    $state = db_e($db, $state);
    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE states SET "; 
    $sql .= "name='" . $state['name'] . "', ";
    $sql .= "code='" . $state['code'] . "' ";
    $sql .= "WHERE id='" . $state['id'] . "' ";
    $sql .= "LIMIT 1;";
    
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // TERRITORY QUERIES
  //

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
    $state_id = db_escape($db, $state_id);
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $state_id . "' ";
    $sql .= "ORDER BY position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
    $id = db_escape($db, $id);
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  function validate_territory($territory, $errors=array()) {
    if (is_blank($territory['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($territory['name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($territory['name'])) {
      $errors[] = "Name may not contain numbers, first letter must be capitalized";
    }

    if (is_blank($territory['position'])) {
      $errors[] = "Position cannot be blank.";
    } elseif (!has_length($territory['position'], array('min' => 1, 'max' => 11))) {
      $errors[] = "Position must be between 1 and 11 numbers.";
    } elseif (!has_valid_position_format($territory['position'])) {
      $errors[] = "Position must contain only numbers";
    } elseif (isset($territory['orig_position']) && strcmp($territory['position'], $territory['orig_position']) === 0) {
      // orig value == current, skip
    } elseif (!is_unique_position($territory['position'], $territory['state_id'])){
      $errors[] = "Position for state has already been taken";
    }
    return $errors;
  }

  // Add a new territory to the table
  // Either returns true or an array of errors
  function insert_territory($territory) {
    global $db;

    $territory = db_e($db, $territory);
    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO territories"; 
    $sql .= "(name, state_id, position)";
    $sql .= "VALUES ('" . implode("', '", $territory) . "');";

    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a territory record
  // Either returns true or an array of errors
  function update_territory($territory) {
    global $db;

    $territory = db_e($db, $territory);
    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE territories SET "; 
    $sql .= "name='"     . $territory['name'] . "',";
    $sql .= "state_id='" . $territory['state_id'] . "',";
    $sql .= "position='" . $territory['position'] . "'";
    $sql .= "WHERE id='" . $territory['id'] . "'";
    $sql .= "LIMIT 1;";
    // For update_territory statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // SALESPERSON QUERIES
  //

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $territory_id = db_escape($db, $territory_id);

    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $id = db_escape($db, $id);

    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  function validate_salesperson($salesperson, $errors=array()) {
    if (is_blank($salesperson['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($salesperson['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($salesperson['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($salesperson['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($salesperson['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($salesperson['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($salesperson['phone'])){
      $errors[] = "Phone number cannot be blank.";
    } elseif(!has_valid_number_format($salesperson['phone'])){
      $errors[] = "Phone number must contain only numbers, '-' are allowed";
    }

    return $errors;
  }

  // Add a new salesperson to the table
  // Either returns true or an array of errors
  function insert_salesperson($salesperson) {
    global $db;

    $salesperson = db_e($db, $salesperson);
    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    $salesperson['phone'] = format_number($salesperson['phone']);

    $sql = "INSERT INTO salespeople (first_name, last_name, phone, email)"; 
    $sql .= "VALUES ('" . implode("','", $salesperson) . "');";

    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a salesperson record
  // Either returns true or an array of errors
  function update_salesperson($salesperson) {
    global $db;

    $salesperson = db_e($db, $salesperson);
    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    $salesperson['phone'] = format_number($salesperson['phone']);

		$sql = "UPDATE salespeople SET ";
    $sql .= "first_name='" . $salesperson['first_name'] . "', ";
    $sql .= "last_name='"  . $salesperson['last_name']  . "', ";
    $sql .= "email='"      . $salesperson['email']      . "', ";
    $sql .= "phone='"      . $salesperson['phone']      . "' ";
    $sql .= "WHERE id='"   . $salesperson['id']         . "' ";
    $sql .= "LIMIT 1;";

    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $id = db_escape($db, $id);
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  //
  // USER QUERIES
  //

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }
  // Find user using id
  function find_user_by_id($id=0) {
    global $db;
    $id = db_escape($db, $id);
    $sql = "SELECT * FROM users WHERE id='" . $id . "' LIMIT 1;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  function validate_user($user, $errors=array()) {
    if (is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user['username'])) {
      $errors[] = "username cannot be blank.";
    } elseif (!has_length($user['username'], array('max' => 255))) {
      $errors[] = "username must be less than 255 characters.";
    } elseif (isset($user['orig_uname']) && strcmp($user['username'], $user['orig_uname']) === 0) {
      // orig value == current, skip
    } elseif (!isset($ignore) && !is_unique_username($user['username'])){
      $errors[] = "username is already in use. Please create a different username.";
    }
    return $errors;
  }

  // Add a new user to the table
  // Either returns true or an array of errors
  function insert_user($user) {
    global $db;

    $user = db_e($db, $user);
    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $created_at = date("Y-m-d H:i:s");
    $sql = "INSERT INTO users ";
    $sql .= "(first_name, last_name, email, username, created_at) ";
    $sql .= "VALUES (";
    $sql .= "'" . $user['first_name'] . "',";
    $sql .= "'" . $user['last_name']  . "',";
    $sql .= "'" . $user['email']      . "',";
    $sql .= "'" . $user['username']   . "',";
    $sql .= "'" . $created_at . "'";
    $sql .= ");";

    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a user record
  // Either returns true or an array of errors
  function update_user($user) {
    global $db;

    $user = db_e($db, $user);
    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . $user['first_name']. "', ";
    $sql .= "last_name='"  . $user['last_name'] . "', ";
    $sql .= "email='"      . $user['email']     . "', ";
    $sql .= "username='"   . $user['username']  . "' ";
    $sql .= "WHERE id='"   . $user['id']        . "' ";
    $sql .= "LIMIT 1;";
    // For update_user statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the errro, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  function find_username($name){
      global $db;
      $name= db_escape($db, $name);

      $sql = "SELECT COUNT(*) as 'count' FROM users WHERE username=";
      $sql .= "'" . $name . "';";
      $count_result = db_query($db, $sql);
      return $count_result;
    }

  function find_code($code){
    global $db;

    $code = db_escape($db, $code);

    $sql = "SELECT COUNT(*) as 'count' FROM states WHERE code=";
    $sql .= "'" . $code . "';";
    $count_result = db_query($db, $sql);
    return $count_result;
  }

  function find_position($position, $state_id){
    global $db;

    $position = db_escape($db, $position);
    $state_id = db_escape($db, $state_id);

    
    
    $sql = "SELECT COUNT(*) as 'count' ";
    $sql .= "FROM territories ";
    $sql .= "WHERE position='". $position . "'";
    $sql .= "AND state_id='"  . $state_id . "';"; 
    $count_result = db_query($db, $sql);
    return $count_result;

  }
?>