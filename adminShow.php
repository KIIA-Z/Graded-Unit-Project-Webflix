<?php 
 
# Access session.
session_start();

#display navbar
include ( 'include/home.html' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#connect to database
require ( 'include/connect_db.php' ) ;

?>
			<div style="text-align:center">
				<div class="card card-default" style="width: 18rem;">
                     <a href="addShow.php" class="btn btn-secondary btn-block" role="button">Add a Genre+</a>
                </div>
            </div>

<?php
# Retrieve items from 'bookings' database table and displays them with while loop.
$q = "SELECT * FROM shows ORDER BY id ASC" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo '<div class="alert alert-dark" role="alert">
<h4 class="alert-heading">' . $row['show_title'] . '  </h4>
<p>TV Show ID:  ' . $row['id'] . '</p>
<p>Genre:  ' . $row['genre'] . '</p>
<p>Description:  ' . $row['further_info'] . '</p>
<p>Image Location:  ' . $row['img'] . '</p>
<p>Release Year:  ' . $row['release_year'] . '</p>
<p>TV Show Language:  ' . $row['language'] . '</p>
<p>Number Of Episodes:  ' . $row['num_seasons'] . '</p>
<p>Number Of Episodes:  ' . $row['num_episodes'] . '</p>
<p>Trailer:  ' . $row['preview'] . '</p>
<p>TV Show Link:  ' . $row['show_link'] . '</p>
<hr>
<footer class="blockquote-footer">
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="deleteShow.php?show_id='.$row['id'].'"> <i class="fas fa-trash-alt"></i>  Delete TV Show </a><br>
</div>
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="editShow.php?show_id='.$row['id'].'"> <i class="fas fa-trash-alt"></i>  Edit TV Show </a><br>
</footer>
</div>
			
';  
  }
  }
  #or the admin is told there are no shows to display.
else { echo '<div class="container">
<br>
<div class="alert alert-secondary" role="alert">
<p>There are no tv shows to edit!</p>
</div>
<div> ' ; }

#close database connection.
mysqli_close( $link) ; 

  #displays footer
  include ( 'include/footer.html' ) ;
?>
