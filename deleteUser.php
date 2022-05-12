<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#connects to database
require ( 'include/connect_db.php' ) ;

#if genre_id is set it is set set toa php varible
if ( isset( $_GET['user_id'] ) ) $user_id = $_GET['user_id'] ;

#a record is deleted from the database where genre_id is the same as the varivble set above 
$sql = "DELETE FROM users WHERE user_id='$user_id'";
 if ($link->query($sql) === TRUE) {
       header("Location: adminUser.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
	?>