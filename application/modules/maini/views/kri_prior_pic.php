 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Periode Kunci Indikator Risiko : <?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN ((SELECT MAX(periode_id) FROM m_periode)-1)";
			$query = $this->db->query($sql)->row();
			echo $query->periode_name;
		?>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaksi</a>
					<i class="fa fa-angle-right"></i>
				</li>
			 
				<li>
					<a target="_self" href="javascript:;">Penunjukan KRI</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">KRI Reguler</a>
				</li>
			</ul>
		</div>

			<div class="tab-content">
				<div class="tab-pane active" id="tab_kri">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="timing_pelaporan">Waktu Pelaporan</option>
								<option value="risk_code">ID Risiko</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri-filterButton">Cari</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>KRI ID</center></th>
							<th><center>KRI</center></th>
							<th><center>Waktu Pelaporan</center></th>
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>ID Risiko</center></th>
							<th width="20px"><center>Permintaan Perubahan</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					<div class="row">
					<div class="col-md-6">
					<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 Diverifikasi oleh Kepala Divisi
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Menunggu Verifikasi RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Diverifikasi Oleh RAC
							</li>
						</ul>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 PErmintaan Perubahan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
					</div>
					</div>
				</div>
			</div>

		<!-- END CONTENT-->
	</div>
</div>

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Pilih Penerima</h4>
	</div>
	<div class="modal-body">
		<table id="pic_list_table" class="table table-condensed table-bordered table-hover">
			<thead>
			<tr role="row" class="heading">
				<th width="30px">&nbsp;</th>
				<th>Nama</th>
				<th>Divisi</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($pic_list as $k=>$row) { ?>
			<tr id="modal-pic-tr-<?=$k?>">
				<td>
				<div class="btn-group">
					<button value_idx="<?=$k?>" value="<?=$row['username']?>" type="button" class="btn btn-default btn-xs button-assign-pic"><i class="fa fa-check-circle font-blue"> Pilih </i></button>
				</div>
				</td>
				<td class="col_display_name"><?=$row['display_name']?></td>
				<td><?=$row['division_name']?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>