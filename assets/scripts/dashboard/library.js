$('#sts').hide();

$('#tab_kri_list-filterBy').change(function(){
    var chs = $('#tab_kri_list-filterBy').val();
        if(chs == 'mandatory'){
            $('#sts').show();
            $('#tab_kri_list-filterValue').hide();
        }else{
            $('#sts').hide();
            $('#tab_kri_list-filterValue').show();
            $('#tab_kri_list-filterValue').val('');
        }
});

$('#input_kri').change(function(){
    var mitg = $('#input_kri').val();
    $('#tab_kri_list-filterValue').val(mitg);
});

function Check(){
     $('#due_date').val('00-00-0000');
     $('#fdate').hide();
     $('#ckc').hide();
     $('#kcc').show();
    $("#checked").show();
}

function Chckd(){
    $('#due_date').val('');
     $('#fdate').show();
     $('#ckc').show();
     $('#kcc').hide();
     $("#checked").hide();
}


var gridRiskList = new Datatable();
gridRiskList.init({
    src: $("#datatable_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk" // ajax source
        },
       
        "columns": [
            { "data": "risk_code", "orderable":true
            },
            { "data": "risk_event" },
            { "data": "risk_description" },
            { "data": "risk_cause" },
            { "data": "risk_impact" },
            { "data": "cat_name1" },
            { "data": "cat_name2" },
            { "data": "cat_name3" }, 
            { 
            "data": null,
            "orderable": false,
            "defaultContent": '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

                    '<button type="button" class="btn blue btn-xs button-grid-info" > <i class="fa fa-info" aria-hidden="true"> Info </i></button>'+
                '</div>'
               
           }
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskList_ap = new Datatable();
gridRiskList_ap.init({
    src: $("#datatableap_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_ap" // ajax source
        },
        "columnDefs": [{
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return 'AP.'+data+'';
                }
            },{
            "targets" : 6,
            "data" : "id",
            "render": function(data, type, full, meta){
                if(full.status == 0){
                btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Hide </i></button>'+
                '</div>';
                }else{
                    btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-show"><i class="fa fa-check-circle font-green"> Show </i></button>'+
                '</div>';
                }
                return btn;
                }
            }],
        
        "columns": [
            { "data": "id","orderable":true},
            { "data": "action_plan" },
            { "data": "due_date_x" }, 
            { "data": "division_name" }, 
            { "data": "risk_code" },
            { "data": "periode_id" },
            { "data": "id"}
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});


var gridRiskList_kri = new Datatable();
gridRiskList_kri.init({
    src: $("#datatablekri_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_kri" // ajax source
        },
        "columnDefs": [ {
            "targets": 4,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.risk_status == '0' || full.risk_status == '1') cls = '';
                return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'">'+data+'</a>';
            }
        },{
            "targets": 5,
            "data": "kri_code",
            "render": function ( data, type, full, meta ) {

                 return '<a target="_self" href="'+site_url+'/library/viewOwnedKriLib/'+full.id+'"><button type="button" class="btn blue btn-xs" > <i class="fa fa-pencil"> Edit </i></button></a>';

            }
        } ],
        "columns": [
            { "data": "kri_code" },
            { "data": "key_risk_indicator" },
            { "data": "mandatory" }, 
            { "data": "threshold value" }, 
            { "data": "risk_code" }, 
            { "data": "kri_code" }
           
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskList_ec = new Datatable();
gridRiskList_ec.init({
    src: $("#datatableec_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_ec" // ajax source
        },
        "columnDefs": [  {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return 'EC.'+data+'';
            }
        },{
            "targets" : 6,
            "data" : "id",
            "render": function(data, type, full, meta){
                if(full.risk_existing_control != 'Not Available'){
                if(full.status == 0){
                btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Hide </i></button>'+
                '</div>';
                }else{
                    btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-show"><i class="fa fa-check-circle font-green"> Show </i></button>'+
                '</div>';
                }}else{
                     btn = '<div class="btn-group">'+
                    '<button type="button" class="btn btn-default btn-xs button-grid-edit" disabled> <i class="fa fa-pencil"> Edit </i></button>'+
                     
                     '<button type="button" class="btn btn-default btn-xs button-grid-delete" disabled><i class="fa fa-trash-o font-red"> Hide </i></button>'+
                '</div>';
                }
                return btn;
                }
            }],
        
        "columns": [
            { "data": "id","orderable":true},
            { "data": "risk_existing_control" },
            { "data": "risk_evaluation_control" },
            { "data": "division_name" },
            { "data": "risk_code" }, 
            { "data": "periode_id" }, 
            { "data": "id"}
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskList_objective = new Datatable();
gridRiskList_objective.init({
    src: $("#datatableobjective_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_objective" // ajax source
        },
        "columnDefs": [  {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return 'OB.'+data+'';
            }
        },{
            "targets" : 4,
            "data" : "id",
            "render": function(data, type, full, meta){
                if(full.status == 0){
                btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Hide </i></button>'+
                '</div>';
                }else{
                    btn = '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+
                     
                    '<button type="button" class="btn btn-default btn-xs button-grid-show"><i class="fa fa-check-circle font-green"> Show </i></button>'+
                '</div>';
                }
                return btn;
                }
            }],
        
        "columns": [
            { "data": "id","orderable": true },
            { "data": "objective" },
            { "data": "risk_code" }, 
            { "data": "periode_id" }, 
            { "data": "id"}
       ],
       //"rowsGroup":[0, 1, 3],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});


var gridTaxonomi = new Datatable();
gridTaxonomi.init({
    src: $("#datatabletax_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_tax" // ajax source
        },
        
        "columns": [
             
            { "data": "cat_code" },
            { "data": "cat_name" },
            { "data": "cat_desc" },
             
            { 
            "data": null,
            "orderable": false,
            "defaultContent": '<div class="btn-group">'+
                    '<button type="button" class="btn blue btn-xs button-grid-edit" > <i class="fa fa-pencil"> Edit </i></button>'+                  
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
                '</div>'
               
           }
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridTaxonomi_user = new Datatable();
gridTaxonomi_user.init({
    src: $("#datatabletaxuser_ajax"),
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
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/library/getAllRisk_tax" // ajax source
        },
        
        "columns": [
             
            { "data": "cat_code" },
            { "data": "cat_name" },
            { "data": "cat_desc" }
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridLibraryaction = new Datatable();

gridLibraryaction.init({
    src: $("#library_tableaction"),
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
            "url": site_url+"/risk/RiskRegister/getActionLibrary" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "action_plan",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: Dashboard.selectLibraryaction('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        },{
            "targets": 1,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                
                return 'AP.'+data;
            }
        },{
            "targets": 3,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "id", "orderable": true },
            { "data": "action_plan", "orderable": true },
            {"data": "due_date_v"},
            {"data":"division_v"} 
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridControl = new Datatable();
gridControl.init({
    src: $("#library_control_table"),
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
            "url": site_url+"/risk/RiskRegister/getControlLibrary" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: Dashboard.selectControlLibrary('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        },{
            "targets": 1,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return 'EC.'+data;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "id"},
            { "data": "risk_existing_control"},
            { "data": "risk_evaluation_control" },
            { "data": "control_owner" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridControlobjective = new Datatable();
gridControlobjective.init({
    src: $("#library_objective_table"),
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
            "url": site_url+"/risk/RiskRegister/getControlLibraryobjective" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskInput.selectControlLibraryobjective('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        },{
            "targets": 1,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return 'OB.'+data;
            }
        }],
        "columns": [
            { "data": "id", "orderable": false },
            { "data" : "id"},
            { "data": "objective"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});
 
      
var Dashboard = function() {
    return {
        init: function() {
            var me = this;
            
              if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: Metronic.isRTL(),
                        orientation: "left",
                        autoclose: true
                    });
                    //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
                }

         //------------------action plan
            $('#choose_l_divisi-action').hide();

            $('#tab_action_list-filterBy').change(function(){
                var risk_action = $('#tab_action_list-filterBy').val();
                 if(risk_action == "action_plan"){
                    $('#choose_l_divisi-action').hide();
                    $('#tab_action_list-filterValue').show();
                    $('#tab_action_list-filterValue').val('');
                 }else if(risk_action == "due_date"){
                    $('#choose_l_divisi-action').hide();
                    $('#tab_action_list-filterValue').show();
                    $('#tab_action_list-filterValue').val('');
                }else if(risk_action == "division"){
                    $('#choose_l_divisi-action').show();
                    $('#tab_action_list-filterValue').hide();
                    $('#tab_action_list-filterValue').val('');
                 }
            });

            $('#l_divisi-action').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_action_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-action').val();
                if(l_divisi == "-"){
                    $('#tab_action_list-filterValue').val('');
                }
            });

            //------------------existing control
            $('#choose_l_divisi-control').hide();

            $('#tab_control_list-filterBy').change(function(){
                var risk_control = $('#tab_control_list-filterBy').val();
                 if(risk_control == "risk_evaluation_control"){
                    $('#choose_l_divisi-control').hide();
                    $('#tab_control_list-filterValue').show();
                    $('#tab_control_list-filterValue').val('');
                 }else if(risk_control == "risk_existing_control"){
                    $('#choose_l_divisi-control').hide();
                    $('#tab_control_list-filterValue').show();
                    $('#tab_control_list-filterValue').val('');
                }else if(risk_control == "risk_control_owner"){
                    $('#choose_l_divisi-control').show();
                    $('#tab_control_list-filterValue').hide();
                    $('#tab_control_list-filterValue').val('');
                 }
            });

            $('#l_divisi-control').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_control_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-control').val();
                if(l_divisi == "-"){
                    $('#tab_control_list-filterValue').val('');
                }
            });
            
            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
            
            $('#tab_risk_list-filterButton').on('click', function() {
                me.filterDataGridRiskList();
            });

            $("#form_tab_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRiskList();
            });

             $('#tab_objective_list-filterButton').on('click', function() {
                me.filterDataGridObjectiveList();
            });

            $("#form_tab_objective_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridObjectiveList();
            });

            $('#tab_action_list-filterButton').on('click', function() {
                me.filterDataGridActionList();
            });

            $("#form_tab_action_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionList();
            });

            $('#tab_control_list-filterButton').on('click', function() {
                me.filterDataGridControlList();
            });

            $("#form_tab_control_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridControlList();
            });

            $('#tab_taksonomi_list-filterButton').on('click', function() {
                me.filterDataGridTaksonomiList();
            });

            $("#form_tab_taksonomi_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridTaksonomiList();
            });

            $('#tab_kri_list-filterButton').on('click', function() {
                me.filterDataGridKriList();
            });

            $("#form_tab_kri_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridKriList();
            });
			
			$('#tab_taksonomiuser_list-filterButton').on('click', function() {
                me.filterDataGridTaksonomiUserList();
            });

            $("#form_tab_taksonomiuser_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridTaksonomiUserList();
            });

            $('#modal-libraryaction-filter-submit').on('click', function() {
                me.filterLibraryAction();
            });

            $('#modal-control-filter-submit').on('click', function() {
                me.filterControl();
            });
             
             $('#datatable_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList.getDataTable().row(r).data(); 
                    me.deleteData(data);
                    
            });
            
            $('#button-kri-open-treshold').on('click', function() {
             
                var type = $('#select-treshold-type').val();
                if (type == 'SELECTION') {
                    $('#modal-treshold-selection').modal('show');
                    //me.initAddTresholdSelection();
                } else {
                    $('#modal-treshold-value').modal('show');
                    //me.initAddTresholdValue();
                }
            });
             
            $('#datatableap_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ap.getDataTable().row(r).data(); 
                    me.deleteData_ap(data);
                    
            });

            $('#datatableap_ajax').on('click', 'button.button-grid-show', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ap.getDataTable().row(r).data(); 
                    me.showData_ap(data);
                    
            });
            
            $('#datatableec_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ec.getDataTable().row(r).data(); 
                    me.deleteData_ec(data);
                    
            });

            $('#datatableec_ajax').on('click', 'button.button-grid-show', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ec.getDataTable().row(r).data(); 
                    me.showData_ec(data);
                    
            });

            $('#datatableobjective_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_objective.getDataTable().row(r).data(); 
                    me.deleteData_objective(data);
                    
            });

            $('#datatableobjective_ajax').on('click', 'button.button-grid-show', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_objective.getDataTable().row(r).data(); 
                    me.showData_objective(data);
                    
            });
            // error
            $('#sel_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_sub_category', val);
            });
            
            
            $('#sel_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_2nd_sub_category', val);
            });
            
            $('#datatablekri_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_kri.getDataTable().row(r).data(); 
                    me.deleteData_kri(data);
                    
            });
            
            $('#datatabletax_ajax').on('click', 'button.button-grid-delete', function(e) {
              
                    e.preventDefault();                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridTaxonomi.getDataTable().row(r).data(); 
                    me.deleteData_tax(data);
                    
            });
                
            $('#datatable_ajax').on('click', 'button.button-grid-edit', function(e) {
            
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList.getDataTable().row(r).data(); 
                    me.showriskform(data);
                
            });

            $('#datatable_ajax').on('click', 'button.button-grid-info', function(e) {
            
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList.getDataTable().row(r).data(); 
                    me.showriskforminfo(data);
                
            });
            
            $('#datatableap_ajax').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ap.getDataTable().row(r).data(); 
                    me.showriskform_ap(data);
                
            });
            
            $('#datatablekri_ajax').on('click', 'button.button-grid-edit', function(e) {
            
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_kri.getDataTable().row(r).data(); 
                    me.showriskform_kri(data);
                
            });
            
            $('#datatableec_ajax').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_ec.getDataTable().row(r).data(); 
                    me.showriskform_ec(data);
                
            });

            $('#datatableobjective_ajax').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridRiskList_objective.getDataTable().row(r).data(); 
                    me.showriskform_objective(data);
                
            });
            
            $('#datatabletax_ajax').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridTaxonomi.getDataTable().row(r).data(); 
                    me.showriskform_tax(data);
                
            });
            
            $('#button-add').on('click' , function(e) {
            
                    e.preventDefault();
                     
                    me.showriskform_ap_add();

                
            });
            
            $('#button-add-ec').on('click' , function(e) {
            
                    e.preventDefault();
                     
                    me.showriskform_ec_add();

                
            });

            $('#button-add-objective').on('click' , function(e) {
            
                    e.preventDefault();
                     
                    me.showriskform_objective_add();

                
            });
            
            $('#button-treshold-selection-add').click(function(e) {
             
                        e.preventDefault();
                        
                        var l = Ladda.create(this);
                        l.start();
                         
                        var url = site_url+'/library/add_treshold';
                         
                        $.post(
                            url,
                            $( "#kri-form-selection" ).serialize(),
                            function( data ) {
                                 l.stop();
                                if(data.success) {
                                    load_tresholddet(data.kri_id);
                                    MainApp.viewGlobalModal('success', 'Success add Data');
                                    $('#modal-treshold-selection').modal('hide');
                                    
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });

            $('#library-modal-listrisk-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listrisk_update';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridRiskList.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });
                
                $('#library-modal-listriskap-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridRiskList_ap.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });
 
                $('#library-modal-listriskec-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listriskec_update';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridRiskList_ec.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                             gridRiskList_ec.getDataTable().ajax.reload();
                                    
                            $('#modal_listrisk').modal('hide');
                                    
                            MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                         });
                     
                });

                $('#library-modal-listriskobjective-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listriskobjective_update';
                            var tx = 'Update List Objective';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form-objective" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridRiskList_objective.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk_objective').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });
                
                $('#library-modal-listrisktax-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listrisktax_update';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridTaxonomi.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });
                
                $('#is_percentage_treshold').on('click', function() {
                    $('#t-col-right-treshold').find('input[type=number]').prop('disabled', true);
                    $('#t-col-right-treshold').find('select').prop('disabled', true);
                    
                    if($(this).prop( "checked" )) {
                        $('#t-col-right-treshold').find('input[type=number]').prop('disabled', false);
                        $('#t-col-right-treshold').find('select').prop('disabled', false);
                         
                    } 
                });
                
                $('#button-treshold-value-add').on('click', function() {
                 
                        var l = Ladda.create(this);
                        l.start();
              
                    var url = site_url+'/library/add_treshold_2';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#kri-form-value" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    load_tresholddet(data.kri_id);
                                    MainApp.viewGlobalModal('success', 'Success save Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                    $('#modal-treshold-value').modal('hide');
                })
 
                $('#library-modal-listriskkri-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/library/listriskkri_update';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridRiskList_kri.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                     
                });

            $('#button-grid-edit').on('click' , function(e) {
                
                    e.preventDefault();
                    var r = this.parentNode.parentNode.parentNode; 
                    var data =  $('#provinsi').getDataTable().row(r).data(); 
                    me.showriskform(data);


                
            });
        },
        
        deleteData_kri: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData_kri';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_kri.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
        
        loadCategorySelect: function(sel_id, parent) {
            $('#'+sel_id)[0].options.length = 0;
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+parent, function( data ) {
                $.each( data, function( key, val ) {
                    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                });
                $('#'+sel_id).trigger('change');
            });
        },
         
        deleteData_ec: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to hide this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData_ec';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_ec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success hide data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },

        showData_ec: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to hide this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskShowData_ec';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_ec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success hide data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
        deleteData_objective: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to hide this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData_objective';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_objective.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success hide data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
        showData_objective: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to show this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskShowData_objective';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_objective.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success show data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
         deleteData_ap: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to hide this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData_ap';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_ap.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success hide data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error submitting data');
                     });
                });
        },

        showData_ap: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to show this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskShowData_ap';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList_ap.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success show data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error submitting data');
                     });
                });
        },
         deleteData_tax: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData_tax';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridTaxonomi.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
        deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/libraryriskDeleteData';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
        },
        showriskform: function(data) {
                var htmlopt = "";
                  
                 var url = site_url+'/library/getRiskCategory';
                    $.post(
                        url,
                        { 'id':  data.cat_name2},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                 
                                var key = datanya.ref_value;
                                var res = key.split(" - Category "); 
                                 
                                if(data.cat_name == res[1]){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopt += "<option value = '"+datanya.ref_key+"' "+select+">"+datanya.ref_value+"</option>";
                                 
                            }   
                            $("#cat_name").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
             
                $('#modal-listrisk-form').find('input[name=risk_id]').attr('readonly', true).val(data.risk_code);
                $('#modal-listrisk-form').find('textarea[name=risk_event]').attr('readonly', false).val(data.risk_event);
                $('#modal-listrisk-form').find('textarea[name=risk_cause]').attr('readonly', false).val(data.risk_cause);
                $('#modal-listrisk-form').find('textarea[name=risk_impact]').attr('readonly', false).val(data.risk_impact);
                $('#modal-listrisk-form').find('select[name=cat_name]').attr('readonly', false).val(data.cat_name2);
                $('#modal-listrisk-form').find('textarea[name=risk_description]').attr('readonly', false).val(data.risk_description);
                
                //console.log(data_risk);
                $('#sel_risk_category').find('option').remove();
                $('#sel_risk_sub_category').find('option').remove();
                $('#sel_risk_2nd_sub_category').find('option').remove();
                
                $.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( datax ) {
                    
                    $.each( datax, function( key, val ) {
                        $('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                    });
                    $('#sel_risk_category').val(data.cat_id1);
                    
                    $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data.cat_id1, function( data1 ) {
                        $.each( data1, function( key2, val2 ) {
                            $('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
                        });
                        $('#sel_risk_sub_category').val(data.cat_id2);                      
                            
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data.cat_id2, function( data2 ) {
                            $.each( data2, function( key3, val3 ) {                             
                                $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
                                $('#sel_risk_2nd_sub_category').val(data.cat_id3);
                                Metronic.unblockUI();
                            });
                        });
                    });
                });
                  
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },


 showriskforminfo: function(data) {
    $.ajax({
        url: 'index.php/library/list_risk/',
        type: 'POST',
        data: { risk_code: data.risk_code, field2 : "inimah"} ,
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            location.href=site_url+'/library/list_risk_properties/'+data.risk_code;
           //$('#modal_listrisk_info').modal('show');
        }
    }); 
                  
                //$('#modal_listrisk_info').modal('show');
                this.dataMode = 'view';
            },
            
            showriskform_ap: function(data) {
                                var htmlopt = "";
                
                 var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  data.division_id},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                  
                                if(data.division == datanya.division_id){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopt += "<option value = '"+datanya.division_id+"' "+select+">"+datanya.division_name+"</option>";
                                 
                            }   
                            $("#division").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                 
                    var dud = data.due_date_v;
                    if(dud == '00-00-0000'){
                         $('#kcc').show();
                         $('#ckc').hide();
                         $("#checked").show();
                         $('#fdate').hide();
                    }else{
                         $('#ckc').show();
                         $('#kcc').hide();
                         $("#checked").hide();
                         $('#fdate').show();
                    }

                $('#modal-listrisk-form').find('input[name=ap_code]').attr('readonly', true).val(data.id);    
                $('#modal-listrisk-form').find('input[name=id]').attr('readonly', true).val(data.id);
                $('#modal-listrisk-form').find('textarea[name=action_plan]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=due_date]').attr('readonly', true).val(data.due_date_v);
                
              
                $('#modal-listrisk-form').find('input[name=action_plan_status]').attr('readonly', true).val(data.action_plan_status);
                $('#modal-listrisk-form').find('input[name=periode_id]').attr('readonly', true).val(data.periode_id);
                $('#modal-listrisk-form').find('textarea[name=action_plan_ex]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=division_ex]').attr('readonly', false).val(data.division); 
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },

        selectLibraryaction: function(rid) {
            var me = this;
            
            //document.getElementById("check_date").checked = false;

            $('#modal-libraryaction').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadactionLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['action_plan'] = data_risk['action_plan'];
                
                me.populateRisk($('#modal-listrisk-form'), data_risk);
            });
         
        },

        selectControlLibrary: function(rid) {
            var me = this;
            $('#modal-listrisk-form textarea[name=risk_existing_control]').attr('readonly', false);
            $('#modal-listrisk-form text[name=id]').attr('readonly', false);
            
            $('#modal-control').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['id'] = data_risk['id'];
                
                me.populateRisk($('#modal-listrisk-form'), data_risk);
            });
        },

        populateRisk: function(frm, data) {
                
            $.each(data, function(key, value){

                if($('#due_date').val() == '00-00-0000' || $('#due_date').val() == 'Continuous'){
                    $('#fdate').hide();
                    $("#checked").show();
                    $('#ckc').hide();
                    $('#kcc').show();   
                }else{
                    $('#fdate').show();
                    $("#checked").hide();
                    $('#ckc').show();
                    $('#kcc').hide();   
                } 

                var $ctrl = $('[name='+key+']', frm);  
                switch($ctrl.attr("type"))  
                {  
                    case "text" :   
                    case "hidden":  
                    case "textarea":
                        $ctrl.val(value);   
                        break;   
                    case "radio" : case "checkbox":   
                    $ctrl.each(function(){
                       if($(this).attr('value') == value) {  $(this).prop("checked",true); } });   
                    break;  
                    default:
                    $ctrl.val(value); 
                }  
            });  
        },

            showriskform_kri: function(data) {
            
                var htmlopt = "";
                var htmloptselect = "";
                
                $("#treshold_listnya").html("");
                
                 var url = site_url+'/library/get_treshold_type';
                    $.post(
                        url,
                         { 'id':  data.DT_RowId},
                        function(datax) {
                        
                            var datanya = datax['treshold_list'];                           
                            for (var i = '0'; i < datanya.length; i++) {
                                var datanya_x = datanya[i];
                                  
                                htmlopt += "<tr role='row'  >";
                                htmlopt += "                        <td>"+datanya_x.operator+"</td>";
                                htmlopt += "                        <td>"+datanya_x.value_1+"</td>";
                                htmlopt += "                        <td>"+datanya_x.value_2+"</td>";
                                htmlopt += "                        <td>"+datanya_x.value_type+"</td>";
                                htmlopt += "                        <td>"+datanya_x.result+"</td>";
                                htmlopt += "    <td> <button class='btn btn-default btn-xs' onclick='delete_treshold("+datanya_x.id+")'  type='button'><i class='fa fa-trash-o font-red'></i></button></td>";
                                htmlopt += "                    </tr>";
                                 
                            }   
                            $("#treshold_listnya").append(htmlopt);
                             
                            var cars = ["SELECTION", "VALUE"]; 
                            for(var y = 0 ; y < 2; y++) {
                             
                                if(cars[y] == datax.treshold_type){
                                    var select = "selected = 'selected'";
                                }else{
                                    var select = "";
                                }
                            
                                htmloptselect += "<option "+select+" >"+cars[y]+"</option>";
                                
                            }
                            
                            $("#select-treshold-type").html(htmloptselect);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                     
                
                $('#kri-form-selection').find('input[name=kri_id]').attr('readonly', true).val(data.DT_RowId); 
                $('#kri-form-value').find('input[name=kri_id]').attr('readonly', true).val(data.DT_RowId); 
                $('#modal-listrisk-form').find('input[name=kri_code]').attr('readonly', true).val(data.kri_code);
                $('#modal-listrisk-form').find('input[name=key_risk_indicator]').attr('readonly', false).val(data.key_risk_indicator);
                $('#modal-listrisk-form').find('input[name=mandatory]').attr('readonly', false).val(data.mandatory);
                  
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },
            
            showriskform_ec: function(data) {
                var htmlopt = "";
                var htmlopr = "";
                
                 var url = site_url+'/library/getExistingControl';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datay) {
                            
                            for (var i = '0'; i < datay.length; i++) {
                                var datanya = datay[i];
                                  
                                if(data.risk_evaluation_control == datanya.evaluation_control){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopt += "<option value = '"+datanya.evaluation_control+"' "+select+">"+datanya.evaluation_control+"</option>";
                                 
                            }   
                             
                            $("#risk_evaluation_control").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });

                    var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                  
                                if(data.risk_control_owner == datanya.division_id){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopr += "<option value = '"+datanya.division_id+"' "+select+">"+datanya.division_name+"</option>";
                                 
                            }   
                             
                            $("#risk_control_owner").html(htmlopr);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                    
                $('#modal-listrisk-form').find('input[name=id]').attr('readonly', true).val(data.id);
                $('#modal-listrisk-form').find('input[name=idex]').attr('readonly', true).val(data.id);
                $('#modal-listrisk-form').find('textarea[name=risk_existing_control]').attr('readonly', false).val(data.risk_existing_control);
                $('#modal-listrisk-form').find('textarea[name=risk_existing_control_ex]').attr('readonly', true).val(data.risk_existing_control);

                $('#modal-listrisk-form').find('input[name=risk_evaluation_control_ex]').attr('readonly', true).val(data.risk_evaluation_control);
                $('#modal-listrisk-form').find('input[name=risk_control_owner_ex]').attr('readonly', true).val(data.risk_control_owner);


                  
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },

            showriskform_objective: function(data) {
                var htmlopt = "";
                
                 var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                  
                                if(data.risk_control_owner == datanya.division_id){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopt += "<option value = '"+datanya.division_id+"' "+select+">"+datanya.division_id+"</option>";
                                 
                            }   
                             
                            $("#").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                    
                $('#modal-listrisk-form-objective').find('input[name=id]').attr('readonly', true).val("OB."+data.id);
                $('#modal-listrisk-form-objective').find('textarea[name=objective]').attr('readonly', false).val(data.objective);

                $('#modal-listrisk-form-objective').find('textarea[name=objective_ex]').attr('readonly', false).val(data.objective);
                  
                $('#modal_listrisk_objective').modal('show');
                this.dataMode = 'view';
            },
            
            showriskform_tax: function(data) {
                  
                $('#modal-listrisk-form').find('input[name=cat_code]').attr('readonly', true).val(data.cat_code);
                $('#modal-listrisk-form').find('input[name=cat_name]').attr('readonly', false).val(data.cat_name);
                $('#modal-listrisk-form').find('textarea[name=cat_desc]').attr('readonly', false).val(data.cat_desc);
                  
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },
            
            showriskform_ap_add: function(data) {
                var htmlopt = "";
                
                 var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                 
                                htmlopt += "<option value = '"+datanya.division_id+"' >"+datanya.division_name+"</option>";
                                 
                            }   
                            $("#division").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                    
                    $('#id').val('');
                    $('#action_plan').val('');
                    $('#due_date').val('');
                    
                    $('#modal_listrisk').modal('show');
                    
                this.dataMode = 'view';
            },
            
            showriskform_objective_add: function(data) {
                var htmlopt = "";
                
                 var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                 
                                htmlopt += "<option value = '"+datanya.division_id+"' >"+datanya.division_id+"</option>";
                                 
                            }   
                            $("#").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                    
                    $('#id').val('');
                    $('#objective').val('');
                    
                    $('#modal_listrisk_objective').modal('show');
                    
                this.dataMode = 'view';
            },

            showriskform_ec_add: function(data) {
                var htmlopt = "";
                var htmlopr = "";
                
                 var url = site_url+'/library/getExistingControl';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datay) {
                            
                            for (var i = '0'; i < datay.length; i++) {
                                var datanya = datay[i];
                                 
                                htmlopt += "<option value = '"+datanya.existing_control+"' >"+datanya.existing_control+"</option>";
                                 
                            }   
                            $("#risk_existing_control").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });

                     var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  ""},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                 
                                htmlopr += "<option value = '"+datanya.division_id+"' >"+datanya.division_name+"</option>";
                                 
                            }   
                            $("#risk_control_owner").html(htmlopr);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                    
                    $('#id').val('');
                    $('#risk_evaluation_control').val('');
                    
                    $('#modal_listrisk').modal('show');
                    
                this.dataMode = 'view';
            },

        filterDataGridRiskList: function() {
            var fby = $('#tab_risk_list-filterBy').val();
            var fval = $('#tab_risk_list-filterValue').val();
            
            gridRiskList.clearAjaxParams();
            gridRiskList.setAjaxParam("filter_by", fby);
            gridRiskList.setAjaxParam("filter_value", fval);
            gridRiskList.getDataTable().ajax.reload();
        },

        filterDataGridObjectiveList: function() {
            var fby = $('#tab_objective_list-filterBy').val();
            var fval = $('#tab_objective_list-filterValue').val();
            
            gridRiskList_objective.clearAjaxParams();
            gridRiskList_objective.setAjaxParam("filter_by", fby);
            gridRiskList_objective.setAjaxParam("filter_value", fval);
            gridRiskList_objective.getDataTable().ajax.reload();
        },

        filterDataGridActionList: function() {
            var fby = $('#tab_action_list-filterBy').val();
            var fval = $('#tab_action_list-filterValue').val();
            
            gridRiskList_ap.clearAjaxParams();
            gridRiskList_ap.setAjaxParam("filter_by", fby);
            gridRiskList_ap.setAjaxParam("filter_value", fval);
            gridRiskList_ap.getDataTable().ajax.reload();
        },

        filterDataGridControlList: function() {
            var fby = $('#tab_control_list-filterBy').val();
            var fval = $('#tab_control_list-filterValue').val();
            
            gridRiskList_ec.clearAjaxParams();
            gridRiskList_ec.setAjaxParam("filter_by", fby);
            gridRiskList_ec.setAjaxParam("filter_value", fval);
            gridRiskList_ec.getDataTable().ajax.reload();
        },

        filterDataGridTaksonomiList: function() {
            var fby = $('#tab_taksonomi_list-filterBy').val();
            var fval = $('#tab_taksonomi_list-filterValue').val();
            
            gridTaxonomi.clearAjaxParams();
            gridTaxonomi.setAjaxParam("filter_by", fby);
            gridTaxonomi.setAjaxParam("filter_value", fval);
            gridTaxonomi.getDataTable().ajax.reload();
        },

        filterDataGridKriList: function() {
            var fby = $('#tab_kri_list-filterBy').val();
            var fval = $('#tab_kri_list-filterValue').val();
            
            gridRiskList_kri.clearAjaxParams();
            gridRiskList_kri.setAjaxParam("filter_by", fby);
            gridRiskList_kri.setAjaxParam("filter_value", fval);
            gridRiskList_kri.getDataTable().ajax.reload();
        },
		
		filterDataGridTaksonomiUserList: function() {
            var fby = $('#tab_taksonomi_user_list-filterBy').val();
            var fval = $('#tab_taksonomi_user_list-filterValue').val();
            
            gridTaxonomi_user.clearAjaxParams();
            gridTaxonomi_user.setAjaxParam("filter_by", fby);
            gridTaxonomi_user.setAjaxParam("filter_value", fval);
            gridTaxonomi_user.getDataTable().ajax.reload();
        },

        filterLibraryAction: function() {
            var fval = $('#modal-libraryaction div.inputs input[name=filter_search]')[0].value;
            gridLibraryaction.clearAjaxParams();
            gridLibraryaction.setAjaxParam("filter_library", fval);
            gridLibraryaction.getDataTable().ajax.reload(); 
        },

        filterControl: function() {
            var fval = $('#modal-control div.inputs input[name=filter_search]')[0].value;
            gridControl.clearAjaxParams();
            gridControl.setAjaxParam("filter_library", fval);
            gridControl.getDataTable().ajax.reload();   
        },
       
    };  
}();

