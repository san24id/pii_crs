var gridRiskOwned = new Datatable();
gridRiskOwned.init({
    src: $("#datatable_risk_owned"),
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
            "url": site_url+"/library/getViewConfirmHead",
            "data": function ( d ) {
                d.user_id = g_status_user_id;
                d.divisi_id = g_division_id;
                //MainApp.viewGlobalModal('error', d.msg);
            } // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var img = '';
                if (data == '5') {
                    img = 'submit.png';
                }else if(full.risk_existing_control == 'under'){ 
                    img = 'default.png';
                }else if (data == '3') {
                    img = 'draft.png';
                }else if (data == '4') {
                    img = 'draft.png';
                }else {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "risk_id",
            "render": function ( data, type, full, meta ) {
                if (full.risk_status == 5) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/ViewSubmitTreatment/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                }
                
                //return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "risk_owner_v"},
            { "data": "suggested_risk_treatment_v" }
       ],
        "order": [
            [0, "desc"], [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionPlan = new Datatable();
gridActionPlan.init({
 src: $("#datatable_action_plan"),
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
            "url": site_url+"/library/getViewConfirmApHead",
            "data": function ( d ) {
                d.user_id = g_status_user_id;
                d.divisi_id = g_division_id;
                //MainApp.viewGlobalModal('error', d.msg);
            } // ajax source
        },
    "columnDefs": [ {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 1) {
                    img = 'draft.png';
                } else if (data == 2) {
                    img = 'verified_head.png';
                }else if(full.existing_control_id == 1){
                    img = 'change_request.png';
                }else if (data == 3) {
                    img = 'submit.png';
                }else if (data > 3) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
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
        },
        {
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                    if(full.status_periode == 0){
                        if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }else{
                            ret = '<span>'+data+'</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }
                    }else if(full.status_periode == 1){
                         if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp;';
                                  
                        }else{
                            ret = '<span>'+data+'</span> &nbsp;';
                        }
                    }
                return ret;
            }
        }, {
            "targets": 6,
            "data": "act_code",
           "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.risk_id+'">'+data+'</a>';
                }
            }
        }],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "assigned_to_v" },
            { "data": "division_name"},
            { "data": "risk_code" },
            { "data": "risk_owner_v"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionExec = new Datatable();
gridActionExec.init({
    src: $("#datatable_ap_execution"),
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
            "url": site_url+"/library/getViewConfirmApexHead",
            "data": function ( d ) {
                d.user_id = g_status_user_id;
                d.divisi_id = g_division_id;
                d.id_apex = g_idapex;
                //MainApp.viewGlobalModal('error', d.msg);
            } // ajax source
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
                }else if(full.existing_control_id == 1){
                    img = 'change_request.png';
                }else if (data == 6) {
                    img = 'submit.png';
                }else if (data > 6) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
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
        },
        {
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                    if(full.status_periode == 0){
                        if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }else{
                            ret = '<span>'+data+'</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }
                    }else if(full.status_periode == 1){
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
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.risk_id+'">'+data+'</a>';
                }
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
            { "data": "risk_owner_v"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var Dashboard = function() {
    return {
        tmpRiskId: null,
        init: function() {
        	var me = this;

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


             $('#choose_l_divisi-treatment').hide();

            $('#tab_treatment_list-filterBy').change(function(){
                var risk_treatment = $('#tab_treatment_list-filterBy').val();
                 
                if(risk_treatment == "risk_code"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_event"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_owner"){
                    $('#choose_l_divisi-treatment').show();
                    $('#tab_treatment_list-filterValue').hide();
                    $('#tab_treatment_list-filterValue').val('');
                }else if(risk_treatment == "suggested_risk_treatment"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }
            });

            $('#l_divisi-treatment').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_treatment_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-treatment').val();
                if(l_divisi == "-"){
                    $('#tab_treatment_list-filterValue').val('');
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
            

            $('#tab_old_risk_list-filterButton').on('click', function() {
                me.filterDataGridOldRiskList();
            });

            $("#form_tab_old_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridOldRiskList();
            });
        	
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
				    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = grid_cr.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });

        	$('#tab_risk_register_list-filterButton').on('click', function() {
				
        		me.filterDataGridRegister();
        	});

            $("#form_tab_risk_register_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRegister();
            });
        	
        	$('#tab_treatment_list-filterButton').on('click', function() {
        		me.filterDataGridTreatment();
        	});
			
            $("#form_tab_treatment_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridTreatment();
            });

			$('#tab_action_plan_list-filterButton').on('click', function() {
        		me.filterDataGridActionplan();
        	});

            $("#form_tab_action_plan_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplan();
            });
			
            $("#form_tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
            });
            
        	$('#tab_action_plan_exec-filterButton').on('click', function() {
        		me.filterDataGridActionplanexec();
        	});

             $("#tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
            });

            $("#datatable_action_plan_exec").on('click', 'button.button-grid-search', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = gridActionExec.getDataTable().row(r).data();
                me.viewExecutionForm(data);
            });

            $('#exec-button-save').on('click', function() {
                var me = this;
                var url = site_url+'/main/mainpic/execSaveDraft';
                var valid = false;
                
                if ($('#exec-select-status').val() == 'COMPLETE') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                        //&& $( "#exec-form" ).find('textarea[name=execution_evidence]').val() != ''
                    ) valid = true
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
                    var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to save this Action Plan Execution ?');
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
                                    gridActionExec.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                                } else {
                                     
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'This Risk Is Under Maintenance by RAC you cannot modify this risk until the process done');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac';
                            });
                                }
                            },
                            "json"
                        ).fail(function() {
                            Metronic.unblockUI();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                    });
                } else {
                    MainApp.viewGlobalModal('error', 'Please Fill All Action Plan Execution data');
                }
            });

            $("#datatable_action_plan_exec").on('click', 'button.button-grid-submit', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = gridActionExec.getDataTable().row(r).data();
                
                var url = site_url+'/main/mainpic/execSubmit';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to Submit this Action Plan Execution?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {action_id: data.id},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
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


        },
        initUserChart: function() {
                        
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/risk", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_rac_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount2/riskregister", function( data ) {
            	var series = data;
            	var tick = [ [0, "User"], [1, ""], [2, ""] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_rr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/treatment", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_tr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/actionplan", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_ap_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/kri", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_kri_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/change", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_cr_to_verify", data, on_options);
            });
            
        },
        viewOwnedAssignForm: function(username, mode,note) {
			 
            var me = this;
            me.tmpRiskId = username;
            me.tmpRiskMode = mode;
			if(note == "null"){
				note = "";
			}
			 
			$("#modal_pic_note").val(note);
			$("#modal_pic_risk_input_by").val(username);
            $('#modal-pic').modal('show');
                
        },
		  
		//fake
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/crDeleteData';
                    $.post(
                        url,
                        { 'id':  data.id},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid_cr.getDataTable().ajax.reload();
                                
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
        filterDataGridRiskList: function() {
        	var fby = $('#tab_risk_list-filterBy').val();
        	var fval = $('#tab_risk_list-filterValue').val();
        	
        	gridRiskList.clearAjaxParams();
        	gridRiskList.setAjaxParam("filter_by", fby);
        	gridRiskList.setAjaxParam("filter_value", fval);
        	gridRiskList.getDataTable().ajax.reload();
        },

        filterDataGridOldRiskList: function() {
            var fby = $('#tab_old_risk_list-filterBy').val();
            var fval = $('#tab_old_risk_list-filterValue').val();
            
            gridOldRisk.clearAjaxParams();
            gridOldRisk.setAjaxParam("filter_by", fby);
            gridOldRisk.setAjaxParam("filter_value", fval);
            gridOldRisk.getDataTable().ajax.reload();
        },

        filterDataGridRegister: function() {
        	var fby = $('#tab_risk_register_list-filterBy').val();
        	var fval = $('#tab_risk_register_list-filterValue').val();
			 
        	gridRegister.clearAjaxParams();
        	gridRegister.setAjaxParam("filter_by", fby);
        	gridRegister.setAjaxParam("filter_value", fval);
        	gridRegister.getDataTable().ajax.reload();
        },
        filterDataGridTreatment: function() {
        	var fby = $('#tab_treatment_list-filterBy').val();
        	var fval = $('#tab_treatment_list-filterValue').val();
        	
        	gridTreatment.clearAjaxParams();
        	gridTreatment.setAjaxParam("filter_by", fby);
        	gridTreatment.setAjaxParam("filter_value", fval);
        	gridTreatment.getDataTable().ajax.reload();
        },
		 filterDataGridActionplan: function() {
        	var fby = $('#tab_action_plan_list-filterBy').val();
        	var fval = $('#tab_action_plan_list-filterValue').val();
        	
        	gridActionPlan.clearAjaxParams();
        	gridActionPlan.setAjaxParam("filter_by", fby);
        	gridActionPlan.setAjaxParam("filter_value", fval);
        	gridActionPlan.getDataTable().ajax.reload();
        },
        viewExecutionForm: function(data) {
            var me = this;
            var act_id = data.id;
            
            $('#exec-form')[0].reset();
            
            $('#form-action-id').val(act_id);
            
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
            } else {
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
            
        },
		 filterDataGridActionplanexec: function() {
        	var fby = $('#tab_action_plan_exec-filterBy').val();
        	var fval = $('#tab_action_plan_exec-filterValue').val();
        	
        	gridActionExec.clearAjaxParams();
        	gridActionExec.setAjaxParam("filter_by", fby);
        	gridActionExec.setAjaxParam("filter_value", fval);
        	gridActionExec.getDataTable().ajax.reload();
        },
        
       
	};	
}();


