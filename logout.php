<?php # DISPLAY COMPLETE LOGGED OUT PAGE.
# Access session.
include('include/logout.html');
session_start() ;
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'include/login_tools.php' ) ; load() ; }
# Clear existing variables.
$_SESSION = array() ;
# Destroy the session.
session_destroy() ;
# Display body section.
echo '<h1>Goodbye!</h1><p>You are now logged out.</p><p><a href="login.php">Login</a></p>' ;
 include('include/footer.html');
?>
