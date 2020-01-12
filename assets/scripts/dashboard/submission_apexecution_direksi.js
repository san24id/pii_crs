$('#ne').hide();
$('#choose_status_date_apx').hide();
$('#choose_l_divisi_apx').hide();
$('#tab_apex-filterBy').change(function(){
    var frmval = $('#tab_apex-filterBy').val();
    if(frmval == 'choose'){
        $('#ne').hide();
        $('#choose_l_divisi_apx').hide();
        $('#choose_status_date_apx').hide();
        $('.hash').attr('id', 'tab_apex-filterValue');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }else if(frmval == 'display_name'){
        $('#ne').show();
        $('#choose_l_divisi_apx').hide();
        $('#choose_status_date_apx').hide();
        $('.hash').attr('id', 'tab_apex-filterValue');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }
    else if(frmval == 'status_date'){
        $('#ne').hide();
        $('#choose_l_divisi_apx').hide();
        $('#choose_status_date_apx').show();
        $('.hash').attr('id', 'ne');
        $('.bish').attr('id', 'tab_apex-filterValue');
        $('.besh').attr('id', 'choose_l_divisi_ap');
    }
    else if(frmval == 'division_name'){
        $('#ne').hide();
        $('#choose_l_divisi_apx').show();
        $('#choose_status_date_apx').hide();
        $('.hash').attr('id', 'ne');
        $('.bish').attr('id', 'choose_status_date_ap');
        $('.besh').attr('id', 'tab_apex-filterValue');
    }
});

var gridListActionPlanExe = new Datatable();
gridListActionPlanExe.init({
    src: $("#datatable_ajax_apex"),
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
        "ajax": {
            "url": site_url+"/admin/reminder/getdataApex" // ajax source
        },  
         "columnDefs":[{
            "targets": 1,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self"  href="'+site_url+'/library/viewSubmitApex/'+full.id+'">'+full.periode_name+'</a>';
                
            }
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "id"},
           { "data": "mail_subject" },
           { "data": "due_date_v" },
           { "data": "f1due_date" },
           { "data": "f2due_date" },
           { "data": "f3due_date" },
           { "data": "create_date"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionPlanExe = new Datatable();
gridActionPlanExe.init({
    src: $("#datatable_ajax_vapex"),
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
            "url": site_url+"/library/getHeadActionPlanExe/"+g_id // ajax source
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
                        '<td><a target="_self" class="" href="'+site_url+'/library/viewConfirmApexHead/'+full.username+'/'+full.id_apex+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-eye ">View</i></button></a></td>'+
                        '<td><a target="_self" class="" href="'+site_url+'/library/ViewConfirmApexHead_excel/'+full.username+'/'+full.id_apex+'"><button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa font-green fa-download">Export</i></button></a></td>'+  
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
            { "data": "username","orderable": true }
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
            
            $('#tab_apex-filterButton').on('click', function() {
                me.filterDataGridApex();
            });

            $("#form_tab_apex").submit(function (e) {
                e.preventDefault();
                me.filterDataGridApex();
            });   
        },
            
                        

        filterDataGridApex: function() {
            var fby = $('#tab_apex-filterBy').val();
            var fval = $('#tab_apex-filterValue').val();
            
            gridActionPlanExe.clearAjaxParams();
            gridActionPlanExe.setAjaxParam("filter_by", fby);
            gridActionPlanExe.setAjaxParam("filter_value", fval);
            gridActionPlanExe.getDataTable().ajax.reload();
        },

        viewApexeSubmission: function(username, mode,note, periode_id, type, id_apex) {
             
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
            $("#modal_pic_risk_id_apex").val(id_apex);
            $('#modal-submit-apex').modal('show');      
        }
       
    };  
}();

function submit_risk_apex(){             
    $.ajax({ 
        type: 'POST',
        url: site_url+"/main/mainrac/submit_risk_apex",
        data: $("#noteform").serialize(),
        success: function(data){
            $('#modal-submit-apex').modal('hide');
            gridActionPlanExe.getDataTable().ajax.reload();
        }               
    })
}