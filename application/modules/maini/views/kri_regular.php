 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
		Periode Kunci Indikator Risiko : <?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode)";
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
				<div class="tab-pane active" id="tab_kri_list">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-success">Mitigasi</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-default">Non Mitigasi</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">Pemilik KRI</option>
								<option value="timing_pelaporan">Waktu Pelaporan</option>
								<option value="risk_code">ID Risiko</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri">
							<select class="form-control input-sm" id="l_divisi-kri">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
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
							<th><center>ID KRI</center></th>
							<th><center>KRI</center></th>
							<th><center>Pemilik KRI</center></th>
							<th><center>Waktu Pelaporan</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peringatan KRI</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Simpan Draft
							</li>
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
								 Diverifikasi oleh RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				

				<div class="tab-pane" id="tab_kri_list_non_mitigation">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-default">Mitigasi</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-success">Non Mitigasi</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_nonmtg">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_nonmtg-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">Pemilik KRI</option>
								<option value="timing_pelaporan">Waktu Pelaporan</option>
								<option value="risk_code">ID Risiko</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri_nonmtg">
							<select class="form-control input-sm" id="l_divisi-kri_nonmtg">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_nonmtg-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri_nonmtg-filterButton">Cari</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri_non_mitigation">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID KRI</center></th>
							<th><center>KRI</center></th>
							<th><center>Pemilik KRI</center></th>
							<th><center>Waktu Pelaporan</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peringatan KRI</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Simpan Draft
							</li>
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
								 Diverifikasi oleh RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>

			</div>
		<!-- END CONTENT-->
	</div>
</div>