var grid = new Datatable();
var grid2 = new Datatable();

$('#re').hide();
$('#rl').hide();
$('#il').hide();
$('#li').hide();
$('#s_r1_level').hide();
$('#choose_l_divisi_1').hide();

$('#tr').hide();
$('#tl').hide();
$('#ti').hide();
$('#tk').hide();
$('#choose_l_divisi_2').hide();

$('#filterFormBy').change(function(){
	var frmval = $('#filterFormBy').val();
	if(frmval === '-'){
		$('#re').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');	
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');		
	}else if(frmval === 'risk_status'){
		$('#re').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').show();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');			
	}else if(frmval === 'risk_code'){
		$('#re').show();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');			
	}else if(frmval === 'risk_event'){
		$('#re').show();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');			
	}
	else if(frmval === 'risk_level'){
		$('#re').hide();
		$('#rl').show();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','filterFormValue');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');	
	}
	else if(frmval === 'risk_impact_level'){
		$('#re').hide();
		$('#rl').hide();
		$('#il').show();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');			
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#re').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').show();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','filterFormValue');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');	
	}
	else if(frmval === 'risk_owner'){
		$('#re').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').show();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','filterFormValue');		
	}	
	else{
		$('#re').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('#s_r1_level').hide();
		$('#choose_l_divisi_1').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','fk');
		$('.rash').attr('id','s_level_r1');	
		$('.bash').attr('id','l_divisi_1');	
	}
});

$('#filterFormBy2').change(function(){
	var frmval = $('#filterFormBy2').val(); 
	if(frmval === 'risk_event'){
		$('#tr').show();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
		$('.bish').attr('id','l_divisi_2');			
	}
	if(frmval === 'risk_code'){
		$('#tr').show();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');	
		$('.bish').attr('id','l_divisi_2');		
	}
	else if(frmval === 'risk_level'){
		$('#tr').hide();
		$('#tl').show();
		$('#ti').hide();
		$('#tk').hide();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','pe');
		$('.pesh').attr('id','filterFormValue2');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
		$('.bish').attr('id','l_divisi_2');	
	}
	else if(frmval === 'risk_impact_level'){
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').show();
		$('#tk').hide();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.posh').attr('id','pk');
		$('.bish').attr('id','l_divisi_2');			
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').show();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','filterFormValue2');
		$('.bish').attr('id','l_divisi_2');	
	}
	else if(frmval === 'risk_owner'){
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('#choose_l_divisi_2').show();
		$('.pash').attr('id','pe');
		$('.pesh').attr('id','pl');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
		$('.bish').attr('id','filterFormValue2');			
	}	
	else{
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('#choose_l_divisi_2').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','pk');
		$('.bish').attr('id','l_divisi_2');	
	}	
});

