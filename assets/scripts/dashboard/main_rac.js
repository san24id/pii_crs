var apid = $('#ap_id').val();
var apst = $('#ap_sts').val();

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

var gridRiskList = new Datatable();
gridRiskList.init({
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
        "stateSave" : true,    
        "ajax": {
            "url": site_url+"/main/mainrac/getAllRisk" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0' || data == '1') {
        			img = 'draft.png';
        		} else if (data == '2') {
        			img = 'submit.png';
        		} else if (data == '3') {
        			//img = 'verified.png';
                    img = 'treatment.png';
        		}else if (data == '4' || data == '5') {
        			img = 'treatment.png';
        		}else if (data == '6') {
        			img = 'actplan.png';
        		}else if (data == '10') {
                    img = 'executed_2.png';
                }else if (data == '20') {
        			img = 'executed.png';
        		}

                if(full.risk_evaluation_control == 'adhoc'){
        		  return '<center>Adhoc<br /><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
                }else{
                   return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
                }
        	}
        }, {
        	"targets": 1,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
                if (full.risk_status >= 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                } 
        		
           	}
        },{
            "targets": 10,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var img = '';
               if (data == '3' || data == '4' || data == '5') {
                    img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

                        '</div>';
                }else{
                    img = '';
                }
                return '<center>'+img+'</center>';
            }
        } ],
        "columns": [
			{ "data": "risk_status","orderable":true},
			{ "data": "risk_code" },
			{ "data": "risk_event" },
			{ "data": "risk_level_v" },
			{ "data": "impact_level_v" },
			{ "data": "likelihood_v" },
            { "data": "risk_level_after_mitigation_v" },
            { "data": "impact_level_after_mitigation_v" },
            { "data": "likelihood_after_mitigation_v" },
			{ "data": "risk_owner_v" },
            { "data": "risk_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRegister = new Datatable();
gridRegister.init({
    src: $("#datatable_risk_register"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getUserList" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '0' || data == '1') {
        			img = 'draft.png';
        		} else if (data == '2') {
        			img = 'submit.png';
        		} else  {
        			img = 'verified.png';
        		}
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "display_name",
        	"render": function ( data, type, full, meta ) {
        		return '<a target="_self" href="'+site_url+'/main/mainrac/riskRegister/'+full.username+'">'+data+'</a>';
        	}
        },{
            "targets": 5,
            "data": "risk_treatment_owner_v",
            "render": function ( data, type, full, meta ) {
                var ret = full.risk_treatment_owner_v;
                if (data == '' || data == null) {
                    ret =  '<div class="btn-group">'+
                             '<button type="button" class="btn btn-primary btn-xs button-grid-edit"><i class="fa fa-plus"> Add Note </i></button>'+
                           '</div>';
                }else{
                    ret =  '<div class="btn-group">'+
                            '<button type="button" class="btn btn-primary btn-xs button-grid-edit"><i class="fa fa-plus"> Add Note </i></button>'+
                           '</div>';
                }
                return ret;
            }
        } ],
        "columns": [
			{ "data": "risk_status","orderable":true},
			{ "data": "display_name" },
			{ "data": "division_name" },
            { "data": "tanggal_submit" },
            { "data": "note" },
            { "data": "username" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var gridTreatment = new Datatable();
gridTreatment.init({
    src: $("#datatable_risk_treatment"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getTreatmentList" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "risk_status",
        	"render": function ( data, type, full, meta ) {
        		var img = '';
        		if (data == '5') {
        			img = 'submit.png';
                }else if(full.risk_existing_control == 'under'){ 
                    img = 'default.png';
        		}else if (data == '3') {
                    img = 'draft.png';
                }else if (data == '4') {
                    img = 'draft.png';
                }else {
        			img = 'verified.png';
        		}
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "risk_id",
        	"render": function ( data, type, full, meta ) {
        		if (full.risk_status == 5) {
        			return '<a target="_self" href="'+site_url+'/main/mainrac/riskTreatmentForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
        		}
                
        		//return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
        	}
        },{
            "targets": 5,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var img = '';
               if (data == '3' || data == '4' || data == '5') {
                    img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+

                        '</div>';
                }else{
                    img = '';
                }
                return '<center>'+img+'</center>';
            }
        }],
        "columns": [
			{ "data": "risk_status","orderable":true},
			{ "data": "risk_code" },
			{ "data": "risk_event" },
			{ "data": "risk_owner_v" },
			{ "data": "suggested_risk_treatment_v" },
            { "data": "risk_status" }
       ],
        "order": [
            [0, "desc"], [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionPlan = new Datatable();
gridActionPlan.init({
    src: $("#datatable_action_plan"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getActionPlan" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id_p",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (full.action_plan_status == 1) {
                    img = 'draft.png';
                } else if (full.action_plan_status == 2) {
                    img = 'verified_head.png';
                }else if (full.action_plan_status == 3) {
                    img = 'submit.png';
                }else if (full.action_plan_status > 3) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "risk_id",
            "render": function ( data, type, full, meta ) {
                if (full.action_plan_status == 3 ) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanForm/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                //return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ap">'+data+'</a>';
                }
            }
        },{
            "targets":2,
            "data":"action_plan",
            "render":function(data, type, full, meta){
                if(full.action_plan_status == 3){
                    if(full.haction_plan == null){
                        return data;
                    }else{
                        return full.haction_plan;
                    }
                }else{
                    return data;
                }
            }
        },{
            "targets": 3,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
             if(full.action_plan_status == 3){
                    if(full.hdue_date_v == null){
                        if(data == '00-00-0000'){
                            dd = 'Continuous';
                        }else{
                            dd = data;
                        }
                        return dd;
                    }else{
                        if(full.hdue_date_v == '00-00-0000'){
                            hdd = 'Continuous';
                        }else{
                            hdd = full.hdue_date_v;
                        }
                        return hdd;
                    }
                }else{
                        if(data == '00-00-0000'){
                            dd = 'Continuous';
                        }else{
                            dd = data;
                        }
                        return dd;
                }
            }
        }, {
            "targets":4,
            "data":"division_name",
            "render":function(data, type, full, meta){
                if(full.action_plan_status == 3){
                    if(full.hdivision == null){
                        return data;
                    }else{
                        return full.hdivision;
                    }
                }else{
                    return data;
                }
            }
        } ],
        "columns": [
            { "data": "action_plan_status","orderable":true},
            { "data": "act_code" },
            { "data": "action_plan"},
            { "data": "due_date_v" },
            { "data": "division_name" },
            { "data": "risk_code" },
            { "data": "risk_owner_v"}
       ],
        "order": [
            [0, "desc"],  [1, "asc"] 
        ]// set first column as a default sort by asc
    }
});

var gridActionExec = new Datatable();
gridActionExec.init({
    src: $("#datatable_action_plan_exec"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getActionPlanExec" // ajax source
        },
        "columnDefs": [
            /*{
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 4) {
                    img = 'draft.png';
                } else if (data == 5) {
                    img = 'verified_head.png';
                } else if (data == 6) {
                    img = 'submit.png';
                }else if (data > 6) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },
        {
            "targets": 3,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        },
         {
            "targets": 1,
            "data": "act_code",
             "render": function ( data, type, full, meta ) {
                if (full.action_plan_status == 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanForm/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else if(full.action_plan_status == 7){
                     return '<a target="_self" href="'+site_url+'/main/mainrac/FormactionPlanExec/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{       
                    //return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ec">'+data+'</a>';
                }
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }
            }
        }, {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                if(data == null){
                    

                var ext = '';
                var search = false;
                var submit = false;

                if(full.status_periode == 0){
                //var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Search </i></button>';
                //var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                var search_text = '';
                var submit_text = '';
                //return 'PROCESS';
                }else if(full.status_periode == 1){
                var search_text = '';
                var submit_text = '';
                }

                data_v = '';
                if (data == 'EXTEND') data_v = 'Extend';
                if (data == 'COMPLETE') data_v = 'Complete';
                if (data == 'ONGOING') data_v = 'On Going';
                
                if (full.is_owner == 1) {
                    search = true;
                    if (data_v != '' && full.action_plan_status == 4) submit = true;
                    if (data_v != '' && full.action_plan_status == 5 && full.is_head == 1) submit = true;
                } else {
                    if (data_v != '') search = true;
                    if (data_v != '' && full.action_plan_status == 5) submit = true;
                }
                 
                
                if (!search) search_text = '';
                if (!submit) submit_text = '';
                
                var ret = data_v+' &nbsp; <div class="btn-group">'+
                        search_text+
                        submit_text+
                    '</div>'
                return ret;


                }else{  
                     if(full.action_plan_status == 6){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanExecForm/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                            }else if(full.action_plan_status == 7){
                                return data;
                            }else{
                                return '';
                            }
                }
                
            }
        }
        {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {

                
                
            }
        } */

        {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (full.existing_control_id == 'review') {
                    img = 'executed_2.png';
                } else if (full.existing_control_id == 2) {
                    img = 'actplan.png';
                } else if (data == 4 || data == 5) {
                    img = 'draft.png';
                } else if (data == 6) {
                    img = 'submit.png';
                }else if (data > 6) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },{
            "targets": 3,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        },{
            "targets": 1,
            "data": "act_code",
             "render": function ( data, type, full, meta ) {
                if (full.action_plan_status == 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanForm/'+full.id_p+'/'+full.action_plan_status+'">AP.'+data+'</a>';
                }else if(full.action_plan_status == 7){
                     return '<a target="_self" href="'+site_url+'/main/mainrac/FormactionPlanExec/'+full.id_p+'/'+full.action_plan_status+'?kat=pri">AP.'+data+'</a>';
                }else{       
                    //return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ec">AP.'+data+'</a>';
                }
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/risk_list_prior_ap?status=ap&&id='+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }
            }
        }, {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                if(data == null){
                    

                var ext = '';
                var search = false;
                var submit = false;
                
                //var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Search </i></button>';
                //var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                var search_text = '';
                var submit_text = '';
                //return 'PROCESS';


                data_v = '';
                if (data == 'EXTEND') data_v = 'Extend';
                if (data == 'COMPLETE') data_v = 'Complete';
                if (data == 'ONGOING') data_v = 'On Going';
                
                if (full.is_owner == 1) {
                    search = true;
                    if (data_v != '' && full.action_plan_status == 4) submit = true;
                    if (data_v != '' && full.action_plan_status == 5 && full.is_head == 1) submit = true;
                } else {
                    if (data_v != '') search = true;
                    if (data_v != '' && full.action_plan_status == 5) submit = true;
                }
                 
                
                if (!search) search_text = '';
                if (!submit) submit_text = '';
                
                var ret = data_v+' &nbsp; <div class="btn-group">'+
                        search_text+
                        submit_text+
                    '</div>'
                return ret;


                }else{
                    if(full.existing_control_id == 'review'){
                                return data;    
                     }else if(full.action_plan_status == 6 || full.action_plan_status == 7){
                            //return '<a  href="'+site_url+'/main/mainrac/actionPlanExecFormPrior/'+full.id_p+'/'+full.action_plan_status+'" target="_self">'+data+'</a>';
                            return '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-sm button-grid-verify"><i class="fa font-blue">'+data+'</i></button>'+
                            '</div>';
                            }else{
                                return '';
                            }
                }
                
            }
        },{
            "targets": 11,
            "data": "existing_control_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var imge = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil-square-o font-blue"> Edit </i></button>'+

                        '</div>';
                if(data != 2){
                    img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-ignore"><i class="fa fa-trash-o font-red"> Ignore </i></button>'+

                        '</div>';
                }else if(data == 2){
                     img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-accept"><i class="fa fa-check-circle font-blue"> Accept </i></button>'+
                        '</div>';
                }
                return '<center>'+imge+'</center>'+'<br/><center>'+img+'</center>';
            }
        }],
        "columns": [
			{ "data": "action_plan_status","orderable":true},
			{ "data": "act_code" },
			{ "data": "action_plan" },
			{ "data": "due_date_v" },
			{ "data": "division_name" },
			{ "data": "execution_status" },
            { "data": "risk_code" },
            { "data": "risk_owner_v" },
            { "data": "risk_level_after_mitigation_v" },
            { "data": "impact_level_after_mitigation_v" },
            { "data": "likelihood_after_mitigation_v" },
            { "data": "existing_control_id" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var gridActionExec_adt = new Datatable();
gridActionExec_adt.init({
    src: $("#datatable_action_plan_exec_adt"),
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
            "url": site_url+"/main/mainrac/getActionPlanExec_adt" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "action_plan_status",
        	"render": function ( data, type, full, meta ) {
        		var img = 'default.png';
        		if (data == 4) {
        			img = 'draft.png';
        		} else if (data == 5) {
        			img = 'verified_head.png';
        		} else if (data == 6) {
        			img = 'submit.png';
        		}else if (data > 6) {
        			img = 'verified.png';
        		}
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "act_code",
        	"render": function ( data, type, full, meta ) {
        		return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
        	}
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
        	"targets": 5,
        	"data": "execution_status",
			 
        	"render": function ( data, type, full, meta ) {
        	 
				if(data == null){
					return '';
				}else if(full.action_plan_status == 6 ){                   
                   return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanExecForm/'+full.id+'">'+data+'</a>';
                }else{					 
					return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanExecForm/'+full.id+'/view">'+data+'</a>';
				}
        	}
        } ],
        "columns": [
			{ "data": "action_plan_status" },
			{ "data": "act_code" },
			{ "data": "action_plan" },
			{ "data": "due_date_v" },
			{ "data": "division_name" },
			{ "data": "execution_status" },
            { "data": "risk_code" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridActionExec_prior = new Datatable();
gridActionExec_prior.init({
    src: $("#datatable_action_plan_exec_prior"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getActionPlanExec_prior" // ajax source
               // "data": function ( d ) {
                //d.periodeid = g_periode_id;
                //MainApp.viewGlobalModal('error', d.msg);
            //}
        },
         "columnDefs": [ {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 4) {
                    img = 'draft.png';
                } else if (data == 5) {
                    img = 'verified_head.png';
                } else if (data == 6) {
                    img = 'submit.png';
                }else if (data > 6) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        },
          {
            "targets": 3,
            "data": "due_date_v",
            "render": function ( data, type, full, meta ) {
                if(data == '00-00-0000'){
                    dd = 'Continuous';
                }else{
                    dd = data;
                }
                return dd;
            }
        },
         {
            "targets": 1,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id_p+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                if(data == null){
                    

                var ext = '';
                var search = false;
                var submit = false;

                if(full.status_periode == 0){
                //var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Search </i></button>';
                //var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                var search_text = '';
                var submit_text = '';
                //return 'PROCESS';
                }else if(full.status_periode == 1){
                var search_text = '';
                var submit_text = '';
                }

                data_v = '';
                if (data == 'EXTEND') data_v = 'Extend';
                if (data == 'COMPLETE') data_v = 'Complete';
                if (data == 'ONGOING') data_v = 'On Going';
                
                if (full.is_owner == 1) {
                    search = true;
                    if (data_v != '' && full.action_plan_status == 4) submit = true;
                    if (data_v != '' && full.action_plan_status == 5 && full.is_head == 1) submit = true;
                } else {
                    if (data_v != '') search = true;
                    if (data_v != '' && full.action_plan_status == 5) submit = true;
                }
                 
                
                if (!search) search_text = '';
                if (!submit) submit_text = '';
                
                var ret = data_v+' &nbsp; <div class="btn-group">'+
                        search_text+
                        submit_text+
                    '</div>'
                return ret;


                }else{  
                     if(full.action_plan_status > 5){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanExecForm/'+full.id_p+'">'+data+'</a>';
                            }else{
                                return '';
                            }
                }
                
            }
        }
        /*{
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {

                
                
            }
        } */],
        "columns": [
            { "data": "action_plan_status","orderable":true },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "division_name" },
            { "data": "execution_status" },
            { "data": "risk_code" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_kri = new Datatable();
grid_kri.init({
    src: $("#datatable_kri"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getKri" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "kri_status",
        	"render": function ( data, type, full, meta ) {
        		var img = 'default.png';
        		if (data == 0) {
                    img = 'save_draft_kri.png';
                } else if (data == 1 || data == 2) {
                    img = 'draft.png';
                } else if (data == 3) {
                    img = 'submit.png';
                }else if (data > 3) {
                    img = 'verified.png';
                }
        		return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
        	}
        }, {
        	"targets": 1,
        	"data": "kid",
        	"render": function ( data, type, full, meta ) {
                var stat = full.status_periode;
        		var ret = full.kri_pic_v;
        		var dat = '';
                if(stat == 1){
                    //return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriDesignation/'+full.id+'">'+data+'</a>';
                    if(full.kri_status == 0){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                            }else{
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                        }
                }else{
        		      if (ret == '' || ret == null) {
                            if(full.kri_status == 0){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                            }else{
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                            }
        			    
        		      } else {
        			         if(full.kri_status == 0){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                            }else{
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                            }
        		      }
                }
        		return dat;
        	}
        }, {
        	"targets": 5,
        	"data": "risk_code",
        	"render": function ( data, type, full, meta ) {
        		return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
        	}
        }, {
        	"targets": 6,
        	"data": "kri_warning",
        	"render": function ( data, type, full, meta ) {
        		if (data != '' && data != null) {
            		var img = data.toLowerCase();

                    if(img == 'red'){
                        img = base_url+'assets/images/legend/kri_'+img+'.gif';
                    }else{
                        img = base_url+'assets/images/legend/kri_'+img+'.png';
                    }
            		return '<img src="'+img+'"/>';
        		} 
        		return '';
        	}
        } ],
        "columns": [
			{ "data": "kri_status","orderable":true },
			{ "data": "kid" },
			{ "data": "key_risk_indicator" },
			{ "data": "kri_owner_v" },
			{ "data": "timing_pelaporan_v" },
			{ "data": "risk_code" },
			{ "data": "kri_warning" }
       ],
        "order": [
            [0, "desc"], [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_cr = new Datatable();
grid_cr.init({
    src: $("#datatable_cr"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getChangeRequest" // ajax source
        },
        "columnDefs": [ {
         	"targets": 1,
         	"data": "cr_code",
         	"render": function ( data, type, full, meta ) {
         		var cls = 'font-green-jungle';
         		if (full.cr_type == 'Risk Register') {
         			var vm = 'risk/RiskRegister/ChangeRequestRac';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.created_by+'?status=change">'+data+'</a>';
         		}else  if (full.cr_type == 'Action Plan Form') {
                        if(full.cr_status == '1'){
                            var vm = 'main/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'main/mainrac/ChangeRequestActionVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                }else  if (full.cr_type == 'Action Plan Execution Form') {
                        if(full.cr_status == '1'){
                            var vm = 'main/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'main/mainrac/ChangeRequestActionExeVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                }else  if (full.cr_type == 'Action Plan Execution Prior Form') {
                        if(full.cr_status == '1'){
                            var vm = 'main/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'main/mainrac/ChangeRequestActionExePriorVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                
                }else  if (full.cr_type == 'Risk Form') {
                        if(full.cr_status == '1'){
                            var vm = 'main/mainrac/ChangeRequestView';
                        }else{
                            var vm = 'main/mainrac/ChangeRequestVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                    
                }else  if (full.cr_type == 'Risk Form Library') {
                        if(full.cr_status == '1'){
                            var vm = 'main/mainrac/ChangeRequestView';
                        }else{
                            var vm = 'main/mainrac/ChangeRequestVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                
                }else if (full.cr_status == '1') {
                    var vm = 'main/mainrac/ChangeRequestView';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                } else {
         			var vm = 'main/mainrac/ChangeRequestVerify';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
         		}
         		
         	}
         },{
            "targets": 6,
            "data": null,
            "render": function ( data, type, full, meta ) {
                
                if (full.cr_status == '1') {
                    return '<div class="btn-group">'+  
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red">    Delete</i></button>'+
                '</div>';
                }else if (full.cr_status == '0') {
                    return '---';
                } else {
                    return '---';
                }
            }
         },{
         	"targets": 4,
         	"data": "cr_status",
         	"render": function ( data, type, full, meta ) {
         		if (data == '1') return '<i class="fa fa-bell-o font-black"> Complete </i>';
         		if (data == '0') return '<i class="fa fa-bell font-black"> Pending </i>';
         		return '<i class="fa fa-bell-slash font-black"> Undefined </i>';
         	},
         }],
         "columns": [
        		{ "data": "GenRowNum" },
        		{ "data": "ch_code" },
        		{ "data": "cr_type" },
        		{ "data": "created_by_v" },
        		{ "data": "cr_status" },
                { "data": "created_date" },
                {
            "data": null,
           // "orderable": false,
           // "defaultContent": '<div class="btn-group">'+
           // '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"></i></button>'+
           // '</div>'
           
           }
        ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});
var gridOldRisk = new Datatable();
gridOldRisk.init({
    src: $("#datatable_old_risk"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getAllOldRisk" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var img = '';
                if (data == '0' || data == '1') {
                    img = 'draft.png';
                } else if (data == '2') {
                    img = 'submit.png';
                } else if (data == '3' || data == '4') {
                    //img = 'verified.png';
                    img = 'treatment.png';
                }else if (data == '5') {
                    img = 'treatment.png';
                }else if (data == '6') {
                    img = 'actplan.png';
                }else if (data == '10') {
                    img = 'executed_2.png';
                }else if (data == '20') {
                    img = 'executed.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                if (full.risk_status >= 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewRiskOR/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                } 
                
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "impact_level_v" },
            { "data": "likelihood_v" },
            { "data": "risk_level_after_mitigation_v" },
            { "data": "impact_level_after_mitigation_v" },
            { "data": "likelihood_after_mitigation_v" },
            { "data": "risk_owner_v" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var grid_kri_non_mitigation = new Datatable();
grid_kri_non_mitigation.init({
    src: $("#datatable_kri_non_mitigation"),
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
        "stateSave" : true, 
        "ajax": {
            "url": site_url+"/main/mainrac/getKri_non" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "kri_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 0) {
                    img = 'save_draft_kri.png';
                } else if (data == 1 || data == 2) {
                    img = 'draft.png';
                } else if (data == 3) {
                    img = 'submit.png';
                }else if (data > 3) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "kid",
            "render": function ( data, type, full, meta ) {
                 var stat = full.status_periode;
                var ret = full.kri_pic_v;
                var dat = '';
                if(stat == 1){
                        //return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriDesignation/'+full.id+'">'+data+'</a>';
                    if(full.kri_status == 0){
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                            }else{
                                return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                            }
                }else{
                    if (ret == '' || ret == null) {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                        }
                            
                    } else {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                        }
                    }
                }
                return dat;
            }
        }, {
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "kri_warning",
            "render": function ( data, type, full, meta ) {
                if (data != '' && data != null) {
                    var img = data.toLowerCase();

                    if(img == 'red'){
                        img = base_url+'assets/images/legend/kri_'+img+'.gif';
                    }else{
                        img = base_url+'assets/images/legend/kri_'+img+'.png';
                    }
                    return '<img src="'+img+'"/>';
                } 
                return '';
            }
        } ],
        "columns": [
            { "data": "kri_status" },
            { "data": "kid" },
            { "data": "key_risk_indicator" },
            { "data": "kri_owner_v" },
            { "data": "timing_pelaporan_v" },
            { "data": "risk_code" },
            { "data": "kri_warning" }
       ],
        "order": [
            [0, "desc"], [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskaction = new Datatable();
gridRiskaction.init({
    src: $("#risklist_action"),
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
            "url": site_url+"/main/mainrac/getRiskAciton_now/"+apid+'/'+apst // ajax source
        },
        "columnDefs": [{
            "targets": 0,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                if (full.risk_status >= 3) {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                } 
                
            }
        } ],
        "columns": [
            { "data": "risk_code", "orderable": true },
            {"data":  "risk_event"},
            {"data":  "risk_description"},
            {"data":  "ap_code"},
            {"data":  "impact_level_v"},
            {"data":  "likelihood_v"},
            {"data":  "risk_level_v"},
            {"data":  "impact_level_v_after_mitigation"},
            {"data":  "likelihood_v_after_mitigation"},
            {"data":  "risk_level_v_after_mitigation"}  
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var Dashboard = function() {
    return {
        tmpRiskId: null,
        init: function() {
            var me = this;

            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    todayHighlight: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };

            // TAB SEARCH RISK LIST
            $('#choose_s_level').hide();
            $('#choose_r_level').hide();
            $('#choose_l_hood').hide();
            $('#choose_impact_l').hide();
            $('#choose_l_divisi').hide();
            $('#tab_risk_list-filterValue').hide();
            $('#risk_search').hide();


            $('#tab_risk_list-filterBy').change(function(){
                var risk_list = $('#tab_risk_list-filterBy').val();

                var risk_list_filter = $("option:selected", this).attr('data-FilterRiskList');
                $('input[id="rl_1"]').attr('value', risk_list_filter);

                if(risk_list == "choose"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                    $('#rl_1').val('');
                    $('#rl_2').val('');
                }
                else if(risk_list == "risk_code"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').show();
                }else if(risk_list == "risk_event"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').show();
                }else if(risk_list == "risk_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_impact_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_likelihood_key"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                }else if(risk_list == "risk_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_impact_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_likelihood_key_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_owner"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').show();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                } else if(risk_list == "risk_status"){
                    $('#choose_s_level').show();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#risk_search').hide();
                }

            });

            $('#r_level').change(function(){
                var risk_level = $('#r_level').val();
                var risk_level2 = $("option:selected", this).attr('data-RiskLevel');
                $('input[id="tab_risk_list-filterValue"]').attr('value', risk_level);
                $('input[id="rl_2"]').attr('value', risk_level2);
                if(risk_level == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#l_hood').change(function(){
                var likelihood = $("option:selected", this).attr('data-likelihood');
                var likelihood2 = $("option:selected", this).attr('data-likelihood2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', likelihood);
                $('input[id="rl_2"]').attr('value', likelihood2);
                var l_hood = $('#l_hood').val();
                if(l_hood == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#impact_l').change(function(){
                var impact_level = $("option:selected", this).attr('data-impact');
                var impact_level2 = $("option:selected", this).attr('data-impact2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', impact_level);
                $('input[id="rl_2"]').attr('value', impact_level2);
                var impact_l = $('#impact_l').val();
                if(impact_l == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#l_divisi').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_risk_list-filterValue"]').attr('value', division_list);
                $('input[id="rl_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi').val();
                if(l_divisi == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All');
                }
            });

            $('#s_level').change(function(){
                var risk_status = $('#s_level').val();
                var risk_status2 = $("option:selected", this).attr('data-RiskStatusLevel');
                $('input[id="tab_risk_list-filterValue"]').attr('value', risk_status);
                $('input[id="rl_2"]').attr('value', risk_status2);
                if(risk_status == "-"){
                    $('#tab_risk_list-filterValue').val('');
                    $('#rl_2').val('All Status');
                }
            });
            //---------------------Register
             $('#choose_l_divisi-register').hide();
             $('#tab_risk_register_list-filterValue').hide();
             $('#choose_s_level-register').hide();
             $('#register_search').hide();

            $('#tab_risk_register_list-filterBy').change(function(){
                var risk_register = $('#tab_risk_register_list-filterBy').val();

                var risk_list_filter = $("option:selected", this).attr('data-FilterRiskList');
                $('input[id="rg_1"]').attr('value', risk_list_filter);

                 if(risk_register == "choose"){
                    $('#choose_s_level-register').hide();
                    $('#choose_l_divisi-register').hide();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#register_search').hide();
                    $('#rg_1').val('');
                    $('#rg_2').val('');
                 }else if(risk_register == "display_name"){
                    $('#choose_s_level-register').hide();
                    $('#choose_l_divisi-register').hide();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#register_search').show();
                 }else if(risk_register == "division_name"){
                    $('#choose_s_level-register').hide();
                    $('#choose_l_divisi-register').show();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#register_search').hide();
                 }else if(risk_register == "risk_status"){
                    $('#choose_s_level-register').show();
                    $('#choose_l_divisi-register').hide();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#register_search').hide();
                }
            });

            $('#l_divisi-register').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_risk_register_list-filterValue"]').attr('value', division_list);
                $('input[id="rg_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi-register').val();
                if(l_divisi == "-"){
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#rg_2').val('All');
                }
            });

            $('#s_level-register').change(function(){
                var risk_status = $('#s_level-register').val();
                $('input[id="tab_risk_register_list-filterValue"]').attr('value', risk_status);
                var risk_status2 = $("option:selected", this).attr('data-status');
                $('input[id="rg_2"]').attr('value', risk_status2);
                if(risk_status == "-"){
                    $('#tab_risk_register_list-filterValue').val('');
                    $('#rg_2').val('All');
                }
            });

            //--------------------treatment
            $('#choose_l_divisi-treatment').hide();
            $('#choose_s_level-treatment').hide();
            $('#choose_risk-treatment').hide();
            $('#treatment_search').hide();

            $('#tab_treatment_list-filterBy').change(function(){
                var risk_treatment = $('#tab_treatment_list-filterBy').val();

                var risk_list_filter = $("option:selected", this).attr('data-FilterRiskList');
                $('input[id="rt_1"]').attr('value', risk_list_filter);
                 
                if(risk_treatment == "choose"){
                    $('#choose_s_level-treatment').hide();
                    $('#choose_l_divisi-treatment').hide();
                    $('#treatment_search').hide();
                    $('#tab_treatment_list-filterValue').val('');
                    $('#choose_risk-treatment').hide();
                    $('#rt_1').val('');
                    $('#rt_2').val('');
                 }else if(risk_treatment == "risk_code"){
                    $('#choose_s_level-treatment').hide();
                    $('#choose_l_divisi-treatment').hide();
                    $('#treatment_search').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_event"){
                    $('#choose_s_level-treatment').hide();
                    $('#choose_l_divisi-treatment').hide();
                    $('#treatment_search').show();
                    $('#tab_treatment_list-filterValue').val('');
                    $('#choose_risk-treatment').hide();
                 }else if(risk_treatment == "risk_owner"){
                    $('#choose_s_level-treatment').hide();
                    $('#choose_l_divisi-treatment').show();
                    $('#treatment_search').hide();
                    $('#tab_treatment_list-filterValue').val('');
                    $('#choose_risk-treatment').hide();
                }else if(risk_treatment == "suggested_risk_treatment"){
                    $('#choose_s_level-treatment').hide();
                    $('#choose_l_divisi-treatment').hide();
                    $('#treatment_search').hide();
                    $('#tab_treatment_list-filterValue').val('');
                    $('#choose_risk-treatment').show();
                }else if(risk_treatment == "risk_status"){
                    $('#choose_s_level-treatment').show();
                    $('#choose_l_divisi-treatment').hide();
                    $('#treatment_search').hide();
                    $('#tab_treatment_list-filterValue').val('');
                    $('#choose_risk-treatment').hide();
                }
            });

            $('#l_divisi-treatment').change(function(){

                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_treatment_list-filterValue"]').attr('value', division_list);
                $('input[id="rt_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi-treatment').val();
                if(l_divisi == "-"){
                    $('#tab_treatment_list-filterValue').val('');
                    $('#rt_2').val('All');
                }
            });

            $('#s_level-treatment').change(function(){
                var risk_status = $('#s_level-treatment').val();
                var risk_status2 = $("option:selected", this).attr('data-treatlevel');
                $('input[id="tab_treatment_list-filterValue"]').attr('value', risk_status);
                $('input[id="rt_2"]').attr('value', risk_status2);
                if(risk_status == "-"){
                    $('#tab_treatment_list-filterValue').val('');
                    $('#rt_2').val('All Status');
                }
            });

            $('#s_risk-treatment').change(function(){
                var risk_treatment = $('#s_risk-treatment').val();
                var risk_treatment2 = $("option:selected", this).attr('data-sugest');
                $('input[id="tab_treatment_list-filterValue"]').attr('value', risk_treatment);
                $('input[id="rt_2"]').attr('value', risk_treatment2);
                if(risk_treatment == "-"){
                    $('#tab_treatment_list-filterValue').val('');
                    $('#rt_2').val('All');
                }
            });
        	
            //------------------action plan
            $('#choose_l_divisi-action').hide();
            $('#choose_l_owner-action').hide();
            $('#tab_action_plan_list-filterValue').hide();
            $('#choose_s_level-action').hide();
            $('#ap_id').hide();
            $('#actionplan_search').hide();

            $('#tab_action_plan_list-filterBy').change(function(){
                var risk_action = $('#tab_action_plan_list-filterBy').val();

                var ap_list_filter = $("option:selected", this).attr('data-filterAp');

                $('input[id="rap_1"]').attr('value', ap_list_filter);

                 if(risk_action == "choose"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').hide();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#ap_id').hide();
                    $('#rap_1').val('');
                    $('#rap_2').val('');
                 }else if(risk_action == "action_plan"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').show();
                    $('#ap_id').hide();
                 }else if(risk_action == "due_date"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').show();
                    $('#ap_id').hide();
                }else if(risk_action == "risk_code"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').show();
                    $('#ap_id').hide();
                }else if(risk_action == "division"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').show();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').hide();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').hide();
                    $('#ap_id').hide();
                 }else if(risk_action == "risk_owner"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').show();
                    $('#tab_action_plan_list-filterValue').hide();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').hide();
                    $('#ap_id').hide();
                 }else if(risk_action == "action_plan_status"){
                    $('#choose_s_level-action').show();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').hide();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').hide();
                    $('#ap_id').hide();
                }else if(risk_action == "ap_code"){
                    $('#choose_s_level-action').hide();
                    $('#choose_l_divisi-action').hide();
                    $('#choose_l_owner-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#actionplan_search').hide();
                    $('#ap_id').show();
                 }
            });

            $('#l_divisi-action').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_action_plan_list-filterValue"]').attr('value', division_list);
                $('input[id="rap_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi-action').val();
                if(l_divisi == "-"){
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#rap_2').val('All');
                }
            });

            $('#l_owner-action').change(function(){
                var owner_list = $("option:selected", this).attr('data-owner');
                 var owner_list2 = $("option:selected", this).attr('data-owner2');
                $('input[id="tab_action_plan_list-filterValue"]').attr('value', owner_list);
                $('input[id="rap_2"]').attr('value', owner_list2);
                var l_owner = $('#l_owner-action').val();
                if(l_owner == "-"){
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#rap_2').val('All');
                }
            });

            $('#s_level-action').change(function(){
                var action_plan_status = $('#s_level-action').val();
                 var action_plan_status2 = $("option:selected", this).attr('data-levelAP');
                $('input[id="tab_action_plan_list-filterValue"]').attr('value', action_plan_status);
                $('input[id="rap_2"]').attr('value', action_plan_status2);
                if(action_plan_status == "-"){
                    $('#tab_action_plan_list-filterValue').val('');
                    $('#rap_2').val('All')
                }
            });

            //---------------------acntion plan execution
            $('#choose_l_divisi-execution').hide();
            $('#choose_l_owner-execution').hide();
            $('#choose_status-execution').hide();
            $('#choose_s_level-execution').hide();
            $('#tab_action_plan_exec-filterValue').hide();
            $('#apex_id').hide();

            $('#tab_action_plan_exec-filterBy').change(function(){
                var risk_execution = $('#tab_action_plan_exec-filterBy').val();
                if(risk_execution == "choose"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                 }else if(risk_execution == "action_plan"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                 }else if(risk_execution == "due_date"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                }else if(risk_execution == "division"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').show()
                    $('#choose_l_owner-execution').hide();;
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                }else if(risk_execution == "execution_status"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').show();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                }else if(risk_execution == "risk_code"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                 }else if(risk_execution == "risk_owner"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').show();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                 }else if(risk_execution == "action_plan_status"){
                    $('#choose_s_level-execution').show();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').hide();
                }else if(risk_execution == "ap_code"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#apex_id').show();
                 }
            });

            $('#l_divisi-execution').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_action_plan_exec-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-execution').val();
                if(l_divisi == "-"){
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            $('#l_owner-execution').change(function(){
                var division_list = $("option:selected", this).attr('data-owner');
                $('input[id="tab_action_plan_exec-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_owner-execution').val();
                if(l_divisi == "-"){
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            $('#status-execution').change(function(){
                var status_execution = $('#status-execution').val();
                if(status_execution == 'ONGOING'){
                    $('#tab_action_plan_exec-filterValue').val('ONGOING');
                }else if(status_execution == 'EXTEND'){
                    $('#tab_action_plan_exec-filterValue').val('EXTEND');
                }else if(status_execution == 'COMPLETE'){
                    $('#tab_action_plan_exec-filterValue').val('COMPLETE');
                }else{
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            $('#s_level-execution').change(function(){
                var action_plan_status = $('#s_level-execution').val();
                $('input[id="tab_action_plan_exec-filterValue"]').attr('value', action_plan_status);
                if(action_plan_status == "-"){
                    $('#tab_action_plan_exec-filterValue').val('');
                }
            });

            //--------------------------KRI
            $('#tab_kri-filterValue').hide();
            $('#choose_l_divisi-kri').hide();
            $('#choose_kri_s').hide();
            $('#choose_kri_w').hide();
            $('#kri_search').hide();



            $('#tab_kri-filterBy').change(function(){
                var risk_kri = $('#tab_kri-filterBy').val();

                var kri_list_filter = $("option:selected", this).attr('data-KRIfilter');
                $('input[id="rm_1"]').attr('value', kri_list_filter);

                if(risk_kri == "choose"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').hide();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').hide();
                    $('#rm_1').val('');
                    $('#rm_2').val('');
                 }else if(risk_kri == "kri_status"){
                    $('#choose_kri_s').show();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').hide();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').hide();
                 }else if(risk_kri == "key_risk_indicator"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').show();
                 }else if(risk_kri == "kri_owner"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').show();
                    $('#tab_kri-filterValue').hide();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').hide();
                }else if(risk_kri == "timing_pelaporan"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').show();
                 }else if(risk_kri == "risk_code"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#choose_kri_w').hide();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').show();
                 }else if(risk_kri == "kri_warning"){
                    $('#choose_kri_s').hide();
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').hide();
                    $('#choose_kri_w').show();
                    $('#tab_kri-filterValue').val('');
                    $('#kri_search').hide();
                 }
            });

            $('#k_status').change(function(){
                var kri_status = $('#k_status').val();
                var kri_status2 = $("option:selected", this).attr('data-k_status');
                $('input[id="tab_kri-filterValue"]').attr('value', kri_status);
                $('input[id="rm_2"]').attr('value', kri_status2);
                if(kri_status == "-"){
                    $('#tab_kri-filterValue').val('');
                    $('#rm_2').val('All Status');
                }
            });

            $('#l_divisi-kri').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_kri-filterValue"]').attr('value', division_list);
                $('input[id="rm_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi-kri').val();
                if(l_divisi == "-"){
                    $('#tab_kri-filterValue').val('');
                    $('#rm_2').val('All');
                }
            });

            $('#k_warning').change(function(){
                var status_waring = $('#k_warning').val();
                var status_waring2 = $("option:selected", this).attr('data-warning');
                if(status_waring == 'RED'){
                    $('#tab_kri-filterValue').val('RED');
                    $('input[id="rm_2"]').attr('value', status_waring2);
                }else if(status_waring == 'YELLOW'){
                    $('#tab_kri-filterValue').val('YELLOW');
                     $('input[id="rm_2"]').attr('value', status_waring2);
                }else if(status_waring == 'GREEN'){
                    $('#tab_kri-filterValue').val('GREEN');
                    $('input[id="rm_2"]').attr('value', status_waring2);
                }else{
                    $('#tab_kri-filterValue').val('');
                    $('#rm_2').val('');
                }
            });

            //--------------------------KRI Non Mitigation
            $('#tab_kri_nonmtg-filterValue').hide();
            $('#choose_l_divisi-kri_nonmtg').hide();
            $('#choose_kri_s_nonmtg').hide();
            $('#kri_search_nm').hide();



            $('#tab_kri_nonmtg-filterBy').change(function(){
                var risk_krinon = $('#tab_kri_nonmtg-filterBy').val();

                var kri_list_filternon = $("option:selected", this).attr('data-KRIfilternon');
                $('input[id="rnm_1"]').attr('value', kri_list_filternon);

                if(risk_krinon == "choose"){
                    $('#choose_kri_s_nonmtg').hide();
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').hide();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').hide();
                    $('#rnm_1').val('');
                    $('#rnm_2').val('');
                 }else if(risk_krinon == "kri_status"){
                    $('#choose_kri_s_nonmtg').show();
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').hide();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').hide();
                 }else if(risk_krinon == "key_risk_indicator"){
                    $('#choose_kri_s_nonmtg').hide();
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').show();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').show();
                 }else if(risk_krinon == "kri_owner"){
                    $('#choose_kri_s_nonmtg').hide();
                    $('#choose_l_divisi-kri_nonmtg').show();
                    $('#tab_kri_nonmtg-filterValue').hide();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').hide();
                }else if(risk_krinon == "timing_pelaporan"){
                    $('#choose_kri_s_nonmtg').hide();
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').show();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').show();
                 }else if(risk_krinon== "risk_code"){
                    $('#choose_kri_s_nonmtg').hide();
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').show();
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#kri_search_nm').show();
                 }
            });

            $('#k_status_nonmtg').change(function(){
                var kri_statusnon = $('#k_status_nonmtg').val();
                var kri_status2non = $("option:selected", this).attr('data-k_statusnon');
                $('input[id="tab_kri_nonmtg-filterValue"]').attr('value', kri_statusnon);
                $('input[id="rnm_2"]').attr('value', kri_status2non);
                if(kri_statusnon == "-"){
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#rnm_2').val('All Status');
                }
            });

            $('#l_divisi-kri_nonmtg').change(function(){
                var division_listnon = $("option:selected", this).attr('data-divisionnon');
                var division_list2non = $("option:selected", this).attr('data-division2non');
                $('input[id="tab_kri_nonmtg-filterValue"]').attr('value', division_listnon);
                $('input[id="rnm_2"]').attr('value', division_list2non);
                var l_divisi = $('#l_divisi-kri_nonmtg').val();
                if(l_divisi == "-"){
                    $('#tab_kri_nonmtg-filterValue').val('');
                    $('#rnm_2').val('All');
                }
            });

            //--------------------------Register Prior
            $('#choose_r_level-prior').hide();
            $('#choose_l_hood-prior').hide();
            $('#choose_impact_l-prior').hide();
            $('#choose_l_divisi-prior').hide();
            $('#tab_old_risk_list-filterValue').hide();
            $('#choose_s_level-prior').hide();
            $('#risk_search-prior').hide();

            $('#tab_old_risk_list-filterBy').change(function(){
                var risk_list_prior = $('#tab_old_risk_list-filterBy').val();

                var risk_list_filter = $("option:selected", this).attr('data-FilterRiskList');
                $('input[id="rlp_1"]').attr('value', risk_list_filter);

                if(risk_list_prior == "choose"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                    $('#rlp_1').val('');
                    $('#rlp_2').val('');
                }else if(risk_list_prior == "risk_code"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').show();
                }else if(risk_list_prior == "risk_event"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').show();
                }else if(risk_list_prior == "risk_level"){
                    $('#choose_r_level-prior').show();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                } else if(risk_list_prior == "risk_impact_level"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').show();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                } else if(risk_list_prior == "risk_likelihood_key"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').show();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                }else if(risk_list_prior == "risk_level_after_mitigation"){
                    $('#choose_r_level-prior').show();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                } else if(risk_list_prior == "risk_impact_level_after_mitigation"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').show();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                } else if(risk_list_prior == "risk_likelihood_key_after_mitigation"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').show();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                } else if(risk_list_prior == "risk_owner"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').show();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                }else if(risk_list_prior == "risk_status"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').show();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#risk_search-prior').hide();
                }

            });


            $('#s_level-prior').change(function(){
                var risk_status = $('#s_level-prior').val();
                var risk_status2 = $("option:selected", this).attr('data-RiskStatusLevel');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', risk_status);
                $('input[id="rlp_2"]').attr('value', risk_status2);
                if(risk_status == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#rlp_2').val('All');
                }
            });

            $('#r_level-prior').change(function(){
                var risk_level = $('#r_level-prior').val();
                var risk_level2 = $("option:selected", this).attr('data-RiskLevel');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', risk_level2);
                $('input[id="rlp_2"]').attr('value', risk_level2);
                if(risk_level == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#rlp_2').val('All');
                }
            });

            $('#l_hood-prior').change(function(){
                var likelihood = $("option:selected", this).attr('data-likelihood');
                var likelihood2 = $("option:selected", this).attr('data-likelihood2');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', likelihood);
                $('input[id="rlp_2"]').attr('value', likelihood2);
                var l_hood = $('#l_hood-prior').val();
                if(l_hood == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#rlp_2').val('All');
                }
            });

            $('#impact_l-prior').change(function(){
                var impact_level = $("option:selected", this).attr('data-impact');
                var impact_level2 = $("option:selected", this).attr('data-impact2');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', impact_level);
                $('input[id="rlp_2').attr('value', impact_level2);
                var impact_l = $('#impact_l-prior').val();
                if(impact_l == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#rlp_2').val('All');
                }
            });

            $('#l_divisi-prior').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                var division_list2 = $("option:selected", this).attr('data-division2');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', division_list);
                $('input[id="rlp_2"]').attr('value', division_list2);
                var l_divisi = $('#l_divisi-prior').val();
                if(l_divisi == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#rlp_2').val('All');
                }
            });

        	// TAB CONTROL FOR BREADCRUMB
        	$('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
        		var hrefa = $(this).attr('href');
        		var ulid = hrefa.replace('#', '');
        		var title = $(this).html().trim();
        		$('#bread_tab_title').html(title);
        	});
        	
        	$('#tab_risk_list-filterButton').on('click', function() {

                $('#rl_3').val($('#rl_1').val());
                $('#rl_4').val($('#rl_2').val());

                if($('#tab_risk_list-filterBy').val() == 'risk_code' || $('#tab_risk_list-filterBy').val() == 'risk_event'){
                     $('#tab_risk_list-filterValue').val($('#s_risklist').val());
                     $('#rl_2').val($('#s_risklist').val());
                     $('#rl_4').val($('#s_risklist').val());

                    if($('#s_risklist').val() == ''){
                        $('#tab_risk_list-filterValue').val($('#s_risklist').val());
                        $('#rl_2').val($('#s_risklist').val());
                        $('#rl_4').val($('#s_risklist').val());
                    }
                }

                if($('#tab_risk_list-filterValue').val() == ''){
                    $('#tab_risk_list-filterValue').val('Sh0w4llR15k');
                }
        		me.filterDataGridRiskList();
        	});

            $("#form_tab_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRiskList();
            });
            

            $('#tab_old_risk_list-filterButton').on('click', function() {

                $('#rlp_3').val($('#rlp_1').val());
                $('#rlp_4').val($('#rlp_2').val());

                if($('#tab_old_risk_list-filterBy').val() == 'risk_code' || $('#tab_old_risk_list-filterBy').val() == 'risk_event'){
                     $('#tab_old_risk_list-filterValue').val($('#s_risklist_prior').val());
                     $('#rlp_2').val($('#s_risklist_prior').val());
                     $('#rlp_4').val($('#s_risklist_prior').val());

                    if($('#s_risklist_prior').val() == ''){
                        $('#tab_old_risk_list-filterValue').val($('#s_risklist_prior').val());
                        $('#rlp_2').val($('#s_risklist_prior').val());
                        $('#rlp_4').val($('#s_risklist_prior').val());
                    }
                }

                if($('#tab_old_risk_list-filterValue').val() == ''){
                    $('#tab_old_risk_list-filterValue').val('Sh0w4llR15k');
                }

                me.filterDataGridOldRiskList();
            });

            $("#form_tab_old_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridOldRiskList();
            });
        	
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
				    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = grid_cr.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });

        	$('#tab_risk_register_list-filterButton').on('click', function() {

                 $('#rg_3').val($('#rg_1').val());
                 $('#rg_4').val($('#rg_2').val());

                if($('#tab_risk_register_list-filterBy').val() == 'display_name'){
                     $('#tab_risk_register_list-filterValue').val($('#s_risklist_reg').val());
                     $('#rg_2').val($('#s_risklist_reg').val());
                     $('#rg_4').val($('#s_risklist_reg').val());

                    if($('#s_risklist_reg').val() == ''){
                        $('#tab_risk_register_list-filterValue').val($('#s_risklist_reg').val());
                        $('#rg_2').val($('#s_risklist_reg').val());
                        $('#rg_4').val($('#s_risklist_reg').val());
                    }
                }

                if($('#tab_risk_register_list-filterValue').val() == ''){
                    $('#tab_risk_register_list-filterValue').val('Sh0w4llR15k');
                }
				
        		me.filterDataGridRegister();
        	});

            $('#hide_risk_owner').on('click', function(e){
                //$('#modal-pic').modal('show');  
                 e.preventDefault();
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to Hide table Treatment Owner and Risk Owner By me ?');
                mod.find('button.btn-primary').off('click');

                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/hide_treatment';
                    $.post(
                        url,
                        //{ 'id':  data.id},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridTreatment.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                                location.href=site_url+'/main/mainrac';
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });  
            });

            $('#show_risk_owner').on('click', function(e){
                //$('#modal-pic').modal('show');  
                 e.preventDefault();
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to Show table Treatment Owner and Risk Owner By me ?');
                mod.find('button.btn-primary').off('click');

                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/show_treatment';
                    $.post(
                        url,
                        //{ 'id':  data.id},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridTreatment.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                                location.href=site_url+'/main/mainrac';
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });  
            });

            $("#form_tab_risk_register_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRegister();
            });
        	
        	$('#tab_treatment_list-filterButton').on('click', function() {


                 $('#rt_3').val($('#rt_1').val());
                 $('#rt_4').val($('#rt_2').val());

                if($('#tab_treatment_list-filterBy').val() == 'risk_code' || $('#tab_treatment_list-filterBy').val() == 'risk_event'){
                     $('#tab_treatment_list-filterValue').val($('#s_risklist_treat').val());
                     $('#rt_2').val($('#s_risklist_treat').val());
                     $('#rt_4').val($('#s_risklist_treat').val());

                    if($('#s_risklist_treat').val() == ''){
                        $('#tab_treatment_list-filterValue').val($('#s_risklist_treat').val());
                        $('#rt_2').val($('#s_risklist_treat').val());
                        $('#rt_4').val($('#s_risklist_treat').val());
                    }
                }

                if($('#tab_treatment_list-filterValue').val() == ''){
                    $('#tab_treatment_list-filterValue').val('Sh0w4llR15k');
                }

        		me.filterDataGridTreatment();
        	});
			
            $("#form_tab_treatment_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridTreatment();
            });

			$('#tab_action_plan_list-filterButton').on('click', function() {

                 $('#rap_3').val($('#rap_1').val());
                 $('#rap_4').val($('#rap_2').val());

                if($('#tab_action_plan_list-filterBy').val() == 'risk_code' || $('#tab_action_plan_list-filterBy').val() == 'action_plan' || $('#tab_action_plan_list-filterBy').val() == 'due_date'){
                     $('#tab_action_plan_list-filterValue').val($('#s_action_plan_list').val());
                     $('#rap_2').val($('#s_action_plan_list').val());
                     $('#rap_4').val($('#s_action_plan_list').val());

                    if($('#s_action_plan_list').val() == ''){
                        $('#tab_action_plan_list-filterValue').val($('#s_action_plan_list').val());
                        $('#rap_2').val($('#s_action_plan_list').val());
                        $('#rap_4').val($('#s_action_plan_list').val());
                    }
                }

                if($('#tab_action_plan_list-filterBy').val() == 'ap_code'){
                     $('#tab_action_plan_list-filterValue').val($('#s_action_plan_list2').val());
                     $('#rap_2').val($('#s_action_plan_list2').val());
                     $('#rap_4').val($('#s_action_plan_list2').val());

                    if($('#s_action_plan_list2').val() == ''){
                        $('#tab_action_plan_list-filterValue').val($('#s_action_plan_list2').val());
                        $('#rap_2').val($('#s_action_plan_list2').val());
                        $('#rap_4').val($('#s_action_plan_list2').val());
                    }
                }

                if($('#tab_action_plan_list-filterValue').val() == ''){
                    $('#tab_action_plan_list-filterValue').val('Sh0w4llR15k');
                }

        		me.filterDataGridActionplan();
        	});

            $("#form_tab_action_plan_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplan();
            });
			            
        	$('#tab_action_plan_exec-filterButton').on('click', function() {
        		me.filterDataGridActionplanexec();
        	});

             $("#form_tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
            });

            $('#tab_kri-filterButton').on('click', function() {

                $('#rm_3').val($('#rm_1').val());
                 $('#rm_4').val($('#rm_2').val());

                if($('#tab_kri-filterBy').val() == 'risk_code' || $('#tab_kri-filterBy').val() == 'key_risk_indicator' || $('#tab_kri-filterBy').val() == 'timing_pelaporan'){
                     $('#tab_kri-filterValue').val($('#s_krilist').val());
                     $('#rm_2').val($('#s_krilist').val());
                     $('#rm_4').val($('#s_krilist').val());

                    if($('#s_krilist').val() == ''){
                        $('#tab_kri-filterValue').val($('#s_krilist').val());
                        $('#rm_2').val($('#s_krilist').val());
                        $('#rm_4').val($('#s_krilist').val());
                    }
                }

                if($('#tab_kri-filterValue').val() == ''){
                    $('#tab_kri-filterValue').val('Sh0w4llR15k');
                }

                me.filterDataGridKri();
            });

             $("#form_tab_kri").submit(function (e) {
                e.preventDefault();
                me.filterDataGridKri();
            });

            $('#tab_kri_mtg-filterButton').on('click', function() {
                me.filterDataGridKriMtg();
            });

            $("#form_tab_kri_mtg").submit(function (e) {
                e.preventDefault();
                me.filterDataGridKriMtg();
            });

            $('#tab_kri_nonmtg-filterButton').on('click', function() {
                 
                 $('#rnm_3').val($('#rnm_1').val());
                 $('#rnm_4').val($('#rnm_2').val());

                if($('#tab_kri_nonmtg-filterValue').val() == 'risk_code' || $('#tab_kri_nonmtg-filterValue').val() == 'key_risk_indicator' || $('#tab_kri_nonmtg-filterValue').val() == 'timing_pelaporan'){
                     $('#tab_kri_nonmtg-filterValue').val($('#s_krilistnon').val());
                     $('#rnm_2').val($('#s_krilistnon').val());
                     $('#rnm_4').val($('#s_krilistnon').val());

                    if($('#s_krilistnon').val() == ''){
                        $('#tab_kri_nonmtg-filterValue').val($('#s_krilistnon').val());
                        $('#rnm_2').val($('#s_krilistnon').val());
                        $('#rnm_4').val($('#s_krilistnon').val());
                    }
                }

                if($('#tab_kri_nonmtg-filterValue').val() == ''){
                    $('#tab_kri_nonmtg-filterValue').val('Sh0w4llR15k');
                }

                me.filterDataGridKrinonMtg();
            });

             $("#form_tab_kri_nonmtg").submit(function (e) {
                e.preventDefault();
                me.filterDataGridKrinonMtg();
            });

            $("#datatable_action_plan_exec").on('click', 'button.button-grid-search', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = gridActionExec.getDataTable().row(r).data();
                me.viewExecutionForm(data);
            });

            $('#exec-button-save').on('click', function() {
                var me = this;
                var url = site_url+'/main/mainpic/execSaveDraft';
                var valid = false;
                
                if ($('#exec-select-status').val() == 'COMPLETE') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                        //&& $( "#exec-form" ).find('textarea[name=execution_evidence]').val() != ''
                    ) valid = true
                }
                
                if ($('#exec-select-status').val() == 'EXTEND') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_reason]').val() != ''
                        && $( "#exec-form" ).find('input[name=revised_date]').val() != ''
                    ) valid = true
                }
                
                if ($('#exec-select-status').val() == 'ONGOING') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                         
                    ) valid = true
                }
                
                if (valid) {
                    var mod = MainApp.viewGlobalModal('confirm', 'Are you sure want to save this Action Plan Execution ?');
                    mod.find('button.btn-primary').off('click');
                    mod.find('button.btn-primary').one('click', function(){
                        mod.modal('hide');
                        $('#modal-exec').modal('hide');
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $( "#exec-form" ).serialize(),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    gridActionExec.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
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
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                    });
                } else {
                    MainApp.viewGlobalModal('error', 'Please Fill All Action Plan Execution data');
                }
            });

            $("#datatable_action_plan_exec").on('click', 'button.button-grid-submit', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = gridActionExec.getDataTable().row(r).data();
                
                var url = site_url+'/main/mainpic/execSubmit';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure want to Submit this Action Plan Execution?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {action_id: data.id},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
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


            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    var data = gridRiskList.getDataTable().row(r).data();
                    
                    me.deleteRiskTreatment(data);
            });

            $("#datatable_risk_treatment").on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    var data = gridTreatment.getDataTable().row(r).data();
                    
                    me.deleteRiskTreatment(data);
            });


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-verify', function(e) {
           
           
                    e.preventDefault();
                    
                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;

                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data();

                    gridActionExec.getDataTable().ajax.reload();
                    
                    var openverify;
                    openverify =  window.open('index.php/main/mainrac/actionPlanExecFormShow/'+data.id_p+'/'+data.action_plan_status,'name','location=no,menubar=no,scrollbars=yes,resizable=no,fullscreen=no,height=550,width=1024,left='+x+',top='+y);
                    openverify.focus();     
                    //me.showriskform_verify(data);
                
            });


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data(); 
                    me.showriskform_ap(data);
                
            });

            $("#datatable_risk_register").on('click', 'button.button-grid-edit', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    var data = gridRegister.getDataTable().row(r).data();
                    
                    me.viewOwnedAssignForm(data);
            });

            $('#library-modal-listriskap-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/main/mainrac/update_apex_now';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#modal-listrisk-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridActionExec.getDataTable().ajax.reload();
                                    
                                    $('#modal_listrisk').modal('hide');
                                    
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

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-ignore', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.ignoreAPE(data);
              });

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-accept', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                     
                    var data = gridActionExec.getDataTable().row(r).data();
 
                    me.acceptAPE(data);
             });

            $('#refresh_prior_ap').on('click', function() {
                gridActionExec.getDataTable().ajax.reload();
            });


            $('#modal-changelevel-form-verify-no').on('click', function(e) {

                e.preventDefault();
                    
                var r = this.parentNode.parentNode.parentNode; 
                var data = gridActionExec.getDataTable().row(r).data();
                me.ChangeLevelRiskDataNo(data)          
            });


            $('#edit_note').click(function(e) {
                    e.preventDefault();
                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;
                    var openverify;
                    var l = Ladda.create(this);
                    l.start();

                        var url = site_url+'/main/mainrac/submit_note';
                        var tx = 'Update';
                    $.post(
                        url,
                        $( "#noteform" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                gridRegister.getDataTable().ajax.reload();
                                $('#modal-pic').modal('hide');
                                MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        l.stop();
                       //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        gridRegister.getDataTable().ajax.reload();
                        $('#modal-pic').modal('hide');
                        MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                     });
                });

        },
        initUserChart: function() {
                        
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/risk", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_rac_to_verify", data, on_options);

            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount2/riskregister", function( data ) {
            	var series = data;
            	var tick = [ [0, "User"], [1, ""], [2, ""] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_rr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/treatment", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_tr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/actionplan", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_ap_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/kri", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_kri_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainrac/getSummaryCount/change", function( data ) {
            	var series = data;
            	var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
            	
            	on_options["yaxis"]["ticks"] = tick;
            	
            	$.plot("#chart_cr_to_verify", data, on_options);
            });
            
        },
        viewOwnedAssignForm: function(data) {
			 
            $('#noteform')[0].reset();
            $('#noteform').find("input[name='periode_id']").val(data.periode_id);
            $('#noteform').find("input[name='tanggal_submit']").val(data.tanggal_submit);
            $('#noteform').find("input[name='risk_input_by']").val(data.username);
            $('#noteform').find("textarea[name='note']").val(data.note);

            $('#modal-pic').modal('show');
                
        },
		  
		//fake
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/main/mainrac/crDeleteData';
                    $.post(
                        url,
                        { 'id':  data.id},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid_cr.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
            },
        filterDataGridRiskList: function() {
        	var fby = $('#tab_risk_list-filterBy').val();
        	var fval = $('#tab_risk_list-filterValue').val();
            var frl1 = $('#rl_1').val();
            var frl2 = $('#rl_2').val();
        	
        	gridRiskList.clearAjaxParams();
        	gridRiskList.setAjaxParam("filter_by", fby);
        	gridRiskList.setAjaxParam("filter_value", fval);
            gridRiskList.setAjaxParam("filter_rl_1", frl1);
            gridRiskList.setAjaxParam("filter_rl_2", frl2);
        	gridRiskList.getDataTable().ajax.reload();
        },

        filterDataGridOldRiskList: function() { 
            var fby = $('#tab_old_risk_list-filterBy').val();
            var fval = $('#tab_old_risk_list-filterValue').val();
            var frl1 = $('#rlp_1').val();
            var frl2 = $('#rlp_2').val();
            
            gridOldRisk.clearAjaxParams();
            gridOldRisk.setAjaxParam("filter_by", fby);
            gridOldRisk.setAjaxParam("filter_value", fval);
            gridOldRisk.setAjaxParam("filter_rl_1", frl1);
            gridOldRisk.setAjaxParam("filter_rl_2", frl2);
            gridOldRisk.getDataTable().ajax.reload();
        },

        filterDataGridRegister: function() {
        	var fby = $('#tab_risk_register_list-filterBy').val();
        	var fval = $('#tab_risk_register_list-filterValue').val();
            var frl1 = $('#rg_1').val();
            var frl2 = $('#rg_2').val();
            
            gridRegister.clearAjaxParams();
            gridRegister.setAjaxParam("filter_by", fby);
            gridRegister.setAjaxParam("filter_value", fval);
            gridRegister.setAjaxParam("filter_rl_1", frl1);
            gridRegister.setAjaxParam("filter_rl_2", frl2);
        	gridRegister.getDataTable().ajax.reload();
        },
        filterDataGridTreatment: function() {
        	var fby = $('#tab_treatment_list-filterBy').val();
        	var fval = $('#tab_treatment_list-filterValue').val();
        	var frl1 = $('#rt_1').val();
            var frl2 = $('#rt_2').val();
            
            gridTreatment.clearAjaxParams();
            gridTreatment.setAjaxParam("filter_by", fby);
            gridTreatment.setAjaxParam("filter_value", fval);
            gridTreatment.setAjaxParam("filter_rt_1", frl1);
            gridTreatment.setAjaxParam("filter_rt_2", frl2);
        	gridTreatment.getDataTable().ajax.reload();
        },
		 filterDataGridActionplan: function() {
        	var fby = $('#tab_action_plan_list-filterBy').val();
        	var fval = $('#tab_action_plan_list-filterValue').val();
            var frl1 = $('#rap_1').val();
            var frl2 = $('#rap_2').val();
        	
        	gridActionPlan.clearAjaxParams();
        	gridActionPlan.setAjaxParam("filter_by", fby);
        	gridActionPlan.setAjaxParam("filter_value", fval);
            gridActionPlan.setAjaxParam("filter_rap_1", frl1);
            gridActionPlan.setAjaxParam("filter_rap_2", frl2);
        	gridActionPlan.getDataTable().ajax.reload();
        },

        viewExecutionForm: function(data) {
            var me = this;
            var act_id = data.id;
            
            $('#exec-form')[0].reset();
            
            $('#form-action-id').val(act_id);
            
            $('#fgroup-explain').hide();
            $('#fgroup-evidence').hide();
            $('#fgroup-reason').hide();
            $('#fgroup-date').hide();
            
            $( '#exec-select-status' ).prop('disabled', true);
            $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', true);
            $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', true);
            $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', true);
            
            $('#exec-button-save').hide();
            
            if (data.execution_status == 'COMPLETE') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_explain]').val(data.execution_explain);
                $( "#exec-form" ).find('textarea[name=execution_evidence]').val(data.execution_evidence);
                
                $('#fgroup-explain').show();
                $('#fgroup-evidence').show();
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
            } else if (data.execution_status == 'EXTEND') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_reason]').val(data.execution_reason);
                $( "#exec-form" ).find('input[name=revised_date]').val(data.revised_date_v);
                
                $('#fgroup-reason').show();
                $('#fgroup-date').show();
                
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
            } else {
                $( '#exec-select-status' ).val('COMPLETE');
                $('#fgroup-explain').show();
                $('#fgroup-evidence').show();
                $( '#exec-select-status' ).prop('disabled', false);
                $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                $('#exec-button-save').show();
            }
            
            //
            //if (data.is_owner == 1 && (data.action_plan_status == 4 || data.action_plan_status == 5)) {
            //  $('#exec-button-save').show();
            //}
            
            $('#modal-exec').modal('show');
            
        },
		 filterDataGridActionplanexec: function() {
        	var fby = $('#tab_action_plan_exec-filterBy').val();
        	var fval = $('#tab_action_plan_exec-filterValue').val();
        	
        	gridActionExec.clearAjaxParams();
        	gridActionExec.setAjaxParam("filter_by", fby);
        	gridActionExec.setAjaxParam("filter_value", fval);
        	gridActionExec.getDataTable().ajax.reload();
        },
         filterDataGridKri: function() {
            var fby = $('#tab_kri-filterBy').val();
            var fval = $('#tab_kri-filterValue').val();
            var frl1 = $('#rm_1').val();
            var frl2 = $('#rm_2').val();
            
            grid_kri.clearAjaxParams();
            grid_kri.setAjaxParam("filter_by", fby);
            grid_kri.setAjaxParam("filter_value", fval);
            grid_kri.setAjaxParam("filter_rm_1", frl1);
            grid_kri.setAjaxParam("filter_rm_2", frl2);
            grid_kri.getDataTable().ajax.reload();
        },
        filterDataGridKriMtg: function() {
            var fby = $('#tab_kri_mtg-filterBy').val();
            var fval = $('#tab_kri_mtg-filterValue').val();
            var frl1 = $('#rm_1').val();
            var frl2 = $('#rm_2').val();
            
            grid_kri_mitigation.clearAjaxParams();
            grid_kri_mitigation.setAjaxParam("filter_by", fby);
            grid_kri_mitigation.setAjaxParam("filter_value", fval);
            grid_kri_mitigation.setAjaxParam("filter_rm_1", frl1);
            grid_kri_mitigation.setAjaxParam("filter_rm_2", frl2);
            grid_kri_mitigation.getDataTable().ajax.reload();
        },
        filterDataGridKrinonMtg: function() {
            var fby = $('#tab_kri_nonmtg-filterBy').val();
            var fval = $('#tab_kri_nonmtg-filterValue').val();
            var frl1 = $('#rnm_1').val();
            var frl2 = $('#rnm_2').val();
            
            grid_kri_non_mitigation.clearAjaxParams();
            grid_kri_non_mitigation.setAjaxParam("filter_by", fby);
            grid_kri_non_mitigation.setAjaxParam("filter_value", fval);
            grid_kri_non_mitigation.setAjaxParam("filter_rnm_1", frl1);
            grid_kri_non_mitigation.setAjaxParam("filter_rnm_2", frl2);
            grid_kri_non_mitigation.getDataTable().ajax.reload();
        },

        deleteRiskTreatment: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Delete</b> risk : <b>'+data.risk_event+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'risk_id' : data.risk_id
                    };
                    var url = site_url+'/main/mainrac/deleteRiskrac';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList.getDataTable().ajax.reload();
                                gridTreatment.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Risk');
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

            showriskform_ap: function(data) { 
                var htmlopt = "";
                
                 var url = site_url+'/library/getDivision';
                    $.post(
                        url,
                        { 'id':  data.division_id},
                        function(datax) {
                            
                            for (var i = '0'; i < datax.length; i++) {
                                var datanya = datax[i];
                                  
                                if(data.division == datanya.division_id){
                                var select = "selected = selected";
                             
                                }else{
                                var select = "";
                                 
                                }
                                htmlopt += "<option value = '"+datanya.division_id+"' "+select+">"+datanya.division_name+"</option>";
                                 
                            }   
                            $("#division").html(htmlopt);
            
                        },
                        "json"
                    ).fail(function() {                         
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                 
                    var dud = data.due_date_v;
                    if(dud == '00-00-0000'){
                         $('#kcc').show();
                         $('#ckc').hide();
                         $("#checked").show();
                         $('#fdate').hide();
                    }else{
                         $('#ckc').show();
                         $('#kcc').hide();
                         $("#checked").hide();
                         $('#fdate').show();
                    }


                $('#modal-listrisk-form').find('input[name=ap_code]').attr('readonly', true).val("AP."+data.id_p);
                $('#modal-listrisk-form').find('input[name=id]').attr('readonly', true).val(data.id_p);
                $('#modal-listrisk-form').find('textarea[name=action_plan]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=due_date]').attr('readonly', true).val(data.due_date_v);
                
              
                $('#modal-listrisk-form').find('input[name=action_plan_status]').attr('readonly', true).val(data.action_plan_status);
                $('#modal-listrisk-form').find('input[name=periode_id]').attr('readonly', true).val(data.periode_id);
                $('#modal-listrisk-form').find('textarea[name=action_plan_ex]').attr('readonly', false).val(data.action_plan);
                $('#modal-listrisk-form').find('input[name=division_ex]').attr('readonly', false).val(data.division); 
                $('#modal_listrisk').modal('show');
                this.dataMode = 'view';
            },


            ignoreAPE: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Ignore</b> risk : <b>'+data.action_plan+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'ap_code' : data.id_p,
                        'periode_id' : data.periode_id
                    };
                    var url = site_url+'/main/mainrac/ignoreAP_execution';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Ignore Action plan execution');
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

            acceptAPE: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure want to <b>Accept</b> risk : <b>'+data.action_plan+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'ap_code' : data.id_p,
                        'periode_id' : data.periode_id
                    };
                    var url = site_url+'/main/mainrac/acceptAP_execution';          
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Accept Action plan execution');
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

        ChangeLevelRiskDataNo: function(data) {  
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionExecVerify';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this Action Plan ?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    var g_risk_id = $('#action-plan-id').val();
                    var g_action_plan_status = $('#action_plan_status').val();
                    var g_review_status = $('#review_status').val();
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $( "#input-form" ).serialize() + '&' + $("#modal-risk-form-validation_no").serialize(),
                          
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridActionExec.getDataTable().ajax.reload();
                                MainApp.viewGlobalModal('success', 'Success verify Action plan execution');
                                if(g_review_status != 1){
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+g_action_plan_status;
                                }else{
                                    location.href=site_url+'/main/mainrac/actionPlanExecFormShow/'+g_risk_id+'/'+7;
                                }
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
        },
       
	};	
}();


