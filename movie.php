<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'include/login.php' ) ; load() ; } 

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) {$id = $_GET['id'] ;}

# Open database connection.
require ( 'include/connect_db.php' ) ;

#
include ( 'include/home.html' ) ;

$sub_type = $_SESSION[ 'subscription_type' ] ;
echo $sub_type;

# Retrieve selective item data from 'movie' database table and displays results with link for user to pay for subscription because theyre a free user.  
$q = "SELECT * FROM movie WHERE id = '$id'" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );
if( $sub_type == 0 ){
    echo '        
		<div class="container-fluid">
          <div class="row">
          <div class="col-sm-12 col-md-1">
          </div>
          <div class="col-sm-12 col-md-6">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="'. $row['preview'].'" frameborder="0" allow="autoplay; 
          encrypted-media; 
          gyroscope; 
          picture-in-picture" allowfullscreen="">
          </iframe>
          </div>
          </div> 
          <div class="col-sm-12 col-md-4">
          <h1>'.$row['movie_title'].'</h1>
          <hr>
          <p>'. $row['further_info'].'</p>
          <table class="table table-striped"
          <tbody>
          <tr>
          <td><h6>Genre(s)</h6></td>
          <td><h6>'. $row['genre'].'</h6></td>
          </tr>
          <tr>
          <td><h6>Release Date</h6></td>
          <td><h6>'. $row['release_year'].'</h6></td>
          </tr>
          <tr>
          <tr>
          <td><h6>Movie Length</h6></td>
          <td><h6>'. $row['movie_length'] . '</h6></td>
          </tr>
		  <tr>
          <td><h6>Language</h6></td>
          <td><h6>'. $row['language'] . '</h6></td>
          </tr>
          </tbody>
          </table>
          <hr>
          <a href="payment.php"> <button type="button" class="btn btn-secondary btn-block" role="button"><h3>Purchase premium</h3></button></a>
              </div> '; 
              
  }
  #or displays same thing with a link to the movie 
else
  {
echo'<div class="container-fluid">
          <div class="row">
          <div class="col-sm-12 col-md-1">
          </div>
          <div class="col-sm-12 col-md-6">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="'. $row['preview'].'" frameborder="0" allow="autoplay; 
          encrypted-media; 
          gyroscope; 
          picture-in-picture" allowfullscreen="">
          </iframe>
          </div>
          </div> 
          <div class="col-sm-12 col-md-4">
          <h1>'. $row['movie_title'].'</h1>
          <hr>
          <p>'. $row['further_info'].'</p>
          <table class="table table-striped"
          <tbody>
          <tr>
          <td><h6>Genre(s)</h6></td>
          <td><h6>'. $row['genre'].'</h6></td>
          </tr>
          <tr>
          <td><h6>Release Date</h6></td>
          <td><h6>'. $row['release_year'].'</h6></td>
          </tr>
          <tr>
          <td><h6>Movie Length</h6></td>
          <td><h6>'. $row['movie_length'] . '</h6></td>
          </tr>
		  <tr>
          <td><h6>Language</h6></td>
          <td><h6>'. $row['language'] . '</h6></td>
          </tr>
          </tbody>
          </table>
          <hr>
		   <a href="'. $row['movie_link'] . '"> <button type="button" class="btn btn-secondary btn-block" role="button"><h3>Watch Content</h3></button></a>
              </div> ';
        
  }
}

# Close database connection.
mysqli_close($link);


# Display footer section.
include ( 'include/footer.html' ) ;
?>