<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
  
  private $_id = 0;
  public $name = '';
  public $pass = '';
  /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = UserRecord::model()->findByAttributes(array("name" => $this->name));
        if ($user && $user->status != UserRecord::ACTIVE) {
          $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
          return !$this->errorCode;
        }
        if (!$user) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else  {
          $pass = $user->pass;
          if ($user->pass != md5($this->pass)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
          }
          else {
            $this->_id = $user->user_id;
            $this->setState("user", $user);
			$this->errorCode=self::ERROR_NONE;
          }
        }
        
        return !$this->errorCode;
	}
    
    public function getId() {
      return $this->_id;
    }
}