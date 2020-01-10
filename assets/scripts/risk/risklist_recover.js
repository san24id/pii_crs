var grid = new Datatable();
var grid2 = new Datatable();

$('#re').hide();
$('#rl').hide();
$('#il').hide();
$('#li').hide();
$('#s_r1_level').hide();
$('#l_r1_divisi').hide();

$('#tr').hide();
$('#tl').hide();
$('#ti').hide();
$('#tk').hide();
$('#s_r2_level').hide();
$('#l_r2_divisi').hide();

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
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
		$('.hash').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');		
	}
	else if(frmval === 'risk_level'){
		$('#re2').hide();
		$('#re').hide();
		$('#rl').show();
		$('#il').hide();
		$('#li').hide();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','filterFormValue');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');
	}
	else if(frmval === 'risk_impact_level'){
		$('#re2').hide();
		$('#re').hide();
		$('#rl').hide();
		$('#il').show();
		$('#li').hide();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','filterFormValue');
		$('.hesh').attr('id','fl');
		$('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');		
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#re').hide();
		$('#re2').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').show();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','filterFormValue');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');
	}
	else if(frmval === 'risk_owner'){
		$('#re').hide();
		$('#re2').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').show();
		$('.hash').attr('id','fe');
		$('.hesh').attr('id','fe2');
		$('.hish').attr('id','fi');
		$('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','filterFormValue');
	}
    else if(frmval === 'risk_status'){
        $('#re').hide();
        $('#re2').hide();
        $('#rl').hide();
        $('#il').hide();
        $('#li').hide();
        $('#s_r1_level').show();
        $('#l_r1_divisi').hide();
        $('.hash').attr('id','fe');
        $('.hesh').attr('id','fe2');
        $('.hish').attr('id','fi');
        $('.hosh').attr('id','fk');
        $('.rash').attr('id','filterFormValue');
        $('.rish').attr('id','l_divisi_r1');	
	}else if(frmval === 'risk_code'){
        $('#re2').hide();
        $('#re').show();
        $('#rl').hide();
        $('#il').hide();
        $('#li').hide();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
        $('.hash').attr('id','filterFormValue');
        $('.hesh').attr('id','fl');
        $('.hish').attr('id','fi');
        $('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');        
    }else{
		$('#re').hide();
		$('#re2').hide();
		$('#rl').hide();
		$('#il').hide();
		$('#li').hide();
        $('#s_r1_level').hide();
        $('#l_r1_divisi').hide();
		$('.hash').attr('id','fe');
		$('.hish').attr('id','fi');
		$('.hesh').attr('id','fl');		
		$('.hosh').attr('id','fk');
        $('.rash').attr('id','s_level_r1');
        $('.rish').attr('id','l_divisi_r1');
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
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
		$('.pash').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');		
	}
	else if(frmval === 'risk_level'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').show();
		$('#ti').hide();
		$('#tk').hide();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
		$('.pash').attr('id','pe');
		$('.pesh').attr('id','filterFormValue2');
		$('.pish').attr('id','pi');
		$('.posh').attr('id','pk');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');
	}
	else if(frmval === 'risk_impact_level'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').show();
		$('#tk').hide();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','filterFormValue2');
		$('.pesh').attr('id','pl');
		$('.posh').attr('id','pk');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');		
	}
	else if(frmval === 'risk_likelihood_key'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').show();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','filterFormValue2');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');
	}
	else if(frmval === 'risk_owner'){
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').show();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','p2');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','filterFormValue2');
	}
    else if(frmval === 'risk_status'){
        $('#tr2').hide();
        $('#tr').hide();
        $('#tl').hide();
        $('#ti').hide();
        $('#tk').hide();
        $('#s_r2_level').show();
        $('#l_r2_divisi').hide();
        $('.pash').attr('id','pe');
        $('.pish').attr('id','pi');
        $('.pesh').attr('id','pl');     
        $('.posh').attr('id','p2');
        $('.rush').attr('id','filterFormValue2');
        $('.resh').attr('id','l_divisi_r2');
    }else if(frmval === 'risk_code'){
        $('#tr2').hide();
        $('#tr').show();
        $('#tl').hide();
        $('#ti').hide();
        $('#tk').hide();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
        $('.pash').attr('id','filterFormValue2');
        $('.pesh').attr('id','pl');
        $('.pish').attr('id','pi');
        $('.posh').attr('id','pk');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');        
    }		
	else{
		$('#tr2').hide();
		$('#tr').hide();
		$('#tl').hide();
		$('#ti').hide();
		$('#tk').hide();
        $('#s_r2_level').hide();
        $('#l_r2_divisi').hide();
		$('.pash').attr('id','pe');
		$('.pish').attr('id','pi');
		$('.pesh').attr('id','pl');		
		$('.posh').attr('id','pk');
        $('.rush').attr('id','s_level_r2');
        $('.resh').attr('id','l_divisi_r2');
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
        	"targets": 1,
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
        	"targets": 2,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
        		var cls = 'font-green';
        		if (full.risk_status == '0' || full.risk_status == '1') cls = '';
        		return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.risk_id+'">'+data+'</a>';
        	}
        }, {
        	"targets": 9,
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
            { "data": "checkboxColumn", "orderable": false  },
			{ "data": "risk_status"},
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
        	"targets": 1,
        	"data": "ex",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
                if (data == '0' || data == '1') {
                    img = 'draft.png';
                } else if (data == '2') {
                    img = 'submit.png';
                } else if (data == '3') {
                    //img = 'verified.png';
                    img = 'treatment.png';
                }else if (data == '4' || data == '5') {
                    img = 'treatment.png';
                }else if (data == '6') {
                    img = 'actplan.png';
                }else if (data == '10') {
                    img = 'executed_2.png';
                }else if (data == '20') {
                    img = 'executed.png';
                }
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 2,
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
            { "data": "checkboxColumn", "orderable": false  },
			{ "data": "ex", "orderable": false },
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

                $('#delete_check_recover2').on('click', function() {
                var selRow =  grid2.getSelectedRows();
                if (selRow.length > 0) {
                    var subParam = {};
                    var ct = 0;
                    $.each(selRow, function(k, v) {
                        subParam['risk_id['+ct+']'] = v;
                        ct++;
                    });
                    
                    var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to delete selected Risk Recover ?');
                    mod.find('button.btn-ok-success').one('click', function(){
                        mod.modal('hide');
                        
                    var url = site_url+'/risk/RiskRegister/deleteSelectRecoverRisk';
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $.param(subParam),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    grid.getDataTable().ajax.reload();
                                     grid2.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success delete for selected Risk Recover');
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
                } else {
                    MainApp.viewGlobalModal('error', 'Please Select Risk');
                }
            });

            $('#delete_check_recoverfr').on('click', function() {
                var selRow =  grid.getSelectedRows();
                if (selRow.length > 0) {
                    var subParam = {};
                    var ct = 0;
                    $.each(selRow, function(k, v) {
                        subParam['risk_id['+ct+']'] = v;
                        ct++;
                    });
                    
                    var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to delete selected Recover Roll Forward Risk ?');
                    mod.find('button.btn-ok-success').one('click', function(){
                        mod.modal('hide');
                        
                    var url = site_url+'/risk/RiskRegister/deleteSelectRecoverRiskfr';
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $.param(subParam),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    grid.getDataTable().ajax.reload();
                                     grid2.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success delete for selected Risk Recover');
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
                } else {
                    MainApp.viewGlobalModal('error', 'Please Select Risk');
                }
            });

                $('#delete_all_recover2').on('click', function() {
                    me.deleteallrecover2(); 
                });

                $('#delete_all_recoverfr').on('click', function() {
                    me.deleteallrecoverfr(); 
                });
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        
	        confirmRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('confirm', 'Are you sure you want to <b>Restore</b> this risk to your Risk Register, for risk : <b>'+data.risk_event+'</b> ? ');
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
	        					//MainApp.viewGlobalModal('success', 'Success Update Risk Status');
	        					window.location.href = site_url+'/risk/RiskRegister/recover';

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
	        					//MainApp.viewGlobalModal('success', 'Success Update Risk Status');
	        					window.location.href = site_url+'/risk/RiskRegister/recover';

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
	         deleteRiskAtas: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Delete</b> risk : <b>'+data.risk_event+'</b> ?');
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
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete Risk');
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
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete Risk');
	        				} else {
	        					MainApp.viewGlobalModal('error', data.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
	        			grid.getDataTable().ajax.reload();
	        			grid2.getDataTable().ajax.reload();
	        			MainApp.viewGlobalModal('success', 'Success Delete Risk');
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
	        					MainApp.viewGlobalModal('error', data.msg);
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
	        	var mod = MainApp.viewGlobalModal('confirm', 'Submit to RAC All Risk in Periode : <b>'+g_p_name+'</b>');
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

            deleteallrecover2: function() {
            var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to delete all Recover Risk ?');
                mod.find('button.btn-ok-success').one('click', function(){
                    mod.modal('hide');
                    var url = site_url+'/risk/RiskRegister/deleteAllRecoverRisk';
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid.getDataTable().ajax.reload();
                                grid2.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success delete all risk');
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

            deleteallrecoverfr: function() {
            var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to delete all Recover Roll Forward Risk ?');
                mod.find('button.btn-ok-success').one('click', function(){
                    mod.modal('hide');
                    var url = site_url+'/risk/RiskRegister/deleteAllRecoverRollFR';
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid.getDataTable().ajax.reload();
                                grid2.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success delete all risk');
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
             }

	 }
}();