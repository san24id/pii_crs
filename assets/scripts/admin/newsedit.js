var News = function() {
	return {
			dataMode: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;
	        		            
	            // datatables filter button
	            $("#input-form-submit-button").click(function(e) {
	            	if ($("#news-title").val() == '') {
	            		MainApp.viewGlobalModal('error', 'Please fill the news title / subject');
	            	} else {
	            		$("#input-form").submit();
	            	}
	            });
	        }
	 }
}();