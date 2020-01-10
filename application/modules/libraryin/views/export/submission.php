   <style>
		 
</style>
			 
			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>IIGF Corporate Risk Register </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b>List of User Submission
 </b></font> 
						</div>
						
					</center>
			 </div>
				
				 
			<table class="responsive table table-striped table-bordered table-hover" border = "1">
			
				<thead>
					  <tr>
							<th> No </th> 
							<th>User</th>
							<th>Name</th>
							<th>Divisi</th>
							<th>Tanggal Submit</th>
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $row):?>
							<tr>												  
								<td> <?=$i;?> </td>
								<td> <?=$row['username'];?> </td>
								<td> <?=$row['display_name'];?> </td>
								<td> <?=$row['division_name'];?> </td>
								<td>
									<?php
										 if($row['periode_id'] != null){
											echo $row['tanggal_submit'];	
									}else{
										echo '';
										} ?>
								 </td></tr>
							<?php $i++;?>
					 <?php endforeach;?> 
					<?php else:?>
						<tr>
							<td colspan = "6"><center>No Data</center></td>
						</tr>
					<?php endif;?> 
				</tbody>
				
			</table>
			<div class="table-footer">
				<div class="table-caption">Total Data : <span class="label label-info"><?php echo $total_data;?></span></div>
			</div>
			 
	 

					
						
		