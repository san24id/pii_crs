<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Key Risk Indicator (KRI) View
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Key Risk Indicator View</a>
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
			<input type="hidden" name="kri_id" value=""/>
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
					<label class="col-md-2 control-label">Mandatory/Non Mandatory?</label>
					<div class="col-md-6">
					<?php if($kri['mandatory'] == 'Y'){
							$mitigation = 'Mandatory';
						}else if ($kri['mandatory'] == 'N'){
							$mitigation = 'Non Mandatory';
							} ?>
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="mandatory" placeholder="" value="<?=$mitigation; ?>">
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
				<?php } ?>
				<div class="form-group">
					<label class="col-md-2 control-label">Response</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" readonly="true" name="report" placeholder="" value="<?=$kri['owner_report']?>">
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
			</div>
			<div class="form-actions right">
				<?php if($this->session->credential['main_role_id'] == 2){ ?>
					<button type="button" class="btn yellow" id="kri-button-cancel" onclick="javascript: location.href=site_url+'/main/mainrac/regularkri';"><i class="fa fa-times"></i> Back</button>
				<?php }else{ ?>
					<button type="button" class="btn yellow" id="kri-button-cancel" onclick="javascript: location.href=site_url+'/main/mainpic/regularkri';"><i class="fa fa-times"></i> Back</button>
				<?php } ?>
			</div>
			</form>
			</div>
		</div>
		</div>
	</div>
</div>

