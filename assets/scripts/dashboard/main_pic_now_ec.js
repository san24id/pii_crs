var grid_exec = new Datatable();
grid_exec.init({
    src: $("#datatable_action_exec"),
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
            "url": site_url+"/main/mainpic/getActionPlanExec_now" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 4) {
                    img = 'draft.png';
                } else if (data == 5) {
                    img = 'verified_head.png';
                } else if (data == 6) {
                    img = 'submit.png';
                }else if (data > 6) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.assigned_to_v;
                var dat = '';
               if  (ret == '' || ret == null) {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=acp">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=acp">'+data+'</a>';
                }
                return dat;
            }
        },
          {
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
        },
        {
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                    if(full.status_periode == 1){
                        if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }else{
                            ret = '<span>'+data+'</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }
                    }else if(full.status_periode == 0){
                         if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp;';
                                  
                        }else{
                            ret = '<span>'+data+'</span> &nbsp;';
                        }
                    }
                return ret;
            }
        }, {
            "targets": 7,
            "data": "act_code",
           "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }
            }
        },{
            "targets": 6,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                var ext = '';
                var search = false;
                var submit = false;

               if(full.status_periode == 1){
                    if(full.action_plan_status != 7 && full.action_plan_status != 6){
                        var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Edit </i></button>';
                        var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                    }else{
                        var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Show </i></button>';
                        var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                    }
                }else if(full.status_periode == 0){
                var search_text = '';
                var submit_text = '';
                }

                data_v = '';
                if (data == 'EXTEND') data_v = 'Extend';
                if (data == 'COMPLETE') data_v = 'Complete';
                if (data == 'ONGOING') data_v = 'On Going';
                
                if (full.is_owner == 1) {
                    search = true;
                    if (data_v != '' && full.action_plan_status == 4) submit = true;
                    if (data_v != '' && full.action_plan_status == 5 && full.is_head == 1) submit = true;
                } else {
                    if (data_v != '') search = true;
                    if (data_v != '' && full.action_plan_status == 5) submit = true;
                }
                 
                
                if (!search) search_text = '';
                if (!submit) submit_text = '';
                
                var ret = data_v+' &nbsp; <div class="btn-group">'+
                        search_text+
                        submit_text+
                    '</div>'
                return ret;
                
            }
        }, {
            "targets": 9,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data == 6) {
                     if(full.existing_control_id == 1){
                            tt='<div class="btn-group">'+
                                '<button type="button" class="btn red btn-xs button-grid-edit" disabled="disabled"><i> Request Pending to RAC </i></button>'+ 
                                '</div>';
                    }else{
                     tt = '<div class="btn-group">'+
                            '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/main/mainpic/ChangeRequestActionExe/'+full.id_p+'/'+full.action_plan_status+'\'"><i class="fa fa-pencil"> Change Request </i></button>'+
                        '</div>';
                    }
                }
                return tt;
            }
        }],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "assigned_to_v" },
            { "data": "division_name"},
            { "data": "execution_status" },
            { "data": "risk_code" },
            { "data": "risk_owner_v"},
            { "data": "action_plan_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

$("#pic_list_table").DataTable();

var Dashboard = function() {
    return {
        tmpRiskId: null,
        init: function() {
            var me = this;
            
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };

             //---------------------acntion plan execution
            $('#choose_l_divisi-execution').hide();
            $('#choose_status-execution').hide();

            $('#tab_action_plan_exec-filterBy').change(function(){
                var risk_execution = $('#tab_action_plan_exec-filterBy').val();
                 if(risk_execution == "action_plan"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                 }else if(risk_execution == "due_date"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                }else if(risk_execution == "division"){
                    $('#choose_l_divisi-execution').show();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                }else if(risk_execution == "execution_status"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').show();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                }else if(risk_execution == "risk_code"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                 }else if(risk_execution == "risk_owner"){
                    $('#choose_l_divisi-execution').show();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            $('#l_divisi-execution').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_action_plan_exec-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-execution').val();
                if(l_divisi == "-"){
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            $('#choose_status-execution').change(function(){
                var status_execution = $('#status-execution').val();
                if(status_execution == 'ONGOING'){
                    $('#tab_action_plan_exec-filterValue').val('ONGOING');
                }else if(status_execution == 'EXTEND'){
                    $('#tab_action_plan_exec-filterValue').val('EXTEND');
                }else if(status_execution == 'COMPLETE'){
                    $('#tab_action_plan_exec-filterValue').val('COMPLETE');
                }else{
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });
            
            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
            
            var cnt1 = cnt2 = cnt3 = 0; 
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
                $.each( data, function( key, val ) {
                    // GET INIT SUB CATEGORY
                    if (cnt1 == 0) {
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val.ref_key, function( data1 ) {
                            $.each( data1, function( key2, val2 ) {
                                if (cnt2 == 0) {
                                    // GET INIT 2ND SUB CATEGORY
                                    $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val2.ref_key, function( data2 ) {
                                        $.each( data2, function( key3, val3 ) {
                                            $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
                                        });
                                    });
                                }
                                
                                $('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
                                    
                                cnt2++;
                            });
                        });
                    }
                    
                    $('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                        
                    cnt1++;
                });
            });

             var cnto1 = cnto2 = cnto3 = 0; 
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
                $.each( data, function( key, val ) {
                    // GET INIT SUB CATEGORY
                    if (cnto1 == 0) {
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val.ref_key, function( data1 ) {
                            $.each( data1, function( key2, val2 ) {
                                if (cnto2 == 0) {
                                    // GET INIT 2ND SUB CATEGORY
                                    $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val2.ref_key, function( data2 ) {
                                        $.each( data2, function( key3, val3 ) {
                                            $('#sel_old_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
                                        });
                                    });
                                }
                                
                                $('#sel_old_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
                                    
                                cnto2++;
                            });
                        });
                    }
                    
                    $('#sel_old_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                        
                    cnto1++;
                });
            });
            
            $('#sel_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_sub_category', val);
            });
            
            $('#sel_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_2nd_sub_category', val);
            });

            $('#sel_old_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_sub_category', val);
            });
            
            $('#sel_old_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_2nd_sub_category', val);
            });
            
            // FILTER BUTTON
            $('#button-filter-category').on('click', function() {
                var cat = $("#sel_risk_2nd_sub_category").val();
                me.filterMyRisk('risk_2nd_sub_category', cat);
            });
            
            $('#button-filter-clear').on('click', function() {
                me.filterMyRisk('risk_2nd_sub_category', false);
            });

            $('#button-old-filter-category').on('click', function() {
                var cat = $("#sel_old_risk_2nd_sub_category").val();
                me.filterOldMyRisk('risk_old_2nd_sub_category', cat);
            });
            
            $('#button-old-filter-clear').on('click', function() {
                me.filterOldMyRisk('risk_old_2nd_sub_category', false);
            });

            $("#form_tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
            });
            
            $('#tab_action_plan_exec-filterButton').on('click', function() {
                me.filterDataGridActionplanexec();
            });
            
            $('#pic_list_table button.button-assign-pic').on('click', function() {
                var xx = $(this).attr("value");
                var idx = $(this).attr("value_idx");
                var mode = me.tmpRiskMode;
                
                var vv = $('#modal-pic-tr-'+idx+' > td.col_display_name').html();
                
                var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this risk ?';
                if (mode == 'actionplan') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this Action Plan ?';
                }
                
                if (mode == 'kri') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this KRI ?';
                }
                
                var mod = MainApp.viewGlobalModal('confirm', text);
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    $('#modal-pic').modal('hide');
                    me.ownedAssignPic(me.tmpRiskId, xx, mode);
                });
            });
            
            $('#exec-select-status').change(function() {
                if ($( this ).val() == 'EXTEND') {
                    $('#fgroup-explain').hide();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').show();
                    $('#fgroup-date').show();
                    $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                } else if ($( this ).val() == 'COMPLETE') {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
                else  {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
            });
            
            $("#datatable_action_exec").on('click', 'button.button-grid-search', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec.getDataTable().row(r).data();
                me.viewExecutionForm(data);
            });
            
            $("#datatable_action_exec").on('click', 'button.button-grid-submit', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec.getDataTable().row(r).data();
                
                var url = site_url+'/main/mainpic/execSubmit';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Submit this Action Plan Execution?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {action_id: data.id_p},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid_exec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                            } else {
                   
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
            });
