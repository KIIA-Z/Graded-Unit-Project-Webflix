  <?php # DISPLAY COMPLETE LOGGED IN PAGE.
# Access session.
session_start();
include ( 'include/home.html' ) ;
# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


require ( 'include/connect_db.php' ) ;

# Retrieve items from 'bookings' database table.
$q = "SELECT * FROM booking_contents, movie WHERE booking_contents.id = movie.id 
ORDER BY booking_id DESC" ;

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {

echo '<div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Tickets for: ' . $row['movie_title'] . '  </h4>
<p>Number of tickets:  ' . $row['quantity'] . '</p>
<p>' . $row['message'] . '</p>
<hr>
<footer class="blockquote-footer">
<span>' . $row['first_name'] .' '. $row['last_name'] . '</span> 
<br>
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="delete_bookings.php?booking_id='.$row['booking_id'].'"> <i class="fas fa-trash-alt"></i>  Remove Booking</a><br>
</footer>
</div>
			
';  
  }
  }
else { echo '<div class="container">
<br>
<div class="alert alert-secondary" role="alert">
<p>You have no movie bookings</p>
</div>
<div> ' ; }

mysqli_close( $link) ; 

  include ( 'include/footer.html' ) ;
?>
