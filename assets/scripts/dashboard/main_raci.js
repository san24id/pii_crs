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
        "ajax": {
            "url": site_url+"/maini/mainrac/getAllRisk" // ajax source
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
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
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
            { "data": "risk_owner_v" }
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getUserList" // ajax source
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
                return '<a target="_self" href="'+site_url+'/maini/mainrac/riskRegister/'+full.username+'">'+data+'</a>';
            }
        },{
            "targets": 5,
            "data": "risk_treatment_owner_v",
            "render": function ( data, type, full, meta ) {
                var ret = full.risk_treatment_owner_v;
                if (data == '' || data == null) {
                    ret = '<span></span> &nbsp; '+
                          '<button onclick="javascript: Dashboard.viewOwnedAssignForm(\''+full.username+'\', \'treatment\',\''+full.note+'\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-plus"> Add </i><span class="hidden-480"> Note </span></button>';
                }else{
                    ret = '<span></span> &nbsp; '+
                          '<button onclick="javascript: Dashboard.viewOwnedAssignForm(\''+full.username+'\', \'treatment\',\''+full.note+'\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-plus"> Add </i><span class="hidden-480"> Note </span></button>';
                }
                return ret;
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "display_name" },
            { "data": "division_name" },
            { "data": "tanggal_submit" },
            { "data": "note" },
            { "data": "note_v" }
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getTreatmentList" // ajax source
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
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/riskTreatmentForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
                }
                
                //return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_owner_v" },
            { "data": "suggested_risk_treatment_v" }
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getActionPlan" // ajax source
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
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanForm/'+full.id_p+'">'+data+'</a>';
                }else{
                //return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewActionPlan/'+full.id_p+'?kat=ap">'+data+'</a>';
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
        },{
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/maini/viewRisk/'+full.risk_id+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/libraryin/list_risk_lib?status=ap&&id='+full.id_p+'">'+data+'</a>';
                }
            }
        } ],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan"},
            { "data": "due_date_v" },
            { "data": "division_name" },
            { "data": "risk_code" }
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getActionPlanExec" // ajax source
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
                if (full.action_plan_status == 3) {
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanForm/'+full.id_p+'">'+data+'</a>';
                }else if(full.action_plan_status == 7){
                     return '<a target="_self" href="'+site_url+'/maini/mainrac/FormactionPlanExec/'+full.id_p+'">'+data+'</a>';
                }else{       
                    //return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/viewActionPlan/'+full.id_p+'?kat=ec">'+data+'</a>';
                }
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/maini/viewRisk/'+full.risk_id+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/libraryin/list_risk_lib?status=ap&&id='+full.id_p+'">'+data+'</a>';
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
                                return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanExecForm/'+full.id_p+'">'+data+'</a>';
                            }else if(full.action_plan_status == 7){
                                return data;
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
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "division_name" },
            { "data": "execution_status" },
            { "data": "risk_code" }
       ],
        "order": [
            [0, "desc"], [1, "asc"]
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
            "url": site_url+"/maini/mainrac/getActionPlanExec_adt" // ajax source
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
                return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
            "targets": 5,
            "data": "execution_status",
             
            "render": function ( data, type, full, meta ) {
             
                if(data == null){
                    return '';
                }else if(full.action_plan_status == 6 ){                   
                   return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanExecForm/'+full.id+'">'+data+'</a>';
                }else{                   
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanExecForm/'+full.id+'/view">'+data+'</a>';
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getActionPlanExec_prior" // ajax source
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
                return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanView/'+full.id_p+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
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
                                return '<a target="_self" href="'+site_url+'/maini/mainrac/actionPlanExecForm/'+full.id_p+'">'+data+'</a>';
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getKri" // ajax source
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
            "data": "kri_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.kri_pic_v;
                var dat = '';
                if (ret == '' || ret == null) {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                        
                } else {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                }
                return dat;
            }
        }, {
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
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
            { "data": "kri_code" },
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getChangeRequest" // ajax source
        },
        "columnDefs": [ {
            "targets": 1,
            "data": "cr_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green-jungle';
                if (full.cr_type == 'Risk Register') {
                    var vm = 'riski/RiskRegister/ChangeRequestRac';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.created_by+'?status=change">'+data+'</a>';
                }else  if (full.cr_type == 'Action Plan Form') {
                        if(full.cr_status == '1'){
                            var vm = 'maini/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'maini/mainrac/ChangeRequestActionVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                }else  if (full.cr_type == 'Action Plan Execution Form') {
                        if(full.cr_status == '1'){
                            var vm = 'maini/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'maini/mainrac/ChangeRequestActionExeVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                }else  if (full.cr_type == 'Action Plan Execution Prior Form') {
                        if(full.cr_status == '1'){
                            var vm = 'maini/mainrac/ChangeRequestActionView';
                        }else{
                            var vm = 'maini/mainrac/ChangeRequestActionExePriorVerify';
                        }
                         return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                   
                }else if (full.cr_status == '1') {
                    var vm = 'maini/mainrac/ChangeRequestView';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                } else {
                    var vm = 'maini/mainrac/ChangeRequestVerify';
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
                { "data": "cr_code" },
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getAllOldRisk" // ajax source
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
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/maini/mainrac/riskRegisterForm/'+full.risk_id+'/'+full.risk_input_by+'">'+data+'</a>';
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
            { "data": "risk_owner_v" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_kri_mitigation = new Datatable();
grid_kri_mitigation.init({
    src: $("#datatable_kri_mitigation"),
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
            "url": site_url+"/maini/mainrac/getKri" // ajax source
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
            "data": "kri_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.kri_pic_v;
                var dat = '';
                if (ret == '' || ret == null) {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                        
                } else {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                }
                return dat;
            }
        }, {
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
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
            { "data": "kri_code" },
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
        "ajax": {
            "url": site_url+"/maini/mainrac/getKri_non" // ajax source
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
            "data": "kri_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.kri_pic_v;
                var dat = '';
                if (ret == '' || ret == null) {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                        
                } else {
                    if(full.kri_status == 0){
                         return '<a target="_self" href="'+site_url+'/maini/mainrac/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/maini/mainrac/viewKri/'+full.id+'">'+data+'</a>';
                    }
                }
                return dat;
            }
        }, {
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/maini/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
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
            { "data": "kri_code" },
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
            $('#choose_r_level').hide();
            $('#choose_l_hood').hide();
            $('#choose_impact_l').hide();
            $('#choose_l_divisi').hide();
            $('#tab_risk_list-filterValue').show();

            $('#tab_risk_list-filterBy').change(function(){
                var risk_list = $('#tab_risk_list-filterBy').val();
                if(risk_list == "risk_event"){
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').show();
                    $('#tab_risk_list-filterValue').val('');
                }else if(risk_list == "risk_level"){
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                } else if(risk_list == "risk_impact_level"){
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                } else if(risk_list == "risk_likelihood_key"){
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                } else if(risk_list == "risk_owner"){
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').show();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                }

            });

            $('#r_level').change(function(){
                var risk_level = $('#r_level').val();
                $('input[id="tab_risk_list-filterValue"]').attr('value', risk_level);
                if(risk_level == "-"){
                    $('#tab_risk_list-filterValue').val('');
                }
            });

            $('#l_hood').change(function(){
                var likelihood = $("option:selected", this).attr('data-likelihood');
                $('input[id="tab_risk_list-filterValue"]').attr('value', likelihood);
                var l_hood = $('#l_hood').val();
                if(l_hood == "-"){
                    $('#tab_risk_list-filterValue').val('');
                }
            });

            $('#impact_l').change(function(){
                var impact_level = $("option:selected", this).attr('data-impact');
                $('input[id="tab_risk_list-filterValue"]').attr('value', impact_level);
                var impact_l = $('#impact_l').val();
                if(impact_l == "-"){
                    $('#tab_risk_list-filterValue').val('');
                }
            });

            $('#l_divisi').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_risk_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi').val();
                if(l_divisi == "-"){
                    $('#tab_risk_list-filterValue').val('');
                }
            });
            //---------------------Register
            $('#choose_l_divisi-register').hide();

            $('#tab_risk_register_list-filterBy').change(function(){
                var risk_register = $('#tab_risk_register_list-filterBy').val();
                 if(risk_register == "display_name"){
                    $('#choose_l_divisi-register').hide();
                    $('#tab_risk_register_list-filterValue').show();
                    $('#tab_risk_register_list-filterValue').val('');
                 }else if(risk_register == "division_name"){
                    $('#choose_l_divisi-register').show();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                }
            });

            $('#l_divisi-register').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_risk_register_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-register').val();
                if(l_divisi == "-"){
                    $('#tab_risk_register_list-filterValue').val('');
                }
            });

            //--------------------treatment
            $('#choose_l_divisi-treatment').hide();

            $('#tab_treatment_list-filterBy').change(function(){
                var risk_treatment = $('#tab_treatment_list-filterBy').val();
                 if(risk_treatment == "risk_event"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_owner"){
                    $('#choose_l_divisi-treatment').show();
                    $('#tab_treatment_list-filterValue').hide();
                    $('#tab_treatment_list-filterValue').val('');
                }else if(risk_treatment == "suggested_risk_treatment"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }
            });

            $('#l_divisi-treatment').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_treatment_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-treatment').val();
                if(l_divisi == "-"){
                    $('#tab_treatment_list-filterValue').val('');
                }
            });
            
            //---------------------Register
            $('#choose_l_divisi-register').hide();

            $('#tab_risk_register_list-filterBy').change(function(){
                var risk_register = $('#tab_risk_register_list-filterBy').val();
                 if(risk_register == "display_name"){
                    $('#choose_l_divisi-register').hide();
                    $('#tab_risk_register_list-filterValue').show();
                    $('#tab_risk_register_list-filterValue').val('');
                 }else if(risk_register == "division_name"){
                    $('#choose_l_divisi-register').show();
                    $('#tab_risk_register_list-filterValue').hide();
                    $('#tab_risk_register_list-filterValue').val('');
                }
            });

            $('#l_divisi-register').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_risk_register_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-register').val();
                if(l_divisi == "-"){
                    $('#tab_risk_register_list-filterValue').val('');
                }
            });

            //------------------action plan
            $('#choose_l_divisi-action').hide();

            $('#tab_action_plan_list-filterBy').change(function(){
                var risk_action = $('#tab_action_plan_list-filterBy').val();
                 if(risk_action == "action_plan"){
                    $('#choose_l_divisi-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                 }else if(risk_action == "due_date"){
                    $('#choose_l_divisi-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                }else if(risk_action == "division"){
                    $('#choose_l_divisi-action').show();
                    $('#tab_action_plan_list-filterValue').hide();
                    $('#tab_action_plan_list-filterValue').val('');
                 }
            });

            $('#l_divisi-action').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_action_plan_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-action').val();
                if(l_divisi == "-"){
                    $('#tab_action_plan_list-filterValue').val('');
                }
            });

            //---------------------acntion plan execution
            $('#choose_l_divisi-execution').hide();
            $('#choose_status-execution').hide();

            $('#tab_action_plan_exec-filterBy').change(function(){
                var risk_execution = $('#tab_action_plan_exec-filterBy').val();
                 if(risk_execution == "action_plan"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                 }else if(risk_execution == "due_date"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                }else if(risk_execution == "division"){
                    $('#choose_l_divisi-execution').show();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                }else if(risk_execution == "execution_status"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').show();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
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

            $('#choose_status-execution').change(function(){
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

            //--------------------------KRI
            $('#choose_l_divisi-kri').hide();

            $('#tab_kri-filterBy').change(function(){
                var risk_kri = $('#tab_kri-filterBy').val();
                 if(risk_kri == "key_risk_indicator"){
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#tab_kri-filterValue').val('');
                 }else if(risk_kri == "kri_owner"){
                    $('#choose_l_divisi-kri').show();
                    $('#tab_kri-filterValue').hide();
                    $('#tab_kri-filterValue').val('');
                }else if(risk_kri == "timing_pelaporan"){
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#tab_kri-filterValue').val('');
                 }
            });

            $('#l_divisi-kri').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_kri-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-kri').val();
                if(l_divisi == "-"){
                    $('#tab_kri-filterValue').val('');
                }
            });

            //--------------------------KRI Non Mitigation
            $('#choose_l_divisi-kri_nonmtg').hide();

            $('#tab_kri_nonmtg-filterBy').change(function(){
                var risk_kri_nonmtg = $('#tab_kri_nonmtg-filterBy').val();
                 if(risk_kri_nonmtg == "key_risk_indicator"){
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').show();
                    $('#tab_kri_nonmtg-filterValue').val('');
                 }else if(risk_kri_nonmtg == "kri_owner"){
                    $('#choose_l_divisi-kri_nonmtg').show();
                    $('#tab_kri_nonmtg-filterValue').hide();
                    $('#tab_kri_nonmtg-filterValue').val('');
                }else if(risk_kri_nonmtg == "timing_pelaporan"){
                    $('#choose_l_divisi-kri_nonmtg').hide();
                    $('#tab_kri_nonmtg-filterValue').show();
                    $('#tab_kri_nonmtg-filterValue').val('');
                 }
            });

            $('#l_divisi-kri_nonmtg').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_kri_nonmtg-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-kri_nonmtg').val();
                if(l_divisi == "-"){
                    $('#tab_kri_nonmtg-filterValue').val('');
                }
            });

            //--------------------------Register Prior
            $('#choose_r_level-prior').hide();
            $('#choose_l_hood-prior').hide();
            $('#choose_impact_l-prior').hide();
            $('#choose_l_divisi-prior').hide();
            $('#tab_old_risk_list-filterValue').show();

            $('#tab_old_risk_list-filterBy').change(function(){
                var risk_list_prior = $('#tab_old_risk_list-filterBy').val();
                if(risk_list_prior == "risk_event"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').show();
                    $('#tab_old_risk_list-filterValue').val('');
                }else if(risk_list_prior == "risk_level"){
                    $('#choose_r_level-prior').show();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                } else if(risk_list_prior == "risk_impact_level"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').show();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                } else if(risk_list_prior == "risk_likelihood_key"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').show();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                } else if(risk_list_prior == "risk_owner"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').show();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                }

            });

            $('#r_level-prior').change(function(){
                var risk_level = $('#r_level-prior').val();
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', risk_level);
                if(risk_level == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                }
            });

            $('#l_hood-prior').change(function(){
                var likelihood = $("option:selected", this).attr('data-likelihood');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', likelihood);
                var l_hood = $('#l_hood-prior').val();
                if(l_hood == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                }
            });

            $('#impact_l-prior').change(function(){
                var impact_level = $("option:selected", this).attr('data-impact');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', impact_level);
                var impact_l = $('#impact_l-prior').val();
                if(impact_l == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
                }
            });

            $('#l_divisi-prior').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="tab_old_risk_list-filterValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi-prior').val();
                if(l_divisi == "-"){
                    $('#tab_old_risk_list-filterValue').val('');
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
                me.filterDataGridRiskList();
            });

            $("#form_tab_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRiskList();
            });
            

            $('#tab_old_risk_list-filterButton').on('click', function() {
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
                
                me.filterDataGridRegister();
            });

            $("#form_tab_risk_register_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridRegister();
            });
            
            $('#tab_treatment_list-filterButton').on('click', function() {
                me.filterDataGridTreatment();
            });
            
            $("#form_tab_treatment_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridTreatment();
            });

            $('#tab_action_plan_list-filterButton').on('click', function() {
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
                var url = site_url+'/maini/mainpic/execSaveDraft';
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
                                location.href=site_url+'/maini/mainrac';
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
                
                var url = site_url+'/maini/mainpic/execSubmit';
                
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


        },
        initUserChart: function() {
                        
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount/risk", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_rac_to_verify", data, on_options);

            });
            
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount2/riskregister", function( data ) {
                var series = data;
                var tick = [ [0, "User"], [1, ""], [2, ""] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_rr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount/treatment", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_tr_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount/actionplan", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_ap_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount/kri", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_kri_to_verify", data, on_options);
            });
            
            $.getJSON( site_url+"/maini/mainrac/getSummaryCount/change", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_cr_to_verify", data, on_options);
            });
            
        },
        viewOwnedAssignForm: function(username, mode,note) {
             
            var me = this;
            me.tmpRiskId = username;
            me.tmpRiskMode = mode;
            if(note == "null"){
                note = "";
            }
             
            $("#modal_pic_note").val(note);
            $("#modal_pic_risk_input_by").val(username);
            $('#modal-pic').modal('show');
                
        },
          
        //fake
         deleteData: function(data) {
            
                var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to delete this data?');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    var url = site_url+'/maini/mainrac/crDeleteData';
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
            
            gridRiskList.clearAjaxParams();
            gridRiskList.setAjaxParam("filter_by", fby);
            gridRiskList.setAjaxParam("filter_value", fval);
            gridRiskList.getDataTable().ajax.reload();
        },

        filterDataGridOldRiskList: function() {
            var fby = $('#tab_old_risk_list-filterBy').val();
            var fval = $('#tab_old_risk_list-filterValue').val();
            
            gridOldRisk.clearAjaxParams();
            gridOldRisk.setAjaxParam("filter_by", fby);
            gridOldRisk.setAjaxParam("filter_value", fval);
            gridOldRisk.getDataTable().ajax.reload();
        },

        filterDataGridRegister: function() {
            var fby = $('#tab_risk_register_list-filterBy').val();
            var fval = $('#tab_risk_register_list-filterValue').val();
             
            gridRegister.clearAjaxParams();
            gridRegister.setAjaxParam("filter_by", fby);
            gridRegister.setAjaxParam("filter_value", fval);
            gridRegister.getDataTable().ajax.reload();
        },
        filterDataGridTreatment: function() {
            var fby = $('#tab_treatment_list-filterBy').val();
            var fval = $('#tab_treatment_list-filterValue').val();
            
            gridTreatment.clearAjaxParams();
            gridTreatment.setAjaxParam("filter_by", fby);
            gridTreatment.setAjaxParam("filter_value", fval);
            gridTreatment.getDataTable().ajax.reload();
        },
         filterDataGridActionplan: function() {
            var fby = $('#tab_action_plan_list-filterBy').val();
            var fval = $('#tab_action_plan_list-filterValue').val();
            
            gridActionPlan.clearAjaxParams();
            gridActionPlan.setAjaxParam("filter_by", fby);
            gridActionPlan.setAjaxParam("filter_value", fval);
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
            
            grid_kri.clearAjaxParams();
            grid_kri.setAjaxParam("filter_by", fby);
            grid_kri.setAjaxParam("filter_value", fval);
            grid_kri.getDataTable().ajax.reload();
        },
        filterDataGridKriMtg: function() {
            var fby = $('#tab_kri_mtg-filterBy').val();
            var fval = $('#tab_kri_mtg-filterValue').val();
            
            grid_kri_mitigation.clearAjaxParams();
            grid_kri_mitigation.setAjaxParam("filter_by", fby);
            grid_kri_mitigation.setAjaxParam("filter_value", fval);
            grid_kri_mitigation.getDataTable().ajax.reload();
        },
        filterDataGridKrinonMtg: function() {
            var fby = $('#tab_kri_nonmtg-filterBy').val();
            var fval = $('#tab_kri_nonmtg-filterValue').val();
            
            grid_kri_non_mitigation.clearAjaxParams();
            grid_kri_non_mitigation.setAjaxParam("filter_by", fby);
            grid_kri_non_mitigation.setAjaxParam("filter_value", fval);
            grid_kri_non_mitigation.getDataTable().ajax.reload();
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
                    var url = site_url+'/admini/qna/qnaDeleteData';
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
                    var url = site_url+'/admini/qna/qnaDeleteData';
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
                window.open(site_url+'/maini/mainrac/getAllRisk_excel'+'?'+searchnya+$('#get_check_risklist').serialize());
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
                window.open(site_url+'/maini/mainrac/getAllRisk_pdf'+'?'+searchnya+$('#get_check_risklist').serialize());
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
                window.open(site_url+'/maini/mainrac/getAllRiskregister_excel'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
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
                window.open(site_url+'/maini/mainrac/getAllRiskregister_pdf'+'?'+searchnya+$('#get_check_riskregisterlist').serialize());
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
                window.open(site_url+'/maini/mainrac/getAllRisktreatment_excel'+'?'+searchnya+$('#get_check_risktreatment').serialize());
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
                window.open(site_url+'/maini/mainrac/getAllRisktreatment_pdf'+'?'+searchnya+$('#get_check_risktreatment').serialize());
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
                window.open(site_url+'/maini/mainrac/getActionplan_excel'+'?'+searchnya+$('#get_check_actionplan').serialize());
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
                window.open(site_url+'/maini/mainrac/getActionplan_pdf'+'?'+searchnya+$('#get_check_actionplan').serialize());
            }                    
     
});
 
