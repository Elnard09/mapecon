<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Get form data
        $date_filed = $_POST['date_filed'];
        $leave_from = $_POST['from-date'];
        $leave_to = $_POST['to-date'];
        $leave_type = $_POST['leave-type'];
        $leave_type_others= $_POST['others'];
        $reason = $_POST['reason'];

        // Include the FPDF library (you need to download and include it in your project)
        require('fpdf/fpdf.php');

        // Create a new FPDF object
        $pdf = new FPDF();

        // Add a page
        $pdf->AddPage();

        // Set the path to your background image
        $background = 'Pictures/leave form.png';

        // Check if the image file exists before attempting to use it
        if (file_exists($background)) {
            // Place the image as a background
            $pdf->Image($background, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
        } else {
            die('Background image not found: ' . $background);
        }

        // Set font
        $pdf->SetFont('Arial', 'B', 16);

        // Set position for the content
        $pdf->SetXY(10, 10);

        // Output the title
        $pdf->Cell(0, 10, '', 0, 1, 'C');

        // Set font for the content
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(0, 0, 139);

        // Output form data
        $pdf->Cell(0, 15, '', 0, 1);
        $pdf->Cell(35, 10, '', 0, 0);
        $pdf->Cell(91, 15, $date_filed, 0, 0);
        $pdf->Cell(20, 10, '', 0, 0);
        $pdf->Cell(96, 10, '', 0, 0);
        $pdf->Cell(21, 10, '', 0, 0);
        $pdf->Cell(81, 16, $leave_from, 0, 0);
        $pdf->Cell(0, 16, $leave_to, 0, 1);
        $pdf->Cell(102, 10, '', 0, 0);
        $pdf->Cell(0, 1, $leave_type_others, 0, 1);
        // Concatenate the "Others" option with the user input if selected
        //if ($leave_type == "Others") {
            // $pdf->Cell(0, 14, "Others: " . $_POST['others'], 0, 1);
        // } else {
            // $pdf->Cell(0, 14, $leave_type, 0, 1);
        // }
        $pdf->Cell(46, 10, '', 0, 0);
        $pdf->Cell(0, 14, $leave_type, 0, 1);
        $pdf->Cell(3, 10, '', 0, 0);
        $pdf->Cell(0, 44, $reason, 0, 1);
   
        // Output the PDF (uncomment one option)
        // $pdf->Output('leave_form.pdf', 'D'); // Download
        $pdf->Output(); // Display in browser for preview
        exit; // Stop further execution
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Leave Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/mapecon/style.css">
</head>
<body>
  <special-header></special-header>

  <div class="menu"><span class="openbtn" onclick="toggleNav()">&#9776;</span>  EMP</div>
  
  <!-- Content -->
 <div class="content" id="content">

   <!-- Sidebar -->
   <div class="sidebar" id="sidebar">
    <a href="/mapecon/User Interface/User Leave Home.html" class="home-sidebar"><i class="fa fa-home"></i> Home</a>
    <span class="leave-label">NAVIGATE</span>
    <a href="/mapecon/User Interface/User Leave Form.html" id="active"><i class="fa fa-file-text-o"></i>Leave Application</a>
    <a href="/mapecon/User Interface/User Leave History.html"><i class="fa fa-file-word-o"></i> Leave History</a>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="closeNav()"></div>
  <div class="leave-application">
    <h2>New Leave Application</h2>
    <form action="<?php echo($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="leave-type">Leave Type:</label>
        <div class="leave-type">
            <select name="leave-type" id="leave-type">
                <option value="">Select</option>
                <option value="Casual">Casual Leave</option>
                <option value="Compensatory">Compensatory Off</option>
                <option value="Unpaid">Leave Without Pay</option>
                <option value="Privilege">Privilege Leave</option>
                <option value="Sick">Sick Leave</option>
                <option value="Vacation">Vacation Leave</option>
                <option value="Others">Others</option>
            </select>
        </div>
        <div id="others-container" style="display: none;">
            <label for="others">Others:</label>
            <input type="text" id="others" name="others">
        </div>
        <div class="date-range">
            <div class="from-date">
                <label for="from-date">From Date:</label>
                <input type="date" name="from-date" id="from-date">
            </div>
            <div class="to-date">
                <label for="to-date">To Date:</label>
                <input type="date" name="to-date" id="to-date">
            </div>
            <div class="num-of-days">
                <label for="numofDays">Working days covered:</label>
                <input type="number" id="numofDays" name="numofDays">
            </div>
        </div>
        <label for="reason" class="reason-label">Reason:</label>
        <div class="reason">
            <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
        </div>
        <div class="buttons">
            <button type="button" onclick="window.location.href='/mapecon/User Interface/User Leave Home.html';">Cancel</button>
            <button type="submit" name="pdf-btn" id="pdf-btn">Save as PDF</button>
            <button type="submit" id="submit-btn">Submit to HR</button>
        </div>
        <input type="hidden" id="date_filed" name="date_filed" value="<?php echo date('m-d-Y'); ?>">
    </form>
</div>
  
</div>
</body>
<script src="/mapecon/headerManager.js"></script>
<script>
    document.getElementById('leave-type').addEventListener('change', function() {
        var othersContainer = document.getElementById('others-container');
        if (this.value === 'Others') {
            othersContainer.style.display = 'block';
        } else {
            othersContainer.style.display = 'none';
        }
    });
  
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
