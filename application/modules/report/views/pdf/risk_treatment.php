<style type="text/css">
	table{
		font-size: 8px;
	}
	p{
		text-align: center;
	}
</style>
<p>List of Risk Treatment</p>
<p><?php echo $periode;?></p>
<br/>
<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Owner</th>
			<th>Impact Level</th>
			<th>Likelihood Level</th>
			<th>Risk Level</th>
			<th>Implementation</th>
			<th>Action Plan</th>
			<th>Due Date</th>
			<th>Action Plan Owner</th>
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
			<td><?= $key->risk_owner;?></td>
			<td><?= $key->risk_impact_level;?></td>
			<td><?= $key->risk_likelihood_key;?></td>
			<td><?= $key->risk_level;?></td>
			<td><?= $key->suggested_risk_treatment;?></td>
			<td><?= $key->action_plan;?></td>
			<td><?= $key->due_date;?></td>
			<td><?= $key->division;?></td>
		</tr>
		<?php $i++;
		 endforeach;?>
	</tbody>
</table>
<br>
<p style="text-align: left;">Jumlah Risk: <?=$rows;?></p>