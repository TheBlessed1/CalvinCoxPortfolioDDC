<?php
require_once("../etc/creds.php");
require_once("../classes/User.php");
/* Checks url for a good nonce
 * input: none
 * output: Verification url
 *throws if not a Nonce by regex*/
function checkURLForNonce($urlNonce)
{
	$p = "/^[0-9a-fA-F]{64}$/";
	if(preg_match($p, $urlNonce) !== 1)
	{
		throw new Exception("Please check registration link.");
	}
	else
	{
		return($urlNonce);
	}
}
/* This script will create a new kerberos principal upon the initial signup.
 * It will take a password form's two inputs, the users password, check it, and create
 * a principal based on that information.  This will require the user's email as an input.
 * This script fires in the context of the user clicking on a regstration link sent via e-mail
 * which contains a get parameter.  This get parameter is checked against a database query based
 * on the user's email.  If everything matches up, the nonce is removed from the user's row, 
 * indicating the user is registered, and a Kerberos principal is subsequently created. */
$email 	    = $_POST["email"];
$newPassword1 = $_POST["password1"];
$newPassword2 = $_POST["password2"];
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

// execute statement, check results

$statement->execute();

$result = $statement->get_result();

// since I expect exactly one result the program will halt and throw an exception if zero or more than one is returned.

if($result->num_rows !== 1)
{
	echo "Invalid username or password.";
	throw new Exception("Invalid username or password.");
}

// create object from this query

$row = $result->fetch_assoc();
// free up resources, but keep the connection
$result->free();
$statement->close();
// object created.  Needed for userId, and nonce verification.
$user = new User($row["email"], $row["nonce"], $row["userId"]);

// clearing the nonce from the user

$clearNonce = "UPDATE user SET nonce = NULL WHERE user.nonce = ?";

// grab nonce from $_POST parameter

$urlNonce = checkURLForNonce($_POST["nonce"]);

// verify url nonce matches the nonce from the database

$checkNonce = $user->getNonce();

if($checkNonce !== $urlNonce)
{
	throw new Exception ("Verify registration link.");
}

// if everything matched up OK, proceed.

$statement = $mysql->prepare($clearNonce);

$statement->bind_param("s", $urlNonce);

// execute statement, verify exactly one row affected in this process.

$statement->execute();

if($mysql->affected_rows !== 1 )
	{
		throw new Exception("Invalid username or password.");
	}	
}
catch(mysqli_sql_exception $mysqlException)
{
	// this only runs if mySQL had a problem
	echo "mySQL exception encountered: " . $mysqlException->getMessage();
	exit;
}

catch(Exception $exception)
{
	// this only runs if we have a non-mySQL exception
	echo "Normal Exception encountered: " . $exception->getMessage();
	exit;
}

// creation of Kerberos principal

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
// I'm keeping the connection to mysql the entire process.
$mysql->close();

// if we made it this far, everything is fine

echo "User registration successful.  Redirecting to login page.";
header( 'Location: http://students.deepdivecoders.com/~jordan/capstone_2/registration/login.php', true, 301);
die();

?>