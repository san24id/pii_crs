 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <style type="text/css">
li.tip span {
    display: none
}
li.tip:hover span {
	color: #FFF;
    border: #c0c0c0 1px dotted;
    padding: 5px 5px 0px 5px;
    display: block;
    z-index: 100;
    background: #a5cb39;
    top: 50px;
    position: absolute;
    text-decoration: none;
    border-radius:10px;
    box-shadow: 0px 0px 14px #222;
    /*opacity:0.8;
    filter:alpha(opacity=80);*/
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
					<a target="_self" href="<?=$site_url?>/maini">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">My Risk Register</a>
				</li>
			</ul>
<!-- 			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="javascript:;">Export to XLS</a>
						</li>
					</ul>
				</div>
			</div> -->
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
					<span>My Risk Register</span>
					  <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_risk"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>Risk Owned By Me</span>
					 <object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_risk_owned"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My Action Plan</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_ap"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My Action Plan Execution</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_apex"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>My KRI</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_kri"></object>
				</div>
				<div class="col-md-2" style="text-align: center;">
					<span>Permintaan Perubahan</span>
					<object width="138%" height="180px" style="margin-left: -20%; margin-top: -10%; margin-bottom: -10%; margin-right: -10%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/chart_submitted_changerequest"></object>
				</div>
				<!-- <div class="col-md-2">
					<span>Prior Period</span>
					<object width="100%" height="100%" scrolling="no" frameborder="no" data="<?=$site_url?>/main/mainpic/ChartRiskPriorToVerifyPIC"></object>
				</div> -->
			</div>
		</div>

	<input type = "hidden" id = "tabactive" name ="tabactive" value = "0">	
		<input type="hidden" id="tabuser" name="tabuser" value="<?php echo $this->session->credential['username']; ?>">
		<input type="hidden" id="tabdiv" name="tabdiv" value="<?php echo $this->session->credential['division_id']; ?>">
		<input type="hidden" id="tabrol" name="tabrol" value="<?php echo $this->session->credential['main_role_id']; ?>">
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
						<th>Risk Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
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
		<div class="modal fade" data-width="650" id="modal-export-treatment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Risk Owned List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risktreatment">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status" ></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Event<input type = "checkbox" checked="true"  name = "risk_event"  > </th>
						<th>Risk Level<input type = "checkbox" checked="true"  name = "risk_level"  > </th>  
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner_v"  > </th> 
						<th>Risk Treatment<input type = "checkbox" checked="true"  name = "suggested_risk_treatment_v" ></th>
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to" ></th>  
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
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>  
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner"  > </th>  
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
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th> 
						<th>Action Plan Owner<input type = "checkbox" checked="true"  name = "division_name"  > </th>
						<th>Execution<input type = "checkbox" checked="true"  name = "execution_status"  > </th>
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th>
						<th>Risk Owner<input type = "checkbox" checked="true"  name = "risk_owner"  > </th>       
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
						<th>Timing Reporting<input type = "checkbox" checked="true"  name = "timing_pelaporan_v"  > </th>
						<th>Assigned To<input type = "checkbox" checked="true"  name = "assigned_to"  > </th>   
						<th>Risk ID<input type = "checkbox" checked="true"  name = "risk_code"  > </th> 
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
						<th>ID CH<input type = "checkbox" checked="true"  name = "cr_code"  > </th>
						<th>Change In<input type = "checkbox" checked="true"  name = "cr_type"  > </th>
						<th>Status Change Request<input type = "checkbox" checked="true"  name = "cr_status" ></th>
						<th>Date<input type = "checkbox" checked="true"  name = "date" ></th>  						 
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

		<!-- Modal -->
		<div class="modal fade" data-width="650" id="modal-risk_prior" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="#modal-dialog" role="document" >
			<div class="modal-content" >
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Prior Period Risk List Export - choose field to export</h4>
			  </div>
			  <div class="modal-body">
				<form id = "get_check_risk_priorlist">
					<tr role="row" class="heading">
						<th width="30px">Status <input type = "checkbox" checked="true"  name = "risk_status"></th>
						<th>Risk ID <input type = "checkbox" checked="true"  name = "risk_code" > </th>
						<th>Risk Event <input type = "checkbox" checked="true"  name = "risk_event" > </th>
						<th>Risk Level <input type = "checkbox" checked="true"  name = "risk_level_v" ></th>
						<th>Impact Level <input type = "checkbox" checked="true"  name = "impact_level_v" > </th>
						<th>Likelihood <input type = "checkbox" checked="true"  name = "likelihood_v" > </th>
						<th>Risk Owner <input type = "checkbox" checked="true"  name = "risk_owner_v" > </th>  
					</tr>
				</form>							 
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class = "btn btn-success" id = "riskprior_list_excel">Export to Excel</button>
				<button class = "btn btn-success" id = "riskprior_list_pdf" >Export to PDF</button>
			  </div>
			</div>
		  </div>
		</div>
		<div class="tabbable-custom ">
			<ul class="nav nav-tabs ">
				<li class="active tip">
					<a href="#tab_my_risk_register" data-toggle="tab">
					My Risk Register </a>
					<span style="left:10px; width: 300px;"><p align="justify">Menampilkan daftar risiko yang teridentifikasi oleh Anda dan memberikan rincian informasi terkait risiko tersebut</p></span>
				</li>
				<li class="tip">
					<a href="#tab_owned" data-toggle="tab">
					Risk Owned By Me 
					<font style="color:red;">
					<?php 
					if( $cekowned > 0){
					echo "($cekowned)";
					}
					?>
					</font>
					</a>
					<span style="left:-90px; width: 400px;"><p align="justify">Menampilkan daftar risiko yang perlu dikonfirmasi oleh Anda sebagai pemilik Risiko dan untuk meninjau usulan rencana tindak lanjut <i>(Action Plan)</i>. Anda bertanggung jawab untuk mengelola risiko tersebut</p></span>
				</li>
				<li class="tip">
					<a href="#tab_action_plan" data-toggle="tab">
					My Action Plan 
					<font style="color:red;">
					<?php 
					if($cekplan > 0){
					echo "($cekplan)";
					}
					?>
					</font>
					</a>
					<span style="left:-90px; width: 400px;"><p align="justify">Menampilkan daftar rencana tindak lanjut <i>(action plan)</i> yang perlu dikonfirmasi oleh Anda selaku <i>Action Plan Owner</i>. Anda bertanggung jawab untuk melaksanakan rencana tindak lanjut tersebut dalam batas waktu yang telah disepakati</p></span>
				</li>
				<li class="tip">
					<a href="#tab_action_exec" data-toggle="tab">
					My Action Plan Execution 
					<font style="color:red;">
					<?php 
					if($cekplanexec > 0){
					echo "($cekplanexec)";
					}
					?>
					</font>
					</a>
					<span style="left:-50px; width: 350px;"><p align="justify">Menampilkan status pelaksanaan Action Plan yang disetujui</p></span>
				</li>
				<li class="tip">
					<a href="#tab_kri" data-toggle="tab">
					My KRI 
					<font style="color:red;">
					<?php 
					if($cekkri > 0){
					echo "($cekkri)";
					}
					?>
					</font>
					</a>
					<span style="left:-160px; width: 400px;"><p align="justify">Menampilkan Key Risk Indicator yang menjadi tanggung jawab dari <i>Risk Owner</i> untuk dilaporkan statusnya</p></span>
				</li>
				<li class="tip">
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
					<span style="left:-100px; width: 400px;"><p align="justify">Menampilkan informasi mengenai status <i>Change Request</i>, apakah disetujui atau tidak (baik untuk risiko, <i>Action Plan</i>, dll) yang diajukan oleh User kepada RAC</p></span>
				</li>
				<li class="tip">
					<a href="#tab_old_my_risk_register" data-toggle="tab">
					Risiko Saya Periode Lalu</a>
					<span style="left:-100px; width: 400px;"><p align="justify">Menampilkan daftar risiko yang diidentifikasi oleh <i>User </i>pada periode lalu dan memberikan informasi terkait risiko tersebut <i>(i.e. risk event, risk level, likelihood)</i></p></span>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_my_risk_register">
					<div class="row">
						<div class="col-md-4">
						<form role="form form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<select class="form-control input-sm" name="risk_category" id="sel_risk_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_sub_category" id="sel_risk_sub_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_2nd_sub_category" id="sel_risk_2nd_sub_category"></select>
								</div>
								<div class="form-group">
									<button type="button" id="button-filter-category" class="btn blue btn-sm">Filter Risiko</button>
									<button type="button" id="button-filter-clear" class="btn blue btn-sm">Hapus Filter</button>
								</div>
							</div>
						</form>
						</div>
						<?php
							if($adhoc_button !=''){
								?>
						<div class="col-md-8 clearfix" style="margin-top: 130px;">
							<a href="javascript: location.href='<?=$site_url?>/risk/RiskRegister/RiskRegisterInput/adhoc';" 
							class="btn default green pull-right" <?=$adhoc_button ? '' : 'disabled'?>>
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
							Tambah Risiko Baru</span>
							</a>
						</div>
						<?php
					}
					?>
					</div>
					<hr/>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_risk_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_level">Level Risiko</option>
								<option value="risk_impact_level">Level Dampak</option>
								<option value="risk_likelihood_key">Kemungkinan Keterjadian</option>
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
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_risk_list-filterValue">
						</div>
						<button type="submit" class="btn blue btn-sm" id="tab_risk_list-filterButton">Cari</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_ajax">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peristiwa Risiko</center></th>
							<th><center>Level Risiko</center></th>
							<th><center>Level Dampak</center></th>
							<th><center>Kemungkinan Keterjadian</center></th>
							<th><center>Pemilik Risiko</center></th>
							<th width="50px"><center>Daftar Permintaan Perubahan</center></th>
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
								 Action Plan telahh dilaksanakan dan diverifikasi
							</li>
						</ul>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Permintaan Perubahan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
		
					</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_owned">
				<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_treatment_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_level">Level Risiko</option>
								<option value="suggested_risk_treatment">Penanganan Risiko</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Cari</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_grid_owned">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Peristiwa Risiko</center></th>
							<th><center>Level Risiko</center></th>
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>Penanganan Risiko</center></th>
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
								 *Informasi pada Dashboard ini akan diperbarui setelah RAC memverifikasi Risk Owned By Me 
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Permintaan perubahan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_plan">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_list-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Batas Waktu</option>
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
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>Pemilik Action Plan</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Pemilik Risiko</center></th>
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Permintaan Perubahan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
					</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_action_exec">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_action_plan_exec">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_action_plan_exec-filterBy">
								<option value="action_plan">Action Plan</option>
								<option value="due_date">Batas Waktu</option>
								<option value="execution_status">Pelaksanaan</option>
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
							<th><center>AP.ID</center></th>
							<th><center>Action Plan</center></th>
							<th><center>Batas Waktu</center></th>
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>Pemilik Action Plan</center></th>
							<th><center>Pelaksanaan</center></th>
							<th><center>ID Risiko</center></th>
							<th><center>Pemilik Risiko</center></th>
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Permintaan perubahan 
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab_kri">
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="timing_pelaporan">Waktu Pelaporan</option>
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
							<th><center>Waktu Pelaporan</center></th>
							<th><center>Ditugaskan Kepada</center></th>
							<th><center>ID Risiko</center></th>
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
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/change_request.png"/> &nbsp; 
								 Permintaan perubahan
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/default.png"/> &nbsp; 
								 Under Maintenance
							</li>
						</ul>
					</div>
					</div>
				</div>
				
				<div class="tab-pane" id="tab_change_request_list">
					<div>
						<table class="table table-condensed table-bordered table-hover" id="datatable_ajax_change">
						<thead>
						<tr role="row" class="heading">
							<th><center>No</center></th>
							<th><center>ID Perubahan</center></th>
							<th><center>Perubahan Dalam</center></th>
							<th><center>Status Permintaan Perubahan</center></th>
							<th><center>Tanggal</center></th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_old_my_risk_register">
					<div class="row">
						<div class="col-md-4">
						<form role="form form-horizontal">
							<div class="form-body">
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_category" id="sel_old_risk_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_sub_category" id="sel_old_risk_sub_category"></select>
								</div>
								<div class="form-group">
									<select class="form-control input-sm" name="risk_old_2nd_sub_category" id="sel_old_risk_2nd_sub_category"></select>
								</div>
								<div class="form-group">
									<button type="button" id="button-old-filter-category" class="btn blue btn-sm">Filter Risiko</button>
									<button type="button" id="button-old-filter-clear" class="btn blue btn-sm">Hapus Filter</button>
								</div>
							</div>
						</form>
						</div>
					</div>
					<hr/>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_old_risk_list" >
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter Berdasarkan : </label>
							<select class="form-control input-medium input-sm" id="tab_old_risk_list-filterBy">
								<option value="risk_event">Peristiwa Risiko</option>
								<option value="risk_level">Level Risiko</option>
								<option value="risk_impact_level">Level Dampak</option>
								<option value="risk_likelihood_key">Kemungkinan Keterjadian</option>
							</select>
						</div>
						<div class="form-group" id="choose_r_level-old">
							<select class="form-control input-medium input-sm" id="r_level-old">
								<option value="-">Semua</option>
								<option value="LOW">Rendah</option>
								<option value="MODERATE">Sedang</option>
								<option value="HIGH">Tinggi</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_hood-old">
							<select class="form-control input-medium input-sm" id="l_hood-old">
								<option value="-">Semua</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group" id="choose_impact_l-old">
							<select class="form-control input-medium input-sm" id="impact_l-old">
								<option value="-">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
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
								 Dalam proses penanganan Risiko 
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
								 Action Plan telahh dilaksanakan dan diverifikasi
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
		<h4 class="modal-title">Pilih Wakil</h4>
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

<script type="text/javascript">
						var g_submit_mode = '<?php echo "$adhoc_button";?>';
						</script>