var Actionplan_adt = function() {
    return {
        init: function() {
        	var me = this;
        	
        	// TAB CONTROL FOR BREADCRUMB
        	$('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
        		var hrefa = $(this).attr('href');
        		var ulid = hrefa.replace('#', '');
        		var title = $(this).html().trim();
        		$('#bread_tab_title').html(title);
        	});
        	 
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    //alert(r);exit;
                    var data = gridRiskList.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });
 
        	$('#tab_action_plan_exec-filterButton').on('click', function() {
        		me.filterDataGridActionplanexec();
        	});

        },
       
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/admin/qna/qnaDeleteData';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
            },
        
		 filterDataGridActionplan: function() {
        	var fby = $('#tab_action_plan_list-filterBy').val();
        	var fval = $('#tab_action_plan_list-filterValue').val();
        	
        	gridActionPlan.clearAjaxParams();
        	gridActionPlan.setAjaxParam("filter_by", fby);
        	gridActionPlan.setAjaxParam("filter_value", fval);
        	gridActionPlan.getDataTable().ajax.reload();
        },
		 filterDataGridActionplanexec: function() {
        	var fby = $('#tab_action_plan_exec-filterBy').val();
        	var fval = $('#tab_action_plan_exec-filterValue').val();
        	
        	gridActionExec.clearAjaxParams();
        	gridActionExec.setAjaxParam("filter_by", fby);
        	gridActionExec.setAjaxParam("filter_value", fval);
        	gridActionExec.getDataTable().ajax.reload();
        },
       
	};	
}();

