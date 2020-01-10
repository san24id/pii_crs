<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Manage Risk Level Matrix
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<button id="show_modal_name_level"  type="button" class="btn default green-stripe">
					<i class="glyphicon glyphicon-cog"></i>
					<span class="hidden-480">
					Edit Level Name </span>
					</button>
				</div>
			</div>
				
			</div>
			
			<div class="portlet-body">
				
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered" id="datatable_ajax_risklevel">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th>Impact Level</th>
						<th>Likelihood</th>
						<th>Risk Level</th>
						<th width="7%">
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
</div>


<div id="modal_level_name_edit" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Edit Name Level</h4>		 
	</div>
	<div class="modal-body">
					<div class="form-body">
					<h4>Impact Level</h4>
							 <table class="table table-striped table-bordered" id="datatable_impactlevel">
								<thead>
									<tr role="row" class="heading">
										<th width="10%">Level</th>
										<th>Name Level</th>
										<th width="7%">Action</th>
									</tr>
								</thead>
							
								 <tbody>
								</tbody>
							</table>
							</div>

						
						
	</div>		
		<br>			
	</div>
</div>

<div id="modal_level_edit" class="modal fade" tabindex="-1" data-width="400" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	</div>
	<div class="modal-body">
				<form id="level_edit" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
								<div class="col-md-12">
									<input type="hidden" class="form-control input-sm input-readview" readonly="readonly" name="name_level" placeholder="name_level">
									<input type="text" class="form-control input-sm input-readview" readonly="readonly" name="level_name" placeholder="level_name">
								</div>
						</div>
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="name_level_button_edit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>