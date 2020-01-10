<?php error_reporting(0); ?>
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
						<input type="hidden" name="add_user_flag" value="" />
						<input type="hidden" name="add_user_username" value = "" />
						<input type="hidden" name="add_user_date_changed" value="" />

						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Submitted By</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" value="<?php echo $user; ?>" readonly="true" id="--primary-risk_submitted_by--" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk Code</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_code" placeholder="">
								<input type="hidden" name="risk_library_id" value=""/>
								</div>
							<!--</div>
							<div class="form-group">
								<input type="hidden" name="risk_library_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact">Library Risk ID</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
								</div>-->
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Event 
								</label>
								<div class="col-md-9">
								<textarea class="form-control input-sm input-readview" readonly="readonly" rows="3" name="risk_event" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" title="fill this field with decription of identified risk which explains nature of the risk">Risk Event Description </label>
								<div class="col-md-9">
								<textarea class="form-control popovers input-sm input-readview" readonly="readonly" rows="3" name="risk_description" placeholder="" data-container="body" data-placement="bottom" placeholder="" data-content=""></textarea>
								</div>
							</div>	
							<div class="form-group" style="display: none">
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
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk owner who is responsible in managing the activities that direcly related to the risk">Risk Owner</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="division_v" placeholder="">
								</div>
							</div>
							<h4>Objective</h4>
							<div class="table-scrollable">
								<table id="primary_objective_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">OB.ID</span></th>
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
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with risk category that related to identified risk as decribed in ‘Risk Description’ " >Risk Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_category" id="sel_risk_category1">
								</select>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category1">
								</select>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label small cl-compact" >Risk 2nd Sub Category</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category1">
								</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of set of factors that may affects or lead to the occurrence of risk event" >Cause </label>
								<div class="col-md-9">
								<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_cause" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of potential direct or indirect loss or cost to IIGF that could have been suffered from a risk event">Impact </label>
								<div class="col-md-9">
								<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_impact" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label smaller cl-compact">*Last Max Impact Level</label>
								<div class="col-md-9">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
										<tr role="row" class="heading">
												<th>Category</th>
												<th>Parameter</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($max_impact as $row) {?>
											<tr>
												<td><?php echo $row['impact_category']; ?></td>
												<td><?php echo $row['ref_value']; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
														
								</div>
							</div>

	<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "SELECT tt2.* FROM (SELECT t2.* FROM (SELECT a.* FROM t_risk_impact a INNER JOIN t_risk_impact_change b ON a.`impact_level` = b.`impact_level` AND a.`impact_id` = b.`impact_id` WHERE a.`risk_id` = '".$risk_id."' AND b.`risk_id` = '".$risk_id."' AND b.`switch_flag` = '".$risk_input_by."') t1 RIGHT JOIN t_risk_impact t2 ON t1.impact_id = t2.`impact_id` AND t1.impact_level = t2.`impact_level` WHERE t2.risk_id = '".$risk_id."' AND t1.impact_level IS NULL)tt1 JOIN m_risk_impact tt2 ON tt1.impact_id = tt2.`impact_id`";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$dsp_none = "";
		}else{
			$dsp_none = 'style="display: none;"';
		}

		?>

							<div class="form-group" <?php echo $dsp_none; ?>>
								<label class="col-md-3 control-label smaller cl-compact"></label>
								<div class="col-md-9">
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-dis_primary_impact"><i>Impact check</i></button>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with grading as describe in “Impact Category” (e.g. insignificant, minor, moderate, major, and catastrophic) after consideration to existing control effectiveness" >Impact Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="impact_level_v" placeholder="">
									<div class="input-group" style="display: none;">
										<input type="hidden" name="risk_impact_level_id" value=""/>
										<input type="text" style="width: 100%; height: 28px; padding-left: 10px;" readonly="true" name="risk_impact_level_value" placeholder="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field withthe grading criteria as described in “Likelihood of Risk Occurrence” table (e.g. very low, low, medium, high, and very high) after consideration to existing control effectiveness">Likelihood</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="likelihood_v" placeholder="">
									<div class="input-group" style="display: none;">
										<input type="hidden" name="risk_likelihood_id" value=""/>
										<input type="text" style="width: 100%; height: 28px; padding-left: 10px;" readonly="true" name="risk_likelihood_value" placeholder="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the grading criteria as described in “Risk Level” matrix (e.g. insignificant, minor, moderate, major, and catastrophic) based on defined value in ‘Likelihood’ and ‘Impact Level’">Risk Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level_v" placeholder="">
									<input type="hidden" class="form-control input-sm" readonly="true" name="risk_level" placeholder="">
								</div>
							</div>
							<hr/>
							<h4>Control</h4>
							<div class="table-scrollable">
								<table id="primary_control_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">EC.ID</span></th>
										<th><span class="small">Existing Control</span></th>
										<th><span class="small">Evaluation on Existing Control</span></th>		
										<th><span class="small">Control Owner</span></th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with treatment category as described in “Risk Treatment Guideline” based on its risk level">Suggested Risk Treatment</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="treatment_v" placeholder="">
									<div class="col-md-9" style="display: none;">
									<select class="form-control input-sm" name="suggested_risk_treatment" id="suggested_rt_primary">
									<?php foreach($treatment_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
								</div>
							</div>
							<hr/>
							<h4>Action Plan</h4>
							<div class="table-scrollable">
								<table id="primary_action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small"></span></th>
										<th><span class="small">AP.ID</span></th>
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
						<div class="form-actions">
					
							<button class="btn red" type="button" data-toggle="modal" href="#modal-delete"><i class="fa  fa-trash-o"></i> Delete</button>
							<input type="hidden" name="submit_mode" value="verifyRisk" />
							<button id="primary-risk-button-verify" type="button" class="btn blue" style="float: right;"><i class="fa fa-check-circle"></i>Verify</button>
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
								<input type="hidden" name="risk_library_id" value=""/>
								</div>
							<!--</div>
							<div class="form-group">
								<input type="hidden" name="risk_library_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact">Library Risk ID</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
								</div>-->
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Risk Event 
								</label>
								<div class="col-md-9">
								<textarea class="form-control input-sm" rows="3" name="risk_event" placeholder=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact" title="fill this field with decription of identified risk which explains nature of the risk">Risk Event Description </label>
								<div class="col-md-9">
								<textarea class="form-control popovers input-sm" rows="3" name="risk_description" placeholder="" data-container="body" data-placement="bottom" placeholder="" data-content=""></textarea>
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
									 			<th width="20%">OB.ID</th>
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
								<textarea class="form-control popovers input-sm" rows="3" name="risk_cause" placeholder="" data-container="body" data-trigger="focus" data-placement="bottom" data-content=""></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the description of potential direct or indirect loss or cost to IIGF that could have been suffered from a risk event" >Impact </label>
								<div class="col-md-9">
								<textarea class="form-control popovers input-sm" rows="3" name="risk_impact" placeholder="" data-container="body" data-trigger="focus" data-placement="bottom" data-content=""></textarea>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label smaller cl-compact">*Last Max Impact Level</label>
								<div class="col-md-9">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
										<tr role="row" class="heading">
												<th>Category</th>
												<th>Parameter</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($max_impact_change as $row) {?>
											<tr>
												<td><?php echo $row['impact_category']; ?></td>
												<td><?php echo $row['ref_value']; ?></td>
											</tr>
											<?php } ?>
											<tr>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="2"><font color="red">*) This data ate the 3 max of last impact level and will change shortly after you Save or Set As Primary</font> </td>
											</tr>
										</tbody>
									</table>					
								</div>
							</div>

	<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "SELECT tt2.* FROM (SELECT t2.* FROM (SELECT a.* FROM t_risk_impact a INNER JOIN t_risk_impact_change b ON a.`impact_level` = b.`impact_level` AND a.`impact_id` = b.`impact_id` WHERE a.`risk_id` = '".$risk_id."' AND b.`risk_id` = '".$risk_id."' AND b.`switch_flag` = '".$risk_input_by."') t1 RIGHT JOIN t_risk_impact t2 ON t1.impact_id = t2.`impact_id` AND t1.impact_level = t2.`impact_level` WHERE t2.risk_id = '".$risk_id."' AND t1.impact_level IS NULL)tt1 JOIN m_risk_impact tt2 ON tt1.impact_id = tt2.`impact_id`";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$dsp_none = "";
		}else{
			$dsp_none = 'style="display: none;"';
		}

		?>
							<div class="form-group" <?php echo $dsp_none; ?>>
								<label class="col-md-3 control-label smaller cl-compact"></label>
								<div class="col-md-9">
										<img src="<?php echo base_url(); ?>assets/images/legend/kri_red.gif"/>
										<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-dis_impact"><i>Impact check</i></button>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with grading as describe in “Impact Category” (e.g. insignificant, minor, moderate, major, and catastrophic) after consideration to existing control effectiveness" >Impact Level </label>
								<div class="col-md-9">
									<div class="input-group">
										<input type="hidden" name="risk_impact_level_id" value=""/>
										<input type="text" style="width: 100%; height: 28px; padding-left: 10px;" readonly="true" name="risk_impact_level_value" placeholder="">
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
										<input type="text" style="width: 100%; height: 28px; padding-left: 10px;" readonly="true" name="risk_likelihood_value" placeholder="">
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
										<th><span class="small">EC.ID</span></th>
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
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with treatment category as described in “Risk Treatment Guideline” based on its risk level" >Suggested Risk Treatment</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="suggested_risk_treatment" id="suggested_rt_change">
									<?php foreach($treatment_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<hr/>
	<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select suggested_risk_treatment, created_date from t_risk_change
				where risk_id = '".$risk_id."' and risk_input_by = '$risk_input_by'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$hasil = $query->row();
			$suggested = $hasil->suggested_risk_treatment;
			$created = $hasil->created_date;
			
		}

		$sql2 = "select suggested_risk_treatment, created_date from t_risk
				where risk_id = '".$risk_id."'";
		$query2 = $this->db->query($sql2);
		if ($query2->num_rows() > 0){
			$hasil2 = $query2->row();
			$suggested2 = $hasil2->suggested_risk_treatment;
			$created2 = $hasil2->created_date;
			
		}

	?>
		<input type="hidden" name="suggetchange" value="<?php echo $suggested; ?>" id="sgrt">
		<input type="hidden" name="suggetprimary" value="<?php echo $suggested2; ?>">
							<div class="clearfix" id="btnaction">
								<a href="#form-data" id="button-form-data-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Suggestion Action Plan </span>
								</a>
								<h4>Action Plan</h4>
							</div>
							
							<div class="table-scrollable">
								<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small"></span></th>
										<th><span class="small">AP.ID</span></th>
										<th><span class="small">Suggested Action Plan</span></th>
										<th><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
										<th width="30px">&nbsp;</th>
									</tr>
									</thead>
									<tbody id="action_plan_form">
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
						<label class="col-md-3 control-label smaller cl-compact">OB.ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="hidden" class="form-control input-sm" readonly="true" name="objective_id" id = "objective_id" placeholder="">
								<input type="text" class="form-control input-sm" readonly="true" name="objid" id = "objid" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-objective"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Objective <span class="required">* </span></label>
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
			<br /><br />
			 <span style="color:#035CFF"><p align="left"><i>Note : <br/>If you select menu Not Available then data Existing Control will be reset</i></p></span>
	</div>
