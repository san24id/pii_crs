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
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<?php if ($valid_mode) { ?>
		<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="">
						Risk Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="row">
								<input type="hidden" id="id_im" value="<?=$id_im?>">
							<div class="col-md-6">	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Submitted By</label>
									<div class="col-md-9">
									<input type="hidden" class="form-control input-sm" name="risk_input_by" id="risk_input_by" placeholder="">
									<input type="text" class="form-control input-sm" readonly="true" id="risk_submitted_by" placeholder="">
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the grading criteria as described in “Risk Level” matrix (e.g. insignificant, minor, moderate, major, and catastrophic) based on defined value in ‘Likelihood’ and ‘Impact Level’" >Risk Status </label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="risk_status" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="risk_id" value=""/>
									<label class="col-md-3 control-label smaller cl-compact">Risk ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_code']?>" placeholder="">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" placeholder=""><?=$risk['risk_event']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event Description</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3"  placeholder=""><?=$risk['risk_description']?></textarea>
									</div>
								</div>
								
								<div class="panel-body">
									 <div class="clearfix">
									 </div>
									 
									 <div class="table-scrollable">
										<table class="table table-condensed table-bordered table-hover">
										<thead>
											<tr role="row" class="heading">
												<th width="15%">OB. ID</th>
												<th>Objective</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($risk['objective_list'] as $k => $row) { ?>
											<tr>
												<td><?php echo 'OB.'.$row['objid']; ?></td>
												<td><?=$row['objective']?></td>
											</tr>
											<?php } ?>
										</tbody>
										</table>
									 </div>
								</div>							
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_category_v']?>" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_sub_category_v']?>" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk 2nd Sub Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_2nd_sub_category_v']?>" placeholder="">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Owner</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_owner_v']?>" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Cause</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" placeholder=""><?=$risk['risk_cause']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Impact</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" placeholder=""><?=$risk['risk_impact']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with grading as describe in “Impact Category” (e.g. insignificant, minor, moderate, major, and catastrophic) after consideration to existing control effectiveness">Impact Level </label>
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
							</div>
							</div>
							<div class="clearfix">
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Control</h3>
								</div>
								<div class="panel-body">
									 <div class="clearfix">

									 </div>
									 
									 <div class="table-scrollable">
									 	<table class="table table-condensed table-bordered table-hover">
									 		<thead>
									 		<tr role="row" class="heading">
									 			<th>EC.ID</th>
									 			<th>Existing Control</th>
									 			<th>Evaluation on Existing Control</th>
									 			
									 			<th>Control Owner</th>
									 			<th width="30px">&nbsp;</th>
									 		</tr>
									 		</thead>
											<tbody>
												<?php foreach($risk['control_list'] as $k => $row) { ?>
												<tr>
													<td><?php echo 'EC.'.$row['ec_id']?></td>
													<td><?=$row['risk_existing_control']?></td>
													<td><?=$row['risk_evaluation_control']?></td>
													<td><?=$row['control_owner']?></td>
												</tr>
												<?php } ?>
								</tbody>
									 	</table>
									 </div>
								</div>
							</div>
	<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select suggested_risk_treatment, risk_status from t_risk
				where risk_id = '".$risk_id."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$hasil = $query->row();
			$suggested2 = $hasil->suggested_risk_treatment;
			$status = $hasil->risk_status;		
		}

		if($status == 20){
			echo "<div class='form-group'>
				  <div class='panel panel-default'>";
		}else{
	?>
							<div class="form-group">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-2 control-label smaller cl-compact" >Suggested Risk Treatment</label>
									<div class="col-md-3">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['treatment_v']?>" placeholder="">
									</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Action Plan<font style="color:red;">*</font></h3>
								</div>
								<div class="panel-body">

		<input type="hidden" value="<?php echo $suggested2; ?>" id="sgrt2">
								<span class="btnactionc">
									<div class="clearfix">
									 </div>
								</span>
									 
									<div class="table-scrollable">
										<table class="table table-condensed table-bordered table-hover">
											<thead>
											<tr role="row" class="heading">
												<th>AP.ID</th>
												<th>Suggested Action Plan</th>
												<th>Due Date</th>
												<th>Action Plan Owner</th>
												<th width="66px">&nbsp;</th>
											</tr>
											</thead>
											<tbody>
												<?php foreach($risk['action_plan_list'] as $k => $row) { ?>
												<tr>
													<td><?php echo 'AP.'.$row['id_ap']?></td>
													<td><?=$row['action_plan']?></td>
												<?php 
													if($row['due_date_v'] == '00-00-0000'){
													$row['due_date_v'] = 'continuous';
													}
												?>
												<td><?=$row['due_date_v']?></td>
												<td><?=$row['division_v']?></td>
												</tr>
										<?php } ?>
									</tbody>
										</table>
										<!--
										<tr>
											<td>Action</td>
											<td>Date</td>
											<td>PIC</td>
											<td>
											<div class="btn-group">
												<button type="button" class="btn btn-default btn-xs"><i class="fa fa-minus-circle font-red"></i></button>
											</div>
											</td>
										</tr>
										-->
									</div>
							<?php } ?>
								</div>
							</div>

						</div>
						<div class="form-actions right">
						<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$status = $_GET['status'];
		?>
							<input type="hidden" name="submit_mode" value="verifyRisk" />
							<button id="risk-likelihood_edit" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
							<button type="button" class="btn yellow" id="risk-likelihood_cancel"><i class="fa fa-times"></i> Cancel</button>
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
<?php if(isset($modifyRisk)) { ?>
<script type="text/javascript">
	var g_risk_id = <?=$risk_id?>;
	var g_username = null;
	var id_l = <?=$id_l?>;
</script>
<?php } ?>

<?php } ?>