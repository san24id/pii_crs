<style type="text/css">
	table{
		font-size: 8px;
	}
	p{
		text-align: center;
	}
</style>
<p>Top Ten Risk</p>
<br/>
<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Description</th>
			<th>Risk Owner</th>
			<th>Impact Level</th>
			<th>Likelihood Level</th>
			<th>Risk Level</th>
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
			<td><?= $key->risk_description;?></td>
			<td><?= $key->risk_owner;?></td>
			<td><?= $key->risk_impact_level;?></td>
			<td><?= $key->risk_likelihood_key;?></td>
			<td><?= $key->risk_level;?></td>
		</tr>
		<?php $i++;
		 endforeach;?>
	</tbody>
</table>
<br>
<p style="text-align: left;">Jumlah Risk: <?=$rows;?></p>