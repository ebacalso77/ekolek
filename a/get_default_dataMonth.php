<?php
include "../connection.php";

// Query the database for data within the date range
$sql="
SELECT baranggay.b_name AS barangay_name, COUNT(tbl_report.report_b_id) AS report_count
        FROM tbl_report
        INNER JOIN baranggay ON baranggay.b_id = tbl_report.report_b_id
        GROUP BY baranggay.b_id, baranggay.b_name ORDER BY report_count DESC;
";

$result = $con->query($sql);

// Prepare the data in the format expected by Google Charts
$dataMonth = array();
$dataMonth[] = ['Baranggay','Total Complaints'];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataMonth[] = [ucwords($row['barangay_name']), (int)$row['report_count']];
    }
}

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($dataMonth);