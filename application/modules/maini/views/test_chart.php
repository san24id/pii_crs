<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports &amp; statistics</small>
		</h3>

		<div>
			<?php
    /* Mengambil query report*/
    foreach($report as $result){
        $level[] = $result->risk_level; //ambil bulan
        $value[] = (float) $result->numcount; //ambil nilai
    }
    /* end mengambil query*/
	?>

		</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	<script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Risk To Verify',
             style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                },
        },
        xAxis: {
           categories:  <?php echo json_encode($level);?>,
            style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                },
        },
        yAxis: {
            min: 0,
            title: {
                text: '',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
    
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
      /*  legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },*/
        credits: {
            enabled: false
        },
        series: [{
           name: 'Verify',
           colorByPoint: true,
            data: <?php echo json_encode($value);?>,
            shadow : true,
            dataLabels: {
                enabled: true,
                align: 'center',
                formatter: function() {
                     return Highcharts.numberFormat(this.y, 0);
                }, // one decimal
                y: 0, // 10 pixels down from the top
                style: {
                    fontSize: '10px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }

        ]
    });
});

		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<!--<script src="https://code.highcharts.com/modules/exporting.js"></script>-->

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</div>
</div>