var Actionplan_exe = function() {
    return {
        init: function() {
            var me = this;
            
            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
             
             $('#datatable_cr').on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    //alert(r);exit;
                    var data = gridRiskList.getDataTable().row(r).data();
 
                    me.deleteData(data);
                });
 
            $('#tab_action_plan_exec-filterButton').on('click', function() {
                me.filterDataGridActionplanexec();
            });

        },
       
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/admin/qna/qnaDeleteData';
                    $.post(
                        url,
                        { 'id':  data.DT_RowId},
                        function(data) {
                            Metronic.unblockUI();
                            if(data.success) {
                                gridRiskList.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete Data');
                            } else {
                                MainApp.viewGlobalModal('error123', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        MainApp.viewGlobalModal('error', 'Error Submitting Data');
                     });
                });
            },
        
         filterDataGridActionplan: function() {
            var fby = $('#tab_action_plan_list-filterBy').val();
            var fval = $('#tab_action_plan_list-filterValue').val();
            
            gridActionPlan.clearAjaxParams();
            gridActionPlan.setAjaxParam("filter_by", fby);
            gridActionPlan.setAjaxParam("filter_value", fval);
            gridActionPlan.getDataTable().ajax.reload();
        },
         filterDataGridActionplanexec: function() {
            var fby = $('#tab_action_plan_exec-filterBy').val();
            var fval = $('#tab_action_plan_exec-filterValue').val();
            
            gridActionExec.clearAjaxParams();
            gridActionExec.setAjaxParam("filter_by", fby);
            gridActionExec.setAjaxParam("filter_value", fval);
            gridActionExec.getDataTable().ajax.reload();
        },
       
    };  
}();

