 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <style type="text/css">
li.tip span {
    display: none
}
li.tip:hover span {
	color: #FFF;
    border: #c0c0c0 1px dotted;
    padding: 5px 5px 0px 5px;
    display: block;
    z-index: 100;
    background: #a5cb39;
    top: 50px;
    position: absolute;
    text-decoration: none;
    border-radius:10px;
    box-shadow: 0px 0px 14px #222;
    /*opacity:0.8;
    filter:alpha(opacity=80);*/
	}

 </style>

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
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">My Risk Register</a>
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
					<span>Risk Owned By Me</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_risk_owned"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My Action Plan</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_ap"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My Action Plan Execution</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_apex"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My KRI</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_kri"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>Change Request</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_changerequest"></object>
				</div>
				<!-- <div class="col-md-2">
					<span>Prior Period</span>
					<object width="100%" height="100%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/ChartRiskPriorToVerifyPIC"></object>
				</div> -->
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
		<div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk Owned List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risktreatment">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th>
						<th>Risk Level<input type = "checkbox" checked="true"  name = "risk_level"  > </th>  
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
						<th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v" ></th>
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to" ></th>  
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
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner"  > </th>  
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
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>
						<th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th>
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner"  > </th>       
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
						<th>Timing Reporting<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th>   
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
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
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th>
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status" ></th>
						<th>Date<input type = "checkbox" checked="true"  name = "date" ></th>  						 
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
				<li class="active tip">
					<a href="#tab_my_risk_register" data-toggle="tab">
					My Risk Register </a>
					<span style="left:10px; width: 300px;"><p align="justify">Shows a list of the identified risks by you and provide detail information regarding those risks</p></span>
				</li>
				<li class="tip">
					<a href="#tab_owned" data-toggle="tab">
					Risk Owned By Me 
					<font style="color:red;">
					<?php 
					if( $cekowned > 0){
					echo "($cekowned)";
					}
					?>
					</font>
					</a>
					<span style="left:-90px; width: 400px;"><p align="justify">Shows a list of risks that need to be confirmed by You as Risk Owner and to review the suggested action plan. You are responsible to manage those risks</p></span>
				</li>
				<li class="tip">
					<a href="#tab_action_plan" data-toggle="tab">
					My Action Plan 
					<font style="color:red;">
					<?php 
					if($cekplan > 0){
					echo "($cekplan)";
					}
					?>
					</font>
					</a>
					<span style="left:-90px; width: 400px;"><p align="justify">Shows a list of action plan that need to be confirmed by You as Action Plan Owner. You are responsible to execute the action plan on the agreed due date</p></span>
				</li>
				<li class="tip">
					<a href="#tab_action_exec" data-toggle="tab">
					My Action Plan Execution 
					<font style="color:red;">
					<?php 
					if($cekplanexec > 0){
					echo "($cekplanexec)";
					}
					?>
					</font>
					</a>
					<span style="left:-50px; width: 350px;"><p align="justify">Shows the status of the execution of agreed action plan</p></span>
				</li>
				<li class="tip">
					<a href="#tab_kri" data-toggle="tab">
					My KRI 
					<font style="color:red;">
					<?php 
					if($cekkri > 0){
					echo "($cekkri)";
					}
					?>
					</font>
					</a>
					<span style="left:-160px; width: 400px;"><p align="justify">Shows a Key Risk Indicator which are the responsibility of Risk Owner to report the status</p></span>
				</li>
				<li class="tip">
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
					<span style="left:-100px; width: 400px;"><p align="justify">Shows an information about the Change Request status, whether approved or not, submitted by User to RAC</p></span>
				</li>
				<li class="tip">
					<a href="#tab_old_my_risk_register" data-toggle="tab">
					MyPriorPeriod Risk</a>
					<span style="left:-100px; width: 400px;"><p align="justify">Shows a list of the identified risks by User in prior period and provide information regarding those risks</p></span>
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
									<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category">
									</select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category">
									</select>
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
							class="btn default green pull-right" <?=$adhoc_button ? '' : 'disabled'?>>
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
								<option value="verify" data-RiskStatusLevel="Verified by RAC ">Verified by RAC</option>
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
					<div ><!--class="table-scrollable"-->
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
							<th width="50px"><center>Change Request List</center></th>
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Change Request
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_owned">
				<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_treatment_list-filterBy">
								<option value="choose">Choose / Show All</option>
								<option value="risk_status">Status</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_division">Risk Owner</option>
								<option value="suggested_risk_treatment">Risk Treatment</option>
							</select>
						</div>

						<div class="form-group" id="choose_s_level-treatment" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_level-treatment">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">Verified by RAC</option>
							</select>
						</div>


						<div class="form-group" id="choose_r_level-treatment" style="display: none;">
							<select class="form-control input-medium input-sm" id="r_level-treatment">
								<option value="-">All</option>
								<option value="LOW">Low</option>
								<option value="MODERATE">Moderate</option>
								<option value="HIGH">High</option>
							</select>
						</div>

						<div class="form-group" id="choose_l_divisi-treatment" style="display: none;">
							<select class="form-control input-sm" id="l_divisi-treatment">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>

						<div class="form-group" id="choose_risk-treatment" style="display: none;">
							<select class="form-control input-medium input-sm" id="s_risk-treatment">
								<option value="-">All</option>
								<option value="ACCEPT" data-sugest = "Accept">Accept</option>
								<option value="MITIGATE" data-sugest = "Mitigate">Mitigate</option>
								<option value="TRANSFER" data-sugest = "Transfer">Transfer</option>
							</select>
						</div>

						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Search</button>
					</form>

					<?php
							foreach ($setting_dasborad as $key) {
								if($key['type'] == 3 && $key['status'] == 0){
									$setting_riskown = '';
								}else if($key['type'] == 3 && $key['status'] == 1){
									$setting_riskown = 'style="display:none;"';
								}
							}
					?>
					<?php if($this->session->credential['main_role_id'] == 4 || $this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-riskowner"
							class="btn default green pull-right">
							<i class="fa fa-check-square-o"></i>
							<span class="hidden-480">
							Confirmation Letter for Risk Owned By Me </span>
							</a>
					<?php } ?>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_grid_owned">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Risk Treatment</center></th>
							<th><center>Assigned To</center></th>
							<th width="20px"><center>Change Request</center></th>
						</tr>
						</thead>
						<tbody <?php echo $setting_riskown; ?>>
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
								 To be verified by Division Head
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Change Request
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_list-filterBy">
								<option value="choose">Choose / Show All</option>
								<option value="action_plan_status">Status</option>
								<option value="ap_code">AP.ID</option>
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division">Action Plan Owner</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>

						<div class="form-group" id="choose_s_level-action">
							<select class="form-control input-medium input-sm" id="s_level-action">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">Verified by RAC</option>
							</select>
						</div>
						
						<div class="form-group" id="choose_l_divisi-action">
							<select class="form-control input-sm" id="l_divisi-action">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="AP." id="ap_id" readonly="" style="width: 47px;"> <input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_list-filterButton">Search</button>
					</form>
					<?php if($this->session->credential['main_role_id'] == 4 || $this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-action_plan" 
							class="btn default green pull-right">
							<i class="fa fa-check-square-o"></i>
							<span class="hidden-480">
							Confirmation Letter for My Action Plan </span>
							</a>
					<?php } ?>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Due Date</center></th>
							<th><center>Assigned To</center></th>
							<th><center>Action Plan Owner</center></th>
							<th><center>Risk ID</center></th>
							<th width="20%"><center>Risk Owner</center></th>
							<th width="20px"><center>Change Request</center></th>
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
								 To be verified by Division Head
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Change Request
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_exec">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="choose">Choose / Show All</option>
								<option value="action_plan_status">Status</option>
								<option value="ap_code">AP.ID</option>
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="execution_status">Execution</option>
								<option value="division">Action Plan Owner</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level-execution">
							<select class="form-control input-medium input-sm" id="s_level-execution">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="softreview">Verified By RAC (Soft Review)</option>
								<option value="treatment">Verified By RAC (Final Review)</option>
								<option value="ignore">Ignore</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-execution">
							<select class="form-control input-sm" id="l_divisi-execution">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_status-execution">
							<select class="form-control input-sm" id="status-execution">
								<option value="-">All</option>
								<option value="ONGOING">ONGOING</option>
								<option value="EXTEND">EXTEND</option>
								<option value="COMPLETE">COMPLETE</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="AP." id="apex_id" readonly="" style="width: 47px;"> <input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Due Date</center></th>
							<th><center>Assigned To</center></th>
							<th><center>Action Plan Owner</center></th>
							<th><center>Execution</center></th>
							<th><center>Risk ID</center></th>
							<th width="20%"><center>Risk Owner</center></th>
							<th width="20px"><center>Change Request</center></th>
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
								 To be verified by Division Head
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Change Request
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_kri">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="timing_pelaporan">Time Reporting</option>
								<option value="risk_code">Risk ID</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>KRI ID</center></th>
							<th><center>KRI</center></th>
							<th><center>Time Reporting</center></th>
							<th><center>Assigned To</center></th>
							<th><center>Risk ID</center></th>
							<th width="20px"><center>Change Request</center></th>
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
								 To be verified by Division Head
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Change Request
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
					</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_change_request_list">
					<div>
						<table class="table table-condensed table-bordered table-hover" id="datatable_ajax_change">
						<thead>
						<tr role="row" class="heading">
							<th><center>No</center></th>
							<th><center>ID Change</center></th>
							<th><center>Changes in</center></th>
							<th><center>Status Change Request</center></th>
							<th><center>Date</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_old_my_risk_register">
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
								<option value="verify" data-RiskStatusLevel="Verified by RAC ">Verified by RAC</option>
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
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_old_risk">
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
								 Submitted to rac
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

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Select Assignee</h4>
	</div>
	<div class="modal-body">
		<table id="pic_list_table" class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th width="30px">&nbsp;</th>
				<th>Name</th>
				<th>Division</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($pic_list as $k=>$row) { ?>
			<tr id="modal-pic-tr-<?=$k?>">
				<td>
				<div class="btn-group">
					<button value_idx="<?=$k?>" value="<?=$row['username']?>" type="button" class="btn btn-default btn-xs button-assign-pic"><i class="fa fa-check-circle font-blue"> Select </i></button>
				</div>
				</td>
				<td class="col_display_name"><?=$row['display_name']?></td>
				<td><?=$row['division_name']?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
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
						<input type="text" class="form-control input-sm" id="form-action-dd" name="revised_date" readonly>
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

<!-- Risk Owner -->
<div id="modal-riskowner" class="modal fade" tabindex="-1" data-width="960" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Confirmation Letter for Risk Owned By Me</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-risk_owner" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
							<textarea class="form-control input-readview" readonly="true" rows="8" name="s_risk_owner" placeholder="Message Text" id="s_risk_owner"><?=$s_risk_owner['text']?></textarea>
							</div>
						</div>
						<div class="col-md-9"></div><div class="col-md-3">An.<br /><?php echo $this->session->credential['display_name']; ?></div>
						<br />
					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select risk_input_by from t_risk_add_owner where risk_input_by = '".$session_data['username']."' and periode_id = (select max(periode_id) from m_periode) and status = 1 and type = 'risk owner'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){ ?>
			<button type="button" class="btn blue ladda-button"
			 data-style="expand-right" disabled 
			>Already Sign</button>
		<?php }else{
			$sql_co = "select * from t_risk where periode_id = (select max(periode_id) from m_periode) AND risk_status > 2 AND risk_status < 5 and existing_control_id is null and risk_owner = '".$session_data['division_id']."'";
			$query_co = $this->db->query($sql_co);

			$sql_co1 = "select * from t_risk where periode_id = (select max(periode_id) from m_periode) AND risk_status > 2 and existing_control_id is null and risk_owner = '".$session_data['division_id']."'";
			$query_co1 = $this->db->query($sql_co1);

				if($query_co1->num_rows() > 0){
					if($query_co->num_rows() == 0){?>
						<button id="submit-risk_owner" type="button" class="btn blue ladda-button" data-style="expand-right">Sign</button>
						<button type="button" id = 'ar1' class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
				<?php 	
					}else{
		 		?>
		 		   <button type="button" class="btn blue ladda-button" data-style="expand-right" disabled>pending..</button>
				
		<?php }}}?>
	</div>	
