<script src="assets/toogle/js/jquery-3.1.1.min"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Entri KRI
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
					<a target="_self" href="javascript:;">Penetapan KRI</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Entri KRI</a>
				</li>
			</ul>
		</div>
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<form id="input-form" role="form" class="form-horizontal">
				<div class="form-body">
					<div class="form-group">
						<input type="hidden" name="risk_library_id" id="risk_library_id" value=""/>
						<label class="col-md-2 control-label">ID Risiko</label>
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control input-sm" readonly="true" name="risk_library_code" placeholder="">
								<span class="input-group-btn">
								<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-library"><i class="fa fa-search fa-fw"/></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Peristiwa Risiko</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_event" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Level Risiko</label>
						<div class="col-md-6">
						<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_level" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Penanganan Risiko</label>
						<div class="col-md-6">
							<input type="text" class="form-control input-sm input-readview" readonly="true" name="risk_treatment" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label" >Action Plan</label>
						<div class="col-md-8">
							<table id="action_plan_table" class="table table-condensed table-bordered table-hover">
								<thead>
								<tr role="row" class="heading">
									<th>Action Plan</th>
									<th>Batas Waktu</th>
									<th>Pemilik Action Plan</th>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</form>
			<hr/>
			<div class="form">
			<form id="kri-form" role="form" class="form-horizontal">
			<input type="hidden" name="kri_id" value=""/>
			<input type="hidden" name="risk_id" id="kri-risk-id" value=""/>
			<div class="form-body">
				<div class="form-group">
					<input type="hidden" name="kri_library_id" value=""/>
					<label class="col-md-2 control-label">ID KRI</label>
					<div class="col-md-6">
						<div class="input-group">
							<input type="text" class="form-control input-sm" readonly="true" name="kri_library_code" placeholder="">
							<span class="input-group-btn">
							<button class="btn btn-primary btn-sm" type="button" data-toggle="modal" href="#modal-kri"><i class="fa fa-search fa-fw"/></i></button>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Mitigasi Selesai ?</label>
					<div class="col-md-6">
					<span class="man"><input checked data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-on = "Already" data-off = "Not Yet" id="cek-mitigation"></span>
					<span class="man2"><input data-toggle="toggle" type="checkbox" data-size="small" data-onstyle="danger" data-on = "Already" data-off = "Not Yet" id="cek-mitigation2"></span>
					<input type="hidden" class="form-control input-sm" id="mandatory" name="mandatory" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Indikator Key Risk</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="key_risk_indicator" required="required" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Pemilik KRI</label>
					<div class="col-md-4">
					<select class="form-control input-sm" name="kri_owner" required="required">
						<option value="">Pilih Satu</option>
						<?php foreach($division_list as $row) { ?>
						<option value="<?=$row['ref_key']?>"><?=$row['ref_value']?></option>
						<?php } ?>
					</select>
					</div>
				</div>
				<div class="form-group">
				<label class="col-md-2 control-label"></label>
					<div class="col-md-6">
						<span style="color:#035CFF"><p align="left"><i></i></p></span>
					</div>
				</div>
				<div class="form-group">	
					<label class="col-md-2 control-label">Ambang</label>
					<div class="col-md-6">
					<select class="form-control input-sm" id="select-treshold-type-1" name="treshold_type" required="required">
						<option value="">Pilih Satu</option>
						<option value="SELECTION">Teks</option>
						<option value="VALUE">Nilai</option>
					</select>

					<select class="form-control input-sm" id="select-treshold-type" name="treshold_type" required="required">
						<option value="">Pilih Satu</option>
						<option value="SELECTION">Teks</option>
						<option value="VALUE">Nilai</option>
					</select>

					<select class="form-control input-sm" id="select-treshold-type2" name="treshold_type" required="required">
						<option value="">Pilih Satu</option>
						<option value="SELECTION">Teks</option>
						<option value="VALUE">Nilai</option>
					</select>
					</div>
				</div>

				<div class="form-group"  id="treshold_description">
				<label class="col-md-2"></label>
					<div class="col-md-8">
						<button class="btn green btn-sm" style="margin-bottom: 10px;" type="button" id="button-kri-open-treshold"><span class="glyphicon glyphicon-cog"></span>&nbsp;Ubah</button>
						<button class="btn green btn-sm" style="margin-bottom: 10px;" type="button" id="button-kri-open-treshold2"><span class="glyphicon glyphicon-cog"></span>&nbsp;Ubah</button>
						<table id="treshold_table" class="table table-condensed table-bordered table-hover">
							<thead>
							<tr role="row" class="heading">
								<th>Operator</th>
								<th>Nilai 1</th>
								<th>Nilai 2</th>
								<th>Jenis Nilai</th>
								<th>Warning</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Waktu Pelaporan</label>
					<div class="col-md-8">
					<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control input-sm" id="timing" name="timing_pelaporan" required="required" readonly>
						<span class="input-group-btn">
						<button class="btn default btn-sm" type="button"><i class="fa fa-calendar"></i></button>
						</span>
					</div>
					</div>
				</div>
			</div>
			<div class="form-actions right">
				<button id="kri-button-submit" type="button" class="btn blue"><i class="fa fa-check-circle"></i> Aktif</button>
				<button id="kri-button-save" type="button" class="btn blue"><i class="fa fa-circle-o"></i>Simpan</button>
				<button type="button" class="btn yellow" id="kri-button-cancel"><i class="fa fa-times"></i>Batal</button>
			</div>
			</form>
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
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-library-filter-submit">Cari</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>ID Risiko</th>
					<th>Peristiwa Risiko</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- KRI LIBRARY -->
