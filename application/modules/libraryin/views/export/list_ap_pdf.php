
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Library Of Action Plan    </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >AP ID</th>  
			<th  >Action Plan</th>  
			<th  >Action Plan Owner</th>
			<th  >Risk ID</th>    
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td valign="top">AP.<?=$key['id'];?></td>
			<td valign="top"><?=$key['action_plan'];?></td>
			<td valign="top"><?=$key['division_name'];?></td>
			<td valign="top"><?=$key['risk_code'];?></td>  
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>