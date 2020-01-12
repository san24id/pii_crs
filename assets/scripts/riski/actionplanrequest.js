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

var apForm = function() {
	return {
		init: function() {
        	var me = this;
        	
        	if (jQuery().datepicker) {
        	    $('.date-picker').datepicker({
        	        rtl: Metronic.isRTL(),
        	        orientation: "left",
        	        autoclose: true,
        	        todayHighlight: true
        	    });
        	    //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        	};
        	
        	$('#risk-button-save').on('click', function() {
        		me.submitRiskData('draft');
        	});
        	
        	$('#risk-button-verify').on('click', function() {
        		me.submitRiskData('submit');
        	});

            $('#risk-button-cancel').on('click', function () {
                var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin membatalkan? Anda akan kehilangan data yang belum disimpan.');
                mod.find('button.btn-primary').one('click', function(){
                    location.href=site_url+'/main/mainpic';
                });
            });
        	
        },
        submitRiskData: function(submitMode) {
        	var me = this;
        	var param = $('#input-form').serializeArray();
        	
        	if (submitMode == 'draft') {
        		var url = site_url+'/main/mainpic/actionSaveDraft';
        		var vtext = 'Apakah Anda yakin ingin Menyimpan sebagai Draft Action Plan ini?';
        	} else {
        		var url = site_url+'/main/mainpic/actionRequest';
        		var vtext = 'Apakah Anda yakin ingin Mengubah Permintaan Action Plan ini?';
        	}
        	
        	var mod = MainApp.viewGlobalModal('confirm', vtext);
        	mod.find('button.btn-primary').off('click');
        	mod.find('button.btn-primary').one('click', function(){
        		mod.modal('hide');
        		
        		Metronic.blockUI({ boxed: true });
        		$.post(
        			url,
        			$( "#input-form" ).serialize(),
        			function( data ) {
        				var ggid = $( "#form-action-id" ).val();
        				Metronic.unblockUI();
        				if(data.success) {
        					var mod = MainApp.viewGlobalModal('success', 'Sukses Memperbarui Risiko');
        					mod.find('button.btn-ok-success').one('click', function(){
        						if (submitMode == 'draft') {
        							location.href=site_url+'/main/mainpic/viewOwnedActionPlan/'+ggid;
        						} else {
        							location.href=site_url+'/main/mainpic#tab_action_plan';
        						}
        					});
        				} else {
        					 
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'Risiko ini Sedang dalam Pemeliharaan oleh RAC Anda tidak dapat mengubah risiko ini sampai proses telah selesai');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainpic';
                            });
        				}
        			},
        			"json"
        		).fail(function() {
        			Metronic.unblockUI();
        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
        		 });
        	});
        }
	 }
}();