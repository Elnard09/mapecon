<?php
// Include necessary files and initialize database connection
include("../sql/config.php");
include("../sql/function.php");

// Include the FPDF library
require("/xampp/htdocs/mapecon/fpdf/fpdf.php");

// Create new FPDF instance
$pdf = new FPDF();

// Retrieve selected IDs from the POST request
$selectedIds = json_decode($_POST['selected']);

// Add a page
$pdf->AddPage();

// Loop through each selected ID and generate PDF content
foreach ($selectedIds as $application_id) {
    $query = "SELECT l.*, u.firstname, u.lastname, u.department, u.contactnumber 
              FROM leave_applications AS l
              INNER JOIN users AS u ON l.user_id = u.user_id
              WHERE l.application_id = '$application_id'";
    $result = mysqli_query($connection, $query);


    // Check if query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set the path to your background image
        $background = $_SERVER['DOCUMENT_ROOT'] . "/mapecon/Pictures/leave form.png";

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
        $pdf->Cell(91, 15, $row['date_filed'], 0, 0);
        $pdf->Cell(0, 15, $row['department'], 0, 1);
        $pdf->Cell(20, 10, '', 0, 0);
        $pdf->Cell(0, 1, $row['firstname'] . ' ' . $row['lastname'], 0, 1);
        $pdf->Cell(96, 10, '', 0, 0);
        $pdf->Cell(0, 15, $row['contactnumber'], 0, 1);
        $pdf->Cell(21, 10, '', 0, 0);
        $pdf->Cell(81, 16, $row['from_date'], 0, 0);
        $pdf->Cell(0, 16, $row['to_date'], 0, 1);
        $pdf->Cell(102, 10, '', 0, 0);
        $pdf->Cell(0, 1, $row['working_days_covered'], 0, 1);
        $pdf->Cell(46, 10, '', 0, 0);
        if ($row['leave_type'] == "Others") {
            $pdf->Cell(0, 14, "Others ", 0, 1);
            $pdf->Cell(57, 0, '', 0, 0);
            $pdf->Cell(0, 1, "Others: " . $row['leave_type_others'], 0, 1);
        } else {
            $pdf->Cell(0, 14, $row['leave_type'], 0, 1);
        }
        $pdf->Cell(3, 10, '', 0, 0);
        $pdf->Cell(0, 42, $row['reason'], 0, 1);
    } else {
        die('Error executing query or no data found.');
    }
}

// Output the PDF
$pdf->Output();
?>
