<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Action Plan Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Risk Owner Form</a>
				</li>
			</ul>
		</div>
		<div class="row">
		<!-- END PAGE HEADER-->
		<?php if ($valid_mode) { ?>
		<script type="text/javascript">
			var g_username = null;
		</script>


	<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$status = $_GET['status'];
	$id = $action_plan['change_id'];
	//$username = $this->session->credential['username'];
	$this->load->database();
	 ?>
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						PRIMARY
					</div>
				</div>
				
				<div class="portlet-body form">
					<form role="form" class="form-horizontal">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-9">
									<input type="hidden" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['risk_data']['risk_code']?>" placeholder="">
								</div>
							</div>
							
							<hr/>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">AP ID</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Action Plan</label>
								<div class="col-md-9">
								<textarea class="form-control input-readview" readonly="true" rows="3" placeholder=""><?=$action_plan['action_plan']?></textarea>
								<!--
								<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['action_plan']?>" placeholder="">
								-->
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
								<div class="col-md-9">
								<?php 
									if($action_plan['due_date_v'] == '00-00-0000'){
								?>
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="Continuous" placeholder="">
								<?php 
									}else{
								?>
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['due_date_v']?>" placeholder="">
								<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['division_v']?>" placeholder="">
								</div>
							</div>
						</div>
						<div class="form-actions right">
							<button id="primary-risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Approve</button>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<!-- CHANGES FORM -->
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						CHANGES
					</div>
				</div>
				
				<div class="portlet-body form">
					<form role="form" id="input-form" class="form-horizontal">
					<input type="hidden" id="action-plan-id" value="<?=$action_plan['change_id']?>" name="id" placeholder="">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-9">
									<input type="hidden" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['risk_data']['risk_code']?>" name="risk_code" placeholder="">
								</div>
							</div>
							<hr/>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact">AP ID</label>
								<div class="col-md-9">
								<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" name="act_code" placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Action Plan</label>
								<div class="col-md-9">
									<textarea class="form-control input-readview"  rows="3" placeholder="" name="action_plan"><?=$action_plan['change_data']['action_plan']?></textarea>
								<!--
									<input type="text" class="form-control input-sm input-readview" value="<?=$action_plan['change_data']['action_plan']?>" name="action_plan" placeholder="">
								-->
								</div>
							</div>
							<div class="form-group">
									<label class="col-md-2 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<?php 
											if($action_plan['change_data']['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="button" style="width: 20px; height: 20px;" onclick="Check2()" id="ckc2"/>
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd2()" id="kcc2"/>
						 					&nbsp;Continous&nbsp;<span id="checked2"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate2">
										<?php }else{ ?>
											<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 					&nbsp;Continous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
										<?php } ?>
									
										<?php 
											if($action_plan['change_data']['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm"  id = "due_date" readonly value="Continuous" placeholder="select date">
											<input type="hidden" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan['change_data']['due_date_v']?>">
										<?php }else{ ?>

											<input type="text" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan['change_data']['due_date_v']?>" placeholder="select date">
										<?php } ?>
										<span class="input-group-btn">
										<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
									</div>
								</div>
							<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner</label>
								<div class="col-md-9">
								<select class="form-control input-sm" name="division">
									<?php foreach($division_list as $row) { ?>
									<option value="<?=$row['ref_key']?>" <?=$row['ref_key'] == $action_plan['change_data']['division'] ? 'SELECTED' : '' ?>><?=$row['ref_value']?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							<input type="hidden" class="form-control input-sm input-readview" name="id_c" readonly="true" value="<?=$action_plan['id_ap']?>" placeholder="">
							<input type="hidden" class="form-control input-sm input-readview" name="action_plan_c" readonly="true" value="<?=$action_plan['action_plan']?>" placeholder="">
							<input type="hidden" class="form-control input-sm input-readview" name="due_date_c" readonly="true" value="<?=$action_plan['due_date']?>" placeholder="">
							<input type="hidden" class="form-control input-sm input-readview" name="division_c" readonly="true" value="<?=$action_plan['division']?>" placeholder="">
							<br/>
							 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box 
<br/>If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>
						</div>
						<div class="form-actions right">
							<button id="changes-risk-set-as-primary" type="button" class="btn blue"><i class="fa fa-arrows-h"></i> Set As Primary</button>
							<button id="changes-risk-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save</button>
							<button type="button" class="btn yellow" id="changes-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
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
				<h4 class="block">Error</h4>
				<p>
					 You are not allowed to view this Risk
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
