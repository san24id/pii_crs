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
            "url": site_url+"/main/mainpic/getOwnedKri_prior" // ajax source
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
            "data": "kid",
            "render": function ( data, type, full, meta ) {
                var stat = full.status_periode;
                var ret = full.kri_pic_v;
                var dat = '';
                if(stat == 0){
                    return '<a target="_self" href="'+site_url+'/main/mainpic/viewKriPrior/'+full.id+'">'+data+'</a>';
                }else{
                    if (ret == '' || ret == null) {
                        return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
                    } else {
                        return '<a target="_self" href="'+site_url+'/main/mainpic/viewOwnedKriPrior/'+full.id+'">'+data+'</a>';
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
                if(stat == 0){
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
                if(stat == 0){
                    return '';
                }else{
                    if (data == 3) {
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
            { "data": "kid" },
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


            // TAB CONTROL FOR BREADCRUMB
            $('ul.nav-tabs a[data-toggle=tab]').on('click', function() {
                var hrefa = $(this).attr('href');
                var ulid = hrefa.replace('#', '');
                var title = $(this).html().trim();
                $('#bread_tab_title').html(title);
            });
            
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

             var cnto1 = cnto2 = cnto3 = 0; 
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/0", function( data ) {
                $.each( data, function( key, val ) {
                    // GET INIT SUB CATEGORY
                    if (cnto1 == 0) {
                        $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val.ref_key, function( data1 ) {
                            $.each( data1, function( key2, val2 ) {
                                if (cnto2 == 0) {
                                    // GET INIT 2ND SUB CATEGORY
                                    $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+val2.ref_key, function( data2 ) {
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
            $.getJSON( site_url+"/risk/RiskRegister/getCategory/"+parent, function( data ) {
                $.each( data, function( key, val ) {
                    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
                });
                $('#'+sel_id).trigger('change');
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
    };  
}();

