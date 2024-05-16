<?php
session_start();

include("../sql/config.php");
include("../sql/function.php");

if (isset($_GET['email']) && isset($_GET['otp'])) {
    date_default_timezone_set("Asia/Bangkok");
    $date = date("y-m-d");
    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND otp = ? AND `token expired` = ?");
    $stmt->bind_param("sss", $_GET['email'], $_GET['otp'], $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows == 1) {
            // The link is valid
        } else {
            echo '<script type="text/javascript">
                    alert("Invalid or expired link");
                  </script>';
        }
    } else {
        echo '<script type="text/javascript">
                alert("Server down. try again later");
              </script>';
    }
    $stmt->close();
}

if (isset($_POST['updatepass'])) {
    $email = $_POST['email'];
    $newpass = $_POST['newpass'];
    $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);

    $stmt = $connection->prepare("UPDATE `users` SET `password` = ?, `otp` = NULL, `token expired` = NULL WHERE `email` = ?");
    $stmt->bind_param("ss", $hashed_password, $email);
    $querycheck = $stmt->execute();

    if ($querycheck) {
        echo "<script>
                alert('Password updated successfully');
                window.location.href='User Log in.php';
              </script>";
    } else {
        echo '<script type="text/javascript">
                alert("Server down. Please try again later");
              </script>';
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password | Glamour</title>
    <link rel="shortcut icon" type="image/png" href="CSS/Pictures/favicon.png">
    <link rel="stylesheet" href="CSS/createnewpass.css">
    <link rel="stylesheet" href="/mapecon/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>
<body id="createnewpass-body" class="no-header-padding">
    <div class="background-image"></div>
    <div class="container-login">
        <div class="login-form">
            <img src="/mapecon/Pictures/MAPECON_logo.png" alt="MAPECON Logo" class="logo">
            <h2 class="h2-forgor">Create New Password</h2>
            <p class="p-forgor">Email verified. Create a password that you can remember.</p>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="password" name="newpass" id="newpass" required placeholder="Enter new password">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="login-btn" name="updatepass">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
