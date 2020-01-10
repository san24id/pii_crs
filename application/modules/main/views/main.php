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
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li id="bread_tab_my_risk_register" class="bread_tab">
					<a target="_self" href="<?=$site_url?>/main">My Risk Register</a>
				</li>
				<li id="bread_tab_change_request_list" class="bread_tab" style="display: none;">
					<a target="_self" href="<?=$site_url?>/main">Change Request List</a>
				</li>
			</ul>
<!-- 			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="javascript:;">Export to XLS</a>
						</li>
					</ul>
				</div>
			</div> -->
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
			<div class="panel-body">
				<div class="col-md-2" style="text-align: center;">
					<span>My Risk Register</span>
					  <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_risk"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>Change Request</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_changerequest"></object>
				</div>
			</div>
		</div>

		<input type = "hidden" id = "tabactive" name ="tabactive" value = "0">	
		<input type="hidden" id="tabuser" name="tabuser" value="<?php echo $this->session->credential['username']; ?>">
		<input type="hidden" id="tabdiv" name="tabdiv" value="<?php echo $this->session->credential['division_id']; ?>">
		<input type="hidden" id="tabrol" name="tabrol" value="<?php echo $this->session->credential['main_role_id']; ?>">
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
						<th>Risk Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
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
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status"  > </th>
						<th>Date<input type = "checkbox" checked="true"  name = "date"  > </th>  						 
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

		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-risk_prior" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document" >
			<div class="modal-content" >
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Prior Period Risk List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risk_priorlist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
						<th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
						<th>Risk Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
						<th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th>  
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "riskprior_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "riskprior_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>

		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_my_risk_register" data-toggle="tab">
					My Risk Register </a>
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
					<a href="#tab_my_old_risk_register" data-toggle="tab">
					My Prior Period Risk</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_my_risk_register">
					<div class="row">
						<div class="col-md-4">
						<form role="form form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<select class="form-control input-sm" name="risk_category" id="sel_risk_category">
										<option value="choose">Choose Category</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category"></select>
								</div>
								<div class="form-group">
									<button type="button" id="button-filter-category" class="btn blue btn-sm">Filter Risk</button>
									<button type="button" id="button-filter-clear" class="btn blue btn-sm">Remove Filter</button>
								</div>
							</div>
						</form>
						</div>

						<?php
							if($adhoc_button !=''){
								?>
						<div class="col-md-8 clearfix" style="margin-top: 130px;">
							<a href="javascript: location.href='<?=$site_url?>/risk/RiskRegister/RiskRegisterInput/adhoc';" 
							   class="btn default green pull-right <?=$adhoc_button ? '' : 'disabled'?>">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
							Add New Risk </span>
							</a>
						</div>
					<?php
					}
					?>
					</div>
					<hr/>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="choose">Choose/ Show All</option>
								<option value="risk_status">Status</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>

						<div class="form-group" id="choose_s_level" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_level">
								<option value="-">All Status</option>
								<option value="draft" data-RiskStatusLevel="Draft">Draft</option>
								<option value="submitted" data-RiskStatusLevel="submitted to RAC">Submitted to RAC</option>
								<option value="treatment" data-RiskStatusLevel="On risk treatment process">On risk treatment process</option>
								<option value="action_plan" data-RiskStatusLevel="On action plan process">On action plan process</option>
								<option value="action_plan_execution" data-RiskStatusLevel="On action plan execution process">On action plan execution process</option>
								<option value="verified_final" data-RiskStatusLevel="Action plan has been executed and verified">Action plan has been executed and verified </option>
							</select>
						</div>

						<div class="form-group" id="choose_r_level" style="display: none;">
							<select class="form-control input-medium input-sm" id="r_level">
								<option value="-">All</option>
								<option value="LOW">Low</option>
								<option value="MODERATE">Moderate</option>
								<option value="HIGH">High</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood" style="display: none;">
							<select class="form-control input-medium input-sm" id="l_hood">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l" style="display: none;">
							<select class="form-control input-medium input-sm" id="impact_l">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi" style="display: none;">
							<select class="form-control input-sm" id="l_divisi">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Search</button>
					</form>
					<div class="table-container" ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Impact Level</center></th>
							<th><center>Likelihood</center></th>
							<th><center>Risk Owner</center></th>
							<th width="50px"><center>Change Request</center></th>
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
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 On risk treatment process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 On action plan process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On action plan execution process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action plan has been executed and verified
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_change_request_list">
					<div class="table-container" ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax_change">
						<thead>
						<tr role="row" class="heading">
							<th>No</th>
							<th>ID Change</th>
							<th>Changes in</th>
							<th>Status Change Request</th>
							<th>Date</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_my_old_risk_register">
					<div class="row">
						<div class="col-md-4">
						<form role="form form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_category" id="sel_old_risk_category">
										<option value="choose">Choose Category</option>
									</select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_sub_category" id="sel_old_risk_sub_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_2nd_sub_category" id="sel_old_risk_2nd_sub_category"></select>
								</div>
								<div class="form-group">
									<button type="button" id="button-old-filter-category" class="btn blue btn-sm">Filter Risk</button>
									<button type="button" id="button-old-filter-clear" class="btn blue btn-sm">Remove Filter</button>
								</div>
							</div>
						</form>
						</div>		
					</div>
					<hr/>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_old_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_old_risk_list-filterBy">
								<option value="choose" data-FilterRiskList = "Choose / Show All">Choose / Show All</option>
								<option value="risk_status" data-FilterRiskList = "Status">Status</option>
								<option value="risk_code" data-FilterRiskList = "Risk ID">Risk ID</option>
								<option value="risk_event" data-FilterRiskList = "Risk Event">Risk Event</option>
								<option value="risk_level" data-FilterRiskList = "Risk Level">Risk Level</option>
								<option value="risk_impact_level" data-FilterRiskList = "Impact Level">Impact Level</option>
								<option value="risk_likelihood_key" data-FilterRiskList = "Likelihood">Likelihood</option>
								<option value="risk_owner" data-FilterRiskList = "Risk Owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level-prior" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_level-prior">
								<option value="-">All Status</option>
								<option value="draft" data-RiskStatusLevel="Draft">Draft</option>
								<option value="submitted" data-RiskStatusLevel="submitted to RAC">Submitted to RAC</option>
								<option value="treatment" data-RiskStatusLevel="On risk treatment process">On risk treatment process</option>
								<option value="action_plan" data-RiskStatusLevel="On action plan process">On action plan process</option>
								<option value="action_plan_execution" data-RiskStatusLevel="On action plan execution process">On action plan execution process</option>
								<option value="verified_final" data-RiskStatusLevel="Action plan has been executed and verified">Action plan has been executed and verified </option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level-prior">
							<select class="form-control input-medium input-sm" id="r_level-prior">
								<option value="-">All</option>
								<option value="LOW">Low</option>
								<option value="MODERATE">Moderate</option>
								<option value="HIGH">High</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood-prior">
							<select class="form-control input-medium input-sm" id="l_hood-prior">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l-prior">
							<select class="form-control input-medium input-sm" id="impact_l-prior">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-prior">
							<select class="form-control input-sm" id="l_divisi-prior">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_old_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_old_risk_list-filterButton">Search</button>
					</form>
					<div class="table-container" ><!--class="table-scrollable"-->
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
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 On risk treatment process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 On action plan process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On action plan execution process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action plan has been executed and verified
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

						<script type="text/javascript">
						var g_submit_mode = '<?php echo "$adhoc_button";?>';
						</script>
					