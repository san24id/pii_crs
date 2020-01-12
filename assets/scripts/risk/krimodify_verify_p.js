var KriModify = function() {
    return {
        init: function(mode) {
            var me = this;
           me.loadRisk(g_risk_id);
           me.loadKri(g_kri_id);
            
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
            
            $('#select-treshold-type').on('change', function() {
                if (me.dataTresholdCounter > 0) {
                    var mod = MainApp.viewGlobalModal('confirm', 'Are You sure you want to change the treshold type ? This will delete all previous treshold setting');
                    mod.find('button.btn-primary').one('click', function(){
                        mod.modal('hide');
                        me.tresholdReset();
                    });
                } else {
                    me.tresholdReset();
                }
            });
            
            handleValidation();         
        },
        
        
        loadRisk: function(rid) {
            var me = Kri;
            
            $('#modal-library').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/risk/RiskRegister/loadRiskLibrary/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                //data_risk['risk_library_id'] = data_risk['risk_id'];
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
        
        loadKri: function(rid) {
            var me = Kri;
            
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
                    $('#kri-form').find('textarea[name=validation]').prop('required', true);
                }else if(data_risk['mandatory'] == 'N'){
                    $('.man2').show();
                    $('.man').hide();
                    $('#kri-form').find('textarea[name=key_risk_indicator]').prop('required', false);
                    $('#kri-form').find('select[name=treshold_type]').prop('required', false);
                    $('#kri-form').find('input[name=timing_pelaporan]').prop('required', false);
                    $('#kri-form').find('select[name=kri_owner]').prop('required', false);
                    $('#kri-form').find('textarea[name=validation]').prop('required', false);
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
                fdata_risk['owner_report'] = data_risk['owner_report'];
                fdata_risk['supporting_evidence'] = data_risk['supporting_evidence'];
                fdata_risk['validation'] = data_risk['validation'];
                
                me.populateRisk($('#kri-form'), fdata_risk);
                
                me.tresholdReset();
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
        }
     }
}();