$('.nav-tabs a').click(function (e) {
     e.preventDefault();
	 $('#tabactive').val($($(this).attr('href')).index());
  
});

$('#risk_list_export').on('click', function() {
	
		var tabactive = $('#tabactive').val();
		 
		if(tabactive == "0"){	
			$('#modal-export').modal('show');
		}
		
		if(tabactive == "1"){	
			$('#modal-export-register').modal('show');
		}
		
		if(tabactive == "2"){	
			$('#modal-export-treatment').modal('show');
		}
		
		if(tabactive == "3"){	
			$('#modal-actionplanlist').modal('show');
		}
		
		if(tabactive == "6"){	
			$('#modal-executionlist').modal('show');
		}
		
		if(tabactive == "4"){	
			$('#modal-kri').modal('show');
		}
		
		if(tabactive == "5"){	
			$('#modal-changereq').modal('show');
		}

        if(tabactive == "7"){   
            $('#modal-risk_prior').modal('show');
        }
});	
 

$('#risk_list_excel').on('click', function() {
	  
			if($('#get_check_risklist').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_risk_list-filterValue").val();
				if(search !=""){
					var searchnya = "search="+search+"&";
				}else{
					var searchnya = "";
				} 
				window.open(site_url+'/main/mainrac/getAllRisk_excel'+'?'+searchnya+$('#get_check_risklist').serialize());
			}					 
	 
});

