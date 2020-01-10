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
            "url": site_url+"/user/userGetData" // ajax source
        },
        "columnDefs": [ {
            "targets": 7,
            "data": "status_mail1",
            "render": function ( data, type, full, meta ) {

                if(data == 1){
                
                    return 'Active';
                }else{
                    return 'Disable';
                }
            }

        },{
            "targets": 8,
            "data": "status_mail2",
            "render": function ( data, type, full, meta ) {

                if(data == 1){
                
                    return 'Active';
                }else{
                    return 'Disable';
                }
            }

        },{
            "targets": 9,
            "data": "username",
            "render": function ( data, type, full, meta ) {

            	if(full.role_id == 2){
            		return '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-exchange"> Change </i></button>'+
           		'</div>';
            	}else{
            		if(full.status_login == 1){
            			 return '<div class="btn-group">'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-exchange"> Change </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-unblock_user"><i class="fa fa-check-circle-o font-green"> Unfreeze</i></button>'+
           				'</div>';
            		}else{
                		return '<div class="btn-group">'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-edit"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-confirm"><i class="fa fa-exchange"> Change </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
           					'<button type="button" class="btn btn-default btn-xs button-grid-block_user"><i class="fa fa-check-circle-o font-green"> Freeze</i></button>'+
           				'</div>';
           			}
           		}
            }
        } ],
        "columns": [
           { "data": "GenRowNum", "orderable": false },
           { "data": "username" },
           { "data": "display_name" }, 		   
           { "data": "role_name" },
		   { "data": "role_status" },
		   { "data": "email" },
           { "data": "division_name" },
           { "data": "status_mail1" },
           { "data": "status_mail2" },
           { "data": "username" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridUserHide = new Datatable();
gridUserHide.init({
    src: $("#datatable_hide"),
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
            "url": site_url+"/user/userGetData_hide" // ajax source
        },
        "columns": [
            { "data": "checkboxColumn", "orderable": false  },
       		{ "data": "GenRowNum", "orderable": false },
			{ "data": "username" },
			{ "data": "display_name"},
			{ "data": "role_id"},
			{ "data": "role_status"},
			{ "data": "email" },
			{ "data": "division_name" },
			{ 
           	"data": null,
           	"orderable": false,
           	"defaultContent": '<div class="btn-group">'+
           			'<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
           		'</div>'
           }
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridUserSSO = new Datatable();
gridUserSSO.init({
    src: $("#datatable_sso"),
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
            "url": site_url+"/user/userGetData_sso" // ajax source
        },
        "columnDefs": [{
            "targets": 5,
            "data": "id",
            "render": function ( data, type, full, meta ) {

                    return '<div class="btn-group">'+
                    '<button type="button" class="btn btn-default btn-xs button-grid-editsso"><i class="fa fa-pencil font-blue"> Edit </i></button>'+
                    '<button type="button" class="btn btn-default btn-xs button-grid-delete"><i class="fa fa-trash-o font-red"> Delete </i></button>'+
                '</div>';
            }
        } ],
        "columns": [
            { "data": "checkboxColumn", "orderable": false  },
            { "data": "GenRowNum", "orderable": false },
            { "data": "username" },
            { "data": "computer_name"},
            { "data": "status" },
            { "data": "id"}
       ],
        "order": [
            [2, "asc"]
        ]// set first column as a default sort by asc
    }
});

var gridAddUserSSO = new Datatable();
gridAddUserSSO.init({
    src: $("#AddUserSSO"),
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
           "url": site_url+"/user/userGetData_Addsso" // ajax source
        },
        "columnDefs": [ {
            "targets": 0,
            "data": "id",
            "render": function ( data, type, full, meta ) {
                var ret = '<div class="btn-group">'+
                '<button type="button" class="btn btn-default btn-xs" onclick="javascript: User.selectAddUserSSO('+full.id+')"><i class="fa fa-check-circle font-blue"> Select </i></button>'+
                '</div>';
                return ret;
            }
        },{
            "targets": 1,
            "data": "username",
            "render": function ( data, type, full, meta ) {
                return data;
            }
        }],
        "columns": [
            { "data": "id", "orderable": false },
           { "data": "username" },
           { "data": "display_name" },         
           { "data": "role_name" },
           { "data": "role_status" },
           { "data": "email" },
           { "data": "division_name" }
       ],
        "order": [
            [1, "asc"]
        ]// set first column as a default sort by asc
    }
});

