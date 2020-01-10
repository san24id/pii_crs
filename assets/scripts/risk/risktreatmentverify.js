 $('#kcc').hide();
 $("#checked").hide();


$('#suggested_rt').change(function(){
 var suggested_rt =  $('#suggested_rt').val();
   if(suggested_rt == 'ACCEPT'){
         $('#action_plan_form').hide();
         $('#btnaction').hide();
         $('.btnactionc').hide();
   }else{
        $('#action_plan_form').show();
        $('#btnaction').show();
        $('.btnactionc').show();
   }

});


 var sgrt2 =  $('#sgrt2').val();
if(sgrt2 == 'ACCEPT'){
    $('.btnactionc').hide();
}else{
    $('.btnactionc').show();
}

 var sgrt =  $('#sgrt').val();
if(sgrt == 'ACCEPT'){
    $('#btnaction').hide();
}else{
    $('#btnaction').show();
}

function Check(){
     $('#due_date').val('00-00-0000');
     $('#fdate').hide();
     $('#ckc').hide();
     $('#kcc').show();
    $("#checked").show();
}

function Chckd(){
    $('#due_date').val('');
     $('#fdate').show();
     $('#ckc').show();
     $('#kcc').hide();
     $("#checked").hide();
}

$('#risk_control_owner').change(function(){
    var datacon = $("option:selected", this).attr('data-control');
    var control_owner = $('#control_owner').val();
    $("input[name='control_owner']").attr('value',datacon);
});

$('#division').change(function(){
    var dataap = $("option:selected", this).attr('data-action');
    var action_owner = $('#division_v').val();
    $("input[name='division_v']").attr('value', dataap);
});

