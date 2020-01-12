<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Action Plan Execution Periode : <?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode a LEFT JOIN (select * from mail_ap_execution b where b.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) ORDER by b.id DESC ) c ON a.periode_id = c.periode_id WHERE a.periode_id IN (SELECT MAX((periode_id)-1) FROM m_periode)";
			$query = $this->db->query($sql)->row();
			echo $query->periode_name;
			echo '&rarr;';
			echo $query->mail_subject;
		?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
			 
				<li>
					<a target="_self" href="javascript:;">Action Plan Execution</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Period Action Plan Execution</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/listprior_apec_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/listprior_apec_excel");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
		</div>

		<!-- END PAGE HEADER-->
		<div class="row">
		<script type="text/javascript">
			/*var g_periode_id = '<?=$periode['periode_id']?>';*/
		</script>
		<div class="col-md-12">
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan_status">Action Plan Status</option>
								<option value="ap_code">AP.ID</option>
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division">Action Plan Owner</option>
								<option value="execution_status">Execution</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_owner">Risk Owner</option>
							</select>
						</div>
						<div class="form-group" id="choose_s_level-execution">
							<select class="form-control input-medium input-sm" id="s_level-execution">
								<option value="-">All Status</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="softreview">Verified By RAC (Soft Review)</option>
								<option value="treatment">Verified By RAC (Final Review)</option>
								<option value="ignore">Ignore</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-execution">
							<select class="form-control input-sm" id="l_divisi-execution">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_owner-execution">
							<select class="form-control input-sm" id="l_owner-execution">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-owner = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_status-execution">
							<select class="form-control input-sm" id="status-execution">
								<option value="-">All</option>
								<option value="ONGOING">ONGOING</option>
								<option value="EXTEND">EXTEND</option>
								<option value="COMPLETE">COMPLETE</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" value="AP." id="ap_id" readonly="" style="width: 47px;"> <input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Refresh table <button type="button" class="btn green btn-sm" id="refresh_prior_ap"><i class="fa fa-refresh" aria-hidden="true"></i>
</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Due Date</center></th>
							<th><center>Action Plan Owner</center></th>
							<th><center>Execution</center></th>
							<th><center>Risk Code</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Risk Level<br>After Mitigation</center></th>
							<th><center>Impact Level<br>After Mitigation</center></th>
							<th><center>Likelihood<br>After Mitigation</center></th>
							<th><center>Action</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					<div class="col-md-12">
					<h4>Legend</h4>
					<?php 
						$sql_draft = "SELECT COUNT(DISTINCT  a.ap_code) as sum_draft FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and (a.action_plan_status = 4 or a.action_plan_status = 5) and (a.existing_control_id is NULL or a.existing_control_id = '') and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_draft = $this->db->query($sql_draft)->row();

						$sql_submit = "SELECT COUNT(DISTINCT  a.ap_code) as sum_submit FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and a.action_plan_status = 6 and (a.existing_control_id is NULL or a.existing_control_id = '') and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_submit = $this->db->query($sql_submit)->row();

						$sql_soft = "SELECT COUNT(DISTINCT  a.ap_code) as sum_soft FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and a.existing_control_id = 'review' and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_soft = $this->db->query($sql_soft)->row();

						$sql_verify = "SELECT COUNT(DISTINCT  a.ap_code) as sum_verify FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and a.action_plan_status = 7 and (a.existing_control_id is NULL or a.existing_control_id = '') and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_verify = $this->db->query($sql_verify)->row();

						$sql_ignore = "SELECT COUNT(DISTINCT  a.ap_code) as sum_ignore FROM t_risk_action_plan a, t_risk b, m_action_plan c  where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and a.existing_control_id = 2 and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_ignore = $this->db->query($sql_ignore)->row();

						$sql_total = "SELECT COUNT(DISTINCT  a.ap_code) as sum_total FROM t_risk_action_plan a, t_risk b, m_action_plan c where a.risk_id = b.risk_id and b.existing_control_id is NULL and a.periode_id = ((select max(periode_id) from m_periode)-1) and a.action_plan_status > 3 and a.switch_flag = 'P' and a.ap_code = c.id";
						$query_total = $this->db->query($sql_total)->row();
					?>
						<table class="table table-bordered" style="width: 40%">
							<tr>
								<th colspan="2">Note &nbsp;:&nbsp;"Ignore" will make the action plan listed on Ignore List and won't show up in action plan owner list (but it remains on the report and the risk register for the next period)</th>
							</tr>
							<tr>	
								<th width="76%" >Status</th>
								<th>Number of Item</th>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 	Draft
								</td>
								<td><?php echo $query_draft->sum_draft; ?></td>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 	Submitted to RAC
								</td>
								<td><?php echo $query_submit->sum_submit; ?></td>
							</tr>
							<tr>
								<td>
									<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 	Verified By RAC (Soft Review)
								</td>
								<td><?php echo $query_soft->sum_soft; ?></td>
							</tr>
							<tr>
								<td>
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC (Final Review)
								</td>
								<td><?php echo $query_verify->sum_verify; ?></td>
							</tr>
							<tr>
								<td>
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 Ignore
								</td>
								<td><?php echo $query_ignore->sum_ignore; ?></td>
							</tr>
							<tr>
								<td>
								 Total
								</td>
								<td><?php echo $query_total->sum_total; ?></td>
							</tr>

						</table>
					</div>
					</div>
		</div>
		</div>
		
	</div>
