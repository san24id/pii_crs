<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Manage Likelihood
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
				</div>
			</div>
				
			</div>
			
			<div class="portlet-body">
				
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered" id="datatable_ajax_like">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th width="25%">Level</th>
						<th>Description</th>
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
			<hr/>
					<div class="row">
					<div class="col-md-6">
						<h4>Information</h4>
						<ul class="list-group">
							<li class="list-group-item">
								Changing the risk on Manage Likelihood only affects the current period
							</li>
						</ul>
		
					</div>
					</div>
			</div>
		</div>
			
		
	</div>
</div>

<div id="modal_likelihood_edit" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Edit Likelihood</h4>		 
	</div>
	<div class="modal-body">
				<form id="likelihood_edit" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">Level</label>
								<div class="col-md-9">
									<input type="hidden" class="form-control input-sm input-readview" name="l_id" placeholder="l_id">
									<input type="hidden" class="form-control input-sm input-readview" name="l_key" placeholder="l_key">
									<input type="text" class="form-control input-sm input-readview" readonly="readonly" name="l_title" placeholder="l_title">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="l_desc" id="l_desc"></textarea>  
							</div>
						</div>
					</div>
					</

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="likelihood_button_edit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>