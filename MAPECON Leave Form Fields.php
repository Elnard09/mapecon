<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get form data

//echo "Current Date: " . $currentDate;
$date_filed = $_POST['date_filed'];;
//$department = $_POST['department'];
//$name = $_POST['name'];
//$contact_number = $_POST['contact_number'];
$leave_from = $_POST['from-date'];
$leave_to = $_POST['to-date'];
$working_days_covered = $_POST['others'];
$leave_type = $_POST['leave-type'];
$reason = $_POST['reason'];

// Include the FPDF library (you need to download and include it in your project)
require('C:/xampp/htdocs/maps/fpdf/fpdf.php');

// Create a new FPDF object
$pdf = new FPDF();

// Add a page
$pdf->AddPage();

// Set the path to your background image
$background = 'C:/xampp/htdocs/maps/user/leave.png';

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
//$pdf->Cell($width, $height, $text, $border, $ln, $align, $fill, $link);
$pdf->Cell(0, 15, '', 0, 1);
$pdf->Cell(35, 10, '', 0, 0);
$pdf->Cell(91, 15, /*'DATE FILED: ' .*/ $date_filed, 0, 0);
//$pdf->Cell(0, 15, /*'DEPARTMENT: ' .*/ $department, 0, 1);
$pdf->Cell(20, 10, '', 0, 0);
//$pdf->Cell(0, 1, /*'NAME: ' .*/ $name, 0, 1);
$pdf->Cell(96, 10, '', 0, 0);
//$pdf->Cell(0, 15, /*'CONTACT NUMBER WHILE ON LEAVE: ' .*/ $contact_number, 0, 1);
$pdf->Cell(21, 10, '', 0, 0);
$pdf->Cell(81, 16, /*'DATE/S OF REQUESTED LEAVE: FROM ' .*/ $leave_from, 0, 0);
$pdf->Cell(0, 16, $leave_to, 0, 1);
$pdf->Cell(102, 10, '', 0, 0);
$pdf->Cell(0, 1, /*'NUMBER OF WORKING DAYS COVERED: ' .*/ $working_days_covered, 0, 1);
$pdf->Cell(46, 10, '', 0, 0);
$pdf->Cell(0, 14, /*'TYPE OF LEAVE: ' .*/ $leave_type, 0, 1);
$pdf->Cell(3, 10, '', 0, 0);
$pdf->Cell(0, 44, /*'REASON FOR LEAVE: ' .*/ $reason, 0, 1);

// Output the PDF (uncomment one option)
// $pdf->Output('leave_form.pdf', 'D'); // Download
$pdf->Output(); // Display in browser for preview
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leave Filing</title>
  <link rel="stylesheet" href="style.css">
  
</head>
<body>
  <special-header></special-header>
  <h2 class="h2_field">New Leave Application</h2>
  <div class="leave-application">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="leave-type">Leave Type:</label>
      <div class="leave-type">
        <select name="leave-type" id="leave-type">
          <option value="">Select</option>
          <option value="casual leave">Casual Leave</option>
          <option value="compensatory">Compensatory Off</option>
          <option value="unpaid">Leave Without Pay</option>
          <option value="privilege leave">Privilege Leave</option>
          <option value="sick">Sick Leave</option>
          <option value="vacation">Vacation Leave</option>
          <option value="vacation">Others</option>
        </select>
      </div>
      <label for="others">Others:</label>
      <input type="text" id="others" name="others" >
      <label for="from-date">From Date:</label>
      <div class="from-date-date-range">
        <div class="from-date">
          <input type="date" name="from-date" id="from-date">
        </div>
      </div>
      <label for="to-date">To Date:</label>
      <div class="to-date-date-range">
    <div class="to-date">
        <input type="date" name="to-date" id="to-date">
      </div>
    </div>
    <label for="numofDays">Number of working days covered:</label>
      <input type="text" id="numofDays" name="others" >
    <label for="reason">Reason:</label>
      <div class="reason">
        <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
      </div>
      <div class="buttons">
        <button type="button">Cancel</button>
        <button type="submit" id="pdf-btn">Save as PDF</button>
        <button type="submit"id="submit-btn">Submit to HR</button>
      </div>
      <input type="hidden" id="date_filed" name="date_filed" value="<?php echo date('m-d-Y'); ?>">
    </form>
  </div>
</body>
<script src="./headerManager.js"></script>
</html>