 $('#kcc').hide();
 $("#checked").hide();
 
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

                    location.href=site_url+'/main/mainrac#tab_action_plan_list';
                
            });
        	
        },
        submitRiskData: function(submitMode) {
        	var me = this;
        	var param = $('#input-form').serializeArray();
        	
        	if (submitMode == 'draft') {
        		var url = site_url+'/main/mainrac/actionChangeDate';
        		var vtext = 'Are You sure you want to confirm due_date this Action Plan ?';
        	} else {
        		var url = site_url+'/main/mainpic/actionSubmit';
        		var vtext = 'Are You sure you want to Submit this Action Plan ?';
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
                        var ggst = $( "#form-action-stat" ).val();
        				Metronic.unblockUI();
        				if(data.success) {
        					var mod = MainApp.viewGlobalModal('success', 'Success Updating Risk');
        					mod.find('button.btn-ok-success').one('click', function(){
        						if (submitMode == 'draft') {
        							location.href=site_url+'/main/mainrac/viewActionPlan/'+ggid+'/'+ggst+'?kat=ap';
        						} else {
        							location.href=site_url+'/main/mainrac';
        						}
        					});
        				} else {
        					 
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'This Risk Is Under Maintenance by RAC you cannot modify this risk until the process done');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac';
                            });
        				}
        			},
        			"json"
        		).fail(function() {
                    var ggid = $( "#form-action-id" ).val();
                    var ggst = $( "#form-action-stat" ).val();
        			Metronic.unblockUI();
        			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
                    var mod = MainApp.viewGlobalModal('success', 'Success Updating Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                if (submitMode == 'draft') {
                                    location.href=site_url+'/main/mainrac/viewActionPlan/'+ggid+'/'+ggst+'?kat=ap';
                                } else {
                                    location.href=site_url+'/main/mainrac';
                                }
                            });
        		 });
        	});
        }
	 }
}();