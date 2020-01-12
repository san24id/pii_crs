 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<h3 class="page-title">
		Key Risk Indicator Periode : <?php 
			$this->load->database();
			$sql = "SELECT * FROM  m_periode WHERE periode_id IN ((SELECT MAX(periode_id) FROM m_periode)-1)";
			$query = $this->db->query($sql)->row();
			echo $query->periode_name;
		?>
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
					<a target="_self" href="javascript:;">KRI Designation</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Regular KRI</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/kri_pdfregular");?>">PDF</a>
						</li>
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/kri_excelregular");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
		</div>
		
			<div class="tab-content">
				<div class="tab-pane active" id="tab_kri_list">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-success">Mandatory</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-default">Non Mandatory</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
								<option value="risk_code">Risk ID</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri">
							<select class="form-control input-sm" id="l_divisi-kri">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri">
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
								 Save Draft (KRI still not active)
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft (KRI has active and will be submit by Division Head)
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified_head.png"/> &nbsp; 
								 To be verified by Division Head
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
				

				<div class="tab-pane" id="tab_kri_list_non_mitigation">
					<div style="margin-bottom: 10px;">
						<a href="#tab_kri_list" data-toggle="tab"><button class="btn btn-default">Mandatory</button></a>
						<a href="#tab_kri_list_non_mitigation" data-toggle="tab"><button class="btn btn-success">Non Mandatory</button></a>
					</div>
					<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_kri_nonmtg">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_kri_nonmtg-filterBy">
								<option value="key_risk_indicator">KRI</option>
								<option value="kri_owner">KRI Owner</option>
								<option value="timing_pelaporan">Time Reporting</option>
								<option value="risk_code">risk_code</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-kri_nonmtg">
							<select class="form-control input-sm" id="l_divisi-kri_nonmtg">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_kri_nonmtg-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_kri_nonmtg-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_kri_non_mitigation">
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
								 Save Draft (KRI still not active)
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft  (KRI has active and need to be verified by RAC) 
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified by RAC
							</li>
						</ul>
					</div>
					</div>
				</div>

			</div>
		<!-- END CONTENT-->
	</div>
</div>