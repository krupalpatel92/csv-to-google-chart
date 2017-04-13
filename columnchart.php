<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<title>GDP</title>
<body>
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/lib/readcsv.php");
$DataFile = $_SERVER['DOCUMENT_ROOT'] . "/CSV-to-Gchart/csv/gdp.csv";
$GChartData = csv_to_array($DataFile);
$full_chart_data = BuildDataTable($GChartData['data'], $GChartData['header']);
?>
<script type="text/javascript">

    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable(<?php echo $full_chart_data; ?>);

        var view = new google.visualization.DataView(data);
        var options = {
            chartArea: {
                top: "10%",
                left: "10%",
                height: "50%",
                width: "85%"
            },
            bar: {groupWidth: "70%"},
            legend: {position: 'top'},
            hAxis:{
                maxTextLines: 1,
                direction: -1,
                slantedText: true
            },
            vAxis: {format: '', gridlines: {count: 3}},
            colors: ['#fba919', '#ec1f27'],
        };

        var chart = new google.visualization.ColumnChart(document.getElementById("chart"));
        chart.draw(view, options);

    }
</script>

<h3 align="center" style="font-family: Arial;">Column Chart</h3>
<div id="chart" style="width:800px; height:400px; margin:0 auto;"></div>

<!-- <h3>Ms Excel chart</h3>
<div style="height:271px; overflow:hidden;">
<iframe width="423" height="297" frameborder="0" scrolling="no" src="https://onedrive.live.com/embed?cid=1D0C769245C7B16A&resid=1D0C769245C7B16A%21134&authkey=ALtbhHgOodf-fwc&em=2&wdAllowInteractivity=False&Item=Chart%20350&wdDownloadButton=True"></iframe>
</div>
 -->
<!--<iframe width="700" height="600" frameborder="0" scrolling="no" src="https://onedrive.live.com/embed?cid=1D0C769245C7B16A&resid=1D0C769245C7B16A%21132&authkey=AF6zOsEIPh7KxhA&em=2&wdAllowInteractivity=False&Item=Chart%205&wdDownloadButton=True"></iframe>-->

</body>
</html>