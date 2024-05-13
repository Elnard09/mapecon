<?php
session_start();

include("../sql/config.php");

// Retrieve data for pending, approved, and declined leaves
$queryPending = "SELECT COUNT(*) AS pending_count FROM leave_applications WHERE status = 'Pending'";
$queryApproved = "SELECT COUNT(*) AS approved_count FROM leave_applications WHERE status = 'Approved'";
$queryDeclined = "SELECT COUNT(*) AS declined_count FROM leave_applications WHERE status = 'Declined'";

$resultPending = mysqli_query($connection, $queryPending);
$resultApproved = mysqli_query($connection, $queryApproved);
$resultDeclined = mysqli_query($connection, $queryDeclined);

$rowPending = mysqli_fetch_assoc($resultPending);
$rowApproved = mysqli_fetch_assoc($resultApproved);
$rowDeclined = mysqli_fetch_assoc($resultDeclined);

// Close database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/mapecon/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->
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
        <a href="Admin Profile.php">Profile </a>
        <a href="Admin Change Password.php">Change Password</a>
        <a href="../sql/logout.php">Logout</a>
      </div>
    </label>
  </div>
</header>
<div class="menu"><span class="openbtn" onclick="toggleNav()">&#9776;</span>  HR</div>
  
  <!-- Content -->
 <div class="content" id="content">

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="Admin Home.php" class="home-sidebar" id="active"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">LEAVE REPORTS</span>
    <a href="Pending Leaves.php"><i class="fa fa-file-text-o"></i> Pending Leaves</a>
    <a href="Approved Leaves.php"><i class="fa fa-file-word-o"></i> Approved Leaves</a>
    <a href="Declined Leaves.php"><i class="fa fa-file-excel-o"></i> Declined Leaves</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>
  <div class="card-container-admin">
    <div class="card-container-wrapper">
      <div class="card" onclick="location.href='/mapecon/Admin Interface/Pending Leaves.php';" style="cursor: pointer;">
        <div class="card-content">
          <img src="/mapecon/Pictures/pending.png" alt="Pending">
        </div>
      </div>
      <p class="phrase">Pending</p>
    </div>
    <div class="card-container-wrapper">
        <div class="card" onclick="location.href='/mapecon/Admin Interface/Approved Leaves.php';" style="cursor: pointer;">
          <div class="card-content">
            <img src="/mapecon/Pictures/approved.png" alt="Approved">
          </div>
        </div>
        <p class="phrase">Approved</p>
      </div>
    <div class="card-container-wrapper">
      <div class="card" onclick="location.href='/mapecon/Admin Interface/Declined Leaves.php';" style="cursor: pointer;">
        <div class="card-content">
          <img src="/mapecon/Pictures/declined.png" alt="Declined">
        </div>
      </div>
      <p class="phrase">Declined</p>
    </div>
</div>

<!-- Data Visualization -->
  <div class="data-visualization">
    <canvas id="leaveChart"></canvas> <!-- Canvas for the chart -->
  </div>
</div>
</body>

<script>
  // JavaScript function to create and update the leave status chart
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('leaveChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie', // Change chart type to pie
      data: {
        labels: ['Pending', 'Approved', 'Declined'],
        datasets: [{
          label: 'Leave Status',
          data: [<?php echo $rowPending['pending_count']; ?>, <?php echo $rowApproved['approved_count']; ?>, <?php echo $rowDeclined['declined_count']; ?>],
          backgroundColor: [
            'rgba(0, 0, 255, 0.7)', // Pending - Blue
            'rgba(0, 128, 0, 0.7)', // Approved - Green
            'rgba(255, 0, 0, 0.7)' // Declined - Red
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'right'
        }
      }
    });
  });
</script>

<script>
  // JavaScript functions for sidebar toggling
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
