 <?php
 
 # Access session.
session_start() ;

#connects to database
require('include/connect_db.php');

#displays navbar
include ( 'include/home.html' ) ;

$ul= 0;

#if user isnt set to admin level they will be sent back to the home page
if(!isset($_SESSION['user_id'])  || $ul == $_SESSION['user_level'] ) {header("Location: home.php");}

  ?>
  <div class="container h-100">
   <div class="row h-100 justify-content-center align-items-center">
<div style="text-align:center">
  <h1>Welcome to the Admin Home Area</h1>
<div class="btn-group">
    <a href="adminGenre.php" class="btn btn-primary active">
        <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Admin Genre Area </a>
  <div class="btn-group">
    <a href="adminMovie.php" class="btn btn-primary active">
        <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Admin Movies Area </a>
		<div class="btn-group">
    <a href="adminShow.php" class="btn btn-primary active">
        <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Admin Tv Shows Area </a>
		<div class="btn-group">
    <a href="adminUser.php" class="btn btn-primary active">
        <i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i> Admin User Area </a>
</div>
</div>
</div>
</div>
</div>
    <?php 


#displays footer
  include('include/footer.html');

?>
