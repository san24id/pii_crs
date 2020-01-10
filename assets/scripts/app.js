var MainApp = function() {
	return {
        init: function() {
        	 
        },
	    viewGlobalModal: function(mode, msg) {
	    	if (mode == 'success') {
	    		$('#global-app-modal-success .alert_container').html(msg);
	    		$('#global-app-modal-success').modal('show');
	    		return $('#global-app-modal-success');
	    	} else if (mode == 'warning') {
	    		$('#global-app-modal-warning .alert_container').html(msg);
	    		$('#global-app-modal-warning').modal('show');
	    		return $('#global-app-modal-warning');
	    	}else if (mode == 'warning-maintenance') {
	    		$('#global-app-modal-warning-maintenance .alert_container').html(msg);
	    		$('#global-app-modal-warning-maintenance').modal('show');
	    		return $('#global-app-modal-warning-maintenance');
	    	} else if (mode == 'confirm') {
	    		$('#global-app-modal-confirmation .alert_container').html(msg);
	    		$('#global-app-modal-confirmation').modal('show');
	    		return $('#global-app-modal-confirmation');
	    	}else if (mode == 'confirm-change') {
	    		$('#global-app-modal-confirmation-change .alert_container').html(msg);
	    		$('#global-app-modal-confirmation-change').modal('show');
	    		return $('#global-app-modal-confirmation');
	    	}else if (mode == 'alert') {
	    		$('#global-app-modal-error-alert .alert_container').html(msg);
	    		$('#global-app-modal-error-alert').modal('show');
	    		return $('#global-app-modal-error-alert');
	    	} else {
	    		$('#global-app-modal-error .alert_container').html(msg);
	    		$('#global-app-modal-error').modal('show');
	    		return $('#global-app-modal-error');
	    	}
	    }
	 }
}();

var on_options = {
	legend: {
        show: false
    },
    series: {
        bars: {
            show: true,
            barWidth: 0.5,
            align: "center",
            horizontal: true,
            lineWidth: 0
        }
    },
    yaxis: {
        mode: "categories",
        tickLength: 2,
        axisMargin: 10,
        autoscaleMargin: 0.05
    },
    xaxis: {
        min: 0,
        //ticks: 2
        tickDecimals: 0
    },
    grid: {
    	hoverable: true,
        tickColor: "#eee",
        borderColor: "#eee",
        borderWidth: 1
    },
    colors: ["#D91E18", "#F3C200", "#1BA39C"]
};

if (banner_status == "1") {
	$("#webticker").webTicker({
	    speed: 50, //pixels per second
	    direction: "left", //if to move left or right
	    moving: true, //weather to start the ticker in a moving or static position
	    startEmpty: true, //weather to start with an empty or pre-filled ticker
	    duplicate: false, //if there is less items then visible on the ticker you can duplicate the items to make it continuous
	    rssurl: false, //only set if you want to get data from rss
	    rssfrequency: 0, //the frequency of updates in minutes. 0 means do not refresh
	    updatetype: "reset" //how the update would occur options are "reset" or "swap"
	}); 
}