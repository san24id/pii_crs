 
		   
			 	 
			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>Risk Treatment Report </b></font> 
						</div>
					 
						<div class="table-caption">
							<font = "3"><b>  Periode <?=$cekperiode[0]['periode_name'];?> (<?=date('d M Y',strtotime($cekperiode[0]['periode_start']));?>) s/d (<?=date('d M Y',strtotime($cekperiode[0]['periode_end']));?>)</b></font> 
						</div>
					</center>
			 </div>
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
							 <th> No </th>
							 <th> Status</th>
							<th> Risk Status</th>   
							<th>  Risk ID </th>   
							<th>  Risk Event </th> 
							<th>  Risk Owner </th> 
							<th>  Risk Impact Level </th>
							<th>  Risk Likelihood level </th>
							<th> Risk Level </th>
							<th> Implementation</th>
							<th> Action Plan </th>
							<th> Action Plan Owner</th>
							<th> Due Date</th>
							
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $key):?>
							<tr>												  
								<td> <?=$i;?> </td> 
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
								<td> <?=$key['risk_code'];?> </td>
								<td> <?=$key['risk_event'];?> </td>  
								<td> <?=$key['risk_owner'];?> </td>  
								<td> <?=$key['risk_impact_level'];?> </td> 
								<td> <?=$key['risk_likelihood_key'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
								<td> <?=$key['suggested_risk_treatment'];?> </td>
								<td> <?=$key['Action Plan'];?> </td> 
								<td> <?=$key['Action Plan Owner'];?> </td>			
								<td> <?=$key['Due Date'];?> </td>
									
								<?php $i++;?>								
							</tr>
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
			 
	 

					
						
		