<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading"> 
			<?php if(isset($dataget['cr_code'])):?><th>ID CH </th><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><th>Change In  </th><?php endif;?> 
			<?php if(isset($dataget['created_by_v'])):?><th>Requester  </th><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><th>Status Request  </th><?php endif;?>  
		</tr>
	</thead>
	<tbody>
		<?php foreach($datatable as $key):?>
		  
	 	<tr> 
			<?php if(isset($dataget['cr_code'])):?><td><?=$key['cr_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><td><?=$key['cr_type'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['created_by_v'])):?><td><?=$key['created_by_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><td><?=$key['cr_status'] ;?></td><?php endif;?>  
		</tr>
		<?php endforeach;?>
	</tbody>
	</table>