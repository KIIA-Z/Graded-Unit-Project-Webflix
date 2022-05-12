<?php
# Access session.
session_start();

#connects to database
require ( 'include/connect_db.php' ) ;

#sets varible to session data
$_SESSION[ 'user_id' ] = $id  ;

#checks if user is admin level or not
$sql = "select * from users where user_id = '$id'";
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );
$row[ 'subscription_type' ] = $sub_type ;
  mysqli_close($link);
}
exit();
?>