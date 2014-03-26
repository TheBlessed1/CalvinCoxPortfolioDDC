<?php
// require all the things
require_once("../etc/creds.php");
require_once("../classes/User.php");
require_once("../classes/Rss.php");
require_once("../classes/TwitterFeed.php");
//require_once("../classes/userTwitterFeed.php");
//require_once("../classes/userRss.php");

/* This function populates the user prefrences and echos the controller interface.
 * The function will fire four queries within one mysql connection, two to determine the 
 * list of radio buttons, and two to determine the status of those same radio buttons.
 * this function also will fire the 
 * intput: none
 * output: none
 * throws: mysql failures or undergirding object failures*/
function populateRadioButtons($userId)
{
	// generate queries
	mysqli_report(MYSQLI_REPORT_STRICT);

	try
	{
		// some global credentials passed through require
		global $MYSQL_APP, $MYSQL_CREDENTIALS;
		$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS, 'capstone');
		// populate a list of all avaliable RSS Feeds
		$query = "SELECT rssId, feedName FROM rss";
		$statement = $mysql->prepare($query);
		if($statement === false)
		{
			throw new Exception("Invalid username or password.");
		}
		$statement->execute();
		$result = $statement->get_result();		
	
		// give me a row of rss and I will give you a radio button pair for all the Rss feeds we have, and fill it with the user's previous option.
		while( ($row = $result->fetch_assoc()) !== null)
		{	
			$i = 0;
			$i += 1;
			$rss = new Rss($row['rssId'], null, $row['feedName']);
			$buttonId = $rss->getRssId();
			$buttonName = $rss->getRssName();
			$arrayOfStatuses = determineRadioStatus(get_class($rss), $mysql, $userId);
			var_dump($arrayOfStatuses);
			echo "<input type='radio' name ='$buttonId' value ='$status'>";
			echo "<input type='radio' name ='$buttonId' value ='off'>     $buttonName <br/>";

			//FIXME START HERE HEY HEY THIS IS WHERE YOU LEFT OFF

			// calls the function, passing the class name of the object, and the mysql object so the function can do its thing.
			/*$arrayOfStatuses = determineRadioStatus(get_class($Rss), $mysql, $userId);
			foreach($arrayOfStatuses as $status)
			{
				echo "<input type='radio' name='$buttonId' value='$status'> $buttonName <br/> ";
			}*/
		}
		// do it again for the twitter stuff
	
		// clean up the old result and statement
		$result->free();
		$statement->close();
	
		// new query for the twitter stuff
	
		$query = "SELECT twitterFeedId, twitterFeedName FROM twitterFeed";
		$statement = $mysql->prepare($query);
		if($statement === false)
		{
			throw new Exception("Invalid username of password.");
		}
		$statement->execute();
		$result = $statement->get_result();
	
		// same drill as rss feeds
	 
		while(($row = $result->fetch_assoc()) !== null)
		{
			$twitterFeed = new TwitterFeed($row['twitterFeedId'], $row['twitterFeedName'], null);
			$buttonId = $twitterFeed->getTwitterFeedId();
			$buttonName = $twitterFeed->getTwitterFeedName();
			// calls the function, passing the class name of the object, and the mysql object so the function can do its thing.
			/*$arrayOfStatuses = determineRadioStatus(get_class($twitterFeed), $mysql, $userId);
			foreach($arrayOfStatuses as $status)
			{	
				
				echo "<input type='radio' name='$buttonId' value='$status'> $buttonName<br/>";
			}*/
		}
		// clean up
		$result->free();
		$statement->close();
		$mysql->close();
	}

	catch(mysqli_sql_exception $mysqlException)
	{
		// this only runs if mySQL had a problem
		echo "MySQL exception encountered: " . $mysqlException->getMessage();
		exit;
	}

	catch(Exception $exception)
	{
		// this runs if we have a non-mySQL exception
		echo "Standard exception encountered: " . $exception->getMessage();
		exit;
	}
}

/* These function determine the status of the radio buttons.  They are designed to fire in
 * the context of the populateRadioButtons function.  This function assumes an active mysql connection
 * input: className, mysql connection, userId
 * output: associative array containing userId and classNameId
 * throws: mysql failures, or undergirding object failures.  */
 
function determineRadioStatus($className, $mysql, $userId)
{	
	try
	{
		// assumes mysql connection already active and some object already in memory.
		$query = "SELECT "  . $className . "Id FROM user" 
						. $className . " WHERE userId = "
						. $userId;
		$statement = $mysql->prepare($query);
		if($statement === false)
		{
			echo "Invalid username or password.";
			exit;
		}
		$statement->execute();
		$result = $statement->get_result();
		$arrayOfStatuses = $result->fetch_assoc();
		return($arrayOfStatuses);

		
	}
		catch(mysqli_sql_exception $mysqlException)
	{
		// this only runs if mySQL had a problem
		echo "MySQL exception encountered: " . $mysqlException->getMessage();
		exit;
	}

	catch(Exception $exception)
	{
		// this runs if we have a non-mySQL exception
		echo "Standard exception encountered: " . $exception->getMessage();
		exit;
	}
}



?>