<!DOCTYPE html>
<html>
<head>
    <title>Risk IIGF</title>
 
<!--<script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/exporting.js"></script>
-->
     <script src="../../assets/js/highcharts/jquery-3.2.1.min.js"></script>
 
    <script type="text/javascript">
    $(document).ready(function() {
          Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.2).get('rgb')] // darken
            ]
        };
    });

        $('#suara').highcharts({
            chart: {
                backgroundColor:'#f2f2f2',
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 70
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            plotOptions: {
                pie: {
                    size:320,
                    viewDistance: 40,
                    depth: 40,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: false,
                    format: '<b>{point.name}</b> <br>( {point.percentage:.1f} % )'                  
                              
      },
      showInLegend: true
                }
            },
            series: [{  
                name: 'Total : ',
                edgeWidth: 1,
                edgeColor: '#FFFAFA',
                innerSize: '30%',
                colors: ['#F4A460', '#7FFF00', '#32CD32'],
               // colors: ['#F0FFF0','#F4A460', '#32CD32', '#7FFF00'],
                data: [ 
                  <?php
                  // meng include file connection.php
                  require 'include/connection.php';
 
                  // meng extend class Connection()
                $con = new Connection();
                 
                // mendapatkan seluruh data dari tabel hasilvoting kemudian di looping menggunakan while
                $voting = $con->getRiskStatusCeo();
 
                // melakukan looping
                  while ($data = $voting->fetch(PDO::FETCH_OBJ)) {
                    echo "[ '".$data->statusrisk." :".$data->statuscount."', ".$data->statuscount."],";
                  }
                  ?> 
                  ]  
            }]
        });
    });
    </script>
</head>
<body>
  
<!-- awal sebagai id untuk menampilkan diagram batang -->
<div id="suara" style="height: 215px; width: 100%"></div>
<!-- akhir -->
 
<!--<footer>
    <p align="center"><a href="#" target="_blank">View Chart</a></p>
</footer>-->
 
 
<script src="../../assets/js/highcharts/highcharts.js"></script>
<script src="../../assets/js/highcharts/highcharts-3d.js"></script><!--plugin 3d nya-->
<script src="../../assets/js/highcharts/highcharts-exporting.js"></script>

</body>
</html>