var id_periode = $('#periode_id').val();
$('#na').hide();  
$('#choose_l_divisi').hide();
$('#choose_status_date').hide();
$('#ni').hide();
$('#choose_status_date_own').hide();
$('#choose_l_divisi_own').hide();
$('#nu').hide();
$('#choose_status_date_ap').hide();
$('#choose_l_divisi_ap').hide();

 $('.bish').attr('id', 'tab_risk_list-filterValue');

$('#tab_risk_list-filterBy').change(function(){
    var frmval = $('#tab_risk_list-filterBy').val();
    if(frmval == 'choose'){
        $('#na').hide();
        $('#choose_l_divisi').hide();
        $('#choose_status_date').hide();
        $('.hash').attr('id', 'tab_risk_list-filterValue');
        $('.bish').attr('id', 'choose_status_date');
        $('.besh').attr('id', 'choose_l_divisi');
    }else if(frmval == 'display_name'){
        $('#na').show();
        $('#choose_l_divisi').hide();
        $('#choose_status_date').hide();
        $('.hash').attr('id', 'tab_risk_list-filterValue');
        $('.bish').attr('id', 'choose_status_date');
        $('.besh').attr('id', 'choose_l_divisi');
    }
    else if(frmval == 'status_date'){
        $('#na').hide();      
        $('#choose_l_divisi').hide();
        $('#choose_status_date').show();
        $('.hash').attr('id', 'na');
        $('.bish').attr('id', 'tab_risk_list-filterValue');
        $('.besh').attr('id', 'choose_l_divisi');
    }

    else if(frmval == 'division_name'){
        $('#na').hide();
        $('#choose_l_divisi').show();
        $('#choose_status_date').hide();
        $('.hash').attr('id', 'na');
        $('.bish').attr('id', 'choose_status_date');
        $('.besh').attr('id', 'tab_risk_list-filterValue');
    }
});

$('#tab_risk_owned-filterBy').change(function(){
    var frmval = $('#tab_risk_owned-filterBy').val();
    if(frmval == 'choose'){
        $('#ni').hide();
        $('#choose_l_divisi_own').hide();
        $('#choose_status_date_own').hide();
        $('.hash').attr('id', 'ni');
        $('.bish').attr('id', 'choose_status_date_own');
        $('.besh').attr('id', 'choose_l_divisi_own');
    }else if(frmval == 'display_name'){
        $('#ni').show();
        $('#choose_l_divisi_own').hide();
        $('#choose_status_date_own').hide();
        $('.hash').attr('id', 'tab_risk_owned-filterValue');
        $('.bish').attr('id', 'choose_status_date_own');
        $('.besh').attr('id', 'choose_l_divisi_own');
    }
    else if(frmval == 'status_date'){
        $('#ni').hide();      
        $('#choose_l_divisi_own').hide();
        $('#choose_status_date_own').show();
        $('.hash').attr('id', 'ni');
        $('.bish').attr('id', 'tab_risk_owned-filterValue');
        $('.besh').attr('id', 'choose_l_divisi_own');
    }
    else if(frmval == 'division_name'){
        $('#ni').hide();
        $('#choose_l_divisi_own').show();
        $('#choose_status_date_own').hide();
        $('.hash').attr('id', 'ni');
        $('.bish').attr('id', 'choose_status_date_own');
        $('.besh').attr('id', 'tab_risk_owned-filterValue');
    }
});

