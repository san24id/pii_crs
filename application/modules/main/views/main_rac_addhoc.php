<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <style type="text/css">
 /* Tooltip */
  .pop + .tooltip > .tooltip-inner {
      background-color: #73AD21; 
      color: #FFFFFF;  
      padding: 7px;
      font-size: 14px;
  }
  /* Tooltip on bottom */
  .pop + .tooltip.bottom > .tooltip-arrow {
      border-bottom: 5px solid blue;
  }
  #chart{
  	width: 30px;
  	height: 30px;
  	border: red;
  }
 </style>
<!-- BEGIN CONTENT -->
<?php 
			$this->load->database();
			$sql = "select 
					a.risk_id
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id is null 
					and a.risk_existing_control = 'under' and a.periode_id = (select max(periode_id) from m_periode)";
			$query = $this->db->query($sql)->row();
		?>
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
			<div class="panel-body">
				<div class="col-md-2" style="text-align: center;">
					<span style="font-size: 11px;">Risk To Verify</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_risk"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">Risk Register To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_user"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span style="font-size: 11px;">Treatment To Verify</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_treatment"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">Action Plan To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_ap"></object>
				</div>
				<div class="col-md-2" style="width: 15%; text-align: center;">
					<span style="font-size: 11px;">Action Plan Execution To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_apex"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">KRI To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_kri"></object>
				</div>
				<div class="col-md-2" style="width: 13%; text-align: center;">
					<span style="font-size: 11px;">Change Request To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_changerequest"></object>
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
						<th>KRI Owner<input type = "checkbox" checked="true"  name = "kri_owner"  > </th> 
						<th>Timing Reporting<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>  
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
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
						<th>Requestor<input type = "checkbox" checked="true"  name = "created_by_v"  > </th> 
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
		
<?php if($query == true){
				$i = "You have undermaintenance risk, please check menu transaction undermaintenance";
				echo '<button type="button" class="btn btn-default btn-sm" disabled="disabled"><i class="fa fa-info-circle font-red" style="font-size:15px;">'.$i.'</i></span></button>';
			} ?>
		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_risk_list" class="pop" data-toggle="tab">
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
			</ul>
