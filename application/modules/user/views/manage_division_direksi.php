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
					<th width="85%">
						 Division Name
					</th>
					<th width="85%">
						 Directorate Group
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

		<div id="form-data-move" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form-move" class="form-horizontal" role="form">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Division Name</label>
								<div class="col-md-6">
									<input type="hidden" class="form-control" placeholder="Divisi ID" name="division_id">
									<input type="text" class="form-control" placeholder="Divisi Name" name="division_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Old Directorate</label>
								<div class="col-md-6">
									<input type="hidden" class="form-control" placeholder="Direksi Name" name="direk_id">
									<input type="text" class="form-control" placeholder="Direksi Name" name="direk_old">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">New Directorate</label>
								<div class="col-md-6">
									<select class="form-control" name="direksi_new">
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
				<button id="input-form-submit-button-move" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>
