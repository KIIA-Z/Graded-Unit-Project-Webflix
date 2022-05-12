<?php
# Open database connection.
require('include/connect_db.php');

# Get email passed from the form.
$email = $_POST[ 'email_request' ];

# Email message.
$message = "
<html>
<head>
</head>
<body>
<h1>Password Reset</h1>
<p>If you forgot your password, use the link below to reset it</p>
<p>If you did not request a password reset, please ignore this email</p>
<a href='http://webdev.edinburghcollege.ac.uk/~HNCSOFTSA3/Webflix%20-%20Graded%20Unit/reset_password.php?email=$email'> <button type='button' role='button'><h1>Reset your password</h1></button></a>
<br>
</body>
</html>
";

# send email
$q = "SELECT * FROM users WHERE email='$email'";
$r = mysqli_query($link, $q);
if (mysqli_num_rows($r) > 0) {
  $subject = "Reset password";
  $headers = "From: Webflix <password-reset@webflix.com>\r\n";
  $headers .= "Reply-To: password-reset@webflix.com\r\n";
  $headers .= "Content-type: text/html\r\n";
  mail($email, $subject, $message, $headers);

  $Success = urlencode("Email sent");
  header("Location:forgot.php?status=".$Success);
  die;
}
#or user is told there are no accounts with that email
else{
  $status = urlencode("No account found with that email address.");
  header("Location:forgot_password.php?status=".$status);
  die;
}
?>