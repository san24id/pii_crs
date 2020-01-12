<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<?php if(isset($dataget['action_plan_status'])):?><th width="30px">Status</th><?php endif;?> 
			<?php if(isset($dataget['action_plan_status'])):?><th>Execution Status </th><?php endif;?>  
			<?php if(isset($dataget['act_code'])):?><th>AP ID  </th><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><th>Action Plan  </th><?php endif;?>  
			<?php if(isset($dataget['due_date_v'])):?><th>Due Date  </th><?php endif;?>  
			<?php if(isset($dataget['division_name'])):?><th>Action Plan Owner </th><?php endif;?>  
			<?php if(isset($dataget['execution_status'])):?><th>Execution  </th><?php endif;?>  
			
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		 
			<?php 
			if ($key['action_plan_status'] == '4') {
				$stat = "Draft";
			}
			if($key['action_plan_status']=="5"){
				$stat = "Verified By Head";
			}	
			if($key['action_plan_status']=="6"){
				$stat = "submitted to rac";
			}	
			if($key['action_plan_status'] > "6"){
				$stat = "Verified By RAC";
			}	 
			?>
		
	 	<tr>
			<?php if(isset($dataget['action_plan_status'])):?><td><?=$stat;?></td><?php endif;?> 
						<?php if(isset($dataget['action_plan_status'])):?><td> <?php
									if ($key['action_plan_status'] == 0){
										echo "Draft";
									}else if ($key['action_plan_status'] == 1){
										echo "Draft";
									}else if ($key['action_plan_status'] == 2){
										echo "Submit To RAC";
									}else if ($key['action_plan_status'] == 3){
										echo "Verified By RAC";
									}else if ($key['action_plan_status'] == 4){
										echo "On Risk Treatment Process";
									}else if ($key['action_plan_status'] == 5){
										echo "On Risk Treatment Process";
									}else if ($key['action_plan_status'] == 6){
										echo "On Risk Treatment Process";
									}else if ($key['action_plan_status'] == 10){
										echo "on Action Plan Process";
									}else{
										echo "Action Plan Has Been Executed and Verified";
									}
									?> </td><?php endif;?>   

			<?php if(isset($dataget['act_code'])):?><td><?=$key['act_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['action_plan'])):?><td><?=$key['action_plan'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['due_date_v'])):?><td><?=$key['due_date_v'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['division_name'])):?><td><?=$key['division_name'] ;?></td><?php endif;?>  
			<?php if(isset($dataget['execution_status'])):?><td><?=$key['execution_status'] ;?></td><?php endif;?>   
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>