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

#
include ( 'include/home.html' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#if show_id is set it is set set to a php varible
if ( isset( $_GET['show_id'] ) ) {$show_id = $_GET['show_id']; }

#connects top database
require ( 'include/connect_db.php' ) ;

# Retrieve items from 'shows' database table and displays the results with a while loop.
$q = "SELECT * FROM shows WHERE id = '$show_id'" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo' <div style="text-align:center">
<h1>Update '. $row['show_title'].' Record </h1>
<form id = "editShow" action="editShow.php?show_id='.$show_id.'" method ="post">
  <div class="form-group"
    <label for="exampleInputEmail1">TV Show ID: </label>
    <input type="text" name="id" size="25" value="'. $row['id'].'"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">TV Show Title: </label>
    <input type="text" name="show_title" size="25" value="'.$row['show_title'].'">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Genre: </label>
    <input type="text" name="genre" size="25" value="'.$row['genre'].'">
  </div>
  <div class="form-group row">
  <div class="col-xs-2" style="text-align:center">
    <label for="exampleFormControlTextarea1">TV Show Descriptiopn: </label>
    <textarea name="further_info" class="form-control" id="further_info" rows="3">'.$row['further_info'].'</textarea>
	</div>
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Image Location Name: </label>
    <input type="text" name="img" size="25" value="'.$row['img'].'">
	</div>
	<div class="form-group">
    <label for="exampleInputPassword1">Image Release Year: </label>
    <input type="text" name="release_year" size="25" value="'.$row['release_year'].'">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Language: </label>
    <input type="text" name="language" size="25" value="'.$row['language'].'">
	</div>
	  <div class="form-group">
    <label for="exampleInputPassword1">Number Of Seasons: </label>
    <input type="text" name="num_seasons" size="25" value="'.$row['num_seasons'].'">
	</div>
	 <div class="form-group">
    <label for="exampleInputPassword1">Number Of Episodes: </label>
    <input type="text" name="num_episodes" size="25" value="'.$row['num_episodes'].'">
	</div>
<div class="form-group">
    <label for="exampleInputPassword1">Trailer: </label>
    <input type="text" name="preview" size="25" value="'.$row['preview'].'">
</div>
 <div class="form-group">
    <label for="exampleInputPassword1">Link To TV Show: </label>
    <input type="text" name="show_link" size="25" value="'.$row['show_link'].'">
	</div>
<button type="submit" class="btn btn-default">Update TV Show</button>
</form> 
  			
';  
  }
}
?>

<?php 
# On success register user inserting into 'users' database table.
 if ( isset($errors) && (empty($errors))
 {
$sql = "UPDATE shows SET id = '$id', show_title = '$title', genre = '$genre', further_info = '$further_info', img = '$img', release_year = '$release',
 language = '$language', num_seasons = '$num_s', num_episodes = '$num_e', preview = '$preview', show_link = '$show_link'  WHERE id = '$show_id'";
$r= @mysqli_query( $link, $sql );

 if($r)
{
	header("Location: adminShow.php");
	mysqli_close( $link) ; 
	mysqli_close( $link2) ;
		exit();
}

else
{
	mysqli_close($link);
	mysqli_close($link2);
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
