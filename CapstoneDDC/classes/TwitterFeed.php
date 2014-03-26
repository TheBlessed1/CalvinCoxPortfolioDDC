<?

class TwitterFeed
{
	// state variables
	
	protected $twitterFeedId;
	protected $twitterFeedName;
	protected $widget;

	// constructor

	public function __construct($newTwitterFeedId, $newTwitterFeedName, $newWidget)
	{
		try
		{
			$this->setTwitterFeedId($newTwitterFeedId);
			$this->setTwitterFeedName($newTwitterFeedName);
			$this->setWidget($newWidget);
		}
		catch(Exception $e)
		{
			throw(new Exception("TwitterFeed object construct failure.", 0, $e));
		}
	}
		
	// accessor methods
	
	public function getTwitterFeedId()
	{
		return($this->twitterFeedId);
	}
	
	public function getTwitterFeedName()
	
	{
		return($this->twitterFeedName);	
	}
	
	public function getWidget()
	
	{
		return($this->setWidget);
	}
	
	// mutator methods
	
	/**/
	
	
	/* mutator for twitterFeedId
	 * input int twitterFeedId
	 * output none
	 * throws: when both not null and not int */

	public function setTwitterFeedId($newTwitterFeedId)
	{
		if($newTwitterFeedId === null)
		{
			$this->twitterFeedId = $newTwitterFeedId;
		}
		elseif(!is_int($newTwitterFeedId))
		{
			throw new Exception ("Bad Twitter Feed ID.");
		}
		else
		{
			$this->twitterFeedId = $newTwitterFeedId;
		}
	}
	
	/* mutator for twitterFeedName
	 * input string twitterFeedName
	 * output none
	 * throws: when empty or not a string */	
	public function setTwitterFeedName($newTwitterFeedName)
	{
		if(empty($newTwitterFeedName) || !is_string($newTwitterFeedName))
		{
			throw new Exception("Twitter Feed must be a string.");
		}
		
		$this->twitterFeedName = $newTwitterFeedName;
	}
		
	/* mutator for widget
	 * input string widget
	 * output none
	 * throws: when empty or not a string */
	 
	public function setWidget($newWidget)
	{
		if($newWidget === null)
		{
			$this->widget = $newWidget;
		}
	 	elseif(empty($newWidget) || !is_string($newWidget))
	 	{
	 		throw new Exception ("Bad widget.");
	 	}
	 	$this->widget = $newWidget;
	}
	
	
}

?>