<?php
require_once("../etc/creds.php");
require_once("../classes/User.php");
/* This is the first time user signup process.
 * Some user data is collected, a nonce is generated
 * for the email verification process, and a database row is added
 * to reflect the new user. */
// $_POST data from user
$email 		= $_POST["email"];
/* Passwords aren't actually necessary at this stage.
$password1 	= $_POST["password1"];
$password2	= $_POST["password2"];

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
// bind the sanitized input to the query.  bind_param can't take method calls, thus the variables

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
	exit;
}

catch(Exception $exception)
{
	// this only runs if we have a non-mySQL exception
	echo "Exception encountered: " . $exception->getMessage();
	exit;
}

// since I expect exactly one result the program will halt and throw an exception if zero or more than one is returned.
// throws if email already taken or bad query.
if($mysql->affected_rows !== 1)
{
	echo "Invalid username or password.";
	throw new Exception("Invalid username or password.");
}
// free up resources

$statement->close();
$mysql->close();

// let the user know something happened
/* Mails link for verification
 * input: email string, nonce string
 * output: none
 * throws: if email not sent    */
function mailVLink($email, $nonce)
{
	$link = ("http://students.deepdivecoders.com/~jordan/capstone_2/registration/signup.php?nonce=" . $nonce);
	$delivery = mail($email, "NM Business Hub Registration",
	"Hello! \r\n
	Thank you for signing up for NMBN. \r\n
	To verify your email and complete the process, copy the following url into your browser: 
	\r\n"
	. $link . 
	"\r\n
	If you feel you have received this email by mistake, disregard this message.");
	if ($delivery !== true)
	{
		throw new Exception ("Mail not sent.");
	}
}
mailVlink($email, $r);

echo "Sign up complete.  Please finish the registration process by checking the email you entered and clicking the link provided.";
// continue email process here.  An email should fire to the respective user.

?>