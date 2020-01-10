<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainRac extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_rac.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequest();
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['cekregisterlist'] = $this->risk->cekRegisterList();
		$data['treatmentlist'] = $this->risk->treatmentlist();
		$data['cekplan'] = $this->risk->cekPlanRac();
		$data['cekplanExec'] = $this->risk->cekPlanExecRac();
		$data['cekkrirac'] = $this->risk->cekKriRac();
		$data['s_risk_owner'] = $this->risk->statemen_risk_owner();
		$data['s_action_plan'] = $this->risk->statemen_action_plan();
		$data['s_action_plan_exe'] = $this->risk->statemen_action_plan_exe();
		$data['sumAllRisk'] = $this->risk->getSumRisk();
		$data['sumAllRiskReg'] = $this->risk->getSumRiskUsername();
		$data['sumAllTreatment'] = $this->risk->getDataMode('sum_racTratmentList', $defFilter = null, $page = null, $row = null, $order_by = null, $order = null, $filter_by = null, $filter_value = null);
		$data['sumAllKRI'] = $this->risk->getDataMode('sum_rackri', $defFilter = null, $page = null, $row = null, $order_by = null, $order = null, $filter_by = null, $filter_value = null);
		$data['sumAllKRINon'] = $this->risk->getDataMode('sum_rackri_non', $defFilter = null, $page = null, $row = null, $order_by = null, $order = null, $filter_by = null, $filter_value = null);
		$data['sumAllAp'] = $this->risk->getDataMode('sumRacAP', $defFilter = null, $page = null, $row = null, $order_by = null, $order = null, $filter_by = null, $filter_value = null);
		$data['sumAllOldRisk'] = $this->risk->getSumOldRisk();
		$data['setting_dasborad'] = $this->risk->dasboard_setting();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();


		$this->load->view('header', $data);
		$this->load->view('main_rac', $data);
		$this->load->view('footer', $data);
	}

	public function editor(){

		$this->load->view('demo');

	}

	public function hide_treatment()
	{
	
			$this->load->model('risk/risk');
			$res = $this->risk->hide_dasboard_risk_own();
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error';
			}
			echo json_encode($data);
	}

	public function show_treatment()
	{
	
			$this->load->model('risk/risk');
			$res = $this->risk->show_dasboard_risk_own();
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error';
			}
			echo json_encode($data);
	}

	public function addhocrac()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/addhocrac');
		$data['engnya'] = base_url('index.php/main/mainrac/addhocrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/addhocrac');
		
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_rac.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequest();
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['cekregisterlist'] = $this->risk->cekRegisterList();
		$data['treatmentlist'] = $this->risk->treatmentlist();
		$data['cekplan'] = $this->risk->cekPlanRac();
		$data['cekplanExec'] = $this->risk->cekPlanExecRac();
		$data['cekkrirac'] = $this->risk->cekKriRac();
		$data['s_risk_owner'] = $this->risk->statemen_risk_owner();
		$data['s_action_plan'] = $this->risk->statemen_action_plan();
		$data['s_action_plan_exe'] = $this->risk->statemen_action_plan_exe();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();


		$this->load->view('header', $data);
		$this->load->view('main_rac_addhoc', $data);
		$this->load->view('footer', $data);
	}


	public function secret_user(){

		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		

		
		//cek change request
		$this->load->model('risk/risk');

		$data['report'] = $this->risk->report();

		$this->load->view('header', $data);
		$this->load->view('test_mail', $data);
		$this->load->view('footer', $data);

	}

	public function InformasiMenuDireksi()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		
		// $this->load->view('header', $data);
		// $this->load->view('boardDireksi', $data);
		// $this->load->view('footer', $data);
	$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_direksi2.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		 
		';
	 $this->load->model('risk/riskdireksi');

		$data['listDivision'] = $this->riskdireksi->getDivision();
		$data['listDivision_directorat'] = $this->riskdireksi->getDivision_directorat();
		
		$data['sumAllRisk'] = $this->riskdireksi->sumAllRisk();
		$data['sumAllRisk_prior'] = $this->riskdireksi->sumAllRisk_prior();
	
		
		$data['sumHighRisk'] = $this->riskdireksi->sumHighRisk();
		$data['sumModerateRisk'] = $this->riskdireksi->sumModerateRisk();
		$data['sumLowRisk'] = $this->riskdireksi->sumLowRisk();
		$data['sumHighRisk_prior'] = $this->riskdireksi->sumHighRisk_prior();
		$data['sumModerateRisk_prior'] = $this->riskdireksi->sumModerateRisk_prior();
		$data['sumLowRisk_prior'] = $this->riskdireksi->sumLowRisk_prior();
		//top five risk
		$data['tabTopFiveRisk']=$this->riskdireksi->tabTopFiveRisk();
		//----

				//actiopn plan
		$data['AP_total_prior'] = $this->riskdireksi->AP_total_prior();
		$data['AP_total_cur'] = $this->riskdireksi->AP_total_cur();

		$data['AP_ongoing_prior'] = $this->riskdireksi->AP_ongoing_prior();
		$data['AP_extend_prior'] = $this->riskdireksi->AP_extend_prior();
		$data['AP_complete_prior'] = $this->riskdireksi->AP_complete_prior();


		$data['AP_ongoing_cur'] = $this->riskdireksi->AP_ongoing_cur();
		$data['AP_extend_cur'] = $this->riskdireksi->AP_extend_cur();
		$data['AP_complete_cur'] = $this->riskdireksi->AP_complete_cur();

		//kri
		$data['AP_kri_prior'] = $this->riskdireksi->AP_kri_prior();
		$data['AP_kri_curent'] = $this->riskdireksi->AP_kri_curent();

		$data['AP_kri_green_prior'] = $this->riskdireksi->AP_kri_green_prior();
		$data['AP_kri_yellow_prior'] = $this->riskdireksi->AP_kri_yellow_prior();
		$data['AP_kri_red_prior'] = $this->riskdireksi->AP_kri_red_prior();


		$data['AP_kri_red_cur'] = $this->riskdireksi->AP_kri_red_cur();
		$data['AP_kri_yellow_cur'] = $this->riskdireksi->AP_kri_yellow_cur();
		$data['AP_kri_green_cur'] = $this->riskdireksi->AP_kri_green_cur();


		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		//---- end

		$this->load->view('header_dir', $data);
		$this->load->view('boardDireksi2', $data);
		$this->load->view('footer', $data);
	}

	public function ChartTest()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		

		
		//cek change request
		$this->load->model('risk/risk');

		$data['report'] = $this->risk->report();

		$this->load->view('header', $data);
		$this->load->view('test_chart', $data);
		$this->load->view('footer', $data);
	}

//--- Chart Dasbord ----//
	public function chart_risk()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['risk_high_submit'] = $this->risk->chart_risk_high();
		$data['risk_high_verify'] = $this->risk->chart_risk_high_v();
		$data['risk_moderate_submit'] = $this->risk->chart_risk_moderate();
		$data['risk_moderate_verify'] = $this->risk->chart_risk_moderate_v();
		$data['risk_low_submit'] = $this->risk->chart_risk_low();
		$data['risk_low_verify'] = $this->risk->chart_risk_low_v();

		$this->load->view('chart/risk_chart', $data);
	}

	public function chart_submitted_user()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['user_submit'] = $this->risk->chart_submitted_user();
		$data['user_verify'] = $this->risk->chart_verify_user();

		$this->load->view('chart/submitted_user_pie', $data);
	}

	public function chart_treatment()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['treatment_high_submit'] = $this->risk->chart_treatment_high();
		$data['treatment_moderate_submit'] = $this->risk->chart_treatment_moderate();
		$data['treatment_low_submit'] = $this->risk->chart_treatment_low();
		$data['treatment_high_verify'] = $this->risk->chart_treatment_high_v();
		$data['treatment_moderate_verify'] = $this->risk->chart_treatment_moderate_v();
		$data['treatment_low_verify'] = $this->risk->chart_treatment_low_v();

		$this->load->view('chart/treatment_chart', $data);
	}

	public function chart_submitted_ap()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['ap_draft'] = $this->risk->chart_draft_ap();
		$data['ap_submit'] = $this->risk->chart_submitted_ap();
		$data['ap_verify'] = $this->risk->chart_verify_ap();

		$this->load->view('chart/submitted_ap_pie', $data);
	}

	public function chart_submitted_apex()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['apex_draft'] = $this->risk->chart_draft_apex();
		$data['apex_submit'] = $this->risk->chart_submitted_apex();
		$data['apex_verify'] = $this->risk->chart_verify_apex();

		$this->load->view('chart/submitted_apex_pie', $data);
	}

	public function chart_submitted_kri()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['kri_draft'] = $this->risk->chart_draft_kri();
		$data['kri_submit'] = $this->risk->chart_submitted_kri();
		$data['kri_verify'] = $this->risk->chart_verify_kri();

		$this->load->view('chart/submitted_kri_pie', $data);
	}

	public function chart_submitted_changerequest()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$this->load->model('risk/risk');

		$data['crequest_submit'] = $this->risk->chart_submitted_changerequest();
		$data['crequest_verify'] = $this->risk->chart_verify_changerequest();

		$this->load->view('chart/submitted_change_request_pie', $data);
	}

//---------------------------------
	
	public function riskRegister($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_rac_risk.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = true;
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$this->load->model('admin/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($rid);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;

			$this->load->view('main/header', $data);
			$this->load->view('risk_register_list', $data);
			$this->load->view('main/footer', $data);
		}

	}
