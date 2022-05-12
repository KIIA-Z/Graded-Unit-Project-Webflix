<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login.php' ) ; load() ; } 

#if results is set it is set to a php varible 
if ( isset( $_GET['results'] ) ) $results = $_GET['results'] ;

# Open database connection.
require ( 'include/connect_db.php' ) ;

#display navbar
include ( 'include/home.html' ) ;

#display relevant search results from sql query.
 echo '<h3> Movies </h3>';
$sql = "SELECT * FROM movie WHERE movie_title  LIKE '%{$_GET[results]}%'";
$result = mysqli_query($link,$sql);
echo '<div class="container">
		<div class="row">
			<div class="col-md-3">';
while ($row = $result->fetch_assoc())
{
?>
                <div class="card card-default" style="width: 18rem;">
                    <img src="<?php  echo $row['img'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php  echo $row['movie_title'] ?></h5>
                        <a href="movie.php?id=<?php echo $row['id']?>" class="btn btn-secondary btn-block" role="button">View Content</a>
                    </div>
                </div>
<?php
}
echo'   	
        </div>
		</div>';
		
# Display footer section.
include ( 'include/footer.html' ) ;
?>
