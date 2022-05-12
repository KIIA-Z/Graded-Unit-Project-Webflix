<?php 
ob_start();
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
 
 # Check for a TV Show ID.
 if( empty($_POST[ 'id' ]))
 {$errors[] = 'An ID number must be entered to update record';}
else
{$id = mysqli_real_escape_string($link2,trim( $_POST['id']));}

 # Check for a TV Show title.
 if( empty($_POST[ 'show_title' ]))
 {$errors[] = 'A TV show Title must be entered to update record';}
else
{$title = mysqli_real_escape_string($link2,trim( $_POST['show_title']));}

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
 if( empty($_POST[ 'num_seasons' ]))
 {$errors[] = 'A Image Location must be entered to update record';}
else
{$num_s = mysqli_real_escape_string($link2,trim( $_POST['num_seasons']));}

 # Check for a number of episodes.
 if( empty($_POST[ 'num_episodes' ]))
 {$errors[] = 'A Image Location must be entered to update record';}
else
{$num_e = mysqli_real_escape_string($link2,trim( $_POST['num_episodes']));}

 # Check for a preview.
 if( empty($_POST[ 'preview' ]))
 {$errors[] = 'A Preview must be entered to update record';}
else
{$preview = mysqli_real_escape_string($link2,trim( $_POST['preview']));}

 # Check for a show link.
 if( empty($_POST[ 'show_link' ]))
 {$errors[] = 'A Preview must be entered to update record';}
else
{$show_link = mysqli_real_escape_string($link2,trim( $_POST['show_link']));}

}
 
# Access session.
session_start();
 
include ( 'include/home.html' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


require ( 'include/connect_db.php' ) ;
?>

<div class="container">
<div style="text-align:center">
<h1>Add TV Show Record </h1>
<form id = "addShow" action="addShow.php" method ="post">
  <div class="form-group"
    <label for="exampleInputEmail1">TV Show ID: </label>
    <input type="text" name="id" size="25" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">TV Show Title: </label>
    <input type="text" name="show_title" size="25" value="<?php if (isset($_POST['show_title'])) echo $_POST['show_title']; ?>">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Genre: </label>
    <input type="text" name="genre" size="25" value="<?php if (isset($_POST['genre'])) echo $_POST['genre']; ?>">
  </div>
  <div class="form-group row">
  <div class="col-xs-2" style="text-align:center">
  <div class="form-group"
    <label for="exampleInputEmail1">  </label>
	</div>
	  <div class="form-group"
    <label for="exampleInputEmail1">  </label>
	</div>
	  <div class="form-group"
    <label for="exampleInputEmail1">  </label>
	</div>
    <label for="exampleFormControlTextarea1">TV Show Descriptiopn: </label>
    <textarea name="further_info" class="form-control" id="further_info" rows="3"><?php if (isset($_POST['further_info'])) echo $_POST['further_info']; ?></textarea>
	</div>
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image Location Name: </label>
    <input type="text" name="img" size="25" value="<?php if (isset($_POST['img'])) echo $_POST['img']; ?>">
	</div>
	<div class="form-group">
    <label for="exampleInputPassword1">Image Release Year: </label>
    <input type="text" name="release_year" size="25" value="<?php if (isset($_POST['release_year'])) echo $_POST['release_year']; ?>">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Language: </label>
    <input type="text" name="language" size="25" value="<?php if (isset($_POST['language'])) echo $_POST['language']; ?>">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Number Of Seasons: </label>
    <input type="text" name="num_seasons" size="25" value="<?php if (isset($_POST['num_seasons'])) echo $_POST['num_seasons']; ?>">
	</div>
	 <div class="form-group">
    <label for="exampleInputPassword1">Number Of Episodes: </label>
    <input type="text" name="num_episodes" size="25" value="<?php if (isset($_POST['num_episodes'])) echo $_POST['num_episodes']; ?>">
	</div>
<div class="form-group">
    <label for="exampleInputPassword1">Trailer: </label>
    <input type="text" name="preview" size="25" value="<?php if (isset($_POST['preview'])) echo $_POST['preview']; ?>">
</div>
 <div class="form-group">
    <label for="exampleInputPassword1">Link To TV Show: </label>
    <input type="text" name="show_link" size="25" value="<?php if (isset($_POST['show_link'])) echo $_POST['show_link']; ?>">
	</div>
<button type="submit" class="btn btn-default">Add TV Show</button>
</form>

</div>
</div>

<?php

# On success register user inserting into 'users' database table.
 if (empty($errors))
 {
$sql = "INSERT INTO shows( id, show_title, genre, further_info, img, release_year, language, num_seasons, num_episodes, preview, show_link) 
VALUES ('$id', '$title', '$genre', '$further_info','$img', '$release', '$language', '$num_s', '$num_e','$preview', '$show_link')";
$r= @mysqli_query( $link, $sql );

 if($r && $pass == 1)
{
	header("Location: adminShow.php");
	mysqli_close( $link) ; 
	exit();
}

else
{
	mysqli_close($link);
	exit();
}
 }
 
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
