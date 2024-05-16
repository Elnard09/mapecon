<?php
session_start();

include("../sql/config.php");
include("../sql/function.php");

if(isset($_GET['email']) && isset($_GET['otp']))
{
    date_default_timezone_set("Asia/Bangkok");
    $date = date("y-m-d");
    $query = "SELECT * FROM users WHERE email = '$_GET[email]' AND otp = '$_GET[otp]' AND token expired = '$date'";
    $result = mysqli_query($connection, $query);

    if($result)
    {
        if(mysqli_num_rows($result) == 1)
        {
            //pinangcheck lang ng anerrr
        } else {
            ?><script type="text/javascript">
                    alert('Invalid or expired link');
                    </script>
                    <?php
        }
    } else {
        ?><script type="text/javascript">
                    alert('Server down. try again later');
                    </script>
                    <?php
    }
}

?>

<?php



if(isset($_POST['updatepass']))
{
    //encrypted pass
    //$newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $newpass = $_POST['newpass'];

    $passhash = $newpass;
    $hashed_password = password_hash($passhash, PASSWORD_DEFAULT);

    $update = "UPDATE `users` SET `password`='$hashed_password', `otp` = NULL, `token expired` = NULL WHERE `email`='$email' ";
    $querycheck = mysqli_query($connection, $update);
    if($querycheck)
    {
        echo"
        <script>
            alert('Password updated successfully');
            window.location.href='User Log in.php';
        </script>
        ";
                        

    } else {
        ?><script type="text/javascript">
                    alert('Server down. Please try again later');
                    </script>
                    <?php
    }
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
    
    <!--css link-->
    <link rel="stylesheet" href="CSS/createnewpass.css">
    
    <!--icons-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Judson&family=Poppins&family=Quicksand:wght@300&display=swap" rel="stylesheet">
</head>

<body id="createnewpass-body">
<?php



?>
    <div class="wrapper-createnewpass">
        <h2>CREATE NEW PASSWORD</h2>
        <p>Create a <span>secure</span> password that you can <span>remember.</span></p>
        <form action="" method="POST">
            <div class="input-box">
                <input type="password" name="newpass" id="newpass" required placeholder="Enter new password">
                <label><i class="ri-lock-fill"></i>&nbsp;NEW PASSWORD</label>
            </div>
            <button type="submit" class="btn" name="updatepass">UPDATE PASSWORD</button>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?> ">
        </form>
    </div>
    <div class="logo">
        <img src="CSS/Pictures/glamour-logo.png" alt="Logo" style="width:100px;height:60px;">
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>