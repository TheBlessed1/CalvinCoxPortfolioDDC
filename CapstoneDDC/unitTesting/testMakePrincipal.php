<?php
require_once("creds.php");
require_once("User.php");

/* This small script will create a new kerberos principal upon the initial signup.
 * It will take a password form's two inputs, the users password, check it, and create
 * a principal based on that information.  This will require the user's email as an input. */
$email 		= "jamestkirk@starfleet.com";
$newPassword1 	= "Khaaaaaaaaaaaaaaaaan1";
$newPassword2 	= "Khaaaaaaaaaaaaaaaaan1";
// passwords must match, be at least 8 characters, contain 1 number, one capital letter, and one lowercase letter
$p1 = "/.{8,}/";
$p2 = "/\d+/";
$p3 = "/[a-z]+/";
$p4 = "/[A-Z]+/";
if( ($newPassword1 !== $newPassword2) 		
||  (preg_match($p1, $newPassword1) !== 1)
||  (preg_match($p2, $newPassword1) !== 1)
||  (preg_match($p3, $newPassword1) !== 1)
||  (preg_match($p4, $newPassword1) !== 1) )
{
	throw new Exception("Invalid new password.");
}
// fetch userId via a mySQL query

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

$statement->bind_param("s", $email);

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
	echo "Regular Exception encountered: " . $exception->getMessage();
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
// object
$user = new User($row["email"], $row["nonce"], $row["userId"]);

$princName = "webUser" . $user->getUserId() . "/capstonesite@STUDENTS.DEEPDIVECODERS.COM";
$princ = new KADM5Principal($princName);
$conn = new KADM5($KERBEROS_PRINCIPAL, $KERBEROS_KEY, true);
// this method call returns null, thus I have to verify that the creation took place by fetching the name
$conn->createPrincipal($princ, $newPassword1);
$hasCreatedPrincipal = $conn->getPrincipal($princName);

if($hasCreatedPrincipal->getName() !== $princName)
{
	throw new Exception ("Failed to create account.");
}
echo "Victory!";

?>