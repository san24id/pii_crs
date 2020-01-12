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

var g_id_ap = $('#action_id').val();;

var gridReviewaction = new Datatable();
gridReviewaction.init({
    src: $("#review_tableaction"),
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
            //"url": site_url+"/main/Mainrac/getActionreviewtab2/1/"+g_id_ap+"/"+g_action_plan_st+"/"+g_action_plan+"/"+g_action_own // ajax source
            "url": site_url+"/main/Mainrac/getActionreviewtab2/"+g_id_ap // ajax source
        },
        "columnDefs": [ 
        {
            "targets": 1,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        }, {
            "targets": 2,
            "data": "apdue",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        }],
        "columns": [
            { "data": "action_plan", "orderable": true },
            {"data": "due_date_v"},
            {"data": "apdue"},
            {"data": "division_v"} 
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});
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
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Risk Treatment ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac#tab_action_plan_list';
        		});
        	});

            $('#primary-risk-button-submit-v').on('click', function () {
                me.submitRiskData('verify-v')
            });
        	
            $('#primary-risk-button-submit').on('click', function () {
                me.submitRiskData('verify')
            });

        	$('#primary-risk-button-confirm').on('click', function () {
        		me.submitRiskData('verify')
        	});

            $('#primary-risk-button-submit-1').on('click', function () {
                me.submitRiskData('verify-1-form')
            });

            $('#risk-button-save').on('click', function() {
                me.submitRiskData('draft');
            });

            $('#risk-button-cancel').on('click', function () {

                    location.href=site_url+'/main/mainrac#tab_action_plan_list';
                
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
            		var text = 'Are You sure you want to Save and Set As Primary this Action Plan ?';
            	} else if (submitMode == 'verify') {
            		var url = site_url+'/main/mainrac/actionVerify';
            		var text = 'Are You sure you want to Verify this Action Plan ?';
            	}else if (submitMode == 'verify-1-form') {
                    var url = site_url+'/main/mainrac/actionVerify1form';
                    var text = 'Are You sure you want to Verify this Action Plan ?';
                }else if (submitMode == 'save-primary') {
                    var url = site_url+'/main/mainrac/actionSaveprimary';
                    var text = 'Are You sure you want to save this Action Plan ?';
                }else if (submitMode == 'save-primary2') {
                    var url = site_url+'/main/mainrac/actionSaveprimary2';
                    var text = 'Are You sure you want to save this Action Plan ?';
                }else if (submitMode == 'verify-v') {
                    var url = site_url+'/main/mainrac/actionSaveVery';
                    var text = 'Are You sure you want to Verify this Action Plan ?';
                }else if (submitMode == 'draft') {
                    var url = site_url+'/main/mainrac/actionChangeDate';
                    var text = 'Are You sure you want to confirm due_date this Action Plan ?';
                }else {
            		var url = site_url+'/main/mainrac/actionSave';
            		var text = 'Are You sure you want to Save this Action Plan ?';
            	}
            	
            	var mod = MainApp.viewGlobalModal('confirm', text);
            	mod.find('button.btn-primary').off('click');
            	mod.find('button.btn-primary').one('click', function(){
            		mod.modal('hide');
            		var g_risk_id = $('#action_id').val();
                    var g_ap_status = $('#action_status').val();
                    var g_ap_periode = $('#action_periode').val();
            		Metronic.blockUI({ boxed: true });
            		$.post(
            			url,
            			$( "#input-form" ).serialize(),
            			function( data ) {
            				Metronic.unblockUI();
            				if(data.success) {
            					var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
            					mod.find('button.btn-ok-success').one('click', function(){
            						if (submitMode == 'setAsPrimary') {
            							location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id+'/'+g_ap_status;
            						} else if (submitMode == 'verify') {
            							location.href=site_url+'/main/mainrac#tab_action_plan_list';
            						}else if (submitMode == 'verify-1-form') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'save-primary2') {
                                        location.href=site_url+'/main/mainrac/actionPlanForm_under/'+g_risk_id+'/'+g_ap_periode+'?status=under';
                                    }else if (submitMode == 'verify-v') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'draft') {
                                        location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id+'/'+g_ap_status;
                                    } else {
            							location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id+'/'+g_ap_status;
            						}
            					});
            					
            				} else {
            					MainApp.viewGlobalModal('error', data.msg);
            				}
            				
            			},
            			"json"
            		).fail(function() {
            			Metronic.unblockUI();
            			var mod = MainApp.viewGlobalModal('success', 'Success Updating your Action Plan');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    if (submitMode == 'setAsPrimary') {
                                        location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id+'/'+g_ap_status;
                                    } else if (submitMode == 'verify') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'verify-1-form') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    }else if (submitMode == 'save-primary2') {
                                          location.href=site_url+'/main/mainrac/actionPlanForm_under/'+g_risk_id+'/'+g_ap_periode+'?status=under';
                                    }else if (submitMode == 'verify-v') {
                                        location.href=site_url+'/main/mainrac#tab_action_plan_list';
                                    } else {
                                        location.href=site_url+'/main/mainrac/actionPlanForm/'+g_risk_id+'/'+g_ap_status;
                                    }
                                });
            		 });
            	});
            }
        }
	 }
}();