<div id="modal-kri" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Pustaka KRI</h4>
		<div class="inputs">
			<div class="portlet-input input-inline">
				<div class="input-group">
					<input type="text" class="form-control" name="filter_search" placeholder="search...">
					<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="modal-kri-filter-submit">Cari</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-body">
		<div>
			<table id="kri_library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					<th width="66px">&nbsp;</th>
					<th>Kode KRI</th>
					<th>Indikator Key Risk</th>
					<th>Mitigasi Selesai ?</th>
				</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>

<!-- KRI Treshold BY SELECTION -->
<div id="modal-treshold-selection" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
		<h4 class="modal-title">Pilih Jenis Ambang</h4>
	</div>
	<div class="modal-body">
		<input type = "hidden" id = "form-control-revid-objective">
		<form id="kri-form-selection" role="form" class="form-horizontal">
			<input type="hidden" name="operator" value="EQUAL" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Sama dengan</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-1" id="value-equal-1" placeholder=""></textarea>
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-1-result" id="value-equal-1-result" >
						<option value="GREEN">Hijau</option>
						<option value="YELLOW">Kuning</option>
						<option value="RED">Merah</option>
					</select>
					</div>
				</div>
			</div>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">sama dengan</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-2" id="value-equal-2" placeholder=""></textarea>
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-2-result" id="value-equal-2-result" >
						<option value="GREEN">Hijau</option>
						<option value="YELLOW">Kuning</option>
						<option value="RED">Merah</option>
					</select>
					</div>
				</div>
			</div>
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">sama dengan</label>
					<div class="col-md-6">
					<textarea class="form-control input-sm popovers"  data-container="body" data-placement="bottom" rows="3" name="value-equal-3" id="value-equal-3" placeholder=""></textarea>
					</div>
					<label class="col-md-1 control-label">Warning</label>
					<div class="col-md-2">
					<select class="form-control input-sm" name="value-equal-3-result" id="value-equal-3-result" >
						<option value="GREEN">Hijau</option>
						<option value="YELLOW">Kuning</option>
						<option value="RED">Merah</option>
					</select>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button id="button-treshold-selection-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Tutup</button>
	</div>
</div>

<!-- KRI Treshold BY VALUE -->
<div id="modal-treshold-value" class="modal fade" tabindex="-1" data-width="950" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<h4 class="modal-title">Pilih Jenis Nilai</h4>
	</div>
	<div class="modal-body">
	<input type = "hidden" id = "form-control-value-objective">
		<form id="kri-form-value" role="form" class="form-horizontal">
			<div class="form-body row">
				<div class="col-md-6" id="t-col-left-treshold">
					<h4 style="margin-top: 0;"><b>Ambang Numerik</b></h4>
					<div class="form-group">
						<input type="hidden" name="value-below-2" value='-'>
						<input type="hidden" name="value-below-oper_v" value='Below'>
						<input type="hidden" name="value-below-oper" value='BELOW'>
						<input type="hidden" name="value-below-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Bawah</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="value-below-1" id="value-below-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-below-result" id="value-below-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="value-between-oper_v" value='Between'>
						<input type="hidden" name="value-between-oper" value='BETWEEN'>
						<input type="hidden" name="value-between-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Antara</label>
						<div class="col-md-7" style="padding-right: 0px;">
							<div class="input-group">
								<input type="number" class="form-control input-sm" name="value-between-1" id="value-between-1">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="value-between-2" id="value-between-2">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-between-result" id="value-between-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="value-above-2" value='-'>
						<input type="hidden" name="value-above-oper_v" value='Above'>
						<input type="hidden" name="value-above-oper" value='ABOVE'>
						<input type="hidden" name="value-above-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Atas</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="value-above-1" id="value-above-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-above-result" id="value-above-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="col-md-6" id="t-col-right-treshold">
					<h4 style="margin-top: 0;"><b>Ambang Persentase</b></h4>
					<div class="form-group">
						<input type="hidden" name="perc-below-2" value='-'>
						<input type="hidden" name="perc-below-oper_v" value='Below'>
						<input type="hidden" name="perc-below-oper" value='BELOW'>
						<input type="hidden" name="perc-below-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Bawah</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="perc-below-1" id="perc-below-1">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-below-result" id="perc-below-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="perc-between-oper_v" value='Between'>
						<input type="hidden" name="perc-between-oper" value='BETWEEN'>
						<input type="hidden" name="perc-between-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Antara</label>
						<div class="col-md-7" style="padding-right: 0px;">
							<div class="input-group">
								<input type="number" class="form-control input-sm" name="perc-between-1" id="perc-between-1">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="perc-between-2" id="perc-between-2">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-between-result" id="perc-between-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="perc-above-2" value='-'>
						<input type="hidden" name="perc-above-oper_v" value='Above'>
						<input type="hidden" name="perc-above-oper" value='ABOVE'>
						<input type="hidden" name="perc-above-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Atas</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="perc-above-1" id="perc-above-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-above-result" id="perc-above-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
				</div>
				
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button id="button-treshold-value-add" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Tutup</button>
	</div>
</div>
