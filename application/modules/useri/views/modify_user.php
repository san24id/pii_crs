<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Memodifikasi Pengguna
		</h3>
		<!-- END PAGE HEADER-->		
		<div class="row">
		<div class="col-md-12">
		<div class="portlet">
		<div class="portlet-title">
			<form class="form-inline" role="form" id="filterForm">
				<div class="form-group">
					<label for="filterFormBy">Filter Berdasarkan</label>
					<select class="form-control input-medium input-sm" id="filterFormBy">
						<option value="username">Nama User</option>
						<option value="display_name">Nama Lengkap</option>
						<option value="mtable.role_name">Role</option>
						<option value="mtable.role_status">Status Role</option>
						<option value="mtable.email">Email</option>
						<option value="mtable.division_name">Divisi</option>
					</select>
				</div>
				<div class="form-group" id="choose_l_divisi">
					<select class="form-control input-sm" id="l_divisi">
						<option value="-">All</option>
							<?php foreach ($division_list as $key) {?>
								<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
							<?php }?>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-sm" id="filterFormValue" placeholder="Search">
				</div>
				<button type="button" id="filterFormSubmit" class="btn green btn-sm">Cari</button>
				<a href="#form-user" id="button-form-control-open" data-toggle="modal" class="btn default green pull-right btn-sm">
				<span class="hidden-480">User Hide </span></a>
			</form>	
			
		</div>

		</div>
		
		<div class="portlet-body">
			<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_ajax">
				<thead>
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Nama User<center></th>
					<th width="16%"><center>Nama Lengkap</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Status Role</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Divisi</center></th>
					<th width="20%"><center>Aksi</center></th>
				</tr>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>

		</div>
		</div>
		</div>
		

		
		<!-- FORM MODAL -->
		<div id="form-data" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Tambah User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form" class="form-horizontal" role="form">
						<input type="hidden" name="user_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">Nama User</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="User Name" name="username">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Nama Lengkap</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Full Name" name="display_name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Role</label>
								<div class="col-md-6">
									<select class="form-control" name="role_id" id="role_id">
										<?php foreach($role_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Status Role</label>
								<div class="col-md-6">
									<select class="form-control" name="role_status" id="role_status">
										
										<?php foreach($role_status as $v) { ?>
										
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										
										<?php } ?>
									</select>
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-md-3 control-label">Status Role</label>
								<div class="col-md-6">
									<input type = "text" name = "role_status" id = "role_status" class = "form-control">
								</div>
							</div>-->
							<div class="form-group">
								<label class="col-md-3 control-label">Email</label>
								<div class="col-md-6">
									<input type = "text" name = "email" id = "email" class = "form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Divisi</label>
								<div class="col-md-6">
									<select class="form-control" name="division_id">
										<?php foreach($division_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group" style="display: none;">
								<label class="col-md-3 control-label">Divisi</label>
								<div class="col-md-6">
									<input type="text" class="form-control" placeholder="Division Old" name="division_old">
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

		<!-- FORM MODAL MOVE -->
		<div id="form-data-move" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Tambah User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="input-form-move" class="form-horizontal" role="form">
						<input type="hidden" name="user_id" value="">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-3 control-label">User Lama</label>
								<div class="col-md-6">
									<input type="hidden" class="form-control" placeholder="User Name" name="username_id">
									<input type="text" class="form-control" placeholder="User Name" name="username_old">
								</div>
							</div>
							
							
							
							<div class="form-group">
								<label class="col-md-3 control-label">User Baru</label>
								<div class="col-md-6">
									<select class="form-control" name="username_new">
										<?php foreach($username_list as $v) { ?>
										<option value="<?=$v['key']?>"><?=$v['value']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Tutup</button>
				<button id="input-form-submit-button-move" type="button" 
					class="btn blue ladda-button"
					 data-style="expand-right"
					>Submit</button>
			</div>
		</div>


		<!-- modal hide user
<div id="form-user" class="modal fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">User Hide</h4>
			</div>
	<div class="modal-body">
		<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="">
				<thead>
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Nama User<center></th>
					<th width="16%"><center>Nama Lengkap</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Status Role</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Divisi</center></th>
					<th width="20%"><center>Aksi</center></th>
				</tr>
				<?php
				$no = 1;
				foreach ($userhide as $row) {
				?>
				<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['display_name'];?></td>
				<td><?php echo $row['role_id'];?></td>
				<td><?php echo $row['role_status'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['division_id'];?></td>
				</tr>
				<?php
				$no++;
				}
				?>
				</thead>
				<tbody>
				</tbody>
				</table>
			</div>
	</div>
	
</div>

	</div>
</div>-->
<div id="form-user" class="modal fade" tabindex="-1" data-width="860" data-backdrop="static" data-keyboard="false">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">User Hide</h4>
			</div>
	<div class="modal-body">
		<div class="table-container">
				<div class="table-actions-wrapper">
				</div>
				<table class="table table-striped table-bordered " id="datatable_hide">
				<thead>
				<tr role="row" class="heading">
					<th width="3%"><center>No</center></th>
					<th width="13%"><center>Nama User<center></th>
					<th width="16%"><center>Nama Lengkap</center></th>
					<th width="12%"><center>Role</center></th>
					<th width="16%"><center>Status Role</center></th>
					<th width="12%"><center>Email</center></th>
					<th width="18%"><center>Divisi</center></th>
					<th width="20%"><center>Aksi</center></th>
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