<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Form Risiko
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Tampilan Risiko</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<?php if ($valid_mode) { ?>
		<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Risk Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-6">
							<?php if($this->session->credential['main_role_id'] == 2){?>	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Diajukan Oleh</label>
									<div class="col-md-9">
										<input type="text" id="risk_submitted_by" class="form-control input-sm input-readview" readonly="true" placeholder="" value="<?php echo $risk['risk_input_by_v']; ?>">											
									</div>
								</div>
							<?php } ?>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">ID Risiko</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_code']?>" name="risk_id" placeholder="">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Peristiwa Risiko</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_event" placeholder=""><?=$risk['risk_event']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Deskripsi Peristiwa Risiko</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_description" placeholder=""><?=$risk['risk_description']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Kategori Risiko</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_category_v']?>" name="risk_category" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Sub Kategori Risiko</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_sub_category_v']?>" name="risk_sub_category" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Sub Kategori Risiko level 2</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_2nd_sub_category_v']?>" name="risk_2nd_sub_category" placeholder="">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Pemilik Risiko</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_owner_v']?>" name="risk_id" placeholder="">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Penyebab</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_cause" placeholder=""><?=$risk['risk_cause']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Dampak</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_impact" placeholder=""><?=$risk['risk_impact']?></textarea>
									</div>
								</div>
								
								<!--<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">ID Kontrol Existing</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['existing_control_id']?>" name="existing_control_id" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Kontrol Existing</label>
									<div class="col-md-9">
									<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_existing_control" placeholder=""><?=$risk['risk_existing_control']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Evaluasi pada Kontrol Existing</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_evaluation_control']?>" name="risk_evaluation_control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Pemilik Kontrol</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_control_owner']?>" name="risk_control_owner" placeholder="">
									</div>
								</div>-->
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Level Dampak</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['impact_level_v']?>" name="risk_impact_level_value" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Kemungkinan Keterjadian</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['likelihood_v']?>" name="risk_likelihood_value" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-3 control-label smaller cl-compact" >Level Risiko</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_level_v']?>" name="risk_level" placeholder="">
									</div>
								</div>
							</div>
							</div>
							<div class="clearfix">
							</div>
							<hr/>
							<h4>Objective</h4>
							<table id="objective_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th width="15%">Obj. ID</th>
									<th>Objective</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($risk['objective_list'] as $k => $row) { ?>
									<tr>
										<td><?=$row['id']?></td>
										<td><?=$row['objective']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr/>
							<h4>Kontrol</h4>
							<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th>ID Kontrol Existing</th>
									<th>Kontrol Existing</th>
									<th>Evaluasi pada Kontrol Existing</th>
									
									
									<th>Pemilik Kontrol</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($risk['control_list'] as $k => $row) { ?>
									<tr>
										<td><?=$row['existing_control_id']?></td>
										<td><?=$row['risk_evaluation_control']?></td>
										<td><?=$row['risk_existing_control']?></td>
										<td><?=$row['risk_control_owner']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr />
							<div class="form-group">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-2 control-label smaller cl-compact" >Penanganan Risiko Yang Disarankan</label>
									<div class="col-md-3">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['treatment_v']?>" name="suggested_risk_treatment" placeholder="">
									</div>
							</div>
							<hr />
							<h4>Action Plan</h4>
							<div class="table-scrollable">
								<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th>Action Plan Yang Disarankan</th>
										<th>Batas Waktu</th>
										<th>Pemilik Action Plan</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($risk['action_plan_list'] as $k => $row) { ?>
										<tr>
											<td><?=$row['action_plan']?></td>
											<?php 
												if($row['due_date_v'] == '00-00-0000'){
													$row['due_date_v'] = 'Continuous';
												}
											?>
											<td><?=$row['due_date_v']?></td>
											<td><?=$row['division_v']?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			Risiko Diajukan oleh :
			<?php
			echo $risk_user['nama'];
			?>
		</div>
		</div>
		<?php } else { ?>
		<!-- ERROR RISK REGISTER MODE -->
		<div class="row">
		<div class="col-md-12">
			<div class="note note-danger">
				<h4 class="block">Error</h4>
				<p>
					 Anda tidak diizinkan untuk melihat Risiko ini
				</p>
				<p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Kembali ke Beranda </a>
				</p>
			</div>
		</div>
		</div>
		<?php } ?>
	</div>
</div>