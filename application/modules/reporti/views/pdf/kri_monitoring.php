<style type="text/css">
	table{
		font-size: 8px;
	}
	p{
		text-align: center;
	}
</style>
<p>Key Risk Indicator(KRI) Monitoring</p>
<p><?php echo $periode;?></p>
<br/>
<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Risk Code</th>
			<th>Risk Event</th>
			<th>Risk Level</th>
			<th>Implementation</th>
			<th>KRI ID</th>
			<th>KRI</th>
			<th>KRI Owner</th>
			<th>Threshold</th>
			<th>Timing Pelaporan</th>
			<th>Pelaporan oleh Divisi</th>
			<th>Result</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
			foreach($data as $key):?>
	 	<tr>
			<td><?= $i;?></td>
			<td><?= $key->risk_code;?></td>
			<td><?= $key->risk_event;?></td>
			<td><?= $key->risk_level;?></td>
			<td><?= $key->suggested_risk_treatment;?></td>
			<td><?= $key->kri_code;?></td>
			<td><?= $key->key_risk_indicator;?></td>
			<td><?= $key->kri_owner;?></td>
			<td><?= $key->treshold;?></td>
			<td><?= $key->timing_pelaporan;?></td>
			<td><?= $key->owner_report;?></td>
			<td><?= $key->kri_warning;?></td>
		</tr>
		<?php $i++;
		 endforeach;?>
	</tbody>
</table>
<br>
<p style="text-align: left;">Jumlah Risk: <?=$rows;?></p>