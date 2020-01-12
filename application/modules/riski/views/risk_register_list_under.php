<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		Undermaintanance
		</h3>
		<!-- END PAGE HEADER-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="fa fa-home"></i>
					<a target="_self" href="<?=$site_url?>/main">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="javascript:;">Transaksi</a>
					<i class="fa fa-angle-right"></i>
				</li>
				
				<li>
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister">Undermaintenance</a>
				</li>
			</ul>
		</div>
		<?php 
		
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$status = $_GET['status'];
		if ($status != 'ap'){ ?>
		<script type="text/javascript">
			var g_p_name = '<?=$periode['periode_name']?>';
		</script>
		<div class="col-md-12">
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
				 Daftar Risiko Aktif
				</div>
			</div>
			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy">Filter Berdasarkan</label>
						<select class="form-control input-medium input-sm" id="filterFormBy">
							<option value="-">Pilih</option>
							<option value="risk_event">Risiko</option>
							<option value="risk_level">Level Risiko</option>
							<option value="risk_impact_level">Dampak Level</option>
							
							<option value="risk_owner">Pemilik Risiko</option>
						</select>
					</div>
					<div class="form-group" id="re">
						<input type="text" class="hash form-control input-sm" id="fe" placeholder="Insert Filter Value">
					</div>

					<div class="form-group" id="rl">
						<select class="hesh form-control input-sm" id="fl">
							<option value="ALL">Semua</option>
							<option value="low">Rendah</option>	
							<option value="moderate">Sedang</option>
							<option value="high">Tinggi</option>
						</select>
						
					</div>

					<div class="form-group" id="il">
						<select class="hish form-control input-sm" id="fi">
							<option value="insignificant">Tidak Signifikan</option>	
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

					<div class="form-group" id="re2">
						<input type="text" class="hash form-control input-sm" id="fe2" placeholder="Insert Filter Value">
					</div>										

					<button type="submit" id="filterFormSubmit" class="btn blue btn-sm">Cari</button>
				</form>
				
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">ID Risiko</th>
						<th width="20%">AP ID</th>
						<th width="40%">Peristiwa Risiko</th>
						<th width="10%">Level Risiko</th>
						<th width="10%">Pemilik Risiko</th>
						<th width="10%">Pindah ke Undermaintenance</th>
						
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
					Daftar Risiko undermaintenance RAC
				</div>
				
				
			</div>
			
			<div class="portlet-body">
				<form class="form-inline" role="form" id="filterForm2" style="margin-bottom: 10px;">
					<div class="form-group">
						<label for="filterFormBy2">Filter Berdasarkan</label>
						<select class="form-control input-medium input-sm" id="filterFormBy2">
							<option value="-">Pilih</option>
							<option value="risk_event">Risiko</option>
							<option value="risk_level">Level Risiko</option>
							<option value="risk_impact_level">Dampak Level</option>
							
							<option value="risk_owner">Pemilik Risiko</option>
						</select>
					</div>

					<div class="form-group" id="tr">
						<input type="text" class="pash form-control input-sm" id="pe" placeholder="Insert Filter Value">
					</div>

					<div class="form-group" id="tl">
						<select class="pesh form-control input-sm" id="pl">
							<option value="ALL">Semua</option>
							<option value="low">Rendah</option>	
							<option value="moderate">Sedang</option>
							<option value="high">Tinggi</option>
						</select>
						
					</div>

					<div class="form-group" id="ti">
						<select class="pish form-control input-sm" id="pi">
							<option value="insignificant">Tidak Signifikan</option>	
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

					<div class="form-group" id="tr2">
						<input type="text" class="pash form-control input-sm" id="pe2" placeholder="Insert Filter Value">
					</div>
				
					<button type="submit" id="filterFormSubmit2" class="btn blue btn-sm">Cari</button>
				</form>	
				
				<div class="table-container">
					<table class="table table-striped table-bordered " id="datatable_ajax2">
					<thead>
					<tr role="row" class="heading">
						<th width="10%">Status</th>
						<th width="10%">ID Risiko</th>
						<th width="20%">AP ID</th>
						<th width="40%">Peristiwa Risiko</th>
						<th width="10%">Level Risiko</th>
						<th width="10%">Pemilik Risiko</th>
						<th width="10%">Pindah ke Active List</th>
					</tr>
					</thead>
					<tbody>
					</tbody>



					</table>

				</div>
				<div class="row">
				<div class="col-md-12 clearfix">


	
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
								<img src="<?=$base_url?>assets/images/legend/executed.png"/> &nbsp; 
								Action Plan telah dilaksanakan dan diverifikasi 
							</li>
						</ul>
		</div>
		</div>
		<div class="row">
		
<?php }else{ 

$username = $this->session->credential['username'];
	$this->load->database();
	$risk_id = $_GET['id'];
	$sql="select concat('AP.', LPAD(b.id, 6, '0')) as id_plan, b.id as id_ap, a.id , a.action_plan, a.division, a.execution_status
	from t_risk_action_plan a, m_action_plan b where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = '$risk_id' ";
	$query = $this->db->query($sql);

	?>

<!-- LIBRARY -->
<div id="modal-library" class="" tabindex="-1" data-width="860" data-keyboard="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Action Plan</h4>
		
	</div>
	<div class="modal-body">
		<div>
			<table id="/library_table" class="table table-condensed table-bordered table-hover">
				<thead>
				<tr role="row" class="heading">
					
					<th>AP ID</th>
					<th>Action Plan</th>
					<th>Pemilik Action Plan</th>
					<th>Eksekusi</th>
				</tr>
				</thead>
				<tbody>
<?php

if ($query->num_rows() > 0)
{
   foreach ($query->result_array() as $row)
   {
      ?>
      <tr><td><a href="<?php echo $site_url ?>/main/mainrac/actionPlanForm_under/<?php echo$row['id'] ?>?status=under"> <?php echo $row['id_plan']; ?> </a></td><td><?php echo $row['action_plan']; ?></td><td><?php echo $row['division']; ?></td><td><a href="<?php echo $site_url ?>/main/mainrac/FormactionPlanExec_un/<?php echo$row['id'] ?>?status=under"><?php echo $row['execution_status']; ?></a></td></tr>
<?php
   }
} 
					?>
				</tbody>
			</table>
		</div>
	</div>
	
</div>
</div>
<?php } ?>
		</div>
		<div class="clearfix">
		</div>
		
	</div>				
	</div>
</div>