grid.init({
    src: $("#datatable_ajax"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
		//"scrollX": true,
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/risk/RiskRegister/riskGetRollOver" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (full.risk_existing_control == '3') {
        			img = 'submit.png';
        		}else if (data == '0') {
        			img = 'draft.png';
        		} else if (data == '1') {
        			img = 'confirm.png';
        		} else {
        			img = 'draft.png';
        		}
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
        		var cls = 'font-green';
        		if (full.risk_status == '0' || full.risk_status == '1') cls = '';
        		return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'">'+data+'</a>';
        	}
        }, {
        	"targets": 7,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var val = '';
        		if (data == '0') {
        			val = 'Draft';
        		} else if (data == '1') {
        			val = 'Confirm';
        		} else {
        			val = 'Draft';
        		}
        		return val;
        	}
        }, {
        	"targets": 8,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Confirm </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
        				'</div>';
        		} else if (data == '1') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-cancel"><i class="fa fa-times font-yellow"> Cancel</i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
        				'</div>';
        		} else {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Confirm </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
        				'</div>';
        		}
        		return img;
        	}
        } ],
        "columns": [
			{ "data": "risk_status", "orderable": false },
			{ "data": "risk_code" },
			{ "data": "risk_event" },
			{ "data": "risk_level_v" },
			{ "data": "impact_level_v" },
			{ "data": "likelihood_v" },
			{ "data": "risk_owner_v" },
			{ "data": "risk_status", "orderable": false },
			{ "data": "risk_status", "orderable": false }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

grid2.init({
    src: $("#datatable_ajax2"),
    onSuccess: function (grid) {
        // execute some code after table records loaded
    },
    onError: function (grid) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid) {
        // execute some code on ajax data load
    },
    loadingMessage: 'Loading...',
    dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
        
		//"scrollX": true,
        "pageLength": 25, // default record count per page
        "ajax": {
            "url": site_url+"/risk/RiskRegister/riskGetDataUser" // ajax source
        },    
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0') {
        			img = 'draft.png';
        		} else if (data == '1') {
        			img = 'confirm.png';
        		} else {
        			img = 'submit.png';
        		}
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
        		var cls = 'font-green';
        		if (full.risk_status == '0' || full.risk_status == '1'){ cls = '';
        		return '<a target="_self" class="'+cls+'" href="'+site_url+'/risk/RiskRegister/modifyRisk/'+full.risk_id+'?s=register">'+data+'</a>';
        		}else if (full.risk_status == '2'){ cls = '';
        		return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRiskChange/'+full.risk_id+'">'+data+'</a>';
        		}else if (full.risk_status > '2'){ cls = '';
        		return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'">'+data+'</a>';
        		}
        	}
        } ],    
        "columns": [
           { "data": "risk_status" },
           { "data": "risk_code" },
           { "data": "risk_event" },
           { "data": "risk_level_v" },
           { "data": "impact_level_v" },
           { "data": "likelihood_v" },
           { "data": "risk_owner_v" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var RiskList = function() {
	return {
			dataMode: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;
	        	
	        	$("#datatable_ajax").on('click', 'button.button-grid-confirm', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.confirmRisk(data);
    	        });
    	        
    	        $("#datatable_ajax").on('click', 'button.button-grid-cancel', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.draftRisk(data);
    	        });
    	        
    	        $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.deleteRisk(data);
    	        });
    	        
    	        $('#button-save-draft').click(function(e) {
    	        	e.preventDefault();
    	        	me.draftRiskPeriode();
    	        });
    	        
    	        $('#button-save-submit').click(function(e) {
    	        	e.preventDefault();
    	        	me.submitRiskPeriode();
    	        });

      			$('#button-alert-submit').on('click', function() {
        			var mod = MainApp.viewGlobalModal('alert', 'To submit Risk Identified in This Periode, please confirm or delete data at Roll Forward Risk');
        		});

				
				$('#filterFormSubmit').on('click', function() {
					me.filterDataGridRiskList();  
				});
				
				$('#filterFormSubmit2').on('click', function() {
					me.filterDataGridRiskList2(); 
				});

				 $("#filterForm").submit(function (e) {
               	 	e.preventDefault();
                	me.filterDataGridRiskList(); 
           		 });
				
				$("#filterForm2").submit(function (e) {
               	 	e.preventDefault();
                	me.filterDataGridRiskList2(); 
           		 });

				$('#button-change-request').click(function(e) {
    	        	e.preventDefault();
    	        	me.submitRiskPeriode2();
    	        });
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        confirmRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Do you want to Roll Forward this risk to curent periode,<br>for risk : <b>'+data.risk_event+'</b> ? ');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id
	        		};
	        		var url = site_url+'/risk/RiskRegister/confirmRisk';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					MainApp.viewGlobalModal('success', 'Success Risk New Periode');
	        					window.location.href = site_url+'/risk/RiskRegister';

	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('success', 'Success Risk New Periode');

	        			//window.location.href = site_url+'/risk/RiskRegister';
	        		 });
	        	});
	        },
	        draftRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Update Risk Status to <b>Draft</b> for risk : <b>'+data.risk_event+'</b> ? ');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id
	        		};
	        		var url = site_url+'/risk/RiskRegister/draftRisk';
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					grid.getDataTable().ajax.reload();
	        					grid2.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Update Risk Status');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        		 });
	        	});
	        },
	        deleteRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Delete</b> risk : <b>'+data.risk_event+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id
	        		};
	        		var url = site_url+'/risk/RiskRegister/deleteRisk';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//MainApp.viewGlobalModal('success', 'Success Delete Risk');
	        					window.location.href = site_url+'/risk/RiskRegister';
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        		 });
	        	});
	        },
	        draftRiskPeriode: function() {
	        	//g_p_name
	        		var url = site_url+'/risk/RiskRegister/draftRiskByPeriode';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			{},
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					grid.getDataTable().ajax.reload();
	        					grid2.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Update Risk Status');
	        				} else {
	        					MainApp.viewGlobalModal('alert', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        		 });
	        	
	        },
			filterDataGridRiskList: function() {
        	var fby = $('#filterFormBy').val();
        	var fval = $('#filterFormValue').val();
        	
        	grid.clearAjaxParams();
        	grid.setAjaxParam("filter_by", fby);
        	grid.setAjaxParam("filter_value", fval);
        	grid.getDataTable().ajax.reload();
			},
			filterDataGridRiskList2: function() {
        	var fby = $('#filterFormBy2').val();
        	var fval = $('#filterFormValue2').val();
        	
        	grid2.clearAjaxParams();
        	grid2.setAjaxParam("filter_by", fby);
        	grid2.setAjaxParam("filter_value", fval);
        	grid2.getDataTable().ajax.reload();
			},
	        submitRiskPeriode: function() {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Do you want to Submit to RAC all risk identified in periode : <b>'+g_p_name+'</b>');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var url = site_url+'/risk/RiskRegister/submitRiskByPeriode';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			{},
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					
	        					//MainApp.viewGlobalModal('success', 'Success Update Risk Status');
	        					window.location.href = site_url+'/risk/RiskRegister';
	        				} else {
	        					MainApp.viewGlobalModal('alert', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        			window.location.href = site_url+'/risk/RiskRegister';
	        		 });
	        	});
	        },
	        
	        submitRiskPeriode2: function() {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Do you want to Change request to RAC all risk identified in periode : <b>'+g_p_name+'</b>');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var url = site_url+'/risk/RiskRegister/submitRiskByPeriode2';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			{},
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					
	        					//MainApp.viewGlobalModal('success', 'Success Change Request');
	        					window.location.href = site_url+'/main/#tab_change_request_list';
	        				} else {
	        					MainApp.viewGlobalModal('alert', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        			window.location.href = site_url+'/main/#tab_change_request_list';
	        		 });
	        	});
	        }



	 }
}();