</div>


<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Risk Library</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="col-md-6 input-group">
					<select class="form-control input-sm" name="filter_search">
						<option value="HIGH">Tinggi</option>
						<option value="MODERATE">Sedang</option>
						<option value="LOW">Rendah</option>
					</select>
					<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" id="modal-library-filter-submit">Search</button>
					</span>
				</div>
				<!--
				<div class="checkbox-list">
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_high" class="checkbox_selectClass" value="HIGH"> Tinggi </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_moderate" class="checkbox_selectClass" value="MODERATE"> Sedang </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_low" class="checkbox_selectClass" value="LOW"> Rendah </label>
				</div>
				-->
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th>No</th>
					<th>Risk ID</th>
					<th>Risk Event</th>
					<th>Risk Level</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button id="library-modal-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
	</div>
</div>

<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Action Plan Edit</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">AP.ID :</label>
							<div class="col-md-9">
							<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="ap_code" id = "ap_code">
							<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="id" id = "id">
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan :</label>
							<div class="col-md-9">
							<textarea class="form-control" name ="action_plan" id ="action_plan"></textarea>  
							<textarea style="display:none;" class="form-control" name = "action_plan_ex" id = "action_plan_ex"></textarea>
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
								<div class="col-md-9">

										
											<input type="button" style="width: 20px; height: 20px;" onclick="Check()" id="ckc" />
											<input type="button"  style=" width: 20px; height: 20px;" onclick="Chckd()" id="kcc" />
						 					&nbsp;Continous&nbsp;<span id="checked"><img width="20px" height="20px" src="<?php echo base_url('assets/images/checkbox-checked.png')?>" /></span>
						 					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d" id="fdate">
										
											
											<input type="text" class="form-control input-sm" name="due_date" id="due_date" placeholder="select date">
									
									<span class="input-group-btn">
									<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								</div>
							</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Action Plan Owner :</label>
							<div class="col-md-9">
							<select name="division"  class="form-control" id = "division"> 
							</select>		
							<input type="hidden" class="form-control" name="division_ex" id = "division_ex"> 
							</div>
						</div>

						<div class="form-group" style="display: none;">
						 
						<label class="col-md-3 control-label smaller cl-compact">Hidden Input :</label>
							<div class="col-md-9">
								<input type="text" class="form-control input-sm" name="action_plan_status" id="action_plan_status">
								<input type="text" class="form-control input-sm" name="periode_id" id="periode_id">

							</div>
						</div>
					
						 
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="library-modal-listriskap-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Save</button>
	</div>
