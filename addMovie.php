<?php 

#If Statment stops code from running until the submit button is pressed 
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
 {$errors[] = 'A Movie Title must be entered to update record';}
else
{$title = mysqli_real_escape_string($link2,trim( $_POST['movie_title']));}

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

 # Check for a preview.
 if( empty($_POST[ 'preview' ]))
 {$errors[] = 'A Preview must be entered to update record';}
else
{$preview = mysqli_real_escape_string($link2,trim( $_POST['preview']));}

 # Check if id is already used.
 if(empty($errors))
 {
	 $q ="SELECT id FROM movie WHERE id='$id'";
	 $r=@mysqli_query($link, $q);
	 if(mysqli_num_rows($r)!=0){$errors[]='<h1>Movie ID already taken.</h1><br> Please try a diffrent ID value';}
 }

}
 
# Access session.
session_start();
 
 #displays the navbar
include ( 'include/home.html' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


#Conects to the Database
require ( 'include/connect_db.php' ) ;
?>

<div class="container">
<div style="text-align:center">
<h1>Add a Movie Record </h1>
<form id = "editMovie" action="addMovie.php" method ="post">
  <div class="form-group"
    <label for="exampleInputEmail1">Movie ID: </label>
    <input type="text" name="id" size="25" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Movie Title: </label>
    <input type="text" name="movie_title" size="25" value="<?php if (isset($_POST['movie_title'])) echo $_POST['movie_title']; ?>">
  </div>
  <div class="form-group">
  <div style="text-align:center">
    <label for="exampleFormControlTextarea1">Movie Descriptiopn: </label>
    <textarea name="further_info" class="form-control" id="further_info" rows="3"><?php if (isset($_POST['further_info'])) echo $_POST['further_info']; ?></textarea>
	</div>
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image Location Name: </label>
    <input type="text" name="img" size="25" value="<?php if (isset($_POST['img'])) echo $_POST['img']; ?>">
	</div>
<div class="form-group">
    <label for="exampleInputPassword1">Trailer: </label>
    <input type="text" name="preview" size="25" value="<?php if (isset($_POST['preview'])) echo $_POST['preview']; ?>">
</div>
<button type="submit" class="btn btn-default">Add Movie</button>
</form> 
  			

<?php 
# On success register user inserting into 'users' database table.
 if (empty($errors))
 {
$sql = "INSERT INTO movie( id, movie_title, further_info, img, preview) VALUES ('$id', '$title','$further_info','$img','$preview')";
$r= @mysqli_query( $link, $sql );

#if SQL connection is successful admin is taken back to the admin Movie Page
 if($r && $pass == 1)
{
	header("Location: adminMovie.php");
	mysqli_close( $link) ; 
}
#or the data base connection is closed
else
{
	mysqli_close($link);
	exit();
}
 }
 #displayed errors if there are any
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
