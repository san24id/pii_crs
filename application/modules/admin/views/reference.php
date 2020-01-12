<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Data Reference
		</h3>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<div class="actions">
				<a href="javascript: Reference.showInputForm()" class="btn default green-stripe">
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
					<option value="ref_context">Reference Context</option>
					<option value="ref_key">Reference Key</option>
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
					<th width="25%">Reference Context</th>
					<th width="20%">Reference Key</th>
					<th width="40%">Reference Value</th>
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
				<h4 class="modal-title">Add Reference</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<input type="hidden" name="ref_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Reference Context</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Reference Context" name="ref_context">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Reference Key</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Reference Key" name="ref_key">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Reference Value</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Reference Value" name="ref_value">
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