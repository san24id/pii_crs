<!DOCTYPE html>
<html>
<head>
    <title>Risk IIGF</title>
 
<!--<script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/exporting.js"></script>
-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 
    <script type="text/javascript">
    $(document).ready(function() {
        $('#suara').highcharts({
            chart: {
                backgroundColor: '#f2f2f2',
                    
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Division'
            },
            subtitle: {
                text: ''
            },
            legend: {
                    layout: 'vertical',
                    align:'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
               
            plotOptions: {
                pie: {
                    depth: 45,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: true,                   
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'sand-signika'
                   
      },
      showInLegend: true
                }
            },
            series: [{  
                name: 'Jumlah ',
                data: [ 
                  <?php
                  // meng include file connection.php
                  require 'include/connection.php';
 
                  // meng extend class Connection()
                $con = new Connection();
                 
                // mendapatkan seluruh data dari tabel hasilvoting kemudian di looping menggunakan while
                $voting = $con->getCooDash();
 
                // melakukan looping
                  while ($data = $voting->fetch(PDO::FETCH_OBJ)) {
                    echo "[ '".$data->risk_owner."', ".$data->numberrisk."],";
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
<div id="suara"></div>
<!-- akhir -->
 
 
<script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/highcharts-3d.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/themes/dark-unica.js"></script>
</body>
</html>