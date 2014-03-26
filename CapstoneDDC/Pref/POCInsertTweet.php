<?php
require_once("UserTweet.php");
/*connect to mySQL and prepare statement
 *insert tweetID (aka productId) into UserTweet table (aka profiles_meta)
 *hard coding search parameter as POC until form is built form user*/

$mysql		= new mysqli("localhost", "u5m1", "1CODingF\$\$L", "u5m1");
$query 		= "UPDATE profiles_meta SET productId=? WHERE profileId=2";
$statement	= $mysql->prepare($query);
if($statement === false)
{
	throw(new Exception("unable to prepare mySQL statement"));
}
$p = 55;
$statement->bind_param("i", $p);
$statement->execute();
$result = $statement->get_result();
echo "Affected rows (UPDATE):  ", mysqli_affected_rows($mysql);

/*if($result->num_rows !==1)
{
	throw(new Exception("unable to retrieve row 51"));
}*/
?>