var handleValidationObjective = function() {
    var form1 = $('#input-form-control-objective');
    
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {
            objective: {
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
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskVerify.selectControlLibraryobjective('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "objective"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

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
        		'<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskVerify.selectControlLibrary('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
        		'</div>';
        		return ret;
        	}
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "risk_existing_control"},
            { "data": "risk_evaluation_control" },
            { "data": "control_owner" }
       ],
        "order": [
            [1, "asc"]
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
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskVerify.selectLibraryaction('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        },
        {
            "targets": 2,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        }],
        "columns": [
            { "data": "action_plan", "orderable": false },
            { "data": "action_plan", "orderable": true },
            {"data": "due_date_v"},
            {"data": "division_v"} 
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridReviewaction = new Datatable();
gridReviewaction.init({
    src: $("#review_tableaction"),
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
            "url": site_url+"/main/Mainrac/getActionreview/"+g_risk_id // ajax source
        },
        "columnDefs": [ 
        {
            "targets": 1,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        }, {
            "targets": 2,
            "data": "apdue",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        },{
            "targets": 3,
            "data": "exdue",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        }],
        "columns": [
            { "data": "action_plan", "orderable": true },
            {"data": "due_date_v"},
            {"data": "apdue"},
            {"data": "exdue"},
            {"data": "division_v"} 
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

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
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskVerify.selectControlLibraryexisting('+full.id +')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "evaluation_control"},
            { "data": "description" }
          
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});
var RiskVerify = function() {
	return {
		dataControl: {},
		dataActionPlan: {},
		dataRiskImpact: {},
        dataControlobjective: {},
        dataControlCounterobjective: 0,
		dataControlCounter: 0,
		dataActionPlanCounter: 0,
		riskLevelList: null,
		riskLevelReference: null,
		impactLevelReference: null,
		init: function() {
        	var me = this;
        	
        	me.loadRisk(g_risk_id,risk_input_by);
        	me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
            handleValidationObjective();
            handleValidationControl();
            handleValidationAction();
        	
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
                    var xcid = $('#input-form-control input[name=control_id]').val();
                    var xeid = $('#input-form-control input[name=ec_id]').val();
                    var xexis = $('#input-form-control textarea[name=risk_existing_control]').val();
                    var xeval = $('#input-form-control input[name=risk_evaluation_control]').val();
                    var xowner = $('#input-form-control select[name=risk_control_owner]').val();
                    var xdiv = $('#input-form-control input[name=control_owner]').val();
                    
                    var tr_id = $('#form-control-revid').val();
                    
                    $("#tr_c"+tr_id).html("");
                     
                    var nnode = {
                        'tr_id' : tr_id,
                        'control_id' : xcid,
                        'ec_id' : xeid,
                        'risk_evaluation_control' : xeval,
                        'risk_existing_control' : xexis,
                        'risk_control_owner' : xowner,
                        'control_owner' : xdiv
                    };
                    
                    me.controlAddRow(nnode);
                    
                    $('#form-control').modal('hide');
                    $('#form-control-2').modal('hide');
                }
            });

            $('#input-control-add-objective').on('click', function() {
                var form1 = $('#input-form-control-objective').validate();
                var fvalid = form1.form();
                 
                if (fvalid) {
                    var xcid = $('#input-form-control-objective input[name=objective_id]').val();
                    var xcobjid = $('#input-form-control-objective input[name=objid]').val();
                    var xexis = $('#input-form-control-objective textarea[name=objective]').val();
                  
                    
                    var tr_idob = $('#form-control-revid-objective').val();
                    
                    $("#"+tr_idob).html("");
                    
                    var nnode = {
                        'tr_idob' : tr_idob,
                        'objective_id' : xcid,
                        'objid' : xcobjid,
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
                    //var tr_idnya2 = $('#tr_idnya2').val();
                    var tr_idnya2 = $('#form-data-revid').val();

                    var xidap = $('#input-form-action-plan input[name=id_ap]').val();
                    var xplan = $('#input-form-action-plan textarea[name=action_plan]').val();
                    var xdate = $('#input-form-action-plan input[name=due_date]').val();
                    var xdiv_view = $('#input-form-action-plan input[name=division_v]').val();
                    var xdiv_id = $('#input-form-action-plan select[name=division] option:selected').val();
                    var xecs = $('#input-form-action-plan input[name=execution_status]').val();
                    var xece = $('#input-form-action-plan input[name=execution_explain]').val();
                    var xece_vi = $('#input-form-action-plan input[name=execution_evidence]').val();
                    var xecr = $('#input-form-action-plan input[name=execution_reason]').val();
                    var xred = $('#input-form-action-plan input[name=revised_date]').val();
                    
                    var nnode = {
                        'tr_idnya2' : tr_idnya2,
                        'id_ap' : xidap,
                        'action_plan' : xplan,
                        'due_date' : xdate,
                        'division_v' : xdiv_view,
                        'division' : xdiv_id,
                        'execution_status' : xecs,
                        'execution_explain' : xece,
                        'execution_evidence' : xece_vi,
                        'execution_reason' : xecr,
                        'revised_date' : xred,
                      
                    };
                    
                    me.actionPlanAddRow(nnode);
                    
                    $('#form-data').modal('hide');
                }
            });
	    	
	    	$('#input-form-impact-button').on('click', function() {
                var imp_1 =  $('#imp_1').val();
                var imp_2 =  $('#imp_2').val();
                var imp_3 =  $('#imp_3').val();
                var imp_4 =  $('#imp_4').val();
                var imp_5 =  $('#imp_5').val();

                var imp = {
                   'NA': 0, [imp_1]: 1, [imp_2]: 2, 
                   [imp_3]: 3, [imp_4]: 4, [imp_5]: 5
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
	    			MainApp.viewGlobalModal('error', 'Cannot set all Not Available (N/A) on Risk Impact');
	    		} else {
	    			var xv = me.impactLevelReference[max_val];
	    			$('#input-form input[name=risk_impact_level_id]').val(max_val);
	    			$('#input-form input[name=risk_impact_level_value]').val(xv);
	    			
	    			$('#modal-impact').modal('hide');
	    			me.setRiskLevel();
	    		}
	    	});
	    	
            $('#button-form-control-open').on('click', function () {
                
                //$('#input-form-action-plan').reset();
                document.getElementById("input-form-control2").reset();
                document.getElementById("input-form-control").reset();
                 
                $('#form-control-revid').val("");
                $('#input-form-control textarea[name=risk_existing_control]').attr('readonly', false);
                
            });

            /*
            $('#button-form-control-open').on('click', function () {
                //$('#input-form-control')[0].reset();
                 
                document.getElementById("input-form-control").reset();
                 
                $('#form-control-revid').val("");
                $('#input-form-control textarea[name=risk_existing_control]').attr('readonly', false);
            });
            */

            $('#button-form-control-open-objective').on('click', function () {
                document.getElementById("input-form-control-objective").reset();
               // $('#input-form-control-objective')[0].reset();
                $('#form-control-revid-objective').val("");
                $('#input-form-control-objective text[name=objid]').attr('readonly', false);
                $('#input-form-control-objective textarea[name=objective]').attr('readonly', false);
            });
	    	
	    	$('#button-form-data-open-ap').on('click', function () {
                
                //$('#input-form-action-plan').reset();
                $('#fdate').show();
                $("#checked").hide();
                $('#ckc').show();
                $('#kcc').hide();
                $('#form-data-revid').val('');
                document.getElementById("input-form-action-plan").reset();
            });
        	
        	$('#changes-risk-set-as-primary').on('click', function () {
        		me.submitRiskData('setAsPrimary')
        	});
        	
        	$('#changes-risk-button-save').on('click', function () {
        		me.submitRiskData('save')
        	});
        	
        	$('#changes-risk-button-submit').on('click', function () {
        		me.submitRiskData('verifyChanges')
        	});
        	
        	
        	$('#changes-risk-button-cancel').on('click', function () {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Risk Treatment ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac#tab_treatment_list';
        		});
        	});

            $('#primary-risk-button-submit2').on('click', function () {
                me.submitRiskData2('verify')
            });
        	
        	$('#primary-risk-button-submit').on('click', function () {
        		me.submitRiskData('verify-primary')
        	});

            $('#primary-risk-button-confirm').on('click', function () {
                me.submitRiskData('verify-primary')
            });

            $('#changes-risk-button-save-primary').on('click', function () {
                me.submitRiskData('save-primary')
            });
        	
        	$('#modal-control-filter-submit-objective').on('click', function() {
                me.filterControlobjective();
            });

            $('#modal-libraryaction-filter-submit').on('click', function() {
                me.filterLibraryAction();
            });
        	
        	/*
        	$('#div-portlet-page-caption').html('Verify Risk Information');
        	
        	$('#risk-button-verify').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this risk ?');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData('verify');
        		});
        		
        	});
        	
        	$('#risk-button-draft').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Save this risk ?');
        		mod.find('button.btn-primary').one('click', function(){
        			me.submitRiskData('save');
        		});
        	});
        	
        	$('#risk-button-delete').on('click', function() {
        		var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this Risk ?');
        		mod.find('button.btn-danger').one('click', function(){
        			mod.modal('hide');
        			
        			Metronic.blockUI({ boxed: true });
        			var url = site_url+'/main/mainrac/deleteRisk';
        			$.post(
        				url,
        				{ 'risk_id':  g_risk_id},
        				function( data ) {
        					Metronic.unblockUI();
        					if(data.success) {
        						var mod2 = MainApp.viewGlobalModal('success', 'Success Delete Data');
        						mod2.find('button.btn-ok-success').one('click', function(){
        							location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
        						});
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
        	});
        	
        	$('#risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Risk Verification ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainrac/riskRegister/'+g_username;
        		});
        	});
        	*/

             $('#risk-button-delete').on('click', function() {
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this Risk ?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/deleteRiskrac';
                    $.post(
                        url,
                        { 'risk_id':  g_risk_id},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod2 = MainApp.viewGlobalModal('success', 'Success Delete Data');
                                mod2.find('button.btn-ok-success').one('click', function(){
                                   location.href=site_url+'/main/mainrac#tab_treatment_list';
                                });
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
            });

            $('#control_id').change(function() {
                var val = $(this).val();
                me.loadCategorySelectcontrol('control_status', val);
                });

            $('#input-control-add-3').on('click', function() {
                    var mod = MainApp.viewGlobalModal('confirm', 'Are you sure there is no control exist?');
                    mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                
                    var form1 = $('#input-form-control-3').validate();
                    var fvalid = form1.form();
                 
                    if (fvalid) {
                    var xcid = $('#input-form-control-3 input[name=control_id_n]').val();
                    var xeid = $('#input-form-control-3 input[name=ec_id_n]').val();
                    var xexis = $('#input-form-control-3 input[name=risk_existing_control_n]').val();
                    var xeval = $('#input-form-control-3 input[name=risk_evaluation_control_n]').val();
                    var xowner = $('#input-form-control-3 input[name=risk_control_owner_n]').val();
                    var xdiv = $('#input-form-control-3 input[name=control_owner_n]').val();
                    
                    var tr_id = $('#form-control-revid-3').val();
                    
                    $("#tr_c"+tr_id).html("");
                     
                    var nnode = {
                        'tr_id' : tr_id,
                        'control_id' : xcid,
                        'ec_id' : xeid,
                        'risk_existing_control' : xexis,
                        'risk_evaluation_control' : xeval,
                        'risk_control_owner' : xowner,
                        'control_owner' : xdiv,
                    };
                    
                    me.controlAddRow(nnode);
                    
                    $('#form-control-2').modal('hide');
                    $('#form-control-3').modal('hide');
                }
                });
            });

        },

        loadCategorySelectcontrol: function(sel_id, parent) {
                if(parent == 1){
                $('#form-control').modal('show');
                $('#form-control-2').modal('hide');
            }else{ 
                $('#form-control-3').modal('show');
                 $('#form-control-2').modal('hide');
            }
             },

        loadRisk: function(rid,risk_input_by) {
        	var me = this;
        	
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+'/main/mainrac/loadTreatmentOwn2/'+rid+'/'+risk_input_by, function( data_risk ) {
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
                        'id_ap' : val.id_ap,
                        'action_plan' : val.action_plan,
                        'due_date' : val.due_date_v,
                        'division_v' : val.division_v,
                        'division' : val.division,
                        'execution_status':val.execution_status,
                        'execution_explain':val.execution_explain,
                        'execution_evidence':val.execution_evidence,
                        'execution_reason':val.execution_reason,
                        'revised_date':val.revised_date

        			}
        			me.actionPlanAddRow(nnode);
        		});
        		
        		me.controlReset();
                $.each( data_risk['control_list'], function( key, val ) {
                    var ecid = val.id;
                    if (val.id == null || val.id == '0') ecid = '';
                    var nnode = {
                        'control_id' : ecid,
                        'ec_id' : val.ec_id,
                        'risk_existing_control' : val.risk_existing_control,
                        'risk_evaluation_control' : val.risk_evaluation_control,
                        'risk_control_owner' : val.risk_control_owner,
                        'control_owner' : val.control_owner
                    };
        			
        			me.controlAddRow(nnode);
        		});

                 //objective
                me.controlResetobjective();
                $.each( data_risk['objective_list'], function( key, val ) {
                    var ecid = val.id;
                    if (val.id == null || val.id == '0') ecid = '';
                    var nnode = {
                        'objective_id' : ecid,
                        'objid' : val.objid,
                        'objective' : val.objective
                    };
                    
                    me.controlAddRowobjective(nnode);
                });
        	});
        },
        populateRisk: function(frm, data) {   
            $.each(data, function(key, value){

                if($('#due_date').val() == '00-00-0000' || $('#due_date').val() == 'Continuous'){
                    $('#fdate').hide();
                    $("#checked").show();
                    $('#ckc').hide();
                    $('#kcc').show();   
                }else{
                    $('#fdate').show();
                    $("#checked").hide();
                    $('#ckc').show();
                    $('#kcc').hide();   
                } 

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
         controlTableDeleteobjective: function(xrow, dataId) {
            //console.log(dataId);
            var i=xrow.parentNode.parentNode.parentNode.rowIndex;
            document.getElementById('objective_table').deleteRow(i);
            this.controlDeleteobjective(dataId);
        },
        controlResetobjective: function() {
            this.dataControlobjective = {};
            this.dataControlCounterobjective = 0;
            $("#objective_table > tbody").html("");
        },
        controlAddobjective: function(data, dcounter) {
            this.dataControlobjective[dcounter] = data;
        },
        controlDeleteobjective: function(id) {
            delete this.dataControlobjective[id];
        },
        controlAddRowobjective: function(nnode) {
            var me = this;
            
            var lastidrand = $('#form-control-revid-objective').val();
            
            //alert(lastidrand);
            
            $('#'+lastidrand).html('');
              
            $('#'+lastidrand).remove();
            
            me.dataControlCounterobjective++; 
            
            var idrand = Math.floor((Math.random() * 1000000) + 1); 

            $('#objective_table > tbody:last-child').append('<tr id = "'+me.dataControlCounterobjective+'">'+
                '<td><input type = "hidden" id = "objective_id'+me.dataControlCounterobjective+'" value = "'+nnode.objective_id+'">'+
                '<input type = "hidden" id = "objid'+me.dataControlCounterobjective+'" value = "'+nnode.objid+'">'+'OB.'+nnode.objid+'</td>'+
                '<td><textarea style="display:none;" id = "objective'+me.dataControlCounterobjective+'">'+nnode.objective+'</textarea>'+nnode.objective+'</td>'+
                '<td>'+
                '<div class="btn-group">'+
                    '<button type="button" class="btn btn-default btn-xs" onclick = "modal_control_edit_objective('+me.dataControlCounterobjective+')" ><i class="fa fa-pencil font-blue"> Edit </i></button>'+
                    '<button type="button" class="btn btn-default btn-xs" onclick="RiskVerify.controlTableDeleteobjective(this, '+me.dataControlCounterobjective+')"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
                '</div>'+
                '</td>'+
            '</tr>');
            this.controlDeleteobjective(nnode.tr_idob); 
            me.controlAddobjective(nnode, me.dataControlCounterobjective);
        },
        controlTableDelete: function(xrow, dataId) {
        	//console.log(dataId);
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('control_table').deleteRow(i);
        	this.controlDelete(dataId);
            $('#button-form-control-open').show();
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
         controlAddRow: function(nnode) {
            var me = this;
            
            var lastidrand = $('#form-control-revid').val();
            
            $('#tr_c'+lastidrand).remove();
            
            $('#tr_c'+lastidrand).html('');

            me.dataControlCounter++; 
            
            var idrand = Math.floor((Math.random() * 1000000) + 1);

            

            if(nnode.risk_evaluation_control != 'Not Available' && nnode.risk_existing_control != 'Not Available'){
                $('#button-form-control-open').show();
                var i = '<button type="button" class="btn btn-default btn-xs" onclick = "modal_control_edit('+me.dataControlCounter+')" ><i class="fa fa-pencil font-blue"> Edit </i></button>';
            }else{
                this.controlReset();
                $('#button-form-control-open').hide();
                var i ='';
            }

            $('#control_table > tbody:last-child').append('<tr id = "tr_c'+me.dataControlCounter+'">'+
                '<td><input type = "hidden" id = "control_id'+me.dataControlCounter+'" value = "'+nnode.control_id+'"><input type = "hidden" id = "ec_id'+me.dataControlCounter+'" value = "'+nnode.ec_id+'">EC.'+nnode.ec_id+'</td>'+
                '<td><textarea style="display:none;"  id = "risk_existing_control'+me.dataControlCounter+'" >'+nnode.risk_existing_control+'</textarea>'+nnode.risk_existing_control+'</td>'+
                '<td><input type = "hidden" id = "risk_evaluation_control'+me.dataControlCounter+'" value = "'+nnode.risk_evaluation_control+'">'+nnode.risk_evaluation_control+'</td>'+
                '<td><input type = "hidden" id = "risk_control_owner'+me.dataControlCounter+'" value = "'+nnode.risk_control_owner+'"><input type = "hidden" id = "control_owner'+me.dataControlCounter+'" value = "'+nnode.control_owner+'">'+nnode.control_owner+'</td>'+
                '<td>'+
                '<div class="btn-group">'+i+
                    '<button type="button" class="btn btn-default btn-xs" onclick="RiskVerify.controlTableDelete(this, '+me.dataControlCounter+')"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
                '</div>'+
                '</td>'+
            '</tr>');
            this.controlDelete(nnode.tr_id); 
            me.controlAdd(nnode, me.dataControlCounter);
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
        	delete this.dataActionPlan[id];
        },
         actionPlanAddRow: function(nnode) {
            var me = this;
            
            me.dataActionPlanCounter++;
            
            var lastidrand = $('#form-data-revid').val();
            
            var tr_id2 = $('#form-data-revid').val();

            var suggested_rt =  $('#suggested_rt').val();
             
            //$("#tr_z"+tr_id2).html("");
            $("#tr_z"+tr_id2).remove(); 
            
            $('#tr_z'+lastidrand).html('');
            
            var idrand = Math.floor((Math.random() * 1000000) + 1); 

            if(nnode.due_date == '00-00-0000'){
                nnode.due_date = 'Continuous';
            }

            if(suggested_rt == 'ACCEPT'){
              $('#action_plan_form').hide();
            }else{
            
                $('#action_plan_table > tbody:last-child').append('<tr id = "tr_z'+me.dataActionPlanCounter+'">'+
                '<td><input type = "hidden" value = "'+nnode.id_ap+'" id = "id_ap'+me.dataActionPlanCounter+'">AP.'+nnode.id_ap+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.action_plan+'" id = "action_plan'+me.dataActionPlanCounter+'">'+nnode.action_plan+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.due_date+'" id = "due_date'+me.dataActionPlanCounter+'">'+nnode.due_date+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.division+'" id = "division'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.division_v+'" id = "division_v'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_status+'" id = "execution_status'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_explain+'" id = "execution_explain'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_evidence+'" id = "execution_evidence'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_reason+'" id = "execution_reason'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.revised_date+'" id = "revised_date'+me.dataActionPlanCounter+'">'+nnode.division_v+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.execution_status+'" id = "execution_status'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_explain+'" id = "execution_explain'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_evidence+'" id = "execution_evidence'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.execution_reason+'" id = "execution_reason'+me.dataActionPlanCounter+'">'+
                '<input type = "hidden" value = "'+nnode.revised_date+'" id = "revised_date'+me.dataActionPlanCounter+'">'+nnode.execution_status+'</td>'+
                '<td>'+
                    '<div class="btn-group">'+
                        '<button type="button" class="btn btn-default btn-xs" onclick="modal_ap_edit('+me.dataActionPlanCounter+')" ><i class="fa fa-pencil font-blue"> Edit</i></button>'+
                        '<button type="button" class="btn btn-default btn-xs" onclick="RiskVerify.actionPlanTableDelete(this, '+me.dataActionPlanCounter+')"><i class="fa fa-trash-o font-red"> Delete</i></button>'+
                    '</div>'+
                    '</td>'+
                '</tr>');
            }
            
            me.actionPlanDelete(nnode.tr_idnya2);
            me.actionPlanAdd(nnode, me.dataActionPlanCounter);
        },
        showImpactList: function() {
        	$('#modal-impact').on('shown.bs.modal', function () {
        		$('#modal-impact.modal .modal-body').css('max-height', 400);
        		$('#modal-impact.modal .modal-body').css('overflow', 'none');
        		$('#modal-impact.modal .modal-body').css('overflow-y', 'auto');
        	});
        	
        	$('#modal-impact').modal('show');
        },
        filterControl: function() {
        	var fval = $('#modal-control div.inputs input[name=filter_search]')[0].value;
        	gridControl.clearAjaxParams();
        	gridControl.setAjaxParam("filter_library", fval);
        	gridControl.getDataTable().ajax.reload();	
        },
        selectControlLibraryobjective: function(rid) {
            var me = this;
            $('#input-form-control-objective textarea[name=objective]').attr('readonly', false);
            $('#input-form-control-objective text[name=objid]').attr('readonly', false);
            
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
        selectControlLibrary: function(rid) {
            var me = this;
            $('#input-form-control textarea[name=risk_existing_control]').attr('readonly', false);
             $('#input-form-control text[name=ec_id]').attr('readonly', false);
            
            $('#modal-control').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['control_id'] = data_risk['id'];
                
                me.populateRisk($('#input-form-control'), data_risk);
            });
        },
         selectControlLibraryexisting: function(rid) {
            var me = this;
            $('#input-form-control input[name=risk_evaluation_control]').attr('readonly', true);
            
            $('#modal-control-existing').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibraryexisting/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['risk_evaluation_control'] = data_risk['evaluation_control'];
                
                me.populateRisk($('#input-form-control'), data_risk);
            });
        },
        filterLibraryAction: function() {
            var fval = $('#modal-libraryaction div.inputs input[name=filter_search]')[0].value;
            gridLibraryaction.clearAjaxParams();
            gridLibraryaction.setAjaxParam("filter_library", fval);
            gridLibraryaction.getDataTable().ajax.reload(); 
        },
        filterControlobjective: function() {
            var fval = $('#modal-objective div.inputs input[name=filter_search]')[0].value;
            gridControlobjective.clearAjaxParams();
            gridControlobjective.setAjaxParam("filter_library", fval);
            gridControlobjective.getDataTable().ajax.reload();   
        },
        submitRiskData2: function(submitMode) {
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
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
                    control_param['control['+cnt+'][ec_id]'] = value.ec_id;
                    control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
                    control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
                    control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at least One Control for this Risk');
                    return false;
                }

                // prepare objective data
                var objective_param = {};
                var cnt = 0;
                $.each(me.dataControlobjective, function(key, value) { 
                    objective_param['objective['+cnt+'][objective_id]'] = value.id;
                    objective_param['objective['+cnt+'][objid]'] = value.objid;
                    objective_param['objective['+cnt+'][objective]'] = value.objective;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at least One objective for this Risk');
                    return false;
                }
                
                
                // prepare action plan data
                var actplan_param = {};
                var cnt = 0;
                $.each(me.dataActionPlan, function(key, value) { 
                    actplan_param['actplan['+cnt+'][id_ap]'] = value.id_ap; 
                    actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
                    actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
                    actplan_param['actplan['+cnt+'][division]'] = value.division;
                    actplan_param['actplan['+cnt+'][execution_status]'] = value.execution_status;
                    actplan_param['actplan['+cnt+'][execution_explain]'] = value.execution_explain;
                    actplan_param['actplan['+cnt+'][execution_evidence]'] = value.execution_evidence;
                    actplan_param['actplan['+cnt+'][execution_reason]'] = value.execution_reason;
                    actplan_param['actplan['+cnt+'][revised_date]'] = value.revised_date;
                    cnt++;
                });
                //console.log(impact_param);
                
                 var suggested_rt =  $('#suggested_rt').val();
                if(suggested_rt != 'ACCEPT'){
                    if (cnt < 1) {
                         MainApp.viewGlobalModal('error', 'Please Input at least One Action Plan for this Risk');
                         return false;
                    }
                }
                
                if (submitMode == 'setAsPrimary') {
                    var url = site_url+'/main/mainrac/treatmentSetAsPrimary';
                    var text = 'Are You sure you want to Save and Set As Primary this Risk ?';
                } else if (submitMode == 'verify') {
                    var url = site_url+'/main/mainrac/treatmentVerify2';
                    var text = 'Are You sure you want to Verify with Primary Data for this Risk ?';
                } else if (submitMode == 'verifyChanges') {
                    var url = site_url+'/main/mainrac/treatmentVerifyChanges';
                    var text = 'Are You sure you want to Verify with Changes Data for this Risk ?';
                }else if (submitMode == 'save2') {
                    var url = site_url+'/main/mainrac/treatmentSaveprimary';
                    var text = 'Are You sure you want to Save this Risk ?';
                } else {
                    var url = site_url+'/main/mainrac/treatmentSave';
                    var text = 'Are You sure you want to Save this Risk ?';
                }
                
                var mod = MainApp.viewGlobalModal('confirm', text);
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param) + '&' + $.param(objective_param),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                    if (submitMode == 'setAsPrimary') {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id;
                                    } else if (submitMode == 'verify' || submitMode == 'verifyChanges') {
                                        location.href=site_url+'/main/mainrac';
                                    }else if (submitMode == 'save2') {
                                        location.href=site_url+'/main/mainrac';
                                    } else {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id;
                                    }
                                });
                                
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                    if (submitMode == 'setAsPrimary') {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id;
                                    } else if (submitMode == 'verify' || submitMode == 'verifyChanges') {
                                        location.href=site_url+'/main/mainrac';
                                    }else if (submitMode == 'save2') {
                                        location.href=site_url+'/main/mainrac';
                                    } else {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id;
                                    }
                                });
                     });
                });
            }
        },
        submitRiskData: function(submitMode) {
        	var form1 = $('#input-form').validate();
        	var fvalid = form1.form();
        	if (fvalid) {
            	var me = this;
            	var param = $('#input-form').serializeArray();
            	
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
                    control_param['control['+cnt+'][ec_id]'] = value.ec_id;
                    control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
                    control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
                    control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
                    cnt++;
                });
                
                if(submitMode != 'verify-primary' ){
                    if (cnt < 1) {
                        MainApp.viewGlobalModal('error', 'Please Input at least One Control for this Risk');
                        return false;
                    }
                }

                // prepare objective data
                var objective_param = {};
                var cnt = 0;
                $.each(me.dataControlobjective, function(key, value) { 
                    objective_param['objective['+cnt+'][objective_id]'] = value.id;
                    objective_param['objective['+cnt+'][objid]'] = value.objid;
                    objective_param['objective['+cnt+'][objective]'] = value.objective;
                    cnt++;
                });

                if(submitMode != 'verify-primary' ){
                    if (cnt < 1) {
                        MainApp.viewGlobalModal('error', 'Please Input at least One objective for this Risk');
                        return false;
                    }
                }
                
                
                // prepare action plan data
                var actplan_param = {};
                var cnt = 0;
                $.each(me.dataActionPlan, function(key, value) { 
                    actplan_param['actplan['+cnt+'][id_ap]'] = value.id_ap; 
                    actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
                    actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
                    actplan_param['actplan['+cnt+'][division]'] = value.division;
                    actplan_param['actplan['+cnt+'][execution_status]'] = value.execution_status;
                    actplan_param['actplan['+cnt+'][execution_explain]'] = value.execution_explain;
                    actplan_param['actplan['+cnt+'][execution_evidence]'] = value.execution_evidence;
                    actplan_param['actplan['+cnt+'][execution_reason]'] = value.execution_reason;
                    actplan_param['actplan['+cnt+'][revised_date]'] = value.revised_date;
                    cnt++;
                });
                //console.log(impact_param);
                
                 var suggested_rt =  $('#suggested_rt').val();
                if(suggested_rt != 'ACCEPT' || submitMode != 'verify-primary'){
                    if (cnt < 1) {
                         MainApp.viewGlobalModal('error', 'Please Input at least One Action Plan for this Risk');
                         return false;
                    }
                }
            	
            	if (submitMode == 'setAsPrimary') {
            		var url = site_url+'/main/mainrac/treatmentSetAsPrimary';
            		var text = 'Are You sure you want to Save and Set As Primary this Risk ?';
            	} else if (submitMode == 'verify-primary') {
            		var url = site_url+'/main/mainrac/treatmentVerifyPrimary';
            		var text = 'Are You sure you want to Verify with Primary Data for this Risk ?';
            	} else if (submitMode == 'verifyChanges') {
            		var url = site_url+'/main/mainrac/treatmentVerifyChanges';
            		var text = 'Are You sure you want to Verify with Changes Data for this Risk ?';
            	}else if (submitMode == 'save-primary') {
                    var url = site_url+'/main/mainrac/treatmentSaveprimary';
                    var text = 'Are You sure you want to Save this Risk ?';
                } else {
            		var url = site_url+'/main/mainrac/treatmentSave/'+risk_input_by;
            		var text = 'Are You sure you want to Save this Risk ?';
            	}
            	
            	var mod = MainApp.viewGlobalModal('confirm', text);
            	mod.find('button.btn-primary').off('click');
            	mod.find('button.btn-primary').one('click', function(){
            		mod.modal('hide');
            		Metronic.blockUI({ boxed: true });
            		$.post(
            			url,
            			$( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param) + '&' + $.param(objective_param),
            			function( data ) {
            				Metronic.unblockUI();
            				if(data.success) {
            					var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
            					mod.find('button.btn-ok-success').one('click', function(){
            						//location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
            						if (submitMode == 'setAsPrimary') {
            							location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
            						} else if (submitMode == 'verify' || submitMode == 'verifyChanges' || submitMode == 'verify-primary') {
            							location.href=site_url+'/main/mainrac#tab_treatment_list';
            						}else if (submitMode == 'save-primary') {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
                                    } else {
            							location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
            						}
            					});
            					
            				} else {
            					MainApp.viewGlobalModal('error', data.msg);
            				}
            				
            			},
            			"json"
            		).fail(function() {
            			Metronic.unblockUI();
            			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Updating your Risk');
                                mod.find('button.btn-ok-success').one('click', function(){
                                    //location.href=site_url+'/risk/RiskRegister/modifyRisk/'+g_risk_id;
                                    if (submitMode == 'setAsPrimary') {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
                                    } else if (submitMode == 'verify' || submitMode == 'verifyChanges' || submitMode == 'verify-primary') {
                                        location.href=site_url+'/main/mainrac#tab_treatment_list';
                                    }else if (submitMode == 'save-primary') {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
                                    } else {
                                        location.href=site_url+'/main/mainrac/riskTreatmentForm/'+g_risk_id+'/'+risk_input_by;
                                    }
                                });
            		 });
            	});
            }
        }
	 }
}();

