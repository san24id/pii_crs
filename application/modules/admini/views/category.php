<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Pngelola Kategori
		</h3>
		
		<!-- END PAGE HEADER-->
		<div class="row">
		<div class="col-md-12">
			<h4>Kategori</h4>
			<div class="row"><div class="col-md-9">
			<div class="form-group">
				<div class="col-md-12">
					<div class="input-group">
					<input type = "hidden" id = "lastcat" value = "">					 
					<select class="form-control input-sm" name="risk_category" id="sel_risk_category"></select>
					<span class="input-group-btn" style="padding-left: 20px;">
					<button class="btn btn-success btn-sm" id='btn_cat_add' type="button"><i class="fa fa-plus font-white"></i>Tambah</button>
					<button class="btn btn-success btn-sm" id='btn_cat_edit' type="button"><i class="fa fa-pencil font-white"></i>Ubah</button>
					<button class="btn btn-success btn-sm" id='btn_cat_delete' type="button"><i class="fa fa-cross font-white"></i>Hapus</button>
					</span>
					</div>
				</div>
				<div class="col-md-12" style="padding-top: 10px; width: 530px;">
					<div class="note note-info" id="note-category"><p></p></div>
				</div>
			</div>
			</div></div>
			<hr/>
			
			<h4>Sub Kategori</h4>
			<div class="row"><div class="col-md-9">
			<div class="form-group">
				<div class="col-md-12">
					<div class="input-group">
					<input type = "hidden" id = "lastsel_risk_sub_category" value = "">
					<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category"></select>
					<span class="input-group-btn" style="padding-left: 20px;">
					<button class="btn btn-success btn-sm" id='btn_sub_cat_add' type="button"><i class="fa fa-plus font-white"></i>Tambah</button>
					<button class="btn btn-success btn-sm" id='btn_sub_cat_edit' type="button"><i class="fa fa-pencil font-white"></i>Ubah</button>
					<button class="btn btn-success btn-sm" id='btn_sub_cat_delete' type="button"><i class="fa fa-cross font-white"></i>Hapus</button>
					</span>
					</div>
				</div>
				<div class="col-md-12" style="padding-top: 10px; width: 530px;">
					<div class="note note-info" id="note-sub-category"><p></p></div>
				</div>
			</div>
			</div></div>
			<hr/>
			
			<h4>Sub Kategori Level 2</h4>
			<div class="row"><div class="col-md-9">
			<div class="form-group">
				<div class="col-md-12">
					<div class="input-group">
					<input type = "hidden" id = "lastsel_risk_2nd_sub_category" value = "">
					<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category"></select>
					<span class="input-group-btn" style="padding-left: 20px;">
					<button class="btn btn-success btn-sm" id='btn_sub_sub_cat_add' type="button"><i class="fa fa-plus font-white"></i>Tambah</button>
					<button class="btn btn-success btn-sm" id='btn_sub_sub_cat_edit' type="button"><i class="fa fa-pencil font-white"></i>Ubah</button>
					<button class="btn btn-success btn-sm" id='btn_sub_sub_cat_delete' type="button"><i class="fa fa-cross font-white"></i>Hapus</button>
					</span>
					</div>
				</div>
				<div class="col-md-12" style="padding-top: 10px; width: 530px;">
					<div class="note note-info" id="note-sub_sub-category"><p></p></div>
				</div>
			</div>
			</div></div>
		</div>
		</div>
	</div>
</div>

<!-- CATEGORY -->
<div id="modal-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Kategori</h4>
	</div>
	<div class="modal-body">
			<form id="modal-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Kode</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_code" placeholder="" readonly = "readonly">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Nama Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_name" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Deskripsi</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm" rows="3" name="cat_desc" placeholder=""></textarea>
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
		<button id="modal-category-form-submit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Simpan</button>
	</div>
</div>

<!-- SUB CATEGORY -->
<div id="modal-sub-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Sub Kategori</h4>
	</div>
	<div class="modal-body">
			<form id="modal-sub-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="cat_parent_text" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Kode</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_code" placeholder="" readonly = "readonly">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Nama Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_name" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Deskripsi</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm" rows="3" name="cat_desc" placeholder=""></textarea>
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
		<button id="modal-sub-category-form-submit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Simpan</button>
	</div>
</div>

<!-- SUB SUB CATEGORY -->
<div id="modal-sub_sub-category" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Sub Kategori</h4>
	</div>
	<div class="modal-body">
			<form id="modal-sub_sub-category-form" role="form" class="form-horizontal">
				<input type="hidden" name="mode" value="add" />
				<input type="hidden" name="cat_id" value="" />
				<input type="hidden" name="cat_parent" value="0" />
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="cat_parent_text" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Sub Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" readonly="true" name="cat_sub_parent_text" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Kode</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_code" placeholder="" readonly = "readonly">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Nama Kategori</label>
						<div class="col-md-9">
						<input type="text" class="form-control input-sm" name="cat_name" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label smaller cl-compact" >Deskripsi</label>
						<div class="col-md-9">
						<textarea class="form-control input-sm" rows="3" name="cat_desc" placeholder=""></textarea>
						</div>
					</div>
				</div>
			</form>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
		<button id="modal-sub_sub-category-form-submit" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Simpan</button>
	</div>
</div>