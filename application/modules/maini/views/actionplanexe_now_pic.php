<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Periode Eksekusi Action Plan : <?php 
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
					<a target="_self" href="<?=$site_url?>/main">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaksi</a>
					<i class="fa fa-angle-right"></i>
				</li>
			 
				<li>
					<a target="_self" href="javascript:;">Eksekusi Action Plan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Eksekusi Action Plan Regular</a>
				</li>
			</ul>
		</div>

		<!-- END PAGE HEADER-->
		<div class="row">
		<script type="text/javascript">
		</script>
		<div class="col-md-12">
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Batas Waktu</option>
								<option value="execution_status">Eksekusi</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Cari</button>
					</form>
						
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Batas Waktu</center></th>
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>Eksekusi</center></th>
							<th><center>Kode Risiko</center></th>
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
					<h4>Keterangan</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/confirm.png"/> &nbsp; 
								Menunggu verifikasi Kepala Divisi
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								Menunggu verifikasi RAC
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
		
	</div>
</div>


<!-- LIBRARY -->
<div id="modal-library" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Pustaka Risiko</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="col-md-6 input-group">
					<select class="form-control input-sm" name="filter_search">
						<option value="HIGH">Tinggi</option>
						<option value="MODERATE">Sedang</option>
						<option value="LOW">Rendah</option>
					</select>
					<span class="input-group-btn">
					<button class="btn btn-default btn-sm" type="button" id="modal-library-filter-submit">Cari</button>
					</span>
				</div>
				<!--
				<div class="checkbox-list">
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_high" class="checkbox_selectClass" value="HIGH"> Tinggi </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_moderate" class="checkbox_selectClass" value="MODERATE"> Sedang </label>
					<label class="checkbox-inline">
					<input type="checkbox" id="checkbox_low" class="checkbox_selectClass" value="LOW"> Rendah </label>
				</div>
				-->
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="2%">
						<input type="checkbox" class="group-checkable">
					</th>
					<th>No</th>
					<th>ID Risiko</th>
					<th>Kejadian Risiko</th>
					<th>Level Risiko</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
	<div class="modal-footer">
		<button id="library-modal-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Tambah</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
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

<!-- Execution Form -->
<div id="modal-exec" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Eksekusi Action Plan</h4>
	</div>
	<div class="modal-body form">
		<form id="exec-form" role="form" class="form-horizontal">
		<input type="hidden" id="form-action-id" name="action_id" value="" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 smaller control-label">Status </label>
					<div class="col-md-9">
					<select class="form-control input-sm" name="execution_status" id="exec-select-status">
						<option value="COMPLETE" selected>Selesai</option>
						<option value="EXTEND">Diperpanjang</option>
						<option value="ONGOING">Sedang Berjalan</option>
					</select>
					</div>
				</div>
				<div class="form-group" id="fgroup-explain">
					<label class="col-md-3 control-label smaller cl-compact">Penjelasan<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_explain" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-evidence">
					<label class="col-md-3 control-label smaller cl-compact">Bukti</label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_evidence" placeholder=""></textarea>
					</div>
				</div>				 
				<div class="form-group" id="fgroup-reason">
					<label class="col-md-3 control-label smaller cl-compact">Alasan<span class="required">* </span></label>
					<div class="col-md-9">
					<textarea class="form-control" rows="3" name="execution_reason" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group" id="fgroup-date">
					<label class="col-md-3 smaller control-label">Tanggal Revisi<span class="required">* </span></label>
					<div class="col-md-9">
					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
						<input type="text" class="form-control input-sm" id="form-action-dd" name="revised_date" readonly>
						<span class="input-group-btn">
						<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
			
			<div class="form-actions right">
				<button id="exec-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Simpan </button>
				<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
			</div>
		</form>
	</div>
</div>