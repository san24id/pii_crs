<style>

table{
	border-collapse: collapse;
}

th{
	height: 35px;
}
thead{
	font-size: 14px;
}
tbody{
	font-size: 12px;
}

</style>
			 
		<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode a WHERE a.periode_id = '".$id_period."'";
			$query = $this->db->query($sql)->row();
		?>

			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>IIGF Corporate Risk Register </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b><?php echo $title_content.'&nbsp;'; echo $query->periode_name; ?></b></font> 
						</div>
						
					</center>
			 </div>
				
				 
			<table border="1">
			
				<thead>
					  <tr>
							<th> No </th> 
							<th>Status</th>
							<th>User</th>
							<th>Name</th>
							<th>Divisi</th>
							<th>Submission Date</th>
					  </tr>
				</thead> 
				<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $row):?>
							<tr>												  
								<td> <?=$i;?> </td>
								<td> <?=$row['status_date_v'];?> </td>
								<td> <?=$row['username'];?> </td>
								<td> <?=$row['display_name'];?> </td>
								<td> <?=$row['division_name'];?> </td>
								<td>
									<?php
										 if($row['periode_id'] != NULL){
											echo $row['due_date_v'];	
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
			 
	 

					
						
		