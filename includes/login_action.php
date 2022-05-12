<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
# Open database connection.
require('include/connect_db.php');
# Get connection, load, and validate functions.
require('include/login_tools.php');
# Check login.
  list( $check, $data ) = validate( $link, $_POST[ 'email' ], $_POST[ 'pass' ] ) ; 
# On success set session data and display logged in page or assign an error message.
if($check)
	{
	# Access session.
	session_start();
	$_SESSION['user_id']= $data['user_id'];
	$_SESSION['first_name']= $data['first_name'];
	$_SESSION['last_name']= $data['last_name'];
	$_SESSION['user_level']= $data['user_level'];
	$_SESSION['subscription_type']= $data['subscription_type'];
	load('home.php');
	}
# Or on failure set errors
else{$errors = $data;}
# Close database connection.
mysqli_close($link);
}
?>
