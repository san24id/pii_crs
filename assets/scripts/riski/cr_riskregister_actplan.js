var gridControl = new Datatable();
gridControl.init({
    src: $("#library_control_table"),
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
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/risk/RiskRegister/getControlLibrary" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
        		var ret = '<div class="btn-group">'+
        		'<button type="button" class="btn btn-default btn-xs" onclick="javascript: ChangeRequest.selectControlLibrary('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
        		'</div>';
        		return ret;
        	}
        } ],
        "columns": [
			{ "data": "id", "orderable": false },
			{ "data": "risk_existing_control"},
			{ "data": "risk_evaluation_control" },
			{ "data": "risk_control_owner" }
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridControlobjective = new Datatable();
gridControlobjective.init({
    src: $("#library_objective_table"),
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
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/risk/RiskRegister/getControlLibraryobjective" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: ChangeRequest.selectControlLibraryobjective('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "objective"}
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});



var gridLibraryaction = new Datatable();
gridLibraryaction.init({
    src: $("#library_tableaction"),
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
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/risk/RiskRegister/getActionLibrary" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "action_plan",
        	"render": function ( data, type, full, meta ) {
        		var ret = '<div class="btn-group">'+
        		'<button type="button" class="btn btn-default btn-xs" onclick="javascript: ChangeRequest.selectLibraryaction('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
        		'</div>';
        		return ret;
        	}
        } ],
        "columns": [
			{ "data": "action_plan", "orderable": false },
			{ "data": "action_plan", "orderable": false } 
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});
var handleValidation = function() {
	// for more info visit the official plugin documentation: 
	// http://docs.jquery.com/Plugins/Validation
	
	var form1 = $('#input-form');
	//var error1 = $('.alert-danger', form1);
	//var success1 = $('.alert-success', form1);
	
	form1.validate({
	    errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: true, // do not focus the last invalid input
	    ignore: "",  // validate all fields including form hidden input
	    rules: {
	        risk_cause: {
	            minlength: 2,
	            required: true
	        },
	        risk_impact: {
	            minlength: 2,
	            required: true
	        },
	        risk_impact_level_value: {
	            required: true
	        },
	        risk_likelihood_value: {
	            required: true
	        },
	        risk_level: {
	            required: true
	        }
	    },
		errorPlacement: function (error, element) { // render error placement for each input type
            if (element.parent(".input-group").size() > 0) {
                error.insertAfter(element.parent(".input-group"));
            } else if (element.attr("data-error-container")) { 
                error.appendTo(element.attr("data-error-container"));
            } else if (element.parents('.radio-list').size() > 0) { 
                error.appendTo(element.parents('.radio-list').attr("data-error-container"));
            } else if (element.parents('.radio-inline').size() > 0) { 
                error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
            } else if (element.parents('.checkbox-list').size() > 0) {
                error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
            } else if (element.parents('.checkbox-inline').size() > 0) { 
                error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
            } else {
                error.insertAfter(element); // for other inputs, just perform default behavior
            }
        },
	    invalidHandler: function (event, validator) { //display error alert on form submit              
	        MainApp.viewGlobalModal('error', 'Mohon Isi Semua Kolom ');
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
	        console.log('validate submit');
	        return false;
	    }
	});
}

