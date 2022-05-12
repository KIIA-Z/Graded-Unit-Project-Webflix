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
	<div class="container">
			<div style="text-align:center">
				<div class="card card-default" style="width: 18rem;">
                     <a href="addMovie.php" class="btn btn-secondary btn-block" role="button">Add a Movie +</a>
                </div>
            </div>
	</div>

<?php

# Retrieve items from 'bookings' database table and display results in while loop.
$q = "SELECT * FROM movie ORDER BY id ASC" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo '<div class="alert alert-dark" role="alert">
<h4 class="alert-heading">' . $row['movie_title'] . '  </h4>
<p>Movie ID:  ' . $row['id'] . '</p>
<p>Movie Genre:  ' . $row['genre'] . '</p>
<p>Movie Description:  ' . $row['further_info'] . '</p>
<p>Movie Release Year:  ' . $row['release_year'] . '</p>
<p>Movie Language:  ' . $row['language'] . '</p>
<p>Movie Length:  ' . $row['movie_length'] . '</p>
<p>Image location:  ' . $row['img'] . '</p>
<p>Movie Trailer:  ' . $row['preview'] . '</p>
<p>Movie Link:  ' . $row['movie_link'] . '</p>
<hr>
<footer class="blockquote-footer">
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="deleteMovie.php?moive_id='.$row['id'].'"> <i class="fas fa-trash-alt"></i>  Delete Movie </a><br>
</div>
<div class="alert alert-secondary" role="alert">
<a  class="alert-link" href="editMovie.php?movie_id='.$row['id'].'"> <i class="fas fa-trash-alt"></i>  Edit Movie </a><br>
</footer>
</div>
			
';  
  }
  }
  #else admin is told there are no movies to display
else { echo '<div class="container">
<br>
<div class="alert alert-secondary" role="alert">
<p>There are no movies to edit!</p>
</div>
<div> ' ; }

#database connection closed
mysqli_close( $link) ; 

  #display footer
  include ( 'include/footer.html' ) ;
?>
