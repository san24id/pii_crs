<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Change Request Action Plan Execution Prior View
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Change Request Action Plan Execution Prior View</a>
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
		<div class="col-md-2"></div><div class="col-md-8">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Action Plan Execution Prior Form Request
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
											<hr/>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Status  </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['execution_status']?>" placeholder="">
						</div>
					</div>
					<?php 
						$h1 = $h2 = '';
						$h3 = "";
						if ($action_plan['execution_status'] == 'COMPLETE') { 
							$h2 = 'style="display: none"';
						}
						else if ($action_plan['execution_status'] == 'ONGOING') { 
							$h2 = 'style="display: none"';
							$h3 = 'style="display: none"';
						}
						else {
							$h1 = 'style="display: none"';
							$h3 = 'style="display: none"';
						}
					?>
					<div class="form-group" <?=$h1?>>
						<label class="col-md-2 control-label smaller cl-compact">Explanation</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="execution_explain" placeholder=""><?=$action_plan['execution_explain']?></textarea>
						</div>
					</div>

					<div class="form-group" <?=$h3?>>
						<label class="col-md-2 control-label smaller cl-compact">Evidence</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="execution_evidence" placeholder=""><?=$action_plan['execution_evidence']?></textarea>
						</div>
					</div>
					<div class="form-group" <?=$h2?>>
						<label class="col-md-2 control-label smaller cl-compact">Reason</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="execution_reason" placeholder=""><?=$action_plan['execution_reason']?></textarea>
						</div>
					</div>
					<div class="form-group" <?=$h2?>>
						<label class="col-md-2 control-label smaller cl-compact">Revised Date</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm input-readview" name="revised_date1" readonly value="<?=$action_plan['revised_date_v']?>">
						</div>
					</div>			
						<div class="form-actions right">
							<a href="javascript:history.back()"><button type="button" class="btn yellow"><i class="fa fa-times"></i> Back</button></a>
						</div>
					</form>
				</div>	
			</div>
		</div>
		<!-- CHANGES FORM -->
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
