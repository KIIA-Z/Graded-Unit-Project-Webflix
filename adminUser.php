<?php 
# Access session.
session_start();

#display navbar
include ( 'include/home.html' ) ;
# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

require ( 'include/connect_db.php' ) ;

# Retrieve items from 'bookings' database table and displays the results in a while loop.
$q = "SELECT * FROM users ORDER BY user_id ASC" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo '<div class="alert alert-dark" role="alert">
<h4 class="alert-heading">User ID: ' . $row['user_id'] . ' </h4>
<p>User Name:  ' . $row['first_name'] . ' ' . $row['last_name'] . '</p>
<p>Email:  ' . $row['email'] . '</p>
<p>Date Of Birth:  ' . $row['DOB'] . '</p>
<p>Contact Number:  ' . $row['contact_number' ] . '</p>
<p>Country:  ' . $row['country'] . '</p>
<p>Join Date:  ' . $row['join_date'] . '</p>
<p>Acount State:  ' . $row['status'] . '</p>
<hr>
<footer class="blockquote-footer">
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="deleteUser.php?user_id='.$row['user_id'].'"> <i class="fas fa-trash-alt"></i>  Delete User Details </a><br>
</div>
</footer>
</div>
			
';  
  }
  }
  #else the admin is told there are no users to display
else { echo '<div class="container">
<br>
<div class="alert alert-secondary" role="alert">
<p>There are no movies to edit!</p>
</div>
<div> ' ; }

#closes database connection.
mysqli_close( $link) ; 

#displays footer.
  include ( 'include/footer.html' ) ;
?>
