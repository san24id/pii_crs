<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk Register Exercise 
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main/mainrac">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="<?=$site_url?>/main/mainrac/riskRegister/<?=$filled_by_id?>">Risk Register Exercise</a>
				</li>
			</ul>
		</div>
		
		<?php if ($valid_mode) { ?>
		<script type="text/javascript">
			var g_p_name = '<?=$periode['periode_name']?>';
			var g_status_user_id = '<?=$filled_by_id?>';
		</script>
		<div class="row">
		<div class="col-md-12">
			
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
					Risk List (	<?=$filled_by_id?> )
				</div>
				<div style="float:right;font-size:18px;padding:4px;">

					 <div class="actions">
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister/RiskRegisterInputRac/periodic/<?=$filled_by_id?>" class="btn default green">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">
					Add New Risk </span>
					</a>
				</div>
				</div>
			</div>
			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy">Filter By</label>
						<select class="form-control input-medium input-sm" id="filterFormBy">
							<option value="-">Choose</option>
							<option value="risk_event">Risk</option>
							<option value="risk_level">Risk Level</option>
							<option value="risk_impact_level">Impact Level</option>
							<option value="risk_likelihood_key">Likelihood</option>
							<option value="risk_owner">Risk Owner</option>
							<option value="risk_status">Status</option>
						</select>
					</div>
					<div class="form-group" id="re">
						<input type="text" class="hash form-control input-sm" id="fe" placeholder="Insert Filter Value">
					</div>

					<div class="form-group" id="rl">
						<select class="hesh form-control input-sm" id="fl">
							<option value="ALL">ALL</option>	
							<option value="low">Rendah</option>	
							<option value="moderate">Sedang</option>
							<option value="high">Tinggi</option>
						</select>
						
					</div>

					<div class="form-group" id="il">
						<select class="hish form-control input-sm" id="fi">
							<option value="insignificant">Tidak significant</option>	
							<option value="minor">Minor</option>
							<option value="major">Major</option>
							<option value="moderate">Moderate</option>
							<option value="catasthropic">Catasthropic</option>
						</select>
						
					</div>

					<div class="form-group" id="li">
						<select class="hosh form-control input-sm" id="fk">
							<option value="very low">Sangat Rendah</option>	
							<option value="low">Rendah</option>
							<option value="medium">Sedang</option>
							<option value="high">Tinggi</option>
							<option value="very high">Sangat Tinggi</option>
						</select>
						
					</div>



					<button type="submit" id="filterFormSubmit" class="btn blue btn-sm">Search</button>
				</form>
				
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">ID Resiko</th>
						<th width="40%">Resiko</th>
						<th width="10%">Risk Level</th>
						<th width="10%">Impact Level</th>
						<th width="10%">Likelihood</th>
						<th width="10%">Risk Owner</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
					Risk List Verified 
				</div>

			</div>

			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm2" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy2">Filter By</label>
						<select class="form-control input-medium input-sm" id="filterFormBy2">
							<option value="-">Choose</option>
							<option value="risk_event">Risk</option>
							<option value="risk_level">Risk Level</option>
							<option value="risk_impact_level">Impact Level</option>
							<option value="risk_likelihood_key">Likelihood</option>
							<option value="risk_owner">Risk Owner</option>
						</select>
					</div>

					<div class="form-group" id="tr">
						<input type="text" class="pash form-control input-sm" id="pe" placeholder="Insert Filter Value">
					</div>

					<div class="form-group" id="tl">
						<select class="pesh form-control input-sm" id="pl">
							<option value="ALL">ALL</option>
							<option value="low">Rendah</option>	
							<option value="moderate">Sedang</option>
							<option value="high">Tinggi</option>
						</select>
						
					</div>

					<div class="form-group" id="ti">
						<select class="pish form-control input-sm" id="pi">
							<option value="insignificant">Tidak significant</option>	
							<option value="minor">Minor</option>
							<option value="major">Major</option>
							<option value="moderate">Moderate</option>
							<option value="catasthropic">Catasthropic</option>
						</select>
						
					</div>

					<div class="form-group" id="tk">
						<select class="posh form-control input-sm" id="pk">
							<option value="very low">Sangat Rendah</option>	
							<option value="low">Rendah</option>
							<option value="medium">Sedang</option>
							<option value="high">Tinggi</option>
							<option value="very high">Sangat Tinggi</option>
						</select>
						
					</div>						
					<button type="submit" id="filterFormSubmit2" class="btn blue btn-sm">Search</button>
				</form>	
				
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax2">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">ID Resiko</th>
						<th width="40%">Resiko</th>
						<th width="10%">Risk Level</th>
						<th width="10%">Impact Level</th>
						<th width="10%">Likelihood</th>
						<th width="10%">Risk Owner</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>

				<div class="row">
				<div class="col-md-12 clearfix">

		<?php
			error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
			$status = $_GET['status'];
			$this->load->database();
			$sql = "select cr_status from t_cr_risk where created_by = '$filled_by_id' order by id desc limit 1 ";
			$query = $this->db->query($sql);
			$hasil = $query->row();
			$user = $hasil->cr_status;
			if ($status=='change'){
				
		if ($user != 1){
		?>

		<a href="javascript: ;" id="button-change-ignore" class="btn default red pull-right" style="margin-right: 10px;">
					<i class="fa  fa-circle-o"></i>
					<span class="hidden-480">
					Ignore </span>
					</a>

		<a href="javascript: ;" id="button-change-verify" class="btn default green pull-right" style="margin-right: 10px;">
					<i class="fa  fa-circle-o"></i>
					<span class="hidden-480">
					Verify </span>
					</a>
		<?php }
				}
			?>
				</div>
				</div>

			</div>
		</div>
		</div>
		</div>
		
		<div class="row">
		<div class="col-md-6" style="padding-left: 40px;">
			<h4>Legend</h4>
						<ul class="list-group">
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/draft.png"/> &nbsp; 
								 Draft
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/submit.png"/> &nbsp; 
								 submitted to rac
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/verified.png"/> &nbsp; 
								 Verified By RAC
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/treatment.png"/> &nbsp; 
								 on Risk Treatment Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/actplan.png"/> &nbsp; 
								 on Action Plan Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed_2.png"/> &nbsp; 
								 On Action Plan Execution Process
							</li>
							<li class="list-group-item">
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								 Action Plan Has Been Executed and Verified
							</li>
						</ul>
		</div>
		
		</div>
		<div class="clearfix">
		</div>
		
	</div>				
	</div>
	<?php } else { ?>
	<!-- ERROR RISK REGISTER MODE -->
	<div class="row">
	<div class="col-md-12">
		<div class="note note-danger">
			<?php if (isset($submit_mode) && $submit_mode == 'adhoc') { ?>
			<h4 class="block">Error</h4>
			<p>
				 Cannot Input Adhoc Risk Register Exercise because Risk Period is already set, please contact RAC team for further information
				 <p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Back to Home </a>
				</p>
			</p>
			<?php } else { ?>
			<h4 class="block">Error</h4>
			<p>
				 Cannot Input Risk Register Exercise because Risk Period is not set, please contact RAC team for further information
			</p>
			<p>
				<a class="btn red" target="_self" href="<?=$site_url?>/main">
				Back to Home </a>
			</p>
			<?php } ?>
		</div>
	</div>
	</div>
	<?php } ?>
</div>