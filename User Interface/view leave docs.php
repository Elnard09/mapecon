<?php
include("../sql/config.php");
include("../sql/function.php");
  // Include the FPDF library
  require("/xampp/htdocs/mapecon/fpdf/fpdf.php");

  // Fetch leave application details from the database
  // Replace this with your actual database query
  // Example:
  $application_id = $_GET['application_id'];
  $query = "SELECT * FROM leave_applications WHERE application_id = '$application_id'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);

  // Create a new FPDF object
  $pdf = new FPDF();

  // Add a page
  $pdf->AddPage();

  // Set the path to your background image
  $background = "/xampp/htdocs/mapecon/Pictures/leave form.png";

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

  // Output form
  $pdf->Cell(0, 15, '', 0, 1);
  $pdf->Cell(35, 10, '', 0, 0);
  $pdf->Cell(91, 15, /*'DATE FILED: ' .*/ $date_filed, 0, 0);
  $pdf->Cell(0, 15, /*'DEPARTMENT: ' .*/ $user_data['department'], 0, 1);
  $pdf->Cell(20, 10, '', 0, 0);
  $pdf->Cell(0, 1, /*'NAME: ' .*/ $user_data['firstname'] . ' ' . $user_data['lastname'], 0, 1);
  $pdf->Cell(96, 10, '', 0, 0);
  $pdf->Cell(0, 15, /*'CONTACT NUMBER WHILE ON LEAVE: ' .*/ $user_data['contactnumber'], 0, 1);
  $pdf->Cell(21, 10, '', 0, 0);
  $pdf->Cell(81, 16, /*'DATE/S OF REQUESTED LEAVE: FROM ' .*/ $leave_from, 0, 0);
  $pdf->Cell(0, 16, $leave_to, 0, 1);
  $pdf->Cell(102, 10, '', 0, 0);
  $pdf->Cell(0, 1, /*'NUMBER OF WORKING DAYS COVERED: ' .*/ $working_days_covered, 0, 1);
  $pdf->Cell(46, 10, '', 0, 0);
  if ($leave_type == "Others") {
    $pdf->Cell(0, 14, "Others ", 0, 1);
    $pdf->Cell(57, 0, '', 0, 0);
    $pdf->Cell(0, 1, /*"Others: " */ $leave_type_others, 0, 1);
  } else {
    $pdf->Cell(0, 14, $leave_type, 0, 1);
  }
  $pdf->Cell(3, 10, '', 0, 0);
  $pdf->Cell(0, 42, /*'REASON FOR LEAVE: ' .*/ $reason, 0, 1);

  // Output the PDF
  $pdf->Output();
?>