$('#risk_list_pdf').on('click', function() {
		 
			if($('#get_check_risklist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisk_pdf'+'?'+searchnya+$('#get_check_risklist').serialize());
			}					 
	 
});
 
$('#risk_register_list_excel').on('click', function() {
	  
			if($('#get_check_riskregisterlist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_register_list-filterValue").val();
					var orderby = $("#tab_risk_register_list-filterBy").val();
					if(search !=""){
						var searchnya = "search="+search+"&orderby="+orderby+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRiskregister_excel'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
			}					 
	 
});

$('#risk_register_list_pdf').on('click', function() {
		 
			if($('#get_check_riskregisterlist').serialize() == ""){
				alert("Please field at least one ")
			}else{
					var search = $("#tab_risk_register_list-filterValue").val();
					var orderby = $("#tab_risk_register_list-filterBy").val();
					if(search !=""){
						var searchnya = "search="+search+"&orderby="+orderby+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRiskregister_pdf'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
			}					 
	 
});

$('#treatment_list_excel').on('click', function() {
	  
			if($('#get_check_risktreatment').serialize() == ""){
				alert("Please field at least one ")
			}else{
				 var search = $("#tab_treatment_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisktreatment_excel'+'?'+searchnya+$('#get_check_risktreatment').serialize());
			}					 
	 
});

$('#treatment_list_pdf').on('click', function() {
		 
			if($('#get_check_risktreatment').serialize() == ""){
				alert("Please field at least one ")
			}else{
				 var search = $("#tab_treatment_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getAllRisktreatment_pdf'+'?'+searchnya+$('#get_check_risktreatment').serialize());
			}					 
	 
});


$('#actionplan_list_excel').on('click', function() {
	  
			if($('#get_check_actionplan').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_action_plan_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getActionplan_excel'+'?'+searchnya+$('#get_check_actionplan').serialize());
			}					 
	 
});
 
$('#actionplan_list_pdf').on('click', function() {
		 
			if($('#get_check_actionplan').serialize() == ""){
				alert("Please field at least one ")
			}else{
				var search = $("#tab_action_plan_list-filterValue").val();
					if(search !=""){
						var searchnya = "search="+search+"&";
					}else{
						var searchnya = "";
					} 
				window.open(site_url+'/main/mainrac/getActionplan_pdf'+'?'+searchnya+$('#get_check_actionplan').serialize());
			}					 
	 
});
 
$('#execution_list_excel').on('click', function() {
	  
			if($('#get_check_execution').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getExecution_excel'+'?'+$('#get_check_execution').serialize());
			}					 
	 
});


$('#execution_list_pdf').on('click', function() {
		 
			if($('#get_check_execution').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getExecution_pdf'+'?'+$('#get_check_execution').serialize());
			}					 
	 
});


$('#kri_list_excel').on('click', function() {
	  
			if($('#get_check_kri').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getKRI_excel'+'?'+$('#get_check_kri').serialize());
			}					 
	 
});


$('#kri_list_pdf').on('click', function() {
		 
			if($('#get_check_kri').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getKRI_pdf'+'?'+$('#get_check_kri').serialize());
			}					 
	 
});


$('#changereq_list_excel').on('click', function() {
	  
			if($('#get_check_changereq').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getChangereq_excel'+'?'+$('#get_check_changereq').serialize());
			}					 
	 
});


$('#changereq_list_pdf').on('click', function() {
		 
			if($('#get_check_changereq').serialize() == ""){
				alert("Please field at least one ")
			}else{
				window.open(site_url+'/main/mainrac/getChangereq_pdf'+'?'+$('#get_check_changereq').serialize());
			}					 
	 
});

$('#riskprior_list_excel').on('click', function() {
      
            if($('#get_check_risk_priorlist').serialize() == ""){
                alert("Please field at least one ")
            }else{
                var search = $("#tab_old_risk_list-filterValue").val();
                if(search !=""){
                    var searchnya = "search="+search+"&";
                }else{
                    var searchnya = "";
                } 
                window.open(site_url+'/main/mainrac/getAllRiskPrior_excel'+'?'+searchnya+$('#get_check_risklist').serialize());
            }                    
     
});

$('#riskprior_list_pdf').on('click', function() {
         
            if($('#get_check_risk_priorlist').serialize() == ""){
                alert("Please field at least one ")
            }else{
                    var search = $("#tab_old_risk_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/mainrac/getAllRiskPrior_pdf'+'?'+searchnya+$('#get_check_risklist').serialize());
            }                    
     
});


function submit_note(){				
	$.ajax({ 
		type: 'POST',
		url: site_url+"/main/mainrac/submit_note",
		data: $("#noteform").serialize(),
		success: function(data){
			$('#modal-pic').modal('hide');
			gridRegister.getDataTable().ajax.reload();
		}				
	})
}

 $('#save-risk_owner').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                        var url = site_url+'/main/mainrac/updatestatement_risk_owner';
                        var tx = 'Update';
    
                    $.post(
                        url,
                        $( "#input-form-risk_owner" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                
                                $('#modal-riskowner').modal('show');
                                
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

  $('#save-action_plan').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                        var url = site_url+'/main/mainrac/updatestatement_action_plan';
                        var tx = 'Update';
    
                    $.post(
                        url,
                        $( "#input-form-action_plan" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                
                                $('#modal-action_plan').modal('show');
                                
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

   $('#save-action_plan_exe').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                        var url = site_url+'/main/mainrac/updatestatement_action_plan_exe';
                        var tx = 'Update';
    
                    $.post(
                        url,
                        $( "#input-form-action_plan_exe" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                
                                $('#modal-action_plan_exe').modal('show');
                                
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