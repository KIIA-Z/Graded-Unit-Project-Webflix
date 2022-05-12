<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#connect to database
require ( 'include/connect_db.php' ) ;

#if genre_id is set it is set set toa php varible
if ( isset( $_GET['movie_id'] ) ) $movie_id = $_GET['movie_id'] ;

#a record is deleted from the database where genre_id is the same as the varivble set above
$sql = "DELETE FROM genre WHERE id='$movie_id'";
 if ($link->query($sql) === TRUE) {
       header("Location: adminGenre.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
	?>
