var Send_Register = function() {
	return {
		dataMode: null,
        //main function to initiate the module
        init: function(mode) {
        	var me = this;
        	me.dataMode = mode;

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    todayHighlight: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };
        	
        	
        	$('#button-cancel-send').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Do you want to cancel your Send Mail');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac';
        		});
        	});

            $('#button-cancel-send_apex').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Do you want to cancel your Send Mail');
                mod.find('button.btn-primary').one('click', function(){
                    location.href=site_url+'/admin/reminder/Ap_execution';
                });
            });

            $('#input-form-send-register').on('click', function() {
                me.SendRiskData();
            });

             $('#input-form-save-register').on('click', function() {
                me.SaveRiskData();
            });

            $('#s_mail').change(function(){
                if(this.checked){
                    $('#status_mail').val('1');
                }else{
                    $('#status_mail').val('0');   
                }
            });

            $('#s_mail2').change(function(){
                if(this.checked){
                    $('#status_mail').val('1');
                }else{
                    $('#status_mail').val('0');   
                }
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
                        $( "#input-form" ).serialize(),
                          
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

       
        SendRiskData: function() {

            var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');

        	var form1 = $('#input-form').validate();
        	var fvalid = form1.form();
        	if (fvalid) {
	        	var me = this;
	        	var param = $('#input-form').serializeArray();
	        	
	        	Metronic.blockUI({ boxed: true });
	        	var url = site_url+'/admin/Reminder/save_register_mail';
	        	$.post(
	        		url,
	        		$( "#input-form" ).serialize(),
	        		function( data ) {
	        			Metronic.unblockUI();
	        			if(data.success) {
	        				//var mod = MainApp.viewGlobalModal('success', 'Success send your mail risk register');
	        				mod.find('button.btn-ok-success').one('click', function(){
	        					//location.href=site_url+'/risk/RiskRegister/RiskRegisterInput/'+me.dataMode;
                                location.href=site_url+'/admin/reminder/Regular_risk';
	        				});
	        				
	        			} else {
	        				MainApp.viewGlobalModal('error', data.msg);
	        			}
	        			
	        		},
	        		"json"
	        	).fail(function() {
	        		Metronic.unblockUI();
	        		//MainApp.viewGlobalModal('error', 'Error Submitting Data');
                    //var mod = MainApp.viewGlobalModal('success', 'Success send your mail risk register');
	        	 });
	        }
            });
        },

        SaveRiskData: function() {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                

                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/admin/Reminder/send_mail_risk';
                $.post(
                    url,
                    $( "#input-form" ).serialize(),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            //var mod = MainApp.viewGlobalModal('success', 'Success save your mail risk register');
                            mod.find('button.btn-ok-success').one('click', function(){
                                //location.href=site_url+'/risk/RiskRegister/RiskRegisterInput/'+me.dataMode;
                                location.href=site_url+'/admin/reminder/send_mail_risk';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                        
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                    //var mod = MainApp.viewGlobalModal('success', 'Success save your mail risk register');
                 });
            }
        }
	 }
}();