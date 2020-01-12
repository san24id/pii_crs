var grid = new Datatable();
$('#sts').hide();

$('#filterFormBy').change(function(){
    var frmval = $('#filterFormBy').val();
     if(frmval == 'a.status'){
     	$('#sts').show();
     	$('#filterFormValue').hide();
     }else{
     	$('#sts').hide();
     	$('#filterFormValue').show();
     	$('#filterFormValue').val('');
     }
});

$('#inputsts').change(function(){
     	s = $('#inputsts').val();
     	$('#filterFormValue').val(s);

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
            "url": site_url+"/admin/report/reportGetData" // ajax source
        },
        "columns": [
           { "data": "GenRowNum" },
           { "data": "title" },
           { "data": "filename" },
           { "data": "created_date_v" },
           { "data": "created_by_v" },
           { "data": "date_publish_v" },
           { "data": "status_v" },
           { 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
           		'</div>'
           }
       ],
       "columnDefs": [ {
       	"targets": 1,
       	"data": "title",
       	"render": function ( data, type, full, meta ) {
       		var ret = '<a target="_self" href="'+site_url+'/admin/news/newsView/'+full.id+'">'+data+'</a>';
       		return ret;
       	}
       } ],
        "order": [
            [3, "desc"]
        ]// set first column as a default sort by asc
    }
});

var report = function() {
	return {
			reportMode: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;
	        		            
	            // datatables filter button
	            $("#filterFormSubmit").click(function() {
	            	var fby = $("#filterFormBy").val();
	            	var fval = $("#filterFormValue").val();
	            	
	            	me.filterDataGrid(fby, fval);
	            });

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
	            	var report = grid.getDataTable().row(r).report();
	            	
	            	location.href=site_url+'/admin/report/reportEdit/'+report.id;
	            });
	            
	            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var report = grid.getDataTable().row(r).report();
	            	
	            	me.deletedata(report);
	            });
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        deletedata: function(report) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this report ?');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		
	        		Metronic.blockUI({ boxed: true });
	        		var url = site_url+'/admin/report/reportdeletedata';
	        		$.post(
	        			url,
	        			{ 'id':  report.DT_RowId},
	        			function( report ) {
	        				Metronic.unblockUI();
	        				if(report.success) {
	        					grid.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete report');
	        				} else {
	        					MainApp.viewGlobalModal('error', report.msg);
	        				}
	        				
	        			},
	        			"json"
	        		).fail(function() {
	        			Metronic.unblockUI();
	        			MainApp.viewGlobalModal('error', 'Error Submitting report');
	        		 });
	        	});
	        }
	 }
}();