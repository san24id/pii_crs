var Login = function() {
	var handleLogin = function() {
		$('#submit-form').click(function(e) {
			$('.alert-danger', $('.login-form')).hide();
			$( "#alert-msg-container" ).html('');
			
		    e.preventDefault();
		    var l = Ladda.create(this);
		    l.start();
		    
		    var url = site_url+'/login/authenticate';
		    $.post(
		    	url,
		    	$( "#auth-form" ).serialize(),
		    	function( data ) {
		    		l.stop();
					if(data.success) {
						window.location.href = site_url+"/main";
					} else {
						$('.alert-danger', $('.login-form')).show();
						$( "#alert-msg-container" ).html(data.msg);
					}
		    	},
		    	"json"
		    ).fail(function() {
		    	l.stop();
		    	$('.alert-danger', $('.login-form')).show();
		    	$( "#alert-msg-container" ).html("Authentication Error" );
		     });
		});
    }

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();

        }

    };

}();