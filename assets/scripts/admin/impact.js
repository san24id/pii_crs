var id_im = $('#id_im').val();
var id_l = $('#id_l').val();

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
            "url": site_url+"/admin/manage/impactGetData" // ajax source
        },
         "columnDefs": [{
           "targets": 12,
            "data": "impact_id",
            "render": function ( data, type, full, meta ) {
                var img = '';
                var imge = '<div class="btn-group">'+
                            '<a href="'+site_url+'/admin/manage/impact_risk/'+full.impact_id+'"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-list font-green">check Risk List </i></button></a>'+

                          '</div><br/>'+'<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil-square-o font-blue"> Edit </i></button>'+

                           '</div>';
                if(full.status_impact == 0){
                    img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Hide </i></button>'+

                        '</div>';
                }else if(full.status_impact == 1){
                     img = '<div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs button-grid-show"><i class="fa fa-check-circle font-blue"> Show </i></button>'+
                        '</div>';
                }
                return '<center>'+imge+'</center>'+'<br/><center>'+img+'</center>';
            }
        }],
        "columns": [
           { "data": "GenRowNum" },
           { "data": "impact_category" },
           { "data": "lvl_1" },
           { "data": "lvl_1_desc" },
           { "data": "lvl_2" },
           { "data": "lvl_2_desc" },
           { "data": "lvl_3" },
           { "data": "lvl_3_desc" },
           { "data": "lvl_4" },
           { "data": "lvl_4_desc" },
           { "data": "lvl_5" },
           { "data": "lvl_5_desc" },
           { "data": "impact_id" }
       ],
        "order": [
            [0, "desc"]
        ]// set first column as a default sort by asc
    }
});

var gridlikelihood = new Datatable();
gridlikelihood.init({
    src: $("#datatable_ajax_like"),
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
            "url": site_url+"/admin/manage/likelihoodGetData" // ajax source
        },
          "columnDefs": [{
           "targets": 3,
            "data": "l_id",
            "render": function ( data, type, full, meta ) {
               return '<div class="btn-group">'+
                            '<a href="'+site_url+'/admin/manage/likelihood_risk/'+data+'"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-list font-green">check Risk List </i></button></a>'+

                      '<div class="btn-group">'+
                        '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
                      '</div>';
                    }
                }],
        "columns": [
           { "data": "GenRowNum" },
           { "data": "l_title" },
           { "data": "l_desc" },
           { "data": "l_id"}
       ],
        "order": [
            [0, "desc"]
        ]// set first column as a default sort by asc
    }
});

var gridRriskLevel = new Datatable();
gridRriskLevel.init({
    src: $("#datatable_ajax_risklevel"),
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
            "url": site_url+"/admin/manage/RiskLevelGetData" // ajax source
        },
        "columns": [
           { "data": "GenRowNum" },
           { "data": "v_impact" },
           { "data": "v_likelihood" },
           { "data": "v_risk_level" },
           { 
            "data": null,
            "orderable": false,
            "defaultContent": '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
              '</div>'
           }
       ],
       "columnDefs": [ {
        /*"targets": 1,
        "data": "title",
        "render": function ( data, type, full, meta ) {
          var ret = '<a target="_self" href="'+site_url+'/admin/news/newsView/'+full.id+'">'+data+'</a>';
          return ret;
        }*/
       } ],
        "order": [
            [1, "desc"]
        ]// set first column as a default sort by asc
    }
});

