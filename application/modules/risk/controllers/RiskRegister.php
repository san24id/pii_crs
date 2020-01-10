<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiskRegister extends APP_Controller {
	function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin/mperiode');
        $this->load->model('risk/risk');
        $this->load->model('risk/mriskregister');
    }
	
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister');
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');
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
		
		<script src="assets/scripts/risk/risklist.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$data['username'] = $this->session->credential['username'];
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_list', $data);
		$this->load->view('main/footer', $data);
	}

	public function ChangeRequestRac($username)
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister');
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');
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
		
		<script src="assets/scripts/risk/risklist_change_rac.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}

		$data['username'] = $username;
		
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_list_change_rac', $data);
		$this->load->view('main/footer', $data);
	}
	//ubah
	public function undermaintenance()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister/undermaintenance');
		$data['indonya'] = base_url('index.php/riski/RiskRegister/undermaintenance');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/undermaintenance');
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
		
		<script src="assets/scripts/risk/risklist_under.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}
		
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
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_list_under', $data);
		$this->load->view('main/footer', $data);
	}
//ubah 
	public function riskGetRollOver_under()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_under', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	//ubah 
	public function riskGetRollOver_under2()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_under2', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	//ubah 
	public function riskGetRollOver_under3()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_under3', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	//ubah

	public function confirmRisk_under() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;
			
			$res = $this->risk->riskSetConfirm_under($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}

	public function recover()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister/recover');
		$data['indonya'] = base_url('index.php/riski/RiskRegister/recover');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/recover');
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
		
		<script src="assets/scripts/risk/risklist_recover.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_list_recover', $data);
		$this->load->view('main/footer', $data);
	}

	public function recover_user()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('risk/RiskRegister/recover_user');
		$data['indonya'] = base_url('index.php/riski/RiskRegister/recover');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/recover');
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
		
		<script src="assets/scripts/risk/risklist_recover_user.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'RiskList.init();';
		
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
		}

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$session_data = $this->session->credential;
		$data['uid'] = $session_data['username'];
		
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_list_recover_user', $data);
		$this->load->view('main/footer', $data);
	}

	

	public function riskGetRollOver_recover()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_recover', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		foreach($data['data'] as $k=>$v) {
			$data['data'][$k]['checkboxColumn'] = '<input type="checkbox" name="id[]" value="'.$v['risk_id'].'" rtype="'.$v['risk_level'].'">';
		}
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskGetRollOver_recover_user()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_recover_user', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskGetRollOver_recover_modify()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_recover_modify', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskGetRollOver_recover_modify_rac()
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover_recover_modify_rac', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		foreach($data['data'] as $k=>$v) {
			$data['data'][$k]['checkboxColumn'] = '<input type="checkbox" name="id[]" value="'.$v['risk_id'].'" rtype="'.$v['risk_level'].'">';
		}
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function confirmRisk_recover() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
	
			$periode_id = $periode['periode_id'];
			$data['periode_id'] = $periode_id;


			//cek dulu dari library apa nggak
			$cek_from_library = $this->risk->cek_from_library($_POST['risk_id']);

			//cek dulu dari t_risk_add user bukan
			$cek_from_add = $this->risk->cek_from_add($_POST['risk_id'],$session_data['username']);


		if($cek_from_add == true){

			if($cek_from_library == true){
			$res = $this->risk->riskSetConfirm_recover_library($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
			}else{
			$res = $this->risk->riskSetConfirm_recover($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
			}

		}else{
			$res = $this->risk->riskSetConfirm_recover_from_add($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
		}

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}else {
				$resp['success'] = false;
				$resp['msg'] = 'your risk register exercise has been submitted please contact RAC team to recover deleted risk.';
			}
		}
		
		echo json_encode($resp);
	}

	public function confirmRisk_recover_rac() {

		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;



			//end
			$res = $this->risk->riskSetConfirm_recover_rac($_POST['risk_id'], $_POST['username'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
			//fungsi jempol normal
			$res = $this->risk->riskSetConfirm_recover_1($_POST['risk_id'], $_POST['username'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}

	public function confirmRisk_recover_rac_bawah() {

		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;

			$res = $this->risk->riskSetConfirm_recover_bawah_rac($_POST['risk_id'], $_POST['risk_input_by'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
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
	
	public function RiskRegisterInput($mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		if ($mode == 'adhoc') {
			$data['submit_mode'] = 'adhoc';
			$menu = 'main';
		} else if ($mode == 'periodic') {
			$data['submit_mode'] = 'periodic';
			$menu = 'risk/RiskRegister';
		} else {
			exit;
		}
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');				
		$data['valid_mode'] = $this->validatePeriodeMode($data['submit_mode']);
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
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
		
		<script src="assets/scripts/risk/riskinput.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_input', $data);
		$this->load->view('main/footer', $data);	
	}

	public function RiskRegisterInputRac($mode = false, $username)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		if ($mode == 'adhoc') {
			$data['submit_mode'] = 'adhoc';
			$menu = 'main';
		} else if ($mode == 'periodic') {
			$data['submit_mode'] = 'periodic';
			$menu = 'risk/RiskRegister';
		} else {
			exit;
		}
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');				
		$data['valid_mode'] = $this->validatePeriodeMode($data['submit_mode']);
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
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
		
		<script src="assets/scripts/risk/riskinputrac.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['username_user'] = $username; //username karena yg input rac
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_register_input', $data);
		$this->load->view('main/footer', $data);	
	}
	
	public function modifyRisk($risk_id = null)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
			$res = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $session_data);
			
			if ($res) {
				$data = $this->loadDefaultAppConfig();
				$menu = '';
				
				if ($res['periode_id'] == '') {
					$data['submit_mode'] = 'adhoc';
					$menu = 'main';
				} else {
					$data['submit_mode'] = 'periodic';
					//$menu = 'risk/RiskRegister';
					$menu = 'main';
				}
				$data['indonya'] = base_url('index.php/maini/mainpic');
				$data['engnya'] = base_url('index.php/main/mainpic');				
				$data['valid_mode'] = true;
				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
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
				
				<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskmodify.js"></script>
				';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskModify.init('".$data['submit_mode']."');
				";
				
				$data['modifyRisk'] = true;
				$data['risk_id'] = $risk_id;
				$data['username_user'] = '';
				
				$data['category'] = $this->mriskregister->getRiskCategory();
				$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
				$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
				$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				$this->load->view('main/header', $data);
				$this->load->view('risk_register_input', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function deleteRiskModify()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$risk_id = $_POST['risk_id'];
			$this->load->model('risk/risk');

			
			$res = $this->risk->deleteRiskModify($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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
	
	public function getCategory($parent) 
	{
		
		$data = $this->mriskregister->getRiskCategory($parent);
		echo json_encode($data);
		exit;
	}

	public function getCategory_in($parent) 
	{
		
		$data = $this->mriskregister->getRiskCategory_in($parent);
		echo json_encode($data);
		exit;
	}

	public function getUserRole($parent) 
	{
		
		$data = $this->mriskregister->getUserRole($parent);
		echo json_encode($data);
		exit;
	}
	
	public function getRiskLevelList() 
	{
		$res = array();
		
		$data = $this->mriskregister->getRiskLevelList();
		if ($data) {
			foreach($data as $row) {
				$res[$row['ref_key']] = $row['ref_value'];
			}
		}
		echo json_encode($res);
		exit;
	}
	
	public function getImpactLevelReference() 
	{
		$res = array();
		
		$data = $this->mriskregister->getReference('impact.display');
		if ($data) {
			foreach($data as $row) {
				$res[$row['ref_key']] = $row['ref_value'];
			}
		}
		echo json_encode($res);
		exit;
	}
	
	public function getRiskLevelReference() 
	{
		$res = array();
		
		$data = $this->mriskregister->getReference('risklevel.display');
		if ($data) {
			foreach($data as $row) {
				$res[$row['ref_key']] = $row['ref_value'];
			}
		}
		echo json_encode($res);
		exit;
	}
	
	public function getRiskLibrary() 
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
		
		$data = $this->risk->getDataMode('allRiskLibrary', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getActionLibrary() 
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
		
		$data = $this->risk->getDataMode('allActionLibrary', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	//ini di pake dimana mana loadrisklibrary
	public function loadRiskLibrary($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak
			$cek_from_library = $this->risk->cek_from_library($rid);
				$datax = $this->risk->getRiskById($rid);
			
			if(!$datax){
				if ($datax['risk_input_by'] != $session_data['username']) {				
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskById($rid,$session_data['username']);
				} 
			}			
			 
			echo json_encode($datax);
		}
	}

	public function loadRiskLibrary_primary_c($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak			
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskByIdprimary_c($rid);
		
			 
			echo json_encode($datax);
		}
	}

	public function loadRiskLibrary_change_c($rid, $uid) 
	{
			if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak			
				//echo "<pre>";print_r($datax);exit;
								
				$datax = $this->risk->getRiskByIdchange_c($rid, $uid);
		
			 
			echo json_encode($datax);
		}
	}


	public function loadRiskLibraryModify($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak
			$cek_from_library = $this->risk->cek_from_library($rid);

			if($cek_from_library == true){
				$datax = $this->risk->getRiskById_change($rid, $session_data['username']);
			}else{
				$datax = $this->risk->getRiskById($rid);
			}
			 
			
			
			if(!$datax){
				if ($datax['risk_input_by'] != $session_data['username']) {				
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskById_change($rid,$session_data['username']);
				 
				} 
			}			
			 
			echo json_encode($datax);
		}
	}
	
	public function loadRiskLibrary_change($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getRiskById_change($rid);
			echo json_encode($data);
		}
	}


	public function loadRiskLibrary_own($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak
			$cek_from_library = $this->risk->cek_from_library($rid);
				$datax = $this->risk->getRiskById($rid);
			
			if(!$datax){
				if ($datax['risk_input_by'] != $session_data['username']) {				
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskById_own($rid,$session_data['username']);
				} 
			}			
			 
			echo json_encode($datax);
		}
	}


		public function loadRiskLibraryOwner($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			$datax = $this->risk->getRiskByIdowner($rid);		
			 
			echo json_encode($datax);
		}
	}

	public function loadRiskLibrary_actplan($rid,$act_id) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getRiskById_actplan($rid,$act_id);
			echo json_encode($data);
		}
	}
	
	public function loadRiskLibraryChange($rid,$risk_input_by) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			
			$this->load->model('risk/risk');
			$data = $this->risk->getRiskChangeById($rid,$risk_input_by);
			echo json_encode($data);
		}
	}
	
	public function loadRiskForChange($rid, $aid = false) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getRiskById($rid);
			
			$ap_list = $data['action_plan_list'];
			$data['action_plan_list'] = false;
			
			foreach($ap_list as $k=>$vdata) {
				if ($aid && $aid != $vdata['id']) {
					continue;
				} else {
					if ($aid) {
						$vdata['change_flag'] = 'CHANGE';						
						$vdata['data_flag'] = NULL;
						$data['action_plan_list'][$k] = $vdata;
					} else {
						$vdata['change_flag'] = 'CHANGE';
						
						$vdata['data_flag'] = NULL;
						$stat = $vdata['action_plan_status'];
						$ass = $vdata['assigned_to'];
						if ( $stat > 0 && ($ass != '' && $ass != null )  ) {
							$vdata['data_flag'] = 'LOCKED';
						}
						
						$data['action_plan_list'][$k] = $vdata;
					}
				}
			}
			
			echo json_encode($data);
		}
	}

	public function loadRiskForChange2($rid, $aid = false) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getRiskByIdchanges($rid);
			
			$ap_list = $data['action_plan_list'];
			$data['action_plan_list'] = false;
			
			foreach($ap_list as $k=>$vdata) {
				if ($aid && $aid != $vdata['id']) {
					continue;
				} else {
					if ($aid) {
						$vdata['change_flag'] = 'CHANGE';						
						$vdata['data_flag'] = NULL;
						$data['action_plan_list'][$k] = $vdata;
					} else {
						$vdata['change_flag'] = 'CHANGE';
						
						$vdata['data_flag'] = NULL;
						$stat = $vdata['action_plan_status'];
						$ass = $vdata['assigned_to'];
						if ( $stat > 0 && ($ass != '' && $ass != null )  ) {
							$vdata['data_flag'] = 'LOCKED';
						}
						
						$data['action_plan_list'][$k] = $vdata;
					}
				}
			}
			
			echo json_encode($data);
		}
	}

	public function loadRiskAggregate($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak			
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskAgById($rid);
		
			 
			echo json_encode($datax);
		}
	}
	
	public function loadRiskAggregateNew($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
			
			//cek dulu dari library apa nggak			
				//echo "<pre>";print_r($datax);exit;				
				$datax = $this->risk->getRiskAgNewById($rid);
		
			 
			echo json_encode($datax);
		}
	}
	

	public function getControlLibrary() 
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
		
		$data = $this->risk->getDataMode('allControlLibrary', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getControlLibraryobjective() 
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
		
		$data = $this->risk->getDataMode('allControlLibraryobjective', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getControlLibraryexisting() 
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
		
		$data = $this->risk->getDataMode('allControlLibraryExisting', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getDivision() 
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
		
		$data = $this->risk->getDataMode('allDivisi', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getRiskInputBy() 
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
		
		$data = $this->risk->getDataMode('RiskInputBy_Id', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getDisImpact() 
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
		
		$data = $this->risk->getDataMode('diffImpact', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function loadControlLibrary($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getControlById($rid);
			echo json_encode($data);
		}
	}

	public function loadControlLibraryobjective($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getControlById3($rid);
			echo json_encode($data);
		}
	}

	public function loadControlLibraryexisting($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getControlById2($rid);
			echo json_encode($data);
		}
	}
	
	public function loadactionLibrary($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getActionById($rid);
			echo json_encode($data);
		}
	}

	public function loadControlLibraryDivisi($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$data = $this->risk->getControlDivisi($rid);
			echo json_encode($data);
		}
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskGetRollOver_change_rac($username)
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $username,
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('userRollover', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('user', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function riskGetDataUser_change_rac($username)
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
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		
		$defFilter = array(
			'userid' => $username,
			'periodid' => $periode_id
		);
		$data = $this->mriskregister->getDataMode('user', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function insertRiskData()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}
		
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
		
		// build data
		$risk = array(
			'risk_code' => $code,
			'risk_status' => $rstatus,
			'periode_id' => $periode_id,
			'risk_input_by' => $data['session']['username'],
			'risk_input_division' => $data['session']['division_id'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $data['session']['username']
		);
		// array untuk dari library nih ubah
		$risk2 = array(
			'risk_code' => $_POST['risk_library_code'],
			'risk_status' => $rstatus,
			'periode_id' => $periode_id,
			'risk_input_by' => $data['session']['username'],
			'risk_input_division' => $data['session']['division_id'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $data['session']['username']
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
		
		if ($_POST['risk_library_id'] != null) {
			$cek_risk_code = $this->mriskregister->cekRiskCodeRegisterLibrary($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
			if($cek_risk_code == true){
				$resp['success'] = false;
				$resp['msg'] = 'The Risk ID of this '.$username_user.' already exists';
			}else{
				$res = $this->mriskregister->insertRiskRegisterLibrary($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
			}
		} else {
			$res = $this->mriskregister->insertRiskRegister($risk, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
		}
		
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


	public function insertRiskDataAddhoc()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}
		
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
		
		// build data
		$risk = array(
			'risk_code' => $code,
			'risk_status' => $rstatus,
			'periode_id' => $periode_id,
			'risk_input_by' => $data['session']['username'],
			'risk_input_division' => $data['session']['division_id'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $data['session']['username']
		);
		// array untuk dari library nih ubah
		$risk2 = array(
			'risk_code' => $_POST['risk_library_code'],
			'risk_status' => $rstatus,
			'periode_id' => $periode_id,
			'risk_input_by' => $data['session']['username'],
			'risk_input_division' => $data['session']['division_id'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $data['session']['username']
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
		
		if ($_POST['risk_library_id'] != null) {
			$cek_risk_code = $this->mriskregister->cekRiskCodeRegisterLibrary($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
			if($cek_risk_code == true){
				$resp['success'] = false;
				$resp['msg'] = 'The Risk ID of this '.$username_user.' already exists';
			}else{
				$res = $this->mriskregister->insertRiskRegisterLibraryAddhoc($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
			}
		} else {
			$res = $this->mriskregister->insertRiskRegisterAddhoc($risk, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
		}
		
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

	public function insertRiskDataRac($username_user)
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = 0;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$rstatus = 2;
		}
		
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
		
		// build data
		$risk = array(
			'risk_code' => $code,
			'risk_status' => 2,
			'periode_id' => $periode_id,
			'risk_input_by' => $username_user,
			'risk_input_division' =>  $_POST['risk_division'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $username_user
		);
		// array untuk dari library nih ubah
		$risk2 = array(
			'risk_code' => $_POST['risk_library_code'],
			'risk_status' => 2,
			'periode_id' => $periode_id,
			'risk_input_by' => $username_user,
			'risk_input_division' => $_POST['risk_division'],
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
			//'existing_control_id' => $_POST['existing_control_id'],
			//'risk_existing_control' => $_POST['risk_existing_control'],
			//'risk_evaluation_control' => $_POST['risk_evaluation_control'],
			//'risk_control_owner' => $_POST['risk_control_owner'],
			'risk_level' => $_POST['risk_level_id'],
			'risk_impact_level' => $_POST['risk_impact_level_id'],
			'risk_likelihood_key' => $_POST['risk_likelihood_id'],
			'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
			'created_by' => $username_user
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
		
		if ($_POST['risk_library_id'] != null) {
			$cek_risk_code = $this->mriskregister->cekRiskCodeRegisterLibrary($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
			if($cek_risk_code == true){
				$resp['success'] = false;
				$resp['msg'] = 'The Risk ID of this '.$username_user.' already exists';
			}else{
				$res = $this->mriskregister->insertRiskRegisterLibrary($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
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
			$res = $this->mriskregister->insertRiskRegister($risk, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective);
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
	
	public function confirmRisk() {
		
		//$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$session_data = $this->session->credential;
		
		/*	
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;
		*/	
			$res = $this->risk->riskSetConfirm($_POST['risk_id'], $session_data['username']);
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}else{
				$resp['success'] = false;
				$resp['msg'] = 'Error';
			}
		}
		
		echo json_encode($resp);
	}
	
	public function draftRisk() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = array();
			
			$res = $this->risk->riskSetDraft($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-SETDRAFT');
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}
	
	public function draftRiskByPeriode() {
		$session_data = $this->session->credential;
		$resp = array('success' => false, 'msg' => 'Error');
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			
			$data = array();
			
			$res = $this->risk->riskSetDraftByPeriode($periode_id, $session_data['username']);
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}

		echo json_encode($resp);
	}
	
	public function submitRiskByPeriode() {
		$session_data = $this->session->credential;
		$resp = array('success' => false, 'msg' => 'Error');
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$data = array();
			
			$cek_control_submit = $this->risk->cek_control_submit($session_data['username'],$periode_id);
			$cek_ap_submit = $this->risk->cek_ap_submit($session_data['username'],$periode_id);
			$cek_ap_recylebin = $this->risk->cek_ap_recylebin($session_data['username'],$periode_id);


			if($cek_control_submit == true & $cek_ap_submit == true){
				$res = false ;
				$msg = 'You have a Control and Due Date on Action Plan that has not been filled !';
			}else if($cek_control_submit == true & $cek_ap_submit == false){
				$res = false ;
				$msg = 'You have a Control that has not been filled !';
			}else if($cek_control_submit == false & $cek_ap_submit == true){
				$res = false ;
				$msg = 'You have a Due Date on Action Plan that has not been filled !';
			}else if($cek_ap_recylebin == true){
				$res = false;
				$msg = 'Delete All recyle bin User recover risk !';
			}else{
				$res = $this->risk->riskSetSubmitByPeriode($periode_id, $session_data['username']);
			$msg = 'SUCCESS';
			}

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = $msg;
			}else{
				$resp['success'] = false;
				$resp['msg'] = $msg;
			}
		}

		echo json_encode($resp);
	}

	public function submitRiskByPeriode2() {
		$session_data = $this->session->credential;
		$resp = array('success' => false, 'msg' => 'Error');
		
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			
			$data = array();
			
			$res = $this->risk->riskSetSubmitByPeriode2($periode_id, $session_data['username']);
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}

		echo json_encode($resp);
	}

	public function submitRiskByPeriode2_change($user) {
		$session_data = $this->session->credential;
		$resp = array('success' => false, 'msg' => 'Error');
		
		$periode = $this->mperiode->getCurrentPeriode();
		//$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			
			$data = array();
			
			$res = $this->risk->riskSetSubmitByPeriode2_change($periode_id, $user);
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}

		echo json_encode($resp);
	}

	public function submitRiskByPeriode2_ignore($user) {
		$session_data = $this->session->credential;
		$resp = array('success' => false, 'msg' => 'Error');
		
		$periode = $this->mperiode->getCurrentPeriode();
		//$periode_id = null;
		if ($periode) {
			$periode_id = $periode['periode_id'];
			
			$data = array();
			
			$res = $this->risk->riskSetSubmitByPeriode2_ignore($periode_id, $user);
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}

		echo json_encode($resp);
	}
	
	public function deleteRisk() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = array();
			
			$res = $this->risk->getRiskValidate('viewMyRisk', $_POST['risk_id'], $session_data);
			
			if ($res && $res['risk_status'] >= '0') {
				$res = $this->risk->deleteRisk($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
				
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['msg'] = 'You Cannot Delete This Risk';
			}
		}
		
		echo json_encode($resp);
	}

//oktober 10/16
	public function deleteRiskUp() {

		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;
			
			$res = $this->risk->riskSetConfirm_under($_POST['risk_id'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');
			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}

	public function deleteRiskgrid2() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = array();
			
			$res = $this->risk->getRiskValidate('viewMyRisk', $_POST['risk_id'], $session_data);
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = $periode['periode_id'];

			//cek dulu dari library apa nggak
			$cek_from_library = $this->risk->cek_from_library($_POST['risk_id']);

			$cek_from_roll_forward = $this->risk->cek_from_roll_forward($_POST['risk_id'],$periode_id,$session_data['username']);


			if ($res && $res['risk_status'] >= '0') {
				

				if($cek_from_library == true){
					if($cek_from_roll_forward == true){
						//$res = $this->risk->deleteRiskgrid2Bentrok($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
						$res = $this->risk->deleteRiskgrid2fromlibrary($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
					}else{
						$res = $this->risk->deleteRiskgrid2fromlibrary($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
						$res = $this->risk->deleteRiskgrid2($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
					}
				}else{

				$res = $this->risk->deleteRiskgrid2($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
				$res = $this->risk->deleteRiskgrid2fromlibrary($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
					
				}
				
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			} else {
				$resp['msg'] = 'You Cannot Delete This Risk';
			}
		}
		
		echo json_encode($resp);
	}

	// Oktober 11/16
	public function deleteRiskgrid3_rac() {
	$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;


			//end
			$res = $this->risk->riskSetDelete_recover_rac($_POST['risk_id'], $_POST['username'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}

	public function deleteRiskgridfrom_rac() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;


			//end
			$res = $this->risk->deleteRiskgrid2_rac($_POST['risk_id'], $_POST['risk_input_by'], $data, $session_data['username'], 'RISK_REGISTER-CONFIRM');

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		}
		
		echo json_encode($resp);
	}

	//ubah under
	public function deleteRisk_under() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');

		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = array();
			
			//$res = $this->risk->getRiskValidate('viewMyRisk', $_POST['risk_id'], $session_data);
			
			
				$res = $this->risk->deleteRisk_under($_POST['risk_id'], $session_data['username'], 'RISK_EXERCISE-DELETE');
				
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			
		}
		
		echo json_encode($resp);
	}
	
	public function modifyRiskData()
	{
		$resp['success'] = false;
		$resp['msg'] = '';
		
		$data = $this->loadDefaultAppConfig();
		$cred = $this->session->credential;
		
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$risk = $this->risk->getRiskValidate('viewMyRisk', $_POST['risk_id'], $cred);
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
					'risk_input_by' => $data['session']['username'],
					'risk_input_division' => $data['session']['division_id'],
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
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_by' => $data['session']['username']
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
				

				$res_tmp = $this->risk->updateRiskModify_tmp($_POST['risk_id'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], 'RISK_REGISTER-MODIFY');
				
				$cek_plan_duedate = $this->risk->cek_plan_duedate($_POST['risk_id']);
				if($cek_plan_duedate == true) {
					$res = false;
					$msg ='You have a Due Date on Action Plan that has not been filled';
				}else{
					if ($_POST['risk_library_id'] == null){
					$res = $this->risk->updateRiskModify($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], 'RISK_REGISTER-MODIFY');	
					}else{
					$res = $this->risk->updateRiskModifyLibrary($_POST['risk_id'], $_POST['suggested_risk_treatment'], $code, $risk, $impact_level, $actplan, $control, $objective, $data['session']['username'], 'RISK_REGISTER-MODIFY');		
					}
					$msg = $this->db->error();
				}
				

				$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $msg;
				}
			} else {
				$resp['msg'] = 'You Are Not Allowed to Modify this Risk';
			}
			echo json_encode($resp);
		}
	}
	
	public function ChangeRequestInput($risk_id, $userid)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
		
			$res = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $session_data);
			
			//echo "<pre>";
			//print_r($res);
			//exit;
			 
			if ($res) {
				 
				$data = $this->loadDefaultAppConfig();
				
				$res_valid = $this->risk->getRiskValidate('valEntryRiskChange', $risk_id, $session_data);
				$data['valid_entry'] = false;

				if ($res_valid) {
					$data['valid_entry'] = true;
				}
				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
				$data['indonya'] = base_url('index.php/maini');
				$data['engnya'] = base_url('index.php/main');				
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
				
				<script src="assets/scripts/risk/cr_riskregister.js"></script>
				';
				
				if ($res_valid) {
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					
					$data['risk_id'] = $risk_id;
					$data['user_id'] = $userid;
					$data['change_type'] = 'Risk Form';
					
					$data['category'] = $this->mriskregister->getRiskCategory();
					$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
					$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
					$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
					$data['division_list'] = $this->mriskregister->getDivisionList();


					//compare change request user
					$time_compare = $this->mriskregister->time_compare($risk_id);
					$data['time_compare'] = $time_compare->created_date;
				}
				
				$this->load->view('main/header', $data);
				$this->load->view('change_request_input', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function ChangeRequestInputchange($risk_id, $userid)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
		
			$res = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $session_data);
			
			//echo "<pre>";
			//print_r($res);
			//exit;
			 
			if ($res) {
				 
				$data = $this->loadDefaultAppConfig();
				
				$res_valid = $this->risk->getRiskValidate('valEntryRiskChange', $risk_id, $session_data);
				$data['valid_entry'] = false;

				if ($res_valid) {
					$data['valid_entry'] = true;
				}
				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
				$data['indonya'] = base_url('index.php/maini');
				$data['engnya'] = base_url('index.php/main');				
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
				
				<script src="assets/scripts/risk/cr_riskregister_change.js"></script>
				';
				
				if ($res_valid) {
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					
					$data['risk_id'] = $risk_id;
					$data['user_id'] = $userid;
					$data['change_type'] = 'Risk Form Library';
					
					$data['category'] = $this->mriskregister->getRiskCategory();
					$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
					$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
					$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
					$data['division_list'] = $this->mriskregister->getDivisionList();


					//compare change request user
					$time_compare = $this->mriskregister->time_compare($risk_id);
					$data['time_compare'] = $time_compare->created_date;
				}
				
				$this->load->view('main/header', $data);
				$this->load->view('change_request_input_change', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function ChangeRequestDelete($risk_id)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
		
			$res = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $session_data);
			
			if ($res) {
				$data = $this->loadDefaultAppConfig();
				
				$res_valid = $this->risk->getRiskValidate('valEntryRiskChange', $risk_id, $session_data);
				$data['valid_entry'] = false;

				if ($res_valid) {
					$data['valid_entry'] = true;
				}
				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
				$data['indonya'] = base_url('index.php/maini');
				$data['engnya'] = base_url('index.php/main');				
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
				
				<script src="assets/scripts/risk/cr_riskregister.js"></script>
				';
				
				if ($res_valid) {
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					
					$data['risk_id'] = $risk_id;
					$data['change_type'] = 'Delete Risk';
					
					$data['category'] = $this->mriskregister->getRiskCategory();
					$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
					$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
					$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					//compare change request user
					$time_compare = $this->mriskregister->time_compare($risk_id);
					$data['time_compare'] = $time_compare->created_date;
				}
				
				

				$this->load->view('main/header', $data);
				$this->load->view('change_request_input', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
	
	public function submitChangeRisk($time_compare)
	{
		$session_data = $this->session->credential;
		if (isset($_POST['risk_id'])) {
			// build data
			if ($_POST['change_type'] == 'Risk Form') {
				$risk = array(
					'cr_type' => $_POST['change_type'],
					'risk_id' => $_POST['risk_id'],
					'risk_status' => $_POST['risk_status'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_by' => $session_data['username']
				);
			}

			if ($_POST['change_type'] == 'Risk Form Library') {
				$risk = array(
					'cr_type' => $_POST['change_type'],
					'risk_id' => $_POST['risk_id'],
					'risk_status' => $_POST['risk_status'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_by' => $session_data['username']
				);
			}

			if ($_POST['change_type'] == 'Delete Risk') {
				$risk = array(
					'cr_type' => $_POST['change_type'],
					'risk_id' => $_POST['risk_id'],
					'risk_status' => $_POST['risk_status'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_by' => $session_data['username']
				);
			}
			
			if ($_POST['change_type'] == 'Risk Owner Form') {
				$drisk = $this->risk->getRiskByIdNoRef($_POST['risk_id']);
				$risk = array(
					'cr_type' => $_POST['change_type'],
					'risk_id' => $_POST['risk_id'],
					'risk_status' => 5,
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_cause' => $_POST['risk_cause'],
					'risk_impact' => $_POST['risk_impact'],
					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id'],
					'suggested_risk_treatment' => $_POST['suggested_risk_treatment'],
					'created_by' => $session_data['username']
				);
			}
			
			if ($_POST['change_type'] == 'Action Plan Form') {
				$drisk = $this->risk->getRiskByIdNoRef($_POST['risk_id']);
				$risk = array(
					'cr_type' => $_POST['change_type'],
					'risk_id' => $_POST['risk_id'],
					'risk_status' => $_POST['risk_status'],
					'risk_event' => $_POST['risk_event'],
					'risk_description' => $_POST['risk_description'],
					'risk_owner' => $_POST['risk_division'],
					'risk_division' => $_POST['risk_division'],
					'risk_cause' => $drisk['risk_cause'],
					'risk_impact' => $drisk['risk_impact'],
					'risk_level' => $drisk['risk_level'],
					'risk_impact_level' => $drisk['risk_impact_level'],
					'risk_likelihood_key' => $drisk['risk_likelihood_key'],
					'suggested_risk_treatment' => $drisk['suggested_risk_treatment'],
					'created_by' => $session_data['username']
				);
			}
			
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

			if ($_POST['change_type'] == 'Risk Form Library') {
					$res = $this->risk->insertChangeRequestChange($risk, $_POST['suggested_risk_treatment'], $_POST['risk_status'], $impact_level, $actplan, $control, $objective, $this->session->credential['username']);
			}else{
				$res = $this->risk->insertChangeRequest($risk, $_POST['suggested_risk_treatment'], $_POST['risk_status'], $impact_level, $actplan, $control, $objective, $this->session->credential['username']);
			}
			$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}

			//compare change request
			/*$time_format = str_replace('_', ' ', $time_compare);
			$cek_risk_compare = $this->mriskregister->cek_risk_compare($_POST['risk_id'],$time_format);
   
			if($cek_risk_compare){
			$res = $this->risk->insertChangeRequest($risk, $_POST['suggested_risk_treatment'], $_POST['risk_status'], $impact_level, $actplan, $control, $objective, $this->session->credential['username']);
			$resp = array();
				if ($res) {
					$resp['success'] = true;
					$resp['msg'] = 'SUCCESS';
				} else {
					$resp['success'] = false;
					$resp['msg'] = $this->db->error();
				}
			}else{
				$resp['time_compare'] = true;
			}*/
			echo json_encode($resp);
		}
	}
	
	public function ChangeRequestView($risk_id)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
			
			$res = $this->risk->getRiskValidate('viewMyChange', $risk_id, $session_data);
			if ($res) {
				
				$data = $this->loadDefaultAppConfig();
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
				$data['indonya'] = base_url('index.php/maini');
				$data['engnya'] = base_url('index.php/main');				
				$data['pageLevelStyles'] = '';
				
				if ($res['cr_type'] == 'KRI Form')  {
					$kri = $this->risk->getKriById($res['risk_cause']);
					$data['kri'] = $kri;
					$risk = $this->risk->getRiskById($kri['risk_id']);
					$data['risk'] = $risk;
					
					$data['change'] = $res;
					
					$data['pageLevelScripts'] = '';
					$data['pageLevelScriptsInit'] = '';
					$v = 'change_request_kri';
				} else {
					$data['pageLevelScripts'] = '
					<script src="assets/scripts/risk/cr_riskregister_view.js"></script>
					';
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					$v = 'change_request_view';
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
	}
	

	public function ChangeRequestView2($risk_id)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
			
			$res = $this->risk->getRiskValidate('viewMyChange', $risk_id, $session_data);
			if ($res) {
				
				$data = $this->loadDefaultAppConfig();
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic');
				$data['indonya'] = base_url('index.php/maini');
				$data['engnya'] = base_url('index.php/main');				
				$data['pageLevelStyles'] = '';
				
				if ($res['cr_type'] == 'KRI Form')  {
					$kri = $this->risk->getChangeRequestKriById($res['id'], $res['risk_cause']);
					$data['kri'] = $kri;
					$risk = $this->risk->getRiskById($kri['risk_id']);
					$data['risk'] = $risk;
					
					$data['change'] = $res;
					
					$data['pageLevelScripts'] = '';
					$data['pageLevelScriptsInit'] = '';
					$v = 'change_request_kri_view';
				} else {
					$data['pageLevelScripts'] = '
					<script src="assets/scripts/risk/cr_riskregister_view.js"></script>
					';
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					$v = 'change_request_view';
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
	}
	

	public function loadChangeRequest($mode, $rid) {
		if (!empty($rid) && is_numeric($rid)) {
			$data = array();
			if ($mode == 'primary') {
				$data = $this->risk->getChangeById($rid, false);
			}
			
			if ($mode == 'changes') {
				$data = $this->risk->getChangeById($rid, true);
			}
			
			echo json_encode($data);
		}
	}
	
	public function ChangeRequestOwned($risk_id)
	{
		$session_data = $this->session->credential;
		
		if (!empty($risk_id) && is_numeric($risk_id)) {
		
			$res = $this->risk->getRiskValidate('viewRiskByDivision', $risk_id, $session_data);
			
			if ($res) {
				$data = $this->loadDefaultAppConfig();
				
				$res_valid = $this->risk->getRiskValidate('valEntryRiskChange', $risk_id, $session_data);
				$data['valid_entry'] = false;

				if ($res_valid) {
					$data['valid_entry'] = true;
				}
				$data['indonya'] = base_url('index.php/maini/mainpic');
				$data['engnya'] = base_url('index.php/main/mainpic');				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
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
				
				<script src="assets/scripts/risk/cr_riskregister_own.js"></script>
				';
				
				if ($res_valid) {
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					
					$data['risk_id'] = $risk_id;
					$data['change_type'] = 'Risk Owner Form';
					
					$data['category'] = $this->mriskregister->getRiskCategory();
					$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
					$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
					$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
					$data['division_list'] = $this->mriskregister->getDivisionList();

					//compare change request user
					$time_compare = $this->mriskregister->time_compare($risk_id);
					$data['time_compare'] = $time_compare->created_date;
				}
				
				$this->load->view('main/header', $data);
				$this->load->view('change_request_own', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
	
	public function ChangeRequestAction($act_id)
	{
		
		$session_data = $this->session->credential;
		$action = $this->risk->getActionPlanById($act_id);
		
		if ($action && !empty($act_id) && is_numeric($act_id)) {
			$risk_id = $action['risk_id'];
			
			$res = $this->risk->getRiskValidate('viewRiskByDivision', $risk_id, $session_data);

			if ($res) {
				$data = $this->loadDefaultAppConfig();
				$res_valid = $this->risk->getRiskValidate('valEntryActionChange', $act_id, $session_data);				
				$data['valid_entry'] = false;

				if ($res_valid) {
					$data['valid_entry'] = true;
				}
				
				$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic');
				$data['indonya'] = base_url('index.php/maini/mainpic');
				$data['engnya'] = base_url('index.php/main/mainpic');					
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

				<script src="assets/scripts/risk/cr_riskregister_actplan.js"></script>
				';
				
				if ($res_valid) {
					$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
					
					$data['risk_id'] = $risk_id;
					$data['act_id'] = $act_id;
					$data['change_type'] = 'Action Plan Form';
					
					$data['category'] = $this->mriskregister->getRiskCategory();
					$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
					$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
					$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
				}

				$data['time_compare'] = '';
				
				$this->load->view('main/header', $data);
				$this->load->view('change_request_input', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
	
	public function ChangeRequestKri($rid)
	{
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic');
			$data['pageLevelStyles'] = '
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			';
			$data['pageLevelScripts'] = '
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
			<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
			<script src="assets/scripts/risk/cr_riskregister_kri.js"></script>';
			$data['pageLevelScriptsInit'] = 'ChangeRequest.init();';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				$data['input'] = true;
				$view = 'risk/change_request_kri';
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
	
	public function submitChangeKri()
	{
		$session_data = $this->session->credential;
		if (isset($_POST['risk_id'])) {
			// build data
			$drisk = $this->risk->getRiskByIdNoRef($_POST['risk_id']);
			
			$kri = $this->risk->getKriById($_POST['kri_id']);
			$kri_warning = null;
			$report = null;
			$description = null;
			$treshold_type = $kri['treshold_type'];
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'].$value['result'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
						$report = $value['value_1'];
						$description = NULL;
					}
				}
			} else {
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['operator'].$value['value_1'].$value['value_type'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
						$report = $value['value_1'];
						$description = $value['value_type'];
					}
				}
			}
			
			
			$risk = array(
				'cr_type' => 'KRI Form',
				'risk_id' => $_POST['risk_id'],
				'risk_cause' => $_POST['kri_id'],
				'risk_impact' => $report,
				'risk_level' => $kri_warning,
				'risk_impact_level' => NULL,
				'risk_likelihood_key' => NULL,
				'suggested_risk_treatment' => NULL,
				'created_by' => $session_data['username']
			);
			
			$impact_level = false;
			$actplan = false;
			$control = false;
			
			$res = $this->risk->insertChangeRequestKri($risk, $report, $kri_warning, $_POST['support'], $description, $treshold_type);
			
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

	public function deleteSelectRecoverRisk() {
		if (isset($_POST['risk_id']) && is_array($_POST['risk_id']) && count($_POST['risk_id']) > 0) {
			$res = $this->risk->deleteSeletedRiskRecover($_POST['risk_id']);
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

	public function deleteSelectRecoverRiskfr() {
		if (isset($_POST['risk_id']) && is_array($_POST['risk_id']) && count($_POST['risk_id']) > 0) {
			$res = $this->risk->deleteSeletedRiskRecoverfr($_POST['risk_id']);
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

	public function deleteAllRecoverRisk() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;


			//end
			$res = $this->risk->deleteRiskRecoverall();

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		
		echo json_encode($resp);
	}

	public function deleteAllRecoverRollFR() {
		$session_data = $this->session->credential;
		
		$resp = array('success' => false, 'msg' => 'Error');
			
			$periode = $this->mperiode->getCurrentPeriode();
			$periode_id = null;
			if ($periode) {
				$periode_id = $periode['periode_id'];
			}
			
			$data['periode_id'] = $periode_id;


			//end
			$res = $this->risk->deleteRecoverRollFRall();

			if ($res) {
				$resp['success'] = true;
				$resp['msg'] = 'SUCCESS';
			}
		
		echo json_encode($resp);
	}

	public function RiskAggregateInput($mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');				
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
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
		
		<script src="assets/scripts/risk/riskinputag.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['pid'] = $this->uri->segment(4);
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_aggregate_input', $data);
		$this->load->view('main/footer', $data);	
	}


	public function RiskAggregateInputNew($mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		$data['indonya'] = base_url('index.php/riski/RiskRegister/');
		$data['engnya'] = base_url('index.php/risk/RiskRegister/');				
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_aggregate');
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
		
		<script src="assets/scripts/risk/riskinputagnew.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['pid'] = $this->uri->segment(4);
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_aggregatenew_input', $data);
		$this->load->view('main/footer', $data);	
	}


	public function insertRiskAgregate()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}
		
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		$risk2 = array(
			'risk_id' => $_POST['risk_id'],
			'risk_code' => $_POST['risk_library_code'],
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
		

		$res = $this->mriskregister->insertRiskAgg($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective, $periode_max['periode_id']);
		
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


	public function insertRiskAgregateNew()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}
		
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		$risk2 = array(
			'risk_id' => $_POST['risk_id'],
			'risk_code' => $_POST['risk_library_code'],
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
		

		$res = $this->mriskregister->insertRiskAggNew($risk2, $_POST['suggested_risk_treatment'], $code, $impact_level, $actplan, $control, $objective, $periode_max['periode_id']);
		
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


	public function saveRiskDataAggNew()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}
		
		$this->load->model('risk/risk');
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		$risk2 = array(
			'risk_id' => $_POST['risk_id'],
			'risk_code' => $_POST['risk_library_code'],
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
		

		$res = $this->risk->updateRiskAggNew($_POST['risk_id'], $_POST['risk_idag'], $_POST['suggested_risk_treatment'], $risk2, $impact_level, $actplan, $control, $objective, $data['session']['username']);
		
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


	public function transferRiskAgregateNew()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		$periode = $this->mperiode->getCurrentPeriode();	
		$periode_max = $this->mperiode->getMaxPeriode();
		if ($periode) {
			$periode_id = $periode['periode_id'];
			$rstatus = 0;
		} else {
			$periode_id = $periode_max['periode_id'];
			$rstatus = 2;
		}

		$this->load->model('risk/risk');
		// category
		$this->load->model('admin/mcategory');
		$cats = $this->mcategory->getDataById($_POST['risk_2nd_sub_category']);
		$seq_id = $this->mcategory->getSequence($_POST['risk_2nd_sub_category']);
		$code = $cats['cat_code'].'-'.$seq_id;
		
		if ($_POST['risk_library_id'] == '') $_POST['risk_library_id'] = null;
		
		// build data
		$risk = array(
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

		$risk2 = array(
			'risk_id' => $_POST['risk_id'],
			'risk_code' => $_POST['risk_library_code'],
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
		

		$res = $this->risk->transferRiskAggNew($_POST['risk_id'], $_POST['risk_idag'], $_POST['suggested_risk_treatment'], $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);


		$res = $this->risk->updateRiskAggTransferNew($_POST['risk_id'], $_POST['risk_idag'], $_POST['suggested_risk_treatment'], $risk2, $impact_level, $actplan, $control, $objective, $data['session']['username']);
		
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

	public function LossEventInput($mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		$data['indonya'] = base_url('index.php/riski/lossevent');
		$data['engnya'] = base_url('index.php/risk/lossevent');				
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/lossevent');
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
		
		<script src="assets/scripts/risk/loss_event_input.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		$data['sektor_list'] = $this->mriskregister->getSektorList();

		$this->load->view('main/header', $data);
		$this->load->view('loss_event_input', $data);
		$this->load->view('main/footer', $data);	
	}


	public function insertLossEvent()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		
		$risk2 = array(
			'sektor_proyek' => $_POST['sektor_proyek'],
			'nama_proyek' => $_POST['nama_proyek'],
			'nilai_proyek' => $_POST['nilai_proyek'],
			'kejadian' => $_POST['kejadian'],
			'tipe' => $_POST['tipe'],
			'nilai_kerugian' => $_POST['nilai_kerugian'],
			'deskripsi' => $_POST['deskripsi'],
			'periode' => $_POST['periode'],
			'penyebab' => $_POST['penyebab'],
			'fungsi_terkait' => $_POST['fungsi_terkait'],
			'lesson_learned' => $_POST['lesson_learned']
		);
		
		
		$divisi = array();
		foreach($_POST['divisi'] as $v) {
			$divisi[] = $v;
		}

		$res = $this->mriskregister->InsertLossEvent($risk2, $divisi);
		
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

	public function EditLossEvent($id_event = false, $mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		$data['indonya'] = base_url('index.php/riski/lossevent');
		$data['engnya'] = base_url('index.php/risk/lossevent');				
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/lossevent');
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
		
		<script src="assets/scripts/risk/loss_event_input.js"></script>
		<script src="assets/scripts/risk/loss_event_edit.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();RiskVerify.init();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		$data['sektor_list'] = $this->mriskregister->getSektorList();
		$data['row_event'] = $this->risk->getLossEvent($id_event);

		
		$this->load->view('main/header', $data);
		$this->load->view('loss_event_edit', $data);
		$this->load->view('main/footer', $data);	
	}

	public function loadLossEvent($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('risk/risk');
			$session_data = $this->session->credential;
						
			 $datax = $this->risk->getLossEvent($rid);
		
			 
			echo json_encode($datax);
		}
	}

	public function updateLossEvent()
	{
		$data = $this->loadDefaultAppConfig();

		// periode
		
		$risk2 = array(
			'id_event' => $_POST['id_event'],
			'sektor_proyek' => $_POST['sektor_proyek'],
			'nama_proyek' => $_POST['nama_proyek'],
			'nilai_proyek' => $_POST['nilai_proyek'],
			'kejadian' => $_POST['kejadian'],
			'tipe' => $_POST['tipe'],
			'nilai_kerugian' => $_POST['nilai_kerugian'],
			'deskripsi' => $_POST['deskripsi'],
			'periode' => $_POST['periode'],
			'penyebab' => $_POST['penyebab'],
			'lesson_learned' => $_POST['lesson_learned']
		);
		
		
		$divisi = array();
		foreach($_POST['divisi'] as $v) {
			$divisi[] = $v;
		}

		$res = $this->mriskregister->updateLossEvent($risk2, $divisi);
		
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

	public function ViewLossEvent($id_event = false, $mode = false)
	{
		$data = $this->loadDefaultAppConfig();
		$menu = '';
		
		$data['indonya'] = base_url('index.php/riski/lossevent');
		$data['engnya'] = base_url('index.php/risk/lossevent');				
		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac/lossevent');
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
		
		<script src="assets/scripts/risk/loss_event_view.js"></script>
		<script src="assets/scripts/risk/loss_event_edit.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "RiskInput.init('".$mode."');
		RiskInput.initLoadCategory();RiskVerify.init();
		";
		
		
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
		$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		$data['sektor_list'] = $this->mriskregister->getSektorList();
		$data['row_event'] = $this->risk->getLossEvent($id_event);

		
		$this->load->view('main/header', $data);
		$this->load->view('loss_event_view', $data);
		$this->load->view('main/footer', $data);	
	}

}
