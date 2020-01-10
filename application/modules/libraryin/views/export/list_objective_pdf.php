
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Library Of Objective    </div>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th width="10">OB.ID</th> 
			<th>Objective</th> 
			<th width="20%">Risk Code</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td>OB.<?=$key['id'];?></td>
			<td><?=$key['objective'];?></td>
			<td><?=$key['risk_code'];?></td>
		</tr>
		<?php endforeach;?> 
</table>