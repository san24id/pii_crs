<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Regular Period List
		</h3>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			
		</div>
		
		
		</div>
		
		<div class="portlet-body">
			<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_ajax">
				<thead>
				<tr role="row" class="heading">
					<th width="20%">Risk ID</th>
					<th width="25%">Risk Event</th>
					<th width="20%">Risk Description</th>
					<th width="20%">Date</th>
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

<script type="text/javascript">
	var g_id = <?=$id?>;
</script>