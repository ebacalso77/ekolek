<?php
include "../connection.php";
// Get the date range from the AJAX request
$fromDate = $_GET['from_date'];
$toDate = $_GET['to_date'];

// Query the database for data within the date range
$sql="
SELECT baranggay.b_name AS barangay_name, 
               WEEK(ccr_date_collection) AS week_number,
               SUM(ccr_total_truck) AS total_waste
        FROM tbl_collection_completion_report
        INNER JOIN baranggay ON baranggay.b_id = tbl_collection_completion_report.ccr_brgy
        WHERE ccr_date_collection BETWEEN '$fromDate' AND '$toDate'
        GROUP BY baranggay.b_id, week_number,b_name;
";

$result = $con->query($sql);

// Prepare the data in the format expected by Google Charts
$dataArray = array();
$dataArray[] = ['Barangay', 'Week', 'Total Collected Waste'];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataArray[] = [ucwords($row['barangay_name']), $row['week_number'], (int)$row['total_waste']];
    }
}

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($dataArray);