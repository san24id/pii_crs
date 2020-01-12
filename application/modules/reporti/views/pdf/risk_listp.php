<style type="text/css">
	table{
		font-size: 8px;
	}
	p{
		text-align: center;
	}
</style>
<p>List of All Risk</p>
<p><?php echo $periode;?></p>
<br/>
<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>2nd Sub Category</th>
			<th>Risk ID</th>
			<th>Risk Event</th>
			<th>Risk Description</th>
			<th>Risk Owner</th>
			<th>Cause</th>
			<th>Impact</th>
			<th>Control Evaluation</th>
			<th>Control Owner</th>
			<th>Existing Control</th>
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
			<td><?= $key->cat_name;?></td>
			<td><?= $key->risk_code;?></td>
			<td><?= $key->risk_event;?></td>
			<td><?= $key->risk_description;?></td>
			<td><?= $key->risk_owner;?></td>
			<td><?= $key->risk_cause;?></td>
			<td><?= $key->risk_impact;?></td>
			<td><?= $key->risk_evaluation_control;?></td>
			<td><?= $key->risk_control_owner;?></td>
			<td><?= $key->risk_existing_control;?></td>
			<td><?= $key->risk_impact_level;?></td>
			<td><?= $key->risk_likelihood_key;?></td>
			<td><?= $key->risk_level;?></td>
		</tr>
		<?php $i++;
		 endforeach;?>
	</tbody>
</table>
<?php
					
					echo "Jumlah Risk: ".$rows;
		?>