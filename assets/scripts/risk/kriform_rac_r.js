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
        		me.submitRiskData();
        	});
        	
        	$('#kri-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to cancel your KRI Entry ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac/regularkri';
        		});
        	}); 
        	
        },
        submitRiskData: function() {
        	if ($('#owner_report').val() == '') {
        		MainApp.viewGlobalModal('error', 'Please Fill the KRI Report');
        		return false;
        	} 
        	var fvalid = true;
        	if (fvalid) {
        		var me = this;
        		
        		Metronic.blockUI({ boxed: true });
        		var url = site_url+'/risk/Kri/submitKriReport';
        		$.post(
        			url,
        			{
        				'id' : $('#kri-id').val(), 
        				'owner_report' : $('#owner_report').val(),
                                        'support' : $('#support').val()
        			},
        			function( data ) {
        				Metronic.unblockUI();
        				if(data.success) {
        					var mod = MainApp.viewGlobalModal('success', 'Success Updating your KRI');
        					mod.find('button.btn-ok-success').one('click', function(){
        						location.href=site_url+'/main/mainrac/regularkri';
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
	 }
}();