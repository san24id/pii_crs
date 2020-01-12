<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Key Risk Indicator (KRI) Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Key Risk Indicator Form</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<form id="input-form" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label">Risk ID</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_library_code" placeholder="" value="<?=$risk['risk_code']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Risk Event</label>
						<div class="col-md-6">
						<textarea class="form-control input-sm input-readview"  data-container="body" data-placement="bottom" rows="3" readonly="true" name="risk_event" placeholder=""><?=$risk['risk_event']?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Level</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level" placeholder="" value="<?=$risk['risk_level_v']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Risk Treatment</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_treatment" placeholder="" value="<?=$risk['treatment_v']?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Action Plan</label>
						<div class="col-md-8">
							<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th>Action Plan</th>
									<th>Due Date</th>
									<th>Action Plan Owner</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($risk['action_plan_list'] as $key => $value) { ?>
									<tr>
										<td><?=$value['action_plan']?></td>
										<td>
											<?php 
												if($value['due_date_v'] == '00-00-0000'){
													echo "Continuous";
												}else{
													echo $value['due_date_v'];
												}
											?>
										</td>
										<td><?=$value['division_v']?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
			<hr/>
			<div class="form">
			<form id="kri-form" role="form" class="form-horizontal">
			<input type="hidden" name="kri_id" id="kri-id" value="<?=$kri['id']?>"/>
			<input type="hidden" name="risk_id" id="kri-risk-id" value=""/>
			<div class="form-body">
				<div class="form-group">
					<input type="hidden" name="kri_library_id" value=""/>
					<label class="col-md-2 control-label">KRI ID</label>
					<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="kri_library_code" placeholder="" value="<?=$kri['kri_code']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Key Risk Indicator</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="key_risk_indicator" placeholder="" value="<?=$kri['key_risk_indicator']?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Mitigation Complete ?</label>
					<div class="col-md-6">
					<?php if($kri['mandatory'] == 'N'){ ?>
						<input type="text" class="form-control input-sm input-readview" readonly="true" placeholder="" value="Not Yet">
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php }else{ ?>
						<input type="text" class="form-control input-sm input-readview" readonly="true" placeholder="" value="Already">
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Deadline For Report</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="timing_pelaporan" placeholder="" value="<?=$kri['timing_pelaporan_v']?>">
					</div>
				</div>
				<?php if (isset($verifyRac) && $verifyRac) { ?>
				<div class="form-group">
					<label class="col-md-2 control-label">KRI Owner</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="kri_owner" placeholder="" value="<?=$kri['kri_owner_v']?>">
					</div>
				</div>
				<?php }?>
				<?php if (isset($verifyRac) && $verifyRac) { ?>
				<div class="form-group">
					<label class="col-md-2 control-label" > Threshold </label>
					<div class="col-md-8">
						<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>Operator</th>
								<th>Value 1</th>
								<th>Value 2</th>
								<th>Type Value</th>
								<th>Result</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($kri['treshold_list'] as $key => $value) { ?>
								<tr>
									<td><?=$value['operator']?></td>
									<td><?=$value['value_1']?></td>
									<td><?=$value['value_2']?></td>
									<td><?=$value['value_type']?></td>
									<td><?=$value['result']?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } ?>
				
				<?php if ($kri['treshold_type'] == 'SELECTION') { ?>
					<div class="form-group">
						<label class="col-md-2 control-label">Response</label>
						<div class="col-md-6">
						<select class="form-control input-sm" id="owner_report" name="owner_report">
							<?php foreach ($kri['treshold_list'] as $key => $value) { ?>
							<option value="<?=$value['value_1']?>" <?=$value['value_1'] == $kri['owner_report'] ? 'SELECTED' : ''?>><?=$value['value_1']?></option>
							<?php } ?>
						</select>
						</div>
					</div>
				<?php } else { ?> 

				<div class="form-group">
						<label class="col-md-2 control-label">Response</label>
						<div class="col-md-6">
						<select class="form-control input-sm" id="owner_report" name="owner_report">
							
							<?php foreach ($kri['treshold_list'] as $key => $value) { 

							if ($value['value_2'] != null){
								$strip = "-" ;
								}else{
									$strip = "" ;
									}
							if ($value['value_type'] == 'PERCENTAGE'){
								$persen = "%" ;
								}else{
									$persen = "" ;
									}
							if ($value['value_2'] != null && $value['value_type'] == 'PERCENTAGE') {
								$persen2 = "%" ;
								}else{
									$persen2 = "" ;
									}
							 ?>
									PERCENTAGE
							<option value="<?=$value['value_1']?>" <?=$value['value_1'] == $kri['owner_report'] ? 'SELECTED' : ''?>><?=$value['operator']?> <?=$value['value_1']?> <?php echo $persen2 ;?> <?php echo $strip ;?> <?=$value['value_2']?> <?php echo $persen ;?> </option>
							<?php } ?>
						</select> 
						</div>
					</div>
					<!--
					<div class="form-group">
						<label class="col-md-2 control-label">Input Data</label>
						<div class="col-md-6">
							<input type="number" class="form-control input-sm" id="owner_report" name="owner_report" placeholder="" value="<?//=$kri['owner_report'] == '' ? '0' : $kri['owner_report'] ?>">
						</div>
					</div>
					-->
				<?php } ?> 

				<div class="form-group">
				<label class="col-md-2 control-label" title="">Supporting Evidence</label>
				<div class="col-md-6">		
				<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="support" id="support" > <?=$kri['supporting_evidence']?> </textarea>
				</div>
				</div>

				
				<?php if (isset($verifyRac) && $verifyRac) { ?>
				<div class="form-group">
				<label class="col-md-2 control-label" title="">Validation</label>
				<div class="col-md-6">		
				<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="validation" id="validation" ></textarea>
				</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">KRI Warning</label>
					<div class="col-md-6">
					<?php 
					if ($kri['kri_warning'] == 'RED'){
					?>
						<div style="margin-top:7px">
						<img id="warning_img" src="<?=$base_url?>assets/images/legend/kri_<?=strtolower($kri['kri_warning'])?>.gif"/>
						</div>
					<?php
					}else{
					?>
						<div style="margin-top:7px">
						<img id="warning_img" src="<?=$base_url?>assets/images/legend/kri_<?=strtolower($kri['kri_warning'])?>.png"/>
						</div>
					<?php
					}
					?>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="form-actions right">
				<?php if (isset($verifyRac) && $verifyRac) { ?>
				<button id="kri-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button>
				<button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i> Cancel</button>
				<?php } else { ?>
						<?php
							if ($role == 2){
						?>
			<button id="kri-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit</button>
						<?php	
							}else{
						?>
				<button id="kri-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit</button>
				<button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i> Cancel</button>
						<?php } ?>
				
				<?php } ?>
			</div>
			</form>
			</div>
		</div>
		</div>
	</div>
</div>
<?php if (isset($verifyRac) && $verifyRac) { ?>
<script type="text/javascript">
var t_treshold_type = '<?=$kri['treshold_type']?>';
var t_treshold_list = <?=json_encode($kri['treshold_list'])?>;
</script>


<?php } ?>

<!-- CATEGORY -->
<div id="modal-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Level </h4>
	</div>

	<?php
	$this->load->database();
	$sql2 = "select * from t_risk where risk_id = (select risk_id from t_kri where id = '$kri_id')";
	$sql2_run = $this->db->query($sql2)->row();
	?>
	<div style="margin-left:50px;">
	Based on validation performed <br> Do you consider any changes on current risk level ? <br>
	</div>
	<div style="margin-left:70px;">
	current impact level = <?php echo $sql2_run->risk_impact_level; ?> <br>
	current likelihood = <?php echo $sql2_run->risk_likelihood_key; ?> <br>
	current risk level = <?php echo $sql2_run->risk_level; ?>
	</div>
	<hr>
	<div class="modal-body">
			<form id="modal-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					 <div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Impact Level <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_impact_level_id" id = "risk_impact_level_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_impact_level_after_kri" id = "risk_impact_level_after_mitigation" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" id="btn_impact_list"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Likelihood <span class="required">* </span></label>
						<div class="col-md-9">
							<div class="input-group">
								 <input type="hidden" name="risk_likelihood_id" id = "risk_likelihood_id" value=""/> 
								<input type="text" class="form-control input-sm" readonly="true" name="risk_likelihood_key_after_kri" id = "risk_likelihood_key_after_mitigation" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-likelihood"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
					<div class="form-group">
					    <input type="hidden" name="risk_level_id" id = "risk_level_id" value=""/> 
						<label class="col-md-3 control-label smaller cl-compact" >Risk Level </label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="risk_level_after_kri" id = "risk_level_after_mitigation" placeholder="">
						</div>
					</div>
					<!--
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Impact Level</label>
						<div class="col-md-9">
						<select name = "risk_impact_level_after_kri" id = "risk_impact_level_after_kri" class = "form-control">
							<option value = "HIGH">High</option>
							<option value = "MODERATE">Moderate</option>
							<option value = "LOW">Low</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Likelihood Level</label>
						<div class="col-md-9">
						<select name = "risk_likelihood_key_after_kri" id = "risk_likelihood_key_after_kri" class = "form-control">
							<option value = "HIGH">High</option>
							<option value = "MODERATE">Moderate</option>
							<option value = "LOW">Low</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Risk Level</label>
						<div class="col-md-9">
						<select name = "risk_level_after_kri"id = "risk_level_after_kri"  class = "form-control">
							<option value = "HIGH">High</option>
							<option value = "MODERATE">Moderate</option>
							<option value = "LOW">Low</option>
						</select>
						</div>
					</div>-->
				</div>
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



