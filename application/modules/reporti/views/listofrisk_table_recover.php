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
							<font = "3"><b>List of Recover Roll Forward Risk
 </b></font> 
						</div>
						
					</center>
			 </div>
				
				 
			<table class="responsive table table-striped table-bordered table-hover" border = "1">
			
				<thead>
					  <tr>
							<th> No </th> 
							<th>  Risk ID</th>
							<th>  Risk Input BY</th>
							<th>  Risk Even </th>
							<th>  Risk Description </th>
							<th>  Cause </th>
							<th>  Impact </th>
							<th>  Impact Level </th>
							<th>  Likelihood</th>
							<th>  Risk Level </th>  
							<th>  Risk Owner </th>
							<th>  Submited By </th>
							<th>  Objective </th>
							<th>  Existing Control</th>
							<th>  Evaluation on Existing Control</th>
							<th>  Control Owner</th>
							<th>  Suggested Risk Treatment</th> 
							<th> Action Plan</th>
							<th> Due Date</th>
							<th> Division </th>
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $row):?>
							<tr>												  
								<td> <?=$i;?> </td>
								<td> <?=$row['risk_code'];?> </td>
								<td> <?=$row['risk_input_by'];?> </td>
								<td> <?=$row['risk_event'];?> </td>
								<td> <?=$row['risk_description'];?> </td>
								<td> <?=$row['risk_cause'];?> </td> 
								<td> <?=$row['risk_impact'];?> </td> 
								<td> <?=$row['risk_impact_level'];?> </td>
								<td> <?=$row['risk_likelihood_key'];?> </td>  
								<td> <?=$row['risk_level'];?> </td> 
								<td> <?=$row['risk_owner'];?> </td> 
								<td> <?=$row['username'];?> </td>
								<td> <?=$row['objective'];?> </td> 
								<td> <?=$row['risk_evaluation_control'];?> </td>
								<td> <?=$row['risk_existing_control'];?> </td>
								<td> <?=$row['risk_control_owner'];?> </td>
								<td> <?=$row['suggested_risk_treatment'];?> </td> 
								<td> <?=$row['action_plan'];?> </td>
								<td> <?=$row['due_date'];?> </td>
								<td> <?=$row['division'];?> </td>

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
			 
	 

					
						
		