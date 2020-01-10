<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['kri_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><th>KRI ID  </th><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><th>KRI Owner  </th><?php endif;?> 
			<?php if(isset($dataget['treshold'])):?><th>Timing Pelaporan </th><?php endif;?> 
			<?php if(isset($dataget['timing_pelaporan_v'])):?><th>Risk ID  </th><?php endif;?> 
			<?php if(isset($dataget['kri_warning'])):?><th>KRI Warning  </th><?php endif;?>  
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
		<?php 
		if ($key['kri_status'] == '0') {
			$stat = "Draft";
		}
		if($key['kri_status']=="1"){
			$stat = "submitted to rac";
		}	
		if($key['kri_status']=="2"  ){
			$stat = "submitted to rac";
		}	
		if($key['kri_status'] > "2" ){
			$stat = "Verified By RAC";
		}	 
		?>
		
	 	<tr>
			<?php if(isset($dataget['kri_status'])):?><td><?=$stat;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_code'])):?><td><?=$key['kri_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['key_risk_indicator'])):?><td><?=$key['key_risk_indicator'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['treshold'])):?><td><?=$key['treshold'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['timing_pelaporan_v'])):?><td><?=$key['timing_pelaporan_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['kri_warning'])):?><td><?=$key['kri_warning'] ;?></td><?php endif;?>  
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>