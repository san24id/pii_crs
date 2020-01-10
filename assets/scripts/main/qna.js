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
            "url": site_url+"/main/qna/qnaGetData" // ajax source
        },
        "columns": [
           { "data": "qna_code" },
           { "data": "created_date_v" },
           { "data": "subject" },
           { "data": "qna_status" }
       ],
       "columnDefs": [{
       	"targets": 0,
       	"data": "qna_code",
       	"render": function ( data, type, full, meta ) {
       		var cls = 'font-green btn-open-question';
       		return '<a class="'+cls+'" href="javascript:;">'+data+'</a>';
       	}
       } ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var handleValidation = function() {
	var form1 = $('#input-form');
	
	form1.validate({
	    errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: true, // do not focus the last invalid input
	    ignore: "",  // validate all fields including form hidden input
	    rules: {
	        subject: {
	            required: true
	        },
	        question: {
	            required: true
	        }
	    },
	    invalidHandler: function (event, validator) { //display error alert on form submit              
	        MainApp.viewGlobalModal('error', 'Please Fill All Mandatory Field');
	    },
	
	    highlight: function (element) { // hightlight error inputs
	        $(element)
	            .closest('.form-group').addClass('has-error'); // set error class to the control group
	    },
	
	    unhighlight: function (element) { // revert the change done by hightlight
	        $(element)
	            .closest('.form-group').removeClass('has-error'); // set error class to the control group
	    },
	
	    success: function (label) {
	        label
	            .closest('.form-group').removeClass('has-error'); // set success class to the control group
	    },
	
	    submitHandler: function (form) {
	        return false;
	    }
	});
}

var Qna = function() {
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
	            
	            $('#btn-open-form').on('click', function() {
	            	me.showInputForm();
	            });
	            
	            
	            $('#input-form-submit-button').click(function(e) {
	            	var form1 = $('#input-form').validate();
	            	var fvalid = form1.form();
	            	
	            	if (fvalid) {
	            		e.preventDefault();
	            		var l = Ladda.create(this);
	            		l.start();
	            		
	            		if (me.dataMode == 'add') {
	            			var url = site_url+'/main/qna/submitQuestion';
	            			var tx = 'Insert';
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
	            	}
	            });
	            
	            // datatables filter button
	            $("#filterFormSubmit").click(function(e) {
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
	            
	            $("#datatable_ajax").on('click', 'a.btn-open-question', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	me.showQuestion(data);
	            });
	            
	            
	            handleValidation();
	        },
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        showInputForm: function() {
	        	$('#input-form')[0].reset();
	        	$('#form-data').find('h4.modal-title').html('Submit Question');
	        	$('#form-data').find('div.fg-answer').hide();
	        	$('#form-data').find('input[name=subject]').attr('readonly', false);
	        	$('#form-data').find('textarea[name=question]').attr('readonly', false)
	        	var vdate = $.datepicker.formatDate('dd-mm-yy', new Date());
	        	
	        	$('#form-data').find('input[name=var_date]').val(vdate);
	        	$('#input-form-submit-button').show();
	        	
	        	$('#form-data').modal('show');
	        	this.dataMode = 'add';
	        },
	        showQuestion: function(data) {
	        	$('#input-form')[0].reset();
	        	$('#form-data').find('h4.modal-title').html('View Question');
	        	$('#form-data').find('div.fg-answer').hide();
	        	
	        	$('#form-data').find('input[name=subject]').attr('readonly', true).val(data.subject);
	        	$('#form-data').find('textarea[name=question]').attr('readonly', true).val(data.question);
	        	$('#form-data').find('input[name=var_date]').val(data.created_date_v);
				
	        	if (data.status == '1') {
	        		$('#form-data').find('div.fg-answer').show();
	        		$('#form-data').find('textarea[name=answer]').val(data.answer);
	        	}
	        	$('#input-form-submit-button').hide();
	        	$('#form-data').modal('show');
	        	this.dataMode = 'view';
	        }
	        /*,
	        editData: function(data) {
	        	$('#input-form')[0].reset();
	        	$('#input-form').find("input[name='periode_id']").val(data.periode_id);
	        	$('#input-form').find("input[name='periode_name']").val(data.periode_name);
	        	$('#input-form').find("input[name='periode_start']").val(data.periode_start_v);
	        	$('#input-form').find("input[name='periode_end']").val(data.periode_end_v);
	        	
	        	$('#form-data').find('h4.modal-title').html('Edit Periode');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'edit';
	        	
	        },
	        deleteData: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data ?');
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
	        */
	 }
}();