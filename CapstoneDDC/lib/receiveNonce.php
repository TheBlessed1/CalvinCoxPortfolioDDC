<?php
require_once ("../classes/User.php");
require_once("../etc/creds.php");
/* Checks url for nonce
 * input: none
 * output: Verification url
 *throws if not a Nonce by regex*/
function checkURLForNonce()
{
	$urlNonce = urldecode($_GET("nonce"));
	$p = "/^[0-9a-fA-F]{64}$/";
	if(preg_match($p, $urlNonce) !== 1)
	{
		throw new Exception("URL nonce has invalid Nuance(s)");
	}
	else
	{
		return $urlNonce;
	}
}

// VERIFY ALL THE NONCES (VIA MYSQL)
/*br*br*br*br*br*/


// NEXT SECTION MYSQLing
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
	$mysql = new mysqli("localhost", $MYSQL_APP, $MYSQL_CREDENTIALS, 'capstone');
	$clearNonce = "UPDATE user SET nonce = NULL WHERE user.nonce = ?";

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
?>