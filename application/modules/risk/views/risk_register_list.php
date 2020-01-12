<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		<!-- BEGIN PAGE HEADER-->
		<h3 class="page-title">
		Risk Register
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
					<a target="_self" href="javascript:;">Transaction</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister">Risk Register Exercise</a>
				</li>
			</ul>

			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-fit-height blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					Export <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a href="<?=$site_url?>/report/risk/listofrisk_user/<?=$username?>" id="">Export</a>
						</li>					 
					</ul>
				</div>
			</div>

		</div>
		<?php 
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$status = $_GET['status'];
		if ($status != 'false'){ ?>


		<?php if ($valid_mode) { ?>
		<script type="text/javascript">
			var g_p_name = '<?=$periode['periode_name']?>';
		</script>

	<?php
	$date = date("Y-m-d");
	$username = $this->session->credential['username'];
	$this->load->database();

		$sql1 = "select 
                                                                                a.created_by,
                                                                                a.created_date,
                                                                                a.existing_control_id,
                                                                                a.periode_id,
                                                                                a.risk_2nd_sub_category,
                                                                                a.risk_category,
                                                                                a.risk_cause,
                                                                                a.risk_code,
                                                                                a.risk_control_owner,
                                                                                a.risk_date,
                                                                                a.risk_description,
                                                                                a.risk_division,
                                                                                a.risk_evaluation_control,
                                                                                a.risk_event,
                                                                                a.risk_existing_control,
                                                                                a.risk_id,
                                                                                a.risk_impact,
                                                                                a.risk_impact_level,
                                                                                a.risk_input_by,
                                                                                a.risk_input_division,
                                                                                a.risk_level,
                                                                                a.risk_library_id,
                                                                                a.risk_likelihood_key,
                                                                                a.risk_owner,
                                                                                a.risk_sub_category,
                                                                                a.risk_treatment_owner,
                                                                                a.suggested_risk_treatment,
                                                                                a.switch_flag,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                m_periode.periode_end,
                                                                                f.division_name as risk_owner_v,
                                                                                IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
                                                                                from t_risk_add_user y

                                                                                join t_risk a on y.risk_id = a.risk_id
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                join m_periode on m_periode.periode_id = a.periode_id
                                                                                where 
                                                                                a.periode_id IN ((select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)-1)
                                                                                and y.delete_status is null
                                                                                and y.username = '$username'";


        $sql2 = "select 
					a.*,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.periode_id is not null
					and a.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
					and a.risk_input_by = '$username'
					and (m_periode.periode_start <= '".$date."'
					and m_periode.periode_end >= '".$date."')
					and a.existing_control_id is null
					and a.risk_library_id is null

					UNION
					select 
					a.*,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v
					from t_risk_change a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.periode_id is not null
					and a.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
					and a.risk_input_by = '$username'
					and (m_periode.periode_start <= '".$date."'
					and m_periode.periode_end >= '".$date."')
					and a.existing_control_id is null

					UNION
					select 
					a.*,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v
					from t_risk_change a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					where 
					a.existing_control_id is null
					and a.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
					and a.risk_input_by = '$username'
					and a.risk_id NOT IN (select r.risk_id from t_risk r where r.risk_id = a.risk_id and r.periode_id= (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and r.risk_input_by = '$username' and r.risk_status >= 0)
					

					UNION
					select 
                                                                                a.*,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                f.division_name as risk_owner_v
                                                                                from t_risk a
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                join m_periode on m_periode.periode_id = a.periode_id
                                                                                join t_risk_add_user t on a.risk_id = t.risk_id
                                                                                where 
                                                                                a.periode_id is not null
                                                                                and a.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
                                                                                and t.username = '$username'
                                                                                and (m_periode.periode_start <= '".$date."'
                                                                                and m_periode.periode_end >= '".$date."')
																				and a.existing_control_id is null

					";



	$sql3="SELECT 
					a.risk_id,
                    a.risk_code,
                    a.risk_date,
                    a.risk_status,
                    a.periode_id,
                    a.risk_input_by,
                    a.risk_input_division,
                    a.risk_owner,
                    a.risk_division,
                    a.risk_library_id,
                    a.risk_event,
                    a.risk_description,
                    a.risk_category,
                    a.risk_sub_category,
                    a.risk_2nd_sub_category,
                    a.risk_cause,
                    a.risk_impact,
                                                                               
                                                                               
                    a.risk_level,
                    a.risk_impact_level,
                    a.risk_likelihood_key,
                    a.suggested_risk_treatment,
                    a.risk_treatment_owner,

                    a.created_by,
                    a.created_date,
                    a.switch_flag,
					b.ref_value AS risk_status_v,
					c.ref_value AS risk_level_v,
					d.ref_value AS impact_level_v,
					e.l_title AS likelihood_v,
					f.division_name AS risk_owner_v
					FROM t_risk a
					LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
					LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
					LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
					LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
					LEFT JOIN m_division f ON a.risk_owner = f.division_id
					JOIN m_periode ON m_periode.periode_id = a.periode_id
					WHERE 
					a.periode_id IS NOT NULL
					AND a.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
					AND a.risk_input_by = '$username'

					AND a.existing_control_id IS NULL
					AND a.risk_library_id IS NULL
					AND a.risk_status > 1
					
					UNION
					SELECT 
					a.risk_id,
                    a.risk_code,
                    g.risk_date,
                    g.risk_status,
                    g.periode_id,
                    g.risk_input_by,
                    g.risk_input_division,
                    g.risk_owner,
                    g.risk_division,
                    g.risk_library_id,
                    g.risk_event,
                    g.risk_description,
                    g.risk_category,
                    g.risk_sub_category,
                    g.risk_2nd_sub_category,
                    g.risk_cause,
                    g.risk_impact,
                                                                               
                                                                               
                    g.risk_level,
                    g.risk_impact_level,
                    g.risk_likelihood_key,
                    g.suggested_risk_treatment,
                    g.risk_treatment_owner,

                    g.created_by,
                    g.created_date,
                    g.switch_flag,
					b.ref_value AS risk_status_v,
					c.ref_value AS risk_level_v,
					d.ref_value AS impact_level_v,
					e.l_title AS likelihood_v,
					f.division_name AS risk_owner_v
					FROM t_risk a
					JOIN t_risk_change g ON a.risk_id = g.risk_id
					LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
					LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
					LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
					LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
					LEFT JOIN m_division f ON a.risk_owner = f.division_id
					JOIN m_periode ON m_periode.periode_id = a.periode_id
					WHERE 
					g.periode_id IS NOT NULL
					AND g.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
					AND g.risk_input_by = '$username'
					
					AND g.existing_control_id IS NULL 
					 AND g.risk_status > 1
					
					UNION
					SELECT 
					a.risk_id,
                    a.risk_code,
                    a.risk_date,
                    g.risk_status,
                    a.periode_id,
                    g.risk_input_by,
                    a.risk_input_division,
                    a.risk_owner,
                    a.risk_division,
                    a.risk_library_id,
                    a.risk_event,
                    a.risk_description,
                    a.risk_category,
                    a.risk_sub_category,
                    a.risk_2nd_sub_category,
                    a.risk_cause,
                    a.risk_impact,
                                                                               
                                                                               
                    a.risk_level,
                    a.risk_impact_level,
                    a.risk_likelihood_key,
                    a.suggested_risk_treatment,
                    a.risk_treatment_owner,

                    g.created_by,
                    g.created_date,
                    g.switch_flag,
					b.ref_value AS risk_status_v,
					c.ref_value AS risk_level_v,
					d.ref_value AS impact_level_v,
					e.l_title AS likelihood_v,
					f.division_name AS risk_owner_v
					FROM t_risk a
					JOIN t_risk_change g ON a.risk_id = g.risk_id
					JOIN t_risk_add_user t ON a.risk_id = t.risk_id
					LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
					LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
					LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
					LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
					LEFT JOIN m_division f ON a.risk_owner = f.division_id
					JOIN m_periode ON m_periode.periode_id = a.periode_id
					WHERE 
					 g.risk_library_id IS NOT NULL 
                                                                                AND 
                                                                                t.risk_library_id = 1
                                                                                AND g.existing_control_id IS NULL
                                                                                AND
                                                                                a.periode_id IN (SELECT periode_id FROM m_periode WHERE DATE(NOW()) BETWEEN periode_start AND periode_end)
                                                                                AND 
                                                                                t.username = '$username' AND g.risk_input_by = '$username' AND g.risk_status > 2";


        $query1 = $this->db->query($sql1);
        $query2 = $this->db->query($sql2);
        $query3 = $this->db->query($sql3);


        $sql4  = "select date_format(tanggal_submit, '%d-%m-%Y') as tanggal_submit from t_risk_add_informasi where periode_id IN(select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) 
	and risk_input_by = '$username'";

		$query4 = $this->db->query($sql4);

		if ($query4->num_rows() > 0){
			$hasil = $query4->row();
			$tgl_submit = $hasil->tanggal_submit;
		}
		
		 if ($query1->num_rows() == 0 && $query2->num_rows() == 0 ){
    			$status_submit = "DRAFT";
    			$status_spesial = "DRAFSUB1";
    	 }else if($query3->num_rows() > 0){
		 		$status_submit = "SUBMISSION";
		 		$submit_date = "DATE :".'&nbsp'.$tgl_submit;
		 }else if($query1->num_rows() > 0 && $query2->num_rows() == 0){
		 		$status_submit = "DRAFT";
		 		$status_spesial = "DRAFSUB1";
		 }else if($query1->num_rows() > 0 && $query2->num_rows() > 0){
		 		$status_submit = "DRAFT";
		 		$status_spesial = "DRAFSUB1";
		 }else if($query1->num_rows() == 0 && $query2->num_rows() > 0){
		 		$status_submit = "DRAFT";
		 		$status_spesial = "DRAFSUB";
		 }else{
		 	$status_submit = "DRAFT";
		 	$status_spesial = "DRAFSUB1";
		 }

		?>

		<div class="col-md-12">
			<div class="portlet box grey-silver">
			<div class="portlet-title">
				<div class="caption">
					Roll Forward Risk
				</div>
				<div style="float:right;font-size:18px;padding:5px;">
					<?php echo $status_submit.'&nbsp;'.$submit_date; ?>
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
						<th width="10%">Status</th>
						<th width="10%">Action&nbsp;</th>
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
					Risk Identified in This Periode ( <?=$periode['periode_name']?> ) 
				</div>
				<?php if($status_submit == 'SUBMISSION'){ ?>
 				<div class="actions">
					<a target="_self" class="btn default gray">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">
					Add New Risk </span>
					</a>
				</div>
			 <?php }else{  ?>

			   <div class="actions">
					<a target="_self" href="<?=$site_url?>/risk/RiskRegister/RiskRegisterInput/periodic" class="btn default green">
					<i class="fa fa-plus"></i>
					<span class="hidden-480">
					Add New Risk </span>
					</a>
				</div>

			 	<?php } ?>
				
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
						<th width="40%">Risk</th>
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
	<?php
	$sql="select id from t_cr_risk where created_by='$username' and cr_type='Risk Register' and cr_status = 0 ";
	$sql_cek = $this->db->query($sql);
	if ($sql_cek->num_rows() > 0 ){

	}else{
	?>
	 
				<div class="col-md-12 clearfix">
	<?php if ($status_spesial == "DRAFSUB" ){ ?>

					<a href="javascript: ;" id="button-save-submit" class="btn default green pull-right" style="margin-right: 20px;">
					<i class="fa fa-check-circle-o"></i>
					<span class="hidden-480">
					Submit </span>
					</a>

	<?php }else if ($status_spesial == "DRAFSUB1" ){ ?>
					<a href="javascript: ;" id="button-alert-submit" class="btn default red pull-right" style="margin-right: 20px;">
					<i class="fa fa-check-circle-o"></i>
					<span class="hidden-480">
					Submit </span>
					</a>

					<?php }?>

	<?php if ($status_submit == 'DRAFT'){ ?>
		<a href="javascript: ;" id="button-save-draft" class="btn default green pull-right" style="margin-right: 10px; display: none;">
					<i class="fa  fa-circle-o"></i>
					<span class="hidden-480">
					Save As Draft </span>
					</a>
		
	<?php }else{ ?>
		<a href="<?=$site_url?>/risk/RiskRegister?status=false" id="" class="btn default red pull-right" style="margin-right: 20px;">
					<i class="fa fa-check-circle-o"></i>
					<span class="hidden-480">
					Submit </span>
					</a>
		<a href="javascript: ;" id="button-change-request" class="btn default green pull-right" style="margin-right: 10px;">
					<i class="fa  fa-circle-o"></i>
					<span class="hidden-480">
					Change Request </span>
					</a>
	<?php
	}	
	?>
	</div>
	<?php
	}	
	?>
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
					<img src="<?=$base_url?>assets/images/legend/confirm.png"/> &nbsp; 
					 Confirmed
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
	<?php } else { ?>
	<!-- Warning RISK REGISTER MODE -->
	<div class="row">
	<div class="col-md-12">
		<div class="note note-warning">
			<?php if (isset($submit_mode) && $submit_mode == 'adhoc') { ?>
			<h4 class="block">Warning</h4>
			<p>
				 Cannot Input Adhoc Risk Register Exercise because Risk Period is already set, please contact RAC team for further information
				 <p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Back to Home </a>
				</p>
			</p>
			<?php } else { ?>
			<h4 class="block">Information</h4>
			<p>
				 You cannot input the Regular Risk Register due to the Regular Entry Period is Closed, please contact RAC for further information.
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
	
	<?php }else{ ?>
		
			<!-- Warning RISK REGISTER MODE -->
	<div class="row">
	<div class="col-md-12">
		<div class="note note-warning">
			
			<h4 class="block">Information</h4>
			<p>
			<!--
				Warning ! Cannot submit the Risk Register Exercise because there is another risk which have not been review yet.
				Please check and review all of your risk and submit again.
			-->

Cannot submit risk register because you have already submitted this risk register once.

				 <p>
					<a class="btn red" target="_self" href="<?=$site_url?>/main">
					Back to Home </a>
				</p>
			</p>
			
			
		</div>
	</div>
	</div>

	<?php } ?>
</div>