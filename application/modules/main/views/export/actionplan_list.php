<?php error_reporting(0)?>
<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
			$query = $this->db->query($sql)->row();
		?>
<?php if($this->session->credential['main_role_id'] == 2){?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Action Plan List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['action_plan_status'])):?><th>Action Plan Status</th><?php endif;?>  
			<?php if(isset($dataget['act_code'])):?><th>AP ID  </th><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><th>Action Plan  </th><?php endif;?>  
			<?php if(isset($dataget['due_date_v'])):?><th>Due Date </th><?php endif;?>  
			<?php if(isset($dataget['division_name'])):?><th>Action Plan Owner  </th><?php endif;?>  
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID  </th><?php endif;?>
			<?php if(isset($dataget['risk_owner'])):?><th>Risk Owner  </th><?php endif;?>  
		    
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		
			<?php if(isset($dataget['action_plan_status'])):?><td> <?php
									if ($key['action_plan_status'] == 1){
										echo "Draft";
									}else if ($key['action_plan_status'] == 2){
										echo "To be verified by Division Head";
									}else if ($key['action_plan_status'] == 3){
										echo "Submitted to RAC";
									}else if ($key['action_plan_status'] > 3){
										echo " Verified by RAC";
									}
									?> </td><?php endif;?>  
		
			<?php if(isset($dataget['act_code'])):?><td><?=$key['act_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><td><?=$key['action_plan'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['due_date_v'])):?><td><?=$key['due_date_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['division_name'])):?><td><?=$key['division_name'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['risk_code'])):?><td><?=$key['risk_code'] ;?></td><?php endif;?>
			<?php if(isset($dataget['risk_owner'])):?><td><?=$key['risk_owner_v'] ;?></td><?php endif;?>   
			
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>

<?php }else{ ?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Action Plan List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['action_plan_status'])):?><th>Action Plan Status</th><?php endif;?>  
			<?php if(isset($dataget['act_code'])):?><th>AP ID  </th><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><th>Action Plan  </th><?php endif;?>  
			<?php if(isset($dataget['due_date_v'])):?><th>Due Date </th><?php endif;?>
			<?php if(isset($dataget['assigned_to'])):?><th>Assigned To </th><?php endif;?>    
			<?php if(isset($dataget['division_name'])):?><th>Action Plan Owner  </th><?php endif;?>  
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID  </th><?php endif;?>
			<?php if(isset($dataget['risk_owner'])):?><th>Risk Owner  </th><?php endif;?>  
		    
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		
			<?php if(isset($dataget['action_plan_status'])):?><td> <?php
									if ($key['action_plan_status'] == 1){
										echo "Draft";
									}else if ($key['action_plan_status'] == 2){
										echo "To be verified by Division Head";
									}else if ($key['action_plan_status'] == 3){
										echo "Submitted to RAC";
									}else if ($key['action_plan_status'] > 3){
										echo " Verified by RAC";
									}
									?> </td><?php endif;?>  
		
			<?php if(isset($dataget['act_code'])):?><td><?=$key['act_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><td><?=$key['action_plan'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['due_date_v'])):?><td><?=$key['due_date_v'] ;?></td><?php endif;?>
			<?php if(isset($dataget['assigned_to'])):?><td><?=$key['assigned_to_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['division_name'])):?><td><?=$key['division_name'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['risk_code'])):?><td><?=$key['risk_code'] ;?></td><?php endif;?>
			<?php if(isset($dataget['risk_owner'])):?><td><?=$key['risk_owner_v'] ;?></td><?php endif;?>   
			
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>
<?php } ?>