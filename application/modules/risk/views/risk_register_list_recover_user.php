<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Recover Risk
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Setting</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Recover Risk</a>
					
				</li>
				
			</ul>
		</div>
		<?php 
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$username = $this->session->credential['username'];
	$this->load->database();
	$sql="select a.risk_id from t_risk a where  a.periode_id IN(select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and a.risk_input_by = '$username'
					and a.risk_status = 1";
	$query = $this->db->query($sql);
		?>

		<div class="col-md-12">
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
					Recover Roll Forward Risk 
				</div>
			</div>
			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy">Filter By</label>
						<select class="form-control input-medium input-sm" id="filterFormBy">
								<option value="-">Choose/ Show All</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
						</select>
					</div>
					<div class="form-group" id="re">
						<input type="text" class="hash form-control input-sm" id="fe" placeholder="Search">
					</div>

					<div class="form-group" id="s_r1_level" style="display: none;">
							<select class="rash form-control input-medium input-sm" id="s_level_r1">
								<option value="">All</option>
								<option value="draft">Draft</option>
								<option value="submitted">Submitted to RAC</option>
								<option value="treatment">On risk treatment proses</option>
								<option value="ap">on Action Plan Process</option>
								<option value="apex">On action plan execution process</option>
								<option value="apex">Action Plan Has Been Executed and Verified</option>
							</select>
					</div>

					<div class="form-group" id="rl" style="display: none;">
						<select class="hesh form-control input-sm" id="fl">
							<option value="">All</option>	
							<option value="LOW">Low</option>	
							<option value="MODERATE">Moderate</option>
							<option value="HIGH">High</option>
						</select>
						
					</div>

					<div class="form-group" id="il" style="display: none;">
						<select class="hish form-control input-sm" id="fi">
								<option value="">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
						</select>
						
					</div>

					<div class="form-group" id="li" style="display: none;">
						<select class="hosh form-control input-sm" id="fk">
								<option value="">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
						</select>
					</div>

					<div class="form-group" id="choose_l_divisi_1" style="display: none;">
						<select class="bash form-control input-sm" id="l_divisi_1">
							<option value="-">All</option>
							<?php foreach ($division_list as $key) {?>
								<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
							<?php }?>
						</select>
					</div>		

					<button type="submit" id="filterFormSubmit" class="btn blue btn-sm">Search</button>
				</form>
				
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">Risk ID</th>
						<th width="20%">Risk</th>
						<th width="10%">Risk Level</th>
						<th width="10%">Impact Level</th>
						<th width="10%">Likelihood</th>
						<th width="10%">Risk Owner</th>
						
						<th width="10%">&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
		
		<div class="col-md-12">
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
					Recover Risk
				</div>
			</div>
			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm2" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy2">Filter By</label>
						<select class="form-control input-medium input-sm" id="filterFormBy2">
								<option value="-">Choose/ Show All</option>
								<option value="risk_code">Risk ID</option>
								<option value="risk_event">Risk Event</option>
								<option value="risk_level">Risk Level</option>
								<option value="risk_impact_level">Impact Level</option>
								<option value="risk_likelihood_key">Likelihood</option>
								<option value="risk_owner">Risk Owner</option>
						</select>
					</div>

					<div class="form-group" id="tr">
						<input type="text" class="pash form-control input-sm" id="pe" placeholder="Search">
					</div>

					<div class="form-group" id="tl">
						<select class="pesh form-control input-sm" id="pl">
							<option value="">All</option>
							<option value="LOW">Low</option>	
							<option value="MODERATE">Moderate</option>
							<option value="HIGH">High</option>
						</select>
						
					</div>

					<div class="form-group" id="ti">
						<select class="pish form-control input-sm" id="pi">
								<option value="">All</option>
								<?php foreach ($impact_list as $key) {?>
									<option value="<?php echo $key['ref_key']; ?>" data-impact = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
								<?php }?>
						</select>
					</div>

					<div class="form-group" id="tk">
						<select class="posh form-control input-sm" id="pk">
								<option value="">All</option>
								<?php foreach ($likelihood as $key) {?>
									<option value="<?php echo $key['l_key']; ?>" data-likelihood = "<?php echo $key['l_key'];?>"><?php echo $key['l_title'];?></option>
								<?php }?>
						</select>						
					</div>

					<div class="form-group" id="choose_l_divisi_2">
						<select class="bish form-control input-sm" id="l_divisi_2">
							<option value="-">All</option>
							<?php foreach ($division_list as $key) {?>
								<option value="<?php echo $key['ref_key']; ?>" data-division = "<?php echo $key['ref_key'];?>"><?php echo $key['ref_value'];?></option>
							<?php }?>
						</select>
					</div>		

					<button type="submit" id="filterFormSubmit2" class="btn blue btn-sm">Search</button>
				</form>		
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax2">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">Risk ID</th>
						<th width="20%">Risk</th>
						<th width="10%">Risk Level</th>
						<th width="10%">Impact Level</th>
						<th width="10%">Likelihood</th>
						<th width="10%">Risk Owner</th>
						
						<th width="10%">&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
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
								 Submited To RAC
							</li>
						</ul>

		</div>
		
		</div>
		<div class="clearfix">
		</div>
		
	</div>				
	</div>
	
</div>
<?php
$periode_id = $periode['periode_id'];
$sql_cek_status = "select * from t_risk where periode_id ='$periode_id' and risk_status > 1 and risk_input_by = '$uid' UNION select * from t_risk_change where periode_id ='$periode_id' and risk_status > 1 and risk_input_by = '$uid' ";
$res_cek = $this->db->query($sql_cek_status);

if($res_cek->num_rows() > 0){
	$status_submit = 1 ;
}else{
	$status_submit = 0 ;
}
?>
		<script type="text/javascript">
			var g_status_submit = <?=$status_submit?>;
		</script>