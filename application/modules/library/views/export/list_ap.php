
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Library Of Action Plan    </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th rowspan="2"><center>No</center></th>
			<th rowspan="2"><center>AP ID</center></th>
			<th rowspan="2"><center>Action Plan</center></th>
			<th rowspan="2"><center>Due Date</center></th>
			<th rowspan="2"><center>Action Plan Owner</center></th>
			<th colspan="2"><center>Risk</center></th>
		</tr>
			<tr role="row" class="heading">
				<th><center>Risk ID</center></th>
				<th width="10%"><center>Periode</center></th>
			</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		 foreach($datanya as $key):?> 
	 	<tr>
	 		<td valign="top"><?=$i++;?></td>  
			<td valign="top">AP.<?=$key['id'];?></td>
			<td valign="top"><?=$key['action_plan'];?></td>
			<td valign="top"><?=$key['due_date_x'];?></td>
			<td valign="top"><?=$key['division_name'];?></td>
			<td valign="top"><?=$key['risk_code'];?></td> 
			<td valign="top"><?=$key['periode_id'];?></td>  
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>