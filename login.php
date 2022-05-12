
  <?php
  	
if($_SERVER['REQUEST_METHOD']=='POST')
{
require('include/connect_db.php');
}
   # DISPLAY COMPLETE LOGIN PAGE.
   include('include/login.html');
   require ('include/login_action.php')
  ?>
<div style="text-align:center">
<form id = "login" action="login.php" method ="post">
  <h1>Login</h1>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="email" size="25" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"> </p>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pass" size="25" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
	</div>
	<div class="form-group">
                <a href="forgot.php">Forgot password?</a>
                <br>
                <br>
                <a>No Account on Webflix? </a><a href="register.php"><span style="color:#C72606;">Sign up now</span></a>
              </div>
  
  <button type="submit" class="btn btn-outline-dark">Login</button>
    <?php 
# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or <a href="register.php">Register</a></p>' ;
}
  include('include/footer.html');
?>
</form>
</div>

 


   