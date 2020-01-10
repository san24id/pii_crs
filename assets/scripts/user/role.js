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
            "url": site_url+"/user/roleGetData" // ajax source
        },
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "role_name" },
           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-settings"><i class="fa fa-sitemap font-green"></i></button>'+
           		'</div>'
           },
           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-minus-circle font-red"> Delete </i></button>'+
           		'</div>'
           }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var Role = function() {
	return {
			dataMode: null,
			dataSelect: null,
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
	            
	            //$.fn.modal.defaults.maxHeight = function(){
	                // subtract the height of the modal header and footer
	            //    return $(window).height() - 260; 
	            //}
	            
	            $('#input-form-submit-button').click(function(e) {
	                e.preventDefault();
	                var l = Ladda.create(this);
	                l.start();
	                
	                if (me.dataMode == 'add') {
	                	var url = site_url+'/user/roleInsertData';
	                	var tx = 'Insert';
	                } else {
	                	var url = site_url+'/user/roleEditData';
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
	            
	            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	me.deleteData(data);
	            });
	            
	            $("#datatable_ajax").on('click', 'button.button-grid-settings', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	me.dataSelect = data;
	            	
	            	me.viewMenuForm(data);
	            });
	            
	            $('#input-menu-submit-button').click(function(e) {
	                e.preventDefault();
	                
	                var ch = $('#menu_tree_container').jstree().get_checked();
	                var ids = ch.join('|');
	                
	                var l = Ladda.create(this);
	                l.start();
	                
	                var sdata = {
	                	'role_id' : me.dataSelect.role_id,
	                	'ids' : ids
	                };
	                
	               	var url = site_url+'/user/roleEditMenu';
	                $.post(
	                	url,
	                	sdata,
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				$('#menu-access-data').modal('hide');
	            				MainApp.viewGlobalModal('success', 'Success Updating Menu Access');
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
	            
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        showInputForm: function() {
	        	$('#input-form')[0].reset();
	        	$('#form-data').find('h4.modal-title').html('Add Role');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'add';
	        },
	        editData: function(data) {
	        	$('#input-form')[0].reset();
	        	$('#input-form').find("input[name='role_id']").val(data.role_id);
	        	$('#input-form').find("input[name='role_name']").val(data.role_name);
	        	
	        	$('#form-data').find('h4.modal-title').html('Edit Role');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'edit';
	        	
	        },
	        deleteData: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data ?');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		
	        		Metronic.blockUI({ boxed: true });
	        		var url = site_url+'/user/roleDeleteData';
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
	        },
	        viewMenuForm: function(data) {
	        	$('#menu-access-data').find('h4.modal-title').html('Menu Access for Role : <b>'+data.role_name+'</b>');
	        	
	        	$('#menu-access-data').on('shown.bs.modal', function () {
	        		$('#menu-access-data.modal .modal-body').css('max-height', 300);
	        		$('#menu-access-data.modal .modal-body').css('overflow', 'none');
	        		$('#menu-access-data.modal .modal-body').css('overflow-y', 'auto');
	        	});
	        	
	        	$('#menu-access-data').modal('show');
	        	this.loadMenuData(data.DT_RowId);
	        },
	        loadMenuData: function(role_id) {
	        	Metronic.blockUI({ boxed: true });
	        	var url = site_url+'/user/roleGetMenu';
	        	$.post(
	        		url,
	        		{ 'role_id':  role_id},
	        		function( data ) {
	        			Metronic.unblockUI();
	        			$("#menu_tree_container").jstree("destroy");
	        			$('#menu_tree_container').jstree({
	        			    'plugins': ["wholerow", "checkbox"],
	        			    'core': {
	        			        "themes" : {
	        			            "responsive": false
	        			        },    
	        			        'data': data
	        			     }
	        			 });
	        		},
	        		"json"
	        	).fail(function() {
	        		Metronic.unblockUI();
	        		MainApp.viewGlobalModal('error', 'Error Getting Menu');
	        	 });
	        }
	 }
}();