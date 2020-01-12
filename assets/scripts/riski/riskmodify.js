
var RiskModify = function() {
	return {
		init: function() {
        	var me = this;
        	
        	me.loadRisk(g_risk_id);
        	
        	$('#risk-button-modify').on('click', function() {
        		me.submitRiskData();
        	});
        	
        	$('#div-portlet-page-caption').html('Modify Risk Form');

              $('#risk-button-delete').on('click', function() {
                var mod = MainApp.viewGlobalModal('warning', 'Apakah Anda yakin ingin menghapus Resiko ini?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/risk/riskregister/deleteRiskModify';
                    $.post(
                        url,
                        { 'risk_id':  g_risk_id},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod2 = MainApp.viewGlobalModal('success', 'Berhasil menghapus data');
                                mod2.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main';
                                });
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Kesalahan mengirimkan data');
                     });
                });
            });
        },
        loadRisk: function(rid) {
        	var me = RiskInput;
        	
        	$('#modal-library').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadRiskLibraryModify/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['risk_library_id'] = data_risk['risk_library_id'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#input-form'), data_risk);
        		$('#risk_submitted_by').val(data_risk.risk_owner_v);
        		$('#risk_submitted_division').val(data_risk.division_v);
        		
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
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division
        			}
        			me.actionPlanAddRow(nnode);
        		});
        		
        		me.controlReset();
        		$.each( data_risk['control_list'], function( key, val ) {
        			var ecid = '';
        			if (val.existing_control_id == null) ecid = '';
        			var nnode = {
        				'existing_control_id' : ecid,
        				'risk_existing_control' : val.risk_existing_control,
        				'risk_evaluation_control' : val.risk_evaluation_control,
        				'risk_control_owner' : val.risk_control_owner
        			};
        			
        			me.controlAddRow(nnode);
        		});

                //objective
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
        submitRiskData: function() {
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
            		control_param['control['+cnt+'][existing_control_id]'] = value.existing_control_id;
                    control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
            		control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
            		control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
            		cnt++;
            	});
            	
            	if (cnt < 1) {
            		MainApp.viewGlobalModal('error', 'Tolong masukan setidaknya satu kontrol untuk risiko ini');
            		return false;
            	}
            	
            	// prepare action plan data
            	var actplan_param = {};
            	var cnt = 0;
            	$.each(me.dataActionPlan, function(key, value) { 
            		actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
            		actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
            		actplan_param['actplan['+cnt+'][division]'] = value.division;
            		cnt++;
            	});
            	//console.log(impact_param);
            	
            	var suggested_rt =  $('#suggested_rt').val();
                if(suggested_rt != 'ACCEPT'){
                    if (cnt < 1) {
                         MainApp.viewGlobalModal('error', 'Tolong masukan setidaknya satu Action Plan untuk risiko ini');
                         return false;
                    }
                }

                // prepare Objective data
                var objective_param = {};
                var cnt = 0;
                $.each(me.dataControlobjective, function(key, value) { 
                    objective_param['objective['+cnt+'][objective_id]'] = value.id;
                    objective_param['objective['+cnt+'][objid]'] = value.objid;
                    objective_param['objective['+cnt+'][objective]'] = value.objective;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Tolong masukan setidaknya satu Tujuan untuk risiko ini');
                    return false;
                }



            	
            	Metronic.blockUI({ boxed: true });
            	var url = site_url+'/risk/RiskRegister/modifyRiskData';
            	$.post(
            		url,
            		$( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param)+ '&' + $.param(objective_param),
            		function( data ) {
            			Metronic.unblockUI();
            			if(data.success) {
            				var mod = MainApp.viewGlobalModal('success', 'Berhasil Memperbarui Risiko');
            				mod.find('button.btn-ok-success').one('click', function(){
            					//location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                location.href=site_url+'/main';
            				});
            				
            			} else {
            				MainApp.viewGlobalModal('error', data.msg);
            			}
            			
            		},
            		"json"
            	).fail(function() {
            		Metronic.unblockUI();
            		//MainApp.viewGlobalModal('error', 'Kesalahan mengirimkan data');
                    var mod = MainApp.viewGlobalModal('success', 'Berhasil Memperbarui Risiko');
                            mod.find('button.btn-ok-success').one('click', function(){
                                //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                location.href=site_url+'/main';
                            });
            	 });
            }
        }
	 }
}();