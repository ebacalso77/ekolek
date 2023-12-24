<?php
session_start();
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator | E-Kolek</title>

    <!-- Custom fonts for this template-->

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/admin-2.min.css" rel="stylesheet">
    <link rel="icon" href="../img/recycle.png">
    <script src="script.js"></script>
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!--Collection Ratings-->
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Satisfaction Level');
            data.addColumn('number', 'Count');

            // Replace these values with your actual data
            data.addRows([
                <?php
                    $data= mysqli_query($con,"SELECT ratings,count(ratings) as total FROM tbl_collection_ratings group by ratings ");
                    if (mysqli_num_rows($data)>0){
                        while ($r=mysqli_fetch_assoc($data)){
                            if ($r['ratings']=="1"){
                               ?>
                ['Not at all satisfied', <?=$r['total']?>],
            <?php
                            }elseif ($r['ratings']=="2"){
                ?>
                ['Slightly satisfied', <?=$r['total']?>],
                <?php
            }elseif ($r['ratings']=="3"){
                ?>
                ['Moderately satisfied', <?=$r['total']?>],
                <?php
                }elseif ($r['ratings']=="4"){
                ?>
                ['Very satisfied', <?=$r['total']?>],
                <?php
                }elseif ($r['ratings']=="5"){
                ?>
                ['Extremely satisfied', <?=$r['total']?>],
                <?php
                }
                        }
                    }
                ?>
                // ['Not at all satisfied', 2],
                // ['Slightly satisfied', 5],
                // ['Moderately satisfied', 10],
                // ['Very satisfied', 8],
                // ['Extremely satisfied', 15]
            ]);

            // Set chart options
            var options = {
                title: 'Collection Satisfaction Ratings ',
                colors: ['#FF0000', '#FF9900', '#ffef2c', '#99FF00', '#00FF00'], // Set colors for each satisfaction level
                pieHole: 0.4, // Set pie hole to create a donut chart
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div10'));
            chart.draw(data, options);
        }
    </script>
    <!--Collection Ratings-->

    <!--Baranggay with most common complaints-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        // Create a data array in JavaScript
        var data = google.visualization.arrayToDataTable([
            ['Barangay', 'Complaint Records', { role: 'style' }, { role: 'annotation' }],
            <?php
                if (isset($_POST['show'])){
                    $from=$_POST['from'];
                    $to=$_POST['to'];

                    $records_query = "SELECT baranggay.b_name AS barangay_name, COUNT(tbl_report.report_b_id) AS report_count
                    FROM tbl_report
                    INNER JOIN baranggay ON baranggay.b_id = tbl_report.report_b_id
                    WHERE date_reported BETWEEN '$from' and '$to'
                    GROUP BY baranggay.b_id, baranggay.b_name ORDER BY report_count DESC";

                    $result = mysqli_query($con, $records_query);

                    if (mysqli_num_rows($result) > 0) {
                        $max_report_count = 0;

                        // Calculate the maximum report count first
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count = $row['report_count'];
                            if ($count > $max_report_count) {
                                $max_report_count = $count;
                            }
                        }

                        // Reset the result set to the beginning
                        mysqli_data_seek($result, 0);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $count = $row['report_count'];

                            // Calculate the percentage based on the maximum report count
                            $percentage = ($count / $max_report_count) * 100;

                            // Determine the color based on the percentage
                            if ($percentage >= 90) {
                                echo "['" . ucwords($row['barangay_name']) . "', " . $count . ", 'color: red', '" . number_format($percentage, 2) . "%'],";
                            } elseif ($percentage >= 70) {
                                echo "['" . ucwords($row['barangay_name']) . "', " . $count . ", 'color: #FFC300', '" . number_format($percentage, 2) . "%'],";
                            } elseif ($percentage >= 40) {
                                echo "['" . ucwords($row['barangay_name']) . "', " . $count . ", 'color: brown', '" . number_format($percentage, 2) . "%'],";
                            } else {
                                echo "['" . ucwords($row['barangay_name']) . "', " . $count . ", 'color: blue', '" . number_format($percentage, 2) . "%'],";
                            }
                        }
                    }
                } else {
                    // Default date range (e.g., last month)
                    $from = date("Y-m-d", strtotime("-1 month"));
                    $to = date('Y-m-d');

                    $records_query = "SELECT baranggay.b_name AS barangay_name, COUNT(tbl_report.report_b_id) AS report_count
                    FROM tbl_report
                    INNER JOIN baranggay ON baranggay.b_id = tbl_report.report_b_id
                    WHERE date_reported BETWEEN '$from' and '$to'
                    GROUP BY baranggay.b_id, baranggay.b_name ORDER BY report_count DESC";

                    $result = mysqli_query($con, $records_query);

                    if (mysqli_num_rows($result) > 0) {
                        $max_report_count = 0;

                        // Calculate the maximum report count first
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count = $row['report_count'];
                            if ($count > $max_report_count) {
                                $max_report_count = $count;
                            }
                        }

                        // Reset the result set to the beginning
                        mysqli_data_seek($result, 0);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $count = $row['report_count'];

                            // Calculate the percentage based on the maximum report count
                            $percentage = $count;

                            // Determine the color based on the percentage

                                echo "['" . ucwords($row['barangay_name']) . "', " . $count . ", 'color: green', '" .$percentage . "'],";

                        }
                    }
                }
             ?>
        ]);

        var options = {
            title: 'Most Common Barangay with Usual Complaint Records',
            legend: { position: 'bottom' }
        };
        // Create a new pie chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div9'));

        // Add an event listener to handle clicks on pie slices
        google.visualization.events.addListener(chart, 'select', function() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                // Get the selected barangay name
                var barangayName = data.getValue(selectedItem.row, 0);

                // Redirect to the complaint table with the selected barangay name
                window.location.href = 'complaint.php?barangay=' + encodeURIComponent(barangayName);
            }
        });

        // Draw the chart
        chart.draw(data, options);
    }
    </script>
    <!--End Baranggay with most common complaints-->

    <?php
    // Fetch data from the database
    $query = "SELECT baranggay.b_name, baranggay.b_id, SUM(tbl_collection_completion_report.ccr_total_truck) AS total_collection
