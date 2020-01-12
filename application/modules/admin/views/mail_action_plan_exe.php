<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Mail Division Head to report the status of action plan execution
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<a href="<?php echo site_url(); ?>/admin/reminder/apex_input" class="btn default green-stripe">
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
						<option value="mail_subject">Subject</option>
						<option value="due_date">Due Date</option>
						<option value="message">Message</option>
						
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
				</div>
				<button type="submit" id="filterFormSubmit" class="btn green btn-sm">Search</button>
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
						<th width="15%">Periode Name</th>
						<th width="20%">Subject</th>
						<th width="10%">Due Date</th>
						<th width="35%">Message</th>
						<th width="10%">Reminder 1</th>
						<th width="10%">Reminder 2</th>
						<th width="10%">Reminder 3</th>
						<th width="10%">Create Date</th>
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
				<h4 class="modal-title">Add Periode</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<input type="hidden" name="periode_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Periode</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Periode Name" name="periode_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Tanggal</label>
								<div class="col-md-4">
									<div class="input-group input-large date-picker input-daterange" data-date="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy">
										<input type="text" class="form-control" name="periode_start">
										<span class="input-group-addon">
										s/d </span>
										<input type="text" class="form-control" name="periode_end">
									</div>
									<!-- /input-group -->
									<span class="help-block">
									Select date range </span>
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