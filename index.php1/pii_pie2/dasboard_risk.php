<!DOCTYPE html>
<html>
<head>
    <title>Risk IIGF</title>
 
    <script src="../../assets/js/highcharts/jquery-3.2.1.min.js"></script>
 
    <script type="text/javascript">
    $(document).ready(function() {
         Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.1).get('rgb')] // darken
            ]
        };
    });

        $('#suara').highcharts({
            chart: {                                   
             backgroundColor: '#f2f2f2',
           //  plotBackgroundColor: '#13b6ec',
                
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
					size:'92%',
                    depth: 85,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                    enabled: true, 
                    distance: 1, 
                    format: '<b>{point.name}</b><br/>{point.percentage:.1f} %',                  
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'         
      },
      showInLegend: false
                }
            },
            series: [{  
                name: 'Total ',
                
            edgeWidth: 1,
            edgeColor: '#FFFAFA',
                data: [ 
                  <?php
                  // meng include file connection.php
                  require 'include/connection.php';
 
                  // meng extend class Connection()
                $con = new Connection();
                 
                // mendapatkan seluruh data dari tabel hasilvoting kemudian di looping menggunakan while
                $voting = $con->getCFRACDash();
 
                // melakukan looping
                  while ($data = $voting->fetch(PDO::FETCH_OBJ)) {
                    echo "[ '".$data->short_division." :".$data->numberrisk."', ".$data->numberrisk."],";
                  }
                  ?> 
                  ]  
            }]
        });
    });
    </script>
</head>
<style>
#suara{
    height:98%;
    width:98%;
    position:absolute;
}
</style>


<body>

</footer>  
<!-- awal sebagai id untuk menampilkan diagram batang -->
<div id="suara" ></div>
<!-- akhir -->
 
<script src="../../assets/js/highcharts/highcharts.js"></script>
<script src="../../assets/js/highcharts/highcharts-3d.js"></script><!--plugin 3d nya-->
<script src="../../assets/js/highcharts/highcharts-exporting.js"></script>
</body>

</html>