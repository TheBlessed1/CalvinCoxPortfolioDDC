<?php
require_once("../etc/cred_controller.php");

if(document.getElementById("IT").value == "on")
	{
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
		$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS, 'capstone');
		$clearNonce = "INSERT INTO userTwitterFeed (TwitterFeedId) VALUE (1)";

		$urlNonce = checkURLForNonce();
		$statement = $mysql->prepare($clearNonce);

		$statement->bind_param("s", $urlNonce);

		// BELIEVE!!!!!
		$statement->execute();
		}
		catch(mysqli_sql_exception $mysqlException)
		{
		// this only runs if mySQL had a problem
		echo "mySQL exception encountered: " . $mysqlException->getMessage();
		}
		catch(Exception $exception)
		{
		// this only runs if we have a non-mySQL exception
		echo "Exception encountered: " . $exception->getMessage();
		}

		// free up resources	
		$statement->close();
		$mysql->close();
		}
?>