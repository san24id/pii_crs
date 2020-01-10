var RiskVerify = function() {
	return {
		init: function() {
        	var me = this;
        	
        	me.loadRisk(g_risk_id);
        	
        	
        },
        loadRisk: function(rid) {
        	var me = RiskInput;
        	
        	$('#modal-library').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadLossEvent/"+rid, function( data_risk ) {
        		Metronic.unblockUI();

               me.controlResetdivisi();
                $.each( data_risk['divisi_list'], function( key, val ) {
                    var ecid = val.id;
                    if (val.id == null || val.id == '0') ecid = '';
                    var nnode = {
                        'division_id' : val.division_id,
                        'division_name' : val.division_name
                    };
                    
                    me.controlAddRowdivisi(nnode);
                });

        	});
        },
        
 

        saveImpactEdit: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = RiskInput;
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
                
                
                Metronic.blockUI({ boxed: true });

                    var url = site_url+'/admin/manage/saveRiskDataImpact';
                
                $.post(
                    url,
                    $( "#input-form" ).serialize()+ '&' + $.param(impact_param),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                if (submitMode == 'save_impact') {
                                    location.href=site_url+'/admin/manage/impact_risk/'+id_im;
                                } else {
                                    location.href=site_url+'/admin/manage/likelihood_risk/'+id_l;
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
                    var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                               
                                location.href=site_url+'/admin/manage/impact_risk/'+id_im;
                            });
                 });
            }
        }

	 }
}();