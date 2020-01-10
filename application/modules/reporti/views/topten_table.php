 
			  
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Top Ten Risk</b></font></center> </div>
			</div>	
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
							 <th> No </th>
							<th>  Risk ID </th>   
							<th>  Risk Event </th>
							<th>  Risk Description</th>
							<th>  Risk Owner </th>  
							<th>  Risk Impact Level </th>
							<th>  Risk Likelihood Level </th>
							<th> Risk Level </th>
							<th> Status</th>
							<th> Risk Status</th>
							 
					  </tr>
				</thead> 
				<tbody>
				 <?php $i=1;?>
						<?php if($datanya):?>
						 <?php foreach($datanya as $key):?>
							<tr>												  
								<td> <?=$i;?> </td>
								<td> <?=$key['risk_code'];?> </td>
								<td> <?=$key['risk_event'];?> </td> 
								<td> <?=$key['risk_description'];?> </td>
								<td> <?=$key['risk_owner'];?> </td>   
								<td> <?=$key['risk_impact_level'];?> </td> 
								<td> <?=$key['risk_likelihood_key'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
								<td> <?php
									if ($key['risk_status'] == 1){
										echo "Draft";
									}else if ($key['risk_status'] == 2){
										echo "Submitted to rac";
									}else if ($key['risk_status'] == 3){
										echo "On Risk Treatment Process";
									}else if ($key['risk_status'] == 4){
										echo "on Risk Treatment Process";
									}else if ($key['risk_status'] == 5){
										echo "On Risk Treatment Process";
									}else if ($key['risk_status'] == 6){
										echo "on Action Plan Process";
									}else if ($key['risk_status'] == 10){
										echo "On Action Plan Execution Process";
									}else if ($key['risk_status'] == 20){
										echo "Action Plan Has Been Executed and Verified";
									}else{
										echo "Draft";
									}
									?> </td>
								<td> <?php
									if ($key['risk_status'] == 1){
										echo "Draft";
									}else if ($key['risk_status'] == 2){
										echo "Submitted to rac";
									}else if ($key['risk_status'] == 3){
										echo "Draft";
									}else if ($key['risk_status'] == 4){
										echo "Draft";
									}else if ($key['risk_status'] == 5){
										echo "Submitted to RAC";
									}else if ($key['risk_status'] == 6){
										echo "Draft";
									}else if ($key['risk_status'] == 10){
										echo "Submitted to RAC";
									}else if ($key['risk_status'] == 20){
										echo "Verified By RAC";
									}else{
										echo "Draft";
									}
									?> </td>	
													
							</tr>
							 <?php $i++;?>
					 <?php endforeach;?> 
					<?php else:?>
						<tr>
							<td colspan = "17"><center>No Data</center></td>
						</tr>
					<?php endif;?> 
				</tbody>
				
			</table>
			 
			 
	 

					
						
		