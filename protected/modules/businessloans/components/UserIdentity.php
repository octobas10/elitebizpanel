<?php
class UserIdentity extends CUserIdentity{
	private $id;
	public function affiliate_authenticate(){
		$record = AffiliateUser::model()->findByAttributes(array(
			'user_name' => $this->username 
		));
		if($record === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($record->password !== md5($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else{
			$this->id = $record->id;
			$this->setState('roles',$record->isAdmin); // admin is also an affiliate but he has admin role
			$this->setState('usertype','affiliate');
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function lender_authenticate(){
		$record = LenderDetails::model()->findByAttributes(array(
			'user_name' => $this->username
		));
		if($record === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if($record->password !== md5($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else{
			$this->id = $record->id;
			$this->setState('usertype','lender');
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function getId(){
		return $this->id;
	}
}
?>
