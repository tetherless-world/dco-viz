<?php
$ptr = new mysqli("localhost", "dbdump", "Sm8!6MeuRK", "dco_user");

/* check connection */
if ($ptr->connect_errno) {
    printf("Connect failed: %s\n", $ptr->connect_error);
    exit();
}

$sql = "select date_format(date(actedOn),\"%Y,%m,%d\") as date, count(hashid) as number from REQUESTINFO WHERE status = \"ACCEPTED\" AND actedOn is not null GROUP BY date(actedOn) ORDER BY actedOn;" ;

$json = "[\n" ;
$isfirst = true ;
if ($result = $ptr->query($sql))
{
    while($obj = $result->fetch_object())
    {
        $d = $obj->date ;
        $darr = explode( ",", $d ) ;
        $y = $darr[0] ;
        $m = $darr[1]-1 ;
        $d = $darr[2] ;
        $n = $obj->number ;
        if( !$isfirst ) $json .= ",\n" ;
        $isfirst = false ;
        $json .= "[Date.UTC($y,$m,$d),$n]" ;

    }
}
$json .= "\n]" ;

$ptr->close();
?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title> - jsFiddle demo</title>
  
  <script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
  
  
  
  
  <link rel="stylesheet" type="text/css" href="/css/result-light.css">
  
  <style type='text/css'>
    
  </style>
  


<script type='text/javascript'>//<![CDATA[ 

$(function () {
    $('#container').highcharts({
        chart: {
            zoomType: 'x'
        },
        title: {
            text: 'New Members Over Time'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
        },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'New Members'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            name: 'New Members',
            data: <?=$json?>
        }]
    });
});
//]]>  

</script>


</head>
<body>

  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>

  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  
</body>


</html>
