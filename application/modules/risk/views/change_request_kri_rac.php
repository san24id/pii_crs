<script src="assets/toogle/js/jquery-3.1.1.min"></script>

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
					<a target="_self" href="javascript:;">Change Request KRI Regular Form</a>
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
			<input type="hidden" name="change_id" value="<?=$kri['change_id']?>"/>
			<input type="hidden" name="kri_id" value="<?=$kri['kri_id']?>"/>
			<input type="hidden" name="risk_id" id="kri-risk-id" value="<?=$risk['risk_id']?>"/>
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
					<label class="col-md-2 control-label">Mandatory/Non Mandatory?</label>
					<div class="col-md-6">
					<?php if($kri['mandatory'] == 'N'){ ?>
						<input data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-width="140" data-on = "Mandatory" data-off = "Non Mandatory" disabled="disabled" />
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php }else{ ?>
						<input data-toggle="toggle" type="checkbox" checked="checked" data-size="small" data-onstyle="danger" data-width="140" data-on = "Mandatory" data-off = "Non Mandatory" disabled="disabled" />
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
				<div class="form-group">
					<label class="col-md-2 control-label">KRI Owner</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="kri_owner" placeholder="" value="<?=$kri['kri_owner_v']?>">
					</div>
				</div>
								<div class="form-group">
					<label class="col-md-2 control-label" > Threshold Description </label>
					<div class="col-md-8">

					<?php if($kri['treshold_type'] == 'SELECTION'){ ?>
						<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>Value 1</th>
								<th>Warning</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($kri['treshold_list'] as $key => $value) { ?>
								<tr>
									<td><?=$value['value_1']?></td>
									<td><?=$value['result']?></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
						<?php }else{ ?>
						<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>Operator</th>
								<th>Value 1</th>
								<th>Value 2</th>
								<th>Type Value</th>
								<th>Warning</th>
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
						<?php } ?>
					</div>
				</div>
				
				<?php if ( (isset($verify) && $verify) || (isset($input) && $input) ) { ?>
				<hr/>
				<?php if ($kri['treshold_type'] == 'SELECTION') { ?>
					<div class="form-group">
						<label class="col-md-2 control-label">Response</label>
						<div class="col-md-6">
						<select class="form-control input-sm" id="owner_report" name="owner_report">
							<option value="" style="color: #cccccc;">choose one</option>
							<?php foreach ($kri['treshold_list'] as $key => $value) { ?>
							<option value="<?=$value['value_1'].$value['result']?>" <?=$value['value_1'].$value['result'] == $kri['owner_report'].$kri['kri_warning'] ? 'SELECTED' : ''?>><?=$value['value_1']?></option>
							<?php } ?>
						</select>
						</div>
					</div>
				<?php } else { ?> 

				<div class="form-group">
						<label class="col-md-2 control-label">Response</label>
						<div class="col-md-6">
						<select class="form-control input-sm" id="owner_report" name="owner_report">
							<option value="" style="color: #cccccc;">choose one</option>
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
									
									<option value="<?php echo $value['operator'].$value['value_1'].$value['value_type'];?>" <?=$value['value_1'].$value['value_type'].$value['result'] == $kri['owner_report'].$kri['description'].$kri['kri_warning'] ? 'SELECTED' : ''?>><?=$value['operator']?> <?=$value['value_1']?> <?php echo $persen2 ;?> <?php echo $strip ;?> <?=$value['value_2']?> <?php echo $persen ;?> </option>
							<?php } ?>
						</select> 
						</div>
					</div>
				<?php } ?> 

				
				<?php }?>
				<div class="form-group">
				<label class="col-md-2 control-label" title="">Supporting Evidence</label>
				<div class="col-md-6">		
				<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="support" id="support" ><?=$kri['supporting_evidence']?></textarea>
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
			</div>
				<?php if($this->session->credential['main_role_id'] == 2){ ?>
				<br/>
					<div class="form-group">
					<div class="col-md-9">
					<table>
					<tr><td>- Mandatory: KRI will show up in the KRI owner dashboard</td></tr>
					<tr><td>- Non Mandatory: KRI won't show up in the KRI owner dashboard, and remain on RAC's dashboard</td></tr></table>
					</div>
					</div>
				<?php } ?>
			<?php if (isset($verify) && $verify) { ?>
			<input type="hidden" name="change_id" value="<?=$change['id']?>">
			<div class="form-actions right">
				<button id="risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button>
				<button type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			<?php } else if (isset($input) && $input) { ?>
			<div class="form-actions right">
				<button id="risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit</button>
				<button type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			<?php } else { ?>
			<div class="form-actions right">
				<button onclick="javascript: location.href=site_url+'/main#tab_change_request_list'" type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			<?php } ?>
			</form>
			</div>
		</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var t_treshold_type = '<?=$kri['treshold_type']?>';
var t_treshold_list = <?=json_encode($kri['treshold_list'])?>;
</script>