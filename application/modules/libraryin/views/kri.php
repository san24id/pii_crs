<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		KRI
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini/mainrac">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Manajemen Pustaka</a>
					<i class="fa fa-angle-right"></i>
				</li>
				 
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">KRI</a>
				</li>
			</ul>
			
			 <div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/kri_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/kri_excel");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div> 
			  
		</div>
<!-- END PAGE HEADER-->
<!-- BEGIN CONTENT-->
		    
		<div class="tabbable-custom ">
			 
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
				    
					<div ><!--class="table-scrollable"-->
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan :</label>
							<select class="form-control input-medium input-sm" id="tab_kri_list-filterBy">
								<option value="key_risk_indicator">Nama KRI</option>
								<option value="mandatory">Mitigasi</option>
							</select>
						</div>
						<div class="form-group" id="sts">
							<select class="form-control input-medium input-sm" id="input_kri">
								<option value="">Pilih Satu</option>
								<option value="Y">Already</option>
								<option value="N">Not Yet</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Insert Filter Value" id="tab_kri_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_kri_list-filterButton">Cari</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatablekri_ajax">
						<thead>
						<tr role="row" class="heading">
							 
							<th><center>KRI ID</center></th>
							<th><center>Nama KRI</center></th> 
							<th><center>Mitigasi</center></th> 
							<th><center>Tipe Ambang</center></th> 
							<th><center>ID Risiko</center></th> 
							<th><center>Aksi</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
					<hr/>
					
					<div class="row">
					 
					</div>
				</div>
				  
			</div>
			
		</div>
		<!-- END CONTENT-->
	</div>
</div>


<!-- LIBRARY -->
<div id="modal_listrisk" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Pustaka Indikator Key Risk (KRI)</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact"> KRI ID  :</label>
							<div class="col-md-9">
							<input class="form-control input-sm input-readview" type="text" placeholder="" name="kri_code" id = "kri_code" readonly="true"  >
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Indicator Key Risk :</label>
							<div class="col-md-9">
							<input type = "text" name = "key_risk_indicator" id = "key_risk_indicator" class = "form-control">  
							</div>
						</div>
						
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Mitigasi :</label>
							<div class="col-md-9">
							<input type = "text" name = "mandatory" id = "mandatory" class = "form-control">  
							</div>
						</div>
						 
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">Tipe Ambang :</label>
							<div class="col-md-9">
							<select name="treshold_type"  class="form-control"   id="select-treshold-type">
							
							</select>							 
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label">&nbsp;</label>
							<div class="col-md-8">
								 <button class="btn green btn-sm" style="margin-bottom: 10px;" type="button" id="button-kri-open-treshold">Tambah Ambang</button> 
								<table id="treshold_table" class="table table-condensed table-bordered table-hover">
									<thead>
									<tr role="row" class="heading">
										<th>Operator</th>
										<th>Nilai 1</th>
										<th>Nilai 2</th>
										<th>Tipe Nilai</th>
										<th>Hasil</th>
										<th> &nbsp; </th>
									</tr>
									</thead>
									<tbody id = "treshold_listnya">
									 
									</tbody>
								</table>
							</div>
						</div> 
								  
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button id="library-modal-listriskkri-update" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Simpan</button>
		<button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
	</div>
</div>


<!-- KRI Treshold BY SELECTION -->
<div id="modal-treshold-selection" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Tambah Ambang</h4>
	</div>
	<div class="modal-body">
		<form id="kri-form-selection" role="form" class="form-horizontal">
			<input type="hidden" name="operator" value="EQUAL" />
			<input type="hidden" name="kri_id" value="" />
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-2 control-label">Nilai</label>
					<div class="col-md-6">
					<input type="text" class="form-control input-sm input-readview" name="value_1" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Hasil</label>
					<div class="col-md-6">
					<select class="form-control input-sm" name="result">
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
			>Tambah</button>
	</div>
</div>

<!-- KRI Treshold BY VALUE -->
<div id="modal-treshold-value" class="modal fade" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Tambah Ambang</h4>
	</div>
	<div class="modal-body">
		<form id="kri-form-value" role="form" class="form-horizontal">
			<input type="hidden" name="kri_id" value="" />
			<div class="form-body row">
				<div class="col-md-6">
					<h4 style="margin-top: 0;">Ambang Numerik</h4>
					<div class="form-group">
						<input type="hidden" name="value-below-2" value='-'>
						<input type="hidden" name="value-below-oper_v" value='Below'>
						<input type="hidden" name="value-below-oper" value='BELOW'>
						<input type="hidden" name="value-below-value_type" value='NUMERIC'>
						
						<label class="col-md-2 control-label">Bawah</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm input-readview" name="value-below-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-below-result">
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
								<input type="number" class="form-control input-sm" name="value-between-1">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="value-between-2">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-between-result">
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
						<input type="number" class="form-control input-sm input-readview" name="value-above-1" placeholder="">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="value-above-result">
								<option value="GREEN">Hijau</option>
								<option value="YELLOW">Kuning</option>
								<option value="RED">Merah</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6" id="t-col-right-treshold">
					<h4 style="margin-top: 0;"><input type="checkbox" id="is_percentage_treshold" name = "is_percentage_treshold" value="1" />Persentase Ambang</h4>
					<div class="form-group">
						<input type="hidden" name="perc-below-2" value='-'>
						<input type="hidden" name="perc-below-oper_v" value='Below'>
						<input type="hidden" name="perc-below-oper" value='BELOW'>
						<input type="hidden" name="perc-below-value_type" value='PERCENTAGE'>
						
						<label class="col-md-2 control-label">Bawah</label>
						<div class="col-md-7" style="padding-right: 0px;">
						<input type="number" class="form-control input-sm" name="perc-below-1" placeholder="" disabled="true">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-below-result" disabled="true">
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
								<input type="number" class="form-control input-sm" name="perc-between-1" disabled="true">
								<span class="input-group-addon" style="min-width: 10px; padding: 0;"></span>
								<input type="number" class="form-control input-sm" name="perc-between-2" disabled="true">
							</div>
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-between-result" disabled="true">
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
						<input type="number" class="form-control input-sm" name="perc-above-1" placeholder="" disabled="true">
						</div>
						<div class="col-md-3">
							<select class="form-control input-sm" name="perc-above-result" disabled="true">
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
			>Tambah</button>
	</div>
</div>

