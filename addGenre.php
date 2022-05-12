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
  
 # Check for a id.
 if( empty($_POST[ 'id' ]))
 {$errors[] = 'An ID number must be entered to update record';}
else
{$id = mysqli_real_escape_string($link2,trim( $_POST['id']));}

 # Check for a name.
 if( empty($_POST[ 'name' ]))
 {$errors[] = 'A Genre Name must be entered to update record';}
else
{$name = mysqli_real_escape_string($link2,trim( $_POST['name']));}

 # Check if id is already used.
 if(empty($errors))
 {
	 $q ="SELECT genre_ID FROM genre WHERE genre_ID='$id'";
	 $r=@mysqli_query($link, $q);
	 if(mysqli_num_rows($r)!=0){$errors[]='<h1>Genre ID already taken.</h1><br> Please try a diffrent ID value';}
 }

}
 
# Access session.
session_start();
 
#displays the navbar
include ( 'include/home.html' ) ;

#Conects to the Database
require ( 'include/connect_db.php' ) ;

# Redirect if not logged in.																																										
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }
?>
<div class="container">
	<div style="text-align:center">
<h1>Add New Genre Record </h1>
<form id = "register" action="addGenre.php" method ="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Movie Title: </label>
    <input type="text" name="id" size="25" value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name: </label>
    <input type="text" name="name" size="25" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
  </div>
    <button type="submit" class="btn btn-default">Add </button>
  			
<?php
# On success register user inserting into 'users' database table.
 if (empty($errors))
 {
$sql = "INSERT INTO genre( genre_ID, name) VALUES ('$id', '$name')";

$r= @mysqli_query( $link, $sql );

 if($r && $pass == 1)
{
	header("Location: adminGenre.php");
	mysqli_close( $link) ; 
}

#Or close the database connection
else
{
	mysqli_close($link);
	exit();
}
 }
 
 #Display any errors
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



