<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['risk_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><th>Risk ID  </th><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><th>Risk Event  </th><?php endif;?> 
			<?php if(isset($dataget['risk_level_v'])):?><th>Impact Level  </th><?php endif;?> 
			<?php if(isset($dataget['impact_level_v'])):?><th>Likelihood  </th><?php endif;?> 
			<?php if(isset($dataget['likelihood_v'])):?><th>Risk Level  </th><?php endif;?> 
			<?php if(isset($dataget['risk_owner_v'])):?><th>Risk Owner  </th><?php endif;?> 
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
		<?php 
		if ($key['risk_status'] == '0' || $key['risk_status'] == '1') {
			$stat = "Draft";
		}
		if($key['risk_status']=="2"){
			$stat = "submitted to rac";
		}	
		if($key['risk_status']=="3" || $key['risk_status']=="4" ){
			$stat = "Verified By RAC";
		}	
		if($key['risk_status']=="5" || $key['risk_status']=="6" ){
			$stat = "on Risk Treatment Process";
		}	
		if($key['risk_status']=="10"  ){
			$stat = "on Action Plan Process";
		}	
		if($key['risk_status']=="20"  ){
			$stat = "Action Plan Has Been Executed and Verified";
		}	
		?>
		
	 	<tr>
			<?php if(isset($dataget['risk_status'])):?><td><?=$stat ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_code'])):?><td><?=$key['risk_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_event'])):?><td><?=$key['risk_event'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_level_v'])):?><td><?=$key['risk_level_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['impact_level_v'])):?><td><?=$key['impact_level_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['likelihood_v'])):?><td><?=$key['likelihood_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['risk_owner_v'])):?><td><?=$key['risk_owner_v'] ;?></td><?php endif;?> 
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>