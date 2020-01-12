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
                text: ''
            },
            subtitle: {
                text: ''
            },
            plotOptions: {
                pie: {
                   depth: 45,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: true          
      },
      showInLegend: true
                }
            },
            series: [{  
                name: 'Jumlah ',
                colors: ['#FFFFFF','#FF0000', '#FFFF00', '#00FF00'],
                data: [ 
                  <?php
                  // meng include file connection.php
                  require 'include/connection.php';
 
                  // meng extend class Connection()
                $con = new Connection();
                 
                // mendapatkan seluruh data dari tabel hasilvoting kemudian di looping menggunakan while
                $voting = $con->getapRAC();
 
                // melakukan looping
                  while ($data = $voting->fetch(PDO::FETCH_OBJ)) {
                    echo "[ '".$data->execution_status."', ".$data->count."],";
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
 
<footer>
    <p align="center"><a href="#" target="_blank">View Chart</a></p>
</footer>
 
 
<script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/highcharts-3d.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="http://code.highcharts.com/themes/dark-unica.js"></script>

</body>
</html>