FROM baranggay
INNER JOIN tbl_collection_completion_report ON baranggay.b_id = tbl_collection_completion_report.ccr_brgy
GROUP BY baranggay.b_name, baranggay.b_id;";

    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }

    // Create an array to hold the chart data
    $chartData = array();
    $chartData[] = ['Barangay', 'Percentage'];

    $totalCollection = 0;

    // Calculate total collection
    while ($row = mysqli_fetch_assoc($result)) {
        $totalCollection += $row['total_collection'];
    }

    // Calculate percentage and add data to the chart array
    mysqli_data_seek($result, 0); // Reset the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $percentage = ($row['total_collection'] / $totalCollection) * 100;
        $chartData[] = [ucwords($row['b_name']), $percentage];
    }

    // Encode the data as JSON
    $data_json = json_encode($chartData);
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($chartData); ?>);

            // Define custom colors for each barangay
            var colors = ['#3a33ff', '#33FF57', '#5733FF', '#FF33E1', '#33E1FF', '#E1FF33'];

            var options = {
                title: 'Collection Percentage by Barangay',
                legend: 'none',
                chartArea: {width: '80%'},
                hAxis: {
                    title: 'Percentage',
                    minValue: 0,
                    maxValue: 100,
                    format: '#\'%\''
                },
                vAxis: {
                    title: 'Barangay'
                },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        bold: true,
                    }
                },
                colors: colors
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div8'));

            chart.draw(data, options);
        }
    </script>

    <!--    Total Number of Complaints per Day chart1-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Sample data for the chart
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Complaints'],
                <?php
                $show=mysqli_query($con,"SELECT DATE(date_reported) AS reported_date, COUNT(*) AS total_reports
FROM tbl_report
GROUP BY reported_date
ORDER BY total_reports DESC
LIMIT 5;");

                if (!$show) {
                    die("Query failed: " . mysqli_error($con));
                }
                if (mysqli_num_rows($show)>0){
                while ($r=mysqli_fetch_assoc($show)){
                ?>
                ['<?=$r['reported_date']?>', <?=$r['total_reports']?>],
                <?php
                }
                }else{
                echo 0;
            }
                ?>
            ]);

            var options = {
                title: 'Total Number of Complaints per Day',
                curveType: 'function', // Line chart overlay
                hAxis: { title: 'Total Complaints' },
                vAxis: { title: 'Date' },
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.BarChart(document.getElementById('chart_div1'));
            chart.draw(data, options);
        }
    </script>


    <!--    Complaint Status Distribution chart2-->
    <?php
    // Retrieve the total count for each status from the tbl_report table
    $query = "SELECT 
            COUNT(*) as total,
            status
          FROM tbl_report
          WHERE status IN ('pending', 'on-process', 'verified', 'done', 'rated')
          GROUP BY status";

    if (!$query) {
        die("Query failed: " . mysqli_error($con));
    }
    $result = mysqli_query($con, $query);

    // Create an empty array to store the status and count data
    $data = array();

    // Fetch the data from the result and add it to the data array
    while ($row = mysqli_fetch_assoc($result)) {
        $status = ucfirst($row['status']);
        $count = intval($row['total']);
        $data[] = array($status, $count);
    }

    // Generate the JavaScript code for the Google Charts
    function generateChartJS($data)
    {
        $chartData = json_encode($data);
        echo <<<HTML
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
  
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Count');
        data.addRows($chartData);
  
        var options = {
                title: 'Complaint Status Distribution',
                pieHole: 0.4, // Create a donut hole in the center
                legend: { position: 'bottom' }
            };
  
        var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
    </script>
    HTML;
    }

    // Generate the chart using the data
    generateChartJS($data);
    ?>

    <!--    Complaint Rating Trend chart3-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Sample data for the chart
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Total', { role: 'annotation' }],
                <?php
                $query = "SELECT
  DATE(tbl_report.date_reported) AS date_reported,
  tbl_report_feedback.rf_rate,
  COUNT(*) AS total_occurrences
