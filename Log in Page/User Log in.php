<?php
session_start();

    include("../sql/config.php");
    include("../sql/function.php");
 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password))
        {
           //read from database
           $query = "SELECT * FROM users WHERE email = '$email' limit 1";

           $result = mysqli_query($connection, $query);

           if($result) {
                $user_data = mysqli_fetch_assoc($result);
                $passsql = "SELECT password FROM users WHERE email = '$email' ";
                $sqlres = mysqli_query($connection, $passsql);
                $sqlrow = mysqli_fetch_assoc($sqlres);
                $stored_hashed_password = $sqlrow['password'];
            //if($result && mysqli_num_rows($result) > 0){
                
               /* if($user_data['verify_status'] == "1")
                {
                    $passsql = "SELECT password FROM users WHERE email = '$email' ";
                    $sqlres = mysqli_query($connection, $passsql);
                    $sqlrow = mysqli_fetch_assoc($sqlres);
                    $stored_hashed_password = $sqlrow['password'];*/

                    if(password_verify($password, $stored_hashed_password)) {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'Admin')
                        {
                            header("Location: ../Admin Interface/Admin Home.php");
                            die;
                        }

                        $_SESSION['user_id'] = $user_data['user_id'];
                        if($user_data['user_status'] == 'User')
                        {
                            header("Location: ../User Interface/User Leave Home.php");
                            die;
                        }
                    } else {
                        ?><script type="text/javascript">
                        alert('Wrong password. Please try again');
                        window.history.back();
                        </script>
                        <?php 
                    } 

                } else {
                    ?><script type="text/javascript">
                    alert('Please verify your email address to login');
                    window.location.href='User Log in.php';
                    </script>
                    <?php
                }

                
            } /*else {
                ?><script type="text/javascript">
                alert('Email not signed up.');
                </script>
                <?php 
            }*/
            } 
          

         else {
            ?><script type="text/javascript">
            alert('Please fill out the blank form');
            </script>
            <?php 
        }
    
 
    if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
    {
        $mail=$_COOKIE['email'];
        $pass=$_COOKIE['password'];
    } else {
        $mail = "";
        $pass = "";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/mapecon/style.css">
</head>

<body class="no-header-padding">
  <div class="background-image">
  </div>
  <div class="container-sign">
    <div class="login-form">
      <img src="/mapecon/Pictures/MAPECON_logo.png" alt="MAPECON Logo" class="logo"> <h2>Welcome to Leave Simulation System!</h2>
      <p>Log in to access our Leave Management System, streamlining our leave application process.</p>
      <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">
        <a href="#" class="forgot-password">Forgot Password?</a>
        <button type="submit" class="login-btn">Login</button>  </form>
      <div class="sign-up-link">
        Don't have an account? <a href="/mapecon/Log in Page/User Signup.php">Sign Up</a>
      </div>
      
    </div>
  </div>
</body>

</html>