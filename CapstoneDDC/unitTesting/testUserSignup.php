<?php
require_once("creds.php");
require_once("User.php");
/* This is the first time user signup process.
 * Some user data is collected, a nonce is generated
 * for the email verification process, and a database row is added
 * to reflect the new user.  This script will NOT fire twice unless the email is modified
 * this is because email must be unique. */
// $_POST data from user
$email 		= "jamestkirk@starfleet.com";

/* passwords not necessary at this step
$password1 	= "Abcdefg123";
$password2	= "Abcdefg123";

// check password match and meets standards

$p1 = "/.{8,}/";
$p2 = "/\d+/";
$p3 = "/[a-z]+/";
$p4 = "/[A-Z]+/";
if( ($password1  !== $password2) 		
||  (preg_match($p1, $newPassword1) !== 1)
||  (preg_match($p2, $newPassword1) !== 1)
||  (preg_match($p3, $newPassword1) !== 1)
||  (preg_match($p4, $newPassword1) !== 1) )
{
	throw new Exception("Invalid new password.");
}
*/
// after the password passes minimum standards, a nonce is generated for inclusion in the data row.

$nonce = bin2hex(openssl_random_pseudo_bytes(32));

// Objects start here
// the userID is a junk value
$user = new User($email, $nonce, 1337);
// genereate a query to update the user database
mysqli_report(MYSQLI_REPORT_STRICT);

try
{
$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS , 'capstone');

$query = "INSERT INTO user (email, nonce) VALUES(? , ?)";

$statement = $mysql->prepare($query);
	if($statement === false)
	{
		throw new Exception("Invalid username or password.");
	}
// bind the sanitized input to the query
$q = $user->getEmail();
$r = $user->getNonce();

$statement->bind_param("ss", $q, $r);

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

// since I expect exactly one result the program will halt and throw an exception if zero or more than one is returned.
// this exception will be thrown if the e-mail was already used as well.
if($mysql->affected_rows !== 1)
{
	echo "Invalid username or password.";
	throw new Exception("Invalid username or password.");
}
// free up resources

$statement->close();
$mysql->close();

// let the user know something happened

echo "Sign up complete.  Please finish the registration process by checking the email account you use to login and clicking the link provided.";
// include email continuance here
?>