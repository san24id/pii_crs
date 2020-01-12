var id_periode = $('#periode_id').val();


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
        "stateSave" : true,    
        "ajax": {
            "url": site_url+"/main/mainrac/getAllAggRisk/"+id_periode // ajax source
        },
    "columnDefs": [{
            "targets": 0,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
               
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewRiskAgg/'+full.risk_idag+'">'+data+'</a>';
            }
        },{
            "targets": 6,
            "data": "risk_id",
            "render": function ( data, type, full, meta ) {
                var img = '<div class="btn-group">'+
                            '<a href="'+site_url+'/main/mainrac/riskEditAggForm/'+id_periode+'/'+full.risk_idag+'"><button type="button" class="btn btn-default btn-xs button-grid-update"><i class="fa fa-edit font-blue"> Update </i></button></a>'+
                            '<a href="'+site_url+'/main/mainrac/riskTransferAggForm/'+id_periode+'/'+full.risk_idag+'/'+full.risk_id+'"><button type="button" class="btn btn-default btn-xs button-grid-update"><i class="fa fa-exchange font-green"> Transfer </i></button></a>'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

                        '</div>';
           
                return '<center>'+img+'</center>';
            }
        } ],
        "columns": [
            { "data": "risk_code","orderable":true},
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "impact_level_v" },
            { "data": "likelihood_v" },
            { "data": "risk_owner_v" },
            { "data": "risk_id" }
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

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    todayHighlight: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };
            
            //---------------------acntion plan execution
            $('#choose_s_level').hide();
            $('#choose_r_level').hide();
            $('#choose_l_hood').hide();
            $('#choose_impact_l').hide();
            $('#choose_l_divisi').hide();
            $('#tab_risk_list-filterValue').hide();
            $('#risk_search').hide();


            $('#tab_risk_list-filterBy').change(function(){
                var risk_list = $('#tab_risk_list-filterBy').val();

                var risk_list_filter = $("option:selected", this).attr('data-FilterRiskList');
                $('input[id="rl_1"]').attr('value', risk_list_filter);

                if(risk_list == "choose"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                    $('#rl_1').val('');
                    $('#rl_2').val('');
                }
                else if(risk_list == "risk_code"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').show();
                }else if(risk_list == "risk_event"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').show();
                }else if(risk_list == "risk_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_impact_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_likelihood_key"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                }else if(risk_list == "risk_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_impact_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_likelihood_key_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_owner"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').show();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_status"){
                    $('#choose_s_level').show();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                }

            });

            $('#r_level').change(function(){
                var risk_level = $('#r_level').val();
                var risk_level2 = $("option:selected", this).attr('data-RiskLevel');
                $('input[id="tab_risk_list-filterValue"]').attr('value', risk_level);
                $('input[id="rl_2"]').attr('value', risk_level2);
                if(risk_level == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#l_hood').change(function(){
                var likelihood = $("option:selected", this).attr('data-likelihood');
                var likelihood2 = $("option:selected", this).attr('data-likelihood2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', likelihood);
                $('input[id="rl_2"]').attr('value', likelihood2);
                var l_hood = $('#l_hood').val();
                if(l_hood == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#impact_l').change(function(){
                var impact_level = $("option:selected", this).attr('data-impact');
                var impact_level2 = $("option:selected", this).attr('data-impact2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', impact_level);
                $('input[id="rl_2"]').attr('value', impact_level2);
                var impact_l = $('#impact_l').val();
                if(impact_l == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#l_divisi').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', division_list);
                $('input[id="rl_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi').val();
                if(l_divisi == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#s_level').change(function(){
                var risk_status = $('#s_level').val();
                var risk_status2 = $("option:selected", this).attr('data-RiskStatusLevel');
                $('input[id="tab_risk_list-filterValue"]').attr('value', risk_status);
                $('input[id="rl_2"]').attr('value', risk_status2);
                if(risk_status == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All Status');
                }
            });
            
            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });


             $('#datatable_ajax').on('click', 'button.button-grid-delete', function(e) {
                  e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridRiskList.getDataTable().row(r).data();
 
                    me.deleteRiskAgg(data);
              });

        	
                $('#tab_risk_list-filterButton').on('click', function() {

                $('#rl_3').val($('#rl_1').val());
                $('#rl_4').val($('#rl_2').val());

                if($('#tab_risk_list-filterBy').val() == 'risk_code' || $('#tab_risk_list-filterBy').val() == 'risk_event'){
                     $('#tab_risk_list-filterValue').val($('#s_risklist').val());
                     $('#rl_2').val($('#s_risklist').val());
                     $('#rl_4').val($('#s_risklist').val());

                    if($('#s_risklist').val() == ''){
                        $('#tab_risk_list-filterValue').val($('#s_risklist').val());
                        $('#rl_2').val($('#s_risklist').val());
                        $('#rl_4').val($('#s_risklist').val());
                    }
                }

                if($('#tab_risk_list-filterValue').val() == ''){
                    $('#tab_risk_list-filterValue').val('Sh0w4llR15k');
                }
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


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-ignore', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.ignoreAPE(data);
              });

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-accept', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.acceptAPE(data);
             });

            $('#refresh_prior_ap').on('click', function() {
                gridActionExec.getDataTable().ajax.reload();
            });


            $('#modal-changelevel-form-verify-no').on('click', function(e) {

                e.preventDefault();
                    
                var r = this.parentNode.parentNode.parentNode; 
                var data = gridActionExec.getDataTable().row(r).data();
                me.ChangeLevelRiskDataNo(data)          
            });


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-verify', function(e) {
           
           
                    e.preventDefault();
                    
                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;

                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data();

                    gridActionExec.getDataTable().ajax.reload();
                    
                    var openverify;
                    openverify =  window.open('index.php/main/mainrac/actionPlanExecFormShow/'+data.id_p+'/'+data.action_plan_status,'name','location=no,menubar=no,scrollbars=yes,resizable=no,fullscreen=no,height=550,width=1024,left='+x+',top='+y);
                    openverify.focus();     
                    //me.showriskform_verify(data);
                
            });


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data(); 
                    me.showriskform_ap(data);
                
            });

            $('#library-modal-listriskap-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/main/mainrac/update_apex_now';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridActionExec.getDataTable().ajax.reload();
                                    
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

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-ignore', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.ignoreAPE(data);
              });

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-accept', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.acceptAPE(data);
             });

            $('#refresh_prior_ap').on('click', function() {
                gridActionExec.getDataTable().ajax.reload();
            });


            $('#modal-changelevel-form-verify-no').on('click', function(e) {

                e.preventDefault();
                    
                var r = this.parentNode.parentNode.parentNode; 
                var data = gridActionExec.getDataTable().row(r).data();
                me.ChangeLevelRiskDataNo(data)          
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
            var frl1 = $('#rl_1').val();
            var frl2 = $('#rl_2').val();
            
            gridRiskList.clearAjaxParams();
            gridRiskList.setAjaxParam("filter_by", fby);
            gridRiskList.setAjaxParam("filter_value", fval);
            gridRiskList.setAjaxParam("filter_rl_1", frl1);
            gridRiskList.setAjaxParam("filter_rl_2", frl2);
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


                $('#modal-listrisk-form').find('input[name=ap_code]').attr('readonly', true).val("AP."+data.id_p);
                $('#modal-listrisk-form').find('input[name=id]').attr('readonly', true).val(data.id_p);
                $('#modal-listrisk-form').find('textarea[name=action_plan]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=due_date]').attr('readonly', true).val(data.due_date_v);
                
              
                $('#modal-listrisk-form').find('input[name=action_plan_status]').attr('readonly', true).val(data.action_plan_status);
                $('#modal-listrisk-form').find('input[name=periode_id]').attr('readonly', true).val(data.periode_id);
                $('#modal-listrisk-form').find('textarea[name=action_plan_ex]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=division_ex]').attr('readonly', false).val(data.division); 
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },


            ignoreAPE: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Ignore</b> risk : <b>'+data.action_plan+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'ap_code' : data.id_p,
                        'periode_id' : data.periode_id
                    };
                    var url = site_url+'/main/mainrac/ignoreAP_execution';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Ignore Action plan execution');
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
            },

            acceptAPE: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Accept</b> risk : <b>'+data.action_plan+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'ap_code' : data.id_p,
                        'periode_id' : data.periode_id
                    };
                    var url = site_url+'/main/mainrac/acceptAP_execution';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Accept Action plan execution');
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
            },

        ChangeLevelRiskDataNo: function(data) {  
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionExecVerify';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this Action Plan ?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    var g_risk_id = $('#action-plan-id').val();
                    var g_action_plan_status = $('#action_plan_status').val();
                    var g_review_status = $('#review_status').val();
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize() + '&' + $("#modal-risk-form-validation_no").serialize(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                MainApp.viewGlobalModal('success', 'Success verify Action plan execution');
                                if(g_review_status != 1){
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+g_action_plan_status;
                                }else{
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+7;
                                }
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
            }
        },

        deleteRiskAgg: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Delete</b> risk : <b>'+data.risk_event+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'risk_idag' : data.risk_idag
                    };
                    var url = site_url+'/main/mainrac/deleteRiskAgg';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Risk');
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