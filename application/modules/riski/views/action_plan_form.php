<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Action Plan Form
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
		<?php if ($valid_mode) { 
		$id_ap = $action_plan['id_ap'];
		$this->load->database();
		$sql = "select distinct b.due_date from m_action_plan a, t_risk c, t_risk_action_plan b where c.risk_id = b.risk_id and c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and a.action_plan = b.action_plan and a.division = b.division and a.id ='$id_ap' and b.action_plan_status < 4";
			$query = $this->db->query($sql);
		if($query->num_rows() > 1){
			?>
		<div class="row">
<?php 
		$id_ap = $action_plan['id_ap'];
		$this->load->database();
		$sql = "select 
					f.id as id_p, a.id, a.risk_id, a.action_plan_status, a.action_plan, f.division,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,
					b.risk_code,
					c.display_name as assigned_to_v,
					d.division_name as division_name,
					date_format(a.due_date, '%d-%m-%Y') as due_date_v
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id
					left join m_periode on m_periode.periode_id = b.periode_id
					join m_action_plan f on a.action_plan = f.action_plan and a.division = f.division
					where 
					b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					a.action_plan_status > 0 and b.switch_flag = 'P' and f.id ='$id_ap' GROUP BY f.id ORDER BY f.id ASC";
		$query = $this->db->query($sql);

	?>

<!-- LIBRARY -->
<div id="modal-library" class="" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<h4 class="modal-title">Action Plan</h4>
			<div class="pull-right">
					<a href="#form-edit" id="button-form-data-open" data-toggle="modal"><button type="button" class="btn blue"><i class="fa fa-pencil"></i>Edit Due Date</button></a>
					<button type="button" class="btn yellow" id="risk-button-cancel"><i class="fa fa-times"></i> Back</button>
			</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="/library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					
					<th>AP.ID</th>
					<th>Action Plan</th>
					<th>Action Plan Owner</th>
					<th>Due Date</th>
					<th>Risk ID</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
<?php

if ($query->num_rows() > 0)
{
   foreach ($query->result_array() as $row)
   {

		$this->load->database();
		$sql2 = "select 
					f.id as id_p, a.id, a.risk_id, a.action_plan_status, a.action_plan, f.division,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,
					b.risk_code,
					c.display_name as assigned_to_v,
					d.division_name as division_name,
					date_format(a.due_date, '%d-%m-%Y') as due_date_v
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id
					left join m_periode on m_periode.periode_id = b.periode_id
					join m_action_plan f on a.action_plan = f.action_plan and a.division = f.division
					where 
					b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					a.action_plan_status > 0 and b.switch_flag = 'P' and f.id ='".$row['id_p']."'";
		$query2 = $this->db->query($sql2);
		$total = $query2->num_rows();
      ?>
      		<tr>
      			<td rowspan="<?php echo $total+1; ?>"><?php echo $row['act_code']; ?></td>
      			<td rowspan="<?php echo $total+1; ?>"><?php echo $row['action_plan']; ?></td>
      			<td rowspan="<?php echo $total+1; ?>"><?php echo $row['division_name']; ?></td>

      			<?php 
      				 foreach ($query2->result_array() as $row2)
   					{
      			?>
      			<tr>
      			<td><?php echo $row2['due_date_v']; ?></td>
      			<td><?php echo $row2['risk_code']; ?></td>
      			<!--<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-trash-o font-red"> Delete </i></button></td>-->
      			</tr>
      			<?php }?>
      		</tr>
<?php
   }
} 
					?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
</div>


		</div>

		<?php }else{?>

		<div class="col-md-6">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Action Plan Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
					<input type="hidden" name="risk_id" value="<?=$risk['risk_id']?>" />
					<input type="hidden" id="form-action-id" name="action_id" value="<?=$action_plan['id_ap']?>" />
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">AP ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan['act_code']?>" placeholder="">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
									<div class="col-md-9">
										<textarea class="form-control input-sm input-readview" value="" readonly="true" name="action_plan"><?=$action_plan['action_plan']?></textarea>
										<!--
										<input type="text" class="form-control input-sm input-readview" value="<?//=$action_plan_change['action_plan']?>" name="action_plan" placeholder="">
										-->
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<div class="input-group input-medium">
										<?php 
											if($action_plan['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" readonly value="Continuous">
										<?php }else{ ?>
											<input type="text" class="form-control input-sm input-readview" name="due_date" readonly value="<?=$action_plan['due_date_v']?>">
										<?php } ?>
									</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" name="division" value="<?=$action_plan['division_v']?>">
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
						Changed Action Plan
					</div>
				</div>
				
				<div class="portlet-body form">
					<div class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-12">	
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">AP ID</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-sm input-readview" readonly="true" value="<?=$action_plan_change['act_code']?>" placeholder="">
										<input type="hidden" id="form-action-id" name="action_id" value="<?=$action_plan_change['id_ap']?>" />
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
									<div class="col-md-9">
										<textarea class="form-control input-sm input-readview" value="" name="action_plan"><?=$action_plan_change['action_plan']?></textarea>
										<!--
										<input type="text" class="form-control input-sm input-readview" value="<?//=$action_plan_change['action_plan']?>" name="action_plan" placeholder="">
										-->
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<?php 
											if($action_plan_change['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="button" style="width: 20px; height: 20px;" onclick="Check2()" id="ckc2"/>
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd2()" id="kcc2"/>
						 					&nbsp;Continous&nbsp;<span id="checked2"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate2">
										<?php }else{ ?>
											<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 					&nbsp;Continous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
										<?php } ?>
									
										<?php 
											if($action_plan_change['due_date_v'] == '00-00-0000'){
										 ?>
											<input type="text" class="form-control input-sm"  id = "due_date" readonly value="Continuous" placeholder="select date">
											<input type="hidden" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan_change['due_date_v']?>">
										<?php }else{ ?>

											<input type="text" class="form-control input-sm" name="due_date" id = "due_date" readonly value="<?=$action_plan_change['due_date_v']?>" placeholder="select date">
										<?php } ?>
										<span class="input-group-btn">
										<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="division">
										<?php foreach($division_list as $row) { ?>
										<option value="<?=$row['ref_key']?>" <?=$row['ref_key'] == $action_plan_change['division'] ? 'SELECTED' : '' ?>><?=$row['ref_value']?></option>
										<?php } ?>
									</select>
									</div>
								</div>

								<div class="form-group" style="display: none;">
									<label class="col-md-3 control-label smaller cl-compact" title="fill this field with description of risk treatment action to be done in addressing the risk">Assigned Action Plan</label>
									<div class="col-md-9">
										<textarea class="form-control input-sm input-readview" value="" readonly="true" name="action_plan_prim"><?=$action_plan['action_plan']?></textarea>
										<!--
										<input type="text" class="form-control input-sm input-readview" value="<?//=$action_plan_change['action_plan']?>" name="action_plan" placeholder="">
										-->
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
									<div class="col-md-9">
									<div class="input-group input-medium">

											<input type="text" class="form-control input-sm input-readview" name="due_date_prim" readonly value="<?=$action_plan['due_date_v']?>">
									</div>
									</div>
								</div>
								<div class="form-group" style="display: none;">
									<label class="col-md-3 control-label" title="fill this field with the assigned person who is responsible for defined risk treatment activities in ‘Action Plan’">Action Plan Owner </label>
									<div class="col-md-9">
									<input type="text" class="form-control input-sm input-readview" name="division_prim" value="<?=$action_plan['division']?>">
									</div>
								</div>
								
							</div>
							
							</div>
							<br/>
							 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box 
<br/>If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>
						</div>
						<div class="form-actions right">
						<?php
							if ($role == 2){
						?>
							<button id="risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit</button>
						<?php	
							}else{
						?>
							<button id="risk-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save as Draft</button>
							<button id="risk-button-verify" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit</button>
							<a href="<?php echo site_url('main/mainpic/#tab_action_plan'); ?>"><button type="button" class="btn yellow"><i class="fa fa-times"></i> Cancel</button></a>
						
						<?php } ?>

							</div>
					</form>
				</div>
			</div>
		</div>
		</div>
		<?php }} else { ?>
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
<div id="form-edit" class="modal fade" tabindex="-1" data-width="500" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Edit Action Plan Due Date</h4>
	</div>
	<div class="modal-body">
			<input type="hidden"   id = "form-data-revid"  > 
			<form id="input-form" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type="hidden" name="risk_id" value="<?=$risk['risk_id']?>" />
					<input type="hidden" id="form-action-id" name="action_id" value="<?=$action_plan['id_ap']?>" />
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" title="fill this field with the target completion date of risk treatment plan.">Due Date <span class="required">* </span></label>
						<div class="col-md-9">
						<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
						<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 &nbsp;Continuous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
							<input type="text" class="form-control input-sm" name="due_date" id = "due_date" placeholder="select date" readonly>
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
					</div>
					
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button  id="risk-button-save_dd" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
			 <span style="color:#035CFF"><p align="left"><i>Note : <br/> To continue existing control works effectively, please set Due Date by check the "continuous" box 
<br/>If the action plan is not existing control, please set Due Date by select the calendar and ensure the "continuous" box is uncheck</i></p></span>
	</div>
</div>