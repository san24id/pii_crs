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
			
			$('#input-form-impact-button').on('click', function() {
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
        		
        		var sel = $('#form-impact input[type=radio]:checked');
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
					 
        			$('#risk_impact_level_id').val(max_val);
        			$('#risk_impact_level_after_mitigation').val(xv);
        			
        			$('#modal-impact').modal('hide');
        			me.setRiskLevel();
        		}
        	});
        	
        	$('#exec-button-cancel').on('click', function () {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Action Plan Verification ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac#tab_action_plan_exec';
        		});
        	});
			
			$('#input-form-likelihood-button').on('click', function() {
        		var sel = $('#form-likelihood input[name=risk_likelihood]:checked').val();
        		var res = sel.split('|');
        		
        		$('#risk_likelihood_id').val(res[0]);
        		$('#risk_likelihood_key_after_mitigation').val(res[1]);
        		
        		$('#modal-likelihood').modal('hide');
        		me.setRiskLevel();
        	});
			
			$('#exec-button-submit').on('click', function () {

					me.submitRiskData('verify')
        		
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

            $('#approve-apexprior-form-submit').on('click', function() {
                me.submitRiskPriorData('verify')          
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
            	
            	var url = site_url+'/main/mainrac/actionplan_exeverify_cr';
            	
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
            						location.href=site_url+'/main/mainrac#tab_change_request_list';
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

        submitRiskPriorData: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionplan_exe_priorverify_cr';
                
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
                                    location.href=site_url+'/main/mainrac#tab_change_request_list';
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

        submitRiskDataNo: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionplan_exeverify_cr';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this Action Plan ?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    var g_risk_id = $('#action-plan-id').val();
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize() + "&risk_impact_level_after_mitigation="+$('#risk_impact_level_after_mitigation_validation').val()+"&risk_likelihood_key_after_mitigation="+$('#risk_likelihood_key_after_mitigation_validation').val()+"&risk_level_after_mitigation="+$('#risk_level_after_mitigation_validation').val(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    location.href=site_url+'/main/mainrac#tab_action_plan_exec';
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
			 
        	var iv = $('#risk_impact_level_id').val();
        	var lv = $('#risk_likelihood_id').val();
        	console.log(iv, lv);
        	var xv = iv+"-"+lv;
			 
        	if (this.riskLevelList[xv] != undefined) {
        		var vv = this.riskLevelReference[this.riskLevelList[xv]];
        		$('#risk_level_id').val(this.riskLevelList[xv]);				 
        		$('#risk_level_after_mitigation').val(vv);
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

