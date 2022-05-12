 <?php
ob_start();	

#connects to database.
require('include/connect_db.php');

   # displays navbar.
   include('include/login.html');
  ?>
<div class="container">
        <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-md">
        <div class="card card-dark mb-3">
        <div class="card-header">
        <h1 style="text-align: center">Forgot Password</h1>
        <hr>
        </div>
  
          <div class="card-body">
          <form action="send_email.php" method="post">
          <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" size="40" required="">
          </div>
          <br>
          <div style="text-align:center">
          <button type="submit" class="btn btn-secondary btn-block">Send password reset link</button>
          </div>
          </form>
          </div>
    
        </div>
        </div>
        <div class="col-sm">
        </div>
        </div>
        </div>

    <?php 
# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
	
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again' ;
}

  #display footer
  include('include/footer.html'); 
  

?>

 


   