<?php error_reporting(0)?>
<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
			$query = $this->db->query($sql)->row();
		?>
<?php if($this->session->credential['main_role_id'] == 2){?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Risk Treatment List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['risk_status'])):?><th>Treatment Status  </th><?php endif;?>
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID  </th><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><th>Risk Event  </th><?php endif;?>  
			<?php if(isset($dataget['risk_owner_v'])):?><th>Risk Owner  </th><?php endif;?>
			<?php if(isset($dataget['suggested_risk_treatment_v'])):?><th>Risk Treatment  </th><?php endif;?>
			
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
			<?php if(isset($dataget['risk_status'])):?><td> <?php
									if ($key['risk_status'] == 3){
										echo "Draft";
									}else if ($key['risk_status'] == 4){
										echo "To be verified by Division Head";
									}else if ($key['risk_status'] == 5){
										echo "Submitted to RAC ";
									}else if ($key['risk_status'] == 6){
										echo "Verified By RAC";
									}
									?> </td><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><td><?=$key['risk_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><td><?=$key['risk_event'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['risk_owner_v'])):?><td><?=$key['risk_owner_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['suggested_risk_treatment_v'])):?><td><?=$key['suggested_risk_treatment_v'] ;?></td><?php endif;?> 
			

		</tr>
		<?php endforeach;?>
	</tbody>
	</table>
<?php }else{ ?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Risk Owned By Me Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['risk_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID  </th><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><th>Risk Event  </th><?php endif;?>
			<th>Risk Description</th> 
			<th>Risk Category</th>
			<th>Risk Sub Category</th> 
			<th>Risk 2nd Sub Category</th>   
			<th>Risk Cause</th>
			<th>Risk Impact</th>
			<?php if(isset($dataget['risk_level_v'])):?><th>Risk Level  </th><?php endif;?> 
			<?php if(isset($dataget['impact_level_v'])):?><th> Impact Level  </th><?php endif;?> 
			<?php if(isset($dataget['likelihood_v'])):?><th>Likelihood  </th><?php endif;?> 
			<?php if(isset($dataget['risk_owner_v'])):?><th>Risk Owner  </th><?php endif;?>
			<?php if(isset($dataget['assigned_to'])):?><th>Assigned To </th><?php endif;?>
			<?php if(isset($dataget['suggested_risk_treatment_v'])):?><th>Risk Treatment  </th><?php endif;?>
			<th>Risk Objective</th>
			<th>Existing Control</th>
			<th>Evaluation Control</th>
			<th>Control Owner</th>
			<th>Action Plan</th>
			<th>Action Plan Owner</th> 
			
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
			<?php if(isset($dataget['risk_status'])):?><td valign="top"> <?php
									if ($key['risk_status'] == 3){
										echo "Draft";
									}else if ($key['risk_status'] == 4){
										echo "To be verified by Division Head";
									}else if ($key['risk_status'] == 5){
										echo "Submitted to RAC ";
									}else if ($key['risk_status'] == 6){
										echo "Verified By RAC";
									}
									?> </td><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><td valign="top"><?=$key['risk_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><td valign="top"><?=$key['risk_event'] ;?></td><?php endif;?> 
			<td valign="top"><?=$key['risk_description']; ?></td>
			<td valign="top"><?=$key['risk_category_v']; ?></td>
			<td valign="top"><?=$key['risk_sub_category_v']; ?></td>
			<td valign="top"><?=$key['risk_2nd_sub_category_v']; ?></td>
			<td valign="top"><?=$key['risk_cause']; ?></td>
			<td valign="top"><?=$key['risk_impact']; ?></td>
			<?php if(isset($dataget['risk_level_v'])):?><td valign="top"><?=$key['risk_level_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['impact_level_v'])):?><td valign="top"><?=$key['impact_level_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['likelihood_v'])):?><td valign="top"><?=$key['likelihood_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['risk_owner_v'])):?><td valign="top"><?=$key['risk_owner_v'] ;?></td><?php endif;?>
			<?php if(isset($dataget['assigned_to'])):?><td valign="top"><?=$key['risk_treatment_owner_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['suggested_risk_treatment_v'])):?><td valign="top"><?=$key['suggested_risk_treatment_v'] ;?></td><?php endif;?>
			<td valign="top"><?=$key['Objective']; ?></td>
			<td valign="top"><?=$key['Existing Control']; ?></td>
			<td valign="top"><?=$key['Evaluation Control']; ?></td>
			<td valign="top"><?=$key['Control Owner']; ?></td>
			<td valign="top"><?=$key['Action Plan']; ?></td>
			<td valign="top"><?=$key['Action Plan Owner_v']; ?></td> 
			

		</tr>
		<?php endforeach;?>
	</tbody>
	</table>
<?php } ?>