var Actionplan_adt = function() {
    return {
        init: function() {
        	var me = this;
        	
        	// TAB CONTROL FOR BREADCRUMB
        	$('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
        		var hrefa = $(this).attr('href');
        		var ulid = hrefa.replace('#', '');
        		var title = $(this).html().trim();
        		$('#bread_tab_title').html(title);
        	});
        	 
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    //alert(r);exit;
                    var data = gridRiskList.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });
 
        	$('#tab_action_plan_exec-filterButton').on('click', function() {
        		me.filterDataGridActionplanexec();
        	});

        },
       
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/admin/qna/qnaDeleteData';
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
        
		 filterDataGridActionplan: function() {
        	var fby = $('#tab_action_plan_list-filterBy').val();
        	var fval = $('#tab_action_plan_list-filterValue').val();
        	
        	gridActionPlan.clearAjaxParams();
        	gridActionPlan.setAjaxParam("filter_by", fby);
        	gridActionPlan.setAjaxParam("filter_value", fval);
        	gridActionPlan.getDataTable().ajax.reload();
        },
		 filterDataGridActionplanexec: function() {
        	var fby = $('#tab_action_plan_exec-filterBy').val();
        	var fval = $('#tab_action_plan_exec-filterValue').val();
        	
        	gridActionExec.clearAjaxParams();
        	gridActionExec.setAjaxParam("filter_by", fby);
        	gridActionExec.setAjaxParam("filter_value", fval);
        	gridActionExec.getDataTable().ajax.reload();
        },
       
	};	
}();

