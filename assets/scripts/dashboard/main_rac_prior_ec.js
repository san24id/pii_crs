
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
            "url": site_url+"/main/mainrac/getActionPlanExec_prior" // ajax source
        },
        "columnDefs": [ {
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
                     return '<a target="_self" href="'+site_url+'/main/mainrac/FormactionPlanExecPrior/'+full.id_p+'/'+full.action_plan_status+'?kat=pri">AP.'+data+'</a>';
                }else{       
                    //return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id+'">'+data+'</a>';
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewActionPlanPrior/'+full.id_p+'/'+full.action_plan_status+'?kat=pri">AP.'+data+'</a>';
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
                                    //gridActionExec.getDataTable().ajax.reload();
                            
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
			{ "data": "action_plan_status","orderable":true },
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
                return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanView/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
            }
        }, {
            "targets": 6,
            "data": "act_code",
            "render": function ( data, type, full, meta ) {
                return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
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
                                return '<a target="_self" href="'+site_url+'/main/mainrac/actionPlanExecForm/'+full.id_p+'/'+full.action_plan_status+'">'+data+'</a>';
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
            "url": site_url+"/main/mainrac/getKri" // ajax source
        },
        "columnDefs": [ {
        	"targets": 0,
        	"data": "kri_status",
        	"render": function ( data, type, full, meta ) {
        		var img = 'default.png';
        		if (data == 0) {
        			img = 'draft.png';
        		} else if (data == 1) {
        			img = 'verified_head.png';
        		} else if (data == 2) {
        			img = 'submit.png';
        		}else if (data > 2) {
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
            		img = base_url+'assets/images/legend/kri_'+img+'.png';
            		return '<img src="'+img+'"/>';
        		} 
        		return '';
        	}
        } ],
        "columns": [
			{ "data": "kri_status" },
			{ "data": "kri_code" },
			{ "data": "key_risk_indicator" },
			{ "data": "kri_owner" },
			{ "data": "timing_pelaporan_v" },
			{ "data": "risk_code" },
			{ "data": "kri_warning" }
       ],
        "order": [
            [1, "asc"]
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
                    var vm = 'main/mainrac/ChangeRequestActionVerify';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
                }else if (full.cr_status == '1') {
                    var vm = 'main/mainrac/ChangeRequestView';
                } else {
         			var vm = 'main/mainrac/ChangeRequestVerify';
         		}
         		return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
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
                    return '<a target="_self" href="'+site_url+'/main/mainrac/viewRisk/'+full.risk_id+'">'+data+'</a>';
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
            { "data": "risk_owner_v" }
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

            //---------------------acntion plan execution
            $('#choose_l_divisi-execution').hide();
            $('#choose_l_owner-execution').hide();
            $('#choose_status-execution').hide();
            $('#choose_s_level-execution').show();
            $('#tab_action_plan_exec-filterValue').hide();
            $('#ap_id').hide();

            $('#tab_action_plan_exec-filterBy').change(function(){
                var risk_execution = $('#tab_action_plan_exec-filterBy').val();
                 if(risk_execution == "action_plan"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                 }else if(risk_execution == "due_date"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                }else if(risk_execution == "division"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').show()
                    $('#choose_l_owner-execution').hide();;
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                }else if(risk_execution == "execution_status"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').show();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                }else if(risk_execution == "risk_code"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                 }else if(risk_execution == "risk_owner"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').show();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                 }else if(risk_execution == "action_plan_status"){
                    $('#choose_s_level-execution').show();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').hide();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').hide();
                }else if(risk_execution == "ap_code"){
                    $('#choose_s_level-execution').hide();
                    $('#choose_l_divisi-execution').hide();
                    $('#choose_l_owner-execution').hide();
                    $('#choose_status-execution').hide();
                    $('#tab_action_plan_exec-filterValue').show();
                    $('#tab_action_plan_exec-filterValue').val('');
                    $('#ap_id').show();
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

            $('#s_level-execution').change(function(){
                var action_plan_status = $('#s_level-execution').val();
                $('input[id="tab_action_plan_exec-filterValue"]').attr('value', action_plan_status);
                if(action_plan_status == "-"){
                    $('#tab_action_plan_exec-filterValue').val('');
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
			
            $("#form_tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
            });
            
        	$('#tab_action_plan_exec-filterButton').on('click', function() {
        		me.filterDataGridActionplanexec();
        	});

             $("#tab_action_plan_exec").submit(function (e) {
                e.preventDefault();
                me.filterDataGridActionplanexec();
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

            $('#datatable_action_plan_exec').on('click', 'button.button-grid-edit', function(e) {
           
           
                e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data(); 
                    me.showriskform_ap(data);
                
            });

        $('#library-modal-listriskap-update').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/main/mainrac/update_apex';
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

     /*$('#library-modal-listriskap-verify').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/main/mainrac/update_verify';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#modal-verify_ap-form" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridActionExec.getDataTable().ajax.reload();
                                    
                                    $('#modal_ap_verify').modal('hide');
                                    
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
                     
                });*/

            $('#exec-button-submit').on('click', function () {
                if($('#exec-select-status').val() == "COMPLETE"){                   
                    $('#modal-category-validation').modal('show');  
                }else{
                    //me.submitRiskData('verify');
                     $('#modal-category-validation').modal('show'); 
                }
                
            });


            $('#datatable_action_plan_exec').on('click', 'button.button-grid-verify', function(e) { 
           
           
                    e.preventDefault();
                    

                    var r = this.parentNode.parentNode.parentNode; 
                    var data = gridActionExec.getDataTable().row(r).data();

                    gridActionExec.getDataTable().ajax.reload();

                    var x = screen.width/2 - 950/2;
                    var y = screen.height/2 - 700/2;
                    
                    var openverify;
                    openverify =  window.open('index.php/main/mainrac/actionPlanExecFormPriorShow/'+data.id_p+'/'+data.action_plan_status+'/'+7,'name','location=no,menubar=no,scrollbars=yes,resizable=no,fullscreen=no,height=550,width=1024,left='+x+',top='+y);
                    openverify.focus();     
                    //me.showriskform_verify(data);
                
            });

            $('#exec-select-status').change(function() {
                if ($( this ).val() == 'EXTEND') {
                    $('#fgroup-explain').hide();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').show();
                    $('#fgroup-date').show();
                    $('#fgroup-review').show();
                }
                 else if ($( this ).val() == 'ONGOING') {
                    $('#fgroup-explain').show();
                    $('#fgroup-review').show();
                    $('#fgroup-evidence').hide();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                }
                else {
                    $('#fgroup-explain').show();
                    $('#fgroup-evidence').show();
                    $('#fgroup-reason').hide();
                    $('#fgroup-date').hide();
                    $('#fgroup-review').hide();
                }
            });

            $('#exec-button-clouse').on('click', function () {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your Action Plan Verification ? You will loose your unsaved data.');
                mod.find('button.btn-primary').one('click', function(){
                    window.close();
                });
            });

            $('#modal-changelevel-form-verify-no').on('click', function(e) {

                e.preventDefault();
                    
                var r = this.parentNode.parentNode.parentNode; 
                var data = gridActionExec.getDataTable().row(r).data();
                me.ChangeLevelRiskDataNo(data)          
            });

            $('#refresh_prior_ap').on('click', function() {
                gridActionExec.getDataTable().ajax.reload();
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

            showriskform_verify: function(data) {


                $('#modal-verify_ap-form').find('input[name=ap_code]').attr('readonly', true).val("AP."+data.id_p);
                $('#modal-verify_ap-form').find('input[name=id]').attr('readonly', true).val(data.id_p);
                $('#modal-verify_ap-form').find('textarea[name=action_plan]').attr('readonly', true).val(data.action_plan);
                if(data.due_date_v == '00-00-0000'){
                    $('#modal-verify_ap-form').find('input[name=due_date]').attr('readonly', true).val('Continuous');
                }else{
                    $('#modal-verify_ap-form').find('input[name=due_date]').attr('readonly', true).val(data.due_date_v);
                }
                
              
                $('#modal-verify_ap-form').find('input[name=action_plan_status]').attr('readonly', true).val(data.action_plan_status);
                $('#modal-verify_ap-form').find('input[name=periode_id]').attr('readonly', true).val(data.periode_id);
                $('#modal-verify_ap-form').find('textarea[name=action_plan_ex]').attr('readonly', true).val(data.action_plan);
                $('#modal-verify_ap-form').find('input[name=division_ex]').attr('readonly', true).val(data.division_name);
                $('#modal-verify_ap-form').find('select[name=execution_status]').attr('readonly', false).val(data.execution_status);


                if(data.action_plan_status == 7){
                     $('#modal-verify_ap-form').find('select[name=review_status]').attr('readonly', false).val(1);

                    if(data.execution_status == 'ONGOING'){
                        $('#fgroup-explain').show();
                        $('#fgroup-review').hide(); 
                        $('#modal-verify_ap-form').find('textarea[name=execution_explain]').attr('readonly', false).val(data.execution_explain);
                        $('#fgroup-evidence').hide();
                        $('#fgroup-reason').hide();
                        $('#fgroup-date').hide();
                    }else if(data.execution_status == 'EXTEND'){
                        $('#fgroup-reason').show();
                        $('#fgroup-date').show();
                        $('#fgroup-review').hide();  
                        $('#modal-verify_ap-form').find('textarea[name=execution_reason]').attr('readonly', false).val(data.execution_reason);
                        $('#modal-verify_ap-form').find('input[name=revised_date]').attr('readonly', true).val(data.revised_date);
                        $('#fgroup-explain').hide();
                        $('#fgroup-evidence').hide(); 
                    }else if(data.execution_status == 'COMPLETE'){
                        $('#fgroup-explain').show();
                        $('#fgroup-evidence').show(); 
                        $('#modal-verify_ap-form').find('textarea[name=execution_explain]').attr('readonly', false).val(data.execution_explain);
                        $('#modal-verify_ap-form').find('textarea[name=execution_evidence]').attr('readonly', false).val(data.execution_evidence);
                        $('#fgroup-review').hide();
                        $('#fgroup-reason').hide();
                        $('#fgroup-date').hide();  
                    }
                }else{
                    if(data.execution_status == 'COMPLETE'){
                        $('#modal-verify_ap-form').find('select[name=review_status]').attr('readonly', false).val(1);
                    }else{
                        $('#modal-verify_ap-form').find('select[name=review_status]').attr('readonly', false).val('');
                    }

                    if(data.execution_status == 'ONGOING'){
                        $('#fgroup-explain').show();
                        $('#fgroup-review').show(); 
                        $('#modal-verify_ap-form').find('textarea[name=execution_explain]').attr('readonly', false).val(data.execution_explain);
                        $('#fgroup-evidence').hide();
                        $('#fgroup-reason').hide();
                        $('#fgroup-date').hide();
                    }else if(data.execution_status == 'EXTEND'){
                        $('#fgroup-reason').show();
                        $('#fgroup-date').show();
                        $('#fgroup-review').show();  
                        $('#modal-verify_ap-form').find('textarea[name=execution_reason]').attr('readonly', false).val(data.execution_reason);
                        $('#modal-verify_ap-form').find('input[name=revised_date]').attr('readonly', true).val(data.revised_date);
                        $('#fgroup-explain').hide();
                        $('#fgroup-evidence').hide(); 
                    }else if(data.execution_status == 'COMPLETE'){
                        $('#fgroup-explain').show();
                        $('#fgroup-evidence').show(); 
                        $('#modal-verify_ap-form').find('textarea[name=execution_explain]').attr('readonly', false).val(data.execution_explain);
                        $('#modal-verify_ap-form').find('textarea[name=execution_evidence]').attr('readonly', false).val(data.execution_evidence);
                        $('#fgroup-review').hide();
                        $('#fgroup-reason').hide();
                        $('#fgroup-date').hide();  
                    }
                }
                 
                $('#modal_ap_verify').modal('show');
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
        
        ChangeLevelRiskDataNo: function(data) {  
            var form1 = $('#input-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                var param = $('#input-form').serializeArray();
                
                var url = site_url+'/main/mainrac/actionExecVerifyPrior';
                
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
                                 if($('#exec-select-status').val() == "COMPLETE"){
                                     location.href=site_url+'/main/mainrac/actionPlanExecFormPriorShow/'+g_risk_id+'/'+7;
                                 }else{      
                                    if(g_review_status != 1){
                                        location.href=site_url+'/main/mainrac/actionPlanExecFormPriorShow/'+g_risk_id+'/'+g_action_plan_status;
                                    }else{
                                        location.href=site_url+'/main/mainrac/actionPlanExecFormPriorShow/'+g_risk_id+'/'+7;
                                    }
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