FROM
  tbl_report_feedback
INNER JOIN
  tbl_report ON tbl_report.report_id = tbl_report_feedback.rf_report_id
GROUP BY
  rf_rate,date_reported";
                $result = mysqli_query($con, $query);
                if (!$result) {
                    die("Query failed: " . mysqli_error($con));
                }
                $s="";
                if (mysqli_num_rows($result)>0){
                while ($r = mysqli_fetch_assoc($result)){
                if ($r['rf_rate']=="1"){
                    $s= 'Fair';
                } elseif ($r['rf_rate']=="2"){
                    $s= 'Poor';
                } elseif ($r['rf_rate']=="3"){
                    $s='Good';
                } elseif ($r['rf_rate']=="4"){
                    $s='Better';
                } elseif ($r['rf_rate']=="5"){
                    $s='Best';
                }
                ?>
                ['<?=$r['date_reported']?>', <?=intval($r['total_occurrences'])?>, '<?=$s?>'],
                <?php
                }
                }
                ?>
                // Add more data points here
            ]);

            var options = {
                title: 'Complaint Rating Trend',
                curveType: 'function', // Line chart overlay
                hAxis: { title: 'Date' },
                vAxis: { title: 'Total Count of Ratings' ,format:'0'},
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
            chart.draw(data, options);
        }
    </script>



    <!--    Complaint Addressing Time chart4-->
    <?php
    // Query to calculate the total difference and group by s_status
    $query = "SELECT
            rs.s_status,
            SUM(TIMESTAMPDIFF(DAY, r.date_reported, rs.s_date_updated)) AS total_difference
          FROM
            tbl_report r
          JOIN
            tbl_report_status rs ON r.report_id = rs.s_report_id
          WHERE
            rs.s_status IN ('pending', 'on-process', 'verified', 'done', 'rated')
          GROUP BY
            rs.s_status";

    if (!$query) {
        die("Query failed: " . mysqli_error($con));
    }
    $result = mysqli_query($con, $query);

    // Create an empty array to store the status and total difference data
    $data = array();

    // Define colors for each status
    $colors = array('#6c6665', '#FFC300', '#36A2EB', '#39E639', '#FFC0CB');

    // Fetch the data from the result and add it to the data array
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $status = ucfirst($row['s_status']);
        $difference = intval($row['total_difference']);
        $annotation = $status;
        $data[] = array($status, $difference, $colors[$i % count($colors)], $annotation);
        $i++;
    }

    // Generate the JavaScript code for the Google Charts
    function generateChartJS1($data)
    {
        $chartData = json_encode($data);
        echo <<<HTML
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
  
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Total Days');
        
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn({type: 'string', role: 'annotation'});
        data.addRows($chartData);
  
        var options = {
          title: 'Complaint Addressing Time',
          hAxis: { title: 'Status' },
          vAxis: { title: 'Total Days', format:'0' },
          legend: { position: 'none' },
          annotations: { textStyle: { fontSize: 12 } }
        };
  
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div4'));
        chart.draw(data, options);
      }
    </script>
    HTML;
    }

    // Generate the chart using the data
    generateChartJS1($data);
    ?>


    <!--    Collector Weekly Satisfaction Report-->
    <script>
        const weeklySatisfactionData = [
            ['Week Date', 'Satisfaction'],
            <?php
            $get_data=mysqli_query($con,"SELECT AVG(ratings_no) as average_ratings, date_rated FROM tbl_collector_satisfactory_rating group by date_rated");

            if (!$get_data) {
                die("Query failed: " . mysqli_error($con));
            }
            if (mysqli_num_rows($get_data)>0){
            while ($dg=mysqli_fetch_assoc($get_data)){
            ?>
            ['<?=date(" D d M,Y",strtotime($dg['date_rated']))?>', <?=(int)$dg['average_ratings']?>],
            <?php
            }
            }
            ?>
        ];
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const data = google.visualization.arrayToDataTable(weeklySatisfactionData);

            const options = {
                title: 'Weekly Satisfaction Report',
                legend: { position: 'bottom' },
                vAxis: { title: 'Percentage' },
                hAxis: { title: 'Friday in a Week' },
                annotations: {
                    textStyle: {
                        fontSize: 12,
                        bold: true,
                        color: '#000',
                        auraColor: 'none',
                    },
                },
            };

            const chart = new google.visualization.LineChart(document.getElementById('chart_div7'));
            chart.draw(data, options);
        }
    </script>



    <!--    Feedback Report-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Fetch the data from the database using PHP
            <?php
            // Fetch data from tbl_report_feedback
            $sql = "SELECT 
      rf_rate, 
      CASE 
        WHEN rf_rate = '1' THEN 'Fair'
        WHEN rf_rate = '2' THEN 'Poor'
        WHEN rf_rate = '3' THEN 'Good'
        WHEN rf_rate = '4' THEN 'Better'
        WHEN rf_rate = '5' THEN 'Best'
      END AS category,
      COUNT(*) AS count
    FROM tbl_report_feedback
    GROUP BY rf_rate;";

            if (!$sql) {
                die("Query failed: " . mysqli_error($con));
            }
            $result = $con->query($sql);

            // Create the data table
            echo "var data = new google.visualization.DataTable();";
            echo "data.addColumn('string', 'Feedback Rating');";
            echo "data.addColumn('number', 'Total');";
            echo "data.addColumn({type: 'string', role: 'annotation'});";
            echo "data.addColumn({type: 'string', role: 'style'});"; // Add column for bar color
            echo "data.addRows([";

            // Define colors for each rating
            $colors = ['#6c6665', '#FFC300', '#36A2EB', '#39E639', '#FFC0CB'];

            // Iterate through the fetched data and add rows
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $rf_rate = $row['rf_rate'];
                $count = $row['count'];
                $category = $row['category'];
                $color = $colors[$i % count($colors)]; // Get color based on index

                echo "['$rf_rate', $count, '$category', '$color'],";
                $i++;
            }

            echo "]);";
            ?>

            // Set chart options
            var options = {
                title: 'Feedback Report',
                annotations: {
                    textStyle: {
                        fontSize: 14
                    }
                },
                hAxis: { title: 'Total Count per Rating', format: '0' },
                vAxis: { title: 'Rating' },
                legend: { position: 'none' }
            };

            // Instantiate and draw the chart
            var chart = new google.visualization.BarChart(document.getElementById('chart_div5'));
            chart.draw(data, options);
        }
    </script>

    <!--    Weekly Total Collected Waste per Baranggay-->
    <script type="text/javascript">
        // Load the Google Charts API
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(fetchDefaultData);

        function drawChart(data, fromDate, toDate) {
            var chartData = new google.visualization.arrayToDataTable(data);

            var options = {
                chart: {
                    title: 'Weekly Total Collected Waste per Baranggay',
                    titleTextStyle: {
                        fontSize: 18, // Adjust the font size as needed
                        bold: true,
                        textAlign: 'center' // Align the title in the center
                    }
                },
                height: 400,
                width: 615,
                bars: 'vertical',
                bar: { groupWidth: '50%' }, // Adjust the bar width as needed
                legend: { position: 'none' },
                series: {
                    1: { color: 'green' } // Change the color of the bars to green
                }
            };

            // Add subtitle with the selected date range
            options.subtitle = 'Selected Date Range: ' + fromDate + ' to ' + toDate;

            var chart = new google.charts.Bar(document.getElementById('chart_div6'));
            chart.draw(chartData, google.charts.Bar.convertOptions(options));
        }
        function fetchDefaultData() {
            // Perform initial AJAX request to fetch default data
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    var fromDate = "Week "+data[1][1]; // Assuming date is the second column in the default data
                    var toDate ="Week"+ data[data.length - 1][1]; // Assuming date is the second column in the default data
                    drawChart(data, fromDate, toDate);
                }
            };
            xhr.open('GET', 'get_default_data.php', true);
            xhr.send();
        }

        function getChartData() {
            var fromDate = document.getElementById('from_date').value;
            var toDate = document.getElementById('to_date').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    drawChart(data, fromDate, toDate);
                }
            };
            xhr.open('GET', 'get_data.php?from_date=' + fromDate + '&to_date=' + toDate, true);
            xhr.send();
        }
    </script>

</head>
