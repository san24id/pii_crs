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
					<a target="_self" href="javascript:;">Prior Period Action Plan Execution</a>
				</li>
			</ul>
			<div class="page-toolbar">
					<?php 
						  $role = $this->session->credential['main_role_id'];
						  $divisi = $this->session->credential['division_id'];
						  $user = $this->session->credential['username']; 
					?>
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/main/getExecutionPriorUser_pdf?role=$role&divisi=$divisi&user=$user");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/main/getExecutionPriorUser_excel?role=$role&divisi=$divisi&user=$user");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
		</div>

		<!-- END PAGE HEADER-->
		<div class="row">
		<script type="text/javascript">
		</script>
		<div class="col-md-12">
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Due Date</option>
								<option value="division">Action Plan Owner</option>
								<option value="execution_status">Execution</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_owner">Risk Owner</option>
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
						<div class="form-group" id="choose_status-execution">
							<select class="form-control input-sm" id="status-execution">
								<option value="-">All</option>
								<option value="ONGOING">ONGOING</option>
								<option value="EXTEND">EXTEND</option>
								<option value="COMPLETE">COMPLETE</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Search</button>
					</form>
					<?php if($this->session->credential['main_role_id'] == 4 || $this->session->credential['main_role_id'] == 2){?>
							<a data-toggle="modal" href="#modal-action_plan_exe" 
							class="btn default green pull-right">
							<i class="fa fa-check-square-o"></i>
							<span class="hidden-480">
							Confirmation Letter for My Action Plan Execution</span>
							</a>
					<?php } ?>	
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Due Date</center></th>
							<th><center>Assigned To</center></th>
							<th><center>Action Plan Owner</center></th>
							<th><center>Execution</center></th>
							<th><center>Risk Code</center></th>
							<th><center>Risk Owner</center></th>
							<th width="20px"><center>Change Request</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					<div class="col-md-6">
					<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/confirm.png"/> &nbsp; 
								 submitted to Head
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
						</ul>
					</div>
					</div>
		</div>
		</div>
		
	</div>
</div>


<!-- LIBRARY -->
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

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Select Assignee</h4>
	</div>
	<div class="modal-body">
		<table id="pic_list_table" class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th width="30px">&nbsp;</th>
				<th>Name</th>
				<th>Division</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($pic_list as $k=>$row) { ?>
			<tr id="modal-pic-tr-<?=$k?>">
				<td>
				<div class="btn-group">
					<button value_idx="<?=$k?>" value="<?=$row['username']?>" type="button" class="btn btn-default btn-xs button-assign-pic"><i class="fa fa-check-circle font-blue"> Select </i></button>
				</div>
				</td>
				<td class="col_display_name"><?=$row['display_name']?></td>
				<td><?=$row['division_name']?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Execution Form -->
<div id="modal-exec" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Action Plan Execution</h4>
	</div>
	<div class="modal-body form">
		<form id="exec-form" role="form" class="form-horizontal">
		<input type="hidden" id="form-action-id" name="action_id" value="" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 smaller control-label">Status </label>
					<div class="col-md-9">
					<select class="form-control input-sm" name="execution_status" id="exec-select-status">
						<option value="COMPLETE" selected>Complete</option>
						<option value="EXTEND">Extend</option>
						<option value="ONGOING">On Going</option>
					</select>
					</div>
				</div>
				<div class="form-group" id="fgroup-explain">
					<label class="col-md-3 control-label smaller cl-compact">Explanation<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_explain" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-evidence">
					<label class="col-md-3 control-label smaller cl-compact">Evidence</label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_evidence" placeholder=""></textarea>
					</div>
				</div>				 
				<div class="form-group" id="fgroup-reason">
					<label class="col-md-3 control-label smaller cl-compact">Reason<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_reason" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-date">
					<label class="col-md-3 smaller control-label">Revised Date<span class="required">* </span></label>
					<div class="col-md-9">
					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
						<input type="text" class="form-control input-sm" id="form-action-dd" name="revised_date" readonly>
						<span class="input-group-btn">
						<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
			
			<div class="form-actions right">
				<button id="exec-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Submit </button>
				<button id="exec-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Save </button>
				<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
			</div>
		</form>
	</div>
</div>

<!-- action_plan_execution -->
<div id="modal-action_plan_exe" class="modal fade" tabindex="-1" data-width="960" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Confirmation Letter for Action Plan Execution</h4>
	</div>
	<div class="modal-body">
		<div class="form">
				<form id="input-form-action_plan_exe" role="form" class="form-horizontal">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
							<textarea class="form-control input-readview" readonly="true" rows="8" name="s_action_plan_exe" placeholder="Message Text" id="s_action_plan_exe" readonly><?=$s_action_plan_exe['text']?></textarea>
									</div>
						</div>
						<div class="col-md-9"></div><div class="col-md-3">An.<br /><?php echo $this->session->credential['display_name']; ?></div>
						<br />
					</div>
				</form>
			</div>
		</div>

	<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<?php 
		$session_data = $this->session->credential;
		$this->load->database();
		$sql = "select risk_input_by from t_risk_add_owner_apex where risk_input_by = '".$session_data['username']."' and periode_id = ((select max(periode_id) from m_periode)-1) and status = 1 and type = 'prior' and id_apex = (SELECT MAX(id) FROM mail_ap_execution WHERE periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1))";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){ ?>
			<button type="button" class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
		<?php }else{
				$sql_ap = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, a.existing_control_id, date_format(a.revised_date, '%d-%m-%Y') as revised_date_v,
                                                                                                
                    concat('AP.', LPAD(f.id, 6, '0')) as act_code,

                    (select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

                    (select group_concat(concat('<a href=index.php/main/viewRisk/',c.risk_id,'>',c.risk_code,'</a>') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code,

          (SELECT GROUP_CONCAT(f.division_name SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner_v,


           (SELECT GROUP_CONCAT(f.division_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner, 

                    c.display_name as assigned_to_v,
                    d.division_name as division_name,
                    (select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
                    from 
                    t_risk_action_plan a
                    left join t_risk b on a.risk_id = b.risk_id
                    left join m_user c on a.assigned_to = c.username
                    left join m_division d on a.division = d.division_id
                    left join m_periode on m_periode.periode_id = b.periode_id
                    join m_action_plan f on a.ap_code = f.id and a.division = f.division

                        JOIN (SELECT b.id as id, count(b.id) as jml_id
                        FROM t_risk_action_plan a 
                        JOIN m_action_plan b ON a.ap_code = b.id and a.division = b.division 
                        JOIN t_risk c ON a.risk_id = c.risk_id
                        JOIN m_division e ON a.division = e.division_id  
                        JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = ((select MAX(periode_id) from m_periode)-1) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

                    where 
                    b.periode_id = ((select max(periode_id) from m_periode)-1) and
                    a.action_plan_status > 3 and a.action_plan_status < 6 and a.division = '".$session_data['division_id']."' and (a.existing_control_id is NULL or a.existing_control_id = 'review' or a.existing_control_id = 1) and b.switch_flag = 'P'";
				$query_ap = $this->db->query($sql_ap);

					if($query_ap->num_rows() == 0){?>
						<button id="submit-action_plan_exe" type="button" class="btn blue ladda-button" data-style="expand-right">Sign</button>
						<button type="button" id = 'ar3' class="btn blue ladda-button" data-style="expand-right" disabled >Already Sign</button>
				<?php }else{ ?>
		 		   <button type="button" id="p3" class="btn blue ladda-button" data-style="expand-right" disabled>pending..</button>
		<?php }}?>
	</div>	
</div>