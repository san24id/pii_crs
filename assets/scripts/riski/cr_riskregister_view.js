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
        	me.loadRiskPrimary(g_change_id);
        	me.loadRisk(g_change_id);
        	
        	$('#verify-risk-button-cancel').on('click', function() {
        		location.href=site_url+'/main#tab_change_request_list';
        	});
        },
        loadRiskPrimary: function(rid) {
        	var me = this;
        	
        	Metronic.blockUI({ boxed: true });
        	
        	var gurl = site_url+"/risk/RiskRegister/loadChangeRequest/primary/"+rid;
        	if (g_status == '1') {
        		gurl = site_url+"/risk/RiskRegister/loadChangeRequest/primary/"+rid;
        	}
        	
        	$.getJSON( gurl, function( data_risk ) {
        		Metronic.unblockUI();
        		
        		me.populateRisk($('#primary-input-form'), data_risk);

        		me.primaryactionPlanReset();
        		$.each( data_risk['action_plan_list'], function( key, val ) {
        			var nnode = {
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division,
        				'data_flag' : val.data_flag,
        				'change_flag' : val.change_flag
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
        loadRisk: function(rid) {
        	var me = this;
        	
        	$('#modal-library').modal('hide');
        	Metronic.blockUI({ boxed: true });
        	
        	var gurl = site_url+"/risk/RiskRegister/loadChangeRequest/changes/"+rid;
        	if (g_status == '1') {
        		gurl = site_url+"/risk/RiskRegister/loadChangeRequest/changes/"+rid;
        	}
        	
        	$.getJSON( gurl, function( data_risk ) {
        		Metronic.unblockUI();
        		me.populateRisk($('#input-form'), data_risk);
        		
        		me.actionPlanReset();
        		$.each( data_risk['action_plan_list'], function( key, val ) {
        			var nnode = {
        				'action_plan' : val.action_plan,
        				'due_date' : val.due_date_v,
        				'division_v' : val.division_v,
        				'division' : val.division,
        				'data_flag' : val.data_flag,
        				'change_flag' : val.change_flag
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
        	
        	if (g_status == '1') {
        		if (nnode.change_flag == 'DELETE') return false;
        	} else {
        		if (nnode.change_flag == 'ADD') return false;
        	}

            if(nnode.due_date == '00-00-0000'){
                nnode.due_date = 'Continuous'; 
            }
        	
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
        	
        	me.dataControlCounter++;

        	$('#control_table > tbody:last-child').append('<tr>'+
        		'<td>'+nnode.existing_control_id+'</td>'+
        		'<td>'+nnode.risk_existing_control+'</td>'+
        		'<td>'+nnode.risk_evaluation_control+'</td>'+
        		'<td>'+nnode.risk_control_owner+'</td>'+
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

			//if (nnode.change_flag == 'DELETE') return false;
        	
        	if (nnode.data_flag == 'LOCKED') {
        		act_str = 'ASSIGNED';
        	} else {
        		act_str = nnode.change_flag;
        	}
        	
        	me.dataActionPlanCounter++;
        	
        	$('#action_plan_table > tbody:last-child').append('<tr data-id="'+me.dataActionPlanCounter+'">'+
        		'<td>'+nnode.action_plan+'</td>'+
        		'<td>'+nnode.due_date+'</td>'+
        		'<td>'+nnode.division_v+'</td>'+
        		'<td></td>'+
        	'</tr>');
        	
        	me.actionPlanAdd(nnode, me.dataActionPlanCounter);
        },
        actionPlanEditRow: function(tdata, nnode) {
        	var me = this;
        	var xid = tdata.rowid;
        	
        	var act_str = '<div class="btn-group">'+
        		'<button type="button" class="btn btn-default btn-xs button-grid-edit" data-id="'+xid+'"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
        		'<button type="button" class="btn btn-default btn-xs button-grid-delete" data-id="'+xid+'"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
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
        }
	 }
}();