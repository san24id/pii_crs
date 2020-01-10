<?php error_reporting(0)?>
<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
			$query = $this->db->query($sql)->row();
		?>
<?php if($this->session->credential['main_role_id'] == 2){?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard KRI List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['kri_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><th>KRI ID  </th><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><th>KRI</th><?php endif;?> 
			<?php if(isset($dataget['kri_owner'])):?><th>KRI Owner </th><?php endif;?> 
			<?php if(isset($dataget['timing_pelaporan_v'])):?><th>Timing Reporting </th><?php endif;?>
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID</th><?php endif;?>  
			<?php if(isset($dataget['kri_warning'])):?><th>KRI Warning  </th><?php endif;?>  
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
		<?php 
		if ($key['kri_status'] == '0') {
			$stat = "Save Draft";
		}
		if($key['kri_status']=="1"){
			$stat = "Draft";
		}	
		if($key['kri_status']=="2"  ){
			$stat = "To be verified by Division Head";
		}	
		if($key['kri_status'] == "3" ){
			$stat = "Submitted to RAC";
		}
		if($key['kri_status'] == "4" ){
			$stat = "Verified by RAC";
		}	 
		?>
		
	 	<tr>
			<?php if(isset($dataget['kri_status'])):?><td><?=$stat;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><td><?=$key['kri_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><td><?=$key['key_risk_indicator'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_owner'])):?><td><?=$key['kri_owner_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['timing_pelaporan_v'])):?><td><?=$key['timing_pelaporan_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><td><?=$key['risk_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_warning'])):?><td><?=$key['kri_warning'] ;?></td><?php endif;?>  
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>
<?php }else{ ?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard KRI List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['kri_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><th>KRI ID  </th><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><th>KRI</th><?php endif;?>
			<th>Threshold Value</th> 
			<?php if(isset($dataget['timing_pelaporan_v'])):?><th>Timing Reporting </th><?php endif;?>
			<th>Respons</th>
			<th>Supporting Evidence</th>
			<th>Validation</th>
			<?php if(isset($dataget['assigned_to'])):?><th>Assigned To</th><?php endif;?>
			<th>KRI Warning</th> 
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID</th><?php endif;?>
			<th>Risk Event</th>
			<th>Risk Level</th>
			<th>Risk treatment</th>
			<th>Action Plan</th>  

		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
		<?php 
		if ($key['kri_status'] == '0') {
			$stat = "Save Draft";
		}
		if($key['kri_status']=="1"){
			$stat = "Draft";
		}	
		if($key['kri_status']=="2"  ){
			$stat = "To be verified by Division Head";
		}	
		if($key['kri_status'] == "3" ){
			$stat = "Submitted to RAC";
		}
		if($key['kri_status'] == "4" ){
			$stat = "Verified by RAC";
		}	 
		?>
		
	 	<tr>
			<?php if(isset($dataget['kri_status'])):?><td valign="top"><?=$stat;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><td valign="top"><?=$key['kri_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><td valign="top"><?=$key['key_risk_indicator'] ;?></td><?php endif;?>
			<td valign="top"><?=$key['threshold value']; ?></td>  
			<?php if(isset($dataget['timing_pelaporan_v'])):?><td valign="top"><?=$key['timing_pelaporan_v'] ;?></td><?php endif;?>
			<td valign="top"><?=$key['owner_report']; ?></td> 
			<td valign="top"><?=$key['supporting_evidence']; ?></td>
			<td valign="top"><?=$key['validation']; ?></td> 
			<?php if(isset($dataget['assigned_to'])):?><td valign="top"><?=$key['kri_pic_v'] ;?></td><?php endif;?> 
			<td valign="top"><?=$key['kri_warning'] ;?></td>
			<?php if(isset($dataget['risk_code'])):?><td valign="top"><?=$key['risk_code'] ;?></td><?php endif;?>
			<td valign="top"><?=$key['risk_event']; ?></td>
			<td valign="top"><?=$key['risk_level']; ?></td>
			<td valign="top"><?=$key['suggested_risk_treatment']; ?></td>
			<td valign="top"><?=$key['Action Plan']; ?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php } ?>