</div>

<!-- CONTROL Available -->
<div id="form-control" class="modal fade" tabindex="-1" data-width="800" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Control</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type = "hidden" id = "form-control-revid">
						<label class="col-md-3 control-label smaller cl-compact">EC.ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="hidden" class="form-control input-sm" readonly="true" name="control_id" id = "control_id" placeholder="">
								<input type="text" class="form-control input-sm" readonly="true" name="ec_id" id = "ec_id" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Existing Control <span class="required">* </span></label>
						<div class="col-md-9">
						<textarea class="form-control input-sm" value="" rows="3" name="risk_existing_control" id = "risk_existing_control"  placeholder=""></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the effectiveness level of existing control (refers to control assessment criteria)">Evaluation on Existing Control <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_evaluation_control" id = "risk_evaluation_control" placeholder="" value="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control-existing"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the assigned person who is responsible for the business unit, which owns the controls associated with the risk event">Control Owner <span class="required">* </span></label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="risk_control_owner" id = "risk_control_owner">
										<option value="">Choose One</option>
										<?php foreach($division_list as $row) { ?>
										<option value="<?=$row['ref_key']?>" data-control="<?=$row['ref_value']?>"><?=$row['ref_value']?></option>
										<?php } ?>
						</select>
						<input type="hidden" class="form-control input-sm" name="control_owner" id="control_owner" placeholder="">
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
									<label class="col-md-3 control-label">Control</label>
									<div class="col-md-6">
										<input type="text" class="form-control input-sm" value="Not Available">
									</div>
								</div>
								<input type="hidden" class="form-control input-sm" readonly="true" name="control_id_n" placeholder="">
								<input type="hidden" class="form-control input-sm" readonly="true" name="ec_id_n" value="1" placeholder="">
								<input type="hidden" id = "form-control-revid-3">
								<input type="hidden" class="form-control input-sm" readonly="true" name="risk_existing_control_n" value="Not Available">
								<input type="hidden" class="form-control input-sm" readonly="true" name="risk_evaluation_control_n" value="Not Available">
								<input type="hidden" class="form-control input-sm" readonly="true" name="risk_control_owner_n" value="Not Available">
								<input type="hidden" class="form-control input-sm" readonly="true" name="control_owner_n" value="Not Available" placeholder="">
								
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
		<h4 class="modal-title">Add Suggestion Action Plan</h4>
	</div>
	<div class="modal-body">
			<input type="hidden"   id = "form-data-revid"  > 
			<form id="input-form-action-plan" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact">AP.ID</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="id_ap" id = "id_ap" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-libraryaction"><i class="fa fa-search fa-fw"/></i></button>
								</span> 	
							</div>
						</div>
					</div>
									
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Suggested Action Plan</label>
						<div class="col-md-9">
							
								<textarea class="form-control input-sm " rows="3"  name="action_plan" id = "action_plan" placeholder=""> </textarea>
								<!--
								<input type="text" class="form-control input-sm" name="action_plan" id = "action_plan" placeholder=""> 
								-->
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date <span class="required">* </span></label>
						<div class="col-md-9">
						<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
						<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 &nbsp;Continuous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="due_date" id = "due_date" placeholder="select date" readonly>
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Action Plan Owner <span class="required">* </span></label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="division" id = "division">
							<option value="">Choose One</option>
							<?php foreach($division_list as $row) { ?>
								<option value="<?=$row['ref_key']?>" data-action="<?=$row['ref_value']?>"><?=$row['ref_value']?></option>
							<?php } ?>
						</select>
							<input type="hidden" class="form-control input-sm" name="division_v" id="division_v" placeholder="">
							<input type="hidden" class="form-control input-sm" name="execution_status" id="execution_status">
							<input type="hidden" class="form-control input-sm" name="execution_explain" id="execution_explain">
							<input type="hidden" class="form-control input-sm" name="execution_evidence" id="execution_evidence">
							<input type="hidden" class="form-control input-sm" name="execution_reason" id="execution_reason">
							<input type="hidden" class="form-control input-sm" name="revised_date" id="revised_date">
							<input type="hidden" class="form-control input-sm" name="existing_control_id" id="existing_control_id">
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
			 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box 
