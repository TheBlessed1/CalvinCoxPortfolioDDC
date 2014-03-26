<?php
// BEHOLD userRss class!!!!!

class userRss
{
	// member variables
	protected $userId
	protected $rssId


	// constructor
	public function __construct($userId, $rssId)
	{
		try
		{
			$this->setEmail($userId);
			$this->setNonce($rssId);
		}
		
		catch(Exception $e)
		{
			throw(new Exception("userRss object construct failure.", 0, $e));
		}
	}
	// accessors
	/**/
	/* accessor method for userId
	 * input: none
	 * ouput: userId
	 * throws: none */
	 public function getUserId()
	 {
	 	return (this->getUserRId);
	 }

	/* accessor method for rssId
	 * input: none
	 * ouput: rssId
	 * throws: none */
	 public function getRssId()
	 {
	 	return (this->getRssId);
	 }
	 
	 // mutators
	 /**/
	 /* mutator method for UserId
	  * input: newUserId
	  * output: none
	  * throws: empty, non-integer */
	  public function setUserId($newUserId)
	{
	  	if(!is_integer($newUserId) || is empty)
	  	{
	  		throw new Exception "userId error, please contact your local pharmacy.";
	  	}
	  	else
	  	{	
	  		this->userId = $newUserId;
	 	}
	 }

	  public function setrssId($newRssId)
	  {
	  	if(!is_integer($newRssId) || is empty)
	  	{
	  		throw new Exception "rssId error, please contact your local spiderman.";
	  	}
	  	else
	  	{	
	  		this->rssId = $newRssId;
	 	}
	 }
}


?>