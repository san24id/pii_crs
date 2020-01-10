
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Library Of Risk    </div>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >Risk ID</th>  
			<th  >Risk Event</th>  
			<th  >Risk Description</th>  
			<th  >Cause</th>  
			<th  >Impact</th>
			<th  >Risk Category</th>  
			<th  >Risk Sub Category</th> 
			<th  >Risk 2nd sub Category</th> 
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td><?=$key['risk_code'];?></td>
			<td><?=$key['risk_event'];?></td>
			<td><?=$key['risk_description'];?></td>
			<td><?=$key['risk_cause'];?></td>
			<td><?=$key['risk_impact'];?></td>
			<td><?=$key['cat_name1'];?></td>
			<td><?=$key['cat_name2'];?></td>
			<td><?=$key['cat_name3'];?></td>
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>