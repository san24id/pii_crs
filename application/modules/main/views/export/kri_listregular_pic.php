<?php error_reporting(0)?>

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
			<th width="30px">Status</th>
			<th>KRI ID  </th>
			<th>KRI</th>
			<th>Threshold Value</th> 
			<th>Timing Reporting </th>
			<th>Respons</th>
			<th>Supporting Evidence</th>
			<th>Validation</th>
			<th>Assigned To</th>
			<th>KRI Warning</th> 
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Level</th>
			<th>Risk treatment</th>
			<th>Action Plan</th>   

		</tr>
	</thead>
	<tbody>
		<?php 
		$i = 1;
		foreach($datatable as $key):

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
	 		<td valign="top"><?php echo $i++; ?></td>
			<td valign="top"><?=$stat;?></td>
			<td valign="top"><?=$key['kri_code'] ;?></td>
			<td valign="top"><?=$key['key_risk_indicator'] ;?></td>
			<td valign="top"><?=$key['threshold value']; ?></td>  
			<td valign="top"><?=$key['timing_pelaporan_v'] ;?></td>
			<td valign="top"><?=$key['owner_report']; ?></td> 
			<td valign="top"><?=$key['supporting_evidence']; ?></td>
			<td valign="top"><?=$key['validation']; ?></td> 
			<td valign="top"><?=$key['kri_pic_v'] ;?></td>
			<td valign="top"><?=$key['kri_warning'] ;?></td>
			<td valign="top"><?=$key['risk_code'] ;?></td>
			<td valign="top"><?=$key['risk_event']; ?></td>
			<td valign="top"><?=$key['risk_level']; ?></td>
			<td valign="top"><?=$key['suggested_risk_treatment']; ?></td>
			<td valign="top"><?=$key['Action Plan']; ?></td>
		</tr>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>