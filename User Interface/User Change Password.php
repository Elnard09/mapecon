<?php
  session_start();
  include("../sql/config.php");
  include("../sql/function.php");
  
  // Check if user is logged in
  $user_data = check_login($connection);

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $current_password = $_POST['current-password'];
      $new_password = $_POST['new-password'];
      $confirm_password = $_POST['confirm-new-password'];

      // Verify if the current password is correct
      $hashed_password = $user_data['password'];
      if (password_verify($current_password, $hashed_password)) {
          // Check if new password matches the confirmation
          if ($new_password === $confirm_password) {
              // Update the password in the database
              $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
              $id = $user_data['id'];
              $query = "UPDATE users SET password='$hashed_new_password' WHERE id='$id'";
              $result = mysqli_query($connection, $query);
              if ($result) {
                  // Password updated successfully
                  echo '<script>alert("Password updated successfully!");</script>';
              } else {
                  // Error updating password
                  echo '<script>alert("Error updating password!");</script>';
              }
          } else {
              // New password and confirmation do not match
              echo '<script>alert("New password and confirmation do not match!");</script>';
          }
      } else {
          // Current password is incorrect
          echo '<script>alert("Current password is incorrect!");</script>';
      }
}
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Change Password</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/mapecon/style.css">
  
</head>
<body>
<header>
    <div class="logo_header">
    <img src="/mapecon/Pictures/MAPECON_logo.png" alt="MAPECON Logo">
  </div>
  <div class="profile-dropdown">
    <input type="checkbox" id="profile-dropdown-toggle" class="profile-dropdown-toggle">
    <label for="profile-dropdown-toggle" class="profile-dropdown">
      <img src="/mapecon/Pictures/profile.png" alt="Profile">
      <div class="dropdown-content">
        <a href="../User Interface/User Profile.php">Profile </a>
        <a href="../User Interface/User Change Password.php">Change Password</a>
        <a href="../sql/logout.php">Logout</a>
      </div>
    </label>
  </div>
  </header>

  <div class="menu"><span class="openbtn" onclick="toggleNav()">&#9776;</span>  EMP</div>
  
  <!-- Content -->
 <div class="content" id="content">

   <!-- Sidebar -->
   <div class="sidebar" id="sidebar">
    <a href="/mapecon/User Interface/User Leave Home.html" class="home-sidebar"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">NAVIGATE</span>
    <a href="/mapecon/User Interface/User Leave Form.php"><i class="fa fa-file-text-o"></i>Leave Application</a>
    <a href="/mapecon/User Interface/User Leave History.php"><i class="fa fa-file-word-o"></i> Leave History</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>

  <!-- Change Password Form -->
  <div class="change-password" >
    <h2>Change Password</h2>
    <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="current-password">Current Password:</label>
      <input type="password" id="password" name="current-password" required>

      <label for="new-password">New Password:</label>
      <input type="password" id="password" name="new-password" required>

      <label for="confirm-new-password">Confirm New Password:</label>
      <input type="password" id="password" name="confirm-new-password" required>

      <div class="buttons">
        <button type="button">Cancel</button>
        <button type="submit" id="submit-btn">Save</button>
      </div>
    </form>
  </div>
</div>
</body>

<script>
  function toggleNav() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var overlay = document.getElementById("overlay");
    var openButton = document.querySelector(".openbtn");
  
    if (sidebar.style.width === "250px") {
      closeSidebar();
    } else {
      openSidebar();
    }
  }
  
  function openSidebar() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var overlay = document.getElementById("overlay");
    var openButton = document.querySelector(".openbtn");
  
    sidebar.style.width = "250px";
    sidebar.style.visibility = "visible";
    openButton.innerHTML = "&#10005;"; // Change icon to close symbol
  
    if (window.innerWidth <= 768) { // Mobile and tablet breakpoint
      overlay.style.display = "block"; // Display overlay
    } else {
      content.style.marginLeft = "250px"; // Move content to the right
    }
  }
  
  function closeSidebar() {
    var sidebar = document.getElementById("sidebar");
    var content = document.getElementById("content");
    var overlay = document.getElementById("overlay");
    var openButton = document.querySelector(".openbtn");
  
    sidebar.style.width = "0";
    sidebar.style.visibility = "hidden";
    openButton.innerHTML = "&#9776;"; // Change icon to hamburger
  
    if (window.innerWidth <= 768) { // Mobile and tablet breakpoint
      overlay.style.display = "none"; // Hide overlay
    } else {
      content.style.marginLeft = "0"; // Move content back to its original position
    }
  }
  
  // Close sidebar when clicking outside it
  window.onclick = function(event) {
    if (!event.target.matches('.openbtn') && !event.target.matches('#sidebar')) {
      if (document.getElementById("sidebar").style.width === "250px") {
        closeSidebar();
      }
    }
  }
</script>
</html>
