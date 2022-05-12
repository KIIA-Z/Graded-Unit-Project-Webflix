<?php
ob_start();
#Access session
session_start();
include ( 'include/home.html' ) ;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful</title>
    <link rel="stylesheet" type="text/css" href="style.css">

	<?php
	#connect to database.
require ( 'include/connect_db.php' ) ;


$user_id = $_SESSION[ 'user_id' ] ;
echo $user_id;

$sql = "UPDATE users SET subscription_type = '1' WHERE user_id = '$user_id'";
	
$r= @mysqli_query( $link, $sql );
 if( $r )
{
echo'</head>
<body class="App">
  <h1>Payment Successful</h1>
  <div class="wrapper">
   <h2>Users Account has been updated to the appopraite level</h2>
    <div class="form-group">
                <a href="home.php">Return to the home page here</a>
                <br>
              </div>
  </div>
</body>
</html>	';
	#sets users session type to 1 so they can access premium content without logging back in.
	 $_SESSION[ 'subscription_type' ] = 1 ;
	mysqli_close( $link) ; 
	exit();
}

#else the user is told the payment is unsucssesful.
else
echo'	
<body class="App">
  <h1>Payment Unsuccessful</h1>
  <div class="wrapper">
   <h2>Users Account has not been changed</h2>
    <div class="form-group">
                <a href="home.php">Return to the home page here</a>
                <br>
              </div>
  </div>
</body>
</html>';
	#close database connection
	mysqli_close( $link) ; 
	exit();
    ?>




	 
