<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainRac extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
		
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
		<script src="assets/scripts/dashboard/main_raci.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		//cek change request
		$this->load->model('riski/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequest();
		$data['cekrisklist'] = $this->risk->cekRiskList();
		$data['cekregisterlist'] = $this->risk->cekRegisterList();
		$data['treatmentlist'] = $this->risk->treatmentlist();
		$data['cekplan'] = $this->risk->cekPlanRac();
		$data['cekplanExec'] = $this->risk->cekPlanExecRac();
		$data['cekkrirac'] = $this->risk->cekKriRac();

		$this->load->model('riski/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();


		$this->load->view('header', $data);
		$this->load->view('main_rac', $data);
		$this->load->view('footer', $data);
	}


	public function ChartTest()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
		

		
		//cek change request
		$this->load->model('riski/risk');

		$data['report'] = $this->risk->report();

		$this->load->view('header', $data);
		$this->load->view('test_chart', $data);
		$this->load->view('footer', $data);
	}

	//----------- CHART DASHBOARD----------------------------------------------------------------

	public function ChartriskToVerify()
	
	{
		//cek change request
		$this->load->model('riski/risk');
		$data['report'] = $this->risk->report();	
		$this->load->view('chart_risk_to_verify', $data);
		
	}

	public function ChartRiskRegisterToVerify()
	{
		$this->load->model('riski/risk');

		$data['report2'] = $this->risk->report2();

		$this->load->view('chart_risk_Register_to_verify', $data);
	}

	public function ChartTreatmentToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report3'] = $this->risk->report3();

		$this->load->view('chart_Treatment_to_verify', $data);
	}

	public function ChartActionPlanToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report4'] = $this->risk->report4();

		$this->load->view('chart_ActionPlan_to_verify', $data);
	}
	

	public function ChartExecutionToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report7'] = $this->risk->report7();

		$this->load->view('chart_Execution_to_verify', $data);
	}

		public function ChartKRIToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report5'] = $this->risk->report5();
		$this->load->view('chart_KRI_to_verify', $data);
	}

		public function ChartchangeRequestToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report6'] = $this->risk->report6();

		$this->load->view('chart_Changerequest_to_verify', $data);
	}

	public function ChartRiskPriorToVerify()
	{
		//cek change request
		$this->load->model('riski/risk');

		$data['report8'] = $this->risk->report8();

		$this->load->view('chart_risk_prior_to_verify', $data);
	}

//-----------END CHART DASHBOARD----------------------------------------------------------------
	
	public function riskRegister($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
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
			$this->load->model('admini/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($rid);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;

			$this->load->view('maini/header', $data);
			$this->load->view('risk_register_list', $data);
			$this->load->view('maini/footer', $data);
		}

	}
