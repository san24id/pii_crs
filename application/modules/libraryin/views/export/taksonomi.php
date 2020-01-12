
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b>      Library Of Risk Taxonomy 

    </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >ID</th>  
			<th  >Name</th>  
			<th  >Description</th>  
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td><?=$key['cat_code'];?></td>
			<td><?=$key['cat_name'];?></td>
			<td><?=$key['cat_desc'];?></td> 
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>