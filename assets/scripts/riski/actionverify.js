 $('#kcc').hide();
 $("#checked").hide();

  $('#kcc2').hide();
 $("#checked2").show();
 $('#fdate2').hide();

 
function Check(){
     $('#due_date').val('00-00-0000');
     $('#fdate').hide();
     $('#ckc').hide();
     $('#kcc').show();
    $("#checked").show();
}

function Chckd(){
    $('#due_date').val('');
     $('#fdate').show();
     $('#ckc').show();
     $('#kcc').hide();
     $("#checked").hide();
}

function Check2(){
     $('#due_date').val('');
     $('#fdate2').show();
     $('#ckc2').hide();
     $('#kcc2').show();
    $("#checked2").hide();
}

function Chckd2(){
    $('#due_date').val('00-00-0000');
     $('#fdate2').hide();
     $('#ckc2').show();
     $('#kcc2').hide();
     $("#checked2").show();
}
var ActionVerify = function() {
	return {
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
        	
        	$('#changes-risk-set-as-primary').on('click', function () {
        		me.submitRiskData('setAsPrimary')
        	});
        	
        	$('#changes-risk-button-save').on('click', function () {
        		me.submitRiskData('save')
        	});

            $('#changes-risk-button-save-primary').on('click', function () {
                me.submitRiskData('save-primary')
            });

              $('#changes-risk-button-save-primary2').on('click', function () {
                me.submitRiskData('save-primary2')
            });
        	
        	$('#changes-risk-button-cancel').on('click', function () {
        		var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin membatalkan Risk Treatment Anda? Anda akan kehilangan data yang belum disimpan.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac#tab_action_plan_list';
        		});
        	});
        	
        	$('#primary-risk-button-submit').on('click', function () {
        		me.submitRiskData('verify')
        	});

            $('#primary-risk-button-submit-1').on('click', function () {
                me.submitRiskData('verify-1-form')
            });
        	
        },
        submitRiskData: function(submitMode) {
        	var form1 = $('#input-form').validate();
        	var fvalid = form1.form();
        	if (fvalid) {
            	var me = this;
            	var param = $('#input-form').serializeArray();
            	
            	if (submitMode == 'setAsPrimary') {
            		var url = site_url+'/main/mainrac/actionSetAsPrimary';
            		var text = 'Apakah Anda yakin ingin Menyimpan dan Mengatur Sebagai Primary Rencana Aksi ini ?';
            	} else if (submitMode == 'verify') {
            		var url = site_url+'/main/mainrac/actionVerify';
            		var text = 'Apakah Anda yakin ingin Verifikasi Action Plan ini ?';
            	}else if (submitMode == 'verify-1-form') {
                    var url = site_url+'/main/mainrac/actionVerify1form';
                    var text = 'Apakah Anda yakin ingin Verifikasi Action Plan ini ?';
                }else if (submitMode == 'save-primary') {
                    var url = site_url+'/main/mainrac/actionSaveprimary';
                    var text = 'Apakah Anda yakin ingin menyimpan Action Plan ini?';
                }else if (submitMode == 'save-primary2') {
                    var url = site_url+'/main/mainrac/actionSaveprimary2';
                    var text = 'Apakah Anda yakin ingin menyimpan Action Plan ini?';
                } else {
            		var url = site_url+'/main/mainrac/actionSave';
            		var text = 'Apakah Anda yakin ingin menyimpan Action Plan ini?';
            	}
            	
            	var mod = MainApp.viewGlobalModal('confirm', text);
            	mod.find('button.btn-primary').off('click');
            	mod.find('button.btn-primary').one('click', function(){
            		mod.modal('hide');
            		var g_risk_id = $('#action_id').val();
            		Metronic.blockUI({ boxed: true });
            		$.post(
            			url,
            			$( "#input-form" ).serialize(),
            			function( data ) {
            				Metronic.unblockUI();
            				if(data.success) {
            					var mod = MainApp.viewGlobalModal('success', 'Sukses Memperbarui Action Plan Anda');
            					mod.find('button.btn-ok-success').one('click', function(){
            						if (submitMode == 'setAsPrimary') {
            							location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id;
            						} else if (submitMode == 'verify') {
            							location.href=site_url+'/main/mainrac#tab_action_plan_list';
            						}else if (submitMode == 'verify-1-form') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'save-primary2') {
                                        location.href=site_url+'/risk/RiskRegister/undermaintenance';
                                    } else {
            							location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id;
            						}
            					});
            					
            				} else {
            					MainApp.viewGlobalModal('error', data.msg);
            				}
            				
            			},
            			"json"
            		).fail(function() {
            			Metronic.unblockUI();
            			var mod = MainApp.viewGlobalModal('success', 'Sukses Memperbarui Action Plan Anda');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    if (submitMode == 'setAsPrimary') {
                                        location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id;
                                    } else if (submitMode == 'verify') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'verify-1-form') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'save-primary2') {
                                        location.href=site_url+'/risk/RiskRegister/undermaintenance';
                                    } else {
                                        location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id;
                                    }
                                });
            		 });
            	});
            }
        }
	 }
}();