function delete_treshold(a){

            var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/library/delete_treshold';
                    $.post(
                        url,
                        { 'id':  a},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var htmloptdet = "";
                                $("#treshold_listnya").html("");
                                 
                                for (var i = '0'; i < data.totaldata; i++) {
                                    var datanya_x = data[i];
                                      
                                    htmloptdet += "<tr role='row'  >";
                                    htmloptdet += "                     <td>"+datanya_x.operator+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_1+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_2+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_type+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.result+"</td>";
                                    htmloptdet += " <td><button class='btn btn-default btn-xs' onclick='delete_treshold("+datanya_x.id+")'  type='button'><i class='fa fa-trash-o font-red'></i></button></td>";
                                    htmloptdet += " </tr>";
                                      
                                    
                                }
                                $("#treshold_listnya").html(htmloptdet);
                                
                                  
                                MainApp.viewGlobalModal('success', 'Success Delete Data');                              
                                 
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
}


function load_tresholddet(a){
 
                    var url = site_url+'/library/load_tresholddet';
                    $.post(
                        url,
                        { 'id':  a},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var htmloptdet = "";
                                $("#treshold_listnya").html("");
                                 
                                for (var i = '0'; i < data.totaldata; i++) {
                                    var datanya_x = data[i];
                                      
                                    htmloptdet += "<tr role='row'  >";
                                    htmloptdet += "                     <td>"+datanya_x.operator+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_1+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_2+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.value_type+"</td>";
                                    htmloptdet += "                     <td>"+datanya_x.result+"</td>";
                                    htmloptdet += " <td><button class='btn btn-default btn-xs' onclick='delete_treshold("+datanya_x.id+")'  type='button'><i class='fa fa-trash-o font-red'></i></button></td>";
                                    htmloptdet += " </tr>";
                                      
                                    
                                }
                                $("#treshold_listnya").html(htmloptdet);
                                
                                  
                                MainApp.viewGlobalModal('success', 'Success Delete Data');                              
                                 
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {                        
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
             
}
  
 