var User = function() {
	return {
			dataMode: null,
	        //main function to initiate the module
	        init: function() {
	        	var me = this;
	        	
	        	 $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
	              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
	                '<div class="progress progress-striped active">' +
	                  '<div class="progress-bar" style="width: 100%;"></div>' +
	                '</div>' +
	              '</div>';
	
	            $.fn.modalmanager.defaults.resize = true;


	            //-----search user
	           $('#choose_l_divisi').hide();

               $('#filterFormBy').change(function(){
                var risk_user = $('#filterFormBy').val();
                 if(risk_user == "username"){
                    $('#choose_l_divisi').hide();
                    $('#filterFormValue').show();
                    $('#filterFormValue').val('');
                 }else if(risk_user == "display_name"){
                    $('#choose_l_divisi').hide();
                    $('#filterFormValue').show();
                    $('#filterFormValue').val('');
                 }else if(risk_user == "mtable.role_name"){
                    $('#choose_l_divisi').hide();
                    $('#filterFormValue').show();
                    $('#filterFormValue').val('');
                 }else if(risk_user == "mtable.role_status"){
                    $('#choose_l_divisi').hide();
                    $('#filterFormValue').show();
                    $('#filterFormValue').val('');
                 }else if(risk_user == "mtable.division_name"){
                    $('#choose_l_divisi').show();
                    $('#filterFormValue').hide();
                    $('#filterFormValue').val('');
                 }else if(risk_user == "mtable.email"){
                    $('#choose_l_divisi').hide();
                    $('#filterFormValue').show();
                    $('#filterFormValue').val('');
                 }
            });

            $('#l_divisi').change(function(){
                var division_list = $("option:selected", this).attr('data-division');
                $('input[id="filterFormValue"]').attr('value', division_list);
                var l_divisi = $('#l_divisi').val();
                if(l_divisi == "-"){
                    $('#filterFormValue').val('');
                }
            });
            //----------------
	           $('#submit-add_user').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                    if (me.dataMode == 'add') {
                        var url = site_url+'/user/AddNewUser';
                        var tx = 'Insert';
                    }
                    
                    $.post(
                        url,
                        $( "#input-form-add_user" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                grid.getDataTable().ajax.reload();
                                
                                $('#form_add_user').modal('hide');
                                
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

	            $('#input-form-submit-button').click(function(e) {
	                e.preventDefault();
	                var l = Ladda.create(this);
	                l.start();
	                
                	var url = site_url+'/user/userEditRac';
                	var tx = 'Update';

	                $.post(
	                	url,
	                	$( "#input-form" ).serialize(),
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				grid.getDataTable().ajax.reload();
	            				
	            				$('#form-data').modal('hide');
	            				
	            				MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
	            			} else {
	            				MainApp.viewGlobalModal('error', data.msg);
	            			}
							
	                	},
	                	"json"
	                ).fail(function() {
	                	l.stop();
	                	//MainApp.viewGlobalModal('error', 'Error Submitting Data');
	                	var tx = 'Update';
	                	grid.getDataTable().ajax.reload();
	            				
	            				$('#form-data').modal('hide');
	            				
	            				MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
	                 });
	            });

	            //move user
	            $('#input-form-submit-button-move').click(function(e) {
	                e.preventDefault();
	                var l = Ladda.create(this);
	                l.start();
	                
                	var url = site_url+'/user/userMove';
                	var tx = 'Update';

	                $.post(
	                	url,
	                	$( "#input-form-move" ).serialize(),
	                	function( data ) {
	                		l.stop();
	            			if(data.success) {
	            				grid.getDataTable().ajax.reload();
	            				
	            				$('#form-data-move').modal('hide');
	            				
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


                $('#input-add-usersso').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                    if (me.dataMode == 'add') {
                        var url = site_url+'/user/AddNewUserSSO';
                        var tx = 'Insert';
                    }
                    
                    $.post(
                        url,
                        $( "#input-form-AddUserSSO" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                gridUserSSO.getDataTable().ajax.reload();
                                
                                $('#form-Add-User_sso').modal('hide');
                                
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

                $('#edit-user-sso').click(function(e) {
                    e.preventDefault();
                    var l = Ladda.create(this);
                    l.start();
                    
                    var url = site_url+'/user/userEditSSO';
                    var tx = 'Update';

                    $.post(
                        url,
                        $( "#input-form-EditUserSSO" ).serialize(),
                        function( data ) {
                            l.stop();
                            if(data.success) {
                                gridUserSSO.getDataTable().ajax.reload();
                                
                                $('#form-Edit-User_sso').modal('hide');
                                
                                MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        l.stop();
                        //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                        var tx = 'Update';
                        grid.getDataTable().ajax.reload();
                                
                                $('#form-data').modal('hide');
                                
                                MainApp.viewGlobalModal('success', 'Success '+tx+' Data');
                     });
                });

	            
	            // datatables filter button
	            $("#filterFormSubmit").click(function(e) {
	            	var fby = $("#filterFormBy").val();
	            	var fval = $("#filterFormValue").val();
	            	
	            	me.filterDataGrid(fby, fval);
	            });

	            $("#filterForm").submit(function (e) {
               	 	e.preventDefault();
                	var fby = $("#filterFormBy").val();
	            	var fval = $("#filterFormValue").val();
	            	
	            	me.filterDataGrid(fby, fval); 
           		 });
	            
	            // datatables edit delete handler
	            $("#datatable_ajax").on('click', 'button.button-grid-edit', function(e) {
	            	e.preventDefault();
	            	
	            	var r = this.parentNode.parentNode.parentNode;
	            	var data = grid.getDataTable().row(r).data();
	            	
	            	me.editData(data);
	            });

	            $("#datatable_ajax").on('click', 'button.button-grid-delete', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.deleteRisk(data);
    	        });


	            $("#datatable_hide").on('click', 'button.button-grid-delete', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = gridUserHide.getDataTable().row(r).data();
    	        	
    	        	me.deleteRisk_hide(data);
    	        });


                $("#datatable_sso").on('click', 'button.button-grid-delete', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    var data = gridUserSSO.getDataTable().row(r).data();
                    
                    me.deleteRisk_sso(data);
                });


    	        $("#datatable_ajax").on('click', 'button.button-grid-confirm', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.moveRisk(data);
    	        });


    	       	$("#datatable_ajax").on('click', 'button.button-grid-block_user', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.status_block(data);
    	        });

    	        $("#datatable_ajax").on('click', 'button.button-grid-unblock_user', function(e) {
    	        	e.preventDefault();
    	        	
    	        	var r = this.parentNode.parentNode.parentNode;
    	        	var data = grid.getDataTable().row(r).data();
    	        	
    	        	me.status_unblock(data);
    	        });

                $("#datatable_sso").on('click', 'button.button-grid-editsso', function(e) {
                    e.preventDefault();
                    
                    var r = this.parentNode.parentNode.parentNode;
                    var data = gridUserSSO.getDataTable().row(r).data();
                    
                    me.editDataSSO(data);
                });

    	        $('#role_id').change(function() {
        		var val = $(this).val();
        		me.loadCategorySelect('role_status', val);
        		});

                $('#user-modal_delete').on('click', function() {
                var selRow = gridUserHide.getSelectedRows();
                if (selRow.length > 0) {
                    var subParam = {};
                    var ct = 0;
                    $.each(selRow, function(k, v) {
                        subParam['id['+ct+']'] = v;
                        ct++;
                    });
                    
                    var mod = MainApp.viewGlobalModal('confirm', 'Delete Selected username for Modify Username ?');
                    mod.find('button.btn-ok-success').one('click', function(){
                        $('#modal-library').modal('hide');
                        mod.modal('hide');
                        
                        var url = site_url+'/user/User/deleteSelectedUser';
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $.param(subParam),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    gridUserHide.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success username for Modify Username');
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
                    MainApp.viewGlobalModal('error', 'Please Select username');
                }
            });


            $('#usersso-modal_delete').on('click', function() {
                var selRow = gridUserSSO.getSelectedRows();
                if (selRow.length > 0) {
                    var subParam = {};
                    var ct = 0;
                    $.each(selRow, function(k, v) {
                        subParam['id['+ct+']'] = v;
                        ct++;
                    });
                    
                    var mod = MainApp.viewGlobalModal('confirm', 'Delete Selected username for Modify Username ?');
                    mod.find('button.btn-ok-success').one('click', function(){
                        $('#modal-library').modal('hide');
                        mod.modal('hide');
                        
                        var url = site_url+'/user/User/deleteSelectedUserSSO';
                        
                        Metronic.blockUI({ boxed: true });
                        $.post(
                            url,
                            $.param(subParam),
                            function( data ) {
                                Metronic.unblockUI();
                                if(data.success) {
                                    gridUserSSO.getDataTable().ajax.reload();
                                    
                                    MainApp.viewGlobalModal('success', 'Success username for Modify Username');
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
                    MainApp.viewGlobalModal('error', 'Please Select username');
                }
            });

            $('#modal-control-filter-submit-sso').on('click', function() {
                me.filterUserSSO();
            });

            $('#modal-control-filter-submit-objective').on('click', function() {
                me.filterControlobjective();
            });

	        },

            showInputForm: function() {
                $('#input-form-add_user')[0].reset();
                $('#form_add_user').find('h4.modal-title').html('Add New Username');
                $('#form_add_user').modal('show');
                this.dataMode = 'add';
            },

            showInputAddUserSSO: function() {
                $('#input-form-AddUserSSO')[0].reset();
                $('#form-Add-User_sso').find('h4.modal-title').html('Add Username SSO');
                $('#form-Add-User_sso').modal('show');
                this.dataMode = 'add';
            },

	        loadCategorySelect: function(sel_id, parent) {
        	$('#'+sel_id)[0].options.length = 0;
        	$.getJSON( site_url+"/risk/RiskRegister/getUserRole/"+parent, function( data ) {
        		$.each( data, function( key, val ) {
        		    $('#'+sel_id).append($('<option>').text(val.role_status).attr('value', val.role_status));
        		});
        		$('#'+sel_id).trigger('change');
        	});
       		 },

	        moveRisk: function(data) {
	        	$('#input-form-move')[0].reset();
	        	$('#input-form-move').find("input[name='username_id']").val(data.username).prop("readonly", true);
	        	$('#input-form-move').find("input[name='username_old']").val(data.display_name).prop("readonly", true);
	        	$('#form-data-move').find('h4.modal-title').html('move the role and related tasks to:');
	        	$('#form-data-move').modal('show');
	        	this.dataMode = 'edit';
	        },

	        deleteRisk: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure to <b>HIDE</b> User : <b>'+data.username+'</b> ? <br/>Have you changed the risk to other user ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'username' : data.username,
	        			'division_id' : data.division_id,
	        			'role_id' : data.role_id

	        		};
	        		var url = site_url+'/user/user/deleteRiskHide';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//gridUserHide.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete User');
	        					window.location.href = site_url+'/user/modify';
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

	       	deleteRisk_hide: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure to <b>Permanent Delete</b> User : <b>'+data.username+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'username' : data.username,
	        			'division_id' : data.division_id,
	        			'role_id' : data.role_id

	        		};
	        		var url = site_url+'/user/user/deleteUser';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					gridUserHide.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success Delete User');
	        					//window.location.href = site_url+'/user/modify';
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


            deleteRisk_sso: function(data) {
                var mod = MainApp.viewGlobalModal('warning', 'Are you sure to Delete User : <b>'+data.username+'</b> ?');
                mod.find('button.btn-danger').off('click');
                mod.find('button.btn-danger').one('click', function(){
                    mod.modal('hide');
                    var eparam = {
                        'id' : data.id,
                        'username' : data.username,
                        'computer_name' : data.computer_name

                    };
                    var url = site_url+'/user/user/deleteUserSSO';
                    
                    Metronic.blockUI({ boxed: true });
                    $.post(
                        url,
                        $.param(eparam),
                        function( data ) {
                            Metronic.unblockUI();
                            if(data.success) {

                                gridUserSSO.getDataTable().ajax.reload();
                                
                                MainApp.viewGlobalModal('success', 'Success Delete User');
                            } else {
                                MainApp.viewGlobalModal('error', data.msg);
                            }
                            
                        },
                        "json"
                    ).fail(function() {
                        Metronic.unblockUI();
                        //MainApp.viewGlobalModal('error', 'Error Submitting Data');
                          gridUserSSO.getDataTable().ajax.reload();
                                
                          MainApp.viewGlobalModal('success', 'Success Delete User');
                     });
                });
            },

	       status_block: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure to freeze User : <b>'+data.username+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'username' : data.username,
	        			'division_id' : data.division_id,
	        			'role_id' : data.role_id

	        		};
	        		var url = site_url+'/user/user/blockLogin';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//gridUserHide.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success freeze User');
	        					window.location.href = site_url+'/user/modify';
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

	        status_unblock: function(data) {
	        	var mod = MainApp.viewGlobalModal('warning', 'Are you sure to unfreeze User : <b>'+data.username+'</b> ?');
	        	mod.find('button.btn-danger').off('click');
	        	mod.find('button.btn-danger').one('click', function(){
	        		mod.modal('hide');
	        		var eparam = {
	        			'username' : data.username,
	        			'division_id' : data.division_id,
	        			'role_id' : data.role_id

	        		};
	        		var url = site_url+'/user/user/unblockLogin';
	        		
	        		Metronic.blockUI({ boxed: true });
	        		$.post(
	        			url,
	        			$.param(eparam),
	        			function( data ) {
	        				Metronic.unblockUI();
	        				if(data.success) {
	        					//grid.getDataTable().ajax.reload();
	        					//grid2.getDataTable().ajax.reload();
	        					//gridUserHide.getDataTable().ajax.reload();
	        					
	        					MainApp.viewGlobalModal('success', 'Success unfreeze User');
	        					window.location.href = site_url+'/user/modify';
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
	        filterDataGrid: function(fby, fval) {
	        	grid.clearAjaxParams();
	        	grid.setAjaxParam("filter_by", fby);
	        	grid.setAjaxParam("filter_value", fval);
	        	grid.getDataTable().ajax.reload();
	        },
	        editData: function(data) {
	        	$('#input-form')[0].reset();
	        	$('#input-form').find("input[name='username']").val(data.username).prop("readonly", true);
	        	$('#input-form').find("input[name='display_name']").val(data.display_name).prop("readonly", false);
				$('#input-form').find("input[name='email']").val(data.email).prop("readonly", false);
	        	$('#input-form').find("select[name='role_id']").val(data.role_id);
				$('#input-form').find("select[name='role_status']").val(data.role_status);
	        	$('#input-form').find("select[name='division_id']").val(data.division_id);
	        	$('#input-form').find("input[name='division_old']").val(data.division_id);
                $('#input-form').find("select[name='status_mail1']").val(data.status_mail1);
                $('#input-form').find("select[name='status_mail2']").val(data.status_mail2);
	        	
	        	
	        	$('#form-data').find('h4.modal-title').html('Edit User');
	        	$('#form-data').modal('show');
	        	this.dataMode = 'edit';
	        	
	        },

            editDataSSO: function(data) {

                $('#input-form-EditUserSSO')[0].reset();
                 $('#input-form-EditUserSSO').find("input[name='id']").val(data.id).prop("readonly", true);
                $('#input-form-EditUserSSO').find("input[name='username']").val(data.username).prop("readonly", true);
                $('#input-form-EditUserSSO').find("input[name='computer_name']").val(data.computer_name);
                $('#input-form-EditUserSSO').find("select[name='on_login']").val(data.on_login);
                
                $('#form-Edit-User_sso').find('h4.modal-title').html('Edit User SSO');
                $('#form-Edit-User_sso').modal('show');
                this.dataMode = 'edit';
                
            },

        filterUserSSO: function(){
            var fval = $('#form-user_sso div.inputs input[name=filter_search]')[0].value;
            gridUserSSO.clearAjaxParams();
            gridUserSSO.setAjaxParam("filter_library", fval);
            gridUserSSO.getDataTable().ajax.reload();  
        },

         filterControlobjective: function() {
            var fval = $('#modal-AddSSO div.inputs input[name=filter_search]')[0].value;
            gridAddUserSSO.clearAjaxParams();
            gridAddUserSSO.setAjaxParam("filter_library", fval);
            gridAddUserSSO.getDataTable().ajax.reload();   
        },

        selectAddUserSSO: function(rid) {
            var me = this;
            
            $('#input-form-AddUserSSO text[name=username]').attr('readonly', false);
            
            $('#modal-AddSSO').modal('hide');
            Metronic.blockUI({ boxed: true });
            $.getJSON( site_url+"/user/User/loadAddUser/"+rid, function( data_risk ) {
                Metronic.unblockUI();
                
                me.populateRisk($('#input-form-AddUserSSO'), data_risk);
            });
        },

        populateRisk: function(frm, data) {
                
            $.each(data, function(key, value){

                if($('#due_date').val() == '00-00-0000' || $('#due_date').val() == 'Continuous'){
                    $('#fdate').hide();
                    $("#checked").show();
                    $('#ckc').hide();
                    $('#kcc').show();   
                }else{
                    $('#fdate').show();
                    $("#checked").hide();
                    $('#ckc').show();
                    $('#kcc').hide();   
                } 

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
	 }
}();