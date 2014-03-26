<?php
require_once("../classes/User.php");
require_once("../etc/creds.php");

/*The change password sequence.
 * The user enters his email.
 * The user enters his old password, and his new password twice.
 * System checks the password against itself.
 * Query generated based on email.
 * row returned, User object created
 * principal name generated
 * kerberos object created and authenticated
 * TGT generated for user
 * password changed
 * TGT destroyed, and session ended.
 * password changed. */
$email 		= $_POST["email"];
$oldPassword 	= $_POST["oldPassword"];
$newPassword1	= $_POST["newPassword1"];
$newPassword2	= $_POST["newPassword2"];
// passwords must match, be at least 8 characters, contain 1 number, one capital letter, and one lowercase letter
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

// make a query based on the email user input.

mysqli_report(MYSQLI_REPORT_STRICT);

try
{
$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS, 'capstone');

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
	exit;
}

catch(Exception $e)
{
	// this only runs if we have a non-mySQL exception
	echo "Exception encountered: " . $exception->getMessage();
	exit;
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

// created user object from row data

$user = new User($row["email"], $row["nonce"], $row["userId"]);

// make sure user is registered

if($user->getNonce() !== null)
{
	throw new Exception ("Please complete the registration process prior to changing your password.");
}


// create principal name from user row

$princName = "webUser" . $user->getUserId() . "/capstonesite@STUDENTS.DEEPDIVECODERS.COM";

// create principal name from user row

$princName = "webUser" . $user->getUserId() . "/capstonesite@STUDENTS.DEEPDIVECODERS.COM";

// Give principal a TGT
try
{
	$ticket = new KRB5CCache();

	// initPassword will return bool true on success or throw an exception on failure.

	$isLoggedIn = $ticket->initPassword($princName, $oldPassword);

	if ($isLoggedIn !== true)
	{
		throw new Exception ("Invalid username or password.");
	}
	$princ = new KADM5Principal($princName);

	$conn = new KADM5($KERBEROS_PRINCIPAL, $KERBEROS_KEY, true);

	// obtain principal in question.

	$hasChangedPassword = $conn->getPrincipal($princName);
	// change the password; I expect this to resolve true on success.

	// two-step in the if block, changePassword is a method within KADM5->getPrincipal; resolves true on success
	if ($hasChangedPassword->changePassword($newPassword1) !== true)
	{
		throw new Exception ("Password was not changed.");
	}
}
catch(Exception $e)
{
	echo "Kerberos Error.";
	$ticket= null;
	session_destroy();
	exit;
}
// kill ticket
$ticket = null;
echo "Change password victory.  Please log in with your new password.";

?>