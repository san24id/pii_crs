var handleValidation = function() {
    // for more info visit the official plugin documentation: 
    // http://docs.jquery.com/Plugins/Validation
    
    var form1 = $('#kri-form');
    //var error1 = $('.alert-danger', form1);
    //var success1 = $('.alert-success', form1);
    
    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        ignore: "",  // validate all fields including form hidden input
        rules: {

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
            MainApp.viewGlobalModal('error', 'Please Fill All Mandatory Field');
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

var gridLibrary = new Datatable();
gridLibrary.init({
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
        "pageLength": 10, // default record count per page
        "lengthMenu": [[10], [10]],
        "ajax": {
            "url": site_url+"/risk/Kri/getRiskKri" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: Kri.selectLibrary('+full.risk_id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "risk_code", "orderable": false },
            { "data": "risk_code", "orderable": true },
            { "data": "risk_event" },
            { "data": "risk_description" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridKri = new Datatable();
gridKri.init({
    src: $("#kri_library_table"),
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
            "url": site_url+"/risk/Kri/getKriLibrary" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "risk_code",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: Kri.selectKriLibrary('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        } ],
        "columns": [
            { "data": "kri_code", "orderable": false },
            { "data": "kri_code", "orderable": false },
            { "data": "key_risk_indicator", "orderable": false },
            { "data": "mitigation"}
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});

var Kri = function() {
    return {
        dataMode: null,
        //main function to initiate the module
        dataActionPlan: {},
        dataActionPlanCounter: 0,
        dataTreshold: {},
        dataTresholdCounter: 0,
        operatorRef: {
            'EQUAL': 'Equal to',
            'BELOW': 'Below',
            'BETWEEN': 'Between',
            'ABOVE': 'Above',
        },
        levelRef: {
            'GREEN': 'Green',
            'YELLOW': 'Yellow',
            'RED': 'Red'
        },
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
            
            $('#modal-library-filter-submit').on('click', function() {
                me.filterLibrary();
            });
            
            $('#modal-kri-filter-submit').on('click', function() {
                me.filterLibraryKri();
            });

            $('#select-treshold-type2').hide();
            $('#button-kri-open-treshold2').hide();
            $('#select-treshold-type').hide();
            $('#treshold_description').hide();

            $('#select-treshold-type-1').on('change', function() {
                 if($('#select-treshold-type-1').val() == 'SELECTION'){
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').hide();
                                $('#button-kri-open-treshold2').hide();
                        
                                $('#select-treshold-type').show();
                                $('#button-kri-open-treshold').show();
                                $('#select-treshold-type').val('SELECTION');
                                $('#select-treshold-type2').val('SELECTION');
                                $('#treshold_description').show();
                                $('#tselect').show();
                                $('#tvalue').hide();
                   
                }else if($('#select-treshold-type-1').val() == 'VALUE'){
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').show();
                                $('#button-kri-open-treshold2').show();

                                $('#select-treshold-type').hide();
                                $('#button-kri-open-treshold').hide();
                                $('#select-treshold-type').val('VALUE');
                                $('#select-treshold-type2').val('VALUE');
                                $('#treshold_description').show();
                                $('#tselect').hide();
                                $('#tvalue').show();
                }

            });

            $('#select-treshold-type').on('change', function() {
                if($('#select-treshold-type').val() == ''){ 
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                            mod.modal('hide');
                            me.tresholdReset();
                            $('#treshold_description').hide();
                                $('#select-treshold-type-1').show();
                                $('#select-treshold-type2').hide();
                                $('#button-kri-open-treshold2').hide();

                                $('#select-treshold-type').hide();
                                $('#select-treshold-type-1').val('');
                        });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                $('#select-treshold-type').val('SELECTION');
                                $('#treshold_description').show();
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                            });
                    } else {
                        me.tresholdReset();
                        $('#treshold_description').hide();
                    }
                }else if($('#select-treshold-type').val() == 'SELECTION'){
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                                mod.modal('hide');
                                me.tresholdReset();
                                $('#treshold_description').show();
                                $('#select-treshold-type-1').hide();
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                             });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                    $('#select-treshold-type').val('VALUE');
                                    $('#treshold_description').show();
                                    $('#tselect').hide();
                                    $('#tvalue').show(); 
                             });
                    } else {
                        me.tresholdReset();
                        $('#treshold_description').show();
                        $('#tselect').show();
                        $('#tvalue').hide(); 
                    }
                }else if($('#select-treshold-type').val() == 'VALUE'){
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                                mod.modal('hide');
                                me.tresholdReset();
                                $('#treshold_description').show();
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').show();
                                $('#button-kri-open-treshold2').show();

                                $('#select-treshold-type').hide();
                                $('#button-kri-open-treshold').hide();
                                $('#select-treshold-type2').val('VALUE');
                                $('#tselect').hide();
                                $('#tvalue').show(); 
                             });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                $('#select-treshold-type').val('SELECTION');
                                $('#treshold_description').show();
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                             });
                    } else {
                        me.tresholdReset();
                         $('#treshold_description').show(); 
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').show();
                                $('#button-kri-open-treshold2').show();

                                $('#select-treshold-type').hide();
                                $('#button-kri-open-treshold').hide();
                                $('#select-treshold-type2').val('VALUE');
                                $('#tselect').hide();
                                $('#tvalue').show(); 
                    }
                }

            });

            $('#select-treshold-type2').on('change', function() {
                if($('#select-treshold-type2').val() == ''){ 
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                            mod.modal('hide');
                            me.tresholdReset();
                            $('#treshold_description').hide();
                                $('#select-treshold-type-1').show();
                                $('#select-treshold-type2').hide();
                                $('#button-kri-open-treshold2').hide();
                        
                                $('#select-treshold-type').hide();
                                $('#select-treshold-type-1').val('');
                        });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                $('#select-treshold-type2').val('VALUE');
                                $('#treshold_description').show();
                                $('#tselect').hide();
                                $('#tvalue').show(); 
                            });
                    } else {
                        me.tresholdReset();
                        $('#treshold_description').hide();
                    }
                }else if($('#select-treshold-type2').val() == 'SELECTION'){
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                                mod.modal('hide');
                                me.tresholdReset();
                                $('#treshold_description').show();
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').hide();
                                $('#button-kri-open-treshold2').hide();
                        
                                $('#select-treshold-type').show();
                                $('#button-kri-open-treshold').show();
                                $('#select-treshold-type').val('SELECTION');
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                             });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                    $('#select-treshold-type2').val('VALUE');
                                    $('#treshold_description').show();
                                    $('#tselect').hide();
                                    $('#tvalue').show(); 
                             });
                    } else {
                        me.tresholdReset();
                         $('#treshold_description').show();
                                $('#select-treshold-type-1').hide();
                                $('#select-treshold-type2').hide();
                                $('#button-kri-open-treshold2').hide();
                        
                                $('#select-treshold-type').show();
                                $('#button-kri-open-treshold').show();
                                $('#select-treshold-type').val('SELECTION');
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                    }
                }else if($('#select-treshold-type2').val() == 'VALUE'){
                    if (me.dataTresholdCounter > 0) {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                            mod.find('button.btn-primary').one('click', function(){
                                mod.modal('hide');
                                me.tresholdReset();
                                $('#treshold_description').show();
                                $('#select-treshold-type-1').hide();
                                $('#tselect').hide();
                                $('#tvalue').show(); 
                             });
                            mod.find('button.btn-default').one('click', function(){
                                mod.modal('hide');
                                $('#select-treshold-type2').val('SELECTION');
                                $('#treshold_description').show();
                                $('#tselect').show();
                                $('#tvalue').hide(); 
                             });
                    } else {
                        me.tresholdReset();
                         $('#treshold_description').show();
                         $('#tselect').hide();
                         $('#tvalue').show(); 
                    }
                }

            });

            /*$('#treshold_description').hide();
             $('#select-treshold-type').on('change', function() {
                if($('#select-treshold-type').val() == ''){ 
                    if (me.dataTresholdCounter > 0) {
                       me.tresholdReset();
                        $('#treshold_description').hide();
                    } else {
                        me.tresholdReset();
                        $('#treshold_description').hide();
                    }
                }else{
                    if (me.dataTresholdCounter > 0) {
                       me.tresholdReset();
                        $('#treshold_description').show();
                    } else {
                        me.tresholdReset();
                         $('#treshold_description').show(); 
                    }
                }
            });*/


            $('.man2').hide();
            $('#mandatory').val('Y');
            $('#cek-mitigation').change(function() {

                   if(this.checked) {
                        $('#mandatory').val('Y');
                        $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', true);
                        $('#kri-form').find('select[name=treshold_type]').prop('required', true);
                        $('#kri-form').find('input[name=timing_pelaporan]').prop('required', true);
                        $('#kri-form').find('select[name=kri_owner]').prop('required', true);
                        //$('#kri-form').find('button[id=kri-button-submit]').show();
                        //$('#kri-form').find('button[id=kri-button-submit-modif]').show();
                       
                    }else{
                        $('#mandatory').val('N');
                        $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', false);
                        $('#kri-form').find('select[name=treshold_type]').prop('required', false);
                        $('#kri-form').find('input[name=timing_pelaporan]').prop('required', false);
                        $('#kri-form').find('select[name=kri_owner]').prop('required', false);
                        //$('#kri-form').find('button[id=kri-button-submit]').hide();
                        //$('#kri-form').find('button[id=kri-button-submit-modif]').hide();
                    }
            });

            $('#cek-mitigation2').change(function() {

                   if(this.checked) {
                        $('#mandatory').val('Y');
                        $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', true);
                        $('#kri-form').find('select[name=treshold_type]').prop('required', true);
                        $('#kri-form').find('input[name=timing_pelaporan]').prop('required', true);
                        $('#kri-form').find('select[name=kri_owner]').prop('required', true);
                        //$('#kri-form').find('button[id=kri-button-submit]').show();
                        //$('#kri-form').find('button[id=kri-button-submit-modif]').show();
                       
                    }else{
                        $('#mandatory').val('N');
                        $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', false);
                        $('#kri-form').find('select[name=treshold_type]').prop('required', false);
                        $('#kri-form').find('input[name=timing_pelaporan]').prop('required', false);
                        $('#kri-form').find('select[name=kri_owner]').prop('required', false);
                        //$('#kri-form').find('button[id=kri-button-submit]').hide();
                        //$('#kri-form').find('button[id=kri-button-submit-modif]').hide();
                    }
            });
            
         /*   $('#is_numeric_treshold').on('click', function() {
                $('#t-col-left-treshold').find('input[type=number]').prop('disabled', true);
                $('#t-col-left-treshold').find('select').prop('disabled', true);
                
                if($(this).prop( "checked" )) {
                    $('#t-col-left-treshold').find('input[type=number]').prop('disabled', false);
                    $('#t-col-left-treshold').find('select').prop('disabled', false);
                    
                    //var p = this.parentNode;
                    //console.log($(p).find('input[type=number]'));
                    //console.log($(this).siblings('div').find('input[type=number]'));
                    //$(this).siblings('div').find('input[type=number]').prop('disabled', false);
                } 
            });

            $('#is_percentage_treshold').on('click', function() {
                $('#t-col-right-treshold').find('input[type=number]').prop('disabled', true);
                $('#t-col-right-treshold').find('select').prop('disabled', true);
                
                if($(this).prop( "checked" )) {
                    $('#t-col-right-treshold').find('input[type=number]').prop('disabled', false);
                    $('#t-col-right-treshold').find('select').prop('disabled', false);
                    
                    //var p = this.parentNode;
                    //console.log($(p).find('input[type=number]'));
                    //console.log($(this).siblings('div').find('input[type=number]'));
                    //$(this).siblings('div').find('input[type=number]').prop('disabled', false);
                } 
            });*/

             
            $('#button-kri-open-treshold').on('click', function() {
                var type = $('#select-treshold-type').val();
                if (type == 'SELECTION') {
                    $('#modal-treshold-selection').modal('show');

                    $('#form-control-revid-objective').val("");
                    $('#kri-form-selection textarea[name=value-equal-1]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-1-result] option:selected').val();
                    $('#kri-form-selection textarea[name=value-equal-2]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-2-result] option:selected').val();
                    $('#kri-form-selection textarea[name=value-equal-3]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-3-result] option:selected').val();

                        if($('#value-equal-1-result').val() =='GREEN'){
                            $('#value-equal-2-result').val('YELLOW');
                            $('#value-equal-3-result').val('RED');
                        }


                    $('#tr_idnyaob').val(a); 
                    $('#form-control-revid-objective').val(a);
                    $('#kri-form-selection').val($('#value-equal-1'+a).val());
                    $('#kri-form-selection').val($('#value-equal-1-result'+a).val());
                    $('#kri-form-selection').val($('#value-equal-2'+a).val());
                    $('#kri-form-selection').val($('#value-equal-2-result'+a).val());
                    $('#kri-form-selection').val($('#value-equal-3'+a).val());
                    $('#kri-form-selection').val($('#value-equal-3-result'+a).val());

                    
                    me.initAddTresholdSelection();
                } else if(type == 'VALUE') {
                    $('#modal-treshold-value').modal('show');
                    //me.initAddTresholdValue();

                    if($('#value-below-result').val() =='GREEN'){
                            $('#value-between-result').val('YELLOW');
                            $('#value-above-result').val('RED');
                        }


                        if($('#perc-below-result').val() =='GREEN'){
                            $('#perc-between-result').val('YELLOW');
                            $('#perc-above-result').val('RED');
                        }


                    $('#tr_idvalob').val(a); 
                    $('#form-control-value-objective').val(a);
                    $('#kri-form-value').val($('#value-below-1'+a).val());
                    $('#kri-form-value').val($('#value-below-result'+a).val());
                    $('#kri-form-value').val($('#value-between-1'+a).val());
                    $('#kri-form-value').val($('#value-between-2'+a).val());
                    $('#kri-form-value').val($('#value-between-result'+a).val());
                    $('#kri-form-value').val($('#value-above-1'+a).val());
                    $('#kri-form-value').val($('#value-above-result'+a).val());
                    $('#kri-form-value').val($('#perc-below-1'+a).val());
                    $('#kri-form-value').val($('#perc-below-result'+a).val());
                    $('#kri-form-value').val($('#perc-between-1'+a).val());
                    $('#kri-form-value').val($('#perc-between-2'+a).val());
                    $('#kri-form-value').val($('#perc-between-result'+a).val());
                    $('#kri-form-value').val($('#perc-above-1'+a).val());
                    $('#kri-form-value').val($('#perc-above-result'+a).val());
                }
            });


          $('#button-kri-open-treshold2').on('click', function() {
                var type = $('#select-treshold-type2').val();
                if (type == 'SELECTION') {
                    $('#modal-treshold-selection').modal('show');

                    $('#form-control-revid-objective').val("");
                    $('#kri-form-selection textarea[name=value-equal-1]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-1-result] option:selected').val();
                    $('#kri-form-selection textarea[name=value-equal-2]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-2-result] option:selected').val();
                    $('#kri-form-selection textarea[name=value-equal-3]').attr('readonly', false);
                    $('#kri-form-selection select[name=value-equal-3-result] option:selected').val();

                        if($('#value-equal-1-result').val() =='GREEN'){
                            $('#value-equal-2-result').val('YELLOW');
                            $('#value-equal-3-result').val('RED');
                        }


                    $('#tr_idnyaob').val(a); 
                    $('#form-control-revid-objective').val(a);
                    $('#kri-form-selection').val($('#value-equal-1'+a).val());
                    $('#kri-form-selection').val($('#value-equal-1-result'+a).val());
                    $('#kri-form-selection').val($('#value-equal-2'+a).val());
                    $('#kri-form-selection').val($('#value-equal-2-result'+a).val());
                    $('#kri-form-selection').val($('#value-equal-3'+a).val());
                    $('#kri-form-selection').val($('#value-equal-3-result'+a).val());

                    
                    me.initAddTresholdSelection();
                } else if(type == 'VALUE') {
                    $('#modal-treshold-value').modal('show');
                    //me.initAddTresholdValue();

                    if($('#value-below-result').val() =='GREEN'){
                            $('#value-between-result').val('YELLOW');
                            $('#value-above-result').val('RED');
                        }
                    if($('#perc-below-result').val() =='GREEN'){
                            $('#perc-between-result').val('YELLOW');
                            $('#perc-above-result').val('RED');
                        }

                    $('#tr_idvalob').val(a); 
                    $('#form-control-value-objective').val(a);
                    $('#kri-form-value').val($('#value-below-1'+a).val());
                    $('#kri-form-value').val($('#value-below-result'+a).val());
                    $('#kri-form-value').val($('#value-between-1'+a).val());
                    $('#kri-form-value').val($('#value-between-2'+a).val());
                    $('#kri-form-value').val($('#value-between-result'+a).val());
                    $('#kri-form-value').val($('#value-above-1'+a).val());
                    $('#kri-form-value').val($('#value-above-result'+a).val());
                    $('#kri-form-value').val($('#perc-below-1'+a).val());
                    $('#kri-form-value').val($('#perc-below-result'+a).val());
                    $('#kri-form-value').val($('#perc-between-1'+a).val());
                    $('#kri-form-value').val($('#perc-between-2'+a).val());
                    $('#kri-form-value').val($('#perc-between-result'+a).val());
                    $('#kri-form-value').val($('#perc-above-1'+a).val());
                    $('#kri-form-value').val($('#perc-above-result'+a).val());
                }
            });


            
            $('#button-treshold-selection-add').on('click', function() {
            if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-2-result').val() == 'GREEN' && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-2-result').val() == 'YELLOW' && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-2-result').val() == 'RED' && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'GREEN' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'YELLOW' && $('#value-equal-2-result').val() == 'RED'  && $('#value-equal-3-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'GREEN'  && $('#value-equal-3-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-equal-1-result').val() == 'RED' && $('#value-equal-2-result').val() == 'YELLOW'  && $('#value-equal-3-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else{
                me.tresholdReset();

                if($('#value-equal-1').val() == '' && $('#value-equal-2').val() == '' && $('#value-equal-3').val() == ''){
                    var iter = [
                                
                            ];
                }else if($('#value-equal-1').val() == '' && $('#value-equal-2').val() == '' ){
                    var iter = [
                                'value-equal-3'
                            ];
                }else if($('#value-equal-1').val() == '' && $('#value-equal-3').val() == '' ){
                    var iter = [
                                'value-equal-2'
                            ];
                }else if($('#value-equal-2').val() == '' && $('#value-equal-3').val() == '' ){
                    var iter = [
                                'value-equal-1'
                            ];
                }else if($('#value-equal-1').val() == ''){
                    var iter = [
                                'value-equal-2', 'value-equal-3'
                            ];
                }else if($('#value-equal-2').val() == ''){
                    var iter = [
                                'value-equal-1', 'value-equal-3'
                            ];
                }else if($('#value-equal-3').val() == ''){
                    var iter = [
                                'value-equal-1', 'value-equal-2'
                            ];
                }else{
                     var iter = [
                                'value-equal-1', 'value-equal-2', 'value-equal-3' 
                            ];
                }

                var form1 = $('#kri-form-selection').validate();
                var fvalid = form1.form();
                
                if (fvalid) {
                    //var tr_idnya2 = $('#tr_idnya2').val();
                $.each(iter, function(idx, val) {  
                var tr_idob = $('#form-control-revid-objective').val();
                var val1 = $('#kri-form-selection').find('textarea[name='+val+']').val();
                var result = $('#kri-form-selection').find('select[name='+val+'-result]').val();
                var result_v = $('#kri-form-selection').find('select[name='+val+'-result] option:selected').text();
                    
                   var nnode = {
                    'tr_idob' : tr_idob,
                    'operator_v': 'Equal to',
                    'operator': 'EQUAL',
                    'value_1': val1,
                    'value_2': '-',
                    'value_type': '-',
                    'result_v': result_v,
                    'result': result
                };
                
                //console.log(nnode);
                me.tresholdAddRow(nnode);
                })
                
                $('#modal-treshold-selection').modal('hide');
                 }
            }
            });
            
            $('#button-treshold-value-add').on('click', function() {
            if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-between-result').val() == 'GREEN' && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-between-result').val() == 'YELLOW' && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-between-result').val() == 'RED' && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'GREEN' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'YELLOW' && $('#value-between-result').val() == 'RED'  && $('#value-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'GREEN'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#value-below-result').val() == 'RED' && $('#value-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }
            else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-between-result').val() == 'GREEN' && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-between-result').val() == 'YELLOW' && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-between-result').val() == 'RED' && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'YELLOW'  && $('#value-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'GREEN' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'YELLOW' && $('#perc-between-result').val() == 'RED'  && $('#perc-above-result').val() == 'RED'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'GREEN'  && $('#perc-above-result').val() == 'GREEN'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else if($('#perc-below-result').val() == 'RED' && $('#perc-between-result').val() == 'YELLOW'  && $('#perc-above-result').val() == 'YELLOW'){
                MainApp.viewGlobalModal('error', 'Please Input at the Treshold Result Not Same');
            }else{
                me.tresholdReset();
                
                
                if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [

                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'perc-below'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'perc-above'
                        ];

                //------------------7
                }else if($('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                        'value-below', 'value-between'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'value-above'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'perc-below'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'perc-between'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-below', 'perc-above'
                        ];

                //-------------------------12
                }else if($('#value-below-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'value-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'perc-below'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-between', 'perc-above'
                        ];

                //---------------------16
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-above', 'perc-below'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-above', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-above', 'perc-above'
                        ];

                //---------------------19
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-above-1').val() == ''){
                    var iter = [
                            'perc-below', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'perc-below', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == ''){
                    var iter = [
                            'perc-between', 'perc-below'
                        ];
                 
                //----------------21   
                }else if($('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                        'value-below', 'value-between', 'value-above'
                        ];
                }else if($('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'perc-below'
                        ];
                }else if($('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'perc-between'
                        ];
                }else if($('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'perc-above'
                        ];

                //----------------25
                }else if($('#value-below-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'value-above', 'perc-below'
                        ];
                }else if($('#value-below-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'value-above', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'value-above', 'perc-above'
                        ];

                //----------------28        
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                   $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'perc-below', 'perc-between'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-below', 'perc-below', 'perc-above'
                        ];
                }else if($('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == ''){
                    var iter = [
                            'value-below', 'perc-between', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                   $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'perc-below', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-between', 'perc-below', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-between', 'perc-between', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-above', 'perc-below', 'perc-between'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-above', 'perc-below', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' &&
                    $('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-above', 'perc-between', 'perc-above'
                        ];
                }else if($('#value-below-1').val() == '' && $('#value-between-1').val() == '' && $('#value-between-2').val() == '' && $('#value-above-1').val() == ''){
                    var iter = [
                            'perc-above', 'perc-between', 'perc-below'
                        ];

                //----------------32
                }else if($('#perc-between-1').val() == '' && $('#perc-between-2').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'value-above', 'perc-below'
                        ];
                }else if($('#perc-below-1').val() == '' && $('#perc-above-1').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'value-above', 'perc-between'
                        ];
                }else if($('#perc-below-1').val() == '' && $('#perc-between-1').val() == '' && $('#perc-between-2').val() == ''){
                    var iter = [
                            'value-below', 'value-between', 'value-above', 'perc-above'
                        ];
                }else if($('#perc-above-1').val() == ''){
                    var iter = [
                        'value-below', 'value-between', 'value-above',
                        'perc-below', 'perc-between' 
                        ];
                }else{
                    var iter = [
                        'value-below', 'value-between', 'value-above',
                        'perc-below', 'perc-between', 'perc-above'
                        ];
                }//---------------------37
                
                $.each(iter, function(idx, val) {
                
                    var oper_v = $('#kri-form-value').find('input[name='+val+'-oper_v]').val();;
                    var oper = $('#kri-form-value').find('input[name='+val+'-oper]').val();;
                    var val1 = $('#kri-form-value').find('input[name='+val+'-1]').val();
                    var val2 = $('#kri-form-value').find('input[name='+val+'-2]').val();
                    var vt = $('#kri-form-value').find('input[name='+val+'-value_type]').val();
                    var result = $('#kri-form-value').find('select[name='+val+'-result]').val();
                    var result_v = $('#kri-form-value').find('select[name='+val+'-result] option:selected').text();
                                    
                    var nnode = {
                        'operator_v': oper_v,
                        'operator': oper,
                        'value_1': val1,
                        'value_2': val2,
                        'value_type': vt,
                        'result_v': result_v,
                        'result': result
                    };
                    //console.log(nnode);
                    me.tresholdAddRow(nnode);
                })
                
                
                $('#modal-treshold-value').modal('hide');
            }
            });
            
            $('#kri-button-save').on('click', function() {
                me.saveRiskData();
            });

            $('#kri-button-save-modif').on('click', function() {
                me.saveRiskData_modif();
            });

            $('#kri-button-submit').on('click', function() {
                me.submitRiskData();
            });

            $('#kri-button-submit-modif').on('click', function() {
                me.submitRiskData_modif();
            });
            
            $('#kri-button-cancel').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to cancel your KRI Entry ? You will loose your unsaved data.');
                mod.find('button.btn-primary').one('click', function(){
                   location.href=site_url+'/main/mainrac#tab_kri_list';
                });
            }); 

            $('#kri-button-delete').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to delete your KRI Entry ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.deleteKRI_modif();
                });
            });

            $('#kri-button-save-modif_verify').on('click', function() {
                me.saveRiskData_modif_verify();
            });

            $('#modal-impactlevel-form-submit-no').on('click', function() {
                        var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this KRI ?');
                        mod.find('button.btn-primary').one('click', function(){
                me.submitRiskData_no_verify();
                });              
            });

            $('#modal-impactlevel-form-submit').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Verify this KRI ?');
                mod.find('button.btn-primary').one('click', function(){
                me.submitRiskData_yes_verify();
                });                              
            });

            $('#kri-button-delete-v').on('click', function() {
                var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to Delete KRI with Status Mitigation Not Yet ?');
                mod.find('button.btn-primary').one('click', function(){
                    me.deleteKRI_modif_verify();
                });
            });
            
            handleValidation();         
        },
        initAddTresholdValue: function() {
            $('#kri-form-value')[0].reset();

            $('#is_numeric_treshold').prop('checked', false).parent('span').removeClass('checked');
            $('#is_percentage_treshold').prop('checked', false).parent('span').removeClass('checked');
            $('#t-col-left-treshold').find('input[type=number]').prop('disabled', true);
            $('#t-col-left-treshold').find('select').prop('disabled', true);
            $('#t-col-right-treshold').find('input[type=number]').prop('disabled', true);
            $('#t-col-right-treshold').find('select').prop('disabled', true);
        },
        initAddTresholdSelection: function() {
            $('#kri-form-selection')[0].reset();
        },
        
        tresholdTableDelete: function(xrow, dataId) {
            var i=xrow.parentNode.parentNode.parentNode.rowIndex;
            document.getElementById('treshold_table').deleteRow(i);
            this.tresholdDelete(dataId);
        },
        tresholdReset: function() {
            this.dataTresholdCounter = 0;
            this.dataTreshold = {};
            $("#treshold_table > tbody").html("");
        },
        tresholdAdd: function(data, dcounter) {
            this.dataTreshold[dcounter] = data;
        },
        tresholdDelete: function(id) {
            delete this.dataTreshold[id];
        },
        tresholdAddRow: function(nnode) {
            var me = this;

            me.dataTresholdCounter++;


            var lastidrand = $('#form-control-revid-objective').val();
            
            //alert(lastidrand);
            
           // $('#'+lastidrand).html('');
           // $('#'+lastidrand).remove();

            var tr_id2 = $('#form-control-revid-objective').val();
             
            //$("#tr_z"+tr_id2).html("");
            $("#tr_z"+tr_id2).remove(); 
            
            $('#tr_z'+lastidrand).html('');

            
            var idrand = Math.floor((Math.random() * 1000000) + 1); 

            if(nnode.operator_v == 'Equal to'){
            
            $('#treshold_table > tbody:last-child').append('<tr id = "tr_z'+me.dataTresholdCounter+'">'+
               
                '<td><input type = "hidden" id = "value-equal'+me.dataTresholdCounter+' " value = '+nnode.value_1+'>'+nnode.value_1+'</td>'+

                '<td>'+nnode.result_v+'</td>'+
                
                /*'<td>'+'<div class="btn-group">'+
                    '<button type="button" class="btn btn-default btn-xs" onclick = "modal_control_edit_objective('+me.dataTresholdCounter+')" ><i class="fa fa-pencil font-blue"> Edit </i></button>'+
                    '<button type="button" class="btn btn-default btn-xs" onclick="Kri.tresholdTableDelete(this, '+me.dataTresholdCounter+')"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
                '</div>'+
                '</td>'+*/
            '</tr>');
            }else{
                 $('#treshold_table > tbody:last-child').append('<tr id = "tr_z'+me.dataTresholdCounter+'">'+
                '<td>'+nnode.operator_v+'</td>'+
                '<td><input type = "hidden" id = "value-equal'+me.dataTresholdCounter+' " value = '+nnode.value_1+'>'+nnode.value_1+'</td>'+
                '<td>'+nnode.value_2+'</td>'+
                '<td>'+nnode.value_type+'</td>'+
                '<td>'+nnode.result_v+'</td>'+
            '</tr>');
            }
            
            this.tresholdDelete(nnode.tr_idob); 
            me.tresholdAdd(nnode, me.dataTresholdCounter);
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
            delete this.dataActionPlan[id];
        },
        actionPlanAddRow: function(nnode) {
            var me = this;
            if(nnode.due_date == '00-00-0000'){
                nnode.due_date = 'Continuous';            
            }else{
                nnode.due_date;
            }
            
            me.dataActionPlanCounter++;
            
            $('#action_plan_table > tbody:last-child').append('<tr>'+
                '<td>'+nnode.action_plan+'</td>'+
                '<td>'+nnode.due_date+'</td>'+
                '<td>'+nnode.division_v+'</td>'+
                '</td>'+
            '</tr>');
            
            me.actionPlanAdd(nnode, me.dataActionPlanCounter);
        },
        
        selectLibrary: function(rid) {
            var me = this;
            
            $('#modal-library').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadRiskLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                data_risk['risk_library_id'] = data_risk['risk_id'];
                data_risk['risk_library_code'] = data_risk['risk_code'];
                data_risk['risk_level'] = data_risk['risk_level_v'];
                data_risk['risk_treatment'] = data_risk['treatment_v'];
                
                me.populateRisk($('#input-form'), data_risk);
                $('#kri-risk-id').val(data_risk['risk_id']);
                
                me.actionPlanReset();
                $.each( data_risk['action_plan_list'], function( key, val ) {
                    var nnode = {
                        'action_plan' : val.action_plan,
                        'due_date' : val.due_date_v,
                        'division_v' : val.division_v,
                        'division' : val.division
                    }
                    me.actionPlanAddRow(nnode);
                });
            });
        },
        
        selectKriLibrary: function(rid) {
            var me = this;
            
            $('#modal-kri').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/kri/getKri/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                var fdata_risk = {};

                if(data_risk['mandatory'] == 'Y'){
                    $('.man').show();
                    $('.man2').hide();
                    $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', true);
                    $('#kri-form').find('select[name=treshold_type]').prop('required', true);
                    $('#kri-form').find('input[name=timing_pelaporan]').prop('required', true);
                    $('#kri-form').find('select[name=kri_owner]').prop('required', true);
                }else if(data_risk['mandatory'] == 'N'){
                    $('.man2').show();
                    $('.man').hide();
                    $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', false);
                    $('#kri-form').find('select[name=treshold_type]').prop('required', false);
                    $('#kri-form').find('input[name=timing_pelaporan]').prop('required', false);
                    $('#kri-form').find('select[name=kri_owner]').prop('required', false);
                }

                if(data_risk['treshold_type'] == 'SELECTION'){
                    $('#select-treshold-type-1').hide();
                    $('#select-treshold-type2').hide();
                    $('#button-kri-open-treshold2').hide();
                        
                    $('#select-treshold-type').show();
                    $('#button-kri-open-treshold').show();
                    $('#select-treshold-type').val('SELECTION');
                    $('#treshold_description').show();
                    $('#tselect').show();
                    $('#tvalue').hide(); 
                    
                }else if(data_risk['treshold_type'] == 'VALUE'){
                    $('#select-treshold-type-1').hide();
                    $('#select-treshold-type2').show();
                    $('#button-kri-open-treshold2').show();

                    $('#select-treshold-type').hide();
                    $('#button-kri-open-treshold').hide();
                    $('#select-treshold-type2').val('VALUE');
                    $('#treshold_description').show();
                    $('#tselect').hide();
                    $('#tvalue').show();  
                }
                
                fdata_risk['kri_library_id'] = data_risk['id'];
                fdata_risk['kri_library_code'] = data_risk['kri_code'];
                fdata_risk['key_risk_indicator'] = data_risk['key_risk_indicator'];
                fdata_risk['mandatory'] = data_risk['mandatory'];
                fdata_risk['treshold_type'] = data_risk['treshold_type'];
                fdata_risk['timing_pelaporan'] = data_risk['timing_pelaporan_v'];
                fdata_risk['kri_owner'] = data_risk['kri_owner'];
                
                me.populateRisk($('#kri-form'), fdata_risk);
                
                me.tresholdReset();
                    $('#kri-form-selection').val($('#value-equal-1').val(''));
                    $('#kri-form-selection').val($('#value-equal-1-result').val(''));
                    $('#kri-form-selection').val($('#value-equal-2').val(''));
                    $('#kri-form-selection').val($('#value-equal-2-result').val(''));
                    $('#kri-form-selection').val($('#value-equal-3').val());
                    $('#kri-form-selection').val($('#value-equal-3-result').val(''));

                    $('#kri-form-value').val($('#value-below-1').val(''));
                    $('#kri-form-value').val($('#value-below-result').val(''));
                    $('#kri-form-value').val($('#value-between-1').val(''));
                    $('#kri-form-value').val($('#value-between-2').val(''));
                    $('#kri-form-value').val($('#value-between-result').val(''));
                    $('#kri-form-value').val($('#value-above-1').val(''));
                    $('#kri-form-value').val($('#value-above-result').val(''));
                    $('#kri-form-value').val($('#perc-below-1').val(''));
                    $('#kri-form-value').val($('#perc-below-result').val(''));
                    $('#kri-form-value').val($('#perc-between-1').val(''));
                    $('#kri-form-value').val($('#perc-between-2').val(''));
                    $('#kri-form-value').val($('#perc-between-result').val(''));
                    $('#kri-form-value').val($('#perc-above-1').val(''));
                    $('#kri-form-value').val($('#perc-above-result').val(''));
                $.each( data_risk['treshold_list'], function( key, val ) {

                    if(val.operator == 'BELOW' && val.value_type == 'NUMERIC'){    
                            $('#kri-form-value').val($('#value-below-1').val(val.value_1));
                             $('#value-below-result').val(val.result);
                        }else if(val.operator == 'BETWEEN' && val.value_type == 'NUMERIC'){    
                             $('#kri-form-value').val($('#value-between-1').val(val.value_1));
                             $('#kri-form-value').val($('#value-between-2').val(val.value_2));
                             $('#kri-form-value').val($('#value-between-result').val(val.result));
                        }else if(val.operator == 'ABOVE' && val.value_type == 'NUMERIC'){    
                             $('#kri-form-value').val($('#value-above-1').val(val.value_1));
                             $('#kri-form-value').val($('#value-above-result').val(val.result));
                        }else if(val.operator == 'BELOW' && val.value_type == 'PERCENTAGE'){    
                             $('#kri-form-value').val($('#perc-below-1').val(val.value_1));
                             $('#kri-form-value').val($('#perc-below-result').val(val.result));
                        }else if(val.operator == 'BETWEEN' && val.value_type == 'PERCENTAGE'){    
                             $('#kri-form-value').val($('#perc-between-1').val(val.value_1));
                             $('#kri-form-value').val($('#perc-between-2').val(val.value_2));
                             $('#kri-form-value').val($('#perc-between-result').val(val.result));
                        }else if(val.operator == 'ABOVE' && val.value_type == 'PERCENTAGE'){    
                             $('#kri-form-value').val($('#perc-above-1').val(val.value_1));
                             $('#kri-form-value').val($('#perc-above-result').val(val.result));
                        }else if(val.operator == 'EQUAL' && val.result == 'GREEN'){
                             $('#kri-form-selection').val($('#value-equal-1').val(val.value_1));
                             $('#kri-form-selection').val($('#value-equal-1-result').val(val.result));
                        }else if(val.operator == 'EQUAL' && val.result == 'YELLOW'){
                             $('#kri-form-selection').val($('#value-equal-2').val(val.value_1));
                             $('#kri-form-selection').val($('#value-equal-2-result').val(val.result));
                        }else if(val.operator == 'EQUAL' && val.result == 'RED'){
                             $('#kri-form-selection').val($('#value-equal-3').val(val.value_1));
                             $('#kri-form-selection').val($('#value-equal-3-result').val(val.result));
                        }

                    var nnode = {
                        'operator_v': me.operatorRef[val.operator],
                        'operator': val.operator,
                        'value_1': val.value_1,
                        'value_2': val.value_2,
                        'value_type': val.value_type,
                        'result_v': me.levelRef[val.result],
                        'result': val.result
                    };
                    
                    me.tresholdAddRow(nnode);
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
        filterLibrary: function() {
            var fval = $('#modal-library div.inputs input[name=filter_search]')[0].value;
            gridLibrary.clearAjaxParams();
            gridLibrary.setAjaxParam("filter_library", fval);
            gridLibrary.getDataTable().ajax.reload();   
        },
        filterLibraryKri: function() {
            var fval = $('#modal-kri div.inputs input[name=filter_search]')[0].value;
            gridKri.clearAjaxParams();
            gridKri.setAjaxParam("filter_library", fval);
            gridKri.getDataTable().ajax.reload();   
        },
        saveRiskData: function() {
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/insertKriData_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        },

         saveRiskData_modif: function() {
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/UpdateKriData_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac/viewOwnedKri/'+g_kri_id;
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac/viewOwnedKri/'+g_kri_id;
                            });
                 });
            }
        },

        saveRiskData_modif_verify: function() {
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/UpdateKriData_no_verify';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac/viewKri/'+g_kri_id;
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac/viewKri/'+g_kri_id;
                            });
                 });
            }
        },

        submitRiskData: function() {
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/insertKriData';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        },
        submitRiskData_modif: function() {
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/UpdateKriData_sub';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Inserting your Kri');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                        });
                 });
            }
        },
        deleteKRI_modif: function() {
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;

                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/DeleteKriData_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Deleting KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Deleting KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        },
        deleteKRI_modif_verify: function() {
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;

                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/DeleteKriData_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success Deleting KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success Deleting KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        },
                
        submitRiskData_no_verify: function() { 
               
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/verifyKri_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold) + '&' + $("#modal-category-form_no").serialize(),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        },
        submitRiskData_yes_verify: function() { 
               
            if ($('#risk_library_id').val() == '') {
                MainApp.viewGlobalModal('error', 'Please Select Risk');
                return false;
            }
            
            var form1 = $('#kri-form').validate();
            var fvalid = form1.form();
            if (fvalid) {
                var me = this;
                
                // prepare impact data
                var treshold = {};
                var cnt = 0;
                $.each(me.dataTreshold, function(key, value) { 
                    treshold['treshold_list['+cnt+'][operator]'] = value.operator;
                    treshold['treshold_list['+cnt+'][value_1]'] = value.value_1;
                    treshold['treshold_list['+cnt+'][value_2]'] = value.value_2;
                    treshold['treshold_list['+cnt+'][value_type]'] = value.value_type;
                    treshold['treshold_list['+cnt+'][result]'] = value.result;
                    cnt++;
                });
               if($('#cek-mitigation').checked) {
                if (cnt < 1) {
                    MainApp.viewGlobalModal('error', 'Please Input at the Treshold Configuration');
                    return false;
                  }
                }
                
                                
                Metronic.blockUI({ boxed: true });
                var url = site_url+'/risk/Kri/verifyKri_no';
                $.post(
                    url,
                    $( "#kri-form" ).serialize()+ '&' + $.param(treshold) + '&' + $("#modal-category-form").serialize(),
                    function( data ) {
                        Metronic.unblockUI();
                        if(data.success) {
                            var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                            
                        } else {
                            MainApp.viewGlobalModal('error', data.msg);
                        }
                    },
                    "json"
                ).fail(function() {
                    Metronic.unblockUI();
                    //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var mod = MainApp.viewGlobalModal('success', 'Success saving your KRI');
                            mod.find('button.btn-ok-success').one('click', function(){
                                location.href=site_url+'/main/mainrac#tab_kri_list';
                            });
                 });
            }
        }
    //end
     }
}();

function modal_control_edit_objective(a){
$('#tr_idnyaob').val(a); 
$('#form-control-revid-objective').val(a);
$('#kri-form-selection').val($('#value-equal-1'+a).val());
$('#kri-form-selection').val($('#value-equal-1-result'+a).val());
$('#kri-form-selection').val($('#value-equal-2'+a).val());
$('#kri-form-selection').val($('#value-equal-2-result'+a).val());
$('#kri-form-selection').val($('#value-equal-3'+a).val());
$('#kri-form-selection').val($('#value-equal-3-result'+a).val());


$('#modal-treshold-selection').modal('show'); 
}

