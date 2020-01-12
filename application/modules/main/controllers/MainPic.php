<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainPic extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic');
		$data['indonya'] = base_url('index.php/maini/mainpic');
		$data['engnya'] = base_url('index.php/main/mainpic');		
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link href="assets/css/button3d.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_pic.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		//cek owned
		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		if($rol_id == 4){
			$data['cekowned'] = $this->risk->cekOwned($username,$division_nya);
		}else{
			$data['cekowned'] = $this->risk->cekOwnedpic($username,$division_nya);
		}

		if($rol_id == 4){
			$data['cekplan'] = $this->risk->cekPlan($username,$division_nya);
		}else{
			$data['cekplan'] = $this->risk->cekPlanpic($username,$division_nya);
		}

		if($rol_id == 4){
			$data['cekplanexec'] = $this->risk->cekPlanExec($username,$division_nya);
		}else{
			$data['cekplanexec'] = $this->risk->cekPlanExecpic($username,$division_nya);
		}

		if($rol_id == 4){
			$data['cekkri'] = $this->risk->cekKri($username,$division_nya);
		}else{
			$data['cekkri'] = $this->risk->cekKripic($username,$division_nya);
		}		

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($username);
		$data['s_risk_owner'] = $this->risk->statemen_risk_owner();
		$data['s_action_plan'] = $this->risk->statemen_action_plan();
		$data['s_action_plan_exe'] = $this->risk->statemen_action_plan_exe();
		$data['setting_dasborad'] = $this->risk->dasboard_setting();


		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();


		$this->load->view('header', $data);
		$this->load->view('main_pic', $data);
		$this->load->view('footer', $data);
	}

	
//----------- CHART DASHBOARD----------------------------------------------------------------
	public function chart_risk()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');

		$data['risk_high_submit'] = $this->risk->chart_risk_high_my($username, $division_nya, $rol_id);
		$data['risk_high_verify'] = $this->risk->chart_risk_high_v_my($username, $division_nya, $rol_id);
		$data['risk_moderate_submit'] = $this->risk->chart_risk_moderate_my($username, $division_nya, $rol_id);
		$data['risk_moderate_verify'] = $this->risk->chart_risk_moderate_v_my($username, $division_nya, $rol_id);
		$data['risk_low_submit'] = $this->risk->chart_risk_low_my($username, $division_nya, $rol_id);
		$data['risk_low_verify'] = $this->risk->chart_risk_low_v_my($username, $division_nya, $rol_id);

		$this->load->view('chart/risk_chart_head', $data);
	}

	public function chart_risk_owned()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		if($rol_id == 4){
			$data['treatment_high_submit'] = $this->risk->chart_owned_high($username, $division_nya, $rol_id);
			$data['treatment_moderate_submit'] = $this->risk->chart_owned_moderate($username, $division_nya, $rol_id);
			$data['treatment_low_submit'] = $this->risk->chart_owned_low($username, $division_nya, $rol_id);
			$data['treatment_high_verify'] = $this->risk->chart_owned_high_v($username, $division_nya, $rol_id);
			$data['treatment_moderate_verify'] = $this->risk->chart_owned_moderate_v($username, $division_nya, $rol_id);
			$data['treatment_low_verify'] = $this->risk->chart_owned_low_v($username, $division_nya, $rol_id);
		}else{
			$data['treatment_high_submit'] = $this->risk->chart_owned_high_pic($username, $division_nya, $rol_id);
			$data['treatment_moderate_submit'] = $this->risk->chart_owned_moderate_pic($username, $division_nya, $rol_id);
			$data['treatment_low_submit'] = $this->risk->chart_owned_low_pic($username, $division_nya, $rol_id);
			$data['treatment_high_verify'] = $this->risk->chart_owned_high_v_pic($username, $division_nya, $rol_id);
			$data['treatment_moderate_verify'] = $this->risk->chart_owned_moderate_v_pic($username, $division_nya, $rol_id);
			$data['treatment_low_verify'] = $this->risk->chart_owned_low_v_pic($username, $division_nya, $rol_id);
		}

		$this->load->view('chart/risk_owned_chart_head', $data);
	}

	public function chart_submitted_ap()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		if($rol_id == 4){
			$data['ap_submit'] = $this->risk->chart_submitted_ap_head($username, $division_nya, $rol_id);
			$data['ap_verify'] = $this->risk->chart_verify_ap_head($username, $division_nya, $rol_id);
		}else{
			$data['ap_submit'] = $this->risk->chart_submitted_ap_pic($username, $division_nya, $rol_id);
			$data['ap_verify'] = $this->risk->chart_verify_ap_pic($username, $division_nya, $rol_id);
		}

		$this->load->view('chart/submitted_ap_pie_head', $data);
	}

	public function chart_submitted_apex()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		if($rol_id == 4){
			$data['apex_submit'] = $this->risk->chart_submitted_apex_head($username, $division_nya, $rol_id);
			$data['apex_verify'] = $this->risk->chart_verify_apex_head($username, $division_nya, $rol_id);
		}else{
			$data['apex_submit'] = $this->risk->chart_submitted_apex_pic($username, $division_nya, $rol_id);
			$data['apex_verify'] = $this->risk->chart_verify_apex_pic($username, $division_nya, $rol_id);
		}

		$this->load->view('chart/submitted_apex_head', $data);
	}

	public function chart_submitted_kri()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		if($rol_id == 4){
			$data['kri_submit'] = $this->risk->chart_submitted_kri_head($username, $division_nya, $rol_id);
			$data['kri_verify'] = $this->risk->chart_verify_kri_head($username, $division_nya, $rol_id);
		}else{	
			$data['kri_submit'] = $this->risk->chart_submitted_kri_pic($username, $division_nya, $rol_id);
			$data['kri_verify'] = $this->risk->chart_verify_kri_pic($username, $division_nya, $rol_id);
		}

		$this->load->view('chart/submitted_kri_pie_head', $data);
	}

	public function chart_submitted_changerequest()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/mainrac');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainrac');

		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$rol_id = $this->session->credential['role_id'];

		$this->load->model('risk/risk');
		
			$data['crequest_submit'] = $this->risk->chart_submitted_changerequest_head($username, $division_nya, $rol_id);
			$data['crequest_verify'] = $this->risk->chart_verify_changerequest_head($username, $division_nya, $rol_id);

		$this->load->view('chart/submitted_change_request_pie_head', $data);
	}

