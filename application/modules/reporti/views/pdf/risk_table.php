<style type="text/css">
	table{
		font-size: 8px;
	}
	p{
		text-align: center;
	}
</style>
<p>Risk Table</p>
<br/>
<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Description</th>
			<th>Impact Level</th>
			<th>Likelihood Level</th>
			<th>Before Periode</th>
			<th>Previous Periode</th>
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
			<td><?= $key->risk_impact_level;?></td>
			<td><?= $key->risk_likelihood_key;?></td>
			<td><?= $key->curr;?></td>
			<td><?= $key->prev;?></td>

		</tr>
		<?php $i++;
		 endforeach;?>
	</tbody>
</table>
<?php
					
					echo "Jumlah Risk: ".$rows;
		?>