<?php
session_start();

include("../sql/config.php");
include("../sql/function.php");

$update_msg = ""; // Initialize the update message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $department = $_POST['department'];

    $query = "UPDATE users 
              SET firstname = '$fname', lastname = '$lname', contactnumber = '$contact', department = '$department' 
              WHERE user_id = " . $_SESSION['user_id'];

    if (mysqli_query($connection, $query)) {
        $update_msg = "Profile updated successfully!";
    } else {
        $update_msg = "Error updating profile: " . mysqli_error($connection);
    }

    // Fetch user's current profile data
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if($result){
      ?>
      <script type="text/javascript">
      alert('Profile updated successfully!');
      window.location.href='User Leave Home.php';
      </script>
      <?php
      die;
      } else {
        ?><script type="text/javascript">
        alert('Error updating profile! Please try again');
        window.location.href='User Profile.php';
        </script>
        <?php
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
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
    <a href="/mapecon/User Interface/User Leave Home.php" class="home-sidebar"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">NAVIGATE</span>
    <a href="/mapecon/User Interface/User Leave Form.php"><i class="fa fa-file-text-o"></i>Leave Application</a>
    <a href="/mapecon/User Interface/User Leave History.php"><i class="fa fa-file-word-o"></i> Leave History</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>

  <div class="profile-edit">
    <h2>Edit Profile</h2>
    <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="fname">First Name:</label>
      <input type="text" id="fname" name="fname" required>

      <label for="lname">Last Name:</label>
      <input type="text" id="lname" name="lname" required>

      <label for="contact">Contact:</label>
      <input type="tel" id="contact" name="contact" required>

      <label for="department">Department:</label>
      <div class="department-edit">
        <select name="department" id="department-edit" required>
          <option value="">Select</option>
          <option value="Accounting">Accounting</option>
          <option value="Admin">Admin and Shared Services</option>
          <option value="Ads">Ads and Promo</option>
          <option value="Business">Business Development Group</option>
          <option value="Chem Room">Chem Room</option>
          <option value="Clinic">Clinic</option>
          <option value="Collection">Collection</option>
          <option value="EVP">EVP Office</option>
          <option value="Greenovations-Floor">Greenovations (1st and 2nd Floor)</option>
          <option value="Greenovations-Table">Greenovations (MGCPI Table)</option>
          <option value="Operator-HR">Operator and HR</option>
          <option value="OTD">OTD</option>
          <option value="Research">Research and Development</option>
          <option value="Sales">Sales</option>
          <option value="Service">Service</option>
        </select>
      </div>

      <!--<label for="email">Email:</label>
      <input type="email" id="email" name="email" required> -->

      <div class="buttons">
        <button type="button" onclick="window.location.href='/mapecon/User Interface/User Leave Home.php';">Cancel</button>
        <button type="submit" id="submit-btn">Save</button>
      </div>
    </form>
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
