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
							<font = "3"><b>List of All Risk User </b></font> 
						</div>
						
					</center>
			 </div>
				
				 
			<table class="responsive table table-striped table-bordered table-hover" border = "1">
			
				<thead>
					  <tr>
							<th >  No </th> 
							<th>  Risk Status </th>
							<th> 2nd Sub <br>Category </th>  
							<th>  Risk ID </th>   
							<th>  Risk Event </th>
							<th>  Risk Description</th>
							<th>  Risk Owner </th>
							<th>  Risk Cause </th>
							<th>  Risk Impact </th>
							<th>  Objective </th>
							<th>  Existing <br> Control </th>
							<th>  Control <br> Evaluation</th>
							<th>  Control <br> Owner</th>
							<th>  Risk Impact <br> Level </th>
							<th>  Risk Likelihood <br> Level </th>
							<th> Risk Level </th>
							<th> Implementation</th>
							<th> Action Plan </th>
							<th> Action Plan <br> Owner</th>
							<th> Due Date</th>
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $key):?>
							<tr>												  
								<td> <?=$i;?> </td> 
								<td> 
								<?php
								if ($key['risk_status'] == 0){
										echo "Draft";
									}else if($key['risk_status'] == 1){
										echo "Confirmed";
									}else if($key['risk_status'] == 2){
										echo "Submitted to RAC";
									}else{
										echo "Draft";
									}
								?> 
								</td> 
								<td> <?=$key['cat_name'];?> </td> 
								<td> <?=$key['risk_code'];?> </td>
								<td> <?=$key['risk_event'];?> </td> 
								<td> <?=$key['risk_description'];?> </td>
								<td> <?=$key['risk_owner'];?> </td> 
								<td> <?=$key['risk_cause'];?> </td>
								<td> <?=$key['risk_impact'];?> </td> 
								<td> <?=$key['Objective'];?> </td> 
								<td> <?=$key['Existing Control'];?> </td>
								<td> <?=$key['Control Evaluation'];?> </td> 
								<td> <?=$key['Control Owner'];?> </td>
								<td> <?=$key['risk_impact_level'];?> </td> 
								<td> <?=$key['risk_likelihood_key'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
								<td> <?=$key['suggested_risk_treatment'];?> </td>
								<td> <?=$key['Action Plan'];?> </td> 
								<td> <?=$key['Action Plan Owner'];?> </td>			
								<td> <?=$key['Due Date'];?> </td>								
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
			 
	 

					
						
		