$('#tab_action_plan-filterBy').change(function(){
    var frmval = $('#tab_action_plan-filterBy').val();
    if(frmval == 'choose'){
        $('#nu').hide();
        $('#choose_l_divisi_ap').hide();
        $('#choose_status_date_ap').hide();
        $('.hash').attr('id', 'nu');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }else if(frmval == 'display_name'){
        $('#nu').show();
        $('#choose_l_divisi_ap').hide();
        $('#choose_status_date_ap').hide();
        $('.hash').attr('id', 'tab_action_plan-filterValue');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }    
    else if(frmval == 'status_date'){
        $('#nu').hide();      
        $('#choose_l_divisi_ap').hide();
        $('#choose_status_date_ap').show();
        $('.hash').attr('id', 'nu');
        $('.bish').attr('id', 'tab_action_plan-filterValue');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }
    else if(frmval == 'division_name'){
        $('#nu').hide();
        $('#choose_status_date_ap').hide();
        $('#choose_l_divisi_ap').show();
        $('.hash').attr('id', 'nu');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'tab_action_plan-filterValue');
    }
});


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
            "url": site_url+"/library/getUserList/"+id_periode // ajax source
        },  
        "columnDefs": [ 
        {
            "targets": 0,
            "data": "status_date",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 'before') {
                    img = 'executed_2.png';
                } else if (data == 'past') {
                    img = 'treatment.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },{
            "targets": 4,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var maks = Math.max(data);
                if (data == maks) {
                    result = full.due_date_v;
                } else{
                    result = '';
                }
                return '<center>'+result+'</center>';
            }
        } ],
       
        "columns": [
            { "data": "status_date","orderable": true},
            { "data": "username"},
            { "data": "display_name"},
            { "data": "division_name"},
            { "data": "periode_id","orderable": true },
            { "data": "note"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRisOwnedkList = new Datatable();
gridRisOwnedkList.init({
    src: $("#datatable_ajax_risk_own"),
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
            "url": site_url+"/library/getHeadRiskOwn/"+id_periode // ajax source
        },  
        "columnDefs": [{
            "targets": 0,
            "data": "status_date",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 'before') {
                    img = 'executed_2.png';
                } else if (data == 'past') {
                    img = 'treatment.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },{
            "targets": 4,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var maks = Math.max(data);
                if (data == maks) {
                    result = full.tanggal_submit;
                } else{
                    result = '';
                }
                return '<center>'+result+'</center>';
            }
        },{
            "targets": 6,
            "data": "username",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var maks = Math.max(full.periode_id);
                if (full.periode_id == maks) {
                   img = '<table>'+
                        '<td><a target="_self" class="" href="'+site_url+'/library/viewConfirmHead/'+full.username+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-eye ">View</i></button></a><td>'+
                        '<td><a target="_self" class="" href="'+site_url+'/library/viewConfirmRiskOwnHead_excel/'+full.username+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-download">Export</i></button></a></td>'+  
                        '</table>';
                } else{
                    img = '';
                }
                return '<center>'+img+'</center>';
            }
        } ],
       
        "columns": [
            { "data": "status_date","orderable": true},
            { "data": "username"},
            { "data": "display_name"},
            { "data": "division_name"},
            { "data": "periode_id","orderable": true },
            { "data": "note"},
            { "data": "username","orderable": false }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionPlanList = new Datatable();
gridActionPlanList.init({
    src: $("#datatable_ajax_action_plan"),
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
            "url": site_url+"/library/getHeadActionPlan/"+id_periode // ajax source
        },  
        "columnDefs": [
        {
            "targets": 0,
            "data": "status_date",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 'before') {
                    img = 'executed_2.png';
                } else if (data == 'past') {
                    img = 'treatment.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },{
            "targets": 4,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var maks = Math.max(data);
                if (data == maks) {
                    result = full.tanggal_submit;
                } else{
                    result = '';
                }
                return '<center>'+result+'</center>';
            }
        },{
            "targets": 6,
            "data": "username",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var maks = Math.max(full.periode_id);
                if (full.periode_id == maks) {
                   img = '<table>'+
                        '<td><a target="_self" class="" href="'+site_url+'/library/viewConfirmApHead/'+full.username+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-eye ">View</i></button></a></td>'+
                        '<td><a target="_self" class="" href="'+site_url+'/library/viewConfirmActionPlanHead_excel/'+full.username+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-download">Export</i></button></a></td>'+  
                        '</table>';
                } else{
                    img = '';
                }
                return '<center>'+img+'</center>';
            }
        } ],
       
        "columns": [
            { "data": "status_date","orderable": true},
            { "data": "username"},
            { "data": "display_name"},
            { "data": "division_name"},
            { "data": "periode_id","orderable": true },
            { "data": "note"},
            { "data": "username","orderable": false }
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

            $('#tab_risk_owned-filterButton').on('click', function() {
                me.filterDataGridRiskOned();
            });

            $("#form_tab_risk_owned").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRiskOwned();
            });

            $('#tab_action_plan-filterButton').on('click', function() {
                me.filterDataGridActionPlan();
            });

            $("#form_tab_action_plan").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionPlan();
            });   
        },
            
                        
        filterDataGridRiskList: function() {
            var fby = $('#tab_risk_list-filterBy').val();
            var fval = $('#tab_risk_list-filterValue').val();
            
            gridRiskList.clearAjaxParams();
            gridRiskList.setAjaxParam("filter_by", fby);
            gridRiskList.setAjaxParam("filter_value", fval);
            gridRiskList.getDataTable().ajax.reload();
        },

        filterDataGridRiskOwned: function() {
            var fby = $('#tab_risk_owned-filterBy').val();
            var fval = $('#tab_risk_owned-filterValue').val();
            
            gridRisOwnedkList.clearAjaxParams();
            gridRisOwnedkList.setAjaxParam("filter_by", fby);
            gridRisOwnedkList.setAjaxParam("filter_value", fval);
            gridRisOwnedkList.getDataTable().ajax.reload();
        },

        filterDataGridActionPlan: function() {
            var fby = $('#tab_action_plan-filterBy').val();
            var fval = $('#tab_action_plan-filterValue').val();
            
            gridActionPlanList.clearAjaxParams();
            gridActionPlanList.setAjaxParam("filter_by", fby);
            gridActionPlanList.setAjaxParam("filter_value", fval);
            gridActionPlanList.getDataTable().ajax.reload();
        },

        viewOwnedAssignForm: function(username, mode,note, periode_id) {
             
            var me = this;
            me.tmpRiskId = username;
            me.tmpRiskMode = mode;
            if(note == "null"){
                note = "";
            }
             
            $("#modal_pic_note").val(note);
            $("#modal_pic_risk_input_by").val(username);
            $("#modal_pic_risk_periode").val(periode_id);
            $('#modal-pic').modal('show');
                
        },

         viewOwnedSubmission: function(username, mode,note, periode_id, type) {
             
            var me = this;
            me.tmpRiskId = username;
            me.tmpRiskMode = mode;
            if(note == "null"){
                note = "";
            }
             
            $("#modal_pic_note").val(note);
            $("#modal_pic_risk_input_by").val(username);
            $("#modal_pic_risk_periode").val(periode_id);
            $("#modal_pic_risk_type").val(type);
            $('#modal-submit-own').modal('show');      
        }
    };  
}();

function submit_note(){             
    $.ajax({ 
        type: 'POST',
        url: site_url+"/main/mainrac/submit_note",
        data: $("#noteform").serialize(),
        success: function(data){
            $('#modal-pic').modal('hide');
            gridRiskList.getDataTable().ajax.reload();
            gridRegister.getDataTable().ajax.reload();
        }               
    })
}

function submit_risk_own(){             
    $.ajax({ 
        type: 'POST',
        url: site_url+"/main/mainrac/submit_risk_own",
        data: $("#noteform").serialize(),
        success: function(data){
            $('#modal-submit-own').modal('hide');
            gridRisOwnedkList.getDataTable().ajax.reload();
            gridActionPlanList.getDataTable().ajax.reload();
        }               
    })
}