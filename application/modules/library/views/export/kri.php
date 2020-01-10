<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Library Of Key Risk Indicator(KRI)   </div>
</div>	 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1"> 
	<thead>
		<tr role="row" class="heading">
			<th  >KRI ID</th>  
			<th  >Key Risk Indicator</th>  
			<th  >Threshold</th>  
			<th  >Threshold Type</th>
			<th  >Risk ID</th>   
		</tr>
	</thead>
	<tbody>
	<?php if($datanya):?>
		<?php foreach($datanya as $key):?> 
	 	<tr>  
			<td><?=$key['kri_code'];?></td>
			<td><?=$key['key_risk_indicator'];?></td>
			<td><?=$key['treshold'];?></td> 
			<td><?=$key['threshold value'];?></td>
			<td><?=$key['risk_code'];?></td>
		</tr>
		<?php endforeach;?>
	<?php else:?>
		<tr>  
			<td colspan = "5">No Data</td>
			 
		</tr>
	<?php endif;?>
	</tbody>
</table>