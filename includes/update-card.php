<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login.php' ) ; load() ; }
# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('include/connect_db.php');
  # Initialize an error array.
  $errors = array();
# Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }
# Check for a card number:
if ( empty( $_POST[ 'card_number' ] ) )
  { $errors[] = 'Enter the card number.'; }
  else
  { $card_no = mysqli_real_escape_string( $link, trim( $_POST[ 'card_number' ] ) ) ; }
# Check for an expiry month :
if ( empty( $_POST[ 'exp_month' ] ) )
  { $errors[] = 'Enter the cards expiry month date.'; }
  else
  { $exp_m = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_month' ] ) ) ; }
# Check for an expiry eyar :
if ( empty( $_POST[ 'exp_year' ] ) )
  { $errors[] = 'Enter the cards expiry year date.'; }
  else
  { $exp_y = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_year' ] ) ) ; }
# Check for an cvv :
if ( empty( $_POST[ 'cvv' ] ) )
  { $errors[] = 'Enter the cards cvv.'; }
  else
  { $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }
# Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT * FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $link, $q ) ;
    }
# On success new password into 'users' database table.
  if ( empty( $errors ) ) 
  {
   # $q = "UPDATE users SET (card_number, exp_month, exp_year, cvv) VALUES ('$card_no','$exp_m','$exp_y','$cvv') WHERE email='$e'";
	$q = "UPDATE users SET card_number = '$card_no' WHERE email='$e'";
    $r = @mysqli_query ( $link, $q ) ;
	$q = "UPDATE users SET exp_month = '$exp_m' WHERE email='$e'";
    $r = @mysqli_query ( $link, $q ) ;
	$q = "UPDATE users SET exp_year = '$exp_y' WHERE email='$e'";
    $r = @mysqli_query ( $link, $q ) ;
	$q = "UPDATE users SET cvv = '$cvv' WHERE email='$e'";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    {
       header("Location: user.php");
    } else {
        echo "Error updating record: " . $link->error;
    }
# Close database connection.
    
	mysqli_close($link); 
    exit();
  }
  # Or report errors.
  else 
  {  
    echo ' <div class="container"><div class="alert alert-dark alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
	<h1><strong>Error!</strong></h1><p>The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</div></div>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>

