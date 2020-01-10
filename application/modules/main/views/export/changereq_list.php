<?php error_reporting(0)?>
<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
			$query = $this->db->query($sql)->row();
		?>
<?php if($this->session->credential['main_role_id'] == 2){?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Change Request List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading"> 
			<th>No</th>
			<?php if(isset($dataget['cr_code'])):?><th>ID CH </th><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><th>Change In  </th><?php endif;?> 
			<?php if(isset($dataget['created_by_v'])):?><th>Requestor  </th><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><th>Status Change Request  </th><?php endif;?>
			<?php if(isset($dataget['date'])):?><th>Date</th><?php endif;?>   
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			foreach($datatable as $key):?>
		  
	 	<tr>
	 		<td><?=$i++;?></td>  
			<?php if(isset($dataget['cr_code'])):?><td><?=$key['cr_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><td><?=$key['cr_type'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['created_by_v'])):?><td><?=$key['created_by_v'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><td>
													<?php if($key['cr_status']==0){
																echo "Pending";
														  }else{
														  		echo "Complete";
														  }?></td>

			<?php endif;?>
			<?php if(isset($dataget['date'])):?><td><?=$key['created_date'] ;?></td><?php endif;?>   
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php }else{ ?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Dashboard Change Request List Periode : <?php echo $query->periode_name; ?></div>
</div> 
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th>No</th> 
			<?php if(isset($dataget['cr_code'])):?><th>ID CH </th><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><th>Change In  </th><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><th>Status Change Request  </th><?php endif;?>
			<?php if(isset($dataget['date'])):?><th>Date</th><?php endif;?>   
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			foreach($datatable as $key):?>
		  
	 	<tr>
	 		<td><?=$i++;?></td> 
			<?php if(isset($dataget['cr_code'])):?><td><?=$key['cr_code'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_type'])):?><td><?=$key['cr_type'] ;?></td><?php endif;?> 
			<?php if(isset($dataget['cr_status'])):?><td>
													<?php if($key['cr_status']==0){
																echo "Pending";
														  }else{
														  		echo "Complete";
														  }?></td>

			<?php endif;?>
			<?php if(isset($dataget['date'])):?><td><?=$key['created_date'] ;?></td><?php endif;?>   
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php } ?>