var Actionplan_exe = function() {
    return {
        init: function() {
            var me = this;
            
            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
             
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    //alert(r);exit;
                    var data = gridRiskList.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });
 
            $('#tab_action_plan_exec-filterButton').on('click', function() {
                me.filterDataGridActionplanexec();
            });

        },
       
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/admin/qna/qnaDeleteData';
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
        
         filterDataGridActionplan: function() {
            var fby = $('#tab_action_plan_list-filterBy').val();
            var fval = $('#tab_action_plan_list-filterValue').val();
            
            gridActionPlan.clearAjaxParams();
            gridActionPlan.setAjaxParam("filter_by", fby);
            gridActionPlan.setAjaxParam("filter_value", fval);
            gridActionPlan.getDataTable().ajax.reload();
        },
         filterDataGridActionplanexec: function() {
            var fby = $('#tab_action_plan_exec-filterBy').val();
            var fval = $('#tab_action_plan_exec-filterValue').val();
            
            gridActionExec.clearAjaxParams();
            gridActionExec.setAjaxParam("filter_by", fby);
            gridActionExec.setAjaxParam("filter_value", fval);
            gridActionExec.getDataTable().ajax.reload();
        },
       
    };  
}();

$('.nav-tabs a').click(function (e) {
     e.preventDefault();
	 $('#tabactive').val($($(this).attr('href')).index());
  
});

