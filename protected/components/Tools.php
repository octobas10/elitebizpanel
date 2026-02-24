<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class Tools
{
 public static function valid_email($email) {
#     return (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email)) ? true : false;
    return (preg_match("/^[A-Za-z0-9-+_\.]+@[A-Za-z0-9-\.]+$/", $email)) ? true : false;
  }	
  public static function valid_phone($phone) {
    return (preg_match("/^1?[2-9]{1}[0-9]{9}$/", $phone)) ? true : false;
  }	
  public static function valid_zip($zip){
		if(strlen(trim($zip)) < 5 || !preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', trim($zip))){
			return false;
		}else {
			return true;
		}
	}
}
