 		<?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_user WHERE username = '".$d_user."'";
			$query = $this->db->query($sql)->row();
			$sql1 = "SELECT b.periode_id, b.periode_name FROM  m_periode b WHERE b.periode_id = (SELECT max(periode_id) FROM m_periode) LIMIT 1";
			$query1 = $this->db->query($sql1)->row();

		?>
<div class="table-header">
	<center><div class="table-caption"><font = "3"><b> Submission by : <?php echo $query->display_name.'&nbsp;('.$query->username.')'; ?>&nbsp;&nbsp;Periode : <?php echo $query1->periode_name; ?></div>
</div> 
		
<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1"> 
	<thead>
		<tr role="row" class="heading">
					<th>No</th>
					<th>Status</th>
					<th>AP.ID</th>
					<th>Action Plan</th>
					<th>Due Date</th>
					<th>Action Plan Owner</th>
					<th>Assignee</th> 
					<th>Risk ID</th>
					<th>Risk Owner</th>
					<th>Risk Event</th>
					<th>Risk Description</th>  
		</tr>
	</thead>
	<tbody>
						<?php if($datanya):?>
						<?php $i = 1;?>
						 <?php foreach($datanya as $key):?>
							<tr>	
								<td valign="top"><?=$i;?></td>
								<td valign="top"><?php 
										if($key['action_plan_status'] == 3){
											echo 'Submitted to RAC';
										}else{
											echo 'Verified by RAC';
										}
								?></td>
								<td valign="top"><?=$key['act_code'];?></td>
								<td valign="top"><?=$key['action_plan'];?></td>
								<td valign="top"><?php
											if($key['due_date_v'] == '00-00-0000'){
												echo "Continuous";
											}else{
												echo $key['due_date_v'];
											}
											?></td>
								<td valign="top"><?=$key['division_name'];?></td>
								<td valign="top"><?=$key['assigned_to_v'];?></td>
								<td valign="top"><?=$key['risk_code'];?></td>
								<td valign="top"><?=$key['risk_owner_v'];?></td>
								<td valign="top"><?=$key['risk_event'];?></td>
								<td valign="top"><?=$key['risk_description'];?></td>
							</tr>
							<?php $i ++;?>
					 <?php endforeach;?> 
					<?php else:?>
						<tr>
							<td colspan = "17"><center>No Data</center></td>
						</tr>
					<?php endif;?> 
				</tbody>
				
			</table>
			<div class="table-footer">
				<div class="table-caption" style="text-align: left;">Total Data : <span class="label label-info"><?php echo $total_data;?></span></div>
			</div>	 