$('#risk_list_export').on('click', function() {
	
		var tabactive = $('#tabactive').val();
		 
		if(tabactive == "0"){	
			$('#modal-export').modal('show');
		}
		
		if(tabactive == "1"){	
			$('#modal-export-register').modal('show');
		}
		
		if(tabactive == "2"){	
			$('#modal-export-treatment').modal('show');
		}
		
		if(tabactive == "3"){	
			$('#modal-actionplanlist').modal('show');
		}
		
		if(tabactive == "6"){	
			$('#modal-executionlist').modal('show');
		}
		
		if(tabactive == "4"){	
			$('#modal-kri').modal('show');
		}
		
		if(tabactive == "5"){	
			$('#modal-changereq').modal('show');
		}
});	
 

$('#risk_list_excel').on('click', function() {
	  
			if($('#get_check_risklist').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_risk_list-filterValue").val();
				if(search !=""){
					var searchnya = "search="+search+"&";
				}else{
					var searchnya = "";
				} 
				window.open(site_url+'/main/mainrac/getAllRisk_excel'+'?'+searchnya+$('#get_check_risklist').serialize());
			}					 
	 
});

$('#risk_list_pdf').on('click', function() {
		 
			if($('#get_check_risklist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisk_pdf'+'?'+searchnya+$('#get_check_risklist').serialize());
			}					 
	 
});
 
$('#risk_register_list_excel').on('click', function() {
	  
			if($('#get_check_riskregisterlist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_register_list-filterValue").val();
					var orderby = $("#tab_risk_register_list-filterBy").val();
					if(search !=""){
						var searchnya = "search="+search+"&orderby="+orderby+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRiskregister_excel'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
			}					 
	 
});

$('#risk_register_list_pdf').on('click', function() {
		 
			if($('#get_check_riskregisterlist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_register_list-filterValue").val();
					var orderby = $("#tab_risk_register_list-filterBy").val();
					if(search !=""){
						var searchnya = "search="+search+"&orderby="+orderby+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRiskregister_pdf'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
			}					 
	 
});

$('#treatment_list_excel').on('click', function() {
	  
			if($('#get_check_risktreatment').serialize() == ""){
				alert("Please field at least one ")
			}else{
				 var search = $("#tab_treatment_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisktreatment_excel'+'?'+searchnya+$('#get_check_risktreatment').serialize());
			}					 
	 
});

$('#treatment_list_pdf').on('click', function() {
		 
			if($('#get_check_risktreatment').serialize() == ""){
				alert("Please field at least one ")
			}else{
				 var search = $("#tab_treatment_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisktreatment_pdf'+'?'+searchnya+$('#get_check_risktreatment').serialize());
			}					 
	 
});


$('#actionplan_list_excel').on('click', function() {
	  
			if($('#get_check_actionplan').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_action_plan_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getActionplan_excel'+'?'+searchnya+$('#get_check_actionplan').serialize());
			}					 
	 
});
 
$('#actionplan_list_pdf').on('click', function() {
		 
			if($('#get_check_actionplan').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_action_plan_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getActionplan_pdf'+'?'+searchnya+$('#get_check_actionplan').serialize());
			}					 
	 
});
 
$('#execution_list_excel').on('click', function() {
	  
			if($('#get_check_execution').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getExecution_excel'+'?'+$('#get_check_execution').serialize());
			}					 
	 
});


$('#execution_list_pdf').on('click', function() {
		 
			if($('#get_check_execution').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getExecution_pdf'+'?'+$('#get_check_execution').serialize());
			}					 
	 
});


$('#kri_list_excel').on('click', function() {
	  
			if($('#get_check_kri').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getKRI_excel'+'?'+$('#get_check_kri').serialize());
			}					 
	 
});


$('#kri_list_pdf').on('click', function() {
		 
			if($('#get_check_kri').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getKRI_pdf'+'?'+$('#get_check_kri').serialize());
			}					 
	 
});


$('#changereq_list_excel').on('click', function() {
	  
			if($('#get_check_changereq').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getChangereq_excel'+'?'+$('#get_check_changereq').serialize());
			}					 
	 
});


$('#changereq_list_pdf').on('click', function() {
		 
			if($('#get_check_changereq').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getChangereq_pdf'+'?'+$('#get_check_changereq').serialize());
			}					 
	 
});


function submit_note(){				
	$.ajax({ 
		type: 'POST',
		url: site_url+"/main/mainrac/submit_note",
		data: $("#noteform").serialize(),
		success: function(data){
			$('#modal-pic').modal('hide');
			gridRegister.getDataTable().ajax.reload();
		}				
	})
}