
var apid = $('#ap_id').val();
var apst = $('#ap_sts').val();

var gridActionExec = new Datatable();
gridActionExec.init({
    src: $("#datatable_action_plan_exec"),
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
            "url": site_url+"/main/mainrac/getActionPlanExec_prior" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (full.existing_control_id == 'review') {
                    img = 'executed_2.png';
                } else if (full.existing_control_id == 2) {
                    img = 'actplan.png';
                } else if (data == 4 || data == 5) {
                    img = 'draft.png';
                } else if (data == 6) {
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
        },{
            "targets": 1,
            "data": "act_code",
             "render": function ( data, type, full, meta ) {
                if (full.action_plan_status == 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanForm/'+full.id_p+'/'+full.action_plan_status+'">AP.'+data+'</a>';
                }else if(full.action_plan_status == 7){
                     return '<a target="_self" href="'+site_url+'/main/mainrac/FormactionPlanExecPrior/'+full.id_p+'/'+full.action_plan_status+'?kat=pri">AP.'+data+'</a>';
                }else{       
                    //return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewActionPlanPrior/'+full.id_p+'/'+full.action_plan_status+'?kat=pri">AP.'+data+'</a>';
                }
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/risk_list_prior_ap?status=ap&&id='+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }
            }
        }, {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                if(data == null){
                    

                var ext = '';
                var search = false;
                var submit = false;
                
                //var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Search </i></button>';
                //var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                var search_text = '';
                var submit_text = '';
                //return 'PROCESS';


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


                }else{
                    if(full.existing_control_id == 'review'){
                                return data;    
                     }else if(full.action_plan_status == 6 || full.action_plan_status == 7){
                            //return '<a  href="'+site_url+'/main/mainrac/actionPlanExecFormPrior/'+full.id_p+'/'+full.action_plan_status+'" target="_self">'+data+'</a>';
                            return '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-sm button-grid-verify"><i class="fa font-blue">'+data+'</i></button>'+
                            '</div>';
                            }else{
                                return '';
                            }
                }
                
            }
        },{
            "targets": 11,
            "data": "existing_control_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var imge = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil-square-o font-blue"> Edit </i></button>'+

                        '</div>';
                if(data != 2){
                    img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-ignore"><i class="fa fa-trash-o font-red"> Ignore </i></button>'+

                        '</div>';
                }else if(data == 2){
                     img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-accept"><i class="fa fa-check-circle font-blue"> Accept </i></button>'+
                        '</div>';
                }
                return '<center>'+imge+'</center>'+'<br/><center>'+img+'</center>';
            }
        }],
        "columns": [
            { "data": "action_plan_status","orderable":true },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "division_name" },
            { "data": "execution_status" },
            { "data": "risk_code" },
            { "data": "risk_owner_v" },
            { "data": "risk_level_after_mitigation_v" },
            { "data": "impact_level_after_mitigation_v" },
            { "data": "likelihood_after_mitigation_v" },
            { "data": "existing_control_id" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskaction = new Datatable();
gridRiskaction.init({
    src: $("#risklist_action"),
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
            "url": site_url+"/main/mainrac/getRiskAciton/"+apid+'/'+apst // ajax source
        },
        "columnDefs": [{
            "targets": 0,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                if (full.risk_status >= 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                } 
                
            }
        } ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            {"data":  "risk_event"},
            {"data":  "risk_description"},
            {"data":  "ap_code"},
            {"data":  "impact_level_v"},
            {"data":  "likelihood_v"},
            {"data":  "risk_level_v"},
            {"data":  "impact_level_v_after_mitigation"},
            {"data":  "likelihood_v_after_mitigation"},
            {"data":  "risk_level_v_after_mitigation"}  
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var ActionVerify = function() {
    return {
        init: function() {
            var me = this;
            impactLevelReference: null;
            
            
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };
            $(document).on("click", ".open-impact", function () {
                ap_impact_id = $(this).data('id');
            $('#input-form-impact-button_'+ap_impact_id).on('click', function() {
                var imp_1 =  $('#imp_1').val();
                var imp_2 =  $('#imp_2').val();
                var imp_3 =  $('#imp_3').val();
                var imp_4 =  $('#imp_4').val();
                var imp_5 =  $('#imp_5').val();

                var imp = {
                   'NA': 0, [imp_1]: 1, [imp_2]: 2, 
                   [imp_3]: 3, [imp_4]: 4, [imp_5]: 5
                };
                
                var all_na = true;
                var max_idx = 0;
                var max_val = 'NA';
                
                me.dataRiskImpact = {};
                
                var sel = $('#form-impact input[id=impactlevel_'+ap_impact_id+']:checked');
                $.each(sel, function(idx, cmp) {
                    var val = $(cmp).val();
                    var name = $(cmp).attr('name');
                    if (val != 'NA') {
                        all_na = false;
                    }
                    if (imp[val] > max_idx) {
                        max_idx = imp[val];
                        max_val = val;
                    }
                    me.dataRiskImpact[name] = val;
                });
                
                
                
                if (all_na) {
                    MainApp.viewGlobalModal('error', 'Cannot set all Not Available (N/A) on Risk Impact');
                } else {
                    
                    var xv = me.impactLevelReference[max_val];
                     
                    $('#risk_impact_level_id_'+ap_impact_id).val(max_val);
                    $('#risk_impact_level_after_mitigation_'+ap_impact_id).val(xv);
                    
                    $('#modal-impact_'+ap_impact_id).modal('hide');
                    me.setRiskLevel();
                }
            });
            });

            $('#exec-button-cancel').on('click', function () {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Action Plan Verification ? You will loose your unsaved data.');
                mod.find('button.btn-primary').one('click', function(){
                    location.href=site_url+'/main/mainrac#tab_action_plan_exec';
                });
            });

            $(document).on("click", ".open-likelihood", function () {
                ap_risk_id = $(this).data('id');

            $('#input-form-likelihood-button_'+ap_risk_id).on('click', function() {
                var sel = $('#form-likelihood input[name=risk_likelihood_'+ap_risk_id+']:checked').val();
                var res = sel.split('|');
                
                $('#risk_likelihood_id_'+ap_risk_id).val(res[0]);
                $('#risk_likelihood_key_after_mitigation_'+ap_risk_id).val(res[1]);
                
                $('#modal-likelihood-'+ap_risk_id).modal('hide');
                me.setRiskLevel2();
            });
            });
            
            $('#exec-button-submit').on('click', function () {               
                    $('#modal-category-validation').modal('show');
            });

            $('#exec-button-submit-under').on('click', function () {
                if($('#exec-select-status').val() == "COMPLETE"){                   
                    $('#modal-category').modal('show'); 
                }else{
                    me.submitRiskData2('verify')
                }
                
            });
            
            $('#btn_impact_list').on('click', function() {
                me.showImpactList();
            });
             
            $('#modal-impactlevel-form-submit-no').on('click', function() {
                me.submitRiskDataNo('verify')          
            });
             
            $('#modal-impactlevel-form-submit').on('click', function() {
                me.submitRiskData('verify')          
            });

            $('#modal-impactlevel-form-submit-validation').on('click', function() {
                $('#modal-category').modal('show');        
            });
            
            $('#exec-select-status').change(function() {
                if ($( this ).val() == 'EXTEND') {
                    $('#fgroup-explain').hide();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').show();
                    $('#fgroup-date').show();
                }
                 else if ($( this ).val() == 'ONGOING') {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                }
                else {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                }
            });
            
            me.loadRiskLevelList();
            me.loadRiskLevelReference();
            me.loadImpactLevelReference();
            
        },
        submitRiskData: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionExecVerify_yes';
                
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
                        $( "#input-form" ).serialize() + '&' + $("#modal-risk-form").serialize(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                if(g_review_status != 1){
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+g_action_plan_status;
                                }else{
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+7;
                                }
                                });
                                
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main/mainrac#tab_action_plan_exec';
                                });
                     });
                });
            }
        },
        submitRiskDataNo: function(submitMode) {
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
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize() + '&' + $("#modal-risk-form-validation_no").serialize(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main/mainrac/actionplanexe_now';
                                });
                                
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main/mainrac/actionplanexe_now';
                                });
                     });
                });
            }
        },
        submitRiskData2: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionExecVerifyunder';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this Action Plan ?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    var g_risk_id = $('#action-plan-id').val();
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize() + "&risk_impact_level_after_mitigation="+$('#risk_impact_level_after_mitigation').val()+"&risk_likelihood_key_after_mitigation="+$('#risk_likelihood_key_after_mitigation').val()+"&risk_level_after_mitigation="+$('#risk_level_after_mitigation').val(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/risk/RiskRegister/undermaintenance';
                                });
                                
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
         showImpactList: function() {
            $('#modal-impact').on('shown.bs.modal', function () {
                $('#modal-impact.modal .modal-body').css('max-height', 400);
                $('#modal-impact.modal .modal-body').css('overflow', 'none');
                $('#modal-impact.modal .modal-body').css('overflow-y', 'auto');
            });
            
            $('#modal-impact').modal('show');
        },
         setRiskLevel: function() {
             
            var iv = $('#risk_impact_level_id_'+ap_impact_id).val();
            var lv = $('#risk_likelihood_id_'+ap_impact_id).val();
            console.log(iv, lv);
            var xv = iv+"-"+lv;
             
            if (this.riskLevelList[xv] != undefined) {
                var vv = this.riskLevelReference[this.riskLevelList[xv]];
                $('#risk_level_id_'+ap_impact_id).val(this.riskLevelList[xv]);               
                $('#risk_level_after_mitigation_'+ap_impact_id).val(vv);
            }
        },

        setRiskLevel2: function() {
             
            var iv = $('#risk_impact_level_id_'+ap_risk_id).val();
            var lv = $('#risk_likelihood_id_'+ap_risk_id).val();
            console.log(iv, lv);
            var xv = iv+"-"+lv;
             
            if (this.riskLevelList[xv] != undefined) {
                var vv = this.riskLevelReference[this.riskLevelList[xv]];
                $('#risk_level_id_'+ap_risk_id).val(this.riskLevelList[xv]);               
                $('#risk_level_after_mitigation_'+ap_risk_id).val(vv);
            }
        },
        
        loadRiskLevelList: function() {
            var me = this;
            $.getJSON( site_url+"/risk/RiskRegister/getRiskLevelList", function( data ) {
                me.riskLevelList = data;
            });
        },
        loadRiskLevelReference: function() {
            var me = this;
            $.getJSON( site_url+"/risk/RiskRegister/getRiskLevelReference", function( data ) {
                me.riskLevelReference = data;
            });
        },
        loadImpactLevelReference: function() {
            var me = this;
            $.getJSON( site_url+"/risk/RiskRegister/getImpactLevelReference", function( data ) {
                me.impactLevelReference = data;
            });
        },
     }
}();

