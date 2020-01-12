<!DOCTYPE HTML>
<html>
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Rule Direksi</title>
		<script src="../../../assets/js/highcharts/jquery-3.2.1.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			    Highcharts.setOptions({
        colors: ['#ff3300', '#ffcc00', '#009933']
                 });

 // Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
 //        return {
 //            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
 //            stops: [
 //                [0, color],
 //                [1, Highcharts.Color(color).brighten(-0.1).get('rgb')] // darken
 //            ]
 //        };
 //    });

			var options = {
	            chart: {
					// shadow:{
     //                    color: 'white',
     //                    width:25,
     //                    offsetX:0,
     //                    offsety:0,
					// },
	    	        backgroundColor: '#f2f2f2',
					ignoreHiddenSeries: true,
					inverted: false,
					margin: undefined,
					marginBottom: undefined,
					marginLeft: undefined,
					marginRight: undefined,
					marginTop: undefined,
	                renderTo: 'container',
	                type: 'bar',
	                options3d: {
        			 	enabled: true,
         				// alpha: 5,
         				//  beta: 15,
         				viewDistance: 30,
         				depth: 25,
      					},//akhir 3d
	            },

	            title: {
	               text: ' ',
	                x: -170,
	                useHTML: true,
	                style :{ 'color': 'black', 
	                		 'fontSize': '16px',
	                		 'font-weight': 'bold',
	                		 //'background-color': '#999999',
           					 //'border': '5px solid #808080',

	                	},
	            },
	            /*subtitle: {
	                text: 'IIGF Risk',
	                x: -20
	            },*/
	            xAxis: {

	            	 title: {
	            	 		style: {
               					color: '#000000'
        					},
	                		align: 'high',
           					offset: 0,
            				//text: 'Division Name',
            				rotation: 0,
            				},
	                categories: [],
	                 labels: {
         				   style: {
              		  color: 'black',
    		    fontWeight:'bold',
                fontFamily: 'Verdana, sans-serif'

            
       				 }
					},
	                lineWidth: 0,
   					},

	            yAxis: {

	                title: {
	                	style: {
               color: 'black'
       			},
	                    text: 'Number of Risk',
            	 },
	                plotLines: [{
	                    value: 0,
	                    width: 1,
	                    color: '#000000'
	                }],
	                labels: {
         				   style: {
              		  color: 'black',
              		  fontWeight:'bold',
                	fontFamily: 'Verdana, sans-serif'

            
       				 }
					},
	                lineWidth: 0,
   					minorGridLineWidth: 0,
   					lineColor: '#000000',
   					gridLineColor: '#0F466E',
   					minorTickLength: 0,
   					tickLength: 0,
   					 gridLineWidth: true,
  					 minorGridLineWidth: true,
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
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },
	            plotOptions: {
        series: {
            stacking: 'normal',
            
            edgeWidth: 1,
            edgeColor: '#FFFAFA',
            
        },
         bar: {

            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
	                    
            }
        }
   
    },
               series: []
	        }
	        
	        $.getJSON("dataceo_risk_dasboard.php", function(json) {
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
    height:98%;
    width:98%;
    position:absolute;
}
</style>
	<body>

<div id="container" </div>	
	</body>
</html>
