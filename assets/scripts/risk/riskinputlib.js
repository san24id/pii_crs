/*var Checktes = $("#check_date");
Checktes.click(function(){
    if(this.checked){
        $('#due_date').val('00-00-0000');
        $('#fdate').hide();
     }else{
        $('#due_date').val('');
        $('#fdate').show();
     
 });*/

 $('#kcc').hide();
 $("#checked").hide();

$('#suggested_rt_change').change(function(){
 var suggested_rtc =  $('#suggested_rt_change').val();
   if(suggested_rtc == 'ACCEPT'){
         $('#action_plan_form').hide();
         $('#btnaction').hide();
         $('.btnactionc').hide();
         $('#sgrt').val('ACCEPT');
   }else if(suggested_rtc == 'MITIGATE'){
        $('#action_plan_form').show();
        $('#btnaction').show();
        $('.btnactionc').show();
        $('#sgrt').val('MITIGATE');
   }else if(suggested_rtc == 'TRANSFER'){
        $('#action_plan_form').show();
        $('#btnaction').show();
        $('.btnactionc').show();
        $('#sgrt').val('TRANSFER');
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
	        risk_event: {
	            minlength: 2,
	            required: true
	        },
	        risk_description: {
	            minlength: 2,
	            required: true
	        },
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
	        },
            suggested_risk_treatment: {
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
	        MainApp.viewGlobalModal('error', 'Please fill all the mandatory field');
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
	        MainApp.viewGlobalModal('error', 'Please fill all mandatory field');
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
            MainApp.viewGlobalModal('error', 'Please fill all mandatory field');
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
	        MainApp.viewGlobalModal('error', 'Please fill all mandatory field');
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

var RiskInputlib = function() {
	return {
		dataMode: null,
        //main function to initiate the module
        dataControlobjective: {},
        dataControl: {},
        dataActionPlan: {},
        dataRiskImpact: {},
        dataControlCounter: 0,
        dataControlCounterobjective: 0,
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
	                autoclose: true,
	                todayHighlight: true
	            });
	            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
	        };
          
        	
        	me.loadRiskLevelList();
        	me.loadRiskLevelReference();
        	me.loadImpactLevelReference();
        	handleValidation();
        	handleValidationControl();
            handleValidationObjective();
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
            

        initLoadCategory: function() {
        	// init Category select
        	var cnt1 = cnt2 = cnt3 = 0; 
        	
        	$.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
        		$.each( data, function( key, val ) {
        			// GET INIT SUB CATEGORY
        			if (cnt1 == 0) {
        				$.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val.ref_key, function( data1 ) {
        					$.each( data1, function( key2, val2 ) {
        						if (cnt2 == 0) {
        							// GET INIT 2ND SUB CATEGORY
        							$.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val2.ref_key, function( data2 ) {
        								$.each( data2, function( key3, val3 ) {
        								    $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
        								});
        							});
        						}
        						
        					    $('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
        						    
        					    cnt2++;
        					});
        				});
        			}
        			
        			$('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
        			    
        			cnt1++;
        		});
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
        controlTableDelete: function(xrow, dataId) {
        	//console.log(dataId);
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('primary_control_table').deleteRow(i);
        	this.controlDelete(dataId);
            $('#button-form-control-open').show();
        },
        controlTableDeleteobjective: function(xrow, dataId) {
            //console.log(dataId);
            var i=xrow.parentNode.parentNode.parentNode.rowIndex;
            document.getElementById('primary_objective_table').deleteRow(i);
            this.controlDeleteobjective(dataId);
        },
        controlReset: function() {
        	this.dataControl = {};
        	this.dataControlCounter = 0;
        	$("#primary_control_table > tbody").html("");
        },
        controlResetobjective: function() {
            this.dataControlobjective = {};
            this.dataControlCounterobjective = 0;
            $("#primary_objective_table > tbody").html("");
        },
        controlAdd: function(data, dcounter) {
        	this.dataControl[dcounter] = data;
        },
        controlAddobjective: function(data, dcounter) {
            this.dataControlobjective[dcounter] = data;
        },
        controlDelete: function(id) {
        	delete this.dataControl[id];
        },
        controlDeleteobjective: function(id) {
            delete this.dataControlobjective[id];
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

        	$('#primary_control_table > tbody:last-child').append('<tr>'+
        		'<td><input type = "hidden" value = "'+nnode.control_id+'"><input type = "hidden" value = "'+nnode.ec_id+'">EC.'+nnode.ec_id+'</td>'+
                '<td><textarea style="display:none;">'+nnode.risk_existing_control+'</textarea>'+nnode.risk_existing_control+'</td>'+
        		'<td><input type = "hidden" value = "'+nnode.risk_evaluation_control+'">'+nnode.risk_evaluation_control+'</td>'+
        		'<td><input type = "hidden" value = "'+nnode.risk_control_owner+'"><input type = "hidden" value = "'+nnode.control_owner+'">'+nnode.control_owner+'</td>'+
        	'</tr>');
        },
        controlAddRowobjective: function(nnode) {
            var me = this;
            
            var lastidrand = $('#form-control-revid-objective').val();
			
			//alert(lastidrand);
            
            $('#'+lastidrand).html('');
			  
			$('#'+lastidrand).remove();
            
            me.dataControlCounterobjective++; 
            
            var idrand = Math.floor((Math.random() * 1000000) + 1); 

            $('#primary_objective_table > tbody:last-child').append('<tr>'+
                '<td><input type = "hidden" value = "'+nnode.objective_id+'">'+
                '<input type = "hidden" value = "'+nnode.objid+'">'+'OB.'+nnode.objid+'</td>'+
                '<td><textarea style="display:none;">'+nnode.objective+'</textarea>'+nnode.objective+'</td>'+
            '</tr>');
        },
        actionPlanTableDelete: function(xrow, dataId) {
        	var i=xrow.parentNode.parentNode.parentNode.rowIndex;
        	document.getElementById('primary_action_plan_table').deleteRow(i);
        	this.actionPlanDelete(dataId);
        },
        actionPlanReset: function() {
        	this.dataActionPlanCounter = 0;
        	this.dataActionPlan = {};
        	$("#primary_action_plan_table > tbody").html("");
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

            if(nnode.existing_control_id == 2){
                $('#primary_action_plan_table > tbody:last-child').append('<tr>'+
                '<td><img src="assets/images/legend/actplan.png" width="15" /></td>'+
                '<td><input type = "hidden" value = "'+nnode.id_ap+'">AP.'+nnode.id_ap+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.action_plan+'">'+nnode.action_plan+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.due_date+'">'+nnode.due_date+'</td>'+
                '<td><input type = "hidden" value = "'+nnode.division+'">'+
                '<input type = "hidden" value = "'+nnode.division_v+'">'+
                '<input type = "hidden" value = "'+nnode.execution_status+'">'+
                '<input type = "hidden" value = "'+nnode.execution_explain+'">'+
                '<input type = "hidden" value = "'+nnode.execution_evidence+'">'+
                '<input type = "hidden" value = "'+nnode.execution_reason+'">'+
                '<input type = "hidden" value = "'+nnode.revised_date+'">'+
                '<input type = "hidden" value = "'+nnode.existing_control_id+'">'+nnode.division_v+'</td>'+
                '<td>'+
                '<div class="btn-group">'+
                    '<button type="button" title="Delete" class="btn btn-default btn-xs" onclick="RiskInputlib.actionPlanTableDelete(this, '+me.dataActionPlanCounter+')"><i class="fa fa-trash-o font-red"></i></button>'+
                '</div>'+
                '</td>'+
            '</tr><tr><td colspan="6">Legend</td></tr><tr><td><img src="assets/images/legend/actplan.png" width="15" /></td><td colspan="5">This action plan was ignored at prior period. Please review it before verify the risk.</td></tr>');
            }else{
        	$('#primary_action_plan_table > tbody:last-child').append('<tr>'+
                '<td></td>'+
                '<td><input type = "hidden" value = "'+nnode.id_ap+'">AP.'+nnode.id_ap+'</td>'+
        		'<td><input type = "hidden" value = "'+nnode.action_plan+'">'+nnode.action_plan+'</td>'+
        		'<td><input type = "hidden" value = "'+nnode.due_date+'">'+nnode.due_date+'</td>'+
        		'<td><input type = "hidden" value = "'+nnode.division+'">'+
                '<input type = "hidden" value = "'+nnode.division_v+'">'+
                '<input type = "hidden" value = "'+nnode.execution_status+'">'+
                '<input type = "hidden" value = "'+nnode.execution_explain+'">'+
                '<input type = "hidden" value = "'+nnode.execution_evidence+'">'+
                '<input type = "hidden" value = "'+nnode.execution_reason+'">'+
                '<input type = "hidden" value = "'+nnode.revised_date+'">'+
                '<input type = "hidden" value = "'+nnode.existing_control_id+'">'+nnode.division_v+'</td>'+
        		'<td>'+		
        		'</td>'+
        	'</tr>');
            }
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
        selectLibrary: function(rid) {
        	var me = this;
        	
            var suggested_rt =  $('#suggested_rt').val();

            if(suggested_rt == 'ACCEPT'){
                $('#action_plan_form').hide();
            }else{
                $('#action_plan_form').show();
            }

        	$('#modal-library').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadRiskLibrary/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['risk_library_id'] = data_risk['risk_id'];
        		data_risk['risk_library_code'] = data_risk['risk_code'];
        		data_risk['risk_level_id'] = data_risk['risk_level'];
        		data_risk['risk_level'] = data_risk['risk_level_v'];
        		
        		data_risk['risk_impact_level_id'] = data_risk['risk_impact_level'];
        		data_risk['risk_impact_level_value'] = data_risk['impact_level_v'];
        		data_risk['risk_likelihood_id'] = data_risk['risk_likelihood_key'];
        		data_risk['risk_likelihood_value'] = data_risk['likelihood_v'];
        		
        		me.populateRisk($('#input-form'), data_risk);
        		$('#risk_submitted_by').val(data_risk.risk_owner_v);
        		$('#risk_submitted_division').val(data_risk.division_v);
        		
        		//console.log(data_risk);
        		$('#sel_risk_category').find('option').remove();
        		$('#sel_risk_sub_category').find('option').remove();
        		$('#sel_risk_2nd_sub_category').find('option').remove();
        		
        		$.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
        			$.each( data, function( key, val ) {
        				$('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
        			});
        			$('#sel_risk_category').val(data_risk['risk_category']);
        			
        			$.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data_risk['risk_category'], function( data1 ) {
        				$.each( data1, function( key2, val2 ) {
        					$('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
        				});
        				$('#sel_risk_sub_category').val(data_risk['risk_sub_category']);        				
        				
        				$.getJSON( site_url+"/risk/RiskRegister/getCategory/"+data_risk['risk_sub_category'], function( data2 ) {
        					$.each( data2, function( key3, val3 ) {
        					    $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
        					    $('#sel_risk_2nd_sub_category').val(data_risk['risk_2nd_sub_category']);
        					    Metronic.unblockUI();
        					});
        				});
        			});
        		});
        		
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
                        'revised_date':val.revised_date,
                        'existing_control_id':val.existing_control_id
                    };
                    me.actionPlanAddRow(nnode);
                });
                
                me.controlReset();
                $.each( data_risk['control_list'], function( key, val ) {
                    var ecid = val.ec_id;
                    if (val.ec_id == null) ecid = '';
                    var nnode = {
                        'ec_id' : ecid,
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
        selectControlLibrary: function(rid) {
        	var me = this;
        	$('#input-form-control textarea[name=risk_existing_control]').attr('readonly', false);
            $('#input-form-control text[name=ec_id]').attr('readonly', false);
        	
        	$('#modal-control').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadControlLibrary/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['control_id'] = data_risk['ec_id'];
        		
        		me.populateRisk($('#input-form-control'), data_risk);
        	});
        },
        selectControlLibraryobjective: function(rid) {
            var me = this;
            $('#input-form-control-objective textarea[name=objective]').attr('readonly', false);
            $('#input-form-control-objective text[name=objid]').attr('readonly', false);
            
            $('#modal-objective').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadControlLibraryobjective/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['objective_id'] = data_risk['objid'];
                
                me.populateRisk($('#input-form-control-objective'), data_risk);
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
		 selectLibraryaction: function(rid) {
        	var me = this;
			
            //document.getElementById("check_date").checked = false;

        	$('#modal-libraryaction').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	$.getJSON( site_url+"/risk/RiskRegister/loadactionLibrary/"+rid, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		data_risk['action_plan'] = data_risk['action_plan'];
        		
        		me.populateRisk($('#input-form-action-plan'), data_risk);
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
        filterLibrary: function() {
        	var fval = $('#modal-library div.inputs input[name=filter_search]')[0].value;
        	gridLibrary.clearAjaxParams();
        	gridLibrary.setAjaxParam("filter_library", fval);
        	gridLibrary.getDataTable().ajax.reload();	
        },
		 filterLibraryAction: function() {
        	var fval = $('#modal-libraryaction div.inputs input[name=filter_search]')[0].value;
        	gridLibraryaction.clearAjaxParams();
        	gridLibraryaction.setAjaxParam("filter_library", fval);
        	gridLibraryaction.getDataTable().ajax.reload();	
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

         filterRiskInputBy: function() {
            var fval = $('#modal-delete div.inputs input[name=filter_search]')[0].value;
            gridRiskInputBy.clearAjaxParams();
            gridRiskInputBy.setAjaxParam("filter_library", fval);
            gridRiskInputBy.getDataTable().ajax.reload();   
        },
        submitRiskData: function() {
        	var form1 = $('#primary-input-form').validate();
        	var fvalid = form1.form();
        	if (fvalid) {
	        	var me = this;
	        	var param = $('#primary-input-form').serializeArray();
	        	
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

                // prepare Objective data
                var objective_param = {};
                var cnt = 0;
                $.each(me.dataControlobjective, function(key, value) { 
                    objective_param['objective['+cnt+'][objective_id]'] = value.id;
                    objective_param['objective['+cnt+'][objid]'] = value.objid;
                    objective_param['objective['+cnt+'][objective]'] = value.objective;
                    cnt++;
                });
                
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at least One Objective for this Risk');
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
                    actplan_param['actplan['+cnt+'][existing_control_id]'] = value.existing_control_id;          
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
                
	        	Metronic.blockUI({ boxed: true });
	        	var url = site_url+'/risk/RiskRegister/insertRiskData';
	        	$.post(
	        		url,
	        		$( "#primary-input-form" ).serialize()+ '&' + $.param(impact_param)+ '&' + $.param(actplan_param)+ '&' + $.param(control_param)+ '&' + $.param(objective_param),
	        		function( data ) {
	        			Metronic.unblockUI();
	        			if(data.success) {
	        				var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Risk');
	        				mod.find('button.btn-ok-success').one('click', function(){
	        					//location.href=site_url+'/risk/RiskRegister/RiskRegisterInput/'+me.dataMode;
                                if(g_submit_mode == 'adhoc'){
                                location.href=site_url+'/main';
                                }else if(g_submit_mode == 'periodic'){
                                location.href=site_url+'/risk/RiskRegister';
                                }else{
                                location.href=site_url+'/risk/RiskRegister/blblbl';
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
                    var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Risk');
                            mod.find('button.btn-ok-success').one('click', function(){
                                //location.href=site_url+'/risk/RiskRegister/RiskRegisterInput/'+me.dataMode;
                                if(g_submit_mode == 'adhoc'){
                                location.href=site_url+'/main';
                                }else if(g_submit_mode == 'periodic'){
                                location.href=site_url+'/risk/RiskRegister';
                                }else{
                                location.href=site_url+'/risk/RiskRegister/blblbl';
                                }
                            });
	        	 });
	        }
        }
	 }
}();