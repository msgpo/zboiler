<?php

	function hash_password($input, $rounds = 7)
  {
    $salt = "";
    $salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 22; $i++) {
      $salt .= $salt_chars[array_rand($salt_chars)];
    }
    return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
  }

  function validate_password($password_entered) {
  	//password_hash is from db
  	if(crypt($password_entered, $password_hash) == $password_hash) {
    	return true;
  	} else {
  		return false;
  	}
  }

?>