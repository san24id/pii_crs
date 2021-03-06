var grid = new Datatable();

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
            "url": site_url+"/user/divisionGetData" // ajax source
        },
        "columnDefs":[{
        	"targets": 4,
        	"data": "status",
        	"render": function ( data, type, full, meta ) {
        		var sts = '';
        		if (data == '0') {
        			sts = 'ON';
        		} else if (data == '1') {
        			sts = 'OFF';
        		} 
        		return '<center>'+sts+'</center>';
        	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "short_division"},
           { "data": "division_name" },
           { "data": "group_direk_id" },
           { "data": "status" },

           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           		'</div>'
           }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_off = new Datatable();

grid_off.init({
    src: $("#datatable_ajax_off"),
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
            "url": site_url+"/user/divisionGetDataOff" // ajax source
        },
        "columnDefs":[{
        	"targets": 4,
        	"data": "status",
        	"render": function ( data, type, full, meta ) {
        		var sts = '';
        		if (data == '0') {
        			sts = 'ON';
        		} else if (data == '1') {
        			sts = 'OFF';
        		} 
        		return '<center>'+sts+'</center>';
        	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "short_division"},
           { "data": "division_name" },
           { "data": "group_direk_id" },
           { "data": "status" },

           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           		'</div>'
           }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var Division = function() {
	return {
			dataMode: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;
	        	
	        	 $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
	              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
	                '<div class="progress progress-striped active">' +
	                  '<div class="progress-bar" style="width: 100%;"></div>' +
	                '</div>' +
	              '</div>';
	
	            $.fn.modalmanager.defaults.resize = true;
	            
	            $('#input-form-submit-button').click(function(e) {
	                e.preventDefault();
	                var l = Ladda.create(this);
	                l.start();
	                
	                if (me.dataMode == 'add') {
	                	var url = site_url+'/user/divisionInsertData';
	                	var tx = 'Insert';
	                } else {
	                	var url = site_url+'/user/mdivisionEdit';
	                	var tx = 'Update';
	                }
	                $.post(
	                	url,
	                	$( "#input-form" ).serialize(),
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				grid.getDataTable().ajax.reload();
	            				grid_off.getDataTable().ajax.reload();
	            				
	            				$('#form-data').modal('hide');
	            				
	            				MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
	            			} else {
	            				MainApp.viewGlobalModal('error', data.msg);
	            			}
							
	                	},
	                	"json"
	                ).fail(function() {
	                	l.stop();
	                	MainApp.viewGlobalModal('error', 'Error Submitting Data');
	                 });
	            });

	          $('#input-form-insert-button').click(function(e) {
	                e.preventDefault();
	                var l = Ladda.create(this);
	                l.start();
	                
	                var url = site_url+'/user/divisionInsertData';
	                var tx = 'Insert';

	                $.post(
	                	url,
	                	$( "#input-form-insert" ).serialize(),
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				grid.getDataTable().ajax.reload();
	            				
	            				$('#form-data-insert').modal('hide');
	            				
	            				MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
	            			} else {
	            				MainApp.viewGlobalModal('error', data.msg);
	            			}
							
	                	},
	                	"json"
	                ).fail(function() {
	                	l.stop();
	                	MainApp.viewGlobalModal('error', 'Error Submitting Data');
	                 });
	            });
	            
	            // datatables filter button
	            $("#filterFormSubmit").click(function(e) {
	            	var fby = $("#filterFormBy").val();
	            	var fval = $("#filterFormValue").val();
	            	
	            	me.filterDataGrid(fby, fval);
	            });
	            
	            // datatables edit delete handler
	            $("#datatable_ajax").on('click', 'button.button-grid-edit', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	me.editData(data);
	            });

	           	$("#datatable_ajax_off").on('click', 'button.button-grid-edit', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid_off.getDataTable().row(r).data();
	            	
	            	me.editData(data);
	            });
	            
	            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	me.deleteData(data);
	            });
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        showInputForm: function() {
	        	$('#input-form-insert')[0].reset();
	        	$('#form-data-insert').find('h4.modal-title').html('Add Division');
	        	$('#form-data-insert').modal('show');
	        	this.dataMode = 'add';
	        },

	        showOffdivision: function() {
	        	$('#division-off').find('h4.modal-title').html('Division Management');
	        	$('#division-off').modal('show');
	        },
	        editData: function(data) {
	        	$('#input-form')[0].reset();
	        	$('#input-form').find("input[name='division_id']").val(data.division_id);
	        	$('#input-form').find("input[name='short_name']").val(data.short_division);
	        	$('#input-form').find("input[name='division_name']").val(data.division_name);
	        	$('#input-form').find("input[name='role']").val(data.role_direk).prop("readonly", true);
	        	$('#input-form').find("input[name='direk_id']").val(data.group_direk_id).prop("readonly", true);
	        	$('#input-form').find("input[name='direk_old']").val(data.group_direk_name).prop("readonly", true);
	        	$('#input-form').find("select[name='status']").val(data.status);
	        	
	        	$('#form-data').find('h4.modal-title').html('Edit Division');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'edit';
	        	
	        },
	        deleteData: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data ?');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		
	        		Metronic.blockUI({ boxed: true });
	        		var url = site_url+'/user/divisionDeleteData';
	        		$.post(
	        			url,
	        			{ 'id':  data.DT_RowId},
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					grid.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete Data');
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