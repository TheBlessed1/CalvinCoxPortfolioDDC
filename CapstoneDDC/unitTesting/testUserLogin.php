<?php
require_once("creds.php");
require_once("User.php");

$login = htmlentities("testuser@hotmail.com");

// some regex here FIXME 

// query the database for the email the user provides

mysqli_report(MYSQLI_REPORT_STRICT);

try
{
$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS , 'capstone');

$query = "SELECT email, nonce, userId FROM user WHERE email = ?";

$statement = $mysql->prepare($query);
	if($statement === false)
	{
		throw new Exception("Invalid username or password.");
	}
// bind the sanitized input to the query

$statement->bind_param("s", $login);

// engage!

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

$result = $statement->get_result();

// since I expect exactly one result the program will halt and throw an exception if zero or more than one is returned.

if($result->num_rows !== 1)
{
	echo "Invalid username or password.";
	throw new Exception("Invalid username or password.");
}

$row = $result->fetch_assoc();

// free up resources

$result->free();
$statement->close();
$mysql->close();
$user = new User($row["email"], $row["nonce"], $row["userId"]);

// enter object oriented paradigm

// normal login procedure

if($user->getNonce() !== null)
{
	throw new Exception ("Please complete the registration process.  Would you like us to send you another link?");
}
// upon discovering the user is registered, kerberos will now grant the user a TGT after verifying the credentials

// generates a deterministic princName based on the userId of the object's row.  This is invisible to the user


// each user has a normalized pricpal name based upon his userId.  This is unique.
$princName = "webUser" . $user->getUserId() . "/capstonesite@STUDENTS.DEEPDIVECODERS.COM";

// create a TGT object and fetch TGT from Kerberos for the princial if the credentials match.
try
{
$ticket = new KRB5CCache();

// isLoggedIn is true on success.  An exception is thrown upon failure.

$isLoggedIn = $ticket->initPassword($princName, "Newtestpassword8");

}
catch(Exception $e)
{
	throw new Exception("Invalid username or password.");
} 
if($isLoggedIn !== true)
{
	throw new Exception("Invalid Username or Password."); 
}
// now that we have a successful login, the story can change.  But for now here's a generic echo statement.

echo "Login Victory.";


// when doing the change password story, destroying the TGT is accomplished by removing the KRB5Cache object from memory.

?>