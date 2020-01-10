
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b>      Library of Existing Control     </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >Existing Control ID</th>  
			<th  >Existing Control</th>  
			<th  >Evaluation Control</th>  
			<th  >Control Owner</th>   
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):

			$this->load->database();
			$sql2 = "SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name, c.risk_code 
				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id WHERE b.id ='".$key['id']."' and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' ORDER BY c.risk_code ASC";
		$query2 = $this->db->query($sql2);
		$total = $query2->num_rows();

		?> 
	 	<tr>  
			<td valign="top">EC.<?=$key['id'];?></td>
			<td valign="top"><?=$key['risk_evaluation_control'];?></td>
			<td valign="top"><?=$key['risk_existing_control'];?></td>
			<td valign="top"><?=$key['division_name'];?></td>
			<td><table border="1">
					<?php foreach ($query2->result_array() as $key1){ ?>
						<tr>
							<td valign="top"><?=$key1['risk_code'];?></td>
						</tr>
					<?php }?>
				</table></td> 
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>