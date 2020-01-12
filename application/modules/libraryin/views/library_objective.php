<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Daftar Tujuan
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
					<a id="bread_tab_title" target="_self" href="javascript:;">Risiko</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Daftar Objektif</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown"  data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/libraryin/list_ob_pdf");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/libraryin/list_ob_excel");?>">Excel</a>
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
				    <button id="button-add-objective" class="btn green btn-sm" type="button" style="margin-bottom: 10px;"  >Tambah Objektif</button>
					<div><!--class="table-scrollable"-->
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_objective_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_objective_list-filterBy">
								<option value="objective">Objektif</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_objective_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_objective_list-filterButton">Cari</button>
					</form>
						<table class="table table-condensed table-bordered table-hover" id="datatableobjective_ajax">
						<thead>
						<tr role="row" class="heading">
							 
							<th width="15%"><center>OB.ID</center></th>
							<th><center>Objektif Risiko</center></th>
							<th width="15%"><center>ID Risiko</center></th>
							<th width="15%"><center>Aksi</center></th>
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
<div id="modal_listrisk_objective" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Daftar Objektif</h4>		 
	</div>
	<div class="modal-body">
				<form id="modal-listrisk-form-objective" role="form" class="form-horizontal">
					<div class="form-body">
				
						<div class="form-group">
						 
						<label class="col-md-3 control-label smaller cl-compact">OB.ID</label>
							<div class="col-md-9">
							<input class="form-control input-sm" readonly="true" type="text" placeholder="" name="id" id="id">
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label smaller cl-compact">Objektif<span class="required">* </span></label>
							 
									<div class="col-md-9">
										<textarea class="form-control" name="objective" id = "objective" placeholder="NONE" required="required"></textarea>
										<textarea style="display:none;" class="form-control" name="objective_ex" id = "objective_ex"></textarea>										 
									</div> 
							 
						</div>
					</div>
				</form>			
		<br>			
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
		<button id="library-modal-listriskobjective-update" type="button" 
			class="btn blue ladda-button"
			data-style="expand-right">Simpan
		</button>
	</div>
</div>