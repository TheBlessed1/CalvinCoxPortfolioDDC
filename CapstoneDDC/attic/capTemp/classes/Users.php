<?php
class Users
{
	//state variables
	
	protected $email;
	protected $password;  //passwords are stored as hashes
	protected $salt;
	protected $userId;
	// FIXME for nonces
	protected $nonce
	//__contstruct()
	
	public function __construct($newEmail, $newPassword, $newSalt, $newUserId)
	{
		try
		{
			$this->setEmail($newEmail);
			$this->setUserId($newUserId);
			$this->setSalt($newSalt);
			$this->setPassword($newPassword);
		}
		catch(Exception $e)
		{
			throw(new Exception("Users object construct failure.", 0, $e));
		}
	}
	
	//accessor methods
/**/
	/* accessor for email
	 * inputs: 	none
	 * outputs: 	string email
	 * throws: 	none									*/
	 
	public function getEmail()
	{
		return($this->email);
	}
	/* accessor for password
	 * inputs: 	none
	 * outputs: 	string password
	 * throws:	none									*/
	
	public function getPassword()
	{
		return($this->password);
	}
		
	/* accessor for email
	 * inputs: 	none
	 * outputs: 	string salt
	 * throws: 	none									*/
	 
	public function getSalt()
	{
		return($this->salt);
	}
	
	/* accessor for userId
	 * inputs: 	none
	 * outputs: 	int userId
	 * throws: 	none									*/
	 
	public function getUserId()
	{
		return($this->userId);
	}
 	
 	/* accessor for nonces
	* Input: none
	* output: nonce */
	public function getNonce()
	{
		return($this->nonce);
	}
	
	//mutator methods
	/* mutator for email
	 * inputs: 	string email
	 * outputs: 	string email
	 * throws: 	empty, non-string, failed regex			*/
	//
	public function setEmail($newEmail)
	{
		if((!is_string($newEmail)) || empty($newEmail))
		{
			throw new Exception("Invalid username or password.");
		}
		else
		{
			$this->email = $newEmail;
		}
	}
		/* mutator for password
	 * inputs: string password
	 * outputs: string password
	 * throws: nonhex (regex), not 128 characters		*/
	 public function setPassword($newPassword)
	{
		$p = "/^[0-9a-fA-F]{128}$/";
	 	if((preg_match($p, $newPassword) !== 1))
	 	{
	 		throw new Exception("The password is wrong or empty.");
	 	}
	 	else
	 	{
	 		$this->password = $newPassword;
	 	}
	}
	
	/* mutator for salt
	 * inputs: string salt
	 * outputs: string salt
	 * throws: regex fail, not 64 characters 						 */
	public function setSalt($newSalt)
	{
		$p = "/^[0-9a-fA-F]{64}$/";
		if(( preg_match($p, $newSalt) !== 1))
		{
			throw new Exception("The salt is wrong or empty.");
		}
		else
		{
			$this->salt = $newSalt;
		}
	}
	
	/* mutator for userId
	 * inputs: 	int userId
	 * outputs: 	int userid
	 * throws: 	non-int, <= 0							*/
	 
	public function setUserId($newUserId)
	{
		if((!is_int($newUserId)) || ($newUserId <= 0))
		{
			throw new Exception("Invalid username or password.");
		}
		else
		{
			$this->userId = $newUserId;
		}
	}
	
	/* mutator for Nonce
	* input: 64 byte string Nonce
	* outputs: 64 byte string Nonce
	* throws if not 64 byte string*/
	
	public function setNonce($newNonce)
		{
		$p = "/^[0-9a-fA-F]{64}$/";
		if(( preg_match($p, $newNonce) !== 1))
		{
			throw new Exception("The nonce is wrong or empty.");
		}
		else
		{
			$this->nonce = $newNonce;
		}
	}
	
	
	//Nonce Creation
	/* Static method creates nonce. Fired during normal account creation, or upon password reset.
	 * inputs: none
	 * outputs 64 byte string called a nonce */
	 public static function createNonce()
	 {
	 	$p = "/^[0-9a-fA-F]{64}$/";
	 	$generatedNonce = bin2hex(openssl_random_pseudo_bytes(16));
	 	return($generatedNonce);
	 }
	 
	// Salt Creation
	/* Static method which generates salt.  This method will be fired during normal account creation, or upon password reset.
	 * inputs: none
	 * outputs: 64 byte string generated when the user creates his account 
	 * throws: salt fails regular expression match, all-hex, 64 characters					*/
	public static function createSalt()
	{
		$p = "/^[0-9a-fA-F]{64}$/";
		$generatedSalt = bin2hex(openssl_random_pseudo_bytes(32));
		if(preg_match($p, $generatedSalt) !== 1)
		{
			throw new Exception("Invalid username or password.");
		}
		else
		{
			return($generatedSalt);
		}
	}
	//password specific methods
	/* password verification; this is the normal verification process
	 * this is NOT the first-time password verification process
	 * 
	 * inputs:	none
	 * outputs:	bool true on match
	 * throws: 	on nonmatch of $hash and stored password								*/
	
	public function matchPasswordHash($clearPassword)
	{
		
		$hash = bin2hex(hash_pbkdf2("sha512", $clearPassword, $this->salt, 4096, 0, true));
		if($hash !== $this->password)
		{
			throw new Exception("Invalid username or password.");	
		}
		else
		{
			return(true);
		}
	}
	

	//__toString()
	
}



?>
