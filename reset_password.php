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
  
 # Check for a first name.
 if( empty($_POST[ 'pass1' ]))
 {$errors[] = 'An ID number must be entered to update record';}
else
{$pass1 = mysqli_real_escape_string($link2,trim( $_POST['pass1']));}

 # Check for a last name.
 if( empty($_POST[ 'pass1' ]))
 {$errors[] = 'A Genre Name must be entered to update record';}
else
{$pass2 = mysqli_real_escape_string($link2,trim( $_POST['pass2']));}


 # Check for a password.
 if( !empty($_POST[ 'pass1' ]))
{if($_POST['pass1'] != $_POST['pass2'])
 {$errors[] = 'Passwords do not match';}
else
{$pass = mysqli_real_escape_string($link2,trim( $_POST['pass1']));}
}
else
{$errors[]='Enter a password';}
}

require('include/connect_db.php');


if ( isset( $_GET['email'] ) ) {$email = $_GET['email'];}

   # display navbar
   include('include/login.html');
   
  echo'
<div class="container">
      <div class="row">
      <div class="col-sm">
      </div>
      <div class="col-md">
      <div class="card card-dark mb-3">
      <div class="card-header">
      <h1 style="text-align: center">Reset Password</h1>
      <hr>
      </div>
        <div class="card-body">
        <form action="reset_password.php?email='.$email .'" method="post">
        <div class="form-group">
        <input type="hidden" name="email" class="form-control" placeholder="Confirm Email" value="$email" required="">
        </div>
        <div class="form-group">
        <input type="password" name="pass1" class="form-control" placeholder="New Password" value="" required="">
        </div>
        <div class="form-group">
        <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" value="" required="">
        </div>
        <div class="form-group">
        <input class="btn btn-secondary" type="submit" value="Change password">
        </div>
        </form>
        </div>
      </div>
      </div>
      <div class="col-sm">
      </div>
      </div>
      </div>';

#if no errors and error set, dispaly errors
if (isset($errors) && empty($errors))
 {
$sql = "UPDATE users SET pass = SHA2('$pass',256) WHERE email = '$email'";
$r= @mysqli_query( $link, $sql );

 if($r)
{
	$message = "Password Reset!";
    echo "<script type='text/javascript'>alert('$message');</script>";
	header("Location: login.php");
	mysqli_close( $link) ; 
	mysqli_close( $link2) ; 
	exit();
}
else
{
	mysqli_close($link);
	mysqli_close( $link2) ; 
	exit();
}
 }
  include('include/footer.html'); 
?>

 


   