<?php

$ptr = new mysqli("localhost", "dbdump", "Sm8!6MeuRK", "dco_user");

/* check connection */
if ($ptr->connect_errno) {
    printf("Connect failed: %s\n", $ptr->connect_error);
    exit();
}

$sql = "select count(hashid) as count from REQUESTINFO where status = \"ACCEPTED\" AND actedOn > DATE_SUB(NOW(),INTERVAL 6 MONTH);" ;

$n6m = 0 ;
if ($result = $ptr->query($sql))
{
    $obj = $result->fetch_object() ;
    $n6m = $obj->count ;
}
global $n6m ;

$sql = "select count(hashid) as count from REQUESTINFO where status = \"ACCEPTED\" AND actedOn > DATE_SUB(NOW(),INTERVAL 2 MONTH);" ;

$n2m = 0 ;
if ($result = $ptr->query($sql))
{
    $obj = $result->fetch_object() ;
    $n2m = $obj->count ;
}
global $n2m ;

$sql = "select count(hashid) as count from REQUESTINFO where status = \"ACCEPTED\" AND actedOn > DATE_SUB(NOW(),INTERVAL 1 MONTH);" ;

$n1m = 0 ;
if ($result = $ptr->query($sql))
{
    $obj = $result->fetch_object() ;
    $n1m = $obj->count ;
}
global $n1m ;

$sql = "select count(hashid) as count from REQUESTINFO where status = \"ACCEPTED\" AND actedOn > DATE_SUB(NOW(),INTERVAL 1 WEEK);" ;

$n1w = 0 ;
if ($result = $ptr->query($sql))
{
    $obj = $result->fetch_object() ;
    $n1w = $obj->count ;
}
global $n1w ;

$ptr->close();
?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> New Members Bar Chart </title>

  <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>




  <link rel="stylesheet" type="text/css" href="/dco-viz/css/result-light.css">

  <style type='text/css'>

  </style>



<script type='text/javascript'>//<![CDATA[

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'New DCO Member Registrations'
        },
        xAxis: {
            categories: [''],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'New Members',
                align: 'middle'
            },
            labels: {
                overflow: 'justify'
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 20,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '6 months',
            data: [<?=$n6m?>]
        }, {
            name: '2 months',
            data: [<?=$n2m?>]
        }, {
            name: '1 month',
            data: [<?=$n1m?>]
        }, {
            name: '1 week',
            data: [<?=$n1w?>]
        }]
    });
});
//]]>

</script>


</head>
<body>
  <script src="//code.highcharts.com/highcharts.js"></script>
<script src="//code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>


</body>


</html>
