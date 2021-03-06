<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Action Plan Execution
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Action Plan Execution</a>
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
		<!-- CHANGES FORM -->
		<div class="col-md-12 form">
			<form role="form" id="input-form" class="form-horizontal">
			<input type="hidden" id="action-plan-id" value="<?=$action_plan['id_ap']?>" name="id" placeholder="">
			<input type="hidden" value="<?=$action_plan['risk_id']?>" name="risk_id" placeholder="">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">AP ID</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Assigned Action Plan</label>
						<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" value="" readonly="true" name="action_plan"><?=$action_plan['action_plan']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Due Date</label>
						<div class="col-md-9">
										<?php 
											if($action_plan['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" id = "due_date" readonly value="Continuous">
										<?php }else{ ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" id = "due_date" readonly value="<?=$action_plan['due_date_v']?>">
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
					<?php if($action_plan['action_plan_status'] == 7){ ?>
						<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['execution_status']?>" placeholder="">
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
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="execution_explain" placeholder=""><?=$action_plan['execution_explain']?></textarea>
						</div>
					</div>

					<div class="form-group" id="fgroup-evidence" <?=$g3?>>
						<label class="col-md-2 control-label smaller cl-compact">Evidence</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true"rows="3" name="execution_evidence" placeholder=""><?=$action_plan['execution_evidence']?></textarea>
						</div>
					</div>
					<div class="form-group" id="fgroup-reason" <?=$g2?>>
						<label class="col-md-2 control-label smaller cl-compact">Reason</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="execution_reason" placeholder=""><?=$action_plan['execution_reason']?></textarea>
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
					<?php }else{ ?>
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
				<?php } ?>	
				</div>
			
	<?php if($view != 'view'){?>

				<div class="form-actions right">
				<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$status = $_GET['status'];
	if ($status == 'under'){
	?>
					<button id="exec-button-submit-under" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Save</button>
					<?php }else{ ?>
						<?php if($action_plan['action_plan_status'] != 7){ ?>
							<button id="exec-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button>
						<?php }?>
<?php } ?>
					<button type="button" class="btn yellow" id="exec-button-cancel"><i class="fa fa-times"></i> Cancel</button>
				</div>
	<?php } ?>
			</form>
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



<!-- CATEGORY VALIDATION-->
<div id="modal-category-validation" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Level  </h4>
	</div>

	<?php
	$this->load->database();
	$sql2 = "select d.id as id_ap, a.id, a.risk_id,a.action_plan_status, a.action_plan, a.assigned_to, a.division, a.existing_control_id, concat('AP.', LPAD(d.id, 6, '0')) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, e.risk_code, e.risk_event, e.risk_impact_level, e.risk_likelihood_key, e.risk_level, e.risk_impact_level_after_mitigation, e.risk_likelihood_key_after_mitigation, e.risk_level_after_mitigation  from t_risk_action_plan a left join m_division b on a.division = b.division_id left join m_user c on a.assigned_to = c.username join m_action_plan d on a.action_plan = d.action_plan and a.division = d.division join t_risk e on a.risk_id = e.risk_id where d.id = '$ap_id' and a.action_plan_status = 6 and e.periode_id = (SELECT MAX(periode_id) FROM m_periode)";
	$sql2_run = $this->db->query($sql2)->result_array();?>
	
	</table>
	<div style="margin-left:50px;">
	Based on validation performed do you consider any changes on current risk level ? <br>
	</div>
	<div style="margin-left:70px;">
	<?php foreach ($sql2_run as $key) { ?>
	<table class="table">
	<tr><td width="8%">Risk ID</td><td width="3%">=</td><td width="23%"><?php echo $key['risk_code']; ?></td></tr>
	<tr><td>current impact level</td><td>=</td><td><?php echo $key['risk_impact_level']; ?></td></tr>
	<tr><td>current likelihood</td><td>=</td><td><?php echo $key['risk_likelihood_key']; ?></td></tr>
	<tr><td>current risk level</td><td>=</td><td><?php echo $key['risk_level']; ?></td></tr>
	</table>
	<?php } ?>
	</div>
	
	<div class="">
			<form id="modal-risk-form-validation_no" role="form" class="form-horizontal">
			<?php foreach ($sql2_run as $key) { ?>
				<!--<input type="text" name="mode" value="add" />
				<input type="text" name="cat_id" value="" />
				<input type="text" name="cat_parent" value="0" />-->
				<input type="hidden" class="form-control input-sm" value="<?=$key['risk_id'];?>" readonly="true" name="r_id[]" placeholder="">
			 			
								<!--<input type="text" name="risk_impact_level_id" value=""/>--> 
								<input type="hidden" class="form-control input-sm" value="<?=$key['risk_impact_level'];?>" readonly="true" name="risk_impact_level_after_mitigation[]" id = "risk_impact_level_after_mitigation_validation" placeholder="">
							
								 <!--<input type="text" name="risk_likelihood_id" id = "risk_likelihood_id" value=""/>--> 
								<input type="hidden" class="form-control input-sm" value="<?=$key['risk_likelihood_key'];?>" readonly="true" name="risk_likelihood_key_after_mitigation[]" id = "risk_likelihood_key_after_mitigation_validation" placeholder="">
							
					    <!--<input type="text" name="risk_level_id" id = "risk_level_id" value=""/>--> 
						<input type="hidden" class="form-control input-sm" value="<?=$key['risk_level'];?>" readonly="true" name="risk_level_after_mitigation[]" id = "risk_level_after_mitigation_validation" placeholder="">
			<?php }?>		
			</form>
	</div>
	<div class="modal-footer">
		<!--
		<button type="button" data-dismiss="modal" class="btn btn-default">No</button>
		-->
		<button id="modal-impactlevel-form-submit-no" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-left"
			>NO</button>
		<button id="modal-impactlevel-form-submit-validation" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-left"
			>YES</button>
	</div>
</div>

 
<!-- CATEGORY -->
<div id="modal-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Level  </h4>
	</div>
	<div class="modal-body">
			<form id="modal-risk-form" role="form" class="form-horizontal">
			<?php foreach ($sql2_run as $key) { 
					$risk_id = $key['risk_id'];
				?>
				<!--<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />-->
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact" >Risk ID </label>
						<div class="col-md-9">
						<div class="input-group">
							<input type="hidden" class="form-control input-sm" value="<?=$risk_id;?>" readonly="true" name="r_id[]" placeholder="">
							<input type="text" class="form-control input-sm" value="<?=$key['risk_code'];?>" readonly="true" placeholder="">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact" >Impact Level </label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_impact_level_id[]" id = "risk_impact_level_id_<?=$risk_id;?>" value="<?php echo $key['risk_impact_level']; ?>"/> 
								<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_impact_level']); echo ucwords($i);?>" readonly="true" name="risk_impact_level_after_mitigation[]" id = "risk_impact_level_after_mitigation_<?=$risk_id;?>" placeholder="">
								<span class="input-group-btn">
								<button class="open-impact btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-impact_<?=$risk_id;?>" data-id="<?php echo $key['risk_id']; ?>"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact" >Likelihood </label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="hidden" name="risk_likelihood_id[]" id = "risk_likelihood_id_<?=$risk_id;?>" value="<?php echo $key['risk_likelihood_key']; ?>"/> 
								<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_likelihood_key']); echo ucwords($i);?>" readonly="true" name="risk_likelihood_key_after_mitigation[]" id = "risk_likelihood_key_after_mitigation_<?php echo $key['risk_id']; ?>" placeholder="">
								<span class="input-group-btn">
								<button class="open-likelihood btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood-<?=$risk_id;?>" data-id="<?php echo $key['risk_id']; ?>"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
					    <input type="hidden" name="risk_level_id[]" id = "risk_level_id_<?=$risk_id;?>" value="<?php echo $key['risk_level']; ?>"/> 
						<label class="col-md-2 control-label smaller cl-compact" >Risk Level</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_level']); echo ucwords($i);?>" readonly="true" name="risk_level_after_mitigation[]" id = "risk_level_after_mitigation_<?=$risk_id;?>" placeholder="">
						</div>
					</div>
					<hr />
				</div>
				<?php } ?>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="modal-impactlevel-form-submit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>


<!-- IMPACT LEVEL -->
<?php foreach ($sql2_run as $key) { 
	$risk_id = $key['risk_id'];
	?>
<div id="modal-impact_<?=$risk_id;?>" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Impact</h4>
		<span class="font-red">* Dapat diisi lebih dari satu(1) kategori, namun dalam Satu(1)
		Kategori hanya boleh diisi satu(1) parameter</span>
	</div>
	<div class="modal-body">
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
							<input type="radio" id="impactlevel_<?=$risk_id?>" name="impactlevel_<?=$k?>" value="NA" checked> N/A</label>
							<?php foreach($impact_list['impact_list'][$k] as $key=>$row) { ?>
							<label>
							<input type="radio" id="impactlevel_<?=$risk_id?>" name="impactlevel_<?=$k?>" value="<?=$key?>"> <?=$row?></label>
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
		<button id="input-form-impact-button_<?=$risk_id;?>" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>
<?php } ?>
<!-- LIKELIHOOD -->
<?php foreach ($sql2_run as $key) { ?>
<div id="modal-likelihood-<?php echo $key['risk_id']; ?>" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Evaluation on Risk Likelihood</h4>
		<span class="font-red">* Pilih Salah Satu</span>
	</div>
	<div class="modal-body">
		<?php $risk_id = $key['risk_id'];?>
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
					<td><label><input type="radio" name="risk_likelihood_<?=$risk_id?>" id="likelihood_<?=$row['l_id']?>" value="<?=$row['l_key']?>|<?=$row['l_title']?>" <?=$cnt == 0 ? 'checked' : ''?>></label></td>
					<td><?=$row['l_title']?></td>
					<td><?=$row['l_desc']?></td>
				</tr>
			<?php $cnt++; } ?>
			</tbody>
		</table>
		</form>
	</div>
	<div class="modal-footer">
		<button id="input-form-likelihood-button_<?=$risk_id?>" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>
<?php } ?>