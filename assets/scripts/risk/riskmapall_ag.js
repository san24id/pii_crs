var gridCataVLow = new Datatable();
gridCataVLow.init({
    src: $("#table_catvlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
		//"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getCataVLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
			{ "data": "risk_code", "orderable": true },
			{ "data": "risk_event" },
			{ "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridCataLow = new Datatable();
gridCataLow.init({
    src: $("#table_catlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getCataLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridCataMed = new Datatable();
gridCataMed.init({
    src: $("#table_catmed"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getCataMedag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridCataHigh = new Datatable();
gridCataHigh.init({
    src: $("#table_cathigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getCataHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridCataVHigh = new Datatable();
gridCataVHigh.init({
    src: $("#table_catvhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getCataVHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMayVLow = new Datatable();
gridMayVLow.init({
    src: $("#table_mayvlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMayVLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMayLow = new Datatable();
gridMayLow.init({
    src: $("#table_maylow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMayLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMayMed = new Datatable();
gridMayMed.init({
    src: $("#table_maymed"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMayMedag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMayHigh = new Datatable();
gridMayHigh.init({
    src: $("#table_mayhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMayHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMayVHigh = new Datatable();
gridMayVHigh.init({
    src: $("#table_mayvhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMayVHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridModVLow = new Datatable();
gridModVLow.init({
    src: $("#table_modvlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getModVLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridModLow = new Datatable();
gridModLow.init({
    src: $("#table_modlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getModLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridModMed = new Datatable();
gridModMed.init({
    src: $("#table_modmed"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getModMedag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridModHigh = new Datatable();
gridModHigh.init({
    src: $("#table_modhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getModHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridModVHigh = new Datatable();
gridModVHigh.init({
    src: $("#table_modvhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getModVHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMinVLow = new Datatable();
gridMinVLow.init({
    src: $("#table_minvlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMinVLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMinLow = new Datatable();
gridMinLow.init({
    src: $("#table_minlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMinLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMinMed = new Datatable();
gridMinMed.init({
    src: $("#table_minmed"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMinMedag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMinHigh = new Datatable();
gridMinHigh.init({
    src: $("#table_minhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMinHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridMinVHigh = new Datatable();
gridMinVHigh.init({
    src: $("#table_minvhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getMinVHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridInsVLow = new Datatable();
gridInsVLow.init({
    src: $("#table_insvlow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getInsVLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridInsLow = new Datatable();
gridInsLow.init({
    src: $("#table_inslow"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getInsLowag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridInsMed = new Datatable();
gridInsMed.init({
    src: $("#table_insmed"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getInsMedag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridInsHigh = new Datatable();
gridInsHigh.init({
    src: $("#table_inshigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getInsHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridInsVHigh = new Datatable();
gridInsVHigh.init({
    src: $("#table_insvhigh"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
        //"scrollX": true,
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/main/MainRac/getInsVHighag/"+pid // ajax source
        },
        "columnDefs": [  ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var RiskMap = function() {
	return {
		
        init: function(mode) {
        	var me = this;
        	me.dataMode = mode;
        	


            $('#select_divisi').on('click', function() {

                me.filterCataVLow();
                me.filterCataLow();
                me.filterCataMed();
                me.filterCataHigh();
                me.filterCataVHigh();

                me.filterMayVLow();
                me.filterMayLow();
                me.filterMayMed();
                me.filterMayHigh();
                me.filterMayVHigh();

                me.filterModVLow();
                me.filterModLow();
                me.filterModMed();
                me.filterModHigh();
                me.filterModVHigh();

                me.filterMinVLow();
                me.filterMinLow();
                me.filterMinMed();
                me.filterMinHigh();
                me.filterMinVHigh();

                me.filterInsVLow();
                me.filterInsLow();
                me.filterInsMed();
                me.filterInsHigh();
                me.filterInsVHigh();
            
            });
        	
        	$('#catavlow-filter-submit').on('click', function() {
        		me.filterCataVLow();
        	});

            $('#catalow-filter-submit').on('click', function() {
                me.filterCataLow();
            });

            $('#catamed-filter-submit').on('click', function() {
                me.filterCataMed();
            });

            $('#catahigh-filter-submit').on('click', function() {
                me.filterCataHigh();
            });

            $('#catavhigh-filter-submit').on('click', function() {
                me.filterCataVHigh();
            });

            $('#mayvlow-filter-submit').on('click', function() {
                me.filterMayVLow();
            });

            $('#maylow-filter-submit').on('click', function() {
                me.filterMayLow();
            });

            $('#maymed-filter-submit').on('click', function() {
                me.filterMayMed();
            });

            $('#mayhigh-filter-submit').on('click', function() {
                me.filterMayHigh();
            });

            $('#mayvhigh-filter-submit').on('click', function() {
                me.filterMayVHigh();
            });

            $('#modvlow-filter-submit').on('click', function() {
                me.filterModVLow();
            });

            $('#modlow-filter-submit').on('click', function() {
                me.filterModLow();
            });

            $('#modmed-filter-submit').on('click', function() {
                me.filterModMed();
            });

            $('#modhigh-filter-submit').on('click', function() {
                me.filterModHigh();
            });

            $('#modvhigh-filter-submit').on('click', function() {
                me.filterModVHigh();
            });

            $('#minvlow-filter-submit').on('click', function() {
                me.filterMinVLow();
            });

            $('#minlow-filter-submit').on('click', function() {
                me.filterMinLow();
            });

            $('#minmed-filter-submit').on('click', function() {
                me.filterMinMed();
            });

            $('#minhigh-filter-submit').on('click', function() {
                me.filterMinHigh();
            });

            $('#minvhigh-filter-submit').on('click', function() {
                me.filterMinVHigh();
            });

            $('#insvlow-filter-submit').on('click', function() {
                me.filterInsVLow();
            });

            $('#inslow-filter-submit').on('click', function() {
                me.filterInsLow();
            });

            $('#insamed-filter-submit').on('click', function() {
                me.filterInsMed();
            });

            $('#inshigh-filter-submit').on('click', function() {
                me.filterInsHigh();
            });

            $('#insvhigh-filter-submit').on('click', function() {
                me.filterInsVHigh();
            });
			
        },


        filterCataVLow: function() {
        	var fval = $('#modal-allCataVLow div.inputs input[name=filter_catvlow]')[0].value; 
            var fdiv = $('#l_divisi').val();       
        	gridCataVLow.clearAjaxParams();
        	gridCataVLow.setAjaxParam("filter_library", fval);
            gridCataVLow.setAjaxParam("filter_divisi", fdiv);
        	gridCataVLow.getDataTable().ajax.reload();	
        },

        filterCataLow: function() {
            var fval = $('#modal-allCataLow div.inputs input[name=filter_catlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridCataLow.clearAjaxParams();
            gridCataLow.setAjaxParam("filter_library", fval);
            gridCataLow.setAjaxParam("filter_divisi", fdiv);
            gridCataLow.getDataTable().ajax.reload();  
        },

        filterCataMed: function() {
            var fval = $('#modal-allCataMed div.inputs input[name=filter_catmed]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridCataMed.clearAjaxParams();
            gridCataMed.setAjaxParam("filter_library", fval);
            gridCataMed.setAjaxParam("filter_divisi", fdiv);
            gridCataMed.getDataTable().ajax.reload();  
        },

        filterCataHigh: function() {
            var fval = $('#modal-allCataHigh div.inputs input[name=filter_cathigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridCataHigh.clearAjaxParams();
            gridCataHigh.setAjaxParam("filter_library", fval);
            gridCataHigh.setAjaxParam("filter_divisi", fdiv);
            gridCataHigh.getDataTable().ajax.reload();  
        },

        filterCataVHigh: function() {
            var fval = $('#modal-allCataVHigh div.inputs input[name=filter_catvhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridCataVHigh.clearAjaxParams();
            gridCataVHigh.setAjaxParam("filter_library", fval);
            gridCataVHigh.setAjaxParam("filter_divisi", fdiv);
            gridCataVHigh.getDataTable().ajax.reload();  
        },

        filterMayVLow: function() {
            var fval = $('#modal-allMayVLow div.inputs input[name=filter_mayvlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMayVLow.clearAjaxParams();
            gridMayVLow.setAjaxParam("filter_library", fval);
            gridMayVLow.setAjaxParam("filter_divisi", fdiv);
            gridMayVLow.getDataTable().ajax.reload();  
        },

        filterMayLow: function() {
            var fval = $('#modal-allMayLow div.inputs input[name=filter_maylow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMayLow.clearAjaxParams();
            gridMayLow.setAjaxParam("filter_library", fval);
            gridMayLow.setAjaxParam("filter_divisi", fdiv);
            gridMayLow.getDataTable().ajax.reload();  
        },

        filterMayMed: function() {
            var fval = $('#modal-allMayMed div.inputs input[name=filter_maymed]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMayMed.clearAjaxParams();
            gridMayMed.setAjaxParam("filter_library", fval);
            gridMayMed.setAjaxParam("filter_divisi", fdiv);
            gridMayMed.getDataTable().ajax.reload();  
        },

        filterMayHigh: function() {
            var fval = $('#modal-allMayHigh div.inputs input[name=filter_mayhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMayHigh.clearAjaxParams();
            gridMayHigh.setAjaxParam("filter_library", fval);
            gridMayHigh.setAjaxParam("filter_divisi", fdiv);
            gridMayHigh.getDataTable().ajax.reload();  
        },

        filterMayVHigh: function() {
            var fval = $('#modal-allMayVHigh div.inputs input[name=filter_mayvhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMayVHigh.clearAjaxParams();
            gridMayVHigh.setAjaxParam("filter_library", fval);
            gridMayVHigh.setAjaxParam("filter_divisi", fdiv);
            gridMayVHigh.getDataTable().ajax.reload();  
        },

        filterModVLow: function() {
            var fval = $('#modal-allModVLow div.inputs input[name=filter_modvlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridModVLow.clearAjaxParams();
            gridModVLow.setAjaxParam("filter_library", fval);
            gridModVLow.setAjaxParam("filter_divisi", fdiv);
            gridModVLow.getDataTable().ajax.reload();  
        },

        filterModLow: function() {
            var fval = $('#modal-allModLow div.inputs input[name=filter_modlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridModLow.clearAjaxParams();
            gridModLow.setAjaxParam("filter_library", fval);
            gridModLow.setAjaxParam("filter_divisi", fdiv);
            gridModLow.getDataTable().ajax.reload();  
        },

        filterModMed: function() {
            var fval = $('#modal-allModMed div.inputs input[name=filter_modmed]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridModMed.clearAjaxParams();
            gridModMed.setAjaxParam("filter_library", fval);
            gridModMed.setAjaxParam("filter_divisi", fdiv);
            gridModMed.getDataTable().ajax.reload();  
        },

        filterModHigh: function() {
            var fval = $('#modal-allModHigh div.inputs input[name=filter_modhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridModHigh.clearAjaxParams();
            gridModHigh.setAjaxParam("filter_library", fval);
            gridModHigh.setAjaxParam("filter_divisi", fdiv);
            gridModHigh.getDataTable().ajax.reload();  
        },

        filterModVHigh: function() {
            var fval = $('#modal-allModVHigh div.inputs input[name=filter_modvhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridModVHigh.clearAjaxParams();
            gridModVHigh.setAjaxParam("filter_library", fval);
            gridModVHigh.setAjaxParam("filter_divisi", fdiv);
            gridModVHigh.getDataTable().ajax.reload();  
        },

        filterMinVLow: function() {
            var fval = $('#modal-allMinVLow div.inputs input[name=filter_minvlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMinVLow.clearAjaxParams();
            gridMinVLow.setAjaxParam("filter_library", fval);
            gridMinVLow.setAjaxParam("filter_divisi", fdiv);
            gridMinVLow.getDataTable().ajax.reload();  
        },

        filterMinLow: function() {
            var fval = $('#modal-allMinLow div.inputs input[name=filter_minlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMinLow.clearAjaxParams();
            gridMinLow.setAjaxParam("filter_library", fval);
            gridMinLow.setAjaxParam("filter_divisi", fdiv);
            gridMinLow.getDataTable().ajax.reload();  
        },

        filterMinMed: function() {
            var fval = $('#modal-allMinMed div.inputs input[name=filter_minmed]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMinMed.clearAjaxParams();
            gridMinMed.setAjaxParam("filter_library", fval);
            gridMinMed.setAjaxParam("filter_divisi", fdiv);
            gridMinMed.getDataTable().ajax.reload();  
        },

        filterMinHigh: function() {
            var fval = $('#modal-allMinHigh div.inputs input[name=filter_minhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMinHigh.clearAjaxParams();
            gridMinHigh.setAjaxParam("filter_library", fval);
            gridMinHigh.setAjaxParam("filter_divisi", fdiv);
            gridMinHigh.getDataTable().ajax.reload();  
        },

        filterMinVHigh: function() {
            var fval = $('#modal-allMinVHigh div.inputs input[name=filter_minvhigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridMinVHigh.clearAjaxParams();
            gridMinVHigh.setAjaxParam("filter_library", fval);
            gridMinVHigh.setAjaxParam("filter_divisi", fdiv);
            gridMinVHigh.getDataTable().ajax.reload();  
        },

        filterInsVLow: function() {
            var fval = $('#modal-allInsiVLow div.inputs input[name=filter_insvlow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridInsVLow.clearAjaxParams();
            gridInsVLow.setAjaxParam("filter_library", fval);
            gridInsVLow.setAjaxParam("filter_divisi", fdiv);
            gridInsVLow.getDataTable().ajax.reload();  
        },

        filterInsLow: function() {
            var fval = $('#modal-allInsiLow div.inputs input[name=filter_inslow]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridInsLow.clearAjaxParams();
            gridInsLow.setAjaxParam("filter_library", fval);
            gridInsLow.setAjaxParam("filter_divisi", fdiv);
            gridInsLow.getDataTable().ajax.reload();  
        },

        filterInsMed: function() {
            var fval = $('#modal-allInsiMed div.inputs input[name=filter_insmed]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridInsMed.clearAjaxParams();
            gridInsMed.setAjaxParam("filter_library", fval);
            gridInsMed.setAjaxParam("filter_divisi", fdiv);
            gridInsMed.getDataTable().ajax.reload();  
        },

        filterInsHigh: function() {
            var fval = $('#modal-allInsiHigh div.inputs input[name=filter_inshigh]')[0].value;
            var fdiv = $('#l_divisi').val();
            gridInsHigh.clearAjaxParams();
            gridInsHigh.setAjaxParam("filter_library", fval);
            gridInsHigh.setAjaxParam("filter_divisi", fdiv);
            gridInsHigh.getDataTable().ajax.reload();  
        },

        filterInsVHigh: function() {
            var fval = $('#modal-allInsiVHigh div.inputs input[name=filter_insvhigh]')[0].value;
            gridInsVHigh.clearAjaxParams();
            gridInsVHigh.setAjaxParam("filter_library", fval);
            gridInsVHigh.setAjaxParam("filter_divisi", fdiv);
            gridInsVHigh.getDataTable().ajax.reload();  
        }
	 }
}();