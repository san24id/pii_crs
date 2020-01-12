
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b>Username List</div>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Username<center></th>
					<th width="16%"><center>Full Name</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Role Status</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Division</center></th>
				</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		 foreach($datanya as $key):?> 
	 	<tr>
	 		<td valign="top"><?=$i++;?></td>
	 		<td valign="top"><?=$key['username'];?></td> 
	 		<td valign="top"><?=$key['display_name'];?></td>  
	 		<td valign="top"><?=$key['role_name'];?></td>
	 		<td valign="top"><?=$key['role_status'];?></td>
	 		<td valign="top"><?=$key['email'];?></td>
	 		<td valign="top"><?=$key['division_name'];?></td>        
		</tr>
		<?php endforeach;?> 
</table>