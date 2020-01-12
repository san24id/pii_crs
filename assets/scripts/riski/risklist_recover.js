var grid = new Datatable();
var grid2 = new Datatable();

$('#re').hide();
$('#rl').hide();
$('#il').hide();
$('#li').hide();

$('#tr').hide();
$('#tl').hide();
$('#ti').hide();
$('#tk').hide();

$('#re2').hide();
$('#tr2').hide();

$('#filterFormBy').change(function(){
	var frmval = $('#filterFormBy').val(); 
	if(frmval === 'risk_event'){
		$('#re2').hide();
		$('#re').show();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('.hash').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');		
	}
	else if(frmval === 'risk_level'){
		$('#re2').hide();
		$('#re').hide();
		$('#rl').show();
		$('#il').hide();
		$('#li').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','filterFormValue');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
	}
	else if(frmval === 'risk_impact_level'){
		$('#re2').hide();
		$('#re').hide();
		$('#rl').hide();
		$('#il').show();
		$('#li').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hosh').attr('id','fk');		
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#re').hide();
		$('#re2').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').show();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','filterFormValue');
	}
	else if(frmval === 'risk_owner'){
		$('#re').hide();
		$('#re2').show();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','filterFormValue');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
	}	
	else{
		$('#re').hide();
		$('#re2').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','fk');
	}
});

$('#filterFormBy2').change(function(){
	var frmval = $('#filterFormBy2').val(); 
	if(frmval === 'risk_event'){
		$('#tr2').hide();
		$('#tr').show();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('.pash').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');		
	}
	else if(frmval === 'risk_level'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').show();
		$('#ti').hide();
		$('#tk').hide();
		$('.pash').attr('id','pe');
		$('.pesh').attr('id','filterFormValue2');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
	}
	else if(frmval === 'risk_impact_level'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').show();
		$('#tk').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.posh').attr('id','pk');		
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').show();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','filterFormValue2');
	}
	else if(frmval === 'risk_owner'){
		$('#tr2').show();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','filterFormValue2');
	}		
	else{
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','pk');
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
            "url": site_url+"/risk/RiskRegister/riskGetRollOver_recover" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status_v",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0' || data == '1') {
        			img = 'draft.png';
        		} else if (data == '2') {
        			img = 'submit.png';
        		} else if (data == '3' || data == '4') {
        			img = 'verified.png';
        		}else if (data == '5' || data == '6') {
        			img = 'treatment.png';
        		}else if (data == '10') {
        			img = 'actplan.png';
        		}else if (data == '20') {
        			img = 'executed.png';
        		}else {
        			img = 'submit.png';
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
        	"targets": 8,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

        				'</div>';
        		} else if (data == '1') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

        				'</div>';
        		} else{
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
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
			{ "data": "username" },

			
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

grid2.init({
    src: $("#datatable_ajax2"),
    onSuccess: function (grid2) {
        // execute some code after table records loaded
    },
    onError: function (grid2) {
        // execute some code on network or other general error  
    },
    onDataLoad: function(grid2) {
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
            "url": site_url+"/risk/RiskRegister/riskGetRollOver_recover_modify_rac" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status_v",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0' || data == '1') {
        			img = 'draft.png';
        		} else if (data == '2') {
        			img = 'submit.png';
        		} else if (data == '3' || data == '4') {
        			img = 'verified.png';
        		}else if (data == '5' || data == '6') {
        			img = 'treatment.png';
        		}else if (data == '10') {
        			img = 'actplan.png';
        		}else if (data == '20') {
        			img = 'executed.png';
        		}else{
        			img = 'submit.png';
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
        		var img = '';
        		if (data == '0') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
        				'</div>';
        		} else if (data == '1') {
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
        					
        				'</div>';
        		} else{
        			img = '<div class="btn-group">'+
        					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-thumbs-up font-green"> Restore </i></button>'+
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

    	        $("#datatable_ajax2").on('click', 'button.button-grid-confirm', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid2.getDataTable().row(r).data();
    	        	
    	        	me.confirmRiskBawah(data);
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
    	        	
    	        	me.deleteRiskAtas(data);
    	        });
    	        
    	        $("#datatable_ajax2").on('click', 'button.button-grid-delete', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid2.getDataTable().row(r).data();
    	        	
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
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        
	        confirmRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Yakin ingin <b> Restore</b> beresiko bencana ini, untuk risiko : <b>'+data.risk_event+'</b> ? ');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id,
	        			'username' : data.username
	        		};
	        		var url = site_url+'/risk/RiskRegister/confirmRisk_recover_rac';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//MainApp.viewGlobalModal('success', 'Sukses memperbarui Status Risiko');
	        					window.location.href = site_url+'/risk/RiskRegister/recover';

	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
	        		 });
	        	});
	        },

	        confirmRiskBawah: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'recover Risk Status to <b>Confirm</b> for risk : <b>'+data.risk_event+'</b> ? ');
	        	mod.find('button.btn-ok-success').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id,
	        			'risk_input_by' : data.risk_input_by
	        		};
	        		var url = site_url+'/risk/RiskRegister/confirmRisk_recover_rac_bawah';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//MainApp.viewGlobalModal('success', 'Sukses memperbarui Status Risiko');
	        					window.location.href = site_url+'/risk/RiskRegister/recover';

	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
	        		 });
	        	});
	        },


	        draftRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Perbarui Status Risiko menjadi <b> Draft </ b> untuk risiko : <b>'+data.risk_event+'</b> ? ');
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
	        					
	        					MainApp.viewGlobalModal('success', 'Sukses memperbarui Status Risiko');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
	        		 });
	        	});
	        },
	         deleteRiskAtas: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Yakin ingin <b> Hapus </ b> risiko : <b>'+data.risk_event+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id,
	        			'username' : data.username
	        		};
	        		var url = site_url+'/risk/RiskRegister/deleteRiskgrid3_rac';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					grid.getDataTable().ajax.reload();
	        					grid2.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Sukses menghapus Risiko');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
	        		 });
	        	});
	        },

	        deleteRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Yakin ingin <b> Hapus </ b> risiko : <b>'+data.risk_event+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'risk_id' : data.risk_id,
	        			'risk_input_by' : data.risk_input_by
	        		};
	        		var url = site_url+'/risk/RiskRegister/deleteRiskgridfrom_rac';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					grid.getDataTable().ajax.reload();
	        					grid2.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Sukses menghapus Risiko');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			//MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
	        			grid.getDataTable().ajax.reload();
	        			grid2.getDataTable().ajax.reload();
	        			MainApp.viewGlobalModal('success', 'Sukses menghapus Risiko');
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
	        					
	        					MainApp.viewGlobalModal('success', 'Sukses memperbarui Status Risiko');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
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
	        	var mod = MainApp.viewGlobalModal('confirm', 'Kirim ke RAC Semua Risiko dalam Periode : <b>'+g_p_name+'</b>');
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
	        					grid.getDataTable().ajax.reload();
	        					grid2.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Sukses memperbarui Status Risiko');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
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