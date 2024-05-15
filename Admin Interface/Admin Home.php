<?php
session_start();

include("../sql/config.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve the current user's first name
$queryUser = "SELECT firstname FROM users WHERE user_id = ?";
$stmt = $connection->prepare($queryUser);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$resultUser = $stmt->get_result();

if ($resultUser->num_rows > 0) {
  $rowUser = $resultUser->fetch_assoc();
  $firstName = $rowUser["firstname"]; // Escape for security
} else {
  $firstName = "User";
}

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
  <link rel="shortcut icon" href="/mapecon/Pictures/favicon.png">
  <link rel="stylesheet" href="/mapecon/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->
  <style>
    /* Add your custom styles here */
    .dashboard-body {
      background-color: #f4f4f4;
    }
    .dashboard-content {
      padding: 20px;
    }
    .dashboard-content h1 {
      margin-bottom: 20px;
    }
    .dashboard-content .divider {
      border-bottom: 1px solid #ccc;
      margin-bottom: 20px;
    }
    .container {
      display: flex;
      justify-content: center;
    }
    .admin-home {
      flex: 1;
      padding-right: 10px;
    }
    .admin-dashboard {
      flex: 1;
      padding-left: 10px;
    }
  </style>
</head>
<body>
<header>
  <div class="logo_header">
    <a href="../Admin Interface/Admin Home.php"> 
      <img src="/mapecon/Pictures/MAPECON_logo.png" alt="MAPECON Logo">
    </a> 
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
<div class="menu">
  <span class="openbtn" onclick="toggleNav()">&#9776;</span>  
  HR
  <div id="name-greeting">Welcome <span class='user-name'><?php echo $firstName; ?></span>!</div>
</div>
    
<!-- Content -->
<div class="content" id="content">

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="Admin Home.php" class="home-sidebar" id="active"><i class="fa fa-home"></i> Home</a>
    <!-- <a href="Admin Dashboard.php" class="home-sidebar"><i class="fa fa-pie-chart"></i> Dashboard</a> -->
    <span class="leave-label">LEAVE REPORTS</span>
    <a href="Pending Leaves.php"><i class="fa fa-file-text-o"></i> Pending Leaves</a>
    <a href="Approved Leaves.php"><i class="fa fa-file-word-o"></i> Approved Leaves</a>
    <a href="Declined Leaves.php"><i class="fa fa-file-excel-o"></i> Declined Leaves</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>

  <!-- Admin Home content -->
  <div class="container">
    <div class="admin-home">
      <div class="dashboard-content">
        <h1>Home</h1>
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
        
      </div>
    </div>

    <!-- Admin Dashboard content -->
    <div class="admin-dashboard">
      <div class="dashboard-content">
        <h1>Dashboard</h1>
        <div class="container_dashboard">
          <div class="filters">
            <table>
              <tr class="filter-row-approved">
                <th>
                  <select id="monthFilter-dashboard">
                    <option value="">Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </th>
                <th>
                  <select id="yearFilter-dashboard">
                    <option value="">Year</option>
                    <?php 
                      $start_year = 2010;
                      $end_year = date('Y');
                      for( $j=$end_year; $j>=$start_year; $j-- ) {
                          echo '<option value="'.$j.'">'.$j.'</option>';
                      }
                    ?>
                  </select>
                </th>
              </tr>
            </table>
          </div>

          <!-- Data Visualization -->
          <div class="data-visualization">
            <canvas id="leaveChart"></canvas> <!-- Canvas for the chart -->
            </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('leaveChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie', // Change chart type to pie
      data: {
        labels: ['Pending', 'Approved', 'Declined'],
        datasets: [{
          label: 'Leave Status',
          data: [
            <?php echo $rowPending['pending_count']; ?>, 
            <?php echo $rowApproved['approved_count']; ?>, 
            <?php echo $rowDeclined['declined_count']; ?>
          ],
          backgroundColor: [
            'rgb(58, 58, 58)', // Pending - Gray
            'rgba(255,214,213,255)', // Approved - Light Pink
            'rgb(192, 0, 0)' // Declined - Red
          ],
          borderColor: [
            'rgb(255, 255, 255)',
            'rgb(255, 255, 255)',
            'rgb(255, 255, 255)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: 'center'
        }
      }
    });

    // Function to update chart based on selected month and year
    function updateChart() {
      var selectedMonth = document.getElementById("monthFilter-dashboard").value;
      var selectedYear = document.getElementById("yearFilter-dashboard").value;

      // Fetch data based on selected month and year
      fetch('update_chart.php?month=' + selectedMonth + '&year=' + selectedYear)
        .then(response => response.json())
        .then(data => {
          myChart.data.datasets[0].data = [data.pending_count, data.approved_count, data.declined_count];
          myChart.update();
        });
    }

    // Listen for changes in month and year filters
    document.getElementById("monthFilter-dashboard").addEventListener("change", updateChart);
    document.getElementById("yearFilter-dashboard").addEventListener("change", updateChart);
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
</body>
</html>

