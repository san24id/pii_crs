<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		User Management
		</h3>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions">
				<a href="javascript: User.showInputForm()" class="btn default green-stripe">
				<i class="fa fa-plus font-green"></i>
				<span class="hidden-480">
				New Record </span>
				</a>
			</div>
		</div>
		
		<form class="form-inline" role="form" id="filterForm">
			<div class="form-group">
				<label for="filterFormBy">Filter By</label>
				<select class="form-control input-medium input-sm" id="filterFormBy">
					<option value="username">Username</option>
					<option value="display_name">Full Name</option>
					<option value="role_name">Role</option>
					<option value="division_name">Division</option>
				</select>
			</div>
			<div class="form-group">
				<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
			</div>
			<button type="button" id="filterFormSubmit" class="btn green btn-sm">Submit</button>
		</form>	
		</div>
		
		<div class="portlet-body">
			<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_ajax">
				<thead>
				<tr role="row" class="heading">
					<th width="5%">
						 No
					</th>
					<th width="20%"> Username </th>
					<th width="25%"> Full Name </th>
					<th width="20%"> Role </th>
					<th width="20%"> Division </th>
					<th width="10%">
						 Action
					</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
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
								<label class="col-md-3 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" placeholder="Password" name="password">
									<span class="help-block red">* Empty Password if you dont want to change</span>
									
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
									<select class="form-control" name="role_id">
										<?php foreach($role_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division</label>
								<div class="col-md-6">
									<select class="form-control" name="division_id">
										<?php foreach($division_list as $v) { ?>
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
				<button id="input-form-submit-button" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>
	</div>
</div>