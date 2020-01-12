<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports &amp; statistics</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Risk List</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a id = "risk_list_export">Export</a>
						</li>					 
					</ul>
				</div>
			</div>
			
			
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="panel panel-success">
			<div class="panel-body" style="padding: 5px;">
				<div class="col-md-2">
					<span style="font-size: 11px;">Risk To Verify</span>
					<div id="chart_rac_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
				<div class="col-md-2">
					<span style="font-size: 11px;">Risk Register To Verify</span>
					<div id="chart_rr_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
				<div class="col-md-2">
					<span style="font-size: 11px;">Treatment To Verify</span>
					<div id="chart_tr_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
				<div class="col-md-2">
					<span style="font-size: 11px;">Action Plan To Verify</span>
					<div id="chart_ap_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
				<div class="col-md-2">
					<span style="font-size: 11px;">KRI To Verify</span>
					<div id="chart_kri_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
				<div class="col-md-2">
					<span style="font-size: 11px;">Change Request To Verify</span>
					<div id="chart_cr_to_verify" class="chart" style="width: 130px; height: 120px;"></div>
				</div>
			</div>
		</div>
		<input type = "hidden" id = "tabactive" name ="tabactive" value = "0">
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document" >
			<div class="modal-content" >
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risklist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
						<th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Risk Level <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
						<th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk Register List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_riskregisterlist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>User <input type = "checkbox" checked="true"  name = "display_name"  > </th>
						<th>Divisi<input type = "checkbox" checked="true"  name = "division_name"  > </th>
						<th>Submission Date<input type = "checkbox" checked="true"  name = "tanggal_submit"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_register_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_register_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Treatment List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risktreatment">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th> 
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
						<th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v"  > </th>  
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "treatment_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "treatment_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-actionplanlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_actionplan">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "actionplan_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "actionplan_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-executionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan Execution List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_execution">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "execution_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "execution_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-kri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">KRI List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_kri">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "kri_status" ></th>
						<th>KRI ID <input type = "checkbox" checked="true"  name = "kri_code"  > </th>
						<th>KRI<input type = "checkbox" checked="true"  name = "key_risk_indicator"  > </th> 
						<th>KRI Owner<input type = "checkbox" checked="true"  name = "treshold"  > </th> 
						<th>Timing Pelaporan<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
						<th>KRI Warning<input type = "checkbox" checked="true"  name = "kri_warning"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "kri_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "kri_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
 	<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-changereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Change Request List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_changereq">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "GenRowNum" ></th>
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
						<th>Requestor<input type = "checkbox" checked="true"  name = "created_by_v"  > </th> 
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status"  > </th>  						 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "changereq_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "changereq_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		

		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_risk_list" data-toggle="tab">
					Risk List 
					<font style="color:red;">
					<?php 
					if($cekrisklist > 0){
					echo "($cekrisklist)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_risk_register_list" data-toggle="tab">
					Risk Register List 
					<font style="color:red;">
					<?php 
					if($cekregisterlist > 0){
					echo "($cekregisterlist)";
					}
					?>
					</font>
					</a>
					</li>
				<li>
					<a href="#tab_treatment_list" data-toggle="tab">
					Treatment List 
					<font style="color:red;">
					<?php 
					if($treatmentlist > 0){
					echo "($treatmentlist)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_action_plan_list" data-toggle="tab">
					Action Plan List 
					<font style="color:red;">
					<?php 
					if($cekplan > 0){
					echo "($cekplan)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_action_plan_exec" data-toggle="tab">
					Action Plan Execution
					<font style="color:red;">
					<?php 
					if($cekplanExec > 0){
					echo "($cekplanExec)";
					}
					?>
					</font>
					 </a>
				</li>
				<li>
					<a href="#tab_kri_list" data-toggle="tab">
					KRI List 
					<font style="color:red;">
					<?php 
					if($cekkrirac > 0){
					echo "($cekkrirac)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_change_request_list" data-toggle="tab">
					Change Request List 
					<font style="color:red;">
					<?php 
					if($cekChangeRequest > 0){
					echo "($cekChangeRequest)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_risk_old" data-toggle="tab">
					PriorPeriod Risk 
					
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>Risk ID</th>
							<th>Risk Event</th>
							<th>Risk Level</th>
							<th>Impact Level</th>
							<th>Likelihood</th>
							<th>Risk Owner</th>
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
				<div class="tab-pane" id="tab_risk_register_list">	
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_register_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_register_list-filterBy">
								<option value="display_name">User Name</option>
								<option value="division_name">Division</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_risk_register_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_risk_register_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_register">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>User</th>
							<th>Divisi</th>
							<th>Submission Date</th>
							<th width="30%">Note</th>
							<th></th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_treatment_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_treatment_list-filterBy">
								<option value="risk_event">Risk Event</option>
								<option value="risk_owner">Risk Owner</option>
								<option value="suggested_risk_treatment">Risk Treatment</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_treatment">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>Risk ID</th>
							<th>Risk Event</th>
							<th>Risk Owner</th>
							<th>Risk Treatment</th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_list-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division_name">Action Plan Owner</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_action_plan_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>AP ID</th>
							<th>Action Plan</th>
							<th>Due Date</th>
							<th>Action Plan Owner</th>
							<th>Risk ID</th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_kri_list">
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>KRI ID</th>
							<th>KRI</th>
							<th>KRI Owner</th>
							<th>Timing Pelaporan</th>
							<th>Risk ID</th>
							<th>KRI Warning</th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_change_request_list">	
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_cr">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">No</th>
							<th>ID CH</th>
							<th>Changes In</th>
							<th>Requestor</th>
							<th>Status Change Request</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan_exec">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division_name">Action Plan Owner</option>
								<option value="execution_status">Execution</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
					</form>
						
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>AP ID</th>
							<th>Action Plan</th>
							<th>Due Date</th>
							<th>Action Plan Owner</th>
							<th>Execution</th>
							<th>Risk ID</th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_risk_old">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_old_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_old_risk_list-filterBy">
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_old_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_old_risk_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_old_risk">
						<thead>
						<tr role="row" class="heading">
							<th width="30px">Status</th>
							<th>Risk ID</th>
							<th>Risk Event</th>
							<th>Risk Level</th>
							<th>Impact Level</th>
							<th>Likelihood</th>
							<th>Risk Owner</th>
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
			
		</div>
		<!-- END CONTENT-->
	</div>
</div>

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Note</h4>
	</div>
	<div class="modal-body">
		<form id="noteform" role="form" class="form-horizontal" action ="<?=base_url('index.php/main/mainrac/submit_note');?>" method="POST">			 
			<textarea name = "note" id = "modal_pic_note" class="form-control"></textarea>
			<input type = "hidden" id = "modal_pic_risk_input_by" name = "risk_input_by">
			<button type="button" class="btn blue btn-sm" onclick = "submit_note()">Save</button>			 
		</form> 
	</div>
</div>

<!-- Execution Form -->
<div id="modal-exec" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Action Plan Execution</h4>
	</div>
	<div class="modal-body form">
		<form id="exec-form" role="form" class="form-horizontal">
		<input type="hidden" id="form-action-id" name="action_id" value="" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 smaller control-label">Status </label>
					<div class="col-md-9">
					<select class="form-control input-sm" name="execution_status" id="exec-select-status">
						<option value="COMPLETE" selected>Complete</option>
						<option value="EXTEND">Extend</option>
						<option value="ONGOING">On Going</option>
					</select>
					</div>
				</div>
				<div class="form-group" id="fgroup-explain">
					<label class="col-md-3 control-label smaller cl-compact">Explanation<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_explain" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-evidence">
					<label class="col-md-3 control-label smaller cl-compact">Evidence</label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_evidence" placeholder=""></textarea>
					</div>
				</div>				 
				<div class="form-group" id="fgroup-reason">
					<label class="col-md-3 control-label smaller cl-compact">Reason<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_reason" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-date">
					<label class="col-md-3 smaller control-label">Revised Date<span class="required">* </span></label>
					<div class="col-md-9">
					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
						<input type="text" class="form-control input-sm" name="revised_date" readonly value="<?=date('d-m-Y')?>">
						<span class="input-group-btn">
						<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
			
			<div class="form-actions right">
				<button id="exec-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save </button>
				<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
			</div>
		</form>
	</div>
</div>