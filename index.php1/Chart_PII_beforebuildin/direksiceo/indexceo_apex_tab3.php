<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Rule Direksi</title>
		<script src="../../../assets/js/highcharts/jquery-3.2.1.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			    Highcharts.setOptions({
       colors: ['#F4A460', '#00FFFF', '#00FF00'],
                
                 });
  Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.2).get('rgb')] // darken
            ]
        };
    });


			var options = {
	            chart: {
	            	backgroundColor:'#f2f2f2',
	          //   shadow:{
           //              color: 'grey',
           //              width:25,
           //              offsetX:0,
           //              offsety:0,

           // },
	                renderTo: 'container',
	                type: 'column',
					marginRight: 150,
					marginLeft:60,
	                marginBottom: 65,//membuat 3d

	                options3d: {
         enabled: true,
         // alpha: 15,
         // beta: 15,
         viewDistance: 30,
         depth: 25
      }//akhir 3d
	            },
	            title: {
	                text: '',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: [],
	                labels: {
            style: {
           
                color: 'black',
    		    fontWeight:'bold',
                fontFamily: 'Verdana, sans-serif'

            }
        }

	            },
	            yAxis: {
	                title: {
	                    text: ''
	                },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#808080'
	                }],
	                labels: {
            style: {
           
               color: 'black',
    		    fontWeight:'bold',
                fontFamily: 'Verdana, sans-serif'
}
        }

	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	               
	                borderWidth: 0
	            },
	             plotOptions: {
	                column: {
	                    stacking: 'normal',
	                    edgeWidth: 1,
            			edgeColor: '#FFFAFA',
	                    dataLabels: {
	                        enabled: true,
	                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
	                    }
	                }
	            },
	            series: []
	        }	        
	        $.getJSON("dataceo_apex_tab3.php", function(json) {
				options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        	options.series[1] = json[2];
	        	options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);
	        });
	    });
	</script>
	    <script src="../../../assets/js/highcharts/highcharts.js"></script>
        <script src="../../../assets/js/highcharts/highcharts-3d.js"></script><!--plugin 3d nya-->
        <script src="../../../assets/js/highcharts/highcharts-exporting.js"></script>

	</head>
<style>
#container {
    height:96%;
    width:98%;
    position:absolute;
}
</style>
	<body>
		<div id="container"></div>
	</body>
</html>