</div>
<div id="modal_ap_verify" class="modal fade" tabindex="-1" data-width="1000" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Form Action Plan Verify</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-verify_ap-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-2 control-label smaller cl-compact">AP.ID :</label>
							<div class="col-md-9">
							<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="ap_code" id = "ap_code">
							<input class="form-control input-sm" readonly="true" type="hidden" placeholder="" name="id" id = "id">
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label smaller cl-compact">Action Plan :</label>
							<div class="col-md-9">
							<textarea class="form-control input-sm input-readview" readonly="true" name ="action_plan"></textarea>  
							<textarea style="display:none;" class="form-control" name = "action_plan_ex" id = "action_plan_ex"></textarea>
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-2 control-label smaller cl-compact" title="fill this field with the target completion date of risk treatment plan.">Due Date</label>
								<div class="col-md-3">
									<input type="text" class="form-control input-sm input-readview" name="due_date" placeholder="select date">
								</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-2 control-label smaller cl-compact">Action Plan Owner :</label>
							<div class="col-md-9">	
							<input type="text" class="form-control input-sm input-readview" name="division_ex" id = "division_ex"> 
							</div>
						</div>

						<div class="form-group" style="display: none;">
						 
						<label class="col-md-3 control-label smaller cl-compact">Hidden Input :</label>
							<div class="col-md-9">
								<input type="text" class="form-control input-sm" name="action_plan_status" id="action_plan_status">
								<input type="text" class="form-control input-sm" name="periode_id" id="periode_id">

							</div>
						</div>
					<hr />
					<div class="form-group">
						<label class="col-md-2 control-label smaller cl-compact">Status  </label>
						<div class="col-md-9">
					
						<select class="form-control input-sm" name="execution_status" id="exec-select-status">
							<option value="COMPLETE">Complete</option>
							<option value="EXTEND">Extend</option>
							<option value="ONGOING">On going</option>
						</select>
						</div>
					</div>

					<div class="form-group" id="fgroup-review">
						<label class="col-md-2 control-label smaller cl-compact">Status Review</label>
						<div class="col-md-9">
						<select class="form-control input-sm" name="review_status" id="review_status" required="required">
							<option value="" style="color: #cccccc;">Choose One</option>
							<option value="0">Soft Review</option>
							<option value="1">Final Review</option>
						</select>
						</div>
					</div>

					<div class="form-group" id="fgroup-explain">
						<label class="col-md-2 control-label smaller cl-compact">Explanation</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_explain" placeholder=""></textarea>
						</div>
					</div>

					<div class="form-group" id="fgroup-evidence">
						<label class="col-md-2 control-label smaller cl-compact">Evidence</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_evidence" placeholder=""></textarea>
						</div>
					</div>
					<div class="form-group" id="fgroup-reason">
						<label class="col-md-2 control-label smaller cl-compact">Reason</label>
						<div class="col-md-9">
						<textarea class="form-control" rows="3" name="execution_reason" placeholder=""></textarea>
						</div>
					</div>

					<div class="form-group" id="fgroup-date">
						<label class="col-md-2 control-label smaller cl-compact">Revised Date</label>
						<div class="col-md-9">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-container='#modal_ap_verify'>
							<input type="text" class="form-control input-sm" name="revised_date" readonly>
							<span class="input-group-btn">
							<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
							</span>
						</div>
						</div>
					</div>

					<br/>
					<div class="form-group">
					<div class="col-md-9">
					<table>
					<tr><td>*Soft review : Action Plan will be continued to the next monitoring session</td></tr>
					<tr><td>*Final review: Action Plan Execution is final</td></tr></table>
					</div>
					</div>

					</div>

				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="exec-button-submit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Verify</button>
	</div>
</div>