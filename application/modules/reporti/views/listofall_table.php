 
		 
			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>List of All Action Plan Execution with status <?=$postnya['status'];?> </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b> Periode <?=$cekperiode[0]['periode_name'];?> (<?=date('d M Y',strtotime($cekperiode[0]['periode_start']));?>) s/d (<?=date('d M Y',strtotime($cekperiode[0]['periode_end']));?>)  </b></font> 
						</div>						 
					</center>
			 </div>
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
							<th>No</th>
							<th>Status</th>
							<th>AP.ID</th>
							<th>Action Plan</th>
							<th>Due Date</th>
							<th>Action Plan Owner</th>
							<th>Assignee</th> 
							<th>Execution</th>
							<th>Explain</th> 
							<th>Evidence</th> 
							<th>Reason Revised Date</th>
							<th>Revised Date</th>
							<th>Risk ID</th>
							<th>Risk Event</th>
							<th>Risk Description</th> 
							
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $key):?>
							<tr>	
								<td valign="top"><?=$i;?></td>
								<td valign="top"><?php 
										if($key['action_plan_status'] == 4){
											echo 'Draf';
										}else if($key['action_plan_status'] == 5){
											echo 'To Be Verified by Head Division';
										}else if($key['action_plan_status'] == 6){
											echo 'Submitted to RAC';
										}else{
											echo 'Verified by RAC';
										}
								?></td>
								<td valign="top"><?=$key['act_code'];?></td>
								<td valign="top"><?=$key['action_plan'];?></td>
								<td valign="top"><?php
											if($key['due_date_v'] == '00-00-0000'){
												echo "Continuous";
											}else{
												echo $key['due_date_v'];
											}
											?></td>
								<td valign="top"><?=$key['division_name'];?></td>
								<td valign="top"><?=$key['assigned_to_v'];?></td>
								<td valign="top"><?=$key['execution_status'];?></td>
								<td valign="top"><?=$key['execution_explain'];?></td>
								<td valign="top"><?=$key['execution_evidence'];?></td>
								<td valign="top"><?=$key['execution_reason'];?></td>
								<td valign="top"><?=$key['revised_date'];?></td>
								<td valign="top"><?=$key['risk_code'];?></td>
								<td valign="top"><?=$key['risk_event'];?></td>
								<td valign="top"><?=$key['risk_description'];?></td>
							</tr>
							<?php $i ++;?>
					 <?php endforeach;?> 
					<?php else:?>
						<tr>
							<td colspan = "17"><center>No Data</center></td>
						</tr>
					<?php endif;?> 
				</tbody>
				
			</table>
			<div class="table-footer">
				<div class="table-caption">Total Data : <span class="label label-info"><?php echo $total_data;?></span></div>
			</div>	 
			 
	 

					
						
		