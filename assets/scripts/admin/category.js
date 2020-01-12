var Category = function() {
	return {
		actCategory: false,
		actSubCategory: false,
		actSubSubCategory: false,
		init: function() {
        	var me = this;
        	
        	$('#sel_risk_category').change(function() {
        		var val = $(this).val();
        		me.loadCategorySelect('sel_risk_sub_category', val);
        		me.loadCategoryData(val, 'cat');
        	});
        	
        	$('#sel_risk_sub_category').change(function() {
        		var val = $(this).val();
        		me.loadCategorySelect('sel_risk_2nd_sub_category', val);
        		me.loadCategoryData(val, 'sub');
        	});
        	
        	$('#sel_risk_2nd_sub_category').change(function() {
        		var val = $(this).val();
        		me.loadCategoryData(val, 'sub_sub');
        	});
        	
        	// CATEGORY
        	$('#btn_cat_add').on('click', function() {
				
				var cid = $('#sel_risk_category').val();
        		$('#modal-category').modal('show');
        		$('#modal-category-form')[0].reset();
        		$('#modal-category-form input[name=mode]').val('add');
        		$('#modal-category-form input[name=cat_id]').val('');
				 
				var alfabet = new Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
				   
				var nextalfabet = eval($("#lastcat").val());
				$('#modal-category-form input[name=cat_code]').val(alfabet[nextalfabet]);
				 
        	});
        	
        	$('#btn_cat_edit').on('click', function() {
        		var cid = $('#sel_risk_category').val();
        		$('#modal-category').modal('show');
        		$('#modal-category-form')[0].reset();
        		$('#modal-category-form input[name=mode]').val('edit');
        		$('#modal-category-form input[name=cat_id]').val(me.actCategory.cat_id);
        		$('#modal-category-form input[name=cat_code]').val(me.actCategory.cat_code);
        		$('#modal-category-form input[name=cat_name]').val(me.actCategory.cat_name);
        		$('#modal-category-form textarea[name=cat_desc]').val(me.actCategory.cat_desc);
        	});
        	
        	$('#modal-category-form-submit').on('click', function() {
        		$('#modal-category').modal('hide');
        		Metronic.blockUI({ boxed: true });
        		var url = site_url+'/admin/category/categorySubmit';
        		$.post(
        			url,
        			$( "#modal-category-form" ).serialize(),
        			function( data ) {
        				Metronic.unblockUI();
        				if(data.success) {
        					me.initLoadCategory();
        					
        					MainApp.viewGlobalModal('success', 'Success Insert Data');
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
        	
        	$('#btn_cat_delete').on('click', function() {
        		var mod = MainApp.viewGlobalModal('warning', 'Are you sure to Delete this category ? All Child Category Will be deleted also.');
        		var cat_id = $('#sel_risk_category').val();
        		mod.find('button.btn-danger').one('click', function(){
        			mod.modal('hide');
        			
        			Metronic.blockUI({ boxed: true });
        			var url = site_url+'/admin/category/categoryDelete';
        			$.post(
        				url,
        				{ 'id':  cat_id},
        				function( data ) {
        					Metronic.unblockUI();
        					if(data.success) {
        						me.initLoadCategory();
        						
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
        	});
        	
        	// SUB CATEGORY
        	$('#btn_sub_cat_add').on('click', function() {
        		var pid = $('#sel_risk_category').val();
        		var ptext = $('#sel_risk_category option:selected').text();
        		
        		$('#modal-sub-category').modal('show');
        		$('#modal-sub-category-form')[0].reset();
        		$('#modal-sub-category-form input[name=mode]').val('add');
        		$('#modal-sub-category-form input[name=cat_id]').val('');
        		
        		$('#modal-sub-category-form input[name=cat_parent]').val(pid);
        		$('#modal-sub-category-form input[name=cat_parent_text]').val(ptext);
				
				var nextnya = "";
				 
				var nextsplitcat = $('#lastsel_risk_sub_category').val();
				
				if(nextsplitcat!=""){				
					var rescat = nextsplitcat.split(" "); 					
					var rescatdet = rescat[0].split("."); 					 
					var nextnya = eval(rescatdet[1])+eval(1);				
				}else{				
					var rescat = ptext.split(" "); 					
					var rescatdet = new Array(rescat[0]); 					 
					var nextnya = "1";	
				}
				 
				$('#modal-sub-category-form input[name=cat_code]').val(rescatdet[0]+"."+nextnya);
				
        	});
        	
        	$('#btn_sub_cat_edit').on('click', function() {
        		var cur = $('#sel_risk_sub_category').val();

        		if (cur != undefined && cur != '' && cur != null) {
        			var pid = $('#sel_risk_category').val();
        			var ptext = $('#sel_risk_category option:selected').text();
        			
        			$('#modal-sub-category').modal('show');
        			$('#modal-sub-category-form')[0].reset();
        			$('#modal-sub-category-form input[name=mode]').val('edit');
        			
        			$('#modal-sub-category-form input[name=cat_parent]').val(pid);
        			$('#modal-sub-category-form input[name=cat_parent_text]').val(ptext);
        			
        			$('#modal-sub-category-form input[name=cat_id]').val(me.actSubCategory.cat_id);
        			$('#modal-sub-category-form input[name=cat_code]').val(me.actSubCategory.cat_code);
        			$('#modal-sub-category-form input[name=cat_name]').val(me.actSubCategory.cat_name);
        			$('#modal-sub-category-form textarea[name=cat_desc]').val(me.actSubCategory.cat_desc);
        		} else {
        			MainApp.viewGlobalModal('error', 'Cannot Edit Empty Data');
        		}
        		
        	});
        	
        	$('#modal-sub-category-form-submit').on('click', function() {
        		$('#modal-sub-category').modal('hide');
        		Metronic.blockUI({ boxed: true });
        		var url = site_url+'/admin/category/subCategorySubmit';
        		$.post(
        			url,
        			$( "#modal-sub-category-form" ).serialize(),
        			function( data ) {
        				Metronic.unblockUI();
        				if(data.success) {
        					me.initLoadCategory();
        					
        					MainApp.viewGlobalModal('success', 'Success Insert Data');
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
        	
        	$('#btn_sub_cat_delete').on('click', function() {
				var cur = $('#sel_risk_sub_category').val();

        		if (cur != undefined && cur != '' && cur != null) {
        			var mod = MainApp.viewGlobalModal('warning', 'Are you sure to Delete this sub category ? All Child Category Will be deleted also.');
        			var cat_id = $('#sel_risk_sub_category').val();
        			mod.find('button.btn-danger').one('click', function(){
        				mod.modal('hide');
        				
        				Metronic.blockUI({ boxed: true });
        				var url = site_url+'/admin/category/categoryDelete';
        				$.post(
        					url,
        					{ 'id':  cat_id},
        					function( data ) {
        						Metronic.unblockUI();
        						if(data.success) {
        							me.initLoadCategory();
        							
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
        		} else {
        			MainApp.viewGlobalModal('error', 'Cannot Delete Empty Data');
        		}
        	});
        	
        	
        	// SUB SUB CATEGORY
        	$('#btn_sub_sub_cat_add').on('click', function() {
        		var pid = $('#sel_risk_category').val();
        		var ptext = $('#sel_risk_category option:selected').text();
        		
        		var spid = $('#sel_risk_sub_category').val();
        		var sptext = $('#sel_risk_sub_category option:selected').text();
        		
        		$('#modal-sub_sub-category').modal('show');
        		$('#modal-sub_sub-category-form')[0].reset();
        		$('#modal-sub_sub-category-form input[name=mode]').val('add');
        		$('#modal-sub_sub-category-form input[name=cat_id]').val('');
        		
        		$('#modal-sub_sub-category-form input[name=cat_parent]').val(spid);
        		$('#modal-sub_sub-category-form input[name=cat_parent_text]').val(ptext);
        		$('#modal-sub_sub-category-form input[name=cat_sub_parent_text]').val(sptext);
				 
				var nextsplitcat = $('#lastsel_risk_2nd_sub_category').val();
				 
				if(nextsplitcat!=""){				
					var rescat = nextsplitcat.split(" "); 					
					var rescatdet = rescat[0].split("."); 					 
					var nextnya = eval(rescatdet[2])+eval(1);	
					var codeawal = rescatdet[0]+"."+rescatdet[1];
					
				}else{				
					var rescat = sptext.split(" "); 					
					var rescatdet = new Array(rescat[0],rescat[1]); 		
					var codeawal = rescatdet[0] ;					
					var nextnya = "1";	
				}
				 
				$('#modal-sub_sub-category-form input[name=cat_code]').val(codeawal+"."+nextnya);
				
				
        	});
        	
        	$('#btn_sub_sub_cat_edit').on('click', function() {
        		var cur = $('#sel_risk_2nd_sub_category').val(); 
				 
        		if (cur != undefined && cur != '' && cur != null) {
	        		var pid = $('#sel_risk_category').val();
	        		var ptext = $('#sel_risk_category option:selected').text();
	        		var spid = $('#sel_risk_sub_category').val();
	        		var sptext = $('#sel_risk_sub_category option:selected').text();
	        		
	        		$('#modal-sub_sub-category').modal('show');
	        		$('#modal-sub_sub-category-form')[0].reset();
	        		$('#modal-sub_sub-category-form input[name=mode]').val('edit');
	        		
	        		$('#modal-sub_sub-category-form input[name=cat_parent]').val(spid);
	        		$('#modal-sub_sub-category-form input[name=cat_parent_text]').val(ptext);
	        		$('#modal-sub_sub-category-form input[name=cat_sub_parent_text]').val(sptext);
	        		
	        		$('#modal-sub_sub-category-form input[name=cat_id]').val(me.actSubSubCategory.cat_id);
	        		$('#modal-sub_sub-category-form input[name=cat_code]').val(me.actSubSubCategory.cat_code);
	        		$('#modal-sub_sub-category-form input[name=cat_name]').val(me.actSubSubCategory.cat_name);
	        		$('#modal-sub_sub-category-form textarea[name=cat_desc]').val(me.actSubSubCategory.cat_desc);
        		} else {
        			MainApp.viewGlobalModal('error', 'Cannot Edit Empty Data');
        		}
        	});
        	
        	$('#modal-sub_sub-category-form-submit').on('click', function() {
        		$('#modal-sub_sub-category').modal('hide');
        		Metronic.blockUI({ boxed: true });
        		var url = site_url+'/admin/category/subSubCategorySubmit';
        		$.post(
        			url,
        			$( "#modal-sub_sub-category-form" ).serialize(),
        			function( data ) {
        				Metronic.unblockUI();
        				if(data.success) {
        					me.initLoadCategory();
        					
        					MainApp.viewGlobalModal('success', 'Success Insert Data');
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
        	
        	$('#btn_sub_sub_cat_delete').on('click', function() {
        		var cur = $('#risk_2nd_sub_category').val();
        		
        		if (cur != undefined && cur != '' && cur != null) {
        			var mod = MainApp.viewGlobalModal('warning', 'Are you sure to Delete this 2nd sub category ? ');
        			var cat_id = $('#risk_2nd_sub_category').val();
        			mod.find('button.btn-danger').one('click', function(){
        				mod.modal('hide');
        				
        				Metronic.blockUI({ boxed: true });
        				var url = site_url+'/admin/category/categoryDelete';
        				$.post(
        					url,
        					{ 'id':  cat_id},
        					function( data ) {
        						Metronic.unblockUI();
        						if(data.success) {
        							me.initLoadCategory();
        							
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
        		} else {
        			MainApp.viewGlobalModal('error', 'Cannot Delete Empty Data');
        		}
        	});
        },
        initLoadCategory: function() {
        	// init Category select
        	var cnt1 = cnt2 = cnt3 = 0; 
        	$('#sel_risk_category')[0].options.length = 0;
        	$('#sel_risk_sub_category')[0].options.length = 0;
        	$('#sel_risk_2nd_sub_category')[0].options.length = 0;
        	
        	$.getJSON( site_url+"/admin/Category/getCategoryByParentId/0", function( data ) {
        		$.each( data, function( key, val ) {
        			// GET INIT SUB CATEGORY
        			if (cnt1 == 0) {
        				$.getJSON( site_url+"/admin/Category/getCategoryByParentId/"+val.ref_key, function( data1 ) {
        					$.each( data1, function( key2, val2 ) {
        						if (cnt2 == 0) {
        							// GET INIT 2ND SUB CATEGORY
        							$.getJSON( site_url+"/admin/Category/getCategoryByParentId/"+val2.ref_key, function( data2 ) {
        								$.each( data2, function( key3, val3 ) {
        								    $('#sel_risk_2nd_sub_category').append($('<option>').text(val3.ref_value).attr('value', val3.ref_key));
        								});
        								$('#sel_risk_category').trigger('change');
        								$('#sel_risk_sub_category').trigger('change');
        								$('#sel_risk_2nd_sub_category').trigger('change');
        							});
        						}
        						
        					    $('#sel_risk_sub_category').append($('<option>').text(val2.ref_value).attr('value', val2.ref_key));
        						
        					    cnt2++;
								
        					});
        					
        				});
        			}
        			
        			$('#sel_risk_category').append($('<option>').text(val.ref_value).attr('value', val.ref_key));
        			 
        			cnt1++;
					$('#lastcat').val(cnt1);
					
        		});
        	});
        	
        },
        loadCategorySelect: function(sel_id, parent) {
			$('#last'+sel_id).val('');
        	//console.log(sel_id, parent);
        	if (parent == undefined || parent == null) return false;
        	$('#'+sel_id)[0].options.length = 0;
        	$.getJSON( site_url+"/admin/Category/getCategoryByParentId/"+parent, function( data ) {
        		$.each( data, function( key, val ) {
        		    $('#'+sel_id).append($('<option>').text(val.ref_value).attr('value', val.ref_key));
					$('#last'+sel_id).val(val.ref_value);
        		});
        		$('#'+sel_id).trigger('change');
        	});
        },
        loadCategoryData: function(cat_id, mode) {
        	var me = this;
        	
    		if (cat_id == undefined || cat_id == null) {
    			if (mode == 'sub') {
    				$('#note-sub-category > p').html('');
    				$('#note-sub_sub-category > p').html('');
    			}
    			
    			if (mode == 'sub_sub') {
    				$('#note-sub_sub-category > p').html('');
    			}
    			console.log(mode, 'Empty');
    			return false;
    		}
    		$.getJSON( site_url+"/admin/category/getCategory/"+cat_id, function( data ) {
    			me.displaySelected(mode,data);
    		});
    	},
    	displaySelected: function(mode,data) {
    		var me = this;
    		
    		 if (mode == 'cat') {
    		 	me.actCategory = data;
    		 	$('#note-category > p').html(data.cat_desc);
    		 }
    		 
    		 if (mode == 'sub') {
    		 	me.actSubCategory = data;
    		 	$('#note-sub-category > p').html(data.cat_desc);
    		 }
    		 
    		 if (mode == 'sub_sub') {
    		 	me.actSubSubCategory = data;
    		 	$('#note-sub_sub-category > p').html(data.cat_desc);
    		 }
		},
	    submitRiskData: function() {
        	 
	 	}
	 }
}();