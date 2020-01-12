<style type="text/css">
	table{
		font-size: 15px;
	}
	p{
		text-align: center;
	}
</style>
<p>Comparison Of Outcome</p>
<br/>
<table border="1" align="center">
	<thead>
		<tr>
			<th>Risk Level</th>
			<th>Sub Category Of Periode 1</th>
			<th>Sub Category Of Periode 2</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>High</td>
			<td><?= $h1; ?></td>
			<td><?= $h2; ?></td>
		</tr>
		<tr>
			<td>Moderate</td>
			<td><?= $m1; ?></td>
			<td><?= $m2; ?></td>
		</tr>	
		<tr>
			<td>Low</td>
			<td><?= $l1; ?></td>
			<td><?= $l2; ?></td>
		</tr>
		<tr>
			<td>Total</td>
			<td><?= $p1; ?></td>
			<td><?= $p2; ?></td>
		</tr>					
	</tbody>
</table>
<br>