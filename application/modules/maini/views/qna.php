<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Tanya &amp; Jawab
		</h3>
		<!-- END PAGE HEADER-->
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
					<a target="_self" href="javascript:;">Tanya &amp; Jawab</a>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12 clearfix">
				<a href="javascript:;" class="btn btn-sm green pull-right" id="btn-open-form">
				<i class="fa fa-plus"></i>
				<span class="hidden-480">
				Tambah Pertanyaan Baru </span>
				</a>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<form class="form-inline" role="form" id="filterForm" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy">Filter Berdasarkan</label>
						<select class="form-control input-medium input-sm" id="filterFormBy">
							<option value="a.subject">Subyek</option>
							<option value="a.created_date">Tanggal</option>
							<option value="a.status">Jawaban</option>
						</select>
					</div>

					<div class="form-group" id="sts">
						<select class="hesh form-control input-sm" id="inputsts">
							<option value="">ALL</option>	
							<option value="1">Completed</option>	
							<option value="0">Waiting For Response</option>
						</select>
					</div>

					<div class="form-group">
						<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Insert Filter Value">
					</div>
					<button type="button" id="filterFormSubmit" class="btn blue btn-sm">Search</button>
				</form>
				<hr/>
				
				<div>
					<table class="table table-condensed table-bordered table-hover" id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th>No</th>
							<th>Tanggal</th>
							<th>Subyek</th>
							<th>Jawaban</th>
						</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- FORM MODAL -->
<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Tambah Pertanyaan Baru</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<form id="input-form" class="form-horizontal" role="form">
				<input type="hidden" name="periode_id" value="">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-2 control-label">Subyek</label>
						<div class="col-md-6">
							<input type="text" class="form-control" placeholder="Subject" name="subject">
						</div>
						<label class="col-md-1 control-label">Tanggal</label>
						<div class="col-md-2">
							<input type="text" readonly class="form-control" placeholder="Date" name="var_date">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Pertanyaan</label>
						<div class="col-md-9">
							<textarea  class="form-control" rows="4" name="question"></textarea>
						</div>
					</div>
					<div class="form-group fg-answer">
						<label class="col-md-2 control-label">Jawaban</label>
						<div class="col-md-9">
							<textarea readonly class="form-control" rows="4" name="answer"></textarea>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
		<button id="input-form-submit-button" type="button" 
			class="btn blue ladda-button"
			 data-style="expand-right"
			>Submit</button>
	</div>
</div>