<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Change Request Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Change Request Form</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<?php if ($valid_entry) { ?>
		<h4>Changes In : <?=$change_type?> -  <?=$change_code?></h4>
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
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk ID</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_event" placeholder=""></textarea>
									</div>
								</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact">Risk Event Description</label>
								<div class="col-md-9">
								<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_description" placeholder=""></textarea>
								</div>
							</div>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Delete Risk') { ?>
							<h4>Objective</h4>
							<div class="table-scrollable">
								<table id="primary_objective_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="15%"><span class="small">Obj.ID</span></th>
										<th><span class="small">Objective</span></th>
										
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							
							<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Cause </label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_cause" placeholder=""></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Impact </label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_impact" placeholder=""></textarea>
									</div>
								</div>
							
							<?php } ?>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Impact Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="impact_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Likelihood</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="likelihood_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Suggested Risk Treatment</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" name="treatment_v" placeholder="">
								</div>
							</div>
							<hr/>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Delete Risk') { ?>
							
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
							<?php } ?>
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
						<?php if ($change_type != 'Delete Risk') { ?>
							<a href="#form-info-modal" id="" data-toggle="modal" class="btn blue">Risk information</a>
							<button id="primary-risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Approve</button>
						<?php } ?>
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
						<input type="hidden" name="id" value="" />
						
						<div class="form-body">
							<div class="form-group">
								<input type="hidden" name="risk_id" value=""/>
								<label class="col-md-3 control-label smaller cl-compact" >Risk ID</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_code" placeholder="">
								</div>
							</div>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Delete Risk') { ?>
							<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview"  rows="3" name="risk_event" placeholder=""></textarea>
									</div>
								</div>
					
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact">Risk Event Description</label>
								<div class="col-md-9">
								<textarea class="form-control" rows="3"  name="risk_description" placeholder=""></textarea>
								</div>
							</div>

							<div class="clearfix">
								<a href="#form-control-objective" id="button-form-control-open-objective" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Objective </span>
								</a>
								<h4>Objective</h4>
							</div>
							<div class="table-scrollable">
								<table id="objective_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="15%"><span class="small">Obj.ID</span></th>
										<th><span class="small">Objective</span></th>
										<th width="66px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<?php }else{ ?>
							<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview"  readonly="true" rows="3" name="risk_event" placeholder=""></textarea>
									</div>
								</div>
					
							<div class="form-group">
								<label class="col-md-3 control-label small cl-compact">Risk Event Description</label>
								<div class="col-md-9">
								<textarea class="form-control input-readview" readonly="true" rows="3"  name="risk_description" placeholder=""></textarea>
								</div>
							</div>
							<?php } ?>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Delete Risk') { ?>
							<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Cause </label>
									<div class="col-md-9">
									<textarea class="form-control input-readview"  rows="3" name="risk_cause" placeholder=""></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Impact </label>
									<div class="col-md-9">
									<textarea class="form-control input-readview"  rows="3" name="risk_impact" placeholder=""></textarea>
									</div>
								</div>

							
							<?php } ?>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Risk Owner Form' || $change_type == 'Delete Risk') { ?>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Impact Level</label>
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
								<label class="col-md-3 control-label smaller cl-compact" >Likelihood </label>
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
								<label class="col-md-3 control-label smaller cl-compact" >Risk Level </label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_level" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Suggested Risk Treatment</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="suggested_risk_treatment" id="suggested_rt">
									<?php foreach($treatment_list as $row) { ?>
									<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<?php } else { ?>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Impact Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="impact_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Likelihood</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="likelihood_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Risk Level</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="risk_level_v" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" >Suggested Risk Treatment</label>
								<div class="col-md-9">
									<input type="text" class="form-control input-sm" readonly="true" name="treatment_v" placeholder="">
								</div>
							</div>
							<?php } ?>
							<hr/>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Delete Risk') { ?>
							<!--
							<div class="clearfix">
								<a href="#form-control-objective" id="button-form-control-open-objective" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Objective </span>
								</a>
								<h4>Objective</h4>
							</div>
							<div class="table-scrollable">
								<table id="objective_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th width="15%"><span class="small">Obj.ID</span></th>
										<th><span class="small">Objective</span></th>
										<th width="66px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr/>
							-->
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
										<th><span class="small">Evaluation on Existing Control</span></th>
										<th><span class="small">Existing Control</span></th>
										
										<th><span class="small">Control Owner</span></th>
										<th width="66px">&nbsp;</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<hr/>
							<?php } ?>
							<?php if ($change_type == 'Risk Form' || $change_type == 'Risk Owner Form' || $change_type == 'Delete Risk') { ?>
			<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select suggested_risk_treatment from t_cr_risk_change
				where risk_id = '".$risk_id."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
			$hasil = $query->row();
			$suggested = $hasil->suggested_risk_treatment;
			
		}

	?>
		<input type="hidden" value="<?php echo $suggested; ?>" id="sgrt" />	
							<div class="clearfix">
							<span id="btnaction">
								<a href="#form-data" id="button-form-data-open" data-toggle="modal" class="btn default green pull-right btn-sm">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
								Add Suggestion Action Plan </span>
								</a>
							</span>
								<h4>Action Plan</h4>
							</div>
							<?php } else { ?>
							<h4>Action Plan</h4>
							<?php } ?>
							<div class="table-scrollable">
								<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Suggested Action Plan</span></th>
										<th width="80px"><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
										<th width="70px">&nbsp;</th>
									</tr>
									</thead>
									<tbody id="action_plan_form">
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-actions right">
						<?php if ($change_type == 'Delete Risk') { ?>
							<button type="button" class="btn red" id="primary-risk-button-delete"><i class="fa fa-times"></i> Delete</button>
							<button type="button" class="btn yellow" id="changes-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
						<?php }else{?>
						<!--	<button id="changes-risk-set-as-primary" type="button" class="btn blue"><i class="fa fa-arrows-h"></i> Set As Primary</button> -->
						<!--	<button id="changes-risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Approve</button> -->
							<button id="changes-risk-button-save" type="button" class="btn blue"><i class="fa fa-arrows-h"></i> Set As Primary</button>
							<button id="changes-risk-button-save-changes" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
							<button type="button" class="btn yellow" id="changes-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
						<?php }?>
						</div>

					</form>
				</div>
			</div>
		</div>
		</div>
		<?php } else { ?>
		<div class="row">
		<div class="col-md-12">
			<div class="note note-warning">
			<h4 class="block">Error</h4>
			<p>
				 Cannot Input Change Request for this Risk, This Risk already have a Pending Change Request 
			</p>
			<p>
				<a class="btn red" target="_self" href="<?=$site_url?>/main">
				Back to Home </a>
			</p>
			</div>
		</div>
		</div>
		<?php } ?>
	</div>
