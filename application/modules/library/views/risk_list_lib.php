<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk List
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-angle-left"></i>
					<a target="_self" href="javascript:history.back()">Back</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Risk List</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
	<?php 
$username = $this->session->credential['username'];
	$this->load->database();
	$id = $_GET['id'];
	$status = $_GET['status'];
	if($status == 'ap'){
	$sql="SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name, c.risk_code, c.risk_id, c.risk_event, c.risk_description, c.risk_cause, c.risk_impact
				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id 
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id where b.id = '$id' and c.existing_control_id is null and c.risk_status > 2 and a.action_plan_status > 0 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
	$query = $this->db->query($sql);
	}else if($status == 'ape'){
	$sql="SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name, c.risk_code, c.risk_id, c.risk_event, c.risk_description, c.risk_cause, c.risk_impact
				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id 
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id where b.id = '$id' and c.existing_control_id is null and c.risk_status > 2 and a.action_plan_status > 2 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
	$query = $this->db->query($sql);
	}else if($status == 'ob'){
	$sql="SELECT DISTINCT b.id, b.objective, c.risk_code, c.risk_id, c.risk_event, c.risk_description, c.risk_cause, c.risk_impact
				FROM t_risk_objective a 
				JOIN m_objective b ON a.objective = b.objective 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id  where b.id = '$id' and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
	$query = $this->db->query($sql);

	}else if($status == 'ec'){
			$sql="SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name, c.risk_code, c.risk_id, c.risk_event, c.risk_description, c.risk_cause, c.risk_impact
				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id  where b.id = '$id' and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
	$query = $this->db->query($sql);
	}

?>

<!-- LIBRARY -->
<div id="modal-library" class="" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<h4 class="modal-title">Risk</h4>
	</div>
	<div class="modal-body">
		<div>
			<table class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					
					<th>Risk ID</th>
					<th width="30%">Risk Event</th>
					<th width="65%">Risk Description</th>
				</tr>
				</thead>
				<tbody>
			    <?php 
      				 foreach ($query->result_array() as $row)
   						{
      			?>
      			<tr>
      				<td><a href="<?php echo $site_url ?>/main/viewRisk/<?php echo $row['risk_id'] ?>"> <?php echo $row['risk_code']; ?></a></td>
      				<td><?php echo $row['risk_event']; ?></td>
      				<td><?php echo $row['risk_description']; ?></td>
      			<?php }?>
      			</tr>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
</div>

</div>