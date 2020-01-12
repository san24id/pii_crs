var RiskVerify = function() {
	return {
		dataMode: null,
        //main function to initiate the module
        dataActionPlan: {},
        dataRiskImpact: {},
        dataActionPlanCounter: 0,
        riskLevelList: null,
        riskLevelReference: null,
        impactLevelReference: null,
        init: function(mode) {
        	var me = this;
        	me.dataMode = mode;
        	
        	if (jQuery().datepicker) {
	            $('.date-picker').datepicker({
	                rtl: Metronic.isRTL(),
	                orientation: "left",
	                autoclose: true
	            });
	            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	        };
        	
        	$('#sel_risk_category').change(function() {
        		var val = $(this).val();
        		me.loadCategorySelect('sel_risk_sub_category', val);
        	});
        	
        	$('#sel_risk_sub_category').change(function() {
        		var val = $(this).val();
        		me.loadCategorySelect('sel_risk_2nd_sub_category', val);
        	});
        	
        	$('#btn_impact_list').on('click', function() {
        		me.showImpactList();
        	});
        	
        	$('#input-form-likelihood-button').on('click', function() {
        		var sel = $('#form-likelihood input[name=risk_likelihood]:checked').val();
        		var res = sel.split('|');
        		
        		$('#input-form input[name=risk_likelihood_id]').val(res[0]);
        		$('#input-form input[name=risk_likelihood_value]').val(res[1]);
        		
        		$('#modal-likelihood').modal('hide');
        		me.setRiskLevel();
        	});
        	
        	$('#input-actionplan-add').on('click', function() {
        		//var xval = $('#input-form-action-plan').serialize();
        		//console.log(xval);
        		
        		var xplan = $('#input-form-action-plan input[name=action_plan]').val();
        		var xdate = $('#input-form-action-plan input[name=due_date]').val();
        		var xdiv_view = $('#input-form-action-plan select[name=division] option:selected').text();
        		var xdiv_id = $('#input-form-action-plan select[name=division] option:selected').val();
        		var nnode = {
        			'action_plan' : xplan,
        			'due_date' : xdate,
        			'division_v' : xdiv_view,
        			'division' : xdiv_id
        		};
        		
        		me.actionPlanAddRow(nnode);
        		
        		$('#form-data').modal('hide');
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
        			$('#input-form input[name=risk_impact_level_id]').val(max_val);
        			$('#input-form input[name=risk_impact_level_value]').val(xv);
        			
        			$('#modal-impact').modal('hide');
        			me.setRiskLevel();
        		}
        	});
        	
        	$('#risk-button-verify').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this risk ?');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData('verify');
        		});
        		
        	});
        	
        	$('#risk-button-save').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this risk ?');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData('save');
        		});
        	});
        	
        	$('#risk-button-delete').on('click', function() {
        		var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this Risk ?');
        		mod.find('button.btn-danger').one('click', function(){
        			mod.modal('hide');
        			
        			Metronic.blockUI({ boxed: true });
        			var url = site_url+'/main/mainrac/deleteRisk';
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
        			location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
        		});
        	});
        	
        	me.loadInitialData();
        	me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
        },
        loadInitialData: function() {
        	var me = this;
        	Metronic.blockUI({ boxed: true });
        	var cnt1 = cnt2 = cnt3 = 0; 
        	$.getJSON( site_url+"/main/mainrac/riskGetData/"+g_risk_id, function( data_risk ) {
        		g_username = data_risk['risk_owner'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#input-form'), data_risk);
        		$('#risk_submitted_by').val(data_risk.risk_owner_v);
        		$('#risk_submitted_division').val(data_risk.division_v);
        		
        		console.log(data_risk);
        		
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
        		
        		$.each( data_risk['action_plan_list'], function( key, val ) {
        			var nnode = {
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division
        			}
        			me.actionPlanAddRow(nnode);
        		});
        	});
        },
        populateRisk: function(frm, data) {   
            $.each(data, function(key, value){  
            	var $ctrl = $('[name='+key+']', frm);  
	            switch($ctrl.attr("type"))  
	            {  
	                case "text" :   
	                case "hidden":  
	                case "textarea":
	                	$ctrl.val(value);   
	                	break;   
	                case "radio" : case "checkbox":   
	                $ctrl.each(function(){
	                   if($(this).attr('value') == value) {  $(this).prop("checked",true); } });   
	                break;  
	                default:
	                $ctrl.val(value); 
	            }  
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
        getRiskLevel: function(impact, likelihood) {
        	var me = this;
        	if (me.riskLevelList != null) {
        		var xk = impact+'-'+likelihood;
        		return me.riskLevelList[xk];
        	} else {
        		return false;
        	}
        },
        setRiskLevel: function() {
        	var iv = $('#input-form input[name=risk_impact_level_id]').val();
        	var lv = $('#input-form input[name=risk_likelihood_id]').val();
        	console.log(iv, lv);
        	var xv = iv+"-"+lv;
        	if (this.riskLevelList[xv] != undefined) {
        		var vv = this.riskLevelReference[this.riskLevelList[xv]];
        		$('#input-form input[name=risk_level_id]').val(this.riskLevelList[xv]);
        		$('#input-form input[name=risk_level]').val(vv);
        	}
        },
        setRiskImpact: function(data) {
        	this.dataRiskImpact = data;
        },
        actionPlanTableDelete: function(xrow, dataId) {
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('action_plan_table').deleteRow(i);
        	this.actionPlanDelete(dataId);
        },
        actionPlanReset: function() {
        	this.dataActionPlan = {};
        },
        actionPlanAddRow: function(nnode) {
        	var me = this;
        	
        	me.dataActionPlanCounter++;
        	
        	$('#action_plan_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        		'<td>'+
        		'<div class="btn-group">'+
        			'<button type="button" class="btn btn-default btn-xs" onclick="RiskVerify.actionPlanTableDelete(this, '+me.dataActionPlanCounter+')"><i class="fa fa-trash-o font-red"></i></button>'+
        		'</div>'+
        		'</td>'+
        	'</tr>');
        	
        	me.actionPlanAdd(nnode, me.dataActionPlanCounter);
        },
        actionPlanAdd: function(data, dcounter) {
        	this.dataActionPlan[dcounter] = data;
        },
        actionPlanDelete: function(id) {
        	delete this.dataActionPlan[id];
        },
        showImpactList: function() {
        	$('#modal-impact').on('shown.bs.modal', function () {
        		$('#modal-impact.modal .modal-body').css('max-height', 400);
        		$('#modal-impact.modal .modal-body').css('overflow', 'none');
        		$('#modal-impact.modal .modal-body').css('overflow-y', 'auto');
        	});
        	
        	$('#modal-impact').modal('show');
        },
        submitRiskData: function(submitMode) {
        	var me = this;
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
        	
        	//return true;
        	Metronic.blockUI({ boxed: true });
        	if (submitMode == 'verify') {
        		var url = site_url+'/main/mainrac/verifyRiskData';
        	} else {
        		var url = site_url+'/main/mainrac/saveRiskData';
        	}
        	
        	$.post(
        		url,
        		$( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param),
        		function( data ) {
        			Metronic.unblockUI();
        			if(data.success) {
        				var mod = MainApp.viewGlobalModal('success', 'Success Updating Risk');
        				mod.find('button.btn-ok-success').one('click', function(){
        					if (submitMode == 'verify') {
        						location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
        					} else {
        						location.href=site_url+'/main/mainrac/riskRegisterForm/'+g_risk_id;
        					}
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
        }
	 }
}();