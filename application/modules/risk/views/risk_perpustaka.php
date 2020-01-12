<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk Form
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
					<a target="_self" href="javascript:;">Regular Exercise</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Risk Register Exercise</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Risk Form</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<?php if ($valid_mode) { ?>

	<?php
	/* INI NIATNYA MAU FILTER LAGI JADI 1 FORM NUNGGU PERINTAH BU HERLIN
	$id = $risk_id;
	//$username = $this->session->credential['username'];
	$this->load->database();
	$sql="SELECT
(CASE WHEN 
t_risk.risk_cause = t_risk_change.risk_cause 
and t_risk.risk_impact = t_risk_change.risk_impact
and t_risk.risk_impact_level = t_risk_change.risk_impact_level 
and t_risk.risk_likelihood_key = t_risk_change.risk_likelihood_key
and t_risk.risk_level = t_risk_change.risk_level
and t_risk.suggested_risk_treatment = t_risk_change.suggested_risk_treatment
and t_risk.risk_owner = t_risk_change.risk_owner
and t_risk.risk_division = t_risk_change.risk_division

and 
(CASE WHEN count(t_risk_control.risk_id) = count(t_risk_control_change.risk_id) and count(t_risk_action_plan.risk_id) = count(t_risk_action_plan_change.risk_id) 
THEN
t_risk_control.risk_id = t_risk_control_change.risk_id
and t_risk_control.risk_existing_control = t_risk_control_change.risk_existing_control
and t_risk_control.risk_evaluation_control = t_risk_control_change.risk_evaluation_control
and t_risk_control.risk_control_owner = t_risk_control_change.risk_control_owner
and t_risk_action_plan.action_plan = t_risk_action_plan_change.action_plan
and t_risk_action_plan.due_date = t_risk_action_plan_change.due_date
and t_risk_action_plan.division = t_risk_action_plan_change.division
END)
THEN 1
ELSE 0 
END) as 'status'
from t_risk
join t_risk_change on t_risk.risk_id = t_risk_change.risk_id
join t_risk_control on t_risk.risk_id = t_risk_control.risk_id
join t_risk_control_change on t_risk.risk_id = t_risk_control_change.risk_id
join t_risk_action_plan on t_risk.risk_id = t_risk_action_plan.risk_id
join t_risk_action_plan_change on t_risk.risk_id = t_risk_action_plan_change.risk_id
WHERE t_risk.risk_id ='$id'";

	$query = $this->db->query($sql);
	$row = $query->row(); 
	$hasil = $row->status;
	if ($hasil == 0){
?>
		<div class="row">
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="div-portlet-page-caption">
						Primary
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<input type="hidden" name="add_user_flag" value="" />
						<input type="hidden" name="add_user_username" value = "" />
						<input type="hidden" name="add_user_date_changed" value="" />
						
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Submitted By</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" id="risk_submitted_by" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk Code</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_library_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact">Library Risk ID</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-library"><i class="fa fa-search fa-fw"/></i></button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Owner</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_division">
									<?php foreach($division_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Event 
								</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" name="risk_event" data-required="1" placeholder="" value="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact">Risk Event Description </label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_description" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_category" id="sel_risk_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" >Risk 2nd Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Cause </label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_cause" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Impact </label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_impact" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Impact Level </label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="hidden" name="risk_impact_level_id" value=""/>
										<input type="text" class="form-control input-sm" readonly="true" name="risk_impact_level_value" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" id="btn_impact_list"><i class="fa fa-search fa-fw"/></i></button>
										</span>
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Likelihood </label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="hidden" name="risk_likelihood_id" value=""/>
										<input type="text" class="form-control input-sm" readonly="true" name="risk_likelihood_value" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood"><i class="fa fa-search fa-fw"/></i></button>
										</span>
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_level_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk Level </label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_level" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Suggested Risk Treatment</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="suggested_risk_treatment">
									<?php foreach($treatment_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<hr/>
							<div class="clearfix">
								<a href="#form-control" id="button-form-control-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Control </span>
								</a>
								<h4>Control</h4>
							</div>
							<div class="table-scrollable">
								<table id="control_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Existing Control ID</span></th>
										<th><span class="small">Existing Control</span></th>
										<th><span class="small">Evaluation on Existing Control</span></th>
										<th><span class="small">Control Owner</span></th>
										<th width="30px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr/>
							<div class="clearfix">
								<a href="#form-data" id="button-form-data-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Plan Action Suggestion </span>
								</a>
								<h4>Action Plan</h4>
							</div>
							
							<div class="table-scrollable">
								<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Suggested Action Plan</span></th>
										<th><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
										<th width="30px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-actions right">
						<button id="primary-risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i>Verify</button>
						
						//klo jadi 2 form button save nya tinggal modif jafi save t_risk dan t_risk Change
						<button id="risk-button-draft" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
						<button type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		</div>

		<?php }else{ //INI DIISI YANG 2 FORM  } 
		*/
		?>
		

		<?php 
		//cek submited by primary
		$this->load->database();
		$sql = "select username from t_risk_add_user
				where risk_id = '".$risk_id."' ";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$hasil = $query->row();
			$user = $hasil->username;
			
		}else{
			$sql = "select risk_input_by from t_risk
					where risk_id = '".$risk_id."' ";
			$query = $this->db->query($sql);
			$hasil = $query->row();
			$user = $hasil->risk_input_by;
			
		}
		/*
		//submited changes
		$sql_changes = "select risk_input_by from t_risk_change
					where risk_id = '".$risk_id."' ";
		$query_changes = $this->db->query($sql_changes);
		$hasil_changes = $query_changes->row();
		$user_changes = $hasil_changes->risk_input_by;
		*/
		?>
		<div class="row">
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="primary-div-portlet-page-caption">
						Primary
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="primary-input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Submitted By</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" value="<?php echo $user; ?>" readonly="true" id="--primary-risk_submitted_by--" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk Code</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_library_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact">Library Risk ID</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_library_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk owner who is responsible in managing the activities that direcly related to the risk">Risk Owner</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="division_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Event 
								</label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_event" placeholder=""></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" title="fill this field with decription of identified risk which explains nature of the risk">Risk Event Description</label>
								<div class="col-md-9">
								<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_description" placeholder=""></textarea>
								</div>
							</div>

							<h4>Objective</h4>
							<div class="table-scrollable">
								<table id="primary_objective_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Obj. ID</span></th>
										<th><span class="small">Objective</span></th>
										
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk category that related to identified risk as decribed in ‘Risk Description’ ">Risk Category</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_category_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_sub_category_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" >Risk 2nd Sub Category</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_2nd_sub_category_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of set of factors that may affects or lead to the occurrence of risk event" >Cause </label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_cause" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of potential direct or indirect loss or cost to IIGF that could have been suffered from a risk event">Impact </label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_impact" placeholder=""></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with grading as describe in “Impact Category” (e.g. insignificant, minor, moderate, major, and catastrophic) after consideration to existing control effectiveness" >Impact Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="impact_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field withthe grading criteria as described in “Likelihood of Risk Occurrence” table (e.g. very low, low, medium, high, and very high) after consideration to existing control effectiveness">Likelihood</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="likelihood_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the grading criteria as described in “Risk Level” matrix (e.g. insignificant, minor, moderate, major, and catastrophic) based on defined value in ‘Likelihood’ and ‘Impact Level’">Risk Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with treatment category as described in “Risk Treatment Guideline” based on its risk level">Suggested Risk Treatment</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="treatment_v" placeholder="">
								</div>
							</div>
							
							<hr/>
							<h4>Control</h4>
							<div class="table-scrollable">
								<table id="primary_control_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Existing Control ID</span></th>
										<th><span class="small">Evaluation on Existing Control</span></th>
										<th><span class="small">Existing Control</span></th>
										<th><span class="small">Control Owner</span></th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr/>
							<h4>Action Plan</h4>
							<div class="table-scrollable">
								<table id="primary_action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Suggested Action Plan</span></th>
										<th><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-actions right">
							<input type="hidden" name="submit_mode" value="verifyRisk" />
							<button id="primary-risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i>Verify</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="div-portlet-page-caption">
						Changes
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<input type="hidden" name="add_user_flag" value="" />
						<input type="hidden" name="add_user_username" value = "" />
						<input type="hidden" name="add_user_date_changed" value="" />
						
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Submitted By</label>
								<div class="col-md-9">
								<input type="text" name = "risk_input_by_change" class="form-control input-sm" readonly="true" value="<?php echo $risk_input_by ?>" id="--risk_submitted_by--" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk Code</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_library_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact">Library Risk ID</label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-library"><i class="fa fa-search fa-fw"/></i></button>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk owner who is responsible in managing the activities that direcly related to the risk">Risk Owner</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_division">
									<?php foreach($division_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Event 
								</label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3" name="risk_event" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" title="fill this field with decription of identified risk which explains nature of the risk">Risk Event Description </label>
								<div class="col-md-9">
								<textarea class="form-control popovers" rows="3" name="risk_description" placeholder="" data-container="body" data-placement="bottom" placeholder="" data-content=""></textarea>
								</div>
							</div>


							
								<div class="panel-body">
									 <div class="clearfix">
									 	<a href="#form-control-objective" id="button-form-control-open-objective" data-toggle="modal" class="btn default green pull-right btn-sm">
									 	<i class="fa fa-plus"></i>
									 	<span class="hidden-480">
									 	Add Objective</span>
									 	</a>
									 </div>
									 
									 <div class="table-scrollable">
									 	<table id="objective_table" class="table table-condensed table-bordered table-hover">
									 		<thead>
									 		<tr role="row" class="heading">
									 			<th width="20%">Obj. ID</th>
									 			<th>Objective</th>
									 			<th width="30px">&nbsp;</th>
									 		</tr>
									 		</thead>
									 		<tbody>
									 		</tbody>
									 	</table>
									 </div>
								</div>
							

							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk category that related to identified risk as decribed in ‘Risk Description’ " >Risk Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_category" id="sel_risk_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" >Risk 2nd Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of set of factors that may affects or lead to the occurrence of risk event">Cause </label>
								<div class="col-md-9">
								<textarea class="form-control popovers" rows="3" name="risk_cause" placeholder="" data-container="body" data-trigger="focus" data-placement="bottom" data-content=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of potential direct or indirect loss or cost to IIGF that could have been suffered from a risk event" >Impact </label>
								<div class="col-md-9">
								<textarea class="form-control popovers" rows="3" name="risk_impact" placeholder="" data-container="body" data-trigger="focus" data-placement="bottom" data-content=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with grading as describe in “Impact Category” (e.g. insignificant, minor, moderate, major, and catastrophic) after consideration to existing control effectiveness" >Impact Level </label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="hidden" name="risk_impact_level_id" value=""/>
										<input type="text" class="form-control input-sm" readonly="true" name="risk_impact_level_value" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" id="btn_impact_list"><i class="fa fa-search fa-fw"/></i></button>
										</span>
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field withthe grading criteria as described in “Likelihood of Risk Occurrence” table (e.g. very low, low, medium, high, and very high) after consideration to existing control effectiveness">Likelihood </label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="hidden" name="risk_likelihood_id" value=""/>
										<input type="text" class="form-control input-sm" readonly="true" name="risk_likelihood_value" placeholder="">
										<span class="input-group-btn">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood"><i class="fa fa-search fa-fw"/></i></button>
										</span>
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_level_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the grading criteria as described in “Risk Level” matrix (e.g. insignificant, minor, moderate, major, and catastrophic) based on defined value in ‘Likelihood’ and ‘Impact Level’" >Risk Level </label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_level" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with treatment category as described in “Risk Treatment Guideline” based on its risk level" >Suggested Risk Treatment</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="suggested_risk_treatment">
									<?php foreach($treatment_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
								
							<hr/>
							<div class="clearfix">
								<a href="#form-control-2" id="button-form-control-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Control </span>
								</a>
								<h4>Control</h4>
							</div>
							<div class="table-scrollable">
								<table id="control_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Existing Control ID</span></th>
										<th><span class="small">Evaluation on Existing Control</span></th>
										<th><span class="small">Existing Control</span></th>
										<th><span class="small">Control Owner</span></th>
										<th width="30px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr/>
							<div class="clearfix">
								<a href="#form-data" id="button-form-data-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Suggestion Action Plan</span>
								</a>
								<h4>Action Plan</h4>
							</div>
							
							<div class="table-scrollable">
								<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Suggested Action Plan</span></th>
										<th><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
										<th width="30px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-actions right">
							<button id="risk-set-as-primary" type="button" class="btn blue"><i class="fa fa-arrows-h"></i> Set As Primary</button>
							<!-- <button id="risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button> -->
							<button id="risk-button-draft" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
							<button type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		</div>

		<?php } else { ?>
		<!-- ERROR RISK REGISTER MODE -->
		<div class="row">
		<div class="col-md-12">
			<div class="note note-danger">
				<?php if (isset($submit_mode) && $submit_mode == 'adhoc') { ?>
				<h4 class="block">Error</h4>
				<p>
					 Cannot Input Adhoc Risk Register Exercise because Risk Period is already set, please contact RAC team for further information
					 <p>
						<a class="btn red" target="_self" href="<?=$site_url?>/main">
						Back to Home </a>
					</p>
				</p>
				<?php } else { ?>
				<h4 class="block">Error</h4>
				<p>
					 Cannot Input Risk Register Exercise because Risk Period is not set, please contact RAC team for further information
				</p>
				<p>
					<a class="btn red" target="_self" href="<?=$site_url?>/risk/RiskRegister">
					Back to Risk Register List </a>
				</p>
				<?php } ?>
			</div>
		</div>
		</div>
		<?php } ?>
	</div>
</div>

<?php if ($valid_mode) { ?>
<!-- OBJECTIVE -->
<div id="form-control-objective" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Objective</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control-objective" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type = "hidden" id = "form-control-revid-objective">
						<label class="col-md-3 control-label smaller cl-compact">Obj. ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="objective_id" id = "objective_id" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-objective"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Objective </label>
						<div class="col-md-9">
						<textarea class="form-control input-sm " rows="3"  name="objective" id = "objective" placeholder="NONE"></textarea>
						<button id="button_clear_control" type="button" class="hide btn red btn-xs" style="margin-top: 5px;"><i class="fa fa-minus-circle font-white"></i> Clear Existing Control</button>
						</div>
					</div>
					
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-control-add-objective" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>

<!-- CONTROL Option  -->
<div id="form-control-2" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Control</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control2" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
								<label class="col-md-3 control-label">Add Control</label>
								<div class="col-md-6">
									<select class="form-control" name="control_id" id="control_id">
										
										<option value="-">Choose One</option>
										<option value="1">Available</option>
										<option value="2">Not Available</option>
										
									</select>
								</div>
							</div>
				</div>
			</form>
	</div>
</div>

<!-- CONTROL Available -->
<div id="form-control" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Control</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type = "hidden" id = "form-control-revid">
						<label class="col-md-3 control-label smaller cl-compact">Existing Control ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="existing_control_id" id = "existing_control_id" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>

					<div class="form-group">
					<input type = "hidden" id = "form-control-revid">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the effectiveness level of existing control (refers to control assessment criteria)">Evaluation on Existing Control <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_existing_control" id = "risk_existing_control" placeholder="" value="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control-existing"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Existing Control <span class="required">* </span></label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" value="" name="risk_evaluation_control" id = "risk_evaluation_control" placeholder="">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the assigned person who is responsible for the business unit, which owns the controls associated with the risk event">Control Owner <span class="required">* </span></label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="risk_control_owner" id = "risk_control_owner">
										<option value="">Choose One</option>
										<?php foreach($division_list as $row) { ?>
										<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
										<?php } ?>
						</select>
					<!-- <input type="text" class="form-control input-sm" name="risk_control_owner" placeholder=""> -->
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-control-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>

<!-- CONTROL Not Available -->
<div id="form-control-3" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Control</h4>
	</div>
	<div class="modal-body">
			<form id="input-form-control-3" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
								<div class="form-group">
								<label class="col-md-3 control-label">Add Control</label>
								<div class="col-md-6">
									<select class="form-control" name="control_id" id="control_id">
										
										<option value="-">Not Available</option>
										
									</select>
								</div>
							</div>
								<input type="hidden" class="form-control input-sm" readonly="true" name="existing_control_id" id = "existing_control_id" placeholder="">
								<input type = "hidden" id = "form-control-revid-3">
								<input type="hidden" class="form-control input-sm" readonly="true" name="risk_existing_control" id = "risk_existing_control" placeholder="" value="Not Available">
								<input type="hidden" class="form-control input-sm" value="Not Available" name="risk_evaluation_control" id = "risk_evaluation_control" placeholder="">
								<select style="display:none;" name="risk_control_owner" id = "risk_control_owner">
								<option value="Not Available">NONE</option>
								</select>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-control-add-3" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>




<!-- ACTION PLAN -->
<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Suggested Action Plan</h4>
	</div>
	<div class="modal-body">
			<input type="hidden"   id = "form-data-revid"  > 
			<form id="input-form-action-plan" role="form" class="form-horizontal">
				<div class="form-body">
					<!--<div class="form-group">
						<label class="col-md-3 control-label">Suggested Action Plan </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="action_plan" placeholder="">
						</div>
					</div>-->
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Suggested Action Plan</label>
						<div class="col-md-9">
							<div class="input-group">
								<textarea class="form-control input-sm " rows="3"  name="action_plan" id = "action_plan" placeholder=""> </textarea>
								<!--
								<input type="text" class="form-control input-sm" name="action_plan" id = "action_plan" placeholder=""> 
								-->
								
								<span class="input-group-btn">
								<button style="margin-top:-60px; margin-left:5px;" class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-libraryaction"><i class="fa fa-search fa-fw"/></i></button>
								</span> 
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date </label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
							<input type="text" class="form-control input-sm" name="due_date" id = "due_date" readonly>
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Action Plan Owner </label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="division" id = "division">
							<?php foreach($division_list as $row) { ?>
							<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
							<?php } ?>
						</select>
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-actionplan-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>


<!-- LIBRARY ACTION-->
<div id="modal-libraryaction" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Suggested Action Plan Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-libraryaction-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_tableaction" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="30px">&nbsp;</th>
					<th>Action Plan</th> 
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>


<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
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
					<th width="30px">&nbsp;</th>
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<!-- Existing CONTROL -->
<div id="modal-control-existing" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Existing Control</h4>
		<p style="color:red;">*Choose One</p>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_control_table_existing" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="30px">&nbsp;</th>
					<th>Evaluation on Existing Control</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<!-- CONTROL -->
<div id="modal-control" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Existing Control</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_control_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="30px">&nbsp;</th>
					<th>Existing Control</th>
					<th>Evaluation on Existing Control</th>
					<th>Control Owner</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- IMPACT LEVEL -->
<div id="modal-impact" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Impact</h4>
		<span class="font-red">* Dapat diisi lebih dari satu(1) kategori, namun dalam Satu(1)
		Kategori hanya boleh diisi satu(1) parameter</span>
	</div>
	<div class="modal-body" style="height: 400px; max-height: 400px; overflow: none; overflow-y: auto;">
		<form id="form-impact">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>Category</th>
				<th>Parameter</th>
			</tr>
			</thead>
			<tbody>
			<?php $cnt = 0;
				  $i = 1;
				foreach($impact_list['impact'] as $k=>$v) { ?>
				<tr>
					<td><?=$v?></td>
					<td>
						<div class="radio-list">
							<label>
							<input type="radio" name="impactlevel_<?=$k?>" value="NA" checked> N/A</label>
							<?php foreach($impact_list['impact_list'][$k] as $key=>$row) { ?>
							<label>
							<input type="radio" name="impactlevel_<?=$k?>" value="<?=$key?>"> <?=$row?></label>
							<input type="hidden" id ="imp_<?=$i++;?>" value="<?=$key;?>">
							<?php } ?>
						</div>
					</td>
				</tr>
			<?php $cnt++; } ?>
			</tbody>
		</table>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-impact-button" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<!-- LIKELIHOOD -->
<div id="modal-likelihood" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Likelihood</h4>
		<span class="font-red">* Pilih Salah Satu</span>
	</div>
	<div class="modal-body">
		<form id="form-likelihood">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>&nbsp;</th>
				<th width="250px">Kemungkinan terjadinya resiko</th>
				<th>Deskripsi</th>
			</tr>
			</thead>
			<tbody>
			<?php $cnt = 0;
				foreach($likelihood as $row) { ?>
				<tr>
					<td><label><input type="radio" name="risk_likelihood" id="likelihood_<?=$row['l_id']?>" value="<?=$row['l_key']?>|<?=$row['l_title']?>" <?=$cnt == 0 ? 'checked' : ''?>></label></td>
					<td><?=$row['l_title']?></td>
					<td><?=$row['l_desc']?></td>
				</tr>
			<?php $cnt++; } ?>
			</tbody>
		</table>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-likelihood-button" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>

<!-- ADD USER -->
<div id="modal-add-user" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Would you want to add the following information on risk properties ?</h4>
	</div>
	<div class="modal-body">
		<form id="input-adduser" role="form" class="form-horizontal">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Submitted By</label>
					<div class="col-md-9">
					<input type = "text" name = "username" readonly="true" value = "<?=$risk_input_by?>" id = "username" class = "form-control" >
					<!--<select class="form-control input-sm" name="username">
						<option value="<?=$library_risk['risk_input_by']?>"><?=$library_risk['risk_input_by_v']?></option>
					</select>-->
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Date Changed</label>
					<div class="col-md-9">
					<input type="text" class="form-control input-sm" readonly="true" name="date_changed" placeholder="" value="<?=$tanggal_submit['tanggal_submit']?>">
					</div>
				</div>
				
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-adduser-yes" type="button" 
			class="btn blue ladda-button button-form-adduser"
			 data-style="expand-right"
			>Yes</button>
		<button id="input-form-adduser-no" type="button" 
			class="btn blue ladda-button button-form-adduser"
			 data-style="expand-right"
			>No</button>
	</div>
</div>
<?php if(isset($modifyRisk)) { ?>
<script type="text/javascript">
	var g_risk_id = <?=$risk_id?>; 
	var risk_input_by = <?php echo "'".$risk_input_by."'"?> ;
</script>
<?php } ?>

<?php } ?>