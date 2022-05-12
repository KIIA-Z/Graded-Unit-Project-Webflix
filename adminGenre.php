<?php 
 
# Access session.
session_start();

#displayes navbar
include ( 'include/home.html' ) ;
# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#connects to database
require ( 'include/connect_db.php' ) ;


?>
			<div style="text-align:center">
				<div class="card card-default" style="width: 18rem;">
                     <a href="addGenre.php" class="btn btn-secondary btn-block" role="button">Add a Genre+</a>
                </div>
            </div>

<?php
# Retrieve items from 'bookings' database table.
$q = "SELECT * FROM genre ORDER BY genre_ID ASC" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	#Each genre in database is displayed with while loop
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo '<div class="alert alert-dark" role="alert">
            <h4 class="alert-heading">Genre name: ' . $row['name'] . '  </h4>
<p>Genre ID: '  . $row['genre_ID'] . '</p>
<hr>
<footer class="blockquote-footer">
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="deleteGenre.php?genre_ID='.$row['genre_ID'].'"> <i class="fas fa-trash-alt"></i>  Delete Genre </a><br>
</div>
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="editGenre.php?genre_ID='.$row['genre_ID'].'"> <i class="fas fa-trash-alt"></i>  Edit Genre </a><br>
</footer>
</div>
			
';  
  }
  }
else { echo '<div class="container">
<br>
<div class="alert alert-secondary" role="alert">
<p>There are no genres to edit\delete!</p>
</div>
<div> ' ; }

#close database connection
mysqli_close( $link) ; 

  #display footer
  include ( 'include/footer.html' ) ;
?>
