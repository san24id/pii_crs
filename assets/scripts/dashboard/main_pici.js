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
            "url": site_url+"/main/getMyRiskRegister" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var img = '';
                if (data == '0' || data == '1') {
                    img = 'draft.png';
                }else if(full.risk_existing_control == 'request'){
                    img = 'change_request.png';
                }else if(full.risk_existing_control == 'under'){
                    img = 'default.png';
                }else if (data == '2') {
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
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green-jungle';
                var vm = 'main/mainpic/viewRisk';
                if (full.risk_status == '0' || full.risk_status == '1') {
                    cls = '';
                    vm = 'risk/RiskRegister/modifyRisk';
                } 
                return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
            "targets": 7,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data >= 2 && data < 6) {
                    if (g_submit_mode == true){
                        if(full.risk_existing_control == 'request'){
                            tt='<div class="btn-group">'+
                                '<button type="button" class="btn red btn-xs button-grid-edit" disabled="disabled"><i> Request Pending to RAC </i></button>'+ 
                                '</div>';
                        }else if(full.risk_existing_control == 'under'){
                            tt='';
                        }else{
                         tt = '<div class="btn-group">'+
                              '<button type="button" class="btn btn-sky blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/risk/RiskRegister/ChangeRequestInput/'+full.risk_id+'\'"><i class="fa fa-pencil"> Change Request  </i></button>'+ 
                            '</div>';
                        }
                    }else{
                    tt = '';
                    }
                }
                return tt;
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "impact_level_v" },
            { "data": "likelihood_v" },
            { "data": "risk_owner_v" },
            { "data": "risk_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_owned = new Datatable();
grid_owned.init({
    src: $("#datatable_grid_owned"),
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
            "url": site_url+"/main/mainpic/getOwnedRisk" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
               var img = '';
                if (data == '5') {
                    img = 'submit.png';
                }else if(full.risk_existing_control == 'request'){
                    img = 'change_request.png';
                }else if(full.risk_existing_control == 'under'){ 
                    img = 'default.png';
                }else if (data == '3') {
                    img = 'draft.png';
                }else if (data == '4') {
                    img = 'verified_head.png';
                }else {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.risk_treatment_owner_v;
                var rest = full.risk_status;
                var under = full.risk_existing_control;
                var dat = '';
                if (ret == '' || ret == null) {
                    if(rest == '5' || under == 'under' ){
                            return '<a target="_self" href="'+site_url+'/main/main/viewRiskOwn/'+full.risk_id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
                        }
                } else {
                    if(rest == '5' || under == 'under' ){
                        return '<a target="_self" href="'+site_url+'/main/main/viewRiskOwn/'+full.risk_id+'">'+data+'</a>';
                    }else{
                        return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
                    }
                }
                return dat;
            }
        },{
            "targets": 3,
            "data": "risk_level_v",
            "render": function ( data, type, full, meta ) {
                if(full.risk_status == 3 || full.risk_status == 4 || full.risk_status == 5){
                    return full.risk_level_c;
                }else{
                    return data;
                }
            }
        },{
            "targets": 4,
            "data": "risk_owner_v",
            "render": function ( data, type, full, meta ) {
                if(full.risk_status == 3 || full.risk_status == 4 || full.risk_status == 5){
                    return full.risk_owner_c;
                }else{
                    return data;
                }
            }
        },{
            "targets": 5,
            "data": "suggested_risk_treatment_v",
            "render": function ( data, type, full, meta ) {
                if(full.risk_status == 3 || full.risk_status == 4 || full.risk_status == 5){
                    return full.suggested_risk_treatment_c;
                }else{
                    return data;
                }
            }
        }, {
            "targets": 6,
            "data": "risk_treatment_owner_v",
            "render": function ( data, type, full, meta ) {
                var ret = full.risk_treatment_owner_v;
                var under = full.risk_existing_control;
                if(under == 'under'){
                    return '<span>'+full.risk_treatment_owner_v+'</span>';
                }else{
                    if (data == '' || data == null) {
                        ret = '<span>Unasigned</span> &nbsp; '+
                             '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.risk_id+', \'treatment\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                    }else{
                        ret = '<span>'+full.risk_treatment_owner_v+'</span> &nbsp; '+
                              '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.risk_id+', \'treatment\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                    
                    }
                        return ret;
                    }
                }
        }, {
            "targets": 7,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data == 5) {
                    if (g_submit_mode == true){
                        if(full.risk_existing_control == 'request'){
                            tt='<div class="btn-group">'+
                                '<button type="button" class="btn red btn-xs button-grid-edit" disabled="disabled"><i> Request Pending to RAC </i></button>'+ 
                                '</div>';
                        }else if(full.risk_existing_control == 'under'){
                            tt='';
                        }else{
                         tt = '<div class="btn-group">'+
                              '<button type="button" class="btn btn-sky blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/risk/RiskRegister/ChangeRequestOwned/'+full.risk_id+'\'"><i class="fa fa-pencil"> Change Request  </i></button>'+ 
                            '</div>';
                        }
                    }else{
                    tt = '';
                    }
                }
                return tt;
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "risk_owner_v"},
            { "data": "suggested_risk_treatment_v" },
            { "data": "risk_treatment_owner_v" },
            { "data": "risk_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_action = new Datatable();
grid_action.init({
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
            "url": site_url+"/main/mainpic/getOwnedActionPlan" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 1) {
                    img = 'draft.png';
                }else if (data == 2) {
                    img = 'verified_head.png';
                }else if(full.existing_control_id == 1){
                    img = 'change_request.png';
                }else if (data == 3) {
                    img = 'submit.png';
                }else if (data > 3) {
                    img = 'verified.png';
                }
                return '<center><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
            }
        }, {
            "targets": 1,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                var ret = full.assigned_to_v;
                var dat = '';
                if (ret == '' || ret == null) {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ap">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ap">'+data+'</a>';
                }
                return dat;
            }
        },{
            "targets": 5,
            "data": "division_name",
            "render": function ( data, type, full, meta ) {
                 if(full.action_plan_status == 1 || full.action_plan_status == 2 || full.action_plan_status == 3){
                    if(full.division_name_c != null){
                        return full.division_name_c;
                    }else{
                        return data;
                    }
                }else{
                    return data;    
                }
            }
        },{
            "targets":2,
            "data":"action_plan",
            "render":function(data, type, full, meta){
                if(full.action_plan_status == 1 || full.action_plan_status == 2 || full.action_plan_status == 3){
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
            "targets":3,
            "data":"due_date_v",
            "render":function(data, type, full, meta){
                if(full.action_plan_status == 1 || full.action_plan_status == 2 || full.action_plan_status == 3){
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
        },{
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                if (data == '' || data == null) {
                    ret = '<span>Unasigned</span> &nbsp; '+
                          '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplan\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                }else{
                    ret = '<span>'+data+'</span> &nbsp; '+
                          '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplan\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                }
                return ret;
            }
        }, {
            "targets": 6,
            "data": "rik_code",
           "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.id_p+'">'+data+'</a>';
                }
            }
        }, {
            "targets":8,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data == 3) {
                    if(full.existing_control_id == 1){
                            tt='<div class="btn-group">'+
                                '<button type="button" class="btn red btn-xs button-grid-edit" disabled="disabled"><i> Request Pending to RAC </i></button>'+ 
                                '</div>';
                    }else{
                        tt = '<div class="btn-group">'+
                            '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/main/mainpic/ChangeRequestAction/'+full.id_p+'/'+full.action_plan_status+'\'"><i class="fa fa-pencil"> Change Request </i></button>'+
                        '</div>';
                    }
                }
                return tt;
            }
        } ],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "assigned_to_v" },
            { "data": "division_name"},
            { "data": "risk_code" },
            { "data": "risk_owner_v" },
            { "data": "action_plan_status" } 
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var grid_exec = new Datatable();
grid_exec.init({
    src: $("#datatable_action_exec"),
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
            "url": site_url+"/main/mainpic/getOwnedActionPlanExec" // ajax source
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
                }else if(full.existing_control_id == 1){
                    img = 'change_request.png';
                }else if (data == 6) {
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
                var ret = full.assigned_to_v;
                var dat = '';
               if  (ret == '' || ret == null) {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ac">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id_p+'/'+full.action_plan_status+'?kat=ac">'+data+'</a>';
                }
                return dat;
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
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                    if(full.status_periode == 0){
                        if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }else{
                            ret = '<span>'+data+'</span> &nbsp; '+
                                  '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id_p+', \'actionplanexec\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                        }
                    }else if(full.status_periode == 1){
                         if (data == '' || data == null) {
                            ret = '<span>Unasigned</span> &nbsp;';
                                  
                        }else{
                            ret = '<span>'+data+'</span> &nbsp;';
                        }
                    }
                return ret;
            }
        }, {
            "targets": 7,
            "data": "act_code",
           "render": function ( data, type, full, meta ) {
                var cls = 'font-green';
                if (full.jml_id == '1' || full.jml_id <= '1'){
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/main/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
                }else{
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/library/list_risk_lib?status=ap&&id='+full.id_p+'">'+data+'</a>';
                }
            }
        },{
            "targets": 6,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                var ext = '';
                var search = false;
                var submit = false;

                if(full.status_periode == 0){
                    if(full.action_plan_status != 7 && full.action_plan_status != 6){
                        var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Edit </i></button>';
                        var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                    }else{
                       var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"> Show </i></button>';
                       var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>'; 
                    }
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
                
            }
        }, {
            "targets": 9,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data == 6) {
                     if(full.existing_control_id == 1){
                            tt='<div class="btn-group">'+
                                '<button type="button" class="btn red btn-xs button-grid-edit" disabled="disabled"><i> Request Pending to RAC </i></button>'+ 
                                '</div>';
                    }else{
                     tt = '<div class="btn-group">'+
                            '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/main/mainpic/ChangeRequestActionExe/'+full.id_p+'/'+full.action_plan_status+'\'"><i class="fa fa-pencil"> Change Request </i></button>'+
                        '</div>';
                    }
                }
                return tt;
            }
        }],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "assigned_to_v" },
            { "data": "division_name"},
            { "data": "execution_status" },
            { "data": "risk_code" },
            { "data": "risk_owner_v"},
            //,{ "data": "action_plan_status" }
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
            "url": site_url+"/main/mainpic/getOwnedKri" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "kri_status",
            "render": function ( data, type, full, meta ) {
                var img = 'default.png';
                if (data == 1) {
                    img = 'draft.png';
                } else if (data == 2) {
                    img = 'verified_head.png';
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
                var stat = full.status_periode;
                var ret = full.kri_pic_v;
                var dat = '';
                if(stat == 1){
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewKri/'+full.id+'">'+data+'</a>';
                }else{
                    if (ret == '' || ret == null) {
                        return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    } else {
                        return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedKri/'+full.id+'">'+data+'</a>';
                    }
                    return dat;
                }
            }
        }, {
            "targets": 4,
            "data": "kri_pic_v",
            "render": function ( data, type, full, meta ) {
                var stat = full.status_periode;
                var ret = full.kri_pic_v;
                if(stat == 1){
                    return data;
                }else{
                    if (data == '' || data == null) {
                        ret = '<span>Unasigned</span> &nbsp; '+
                            '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id+', \'kri\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                    }else{
                        ret = '<span>'+data+'</span> &nbsp; '+
                             '<button onclick="javascript: Dashboard.viewOwnedAssignForm('+full.id+', \'kri\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Assignee </i></button>';
                    }
                
                    return ret;
                }
            }   
        }, {
            "targets": 5,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedRisk/'+full.risk_id+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "kri_status",
            "render": function ( data, type, full, meta ) {
                var stat = full.status_periode;
                var tt = '';
                if(stat == 1){
                    return '';
                }else{
                    if (data >= 2) {
                        tt = '<div class="btn-group">'+
                                '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/risk/RiskRegister/ChangeRequestKri/'+full.id+'\'"><i class="fa fa-pencil"> Change Request </i></button>'+
                            '</div>';
                    }
                        return tt;
                    }
                }
        } ],
        "columns": [
            { "data": "kri_status" },
            { "data": "kri_code" },
            { "data": "key_risk_indicator" },
            { "data": "timing_pelaporan_v" },
            { "data": "kri_pic_v" },
            { "data": "risk_code" },
            { "data": "kri_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});


var grid_change = new Datatable();
grid_change.init({
    src: $("#datatable_ajax_change"),
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
            "url": site_url+"/main/getMyChangeRequest" // ajax source
        },
        "columnDefs": [ {
            "targets": 1,
            "data": "cr_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green-jungle';
                if (full.cr_type == 'Risk Register') {
                    var vm = 'risk/RiskRegister';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'">'+data+'</a>';
                }else  if (full.cr_type == 'Action Plan Form') {
                    var vm = 'main/mainpic/ChangeRequestActionView';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                }else  if (full.cr_type == 'Action Plan Execution Form') {
                    var vm = 'main/mainpic/ChangeRequestActionExeView';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                }else  if (full.cr_type == 'Action Plan Execution Prior Form') {
                    var vm = 'main/mainpic/ChangeRequestActionExePriorView';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                }else if (full.cr_status == '1') {
                    var vm = 'risk/riskregister/ChangeRequestView';
                } else {
                    var vm = 'risk/riskregister/ChangeRequestView2';
                }
                return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                //var vm = 'risk/riskregister/ChangeRequestView';
                //return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
            }
        }, {
            "targets": 3,
            "data": "cr_status",
            "render": function ( data, type, full, meta ) {
                if (data == '1') return '<i class="fa fa-bell-o font-black"> Complete </i>';
                if (data == '0') return '<i class="fa fa-bell font-black"> Pending </i>';
                return '<i class="fa fa-bell-slash font-black"> Undefined </i>';
            }
        }],
        "columns": [
            { "data": "GenRowNum" },
            { "data": "cr_code" },
            { "data": "cr_type" },
            { "data": "cr_status" },
            { "data": "created_date" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

$("#pic_list_table").DataTable();

var Dashboard = function() {
    return {
        tmpRiskId: null,
        init: function() {
            var me = this;
            
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
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
                if(risk_list == "risk_code"){
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').show();
                    $('#tab_risk_list-filterValue').val('');
                }else if(risk_list == "risk_event"){
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
        //end 

            //--------------------------Register Prior
            $('#choose_r_level-prior').hide();
            $('#choose_l_hood-prior').hide();
            $('#choose_impact_l-prior').hide();
            $('#choose_l_divisi-prior').hide();
            $('#tab_old_risk_list-filterValue').show();

            $('#tab_old_risk_list-filterBy').change(function(){
                var risk_list_prior = $('#tab_old_risk_list-filterBy').val();
                if(risk_list_prior == "risk_code"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').show();
                    $('#tab_old_risk_list-filterValue').val('');
                }else if(risk_list_prior == "risk_event"){
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


             //--------------------treatment
            $('#choose_l_divisi-treatment').hide();

            $('#tab_treatment_list-filterBy').change(function(){
                var risk_treatment = $('#tab_treatment_list-filterBy').val();
                 if(risk_treatment == "risk_code"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_event"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_level"){
                    $('#choose_l_divisi-treatment').hide();
                    $('#tab_treatment_list-filterValue').show();
                    $('#tab_treatment_list-filterValue').val('');
                 }else if(risk_treatment == "risk_division"){
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
            
             //------------------action plan
            $('#choose_l_divisi-action').hide();

            $('#tab_action_plan_list-filterBy').change(function(){
                var risk_action = $('#tab_action_plan_list-filterBy').val();
                 if(risk_action == "risk_code"){
                    $('#choose_l_divisi-action').hide();
                    $('#tab_action_plan_list-filterValue').show();
                    $('#tab_action_plan_list-filterValue').val('');
                 }else if(risk_action == "action_plan"){
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
                 }else if(risk_action == "risk_owner"){
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
                 if(risk_execution == "risk_code"){
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                 }else if(risk_execution == "action_plan"){
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
                }else if(risk_execution == "risk_owner"){
                    $('#choose_l_divisi-execution').show();
                    $('#choose_status-execution').hide();
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
        //end 

            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
            
            var cnt1 = cnt2 = cnt3 = 0; 
            $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/0", function( data ) {
                $.each( data, function( key, val ) {
                    // GET INIT SUB CATEGORY
                    if (cnt1 == 0) {
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+val.ref_key, function( data1 ) {
                            $.each( data1, function( key2, val2 ) {
                                if (cnt2 == 0) {
                                    // GET INIT 2ND SUB CATEGORY
                                    $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+val2.ref_key, function( data2 ) {
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

             var cnto1 = cnto2 = cnto3 = 0; 
            $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/0", function( data ) {
                $.each( data, function( key, val ) {
                    // GET INIT SUB CATEGORY
                    if (cnto1 == 0) {
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+val.ref_key, function( data1 ) {
                            $.each( data1, function( key2, val2 ) {
                                if (cnto2 == 0) {
                                    // GET INIT 2ND SUB CATEGORY
                                    $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+val2.ref_key, function( data2 ) {
                                        $.each( data2, function( key3, val3 ) {
                                            $('#sel_old_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
                                        });
                                    });
                                }
                                
                                $('#sel_old_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
                                    
                                cnto2++;
                            });
                        });
                    }
                    
                    $('#sel_old_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                        
                    cnto1++;
                });
            });
            
            $('#sel_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_sub_category', val);
            });
            
            $('#sel_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategorySelect('sel_risk_2nd_sub_category', val);
            });

            $('#sel_old_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_sub_category', val);
            });
            
            $('#sel_old_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_2nd_sub_category', val);
            });
            
            // FILTER BUTTON
            $('#button-filter-category').on('click', function() {
                var cat = $("#sel_risk_2nd_sub_category").val();
                me.filterMyRisk('risk_2nd_sub_category', cat);
            });
            
            $('#button-filter-clear').on('click', function() {
                me.filterMyRisk('risk_2nd_sub_category', false);
            });

            $('#tab_risk_list-filterButton').on('click', function() {
                me.filterMyRisk();
            });

            $("#form_tab_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterMyRisk();
            });

            $('#button-old-filter-category').on('click', function() {
                var cat = $("#sel_old_risk_2nd_sub_category").val();
                me.filterOldMyRisk('risk_old_2nd_sub_category', cat);
            });

            
            $('#button-old-filter-clear').on('click', function() {
                me.filterOldMyRisk('risk_old_2nd_sub_category', false);
            });

           $('#tab_old_risk_list-filterButton').on('click', function() {
                me.filterOldMyRisk();
            });

            $("#form_tab_old_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterOldMyRisk();
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

            //end
            
            $('#pic_list_table button.button-assign-pic').on('click', function() {
                var xx = $(this).attr("value");
                var idx = $(this).attr("value_idx");
                var mode = me.tmpRiskMode;
                
                var vv = $('#modal-pic-tr-'+idx+' > td.col_display_name').html();
                
                var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this risk ?';
                if (mode == 'actionplan') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this Action Plan ?';
                }
                
                if (mode == 'kri') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this KRI ?';
                }
                
                var mod = MainApp.viewGlobalModal('confirm', text);
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    $('#modal-pic').modal('hide');
                    me.ownedAssignPic(me.tmpRiskId, xx, mode);
                });
            });
            
            $('#exec-select-status').change(function() {
                if ($( this ).val() == 'EXTEND') {
                    $('#fgroup-explain').hide();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').show();
                    $('#fgroup-date').show();
                    $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                } else if ($( this ).val() == 'COMPLETE') {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
                else  {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
            });
            
            $("#datatable_action_exec").on('click', 'button.button-grid-search', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec.getDataTable().row(r).data();
                me.viewExecutionForm(data);
            });
            
            $("#datatable_action_exec").on('click', 'button.button-grid-submit', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec.getDataTable().row(r).data();
                
                var url = site_url+'/main/mainpic/execSubmit';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Submit this Action Plan Execution?');
                mod.find('button.btn-primary').off('click');
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        {action_id: data.id_p},
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {
                                grid_exec.getDataTable().ajax.reload();
                                
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
//simpan yang on going          
            $('#exec-button-save').on('click', function() {
                var me = this;
                var url = site_url+'/main/mainpic/execSaveDraft';
                var valid = false;
                
                if ($('#exec-select-status').val() == 'COMPLETE') {
                    if (
                        $( "#exec-form" ).find('textarea[name=execution_explain]').val() != ''
                    ) valid = true
                        $( "#exec-form" ).find('textarea[name=execution_evidence]').val() != ''
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
                    var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to save this Action Plan Execution ?');
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
                                    grid_exec.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                                } else {
                                     
                            //ubah
                            var mod = MainApp.viewGlobalModal('warning-maintenance', 'This Risk Is Under Maintenance by RAC you cannot modify this risk until the process done');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainpic';
                            });
                                }
                            },
                            "json"
                        ).fail(function() {
                            Metronic.unblockUI();
                            //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                              grid_exec.getDataTable().ajax.reload();
                              MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                         });
                    });
                } else {
                    MainApp.viewGlobalModal('error', 'Please Fill All Action Plan Execution data');
                }
            });
            
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body");
        },
        initUserChart: function() {
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myrisk", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_user", data, on_options);
                /*
                $("#chart_user").bind("plothover", function (event, pos, item) {
                    if (item) {
                        var x = item.datapoint[0].toFixed(0)
    
                        $("#tooltip").html(x)
                            .css({top: item.pageY+5, left: item.pageX+5})
                            .fadeIn(200);
                    } else {
                        $("#tooltip").hide();
                    }
                });
                */
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myriskowned", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_owned", data, on_options);
                
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/myactionplan", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_action_plan", data, on_options);
            });
            
            $.getJSON( site_url+"/main/mainpic/getSummaryCount/kri", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_kri", data, on_options);
            });
            
        },
        loadCategorySelect: function(sel_id, parent) {
            $('#'+sel_id)[0].options.length = 0;
            $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+parent, function( data ) {
                $.each( data, function( key, val ) {
                    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                });
                $('#'+sel_id).trigger('change');
            });
        },
        filterMyRisk: function(fby, fval) {
            grid.clearAjaxParams();
            if (fval) {
                grid.setAjaxParam("risk_cat", fval);
            }
            var fby = $('#tab_risk_list-filterBy').val();
            var flis = $('#tab_risk_list-filterValue').val();
            
            grid.setAjaxParam("filter_by", fby);
            grid.setAjaxParam("filter_value", flis);
            grid.getDataTable().ajax.reload();
        },
        loadCategoryOldSelect: function(sel_id, parent) {
            $('#'+sel_id)[0].options.length = 0;
            $.getJSON( site_url+"/risk/RiskRegister/getCategory_in/"+parent, function( data ) {
                $.each( data, function( key, val ) {
                    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                });
                $('#'+sel_id).trigger('change');
            });
        },
        filterOldMyRisk: function(fby, fval) {
            grid_old.clearAjaxParams();
            if (fval) {
                grid_old.setAjaxParam("risk_cat", fval);
            }
            var fby = $('#tab_old_risk_list-filterBy').val();
            var flis = $('#tab_old_risk_list-filterValue').val();
            
            grid_old.setAjaxParam("filter_by", fby);
            grid_old.setAjaxParam("filter_value", flis);
            grid_old.getDataTable().ajax.reload();
        },

        filterDataGridTreatment: function() {
            var fby = $('#tab_treatment_list-filterBy').val();
            var fval = $('#tab_treatment_list-filterValue').val();
            
            grid_owned.clearAjaxParams();
            grid_owned.setAjaxParam("filter_by", fby);
            grid_owned.setAjaxParam("filter_value", fval);
            grid_owned.getDataTable().ajax.reload();
        },
         filterDataGridActionplan: function() {
            var fby = $('#tab_action_plan_list-filterBy').val();
            var fval = $('#tab_action_plan_list-filterValue').val();
            
            grid_action.clearAjaxParams();
            grid_action.setAjaxParam("filter_by", fby);
            grid_action.setAjaxParam("filter_value", fval);
            grid_action.getDataTable().ajax.reload();
        },
        filterDataGridActionplanexec: function() {
            var fby = $('#tab_action_plan_exec-filterBy').val();
            var fval = $('#tab_action_plan_exec-filterValue').val();
            
            grid_exec.clearAjaxParams();
            grid_exec.setAjaxParam("filter_by", fby);
            grid_exec.setAjaxParam("filter_value", fval);
            grid_exec.getDataTable().ajax.reload();
        },
         filterDataGridKri: function() {
            var fby = $('#tab_kri-filterBy').val();
            var fval = $('#tab_kri-filterValue').val();
            
            grid_kri.clearAjaxParams();
            grid_kri.setAjaxParam("filter_by", fby);
            grid_kri.setAjaxParam("filter_value", fval);
            grid_kri.getDataTable().ajax.reload();
        },
        viewOwnedAssignForm: function(risk_id, mode) {
            var me = this;
            me.tmpRiskId = risk_id;
            me.tmpRiskMode = mode;
            
            $('#modal-pic').modal('show');
        },
        ownedAssignPic: function(risk_id, pic, mode) {
            Metronic.blockUI({ boxed: true });
            var url = site_url+'/main/mainpic/assignPic';
            $.post(
                url,
                { 'risk_id':  risk_id, 'pic':  pic, 'mode': mode },
                function( data ) {
                    Metronic.unblockUI();
                    if(data.success) {
                        if (mode == 'treatment') {
                            grid_owned.getDataTable().ajax.reload();
                        } else if (mode == 'kri') {
                            grid_kri.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexec') {
                            grid_exec.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexecadt') {
                            grid_exec_adt.getDataTable().ajax.reload();
                        } else {
                            grid_action.getDataTable().ajax.reload();
                        }
                        MainApp.viewGlobalModal('success', 'Success Assign PIC');
                    } else {
                        MainApp.viewGlobalModal('error', data.msg);
                    }
                    
                },
                "json"
            ).fail(function() {
                Metronic.unblockUI();
                MainApp.viewGlobalModal('error', 'Error Submitting Data');
             });
            
        },
 //ini view yang excecution on going
        viewExecutionForm: function(data) {
            var me = this;
            var act_id = data.id_p;
            var act_du = data.due_date_v;
            
            $('#exec-form')[0].reset();
            
            $('#form-action-id').val(act_id);
            $('#form-action-dd').val(act_du);
            
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
/* untuk menampilkan data saat di search yang on going*/

            } else if (data.execution_status == 'ONGOING') {
                $( '#exec-select-status' ).val(data.execution_status);
                $( "#exec-form" ).find('textarea[name=execution_explain]').val(data.execution_explain);
                
                $('#fgroup-explain').show();
                
                if (data.is_owner == 1) {
                    if (data.action_plan_status == 4) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                    if (data.is_head == '1' && data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                } else {
                    if (data.action_plan_status == 5) {
                        $( '#exec-select-status' ).prop('disabled', false);
                        $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                        
                        $('#exec-button-save').show();
                    }
                }
}else{
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
            
        }
    };  
}();


var grid_exec_adt = new Datatable();
grid_exec_adt.init({
    src: $("#datatable_action_exec_adt"),
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
            "url": site_url+"/main/mainpic/getOwnedActionPlanExec_adt" // ajax source
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
                var ret = full.assigned_to_v;
                var dat = '';
                if (ret == '' || ret == null) {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id+'">'+data+'</a>';
                } else {
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedActionPlan/'+full.id+'">'+data+'</a>';
                }
                return dat;
            }
        },{
            "targets": 4,
            "data": "assigned_to_v",
            "render": function ( data, type, full, meta ) {
                var ret = data;
                if (data == '' || data == null) {
                    ret = '<span>Unasigned</span> &nbsp; '+
                          '<button onclick="javascript: Actionplan_adt.viewOwnedAssignForm('+full.id+', \'actionplanexecadt\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Search </i></button>';
                }else{
                    ret = '<span>'+data+'</span> &nbsp; '+
                          '<button onclick="javascript: Actionplan_adt.viewOwnedAssignForm('+full.id+', \'actionplanexecadt\')" type="button" class="btn blue btn-xs button-grid-edit"><i class="fa fa-search"> Search </i></button>';
                }
                return ret;
            }
        }, {
            "targets": 5,
            "data": "execution_status",
            "render": function ( data, type, full, meta ) {
                var ext = '';
                var search = false;
                var submit = false;
                
                var search_text = '<button type="button" class="btn blue btn-xs button-grid-search"><i class="fa fa-search"></i></button>';
                var submit_text = '<button type="button" class="btn blue btn-xs button-grid-submit"><i class="fa fa-check-circle"></i> Submit</button>';
                
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
                
            }
        }
        /*, {
            "targets": 6,
            "data": "action_plan_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data >= 3) {
                    tt = '<div class="btn-group">'+
                            '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/risk/RiskRegister/ChangeRequestAction/'+full.id+'\'"><i class="fa fa-pencil"></i></button>'+
                        '</div>';
                }
                return tt;
            }
        } */
         ],
        "columns": [
            { "data": "action_plan_status" },
            { "data": "act_code" },
            { "data": "action_plan" },
            { "data": "due_date_v" },
            { "data": "assigned_to_v" },
            { "data": "execution_status" }
            //,{ "data": "action_plan_status" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var grid_old = new Datatable();
grid_old.init({
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
            "url": site_url+"/main/getOldMyRiskRegister" // ajax source
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
                var cls = 'font-green-jungle';
                var vm = 'main/mainpic/viewRisk';
                if (full.risk_status == '0' || full.risk_status == '1') {
                    cls = '';
                    vm = 'risk/RiskRegister/modifyRisk';
                } 
                return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.risk_id+'">'+data+'</a>';
            }
        } ],
        "columns": [
            { "data": "risk_status" },
            { "data": "risk_code" },
            { "data": "risk_event" },
            { "data": "risk_level_v" },
            { "data": "impact_level_v" },
            { "data": "likelihood_v" },
            { "data": "risk_owner_v" },
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

//---------------------------------fake-------------

var Actionplan_adt = function() {
    return {
        tmpRiskId: null,
        init: function() {
            var me = this;
            
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: Metronic.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
                //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
            };
             
            $('#exec-select-status').change(function() {
                if ($( this ).val() == 'EXTEND') {
                    $('#fgroup-explain').hide();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').show();
                    $('#fgroup-date').show();
                    $( "#exec-form" ).find('textarea[name=execution_reason]').prop('readonly', false);
                } else if ($( this ).val() == 'COMPLETE') {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
                else  {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                    $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                }
            });
            
            $('#pic_list_table button.button-assign-pic').on('click', function() {
                var xx = $(this).attr("value");
                var idx = $(this).attr("value_idx");
                var mode = me.tmpRiskMode;
                
                var vv = $('#modal-pic-tr-'+idx+' > td.col_display_name').html();
                
                var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this risk ?';
                if (mode == 'actionplan') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this Action Plan ?';
                }
                
                if (mode == 'kri') {
                    var text = 'Are You sure you want to Assign <b>'+vv+'</b> for this KRI ?';
                }
                
                var mod = MainApp.viewGlobalModal('confirm', text);
                mod.find('button.btn-primary').one('click', function(){
                    mod.modal('hide');
                    $('#modal-pic').modal('hide');
                    me.ownedAssignPic(me.tmpRiskId, xx, mode);
                });
            });

            $("#datatable_action_exec_adt").on('click', 'button.button-grid-search', function(e) {
                e.preventDefault();
                 
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec_adt.getDataTable().row(r).data();
                me.viewExecutionForm_adt(data);
            });
            
            $("#datatable_action_exec_adt").on('click', 'button.button-grid-submit', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid_exec_adt.getDataTable().row(r).data();
                
                var url = site_url+'/main/mainpic/execSubmit';
                
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Submit this Action Plan Execution ?');
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
                                grid_exec_adt.getDataTable().ajax.reload();
                                
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
                    var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to save this Action Plan Execution ?');
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
                                    grid_exec.getDataTable().ajax.reload();
                                    
                                    //MainApp.viewGlobalModal('success', 'Success Updating Action Plan Execution');
                                    location.href=site_url+'/main/mainpic/actionplan_adt';
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
                } else {
                    MainApp.viewGlobalModal('error', 'Please Fill All Action Plan Execution data');
                }
            });
            
            $("<div id='tooltip'></div>").css({
                position: "absolute",
                display: "none",
                border: "1px solid #fdd",
                padding: "2px",
                "background-color": "#fee",
                opacity: 0.80
            }).appendTo("body");
        },
        viewOwnedAssignForm: function(risk_id, mode) {
            var me = this;
            me.tmpRiskId = risk_id;
            me.tmpRiskMode = mode;
            
            $('#modal-pic').modal('show');
        },
        ownedAssignPic: function(risk_id, pic, mode) {
            Metronic.blockUI({ boxed: true });
            var url = site_url+'/main/mainpic/assignPic';
            $.post(
                url,
                { 'risk_id':  risk_id, 'pic':  pic, 'mode': mode },
                function( data ) {
                    Metronic.unblockUI();
                    if(data.success) {
                        if (mode == 'treatment') {
                            grid_owned.getDataTable().ajax.reload();
                        } else if (mode == 'kri') {
                            grid_kri.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexec') {
                            grid_exec.getDataTable().ajax.reload();
                        } else if (mode == 'actionplanexecadt') {
                            grid_exec_adt.getDataTable().ajax.reload();
                        } else {
                            grid_action.getDataTable().ajax.reload();
                        }
                        MainApp.viewGlobalModal('success', 'Success Assign PIC');
                    } else {
                        MainApp.viewGlobalModal('error', data.msg);
                    }
                    
                },
                "json"
            ).fail(function() {
                Metronic.unblockUI();
                MainApp.viewGlobalModal('error', 'Error Submitting Data');
             });
            
        },
        viewExecutionForm_adt: function(data) {
            var me = this;
            var act_id = data.id;
            var act_du = data.due_date_v;
              
            $('#form-action-id').val(act_id);
            $('#form-action-dd').val(act_du);
            
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
                $( '#exec-select-status' ).val('ONGOING');
                $('#fgroup-explain').show();
                $('#fgroup-evidence').hide();
                $( '#exec-select-status' ).prop('disabled', false);
                $( "#exec-form" ).find('textarea[name=execution_explain]').prop('readonly', false);
                $( "#exec-form" ).find('textarea[name=execution_evidence]').prop('readonly', false);
                $( "#exec-form" ).find('textarea[name=execution_explain]').val(data.execution_explain);
                $('#exec-button-save').show();
            }
         
            
            $('#modal-exec').modal('show');
            
        }
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
            $('#modal-export-treatment').modal('show');
        }
        
        if(tabactive == "2"){   
            $('#modal-actionplanlist').modal('show');
        }
        
        if(tabactive == "3"){   
            $('#modal-executionlist').modal('show');
        }
        
        if(tabactive == "4"){   
            $('#modal-kri').modal('show');
        }
        
        if(tabactive == "5"){   
            $('#modal-changereq').modal('show');
        }

        if(tabactive == "6"){   
            $('#modal-risk_prior').modal('show');
        }
}); 
 

