 
		 
			<div class="table-header">
					<center>
						<div class="table-caption">
							<font = "3"><b>KRI Monitoring </b></font> 
						</div>
						<div class="table-caption">
							<font = "3"><b>  Periode <?=$cekperiode[0]['periode_name'];?> (<?=date('d M Y',strtotime($cekperiode[0]['periode_start']));?>) s/d (<?=date('d M Y',strtotime($cekperiode[0]['periode_end']));?>)</b></font> 
						</div>
						 
					</center>
			 </div>		
			<table class="responsive table table-striped table-bordered table-hover"  border = "1">
				<thead>
					  <tr>
						<th> No </th>
						<th>Risk ID</th>
						<th>Risk Even</th>
						<th>Risk Level</th>
						<th>Risk Treatment</th>
						<th>Action Plan</th>
						<th>KRI ID</th>
						<th>Mandatory/Non Mandatory?</th>
						<th>Key Risk Indicator</th>
						<th>KRI Owner</th>
						<th>Threshold Value</th>
						<th>Timing Pelaporan</th>
						<th>Response</th>
						<th>Supporting Evidence</th>
						<th>Validation</th>
						<th>KRI Warning</th>
						<th>Risk <br/>Level After KRI</th>
						<th>Risk <br/>Impact Level After KRI</th>
						<th>Risk <br/>Likelihood After KRI</th>
						<th>Risk <br/>Level Before KRI</th>
						<th>Risk <br/>Impact Level Before KRI</th>
						<th>Risk <br/>Likelihood Before KRI</th>
						
					  </tr>
				</thead> 
				<tbody>
				 <?php $i=1;?>
						<?php if($datanya):?>
						 <?php foreach($datanya as $key):?>
							<tr>												  
								<td valign="top"> <?=$i;?> </td>
								<td valign="top"><?=$key['risk_code']?></td>
								<td valign="top"><?=$key['risk_event']?></td>
								<td valign="top"><?=$key['risk_level']?></td>
								<td valign="top"><?=$key['suggested_risk_treatment']?></td>
								<td valign="top"><?=$key['Action Plan']?></td>
								<td valign="top"><?=$key['kri_code']?></td>
								<td valign="top"><?=$key['mandatory']?></td>
								<td valign="top"><?=$key['key_risk_indicator']?></td>
								<td valign="top"><?=$key['division_name']?></td>
								<td valign="top"><?=$key['threshold value']?></td>
								<td valign="top"><?=$key['timing_pelaporan_v']?></td>
								<td valign="top"><?=$key['owner_report']?></td>
								<td valign="top"><?=$key['supporting_evidence']?></td>
								<td valign="top"><?=$key['validation']?></td>
								<td valign="top"><?=$key['kri_warning']?></td>
								<td valign="top"><?=$key['risk_level_after_kri']?></td>
								<td valign="top"><?=$key['risk_impact_level_after_kri']?></td>
								<td valign="top"><?=$key['risk_likelihood_key_after_kri']?></td>
								<td valign="top"><?=$key['risk_level']?></td>
								<td valign="top"><?=$key['risk_impact_level']?></td>
								<td valign="top"><?=$key['risk_likelihood_key']?></td>

							</tr>
							 <?php $i++;?>
					 <?php endforeach;?> 
					<?php else:?>
						<tr>
							<td colspan = "17"><center>No Data</center></td>
						</tr>
					<?php endif;?> 
				</tbody>
				
			</table>

			<?php if($datanya):?>
				<div class="table-footer">
					<div class="table-caption">Total Data : <span class="label label-info"><?php echo $total_data;?></span></div>
				</div>
			<?php else: ?>
				<div class="table-footer">
					<div class="table-caption">Total Data : <span class="label label-info"><?php echo "0";?></span></div>
				</div>
			<?php endif; ?>	 
			 
	 

					
						
		