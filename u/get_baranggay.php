<?php
include "../connection.php";

$municipalityId = $_POST["municipalityId"];

// Query to fetch barangays based on the selected municipality
$sql = "SELECT * FROM baranggay WHERE m_id = $municipalityId";
$result = $con->query($sql);

// Generate the HTML options for the barangay selection
$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row["b_id"] . "'>" . ucwords($row["b_name"]) . "</option>";
    }
}else{
    $options .= "<option value=''>No Listed Baranggay.</option>";
}

// Return the generated options
echo $options;

