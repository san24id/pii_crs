<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends APP_Controller {
	function __construct()
    {
        parent::__construct();
        
    }

	public $month_list = array(
		'Januari', 'Februari', 'Maret', 'April',
		'Mei', 'Juni', 'Juli', 'Agustus',
		'September', 'Oktober', 'November', 'Desember'
	);
	
	public function index()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode');
		$data['engnya'] = base_url('index.php/admin/periode');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';

		$this->load->model('admin/mperiode');

		$cek_userRollover = $this->mperiode->userRollover_recover_periode();
		$cek_recoveRisk = $this->mperiode->userrecover_risk_periode();
		$cek_ape_prior = $this->mperiode->cek_actionplanexecution_prior();
		$cek_ape_prior_1 = $this->mperiode->cek_actionplanexecution_prior1()->row();
		$cek_kri_prior = $this->mperiode->cek_kri_mitigation_prior();
		$cek_kri_prior_1 = $this->mperiode->cek_kri_mitigation_prior1()->row();
		$cek_kri_priornon = $this->mperiode->cek_kri_nonmitigation_prior();
		$cek_kri_priornon_1 = $this->mperiode->cek_kri_nonmitigation_prior1()->row();

		$totalape = $cek_ape_prior_1->total_ape;
		$totalkri = $cek_kri_prior_1->total_kri_mandatory;
		$totalkrinon = $cek_kri_priornon_1->total_kri_nonmandatory;
		
		$oke = base_url('assets/images/legend/verified.png');
		$wrong = base_url('assets/images/legend/default.png');

		if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr role="row" class="heading">
									<th width="5%">&nbsp;</th>
									<th width="90%"><center>Alert</center></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Roll Forward Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please delete all recyle bin Recover Risk</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalape.') at prior Action Plan Execution before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$oke.'"; /></td>
									<td>Please review ('.$totalkri.') at prior KRI mandatory before create new period</td>
								</tr>
								<tr>
									<td><img src="'.$wrong.'"; /></td>
									<td>Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</td>
								</tr>
							</tbody>
							</table>';
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('periode', $data);
		$this->load->view('main/footer', $data);
	}

	public function periode_kri()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode');
		$data['engnya'] = base_url('index.php/admin/periode');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode_kri.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_kri', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function periodeGetData()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function periodeGetDataKri()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataKri($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function periodeInsertData() 
	{
		$session_data = $this->session->credential;
	
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		$par['created_by'] = $session_data['username'];
		
		$cek_userRollover = $this->mperiode->userRollover_recover_periode();
		$cek_recoveRisk = $this->mperiode->userrecover_risk_periode();
		$cek_ape_prior = $this->mperiode->cek_actionplanexecution_prior();
		$cek_ape_prior_1 = $this->mperiode->cek_actionplanexecution_prior1()->row();
		$cek_kri_prior = $this->mperiode->cek_kri_mitigation_prior();
		$cek_kri_prior_1 = $this->mperiode->cek_kri_mitigation_prior1()->row();
		$cek_kri_priornon = $this->mperiode->cek_kri_nonmitigation_prior();
		$cek_kri_priornon_1 = $this->mperiode->cek_kri_nonmitigation_prior1()->row();

		$totalape = $cek_ape_prior_1->total_ape;
		$totalkri = $cek_kri_prior_1->total_kri_mandatory;
		$totalkrinon = $cek_kri_priornon_1->total_kri_nonmandatory;
	
		$val = $this->mperiode->validatePeriode($par['periode_start'], $par['periode_end']);

		if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk <br />
							&empty; Please Delete All recyle bin Recover Risk <br /> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk </i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period </i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk<br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == true && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '&empty; Please Delete All recyle bin Recover Roll Forward Risk<br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br>
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == true && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							&empty; Please Delete All recyle bin Recover Risk <br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == true && $cek_kri_prior == false && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							&empty; Please review ('.$totalape.') at prior action plan execution before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == true && $cek_kri_priornon == false){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							&empty; Please review ('.$totalkri.') at prior KRI mandatory before create new period<br />
							<font color=green><i>&radic; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period</i></font>';
		}else if($cek_userRollover == false && $cek_recoveRisk == false && $cek_ape_prior == false && $cek_kri_prior == false && $cek_kri_priornon == true){
			$data['success'] = false;

			$data['msg'] = '<font color=green><i>&radic; Please Delete All recyle bin Recover Roll Forward Risk</i></font><br/>
							<font color=green><i>&radic; Please Delete All recyle bin Recover Risk</i></font><br> 
							<font color=green><i>&radic; Please review ('.$totalape.') at prior action plan execution before create new period</i></font><br />
							<font color=green><i>&radic; Please review ('.$totalkri.') at prior KRI mandatory before create new period</i></font><br />
							&empty; Please review ('.$totalkrinon.') at prior KRI non mandatory before create new period';
		}
		else if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->insertData($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}
	
	public function periodeInsertDataKri()
	{
		$session_data = $this->session->credential;
	
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		$par['created_by'] = $session_data['username'];
		
		$val = $this->mperiode->validatePeriode($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->insertDataKri($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}

	public function periodeEditData()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		
		$val = $this->mperiode->validatePeriode($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->updateData($_POST['periode_id'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}

	public function periodeEditDataKri()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		
		$val = $this->mperiode->validatePeriode($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->updateDataKri($_POST['periode_id'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}
	
	public function periodeDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataById($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDelete( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteData($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}

	public function periodeDeleteDataKri() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataById($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDelete( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteDataKri($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}
	
	/* Periode Action Plan */
	public function actplan()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/actplan');
		$data['indonya'] = base_url('index.php/admini/periode/actplan');
		$data['engnya'] = base_url('index.php/admin/periode/actplan');			
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode_plan.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_plan', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function periodePlanGetData()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataPlan($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function periodePlanInsertData()
	{
		$session_data = $this->session->credential;
	
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		$par['created_by'] = $session_data['username'];
		
		$val = $this->mperiode->validatePeriodePlan($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->insertDataPlan($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}
	
	public function periodePlanEditData()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		
		$val = $this->mperiode->validatePeriodePlan($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->updateDataPlan($_POST['periode_id'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}
	
	public function periodePlanDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataByIdPlan($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDeletePlan( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteDataPlan($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}
//periode report
	public function periode_r()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/periode_r');
		$data['indonya'] = base_url('index.php/admini/periode/periode_r');
		$data['engnya'] = base_url('index.php/admin/periode/periode_r');			
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode_report.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_report', $data);
		$this->load->view('main/footer', $data);
	}

	//periode report include
	public function periode_list($id)
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/actplan');
		$data['indonya'] = base_url('index.php/admini/periode/periode_r');
		$data['engnya'] = base_url('index.php/admin/periode/periode_r');			
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode_list.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';

		$data['id'] = $id;
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_list', $data);
		$this->load->view('main/footer', $data);
	}

	//periode report
	public function periode_list_exclude($id)
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/actplan');
		$data['indonya'] = base_url('index.php/admini/periode/periode_r');
		$data['engnya'] = base_url('index.php/admin/periode/periode_r');			
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode_exclude.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';

		$data['id'] = $id;
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_list', $data);
		$this->load->view('main/footer', $data);
	}

	public function periodeReportInsertData()
	{
		$session_data = $this->session->credential;
	
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		
		
		$val = $this->mperiode->validatePeriodeReport($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->insertDataReport($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}

	public function periodeReportGetData()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataReport($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function periodeReportGetDataList($id)
	{
		
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataReportList($page, $row, $order_by, $order, $filter_by, $filter_value, $id);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function periodeReportGetDataListExclude($id)
	{
		
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataReportListExclude($page, $row, $order_by, $order, $filter_by, $filter_value, $id);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function periodeReportEditData()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('admin/mperiode');
		
		$dints = implode('-', array_reverse( explode('-', $_POST['periode_start']) ) );
		$dinte = implode('-', array_reverse( explode('-', $_POST['periode_end']) ) );
		
		$par['periode_name'] = $_POST['periode_name'];
		$par['periode_start'] = $dints;
		$par['periode_end'] = $dinte;
		
		$val = $this->mperiode->validatePeriodeReport($par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->updateDataReport($_POST['periode_id'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}

	public function periodeReportDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataByIdPlan($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDeleteReport( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteDataReport($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}

	public function periodeReportDeleteDataList($risk_id) {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataByIdPlan($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDeleteReport( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteDataReportList($_POST['id'], $session_data['username'], $risk_id);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}

	public function periodeReportDeleteDataListExclude($risk_id) {
		$session_data = $this->session->credential;
		$this->load->model('admin/mperiode');
		$par = $this->mperiode->getDataByIdPlan($_POST['id']);
		
		$val = $this->mperiode->validatePeriodeDeleteReport( $par['periode_start'], $par['periode_end']);
		if (!$val['status']) {
			$data['success'] = false;
			$data['msg'] = $val['msg'];
		} else {
			$res = $this->mperiode->deleteDataReportListExclude($_POST['id'], $session_data['username'], $risk_id);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		}
		
		
		echo json_encode($data);
	}

	public function periodeGetData_submission()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataSubmit($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function subperiode_register()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode/subperiode_register');
		$data['engnya'] = base_url('index.php/admin/periode/subperiode_register');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_register');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_sregister', $data);
		$this->load->view('main/footer', $data);
	}

	public function subperiode_treatment()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode');
		$data['engnya'] = base_url('index.php/admin/periode');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_treatment');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_streatment', $data);
		$this->load->view('main/footer', $data);
	}

	public function subperiode_action()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode/subperiode_action');
		$data['engnya'] = base_url('index.php/admin/periode/subperiode_action');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_action');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_saction', $data);
		$this->load->view('main/footer', $data);
	}


	public function subperiode_aggregate()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode/subperiode_aggregate');
		$data['engnya'] = base_url('index.php/admin/periode/subperiode_aggregate');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_saggregate', $data);
		$this->load->view('main/footer', $data);
	}

	public function periodeGetDataAgg()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataAgg($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function subperiode_mapaggregate()
	{			
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/periode/subperiode_mapaggregate');
		$data['engnya'] = base_url('index.php/admin/periode/subperiode_mapaggregate');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_mapaggregate');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/admin/periode.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_smapaggregate', $data);
		$this->load->view('main/footer', $data);
	}

	public function periodeGetDataMapAgg()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mperiode');
		$data = $this->mperiode->getDataAgg($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

}







