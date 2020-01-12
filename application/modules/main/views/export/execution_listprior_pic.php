<?php error_reporting(0)?>
<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN ((SELECT MAX(periode_id) FROM m_periode)-1)";
			$query = $this->db->query($sql)->row();
		?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Export Action Plan Execution Prior Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th>No</th>
			<th>Status </th>  
			<th>AP ID  </th>
			<th>Action Plan  </th>  
			<th>Due Date  </th>
			<th>Assigned To</th>  
			<th>Action Plan Owner </th>  
			<th>Execution  </th>
			<th>Risk ID</th>
			<th>Risk Owner </th>   
			
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			foreach($datatable as $key):?>
			<tr>
			<td valign="top"><?php echo $i++; ?></td>
						<td valign="top"><?php
									if ($key['action_plan_status'] == 4){
										echo "Draft";
									}else if ($key['action_plan_status'] == 5){
										echo "To be verified by Division Head ";
									}else if ($key['action_plan_status'] == 6){
										echo "Submit to RAC";
									}else if ($key['action_plan_status'] == 7){
										echo "Verified by RAC";
									}
									?> </td>   

			<td valign="top"><?=$key['act_code'] ;?></td> 
			<td valign="top"><?=$key['action_plan'] ;?></td>  
			<td valign="top"><?=$key['due_date_v'] ;?></td>
			<td valign="top"><?=$key['assigned_to_v'] ;?></td> 
			<td valign="top"><?=$key['division_name'] ;?></td>  
			<td valign="top"><?=$key['execution_status'] ;?></td> 
			<td valign="top"><?=$key['risk_code'] ;?></td>  
			<td valign="top"><?=$key['risk_owner_v'] ;?></td>    
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>