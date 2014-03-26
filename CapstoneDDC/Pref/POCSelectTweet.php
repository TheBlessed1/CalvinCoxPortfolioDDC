<?php
require_once("Tweet.php");
//connect to mySQL and prepare statement
$mysql		= new mysqli("localhost", "u5m1", "1CODingF\$\$L", "u5m1");
$query 		= "SELECT productId, description, price, search FROM products_meta WHERE productId=?";
$statement	= $mysql->prepare($query);
if($statement === false)
{
	throw(new Exception("unable to prepare mySQL statement"));
}
$p = 3;
$statement->bind_param("i", $p);
$statement->execute();
$result = $statement->get_result();

while(($row = $result->fetch_assoc()) != null)
{
	$tweet = new Tweet($row["productId"], $row["description" ], $row["price"], $row["search"]);
	$tweets[] = $tweet;
}


$search=$tweet->getSearch();
/* this was for a test
 * to see if search was getting the deal 
 * echo $search;*/
return $search;
?>