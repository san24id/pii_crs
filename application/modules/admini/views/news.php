<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Pengelola Berita
		</h3>
		<!-- END PAGE HEADER-->
		
		<div class="row">
		<div class="col-md-12">
			<div class="portlet">
			<div class="portlet-title">
				<div class="actions">
					<a href="javascript: location.href='<?=$site_url?>/admin/news/newsInput'" class="btn default green-stripe">
					<i class="fa fa-plus font-green"></i>
					<span class="hidden-480">
					Tambah Baru</span>
					</a>
				</div>
			</div>
			
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">FIlter Berdasarkan</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="title">Judul Berita</option>
						<option value="filename">Nama File</option>
						<option value="a.created_date">Tanggal Dibuat</option>
						<option value="a.created_by">Dibuat Oleh</option>
						<option value="a.date_publish">Tanggal Publikasi</option>
						<option value="a.status">Status</option>
						
					</select>
				</div>
				<div class="form-group" id="sts">
						<select class="hesh form-control input-sm" id="inputsts">
							<option value="">Semua</option>	
							<option value="1">Dipublikasi</option>	
							<option value="0">Tidak Dipublikasi</option>
						</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
				</div>
				<button type="submit"  class="btn green btn-sm" id="filterFormSubmit">Cari</button>
			</form>	
			</div>
			
			<div class="portlet-body">
				<?php if(isset($upload_success)) { ?>
				<div class="alert alert-success">
					<strong>Sukses!</strong> Sukses manmbahkan dan Upload Berita.
				</div>
				<?php } ?>
				
				<div class="table-container">
					<div class="table-actions-wrapper">
					</div>
					<table class="table table-striped table-bordered" id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="5%">
							 No
						</th>
						<th width="25%">Judul Berita</th>
						<th width="25%">Nama File</th>
						<th width="10%">Tanggal Dibuat</th>
						<th width="15%">Dibuat Oleh</th>
						<th width="10%">Tanggal Publikasi</th>
						<th>Status</th>
						<th width="7%">Aksi</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
			
		
	</div>
</div>