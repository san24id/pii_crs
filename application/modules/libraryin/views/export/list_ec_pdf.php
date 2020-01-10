
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b>      Library of Existing Control     </div></center>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th  >Existing Control ID</th>  
			<th  >Existing Control</th>  
			<th  >Evaluation Control</th>  
			<th  >Control Owner</th>
			<th width="20%">Risk ID</th>   
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td>EC.<?=$key['id'];?></td>
			<td><?=$key['risk_evaluation_control'];?></td>
			<td><?=$key['risk_existing_control'];?></td>
			<td><?=$key['division_name'];?></td>
			<td><?=$key['risk_code'];?></td> 
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>