<script>
$(document).ready(function(){
    $('[data-toggle="tab"]').tooltip();   
});
</script>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_status">Status</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level">
							<select class="form-control input-medium input-sm" id="s_level">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">On risk treatment process</option>
								<option value="action_plan">On action plan process</option>
								<option value="action_plan_execution">On action plan execution process</option>
								<option value="verified_final">Action plan has been executed and verified </option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level">
							<select class="form-control input-medium input-sm" id="r_level">
								<option value="-">All</option>
								<option value="LOW">Low</option>
								<option value="MODERATE">Moderate</option>
								<option value="HIGH">High</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood">
							<select class="form-control input-medium input-sm" id="l_hood">
								<option value="-">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l">
							<select class="form-control input-medium input-sm" id="impact_l">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi">
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
						<table class="table table-condensed table-bordered table-hover" id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Impact Level</center></th>
							<th><center>Likelihood</center></th>
							<th><center>Risk Level<br>After Mitigation</center></th>
							<th><center>Impact Level<br>After Mitigation</center></th>
							<th><center>Likelihood<br>After Mitigation</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Action</center></th>
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
				<div class="tab-pane" id="tab_risk_register_list">	
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_register_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_register_list-filterBy">
								<option value="risk_status">Status</option>
								<option value="display_name">User Name</option>
								<option value="division_name">Division</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level-register">
							<select class="form-control input-medium input-sm" id="s_level-register">
								<option value="-">All Status</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">Verified by RAC</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-register">
							<select class="form-control input-sm" id="l_divisi-register">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_value']; ?>" data-division = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_register_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_risk_register_list-filterButton">Search</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_register">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>User</center></th>
							<th><center>Divisi</center></th>
							<th><center>Submission Date</center></th>
							<th width="30%"><center>Note</center></th>
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
								<option value="risk_status">Risk Status</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_owner">Risk Owner</option>
								<option value="suggested_risk_treatment">Risk Treatment</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level-treatment">
							<select class="form-control input-medium input-sm" id="s_level-treatment">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">Verified by RAC</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-treatment">
							<select class="form-control input-sm" id="l_divisi-treatment">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Search</button>
					</form>

					<?php if($this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-riskowner"
							class="btn default green pull-right">
							<i class="fa fa-edit"></i>
							<span class="hidden-480">
							Edit Statement for Risk Owner</span>
							</a>
					<?php } ?>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_treatment">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Risk Treatment</center></th>
							<th><center>Action</center></th>
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
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
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
								<option value="action_plan_status">Action Plan Status</option>
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
						<div class="form-group" id="choose_l_owner-action">
							<select class="form-control input-sm" id="l_owner-action">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-owner = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="AP." id="ap_id" readonly="" style="width: 47px;"> <input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_list-filterButton">Search</button>
					</form>
					<?php if($this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-action_plan"
							class="btn default green pull-right">
							<i class="fa fa-edit"></i>
							<span class="hidden-480">
							Edit Statement for Action Plan</span>
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
							<th><center>Action Plan Owner</center></th>
							<th><center>Risk ID</center></th>
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
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_kri_list">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-success">Mandatory</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-default">Non Mandatory</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
								<option value="risk_code">Risk ID</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri">
							<select class="form-control input-sm" id="l_divisi-kri">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
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
							<th><center>KRI Owner</center></th>
							<th><center>Time Reporting</center></th>
							<th><center>Risk ID</center></th>
							<th><center>KRI Warning</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Save Draft (KRI still not active)
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft (KRI has active and will be submit by Division Head)
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
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_change_request_list">	
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_cr">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>No</center></th>
							<th><center>ID CH</center></th>
							<th><center>Changes In</center></th>
							<th><center>Requestor</center></th>
							<th><center>Status Change Request</center></th>
							<th><center>Date</center></th>
							<th><center>Action</center></th>
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
								<option value="action_plan_status">Action Plan Status</option>
								<option value="ap_code">AP.ID</option>
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division">Action Plan Owner</option>
								<option value="execution_status">Execution</option>
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
						<div class="form-group" id="choose_l_owner-execution">
							<select class="form-control input-sm" id="l_owner-execution">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-owner = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
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
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refresh table <button type="button" class="btn green btn-sm" id="refresh_prior_ap"><i class="fa fa-refresh" aria-hidden="true"></i>
</button>
					</form>
					<?php if($this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-action_plan_exe" 
							class="btn default green pull-right">
							<i class="fa fa-edit"></i>
							<span class="hidden-480">
							Edit Statement for Action Plan Execution</span>
							</a>
					<?php } ?>	
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Due Date</center></th>
							<th><center>Action Plan Owner</center></th>
							<th><center>Execution</center></th>
							<th><center>Risk ID</center></th>
							<th width="20%"><center>Risk Owner</center></th>
							<th><center>Risk Level<br>After Mitigation</center></th>
							<th><center>Impact Level<br>After Mitigation</center></th>
							<th><center>Likelihood<br>After Mitigation</center></th>
							<th>Action</th>
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
					<?php 
						$sql_draft = "SELECT COUNT(DISTINCT  a.ap_code) as sum_draft FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and (a.action_plan_status = 4 or a.action_plan_status = 5) and a.existing_control_id is NULL and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_draft = $this->db->query($sql_draft)->row();

						$sql_submit = "SELECT COUNT(DISTINCT  a.ap_code) as sum_submit FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status = 6 and a.existing_control_id is NULL and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_submit = $this->db->query($sql_submit)->row();

						$sql_soft = "SELECT COUNT(DISTINCT  a.ap_code) as sum_soft FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and a.existing_control_id = 'review' and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_soft = $this->db->query($sql_soft)->row();

						$sql_verify = "SELECT COUNT(DISTINCT  a.ap_code) as sum_verify FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status = 7 and a.existing_control_id is NULL and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_verify = $this->db->query($sql_verify)->row();

						$sql_ignore = "SELECT COUNT(DISTINCT  a.ap_code) as sum_ignore FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and a.existing_control_id = 2 and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_ignore = $this->db->query($sql_ignore)->row();

						$sql_total = "SELECT COUNT(DISTINCT  a.ap_code) as sum_total FROM t_risk_action_plan a, t_risk b, m_action_plan c where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 3 and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_total = $this->db->query($sql_total)->row();
					?>
						<ul class="list-group">
							<li class="list-group-item">
								<table class="table table-bordered">
							<tr>
								<th colspan="2">Note &nbsp;:&nbsp;"Ignore" will make the action plan listed on Ignore List and won't show up in action plan owner list (but it remains on the report and the risk register for the next period)</th>
							</tr>
							<tr>	
								<th width="76%" >Status</th>
								<th>Number of Item</th>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 	Draft
								</td>
								<td><?php echo $query_draft->sum_draft; ?></td>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 	Submitted to RAC
								</td>
								<td><?php echo $query_submit->sum_submit; ?></td>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 	Verified By RAC (Soft Review)
								</td>
								<td><?php echo $query_soft->sum_soft; ?></td>
							</tr>
							<tr>
								<td>
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC (Final Review)
								</td>
								<td><?php echo $query_verify->sum_verify; ?></td>
							</tr>
							<tr>
								<td>
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 Ignore
								</td>
								<td><?php echo $query_ignore->sum_ignore; ?></td>
							</tr>
							<tr>
								<td>
								 Total
								</td>
								<td><?php echo $query_total->sum_total; ?></td>
							</tr>

						</table>
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
								<option value="risk_code">Risk Code</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
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
							<th><center>Risk Level<br>After Mitigation</center></th>
							<th><center>Impact Level<br>After Mitigation</center></th>
							<th><center>Likelihood<br>After Mitigation</center></th>
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
								 on action plan process
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
<!-- ******************************************************************************************* FAIL
				<div class="tab-pane" id="tab_kri_list_mitigation">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list_mitigation" data-toggle="tab"><button class="btn btn-success">Mitigation</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-default">Non Mitigation</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_mtg">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_mtg-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_mtg-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri_mtg-filterButton">Search</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri_mitigation">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>KRI ID</center></th>
							<th><center>KRI</center></th>
							<th><center>KRI Owner</center></th>
							<th><center>Time Reporting</center></th>
							<th><center>Risk ID</center></th>
							<th><center>KRI Warning</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Save Draft
							</li>
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
****************************************************************************************************************-->
				<div class="tab-pane" id="tab_kri_list_non_mitigation">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-default">Mandatory</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-success">Non Mandatory</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_nonmtg">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_nonmtg-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
								<option value="risk_code">risk_code</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri_nonmtg">
							<select class="form-control input-sm" id="l_divisi-kri_nonmtg">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_nonmtg-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri_nonmtg-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri_non_mitigation">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>KRI ID</center></th>
							<th><center>KRI</center></th>
							<th><center>KRI Owner</center></th>
							<th><center>Time Reporting</center></th>
							<th><center>Risk ID</center></th>
							<th><center>KRI Warning</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Save Draft (KRI still not active)
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft  (KRI has active and need to be verified by RAC) 
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
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
			<input type = "hidden" id = "modal_pic_risk_periode" name = "periode_id">
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

<!-- Risk Owner -->
<div id="modal-riskowner" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Statement for Risk Owner</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-risk_owner" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
									<label class="col-md-2 control-label">Statement Text</label>
									<div class="col-md-9">
									<textarea class="form-control" rows="10" name="s_risk_owner" placeholder="Message Text" id="s_risk_owner"><?=$s_risk_owner['text']?></textarea>
									</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="save-risk_owner" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>	
</div>

<!-- Action Plan -->
<div id="modal-action_plan" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Statement for Action Plan</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
									<label class="col-md-2 control-label">Statement Text</label>
									<div class="col-md-9">
									<textarea class="form-control" rows="10" name="s_action_plan" placeholder="Message Text" id="s_action_plan"><?=$s_action_plan['text']?></textarea>
									</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="save-action_plan" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>	
</div>

<!-- action_plan_execution -->
<div id="modal-action_plan_exe" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Statement for Action Plan Execution</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan_exe" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
									<label class="col-md-2 control-label">Statement Text</label>
									<div class="col-md-9">
									<textarea class="form-control" rows="10" name="s_action_plan_exe" placeholder="Message Text" id="s_action_plan_exe"><?=$s_action_plan_exe['text']?></textarea>
									</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="save-action_plan_exe" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>	
</div>

<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Action Plan Edit</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">AP.ID :</label>
							<div class="col-md-9">
							<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="ap_code" id = "ap_code">
							<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="id" id = "id">
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan :</label>
							<div class="col-md-9">
							<textarea class="form-control" name ="action_plan" id ="action_plan"></textarea>  
							<textarea style="display:none;" class="form-control" name = "action_plan_ex" id = "action_plan_ex"></textarea>
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
								<div class="col-md-9">

										
											<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 					&nbsp;Continous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" id="fdate">
										
											
											<input type="text" class="form-control input-sm" name="due_date" id="due_date" placeholder="select date">
									
									<span class="input-group-btn">
									<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								</div>
							</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan Owner :</label>
							<div class="col-md-9">
							<select name="division"  class="form-control" id = "division"> 
							</select>		
							<input type="hidden" class="form-control" name="division_ex" id = "division_ex"> 
							</div>
						</div>

						<div class="form-group" style="display: none;">
						 
						<label class="col-md-3 control-label smaller cl-compact">Hidden Input :</label>
							<div class="col-md-9">
								<input type="text" class="form-control input-sm" name="action_plan_status" id="action_plan_status">
								<input type="text" class="form-control input-sm" name="periode_id" id="periode_id">

							</div>
						</div>
					
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="library-modal-listriskap-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>