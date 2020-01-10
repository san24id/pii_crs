<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk Aggregate Form
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">View Aggregate Risk Library</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Risk Aggregate Library Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-6">
							<?php if($this->session->credential['main_role_id'] == 2){?>	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Submitted By</label>
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
									<label class="col-md-3 control-label smaller cl-compact">Risk ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_code']?>" name="risk_id" placeholder="">
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_event" placeholder=""><?=$risk['risk_event']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Event Description</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_description" placeholder=""><?=$risk['risk_description']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_category_v']?>" name="risk_category" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk Sub Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_sub_category_v']?>" name="risk_sub_category" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Risk 2nd Sub Category</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_2nd_sub_category_v']?>" name="risk_2nd_sub_category" placeholder="">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Risk Owner</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_owner_v']?>" name="risk_id" placeholder="">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Cause</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_cause" placeholder=""><?=$risk['risk_cause']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Impact</label>
									<div class="col-md-9">
									<textarea class="form-control input-readview" readonly="true" rows="3" name="risk_impact" placeholder=""><?=$risk['risk_impact']?></textarea>
									</div>
								</div>
								
								<!--<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Existing Control ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['existing_control_id']?>" name="existing_control_id" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Existing Control</label>
									<div class="col-md-9">
									<textarea class="form-control input-sm input-readview" readonly="true" rows="3" name="risk_existing_control" placeholder=""><?=$risk['risk_existing_control']?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Evaluation on Existing Control</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_evaluation_control']?>" name="risk_evaluation_control" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Control Owner</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['risk_control_owner']?>" name="risk_control_owner" placeholder="">
									</div>
								</div>-->
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Impact Level</label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['impact_level_v']?>" name="risk_impact_level_value" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" >Likelihood</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$risk['likelihood_v']?>" name="risk_likelihood_value" placeholder="">
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-3 control-label smaller cl-compact" >Risk Level</label>
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
									<th width="15%">OB. ID</th>
									<th>Objective</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($risk['objective_list'] as $k => $row) { ?>
									<tr>
										<td><?php echo 'OB.'.$row['objid']; ?></td>
										<td><?=$row['objective']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr/>
							<h4>Control</h4>
							<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th>EC.ID</th>
									<th>Existing Control</th>
									<th>Evaluation on Existing Control</th>
									
									
									<th>Control Owner</th>
								</tr>
								</thead>
								<tbody>
									<?php foreach($risk['control_list'] as $k => $row) { ?>
									<tr>
										<td><?php echo 'EC.'.$row['ec_id']?></td>
										<td><?=$row['risk_existing_control']?></td>
										<td><?=$row['risk_evaluation_control']?></td>
										<td><?=$row['control_owner']?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<hr />
							<div class="form-group">
									<input type="hidden" name="risk_level_id" value=""/>
									<label class="col-md-2 control-label smaller cl-compact" >Suggested Risk Treatment</label>
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
										<th>Ap.ID</th>
										<th>Suggested Action Plan</th>
										<th>Due Date</th>
										<th>Action Plan Owner</th>
									</tr>
									</thead>
									<tbody>
										<?php foreach($risk['action_plan_list'] as $k => $row) { ?>
										<tr>
											<td><?php echo 'AP.'.$row['id_ap']?></td>
											<td><?=$row['action_plan']?></td>
											<?php 
												if($row['due_date_v'] == '00-00-0000'){
													$row['due_date_v'] = 'continuous';
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
		<?php if($this->session->credential['main_role_id'] == 2){
				echo 'Risk Submited By : ';
				echo $risk_user['nama'];
			}?>
		</div>
		</div>
	</div>
</div>