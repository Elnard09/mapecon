<?php
include("../sql/config.php");
include("../sql/function.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email from form
    $email = $_POST["email"];

    // Check if email is empty
    if (empty($email)) {
        echo "Email is required";
    } else {
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else {
            // Check if email exists in database
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Email exists, generate new password
                $new_password = generateRandomString(8);

                // Update user's password
                if (updatePassword($connection, $email, $new_password)) {
                    // Send the new password to the user's email
                    $to = $email;
                    $subject = "Your new password";
                    $message = "Your new password is: " . $new_password;

                    // Headers
                    $headers = "From: Your Name <your_email@gmail.com>\r\n";
                    $headers .= "Reply-To: <your_email@gmail.com>\r\n";
                    $headers .= "Content-type: text/html\r\n";

                    // Sending email using Gmail SMTP
                    $config = array(
                        'protocol'  => 'smtp',
                        'smtp_host' => 'smtp.gmail.com',
                        'smtp_port' => 587,
                        'smtp_user' => 'sorpresabakeshop2019@gmail.com',
                        'smtp_pass' => 'qgmb eomy gogu rsux',
                        'mailtype'  => 'html',
                        'charset'   => 'iso-8859-1',
                        'wordwrap'  => TRUE
                    );

                    // Load email library
                    $ci = new PHPMailer\PHPMailer\PHPMailer();
                    $ci->IsSMTP();
                    $ci->SMTPDebug = 0;
                    $ci->SMTPAuth = true;
                    $ci->SMTPSecure = 'tls';
                    $ci->Host = "smtp.gmail.com";
                    $ci->Port = 587;
                    $ci->IsHTML(true);
                    $ci->Username = "your_email@gmail.com";
                    $ci->Password = "your_password";
                    $ci->SetFrom("your_email@gmail.com", "Your Name");
                    $ci->Subject = $subject;
                    $ci->Body = $message;
                    $ci->AddAddress($to);

                    // Send email
                    if ($ci->send()) {
                        echo "A new password has been sent to your email.";
                    } else {
                        echo "Email sending failed.";
                    }
                } else {
                    echo "Error updating password";
                }
            } else {
                echo "Email does not exist";
            }
        }
    }
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>

<h2>Forgot Password</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Enter your email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
