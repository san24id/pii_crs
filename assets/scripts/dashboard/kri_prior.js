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
            "url": site_url+"/main/mainrac/getKriPrior" // ajax source
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
                if(stat == 0){
                        return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriDesignationPrior/'+full.id+'">'+data+'</a>';
                }else{
                    if (ret == '' || ret == null) {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriPrior/'+full.id+'">'+data+'</a>';
                        }
                            
                    } else {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriPrior/'+full.id+'">'+data+'</a>';
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
            "url": site_url+"/main/mainrac/getKriPrior_non" // ajax source
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
                if(stat == 0){
                        return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriDesignationPrior/'+full.id+'">'+data+'</a>';
                }else{
                    if (ret == '' || ret == null) {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriPrior/'+full.id+'">'+data+'</a>';
                        }
                            
                    } else {
                        if(full.kri_status == 0){
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
                        }else{
                            return '<a target="_self" href="'+site_url+'/main/mainrac/viewKriPrior/'+full.id+'">'+data+'</a>';
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
                 }else if(risk_kri == "risk_code"){
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
                 }else if(risk_kri == "risk_code"){
                    $('#choose_l_divisi-kri').hide();
                    $('#tab_kri-filterValue').show();
                    $('#tab_kri-filterValue').val('');
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


        	// TAB CONTROL FOR BREADCRUMB
        	$('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
        		var hrefa = $(this).attr('href');
        		var ulid = hrefa.replace('#', '');
        		var title = $(this).html().trim();
        		$('#bread_tab_title').html(title);
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