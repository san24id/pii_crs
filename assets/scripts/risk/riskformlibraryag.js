var RiskVerify = function() {
    return {
        init: function() {
            var me = this;
            
            me.loadRisk(g_risk_id);
            
            $('#div-portlet-page-caption').html('Verify Risk Form');
            
            $('#risk-button-verify').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this risk ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.submitRiskData('verify');
                });
                
            });
            
            $('#risk-button-draft').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this risk ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.submitRiskData('save');
                });
            });

            $('#risk-button-draft-under').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this risk ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.submitRiskData('save-under');
                });
            });
            
            $('#risk-button-delete').on('click', function() {
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this Risk ?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/deleteRiskrac';
                    $.post(
                        url,
                        { 'risk_id':  g_risk_id},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod2 = MainApp.viewGlobalModal('success', 'Success Delete Data');
                                mod2.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
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
            });
            
            $('#risk-button-cancel').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Risk Verification ? You will loose your unsaved data.');
                mod.find('button.btn-primary').one('click', function(){
                    //location.href=site_url+'/main/mainrac/riskRegister/'+g_username;

                    location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
                });
            });

            $('#risk-impact_edit').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this Impact ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.saveImpactEdit('save_impact');
                });
            });

            $('#risk-likelihood_edit').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this Impact ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.saveImpactEdit('save_likelihood');
                });
            });

            $('#risk-impact_cancel').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel ?');
                mod.find('button.btn-primary').one('click', function(){
                    //location.href=site_url+'/main/mainrac/riskRegister/'+g_username;

                    location.href=site_url+'/admin/manage/impact_risk/'+id_im;
                });
            });

            $('#risk-likelihood_cancel').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel ?');
                mod.find('button.btn-primary').one('click', function(){
                    //location.href=site_url+'/main/mainrac/riskRegister/'+g_username;

                    location.href=site_url+'/admin/manage/likelihood_risk/'+id_l;
                });
            });
        },
        loadRisk: function(rid) {
            var me = RiskInput;
            
            $('#modal-library').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadRiskLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                g_username = data_risk['risk_input_by'];
                data_risk['risk_library_id'] = data_risk['risk_library_id'];
                data_risk['risk_level_id'] = data_risk['risk_level'];
                data_risk['risk_level'] = data_risk['risk_level_v'];
                
                data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
                data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
                data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
                data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
                
                me.populateRisk($('#input-form'), data_risk);
                $('#risk_submitted_by').val(data_risk.risk_input_by_v);
                $('#risk_input_by').val(data_risk.risk_input_by);
                $('#risk_submitted_division').val(data_risk.risk_input_division_v);
                
                //console.log(data_risk);
                
                $.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
                    $.each( data, function( key, val ) {
                        $('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                    });
                    $('#sel_risk_category').val(data_risk['risk_category']);
                    
                    $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data_risk['risk_category'], function( data1 ) {
                        $.each( data1, function( key2, val2 ) {
                            $('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
                        });
                        $('#sel_risk_sub_category').val(data_risk['risk_sub_category']);                        
                        
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data_risk['risk_sub_category'], function( data2 ) {
                            $.each( data2, function( key3, val3 ) {
                                $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
                                $('#sel_risk_2nd_sub_category').val(data_risk['risk_2nd_sub_category']);
                                Metronic.unblockUI();
                            });
                        });
                    });
                });
                
                $('#form-likelihood').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
                $('#form-likelihood input:radio[name=risk_likelihood]').each(function(){
                    if($(this).attr('value') == data_risk['risk_likelihood_key']+'|'+data_risk['risk_likelihood_value']) {  
                        $(this).prop('checked', true).click();
                    }
                });
                
                me.dataRiskImpact = {};
                //$('#form-impact').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
                $.each( data_risk['impact_list'], function( key, val ) {
                    var gid = val.impact_id;
                    $('#form-impact input:radio[name=impactlevel_'+gid+']').each(function(){
                        if($(this).attr('value') == val.impact_level) {  
                            $(this).prop('checked', true).click();
                            me.dataRiskImpact[$(this).attr('name')] = val.impact_level;
                        }
                    });
                });
                
                me.actionPlanReset();
                $.each( data_risk['action_plan_list'], function( key, val ) {
                    var nnode = {
                        'id_ap' : val.id_ap,
                        'action_plan' : val.action_plan,
                        'due_date' : val.due_date_v,
                        'division_v' : val.division_v,
                        'division' : val.division,
                        'execution_status':val.execution_status,
                        'execution_explain':val.execution_explain,
                        'execution_evidence':val.execution_evidence,
                        'execution_reason':val.execution_reason,
                        'revised_date':val.revised_date
                    }
                    me.actionPlanAddRow(nnode);
                });
                
                me.controlReset();
                $.each( data_risk['control_list'], function( key, val ) {
                    var ecid = val.ec_id;
                    if (val.ec_id == null) ecid = '';
                    var nnode = {
                        'ec_id' : ecid,
                        'risk_existing_control' : val.risk_existing_control,
                        'risk_evaluation_control' : val.risk_evaluation_control,
                        'risk_control_owner' : val.risk_control_owner,
                        'control_owner' : val.control_owner
                    };
                    
                    me.controlAddRow(nnode);
                });

               me.controlResetobjective();
                $.each( data_risk['objective_list'], function( key, val ) {
                    var ecid = val.id;
                    if (val.id == null || val.id == '0') ecid = '';
                    var nnode = {
                        'objective_id' : ecid,
                        'objid' : val.objid,
                        'objective' : val.objective
                    };
                    
                    me.controlAddRowobjective(nnode);
                });

            });
        },
        submitRiskData: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = RiskInput;
                var param = $('#input-form').serializeArray();
                
                // prepare impact data
                var impact_param = {};
                var cnt = 0;
                $.each(me.dataRiskImpact, function(key, value) { 
                    var ar = key.split('_', 2);
                    impact_param['impact['+cnt+'][impact_id]'] = ar[1];
                    impact_param['impact['+cnt+'][impact_level]'] = value;
                    cnt++;
                });
                //console.log(impact_param);
                
                // prepare control data
                var control_param = {};
                var cnt = 0;
                $.each(me.dataControl, function(key, value) { 
                    control_param['control['+cnt+'][ec_id]'] = value.ec_id;
                    control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
                    control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
                    control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at least One Control for this Risk');
                    return false;
                }

                // prepare OBJECTIVE data
                var objective_param = {};
                var cnt = 0;
                $.each(me.dataControlobjective, function(key, value) { 
                    objective_param['objective['+cnt+'][objective_id]'] = value.id;
                    objective_param['objective['+cnt+'][objid]'] = value.objid;
                    objective_param['objective['+cnt+'][objective]'] = value.objective;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at least One objective for this Risk');
                    return false;
                }
                
                // prepare action plan data
                var actplan_param = {};
                var cnt = 0;
                $.each(me.dataActionPlan, function(key, value) { 
                    actplan_param['actplan['+cnt+'][id_ap]'] = value.id_ap; 
                    actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
                    actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
                    actplan_param['actplan['+cnt+'][division]'] = value.division;
                    actplan_param['actplan['+cnt+'][execution_status]'] = value.execution_status;
                    actplan_param['actplan['+cnt+'][execution_explain]'] = value.execution_explain;
                    actplan_param['actplan['+cnt+'][execution_evidence]'] = value.execution_evidence;
                    actplan_param['actplan['+cnt+'][execution_reason]'] = value.execution_reason;
                    actplan_param['actplan['+cnt+'][revised_date]'] = value.revised_date; 
                    cnt++;
                });
                //console.log(impact_param);
                
                 var suggested_rt =  $('#suggested_rt').val();
                if(suggested_rt != 'ACCEPT'){
                    if (cnt < 1) {
                         MainApp.viewGlobalModal('error', 'Please Input at least One Action Plan for this Risk');
                         return false;
                    }
                }
                
                Metronic.blockUI({ boxed: true });
                if (submitMode == 'verify') {
                    var url = site_url+'/main/mainrac/verifyRiskDatarac';
                }else if (submitMode == 'save-under') {
                    var url = site_url+'/main/mainrac/saveRiskDataUnder';
                } else {
                    var url = site_url+'/main/mainrac/saveRiskDataAgg';
                }
                
                $.post(
                    url,
                    $( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param)+ '&' + $.param(objective_param),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                if (submitMode == 'verify') {
                                    location.href=site_url+'/main/mainrac/aggregatrisk/'+pid;
                                }else if (submitMode == 'save-under') {
                                    location.href=site_url+'/risk/RiskRegister/undermaintenance/';
                                } else {
                                    location.href=site_url+'/main/mainrac/aggregatrisk/'+pid;
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
                    var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                if (submitMode == 'verify') {
                                    location.href=site_url+'/main/mainrac/aggregatrisk/'+pid;
                                }else if (submitMode == 'save-under') {
                                    location.href=site_url+'/risk/RiskRegister/undermaintenance/';
                                } else {
                                    location.href=site_url+'/main/mainrac/aggregatrisk/'+pid;
                                }
                            });
                 });
            }
        },

        saveImpactEdit: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = RiskInput;
                var param = $('#input-form').serializeArray();
                
                // prepare impact data
                var impact_param = {};
                var cnt = 0;
                $.each(me.dataRiskImpact, function(key, value) { 
                    var ar = key.split('_', 2);
                    impact_param['impact['+cnt+'][impact_id]'] = ar[1];
                    impact_param['impact['+cnt+'][impact_level]'] = value;
                    cnt++;
                });
                //console.log(impact_param);
                
                
                Metronic.blockUI({ boxed: true });

                    var url = site_url+'/admin/manage/saveRiskDataImpact';
                
                $.post(
                    url,
                    $( "#input-form" ).serialize()+ '&' + $.param(impact_param),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                if (submitMode == 'save_impact') {
                                    location.href=site_url+'/admin/manage/impact_risk/'+id_im;
                                } else {
                                    location.href=site_url+'/admin/manage/likelihood_risk/'+id_l;
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
                    var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                               
                                location.href=site_url+'/admin/manage/impact_risk/'+id_im;
                            });
                 });
            }
        }

     }
}();