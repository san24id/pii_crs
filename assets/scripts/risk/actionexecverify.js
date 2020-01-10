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
                var sel = $('#form-likelihood_'+ap_risk_id+' input[name=risk_likelihood_'+ap_risk_id+']:checked').val();
                var res = sel.split('|');
                
                $('#risk_likelihood_id_'+ap_risk_id).val(res[0]);
                $('#risk_likelihood_key_after_mitigation_'+ap_risk_id).val(res[1]);
                
                $('#modal-likelihood-'+ap_risk_id).modal('hide');
                me.setRiskLevel2();
        	   });
            });
			
			/*$('#exec-button-submit').on('click', function () {
				if($('#exec-select-status').val() == "COMPLETE"){					
					$('#modal-category-validation').modal('show');	
				}else{
					me.submitRiskData('verify')
				}
        		
        	});*/

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
                    $('#fgroup-review').show();
                }
                 else if ($( this ).val() == 'ONGOING') {
                    $('#fgroup-explain').show();
                    $('#fgroup-review').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                }
                else {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $('#fgroup-review').hide();
                }
            });


            $('#exec-button-clouse').on('click', function () {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Action Plan Verification ? You will loose your unsaved data.');
                mod.find('button.btn-primary').one('click', function(){
                    window.close();
                });
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
                                    location.href=site_url+'/main/mainrac#tab_action_plan_exec';
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

