<?php error_reporting(0); ?>
<!-- BEGIN CONTENT -->


<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Loss Event Form
		</h3>
	
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				
				<li>
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Other Risk</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister">Loss Event</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption" id="div-portlet-page-caption">
						Loss Event Form
					</div>
				</div>
				
				<div class="portlet-body form">
					<form id="input-form" role="form" class="form-horizontal">
						<div class="form-body">
							<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Sektor Proyek <span class="required">* </span></label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="sektor_proyek">
										<?php foreach($sektor_list as $row) { ?>
										<option value="<?=$row['id_sektor']?>"><?=$row['sektor']?></option>
										<?php } ?>
									</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nama Proyek <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nama_proyek" class="form-control input-sm">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nilai Proyek <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nilai_proyek" class="form-control input-sm" placeholder="number only" id="rupiah">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Kejadian<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="kejadian" data-required="1" placeholder="" data-content="" ></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Tipe Kerugian<span class="required">* </span></label>
									<div class="col-md-9">
									<select class="form-control input-sm" name="tipe">
										<option value="Loss Event">Loss Event</option>
										<option value="Near Miss">Near Miss</option>
									</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Nilai Kerugian <span class="required">* </span></label>
									<div class="col-md-9">
										<input type="text" name="nilai_kerugian" class="form-control input-sm" placeholder="number only" id="rupiah_nilai">
									</div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Deskripsi/ Keterangan<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="deskripsi" data-required="1" placeholder="" data-content="" ></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Periode<span class="required">* </span></label>
									<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="">
										<input type="text" class="form-control input-sm" name="periode" id = "periode" placeholder="select date" readonly>
									<span class="input-group-btn">
										<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
									</span>
									</div>
								</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Penyebab<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="penyebab" data-required="1" placeholder="" data-content="" ></textarea>
									</div>
								</div>
								<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact"></label>
								<div class="panel-body col-md-9">
									 <div class="clearfix">
									 	<a href="#form-control-divisi" id="button-form-control-open-divisi" data-toggle="modal" class="btn default green pull-right btn-sm">
									 	<i class="fa fa-plus"></i>
									 	<span class="hidden-480">
									 	Add</span>
									 	</a>
									 </div>
									 
									 <div class="table-scrollable">
									 	<table id="divisi_table" class="table table-condensed table-bordered table-hover">
									 		<thead>
									 		<tr role="row" class="heading">
									 			<th><center>Fungsi Terkait</center></th>
									 			<th width="30px">&nbsp;</th>
									 		</tr>
									 		</thead>
									 		<tbody>
									 		</tbody>
									 	</table>
									 </div>
								</div>	
								</div>		
								<div class="form-group">
									<label class="col-md-3 control-label smaller cl-compact">Lesson Learned<span class="required">* </span></label>
									<div class="col-md-9">
										<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="lesson_learned" data-required="1" placeholder="" data-content="" ></textarea>
									</div>
								</div>
								
							</div>
							</div>

						</div>
						<div class="form-actions right">
								<button id="risk-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i> Insert</button>
								<a href="<?php echo site_url() ?>/main/mainrac/lossevent"><button type="button" class="btn yellow"><i class="fa fa-times"></i> Cancel/ Back</button></a>
						</div>

					</form>
				</div>
			</div>
		</div>
		</div>
		
	</div>
		</div>
		</div>
	</div>
</div>

<!-- DIVISION -->
<div id="form-control-divisi" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Fungsi Terkait</h4>
	</div>
	<div class="modal-body">
		
			<form id="input-form-control-divisi" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
					<input type = "hidden" id = "form-control-revid-divisi">
						<label class="col-md-3 control-label smaller cl-compact">Division</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="hidden" class="form-control input-sm" readonly="true" name="division_id" id = "division_id" placeholder="">
								<input type="text" class="form-control input-sm" readonly="true" name="division_name" id = "division_name" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-divisi"><i class="fa fa-search fa-fw"/></i></button>
								</span>
								
							</div>
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button id="input-control-add-divisi" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Add</button>
	</div>
</div>

<!-- DIVISI search Library -->
<div id="modal-divisi" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Division</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-control-filter-submit-divisi">Search</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_divisi_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>Division</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }


    var rupiah_nilai = document.getElementById('rupiah_nilai');
    rupiah_nilai.addEventListener('keyup', function(e){
      // tambahkan 'Rp.' pada saat form di ketik
      // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
      rupiah_nilai.value = formatRupiahNilai(this.value, 'Rp. ');
    });
 
    /* Fungsi formatRupiah */
    function formatRupiahNilai(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah_nilai  = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah_nilai += separator + ribuan.join('.');
      }
 
      rupiah_nilai = split[1] != undefined ? rupiah_nilai + ',' + split[1] : rupiah_nilai;
      return prefix == undefined ? rupiah_nilai : (rupiah_nilai ? 'Rp. ' + rupiah_nilai : '');
    }

</script>