// Oktober 12/16
	public function riskRegister_okto($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
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
			$this->load->model('admini/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($rid);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;

			$this->load->view('maini/header', $data);
			$this->load->view('risk_register_list_okto', $data);
			$this->load->view('maini/footer', $data);
		}

	}

	public function riskRegister2($rid)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
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
			$this->load->model('admini/mperiode');
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
		$this->load->model('user/usermodel');
		$userdata = $this->usermodel->getDataById($rid);
		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $rid;
			
			$this->load->view('maini/header', $data);
			$this->load->view('risk_register_list', $data);
			$this->load->view('maini/footer', $data);
		}

	}
	
	public function getSummaryCount($mode = null) {
		// MODE : risk riskregister treatment actionplan kri change
		$sess = $this->loadDefaultAppConfig();
		
		$this->load->model('riski/risk');
		 
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
		
		$this->load->model('riski/risk');
		 
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
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

		if ($periode == true) {
			$data = $this->risk->getAllRisk($page, $row, $order_by, $order, $filter_by, $filter_value);
		}else{
			//$data = $this->risk->getAllRiskPeriode($page, $row, $order_by, $order, $filter_by, $filter_value);
			$data = $this->risk->getAllRisk($page, $row, $order_by, $order, $filter_by, $filter_value);
		}

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getAllOldRisk() {
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
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

			$data = $this->risk->getAllOldRisk($page, $row, $order_by, $order, $filter_by, $filter_value);

		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getUserList() {
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
		$this->load->model('riski/risk');
		
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = 0;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->risk->getRiskUsername($periode_id, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
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
		
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
				
		$this->load->model('riski/risk');
		$this->load->model('admini/mperiode');
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
		
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('riski/risk');
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
		
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('riski/risk');
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
		
		$this->load->model('admini/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$this->load->model('riski/risk');
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
		$this->load->model('riski/mriskregister');
		$this->load->model('riski/risk');
		$this->load->model('admini/mperiode');
		
		$menu = '';
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'maini/mainrac';
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
				$verifyJs = '<script src="assets/scripts/riski/riskinput.js"></script>
				<script src="assets/scripts/riski/riskverify.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$page_view = 'risk_register_verify';
			} else { // USE LIBRARY
				$verifyJs = '<script src="assets/scripts/riski/riskinput.js"></script>
				<script src="assets/scripts/riski/riskverifylibrary.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$lib_risk = $this->risk->getRiskByIdNoRef($res['risk_library_id']);
				$data['library_risk'] = $lib_risk;
				$data['library_risk_id'] = $res['risk_library_id'];
				$page_view = 'risk_register_library';

				//cari tanggal submit
				$periode = $this->mperiode->getCurrentPeriode();
				$data['tanggal_submit'] = $this->risk->cari_tanggal_submit($user_by,$periode['periode_id']);

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
			
			$this->load->view('maini/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('maini/footer', $data);
		}
	}

	public function riskRegisterFormunder($risk_id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('riski/mriskregister');
		$this->load->model('riski/risk');
		
		$menu = '';
		
		$data['risk_id'] = $risk_id;
		
		$mode = 'periodic';
		$data['submit_mode'] = 'periodic';
		$menu = 'maini/mainrac';
		$data['valid_mode'] = true;
		
		$res = $this->risk->getRiskByIdNoRef($risk_id);
		if ($res) {
			
				$verifyJs = '<script src="assets/scripts/riski/riskinput.js"></script>
				<script src="assets/scripts/riski/riskverify.js"></script>';
				
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
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('maini/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('maini/footer', $data);
		}
	}
	
	public function riskGetData($risk_id)
	{
		$this->load->model('riski/risk');
		$data = $this->risk->getRiskById($risk_id);
		echo json_encode($data);
	}
	
	public function deleteRisk()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$risk_id = $_POST['risk_id'];
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
	/*
	public function verifyPrimaryRiskData()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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

				$res = $this->risk->updateRisk1($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], $user);

				//$res = $this->risk->updateRisk1change($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $data['session']['username']);
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
					if($_POST['risk_status'] < 20){	
						$res = $this->risk->updateRiskracUnder($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
					}else{
						$res = $this->risk->updateRiskracUnder2($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $control, $objective, $data['session']['username']);
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
			$this->load->model('riski/risk');
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $_POST['risk_id'], $cred);
			if ($risk) {
				// category
				if ($risk['risk_2nd_sub_category'] != $_POST['risk_2nd_sub_category']) {
					$this->load->model('admini/mcategory');
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
					
				// update t_risk ke t_risk change 
				
				//echo "<pre>";print_r($this->input->post());exit;
				
				$data_t_risk = $this->risk->get_t_risk($_POST['risk_id']);
				
				// end update t_risk ke t_risk change 
					 
				$res = $this->risk->updateRisk2($_POST['risk_id'], $_POST['risk_library_id'], $_POST['suggested_risk_treatment'], $_POST['risk_input_by_change'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
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
			
			$this->load->model('riski/risk');
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
			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/risk_register_view', $data);
			$this->load->view('maini/footer', $data);
		}
	}
	
	public function getTreatmentList() {
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
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		
		if (isset($_POST['risk_cat']) && $_POST['risk_cat'] != '') {
			$defFilter['risk_cat'] = $_POST['risk_cat'];
		}
		$data = $this->risk->getDataMode('racTreatmentList', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
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
			<script src="assets/scripts/riski/risktreatmentverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "RiskVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac');
			
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewRiskByRac', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;				
				$data['user'] = $user;
			}

			
			$this->load->model('riski/mriskregister');
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();
			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/risk_treatment_verify', $data);
			$this->load->view('maini/footer', $data);
		}
	}
	
	public function loadTreatmentChange($rid,$user) 
	{
		if ($rid && is_numeric($rid)) {
			$this->load->model('riski/risk');

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
			$this->load->model('riski/risk');

			$data = $this->risk->getRiskOwnById2($rid);
			if (!$data) {
				$data = $this->risk->getRiskOwnById2($rid);
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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

	public function treatmentVerifyPrimary()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racActionPlan', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function actionPlanForm($rid=false) 
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
			<script src="assets/scripts/riski/actionverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();


			//cek ini dari rollforward bukan
			$cek_library_id = $this->risk->cekLibraryId($rid);

			$cek_risk_sebelumnya = $this->risk->cekLibraryBefore($cek_library_id['risk_library_id']);

			if($cek_library_id['risk_input_by'] == $cek_risk_sebelumnya['risk_input_by']){
				$data['status_berkala'] = true;
			}else{
				$data['status_berkala'] = false;
			}
			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_plan_verify', $data);
			$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionverify.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_un', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();


			//cek ini dari rollforward bukan
			$cek_library_id = $this->risk->cekLibraryId($rid);

			$cek_risk_sebelumnya = $this->risk->cekLibraryBefore($cek_library_id['risk_library_id']);

			if($cek_library_id['risk_input_by'] == $cek_risk_sebelumnya['risk_input_by']){
				$data['status_berkala'] = true;
			}else{
				$data['status_berkala'] = false;
			}
			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_plan_under', $data);
			$this->load->view('maini/footer', $data);
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
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getActionPlanById($rid);
			$data['action_plan'] = $risk;
			$risk_data = $this->risk->getRiskById($risk['risk_id']);
			$data['risk'] = $risk_data;
			
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_plan_view', $data);
			$this->load->view('maini/footer', $data);
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
				'action_id' => $_POST['action_id'],
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			 
			$this->load->model('riski/risk');
			
			// update t_risk ke t_risk change 
				
			//echo "<pre>";print_r($this->input->post());exit;
			
			//$data_t_risk = $this->risk->get_t_risk_actionplan($_POST['action_id']);
			
			// end update t_risk ke t_risk change

			$cek_changerequest_action = $this->risk->cek_changerequest_action($_POST['action_id']);

				if($cek_changerequest_action){
					$resp['msg'] = 'You have change request for this Action Plan';
				}else{
			$res = $this->risk->actionPlanSaveDraft2($_POST['action_id'], $_POST['risk_id'], $risk, $data['session']['username']);
			//$res = $this->risk->actionSwitchPrimary($_POST['id']);
			
			$resp = array();
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['success'] = false;
				$resp['msg'] = $this->db->error();
			}
		}
			
			//echo update t_risk_change;
				
			//$this->risk->update_t_risk_actionplan_change($data_t_risk,$_POST['id']);
			
			// endupdate t_risk_change
			
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


			
			$this->load->model('riski/risk');


			$cek_changerequest_action = $this->risk->cek_changerequest_action($_POST['action_id']);

			if($cek_changerequest_action){
					$resp['msg'] = 'You have change request for this Action Plan';
				}else{
					$res = $this->risk->actionPlanVerify($_POST['action_id'], $risk_id, $risk, $data['session']['username']);
			
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
			
			$this->load->model('riski/risk');
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
			
			$this->load->model('riski/risk');
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

	public function actionChangeDate() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'due_date' => $dd
			);
			
			$this->load->model('riski/risk');
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
			
			$this->load->model('riski/risk');
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
			
			$this->load->model('riski/risk');
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
			
			$this->load->model('riski/risk');
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
			
			$this->load->model('riski/risk');
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
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('riski/risk');
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
			}else{
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('riski/risk');
		
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
		$this->load->model('riski/risk');
		
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
			}else{
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
			}
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('riski/risk');
		
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
		$this->load->model('riski/risk');
		
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
	
	public function actionPlanExecForm($rid=false,$view=null) 
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
			<script src="assets/scripts/riski/actionexecverify.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_exec_verify', $data);
			$this->load->view('maini/footer', $data);
		}
	}

	public function actionPlanExecFormNow($rid=false,$view=null) 
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
			<script src="assets/scripts/riski/actionexecverify_now.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_exec_verify_now', $data);
			$this->load->view('maini/footer', $data);
		}
	}

	public function actionPlanExecFormPrior($rid=false,$view=null) 
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
			<script src="assets/scripts/riski/actionexecverify_prior.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRacPrior', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_exec_verify_prior', $data);
			$this->load->view('maini/footer', $data);
		}
	}
  
	public function FormactionPlanExec($rid=false,$view=null) 
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
			<script src="assets/scripts/riski/actionexecverify.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/form_action_exec', $data);
			$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionexecverify.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
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
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/form_action_exec', $data);
			$this->load->view('maini/footer', $data);
		}
	}


	public function FormactionPlanExecPrior($rid=false,$view=null) 
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
			<script src="assets/scripts/riski/actionexecverify.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRacPrior', $rid, $cred);
			if ($risk) {
				$risk['revised_date_v'] = '';
				if ($risk['revised_date'] != '') {
					$risk['revised_date_v'] = implode('-', array_reverse( explode('-', $risk['revised_date']) ));
				}
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;
				$data['view'] = $view;				
			}
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/form_action_exec', $data);
			$this->load->view('maini/footer', $data);
		}
	}
	
	public function actionExecVerify()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('riski/risk');
			
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
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
				$res = $this->risk->execOngoing($_POST['id'], $risk, $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
				$res = $this->risk->execUpdateRiskStatus($_POST['id'], $data['session']['username']);
				$res = $this->risk->execExtend($_POST['id'], $risk, $data['session']['username']);
			}
			
			// ----------- level update wawan
			
			$this->risk->updateKRI_Risk_level($_POST['id'], $_POST['risk_id'],$this->input->post());
			
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
			$this->load->model('riski/risk');
			
			if ($_POST['execution_status'] == 'COMPLETE' ) {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
				$res = $this->risk->execCompletePrior($_POST['id'], $risk, $data['session']['username']);
			} 
			else if ($_POST['execution_status'] == "ONGOING") {
				$risk = array(
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence']
				);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
				$res = $this->risk->execOngoingPrior($_POST['id'], $risk, $data['session']['username']);
			} 
			else {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
				$res = $this->risk->execUpdateRiskStatusPrior($_POST['id'], $data['session']['username']);
				$res = $this->risk->execExtendPrior($_POST['id'], $risk, $data['session']['username']);
			}
			
			// ----------- level update wawan
			
			$this->risk->updateKRI_Risk_level_prior($_POST['id'], $_POST['risk_id'], $this->input->post());
			
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
			$this->load->model('riski/risk');
			
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
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racKri', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getKri_non() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('riski/risk');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('racKri_non', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function viewKri($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$this->load->model('riski/mriskregister');
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
			$data['valid_mode'] = false;
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$this->load->model('riski/risk');
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
					
					<script src="assets/scripts/riski/kriverify.js"></script>
					';
					
					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					$data['verifyRac'] = true;
					$view = 'riski/kri_form_rac';
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
					
					<script src="assets/scripts/riski/kriverify_no.js"></script>
					<script src="assets/scripts/riski/krientry.js"></script>
					<script src="assets/scripts/riski/krimodify_verify.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('riski/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'riski/kri_form_rac_no';
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
					
					<script src="assets/scripts/riski/kriverify_no.js"></script>
					<script src="assets/scripts/riski/krientry.js"></script>
					<script src="assets/scripts/riski/krimodify_verify.js"></script>
					';

					$data['kri_id'] = $rid;
					$data['pageLevelScriptsInit'] = "KriForm.init();Kri.init();KriModify.init();";
					$data['verifyRac'] = true;
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('riski/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					$view = 'riski/kri_form_rac_yes';
				}else {
					$view = 'riski/kri_view';
				}
				
				$this->load->view('maini/header', $data);
				$this->load->view($view, $data);
				$this->load->view('maini/footer', $data);
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
		redirect('maini/maindireksicfo');
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
		redirect('maini/maindireksirac');
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
		$this->load->model('riski/risk');
		
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
			$this->load->model('riski/risk');
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
				$v = 'riski/change_request_kri';
			} else {
				$data['pageLevelScripts'] = '
				<script src="assets/scripts/riski/cr_riskregister_view.js"></script>
				';
				$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
				$v = 'riski/change_request_view';
			}
			
			$data['change_id'] = $risk_id;
			$data['change_type'] = $res['cr_type'];
			$data['change_code'] = $res['cr_code'];
			$data['change_status'] = $res['cr_status'];
			
			$this->load->view('maini/header', $data);
			$this->load->view($v, $data);
			$this->load->view('maini/footer', $data);
		}
	}
	
	public function ChangeRequestVerify($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$change = $this->risk->getChangeById($rid, false);

			//ini untuk cek status risk pada saat change request
			$status = $this->risk->getRiskById($change['risk_id']);

			//untuk ngambil status action plan nya
			$status_action = $this->risk->getActionPlanStatus($change['risk_id']);

			if ($change) {
				if ($change['cr_status']*1 == 0) {
					if ($change['cr_type'] != 'KRI Form') {
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
						
						<script src="assets/scripts/riski/cr_riskregister_verify.js"></script>
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
						
						$this->load->model('riski/mriskregister');
						$data['category'] = $this->mriskregister->getRiskCategory();
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'riski/change_request_own_verify';
					} else {
						$data['pageLevelStyles'] = '
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
						<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
						';
						
						$data['pageLevelScripts'] = '
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
						<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
						';
						
						$kri = $this->risk->getKriById($change['risk_cause']);
						$data['kri'] = $kri;
						$risk = $this->risk->getRiskById($change['risk_id']);
						$data['risk'] = $risk;
						
						$data['change'] = $change;
						$data['verify'] = true;
						
						$data['pageLevelScripts'] = '<script src="assets/scripts/riski/cr_riskregister_kri_verify.js"></script>';
						$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
						$view = 'riski/change_request_kri_rac';
					}
				} else {
					if ($change['cr_type'] != 'KRI Form') {
						$data['pageLevelScripts'] = '<script src="assets/scripts/riski/cr_riskregister_view.js"></script>';
						$data['change_id'] = $rid;
						$data['change_type'] = $change['cr_type'];
						$data['change_code'] = $change['cr_code'];
						
						$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
						
						$view = 'riski/change_request_view';
					} else {
						$kri = $this->risk->getKriById($change['risk_cause']);
						$data['kri'] = $kri;
						$risk = $this->risk->getRiskById($change['risk_id']);
						$data['risk'] = $risk;
						
						$data['change'] = $change;
						
						$data['pageLevelScripts'] = '';
						$data['pageLevelScriptsInit'] = '';
						$view = 'riski/change_request_kri_rac';
					}
				}
				
				$this->load->view('maini/header', $data);
				$this->load->view($view, $data);
				$this->load->view('maini/footer', $data);
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
			 
			$this->load->model('riski/risk');
			
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
			$this->load->model('riski/risk');
			
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
		$resp = array();
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$this->load->model('riski/risk');
			
			// ini buat update t_cr_risk_change kayak nya ga perlu	
			//$res = $this->risk->changeRequestSwitchPrimary($_POST['id']);

			$changes = $this->risk->getChangeById_risk($_POST['id']);
			
			$v_risk = true; $v_control = true; $v_action = true; $v_objective = true;
			if ($changes['cr_type'] == 'Risk Owner Form') {
				$v_risk = true; $v_control = true; $v_action = true; $v_objective = true; 
			}
			if ($changes['cr_type'] == 'Action Plan Form') {
				$v_risk = false; $v_control = false; $v_action = true; $v_objective = false;
			}
			
			$res = $this->risk->changeRequestApplyVerify($_POST['id'], $data['session']['username'], $v_risk, $v_control, $v_action, $v_objective);
			
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');
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
			$this->load->model('riski/risk');

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
			$this->load->model('riski/risk');

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
			$this->load->model('riski/risk');
			// build data
			$kri = $this->risk->getKriById($_POST['kri_id']);
			$kri_warning = null;
			$report = $_POST['owner_report'];
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			} else {
				$tt = 'NUMERIC';
				if ($report <= 100) $tt = 'PERCENTAGE';
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_type'] == $tt && $value['operator'] == 'BELOW'
						&& $report < $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'BETWEEN' 
						&& ($report >= $value['value_1'] && $report <= $value['value_2']) ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'ABOVE'
						&& $report > $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
				}
			}
			
			
			$risk = array(
				'risk_impact' => $report,
				'risk_level' => $kri_warning
			);
			
			$impact_level = false;
			$actplan = false;
			$control = false;
			$objective = false;
			
			$uid = $data['session']['username'];
			$res = $this->risk->changeRequestSaveDraft($_POST['change_id'], $_POST['risk_id'], $risk, $impact_level, $actplan, $control, $objective, $uid);
			$res = $this->risk->changeRequestApplyKri($_POST['change_id'], $uid);
			
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
	  
		$this->load->model('riski/risk');
		  
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
		 
		$this->load->model('riski/risk');
		
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
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac/actionplan_adt');
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
		
		<script src="assets/scripts/dashboard/main_raci.js"></script>
		
		';
		
		$data['pageLevelScriptsInit'] = 'Actionplan_adt.init();
		 
		';
		
		$this->load->model('admini/mperiode');
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
		
		
		$this->load->view('maini/header', $data);
		$this->load->view('actionplan_adt', $data);
		$this->load->view('maini/footer', $data);
	}

	public function actionplanexe_prior() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_prior');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_prior');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac/actionplanexe_prior');
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
		<script src="assets/scripts/dashboard/main_rac_prior_ec.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';

		$this->load->model('riski/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$this->load->view('maini/header', $data);
		$this->load->view('actionplanexe_prior', $data);
		$this->load->view('maini/footer', $data);
	}

	public function actionplanexe_now() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_now');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_now');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac/actionplanexe_now');
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
		<script src="assets/scripts/dashboard/main_rac_now_ec.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';

		$this->load->model('riski/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('maini/header', $data);
		$this->load->view('actionplanexe_now', $data);
		$this->load->view('maini/footer', $data);
	}

	public function actionplanexe_periode() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac/actionplanexe_periode');
		$data['engnya'] = base_url('index.php/main/mainrac/actionplanexe_periode');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainrac/actionplanexe_periode');
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
		
		$this->load->view('maini/header', $data);
		$this->load->view('periode_action_plan_exe', $data);
		$this->load->view('maini/footer', $data);
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

		$this->load->model('riski/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$this->load->view('maini/header', $data);
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
		
		$this->load->view('maini/header', $data);
		$this->load->view('kri_regular', $data);
		$this->load->view('maini/footer', $data);
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
		
		$this->load->model('admini/mperiode');
		$data['periode'] = $this->mperiode->getCurrentPeriode();
		$data['param'] = $this->input->post();
		 
		$this->load->model('riski/risk');
		 
		$data['datatable'] = $this->risk->submit_note($data);
		 
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
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			$risk = $this->risk->getRiskValidate('viewRiskByDivisionRac', $rid, $cred);
			$view = 'riski/risk_register_view';
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
						<script src="assets/scripts/riski/riskowned_rac.js"></script>
						';
						
						//$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('riski/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						//$view = 'riski/risk_owner_form';
						$view = 'riski/risk_register_view';
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
						<script src="assets/scripts/riski/riskowned_rac.js"></script>
						';
						
						//$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('riski/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						//$view = 'riski/risk_owner_form';
						$view = 'riski/risk_register_view';
					} else {
						$view = 'riski/risk_register_view';
					}
				}
			}
			
			
			$this->load->view('maini/header', $data);
			$this->load->view($view, $data);
			$this->load->view('maini/footer', $data);
		}
	}

	public function viewActionPlan($rid = false) {
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
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$risk = $this->risk->getActionPlanById($rid);

			if ($risk && $risk['division'] != $cred['division_id'] || $risk['division'] == $cred['division_id'] ) {
				
				$this->load->model('riski/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid);
					
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
						
						<script src="assets/scripts/riski/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'riski/action_plan_form_rac';
					} else {
						$view = 'riski/action_plan_form_rac';
					}
					
					$this->load->view('maini/header', $data);
					$this->load->view($view, $data);
					$this->load->view('maini/footer', $data);
				}
			}
		}
	}

		public function viewActionPlanPrior($rid = false) {
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
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$risk = $this->risk->getActionPlanByIdPrior($rid);

			if ($risk && $risk['division'] != $cred['division_id'] || $risk['division'] == $cred['division_id'] ) {
				
				$this->load->model('riski/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid);
					
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
						
						<script src="assets/scripts/riski/actionplanform_rac.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'riski/action_plan_form_rac';
					} else {
						$view = 'riski/action_plan_form_rac';
					}
					
					$this->load->view('maini/header', $data);
					$this->load->view($view, $data);
					$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionverify_cr.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_plan_request_verify', $data);
			$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionexecverify_cr.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
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

			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_exec_request_verify', $data);
			$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionexecverify_cr.js"></script>
			';
			
			$this->load->model('riski/mriskregister');
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			
			$data['valid_mode'] = false;
			$data['ap_id'] = $rid;
			$this->load->model('riski/risk');
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

			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();
						
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_exec_prior_request_verify', $data);
			$this->load->view('maini/footer', $data);
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
			<script src="assets/scripts/riski/actionverify_cr.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');				
			
			$data['valid_mode'] = false;
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['action_plan'] = $risk;				
			}
			
			$this->load->model('riski/mriskregister');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			
			$this->load->view('maini/header', $data);
			$this->load->view('riski/action_plan_request_view', $data);
			$this->load->view('maini/footer', $data);
		}
	}

	public function viewOwnedKri($rid = false) {
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
			
			$this->load->model('riski/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];

			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] != $cred['division_id']) {
				
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
					
					<script src="assets/scripts/riski/krientry.js"></script>
					<script src="assets/scripts/riski/krimodify.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = 'Kri.init();KriModify.init();';

					$data['indonya'] = base_url('index.php/maini/mainrac');
					$data['engnya'] = base_url('index.php/main/mainrac');
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('riski/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
					$view = 'riski/kri_modify';
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
					
					<script src="assets/scripts/riski/kriform_rac.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'riski/kri_form_rac';
				} else {
					$view = 'riski/kri_view';
				}
				
				$this->load->view('maini/header', $data);
				$this->load->view($view, $data);
				$this->load->view('maini/footer', $data);
			}
		}
	}


}
