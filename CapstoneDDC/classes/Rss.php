<?php

class Rss
{
	// state variables
	
	protected $rssId;
	protected $feed;
	protected $rssName;
	
	// constructor
	
	public function __construct($newRssId, $newFeed, $newRssName)
	{
		try
		{
			$this->setRssId($newRssId);
			$this->setFeed($newFeed);
			$this->setRssName($newRssName);
		}
		
		catch(Exception $e)
		
		{
			throw(new Exception("Rss object construct failure.", 0, $e));
		}
	}
	
	// accessor methods
	
	public function getRssId()
	{
		return($this->rssId);
	}
	
	public function getFeed()
	{
		return($this->feed);
	}
	
	public function getRssName()
	{
		return($this->rssName);
	}
	
	// mutator methods
	
	/* mutator for rssId
	 * input: int rssId
	 * output: none
	 * throws: if both non-null and non-int */
	 
	public function setRssId($newRssId)
	{
		if($newRssId === null)
		{
			$this->rssId = $newRssId;
		}
		elseif(!is_int($newRssId))
		{
			throw new Exception ("Bad RSS Id.");
		}
		else
		{
			$this->rssId = $newRssId;
		}
	}
	
	/* mutator for feed
	 * intput: string feed
	 * output: none
	 * throws non-null, empty or non string */
	 
	public function setFeed($newFeed)
	{
		if($newFeed === null)
		{
			$this->feed = $newFeed;
		}
		elseif(empty($newFeed) || !is_string($newFeed))
		{
			throw new Exception ("Bad feed.");
		}
		
		else
		{
			$this->feed = $newFeed;
		}
	}
	
	/* mutator for rssName 
	 * input: string rssName
	 * output: none
	 * throws empty or non string */
	public function setRssName($newRssName)
	{
		if($newRssName === null)
		{
			$this->rssName = $newRssName;
		}
		elseif(empty($newRssName) || !is_string($newRssName))
		{
			throw new Exception("Bad RSS Name.");
		}
		else
		{
			$this->rssName = $newRssName;
		}
	}
}
?>