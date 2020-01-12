<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<div class="col-md-9">
		<h3 class="page-title">
		Form Action Plan Execution Verify
		</h3>
		</div>
		<!-- END PAGE HEADER-->
		<script type="text/javascript">
			var g_risk_id = <?=$risk['id_ap']?>;
			var g_action_plan_status = <?=$risk['action_plan_status']?>;
			var g_username = null;
		</script>


		<div class="row">
		<!-- CHANGES FORM -->
		<div class="col-md-12 form">
			<form role="form" id="input-form" class="form-horizontal">
			<input type="hidden" id="action-plan-id" value="<?=$action_plan['id_ap']?>" name="id" placeholder="">
			<input type="hidden" id="action_plan_status" value="<?=$action_plan['action_plan_status']?>" name="act_status" placeholder="">
			<input type="hidden" value="<?=$action_plan['risk_id']?>" name="risk_id" placeholder="">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Status</label>
						<div class="col-md-9">
							<?php 
								if ($action_plan['existing_control_id'] == 'review') {
                    					$img = 'executed_2.png';
                    					$text = 'Verified By RAC (Soft Review)';
                				} else if ($action_plan['existing_control_id'] == 2) {
                    					$img = 'actplan.png';
                    					$text = 'Ignore';
                				} else if ($action_plan['action_plan_status'] == 4 || $action_plan['action_plan_status'] == 5) {
        								$img = 'draft.png';
        								$text = 'Draft';
        						} else if ($action_plan['action_plan_status'] == 6) {
        								$img = 'submit.png';
        								$text = 'Submitted to RAC';
        						}else if ($action_plan['action_plan_status'] > 6) {
        								$img = 'verified.png';
        								$text = 'Verified By RAC (Final Review)';
        						}

        						echo "<img src='assets/images/legend/$img'/> $text";
							?>
							
						</div>
					</div>
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
						$g4 = "";
						if ($action_plan['execution_status'] == 'COMPLETE') { 
							$g2 = 'style="display: none"';
							$g4 = 'style="display: none"';
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
					<?php if($action_plan['action_plan_status'] != 7){ ?>
					<div class="form-group" id="fgroup-review" <?=$g4?>>
						<label class="col-md-2 control-label smaller cl-compact">Status Review</label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="review_status" id="review_status">
							<option value="0">Soft Review</option>
							<option value="1">Final Review</option>
						</select>
						</div>
					</div>
					<?php }else{ ?>
						<div class="form-group" style="display: none;" id="fgroup-review" <?=$g4?>>
						<label class="col-md-2 control-label smaller cl-compact">Status Review</label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="review_status" id="review_status">
							<option selected="selected" value="1">Final Review</option>
						</select>
						</div>
					</div>
					<?php } ?>
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
					<br/>
					<div class="form-group">
					<div class="col-md-12">
						<div class="col-md-9">
						<table>
							<tr><td>*Soft review</td><td>&nbsp;:&nbsp;</td><td>Action Plan will be continued to the next monitoring session</td></tr>
							<tr><td>*Final review</td><td>&nbsp;:&nbsp;</td><td>Action Plan Execution is final</td></tr>
						</table>
						</div>
					</div>
					</div>
				</div>
			
	<?php if($view != 'view'){?>

				<div class="form-actions right col-md-11">
				<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$status = $_GET['status'];
	if ($status == 'under'){
	?>
					<button id="exec-button-submit-under" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Save</button>
					<?php }else{ ?>
							<?php if($action_plan['action_plan_status'] >= 6){ ?>	
								<button id="exec-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button>
							
					<?php }} ?>
					<button type="button" class="btn yellow" id="exec-button-clouse"><i class="fa fa-times"></i> Cancel</button>
				</div>
	<?php } ?>
			</form>
		</div>
		
		</div>
	</div>
</div>


<!-- CATEGORY VALIDATION-->
<div id="modal-category-validation" class="modal fade" tabindex="-1" data-width="960" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Changes of Risk Level After Mitigation</h4>
	</div>

	<?php
	$this->load->database();
	$sql2 = "select d.id as id_ap, a.id, a.risk_id,a.action_plan_status, a.action_plan, a.assigned_to, a.division, a.existing_control_id, concat('AP.',d.id) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, e.risk_code, e.risk_event, e.risk_impact_level, e.risk_likelihood_key, e.risk_level, e.risk_impact_level_after_mitigation, e.risk_likelihood_key_after_mitigation, e.risk_level_after_mitigation  from t_risk_action_plan a left join m_division b on a.division = b.division_id left join m_user c on a.assigned_to = c.username join m_action_plan d on a.ap_code = d.id and a.division = d.division join t_risk e on a.risk_id = e.risk_id where d.id = '$ap_id' and (a.action_plan_status = 6 or action_plan_status = 7) and e.periode_id = (SELECT MAX(periode_id) FROM m_periode)";
	$sql2_run = $this->db->query($sql2)->result_array();
	$sql2_run1 = $this->db->query($sql2)->row();
	?>
	
	</table>
	<div class="modal-body">
	<div>
		Based on validation performed do you consider any changes on current risk level ? <br/>

		Action Plan Code : <font><?php echo $sql2_run1->act_code; ?></font>
		<input type="hidden" id="ap_id" value="<?=$sql2_run1->id_ap;?>">
		<input type="hidden" id="ap_sts" value="<?=$sql2_run1->action_plan_status;?>">
		<hr/>
		<table id="risklist_action" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Risk Description</th>
					<th>Ap. Execution ID</th>
					<th>Impact Level</th>
					<th>Likelihood</th>
					<th>Risk Level</th>
					<th>Impact Level<br>After Mitigation</th>
					<th>Likelihood<br>After Mitigation</th>
					<th>Risk Level<br>After Mitigation</th>  
				</tr>
				</thead>
				<tbody></tbody>
		</table>
	</div></div>
	
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
		<button id="modal-changelevel-form-verify-no" type="button" 
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
		<h4 class="modal-title">Changes of Risk Level After Mitigation</h4>
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
						<div class="col-md-4">
							<div class="input-group">
								 <input type="hidden" name="risk_impact_level_id[]" id = "risk_impact_level_id_<?=$risk_id;?>" value="<?php echo $key['risk_impact_level']; ?>"/> 
								<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_impact_level']); echo ucwords($i);?>" readonly="true" name="risk_impact_level_after_mitigation[]" id = "risk_impact_level_after_mitigation_<?=$risk_id;?>" placeholder="">
								<span class="input-group-btn">
								<button class="open-impact btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-impact_<?=$risk_id;?>" data-id="<?php echo $key['risk_id']; ?>"><i class="fa fa-search fa-fw"/></i></button>
								</span>	
							</div>
						</div>
						<label class="col-md-2 control-label smaller cl-compact" >Impact Level After Mitigation </label>
						<div class="col-md-3">
						<div class="input-group">
						<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_impact_level_after_mitigation']); echo ucwords($i);?>" readonly="true"  placeholder=""></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact" >Likelihood </label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="hidden" name="risk_likelihood_id[]" id = "risk_likelihood_id_<?=$risk_id;?>" value="<?php echo $key['risk_likelihood_key']; ?>"/> 
								<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_likelihood_key']); echo ucwords($i);?>" readonly="true" name="risk_likelihood_key_after_mitigation[]" id = "risk_likelihood_key_after_mitigation_<?php echo $key['risk_id']; ?>" placeholder="">
								<span class="input-group-btn">
								<button class="open-likelihood btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood-<?=$risk_id;?>" data-id="<?php echo $key['risk_id']; ?>"><i class="fa fa-search fa-fw"/></i></button>
								</span>	
							</div>
						</div>
						<label class="col-md-2 control-label smaller cl-compact" >Likelihood After Mitigation </label>
						<div class="col-md-3">
						<div class="input-group">
						<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_likelihood_key_after_mitigation']); echo ucwords($i);?>" readonly="true"  placeholder=""></div>
						</div>
					</div>
					<div class="form-group">
					    <input type="hidden" name="risk_level_id[]" id = "risk_level_id_<?=$risk_id;?>" value="<?php echo $key['risk_level']; ?>"/> 
						<label class="col-md-2 control-label smaller cl-compact" >Risk Level</label>
						<div class="col-md-4">
						<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_level']); echo ucwords($i);?>" readonly="true" name="risk_level_after_mitigation[]" id = "risk_level_after_mitigation_<?=$risk_id;?>" placeholder="">
						</div>
					<label class="col-md-2 control-label smaller cl-compact" >Risk Level After Mitigation </label>
						<div class="col-md-3">
						<div class="input-group">
						<input type="text" class="form-control input-sm" value="<?php $i = strtolower($key['risk_level_after_mitigation']); echo ucwords($i);?>" readonly="true"  placeholder=""></div>
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
	<?php 
		$this->load->database();
		$this->load->model('risk/mriskregister');
		$impact_ap_before = $this->mriskregister->getApImpact_before($risk_id);
	?>
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
				foreach($impact_ap_before as $k=>$v) { ?>
				<tr>
					<td><?=$v['impact_category']?></td>
					<td>
						<div class="radio-list">
							<label>
							<input type="radio" checked id="impactlevel_<?=$risk_id?>" name="impactlevel_<?=$v['impact_id']?>" value="NA"> N/A</label>
							<?php foreach($impact_list['impact_list'][$v['impact_id']] as $key=>$row) { ?>
							<label>
							<input type="radio" id="impactlevel_<?=$risk_id?>" name="impactlevel_<?=$v['impact_id']?>" value="<?=$key?>" <?php echo ($key == $v['i_level']) ? 'checked' : ''?>> <?=$row?></label>
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
		<?php 
		$risk_id = $key['risk_id'];
		$risk_likelihood_key = $key['risk_likelihood_key'];

		echo $risk_id;
		?>
		<form id="form-likelihood_<?=$risk_id?>">
		<table class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th>&nbsp;</th>
				<th width="250px">Kemungkinan terjadinya resiko</th>
				<th>Deskripsi</th>
			</tr>
			</thead>
			<tbody>
			<?php
				$cnt = 0; 
				foreach($likelihood as $row) { ?>
				<tr>
					<td><label><input type="radio" name="risk_likelihood_<?=$risk_id?>" id="likelihood_<?=$row['l_id']?>" value="<?=$row['l_key']?>|<?=$row['l_title']?>" <?php echo ($row['l_key'] == $risk_likelihood_key) ? 'checked' : ''?>></label></td>
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
