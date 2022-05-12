<?php 
ob_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
$link2 = mysqli_connect
	('localhost','HNCSOFTSA3','j4H3E40Pb0','HNCSOFTSA3');
	if(!$link2){
		die('Could not connect to mySQL: ' .mysqli_error());
	}
	
 #Initialize an error array.
$errors = array();
$pass = 1; 
 
 # Check for a movie ID.
 if( empty($_POST[ 'id' ]))
 {$errors[] = 'An ID number must be entered to update record';}
else
{$id = mysqli_real_escape_string($link2,trim( $_POST['id']));}

 # Check for a movie title.
 if( empty($_POST[ 'movie_title' ]))
 {$errors[] = 'A TV movie Title must be entered to update record';}
else
{$title = mysqli_real_escape_string($link2,trim( $_POST['movie_title']));}

 # Check for a genre.
 if( empty($_POST[ 'genre' ]))
 {$errors[] = 'A genre must be entered to update record';}
else
{$genre = mysqli_real_escape_string($link2,trim( $_POST['genre']));}

 # Check for a description.
 if( empty($_POST[ 'further_info' ]))
 {$errors[] = 'A Description must be entered to update record';}
else
{$further_info = mysqli_real_escape_string($link2,trim( $_POST['further_info']));}

 # Check for a img.
 if( empty($_POST[ 'img' ]))
 {$errors[] = 'A Image Location must be entered to update record';}
else
{$img = mysqli_real_escape_string($link2,trim( $_POST['img']));}

 # Check for a release year.
 if( empty($_POST[ 'release_year' ]))
 {$errors[] = 'A release year must be entered to update record';}
else
{$release = mysqli_real_escape_string($link2,trim( $_POST['release_year']));}

 # Check for a language.
 if( empty($_POST[ 'language' ]))
 {$errors[] = 'A Image Location must be entered to update record';}
else
{$language = mysqli_real_escape_string($link2,trim( $_POST['language']));}

 # Check for a number of language.
 if( empty($_POST[ 'length' ]))
 {$errors[] = 'A Image Location must be entered to update record';}
else
{$length = mysqli_real_escape_string($link2,trim( $_POST['length']));}


 # Check for a preview.
 if( empty($_POST[ 'preview' ]))
 {$errors[] = 'A Preview must be entered to update record';}
else
{$preview = mysqli_real_escape_string($link2,trim( $_POST['preview']));}

 # Check for a movie link.
 if( empty($_POST[ 'movie_link' ]))
 {$errors[] = 'A Preview must be entered to update record';}
else
{$movie_link = mysqli_real_escape_string($link2,trim( $_POST['movie_link']));}

}
 
# Access session.
session_start();

#displays navbar 
include ( 'include/home.html' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#if mopvie_id is set it is set set toa php varible
if ( isset( $_GET['movie_id'] ) ) {$movie_id = $_GET['movie_id']; }

#connects to database
require ( 'include/connect_db.php' ) ;

# Retrieve items from 'movie' database table and display results in while loop.
$q = "SELECT * FROM movie WHERE id = '$movie_id'" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo' <div class="container">
      <div class="row">
      <div class="col-sm">
      </div>
      <div class="col-md">
      <div class="card card-dark mb-8">
      <div class="card-header">
      <h1 style="text-align: center">Update '. $row['movie_title'].' Record</h1>
      <hr>
      </div>
        <div class="card-body">
        <form id = "editmovie" action="editMovie.php?movie_id='.$movie_id.'" method ="post">
  <div class="form-group"
    <label for="exampleInputEmail1">Movie ID:     </label>
    <input type="text" name="id" size="25" value="'. $row['id'].'"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Movie Title:    </label>
    <input type="text" name="movie_title" size="25" value="'.$row['movie_title'].'">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Genre:        </label>
    <input type="text" name="genre" size="25" value="'.$row['genre'].'">
  </div>
  <div class="form-group row">
  <div  style="text-align:center">
    <label for="exampleFormControlTextarea1">Movie Descriptiopn:   </label>
	<tr>
    <textarea name="further_info" class="form-control" id="further_info" rows="3">'.$row['further_info'].'</textarea>
	</div>
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Location Name:      </label>
    <input type="text" name="img" size="25" value="'.$row['img'].'">
	</div>
	<div class="form-group">
    <label for="exampleInputPassword1">Release Year:      </label>
    <input type="text" name="release_year" size="25" value="'.$row['release_year'].'">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Language:      </label>
    <input type="text" name="language" size="25" value="'.$row['language'].'">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Number Of Seasons:       </label>
    <input type="text" name="length" size="25" value="'.$row['movie_length'].'">
	</div>
<div class="form-group">
    <label for="exampleInputPassword1">Trailer:        </label>
    <input type="text" name="preview" size="25" value="'.$row['preview'].'">
</div>
 <div class="form-group">
    <label for="exampleInputPassword1">Link To Movie: </label>
    <input type="text" name="movie_link" size="25" value="'.$row['movie_link'].'">
	</div>
<button type="submit" class="btn btn-default">Update Movie</button>
</form>
        </div>
      </div>
      </div>
      <div class="col-sm">
      </div>
      </div>
      </div>';
  		  
  }
}
?>

<?php 
# On success register user inserting into 'users' database table.
 if (isset($errors) && empty($errors))
 {
$sql = "UPDATE movie SET id = '$id', movie_title = '$title', genre = '$genre', further_info = '$further_info', img = '$img', release_year = '$release',
 language = '$language', movie_length = '$length', preview = '$preview', movie_link = '$movie_link'  WHERE id = '$movie_id'";
$r= @mysqli_query( $link, $sql );

 if($r && $pass == 1)
{
	header("Location: adminMovie.php");
	mysqli_close( $link) ; 
	mysqli_close( $link2) ;
		exit();
}

#else database connection is closed
else
{
	mysqli_close($link);
	mysqli_close($link2);
	exit();
}
 }
 #errors are displayed
 else
{
	echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred: <br>';
	foreach($errors as $msg)
	{echo "-$msg<br>";}
	echo 'Please try again.</p>';
	mysqli_close($link);
	}

  include ( 'include/footer.html' ) ;
?>
