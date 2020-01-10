 
		 
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Top Ten 2nd Sub Category </b></font></center> </div>
			</div>	
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
							 <th> No </th>
							<th>  Category Code </th>   
							<th>  Category Name </th>   
							<th>  Impact Level </th>
							<th>  Likelihood Level </th>
							<th> Risk Level </th>
							 
					  </tr>
				</thead> 
				<tbody>
				 <?php $i=1;?>
						<?php if($datanya):?>
						 <?php foreach($datanya as $key):?>
							<tr>												  
								<td> <?=$i;?> </td> 
								<td> <?=$key['cat_code'];?> </td>
								<td> <?=$key['cat_name'];?> </td>   
								<td> <?=$key['impact_level'];?> </td> 
								<td> <?=$key['likelihood_level'];?> </td>
								<td> <?=$key['risk_level'];?> </td> 
													
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
			 
			 
	 

					
						
		