$('#risk_list_excel').on('click', function() {
      
            if($('#get_check_risklist').serialize() == ""){
                alert("Please field at least one ")
            }else{
                var user = $('#tabuser').val();
                var divisi = $('#tabdiv').val();
                var role = $('#tabrol').val();
                var search = $("#tab_risk_list-filterValue").val();
                if(search !=""){
                    var searchnya = "search="+search+"&";
                }else{
                    var searchnya = "";
                } 
                window.open(site_url+'/main/main/getAllRiskUser_excel'+'?'+searchnya+$('#get_check_risklist').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});

$('#risk_list_pdf').on('click', function() {
         
            if($('#get_check_risklist').serialize() == ""){
                alert("Please field at least one ")
            }else{
                    var user = $('#tabuser').val();
                    var divisi = $('#tabdiv').val();
                    var role = $('#tabrol').val();
                    var search = $("#tab_risk_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getAllRiskUser_pdf'+'?'+searchnya+$('#get_check_risklist').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});
 
$('#treatment_list_excel').on('click', function() {
      
            if($('#get_check_risktreatment').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 var search = $("#tab_treatment_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getAllRiskOwned_excel'+'?'+searchnya+$('#get_check_risktreatment').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});

$('#treatment_list_pdf').on('click', function() {
         
            if($('#get_check_risktreatment').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 var search = $("#tab_treatment_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getAllRiskOwned_pdf'+'?'+searchnya+$('#get_check_risktreatment').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#actionplan_list_excel').on('click', function() {
      
            if($('#get_check_actionplan').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 var search = $("#tab_action_plan_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getActionplanUser_excel'+'?'+searchnya+$('#get_check_actionplan').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});
 
$('#actionplan_list_pdf').on('click', function() {
         
            if($('#get_check_actionplan').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 var search = $("#tab_action_plan_list-filterValue").val();
                    if(search !=""){
                        var searchnya = "search="+search+"&";
                    }else{
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getActionplanUser_pdf'+'?'+searchnya+$('#get_check_actionplan').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});
 
$('#execution_list_excel').on('click', function() {
      
            if($('#get_check_execution').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                window.open(site_url+'/main/main/getExecutionUser_excel'+'?'+$('#get_check_execution').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#execution_list_pdf').on('click', function() {
         
            if($('#get_check_execution').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 window.open(site_url+'/main/main/getExecutionUser_pdf'+'?'+$('#get_check_execution').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#kri_list_excel').on('click', function() {
      
            if($('#get_check_kri').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 window.open(site_url+'/main/main/getKRIUser_excel'+'?'+$('#get_check_kri').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#kri_list_pdf').on('click', function() {
         
            if($('#get_check_kri').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                 window.open(site_url+'/main/main/getKRIUser_pdf'+'?'+$('#get_check_kri').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#changereq_list_excel').on('click', function() {
      
            if($('#get_check_changereq').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                window.open(site_url+'/main/main/getChangereqUser_excel'+'?'+$('#get_check_changereq').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});


$('#changereq_list_pdf').on('click', function() {
         
            if($('#get_check_changereq').serialize() == ""){
                alert("Please field at least one ")
            }else{
                 var user = $('#tabuser').val();
                 var divisi = $('#tabdiv').val();
                 var role = $('#tabrol').val();
                window.open(site_url+'/main/main/getChangereqUser_pdf'+'?'+$('#get_check_changereq').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
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
                    var user = $('#tabuser').val();
                    var divisi = $('#tabdiv').val();
                    var role = $('#tabrol').val();
                    var searchnya = "";
                } 
                window.open(site_url+'/main/main/getAllRiskPriorUser_excel'+'?'+searchnya+$('#get_check_risklist').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
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
                        var user = $('#tabuser').val();
                        var divisi = $('#tabdiv').val();
                        var role = $('#tabrol').val();
                        var searchnya = "";
                    } 
                window.open(site_url+'/main/main/getAllRiskPriorUser_pdf'+'?'+searchnya+$('#get_check_risklist').serialize()+'&'+'user='+user+'&'+'divisi='+divisi+'&'+'role='+role);
            }                    
     
});

