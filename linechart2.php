<html>
<head></head>
<title>Tread</title>
<body>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/lib/readcsv.php");
$DataFile = $_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/csv/tread.csv";
$GChartData = csv_to_array($DataFile);
$full_chart_data = BuildDataTable($GChartData['data'], $GChartData['header']);
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $full_chart_data; ?>);

        var options = {
            title: '',
            width: '100%',
            height: '100%',
            chartArea: {
                left: "3%",
                top: "3%",
                height: "85%",
                width: "85%"
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart'));
        chart.draw(data, options);
    }
</script>
<h3>Our chart</h3>
<div id="chart" style="height:400px; width:1100px;"></div>
</body>
</html>