// Oktober 12/16
	public function riskRegister_okto($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_rac_risk_okto.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = true;
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$this->load->model('admin/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($rid);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;

			$this->load->view('main/header', $data);
			$this->load->view('risk_register_list_okto', $data);
			$this->load->view('main/footer', $data);
		}

	}

	public function riskRegister2($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_rac_risk.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = true;
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$this->load->model('admin/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');
		$userdata = $this->usermodel->getDataById($rid);
		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;
			
			$this->load->view('main/header', $data);
			$this->load->view('risk_register_list', $data);
			$this->load->view('main/footer', $data);
		}

	}
	
	public function getSummaryCount($mode = null) {
		// MODE : risk riskregister treatment actionplan kri change
		$sess = $this->loadDefaultAppConfig();
		
		$this->load->model('risk/risk');
		 
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		
		$tmp = array(
			'HIGH' => 0, 'MODERATE' => 0, 'LOW' => 0
		);
		
		if ($mode == 'risk') {
			$data = $this->risk->getSummaryCount('risk', $defFilter);
		} else if ($mode == 'riskregister') {
			$data = $this->risk->getSummaryCount('riskregister', $defFilter);
		} else if ($mode == 'treatment') {
			$data = $this->risk->getSummaryCount('treatment', $defFilter);
		} else if ($mode == 'actionplan') {
			$data = $this->risk->getSummaryCount('actionplan', $defFilter);
		} else if ($mode == 'kri') {
			$data = $this->risk->getSummaryCount('kri', $defFilter);
		} else if ($mode == 'change') {
			$data = $this->risk->getSummaryCount('change', $defFilter);
		} else {
			exit;
		}
		
		if ($data) {
			foreach($data as $row) {
				$tmp[$row['risk_level']] = $row['numcount'];
			}
		}
		
		$high = isset($tmp['HIGH']) ? $tmp['HIGH'] : 0;
		$moderate = isset($tmp['MODERATE']) ? $tmp['MODERATE'] : 0;
		$low = isset($tmp['LOW']) ? $tmp['LOW'] : 0;
		
		$resp = array(
			array('data' => array(array($high, "Tinggi"))),
			array('data' => array(array($moderate, "Sedang"))),
			array('data' => array(array($low, "Rendah")))
		);
		
		echo json_encode($resp);
	}
	
	public function getSummaryCount2($mode = null) {
		// MODE : risk riskregister treatment actionplan kri change
		$sess = $this->loadDefaultAppConfig();
		
		$this->load->model('risk/risk');
		 
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		
		if ($mode == 'riskregister') {
			$data = $this->risk->getSummaryCount('riskregister', $defFilter);
		}else {
			exit;
		}
		
		if ($data) {
			foreach($data as $row) {
				$tmp  = $row['numcount'];
			}
		}
		/////////////////
		$high = $tmp ;
		$resp = array(
			array('data' => array(array($high, "Total")))
		);
		
		echo json_encode($resp);
	}

	public function getAllRisk() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rl_1']) && isset($_POST['filter_rl_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
			$filter_rl_1 = $_POST['filter_rl_1'];
			$filter_rl_2 = $_POST['filter_rl_2'];

			$this->load->library('session');

			$_SESSION['filbyrisk'] = $filter_by;
			$_SESSION['filvalrisk'] = $filter_value;
			$_SESSION['filter_rl_1'] = $filter_rl_1;
			$_SESSION['filter_rl_2'] = $filter_rl_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

		if ($periode == true) {
			if(isset($_SESSION['filbyrisk']) || isset($_SESSION['filvalrisk'])){
				$data = $this->risk->getAllRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisk'], $_SESSION['filvalrisk']);
			}else{
				$data = $this->risk->getAllRisk_n($page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		}else{
			//$data = $this->risk->getAllRiskPeriode($page, $row, $order_by, $order, $filter_by, $filter_value);
			if(isset($_SESSION['filbyrisk']) || isset($_SESSION['filvalrisk'])){
				$data = $this->risk->getAllRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisk'], $_SESSION['filvalrisk']);
			}else{
				$data = $this->risk->getAllRisk_n($page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		}

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getAllOldRisk() {
	    $sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rl_1']) && isset($_POST['filter_rl_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
			$filter_rl_1 = $_POST['filter_rl_1'];
			$filter_rl_2 = $_POST['filter_rl_2'];

			$this->load->library('session');

			$_SESSION['filbyriskp'] = $filter_by;
			$_SESSION['filvalriskp'] = $filter_value;
			$_SESSION['filter_rlp_1'] = $filter_rl_1;
			$_SESSION['filter_rlp_2'] = $filter_rl_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

			//$data = $this->risk->getAllOldRisk($page, $row, $order_by, $order, $filter_by, $filter_value);
			if(isset($_SESSION['filbyriskp']) || isset($_SESSION['filvalriskp'])){
				$data = $this->risk->getAllOldRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyriskp'], $_SESSION['filvalriskp']);
			}else{
				$data = $this->risk->getAllOldRisk_n($page, $row, $order_by, $order, $filter_by, $filter_value);
			}


		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
public function getUserList() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rl_1']) && isset($_POST['filter_rl_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
			$filter_rl_1 = $_POST['filter_rl_1'];
			$filter_rl_2 = $_POST['filter_rl_2'];

			$this->load->library('session');

			$_SESSION['filbyriskg'] = $filter_by;
			$_SESSION['filvalriskg'] = $filter_value;
			$_SESSION['filter_rg_1'] = $filter_rl_1;
			$_SESSION['filter_rg_2'] = $filter_rl_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = 0;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		//$data = $this->risk->getRiskUsername_n($periode_id, $page, $row, $order_by, $order, $filter_by, $filter_value);
			if(isset($_SESSION['filbyriskg']) || isset($_SESSION['filvalriskg'])){
				$data = $this->risk->getRiskUsername($periode_id, $page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyriskg'], $_SESSION['filvalriskg']);
			}else{
				$data = $this->risk->getRiskUsername_n($periode_id, $page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function riskGetRollOver()
	{
		$sess = $this->loadDefaultAppConfig();
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
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
				
		$this->load->model('risk/risk');
		$this->load->model('admin/mperiode');
		$defFilter = array(
			'userid' => $_POST['user_id'],
			'periodid' => $periode_id
		);

		//$cek_userRollover = $this->mperiode->userRollover_recover_periode();
		//$cek_userRollover_recover_modify_rac = $this->mperiode->userRollover_recover_modify_rac();	

		$data = $this->risk->getDataMode('racRollover', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		/*if($cek_userRollover == true || $cek_userRollover_recover_modify_rac == true){
					$data['msg'] = 'Delete All recyle bin Recover Roll Forward Risk and Recover Risk';
		}*/
		//$data['msg'] = 'tes';

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function riskGetDataUser()
	{
		$sess = $this->loadDefaultAppConfig();
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
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('risk/risk');
		$defFilter = array(
			'userid' => $_POST['user_id'],
			'periodid' => $periode_id
		);
		$data = $this->risk->getDataMode('racPeriode', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

// Oktober 12/16
public function riskGetDataUser_okto()
	{
		$sess = $this->loadDefaultAppConfig();
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
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('risk/risk');
		$defFilter = array(
			'userid' => $_POST['user_id'],
			'periodid' => $periode_id
		);
		$data = $this->risk->getDataMode('racPeriode_okto', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskGetDataUser_okto2()
	{
		$sess = $this->loadDefaultAppConfig();
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
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('risk/risk');
		$defFilter = array(
			'userid' => $_POST['user_id'],
			'periodid' => $periode_id
		);
		$data = $this->risk->getDataMode('racPeriode_okto2', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
//------------------------------------------------------
	public function riskRegisterForm($risk_id = null,$user_by=null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		$this->load->model('admin/mperiode');
		
		$menu = '';
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'main/mainrac';
		$data['valid_mode'] = true;
		
		$sql = "select risk_id from t_risk_change where risk_id='".$risk_id."' and risk_input_by ='".$user_by."' " ;
		$query = $this->db->query($sql);
	if ($query->num_rows() > 0){
		$res = $this->risk->getRiskByIdNoRefChanges($risk_id,$user_by);
	}else{
		$res = $this->risk->getRiskByIdNoRef($risk_id);
	}
		if ($res) {
			if ($res['risk_library_id'] == '' && $res['risk_library_id'] == null) { // NO LIBRARY
				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskverify.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$page_view = 'risk_register_verify';
			} else { // USE LIBRARY
				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskverifylibrary.js"></script>
				<script src="assets/scripts/risk/riskinputlib.js"></script>
				<script src="assets/scripts/risk/riskverifylibrary_change.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskSetAs.init();RiskInputlib.init('".$data['submit_mode']."');RiskVerify.init();";
				
				$lib_risk = $this->risk->getRiskByIdNoRef($res['risk_library_id']);
				$data['library_risk'] = $lib_risk;
				$data['library_risk_id'] = $res['risk_library_id'];
				$page_view = 'risk_register_library';

				//cari tanggal submit
				$periode = $this->mperiode->getCurrentPeriode();
				$data['tanggal_submit'] = $this->risk->cari_tanggal_submit($user_by,$periode['periode_id']);
				$data['max_impact'] = $this->mriskregister->getMaxImpact($risk_id, $user_by);
				$data['max_impact_change'] = $this->mriskregister->getMaxImpact_change($risk_id, $user_by);
				$data['dff_impact'] = $this->mriskregister->getDffImpact($risk_id, $user_by);
				$data['dff_impact_pri'] = $this->mriskregister->getDffImpact_primary($risk_id, $user_by);

			}
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			'.$verifyJs.'
			';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['risk_input_by'] = $user_by; 
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function riskRegisterFormunder($risk_id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'main/mainrac';
		$data['valid_mode'] = true;
		
		$res = $this->risk->getRiskByIdNoRef($risk_id);
		if ($res) {
			
				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskverify.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$page_view = 'risk_register_verify';
			
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			'.$verifyJs.'
			';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister/undermaintenance');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function riskGetData($risk_id)
	{
		$this->load->model('risk/risk');
		$data = $this->risk->getRiskById($risk_id);
		echo json_encode($data);
	}
	
	public function deleteRisk()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$risk_id = $_POST['risk_id'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteRisk($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
		}
	}

	public function deleteRiskrac()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$risk_id = $_POST['risk_id'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteRiskrac($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
		}
	}

	public function ignoreAP_execution()
	{
		if (isset($_POST['ap_code']) && is_numeric($_POST['ap_code'])) {
			$ap_code = $_POST['ap_code'];
			$periode = $_POST['periode_id'];
			$this->load->model('risk/risk');
			$res = $this->risk->ignoreActoinPlanExe($ap_code, $periode, $this->session->credential['username']);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
		}
	}

	public function acceptAP_execution()
	{
		if (isset($_POST['ap_code']) && is_numeric($_POST['ap_code'])) {
			$ap_code = $_POST['ap_code'];
			$periode = $_POST['periode_id'];
			$this->load->model('risk/risk');
			$res = $this->risk->acceptActoinPlanExe($ap_code, $periode, $this->session->credential['username']);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
		}
	}
	/*
	public function verifyPrimaryRiskData()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				$risk_change = $this->risk->getRiskChangeById($_POST['risk_id']);
				$code = $risk_change['risk_code'];
				
				// build data
				$risk = array(
					'risk_status' => 3,
					'risk_code' => $code,
					'risk_owner' => $risk_change['risk_division'],
					'risk_division' => $risk_change['risk_division'],
					'risk_library_id' => $risk_change['risk_library_id'],
					'risk_event' => $risk_change['risk_event'],
					'risk_description' => $risk_change['risk_description'],
					'risk_category' => $risk_change['risk_category'],
					'risk_sub_category' => $risk_change['risk_sub_category'],
					'risk_2nd_sub_category' => $risk_change['risk_2nd_sub_category'],
					'risk_cause' => $risk_change['risk_cause'],
					'risk_impact' => $risk_change['risk_impact'],
					'risk_level' => $risk_change['risk_level'],
					'risk_impact_level' => $risk_change['risk_impact_level'],
					'risk_likelihood_key' => $risk_change['risk_likelihood_key'],
					'suggested_risk_treatment' => $risk_change['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($risk_change['impact_list'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($risk_change['action_plan_list'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($risk_change['control_list'] as $v) {
					$control[] = $v;
				}
				
				$res = $this->risk->updateRisk1($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $data['session']['username']);
				$res = $this->risk->riskDeleteChange($_POST['risk_id'],$data['session']['username']);
				
				if (isset($_POST['add_user_flag']) && $_POST['add_user_flag'] == 'yes') {
					$dd = implode('-', array_reverse( explode('-', $_POST['add_user_date_changed']) ));
					$res = $this->risk->riskAddUser($_POST['risk_id'], $_POST['add_user_username'], $dd);
				}
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	*/
	public function verifyPrimaryRiskData($user)
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null; 
				
				// build data
				$risk = array(
					'risk_status' => 3,
					'risk_division' => $_POST['risk_division']
					/*
					,
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
					*/
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
				

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				if (isset($_POST['add_user_flag']) && $_POST['add_user_flag'] == 'yes') {
					//$dd = implode('-', array_reverse( explode('-', $_POST['add_user_date_changed']) ));
					$res = $this->risk->riskAddUser($_POST['risk_id'], $_POST['risk_code'], $_POST['add_user_username'], $_POST['add_user_date_changed'], $data['session']['username']);
				}

				$res = $this->risk->updateRisk1($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], $user);


				$res = $this->risk->insertRiskOwn($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], $user);

				//$res = $this->risk->updateRisk1change($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $data['session']['username']);
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}
			
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function verifyRiskData()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_status' => 3,
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}
				
				$res = $this->risk->updateRisk($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $data['session']['username']);
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				
				if (isset($_POST['add_user_flag']) && $_POST['add_user_flag'] == 'yes') {
					//$dd = implode('-', array_reverse( explode('-', $_POST['add_user_date_changed']) ));
					$res = $this->risk->riskAddUser($_POST['risk_id'], $_POST['risk_code'], $_POST['add_user_username'], $_POST['add_user_date_changed'], $data['session']['username']);
				}
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

	public function verifyRiskDatarac()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_status' => 3,
					'risk_code' => $code,
					'risk_input_by' => $_POST['risk_input_by'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
				
				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->updateRiskrac($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				
				/*
				//tadinya library aja yg di masukin add user
				if (isset($_POST['add_user_flag']) && $_POST['add_user_flag'] == 'yes') {
					$dd = implode('-', array_reverse( explode('-', $_POST['add_user_date_changed']) ));
					$res = $this->risk->riskAddUser1form($_POST['risk_id'], $_POST['add_user_username'], $dd);
				}else{
					$dd = date("Y-m-d");
					$res = $this->risk->riskAddUser1form($_POST['risk_id'], $_POST['risk_input_by'], $dd);
				}
				*/

				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}

			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

	public function saveRiskDataUnder()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					//'risk_status' => 3,
					'risk_code' => $code,
					'risk_input_by' => $_POST['risk_input_by'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
				
				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{
					if($_POST['risk_status'] == 3){	
						$res = $this->risk->updateRiskracUnder($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
					}else if($_POST['risk_status'] > 3 && $_POST['risk_status'] < 6){	
						$res = $this->risk->updateRiskracUnder1($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
					}else if($_POST['risk_status'] > 5 && $_POST['risk_status'] < 10){	
						$res = $this->risk->updateRiskracUnder2($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
					}else{
						$res = $this->risk->updateRiskracUnder3($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $control, $objective, $data['session']['username']);
					}
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				
				/*
				//tadinya library aja yg di masukin add user
				if (isset($_POST['add_user_flag']) && $_POST['add_user_flag'] == 'yes') {
					$dd = implode('-', array_reverse( explode('-', $_POST['add_user_date_changed']) ));
					$res = $this->risk->riskAddUser1form($_POST['risk_id'], $_POST['add_user_username'], $dd);
				}else{
					$dd = date("Y-m-d");
					$res = $this->risk->riskAddUser1form($_POST['risk_id'], $_POST['risk_input_by'], $dd);
				}
				*/

				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}

			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function saveRiskData()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}
				
				$res = $this->risk->updateRisk($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $data['session']['username']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

	public function saveRiskDatarac()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
				
				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);
				

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->updateRiskracsave($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}

			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

	public function saveRiskDatachanges($user)
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{
				
				$res = $this->risk->updateRisksave($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'],$user);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}

			}

			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function verifySetAsPrimary($risk_input_by=null) {
		 
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					'risk_code' => $code,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);

				$risksuget = array(
					'suggetprimary' => $_POST['suggetprimary'],
					'suggetchange' => $_POST['suggetchange']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{
					
				// update t_risk ke t_risk change 
				
				//echo "<pre>";print_r($this->input->post());exit;
				
				$data_t_risk = $this->risk->get_t_risk($_POST['risk_id']);
				
				// end update t_risk ke t_risk change 
					 
				$res = $this->risk->updateRisk2($_POST['risk_id'], $_POST['risk_library_id'], $_POST['suggested_risk_treatment'], $_POST['risk_input_by_change'], $code, $risk, $risksuget, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				//$res = $this->risk->riskSwitchPrimary($_POST['risk_id']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
				
				//echo update t_risk_change;
				
				$this->risk->update_t_risk_change($data_t_risk,$_POST['risk_id'],$_POST['risk_library_id'],$this->input->post('risk_input_by_change'));
				
				// endupdate t_risk_change
				
				
			}

			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function viewRisk($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;

			//cek triskchange ada apa nggak
			$cek_change = $this->risk->cek_change($rid);

				

			$risk = $this->risk->getRiskValidate('viewMyRisk', $rid, $cred);

		/*	
			if($cek_change){
				$risk = $this->risk->getRiskValidate('viewRiskByRacChange', $rid, $cred);

			}else{
				$risk = $this->risk->getRiskValidate('viewRiskByRac', $rid, $cred);

			}
		*/

			$risk_user = $this->risk->getRiskUser($rid);
			$data['risk_user'] = $risk_user;

			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_register_view', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function viewRiskOR($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;

			//cek triskchange ada apa nggak
			$cek_change = $this->risk->cek_change($rid);

				

			$risk = $this->risk->getRiskValidate('viewMyRiskOR', $rid, $cred);

		/*	
			if($cek_change){
				$risk = $this->risk->getRiskValidate('viewRiskByRacChange', $rid, $cred);

			}else{
				$risk = $this->risk->getRiskValidate('viewRiskByRac', $rid, $cred);

			}
		*/

			$risk_user = $this->risk->getRiskUser($rid);
			$data['risk_user'] = $risk_user;

			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_register_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function getTreatmentList() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rt_1 = $filter_rt_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rt_1']) && isset($_POST['filter_rt_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];

			$filter_rt_1 = $_POST['filter_rt_1'];
			$filter_rt_2 = $_POST['filter_rt_2'];

			$this->load->library('session');

			$_SESSION['filbyrisktr'] = $filter_by;
			$_SESSION['filvalrisktr'] = $filter_value;
			$_SESSION['filter_rt_1'] = $filter_rt_1;
			$_SESSION['filter_rt_2'] = $filter_rt_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		
		if (isset($_POST['risk_cat']) && $_POST['risk_cat'] != '') {
			$defFilter['risk_cat'] = $_POST['risk_cat'];
		}
			if(isset($_SESSION['filbyrisktr']) || isset($_SESSION['filvalrisktr'])){
				$data = $this->risk->getDataMode('racTreatmentList_n', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisktr'], $_SESSION['filvalrisktr']);
			}else{
				$data = $this->risk->getDataMode('racTreatmentList', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function riskTreatmentForm($rid=false,$user) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/risktreatmentverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "RiskVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;				
				$data['user'] = $user;
			}

			
			$this->load->model('risk/mriskregister');
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_treatment_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function loadTreatmentChange($rid,$user) 
	{
		if ($rid && is_numeric($rid)) {
			$this->load->model('risk/risk');

			$data = $this->risk->getRiskChangeById($rid,$user);
			if (!$data) {
				$data = $this->risk->getRiskById($rid);
			}
			echo json_encode($data);
		}
	}

//ini untuk verify risk owner ngambil triskchange
	public function loadTreatmentOwn2($rid) 
	{
		if ($rid && is_numeric($rid)) {
			$this->load->model('risk/risk');

			$data = $this->risk->getRiskOwnById2($rid);
			if (!$data) {
				$data = $this->risk->getRiskOwnById2($rid);
			}
			echo json_encode($data);
		}
	}

	public function loadSubmitTreatment($rid) 
	{
		if ($rid && is_numeric($rid)) {
			$this->load->model('risk/risk');

			$data = $this->risk->getSubmitTreatmentById($rid);
			if (!$data) {
				$data = $this->risk->getSubmitTreatmentById($rid);
			}
			echo json_encode($data);
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function treatmentSetAsPrimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
				$risk_update = array(
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'risk_owner' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact']
 
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
				
				// update t_risk ke t_risk change 

				//echo "<pre>";print_r($this->input->post());exit;

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$data_t_risk = $this->risk->get_t_risk($_POST['risk_id']);

				// end update t_risk ke t_risk change 

				
				$res = $this->risk->riskChangeUpdate($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				//$res = $this->risk->riskSwitchPrimary($_POST['risk_id']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
				
				//echo update t_risk_change;
				
				$this->risk->update_t_risk_own($data_t_risk,$_POST['risk_id'] );
				
				// endupdate t_risk_change
			}
				
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			
			
			
			echo json_encode($resp);
		}
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function treatmentVerify()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
				$risk_update = array(
					'risk_status' => 6
					/*
					'risk_event' => $_POST['risk_event2'],
					'risk_description' => $_POST['risk_description'],
					
					'risk_level' => $_POST['risk_level'],
					'risk_impact_level' => $_POST['risk_impact_level_value'],
					'risk_likelihood_key' => $_POST['risk_likelihood_value'],
					'suggested_risk_treatment' => $_POST['treatment_v'],
					
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'] 
					*/
				);

				
				$res = $this->risk->updateRisk($_POST['risk_id'], false, $risk_update, false, false, false, $data['session']['username']);
				
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				//$res = $this->risk->actionPlanSetToDraft($_POST['risk_id']);
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function treatmentVerify2()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
			if($_POST['suggested_risk_treatment'] == 'ACCEPT'){
				$risk_update = array(
					'risk_status' => 20,
					//'risk_event' => $_POST['risk_event'],
					//'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'risk_owner' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact']					
				);
			}else{
				$risk_update = array(
					'risk_status' => 6,
					//'risk_event' => $_POST['risk_event'],
					//'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'risk_owner' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact']					
				);
			}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
				$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->updateRiskverify($_POST['risk_id'], $_POST['suggested_risk_treatment'], false, $risk_update, false, $actplan, $control, $objective, $data['session']['username']);
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				//$res = $this->risk->actionPlanSetToDraft($_POST['risk_id']);
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

	public function treatmentVerifyPrimary(){
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data

				if($_POST['risk_suggested'] == 'ACCEPT'){
				$risk_update = array(
					'risk_status' => 20,
					//'risk_event' => $_POST['risk_event'],
					//'risk_description' => $_POST['risk_description'],
						//'risk_level' => $_POST['risk_level_id'],
						//'risk_impact_level' => $_POST['risk_impact_level_id'],
						//'risk_likelihood_key' => $_POST['risk_likelihood_id'],
						//'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
						'risk_owner' => $_POST['risk_division']
						//'risk_cause' => $_POST['risk_cause'],
						//'risk_impact' => $_POST['risk_impact']					
				);
				}else{

					$risk_update = array(
					'risk_status' => 6,
					//'risk_event' => $_POST['risk_event'],
					//'risk_description' => $_POST['risk_description'],
						//'risk_level' => $_POST['risk_level_id'],
						//'risk_impact_level' => $_POST['risk_impact_level_id'],
						//'risk_likelihood_key' => $_POST['risk_likelihood_id'],
						//'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
						//'risk_cause' => $_POST['risk_cause'],
						//'risk_impact' => $_POST['risk_impact'],
						'risk_owner' => $_POST['risk_own'],
						//'risk_division' => $_POST['risk_division']					
				);

				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}

				$objective = array();
				foreach ($_POST['objective'] as $v) {
					$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->updateRiskverifyPrimary($_POST['risk_id'], $_POST['risk_suggested'], false, $risk_update, false, $actplan, $control, $objective, $data['session']['username']);
				//$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				//$res = $this->risk->actionPlanSetToDraft($_POST['risk_id']);
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}


	
	public function treatmentVerifyChanges()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
				$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}
				
				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->riskChangeUpdate($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $data['session']['username']);
				$res = $this->risk->riskSwitchPrimary($_POST['risk_id']);
				
				if($_POST['suggested_risk_treatment']=='ACCEPT'){
					$risk_update = array(
						'risk_status' => 10
					);
				}else{
					$risk_update = array(
						'risk_status' => 6
					);
				}
				

				$res = $this->risk->updateRisk($_POST['risk_id'], $_POST['suggested_risk_treatment'], false, $risk_update, false, false, false, $data['session']['username']);
				$res = $this->risk->riskDeleteChange($_POST['risk_id']);
				$res = $this->risk->actionPlanSetToDraft($_POST['risk_id']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function treatmentSave($username)
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
				$risk_update = array(
					'risk_division' => $_POST['risk_division'],
					'risk_owner' => $_POST['risk_division'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
				$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->riskChangeUpdate1ajah($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $username);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function treatmentSaveprimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// build data
				$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_division' => $_POST['risk_division'],
					'risk_owner' => $_POST['risk_division']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
				$objective[] = $v;
				}

				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->riskChangeUpdate1ajah($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				
				$res = $this->risk->updateRisk_primary($_POST['risk_id'], $_POST['suggested_risk_treatment'], false, $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);

				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function getActionPlan() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rap_1 = $filter_rap_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		    if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rap_1']) && isset($_POST['filter_rap_2'])) {
		    $this->load->library('session');
			$con1 = strtolower('continuous');
			$con2 = strtoupper('continuous');
			$con3 = ucwords("continuous");
			if($_POST['filter_by'] == 'due_date' && $_POST['filter_value'] == $con1 || $_POST['filter_value'] == $con2 || $_POST['filter_value'] == $con3){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', '00-00-0000') ));
				$filter_rap_1 = $_POST['filter_rap_1'];
            	$filter_rap_2 = $_POST['filter_rap_2'];
			}else if($_POST['filter_by'] == 'due_date'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
				$filter_rap_1 = $_POST['filter_rap_1'];
            	$filter_rap_2 = $_POST['filter_rap_2'];
			}else{
            	$filter_by = $_POST['filter_by'];
            	$filter_value = $_POST['filter_value'];
            	$filter_rap_1 = $_POST['filter_rap_1'];
            	$filter_rap_2 = $_POST['filter_rap_2'];
			}

			$_SESSION['filbyacp'] = $filter_by;
            $_SESSION['filvalacp'] = $filter_value;
            $_SESSION['filter_rap_1'] = $filter_rap_1;
            $_SESSION['filter_rap_2'] = $filter_rap_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);

		    if(isset($_SESSION['filbyacp']) || isset($_SESSION['filvalacp'])){
               $data = $this->risk->getDataMode('racActionPlan_n', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyacp'], $_SESSION['filvalacp']);
            }else{
                $data = $this->risk->getDataMode('racActionPlan', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
            }
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function actionPlanForm($rid=false, $aps=false) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRac', $rid, $aps, $cred); 
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();


			//cek ini dari rollforward bukan
			$cek_library_id = $this->risk->cekLibraryId($rid, $aps);

			$cek_risk_sebelumnya = $this->risk->cekLibraryBefore($cek_library_id['risk_library_id']);

			if($cek_library_id['risk_input_by'] == $cek_risk_sebelumnya['risk_input_by']){
				$data['status_berkala'] = true;
			}else{
				$data['status_berkala'] = false;
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_plan_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function actionPlanForm_under($rid=false) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_un', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();


			//cek ini dari rollforward bukan
			//$cek_library_id = $this->risk->cekLibraryId($rid);

			//$cek_risk_sebelumnya = $this->risk->cekLibraryBefore($cek_library_id['risk_library_id']);

			//if($cek_library_id['risk_input_by'] == $cek_risk_sebelumnya['risk_input_by']){
			//	$data['status_berkala'] = true;
			//}else{
			//	$data['status_berkala'] = false;
			//}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_plan_under', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function actionPlanView($rid=false) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = "";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getActionPlanById($rid);
			$data['action_plan'] = $risk;
			$risk_data = $this->risk->getRiskById($risk['risk_id']);
			$data['risk'] = $risk_data;
			
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_plan_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function actionSetAsPrimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraft2($_POST['action_id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
	//ubah
	public function actionVerify()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			
				//$dd = implode('-', array_reverse( explode('-', $_POST['due_date_p']) ));
				$risk = array(
					'action_plan_status' => 4
					//'action_plan' => $_POST['action_plan_p'],
					//'due_date' => $dd,
					//'division' => $_POST['division_p']
				);


			
			$this->load->model('risk/risk');


			//$cek_changerequest_action = $this->risk->cek_changerequest_action($_POST['action_id']);

			$res = $this->risk->actionPlanVerify($_POST['action_id'], $risk_id, $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
		

			echo json_encode($resp);
		}
	}

	public function actionVerify1form()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;

		if(empty($_POST['status'])){
			$status = false;
		}else{
			$status = $_POST['status'];
		}
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			if($_POST['due_date'] != '00-00-0000'){
				$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
				$risk = array(
					'action_plan_status' => 4,
					'action_plan' => $_POST['action_plan'],
					'due_date' => $dd,
					'division' => $_POST['division'],
					'status' => $status
				);
			}else{
				$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
				$risk = array(
					'action_plan_status' => 7,
					'action_plan' => $_POST['action_plan'],
					'due_date' => $dd,
					'division' => $_POST['division'],
					'status' => $status
				);
			}
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanVerify1form($_POST['id'], $_POST['risk_id'], $_POST['due_date'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
	
	public function actionSave()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraft_rac($_POST['action_id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionSaveVery()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveVerify_rac($_POST['action_id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionChangeDate() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'due_date' => $dd,
				'action_plan_status' => $_POST['action_stat']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanChngeDuedate($_POST['action_id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionSave_cr()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraft_cr($_POST['id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionVerify_cr()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
				$risk = array(
					'id' =>  $_POST['id_c'],
					'action_plan' => $_POST['action_plan_c'],
					'due_date' => $_POST['due_date_c'],
					'division' => $_POST['division_c']
				);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanVerify_cr($_POST['id'], $_POST['risk_id'], $_POST['due_date_c'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionplan_exeverify_cr(){
		if (
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$rd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
			$risk = array(
				'id' => $_POST['id'],
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'execution_status' => $_POST['execution_status'],
				'execution_explain' => $_POST['execution_explain'],
				'execution_evidence' => $_POST['execution_evidence'],
				'execution_reason' => $_POST['execution_reason'],
				'revised_date' => $rd,
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanExeVerify_cr($_POST['action_id'], $risk, $data['session']['username']);
			//$res = $this->risk->actionPlanSubmit($_POST['action_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionplan_exe_priorverify_cr(){
		if (
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$rd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
			$risk = array(
				'id' => $_POST['id'],
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'execution_status' => $_POST['execution_status'],
				'execution_explain' => $_POST['execution_explain'],
				'execution_evidence' => $_POST['execution_evidence'],
				'execution_reason' => $_POST['execution_reason'],
				'revised_date' => $rd,
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanExePriorVerify_cr($_POST['action_id'], $risk, $data['session']['username']);
			//$res = $this->risk->actionPlanSubmit($_POST['action_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
// ubah
	public function actionSaveprimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraftprimary($_POST['id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
//ubah mainten
	public function actionSaveprimary2()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'periode_id' => $_POST['action_periode'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraftprimary2($_POST['id'], $_POST['risk_id'], $risk, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
	
	public function getActionPlanExec() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$con1 = strtolower('continuous');
			$con2 = strtoupper('continuous');
			$con3 = ucwords("continuous");
			if($_POST['filter_by'] == 'due_date' && $_POST['filter_value'] == $con1 || $_POST['filter_value'] == $con2 || $_POST['filter_value'] == $con3){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', '00-00-0000') ));
			}else if ($_POST['filter_value'] == 'due_date'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racActionPlanExec', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getActionPlanExec_adt() {
		$sess = $this->loadDefaultAppConfig();
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
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racActionPlanExec_adt', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getActionPlanExec_prior() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$con1 = strtolower('continuous');
			$con2 = strtoupper('continuous');
			$con3 = ucwords("continuous");
			if($_POST['filter_by'] == 'due_date' && $_POST['filter_value'] == $con1 || $_POST['filter_value'] == $con2 || $_POST['filter_value'] == $con3){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', '00-00-0000') ));
			}else if($_POST['filter_by'] == 'due_date'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id'],
			//'periodid' => $_POST['periodeid']
		);
		  
		$data = $this->risk->getDataMode('racActionPlanExec_prior', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getActionPlanExec_now() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$con1 = strtolower('continuous');
			$con2 = strtoupper('continuous');
			$con3 = ucwords("continuous");
			if($_POST['filter_by'] == 'due_date' && $_POST['filter_value'] == $con1 || $_POST['filter_value'] == $con2 || $_POST['filter_value'] == $con3){
				$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', '00-00-0000') ));
			}else{
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id'],
			//'periodid' => $_POST['periodeid']
		);
		  
		$data = $this->risk->getDataMode('racActionPlanExec_now', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function actionPlanExecForm($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRac', $rid, $aps, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_exec_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function actionPlanExecFormNow($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify_now.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRac', $rid, $aps, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_exec_verify_now', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function actionPlanExecFormPrior($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify_prior.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();

			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRacPrior', $rid,$aps,$cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_exec_verify_prior', $data); 
			$this->load->view('main/footer', $data);
		}
	}

		public function actionPlanExecFormPriorShow($rid=false,$aps=false,$aps1=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify_prior.js"></script>
			<script src="assets/scripts/dashboard/main_rac_prior_ec.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();Dashboard.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();

			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRacPrior', $rid,$aps,$aps1,$cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header_form', $data);
			$this->load->view('risk/action_exec_verify_prior_form', $data); 
			$this->load->view('main/footer_form', $data);
		}
	}


	public function actionPlanExecFormShow($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify.js"></script>
			<script src="assets/scripts/dashboard/main_rac.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();Dashboard.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();

			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRac', $rid,$aps,$cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header_form', $data);
			$this->load->view('risk/action_exec_verify_form', $data); 
			$this->load->view('main/footer_form', $data);
		}
	}
  
	public function FormactionPlanExec($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRac', $rid, $aps, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/form_action_exec', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function FormactionPlanExec_un($rid=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_un', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/form_action_exec', $data);
			$this->load->view('main/footer', $data);
		}
	}


	public function FormactionPlanExecPrior($rid=false,$aps=false,$view=null) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getApValidate('viewActionByRacPrior', $rid, $aps, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/form_action_exec', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function actionExecVerify_yes()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
				$res = $this->risk->execComplete($_POST['id'], $risk, $data['session']['username']);
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'review_status' => $_POST['review_status']
				);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
				$res = $this->risk->execOngoing($_POST['id'], $risk, $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd,
					'review_status' => $_POST['review_status']
				);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
				$res = $this->risk->execExtend($_POST['id'], $risk, $data['session']['username']);
			}
			

			$r_id = $this->input->post('r_id');
			$risk_impact = $this->input->post('risk_impact_level_id');
			$risk_likelihood = $this->input->post('risk_likelihood_id');
			$risk_level = $this->input->post('risk_level_id');

			$level = array();
			foreach ($r_id AS $key => $val) {
			$level[] = array(
					'risk_id' => $_POST['r_id'][$key],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_id'][$key],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_id'][$key],
					'risk_level_after_mitigation' => $_POST['risk_level_id'][$key]
				);
			}

			$this->db->update_batch('t_risk', $level, 'risk_id');
			
			// ----------- end level update
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionExecVerify()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execComplete($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'review_status' => $_POST['review_status']
				);

				$res = $this->risk->execOngoing($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd,
					'review_status' => $_POST['review_status']
				);
				$res = $this->risk->execExtend($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
			}
			

			$r_id = $this->input->post('r_id');
			$risk_impact = $this->input->post('risk_impact_level_after_mitigation');
			$risk_likelihood = $this->input->post('risk_likelihood_key_after_mitigation');
			$risk_level = $this->input->post('risk_level_after_mitigation');

			$level = array();
			foreach ($r_id AS $key => $val) {
			$level[] = array(
					'risk_id' => $_POST['r_id'][$key],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_after_mitigation'][$key],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_key_after_mitigation'][$key],
					'risk_level_after_mitigation' => $_POST['risk_level_after_mitigation'][$key]
				);
			}

			//$this->risk->updateKRI_Risk_level($_POST['id'], $level);

			/*$level = array(
						array(
							'risk_id' => '746',
							'risk_impact_level_after_mitigation' => 'LOW',
							'risk_likelihood_key_after_mitigation' => 'LOW',
							'risk_level_after_mitigation' => 'LOW'
						),
						array(
							'risk_id' => '824',
							'risk_impact_level_after_mitigation' => 'MEDIUM',
							'risk_likelihood_key_after_mitigation' => 'MEDIUM',
							'risk_level_after_mitigation' => 'MEDIUM'
						),						
						array(
							'risk_id' => '893',
							'risk_impact_level_after_mitigation' => 'HIGH',
							'risk_likelihood_key_after_mitigation' => 'HIGH',
							'risk_level_after_mitigation' => 'HIGH'
						)
				);*/

			$this->db->update_batch('t_risk', $level, 'risk_id');
			
			// ----------- end level update
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionExecVerifyPrior_yes()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);

				$res = $this->risk->execCompletePrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
				
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'review_status' => $_POST['review_status']
				);
				$res = $this->risk->execOngoingPrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd,
					'review_status' => $_POST['review_status']
				);
				$res = $this->risk->execExtendPrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
			}
			

			$r_id = $this->input->post('r_id');
			$risk_impact = $this->input->post('risk_impact_level_id');
			$risk_likelihood = $this->input->post('risk_likelihood_id');
			$risk_level = $this->input->post('risk_level_id');

			$level = array();
			foreach ($r_id AS $key => $val) {
			$level[] = array(
					'risk_id' => $_POST['r_id'][$key],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_id'][$key],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_id'][$key],
					'risk_level_after_mitigation' => $_POST['risk_level_id'][$key]
				);
			}

			$this->db->update_batch('t_risk', $level, 'risk_id');
			
			// ----------- end level update
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function actionExecVerifyPrior()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execCompletePrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'review_status' => $_POST['review_status']
				);

				$res = $this->risk->execOngoingPrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd,
					'review_status' => $_POST['review_status']
				);
				
				$res = $this->risk->execExtendPrior($_POST['id'], $risk, $data['session']['username']);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
			}
			
			// ----------- level update wawan

			$r_id = $this->input->post('r_id');
			$risk_impact = $this->input->post('risk_impact_level_after_mitigation');
			$risk_likelihood = $this->input->post('risk_likelihood_key_after_mitigation');
			$risk_level = $this->input->post('risk_level_after_mitigation');

			$level = array();
			foreach ($r_id AS $key => $val) {
			$level[] = array(
					'risk_id' => $_POST['r_id'][$key],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_after_mitigation'][$key],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_key_after_mitigation'][$key],
					'risk_level_after_mitigation' => $_POST['risk_level_after_mitigation'][$key]
				);
			}

			$this->db->update_batch('t_risk', $level, 'risk_id');
			
			//$this->risk->updateKRI_Risk_level_prior($_POST['id'], $_POST['risk_id'], $this->input->post());
			
			// ----------- end level update
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
//ubah under
	public function actionExecVerifyunder()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execComplete($_POST['id'], $risk, $data['session']['username']);
				//$res = $this->risk->execUpdateRiskStatus($_POST['risk_id'], $data['session']['username']);
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execOngoing($_POST['id'], $risk, $data['session']['username']);
				//$res = $this->risk->execUpdateRiskStatus($_POST['risk_id'], $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
				$res = $this->risk->execExtend($_POST['id'], $risk, $data['session']['username']);
			}
			
			// ----------- level update wawan
			
			$this->risk->updateKRI_Risk_level($_POST['risk_id'],$this->input->post());
			
			// ----------- end level update
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}

	public function getKri() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rm_1 = $filter_rm_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rm_1']) && isset($_POST['filter_rm_2'])) {
			$this->load->library('session');

			if($_POST['filter_by'] == 'timing_pelaporan'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
				$filter_rm_1 = $_POST['filter_rm_1'];
				$filter_rm_2 = $_POST['filter_rm_2'];


				$_SESSION['filbyrisktr'] = $filter_by;
				$_SESSION['filvalrisktr'] = $filter_value;
				$_SESSION['filter_rm_1'] = $filter_rm_1;
				$_SESSION['filter_rm_2'] = $filter_rm_2;
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];

				$filter_rm_1 = $_POST['filter_rm_1'];
				$filter_rm_2 = $_POST['filter_rm_2'];


				$_SESSION['filbyrisktr'] = $filter_by;
				$_SESSION['filvalrisktr'] = $filter_value;
				$_SESSION['filter_rm_1'] = $filter_rm_1;
				$_SESSION['filter_rm_2'] = $filter_rm_2;
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);

		if(isset($_SESSION['filbyrisktr']) || isset($_SESSION['filvalrisktr'])){
				$data = $this->risk->getDataMode('racKri_n', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisktr'], $_SESSION['filvalrisktr']);
			}else{
				$data = $this->risk->getDataMode('racKri', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getKri_non() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rnm_1 = $filter_rnm_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rnm_1']) && isset($_POST['filter_rnm_2'])) {
			$this->load->library('session');

			if($_POST['filter_by'] == 'timing_pelaporan'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
				$filter_rnm_1 = $_POST['filter_rnm_1'];
				$filter_rnm_2 = $_POST['filter_rnm_2'];


				$_SESSION['filbyrisktr'] = $filter_by;
				$_SESSION['filvalrisktr'] = $filter_value;
				$_SESSION['filter_rnm_1'] = $filter_rnm_1;
				$_SESSION['filter_rnm_2'] = $filter_rnm_2;
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];

				$filter_rnm_1 = $_POST['filter_rnm_1'];
				$filter_rnm_2 = $_POST['filter_rnm_2'];


				$_SESSION['filbyrisktr'] = $filter_by;
				$_SESSION['filvalrisktr'] = $filter_value;
				$_SESSION['filter_rnm_1'] = $filter_rnm_1;
				$_SESSION['filter_rnm_2'] = $filter_rnm_2;
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);

		if(isset($_SESSION['filbyrisktr']) || isset($_SESSION['filvalrisktr'])){
				$data = $this->risk->getDataMode('racKri_non_n', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisktr'], $_SESSION['filvalrisktr']);
			}else{
				$data = $this->risk->getDataMode('racKri_non', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
			}
		
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getKriPrior() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			if($_POST['filter_by'] == 'timing_pelaporan'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racKri_prior', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getKriPrior_non() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			if($_POST['filter_by'] == 'timing_pelaporan'){
				$filter_by = $_POST['filter_by'];
				$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}else{
				$filter_by = $_POST['filter_by'];
				$filter_value = $_POST['filter_value'];
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racKri_prior_non', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function viewKri($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('risk/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);
			
			

			if ($kri) {
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 3) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify.js"></script>
					';
					
					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					$data['verifyRac'] = true;
					$view = 'risk/kri_form_rac';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'N') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no.js"></script>
					<script src="assets/scripts/risk/krientry.js"></script>
					<script src="assets/scripts/risk/krimodify_verify.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_no';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'Y') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no.js"></script>
					<script src="assets/scripts/risk/krientry.js"></script>
					<script src="assets/scripts/risk/krimodify_verify.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_yes';
				}else {
					$view = 'risk/kri_view';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
	
	public function switchTo($role) {
		$cur_sess = $this->session->credential;
		if ($cur_sess['role_status'] != ' ') {
			$this->load->model('user/role');
			$r = false;
			if ($role == 'pic') {
				$r = $this->role->getDataById(5);
			}
			if ($role == 'head') {
				$r = $this->role->getDataById(4);
			}
			if ($role == 'rac') {
				$r = $this->role->getDataById(2);
			}
			if ($role == 'user') {
				$r = $this->role->getDataById(3);
			}
			if ($role == 'cf') {
				$r = $this->role->getDataById(7);
			}
			if ($role == 'coo') {
				$r = $this->role->getDataById(8);
			}
			if ($role == 'ceo') {
				$r = $this->role->getDataById(6);
			}
			
			if ($r) {
				$cur_sess['role_id'] = $r['role_id'];
				$cur_sess['role_name'] = $r['role_name'];
			}
			$this->session->set_userdata('credential', $cur_sess);
		}
		redirect('main');
	}

	public function MyCFOswitchTo($role) {
		$cur_sess = $this->session->credential;
		if ($cur_sess['role_status'] != ' ') {
			$this->load->model('user/role');
			$r = false;
			if ($role == 'mycfo') {
				$r = $this->role->getDataById(9);
			}
			
			if ($r) {
				$cur_sess['role_id'] = $r['role_id'];
				$cur_sess['role_name'] = $r['role_name'];
			}
			$this->session->set_userdata('credential', $cur_sess);
		}
		redirect('main/maindireksicfo');
	}

	public function RCFOswitchTo($role) {
		$cur_sess = $this->session->credential;
		if ($cur_sess['role_status'] != ' ') {
			$this->load->model('user/role');
			$r = false;
			if ($role == 'cf') {
				$r = $this->role->getDataById(7);
			}
			
			if ($r) {
				$cur_sess['role_id'] = $r['role_id'];
				$cur_sess['role_name'] = $r['role_name'];
			}
			$this->session->set_userdata('credential', $cur_sess);
		}
		redirect('main/maindireksirac');
	}
	
	public function getChangeRequest() {
		$sess = $this->loadDefaultAppConfig();
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
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('changesRac', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function ChangeRequestView($risk_id)
	{
		$session_data = $this->session->credential;
		if (!empty($risk_id) && is_numeric($risk_id)) {
			$this->load->model('risk/risk');
			$res = $this->risk->getChangeByIdNoRef($risk_id, false);	
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '
			';
			
			if ($res['cr_type'] == 'KRI Form')  {
				$kri = $this->risk->getKriById($res['risk_cause']);
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				$data['change'] = $res;
				
				$data['pageLevelScripts'] = '';
				$data['pageLevelScriptsInit'] = '';
				$v = 'risk/change_request_kri';
			} else {
				$data['pageLevelScripts'] = '
				<script src="assets/scripts/risk/cr_riskregister_view.js"></script>
				';
				$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
				$v = 'risk/change_request_view';
			}
			
			$data['change_id'] = $risk_id;
			$data['change_type'] = $res['cr_type'];
			$data['change_code'] = $res['cr_code'];
			$data['change_status'] = $res['cr_status'];
			
			$this->load->view('main/header', $data);
			$this->load->view($v, $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function ChangeRequestVerify($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$change = $this->risk->getChangeById($rid, false);

			//ini untuk cek status risk pada saat change request
			$status = $this->risk->getRiskById($change['risk_id']);
			
			$risk = $this->risk->getRiskValidate('viewMyRisk', $change['risk_id'], $cred);

			//untuk ngambil status action plan nya
			$status_action = $this->risk->getActionPlanStatus($change['risk_id']);

			if ($change) {
				if ($change['cr_status']*1 == 0) {
					if ($change['cr_type'] == 'Risk Form') {
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
						<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						<script src="assets/toogle/doc/script.js"></script>
						<script src="assets/toogle/js/bootstrap-toggle.js"></script>
						
						<script src="assets/scripts/risk/cr_riskregister_verify.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "ChangeRequest.init();";
						$data['valid_entry'] = true;
						$data['change_id'] = $rid;
						$data['risk_id'] = $change['risk_id'];
						$data['change_type'] = $change['cr_type'];
						$data['change_code'] = $change['cr_code'];

						//ambil status nya untuk change request
						$data['status'] = $status;
						$data['status_action'] = $status_action;
						$data['risk'] = $risk;
						
						$this->load->model('risk/mriskregister');
						$data['category'] = $this->mriskregister->getRiskCategory();
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'risk/change_request_riskreg_verify';
					}else if ($change['cr_type'] == 'Risk Form Library') {
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
						<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						<script src="assets/toogle/doc/script.js"></script>
						<script src="assets/toogle/js/bootstrap-toggle.js"></script>
						
						<script src="assets/scripts/risk/cr_riskregister_verify.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "ChangeRequest.init();";
						$data['valid_entry'] = true;
						$data['change_id'] = $rid;
						$data['risk_id'] = $change['risk_id'];
						$data['change_type'] = $change['cr_type'];
						$data['change_code'] = $change['cr_code'];

						//ambil status nya untuk change request
						$data['status'] = $status;
						$data['status_action'] = $status_action;
						$data['risk'] = $risk;
						
						$this->load->model('risk/mriskregister');
						$data['category'] = $this->mriskregister->getRiskCategory();
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'risk/change_request_riskregch_verify';
					}else if ($change['cr_type'] == 'Risk Owner Form') {
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
						<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						<script src="assets/toogle/doc/script.js"></script>
						<script src="assets/toogle/js/bootstrap-toggle.js"></script>
						
						<script src="assets/scripts/risk/cr_riskregister_verify.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "ChangeRequest.init();";
						$data['valid_entry'] = true;
						$data['change_id'] = $rid;
						$data['risk_id'] = $change['risk_id'];
						$data['change_type'] = $change['cr_type'];
						$data['change_code'] = $change['cr_code'];

						//ambil status nya untuk change request
						$data['status'] = $status;
						$data['status_action'] = $status_action;
						$data['risk'] = $risk;
						
						$this->load->model('risk/mriskregister');
						$data['category'] = $this->mriskregister->getRiskCategory();
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'risk/change_request_own_verify';
					} else {
						$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
						';
						
						$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					<script src="assets/scripts/risk/cr_riskregister_kri_verify.js"></script>
						';
						
						$kri = $this->risk->getChangeRequestKriById($change['id'], $change['risk_cause']);
						$data['kri'] = $kri;
						$risk = $this->risk->getRiskById($change['risk_id']);
						$data['risk'] = $risk;
						
						$data['change'] = $change;
						$data['verify'] = true;
						
						$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
						$view = 'risk/change_request_kri_rac';
					}
				} else {
					if ($change['cr_type'] != 'KRI Form') {
						$data['pageLevelScripts'] = '<script src="assets/scripts/risk/cr_riskregister_view.js"></script>';
						$data['change_id'] = $rid;
						$data['change_type'] = $change['cr_type'];
						$data['change_code'] = $change['cr_code'];
						
						$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
						
						$view = 'risk/change_request_view';
					} else {
						$kri = $this->risk->getKriById($change['risk_cause']);
						$data['kri'] = $kri;
						$risk = $this->risk->getRiskById($change['risk_id']);
						$data['risk'] = $risk;
						
						$data['change'] = $change;
						
						$data['pageLevelScripts'] = '';
						$data['pageLevelScriptsInit'] = '';
						$view = 'risk/change_request_kri_rac';
					}
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function actionSetAsPrimary_cr()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			 
			$this->load->model('risk/risk');
			
			// update t_risk ke t_risk change 
				
			//echo "<pre>";print_r($this->input->post());exit;
			
			$data_t_risk = $this->risk->get_t_risk_actionplan_cr($_POST['id']);
			
			// end update t_risk ke t_risk change
			
			$res = $this->risk->actionPlanSaveDraft2_cr($_POST['id'], $_POST['risk_id'], $risk, $data['session']['username']);
			//$res = $this->risk->actionSwitchPrimary($_POST['id']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			//echo update t_risk_change;
				
			$this->risk->update_t_risk_actionplan_change($data_t_risk,$_POST['id']);
			
			// endupdate t_risk_change
			
			echo json_encode($resp);
		}
	}

	public function changeRequestVerifyDelete()
	{
		$resp = array();
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			
			// ini buat update t_cr_risk_change kayak nya ga perlu	
			//$res = $this->risk->changeRequestSwitchPrimary($_POST['id']);

			$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			$v_risk = true; $v_control = true; $v_action = true; $v_objective = true;
			if ($changes['cr_type'] == 'Risk Owner Form') {
				$v_risk = true; $v_control = false; $v_action = true; 
			}
			if ($changes['cr_type'] == 'Action Plan Form') {
				$v_risk = false; $v_control = false; $v_action = true;
			}
			
			$res = $this->risk->changeRequestApplyDelete($_POST['id'], $data['session']['username'], $v_risk, $v_control, $v_action, $v_objective);
			
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
		
	}
	
	public function changeRequestVerifyPrimary()
	{

		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');

			$changes = $this->risk->getChangeById_risk($_POST['id']);
			//$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// build data
				$risk_update = array(
					'risk_event' => $changes['risk_event'],
					'risk_description' => $changes['risk_description'],
					'risk_owner' => $changes['risk_division'],
					'risk_division' => $changes['risk_division'],
					'risk_cause' => $changes['risk_cause'],
					'risk_impact' => $changes['risk_impact'],
					'risk_level' => $changes['risk_level'],
					'risk_impact_level' => $changes['risk_impact_level'],
					'risk_likelihood_key' => $changes['risk_likelihood_key'],
					'suggested_risk_treatment' => $changes['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$res = $this->risk->changeRequestApplyVerify($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
		
	}

	public function cr_verifyRiskPrimary()
	{

		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');

			$changes = $this->risk->getChangeById_risk($_POST['id']);
			//$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// build data
				$risk_update = array(
					'risk_event' => $changes['risk_event'],
					'risk_description' => $changes['risk_description'],
					'risk_owner' => $changes['risk_division'],
					'risk_division' => $changes['risk_division'],
					'risk_cause' => $changes['risk_cause'],
					'risk_impact' => $changes['risk_impact'],
					'risk_level' => $changes['risk_level'],
					'risk_impact_level' => $changes['risk_impact_level'],
					'risk_likelihood_key' => $changes['risk_likelihood_key'],
					'suggested_risk_treatment' => $changes['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$res = $this->risk->crRiskPrimary($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
		
	}

	public function cr_verifyRiskChanges()
	{

		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');

			$changes = $this->risk->getChangeById_risk($_POST['id']);
			//$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// build data
				$risk_update = array(
					'risk_event' => $changes['risk_event'],
					'risk_description' => $changes['risk_description'],
					'risk_owner' => $changes['risk_division'],
					'risk_division' => $changes['risk_division'],
					'risk_cause' => $changes['risk_cause'],
					'risk_impact' => $changes['risk_impact'],
					'risk_level' => $changes['risk_level'],
					'risk_impact_level' => $changes['risk_impact_level'],
					'risk_likelihood_key' => $changes['risk_likelihood_key'],
					'suggested_risk_treatment' => $changes['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$res = $this->risk->crRiskChanges($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $changes['created_by'], $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
		
	}	
	
	public function changeRequestSwitchPrimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// build data
			$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$res = $this->risk->changeRequestSaveDraft($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			$res = $this->risk->changeRequestSwitchPrimary($_POST['id'], $_POST['suggested_risk_treatment']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
	}
	
	public function changeRequestVerifyChanges()
	{
		
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');
			$changes = $this->risk->getChangeByIdNoRef($_POST['id']);

			// build data
				$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/

			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}
			
			$v_risk = true; $v_control = true; $v_action = true;
			if ($changes['cr_type'] == 'Risk Owner Form') {
				$v_risk = true; $v_control = false; $v_action = true;
			}
			if ($changes['cr_type'] == 'Action Plan Form') {
				$v_risk = false; $v_control = false; $v_action = true;
			}
			
			//changeRequestApplyVerify($change_id, $uid, )
			$res = $this->risk->changeRequestSaveDraft($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $data['session']['username']);
			$res = $this->risk->changeRequestApplyVerify($_POST['id'], $data['session']['username'], $v_risk, $v_control, $v_action);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
	}
	
	public function changeRequestSaveDraft()
	{
		 
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');

			$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// update t_risk ke t_risk change 
				
			//echo "<pre>";print_r($this->input->post());exit;
			
			$data_t_cr_risk = $this->risk->get_t_cr_risk($_POST['id']);
			$data_t_cr_action_plan = $this->risk->get_t_cr_action_plan($_POST['id']);
			$data_t_cr_control  = $this->risk->get_t_cr_control($_POST['id']);
			//echo "<pre>";print_r($data_t_cr_action_plan);exit;
			
			// end update t_risk ke t_risk change
			
			// build data
				$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$data_risk_change =  $this->risk->getChangeById_risk($_POST['id']);

			$this->risk->insertt_cr_risk($_POST['id']);
			$res = $this->risk->changeRequestSaveDraft($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			$this->risk->updatet_cr_risk($_POST['id']);

			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			//echo update t_risk_change;
				
			//$this->risk->update_t_cr_risk($data_t_cr_risk,$_POST['id']);
			//$this->risk->update_t_cr_action_plan($data_t_cr_action_plan,$_POST['id']);
			//$this->risk->update_t_cr_control($data_t_cr_control,$_POST['id']);
			// endupdate t_risk_change
			
			echo json_encode($resp);
		}
	}

	public function changeRequestSaveDraftchanges()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('risk/risk');

			$changes = $this->risk->getChangeByIdNoRef($_POST['id']);
			
			// build data
				$risk_update = array(
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment']
				);
			
			/*if ($changes['cr_type'] == 'Action Plan Form') {
				$risk_update = false;
			}*/
			
			$impact_level = array();
			foreach($_POST['impact'] as $v) {
				$impact_level[] = $v;
			}
			
			$actplan = array();
			foreach($_POST['actplan'] as $v) {
				$actplan[] = $v;
			}
			
			$control = array();
			foreach($_POST['control'] as $v) {
				$control[] = $v;
			}

			$objective = array();
			foreach($_POST['objective'] as $v) {
				$objective[] = $v;
			}

			$res = $this->risk->changeRequestSaveDraftchanges($_POST['id'], $_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk_update, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			
			echo json_encode($resp);
		}
	}
	
	public function changeRequestVerifyKri()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		
		if (isset($_POST['change_id'])) {
			$this->load->model('risk/risk');
			// build data
			$kri = $this->risk->getKriById($_POST['kri_id']);
			$kri_warning = null;
			$report = null;
			$description = null;
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'].$value['result'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
						$report = $value['value_1'];
						$description = null;
					}
				}
			}else if ($kri['treshold_type'] == 'VALUE') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['operator'].$value['value_1'].$value['value_type'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
						$report = $value['value_1'];
						$description = $value['value_type'];
					}
				}
			}
			
			
			$risk = array(
				'change_id' => $_POST['change_id'],
				'kri_id' => $_POST['kri_id'],
				'owner_report' => $report,
				'kri_warning' => $kri_warning,
				'supporting_evidence' => $_POST['support'],
				'description' => $description
			);
			
			$impact_level = false;
			$actplan = false;
			$control = false;
			$objective = false;
			
			$uid = $data['session']['username'];
			//$res = $this->risk->changeRequestSaveDraft($_POST['change_id'], $_POST['risk_id'], $risk, $impact_level, $actplan, $control, $objective, $uid);
			$res = $this->risk->changeRequestApplyKri($risk, $uid);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
			echo json_encode($resp);
		}
	}
	
	
	public function getAllRisk_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRisk_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/risk_list', $data, true);
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=risk_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getAllRisk_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRisk_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	public function getAllRiskregister_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getUserList_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/riskregister_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=riskregister_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getAllRiskregister_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getUserList_export($data['dataget']);
		 
		$this->load->view('export/riskregister_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("riskregister_list.pdf");
	 
	}
	
	public function getAllRisktreatment_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getTreatment_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/treatment_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=treatment_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getAllRisktreatment_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getTreatment_export($data['dataget']);
		 
		$this->load->view('export/treatment_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("treatment_list.pdf");
	 
	}
	
		public function getActionplan_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getActionplan_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/actionplan_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=actionplan_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	
	public function getActionplan_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getActionplan_export($data['dataget']);
		 
		$this->load->view('export/actionplan_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("actionplan_list.pdf");
	 
	}
	
	public function getExecution_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecution_export();
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/execution_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=execution_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getExecution_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecution_export();
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRI_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRI_export();
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=kri_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	
	public function getKRI_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRI_export();
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}
	
	public function getChangereq_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getChangeReq_export($data['dataget'] );
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/changereq_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=changereq_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getChangereq_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getChangeReq_export($data['dataget']);
		 
		$this->load->view('export/changereq_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("changereq_list.pdf");
	 
	}


	public function getAllRiskPrior_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskPrior_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/risk_list_prior', $data, true);
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=risk_list_prior.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getAllRiskPrior_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskPrior_export($data['dataget']);
		 
		$this->load->view('export/risk_list_prior',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list_prior.pdf");
	 
	}

	
	private function validatePeriodeMode($mode) 
	{
		
		$periode = $this->mperiode->getCurrentPeriode();
		
		if ($mode == 'adhoc') {
			if ($periode) return false;
			else return true;
		} else if ($mode == 'periodic') {
			if ($periode) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}
	
	public function actionplan_adt() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplan_adt');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplan_adt');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/actionplan_adt');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
		
		<script src="assets/scripts/dashboard/main_rac.js"></script>
		
		';
		
		$data['pageLevelScriptsInit'] = 'Actionplan_adt.init();
		 
		';
		
		$this->load->model('admin/mperiode');
		/*
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		$data['periode'] = null;
		if ($data['valid_mode']) {
			//periode AP Exec nya
			$data['periode'] = $this->mperiode->getCurrentPeriode_exec();
			$data['periodenya'] = 1;
		}else{
			$data['periodenya'] = 0;
		}
		*/
		$data['periode'] = $this->mperiode->getCurrentPeriode_exec();
		if ($data['periode']) {
			//periode AP Exec nya
			$data['periodenya'] = 1;
		}else{
			$data['periodenya'] = 0;
		}
		
		
		$this->load->view('main/header', $data);
		$this->load->view('actionplan_adt', $data);
		$this->load->view('main/footer', $data);
	}

	public function actionplanexe_prior() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_prior');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_prior');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/actionplanexe_prior');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_rac_prior_ec.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$this->load->view('main/header', $data);
		$this->load->view('actionplanexe_prior', $data);
		$this->load->view('main/footer', $data);
	}

	public function actionplanexe_now() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_now');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_now');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/actionplanexe_now');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_rac_now_ec.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('main/header', $data);
		$this->load->view('actionplanexe_now', $data);
		$this->load->view('main/footer', $data);
	}

	public function actionplanexe_periode() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_periode');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_periode');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/actionplanexe_periode');
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
		<script src="assets/scripts/dashboard/periode_acton_plan_exe.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_action_plan_exe', $data);
		$this->load->view('main/footer', $data);
	}


	public function priorkri() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/priorkri');
		$data['engnya'] = base_url('index.php/main/mainrac/priorkri');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/priorkri');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/kri_prior.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$this->load->view('main/header', $data);
		$this->load->view('kri_prior', $data);
		$this->load->view('main/footer', $data);
	}

	public function regularkri() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
		$data['engnya'] = base_url('index.php/main/mainrac/regularkri');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/kri_regular.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('main/header', $data);
		$this->load->view('kri_regular', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function crDeleteData()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$risk_id = $_POST['id'];
			$this->load->model('Mqna');
			$res = $this->Mqna->deletecrRisk($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Change Request Not Complete';
			}
			echo json_encode($data);
		}
	}
	
	function submit_note(){
		
		$this->load->model('risk/risk');
		 
		$res = $this->risk->submit_note($this->input->post());

		if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Change Request Not Complete';
			}
			echo json_encode($data);
		 
	}

	function submit_note_own(){
		
		$this->load->model('risk/risk');
		 
		$res = $this->risk->submit_risk_own($this->input->post());

		if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Change Request Not Complete';
			}
			echo json_encode($data);
		 
	}

	function submit_note_ap(){
		
		$this->load->model('risk/risk');
		 
		$res = $this->risk->submit_risk_ap($this->input->post());

		if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Change Request Not Complete';
			}
			echo json_encode($data);
		 
	}

	function submit_risk_apex(){
		
		 
		$this->load->model('risk/risk');
		 
		$res = $this->risk->submit_risk_apex($this->input->post());

		if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Edit Not Complete';
			}
			echo json_encode($data);
		 
	}

	public function viewOwnedRisk($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			$risk = $this->risk->getRiskValidate('viewRiskByDivisionRac', $rid, $cred);
			$view = 'risk/risk_register_view';
			$data['risk_user']['nama'] = '';
			if ($risk) {
				if ($risk['risk_status']*1 > 2) {
					$data['valid_mode'] = true;
					$data['risk'] = $risk;
					
					if ($risk['risk_status']*1 == 3 && $risk['risk_treatment_owner'] != $cred['username']) {
						$data['approval'] = false;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						<script src="assets/scripts/risk/riskowned_rac.js"></script>
						';
						
						//$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('risk/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						//$view = 'risk/risk_owner_form';
						$view = 'risk/risk_register_view';
					} else if  ($risk['risk_status']*1 == 4 && $cred['role_id'] == 2) { // on approval and is div head
						$data['approval'] = true;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						<script src="assets/scripts/risk/riskowned_rac.js"></script>
						';
						
						//$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('risk/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						//$view = 'risk/risk_owner_form';
						$view = 'risk/risk_register_view';
					} else {
						$view = 'risk/risk_register_view';
					}
				}
			}
			
			
			$this->load->view('main/header', $data);
			$this->load->view($view, $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function viewActionPlan($rid = false, $aps = false) {  
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$risk = $this->risk->getActionPlanById($rid, $aps);

			if ($risk && $risk['division'] != $cred['division_id'] || $risk['division'] == $cred['division_id'] ) {
				
				$this->load->model('risk/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid, $aps);
					
					 if ($risk['action_plan_status']*1 == 2 && $cred['role_id'] == 2) { // on approval and is div head
						$data['approval'] = true;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						
						<script src="assets/scripts/risk/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form_rac';
					} else {
						$data['approval'] = true;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						
						<script src="assets/scripts/risk/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						$view = 'risk/action_plan_form_rac';
					}
					
					$this->load->view('main/header', $data);
					$this->load->view($view, $data);
					$this->load->view('main/footer', $data);
				}
			}
		}
	}

		public function viewActionPlanPrior($rid = false, $aps = false, $aps1 = null) {  
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$risk = $this->risk->getActionPlanByIdPrior($rid, $aps, $aps1);

			if ($risk && $risk['division'] != $cred['division_id'] || $risk['division'] == $cred['division_id'] ) {
				
				$this->load->model('risk/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid, $aps);
					
					 if ($risk['action_plan_status']*1 == 2 && $cred['role_id'] == 2) { // on approval and is div head
						$data['approval'] = true;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						
						<script src="assets/scripts/risk/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form_rac';
					} else {
						$data['approval'] = true;
						
						$data['pageLevelStyles'] = '
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
						';
						
						$data['pageLevelScripts'] = '
						<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
						<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
						
						<script src="assets/scripts/risk/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						$view = 'risk/action_plan_form_rac';
					}
					
					$this->load->view('main/header', $data);
					$this->load->view($view, $data);
					$this->load->view('main/footer', $data);
				}
			}
		}
	}

	public function ChangeRequestActionVerify($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionverify_cr.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_plan_request_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function ChangeRequestActionExeVerify($rid = false) {
	if ($rid && is_numeric($rid)) {
			error_reporting(0);
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify_cr.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionExecByRac_cr', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}

			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_exec_request_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function ChangeRequestActionExePriorVerify($rid = false) {
	if ($rid && is_numeric($rid)) {
			error_reporting(0);
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionexecverify_cr.js"></script>
			';
			
			$this->load->model('risk/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionExecPriorByRac_cr', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}

			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();
						
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_exec_prior_request_verify', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function ChangeRequestActionView($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/actionverify_cr.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			
			$this->load->view('main/header', $data);
			$this->load->view('risk/action_plan_request_view', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function viewOwnedKri($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];

			$kri = $this->risk->getKriById($rid);
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 0) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/krientry.js"></script>
					<script src="assets/scripts/risk/krimodify.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = 'Kri.init();KriModify.init();';

					$data['indonya'] = base_url('index.php/maini/mainrac');
					$data['engnya'] = base_url('index.php/main/mainrac');
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
					$view = 'risk/kri_modify';
				} else if ($kri['kri_status']*1 == 3 && $cred['role_id'] == 2) { // on approval and is div head
					$data['approval'] = true;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					
					<script src="assets/scripts/risk/kriform_rac.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form_rac';
				} else {
					$view = 'risk/kri_view';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
		}
	}

	public function viewKriDesignation($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];

			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] != $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
					$view = 'risk/kri_view';
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewOwnedKriRegular($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];

			$kri = $this->risk->getKriById($rid);

			//if ($kri && $kri['kri_owner'] != $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 0) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/krientry_r.js"></script>
					<script src="assets/scripts/risk/krimodify_r.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = 'Kri.init();KriModify.init();';

					$data['indonya'] = base_url('index.php/maini/mainrac');
					$data['engnya'] = base_url('index.php/main/mainrac');
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
					$view = 'risk/kri_modify';
				} else if ($kri['kri_status']*1 == 3 && $cred['role_id'] == 2) { // on approval and is div head
					$data['approval'] = true;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					
					<script src="assets/scripts/risk/kriform_rac_r.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form_rac';
				} else {
					$view = 'risk/kri_view';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			//}
		}
	}

	public function viewOwnedKriPrior($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];

			$kri = $this->risk->getKriById($rid);

			//if ($kri && $kri['kri_owner'] != $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 0) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/krientry_p.js"></script>
					<script src="assets/scripts/risk/krimodify_p.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = 'Kri.init();KriModify.init();';

					$data['indonya'] = base_url('index.php/maini/mainrac');
					$data['engnya'] = base_url('index.php/main/mainrac');
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
					$view = 'risk/kri_modify';
				} else if ($kri['kri_status']*1 == 3 && $cred['role_id'] == 2) { // on approval and is div head
					$data['approval'] = true;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					
					<script src="assets/scripts/risk/kriform_rac_p.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form_rac';
				} else {
					$view = 'risk/kri_view';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			//}
		}
	}

	public function viewKriRegular($rid = false) {
				if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('risk/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);
			
			

			if ($kri) {
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 3) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_r.js"></script>
					';
					
					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					$data['verifyRac'] = true;
					$view = 'risk/kri_form_rac';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'N') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no_r.js"></script>
					<script src="assets/scripts/risk/krientry_r.js"></script>
					<script src="assets/scripts/risk/krimodify_verify_r.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_no';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'Y') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no_r.js"></script>
					<script src="assets/scripts/risk/krientry_r.js"></script>
					<script src="assets/scripts/risk/krimodify_verify_r.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_yes';
				}else {
					$view = 'risk/kri_view_regular';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewKriPrior($rid = false) {
				if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('risk/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);
			
			

			if ($kri) {
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 3) {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_p.js"></script>
					';
					
					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					$data['verifyRac'] = true;
					$view = 'risk/kri_form_rac';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'N') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no_p.js"></script>
					<script src="assets/scripts/risk/krientry_p.js"></script>
					<script src="assets/scripts/risk/krimodify_verify_p.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_no';
				}else if ($kri['kri_status']*1 == 1 && $kri['mandatory'] == 'Y') {
					$data['approval'] = false;
					
					$data['pageLevelStyles'] = '
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
					<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
					<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
					<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
					<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
					';
					
					$data['pageLevelScripts'] = '
					<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
					<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
					<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
					<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
					<script src="assets/toogle/doc/script.js"></script>
					<script src="assets/toogle/js/bootstrap-toggle.js"></script>
					
					<script src="assets/scripts/risk/kriverify_no_p.js"></script>
					<script src="assets/scripts/risk/krientry_p.js"></script>
					<script src="assets/scripts/risk/krimodify_verify_p.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'risk/kri_form_rac_yes';
				}else {
					$view = 'risk/kri_view_prior';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewKriDesignationRegular($rid = false) {
				if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('risk/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);
			
			

			if ($kri) {
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
					$view = 'risk/kri_view_regular';
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewKriDesignationPrior($rid = false) {
				if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('risk/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac/regularkri');
			$data['engnya'] = base_url('index.php/main/mainrac/regularkri');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);
			
			

			if ($kri) {
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
					$view = 'risk/kri_view_prior';
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function getActionreview($rid) 
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
		$this->load->model('risk/risk');
		$defFilter = array();
		if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
			$defFilter['filter_library'] = trim($_POST['filter_library']);
		}
		
		$data = $this->risk->cek_actionplan('allActionReview', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $rid);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getActionreviewtab2($idap)
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
		$this->load->model('risk/risk');
		$defFilter = array();
		if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
			$defFilter['filter_library'] = trim($_POST['filter_library']);
		}
		
		$data = $this->risk->cek_actionplantab2('allActionReviewtab2', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $idap);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function updatestatement_risk_owner()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->us_risk_owner($_POST['s_risk_owner']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function updatestatement_action_plan()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->us_action_plan($_POST['s_action_plan']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function updatestatement_action_plan_exe()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->us_action_plan_exe($_POST['s_action_plan_exe']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function update_apex(){
	
		$this->load->model('risk/risk');
		
		$res = $this->risk->listriskap_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function update_apex_now(){
	
		$this->load->model('risk/risk');
		
		$res = $this->risk->listriskap_update_now($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function update_verify(){
	
		$this->load->model('risk/risk');
		
		$res = $this->risk->listriskap_verify($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function getRiskAciton($ap_id, $ap_sts) {
		$sess = $this->loadDefaultAppConfig();
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
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'ap_id' => $ap_id,
			'ap_sts' => $ap_sts
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

		$data = $this->risk->getRiskApe($defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getRiskAciton_now($ap_id, $ap_sts) {
		$sess = $this->loadDefaultAppConfig();
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
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'ap_id' => $ap_id,
			'ap_sts' => $ap_sts
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

		$data = $this->risk->getRiskApeNow($defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function ViewSubmitTreatment($rid=false,$user) 
	{
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			<script src="assets/scripts/risk/submittreatment.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "RiskVerify.init();";
			$data['indonya'] = base_url('index.php/library/submission_risk_owner');
			$data['engnya'] = base_url('index.php/libraryin/submission_risk_owner');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/submission_risk_owner');
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;				
				$data['user'] = $user;
			}

			
			$this->load->model('risk/mriskregister');
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/submit_treatment', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function getCataVLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}


		$data = $this->risk->getcatvlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataMed() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatmed($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcathigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataVHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatvhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getMayVLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaylow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayMed() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaymed($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayVHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


		public function getModVLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModMed() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodmed($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModVHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinMed() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminmed($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsVLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvlow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsLow() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}
		
		$data = $this->risk->getinslow($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsMed() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsmed($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinshigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsVHigh() 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvhigh($defFilter, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function DivisionMap(){
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/DivisionMap');
			$data['engnya'] = base_url('index.php/main/DivisionMap');	
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/DivisionMap');

		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>

		<script src="assets/scripts/risk/riskmapall.js"></script>
		';

		$data['pageLevelScriptsInit'] = "RiskMap.init();";

			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$this->load->model('risk/risk');
			$data['sumAllRisk'] = $this->risk->getSumRisk();

			$data['allCataVLow'] = $this->risk->getRiskMap_catvlow();
			$data['allCataLow'] = $this->risk->getRiskMap_catlow();
			$data['allCataMed'] = $this->risk->getRiskMap_catmed();
			$data['allCataHigh'] = $this->risk->getRiskMap_cathig();
			$data['allCataVhigh'] = $this->risk->getRiskMap_catvhig();

			$data['allMayVLow'] = $this->risk->getRiskMap_mayvlow();
			$data['allMayLow'] = $this->risk->getRiskMap_maylow();
			$data['allMayMed'] = $this->risk->getRiskMap_maymed();
			$data['allMayHigh'] = $this->risk->getRiskMap_mayhig();
			$data['allMayVhigh'] = $this->risk->getRiskMap_mayvhig();

			$data['allModVLow'] = $this->risk->getRiskMap_modvlow();
			$data['allModLow'] = $this->risk->getRiskMap_modlow();
			$data['allModMed'] = $this->risk->getRiskMap_modmed();
			$data['allModHigh'] = $this->risk->getRiskMap_modhig();
			$data['allModVhigh'] = $this->risk->getRiskMap_modvhig();

			$data['allMinVLow'] = $this->risk->getRiskMap_minvlow();
			$data['allMinLow'] = $this->risk->getRiskMap_minlow();
			$data['allMinMed'] = $this->risk->getRiskMap_minmed();
			$data['allMinHigh'] = $this->risk->getRiskMap_minhig();
			$data['allMinVhigh'] = $this->risk->getRiskMap_minvhig();

			$data['allInsiVLow'] = $this->risk->getRiskMap_insvlow();
			$data['allInsiLow'] = $this->risk->getRiskMap_inslow();
			$data['allInsiMed'] = $this->risk->getRiskMap_insmed();
			$data['allInsiHigh'] = $this->risk->getRiskMap_inshig();
			$data['allInsiVhigh'] = $this->risk->getRiskMap_insvhig();

			$this->load->view('main/header', $data);
			$this->load->view('riskmap_division', $data);
			$this->load->view('footer', $data);
	}


	public function DivisionMapUs(){
			
			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$divmap = $_POST['divisi_map'];

			$this->load->model('risk/risk');

			if($divmap=='alldiv'){
				$data['sumAllRisk'] = $this->risk->getSumRisk();
			}else{
				$data['sumAllRisk'] = $this->risk->getSumRiskDiv($divmap);
			}

			if($divmap=='alldiv'){
				
				$data['allCataVLow'] = $this->risk->getRiskMap_catvlow();
				$data['allCataLow'] = $this->risk->getRiskMap_catlow();
				$data['allCataMed'] = $this->risk->getRiskMap_catmed();
				$data['allCataHigh'] = $this->risk->getRiskMap_cathig();
				$data['allCataVhigh'] = $this->risk->getRiskMap_catvhig();

				$data['allMayVLow'] = $this->risk->getRiskMap_mayvlow();
				$data['allMayLow'] = $this->risk->getRiskMap_maylow();
				$data['allMayMed'] = $this->risk->getRiskMap_maymed();
				$data['allMayHigh'] = $this->risk->getRiskMap_mayhig();
				$data['allMayVhigh'] = $this->risk->getRiskMap_mayvhig();

				$data['allModVLow'] = $this->risk->getRiskMap_modvlow();
				$data['allModLow'] = $this->risk->getRiskMap_modlow();
				$data['allModMed'] = $this->risk->getRiskMap_modmed();
				$data['allModHigh'] = $this->risk->getRiskMap_modhig();
				$data['allModVhigh'] = $this->risk->getRiskMap_modvhig();

				$data['allMinVLow'] = $this->risk->getRiskMap_minvlow();
				$data['allMinLow'] = $this->risk->getRiskMap_minlow();
				$data['allMinMed'] = $this->risk->getRiskMap_minmed();
				$data['allMinHigh'] = $this->risk->getRiskMap_minhig();
				$data['allMinVhigh'] = $this->risk->getRiskMap_minvhig();

				$data['allInsiVLow'] = $this->risk->getRiskMap_insvlow();
				$data['allInsiLow'] = $this->risk->getRiskMap_inslow();
				$data['allInsiMed'] = $this->risk->getRiskMap_insmed();
				$data['allInsiHigh'] = $this->risk->getRiskMap_inshig();
				$data['allInsiVhigh'] = $this->risk->getRiskMap_insvhig();
			}else{
				$data['allCataVLow'] = $this->risk->getRiskMap_catvlowUs($divmap);
				$data['allCataLow'] = $this->risk->getRiskMap_catlowUs($divmap);
				$data['allCataMed'] = $this->risk->getRiskMap_catmedUs($divmap);
				$data['allCataHigh'] = $this->risk->getRiskMap_cathigUs($divmap);
				$data['allCataVhigh'] = $this->risk->getRiskMap_catvhigUs($divmap);

				$data['allMayVLow'] = $this->risk->getRiskMap_mayvlowUs($divmap);
				$data['allMayLow'] = $this->risk->getRiskMap_maylowUs($divmap);
				$data['allMayMed'] = $this->risk->getRiskMap_maymedUs($divmap);
				$data['allMayHigh'] = $this->risk->getRiskMap_mayhigUs($divmap);
				$data['allMayVhigh'] = $this->risk->getRiskMap_mayvhigUs($divmap);

				$data['allModVLow'] = $this->risk->getRiskMap_modvlowUs($divmap);
				$data['allModLow'] = $this->risk->getRiskMap_modlowUs($divmap);
				$data['allModMed'] = $this->risk->getRiskMap_modmedUs($divmap);
				$data['allModHigh'] = $this->risk->getRiskMap_modhigUs($divmap);
				$data['allModVhigh'] = $this->risk->getRiskMap_modvhigUs($divmap);

				$data['allMinVLow'] = $this->risk->getRiskMap_minvlowUs($divmap);
				$data['allMinLow'] = $this->risk->getRiskMap_minlowUs($divmap);
				$data['allMinMed'] = $this->risk->getRiskMap_minmedUs($divmap);
				$data['allMinHigh'] = $this->risk->getRiskMap_minhigUs($divmap);
				$data['allMinVhigh'] = $this->risk->getRiskMap_minvhigUs($divmap);

				$data['allInsiVLow'] = $this->risk->getRiskMap_insvlowUs($divmap);
				$data['allInsiLow'] = $this->risk->getRiskMap_inslowUs($divmap);
				$data['allInsiMed'] = $this->risk->getRiskMap_insmedUs($divmap);
				$data['allInsiHigh'] = $this->risk->getRiskMap_inshigUs($divmap);
				$data['allInsiVhigh'] = $this->risk->getRiskMap_insvhigUs($divmap);
			}


			$this->load->view('riskmap_divisionus', $data);

	}

	
	public function aggregatrisk($id)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/aggregatRisk');
		$data['engnya'] = base_url('index.php/main/mainrac/aggregatRisk');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
		
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/agregat_risk.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('risk/risk');
		
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['sumAllRisk'] = $this->risk->getSumRisk();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['id_period'] = $id;

		$data['periodeag'] = $this->mriskregister->getPeriodeMax();

		$this->load->view('header', $data);
		$this->load->view('agregat_risk', $data);
		$this->load->view('footer', $data);
	}


	public function aggregatrisknew($id)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/aggregatrisknew');
		$data['engnya'] = base_url('index.php/main/mainrac/aggregatrisknew');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
		
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/agregat_risknew.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('risk/risk');
		
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['sumAllRisk'] = $this->risk->getSumRisk();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['id_period'] = $id;

		$data['periodeag'] = $this->mriskregister->getPeriodeMax();

		$this->load->view('header', $data);
		$this->load->view('agregat_risknew', $data);
		$this->load->view('footer', $data);
	}


	public function getAllAggRisk($id_period) {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rl_1']) && isset($_POST['filter_rl_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
			$filter_rl_1 = $_POST['filter_rl_1'];
			$filter_rl_2 = $_POST['filter_rl_2'];

			$this->load->library('session');

			$_SESSION['filbyrisk'] = $filter_by;
			$_SESSION['filvalrisk'] = $filter_value;
			$_SESSION['filter_rl_1'] = $filter_rl_1;
			$_SESSION['filter_rl_2'] = $filter_rl_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

			//$data = $this->risk->getAllRiskPeriode($page, $row, $order_by, $order, $filter_by, $filter_value);
			if(isset($_SESSION['filbyrisk']) || isset($_SESSION['filvalrisk'])){
				$data = $this->risk->getAllAgRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisk'], $_SESSION['filvalrisk'], $id_period);
			}else{
				$data = $this->risk->getAllAgRisk_n($page, $row, $order_by, $order, $filter_by, $filter_value, $id_period);
			}

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getAllAggRiskNew($id_period) {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' && isset($_POST['filter_rl_1']) && isset($_POST['filter_rl_2'])) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
			$filter_rl_1 = $_POST['filter_rl_1'];
			$filter_rl_2 = $_POST['filter_rl_2'];

			$this->load->library('session');

			$_SESSION['filbyrisk'] = $filter_by;
			$_SESSION['filvalrisk'] = $filter_value;
			$_SESSION['filter_rl_1'] = $filter_rl_1;
			$_SESSION['filter_rl_2'] = $filter_rl_2;
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

			//$data = $this->risk->getAllRiskPeriode($page, $row, $order_by, $order, $filter_by, $filter_value);
			if(isset($_SESSION['filbyrisk']) || isset($_SESSION['filvalrisk'])){
				$data = $this->risk->getAllAgRiskNew($page, $row, $order_by, $order, $filter_by, $filter_value, $_SESSION['filbyrisk'], $_SESSION['filvalrisk'], $id_period);
			}else{
				$data = $this->risk->getAllAgRiskNew_n($page, $row, $order_by, $order, $filter_by, $filter_value, $id_period);
			}

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function viewRiskAgg($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;

			//cek triskchange ada apa nggak
			$cek_change = $this->risk->cek_change($rid);

				

			$risk = $this->risk->getRiskValidate('viewAggRisk', $rid, $cred);

			$risk_user = $this->risk->getRiskUser($rid);
			$data['risk_user'] = $risk_user;

			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_aggregate_view', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function viewRiskAggNew($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;

			//cek triskchange ada apa nggak
			$cek_change = $this->risk->cek_change($rid);

				

			$risk = $this->risk->getRiskValidate('viewAggRiskNew', $rid, $cred);

			$risk_user = $this->risk->getRiskUser($rid);
			$data['risk_user'] = $risk_user;

			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_aggregate_view_new', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function riskEditAggForm($pid, $risk_id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'main/mainrac';
		$data['valid_mode'] = true;
		
		$res = $this->risk->getRiskByIdNoRef($risk_id);
		if ($res) {
			
				$verifyJs = '<script src="assets/scripts/risk/riskinputag.js"></script>
				<script src="assets/scripts/risk/riskaggedit.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$page_view = 'risk_aggregate_edit';
			
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			'.$verifyJs.'
			';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			$data['pid'] = $pid;
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function riskEditAggNewForm($pid, $risk_id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'main/mainrac';
		$data['valid_mode'] = true;
		
		$res = $this->risk->getRiskByIdNoRef($risk_id);
		if ($res) {
			
				$verifyJs = '<script src="assets/scripts/risk/riskinputagnew.js"></script>
				<script src="assets/scripts/risk/riskaggnewedit.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$page_view = 'risk_aggregatenew_edit';
			
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			'.$verifyJs.'
			';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			$data['pid'] = $pid;
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}


	public function riskTransferAggForm($pid, $iag,  $risk_id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		
		$data['risk_id'] = $risk_id;
		$data['iag'] = $iag;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'main/mainrac';
		$data['valid_mode'] = true;
		
		$res = $this->risk->getRiskByIdNoRef($risk_id);
		if ($res) {
			
				$verifyJs = '<script src="assets/scripts/risk/riskinputlibraryag.js"></script>
				<script src="assets/scripts/risk/riskinputagtransfer.js"></script>
				<script src="assets/scripts/risk/riskformlibraryag.js"></script>
				<script src="assets/scripts/risk/riskaggtransfer.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');RiskInputTransfer.init('".$data['submit_mode']."');
				RiskVerify.init();RiskTransfer.init();";
				
				$page_view = 'risk_aggregate_transfer';
			
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
			'.$verifyJs.'
			';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			$data['pid'] = $pid;
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function deleteRiskAgg()
	{
			$risk_idag = $_POST['risk_idag'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteRiskAggregate($risk_idag);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
	}

	public function deleteRiskAggNew()
	{
			$risk_idag = $_POST['risk_idag'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteRiskAggregateNew($risk_idag);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
	}


		public function saveRiskDataAgg()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					
					'risk_id' => $_POST['risk_id'],
					'risk_code' => $code,
					'risk_date' => $_POST['risk_date'],
					'risk_status' => $_POST['risk_status'],
					'periode_id' => $_POST['periode_id'],
					'risk_input_by' => $_POST['risk_input_by'],
					'risk_input_division' => $_POST['risk_input_division'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level_after_mitigation' => $_POST['risk_level_after_mitigation'],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_after_mitigation'],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_key_after_mitigation'],
					//'existing_control_id' => $_POST['existing_control_id'],
					//'risk_existing_control' => $_POST['risk_existing_control'],
					//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
					//'risk_control_owner' => $_POST['risk_control_owner'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_date' => $_POST['created_date'],
					'created_by' => $_POST['created_by'],
					'switch_flag' => $_POST['switch_flag']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
					

				$res = $this->risk->updateRiskAgg($_POST['risk_id'], $_POST['risk_idag'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			
			} 
			echo json_encode($resp);
		}
	}



	public function transferRiskDataAgg()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admin/mcategory');
					$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
					$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
					$code = $cats['cat_code'].'-'.$seq_id;
				} else {
					$code = $_POST['risk_code'];
				}
				
				if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
				
				// build data
				$risk = array(
					
					'risk_id' => $_POST['risk_id'],
					'risk_code' => $code,
					'risk_date' => $_POST['risk_date'],
					'risk_status' => $_POST['risk_status'],
					'periode_id' => $_POST['periode_id'],
					'risk_input_by' => $_POST['risk_input_by'],
					'risk_input_division' => $_POST['risk_input_division'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_library_id' => $_POST['risk_library_id'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_category' => $_POST['risk_category'],
					'risk_sub_category' => $_POST['risk_sub_category'],
					'risk_2nd_sub_category' => $_POST['risk_2nd_sub_category'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level_after_mitigation' => $_POST['risk_level_after_mitigation'],
					'risk_impact_level_after_mitigation' => $_POST['risk_impact_level_after_mitigation'],
					'risk_likelihood_key_after_mitigation' => $_POST['risk_likelihood_key_after_mitigation'],
					//'existing_control_id' => $_POST['existing_control_id'],
					//'risk_existing_control' => $_POST['risk_existing_control'],
					//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
					//'risk_control_owner' => $_POST['risk_control_owner'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_date' => $_POST['created_date'],
					'created_by' => $_POST['created_by'],
					'switch_flag' => $_POST['switch_flag']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				$actplan = array();
				foreach($_POST['actplan'] as $v) {
					$actplan[] = $v;
				}
				
				$control = array();
				foreach($_POST['control'] as $v) {
					$control[] = $v;
				}

				$objective = array();
				foreach($_POST['objective'] as $v) {
					$objective[] = $v;
				}
					

				$res = $this->risk->transferRiskAgg($_POST['risk_id'], $_POST['risk_idag'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
				
				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			
			} 
			echo json_encode($resp);
		}
	}


	public function DivisionMapAgg($pid){
			
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/DivisionMapAgg');
			$data['engnya'] = base_url('index.php/main/DivisionMapAgg');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_mapaggregate');

		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>

		<script src="assets/scripts/risk/riskmapall_ag.js"></script>
		';

		$data['pageLevelScriptsInit'] = "RiskMap.init();";

			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$this->load->model('risk/risk');
			$data['sumAllRisk'] = $this->risk->getSumRiskAgg($pid);

			$data['allCataVLow'] = $this->risk->getRiskMap_catvlowag($pid);
			$data['allCataLow'] = $this->risk->getRiskMap_catlowag($pid);
			$data['allCataMed'] = $this->risk->getRiskMap_catmedag($pid);
			$data['allCataHigh'] = $this->risk->getRiskMap_cathigag($pid);
			$data['allCataVhigh'] = $this->risk->getRiskMap_catvhigag($pid);

			$data['allMayVLow'] = $this->risk->getRiskMap_mayvlowag($pid);
			$data['allMayLow'] = $this->risk->getRiskMap_maylowag($pid);
			$data['allMayMed'] = $this->risk->getRiskMap_maymedag($pid);
			$data['allMayHigh'] = $this->risk->getRiskMap_mayhigag($pid);
			$data['allMayVhigh'] = $this->risk->getRiskMap_mayvhigag($pid);

			$data['allModVLow'] = $this->risk->getRiskMap_modvlowag($pid);
			$data['allModLow'] = $this->risk->getRiskMap_modlowag($pid);
			$data['allModMed'] = $this->risk->getRiskMap_modmedag($pid);
			$data['allModHigh'] = $this->risk->getRiskMap_modhigag($pid);
			$data['allModVhigh'] = $this->risk->getRiskMap_modvhigag($pid);

			$data['allMinVLow'] = $this->risk->getRiskMap_minvlowag($pid);
			$data['allMinLow'] = $this->risk->getRiskMap_minlowag($pid);
			$data['allMinMed'] = $this->risk->getRiskMap_minmedag($pid);
			$data['allMinHigh'] = $this->risk->getRiskMap_minhigag($pid);
			$data['allMinVhigh'] = $this->risk->getRiskMap_minvhigag($pid);

			$data['allInsiVLow'] = $this->risk->getRiskMap_insvlowag($pid);
			$data['allInsiLow'] = $this->risk->getRiskMap_inslowag($pid);
			$data['allInsiMed'] = $this->risk->getRiskMap_insmedag($pid);
			$data['allInsiHigh'] = $this->risk->getRiskMap_inshigag($pid);
			$data['allInsiVhigh'] = $this->risk->getRiskMap_insvhigag($pid);

			$data['pid'] = $pid;

			$this->load->view('main/header', $data);
			$this->load->view('riskmap_aggregate', $data);
			$this->load->view('footer', $data);

	}


		public function getCataVLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}


		$data = $this->risk->getcatvlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataMedag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatmedag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcathighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataVHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatvhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getMayVLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaylowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayMedag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaymedag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayVHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


		public function getModVLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModMedag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodmedag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModVHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinMedag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminmedag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsVLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvlowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsLowag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}
		
		$data = $this->risk->getinslowag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsMedag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsmedag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinshighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsVHighag($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvhighag($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


		public function DivisionMapAggnew($pid){
			
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/DivisionMapAggnew');
			$data['engnya'] = base_url('index.php/main/DivisionMapAggnew');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_mapaggregate');

		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>

		<script src="assets/scripts/risk/riskmapall_agnew.js"></script>
		';

		$data['pageLevelScriptsInit'] = "RiskMap.init();";

			$this->load->model('risk/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$this->load->model('risk/risk');
			$data['sumAllRisk'] = $this->risk->getSumRiskAggnew($pid);

			$data['allCataVLow'] = $this->risk->getRiskMap_catvlowagnew($pid);
			$data['allCataLow'] = $this->risk->getRiskMap_catlowagnew($pid);
			$data['allCataMed'] = $this->risk->getRiskMap_catmedagnew($pid);
			$data['allCataHigh'] = $this->risk->getRiskMap_cathigagnew($pid);
			$data['allCataVhigh'] = $this->risk->getRiskMap_catvhigagnew($pid);

			$data['allMayVLow'] = $this->risk->getRiskMap_mayvlowagnew($pid);
			$data['allMayLow'] = $this->risk->getRiskMap_maylowagnew($pid);
			$data['allMayMed'] = $this->risk->getRiskMap_maymedagnew($pid);
			$data['allMayHigh'] = $this->risk->getRiskMap_mayhigagnew($pid);
			$data['allMayVhigh'] = $this->risk->getRiskMap_mayvhigagnew($pid);

			$data['allModVLow'] = $this->risk->getRiskMap_modvlowagnew($pid);
			$data['allModLow'] = $this->risk->getRiskMap_modlowagnew($pid);
			$data['allModMed'] = $this->risk->getRiskMap_modmedagnew($pid);
			$data['allModHigh'] = $this->risk->getRiskMap_modhigagnew($pid);
			$data['allModVhigh'] = $this->risk->getRiskMap_modvhigagnew($pid);

			$data['allMinVLow'] = $this->risk->getRiskMap_minvlowagnew($pid);
			$data['allMinLow'] = $this->risk->getRiskMap_minlowagnew($pid);
			$data['allMinMed'] = $this->risk->getRiskMap_minmedagnew($pid);
			$data['allMinHigh'] = $this->risk->getRiskMap_minhigagnew($pid);
			$data['allMinVhigh'] = $this->risk->getRiskMap_minvhigagnew($pid);

			$data['allInsiVLow'] = $this->risk->getRiskMap_insvlowagnew($pid);
			$data['allInsiLow'] = $this->risk->getRiskMap_inslowagnew($pid);
			$data['allInsiMed'] = $this->risk->getRiskMap_insmedagnew($pid);
			$data['allInsiHigh'] = $this->risk->getRiskMap_inshigagnew($pid);
			$data['allInsiVhigh'] = $this->risk->getRiskMap_insvhigagnew($pid);

			$data['pid'] = $pid;

			$this->load->view('main/header', $data);
			$this->load->view('riskmap_aggregatenew', $data);
			$this->load->view('footer', $data);

	}


		public function getCataVLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}


		$data = $this->risk->getcatvlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataMedagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatmedagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcathighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getCataVHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getcatvhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getMayVLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaylowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayMedagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmaymedagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMayVHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmayvhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


		public function getModVLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModMedagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodmedagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getModVHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getmodvhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinMedagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminmedagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getMinVHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getminvhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsVLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvlowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsLowagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}
		
		$data = $this->risk->getinslowagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsMedagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsmedagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function getInsHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinshighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getInsVHighagnew($pid) 
	{
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_rl_1 = $filter_rl_2 = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$defFilter = array();
			if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
				$defFilter = $_POST['filter_library'];
		}

		$defDiv = array();
			if (isset($_POST['filter_divisi']) && trim($_POST['filter_divisi']) != '') {
				$defDiv = $_POST['filter_divisi'];
		}

		$data = $this->risk->getinsvhighagnew($defFilter, $pid, $defDiv, $page, $row, $order_by, $order);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function lossevent()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/lossevent');
		$data['engnya'] = base_url('index.php/main/mainrac/lossevent');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/lossevent');
		
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/lossevent_risk.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('risk/risk');
		
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['sumAllRisk'] = $this->risk->getSumRisk();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		$data['sektor_list'] = $this->mriskregister->getSektorList();

		$this->load->view('header', $data);
		$this->load->view('loss_event', $data);
		$this->load->view('footer', $data);
	}

	public function getAllLossEvent() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_value']) && $_POST['filter_value'] != '') {
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

				$data = $this->risk->getAllLossEvent_n($page, $row, $order_by, $order, $filter_value);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function deleteLossEvent()
	{
			$id_event = $_POST['id_event'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteLossEvent($id_event);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
	}	


	public function email_tes(){
		$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => 'ssl://smtp.googlemail.com',
			      'smtp_port' => 465,
			      //'smtp_host' => 'smtp.gmail.com',
			      //'smtp_port' => 587,
			      'smtp_user' => 'andes.zal@gmail.com',
			      'smtp_pass' => 'meteor980',
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Set to, from, message, etc.
			$this->email->to("andes.zal@gmail.com");
			$this->email->from("andes.zal@gmail.com","Pesan Gmail");
			//$this->email->bcc("example3@domain.com"); 
			$this->email->subject("Codeigniter email library Test");
			$this->email->message("<b>Remainder 15 mei harap submit risk</b> Body Content");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();


		/*$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => 'ssl://mail.denbe.co.id',
			      'smtp_port' => 465,
			      'smtp_user' => 'efrizal@denbe.co.id',
			      'smtp_pass' => 'andeskae0603',
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Set to, from, message, etc.
			//$this->email->to("hardyono@denbe.co.id, efrizal@denbe.co.id, khairulloh@denbe.co.id, t.anggono@denbe.co.id");
			$this->email->to("efrizal@denbe.co.id,irisk.admin@iigf.co.id");
			$this->email->from("irisk.admin@iigf.co.id","Admin Irisk");
			//$this->email->bcc("example3@domain.com"); 
			$this->email->subject("Testing kirim email");
			$this->email->message("Testing email");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();*/
	}

	public function email_tes2(){
		$config = Array(
			//https://mail.iigf.co.id
			      'protocol' => 'smtp',
			      //'smtp_host' => '172.16.1.2',
			      //'smtp_host' => 'idola.net.id',
			      'smtp_host' => 'ssl://smtp.mailgun.org', // host
			      //'smtp_port' => 465,
			      //'smtp_port' => 443,
			      'smtp_port' => 465,
			      //'smtp_user' => 'postmaster@crm.barantum.com', //nama
			      //'smtp_pass' => '0a818593f0ff19497d1171900246c1f1',
			      'smtp_user' => 'postmaster@iriskiigf.org', //nama
			      'smtp_pass' => '7a0a7be8557083992a7f6b929f60cbf7',
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			//$this->email->set_newline("\r\n");
			$this->email->set_crlf( "\r\n" );

			// Set to, from, message, etc.
			//$this->email->to("saefulloh@denbe.co.id, efrizal@denbe.co.id,heidisari@denbe.co.id");
			$this->email->from("irisk.admin@iigf.co.id","Admin Risk");
			$this->email->to("irisk.admin@iigf.co.id");
			//$this->email->bcc("example3@domain.com"); 
			$this->email->subject("Tes Email");
			$this->email->message("<b>Tes Mail from denbe 400</b>");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();
	}

	public function email_tes3(){
		$config = Array(
			//https://mail.iigf.co.id
			      'protocol' => 'smtp',
			      //'smtp_host' => 'i-test:2095',
			      'smtp_host' => 'ssl://mail.i-test.co.id',
			      //'smtp_port' => 2095,
			      'smtp_port' => 465,
			      //'smtp_port' => 25,
			      'smtp_user' => 'admin@i-test.co.id',
			      'smtp_pass' => 'admin2017',
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Set to, from, message, etc.
			$this->email->to("saefulloh@denbe.co.id, efrizal@denbe.co.id");
			$this->email->from("admin@i-test.co.id","i-test");
			//$this->email->bcc("example3@domain.com"); 
			$this->email->subject("Bug 20, remainder");
			$this->email->message("<b>Remainder 30 mei harap submitted risk</b> Body Content");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();
	}

	public function email_tes4(){
		$config = Array(
			//https://mail.iigf.co.id
			      'protocol' => 'smtp',
			      //'smtp_host' => '172.16.1.2',
			      //'smtp_host' => 'idola.net.id',
			      'smtp_host' => 'mail.iigf.co.id', // host
			      //'smtp_port' => 465,
			      //'smtp_port' => 443,
			      'smtp_port' => 25,
			      'smtp_user' => 'irisk.admin@iigf.co.id', //nama
			      'smtp_pass' => 'R15k2017',
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'smtp_crypto' => 'TLS',
				  'mailtype' => 'html',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			//$this->email->set_newline("\r\n");
			$this->email->set_crlf( "\r\n" );

			// Set to, from, message, etc.
			//$this->email->to("saefulloh@denbe.co.id, efrizal@denbe.co.id,heidisari@denbe.co.id");
			$this->email->to("irisk.admin@iigf.co.id, efrizal@denbe.co.id");
			$this->email->from("irisk.admin@iigf.co.id","PII");
			//$this->email->bcc("example3@domain.com"); 
			$this->email->subject("Bug 20, remainder");
			$this->email->message("<b>Remainder 30 mei harap submitted risk</b> Body Content");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger();
	}

	
public function mycontroller(){

		   // load library email
$this->load->library('PHPMailerAutoload');
        
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "iigfirisk@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "R15k.2017";

//Set who the message is to be sent from
$mail->setFrom('irisk.admin@iigf.co.id', 'Admin Risk');

//Set an alternative reply-to address
//$mail->addReplyTo('irisk.admin@iigf.co.id');
$mail->addReplyTo('efrizal@denbe.co.id');

//Set who the message is to be sent to
//$mail->addAddress('irisk.admin@iigf.co.id');
$mail->addAddress('efrizal@denbe.co.id');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
 $mail->Body = 'Email ini dikirim oleh PHPMailer';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
 }
	}


}
