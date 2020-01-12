var ChangeRequest = function() {
	return {
		init: function() {
        	var me = this;
        	
        	$('#risk-button-submit').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to Verify your Change Request ?');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			mod.modal('hide');
        			me.submitRiskData();
        		});
        	});
        	
        	$('#verify-risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to cancel your Change Request ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main#tab_change_request_list';
        		});
        	});

                $('#owner_report').on('change', function() {                    
                        var img = me.recalculateWarning($(this).val());
                        img = img.toLowerCase();
                        img = base_url+'assets/images/legend/kri_'+img+'.png';

                        $('#warning_img').attr('src', img);
                });
        },
	    submitRiskData: function() {
        	var me = this;
	        
        	Metronic.blockUI({ boxed: true });
        	var url = site_url+'/main/mainrac/changeRequestVerifyKri';

        	$.post(
        		url,
        		$( "#kri-form" ).serialize(),
        		function( data ) {
        			Metronic.unblockUI();
        			if(data.success) {
        				var mod = MainApp.viewGlobalModal('success', 'Success Submitting Change Request');
        				mod.find('button.btn-ok-success').one('click', function(){
        					location.href=site_url+'/main#tab_change_request_list';
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
	 	},

       recalculateWarning: function(nval) {
                if (t_treshold_type != ''  ) {
                        var def = 'default';
                        if (t_treshold_type == 'SELECTION') {
                                $.each(t_treshold_list, function(k, v) {
                                        if (v['value_1']+v['result'] == nval) {
                                                def = v['result'];
                                        }
                                });
                        }else if (t_treshold_type == 'VALUE') {
                                $.each(t_treshold_list, function(k, v) {
                                        if (v['operator']+v['value_1']+v['value_type'] == nval) {
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