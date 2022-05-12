<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login.php' ) ; load() ; } 


# Open database connection.
require ( 'include/connect_db.php' ) ;
include ( 'include/home.html' ) ;

$counter = 0;
 
#displays all tv shows with sql query and while loop.
$sql = "select * from shows";
$result = mysqli_query($link,$sql);
echo '<div class="container">
		<h3> TV Shows </h3>
		<div class="row">';
while ($row = $result->fetch_assoc())
{
?>
			<div class="col-md-3"
                <div class="card card-default" style="width: 9rem;">
                    <img src="<?php  echo $row['img'] ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php  echo $row['show_title'] ?></h5>
                        <a href="show.php?id=<?php echo $row['id']?>" class="btn btn-secondary btn-block" role="button">View Content</a>
                    </div>
                </div>
         
<?php
		}
?>
   	
        </div>
		</div>
<?php

#display footer
include ( 'include/footer.html' );
?>


