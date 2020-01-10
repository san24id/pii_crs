   <style>
  @page { margin: 0px; size: 2000pt 595pt;}
            img {margin:0px;padding:0px}
		 
</style>
			  	
			  <div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>IIGF Corporate Risk Register </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b> List of Risk Identified during this periode  </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b>  Periode <?=$cekperiode[0]['periode_name'];?> (<?=date('d M Y',strtotime($cekperiode[0]['periode_start']));?>) s/d (<?=date('d M Y',strtotime($cekperiode[0]['periode_end']));?>)</b></font> 
						</div>
					</center>
			 </div>
				
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
					  
							<th>  No </th> 
							<th>  Status</th>
							<th>  Risk Status</th>
							<th>  Risk ID </th>   
							<th>  Risk Event </th>
							<th>  Risk Description</th>
							<th>  Objective </th>
							<th>  2nd Sub Category </th>  
							<th>  Risk Owner </th>
							<th>  Risk Cause </th>
							<th>  Risk Impact </th>
							<th>  Risk Impact Level </th>
							<th>  Risk Likelihood Level </th>
							<th>  Risk Level </th>
							<th>  Existing Control</th>
							<th>  Control Evaluation </th>
							<th>  Control Owner</th>
							<th>  Implementation</th>
							<th>  Action Plan </th>
							<th>  Due Date</th>
							<th>  Action Plan Owner</th>
							<th>  User Pengisi</th>
							<th>  Date User Pengisi</th>
							<th>  User Pengedit</th>
							<th>  Date User Pengedit</th>
							
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
								<td> <?=$key['risk_description'];?> </td>
								<td> <?=$key['Objective'];?> </td>	  
								<td> <?=$key['cat_name'];?> </td> 
								<td> <?=$key['risk_owner'];?> </td> 
								<td> <?=$key['risk_cause'];?> </td>
								<td> <?=$key['risk_impact'];?> </td> 
								<td> <?=$key['risk_impact_level'];?> </td> 
								<td> <?=$key['risk_likelihood_key'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
								<td> <?=$key['Existing Control'];?> </td>
								<td> <?=$key['Control Evaluation'];?> </td> 
								<td> <?=$key['Control Owner'];?> </td>
								<td> <?=$key['suggested_risk_treatment'];?> </td>
								<td> <?=$key['Action Plan'];?> </td> 
								<td> <?=$key['Due Date'];?> </td>
								<td> <?=$key['Action Plan Owner'];?> </td>			
								<td> <?=$key['risk_input_by'];?> </td>
								<td> <?=$key['tanggalrisk'];?> </td> 
								<td> <?=$key['username'];?> </td>			
								<td> <?=$key['date_changed'];?> </td>
								
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
			<div class="table-footer">
				<div class="table-caption">Total Data : <span class="label label-info"><?php echo $total_data;?></span></div>
			</div>
			 
	 

					
						
		