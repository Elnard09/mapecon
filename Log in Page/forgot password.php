<?php
session_start();

include("../sql/config.php");
include("../sql/function.php");

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$connection = mysqli_connect("localhost", "root", "", "mapecon"); // Update database name here

if (isset($_POST['forgotSubmit'])) {
  $email = $_POST['email'];

  // Check if the email exists in the database
  $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'"; // Update table name here
  $result = mysqli_query($connection, $checkEmailQuery);

  if (mysqli_num_rows($result) > 0) {
    // Generate a random OTP
    $otp = generateOTP(); // Define the function to generate an OTP
    date_default_timezone_set("Asia/Bangkok");
    $date = date("y-m-d");

    // Store the OTP in a session variable
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Store the OTP in the database
    $sql = "UPDATE `users` SET `otp` = '$otp', `token expired` = '$date' WHERE `email` = '$email'"; // Update column name here
    $result = mysqli_query($connection, $sql);

    if (!$result) {
      echo "Error updating database: " . mysqli_error($connection);
      exit();
    }

    // Send the OTP to the user's email
    sendEmail($email, $otp); // Define the function to send an email

    // Display the success message and redirect
    echo '<script type="text/javascript">';
    echo 'alert("Password reset OTP has been sent to your email.");';
    echo 'window.location.href = "User Log in.php";';
    echo '</script>';
    exit();
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("Email does not exist");';
    echo 'window.location.href = "forgot password.php";';
    echo '</script>';
    exit();
  }
}

// Function to generate a random OTP
function generateOTP() {
  // Generate a random 6-digit number
  $otp = rand(100000, 999999);
  return $otp;
}

// Function to send an email with the OTP
function sendEmail($email, $otp) {
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'sorpresabakeshop2019@gmail.com';
  $mail->Password = 'qgmb eomy gogu rsux';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom('sorpresabakeshop2019@gmail.com', 'Sorpresa Bakeshop');
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = 'MAPECON: Password Reset OTP';
  $mail->Body = "
            <body style='background: #171818; color: #fff; padding: 50px; border-radius: 10px;'>
            
            <center><h1 style='color: #FED586; font-family: Judson;'>GLAMOUR</h1></center>

            <p style='color: #fff;'>
            <em>Good day!<em>
            </p>

            <p style='color: #fff;'>
                We have received a request to reset the password associated with your account. 
                If you did not initiate this request, please disregard this message. To reset your 
                password, please click on the link below:<br><br>
            </p>

            <center>
            <a href='localhost/mapecon/Log in Page/otp input.php?email=$email&reset_token=$otp' 
            style='background: #FED586; padding: 10px; color: black; font-weight: bolder; 
            font-family: Judson; text-decoration: none; border-radius: 5px;'>RESET PASSWORD</a><br><br>
            </center> 
            
            <p style='color: #fff;'>
                You will be taken to a page where you can enter a new password. Please make sure to 
                choose a strong, unique password that you have not used before. <br><br>

                If you have any questions or concerns, please do not hesitate to contact our with  
                this email. Thank you for your cooperation. Have a great day ahead! <br><br>
            </p>

            <p style='color: #fff;'>
            <em>
            Best regards, <br>
            MAPECON
            </em> <br>
            </p>

            </body>
            ";

  if (!$mail->send()) {
    echo '<script type="text/javascript">';
    echo 'alert("Error sending email: ' . $mail->ErrorInfo . '");';
    echo 'window.location.href = "forgot password.php";';
    echo '</script>';
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="css/vertical-layout-light/passwordstyle.css">
  <link rel="shortcut icon" href="images/favicon.jpg" />
</head>

<body>
  <div class="container-scroller">
    <div class="container">
      <div class="card">
        <div class="logo">
          <a href="index.php"><img src="images/pos/logo-mini.png" alt="logo" /></a>
        </div>
        <h3 class="card-header">Forgot Password</h3>
        <div class="card-body">
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
              <button type="submit" name="forgotSubmit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
