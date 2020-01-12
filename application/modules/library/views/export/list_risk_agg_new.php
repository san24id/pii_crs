
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Risk Aggregate </b></div>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
							<th> No </th>
							<th>  Risk Event </th> 
							<th>  Risk Owner </th> 
							<th>  Risk Impact Level </th>
							<th>  Risk Likelihood level </th>
							<th> Risk Level </th>
							<th> Implementation </th>
							<th> Existing Control </th>
							<th> Evaluation Control </th>
							<th> Control Owner </th>
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
								<td> <?=$key['risk_event'];?> </td>  
								<td> <?=$key['risk_owner_v'];?> </td>  
								<td> <?=$key['risk_impact_level'];?> </td> 
								<td> <?=$key['risk_likelihood_key'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
								<td> <?=$key['suggested_risk_treatment'];?> </td>
								<td> <?=$key['Existing Control'];?> </td>
								<td> <?=$key['Evaluation Control'];?> </td>
								<td> <?=$key['Control Owner'];?> </td>
								<td> <?=$key['Action Plan'];?> </td> 
								<td> <?=$key['Action Plan Owner_v'];?> </td>			
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