<br/>If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>
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
					<th width="66px">&nbsp;</th>
					<th>AP.ID</th>
					<th>Action Plan</th>
					<th>Due Date</th>
					<th>Division</th> 
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
					<th width="66px">&nbsp;</th>
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
	</div>
	<div class="modal-body">
		<div>
			<table id="library_control_table_existing" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
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
					<th width="66px">&nbsp;</th>
					<th>EC.ID</th>
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

<!-- OBJECTIVE search Library -->
<div id="modal-objective" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Objective</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit-objective">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_objective_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>OB.ID</th>
					<th>Objective</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
<!--
<tr>
	<td>
	<div class="btn-group">
		<button type="button" class="btn btn-default btn-xs"><i class="fa fa-check-circle font-blue"></i></button>
	</div>
	</td>
	<td>CID-01</td>
	<td>Existing ControlDescription</td>
</tr>
-->

<!-- IMPACT LEVEL -->
<div id="modal-impact" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Impact</h4>
		<span class="font-red">* Choose one(1) or more from category, but one(1) category only have one(1) parameter</span>
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
		<span class="font-red">* Choose One</span>
	</div>
	<div class="modal-body">
		<form id="form-likelihood">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>&nbsp;</th>
				<th width="250px">Likelihood of risk occurrence</th>
				<th>Description</th>
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

