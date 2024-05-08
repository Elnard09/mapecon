<?php
session_start();

include("../sql/config.php");

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "mapecon");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT l.*, UCASE(CONCAT(u.lastname, ', ', u.firstname)) AS full_name
        FROM leave_applications AS l 
        INNER JOIN users AS u ON l.user_id = u.user_id
        ORDER BY l.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Approved Leaves</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/mapecon/style3.css">
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

<div class="menu"><span class="openbtn" onclick="toggleNav()">&#9776;</span>  HR</div>

 <!-- Content -->
 <div class="content" id="content">
<div class="container_report_report">

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="Admin Home.php"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">LEAVE REPORTS</span>
    <a href="Pending Leaves.php"><i class="fa fa-file-text-o"></i> Pending Leaves</a>
    <a href="Approved Leaves.php" class="home-sidebar" id="active"><i class="fa fa-file-word-o"></i> Approved Leaves</a>
    <a href="Declined Leaves.php"><i class="fa fa-file-excel-o"></i> Declined Leaves</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>
  
    <div class="leave-report-header">
      <h2>Approved Leaves</h2>
      <div class="dropdown">
        <button class="dropdown-button" onclick="showDropdown()">Export   <i class="fa fa-caret-down"></i></button>
        <ul class="dropdown-menu">
          <li><a href="#">Compiled PDF</a></li>
          <li><a href="#">Excel Format</a></li>
        </ul>
      </div>
    </div>
    
    <div class="filters">
      <table>
        <tr class="filter-row-approved">
          <th class="entries">Show <input type="number" value="10"> entries</th>
          <th><input type="text" placeholder="Name"></th>
          <th><input type="date" id="dateInput"></th>
        </tr>
      </table>
    </div>

<div>
  <table>
    <tr>
      <th class="th"><input type="checkbox"></th>
      <th class="th">Full Name</th>
      <th class="th">Type of Leave</th>
      <th class="th">Date Filed</th>
      <th class="th">Date Requested</th>
      <th class="th">Leave Until</th>
      <th class="th"></th>
      <th class="th" colspan="2">Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["status"] === "Approved") {
                echo "<tr>";
                echo "<td class='td'><input type='checkbox'></td>";
                echo "<td class='td'>" . $row["full_name"] . "</td>";
                echo "<td class='td'>" . $row["leave_type"] . "</td>";
                echo "<td class='td'>" . $row["date_filed"] . "</td>";
                echo "<td class='td'>" . $row["from_date"] . "</td>";
                echo "<td class='td'>" . $row["to_date"] . "</td>";
                echo "<td class='td'>-</td>";
                echo "<td class='td actions eye tooltip'><a href='view leave docs.php?application_id=" . $row["application_id"] . "' target='_blank'><i class='fa fa-eye'></i><span class='tooltiptext-eye'>View Leave Document</span></a></td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='10'>No data found</td></tr>";
    }
    ?>
  </table>
</div>
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
  

    // Add script to set default text for date input
  document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    const today = new Date();
    const formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');
    dateInput.value = formattedDate;
  });
</script>
</html>
