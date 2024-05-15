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

    // Store the OTP in a session variable
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Store the OTP in the database
    $sql = "UPDATE users SET password_reset_otp = '$otp' WHERE email = '$email'"; // Update column name here
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
    echo 'window.location.href = "otp_verification.php";';
    echo '</script>';
    exit();
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("Email does not exist");';
    echo 'window.location.href = "forgot_password.php";';
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
function sendEmail($to, $otp) {
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'sorpresabakeshop2019@gmail.com';
  $mail->Password = 'qgmb eomy gogu rsux';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom('sorpresabakeshop2019@gmail.com', 'Sorpresa Bakeshop');
  $mail->addAddress($to);

  $mail->isHTML(true);
  $mail->Subject = 'Password Reset OTP';
  $mail->Body = "Your OTP for password reset is: $otp.\n\n This OTP is valid for 5 minutes only.";

  if (!$mail->send()) {
    echo '<script type="text/javascript">';
    echo 'alert("Error sending email: ' . $mail->ErrorInfo . '");';
    echo 'window.location.href = "forgot_password.php";';
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
