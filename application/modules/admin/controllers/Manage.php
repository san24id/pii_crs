<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage');
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
		<script src="assets/scripts/admin/impact.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/manage');
		$data['engnya'] = base_url('index.php/admin/manage');			
		$data['pageLevelScriptsInit'] = 'Impact.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('v_impact', $data);
		$this->load->view('main/footer', $data);
	}

	public function likelihood()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage/likelihood');
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
		<script src="assets/scripts/admin/impact.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/manage/likelihood');
		$data['engnya'] = base_url('index.php/admin/manage/likelihood');			
		$data['pageLevelScriptsInit'] = 'Impact.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('v_likelihood', $data);
		$this->load->view('main/footer', $data);
	}

	public function risklevel()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage/risklevel');
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
		<script src="assets/scripts/admin/impact.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/manage/risklevel');
		$data['engnya'] = base_url('index.php/admin/manage/risklevel');			
		$data['pageLevelScriptsInit'] = 'Impact.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('v_risk_level', $data);
		$this->load->view('main/footer', $data);
	}

	public function impact_risk($id_im)
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage');
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
		<script src="assets/scripts/admin/impact.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/manage');
		$data['engnya'] = base_url('index.php/admin/manage');			
		$data['pageLevelScriptsInit'] = 'Impact.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		//$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$data['id_im'] = $id_im;

		$this->load->view('main/header', $data);
		$this->load->view('v_impact_risk', $data);
		$this->load->view('main/footer', $data);
	}

	public function likelihood_risk($id_l) 
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage/likelihood');
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
		<script src="assets/scripts/admin/impact.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/manage');
		$data['engnya'] = base_url('index.php/admin/manage');			
		$data['pageLevelScriptsInit'] = 'Impact.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		//$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$data['id_l'] = $id_l;

		$this->load->view('main/header', $data);
		$this->load->view('v_likelihood_risk', $data);
		$this->load->view('main/footer', $data);
	}	
	
	public function impactGetData()
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
		$this->load->model('admin/mimpact');
		$data = $this->mimpact->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function update_impact(){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->impact_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function insert_impact(){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->impact_insert($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	}

	public function hide_impact($status_impact){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->impact_update_status($status_impact);
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function show_impact($status_impact){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->impact_update_show($status_impact);
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function likelihoodGetData()
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
		$this->load->model('admin/mimpact');
		$data = $this->mimpact->getDataLike($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function update_likelihood(){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->likelihood_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function RiskLevelGetData()
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
		$this->load->model('admin/mimpact');
		$data = $this->mimpact->getDataRriskLevel($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function ImpactLevelName()
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
		$this->load->model('admin/mimpact');
		$data = $this->mimpact->getLevelImpact($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function namelevel_edit(){
	
		$this->load->model('admin/mimpact');
		
		$res = $this->mimpact->levelname_edit($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function getRiskImpact($id_impact) {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '') {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mimpact');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();


			$data = $this->mimpact->getListRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $id_impact);


		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getRiskLikelihood($id_likelihood) {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '') {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mimpact');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();


			$data = $this->mimpact->getLikelihoodRisk($page, $row, $order_by, $order, $filter_by, $filter_value, $id_likelihood);


		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function riskRegisterForImpact($risk_id = null, $id_im)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		$cred = $this->session->credential;
		
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
				
				$page_view = 'risk_register_impact';
			
			
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
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/admini/manage');
			$data['engnya'] = base_url('index.php/admin/manage');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$data['risk'] = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $cred);
			$data['id_im'] = $id_im;
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function riskRegisterForlikelihood($risk_id = null, $id_l)
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('risk/mriskregister');
		$this->load->model('risk/risk');
		$cred = $this->session->credential;
		
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
				
				$page_view = 'risk_register_likelihood';
			
			
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
			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/manage/likelihood');
			
			$data['modifyRisk'] = true;
			$data['risk_id'] = $risk_id;
			$data['indonya'] = base_url('index.php/admini/manage');
			$data['engnya'] = base_url('index.php/admin/manage');			
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskImpactForList();
			$data['treatment_list'] = $this->mriskregister->getReference('treatment.status');
			$data['division_list'] = $this->mriskregister->getDivisionList();

			$data['risk'] = $this->risk->getRiskValidate('viewMyRisk', $risk_id, $cred);
			$data['id_l'] = $id_l;
			
			$this->load->view('main/header', $data);
			$this->load->view($page_view, $data);
			$this->load->view('main/footer', $data);
		}
	}


	public function saveRiskDataImpact()
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

				// build data
				$risk = array(

					'risk_level' => $_POST['risk_level_id'],
					'risk_impact_level' => $_POST['risk_impact_level_id'],
					'risk_likelihood_key' => $_POST['risk_likelihood_id']
				);
				
				$impact_level = array();
				foreach($_POST['impact'] as $v) {
					$impact_level[] = $v;
				}
				
				
				$cek_changerequest = $this->risk->cek_changerequest($_POST['risk_id']);
				

				if($cek_changerequest){
					$resp['msg'] = 'You have change request for this Risk';
				}else{

				$res = $this->risk->updateRiskImpact($_POST['risk_id'], $risk, $impact_level, $data['session']['username']);
				
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

}