var handleValidationControl = function() {
	var form1 = $('#input-form-control');
	
	form1.validate({
	    errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: true, // do not focus the last invalid input
	    ignore: "",  // validate all fields including form hidden input
	    rules: {
	        risk_existing_control: {
	            required: true
	        },
	        risk_evaluation_control: {
	            required: true
	        },
	        risk_control_owner: {
	            required: true
	        }
	    },
	    invalidHandler: function (event, validator) { //display error alert on form submit              
	        MainApp.viewGlobalModal('error', 'Mohon Isi Semua Kolom ');
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

var gridControlExisting = new Datatable();
gridControlExisting.init({
    src: $("#library_control_table_existing"),
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
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/risk/RiskRegister/getControlLibraryexisting" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: ChangeRequest.selectControlLibraryexisting('+full.id +')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "existing_control"},
            { "data": "description" }
          
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});


var handleValidationAction = function() {
	// for more info visit the official plugin documentation: 
	// http://docs.jquery.com/Plugins/Validation
	
	var form1 = $('#input-form-action-plan');
	//var error1 = $('.alert-danger', form1);
	//var success1 = $('.alert-success', form1);
	
	form1.validate({
	    errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: true, // do not focus the last invalid input
	    ignore: "",  // validate all fields including form hidden input
	    rules: {
	        action_plan: {
	            required: true
	        },
	        due_date: {
	            required: true
	        },
	        division: {
	            required: true
	        }
	    },
		errorPlacement: function (error, element) { // render error placement for each input type
            if (element.parent(".input-group").size() > 0) {
                error.insertAfter(element.parent(".input-group"));
            } else if (element.attr("data-error-container")) { 
                error.appendTo(element.attr("data-error-container"));
            } else if (element.parents('.radio-list').size() > 0) { 
                error.appendTo(element.parents('.radio-list').attr("data-error-container"));
            } else if (element.parents('.radio-inline').size() > 0) { 
                error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
            } else if (element.parents('.checkbox-list').size() > 0) {
                error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
            } else if (element.parents('.checkbox-inline').size() > 0) { 
                error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
            } else {
                error.insertAfter(element); // for other inputs, just perform default behavior
            }
        },
	    invalidHandler: function (event, validator) { //display error alert on form submit              
	        MainApp.viewGlobalModal('error', 'Mohon Isi Semua Kolom ');
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

var ChangeRequest = function() {
	return {
		primarydataControl: {},
		primarydataActionPlan: {},
		primarydataControlCounter: 0,
		primarydataActionPlanCounter: 0,
		
		dataControl: {},
		dataActionPlan: {},
		dataControlCounter: 0,
		dataActionPlanCounter: 0,
		actionPlanChange : null,
		init: function() {
        	var me = this;
        	me.loadRiskPrimary(g_risk_id);
        	me.loadRisk(g_risk_id);
        	
        	if (jQuery().datepicker) {
	            $('.date-picker').datepicker({
	                rtl: Metronic.isRTL(),
	                orientation: "left",
	                autoclose: true,
	                todayHighlight: true
	            });
	            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	        };
	    	
	    	$('#modal-control-filter-submit').on('click', function() {
	    		me.filterControl();
	    	});
	    	
	    	$('#modal-control-filter-submit-objective').on('click', function() {
                me.filterControlobjective();
            });

	    	$('#btn_impact_list').on('click', function() {
	    		me.showImpactList();
	    	});
	    	
	    	$('#input-form-likelihood-button').on('click', function() {
	    		var sel = $('#form-likelihood input[name=risk_likelihood]:checked').val();
	    		var res = sel.split('|');
	    		
	    		$('#input-form input[name=risk_likelihood_id]').val(res[0]);
	    		$('#input-form input[name=risk_likelihood_value]').val(res[1]);
	    		
	    		$('#modal-likelihood').modal('hide');
	    		me.setRiskLevel();
	    	});
	    	
	    	$('#input-control-add').on('click', function() {
	    		var form1 = $('#input-form-control').validate();
	    		var fvalid = form1.form();
	    		
	    		if (fvalid) {
	    			var xcid = $('#input-form-control input[name=existing_control_id]').val();
	        		var xexis = $('#input-form-control input[name=risk_existing_control]').val();
	        		var xeval = $('#input-form-control input[name=risk_evaluation_control]').val();
	        		var xowner = $('#input-form-control select[name=risk_control_owner]').val();
					
					var tr_id = $('#tr_idnya').val();
					
					$("#"+tr_id).html("");
					 
	        		var nnode = {
	        			'existing_control_id' : xcid,
	        			'risk_existing_control' : xexis,
	        			'risk_evaluation_control' : xeval,
	        			'risk_control_owner' : xowner
	        		};
	
	        		me.controlAddRow(nnode);
	        		
	        		$('#form-control').modal('hide');
	    		}
	    	});

	    	$('#input-control-add-objective').on('click', function() {
                var form1 = $('#input-form-control-objective').validate();
                var fvalid = form1.form();
                 
                if (fvalid) {
                    var xcid = $('#input-form-control-objective input[name=objective_id]').val();
                    var xexis = $('#input-form-control-objective textarea[name=objective]').val();
                  
                    
                    var tr_id = $('#tr_idnya').val();
                    
                    $("#"+tr_id).html("");
                    $('#3').remove();
                    
                    var nnode = {
                        'tr_id' : tr_id,
                        'objective_id' : xcid,
                        'objective' : xexis,
                        
                    };
                    
                    me.controlAddRowobjective(nnode);
                    
                    $('#form-control-objective').modal('hide');
                }
            });
	    	
	    	$('#input-actionplan-add').on('click', function() {
	    		var form1 = $('#input-form-action-plan').validate();
	    		var fvalid = form1.form();
	    		
	    		if (fvalid) {
	    			var xplan = $('#input-form-action-plan input[name=action_plan]').val();
	    			var xdate = $('#input-form-action-plan input[name=due_date]').val();
	    			var xdiv_view = $('#input-form-action-plan select[name=division] option:selected').text();
	    			var xdiv_id = $('#input-form-action-plan select[name=division] option:selected').val();
	    			
	    			if (me.actionPlanChange != null) {
	    				var cf = 'CHANGE';
	    				if (me.actionPlanChange.id == null) {
	    					cf = 'ADD';
	    				}
	    				var nnode = {
	    					'id' : me.actionPlanChange.id,
	    					'risk_id' : me.actionPlanChange.risk_id,
	    					'change_flag' : cf,
	    					'data_flag': me.actionPlanChange.data_flag,
	    					'action_plan' : xplan,
	    					'due_date' : xdate,
	    					'division_v' : xdiv_view,
	    					'division' : xdiv_id
	    				};
	    				me.actionPlanEditRow(me.actionPlanChange, nnode);
	    			} else {
	    				var nnode = {
	    					'id' : null,
	    					'risk_id' : null,
	    					'change_flag' : 'ADD',
	    					'data_flag': null,
	    					'action_plan' : xplan,
	    					'due_date' : xdate,
	    					'division_v' : xdiv_view,
	    					'division' : xdiv_id
	    				};
	    				me.actionPlanAddRow(nnode);
	    			}

	    			$('#form-data').modal('hide');
	    		}
	    	});
	    	
	    	$('#input-form-impact-button').on('click', function() {
	    		var imp = {
	    			'NA': 0, 'INSIGNIFICANT':1, 'MINOR':2,  
	    			'MODERATE': 3, 'MAJOR' : 4, 'CATASTROPHIC': 5
	    		};
	    		
	    		var all_na = true;
	    		var max_idx = 0;
	    		var max_val = 'NA';
	    		
	    		me.dataRiskImpact = {};
	    		
	    		var sel = $('#form-impact input[type=radio]:checked');
	    		$.each(sel, function(idx, cmp) {
	    			var val = $(cmp).val();
	    			var name = $(cmp).attr('name');
	    			if (val != 'NA') {
	    				all_na = false;
	    			}
	    			if (imp[val] > max_idx) {
	    				max_idx = imp[val];
	    				max_val = val;
	    			}
	    			me.dataRiskImpact[name] = val;
	    		});
	    		
	    		if (all_na) {
	    			MainApp.viewGlobalModal('error', 'Tidak dapat mengatur semua Not Available (N / A) pada Dampak Resiko');
	    		} else {
	    			var xv = me.impactLevelReference[max_val];
	    			$('#input-form input[name=risk_impact_level_id]').val(max_val);
	    			$('#input-form input[name=risk_impact_level_value]').val(xv);
	    			
	    			$('#modal-impact').modal('hide');
	    			me.setRiskLevel();
	    		}
	    	});
        	
        	$('#button-form-control-open').on('click', function () {
        		$('#input-form-control')[0].reset();
        		$('#input-form-control textarea[name=risk_existing_control]').attr('readonly', false);
        	});
        	
        	$('#button-form-data-open').on('click', function () {
        		$('#input-form-action-plan')[0].reset();
        		me.actionPlanChange = null;
        	});
        	
        	$("#action_plan_table").on('click', 'button.button-grid-edit', function(e) {
        		var xid = $(this).attr('data-id');
        		var tr_par = $(this)[0];
        		
        		$('#input-form-action-plan')[0].reset();
        		$('#form-data').modal('show');
        		
        		var edData = me.dataActionPlan[xid];
        		
        		me.actionPlanChange = {
        			'rowid': xid,
        			'id' : edData.id,
        			'risk_id' : edData.risk_id,
        			'change_flag' : edData.change_flag,
        			'data_flag': edData.data_flag
        		};
        		
        		$('#input-form-action-plan input[name=action_plan]').val(edData.action_plan);
        		$('#input-form-action-plan input[name=due_date]').val(edData.due_date);
        		$('#input-form-action-plan select[name=division]').val(edData.division);

        	});
        	
        	$("#action_plan_table").on('click', 'button.button-grid-delete', function(e) {
        		var xid = $(this).attr('data-id');
        		var tr_par = $(this)[0]; //.parentNode.parentNode.parentNode;
        		
        		var mod = MainApp.viewGlobalModal('confirm', 'Delete Action Plan ?');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			mod.modal('hide');
        			me.actionPlanTableDelete(tr_par, xid);
        			//console.log('Delete', xid);
        		});
        	});
        	
        	$('#risk-button-submit').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin Kirim Permintaan Perubahan Anda?');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData();
        		});
        	});
        	
        	$('#verify-risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Apakah Anda yakin ingin membatalkan Permintaan Perubahan Anda? Anda akan kehilangan data yang belum disimpan.');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main';
        		});
        	});
        	
        	me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
        	
        	handleValidation();
        	handleValidationControl();
        	handleValidationAction();
        	
        },
        loadRiskLevelList: function() {
        	var me = this;
        	$.getJSON( site_url+"/risk/RiskRegister/getRiskLevelList", function( data ) {
        		me.riskLevelList = data;
        	});
        },
        loadRiskLevelReference: function() {
        	var me = this;
        	$.getJSON( site_url+"/risk/RiskRegister/getRiskLevelReference", function( data ) {
        		me.riskLevelReference = data;
        	});
        },
        loadImpactLevelReference: function() {
        	var me = this;
        	$.getJSON( site_url+"/risk/RiskRegister/getImpactLevelReference", function( data ) {
        		me.impactLevelReference = data;
        	});
        },
        getRiskLevel: function(impact, likelihood) {
        	var me = this;
        	if (me.riskLevelList != null) {
        		var xk = impact+'-'+likelihood;
        		return me.riskLevelList[xk];
        	} else {
        		return false;
        	}
        },
        setRiskLevel: function() {
        	var iv = $('#input-form input[name=risk_impact_level_id]').val();
        	var lv = $('#input-form input[name=risk_likelihood_id]').val();
        	//console.log(iv, lv);
        	var xv = iv+"-"+lv;
        	if (this.riskLevelList[xv] != undefined) {
        		var vv = this.riskLevelReference[this.riskLevelList[xv]];
        		$('#input-form input[name=risk_level_id]').val(this.riskLevelList[xv]);
        		$('#input-form input[name=risk_level]').val(vv);
        	}
        },
        setRiskImpact: function(data) {
        	this.dataRiskImpact = data;
        },
        showImpactList: function() {
        	$('#modal-impact').on('shown.bs.modal', function () {
        		$('#modal-impact.modal .modal-body').css('max-height', 400);
        		$('#modal-impact.modal .modal-body').css('overflow', 'none');
        		$('#modal-impact.modal .modal-body').css('overflow-y', 'auto');
        	});
        	
        	$('#modal-impact').modal('show');
        },
        selectControlLibrary: function(rid) {
        	var me = this;
        	$('#input-form-control textarea[name=risk_existing_control]').attr('readonly', true);
        	
        	$('#modal-control').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadControlLibrary/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['existing_control_id'] = data_risk['id'];
        		
        		me.populateRisk($('#input-form-control'), data_risk);
        	});
        },
        selectControlLibraryobjective: function(rid) {
            var me = this;
            $('#input-form-control-objective textarea[name=objective]').attr('readonly', false);
            
            $('#modal-objective').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibraryobjective/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['objective_id'] = data_risk['id'];
                
                me.populateRisk($('#input-form-control-objective'), data_risk);
            });
        },
        selectLibraryaction: function(rid) {
        	var me = this;
			  
        	$('#modal-libraryaction').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadactionLibrary/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['action_plan'] = data_risk['action_plan'];
        		
        		me.populateRisk($('#input-form-action-plan'), data_risk);
        	});
         
        },
         selectControlLibraryexisting: function(rid) {
            var me = this;
            $('#input-form-control input[name=risk_existing_control]').attr('readonly', true);
            
            $('#modal-control-existing').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibraryexisting/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['risk_existing_control'] = data_risk['existing_control'];
                
                me.populateRisk($('#input-form-control'), data_risk);
            });
        },
        filterControl: function() {
        	var fval = $('#modal-control div.inputs input[name=filter_search]')[0].value;
        	gridControl.clearAjaxParams();
        	gridControl.setAjaxParam("filter_library", fval);
        	gridControl.getDataTable().ajax.reload();	
        },
        filterControlobjective: function() {
            var fval = $('#modal-objective div.inputs input[name=filter_search]')[0].value;
            gridControlobjective.clearAjaxParams();
            gridControlobjective.setAjaxParam("filter_library", fval);
            gridControlobjective.getDataTable().ajax.reload();   
        },
        loadRiskPrimary: function(rid) {
        	var me = this;
        	
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+'/risk/RiskRegister/loadRiskLibrary_actplan/'+rid+'/'+g_act_id, function( data_risk ) {
        		Metronic.unblockUI();
        		g_username = data_risk['risk_input_by'];
        		data_risk['risk_library_id'] = data_risk['risk_library_id'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#primary-input-form'), data_risk);
        		$('#primary-risk_submitted_by').val(data_risk.risk_input_by_v);
        		$('#primary-risk_submitted_division').val(data_risk.risk_input_division_v);
        		
        		me.primaryactionPlanReset();
        		$.each( data_risk['action_plan_list'], function( key, val ) {
        			var nnode = {
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division
        			}
        			me.primaryactionPlanAddRow(nnode);
        		});
        		
        		me.primarycontrolReset();
        		$.each( data_risk['control_list'], function( key, val ) {
        			var ecid = '';
        			if (val.existing_control_id == null) ecid = '';
        			var nnode = {
        				'existing_control_id' : ecid,
        				'risk_existing_control' : val.risk_existing_control,
        				'risk_evaluation_control' : val.risk_evaluation_control,
        				'risk_control_owner' : val.risk_control_owner
        			};
        			
        			me.primarycontrolAddRow(nnode);
        		});

        		me.controlResetobjectiveprimary();
        		$.each( data_risk['objective_list'], function( key, val ) {
        			var ecid = '';
        			if (val.objective_id == null) ecid = '';
        			var nnode = {
        				'objective_id' : ecid,
        				'objective' : val.objective
        			};
        			
        			me.controlAddRowobjectiveprimary(nnode);
        		});

        	});
        },
        populateRisk: function(frm, data) {   
            $.each(data, function(key, value){  
            	var $ctrl = $('[name='+key+']', frm);  
                switch($ctrl.attr("type"))  
                {  
                    case "text" :   
                    case "hidden":  
                    case "textarea":
                    	$ctrl.val(value);   
                    	break;   
                    case "radio" : case "checkbox":   
                    $ctrl.each(function(){
                       if($(this).attr('value') == value) {  $(this).prop("checked",true); } });   
                    break;  
                    default:
                    $ctrl.val(value); 
                }  
            });  
        },
        // PRIMARY
        primarycontrolTableDelete: function(xrow, dataId) {
        	//console.log(dataId);
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('primary_control_table').deleteRow(i);
        	this.primarycontrolDelete(dataId);
        },
        primarycontrolReset: function() {
        	this.primarydataControl = {};
        	this.primarydataControlCounter = 0;
        	$("#primary_control_table > tbody").html("");
        },
        primarycontrolAdd: function(data, dcounter) {
        	this.primarydataControl[dcounter] = data;
        },
        primarycontrolDelete: function(id) {
        	delete this.primarydataControl[id];
        },
        primarycontrolAddRow: function(nnode) {
        	var me = this;
        	
        	me.primarydataControlCounter++;

        	$('#primary_control_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.existing_control_id+'</td>'+
        		'<td>'+nnode.risk_existing_control+'</td>'+
        		'<td>'+nnode.risk_evaluation_control+'</td>'+
        		'<td>'+nnode.risk_control_owner+'</td>'+
        	'</tr>');
        	me.primarycontrolAdd(nnode, me.primarydataControlCounter);
        },
        primaryactionPlanTableDelete: function(xrow, dataId) {
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('primary_action_plan_table').deleteRow(i);
        	this.primaryactionPlanDelete(dataId);
        },
        primaryactionPlanReset: function() {
        	this.primarydataActionPlanCounter = 0;
        	this.primarydataActionPlan = {};
        	$("#primary_action_plan_table > tbody").html("");
        },
        primaryactionPlanAdd: function(data, dcounter) {
        	this.primarydataActionPlan[dcounter] = data;
        },
        primaryactionPlanDelete: function(id) {
        	delete this.primarydataActionPlan[id];
        },
        primaryactionPlanAddRow: function(nnode) {
        	var me = this;
        	
        	me.primarydataActionPlanCounter++;
        	
        	$('#primary_action_plan_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        	'</tr>');
        	
        	me.primaryactionPlanAdd(nnode, me.primarydataActionPlanCounter);
        },
        // CHANGES
        controlTableDelete: function(xrow, dataId) {
        	//console.log(dataId);
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('control_table').deleteRow(i);
        	this.controlDelete(dataId);
        },
        // CHANGES
        controlTableDeleteobjective: function(xrow, dataId) {
        	//console.log(dataId);
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('objective_table').deleteRow(i);
        	this.controlDeleteobjective(dataId);
        },
        controlReset: function() {
        	this.dataControl = {};
        	this.dataControlCounter = 0;
        	$("#control_table > tbody").html("");
        },
        controlAdd: function(data, dcounter) {
        	this.dataControl[dcounter] = data;
        },
        controlDelete: function(id) {
        	delete this.dataControl[id];
        },
        controlDeleteobjective: function(id) {
        	delete this.dataControlobjective[id];
        },
        controlAddRow: function(nnode) {
        	var me = this;
        	
        	me.dataControlCounter++;
        	
			var control_str = '';
			if (g_change_type == "Risk Form") {
				control_str = '<td>'+
				'<div class="btn-group">'+
					'<button type="button" class="btn btn-default btn-xs" onclick = "modal_control_edit('+me.dataControlCounter+')" ><i class="fa fa-pencil font-blue"></i></button>'+
					'<button type="button" class="btn btn-default btn-xs" onclick="ChangeRequest.controlTableDelete(this, '+me.dataControlCounter+')"><i class="fa fa-trash-o font-red"></i></button>'+
				 '</div>'+
				'</td>';
			}
			
        	$('#control_table > tbody:last-child').append('<tr id = '+me.dataControlCounter+'>'+
        		'<td><input type = "hidden" id = "existing_control_id'+me.dataControlCounter+'" value = "'+nnode.existing_control_id+'">'+nnode.existing_control_id+'</td>'+
        		'<td><input type = "hidden" id = "risk_existing_control'+me.dataControlCounter+'" value = "'+nnode.risk_existing_control+'">'+nnode.risk_existing_control+'</td>'+
        		'<td><input type = "hidden" id = "risk_evaluation_control'+me.dataControlCounter+'" value = "'+nnode.risk_evaluation_control+'">'+nnode.risk_evaluation_control+'</td>'+
        		'<td><input type = "hidden" id = "risk_control_owner'+me.dataControlCounter+'" value = "'+nnode.risk_control_owner+'">'+nnode.risk_control_owner+'</td>'+
        		control_str+
        	'</tr>');
			
			
        	me.controlAdd(nnode, me.dataControlCounter);
        },
        controlResetobjective: function() {
        	this.dataControlobjective = {};
        	this.dataControlCounter = 0;
        	$("#objective_table > tbody").html("");
        },
        controlAddobjective: function(data, dcounter) {
        	this.dataControlobjective[dcounter] = data;
        },
        controlAddRowobjective: function(nnode) {
        	var me = this;
        	
        	me.dataControlCounter++;
        	
			var control_str = '';
			if (g_change_type == "Risk Form") {
				control_str = '<td>'+
				'<div class="btn-group">'+
					'<button type="button" class="btn btn-default btn-xs" onclick="ChangeRequest.controlTableDeleteobjective(this, '+me.dataControlCounter+')"><i class="fa fa-trash-o font-red"></i></button>'+
				'</div>'+
				'</td>';
			}
			
        	$('#objective_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.objective_id+'</td>'+
        		'<td>'+nnode.objective+'</td>'+
        		control_str+
        	'</tr>');
        	me.controlAddobjective(nnode, me.dataControlCounter);
        },
        controlResetobjectiveprimary: function() {
        	this.dataControlobjectiveprimary = {};
        	this.dataControlCounter = 0;
        	$("#primary_objective_table > tbody").html("");
        },
        controlAddobjectiveprimary: function(data, dcounter) {
        	this.dataControlobjectiveprimary[dcounter] = data;
        },
        controlAddRowobjectiveprimary: function(nnode) {
        	var me = this;
        	
        	me.dataControlCounter++;
        	
			var control_str = '';
			if (g_change_type == "Risk Form") {
				control_str = '<td></td>';
			}
			
        	$('#primary_objective_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.objective_id+'</td>'+
        		'<td>'+nnode.objective+'</td>'+
        		
        	'</tr>');
        	me.controlAddobjectiveprimary(nnode, me.dataControlCounter);
        },
        actionPlanTableDelete: function(xrow, dataId) {
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('action_plan_table').deleteRow(i);
        	this.actionPlanDelete(dataId);
        },
        actionPlanReset: function() {
        	this.dataActionPlanCounter = 0;
        	this.dataActionPlan = {};
        	$("#action_plan_table > tbody").html("");
        },
        actionPlanAdd: function(data, dcounter) {
        	this.dataActionPlan[dcounter] = data;
        },
        actionPlanDelete: function(id) {
        	this.dataActionPlan[id].change_flag = 'DELETE';
        	//delete this.dataActionPlan[id];
        },
        actionPlanAddRow: function(nnode) {
        	var me = this;

        	me.dataActionPlanCounter++;
        	
        	var del_btn = '<button type="button" class="btn btn-default btn-xs button-grid-delete" data-id="'+me.dataActionPlanCounter+'"><i class="fa fa-trash-o font-red"> Delete </i></button>';
        	if (g_change_type == "Action Plan Form") {
        		del_btn = '';
        	}
        	
        	var act_str = '<div class="btn-group">'+
        		'<button type="button" class="btn btn-default btn-xs button-grid-edit" data-id="'+me.dataActionPlanCounter+'"><i class="fa fa-pencil font-blue">  Edit </i></button>'+
        		del_btn+
        	'</div>';
        	if (nnode.data_flag == 'LOCKED') {
        		act_str = 'ASSIGNED';
        	}
        	
        	$('#action_plan_table > tbody:last-child').append('<tr data-id="'+me.dataActionPlanCounter+'">'+
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        		'<td>'+
        		act_str+
        		'</td>'+
        	'</tr>');
        	
        	me.actionPlanAdd(nnode, me.dataActionPlanCounter);
        },
        actionPlanEditRow: function(tdata, nnode) {
        	var me = this;
        	var xid = tdata.rowid;
        	
        	var del_btn = '<button type="button" class="btn btn-default btn-xs button-grid-delete" data-id="'+xid+'"><i class="fa fa-trash-o font-red"> Delete </i></button>';
        	if (g_change_type == "Action Plan Form") {
        		del_btn = '';
        	}
        	
        	var act_str = '<div class="btn-group">'+
        		'<button type="button" class="btn btn-default btn-xs button-grid-edit" data-id="'+xid+'"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
        		del_btn+
        	'</div>';
        	
        	$('#action_plan_table > tbody > tr[data-id='+xid+']').find("td").remove();
        	
        	$('#action_plan_table > tbody > tr[data-id='+xid+']').append(
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        		'<td>'+
        		act_str+
        		'</td>'
        	);
        	//$('#action_plan_table > tbody > tr[data-id='+xid+']').
        	/*
        	$('#action_plan_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        		'<td>'+
        		act_str+
        		'</td>'+
        	'</tr>');
        	*/
        	me.actionPlanEdit(tdata.rowid, nnode);
        },
        actionPlanEdit: function(rid, nnode) {
        	this.dataActionPlan[rid] = nnode;
        },
        loadRisk: function(rid) {
        	var me = this;
        	
        	var xfar = rid;
        	if (g_act_id) xfar = rid+'/'+g_act_id;
        	
        	$('#modal-library').modal('hide');
        	Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+'/risk/RiskRegister/loadRiskLibrary_actplan/'+rid+'/'+g_act_id, function( data_risk ) {
        	//$.getJSON( site_url+"/risk/RiskRegister/loadRiskForChange2/"+xfar, function( data_risk ) {
        		Metronic.unblockUI();
        		g_username = data_risk['risk_input_by'];
        		data_risk['risk_library_id'] = data_risk['risk_library_id'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#input-form'), data_risk);
        		$('#risk_submitted_by').val(data_risk.risk_input_by_v);
        		$('#risk_submitted_division').val(data_risk.risk_input_division_v);
        		
        		$('#form-likelihood').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        		$('#form-likelihood input:radio[name=risk_likelihood]').each(function(){
        			if($(this).attr('value') == data_risk['risk_likelihood_key']+'|'+data_risk['risk_likelihood_value']) {  
        				$(this).prop('checked', true).click();
        			}
        		});
        		
        		me.dataRiskImpact = {};
        		//$('#form-impact').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        		$.each( data_risk['impact_list'], function( key, val ) {
        			var gid = val.impact_id;
        			$('#form-impact input:radio[name=impactlevel_'+gid+']').each(function(){
        				if($(this).attr('value') == val.impact_level) {  
        					$(this).prop('checked', true).click();
        					me.dataRiskImpact[$(this).attr('name')] = val.impact_level;
        				}
        			});
        		});
        		
        		me.actionPlanReset();
        		$.each( data_risk['action_plan_list'], function( key, val ) {
        			var nnode = {
        				'id' : val.id,
        				'risk_id' : val.risk_id,
        				'change_flag' : val.change_flag,
        				'data_flag' : val.data_flag,
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division
        			}
        			me.actionPlanAddRow(nnode);
        		});
        		
        		me.controlReset();
        		$.each( data_risk['control_list'], function( key, val ) {
        			var ecid = '';
        			if (val.existing_control_id == null) ecid = '';
        			var nnode = {
        				'existing_control_id' : ecid,
        				'risk_existing_control' : val.risk_existing_control,
        				'risk_evaluation_control' : val.risk_evaluation_control,
        				'risk_control_owner' : val.risk_control_owner
        			};
        			
        			me.controlAddRow(nnode);
        		});

        		me.controlResetobjective();
        		$.each( data_risk['objective_list'], function( key, val ) {
        			var ecid = '';
        			if (val.objective_id == null) ecid = '';
        			var nnode = {
        				'objective_id' : ecid,
        				'objective' : val.objective
        			};
        			
        			me.controlAddRowobjective(nnode);
        		});

        	});
        },
        submitRiskData: function() {
        	var form1 = $('#input-form').validate();
        	var fvalid = form1.form();
        	if (fvalid) {
            	var me = this;

            	// prepare impact data
            	var impact_param = {};
            	var cnt = 0;
            	$.each(me.dataRiskImpact, function(key, value) { 
            		var ar = key.split('_', 2);
            		impact_param['impact['+cnt+'][impact_id]'] = ar[1];
            		impact_param['impact['+cnt+'][impact_level]'] = value;
            		cnt++;
            	});
            	//console.log(impact_param);
            	
            	// prepare control data
            	var control_param = {};
            	var cnt = 0;
            	$.each(me.dataControl, function(key, value) { 
            		control_param['control['+cnt+'][existing_control_id]'] = value.existing_control_id;
            		control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
            		control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
            		control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
            		cnt++;
            	});
            	
            	if (cnt < 1) {
            		MainApp.viewGlobalModal('error', 'Tolong masukan setidaknya satu kontrol untuk risiko ini');
            		return false;
            	}

            	// prepare objective data
            	var objective_param = {};
            	var cnt = 0;
            	$.each(me.dataControlobjective, function(key, value) { 
            		objective_param['objective['+cnt+'][objective_id]'] = value.objective_id;
            		objective_param['objective['+cnt+'][objective]'] = value.objective;
            		cnt++;
            	});
            	
            	if (cnt < 1) {
            		MainApp.viewGlobalModal('error', 'Tolong masukan setidaknya satu tujuan untuk Risiko ini');
            		return false;
            	}
            	
            	// prepare action plan data
            	var actplan_param = {};
            	var cnt = 0;
            	$.each(me.dataActionPlan, function(key, value) { 
            		actplan_param['actplan['+cnt+'][id]'] = value.id;
            		actplan_param['actplan['+cnt+'][risk_id]'] = value.risk_id;
            		actplan_param['actplan['+cnt+'][change_flag]'] = value.change_flag;
            		actplan_param['actplan['+cnt+'][data_flag]'] = value.data_flag;
            		actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
            		actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
            		actplan_param['actplan['+cnt+'][division]'] = value.division;
            		cnt++;
            	});
            	//console.log(impact_param);
            	
            	if (cnt < 1) {
            		MainApp.viewGlobalModal('error', 'Mohon masukan setidaknya satu Action Plan untuk risiko ini');
            		return false;
            	}
            	
            	Metronic.blockUI({ boxed: true });
            	var url = site_url+'/risk/RiskRegister/submitChangeRisk/'+g_time_compare;

            	$.post(
            		url,
            		$( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param)+ '&' + $.param(objective_param),
            		function( data ) {
            			Metronic.unblockUI();
            			if(data.success) {
            				var mod = MainApp.viewGlobalModal('success', 'Sukses Mengirimkan Permintaan Perubahan');
            				mod.find('button.btn-ok-success').one('click', function(){
            					location.href=site_url+'/main#tab_change_request_list';
            				});
            				
            			} else {
            				
            				//ubah
            				var mod = MainApp.viewGlobalModal('warning-maintenance', 'Risiko ini Sedang dalam Pemeliharaan oleh RAC Anda tidak dapat mengubah risiko ini sampai proses selesai');
            				mod.find('button.btn-ok-success').one('click', function(){
            					location.href=site_url+'/main';
            				});
            			}
            			
            		},
            		"json"
            	).fail(function() {
            		Metronic.unblockUI();
            		MainApp.viewGlobalModal('error', 'Kesalahan Mengirimkan Data');
            	 });
            }
        }
	 }
}();

function modal_control_edit(a){
	 
$('#tr_idnya').val(a); 
$('#existing_control_id').val($('#existing_control_id'+a).val());
$('#risk_existing_control').val($('#risk_existing_control'+a).val());
$('#risk_evaluation_control').val($('#risk_evaluation_control'+a).val());
$('#risk_control_owner').select($('#risk_control_owner'+a).val());
$('#form-control-revid').val(a);

$('#form-control').modal('show'); 
}