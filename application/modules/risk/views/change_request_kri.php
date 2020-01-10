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

				<?php
					$this->load->database();
					$kri_code =$kri['kri_code'];
					$sql = "select t_cr_risk.cr_status from t_cr_risk join t_kri on t_cr_risk.risk_cause = t_kri.id where t_kri.kri_code = '$kri_code' and t_cr_risk.cr_status= 0 ";
					//$sql = "select id from t_kri where kri_code = '$kri_code' ";
					$rs = $this->db->query($sql);
					if ($rs->num_rows() > 0) {
							?>
								<div class="row">
								<div class="col-md-12">
								<div class="note note-warning">
								<h4 class="block">Warning</h4>
								<p>
								 Cannot Input Change Request for this KRI, This KRI already have a Pending Change Request 
								</p>
								<p>
								<a class="btn red" target="_self" href="<?=$base_url?>index.php/main/mainpic">
								Back to Home </a>
								</p>
								</div>
								</div>
								</div>
					<?php
						}else{
					?>



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
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_event" placeholder="" value="<?=$risk['risk_event']?>">
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
			<input type="hidden" name="kri_id" value="<?=$kri['id']?>"/>
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
						<input type="text" class="form-control input-sm input-readview" data-width="140" readonly="true" placeholder="" value="Non Mandatory">
						<input type="hidden" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$kri['mandatory']?>">
					<?php }else{ ?>
						<input type="text" class="form-control input-sm input-readview" data-width="140" readonly="true" placeholder="" value="Mandatory">
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
				
				<?php if ( (isset($verify) && $verify) || (isset($input) && $input) ) { ?>
				<hr/>
				<?php if (isset($verify) && $verify) { ?>
				<div class="form-group">
					<label class="col-md-2 control-label" >Threshold</label>
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
						<?php 
							foreach ($kri['treshold_list'] as $key => $value) {
							if($kri['owner_report'] == NULL){ 
						?>
								<option value="<?=$value['value_1'].$value['result']?>"><?=$value['value_1']?></option>
						<?php }else{ ?>
								<option value="<?=$value['value_1'].$value['result']?>" <?=$value['value_1'].$value['result'] == $kri['owner_report'].$kri['kri_warning'] ? 'SELECTED' : ''?>><?=$value['value_1']?></option>
							<?php }} ?>
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
							<?php if($kri['owner_report'] == NULL){  ?>
								<option value="<?=$value['operator'].$value['value_1'].$value['value_type']?>"><?=$value['operator']?> <?=$value['value_1']?> <?php echo $persen2 ;?> <?php echo $strip ;?> <?=$value['value_2']?> <?php echo $persen ;?> </option>
							<?php }else{?>
								<option value="<?=$value['operator'].$value['value_1'].$value['value_type']?>" <?=$value['value_1'].$value['value_type'].$value['result'] == $kri['owner_report'].$kri['description'].$kri['kri_warning'] ? 'SELECTED' : ''?>><?=$value['operator']?> <?=$value['value_1']?> <?php echo $persen2 ;?> <?php echo $strip ;?> <?=$value['value_2']?> <?php echo $persen ;?> </option>
								<?php }} ?>
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

				<?php } ?>
				<div class="form-group">
				<label class="col-md-2 control-label" title="">Supporting Evidence</label>
				<div class="col-md-6">		
				<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="support" id="support" ><?=$kri['supporting_evidence']?></textarea>
				</div>
				</div> 
			</div>
			<?php if (isset($verify) && $verify) { ?>
			<input type="hidden" name="change_id" value="<?=$change['id']?>">
			<div class="form-actions right">
				<button id="risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Verify</button>
				<button type="button" class="btn yellow" id="verify-risk-button-cancel"><i class="fa fa-times"></i> Cancel</button>
			</div>
			<?php } else if (isset($input) && $input) { ?>
			<div class="form-actions right">
				<button id="risk-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Request</button>
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

<?php
}
?>

	</div>
</div>