$('#execution_list_excel').on('click', function() {
      
            if($('#get_check_execution').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getExecution_excel'+'?'+$('#get_check_execution').serialize());
            }                    
     
});


$('#execution_list_pdf').on('click', function() {
         
            if($('#get_check_execution').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getExecution_pdf'+'?'+$('#get_check_execution').serialize());
            }                    
     
});


$('#kri_list_excel').on('click', function() {
      
            if($('#get_check_kri').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getKRI_excel'+'?'+$('#get_check_kri').serialize());
            }                    
     
});


$('#kri_list_pdf').on('click', function() {
         
            if($('#get_check_kri').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getKRI_pdf'+'?'+$('#get_check_kri').serialize());
            }                    
     
});


$('#changereq_list_excel').on('click', function() {
      
            if($('#get_check_changereq').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getChangereq_excel'+'?'+$('#get_check_changereq').serialize());
            }                    
     
});


$('#changereq_list_pdf').on('click', function() {
         
            if($('#get_check_changereq').serialize() == ""){
                alert("Please field at least one ")
            }else{
                window.open(site_url+'/maini/mainrac/getChangereq_pdf'+'?'+$('#get_check_changereq').serialize());
            }                    
     
});


function submit_note(){             
    $.ajax({ 
        type: 'POST',
        url: site_url+"/maini/mainrac/submit_note",
        data: $("#noteform").serialize(),
        success: function(data){
            $('#modal-pic').modal('hide');
            gridRegister.getDataTable().ajax.reload();
        }               
    })
}