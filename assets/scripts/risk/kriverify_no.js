var KriForm = function() {
	return {
		dataMode: null,
        //main function to initiate the module
        dataActionPlan: {},
        dataActionPlanCounter: 0,
        dataTreshold: {},
        dataTresholdCounter: 0,
        init: function() {
        	var me = this;
        	
        	$('#kri-button-verify').on('click', function() { 
				$('#modal-category').modal('show');	 
        	});
			

            $('#kri-button-delete_verify').on('click', function() {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Delete KRI with Status Mitigation Not Yet ?');
                        mod.find('button.btn-primary').one('click', function(){
                me.deleteRiskData_no();
                });              
            });

            $('#kri-button-delete_verify_yes').on('click', function() {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Delete KRI with Status Mitigation Already ?');
                        mod.find('button.btn-primary').one('click', function(){
                me.deleteRiskData_no();
                });              
            });


                    $('#modal-impactlevel-form-submit-validation').on('click', function() {
                    $('#modal-category').modal('show');        
                });
        	
        	$('#kri-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your KRI Verification ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main';
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
			
			$('#btn_impact_list').on('click', function() { 
        		me.showImpactList();
        	});
			
		me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
        	
        	$('#owner_report').on('change', function() {        		
        		var img = me.recalculateWarning($(this).val());
        		img = img.toLowerCase();
        		img = base_url+'assets/images/legend/kri_'+img+'.png';

        		$('#warning_img').attr('src', img);
        	});
        },

        deleteRiskData_no: function() {
                var fvalid = true;
                if (fvalid) {
                        var me = this;
                                 
                                 //----------------- isi level dan submit
                                 
                        Metronic.blockUI({ boxed: true });
                        var url = site_url+'/risk/kri/deleteKri';
                        $.post(
                                url,
                                {
                                        'id' : $('#kri-id').val(), 
                                        'owner_report' : $('#owner_report').val(),
                                        'support' : $('#support').val(),
                                        'validation' : $('#validation').val(),
                                        'description' : $('#threshold_description').val(),

                                                'risk_impact_level_after_kri' : $('#risk_impact_level_after_mitigation_no').val(),
                                                'risk_likelihood_key_after_kri' : $('#risk_likelihood_key_after_mitigation_no').val(),
                                                'risk_level_after_kri' : $('#risk_level_after_mitigation_no').val()
                                                
                                },
                                function( data ) {
                                                 
                                        Metronic.unblockUI();
                                        if(data.success) {
                                                var mod = MainApp.viewGlobalModal('warning', 'Success Deleting KRI');
                                                mod.find('button.btn-ok-success').one('click', function(){
                                                        location.href=site_url+'/main/mainrac#tab_kri_list';
                                                });
                                                         
                                        } else {
                                                MainApp.viewGlobalModal('error', data.msg);
                                        }

                                },
                                "json"
                        ).fail(function() {
                                Metronic.unblockUI();
                                //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating KRI');
                                                mod.find('button.btn-ok-success').one('click', function(){
                                                        location.href=site_url+'/main/mainrac#tab_kri_list';
                                            });
                         });
                                 
                                 //--------------------end
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
        recalculateWarning: function(nval) {
        	if (t_treshold_type != ''  ) {
        		var def = 'default';
        		if (t_treshold_type == 'SELECTION') {
        			$.each(t_treshold_list, function(k, v) {
        				if (v['value_1'] == nval) {
        					def = v['result'];
        				}
        			});
        		}else if (t_treshold_type == 'VALUE') {
                                $.each(t_treshold_list, function(k, v) {
                                        if (v['value_1'] == nval) {
                                                def = v['result'];
                                        }
                                });
                        } else {
        			var tt = 'NUMERIC';
        			if (nval <= 100) tt = 'PERCENTAGE';
        			
        			$.each(t_treshold_list, function(k, v) {
        				if (v['value_type'] == tt && v['operator'] == 'BELOW'
        					&& nval < v['value_1'] ) {
        					def = v['result'];
        				}
        				
        				if (v['value_type'] == tt && v['operator'] == 'BETWEEN' 
        					&& (nval >= v['value_1'] && nval <= v['value_2']) ) {
        					def = v['result'];
        				}
        				
        				if (v['value_type'] == tt && v['operator'] == 'ABOVE'
        					&& nval > v['value_1'] ) {
        					def = v['result'];
        				}
        			});

        		}
        		return def;
        	} else {
        		return 'default';
        	}
        }
	 }
}();