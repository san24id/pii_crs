var ChangeRequest = function() {
	return {
		init: function() {
        	var me = this;
        	
        	$('#risk-button-submit').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Yakin ingin Kirim Permintaan Perubahan Anda?');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData();
        		});
        	});
        	
        	$('#verify-risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Yakin ingin membatalkan Permintaan Perubahan Anda? Anda akan kehilangan data yang belum disimpan.');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main';
        		});
        	});
        },
	    submitRiskData: function() {
        	var me = this;
	        
        	Metronic.blockUI({ boxed: true });
        	var url = site_url+'/risk/RiskRegister/submitChangeKri';

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