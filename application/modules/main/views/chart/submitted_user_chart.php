<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
    
        <div>
            <?php
    /* Mengambil query report*/
    foreach($user_submit as $result){
        $value_high[] = (float) $result->numcount;
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
        "level":  '',
        "result": '',
        "color": "#009933"
    }, {
        "level": '',
        "result":'',
        "color" : "#ffcc00"
    }, {
        "level": 'User',
        "result": <?php echo json_encode($value_high);?>,
        "color": "#ff3300"
    }],
    //"valueAxes": [{
        //"title": "Income in millions, USD"
    //}],
    "graphs": [{
        "balloonText": "[[category]]:[[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        //"title": "Income",
        "type": "column",
        "valueField": "result",
        "fillColorsField": "color",
    }],
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
      "enabled": true
     }
});
</script>
    </head>
    <body>
    <div id="chartdiv"></div>
    </div>
</div>