function modal_control_edit(a){
     
$('#tr_idnya').val(a); 
$('#control_id').val($('#control_id'+a).val());
$('#ec_id').val($('#ec_id'+a).val());
$('#risk_evaluation_control').val($('#risk_evaluation_control'+a).val());
$('#risk_existing_control').val($('#risk_existing_control'+a).val());
$('#risk_control_owner').val($('#risk_control_owner'+a).val());
$('#control_owner').val($('#control_owner'+a).val());
$('#form-control-revid').val(a);

$('#form-control').modal('show'); 
}

function modal_control_edit_objective(a){
$('#tr_idnyaob').val(a); 
$('#objective_id').val($('#objective_id'+a).val());
$('#objid').val($('#objid'+a).val());
$('#objective').val($('#objective'+a).val());
$('#form-control-revid-objective').val(a);

$('#form-control-objective').modal('show'); 
}

function modal_ap_edit(a){
    
//$('#form-data-revid').val(a);

//$("#checked").hide();
$('#id_ap').val($('#id_ap'+a).val());
$('#action_plan').val($('#action_plan'+a).val());
$('#due_date').val($('#due_date'+a).val());
$('#division').val($('#division'+a).val());
$('#division_v').val($('#division_v'+a).val());
$('#execution_status').val($('#execution_status'+a).val());
$('#execution_explain').val($('#execution_explain'+a).val());
$('#execution_evidence').val($('#execution_evidence'+a).val());
$('#execution_reason').val($('#execution_reason'+a).val());
$('#revised_date').val($('#revised_date'+a).val());
$('#form-data-revid').val(a);

if($('#due_date'+a).val() == '00-00-0000' || $('#due_date'+a).val() == 'Continuous'){
    $('#fdate').hide();
    $("#checked").show();
    $('#ckc').hide();
    $('#kcc').show();   
}else{
    $('#fdate').show();
    $("#checked").hide();
    $('#ckc').show();
    $('#kcc').hide();   
}   


$('#form-data').modal('show'); 
}