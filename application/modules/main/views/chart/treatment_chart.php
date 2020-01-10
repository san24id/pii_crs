<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
    
        <div>
            <?php
    /* Mengambil query report*/
    foreach($treatment_high_submit as $result){
        $level_high_s[] = $result->risk_level;
        $value_high_s[] = (float) $result->numcount;
    }
    foreach($treatment_high_verify as $result){
        $level_high_v[] = $result->risk_level;
        $value_high_v[] = (float) $result->numcount;
    }

    foreach($treatment_moderate_submit as $result){
        $level_moderate_s[] = $result->risk_level;
        $value_moderate_s[] = (float) $result->numcount;
    }
    foreach($treatment_moderate_verify as $result){
        $level_moderate_v[] = $result->risk_level;
        $value_moderate_v[] = (float) $result->numcount;
    }

    foreach($treatment_low_submit as $result){
        $level_low_s[] = $result->risk_level;
        $value_low_s[] = (float) $result->numcount;
    }
    foreach($treatment_low_verify as $result){
        $level_low_v[] = $result->risk_level;
        $value_low_v[] = (float) $result->numcount;
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
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "theme": "light",
    "type": "serial",
    "fontSize": 9,
    "dataProvider": [{
        "level":  'Low',
        "result": <?php echo json_encode($value_low_v);?>,
        "result2": <?php echo json_encode($value_low_s);?>,
        "color": "#009933",
        "color2": "#66ff66"
    }, {
        "level": 'Moderate',
        "result": <?php echo json_encode($value_moderate_v);?>,
        "result2": <?php echo json_encode($value_moderate_s);?>,
        "color" : "#ffcc00",
        "color2" : "#ffff99"
    }, {
        "level": 'High',
        "result": <?php echo json_encode($value_high_v);?>,
        "result2": <?php echo json_encode($value_high_s);?>,
        "color": "#ff3300",
        "color2" : "#ff9966"
    }],
     "valueAxes": [{
        "stackType": "regular",
        "axisAlpha": 0.5,
        "gridAlpha": 0
    }],
   "graphs": [{
        "balloonText": "<span style='font-size:11px'><b>[[category]]</b>:[[value]]</span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 1,
        "type": "column",
        "color": "#000000",
        "valueField": "result",
        "fillColorsField": "color"
    }, {
        "balloonText": "<span style='font-size:11px'><b>[[category]]</b>:[[value]]</span>",
        "fillAlphas": 0.8,
        "labelText": "[[value]]",
        "lineAlpha": 1,
        //"title": "",
        "type": "column",
        "color": "#000000",
        "valueField": "result2",
        "fillColorsField": "color2"
    },],
    "depth3D": 10,
    "angle": 20,
    "rotate": true,
    "categoryField": "level",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "left"
    },
    "export": {
      "enabled": false
     }
});
</script>
    </head>
    <body>
    <div id="chartdiv"></div>
    </div>
</div>