</div>

<!-- Action Plan -->
<div id="modal-action_plan" class="modal fade" tabindex="-1" data-width="960" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Confirmation Letter for Action Plan</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
							<textarea class="form-control input-readview" readonly="true" rows="8" name="s_action_plan" placeholder="Message Text" id="s_action_plan" readonly><?=$s_action_plan['text']?></textarea>
									</div>
						</div>
						<div class="col-md-9"></div><div class="col-md-3">An.<br /><?php echo $this->session->credential['display_name']; ?></div>
						<br />
					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select risk_input_by from t_risk_add_owner where risk_input_by = '".$session_data['username']."' and periode_id = (select max(periode_id) from m_periode) and status = 1 and type = 'action plan'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){ ?>
			<button type="button" class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
		<?php }else{
				$sql_ap = "SELECT * fROM t_risk_action_plan where periode_id = (select max(periode_id) from m_periode) AND action_plan_status > 0 AND action_plan_status < 3 AND existing_control_id is null and division = '".$session_data['division_id']."'";
				$query_ap = $this->db->query($sql_ap);
					if($query_ap->num_rows() == 0){?>
						<button id="submit-action_plan" type="button" class="btn blue ladda-button" data-style="expand-right">Sign</button>
						<button type="button" id = 'ar2' class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
				<?php }else{ ?>
		 		   <button type="button" class="btn blue ladda-button" data-style="expand-right" disabled>pendding..</button>
		<?php }}?>
	</div>	
