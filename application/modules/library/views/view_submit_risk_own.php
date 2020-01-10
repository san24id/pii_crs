<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		View Submission Risk Owned by Me From : <?php 

			echo $filled_by.'&nbsp;('.$filled_by_id.')';
		?>
		<script type="text/javascript">
			var g_status_user_id = '<?=$filled_by_id?>';
			var g_division_id = '<?=$filled_division?>';
		</script>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
								<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;">User Monitoring</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="<?=$site_url?>/library/submission_risk_owner">Head Confirmation For Risk Owner</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li class="bread_tab">
					<a id="bread_tab_title" target="_self" href="javascript:;"><?=$filled_by_id?></a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a  target="_blank" href="<?php echo base_url("index.php/library/viewConfirmRiskOwnHead_excel/$filled_by_id");?>">Excel</a>
						</li>
					 
					</ul>
				</div>
			</div>
		</div>

		<!-- END PAGE HEADER-->
		<div class="row">
		<script type="text/javascript">
			/*var g_periode_id = '<?=$periode['periode_id']?>';*/
		</script>
		<div class="col-md-12">
			<form class="form-inline" role="form" style="margin-bottom: 10px;" id="form_tab_treatment_list">
						<div class="form-group">
							<label for="filterFormBy" class="smaller">Filter By : </label>
							<select class="form-control input-medium input-sm" id="tab_treatment_list-filterBy">
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_owner">Risk Owner</option>
								<option value="suggested_risk_treatment">Risk Treatment</option>
							</select>
						</div>
						<div class="form-group" id="choose_l_divisi-treatment">
							<select class="form-control input-sm" id="l_divisi-treatment">
								<option value="-">All</option>
								<?php foreach ($division_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control input-sm" placeholder="Search" id="tab_treatment_list-filterValue">
						</div>
						<button type="button" class="btn blue btn-sm" id="tab_treatment_list-filterButton">Search</button>
					</form>
					<div ><!--class="table-scrollable"-->
						<table class="table table-condensed table-bordered table-hover " id="datatable_risk_owned">
						<thead>
						<tr role="row" class="heading">
							<th width="30px"><center>Status</center></th>
							<th><center>Risk ID</center></th>
							<th><center>Risk Event</center></th>
							<th><center>Risk Level</center></th>
							<th><center>Risk Owner</center></th>
							<th><center>Risk Treatment</center></th>
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
</div>