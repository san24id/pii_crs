		<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN ((SELECT MAX(periode_id) FROM m_periode)-1)";
			$query = $this->db->query($sql)->row();
		?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Export Key Risk Indicator(KRI) Regular Periode : <?php echo $query->periode_name; ?></div>
</div>	 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1"> 
	<thead>
		<tr role="row" class="heading">
			<th>No</th>
			<th>Status </th>
			<th>KRI ID</th>  
			<th>KRI</th>  
			<th>KRI Owner</th>  
			<th>Time Reporting</th>
			<th>Risk ID</th>
			<th>KRI Warning</th>   
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
	 				if($key['kri_status'] == 0){
	 					echo "Save Draft";
	 				}else if($key['kri_status'] == 1){
	 					echo "Draft";
	 				}else if($key['kri_status'] == 2){
	 					echo "To be verified by Division Head";
	 				}else if($key['kri_status'] == 3){
	 					echo "Submitted to RAC";
	 				}else if($key['kri_status'] == 4){
	 					echo "Verified by RAC";
	 				}
	 				?></td>
			<td><?=$key['kri_code'];?></td>
			<td><?=$key['key_risk_indicator'];?></td>
			<td><?=$key['division_name'];?></td> 
			<td><?=$key['timing_pelaporan_v'];?></td>
			<td><?=$key['risk_code'];?></td>
			<td><?=$key['kri_warning']; ?></td>
		</tr>
		<?php endforeach;?>
	<?php else:?>
		<tr>  
			<td colspan = "8"><center>No Data</center></td>
			 
		</tr>
	<?php endif;?>
	</tbody>
</table>