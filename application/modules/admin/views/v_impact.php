<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Manage Impact
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
					<button id="show_modal_impact_insert"  type="button" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					New Record </span>
					</button>
				</div>
			</div>
			
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter By</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="impact_category">Impact Category</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
				</div>
				<button type="submit"  class="btn green btn-sm" id="filterFormSubmit">Search</button>
			</form>	
			</div>
			
			<div class="portlet-body">
				
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered" id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th width="25%">Impact Category</th>
						<th width="25%">Level 1</th>
						<th width="10%">Level 1 Description</th>
						<th width="25%">Level 2</th>
						<th width="10%">Level 2 Description</th>
						<th width="25%">Level 3</th>
						<th width="10%">Level 3 Description</th>
						<th width="25%">Level 4</th>
						<th width="10%">Level 4 Description</th>
						<th width="25%">Level 5</th>
						<th width="10%">Level 5 Description</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
				<hr/>
					<div class="row">
					<div class="col-md-6">
						<h4>Information</h4>
						<ul class="list-group">
							<li class="list-group-item">
								Changing the risk on Manage Impact only affects the current period
							</li>
						</ul>
		
					</div>
					</div>
		
	</div>
</div>

<div id="modal_impact_edit" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Edit Impact</h4>		 
	</div>
	<div class="modal-body">
				<form id="impact_edit" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Impact Category :</label>
							<div class="col-md-9">
							<input type="hidden" class="form-control input-sm input-readview" name="impact_id" placeholder="impact_id">
							<textarea class="form-control input-sm input-readview" name ="impact_category" id="impact_category"></textarea>  
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label cl-compact">Impact Level</label>
							<div class="col-md-9">
							
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">Level 1 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Insignificant</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_1" placeholder="level_1">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 1 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_1_desc" id="level_1_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 2 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Minor</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_2" placeholder="level_2">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 2 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_2_desc" id="level_2_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 3 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Moderate</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_3" placeholder="level_3">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 3 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_3_desc" id="level_3_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 4 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Major</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_4" placeholder="level_4">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 4 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_4_desc" id="level_4_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 5 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Catastrophic</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_5" placeholder="level_5">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 5 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_5_desc" id="level_5_desc"></textarea>  
							</div>
						</div>

					</div>

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="impact_button_edit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<div id="modal_impact_insert" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Insert Impact</h4>		 
	</div>
	<div class="modal-body">
				<form id="impact_insert" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Impact Category :</label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="impact_category" id="impact_category"></textarea>  
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label cl-compact">Impact Level</label>
							<div class="col-md-9">
							
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">Level 1 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Insignificant</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_1" placeholder="level_1" value="INSIGNIFICANT">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 1 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_1_desc" id="level_1_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 2 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Minor</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_2" placeholder="level_2" value="MINOR">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 2 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_2_desc" id="level_2_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 3 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Moderate</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_3" placeholder="level_3" value="MODERATE">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 3 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_3_desc" id="level_3_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 4 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Major</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_4" placeholder="level_4" value="MAJOR">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 4 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_4_desc" id="level_4_desc"></textarea>  
							</div>
						</div>

						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" >Level 5 : </label>
								<div class="col-md-9">
									<label class="control-label smaller cl-compact">Catastrophic</label>
									<input type="hidden" class="form-control input-sm input-readview" name="level_5" placeholder="level_5" value="CATASTROPHIC">
								</div>
						</div>
						
						<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Level 5 Description : </label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" name ="level_5_desc" id="level_5_desc"></textarea>  
							</div>
						</div>

					</div>

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
			<button id="impact_button_insert" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Submit</button>
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
				<form id="namelevel_edit" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
								<div class="col-md-12">
									<input type="hidden" class="form-control input-sm input-readview" readonly="readonly" name="level_id" placeholder="level_id">
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

<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="1060" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk List</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-library-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Impact Level</center></th>
							<th><center>Likelihood</center></th>
							<th><center>Risk Owner</center></th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>