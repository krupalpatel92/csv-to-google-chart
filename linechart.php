<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<title>Auto Sales</title>
<body>
<?php

if (isset($_POST['chartcsv']) && $_POST['chartcsv'] != "") {
    $user_image = $_FILES['uploadcsv']['name'];
    $tmp_name = $_FILES['uploadcsv']['tmp_name'];
    $imagepath = getcwd() . "/";
    $filename = explode(".", $user_image);
    $newfilename = "auto." . $filename[1];

    //unlink old image
    if (file_exists($imagepath . "auto.csv")) {
        @unlink($imagepath . "auto.csv");
    }

    if (move_uploaded_file($tmp_name, $imagepath . $newfilename)) {
        echo "File uploading finish";
    } else {
        die("Something went wrong in file upload.");
    }

}


if (file_exists(getcwd() . "/csv/auto.csv")) {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/lib/readcsv.php");
    $DataFile = $_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/csv/auto.csv";

    $GChartData = csv_to_array($DataFile);
    $full_chart_data = BuildDataTable($GChartData['data'], $GChartData['header']);
    ?>
    <script type="text/javascript">
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $full_chart_data; ?>);

            var options = {
                curveType: 'function',
                chartArea: {
                    top: "10%",
                    left: "10%",
                    height: "70%",
                    width: "85%"
                },
                vAxis: {format: 'percent', gridlines: {count: 4}},
                hAxis: {slantedTextAngle: 90},
                legend: {position: 'top'},
                lineWidth: 4,
                series: {
                    0: {color: '#fba919'},
                    1: {color: '#ec1f27'},
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart'));
            chart.draw(data, options);
        }
    </script>
<?php } ?>
<h3>Our chart</h3>
<form action="auto.php" method="post" enctype="multipart/form-data">
    <label for="uploadcsv">Upload CSV :</label>
    <input type="file" name="uploadcsv" id="uploadcsv" required/><br/>
    <input type="submit" name="chartcsv" value="Upload"/>
</form>


<h3 align="center" style="font-family: Arial;">Line Chart</h3>
<div id="chart" style="width:800px; height:500px; margin:0 auto;"></div>
</body>
</html>