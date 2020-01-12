<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Change Request Action Plan Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">View Action Plan</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<?php if ($valid_mode) { 
				if($action_plan['existing_control_id'] == 1){?>
		<!-- ERROR RISK REGISTER MODE -->
		<div class="row">
		<div class="col-md-12">
			<div class="note note-danger">
				<h4 class="block">Error</h4>
				<p>
					 You are not allowed to view this Action Plan
				</p>
				<p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Back to Home </a>
				</p>
			</div>
		</div>
		</div>
		<?php }else{?>
		<div class="row">
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Action Plan Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
					<input type="hidden" name="risk_id" value="<?=$risk['risk_id']?>" />
					<input type="hidden" id="form-action-id" name="action_id" value="<?=$action_plan['id_ap']?>" />
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">AP ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan_change['act_code']?>" placeholder="">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
									<div class="col-md-9">
										<textarea class="form-control input-sm input-readview" value="" readonly="true" name="action_plan"><?=$action_plan_change['action_plan']?></textarea>
										<!--
										<input type="text" class="form-control input-sm input-readview" value="<?//=$action_plan_change['action_plan']?>" name="action_plan" placeholder="">
										-->
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<div class="input-group input-medium">
										<?php 
											if($action_plan_change['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm input-readview" readonly value="Continuous">
											<input type="hidden" class="form-control input-sm input-readview" name="due_date" readonly value="<?=$action_plan_change['due_date_v']?>">
										<?php }else{ ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" readonly value="<?=$action_plan_change['due_date_v']?>">
										<?php } ?>
									</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" name="division" value="<?=$action_plan_change['division_v']?>">
									</div>
								</div>
								
							</div>
							
							</div>
						</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Changed Action Plan
					</div>
				</div>
				
				<div class="portlet-body form">
					<div class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">AP ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan_change['act_code']?>" placeholder="">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
									<div class="col-md-9">
										<textarea class="form-control input-sm input-readview" value="" name="action_plan"><?=$action_plan_change['action_plan']?></textarea>
										<!--
										<input type="text" class="form-control input-sm input-readview" value="<?//=$action_plan_change['action_plan']?>" name="action_plan" placeholder="">
										-->
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<?php 
											if($action_plan_change['due_date_v'] == '00-00-0000'){
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
											if($action_plan_change['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm"  id = "due_date" readonly value="Continuous" placeholder="select date">
											<input type="hidden" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan_change['due_date_v']?>">
										<?php }else{ ?>

											<input type="text" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan_change['due_date_v']?>" placeholder="select date">
										<?php } ?>
										<span class="input-group-btn">
										<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="division">
										<?php foreach($division_list as $row) { ?>
										<option value="<?=$row['ref_key']?>" <?=$row['ref_key'] == $action_plan_change['division'] ? 'SELECTED' : '' ?>><?=$row['ref_value']?></option>
										<?php } ?>
									</select>
									</div>
								</div>
								
							</div>
							
							</div>
							<br/>
							 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box 
<br/>If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>
						</div>
						<div class="form-actions right">
							<button id="risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Request</button>
							<button type="button" class="btn yellow" id="risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
							</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<?php }} else { ?>
		<!-- ERROR RISK REGISTER MODE -->
		<div class="row">
		<div class="col-md-12">
			<div class="note note-danger">
				<h4 class="block">Error</h4>
				<p>
					 You are not allowed to view this Action Plan
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