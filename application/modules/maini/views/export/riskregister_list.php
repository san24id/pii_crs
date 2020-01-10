<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['risk_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['display_name'])):?><th>User  </th><?php endif;?> 
			<?php if(isset($dataget['division_name'])):?><th>Divisi  </th><?php endif;?>  
			<?php if(isset($dataget['tanggal_submit'])):?><th>Submission Date  </th><?php endif;?>  
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
		<?php 
		if ($key['risk_status'] == '0' || $key['risk_status'] == '1') {
			$stat = "Draft";
		}else
		if($key['risk_status']=="2"){
			$stat = "submitted to rac";
		}	
		else{
			$stat = "Verified By RAC";
		} 
		?>
		
	 	<tr>
			<?php if(isset($dataget['risk_status'])):?><td><?=$stat;?></td><?php endif;?> 
			<?php if(isset($dataget['display_name'])):?><td><?=$key['display_name'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['division_name'])):?><td><?=$key['division_name'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['tanggal_submit'])):?><td><?=$key['tanggal_submit'] ;?></td><?php endif;?>  
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>