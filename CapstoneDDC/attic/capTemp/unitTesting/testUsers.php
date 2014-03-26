<?php 
require_once("/usr/lib/php5/simpletest/autorun.php");
require_once("../classes/Users.php");

class TestUserModel extends UnitTestCase
{
	function testValidConstructUsers()
	{
		//expectations
		
		//setup
		
		$newEmail 	= "JimBeam@aol.com";
		$newPassword 	= "2ea65bf8ad4e0f687bf73f5960cab9719eb92b6ad6777a8a3d676e1b197c38fd2b9e2417a0f998ab8688c1a4ccee138eb20421e9632a09fb523e9306212af83f";
		$newSalt		= "ba7785d72ba1eb7b52c1874d4612a7ac4cd1ee257973baca69539459b07f64e3";
		$newUserId	= 4059;
		$user          = new Users($newEmail,$newPassword,$newSalt,$newUserId);
		//asserts
		
		$this->assertIsA($user, "Users");
		$this->assertNotNull($user);
		
		$this->assertIsA($user->getPassword(), "string");
		$this->assertIsA($user->getSalt(), "string");
		$this->assertIsA($user->getUserId(), "int");
		$this->assertFalse($user->getUserId() <= 0);
		$this->assertIsA($user->getEmail(), "string");
	}
	/* function testFoo()
	{
		//expectations, if any
		
		//setup, I probably have to build an object, or call some static method
		
		//asserts, this is what I want to be the case for this particular test.
		$object = new Object($y);
		$object->TestedMethod($y);
		$this->assertBLarg;
	} */
	
	function testCreateSalt()
	{
		//expectations
		
		//setup
		
		$salt = Users::createSalt();
		$p = "/^[0-9a-fA-F]{64}$/";
		
		//asserts
		
		$this->assertNotNull($salt);
		$this->assertIsA($salt, "string");
		$this->assertPattern($p, $salt);
	}
	
	// some fixed password for testing
	function testMatchPasswordHash()
	
	{
		//expectations
		
		//setup
		
		$newEmail 		= "JimBeam@aol.com";
		$newPassword 		= "2ea65bf8ad4e0f687bf73f5960cab9719eb92b6ad6777a8a3d676e1b197c38fd2b9e2417a0f998ab8688c1a4ccee138eb20421e9632a09fb523e9306212af83f";
		$newSalt			= "ba7785d72ba1eb7b52c1874d4612a7ac4cd1ee257973baca69539459b07f64e3";
		$newUserId		= 4059;
		$user          	= new Users($newEmail,$newPassword,$newSalt,$newUserId);
		$clearPassword 	= "abc123";
		
		// asserts
		
		$this->assertIdentical($newPassword, $user->getPassword());
		$this->assertIdentical($user->matchPasswordHash($clearPassword), true);
	}
	
	function testFailedMatchPasswordHash()
	{
		//expectations
		
		$this->expectException("Exception");
		
		//setup
		
		$newEmail 		= "JimBeam@aol.com";
		$newPassword 		= "2ea65bf8ad4e0f687bf73f5960cab9719eb92b6ad6777a8a3d676e1b197c38fd2b9e2417a0f998ab8688c1a4ccee138eb20421e9632a09fb523e9306212af83f";
		$newSalt			= "ba7785d72ba1eb7b52c1874d4612a7ac4cd1ee257973baca69539459b07f64e3";
		$newUserId		= 4059;
		$user          	= new Users($newEmail,$newPassword,$newSalt,$newUserId);
		$clearPassword 	= "ABC123";
		$user->matchPasswordHash($clearPassword);
		
		// asserts
		
	}
	
	function testInvalidConstructUsers()
	{	
		//expectations
		
		$this->expectException("Exception");

		//setup
		
		$newEmail 	= "JimBeam/aol-com";
		$newPassword 	= "zzzzz2ea65bf8ad4e0f687bf73f5960cab9719eb92b6ad6777a8a3d676e1b197c38fd2b9e2417a0f998ab8688c1a4ccee138eb20421e9632a09fb523e9306212af83f";
		$newSalt		= "xxxxxba7785d72ba1eb7b52c1874d4612a7ac4cd1ee257973baca69539459b07f64e3";
		$newUserId	= "4059";
		new Users($newEmail,$newPassword,$newSalt,$newUserId);
		
		//asserts
		
	}
	
	function testNullConstructUsers()
	{
		//expectations
		
		$this->expectException("Exception");
		
		//setup
		
		$newEmail 	= null;
		$newPassword 	= null;
		$newSalt		= null;
		$newUserId	= null;
		new Users($newEmail,$newPassword,$newSalt,$newUserId);
		
		//asserts
	}
}
?>