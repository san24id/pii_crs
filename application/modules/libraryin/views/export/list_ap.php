
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Library Of Action Plan    </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >AP ID</th>  
			<th  >Action Plan</th>  
			<th  >Action Plan Owner</th>
			<th  >Risk ID</th>    
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):

		$this->load->database();
		$sql2 = "SELECT DISTINCT b.id, b.action_plan, b.division, c.risk_code, e.division_name
				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id WHERE b.id ='".$key['id']."'and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
		$query2 = $this->db->query($sql2);
		$total = $query2->num_rows();
		?> 
	 	<tr>  
			<td valign="top">AP.<?=$key['id'];?></td>
			<td valign="top"><?=$key['action_plan'];?></td>
			<td valign="top"><?=$key['division_name'];?></td>
			<td>
				<table border="1">
					<?php foreach ($query2->result_array() as $key1){ ?>
						<tr>
							<td valign="top"><?=$key1['risk_code'];?></td>
						</tr>
					<?php }?>
				</table>
			</td>  
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>