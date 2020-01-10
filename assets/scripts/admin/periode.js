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
            "url": site_url+"/admin/periode/periodeGetData" // ajax source
        },
         "columnDefs": [{
        	"targets": 1,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_name;
        		
           	}
        },{
        	"targets": 2,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_start_v;
        		
           	}
        },{
        	"targets": 3,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_end_v;
        		
           	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" },
           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
           		'</div>'
           }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_submit_register = new Datatable();

grid_submit_register.init({
    src: $("#datatable_submit_register"),
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
        "pageLength": 10, // default record count per page
        "ajax": {
            "url": site_url+"/admin/periode/periodeGetData_submission" // ajax source
        },
         "columnDefs": [{
        	"targets": 1,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/library/submission/'+full.periode_id+'">'+full.periode_name+'</a>';
        		
           	}
        },{
        	"targets": 2,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_start_v;
        		
           	}
        },{
        	"targets": 3,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_end_v;
        		
           	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_submit_treatment = new Datatable();

grid_submit_treatment.init({
    src: $("#datatable_submit_treatment"),
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
        "pageLength": 10, // default record count per page
        "ajax": {
            "url": site_url+"/admin/periode/periodeGetData_submission" // ajax source
        },
         "columnDefs": [{
        	"targets": 1,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/library/submission_risk_owner/'+full.periode_id+'">'+full.periode_name+'</a>';
        		
           	}
        },{
        	"targets": 2,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_start_v;
        		
           	}
        },{
        	"targets": 3,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_end_v;
        		
           	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});
var grid_submit_action = new Datatable();

grid_submit_action.init({
    src: $("#datatable_submit_action"),
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
        "pageLength": 10, // default record count per page
        "ajax": {
            "url": site_url+"/admin/periode/periodeGetData_submission" // ajax source
        },
         "columnDefs": [{
        	"targets": 1,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/library/submission_action_plan/'+full.periode_id+'">'+full.periode_name+'</a>';
        		
           	}
        },{
        	"targets": 2,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_start_v;
        		
           	}
        },{
        	"targets": 3,
        	"data": "periode_id",
        	"render": function ( data, type, full, meta ) {
                return full.periode_end_v;
        		
           	}
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var grid_agregate = new Datatable();

grid_agregate.init({
    src: $("#datatable_aggregate"),
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
        "pageLength": 10, // default record count per page
        "ajax": {
            "url": site_url+"/admin/periode/periodeGetDataAgg" // ajax source
        },
         "columnDefs": [{
            "targets": 1,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/aggregatrisk/'+full.periode_id+'">'+full.periode_name+'</a>';
                
            }
        },{
            "targets": 2,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return full.periode_start_v;
                
            }
        },{
            "targets": 3,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return full.periode_end_v;
                
            }
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" }
       ],
        "order": [
            [1, "desc"]
        ]// set first column as a default sort by asc
    }
});

var grid_mapagregate = new Datatable();

grid_mapagregate.init({
    src: $("#datatable_mapaggregate"),
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
        "pageLength": 10, // default record count per page
        "ajax": {
            "url": site_url+"/admin/periode/periodeGetDataAgg" // ajax source
        },
         "columnDefs": [{
            "targets": 1,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/DivisionMapAgg/'+full.periode_id+'">'+full.periode_name+'</a>';
                
            }
        },{
            "targets": 2,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return full.periode_start_v;
                
            }
        },{
            "targets": 3,
            "data": "periode_id",
            "render": function ( data, type, full, meta ) {
                return full.periode_end_v;
                
            }
        }],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "periode_id", "orderable": true },
           { "data": "periode_id" },
           { "data": "periode_id" }
       ],
        "order": [
            [1, "desc"]
        ]// set first column as a default sort by asc
    }
});

var Periode = function() {
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
	            
	            if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: Metronic.isRTL(),
                        orientation: "left",
                        autoclose: true
                    });
                    //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
                }
	            
	            $('#input-form-submit-button').click(function(e) {
	                e.preventDefault();
                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;
                    var openverify;
	                var l = Ladda.create(this);
	                l.start();
	                
	                if (me.dataMode == 'add') {
	                	var url = site_url+'/admin/periode/periodeInsertData';
	                	var tx = 'Insert';
	                } else {
	                	var url = site_url+'/admin/periode/periodeEditData';
	                	var tx = 'Update';
	                }
	                $.post(
	                	url,
	                	$( "#input-form" ).serialize(),
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				grid.getDataTable().ajax.reload();
	            				$('#form-data').modal('hide');
                                 $('#first-newperiode').modal('show');
	            				MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
	            			} else {
	            				//MainApp.viewGlobalModal('error', data.msg);
                                $('#form-information').modal('show');
	            			}
							
	                	},
	                	"json"
	                ).fail(function() {
	                	l.stop();
	                	MainApp.viewGlobalModal('error', 'Error Submitting Data');
	                 });
	            });
	            
                $('#input-form-submit-button_edit').click(function(e) {
                    e.preventDefault();
                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;
                    var openverify;
                    var l = Ladda.create(this);
                    l.start();

                        var url = site_url+'/admin/periode/periodeEditData';
                        var tx = 'Update';
                    $.post(
                        url,
                        $( "#input-form2" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                grid.getDataTable().ajax.reload();
                                $('#form-data2').modal('hide');
                                 $('#first-newperiode').modal('hide');
                                MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                            } else {
                                //MainApp.viewGlobalModal('error', data.msg);
                                $('#form-information').modal('show');
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

	            //
	             $("#filterForm").submit(function (e) {
               	 	e.preventDefault();
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
	        	$('#input-form')[0].reset();
	        	$('#form-data').find('h4.modal-title').html('Add Periode');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'add';
	        },
	        editData: function(data) {
	        	$('#input-form2')[0].reset();
	        	$('#input-form2').find("input[name='periode_id']").val(data.periode_id);
	        	$('#input-form2').find("input[name='periode_name']").val(data.periode_name);
	        	$('#input-form2').find("input[name='periode_start']").val(data.periode_start_v);
	        	$('#input-form2').find("input[name='periode_end']").val(data.periode_end_v);
	        	
	        	$('#form-data2').find('h4.modal-title').html('Edit Periode');
	        	$('#form-data2').modal('show');
	        	this.dataMode = 'edit';
	        	
	        },
	        deleteData: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		
	        		Metronic.blockUI({ boxed: true });
	        		var url = site_url+'/admin/periode/periodeDeleteData';
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