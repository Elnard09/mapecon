<?php
session_start();

include("../sql/config.php");

// Connect to database
$conn = mysqli_connect("localhost","root","","mapecon");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch leave history data
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
<title>User Leave History</title>
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

<div class="menu"><span class="openbtn" onclick="toggleNav()">&#9776;</span>  EMP</div>

 <!-- Content -->
<div class="content" id="content">
<div class="container_report_report">
  
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="/mapecon/User Interface/User Leave Home.php" class="home-sidebar"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">NAVIGATE</span>
    <a href="/mapecon/User Interface/User Leave Form.php"><i class="fa fa-file-text-o"></i>Leave Application</a>
    <a href="/mapecon/User Interface/User Leave History.php" id="active"><i class="fa fa-file-word-o"></i> Leave History</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>
  
    <div class="leave-report-header">
      <h2>Leave History</h2>
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
          <th><input type="date" id="dateInput"></th>
        </tr>
      </table>
    </div>

<div>
  <table>
    <tr>
      <th class="th-history"><input type="checkbox"></th>
      <th class="th-history">Type of Leave</th>
      <th class="th-history">Date Filed</th>
      <th class="th-history">Date Requested</th>
      <th class="th-history">Leave Until</th>
      <th class="th-history">Status</th>
      <th class="th-history"></th>
      <th class="th-history" colspan="3">Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='td-history'><input type='checkbox'></td>";
            echo "<td class='td-history'>" . $row["leave_type"] . "</td>";
            echo "<td class='td-history'>" . $row["date_filed"] . "</td>";
            echo "<td class='td-history'>" . $row["from_date"] . "</td>";
            echo "<td class='td-history'>" . $row["to_date"] . "</td>";
            echo "<td class='td-history'><span class='pending-leave'>Pending</span><span class='approved-leave'>Approved</span><span class='rejected-leave'>Rejected</span></td>";
echo "<td class='td-history'> -</td>";
echo "<td class='actions eye tooltip td-history'><i class='fa fa-eye'></i><span class='tooltiptext-eye'>View Leave Document</span></td>";
echo "<td class='td actions floppy tooltip td-history'><i class='fa fa-floppy-o'></i><span class='tooltiptext-approve'>Send to HR</span></td>";
echo "<td class='td actions close tooltip td-history'><i class='fa fa-trash'></i><span class='tooltiptext-reject'>Cancel Request</span></td>";
            echo "</tr>";
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
      content.style.marginLeft = "0";
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
<?php
// Close database connection
$conn->close();
?>
