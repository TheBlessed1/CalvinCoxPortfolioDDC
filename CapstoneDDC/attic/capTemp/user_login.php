<?php
require_once("Users.php");

$login = htmlentities($_POST["email"]);

// sanitization of this input will occur here  TRUST NO USER FIXME

// query the database for the email the user provides

$mysql = new mysqli(/*FIXME with connection details*/);

$query = "SELECT email, password, salt, userId FROM users WHERE email = ?";

$statement = $mysql->prepare($query);
if($statement !== true)
{
	throw new Exception("Invalid username or password.");
}
// bind the sanitized input to the query

$statement->bind_param("s", $login);

// engage!

$statement->execute;

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
$user = new Users($row["email"], $row["password"], $row["salt"], $row["userId"]);

// enter object oriented paradigm HERE

// isLoggedIn calls Users method matchPasswordHash with clear text data and returns either true, or throws an exception.

$isLoggedIn = $user->matchPasswordHash($_POST["password"]);

if($isLoggedIn !== true)
{
	throw new Exception("Invalid Username or Password."); 
}

// now that we have a successful login, the story can change.  But for now here's a generic echo statement.

echo "Login Victory.";

?>