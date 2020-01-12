<script src="assets/toogle/js/jquery-3.1.1.min"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Modify User
		</h3>
		<!-- END PAGE HEADER-->		
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter By</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="username">Username</option>
						<option value="display_name">Full Name</option>
						<option value="mtable.role_name">Role</option>
						<option value="mtable.role_status">Role Status</option>
						<option value="mtable.email">Email</option>
						<option value="mtable.division_name">Division</option>
					</select>
				</div>
				<div class="form-group" id="choose_l_divisi">
					<select class="form-control input-sm" id="l_divisi">
						<option value="-">All</option>
							<?php foreach ($division_list as $key) {?>
								<option value="<?php echo $key['ref_value']; ?>" data-division = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
							<?php }?>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Search">
				</div>
				<button type="button" id="filterFormSubmit" class="btn green btn-sm">Search</button>

				<div class="btn-group pull-right">
					<table>
					<tr><td>
					<a href="javascript: User.showInputForm()" data-toggle="modal" class="btn default blue pull-right btn-sm" style="margin-right:10px; "><i class="fa fa-plus"></i> Add New User</a></td>
					<td>&nbsp;</td>
					<td>
					<button type="button" class="btn btn-fit-height blue dropdown-toggle btn-sm" data-toggle="dropdown"  data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/User/list_user_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/User/list_user_excel");?>">Excel</a>
						</li>
					 
					</ul>
				</td></tr></table>
				</div>

				<a href="#form-user" id="button-form-control-open" data-toggle="modal" class="btn default green pull-right btn-sm" style="margin-right:10px; ">
				<span class="hidden-480">User Hide </span></a>
				<a href="#form-user_sso" id="button-form-sso" data-toggle="modal" class="btn default green pull-right btn-sm" style="margin-right:10px; ">
				<span class="hidden-480">User SSO </span></a>
			</form>	
			
		</div>

		</div>
		
		<div class="portlet-body">
			<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_ajax">
				<thead>
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Full Name</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Role Status</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Division</center></th>
					<th width="18%"><center>Status Mail1</center></th>
					<th width="18%"><center>Status Mail2</center></th>
					<th width="20%"><center>Action</center></th>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
					<div class="row">
					<div class="col-md-6">
						<h4>Information</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<b><i>Status Mail1</i></b> &nbsp; for send mail or reminder mail 'Mail Regular Risk Register Exercise'
							</li>
							<li class="list-group-item">
								<b><i>Status Mail2</i></b> &nbsp; for send mail or reminder mail 'Mail Risk Owner to confirm the Risks that assigned to your division', 'Mail Action Plan related to the risk of other division that need your support' and 'Mail Division Head to report the status of action plan execution'
							</li>
						</ul>
		
					</div>
					</div>
		</div>
		</div>
		</div>
		

		
		<!-- FORM MODAL -->
		<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<input type="hidden" name="user_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">User Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="User Name" name="username">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Full Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Full Name" name="display_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Role</label>
								<div class="col-md-6">
									<select class="form-control" name="role_id" id="role_id">
										<?php foreach($role_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Role Status</label>
								<div class="col-md-6">
									<select class="form-control" name="role_status" id="role_status">
										
										<?php foreach($role_status as $v) { ?>
										
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										
										<?php } ?>
									</select>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-md-3 control-label">Role Status</label>
								<div class="col-md-6">
									<input type = "text" name = "role_status" id = "role_status" class = "form-control">
								</div>
							</div>-->
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-6">
									<input type = "text" name = "email" id = "email" class = "form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division</label>
								<div class="col-md-6">
									<select class="form-control" name="division_id">
										<?php foreach($division_list as $v) { ?>
										<option value="<?=$v['ref_key']?>"><?=$v['ref_value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label">Division</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Division Old" name="division_old">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status Mail1</label>
								<div class="col-md-6">
									<select name = "status_mail1" id ="status_mail1" class = "form-control">
										<option value="0">Disable</option>
										<option value="1">Active</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status Mail2</label>
								<div class="col-md-6">
									<select name = "status_mail2" id ="status_mail2" class = "form-control">
										<option value="0">Disable</option>
										<option value="1">Active</option>
									</select>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
				<button id="input-form-submit-button" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>

		<!-- FORM MODAL MOVE -->
		<div id="form-data-move" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form-move" class="form-horizontal" role="form">
						<input type="hidden" name="user_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Old User</label>
								<div class="col-md-6">
									<input type="hidden" class="form-control" placeholder="User Name" name="username_id">
									<input type="text" class="form-control" placeholder="User Name" name="username_old">
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="col-md-3 control-label">New User</label>
								<div class="col-md-6">
									<select class="form-control" name="username_new">
										<?php foreach($username_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
				<button id="input-form-submit-button-move" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>


		<!-- modal hide user
<div id="form-user" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">User Hide</h4>
			</div>
	<div class="modal-body">
		<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="">
				<thead>
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Full Name</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Role Status</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Division</center></th>
					<th width="20%"><center>Action</center></th>
				</tr>
				<?php
				$no = 1;
				foreach ($userhide as $row) {
				?>
				<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['display_name'];?></td>
				<td><?php echo $row['role_id'];?></td>
				<td><?php echo $row['role_status'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['division_id'];?></td>
				</tr>
				<?php
				$no++;
				}
				?>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
	</div>
	
</div>

	</div>
</div>-->
<div id="form-user" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">User Hide</h4>
	</div>
	<div class="modal-body">
		<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
					<button id="user-modal_delete" type="button" 
							class="btn default red pull-right btn-sm">Delete</button>
				<table class="table table-striped table-bordered " id="datatable_hide">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Full Name</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Role Status</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Division</center></th>
					<th width="20%"><center>Action</center></th>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
	</div>
	
</div>

<div id="form-user_sso" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">User SSO</h4>
			<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit-sso">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
					<button id="usersso-modal_delete" type="button" class="btn default red pull-right btn-sm" style="margin-left: 5px;">Delete</button>
					<a href="javascript: User.showInputAddUserSSO()" data-toggle="modal" class="btn default blue pull-right btn-sm" style="margin-right:10px; "><i class="fa fa-plus"></i>
						<span class="hidden-480">Add User</span></a>
				<table class="table table-striped table-bordered " id="datatable_sso">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Computer Name</center></th>
					<th width="16%"><center>Status</center></th>
					<th width="20%"><center>Action</center></th>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
	</div>
	
</div>

<div id="form_add_user" class="modal fade" tabindex="-1" data-width="660" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add New User</h4>
	</div>
			<div class="modal-body">
				<div class="form">
				<form id="input-form-add_user" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Username : </label>
						<div class="col-md-7">
							<div class="input-group">
								<input type="text" class="form-control input-sm" name="username" id = "username" placeholder="">
								<span class="input-group-btn">
								<button id="submit-add_user" type="button" class="btn blue ladda-button" data-style="expand-right">Add</button>
								</span> 	
							</div>
						</div>
					</div>
				</form>
			</div>
	</div>
	
</div>


<div id="form-Add-User_sso" class="modal fade" tabindex="-1" data-width="550" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add User SSO</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-AddUserSSO" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact">Username</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="username" id = "username" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-AddSSO"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Computer Name</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm "  name="computer_name" id = "computer_name" />
						</div>
					</div>
					
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-add-usersso" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>

<div id="modal-AddSSO" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">User List</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit-objective">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="AddUserSSO" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Full Name</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Role Status</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Division</center></th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<div id="form-Edit-User_sso" class="modal fade" tabindex="-1" data-width="550" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit User SSO</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-EditUserSSO" role="form" class="form-horizontal">
				<input type="hidden" class="form-control input-sm" readonly="true" name="id" id = "id" placeholder="">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact">Username</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm" readonly="true" name="username" id = "username" placeholder="">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Computer Name</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm "  name="computer_name" id = "computer_name" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">Status</label>
							<div class="col-md-6">
								<select name = "on_login" id ="on_login" class = "form-control">
									<option value="0">Active</option>
									<option value="1">Not Active</option>
								</select>
							</div>
					</div>
					
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="edit-user-sso" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

	</div>
</div>