//-----------END CHART DASHBOARD----------------------------------------------------------------
	
	public function viewRisk($rid = false) {
		if ($rid && is_numeric($rid)) {
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
			
			$risk = $this->risk->getRiskValidate('viewMyRisk', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}

			$data['risk_user']['nama'] = '';
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_register_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
/*public function viewOwnedRisk_new($risk_id = null,$user_by=null)
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

		$cred = $this->session->credential;
		$data['role'] = $cred['role_id'];
		
		$sql = "select risk_id from t_risk_change where risk_id='".$risk_id."' and risk_input_by ='".$user_by."' " ;
		$query = $this->db->query($sql);

	if ($query->num_rows() > 0){
		$res = $this->risk->getRiskByIdNoRefChanges($risk_id,$user_by);
	}else{
		$res = $this->risk->getRiskByIdNoRef($risk_id);
	}
		if ($res) {
			
			if ($res['risk_status']*1 == 3 && $res['risk_treatment_owner'] == $cred['username']) {
				$data['approval'] = false;

				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskowned_new.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskOwned .init();";
				
				$lib_risk = $this->risk->getRiskByIdNoRef($res['risk_library_id']);
				$data['library_risk'] = $lib_risk;
				$data['library_risk_id'] = $res['risk_library_id'];
				$page_view = 'risk/risk_owner_form_new';

				//cari tanggal submit
				$periode = $this->mperiode->getCurrentPeriode();
				$data['tanggal_submit'] = $this->risk->cari_tanggal_submit($user_by,$periode['periode_id']);

			} else 	if ($res['risk_status']*1 == 4 && $cred['role_id'] == 4) {
				$data['approval'] = true;

				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskowned_new.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskOwned .init();";
				
				$lib_risk = $this->risk->getRiskByIdNoRef($res['risk_library_id']);
				$data['library_risk'] = $lib_risk;
				$data['library_risk_id'] = $res['risk_library_id'];
				$page_view = 'risk/risk_owner_form_new';

				//cari tanggal submit
				$periode = $this->mperiode->getCurrentPeriode();
				$data['tanggal_submit'] = $this->risk->cari_tanggal_submit($user_by,$periode['periode_id']);
			}else{
				Redirect('main/mainpic/viewRisk/'.$risk_id);
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
			'.$verifyJs.'';
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure($menu);
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['risk_input_by'] = $user_by;
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');			
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

*/
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
			$risk = $this->risk->getRiskValidate('viewRiskByDivision', $rid, $cred);
			$view = 'risk/risk_register_view';
			$data['risk_user']['nama'] = '';
			if ($risk) {
				if ($risk['risk_status']*1 > 2) {
					$data['valid_mode'] = true;
					$data['risk'] = $risk;
					
					if ($risk['risk_status']*1 == 3 && $risk['risk_treatment_owner'] == $cred['username']) {
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
						<script src="assets/scripts/risk/riskowned.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('risk/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'risk/risk_owner_form';
					} else if  ($risk['risk_status']*1 == 4 && $cred['role_id'] == 4) { // on approval and is div head
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
						<script src="assets/scripts/risk/riskowned.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "RiskOwned.init();";
						
						$this->load->model('risk/mriskregister');
						$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
						$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
						$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
						$data['division_list'] = $this->mriskregister->getDivisionList();
						
						$view = 'risk/risk_owner_form';
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
	
	
	
	public function getSummaryCount($mode = null) {
		// MODE : myrisk myriskowned myactionplan kri
		$sess = $this->loadDefaultAppConfig();
		
		$this->load->model('risk/risk');
		 
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'division_id' => $sess['session']['division_id']
		);
		
		$tmp = array(
			'HIGH' => 0, 'MODERATE' => 0, 'LOW' => 0
		);
		
		if ($mode == 'myrisk') {
			$data = $this->risk->getSummaryCount('riskLevel', $defFilter);
		} else if ($mode == 'myriskowned') {
			$data = $this->risk->getSummaryCount('myriskowned', $defFilter);
		} else if ($mode == 'myactionplan') {
			$data = $this->risk->getSummaryCount('myactionplan', $defFilter);
		} else if ($mode == 'kri') {
			$data = $this->risk->getSummaryCount('mykri', $defFilter);
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
	
	public function getMyRiskRegister() {
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
			'userid' => $sess['session']['username']
		);
		
		if (isset($_POST['risk_cat']) && $_POST['risk_cat'] != '') {
			$defFilter['risk_cat'] = $_POST['risk_cat'];
		}
		$data = $this->risk->getDataMode('allRiskByOwner', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getOwnedRisk() {
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
		
		$data = $this->risk->getDataMode('ownedRisk', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function assignPic() {
		$data = array();
		$data['success'] = false;
		$data['msg'] = '';
		
		if (isset($_POST['risk_id']) && isset($_POST['pic']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			if ($_POST['mode'] == 'treatment') {
				$res = $this->risk->assignPic($_POST['risk_id'], $_POST['pic']);
			} else if ($_POST['mode'] == 'kri') {
				$res = $this->risk->assignPicKri($_POST['risk_id'], $_POST['pic']);
			} else {
				$res = $this->risk->assignPicAction($_POST['risk_id'], $_POST['pic']);
			}
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['msg'] = 'Error Assign PIC';
			}
		}
		
		echo json_encode($data);
	}

	public function assignPicPrior() {
		$data = array();
		$data['success'] = false;
		$data['msg'] = '';
		
		if (isset($_POST['risk_id']) && isset($_POST['pic']) && is_numeric($_POST['risk_id'])) {
			$this->load->model('risk/risk');
			if ($_POST['mode'] == 'treatment') {
				$res = $this->risk->assignPic($_POST['risk_id'], $_POST['pic']);
			} else if ($_POST['mode'] == 'kri') {
				$res = $this->risk->assignPicKri($_POST['risk_id'], $_POST['pic']);
			} else {
				$res = $this->risk->assignPicActionPrior($_POST['risk_id'], $_POST['pic']);
			}
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['msg'] = 'Error Assign PIC';
			}
		}
		
		echo json_encode($data);
	}
	
	public function riskOwnerGetData($rid = false) {
		if ($rid && is_numeric($rid)) {
			$this->load->model('risk/risk');

			// di ganti karena loading lama risk owner form
			//$data = $this->risk->getRiskChangeById($rid);

			$data = $this->risk->getRiskById($rid);
			if (!$data) {
				$data = $this->risk->getRiskById($rid);
			}
			echo json_encode($data);
		}
	}
//get changes
	public function riskOwnerGetData2($rid = false) {
		if ($rid && is_numeric($rid)) {
			$this->load->model('risk/risk');

			// di ganti karena loading lama risk owner form
			//$data = $this->risk->getRiskChangeById($rid);

			$data = $this->risk->getRiskByIdowner($rid);
			if (!$data) {
				$data = $this->risk->getRiskByIdowner($rid);
			}
			echo json_encode($data);
		}
	}
	
	public function treatmentSubmit()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			// if is div head then submit for verification, if pic for div head verify
			if ($this->session->credential['role_id'] == 4) {
				$stat = 5;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 5;
			} else {
				$stat = 4;
			}
			
			// build data
			$risk = array(
				'risk_status' => $stat,
				'risk_division' => $_POST['risk_division'],
				'risk_owner' => $_POST['risk_division'],
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
			
			$this->load->model('risk/risk');
			// save dulu ke dalam t_risk_own
			$res = $this->risk->treatmentSaveDraft($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
			//apus t_risk utama insert t_risk_chage yang di atas
			$res = $this->risk->treatmentSaveDraft2($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			

			//$riskUpdate = array(
			//	'risk_status' => $stat,
			//	'created_by' => $data['session']['username']
			//);
			// ga perllu pake status udah berubah 
			//$res = $this->risk->treatmentSubmit($_POST['risk_id'], $riskUpdate, $data['session']['username']); 
			//ga ngerti buat apaan!
			//$res = $this->risk->actionPlanSetToDraft($_POST['risk_id']);
			
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
	
	public function treatmentSaveDraft()
	{
		if (isset($_POST['risk_id']) && is_numeric($_POST['risk_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			//if ($_POST['existing_control_id'] == '') $_POST['existing_control_id'] = null;
			
			// build data
			$risk = array(
				'risk_status' => 4,
				'risk_owner' => $_POST['risk_division'],
				'risk_division' => $_POST['risk_division'],
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
			
			$this->load->model('risk/risk');
			$res = $this->risk->treatmentSaveDraft($_POST['risk_id'], $_POST['suggested_risk_treatment'], $risk, $impact_level, $actplan, $control, $objective, $data['session']['username']);
			
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
	
	public function getOwnedActionPlan() {
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
			'division_id' => $sess['session']['division_id']
		);

		$division_euy = $this->session->credential['division_name'];

		$cek_ap_change = $this->risk->cek_ap_change($division_euy);
    
		/*if($cek_ap_change == true){
			$data = $this->risk->getDataMode('ownedActionPlanChange', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		}else{
			$data = $this->risk->getDataMode('ownedActionPlan', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		}*/
		$data = $this->risk->getDataMode('ownedActionPlan', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function viewOwnedActionPlan($rid = false, $aps = false) {
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

			if ($risk && $risk['division'] == $cred['division_id']) {
				
				$this->load->model('risk/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid, $aps);
					
					if ($risk['action_plan_status']*1 == 1 && $risk['assigned_to'] == $cred['username']) {
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
						
						<script src="assets/scripts/risk/actionplanform.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form';
					} else if ($risk['action_plan_status']*1 == 2 && $cred['role_id'] == 4) { // on approval and is div head
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
						
						<script src="assets/scripts/risk/actionplanform.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form';
					}else if ($risk['action_plan_status']*1 == 3) {
						$view = 'risk/action_plan_view_s';
					}else {
						$view = 'risk/action_plan_view';
					}
					
					$this->load->view('main/header', $data);
					$this->load->view($view, $data);
					$this->load->view('main/footer', $data);
				}
			}
		}
	}

	public function viewOwnedActionPlanPrior($rid = false, $aps=false) {
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
			$risk = $this->risk->getActionPlanByIdPrior($rid, $aps);

			if ($risk && $risk['division'] == $cred['division_id']) {
				
				$this->load->model('risk/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForChange($rid, $aps);
					
					if ($risk['action_plan_status']*1 == 1 && $risk['assigned_to'] == $cred['username']) {
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
						
						<script src="assets/scripts/risk/actionplanform.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form';
					} else if ($risk['action_plan_status']*1 == 2 && $cred['role_id'] == 4) { // on approval and is div head
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
						
						<script src="assets/scripts/risk/actionplanform.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_form';
					}else if ($risk['action_plan_status']*1 == 3) {
						$view = 'risk/action_plan_view_s';
					}else {
						$view = 'risk/action_plan_view';
					}
					
					$this->load->view('main/header', $data);
					$this->load->view($view, $data);
					$this->load->view('main/footer', $data);
				}
			}
		}
	}

	public function ChangeRequestAction($rid = false, $aps = false) {
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

			if ($risk && $risk['division'] == $cred['division_id']) {
				
				$this->load->model('risk/mriskregister');
				$data['division_list'] = $this->mriskregister->getDivisionList();
				
				if ($risk['action_plan_status']*1 > 0) {
					$data['valid_mode'] = true;
					$data['action_plan'] = $risk;
					$risk_data = $this->risk->getRiskById($risk['risk_id']);
					$data['risk'] = $risk_data;
					$data['action_plan_change'] = $this->risk->getActionPlanForRequest($rid, $aps);
					
					 if ($risk['action_plan_status']*1 == 3) {
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
						
						<script src="assets/scripts/risk/actionplanrequest.js"></script>
						';
						
						$data['pageLevelScriptsInit'] = "apForm.init();";
						
						$view = 'risk/action_plan_request';
					} else {
						$view = 'risk/action_plan_view_s';
					}
					
					$this->load->view('main/header', $data);
					$this->load->view($view, $data);
					$this->load->view('main/footer', $data);
				}
			}
		}
	}
    
	public function ChangeRequestActionExe($rid=false,$aps=false,$view=null) 
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
			<script src="assets/scripts/risk/actionexec_request.js"></script>
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
					$this->load->view('risk/action_plan_exe_request', $data);
					$this->load->view('main/footer', $data);
		}
	}

	public function ChangeRequestActionExePrior($rid=false,$aps=false,$view=null) 
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
			<script src="assets/scripts/risk/actionexec_request.js"></script>
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
					$this->load->view('risk/action_plan_exe_request_prior', $data);
					$this->load->view('main/footer', $data);
		}
	}

	public function RequestActionExe(){
		if (
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$rd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
			$risk = array(
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
			$res = $this->risk->actionplanexcerequestsubmit($_POST['action_id'], $data['session']['username']);
			$res = $this->risk->insertaction_plan_exe_cr($_POST['action_id'], $risk, $data['session']['username']);
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

	public function RequestActionExePrior(){
		if (
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$rd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
			$risk = array(
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
			$res = $this->risk->actionplanexcerequestsubmitPrior($_POST['action_id'], $data['session']['username']);
			$res = $this->risk->insertaction_plan_exe_prior_cr($_POST['action_id'], $risk, $data['session']['username']);
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
			<script src="assets/scripts/risk/actionview_pic.js"></script>
			';
			
			$data['pageLevelScriptsInit'] = "ActionVerify.init();";
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			
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

		public function ChangeRequestActionExeView($rid = false){
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
			<script src="assets/scripts/risk/actionexecverify.js"></script>
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
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
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
			$this->load->view('risk/action_plan_exe_request_view', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function ChangeRequestActionExePriorView($rid = false){
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
			<script src="assets/scripts/risk/actionexecverify.js"></script>
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
			
			$risk = $this->risk->getRiskValidate('viewActionByRac_cr', $rid, $cred);
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
			$this->load->view('risk/action_plan_exe_prior_request_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function actionSaveDuedate() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'due_date' => $dd
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
	
	public function actionSaveDraft($ap_id, $ap_sts) { 
		if (
			isset($_POST['risk_id']) && is_numeric($_POST['risk_id']) && 
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			// if is div head then submit for verification, if pic for div head verify
			// tambah role 2 karena rac mau submit juga
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$ddp = implode('-', array_reverse( explode('-', $_POST['due_date_prim']) ));
			$risk = array(
				'id_ap' => $_POST['action_id'],
				'action_plan_status' => $stat,
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username'],
				'action_plan_p' => $_POST['action_plan_prim'],
				'due_date_p' => $ddp,
				'division_p' => $_POST['division_prim']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraft($_POST['action_id'], $_POST['risk_id'], $risk, $ap_id, $ap_sts, $data['session']['username']);
			//$res = $this->risk->actionUpdateRiskStatus($_POST['risk_id'], $data['session']['username']);
			
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
	
	public function actionSubmit($ap_id, $ap_sts) {
		if (
			isset($_POST['risk_id']) && is_numeric($_POST['risk_id']) && 
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			// if is div head then submit for verification, if pic for div head verify
			// tambah role 2 karena rac mau submit juga
			if ($this->session->credential['role_id'] == 4) {
				$stat = 3;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 3;
			} else {
				$stat = 2;
			}
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$ddp = implode('-', array_reverse( explode('-', $_POST['due_date_prim']) ));
			$risk = array(
				'id_ap' => $_POST['action_id'],
				'action_plan_status' => $stat,
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username'],
				'action_plan_p' => $_POST['action_plan_prim'],
				'due_date_p' => $ddp,
				'division_p' => $_POST['division_prim']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionPlanSaveDraft($_POST['action_id'], $_POST['risk_id'], $risk, $ap_id, $ap_sts, $data['session']['username']);
			$res = $this->risk->actionPlanSubmit($_POST['action_id'], $_POST['risk_id'], $risk, $ap_id, $ap_sts, $data['session']['username'], $this->session->credential['role_id']);
			//$res = $this->risk->actionUpdateRiskStatus($_POST['risk_id'], $data['session']['username']);
			
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

	public function actionRequest() {
		if (
			isset($_POST['action_id']) && is_numeric($_POST['action_id'])
		) {
			$data = $this->loadDefaultAppConfig();
			
			
			// build data
			$dd = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$risk = array(
				'action_plan' => $_POST['action_plan'],
				'due_date' => $dd,
				'division' => $_POST['division'],
				'created_by' => $data['session']['username']
			);
			
			$this->load->model('risk/risk');
			$res = $this->risk->actionplanrequestsubmit($_POST['action_id'], $data['session']['username']);
			$res = $this->risk->insertaction_plan_cr($_POST['action_id'], $risk, $data['session']['username']);
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
	
	public function getOwnedActionPlanExec() {
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
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->risk->getDataMode('ownedActionPlanExec', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getOwnedActionPlanExec_adt() {
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
		
		$data = $this->risk->getDataMode('ownedActionPlanExec_adt', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
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
			'division_id' => $sess['session']['division_id']
		);
		$data = $this->risk->getDataMode('picActionPlanExec_prior', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
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
			'division_id' => $sess['session']['division_id']
		);
		$data = $this->risk->getDataMode('picActionPlanExec_now', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function execSaveDraft() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			if ($_POST['execution_status'] == 'COMPLETE') {
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'execution_reason' => null,
					'revised_date' => null
				);
			}
			
			if ($_POST['execution_status'] == 'EXTEND') {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => null,
					'execution_evidence' => null,
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
			}
			
			if ($_POST['execution_status'] == 'ONGOING') {
			 
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => null,
					'execution_reason' => null,
					'revised_date' => null
				);
			}
			
			// build data
			$this->load->model('risk/risk');
			$res = $this->risk->execSaveDraft($_POST['action_id'], $risk, $data['session']['username']);
			
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

	public function execSaveDraftPrior() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			if ($_POST['execution_status'] == 'COMPLETE') {
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'execution_reason' => null,
					'revised_date' => null
				);
			}
			
			if ($_POST['execution_status'] == 'EXTEND') {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => null,
					'execution_evidence' => null,
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
			}
			
			if ($_POST['execution_status'] == 'ONGOING') {
			 
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => null,
					'execution_reason' => null,
					'revised_date' => null
				);
			}
			
			// build data
			$this->load->model('risk/risk');
			$res = $this->risk->execSaveDraftPrior($_POST['action_id'], $risk, $data['session']['username']);
			
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

	public function ap_execSubmitPrior() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			if ($_POST['execution_status'] == 'COMPLETE') {
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => $_POST['execution_evidence'],
					'execution_reason' => null,
					'revised_date' => null
				);
			}
			
			if ($_POST['execution_status'] == 'EXTEND') {
				$dd = implode('-', array_reverse( explode('-', $_POST['revised_date']) ));
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => null,
					'execution_evidence' => null,
					'execution_reason' => $_POST['execution_reason'],
					'revised_date' => $dd
				);
			}
			
			if ($_POST['execution_status'] == 'ONGOING') {
			 
				$risk = array(
					'execution_status' => $_POST['execution_status'],
					'execution_explain' => $_POST['execution_explain'],
					'execution_evidence' => null,
					'execution_reason' => null,
					'revised_date' => null
				);
			}

			if ($this->session->credential['role_id'] == 4) {
				$stat = 6;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 6;
			} else {
				$stat = 5;
			}
			
			// build data
			$this->load->model('risk/risk');
			$res = $this->risk->execSaveDraftPrior($_POST['action_id'], $risk, $data['session']['username']);
			$res = $this->risk->execSubmitPrior($_POST['action_id'], $stat, $data['session']['username']);
			
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
	
	//rac mau submit juga mangkanya tambah role 2
	public function execSubmit() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			if ($this->session->credential['role_id'] == 4) {
				$stat = 6;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 6;
			} else {
				$stat = 5;
			}
			
			// build data
			$this->load->model('risk/risk');
			$res = $this->risk->execSubmit($_POST['action_id'], $stat, $data['session']['username']);
			
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

	public function execSubmitPrior() {
		if (isset($_POST['action_id']) && is_numeric($_POST['action_id'])) {
			$data = $this->loadDefaultAppConfig();
			
			if ($this->session->credential['role_id'] == 4) {
				$stat = 6;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 6;
			} else {
				$stat = 5;
			}
			
			// build data
			$this->load->model('risk/risk');
			$res = $this->risk->execSubmitPrior($_POST['action_id'], $stat, $data['session']['username']);
			
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
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/actionplan_adt');
		$data['indonya'] = base_url('index.php/maini/mainpic/actionplan_adt');
		$data['engnya'] = base_url('index.php/main/mainpic/actionplan_adt');		
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_pic.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Actionplan_adt.init();
		
		
		 
		';
		
		$this->load->model('admin/mperiode');
		/*
		$data['valid_mode'] = $this->validatePeriodeMode('periodic');
		
		$data['periode'] = null;
		if ($data['valid_mode']) {
			$data['periode'] = $this->mperiode->getCurrentPeriode();
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
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		$this->load->view('header', $data);
		$this->load->view('actionplan_adtpic', $data);
		$this->load->view('footer', $data);
	}

	public function actionplanexe_prior() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainpic/actionplanexe_prior');
		$data['engnya'] = base_url('index.php/main/mainpic/actionplanexe_prior');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/actionplanexe_prior');
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_pic_prior_ec.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		//cek owned
		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$this->load->model('risk/risk');
		$data['cekowned'] = $this->risk->cekOwned($username,$division_nya);
		$data['cekplan'] = $this->risk->cekPlan($username,$division_nya);
		$data['cekplanexec'] = $this->risk->cekPlanExec($username,$division_nya);
		$data['cekkri'] = $this->risk->cekKri($username,$division_nya);

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($username);
		$data['s_action_plan_exe'] = $this->risk->statemen_action_plan_exe();


		$this->load->view('header', $data);
		$this->load->view('actionplanexe_prior_pic', $data);
		$this->load->view('footer', $data);
	}

		public function actionplanexe_now() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainpic/actionplanexe_now');
		$data['engnya'] = base_url('index.php/main/mainpic/actionplanexe_now');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/actionplanexe_now');
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/main_pic_now_ec.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		//cek owned
		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$this->load->model('risk/risk');
		$data['cekowned'] = $this->risk->cekOwned($username,$division_nya);
		$data['cekplan'] = $this->risk->cekPlan($username,$division_nya);
		$data['cekplanexec'] = $this->risk->cekPlanExec($username,$division_nya);
		$data['cekkri'] = $this->risk->cekKri($username,$division_nya);

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$data['s_action_plan_exe'] = $this->risk->statemen_action_plan_exe();

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($username);


		$this->load->view('header', $data);
		$this->load->view('actionplanexe_now_pic', $data);
		$this->load->view('footer', $data);
	}

	public function actionplanexe_periode() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainpic/actionplanexe_periode');
		$data['engnya'] = base_url('index.php/main/mainpic/actionplanexe_periode');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/actionplanexe_periode');
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
		<script src="assets/scripts/dashboard/periode_acton_plan_exe_pic.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'Periode.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('periode_action_plan_exe_pic', $data);
		$this->load->view('main/footer', $data);
	}

	public function priorkri() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainpic/priorkri');
		$data['engnya'] = base_url('index.php/main/mainpic/priorkri');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/priorkri');
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/kri_prior_pic.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		//cek owned
		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$this->load->model('risk/risk');
		$data['cekowned'] = $this->risk->cekOwned($username,$division_nya);
		$data['cekplan'] = $this->risk->cekPlan($username,$division_nya);
		$data['cekplanexec'] = $this->risk->cekPlanExec($username,$division_nya);
		$data['cekkri'] = $this->risk->cekKri($username,$division_nya);

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($username);


		$this->load->view('header', $data);
		$this->load->view('kri_prior_pic', $data);
		$this->load->view('footer', $data);
	}

	public function regularkri() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainpic/regularkri');
		$data['engnya'] = base_url('index.php/main/mainpic/regularkri');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/regularkri');
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/dashboard/kri_regular_pic.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';
		
		$this->load->model('user/usermodel');
		if ($this->session->credential['main_role_id'] == 2) {
			$data['pic_list'] = $this->usermodel->getUserRACByDivision($this->session->credential['division_id']);
		} else {
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
		}
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) {
			$data['adhoc_button'] = false;
		}
		
		//cek owned
		$username = $this->session->credential['username'];
		$division_nya = $this->session->credential['division_id'];
		$this->load->model('risk/risk');
		$data['cekowned'] = $this->risk->cekOwned($username,$division_nya);
		$data['cekplan'] = $this->risk->cekPlan($username,$division_nya);
		$data['cekplanexec'] = $this->risk->cekPlanExec($username,$division_nya);
		$data['cekkri'] = $this->risk->cekKri($username,$division_nya);

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($username);


		$this->load->view('header', $data);
		$this->load->view('kri_regular_pic', $data);
		$this->load->view('footer', $data);
	}


	public function getOwnedKri() {
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
		
		$data = $this->risk->getDataMode('ownedKri', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getOwnedKri_prior() {
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
		
		$data = $this->risk->getDataMode('ownedKri_prior', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function viewOwnedKri($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main/mainpic');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 1 && $kri['kri_pic'] == $cred['username']) {
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
					
					<script src="assets/scripts/risk/kriform.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else if ($kri['kri_status']*1 == 2 && $cred['role_id'] == 4) { // on approval and is div head
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
					
					<script src="assets/scripts/risk/kriform.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else {
					$view = 'risk/kri_view';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewKri($rid = false) {
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
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
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
			$data['indonya'] = base_url('index.php/maini/mainpic/regularkri');
			$data['engnya'] = base_url('index.php/main/mainpic/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 1 && $kri['kri_pic'] == $cred['username']) {
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
					
					<script src="assets/scripts/risk/kriform_r.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else if ($kri['kri_status']*1 == 2 && $cred['role_id'] == 4) { // on approval and is div head
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
					
					<script src="assets/scripts/risk/kriform_r.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else {
					$view = 'risk/kri_view_regular';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

	public function viewOwnedKriPrior($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
				$data['indonya'] = base_url('index.php/maini/mainpic/regularkri');
				$data['engnya'] = base_url('index.php/main/mainpic/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
				$data['kri'] = $kri;
				$risk = $this->risk->getRiskById($kri['risk_id']);
				$data['risk'] = $risk;
				
				if ($kri['kri_status']*1 == 1 && $kri['kri_pic'] == $cred['username']) {
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
					
					<script src="assets/scripts/risk/kriform_p.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else if ($kri['kri_status']*1 == 2 && $cred['role_id'] == 4) { // on approval and is div head
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
					
					<script src="assets/scripts/risk/kriform_p.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = "KriForm.init();";
					
					$view = 'risk/kri_form';
				} else {
					$view = 'risk/kri_view_prior';
				}
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
			}
		}
	}

		public function viewKriRegular($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic/regularkri');
			$data['engnya'] = base_url('index.php/main/mainpic/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
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

	public function viewKriPrior($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini/mainpic/regularkri');
			$data['engnya'] = base_url('index.php/main/mainpic/regularkri');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/mainpic/regularkri');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			$data['role'] = $cred['role_id'];
			
			$kri = $this->risk->getKriById($rid);

			if ($kri && $kri['kri_owner'] == $cred['division_id']) {
				
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

	public function submitstatement_risk_owner()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->sb_risk_owner($session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function submitstatement_action_plan()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->sb_action_plan($session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function submitstatement_action_plan_exe()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->sb_action_plan_exe($session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

	public function submitstatementprior_action_plan_exe()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('risk/risk');
		
			$res = $this->risk->sbprior_action_plan_exe($session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}

}
