<?php 

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
  
 # Check for an id.
 if( empty($_POST[ 'id' ]))
 {$errors[] = 'An ID number must be entered to update record';}
else
{$id = mysqli_real_escape_string($link2,trim( $_POST['id']));}

 # Check for a last name.
 if( empty($_POST[ 'name' ]))
 {$errors[] = 'A Genre Name must be entered to update record';}
else
{$name = mysqli_real_escape_string($link2,trim( $_POST['name']));}
}
 
 
# Access session.
session_start();
 
 #displays navbar
include ( 'include/home.html' ) ;

#connects to database
require ( 'include/connect_db.php' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

#if genre_id is set it is set set toa php varible
if ( isset( $_GET['genre_ID'] ) ) {$genre_id = $_GET['genre_ID']; }

# Retrieve items from 'genre' database table and displays the results with a while loop.
$q = "SELECT * FROM genre WHERE genre_ID = '$genre_id'" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
	echo '<div class="container">';
while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
echo'<div style="text-align:center">
<h1>Update '. $row['name'].' Genre Record </h1>
<form id = "register" action="editGenre.php?genre_ID='.$genre_id.'" method ="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Movie Title: </label>
    <input type="text" name="id" size="25" value="'. $row['genre_ID'].'"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name: </label>
    <input type="text" name="name" size="25" value="'.$row['name'].'">
  </div>
    <button type="submit" class="btn btn-default">Submit</button>
  			
';  
  }
}		


# On success register user inserting into 'users' database table.
 if (empty($errors))
 {
$sql = "UPDATE genre SET genre_ID = '$id', name = '$name' WHERE genre_ID = '$genre_id'";
$r= @mysqli_query( $link, $sql );

 if($r && $pass == 1)
{
	header("Location: adminGenre.php");
	mysqli_close( $link) ; 
}

else
{
	mysqli_close($link);
	exit();
}
 }
 
 #or dispaly errors and closes database connection
 else
{
	echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred: <br>';
	foreach($errors as $msg)
	{echo "-$msg<br>";}
	echo 'Please try again.</p>';
	mysqli_close($link);
	}
  #displays footer
  include ( 'include/footer.html' ) ;
?>



