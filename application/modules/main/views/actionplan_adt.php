<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Action Plan Execution 
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
			 
				<li>
					<a target="_self" href="javascript:;">Action Plan Execution</a>
				</li>
			</ul>
		</div>
		
		<?php if($periodenya == 0):?>
		<div class="row">
		<div class="col-md-12">
			<div class="note note-warning">
				 
				<h4 class="block">Warning</h4>
				<p>
					 Cannot Review Action Plan Execution because Risk Period is not set, please contact RAC team for further information
				</p>
				<p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Back to Home </a>
				</p>
				 
			</div>
		</div>
		</div>
		<?php else:?>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<form class="form-inline" role="form" style="margin-bottom: 10px;">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
					</form>
						
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan_exec_adt">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>AP ID</th>
							<th>Action Plan</th>
							<th>Due Date</th>
							<th>Action Plan Owner</th>
							<th>Execution</th>
							<th>Risk Code</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					<div class="col-md-6">
					<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
					</div>
					</div>
		</div>
		</div>
		
		<?php endif;?>
		
	</div>
</div>


<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="col-md-6 input-group">
					<select class="form-control input-sm" name="filter_search">
						<option value="HIGH">Tinggi</option>
						<option value="MODERATE">Sedang</option>
						<option value="LOW">Rendah</option>
					</select>
					<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" id="modal-library-filter-submit">Search</button>
					</span>
				</div>
				<!--
				<div class="checkbox-list">
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_high" class="checkbox_selectClass" value="HIGH"> Tinggi </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_moderate" class="checkbox_selectClass" value="MODERATE"> Sedang </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_low" class="checkbox_selectClass" value="LOW"> Rendah </label>
				</div>
				-->
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th>No</th>
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Risk Level</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button id="library-modal-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>