//simpan yang on going          
            $('#exec-button-save').on('click', function() {
                var me = this;
                var url = site_url+'/main/mainpic/execSaveDraft';
                var valid = false;
                
                if ($('#exec-select-status').val() == 'COMPLETE') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                    ) valid = true
                     $( "#exec-form" ).find('textarea[name=execution_evidence]').val() != ''
                }
                
                if ($('#exec-select-status').val() == 'EXTEND') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_reason]').val() != ''
                        && $( "#exec-form" ).find('input[name=revised_date]').val() != ''
                    ) valid = true
                }
                
                if ($('#exec-select-status').val() == 'ONGOING') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                         
                    ) valid = true
                }
                
                if (valid) {
                    var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to save this Action Plan Execution ?');
                    mod.find('button.btn-primary').off('click');
                    mod.find('button.btn-primary').one('click', function(){
                        mod.modal('hide');
                        $('#modal-exec').modal('hide');
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $( "#exec-form" ).serialize(),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    grid_exec.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                                } else {
                                     
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'This Risk Is Under Maintenance by RAC you cannot modify this risk until the process done');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainpic/actionplanexe_now';
                            });
                                }
                            },
                            "json"
                        ).fail(function() {
                            Metronic.unblockUI();
                            //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                              grid_exec.getDataTable().ajax.reload();
                              MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                         });
                    });
                } else {
                    MainApp.viewGlobalModal('error', 'Please Fill All Action Plan Execution data');
                }
            });

            $('#submit-action_plan_exe').click(function(e) {
                 e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                        var url = site_url+'/main/mainpic/submitstatement_action_plan_exe';
    
                    $.post(
                        url,
                        $( "#input-form-action_plan_exe" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                
                                $('#modal-action_plan_exe').modal('hide');
                                $('#submit-action_plan_exe').hide();
                                $('#ar3').show();
                                
                                MainApp.viewGlobalModal('success', 'Success your confirmation');
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
            
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body");
        },
        initUserChart: function() {
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myrisk", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_user", data, on_options);
                /*
                $("#chart_user").bind("plothover", function (event, pos, item) {
                    if (item) {
                        var x = item.datapoint[0].toFixed(0)
    
                        $("#tooltip").html(x)
                            .css({top: item.pageY+5, left: item.pageX+5})
                            .fadeIn(200);
                    } else {
                        $("#tooltip").hide();
                    }
                });
                */
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myriskowned", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_owned", data, on_options);
                
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myactionplan", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_action_plan", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/kri", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_kri", data, on_options);
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
        filterMyRisk: function(fby, fval) {
            grid.clearAjaxParams();
            if (fval) {
                grid.setAjaxParam("risk_cat", fval);
            }
            grid.getDataTable().ajax.reload();
        },
        loadCategoryOldSelect: function(sel_id, parent) {
            $('#'+sel_id)[0].options.length = 0;
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+parent, function( data ) {
                $.each( data, function( key, val ) {
                    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                });
                $('#'+sel_id).trigger('change');
            });
        },
        filterOldMyRisk: function(fby, fval) {
            grid_old.clearAjaxParams();
            if (fval) {
                grid_old.setAjaxParam("risk_cat", fval);
            }
            grid_old.getDataTable().ajax.reload();
        },
        viewOwnedAssignForm: function(risk_id, mode) {
            var me = this;
            me.tmpRiskId = risk_id;
            me.tmpRiskMode = mode;
            
            $('#modal-pic').modal('show');
        },
        filterDataGridActionplanexec: function() {
            var fby = $('#tab_action_plan_exec-filterBy').val();
            var fval = $('#tab_action_plan_exec-filterValue').val();
            
            grid_exec.clearAjaxParams();
            grid_exec.setAjaxParam("filter_by", fby);
            grid_exec.setAjaxParam("filter_value", fval);
            grid_exec.getDataTable().ajax.reload();
        },
        ownedAssignPic: function(risk_id, pic, mode) {
            Metronic.blockUI({ boxed: true });
            var url = site_url+'/main/mainpic/assignPic';
            $.post(
                url,
                { 'risk_id':  risk_id, 'pic':  pic, 'mode': mode },
                function( data ) {
                    Metronic.unblockUI();
                    if(data.success) {
                        if (mode == 'treatment') {
                            grid_owned.getDataTable().ajax.reload();
                        } else if (mode == 'kri') {
                            grid_kri.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexec') {
                            grid_exec.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexecadt') {
                            grid_exec_adt.getDataTable().ajax.reload();
                        } else {
                            grid_action.getDataTable().ajax.reload();
                        }
                        MainApp.viewGlobalModal('success', 'Success Assign PIC');
                    } else {
                        MainApp.viewGlobalModal('error', data.msg);
                    }
                    
                },
                "json"
            ).fail(function() {
                Metronic.unblockUI();
                MainApp.viewGlobalModal('error', 'Error Submitting Data');
             });
            
        },
 //ini view yang excecution on going
        viewExecutionForm: function(data) {
            var me = this;
            var act_id = data.id_p;
            var act_du = data.due_date_v;
            
            $('#exec-form')[0].reset();
            
            $('#form-action-id').val(act_id);
            $('#form-action-dd').val(act_du);
            
            $('#fgroup-explain').hide();
            $('#fgroup-evidence').hide();
            $('#fgroup-reason').hide();
            $('#fgroup-date').hide();
            
            $( '#exec-select-status' ).prop('disabled', true);
            $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', true);
            $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', true);
            $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', true);
            
            $('#exec-button-save').hide();
            
            if (data.execution_status == 'COMPLETE') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_explain]').val(data.execution_explain);
                $( "#exec-form" ).find('textarea[name=execution_evidence]').val(data.execution_evidence);
                
                $('#fgroup-explain').show();
                $('#fgroup-evidence').show();
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
            } else if (data.execution_status == 'EXTEND') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_reason]').val(data.execution_reason);
                $( "#exec-form" ).find('input[name=revised_date]').val(data.revised_date_v);
                
                $('#fgroup-reason').show();
                $('#fgroup-date').show();
                
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
/* untuk menampilkan data saat di search yang on going*/

            } else if (data.execution_status == 'ONGOING') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_explain]').val(data.execution_explain);
                
                $('#fgroup-explain').show();
                
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
}else{
                $( '#exec-select-status' ).val('COMPLETE');
                $('#fgroup-explain').show();
                $('#fgroup-evidence').show();
                $( '#exec-select-status' ).prop('disabled', false);
                $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                $('#exec-button-save').show();
            }            
            //
            //if (data.is_owner == 1 && (data.action_plan_status == 4 || data.action_plan_status == 5)) {
            //  $('#exec-button-save').show();
            //}
            
            $('#modal-exec').modal('show');
            
        }
    };  
}();


