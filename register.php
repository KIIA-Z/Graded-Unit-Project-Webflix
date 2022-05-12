<?php
	
if($_SERVER['REQUEST_METHOD']=='POST')
{
require('include/connect_db.php');

#Initialize an error array.
$errors = array();

 # Check for a first name.
 if( empty($_POST[ 'first_name' ]))
 {$errors[] = 'Enter A First Name';}
else
{$fn = mysqli_real_escape_string($link,trim( $_POST['first_name']));}

 # Check for a last name.
 if( empty($_POST[ 'last_name' ]))
 {$errors[] = 'Enter A Last Name';}
else
{$ln = mysqli_real_escape_string($link,trim( $_POST['last_name']));}

 # Check for an email.
 if( empty($_POST[ 'email' ]))
	{ $errors[]='please enter an email.'; }
  else
	 {$e = mysqli_real_escape_string($link,trim( $_POST['email']));}
 
  # Check for a last name.
 if( empty($_POST[ 'DOB' ]))
 {$errors[] = 'Enter A Date of birth';}
else
{$dob = mysqli_real_escape_string($link,trim( $_POST['DOB']));}


 # Check for a password.
 if( !empty($_POST[ 'pass1' ]))
{if($_POST['pass1'] != $_POST['pass2'])
 {$errors[] = 'Passwords do not match';}
else
{$pass = mysqli_real_escape_string($link,trim( $_POST['pass1']));}
}
else
{$errors[]='Enter a password';}

 # Check for an card number.
 if( empty($_POST[ 'card_number' ]))
	{$errors[]='Please enter a card number.';}
  else
	 {$card_number = mysqli_real_escape_string($link,trim( $_POST['card_number']));}
 
   # Check for an expiry date.
 if( empty($_POST[ 'exp_date' ]))
	{$errors[]='Please enter the cards expiry year.';}
  else
	 {$exp_date = mysqli_real_escape_string($link,trim( $_POST['exp_date']));}
 
    # Check for an cvv.
 if( empty($_POST[ 'cvv' ]))
	{$errors[]='Please enter the cvv.';}
  else
	 {$cvv = mysqli_real_escape_string($link,trim( $_POST['cvv']));}
 
 # Check if email address already registered.
 if(empty($errors))
 {
	 $q ="SELECT user_id FROM users WHERE email='$e'";
	 $r=@mysqli_query($link, $q);
	 if(mysqli_num_rows($r)!=0){$errors[]='<h1>email address already registered.</h1><br> you can log in if you already have an account in the <a href="login.php">Login Page</a>, or retry a diffrent email address';}
 }
}
  ?>
   


  <?php
   # DISPLAY COMPLETE LOGIN PAGE.
   include('include/register.html');
  ?>
    
<div style="text-align:center">
<h1>Register</h1>
<form id = "register" action="register.php" method ="post">
  <div class="form-group">
    <label for="exampleInputEmail1">First Name: </label>
    <input type="text" name="first_name" size="25" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>"> 
	</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name: </label>
    <input type="text" name="last_name" size="25" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email: </label>
    <input type="text" name="email" size="25" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"> </p>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Date Of Birth: </label>
    <input type="text" name="DOB" size="25" value="<?php if (isset($_POST['DOB'])) echo $_POST['DOB']; ?>"> </p>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password: </label>
    <input type="text" name="pass1" size="25" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Confirm: </label>
    <input type="text" name="pass2" size="25" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Card Number: </label>
    <input type="text" name="card_number" size="25" value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Expiry date: </label>
    <input type="text" name="exp_date" size="25" value='<?php if (isset($_POST['exp_date'])) echo $_POST['exp_date']; ?>'>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">card cvv: </label>
    <input type="text" name="cvv" size="25" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>"/>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
<?php
 # On success register user inserting into 'users' database table.
 if (empty($errors))
 {

$q = "INSERT INTO users( first_name, last_name, email, pass, DOB, card_number, exp_date, cvv, reg_date) VALUES ('$fn', '$ln', '$e', SHA2('$pass',256), '$dob', '$card_number', '$exp_date', '$cvv', NOW())";
$r= @mysqli_query( $link, $q );

if($r)
{echo'<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>';}

else
	mysqli_close($link);
	exit();
 }
 else
{
	echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred: <br>';
	foreach($errors as $msg)
	{echo "-$msg<br>";}
	echo 'Please try again.</p>';
	mysqli_close($link);
	}


?>


</form>
</div>
<?
include('include/footer.html') ;
?>