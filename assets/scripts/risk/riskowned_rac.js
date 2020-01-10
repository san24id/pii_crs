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
        		'<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskOwned.selectControlLibrary('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
        		'</div>';
        		return ret;
        	}
        } ],
        "columns": [
            { "data": "id", "orderable": false },
            { "data": "risk_evaluation_control" },
            { "data": "risk_existing_control"},
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
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskOwned.selectLibraryaction('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
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
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: RiskOwned.selectControlLibraryexisting('+full.id +')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
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

var RiskOwned = function() {
	return {
		dataMode: null,
        //main function to initiate the module
        dataActionPlan: {},
        dataRiskImpact: {},
        dataActionPlanCounter: 0,
        riskLevelList: null,
        riskLevelReference: null,
        impactLevelReference: null,
        init: function(mode) {
        	var me = this;
        	me.dataMode = mode;
        	
        	if (jQuery().datepicker) {
	            $('.date-picker').datepicker({
	                rtl: Metronic.isRTL(),
	                orientation: "left",
	                autoclose: true
	            });
	            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	        };
        	
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
                    var xexis = $('#input-form-control input[name=risk_existing_control]').val();
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
                }
            });

            $('#input-actionplan-add').on('click', function() {
                var form1 = $('#input-form-action-plan').validate();
                var fvalid = form1.form();
                
                if (fvalid) {
                    //var tr_idnya2 = $('#tr_idnya2').val();
                    var tr_idnya2 = $('#form-data-revid').val();
                    var xplan = $('#input-form-action-plan textarea[name=action_plan]').val();
                    var xdate = $('#input-form-action-plan input[name=due_date]').val();
                    var xdiv_view = $('#input-form-action-plan input[name=division_v]').val();
                    var xdiv_id = $('#input-form-action-plan select[name=division] option:selected').val();
                    var nnode = {
                        'tr_idnya2' : tr_idnya2,
                        'action_plan' : xplan,
                        'due_date' : xdate,
                        'division_v' : xdiv_view,
                        'division' : xdiv_id
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
        	
        	$('#button-form-control-open-ap').on('click', function () {
        		//$('#input-form-action-plan')[0].reset();
				$('#form-data-revid').val('');
                $('#fdate').show();
                $("#checked").hide();
                $('#ckc').show();
                $('#kcc').hide();
				document.getElementById("input-form-action-plan").reset();
        	});
        	
        	$('#modal-control-filter-submit').on('click', function() {
        		me.filterControl();
        	});
        	
        	$('#risk-button-verify').on('click', function() {
        		me.submitRiskData('save');
        	});
        	
        	$('#risk-button-save').on('click', function() {
        		me.submitRiskData('draft');
        	});
        	
        	$('#risk-button-cancel').on('click', function() {
        		var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Risk Treatment ? You will loose your unsaved data.');
        		mod.find('button.btn-primary').off('click');
        		mod.find('button.btn-primary').one('click', function(){
        			location.href=site_url+'/main/mainpic';
        		});
        	});

             $('#control_id').change(function() {
                var val = $(this).val();
                me.loadCategorySelectcontrol('control_status', val);
                });

            $('#input-control-add-3').on('click', function() {
                var form1 = $('#input-form-control-3').validate();
                var fvalid = form1.form();
                 
                if (fvalid) {
                    var xcid = $('#input-form-control-3 input[name=control_id_n]').val();
                    var xeid = $('#input-form-control-3 input[name=ec_id_n]').val();
                    var xexis = $('#input-form-control-3 input[name=risk_existing_control_n]').val();
                    var xeval = $('#input-form-control-3 input[name=risk_evaluation_control_n]').val();
                    var xowner = $('#input-form-control-3 select[name=risk_control_owner_n]').val();
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
        	
        	me.loadInitialData();
        	me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
        	
        	handleValidationControl();
        	handleValidationAction();
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
             
        loadInitialData: function() {
        	var me = this;
        	Metronic.blockUI({ boxed: true });
        	var cnt1 = cnt2 = cnt3 = 0; 
        	$.getJSON( site_url+"/main/mainpic/riskOwnerGetData2/"+g_risk_id, function( data_risk ) {
        		g_username = data_risk['risk_input_by'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#input-form'), data_risk);
        		
        		//console.log(data_risk);
        		        		
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
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division
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
        		
        		Metronic.unblockUI();
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
            $('#input-form-control textarea[name=risk_existing_control]').attr('readonly', true);
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
            $('#input-form-control input[name=risk_existing_control]').attr('readonly', true);
            
            $('#modal-control-existing').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibraryexisting/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['risk_existing_control'] = data_risk['existing_control'];
                
                me.populateRisk($('#input-form-control'), data_risk);
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
        loadCategorySelect: function(sel_id, parent) {
        	$('#'+sel_id)[0].options.length = 0;
        	$.getJSON( site_url+"/risk/RiskRegister/getCategory/"+parent, function( data ) {
        		$.each( data, function( key, val ) {
        		    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
        		});
        		$('#'+sel_id).trigger('change');
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
        	console.log(iv, lv);
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
        filterControl: function() {
        	var fval = $('#modal-control div.inputs input[name=filter_search]')[0].value;
        	gridControl.clearAjaxParams();
        	gridControl.setAjaxParam("filter_library", fval);
        	gridControl.getDataTable().ajax.reload();	
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
                '<td><input type = "hidden" id = "risk_evaluation_control'+me.dataControlCounter+'" value = "'+nnode.risk_evaluation_control+'">'+nnode.risk_evaluation_control+'</td>'+
                '<td><textarea style="display:none;"  id = "risk_existing_control'+me.dataControlCounter+'" >'+nnode.risk_existing_control+'</textarea>'+nnode.risk_existing_control+'</td>'+
                '<td><input type = "hidden" id = "risk_control_owner'+me.dataControlCounter+'" value = "'+nnode.risk_control_owner+'"><input type = "hidden" id = "control_owner'+me.dataControlCounter+'" value = "'+nnode.control_owner+'">'+nnode.control_owner+'</td>'+
                '<td>'+
                '<div class="btn-group">'+i+
                    '<button type="button" class="btn btn-default btn-xs" onclick="RiskOwned.controlTableDelete(this, '+me.dataControlCounter+')"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
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
             
            //$("#tr_z"+tr_id2).html("");
            $("#tr_z"+tr_id2).remove(); 
            
            $('#tr_z'+lastidrand).html('');
            
            var idrand = Math.floor((Math.random() * 1000000) + 1);
            var suggested_rt =  $('#suggested_rt').val(); 

            if(nnode.due_date == '00-00-0000'){
                nnode.due_date = 'Continuous';
            }

            if(suggested_rt == 'ACCEPT'){
              $('#action_plan_form').hide();
            }else{
            
            $('#action_plan_table > tbody:last-child').append('<tr id = "tr_z'+me.dataActionPlanCounter+'">'+
                '<td><input type = "hidden" value = "'+nnode.action_plan+'" id = "action_plan'+me.dataActionPlanCounter+'">'+nnode.action_plan+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.due_date+'" id = "due_date'+me.dataActionPlanCounter+'">'+nnode.due_date+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.division+'" id = "division'+me.dataActionPlanCounter+'"><input type = "hidden" value = "'+nnode.division_v+'" id = "division_v'+me.dataActionPlanCounter+'">'+nnode.division_v+'</td>'+
                '<td>'+
                '<div class="btn-group">'+
                    '<button type="button" class="btn btn-default btn-xs" onclick="modal_ap_edit('+me.dataActionPlanCounter+')" ><i class="fa fa-pencil font-blue"> Edit</i></button>'+
                    '<button type="button" class="btn btn-default btn-xs" onclick="RiskOwned.actionPlanTableDelete(this, '+me.dataActionPlanCounter+')"><i class="fa fa-trash-o font-red"> Delete</i></button>'+
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
        submitRiskData: function(submitMode) {
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
        		control_param['control['+cnt+'][control_id]'] = value.id;
                control_param['control['+cnt+'][risk_evaluation_control]'] = value.risk_evaluation_control;
                control_param['control['+cnt+'][risk_existing_control]'] = value.risk_existing_control;
                control_param['control['+cnt+'][risk_control_owner]'] = value.risk_control_owner;
        		cnt++;
        	});
        	
        	if (cnt < 1) {
        		MainApp.viewGlobalModal('error', 'Please Input at least One Control for this Risk');
        		return false;
        	}
        	
        	// prepare action plan data
        	var actplan_param = {};
        	var cnt = 0;
        	$.each(me.dataActionPlan, function(key, value) { 
        		actplan_param['actplan['+cnt+'][action_plan]'] = value.action_plan;
        		actplan_param['actplan['+cnt+'][due_date]'] = value.due_date;
        		actplan_param['actplan['+cnt+'][division]'] = value.division;
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
        	
        	if (submitMode == 'draft') {
        		var url = site_url+'/main/mainpic/treatmentSaveDraft';
        		var vtext = 'Are You sure you want to Save as Draft this risk ?';
        	} else {
        		var url = site_url+'/main/mainpic/treatmentSubmit';
        		var vtext = 'Are You sure you want to Submit this Risk Treatment ?';
        	}
        	
        	var mod = MainApp.viewGlobalModal('confirm', vtext);
        	mod.find('button.btn-primary').off('click');
        	mod.find('button.btn-primary').one('click', function(){
        		mod.modal('hide');
        		
        		Metronic.blockUI({ boxed: true });
        		$.post(
        			url,
        			$( "#input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param),
        			function( data ) {
        				Metronic.unblockUI();
        				if(data.success) {
        					var mod = MainApp.viewGlobalModal('success', 'Success Updating Risk');
        					mod.find('button.btn-ok-success').one('click', function(){
        						if (submitMode == 'draft') {
        							location.href=site_url+'/main/mainrac/viewOwnedRisk/'+g_risk_id;
        						} else {
        							location.href=site_url+'/main/mainrac';
        						}
        					});
        				} else {
                            
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'This Risk Is Under Maintenance by RAC you cannot modify this risk until the process done');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac';
                            });
                        }
        			},
        			"json"
        		).fail(function() {
        			Metronic.unblockUI();
        			//MainApp.viewGlobalModal('error', 'Error Submitting Data');
                   var mod = MainApp.viewGlobalModal('success', 'Success Updating Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                if (submitMode == 'draft') {
                                    location.href=site_url+'/main/mainrac/viewOwnedRisk/'+g_risk_id;
                                } else {
                                    location.href=site_url+'/main/mainrac';
                                }
                            });
        		 });
        	});
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
$('#action_plan').val($('#action_plan'+a).val());
$('#due_date').val($('#due_date'+a).val());
$('#division').val($('#division'+a).val());
$('#division_v').val($('#division_v'+a).val());
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