</div>

<?php if ($valid_entry) { ?>
<script type="text/javascript">
	var g_risk_id = <?=$risk_id?>;
	var g_change_id = <?=$change_id?>;
	var g_username = null;
	var g_change_type = '<?=$change_type?>';
</script>

<!-- Change Info -->
<div id="form-info-modal" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk information</h4>
	</div>
	<div class="modal-body">

			<div class="table-scrollable">
								<table id="" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th ><span class="small">Risk Status</span></th>
										<th><span class="small">Risk Event</span></th>
										<th><span class="small">Risk Event Description</span></th>
										<th><span class="small">Cause</span></th>
										<th><span class="small">Impact</span></th>
										<th><span class="small">Impact Level</span></th>
										<th><span class="small">likelihood</span></th>
										<th><span class="small">Risk Level</span></th>
										<th><span class="small">Suggested Risk Treatment</span></th>
										
									</tr>
									<tr>
										<td>
				<?php 
			 	if ($status['risk_status'] == 0 || $status['risk_status'] == 1 ){
			 	echo "Draft";
			 	}else if ($status['risk_status'] == 2){
			 	echo "Submited To RAC";
			 	}else if ($status['risk_status'] == 3 || $status['risk_status'] == 4){
			 	echo "Verified By RAC";
			 	}else if ($status['risk_status'] == 5 || $status['risk_status'] == 6){
			 	echo "on Risk Treatment Process";
			 	}else if ($status['risk_status'] == 10){
			 	echo "on Action Plan Process";
			 	}else if ($status['risk_status'] == 20){
			 	echo "Action Plan Has Been Executed and Verified";
			 	}
			  	?>
										</td>
										<td><?php echo $status['risk_event'];?></td>
										<td><?php echo $status['risk_description'];?></td>
										<td><?php echo $status['risk_cause'];?></td>
										<td><?php echo $status['risk_impact'];?></td>
										<td><?php echo $status['risk_impact_level'];?></td>
										<td><?php echo $status['risk_likelihood_key'];?></td>
										<td><?php echo $status['risk_level'];?></td>
										<td><?php echo $status['suggested_risk_treatment'];?></td>
										
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								
							</div>
							<div class="table-scrollable">
							<table id="" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th><span class="small">Action Plan Status</span></th>
										<th><span class="small">Suggested Action Plan</span></th>
										<th><span class="small">Due Date</span></th>
										<th><span class="small">Action Plan Owner</span></th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($status_action as $row) {
									?>
										<tr>
										<td>
				<?php 
			 	if ($status['risk_status'] == 4){
			 	echo "Draft";
			 	}else if ($status['risk_status'] == 5){
			 	echo "Submited To RAC";
			 	}else if ($status['risk_status'] == 6){
			 	echo "Verified By RAC ";
			 	}
			  	?>
										</td>
										<td><?php echo $row['action_plan'];?></td>
										<td><?php echo $row['due_date'];?></td>
										<td><?php echo $row['division'];?></td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
	</div>
</div>
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
						<textarea class="form-control input-sm " rows="3"  name="objective" id = "objective" placeholder="">NONE</textarea>
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
<!-- CONTROL -->
<div id="form-control" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Control</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control" role="form" class="form-horizontal">
			<input type = "hidden" id = "tc_idnya">
				<div class="form-body">
					<div class="form-group">
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
						<label class="col-md-3 control-label smaller cl-compact">Evaluation on Existing Control </label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_existing_control" id = "risk_existing_control" placeholder="" value="NONE">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-control-existing"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<!--
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Existing Control </label>
						<div class="col-md-9">
						<textarea class="form-control input-sm" rows="3" name="risk_existing_control" placeholder=""></textarea>
						<button id="button_clear_control" type="button" class="hide btn red btn-xs" style="margin-top: 5px;"><i class="fa fa-minus-circle font-white"></i> Clear Existing Control</button>
						</div>
					</div>
					-->
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Existing Control </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="risk_evaluation_control" id = "risk_evaluation_control" placeholder="" value="NONE">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Control Owner </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="risk_control_owner" id = "risk_control_owner" placeholder="" value="NONE">
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

<!-- ACTION PLAN -->
<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Assigned Action Plan</h4>
	</div>
	<div class="modal-body">
		<input type = "hidden" id = "tr_idnya2" >
			<form id="input-form-action-plan" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type = "hidden" id = "form-data-revid">
						<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
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
						<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="division" id ="division">
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
			 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box<br/> If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>

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
					<th>Objective</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- LIBRARY ACTION-->
<div id="modal-libraryaction" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Assigned Action Plan Library</h4>
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
					<th>Action Plan</th> 
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
					<th>Evaluation on Existing Control</th>
					<th>Existing Control</th>
					
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
<?php } ?>