var ChangeRequest = function() {
	return {
		init: function() {
        	var me = this;
        	
        	$('#risk-button-submit').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin Verifikasi Permintaan Perubahan Anda ?');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			mod.modal('hide');
        			me.submitRiskData();
        		});
        	});
        	
        	$('#verify-risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin membatalkan Permintaan Perubahan Anda? Anda akan kehilangan data yang belum disimpan.');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main#tab_change_request_list';
        		});
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
        				var mod = MainApp.viewGlobalModal('success', 'Sukses Mengirimkan Permintaan Perubahan');
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
        		MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
        	});
	 	}
	 }
}();