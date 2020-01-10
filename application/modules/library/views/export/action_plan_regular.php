		<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
			$query = $this->db->query($sql)->row();
		?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Export Action Plan Execution Periode : <?php echo $query->periode_name; ?></div>
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
			<th>Risk Code</th>
			<th>Risk Owner</th>   
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
	 				if($key['action_plan_status'] == 4){
	 					echo "Draft";
	 				}else if($key['action_plan_status'] == 5){
	 					echo "To be verified by Division Head";
	 				}else if($key['action_plan_status'] == 6){
	 					echo "Submitted to RAC";
	 				}else if($key['action_plan_status'] == 7){
	 					echo "Verified by RAC";
	 				}
	 				?></td>
			<td><?=$key['act_code'];?></td>
			<td><?=$key['action_plan'];?></td>
			<td><?=$key['due_date_v'];?></td> 
			<td><?=$key['division_name'];?></td>
			<td><?=$key['execution_status'];?></td>
			<td><?=$key['risk_code']; ?></td>
			<td><?=$key['risk_owner_v']; ?></td>
		</tr>
		<?php endforeach;?>
	<?php else:?>
		<tr>  
			<td colspan = "8"><center>No Data</center></td>
			 
		</tr>
	<?php endif;?>
	</tbody>
</table>