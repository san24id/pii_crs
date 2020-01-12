 
			 
			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>List of All Action Plan Execution </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b> Periode <?=$cekperiode[0]['periode_name'];?> (<?=date('d M Y',strtotime($cekperiode[0]['periode_start']));?>) s/d (<?=date('d M Y',strtotime($cekperiode[0]['periode_end']));?>)  </b></font> 
						</div>						 
					</center>
			 </div>
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
							<th> No</th>  
							<th> AP.ID</th>  
							<th>  Action Plan </th>   
							<th> Action Plan Owner </th>
							<th>  Due Date</th>
							<th>  Risk ID </th>
							<th>  Risk Event </th>
							<th>  Risk Owner </th> 
							<th> Risk Level </th> 
							<th> Execution Status</th> 
							<th> Risk Level After Mitigation</th> 
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $key):?>
							<tr>	
								<td> <?=$i;?> </td> 							
								<td> AP.<?=$key['id'];?> </td> 
								<td> <?=$key['action_plan'];?> </td>
								<td> <?=$key['division'];?> </td> 
								<td> <?=$key['due_date'];?> </td>
								<td> <?=$key['risk_code'];?> </td> 
								<td> <?=$key['risk_event'];?> </td>
								<td> <?=$key['risk_owner'];?> </td> 
								<td> <?=$key['risk_level'];?> </td>
								<td> <?=$key['Execution Status'];?> </td> 		
								<td> <?=$key['risk_level_after_mitigation'];?> </td> 										
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
			 
	 

					
						
		