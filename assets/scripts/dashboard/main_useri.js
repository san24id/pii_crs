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
            "url": site_url+"/maini/getMyRiskRegister" // ajax source
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
                }else if (data == '5' ) {
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
                var vm = 'maini/viewRisk';
                if (full.risk_status == '0' || full.risk_status == '1') {
                    cls = '';
                    vm = 'riski/RiskRegister/modifyRisk';
                }else if(full.risk_status == '2'){
                    cls = '';
                    vm = 'maini/viewRiskChange';
                }
                  return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.risk_id+'">'+data+'</a>';

            }
        }, {
            "targets": 7,
            "data": "risk_status",
            "render": function ( data, type, full, meta ) {
                var tt = '';
                if (data >= 2) {
                    if (g_submit_mode == true){
                    tt = '<div class="btn-group">'+
                            '<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/riski/RiskRegister/ChangeRequestInput/'+full.risk_id+'\'"><i class="fa fa-pencil"> Change Request </i></button>'+
                            //'<button type="button" class="btn blue btn-xs button-grid-edit" onclick="location.href=\''+site_url+'/riski/RiskRegister/ChangeRequestDelete/'+full.risk_id+'\'"><i class="fa fa-trash-o"> Delete </i></button>'+
                        '</div>';
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
            "url": site_url+"/maini/getMyChangeRequest" // ajax source
        },
        "columnDefs": [ {
            "targets": 1,
            "data": "cr_code",
            "render": function ( data, type, full, meta ) {
                var cls = 'font-green-jungle';
                if (full.cr_type == 'Risk Register') {
                    var vm = 'riski/RiskRegister';
                    return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'">'+data+'</a>';
                }else if (full.cr_status == '1') {
                    var vm = 'riski/riskregister/ChangeRequestView';
                } else {
                   var vm = 'riski/riskregister/ChangeRequestView';
                }
                return '<a target="_self" class="'+cls+'" href="'+site_url+'/'+vm+'/'+full.id+'">'+data+'</a>';
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
                }else if (data == '5' ) {
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
                var vm = 'maini/viewRisk';
                if (full.risk_status == '0' || full.risk_status == '1') {
                    cls = '';
                    vm = 'riski/RiskRegister/modifyRisk';
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

var Dashboard = function() {
    return {
        init: function() {
            var me = this;
            
            // FILTER DROPDOWN
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
            
            // FILTER BUTTON
            $('#button-filter-category').on('click', function() {
                var cat = $("#sel_risk_2nd_sub_category").val();
                me.filterMyRisk('risk_2nd_sub_category', cat);
            });
            
            $('#button-filter-clear').on('click', function() {
                me.filterMyRisk('risk_2nd_sub_category', false);
            });
//---------------------------
            $('#sel_old_risk_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_sub_category', val);
            });
            
            $('#sel_old_risk_sub_category').change(function() {
                var val = $(this).val();
                me.loadCategoryOldSelect('sel_old_risk_2nd_sub_category', val);
            });
            
            // FILTER BUTTON
            $('#button-old-filter-category').on('click', function() {
                var cat = $("#sel_old_risk_2nd_sub_category").val();
                me.filterOldMyRisk('risk_old_2nd_sub_category', cat);
            });
            
            $('#button-old-filter-clear').on('click', function() {
                me.filterOldMyRisk('risk_old_2nd_sub_category', false);
            });

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
            
           // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                ulid = 'bread_'+ulid;
                
                $('ul.page-breadcrumb li.bread_tab').hide();
                $('#'+ulid).show();
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
        },
        initUserChart: function() {
            $.getJSON( site_url+"/maini/getSummaryCount", function( data ) {
                var series = data;
                var tick = [ [0, "Tinggi"], [1, "Sedang"], [2, "Rendah"] ];
                
                on_options["yaxis"]["ticks"] = tick;
                
                $.plot("#chart_user", data, on_options);
            });
            
            /*
            var initData = [
                {'dtype': 'Tinggi', 'dvalue': 0, 'color': "#D91E18"},
                {'dtype': 'Sedang', 'dvalue': 0, 'color': "#F3C200"},
                {'dtype': 'Rendah', 'dvalue': 0, 'color': "#1BA39C"},
            ];
            $.getJSON( site_url+"/maini/getSummaryCount", function( data ) {
                $.each(data, function(data2idx, dval) {
                    console.log(dval, dval.data[0][1], dval.data[0][0]);
                    if (dval.data[0][1] == 'Tinggi') {
                        initData[0].dvalue = dval.data[0][0];
                    } else if(dval.data[0][1] == 'Sedang') {
                        initData[1].dvalue = dval.data[0][0];
                    } else if(dval.data[0][1] == 'Rendah') {
                        initData[2].dvalue = dval.data[0][0];
                    }
                });
                
                var chart = AmCharts.makeChart("chart_user", {
                    "theme": "light",
                    "type": "serial",
                    "dataProvider": initData,
                    "graphs": [{
                        "fillAlphas": 2,
                        "colorField": "color",
                        "lineAlpha": 0.2,
                        "title": "Dvalue",
                        "type": "column",
                        "valueField": "dvalue"
                    }],
                    "depth3D": 5,
                    "angle": 30,
                    "rotate": true,
                    "categoryField": "dtype",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "fillAlpha": 0.05,
                        "position": "left"
                    }
                });
            });
            */
            
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
            $('#modal-changereq').modal('show');
        }

        if(tabactive == "2"){   
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