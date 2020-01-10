<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Change Request Action Plan Execution Form
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
		<?php if ($valid_mode) { ?>
			<script type="text/javascript">
			var g_risk_id = <?=$risk['id_ap']?>;
			var g_username = null;
		</script>
		<div class="row">
		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Action Plan Execution Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form role="form" id="input-form" class="form-horizontal">
						<input type="hidden" id="action-plan-id" value="<?=$action_plan['id_ap']?>" name="action_id" placeholder="">
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
							
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">AP ID</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Assigned Action Plan</label>
						<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" rows="4" value="" readonly="true"><?=$action_plan['action_plan']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Due Date</label>
						<div class="col-md-9">
										<?php 
											if($action_plan['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm input-readview"  id = "due_date" readonly value="Continuous">
										<?php }else{ ?>
											<input type="text" class="form-control input-sm input-readview"  id = "due_date" readonly value="<?=$action_plan['due_date_v']?>">
										<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Action Plan Owner</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['division_v']?>" placeholder="">
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
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3"  placeholder=""><?=$action_plan['execution_explain']?></textarea>
						</div>
					</div>

					<div class="form-group" <?=$h3?>>
						<label class="col-md-2 control-label smaller cl-compact">Evidence</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3"  placeholder=""><?=$action_plan['execution_evidence']?></textarea>
						</div>
					</div>
					<div class="form-group" <?=$h2?>>
						<label class="col-md-2 control-label smaller cl-compact">Reason</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3"  placeholder=""><?=$action_plan['execution_reason']?></textarea>
						</div>
					</div>
					<div class="form-group" <?=$h2?>>
						<label class="col-md-2 control-label smaller cl-compact">Revised Date</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm input-readview" readonly value="<?=$action_plan['revised_date_v']?>">
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
						Changed Action Plan Execution
					</div>
				</div>
				
				<div class="portlet-body form">
					<div class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
					
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">AP ID</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Assigned Action Plan</label>
						<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" rows="4" value="" readonly="true" name="action_plan"><?=$action_plan['action_plan']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Due Date</label>
						<div class="col-md-9">
										<?php 
											if($action_plan['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm input-readview" id = "due_date" readonly value="Continuous">
											<input type="hidden" class="form-control input-sm input-readview" name="due_date" id = "due_date" readonly value="<?=$action_plan['due_date_v']?>" />
										<?php }else{ ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" id = "due_date" readonly value="<?=$action_plan['due_date_v']?>">
										<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Action Plan Owner</label>
						<div class="col-md-9">
							<input type="text" class="form-control input-sm input-readview"  readonly="true" value="<?=$action_plan['division_v']?>" placeholder="">
							<input type="hidden" class="form-control input-sm input-readview"  readonly="true" name="division" value="<?=$action_plan['division']?>" placeholder="">
						</div>
					</div>
					<hr/>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Status  </label>
						<div class="col-md-9">
					
						<select class="form-control input-sm" name="execution_status" id="exec-select-status">
							<option value="COMPLETE" <?=$action_plan['execution_status'] == 'COMPLETE' ? 'selected' : ''?>>Complete</option>
							<option value="EXTEND" <?=$action_plan['execution_status'] == 'EXTEND' ? 'selected' : ''?>>Extend</option>
							<option value="ONGOING" <?=$action_plan['execution_status'] == 'ONGOING' ? 'selected' : ''?>>On Going</option>
						</select>
						</div>
					</div>
					<?php 
						$g1 = $g2 = '';
						$g3 = "";
						if ($action_plan['execution_status'] == 'COMPLETE') { 
							$g2 = 'style="display: none"';
						}
						else if ($action_plan['execution_status'] == 'ONGOING') { 
							$g2 = 'style="display: none"';
							$g3 = 'style="display: none"';
						}
						else {
							$g1 = 'style="display: none"';
							$g3 = 'style="display: none"';
						}
					?>
					<div class="form-group" id="fgroup-explain" <?=$g1?>>
						<label class="col-md-2 control-label smaller cl-compact">Explanation</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_explain" placeholder=""><?=$action_plan['execution_explain']?></textarea>
						</div>
					</div>

					<div class="form-group" id="fgroup-evidence" <?=$g3?>>
						<label class="col-md-2 control-label smaller cl-compact">Evidence</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_evidence" placeholder=""><?=$action_plan['execution_evidence']?></textarea>
						</div>
					</div>
					<div class="form-group" id="fgroup-reason" <?=$g2?>>
						<label class="col-md-2 control-label smaller cl-compact">Reason</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_reason" placeholder=""><?=$action_plan['execution_reason']?></textarea>
						</div>
					</div>
					<div class="form-group" id="fgroup-date" <?=$g2?>>
						<label class="col-md-2 control-label smaller cl-compact">Revised Date</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
							<input type="text" class="form-control input-sm" name="revised_date" readonly value="<?=$action_plan['revised_date_v']?>">
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
					</div>
								
							</div>
							
							</div>
							<br/>
						</div>
						<div class="form-actions right">
							<button id="exec-button-submit-prior" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Request</button>
							<a href="javascript:history.back()"><button type="button" class="btn yellow"><i class="fa fa-times"></i> Cancel</button></a>
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