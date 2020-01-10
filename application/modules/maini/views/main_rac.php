 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <style type="text/css">
 /* Tooltip */
  .pop + .tooltip > .tooltip-inner {
      background-color: #73AD21; 
      color: #FFFFFF;  
      padding: 7px;
      font-size: 14px;
  }
  /* Tooltip on bottom */
  .pop + .tooltip.bottom > .tooltip-arrow {
      border-bottom: 5px solid blue;
  }
 </style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Dashboard <small>reports &amp; statistics</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/maini/mainrac">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">Daftar Risiko</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a id = "risk_list_export">Export</a>
						</li>					 
					</ul>
				</div>
			</div>
			
			
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN CONTENT-->
		<div class="panel panel-success">
			<div class="panel-body">
				<div class="col-md-2" style="text-align: center;">
					<span style="font-size: 11px;">Risk To Verify</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_risk"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">Risk Register To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_user"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span style="font-size: 11px;">Treatment To Verify</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_treatment"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">Action Plan To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_ap"></object>
				</div>
				<div class="col-md-2" style="width: 15%; text-align: center;">
					<span style="font-size: 11px;">Action Plan Execution To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_apex"></object>
				</div>
				<div class="col-md-2" style="width: 12%; text-align: center;">
					<span style="font-size: 11px;">KRI To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_kri"></object>
				</div>
				<div class="col-md-2" style="width: 13%; text-align: center;">
					<span style="font-size: 11px;">Change Request To Verify</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainrac/chart_submitted_changerequest"></object>
				</div>
			</div>
		</div>
		<input type = "hidden" id = "tabactive" name ="tabactive" value = "0">
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document" >
			<div class="modal-content" >
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risklist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
						<th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Risk Level <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
						<th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk Register List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_riskregisterlist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>User <input type = "checkbox" checked="true"  name = "display_name"  > </th>
						<th>Divisi<input type = "checkbox" checked="true"  name = "division_name"  > </th>
						<th>Submission Date<input type = "checkbox" checked="true"  name = "tanggal_submit"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "risk_register_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "risk_register_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Treatment List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risktreatment">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th> 
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
						<th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v"  > </th>  
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "treatment_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "treatment_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-actionplanlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_actionplan">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "actionplan_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "actionplan_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-executionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Action Plan Execution List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_execution">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "action_plan_status" ></th>
						<th>AP ID <input type = "checkbox" checked="true"  name = "act_code"  > </th>
						<th>Action Plan<input type = "checkbox" checked="true"  name = "action_plan"  > </th> 
						<th>Due Date<input type = "checkbox" checked="true"  name = "due_date_v"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "execution_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "execution_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-kri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">KRI List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_kri">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "kri_status" ></th>
						<th>KRI ID <input type = "checkbox" checked="true"  name = "kri_code"  > </th>
						<th>KRI<input type = "checkbox" checked="true"  name = "key_risk_indicator"  > </th> 
						<th>KRI Owner<input type = "checkbox" checked="true"  name = "treshold"  > </th> 
						<th>Timing Pelaporan<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
						<th>KRI Warning<input type = "checkbox" checked="true"  name = "kri_warning"  > </th> 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "kri_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "kri_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		
 	<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-changereq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Change Request List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_changereq">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "GenRowNum" ></th>
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th> 
						<th>Requestor<input type = "checkbox" checked="true"  name = "created_by_v"  > </th> 
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status"  > </th>  						 
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "changereq_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "changereq_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		

		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a href="#tab_risk_list" class="pop" data-toggle="tab">
					Daftar Risiko
					<font style="color:red;">
					<?php 
					if($cekrisklist > 0){
					echo "($cekrisklist)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_risk_register_list" data-toggle="tab">
					Risiko Terdaftar 
					<font style="color:red;">
					<?php 
					if($cekregisterlist > 0){
					echo "($cekregisterlist)";
					}
					?>
					</font>
					</a>
					</li>
				<li>
					<a href="#tab_treatment_list" data-toggle="tab">
					Daftar Penanganan 
					<font style="color:red;">
					<?php 
					if($treatmentlist > 0){
					echo "($treatmentlist)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_action_plan_list" data-toggle="tab">
					Daftar Action Plan 
					<font style="color:red;">
					<?php 
					if($cekplan > 0){
					echo "($cekplan)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_action_plan_exec" data-toggle="tab">
					Pelaksanaan Action Plan
					<font style="color:red;">
					<?php 
					if($cekplanExec > 0){
					echo "($cekplanExec)";
					}
					?>
					</font>
					 </a>
				</li>
				<li>
					<a href="#tab_kri_list" data-toggle="tab">
					Daftar KRI 
					<font style="color:red;">
					<?php 
					if($cekkrirac > 0){
					echo "($cekkrirac)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_change_request_list" data-toggle="tab">
					Daftar Permintaan Perubahan 
					<font style="color:red;">
					<?php 
					if($cekChangeRequest > 0){
					echo "($cekChangeRequest)";
					}
					?>
					</font>
					</a>
				</li>
				<li>
					<a href="#tab_risk_old" data-toggle="tab">
					Risiko Periode Lalu
					
					</a>
				</li>
			</ul>
<script>
$(document).ready(function(){
    $('[data-toggle="tab"]').tooltip();   
});
</script>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_risk_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_level">Level Risiko</option>
								<option value="risk_impact_level">Level Dampak</option>
								<option value="risk_likelihood_key">Kemungkinan Keterjadian</option>
								<option value="risk_owner">Pemilik Risiko</option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level">
							<select class="form-control input-medium input-sm" id="r_level">
								<option value="-">Semua</option>
								<option value="LOW">Rendah</option>
								<option value="MODERATE">Sedang</option>
								<option value="HIGH">Tinggi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood">
							<select class="form-control input-medium input-sm" id="l_hood">
								<option value="-">Semua</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l">
							<select class="form-control input-medium input-sm" id="impact_l">
								<option value="-">Semua</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi">
							<select class="form-control input-sm" id="l_divisi">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Cari</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover" id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peristiwa Risiko</center></th>
							<th><center>Level Risiko</center></th>
							<th><center>Level Dampak</center></th>
							<th><center>Kemungkinan Keterjadian</center></th>
							<th><center>Pemilik Risiko</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Menunggu verifikasi RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Diverifikasi oleh RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 Dalam proses penanganan risiko
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 Dalam proses Action Plan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 Dalam proses Pelaksanaan Action Plan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan telah dilaksanakan dan diverifikasi
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_risk_register_list">	
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_register_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_register_list-filterBy">
								<option value="display_name">Nama Pengguna</option>
								<option value="division_name">Divisi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-register">
							<select class="form-control input-sm" id="l_divisi-register">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_value']; ?>" data-division = "<?php echo $key['ref_value'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_register_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_risk_register_list-filterButton">Cari</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_register">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Pengguna</center></th>
							<th><center>Divisi</center></th>
							<th><center>Tanggal Pengajuan</center></th>
							<th width="30%"><center>Catatan</center></th>
							<th></th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 Menunggu verifikasi Kepala Divisi
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Menunggu verifikasi RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Diverivikasi Oleh RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_treatment_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasrkan : </label>
							<select class="form-control input-medium input-sm" id="tab_treatment_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_owner">Pemilik Risiko</option>
								<option value="suggested_risk_treatment">Penanganan Risiko</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-treatment">
							<select class="form-control input-sm" id="l_divisi-treatment">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Cari</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_treatment">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peristiwa Risiko</center></th>
							<th><center>Pemilik Risiko</center></th>
							<th><center>Penanganan Risiko</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
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
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenace
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan_list">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_list-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Batas Waktu</option>
								<option value="division">Pemilik Action Plan</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-action">
							<select class="form-control input-sm" id="l_divisi-action">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_list-filterButton">Cari</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Batas Waktu</center></th>
							<th><center>Pemilik Action Plan</center></th>
							<th><center>ID Risiko</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
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
				<div class="tab-pane" id="tab_kri_list">
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
							<th><center>KRI Warning</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Simpan Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
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
				<div class="tab-pane" id="tab_change_request_list">	
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_cr">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>No</center></th>
							<th><center>ID</center></th>
							<th><center>Dalam Perubahan</center></th>
							<th><center>Pemohon</center></th>
							<th><center>Status Permintaan Perubahan</center></th>
							<th><center>Tanggal</center></th>
							<th><center>Tindakan</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan_exec">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Batas Waktu</option>
								<option value="division">Pemilik Action Plan</option>
								<option value="execution_status">Eksekusi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-execution">
							<select class="form-control input-sm" id="l_divisi-execution">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_status-execution">
							<select class="form-control input-sm" id="status-execution">
								<option value="-">Semua</option>
								<option value="ONGOING">Sedang Berjalan</option>
								<option value="EXTEND">Diperpanjang</option>
								<option value="COMPLETE">Selesai</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_action_plan_exec-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_action_plan_exec-filterButton">Cari</button>
					</form>
						
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_action_plan_exec">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>AP</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Batas Waktu</center></th>
							<th><center>Pemilik Action Plan</center></th>
							<th><center>Eksekusi</center></th>
							<th><center>ID Risiko</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 Menunggu verifikasi Kepala Divisi
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Menunggu verifikasi RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Diverivikasi oleh RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_risk_old">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_old_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_old_risk_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_level">Level Risiko</option>
								<option value="risk_impact_level">Level Dampak</option>
								<option value="risk_likelihood_key">Kemungkinan Keterjadian</option>
								<option value="risk_owner">Pemilik Risiko</option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level-prior">
							<select class="form-control input-medium input-sm" id="r_level-prior">
								<option value="-">Semua</option>
								<option value="LOW">Rendah</option>
								<option value="MODERATE">Sedang</option>
								<option value="HIGH">Tinggi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood-prior">
							<select class="form-control input-medium input-sm" id="l_hood-prior">
								<option value="-">Semua</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l-prior">
							<select class="form-control input-medium input-sm" id="impact_l-prior">
								<option value="-">Semua</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-prior">
							<select class="form-control input-sm" id="l_divisi-prior">
								<option value="-">Semua</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_old_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_old_risk_list-filterButton">Cari</button>
					</form>
					
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_old_risk">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peristiwa Risiko</center></th>
							<th><center>Level Risiko</center></th>
							<th><center>Level Dampak</center></th>
							<th><center>Kemungkinan Keterjadian</center></th>
							<th><center>Pemilik Risiko</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Menunggu verifikasi RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Diverifikasi oleh RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 Dalam proses penanganan risiko
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 Dalam Proses Action Plan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 Dalam proses pelaksanaan Action Plan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan telah dilaksanakan dan diverifikasi 
							</li>
						</ul>
		
					</div>
					</div>
				</div>
<!-- ******************************************************************************************* FAIL
				<div class="tab-pane" id="tab_kri_list_mitigation">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list_mitigation" data-toggle="tab"><button class="btn btn-success">Mitigasi</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-default">Non Mitigasi</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_mtg">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_mtg-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_mtg-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri_mtg-filterButton">Search</button>
					</form>
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri_mitigation">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>KRI ID</center></th>
							<th><center>KRI</center></th>
							<th><center>KRI Owner</center></th>
							<th><center>Time Reporting</center></th>
							<th><center>Risk ID</center></th>
							<th><center>KRI Warning</center></th>
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
								 Save Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To Be Verified by Head Division
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 Submitted to RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
		
					</div>
					</div>
				</div>
****************************************************************************************************************-->
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
							<th><center>KRI Warning</center></th>
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
								<img src="<?=$base_url?>assets/images/legend/save_draft_kri.png"/> &nbsp; 
								 Simpan Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
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
		<!-- END CONTENT-->
	</div>
</div>

<!-- PIC -->
<div id="modal-pic" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Ubah Catatan</h4>
	</div>
	<div class="modal-body">
		<form id="noteform" role="form" class="form-horizontal" action ="<?=base_url('index.php/maini/mainrac/submit_note');?>" method="POST">			 
			<textarea name = "note" id = "modal_pic_note" class="form-control"></textarea>
			<input type = "hidden" id = "modal_pic_risk_input_by" name = "risk_input_by">
			<button type="button" class="btn blue btn-sm" onclick = "submit_note()">Simpan</button>			 
		</form> 
	</div>
</div>

<!-- Execution Form -->
<div id="modal-exec" class="modal fade" tabindex="-1" data-width="760" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Pelaksanaan Action Plan</h4>
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
						<input type="text" class="form-control input-sm" name="revised_date" readonly value="<?=date('d-m-Y')?>">
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