var gridImpactLevel = new Datatable();
gridImpactLevel.init({
    src: $("#datatable_impactlevel"),
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
        "ajax": {
            "url": site_url+"/admin/manage/ImpactLevelName" // ajax source
        },
        "columns": [
           { "data": "level_name" },
           { 
            "data": null,
            "orderable": false,
            "defaultContent": '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
              '</div>'
           }
       ],
        "order": [
            [0, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskImpact = new Datatable();
gridRiskImpact.init({
    src: $("#library_table"),
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
             "url": site_url+"/admin/manage/getRiskImpact/"+id_im
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

                if(full.risk_evaluation_control == 'addhoc'){
              return '<center>Addhoc<br /><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
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
          "targets": 8,
          "data": "risk_id",
          "render": function ( data, type, full, meta ) {
               return '<a target="_self" href="'+site_url+'/admin/manage/riskRegisterForImpact/'+full.risk_id+'/'+id_im+'"><div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o font-blue"> Edit </i></button>'+

                        '</div></a>';
            
            }
        } ],
        "columns": [
      { "data": "risk_status","orderable":true},
      { "data": "risk_code" },
      { "data": "risk_event" },
      { "data": "risk_level_v" },
      { "data": "impact_level_v" },
      { "data": "likelihood_v" },
      { "data": "risk_owner_v" },
      { "data": "type"},
      { "data": "risk_id"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridRiskLikelihood = new Datatable();
gridRiskLikelihood.init({
    src: $("#likelihood_risk"),
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
             "url": site_url+"/admin/manage/getRiskLikelihood/"+id_l
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

                if(full.risk_evaluation_control == 'addhoc'){
              return '<center>Addhoc<br /><img src="'+base_url+'assets/images/legend/'+img+'"/></center>';
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
          "targets": 8,
          "data": "risk_id",
          "render": function ( data, type, full, meta ) {
               return '<a target="_self" href="'+site_url+'/admin/manage/riskRegisterForlikelihood/'+full.risk_id+'/'+id_l+'"><div class="btn-group">'+
                            '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o font-blue"> Edit </i></button>'+

                        '</div></a>';
            
            }
        } ],
        "columns": [
      { "data": "risk_status","orderable":true},
      { "data": "risk_code" },
      { "data": "risk_event" },
      { "data": "risk_level_v" },
      { "data": "impact_level_v" },
      { "data": "likelihood_v" },
      { "data": "risk_owner_v" },
      { "data": "type" },
      { "data": "risk_id"}
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var Impact = function() {
	return {
			dataMode: null,
      riskLevelList: null,
      riskLevelReference: null,
      impactLevelReference: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;

            // TAB SEARCH RISK LIST
            $('#choose_s_level').hide();
            $('#choose_r_level').hide();
            $('#choose_l_hood').hide();
            $('#choose_impact_l').hide();
            $('#choose_l_divisi').hide();
            $('#tab_risk_list-filterValue').hide();
            $('#s_risklist').hide();


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
                    $('#s_risklist').hide();
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
                    $('#s_risklist').show();
                }else if(risk_list == "risk_event"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').show();
                }else if(risk_list == "risk_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_impact_level"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_likelihood_key"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                }else if(risk_list == "risk_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').show();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_impact_level_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').show();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_likelihood_key_after_mitigation"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').show();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_owner"){
                    $('#choose_s_level').hide();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').show();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
                } else if(risk_list == "risk_status"){
                    $('#choose_s_level').show();
                    $('#choose_r_level').hide();
                    $('#choose_l_hood').hide();
                    $('#choose_impact_l').hide();
                    $('#choose_l_divisi').hide();
                    $('#tab_risk_list-filterValue').hide();
                    $('#tab_risk_list-filterValue').val('');
                    $('#s_risklist').hide();
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


            $('#choose_r_level-prior').hide();
            $('#choose_l_hood-prior').hide();
            $('#choose_impact_l-prior').hide();
            $('#choose_l_divisi-prior').hide();
            $('#tab_old_risk_list-filterValue').hide();
            $('#choose_s_level-prior').hide();
            $('#s_risklist_prior').hide();

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
                    $('#s_risklist_prior').hide();
                    $('#rlP_1').val('');
                    $('#rlP_2').val('');
                }else if(risk_list_prior == "risk_code"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').show();
                }else if(risk_list_prior == "risk_event"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').show();
                }else if(risk_list_prior == "risk_level"){
                    $('#choose_r_level-prior').show();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                } else if(risk_list_prior == "risk_impact_level"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').show();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                } else if(risk_list_prior == "risk_likelihood_key"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').show();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                }else if(risk_list_prior == "risk_level_after_mitigation"){
                    $('#choose_r_level-prior').show();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                } else if(risk_list_prior == "risk_impact_level_after_mitigation"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').show();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                } else if(risk_list_prior == "risk_likelihood_key_after_mitigation"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').show();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                } else if(risk_list_prior == "risk_owner"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').show();
                    $('#choose_s_level-prior').hide();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
                }else if(risk_list_prior == "risk_status"){
                    $('#choose_r_level-prior').hide();
                    $('#choose_l_hood-prior').hide();
                    $('#choose_impact_l-prior').hide();
                    $('#choose_l_divisi-prior').hide();
                    $('#choose_s_level-prior').show();
                    $('#tab_old_risk_list-filterValue').hide();
                    $('#tab_old_risk_list-filterValue').val('');
                    $('#s_risklist_prior').hide();
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
           
	         // datatables filter button
        	$('#filterFormSubmit').on('click', function() {
				
        		me.filterDataGrid();
        	});

            $("#filterForm").submit(function (e) {
                e.preventDefault();
                me.filterDataGrid();
            });

	            // datatables edit delete handler
	            $("#datatable_ajax").on('click', 'button.button-grid-edit', function(e) {
	            	e.preventDefault();
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	 me.showeditform_impact(data);
	            });


              $("#datatable_ajax_like").on('click', 'button.button-grid-edit', function(e) {
                e.preventDefault();
                var r = this.parentNode.parentNode.parentNode;
                var data = gridlikelihood.getDataTable().row(r).data();
                
                 me.showeditform_likelihood(data);
              });

              $("#datatable_impactlevel").on('click', 'button.button-grid-edit', function(e) {
                e.preventDefault();
                var r = this.parentNode.parentNode.parentNode;
                var data = gridImpactLevel.getDataTable().row(r).data();
                
                 me.showedform_editname_level(data);
              });

            $("#library_table").on('click', 'button.button-grid-edit', function(e) {
                e.preventDefault();
                
                 me.showImpactList();
            });

	          $('#show_modal_impact_insert').click(function(e) {
                      
                        e.preventDefault();
                        $('#modal_impact_insert').modal('show');
                     
                });


	          	$('#impact_button_insert').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/admin/manage/insert_impact';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Insert';
                         
                        $.post(
                            url,
                            $( "#impact_insert" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    grid.getDataTable().ajax.reload();
                                    
                                    $('#modal_impact_insert').modal('hide');
                                    
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

	            $('#impact_button_edit').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                            var url = site_url+'/admin/manage/update_impact';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#impact_edit" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    grid.getDataTable().ajax.reload();
                                    
                                    $('#modal_impact_edit').modal('hide');
                                    
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
	            
	            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	me.deleteData(data);
	            });

            $("#datatable_ajax").on('click', 'button.button-grid-show', function(e) {
                e.preventDefault();
                
                var r = this.parentNode.parentNode.parentNode;
                var data = grid.getDataTable().row(r).data();
                
                me.showData(data);
              });

             $('#likelihood_button_edit').click(function(e) {
                      
                        e.preventDefault();
                        var l = Ladda.create(this);
                        l.start();
                        
                         
                            var url = site_url+'/admin/manage/update_likelihood';
                           //var url = site_url+'/library/listriskap_update';
                            var tx = 'Update';
                         
                        $.post(
                            url,
                            $( "#likelihood_edit" ).serialize(),
                            function( data ) {
                                l.stop();
                                if(data.success) {
                                    gridlikelihood.getDataTable().ajax.reload();
                                    
                                    $('#modal_likelihood_edit').modal('hide');
                                    
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

              $('#show_modal_name_level').click(function(e) {
                      
                        e.preventDefault();
                        $('#modal_level_name_edit').modal('show');
                     
                });

                $('#name_level_button_edit').click(function(e) {
                          var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to edit name level ?');
                          mod.find('button.btn-danger').one('click', function(){
                          e.preventDefault();
                          var l = Ladda.create(this);
                          l.start();
                        
                         
                            var url = site_url+'/admin/manage/namelevel_edit';
                            var tx = 'Update';
                             mod.modal('hide'); 
                             Metronic.blockUI({ boxed: true });
                          $.post(
                            url,
                            $( "#namelevel_edit" ).serialize(),
                            function( data ) {
                              Metronic.unblockUI();
                                l.stop();
                                 Metronic.unblockUI();
                                if(data.success) {
                                    gridImpactLevel.getDataTable().ajax.reload();
                                    grid.getDataTable().ajax.reload();
                                    $('#modal_level_edit').modal('hide');
                                    
                                    MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                                } else {
                                    MainApp.viewGlobalModal('error', data.msg);
                                }
                                
                            },
                            "json"
                        ).fail(function() {
                          Metronic.unblockUI();
                            l.stop();
                            MainApp.viewGlobalModal('error', 'Error Submitting Data');
                         });
                      });
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
              MainApp.viewGlobalModal('error', 'Cannot set all Not Available (N/A) on Risk Impact');
            } else {
          
              var xv = me.impactLevelReference[max_val];
           
              $('#risk_impact_level_id').val(max_val);
              $('#risk_impact_level_after_mitigation').val(xv);
              
              $('#modal-impact').modal('hide');
              me.setRiskLevel(); 
            }
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
                    $('#tab_risk_list-filterValue').val('');
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
                    $('#tab_old_risk_list-filterValue').val('');
                }

                me.filterDataGridOldRiskList();
            });

            $("#form_tab_old_risk_list").submit(function (e) {
                e.preventDefault();
                me.filterDataGridOldRiskList();
            });


            me.loadRiskLevelList();
            me.loadRiskLevelReference();
            me.loadImpactLevelReference();

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

	        filterDataGrid: function(fby, fval) {
	        	var fby = $('#form-control input-medium input-sm').val();
        		var fval = $('#filterFormValue').val();

	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },


          showeditform_impact: function(data) {

            	$('#impact_edit').find('input[name=impact_id]').attr('readonly', true).val(data.impact_id);
                $('#impact_edit').find('textarea[name=impact_category]').attr('readonly', false).val(data.impact_category);
                $('#impact_edit').find('input[name=level_1]').attr('readonly', false).val(data.lvl_1_value);
                $('#impact_edit').find('textarea[name=level_1_desc]').attr('readonly', false).val(data.lvl_1_desc);
                $('#impact_edit').find('input[name=level_2]').attr('readonly', false).val(data.lvl_2_value);
                $('#impact_edit').find('textarea[name=level_2_desc]').attr('readonly', false).val(data.lvl_2_desc);
                $('#impact_edit').find('input[name=level_3]').attr('readonly', false).val(data.lvl_3_value);
                $('#impact_edit').find('textarea[name=level_3_desc]').attr('readonly', false).val(data.lvl_3_desc);
                $('#impact_edit').find('input[name=level_4]').attr('readonly', false).val(data.lvl_4_value);
                $('#impact_edit').find('textarea[name=level_4_desc]').attr('readonly', false).val(data.lvl_4_desc);
                $('#impact_edit').find('input[name=level_5]').attr('readonly', false).val(data.lvl_5_value);
                $('#impact_edit').find('textarea[name=level_5_desc]').attr('readonly', false).val(data.lvl_5_desc);
  
                $('#modal_impact_edit').modal('show');
                this.dataMode = 'view';
            },

	        deleteData: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to hidden this data ?');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		
	        		Metronic.blockUI({ boxed: true });
	        		var url = site_url+'/admin/manage/hide_impact/'+data.impact_id;
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
	        },

          showData: function(data) {
            var mod = MainApp.viewGlobalModal('warning', 'Are You sure you want to show this data ?');
            mod.find('button.btn-danger').one('click', function(){
              mod.modal('hide');
              
              Metronic.blockUI({ boxed: true });
              var url = site_url+'/admin/manage/show_impact/'+data.impact_id;
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
          },

            showeditform_likelihood: function(data) {

                $('#likelihood_edit').find('input[name=l_id]').attr('readonly', true).val(data.l_id);
                $('#likelihood_edit').find('input[name=l_key]').attr('readonly', true).val(data.l_key);
                $('#likelihood_edit').find('input[name=l_title]').attr('readonly', false).val(data.l_title);
                $('#likelihood_edit').find('textarea[name=l_desc]').attr('readonly', false).val(data.l_desc);
  
                $('#modal_likelihood_edit').modal('show');
                this.dataMode = 'view';
            },

            showedform_editname_level: function(data) {
                $('#namelevel_edit').find('input[name=level_id]').attr('readonly', true).val(data.level);
                $('#namelevel_edit').find('input[name=name_level]').attr('readonly', true).val(data.name_level);
                $('#namelevel_edit').find('input[name=level_name]').attr('readonly', false).val(data.level_name);
  
  
                $('#modal_level_edit').modal('show');
                this.dataMode = 'view';
            },
            
            showImpactList: function() {
            $('#modal-impact').on('shown.bs.modal', function () {
                $('#modal-impact.modal .modal-body').css('max-height', 400);
                $('#modal-impact.modal .modal-body').css('overflow', 'none');
                $('#modal-impact.modal .modal-body').css('overflow-y', 'auto');
            });
            
            $('#modal-impact').modal('show');
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

        filterDataGridRiskList: function() {
          var fby = $('#tab_risk_list-filterBy').val();
          var fval = $('#tab_risk_list-filterValue').val();
          var frl1 = $('#rl_1').val();
          var frl2 = $('#rl_2').val();
          
          gridRiskImpact.clearAjaxParams();
          gridRiskImpact.setAjaxParam("filter_by", fby);
          gridRiskImpact.setAjaxParam("filter_value", fval);
          gridRiskImpact.setAjaxParam("filter_rl_1", frl1);
          gridRiskImpact.setAjaxParam("filter_rl_2", frl2);
          gridRiskImpact.getDataTable().ajax.reload();
        },

        
        filterDataGridOldRiskList: function() { 
            var fby = $('#tab_old_risk_list-filterBy').val();
            var fval = $('#tab_old_risk_list-filterValue').val();
            var frl1 = $('#rlp_1').val();
            var frl2 = $('#rlp_2').val();
            
            gridRiskLikelihood.clearAjaxParams();
            gridRiskLikelihood.setAjaxParam("filter_by", fby);
            gridRiskLikelihood.setAjaxParam("filter_value", fval);
            gridRiskLikelihood.setAjaxParam("filter_rl_1", frl1);
            gridRiskLikelihood.setAjaxParam("filter_rl_2", frl2);
            gridRiskLikelihood.getDataTable().ajax.reload();
        },
	 }
}();