 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		KRI Setting
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
					<a target="_self" href="javascript:;">KRI Designation</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">KRI Setting</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<h4>KRI Risk List</h4>
				</div>
			</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Risk Event</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
						<a id="add-risk-button" class="btn default green pull-right btn-sm">
							<i class="fa fa-plus"></i>
								<span class="hidden-480">Add Risk </span>
						</a>
					</form>
			<div>
				<table id="datatable_ajax" class="table table-condensed table-bordered table-hover">
					<thead>
					<tr role="row" class="heading">
						<th><center>Risk ID</center></th>
						<th><center>Risk Event</center></th>
						<th><center>Risk Level</center></th>
						<th><center>Action</center></th>
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

<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_risk" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_risk-filterBy">
								<option value="risk_level">Risk Level</option>
								<option value="risk_event">Risk Event</option>
							</select>
						</div>
					<div class="input-group">
					<select class="form-control input-medium input-sm" name="filter_search" id="filter_search">
						<option value="ALL">All</option>
						<option value="HIGH">High</option>
						<option value="MODERATE">Moderate</option>
						<option value="LOW">Low</option>
					</select>
					<span class="input-group-btn">
					</span>
				</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_risk-filterValue">
						</div>
						<button class="btn btn-default btn-sm" type="button" id="modal-library-filter-submit">Search</button>
			</form>
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