</div>

<!-- action_plan_execution -->
<div id="modal-action_plan_exe" class="modal fade" tabindex="-1" data-width="960" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Confirmation Letter for Action Plan Execution</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan_exe" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
							<textarea class="form-control input-readview" readonly="true" rows="8" name="s_action_plan_exe" placeholder="Message Text" id="s_action_plan_exe" readonly><?=$s_action_plan_exe['text']?></textarea>
									</div>
						</div>
						<div class="col-md-9"></div><div class="col-md-3">An.<br /><?php echo $this->session->credential['display_name']; ?></div>
						<br />
					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select risk_input_by from t_risk_add_owner_apex where risk_input_by = '".$session_data['username']."' and periode_id = (select max(periode_id) from m_periode) and status = 1 and type = 'prior' and id_apex = (SELECT MAX(id) FROM mail_ap_execution WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode))";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){ ?>
			<button type="button" class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
		<?php }else{
				$sql_ap = "SELECT * fROM t_risk_action_plan where periode_id = (select max(periode_id) from m_periode) AND action_plan_status > 3 AND action_plan_status < 6 AND existing_control_id is null and division = '".$session_data['division_id']."'";
				$query_ap = $this->db->query($sql_ap);
					if($query_ap->num_rows() == 0){?>
						<button id="submit-action_plan_exe" type="button" class="btn blue ladda-button" data-style="expand-right">Sign</button>
						<button type="button" id = 'ar3' class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
				<?php }else{ ?>
		 		   <button type="button" class="btn blue ladda-button" data-style="expand-right" disabled>pendding..</button>
		<?php }}?>
	</div>	
</div>

<script type="text/javascript">
						var g_submit_mode = '<?php echo "$adhoc_button";?>';
						</script>