<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
    
        <div>
    <?php
    /* Mengambil query report*/
    foreach($crequest_submit as $result){
        $value_s[] = (float) $result->numcount;
    }

    foreach($crequest_verify as $result){
        $value_v[] = (float) $result->numcount;
    }
    /* end mengambil query*/
    ?>

        </div>

<style>
#chartdiv {
  width: 100%;
  height: 100%;
}                   
</style>

<!-- Resources -->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "fontSize": 10,
  "dataProvider": [{
    "country": "Pending",
    "value": <?php echo json_encode($value_s);?>,
    "color": "#66ff66"
  },{
    "country": "Complete",
    "value": <?php echo json_encode($value_v);?>,
    "color": "#009933"
  }],
  "valueField": "value",
  "titleField": "country",
  "colorField": "color",
  //"labelsEnabled":true,
  "labelText": "[[value]]",
  "color": "#000",
  "labelRadius": -25,
  "outlineAlpha": 0.4,
  "depth3D": 8,
  "balloonText": "<span style='font-size:11px'><b>[[title]]</b><br>[[value]] ([[percents]]%)</span>",
  "angle": 0,
  "startDuration":0,
  "export": {
    "enabled": false
  }
} );
</script>
    </head>
    <body>
    <div id="chartdiv"></div>
    </div>
</div>

