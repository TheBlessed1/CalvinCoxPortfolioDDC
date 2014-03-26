<?php
// BEHOLD userTwitterFeed class!!!!!

class userTwitterFeed
{
	// member variables
	protected $userId
	protected $twitterFeedId


	// constructor
	public function __construct($userId, $twitterFeedId)
	{
		try
		{
			$this->setUserId($userId);
			$this->setTwitterFeedId($twitterFeedId);
		}
		
		catch(Exception $e)
		{
			throw(new Exception("userTwitterFeed object construct failure.", 0, $e));
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

	/* accessor method for twitterFeedId
	 * input: none
	 * ouput: twitterFeedId
	 * throws: none */
	 public function getTwitterFeedId()
	 {
	 	return (this->getTwitterFeedId);
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
	  		throw new Exception "userId error, please contact your local exorcist.";
	  	}
	  	else
	  	{	
	  		this->userId = $newUserId;
	 	}
	 }

	  public function setTwitterFeedId($newTwitterFeedId)
	  {
	  	if(!is_integer($newTwitterFeedId) || is empty)
	  	{
	  		throw new Exception "TwitterFeedId error, please contact your local public defender.";
	  	}
	  	else
	  	{	
	  		this->TwitterFeedId = $newTwitterFeedId;
	 	}
	 }
}


?>