<!--DELETE-->
<div id="modal-delete" class="modal fade" tabindex="-1" data-width="550" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Same from Input By Id</h4>
		<div class="inputs">
		</div>
	</div>
	<div class="modal-body">
		<div>
		"Are you sure want to delete this risk ?"
		<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select GROUP_CONCAT(risk_input_by SEPARATOR ' | ') as risk_input_by from t_risk_change
				where risk_id = '".$risk_id."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$hasil = $query->row();
			$risk_by = $hasil->risk_input_by;
			
			echo "<br/>The risk also listed in risk register for following username: &nbsp;".$risk_by;	
		}
	?>
		<hr />
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="risk-button-delete" type="button" class="btn red"></i> YES</button>
		</div>
	</div>
</div>

<div id="modal-dis_impact" class="modal fade" tabindex="-1" data-width="560" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Impact List</h4>
	</div>
	<div class="modal-body">
		<form id="form-likelihood">
		<table  class="table table-condensed table-bordered table-hover">
			<thead>
				<tr role="row" class="heading">
					<th>Category</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($dff_impact as $row) {?>
						<tr>
							<td><?php echo $row['impact_category']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
		</table>
		</form>
		
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
	</div>
</div>


<div id="modal-dis_primary_impact" class="modal fade" tabindex="-1" data-width="560" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Impact List</h4>
	</div>
	<div class="modal-body">
		<form id="form-likelihood">
		<table  class="table table-condensed table-bordered table-hover">
			<thead>
				<tr role="row" class="heading">
					<th>Category</th>
					<th>Parameter</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($dff_impact_pri as $row) {?>
						<tr>
							<td><?php echo $row['impact_category']; ?></td>
							<td><?php echo $row['impact_level']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
		</table>
		</form>
		
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
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
					<input type="hidden" name="add_user_flag" id="add_user_flag" />
					<label class="col-md-3 control-label">Submitted By</label>
					<div class="col-md-9">
					<input type = "text" name = "add_user_username" readonly="true" value = "<?=$risk_input_by?>" id = "add_user_username" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Date Changed</label>
					<div class="col-md-9">
					<input type="text" class="form-control input-sm" readonly="true" name="add_user_date_changed" placeholder="" value="<?php if($tanggal_submit['tanggal_submit'] == NULL){
						echo substr($created,0,10); }else{ echo $tanggal_submit['tanggal_submit']; }?>">
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