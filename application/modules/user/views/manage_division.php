<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Division Management
		</h3>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions">
				<a href="javascript: Division.showInputForm()" class="btn default green-stripe">
				<i class="fa fa-plus font-green"></i>
				<span class="hidden-480">
				New Record </span>
				</a>

				<a href="javascript: Division.showOffdivision()" class="btn default green-stripe">
				<i class="glyphicon glyphicon-list font-green"></i>
				<span class="hidden-480">
				Division Off </span>
				</a>
			</div>
		</div>
		
		<form class="form-inline" role="form" id="filterForm">
			<div class="form-group">
				<label for="filterFormBy">Filter By</label>
				<select class="form-control input-medium input-sm" id="filterFormBy">
					<option value="division_name">Division Name</option>
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
					<th>
						Chart Name
					</th>
					<th width="85%">
						 Division Name
					</th>
					<th>
						 Division Group
					</th>
					<th>
						 status
					</th>
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
				<h4 class="modal-title">Add Division</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<div class="form-body">
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label">ID</label>
								<div class="col-md-6">
									<input type="text" class="form-control" readonly="true" name="division_id">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Chart Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Short Name" name="short_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Division Name" name="division_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division Group</label>
								<div class="col-md-6">
									<input type="hidden" class="form-control" placeholder="Direksi Name" name="role">
									<input type="hidden" class="form-control" placeholder="Direksi Name" name="direk_id">
									<input type="text" class="form-control" placeholder="Direksi Name" name="direk_old">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division Group Change</label>
								<div class="col-md-6">
									<select class="form-control" name="direksi_new">
										<option value="0">--choose--</option>
										<?php foreach($division_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status</label>
								<div class="col-md-6">
									<select class="form-control" name="status">
										<option value="0">ON</option>
										<option value="1">OFF</option>
									</select>
								</div>
							</div>
						</div>
					</form>
				    <br /><br />
			 		<span style="color:#035CFF;"><p align="left" style="padding-left: 20px;"><i>Note : <br/>
The status (on/off) only affect for all combobox on form, but not affecting the combo box on search function.

</i></p></span>
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

<div id="form-data-insert" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Division</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form-insert" class="form-horizontal" role="form">
						<div class="form-body">
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label">ID</label>
								<div class="col-md-6">
									<input type="text" class="form-control" readonly="true" name="division_id">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Chart Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Short Name" name="short_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Division Name" name="division_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Division Group</label>
								<div class="col-md-6">
									<select class="form-control" name="direksi_new">
										<option value="0">--choose--</option>
										<?php foreach($division_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status</label>
								<div class="col-md-6">
									<select class="form-control" name="status">
										<option value="0">ON</option>
										<option value="1">OFF</option>
									</select>
								</div>
							</div>
						</div>
					</form>
				    <br /><br />
			 		<span style="color:#035CFF;"><p align="left" style="padding-left: 20px;"><i>Note : <br/>
The status (on/off) only affect for all combobox on form, but not affecting the combo box on search function.

</i></p></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
				<button id="input-form-insert-button" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>


<div id="division-off" class="modal fade" tabindex="-1" data-width="1175" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Division</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form-insert" class="form-horizontal" role="form">
						<div class="form-body">
							<div class="container">
											<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_ajax_off">
				<thead>
				<tr role="row" class="heading">
					<th width="5%">
						 No
					</th>
					<th>
						Chart Name
					</th>
					<th width="85%">
						 Division Name
					</th>
					<th>
						 Division Group
					</th>
					<th>
						 status
					</th>
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
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			</div>
		</div>
	</div>
</div>


		<!-- FORM MODAL -->
