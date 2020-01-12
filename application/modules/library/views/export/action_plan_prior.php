	
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b>Export Action Plan Execution Periode : <?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode a LEFT JOIN (select * from mail_ap_execution b where b.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) ORDER by b.id DESC ) c ON a.periode_id = c.periode_id WHERE a.periode_id IN (SELECT MAX((periode_id)-1) FROM m_periode)";
			$query = $this->db->query($sql)->row();
			echo $query->periode_name;
			echo '&rarr;';
			echo $query->mail_subject; 
			?></b></font></div>
</div>	 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1"> 
	<thead>
		<tr role="row" class="heading">
			<th>No</th>
			<th>Status </th>
			<th>AP ID</th>  
			<th>Action Plan</th>  
			<th>Due Date</th>  
			<th>Action Plan Owner</th>
			<th>Execution</th>
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Description</th>
			<th>Risk Owner</th>
			<th>Impact Level<br>After Mitigation</th>
			<th>Likelihood<br>After Mitigation</th>
			<th>Risk Level<br>After Mitigation</th>     
		</tr>
	</thead>
	<tbody>
	<?php if($datanya):?>
		<?php 
			$i = 1;
			foreach($datanya as $key):?> 
	 	<tr>
	 		<td><?php echo $i++; ?></td>
	 		<td><?php
	 				if($key['existing_control_id'] == 2){
	 					echo "Ignore";
	 				}
	 				else if($key['existing_control_id'] == 'review'){
	 					echo "Verified By RAC (Soft Review)";
	 				}
	 				else if($key['action_plan_status'] == 4 || $key['action_plan_status'] == 5){
	 					echo "Draft";
	 				}else if($key['action_plan_status'] == 6){
	 					echo "Submitted to RAC";
	 				}else if($key['action_plan_status'] == 7){
	 					echo "Verified By RAC (Final Review)";
	 				}
	 				?></td>
			<td><?=$key['act_code'];?></td>
			<td><?=$key['action_plan'];?></td>
			<td><?=$key['due_date_v'];?></td> 
			<td><?=$key['division_name'];?></td>
			<td><?=$key['execution_status'];?></td>
			<td><?=$key['risk_code']; ?></td>
			<td><?=$key['risk_event']; ?></td>
			<td><?=$key['risk_description']; ?></td>
			<td><?=$key['risk_owner_v']; ?></td>
			<td><?=$key['risk_level_after_mitigation_v'];?></td>
			<td><?=$key['impact_level_after_mitigation_v']; ?></td>
			<td><?=$key['likelihood_after_mitigation_v']; ?></td>
		</tr>
		<?php endforeach;?>
	<?php else:?>
		<tr>  
			<td colspan = "8"><center>No Data</center></td>
			 
		</tr>
	<?php endif;?>
	</tbody>
</table>