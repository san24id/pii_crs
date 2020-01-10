
			<div class="table-header">
				<center><div class="table-caption"><font = "3"><b> Loss Event </b></div>
			</div>	

<table class="table table-condensed table-bordered table-hover " id="datatable_ajax" border="1">
						  
	<thead>
		<tr role="row" class="heading">
			<th><center>No.</center></th>
							<th><center>Sektor Proyek</center></th>
							<th><center>Nama Proyek</center></th>
							<th><center>Nilai Proyek</center></th>
							<th><center>Kejadian</center></th>
							<th><center>Tipe Kerugian</center></th>
							<th><center>Nikai Kerugian</center></th>
							<th><center>Deskripsi/keterangan</center></th>
							<th><center>Periode</center></th>
							<th><center>Penyebab</center></th>
							<th><center>Fungsi terkait</center></th>
							<th><center>Lesson Learned</center></th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$i = 1;
		foreach($datanya as $key):?> 
	 	<tr>
	 		<td><?=$i++;?></td>  
			<td><?=$key['sektor'];?></td>
			<td><?=$key['nama_proyek'];?></td>
			<td><?=$key['nilai_proyek'];?></td>
			<td><?=$key['kejadian'];?></td>
			<td><?=$key['tipe'];?></td>
			<td><?=$key['nilai_kerugian'];?></td>
			<td><?=$key['deskripsi'];?></td>
			<td><?=$key['periode'];?></td>
			<td><?=$key['penyebab'];?></td>
			<td><?=$key['fungsi'];?></td>
			<td><?=$key['lesson'];?></td>
		</tr>
		<?php endforeach;?> 
	</tbody>
</table>