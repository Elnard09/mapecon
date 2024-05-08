<?php
session_start();

include("../sql/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedIds = json_decode($_POST['selected']);

    // Select leave applications with the selected ids
    $sql = "SELECT l.*, UCASE(CONCAT(u.lastname, ', ', u.firstname)) AS full_name
            FROM leave_applications AS l 
            INNER JOIN users AS u ON l.user_id = u.user_id
            WHERE l.id IN (" . implode(",", $selectedIds) . ")
            ORDER BY l.id DESC";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Define CSV content
        $csvData = "Full Name,Type of Leave,Date Filed,Date Requested,Leave Until\n";
        while($row_data = $result->fetch_assoc()) {
            $csvData .= '"' . $row_data['full_name'] . '","' . $row_data['leave_type'] . '","' . $row_data['date_filed'] . '","' . $row_data['from_date'] . '","' . $row_data['to_date'] . "\"\n";
        }

        // Set headers to force download
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=approved_leaves.csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Output CSV data
        echo $csvData;
        exit;
    } else {
        echo "No data found";
    }
}
?>
