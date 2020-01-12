<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends APP_Controller {

	function __construct()
    {
        parent::__construct();
        
        $this->load->model('risk/risk');
        $this->load->model('Mlibrary');	
    }
	 
	public function list_risk()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_risk');
		$data['engnya'] = base_url('index.php/library/list_risk');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_risk');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		 
		$this->load->view('main/header', $data);
		$this->load->view('library', $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function list_risk_properties($risk_code)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_risk');
		$data['engnya'] = base_url('index.php/library/list_risk');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_risk');
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
		<script src="assets/scripts/dashboard/library.js"></script>

		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';

		$this->load->model('Mlibrary');	
		$all_username = $this->Mlibrary->get_all_username();
		$data_properties = $this->Mlibrary->get_properties($risk_code);

		$data['all_username'] = $all_username;
		$data['properties'] = $data_properties;
		$data['risk_code'] = $risk_code;
		$data['edit_form'] = false;

		$data['risk_code'] = $risk_code;
		$this->load->view('main/header', $data);
		$this->load->view('library_properties', $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function submission($id)
	{

		$cred = $this->session->credential;

		if($cred['role_id'] == 2){
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission');
		$data['engnya'] = base_url('index.php/library/submission');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_register');
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
		<script src="assets/scripts/dashboard/submission.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';

			$view = 'submission_v';
		}else{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission');
		$data['engnya'] = base_url('index.php/library/submission');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_register');
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
		<script src="assets/scripts/dashboard/submission_direksi.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';

			$view = "submission_v_d";
		}

		$this->load->model('risk/mriskregister');
		$this->load->model('risk/riskdireksi');

		if($cred['role_id'] == 2){
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}
		else if($cred['role_id'] == 6){
			$data['division_list'] = $this->riskdireksi->getDivision_ceo();
		}
		else if($cred['role_id'] == 8){
			$data['division_list'] = $this->riskdireksi->getDivision_coo();
		}
		else if($cred['role_id'] == 9){
			$data['division_list'] = $this->riskdireksi->getDivision_cf();
		}else{
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}

		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['id_period'] = $id;
		 
		$this->load->view('main/header', $data);
		$this->load->view($view, $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function submission_risk_owner($id)
	{
		$cred = $this->session->credential;
		if($cred['role_id'] == 2){
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_risk_owner');
		$data['engnya'] = base_url('index.php/library/submission_risk_owner');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_treatment');
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
		<script src="assets/scripts/dashboard/submission.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';
		$view = "submission_risk_own_v";
		}else{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_risk_owner');
		$data['engnya'] = base_url('index.php/library/submission_risk_owner');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_treatment');
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
		<script src="assets/scripts/dashboard/submission_direksi.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();';
		$view = "submission_risk_own_v";	
		}

		$this->load->model('risk/mriskregister');
		$this->load->model('risk/riskdireksi');

		if($cred['role_id'] == 2){
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}
		else if($cred['role_id'] == 6){
			$data['division_list'] = $this->riskdireksi->getDivision_ceo();
		}
		else if($cred['role_id'] == 8){
			$data['division_list'] = $this->riskdireksi->getDivision_coo();
		}
		else if($cred['role_id'] == 9){
			$data['division_list'] = $this->riskdireksi->getDivision_cf();
		}else{
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}

		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['id_period'] = $id;
		 
		$this->load->view('main/header', $data);
		$this->load->view($view, $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function submission_action_plan($id)
	{
		$cred = $this->session->credential;
		if($cred['role_id'] == 2){
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_action_plan');
		$data['engnya'] = base_url('index.php/library/submission_action_plan');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_action');
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
		<script src="assets/scripts/dashboard/submission.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$view = "submission_ap_v";
		}else{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_action_plan');
		$data['engnya'] = base_url('index.php/library/submission_action_plan');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_action');
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
		<script src="assets/scripts/dashboard/submission_direksi.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$view = "submission_ap_v";	
		}

		$this->load->model('risk/mriskregister');
		$this->load->model('risk/riskdireksi');

		if($cred['role_id'] == 2){
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}
		else if($cred['role_id'] == 6){
			$data['division_list'] = $this->riskdireksi->getDivision_ceo();
		}
		else if($cred['role_id'] == 8){
			$data['division_list'] = $this->riskdireksi->getDivision_coo();
		}
		else if($cred['role_id'] == 9){
			$data['division_list'] = $this->riskdireksi->getDivision_cf();
		}else{
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}

		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['id_period'] = $id;
		 
		$this->load->view('main/header', $data);
		$this->load->view($view, $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function submission_action_plan_exe()
	{
		$cred = $this->session->credential;
		if($cred['role_id'] == 2){
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_action_plan_exe');
		$data['engnya'] = base_url('index.php/library/submission_action_plan_exe');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/submission_action_plan_exe');
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
		<script src="assets/scripts/dashboard/submission_apexecution.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$view = "submission_apex_v";
		}else{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_action_plan_exe');
		$data['engnya'] = base_url('index.php/library/submission_action_plan_exe');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/submission_action_plan_exe');
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
		<script src="assets/scripts/dashboard/submission_apexecution_direksi.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$view = "submission_apex_v";
		}

		$this->load->model('risk/mriskregister');
		$this->load->model('risk/riskdireksi');

		if($cred['role_id'] == 2){
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}
		else if($cred['role_id'] == 6){
			$data['division_list'] = $this->riskdireksi->getDivision_ceo();
		}
		else if($cred['role_id'] == 8){
			$data['division_list'] = $this->riskdireksi->getDivision_coo();
		}
		else if($cred['role_id'] == 9){
			$data['division_list'] = $this->riskdireksi->getDivision_cf();
		}else{
			$data['division_list'] = $this->mriskregister->getDivisionList();
		}

		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		 
		$this->load->view('main/header', $data);
		$this->load->view($view, $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function viewSubmitApex($id)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/submission_action_plan_exe');
		$data['engnya'] = base_url('index.php/library/submission_action_plan_exe');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/submission_action_plan_exe');
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
		<script src="assets/scripts/dashboard/submission_apexecution.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		
		$this->load->model('admin/mreminder');

		$mailapex = $this->mreminder->getaction_apex($id);

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();

		if ($mailapex) {
		 	
		 	$data['periode_name'] = $mailapex['periode_name'];
		 	$data['create_date'] = $mailapex['create_date'];
		 	$data['subject'] = $mailapex['mail_subject'];
		 	$data['id'] = $mailapex['id'];

			$this->load->view('main/header', $data);
			$this->load->view('submission_userapex_v', $data);
			$this->load->view('main/footer', $data);
		 }
	}

	public function edit_risk_properties($risk_id,$username,$date_change)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_risk');
		$data['engnya'] = base_url('index.php/library/list_risk');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_risk');
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
		<script src="assets/scripts/dashboard/library.js"></script>

		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';

		$this->load->model('Mlibrary');	
		$all_username = $this->Mlibrary->get_all_username_edit($username);
		//$data_properties = $this->Mlibrary->get_properties($risk_code);

		$data['risk_id'] = $risk_id;
		$data['username'] = $username;
		$data['date_change'] = $date_change;
		$data['edit_form'] = true;
		$data['all_username'] = $all_username;

		//$data['risk_code'] = $risk_code;
		$this->load->view('main/header', $data);
		$this->load->view('library_properties', $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function edit_properties(){
		$data['username'] = $this->input->post('username');
		$data['date_change'] = $this->input->post('date_change');
		$data['username_asli'] = $this->input->post('username_asli');
		$data['date_asli'] = $this->input->post('date_asli');

		$this->load->model('Mlibrary');	
		$all_username = $this->Mlibrary->update_properties($data);

		if($all_username = true){

		redirect('library/list_risk');
			//echo "<script type='text/javascript'>alert('Update Success');</script>";
			//redirect('library/list_risk');
		}


	}

	public function delete_properties($risk_id,$username){
		

		$this->load->model('Mlibrary');	
		$all_username = $this->Mlibrary->delete_properties($risk_id,$username);

		if($all_username = true){

			redirect('library/list_risk');
			//echo "<script type='text/javascript'>alert('Update Success');</script>";
			//redirect('library/list_risk');
		}


	}
	
	public function list_risk_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_export($this->input->post());
			 
		//$data['total_data'] = count($data['datanya']);
		 
		$this->load->view('export/list_risk',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("risktreatmentreport.pdf");
		 
	}
	
	public function list_risk_excel() {
		
		$this->load->model('Mlibrary');
		  
		//$data['dataget'] = $this->input->get();
		 
		$data['datanya'] = $this->Mlibrary->getAllRisk_export($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_risk', $data, true);
		 
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

	public function list_ob_excel() {
		
		$this->load->model('Mlibrary');
		  
		//$data['dataget'] = $this->input->get();
		 
		$data['datanya'] = $this->Mlibrary->getAllObjective_export($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_objective', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=objective_list.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function list_ob_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllObjective_export($this->input->post());
			 
		//$data['total_data'] = count($data['datanya']);
		 
		$this->load->view('export/list_objective',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("objectivereport.pdf");
		 
	}
	
	public function list_ap_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_ap_report($this->input->post());
			  
		$this->load->view('export/list_ap',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("list_ap.pdf");
		  
	}
	
	public function list_ap_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_ap_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_ap', $data, true);
		 
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
	
	public function list_ec_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_ec_report($this->input->post());
			  
		$this->load->view('export/list_ec',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("list_ec.pdf");
		  
	}
	
	public function list_ec_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_ec_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_ec', $data, true);
		 
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

	public function listregular_apec_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getActionapex_regular_report($this->input->post());
			  
		$this->load->view('export/action_plan_regular',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("actionplan_execution_regular.pdf");
		  
	}
	
	public function listregular_apec_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getActionapex_regular_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/action_plan_regular', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=actionplan_execution_regular.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function listprior_apec_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getActionapex_prior_report($this->input->post());
			  
		$this->load->view('export/action_plan_prior',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("actionplan_execution_prior.pdf");
		  
	}
	
	public function listprior_apec_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getActionapex_prior_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/action_plan_prior', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=actionplan_execution_prior.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}
	
	public function taksonomi_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_tax_report($this->input->post());
			  
		$this->load->view('export/taksonomi',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("taksonomi.pdf");
		  
	}
	
	public function taksonomi_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_tax_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/taksonomi', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=taksonomi.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	function submission_pdf($id_period){
			
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
			
			$orientation = "portrait";
			$paper_size='a4';
			 
			//periode saat ini
			$data['datanya'] = $this->Mlibrary->submission_report($id_period);
			  
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'List of Risk Register Submission'; 
			 
			$this->load->view('export/submission',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("User_Submission.pdf");
			
		}

		function submission_excel($id_period){
			
			$this->load->model('Mlibrary');
			$this->load->library('parser');
		    
			$data['datanya'] = $this->Mlibrary->submission_report($id_period);

			//pass retrieved data into template and return as a string	
			 
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'List of Risk Register Submission';
			 
			$stringData = $this->parser->parse('export/submission', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=User_Submission.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
		}

	function submission_riskown_pdf($id_period){
			
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
			
			$orientation = "portrait";
			$paper_size='a4';
			 
			//periode saat ini
			$data['datanya'] = $this->Mlibrary->submission_riskown_report($id_period);
			  
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'Submission Confirmation For Risk Owner'; 
			 
			$this->load->view('export/submission',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("Submission_Confirmation_For_Risk_Owner.pdf");
			
		}

		function submission_riskown_excel($id_period){
			
			$this->load->model('Mlibrary');
			$this->load->library('parser');
		    
			$data['datanya'] = $this->Mlibrary->submission_riskown_report($id_period);

			//pass retrieved data into template and return as a string	
			 
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'Submission Confirmation For Risk Owner';
			 
			$stringData = $this->parser->parse('export/submission', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=Submission_Confirmation_For_Risk_Owner.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
		}

		function submission_actionplan_pdf($id_period){
			
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
			
			$orientation = "portrait";
			$paper_size='a4';
			 
			//periode saat ini
			$data['datanya'] = $this->Mlibrary->submission_actionplan_report($id_period);
			  
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'Submission Confirmation For Action Plan'; 
			 
			$this->load->view('export/submission',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("Submission_Confirmation_For_Action_Plan.pdf");
			
		}

		function submission_actionplan_excel($id_period){
			
			$this->load->model('Mlibrary');
			$this->load->library('parser');
		    
			$data['datanya'] = $this->Mlibrary->submission_actionplan_report($id_period);

			//pass retrieved data into template and return as a string	
			 
			$data['total_data'] = count($data['datanya']);
			$data['id_period'] = $id_period;
			$data['title_content'] = 'Submission Confirmation For Action Plan';
			 
			$stringData = $this->parser->parse('export/submission', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=Submission_Confirmation_For_Action_Plan.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
		}

		function submission_actionplanexe_pdf($id){
			
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
			
			$orientation = "portrait";
			$paper_size='a4';
			 
			//periode saat ini
			$data['datanya'] = $this->Mlibrary->submission_actionplanexe_report($id);
			  
			$data['total_data'] = count($data['datanya']); 
			$this->load->model('admin/mreminder');

			$mailapex = $this->mreminder->getaction_apex($id);

			$this->load->model('risk/mriskregister');
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskReference();
			$data['division_list'] = $this->mriskregister->getDivisionList();

		if ($mailapex) {
		 	
		 	$data['periode_name'] = $mailapex['periode_name'];
		 	$data['create_date'] = $mailapex['create_date'];
		 	$data['subject'] = $mailapex['mail_subject'];
		 	$data['id'] = $mailapex['id'];
			 
			$this->load->view('export/submission_apex',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("Head Confirmation For Action Plan Execution.pdf");
			}
			
		}

		function submission_actionplanexe_excel($id){
			
			$this->load->model('Mlibrary');
			$this->load->library('parser');
		    
			$data['datanya'] = $this->Mlibrary->submission_actionplanexe_report($id);

			//pass retrieved data into template and return as a string	
			 
			$data['total_data'] = count($data['datanya']);

			$this->load->model('admin/mreminder');

			$mailapex = $this->mreminder->getaction_apex($id);

			$this->load->model('risk/mriskregister');
			$data['category'] = $this->mriskregister->getRiskCategory();
			$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
			$data['impact_list'] = $this->mriskregister->getRiskReference();
			$data['division_list'] = $this->mriskregister->getDivisionList();

		if ($mailapex) {
		 	
		 	$data['periode_name'] = $mailapex['periode_name'];
		 	$data['create_date'] = $mailapex['create_date'];
		 	$data['subject'] = $mailapex['mail_subject'];
		 	$data['id'] = $mailapex['id'];
			 
			$stringData = $this->parser->parse('export/submission_apex', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=Head Confirmation For Action Plan Execution.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			}	
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	 
	public function libraryriskDeleteData()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$risk_id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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
	
	public function libraryriskDeleteData_ap()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk_ap($id);
			
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

	public function libraryriskShowData_ap()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->showRisk_ap($id);
			
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
	
	public function libraryriskDeleteData_kri()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$risk_id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk_kri($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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
	
	public function libraryriskDeleteData_ec()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk_ec($id);
			
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

	public function libraryriskShowData_ec()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->showRisk_ec($id);
			
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

	public function libraryriskDeleteData_objective()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk_objective($id);
			
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

	public function libraryriskShowData_objective()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->showRisk_objective($id);
			
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
	
	public function libraryriskDeleteData_tax()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$risk_id = $_POST['id'];
			$this->load->model('Mlibrary');
			$res = $this->Mlibrary->deleteRisk_tax($risk_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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
	
	public function listrisk_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listrisk_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}
	
	public function list_ap()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_ap');
		$data['engnya'] = base_url('index.php/library/list_ap');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_ap');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		 
		$this->load->view('main/header', $data);
		$this->load->view('library_ap', $data);
		$this->load->view('main/footer', $data);
		 
	}
	
	function getRiskCategory(){
	 
		$this->load->model('Mlibrary');
		$this->load->model('risk/mriskregister');
		$data['getparent'] = $this->Mlibrary->getRiskCategory_bycatname($this->input->post('id'));
		
		$data = $this->mriskregister->getRiskCategory($data['getparent'][0]['cat_parent']);
		 
		echo json_encode($data);
	
	}
	
	function getDivision(){
	 
		$this->load->model('Mlibrary'); 
		 
		$data = $this->Mlibrary->getDivision();
		 
		echo json_encode($data);
	
	}

	function getExistingControl(){
	 
		$this->load->model('Mlibrary'); 
		 
		$data = $this->Mlibrary->getExistingControl();
		 
		echo json_encode($data);
	
	}
	
	function get_treshold_type(){
	 
		$this->load->model('Mlibrary'); 
		  
		$this->load->model('risk/risk');
		if ($this->input->post('id') && is_numeric($this->input->post('id'))) {
			$kri = $this->risk->getKriById($this->input->post('id'));
			 
			echo json_encode($kri);
		}
		 
		//echo json_encode($data);
	
	}
	
	public function getAllRisk_ap() {
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk_ap($page, $row, $order_by, $order, $filter_by, $filter_value);
		 
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function list_risk_lib(){
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_risk_lib');
		$data['indonya'] = base_url('index.php/libraryin/list_risk_lib');
		$data['engnya'] = base_url('index.php/library/list_risk_lib');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>';
		
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_list_lib', $data);
		$this->load->view('main/footer', $data);
	}

		public function risk_list_prior_ap(){
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/risk_list_prior_ap');
		$data['indonya'] = base_url('index.php/libraryin/risk_list_prior_ap');
		$data['engnya'] = base_url('index.php/library/risk_list_prior_ap');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>';
		
		
		$this->load->view('main/header', $data);
		$this->load->view('risk_list_prior_ap', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function getAllRisk_kri() {
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk_kri($page, $row, $order_by, $order, $filter_by, $filter_value);
		 
		 
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function kri_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_kri_report($this->input->post());
			  
		$this->load->view('export/kri',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("kri.pdf");
		  
	}
	
	public function kri_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_kri_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=taksonomi.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function kri_pdfregular() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_kriregular_report($this->input->post());
			  
		$this->load->view('export/kri_regular',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("kri_regular.pdf");
		  
	}
	
	public function kri_excelregular() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_kriregular_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_regular', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=kri_regular.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function kri_pdfprior() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->getAllRisk_kriprior_report($this->input->post());
			  
		$this->load->view('export/kri_prior',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("kri_prior.pdf");
		  
	}
	
	public function kri_excelprior() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getAllRisk_kriprior_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_prior', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=kri_prior.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}
	
	public function listriskap_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listmap_update($this->input->post());
		//$res = $this->Mlibrary->listriskap_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}
	
		public function listriskkri_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listriskkri_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}
	
	public function listriskec_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listriskec_update($this->input->post());
		$res = $this->Mlibrary->listmec_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}

	public function listriskobjective_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listmobjective_update($this->input->post());
		$res = $this->Mlibrary->listriskobjective_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}
	
	public function listrisktax_update(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->listrisktax_update($this->input->post());
		 
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error saving Data';
			}
			echo json_encode($data);
	
	}
	
	public function list_ec()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_ec');
		$data['engnya'] = base_url('index.php/library/list_ec');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_ec');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		 
		$this->load->model('risk/mriskregister'); 
		$data['division_list'] = $this->mriskregister->getDivisionList();

		$this->load->view('main/header', $data);
		$this->load->view('library_ec', $data);
		$this->load->view('main/footer', $data);
		 
	}

	public function list_objective()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/list_objective');
		$data['engnya'] = base_url('index.php/library/list_objective');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/list_objective');
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
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		 
		 
		$this->load->view('main/header', $data);
		$this->load->view('library_objective', $data);
		$this->load->view('main/footer', $data);
		 
	}
	
	public function getAllRisk_ec() {
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk_ec($page, $row, $order_by, $order, $filter_by, $filter_value);
		   
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getAllRisk_objective() {
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk_objective($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function taksonomi()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/taksonomi');
		$data['engnya'] = base_url('index.php/library/taksonomi');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/taksonomi');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		 
		 
		$this->load->view('main/header', $data);
		$this->load->view('taksonomi', $data);
		$this->load->view('main/footer', $data);
		 
	}
	
	public function taksonomi_user()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/taksonomi');
		$data['engnya'] = base_url('index.php/library/taksonomi');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/taksonomi');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		 
		 
		$this->load->view('main/header', $data);
		$this->load->view('taksonomi_user', $data);
		$this->load->view('main/footer', $data);
		 
	}
	
	public function getAllRisk_tax() {
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
		$this->load->model('Mlibrary');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$data = $this->Mlibrary->getAllRisk_tax($page, $row, $order_by, $order, $filter_by, $filter_value);
		 
		 
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function kri()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/libraryin/library/kri');
		$data['engnya'] = base_url('index.php/library/kri');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/kri');
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
		<script src="assets/scripts/dashboard/library.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		 
		';
		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		 
		$this->load->view('main/header', $data);
		$this->load->view('kri', $data);
		$this->load->view('main/footer', $data);
		 
	}
	
	public function getKri($rid) {
		$this->load->model('risk/risk');
		if ($rid && is_numeric($rid)) {
			$kri = $this->risk->getKriById($rid);
			echo json_encode($kri);
		}
	}
	
	function delete_treshold(){
	
		$this->load->model('Mlibrary');
		$kri_idnya = $this->Mlibrary->get_tresholddetail($this->input->post());
		$res = $this->Mlibrary->delete_tresholddetail($this->input->post(),$kri_idnya[0]['kri_id']);
		 
		$res['totaldata'] = count($res); 
		 
			if ($res) {
				$res['success'] = true;
				$res['msg'] = 'SUCCESS';
			} else {
				$res['success'] = false;
				$res['msg'] = 'Error Deleting Data';
			}
			
			echo json_encode($res);
	
	}
	
	function add_treshold(){
	
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->add_treshold($this->input->post());
		 
		if ($res) {			 
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
				$data['kri_id'] = $this->input->post('kri_id');
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Adding Data';
				$data['kri_id'] = "";
			}
			  
			echo json_encode($data);
	}
	
	function add_treshold_2(){
	 
		$this->load->model('Mlibrary');
		$res = $this->Mlibrary->add_treshold2($this->input->post());
		 
		if ($res) {			 
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
				$data['kri_id'] = $this->input->post('kri_id');
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Adding Data';
				$data['kri_id'] = "";
			}
			  
			echo json_encode($data);
	}
	
	function load_tresholddet(){
	
		$this->load->model('Mlibrary');		 
		$res = $this->Mlibrary->yap_tresholddetail($this->input->post('id'));
		 
		$res['totaldata'] = count($res); 
		 
			if ($res) {
				$res['success'] = true;
				$res['msg'] = 'SUCCESS';
			} else {
				$res['success'] = false;
				$res['msg'] = 'Error Deleting Data';
			}
			
			echo json_encode($res);
	
	}

	public function getUserList($id_period) {
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
		
		$cred = $this->session->credential;

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
			'userid' => $sess['session']['username'],
			'id_period' => $id_period
		);
		$data = $this->risk->getRiskSubmission($periode_id, $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $cred['role_id']);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getHeadRiskOwn($id_period) {
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

		$cred = $this->session->credential;
		
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
			'userid' => $sess['session']['username'],
			'id_period' => $id_period
		);
		$data = $this->risk->getRisKOwnSubmit($periode_id, $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $cred['role_id']);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getHeadActionPlan($id_period) {
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
		$cred = $this->session->credential;

		$row = $_POST['length'];
		$this->load->model('risk/risk');
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$periode_id = 0;
		if ($periode) {
			$periode_id = $periode['periode_id'];
		} 
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'id_period' => $id_period
		);
		$data = $this->risk->getActionPlanSubmit($periode_id, $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $cred['role_id']);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getHeadActionPlanExe($id) {
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
		$cred = $this->session->credential;

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
		$data = $this->risk->getActionPlanExeSubmit($id,$periode_id, $page, $row, $order_by, $order, $filter_by, $filter_value, $cred['role_id']);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function viewConfirmHead($user) {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/library/submission_risk_owner');
		$data['engnya'] = base_url('index.php/libraryin/submission_risk_owner');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_treatment');
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
		<script src="assets/scripts/dashboard/view_submission.js"></script>
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

		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($user);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $user;
			$data['filled_division'] = $userdata['division_id'];

		$this->load->view('main/header', $data);
		$this->load->view('view_submit_risk_own', $data);
		$this->load->view('main/footer', $data);

		}
	}

	public function viewConfirmApHead($user) {
$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/library/submission_action_plan');
		$data['engnya'] = base_url('index.php/libraryin/submission_action_plan');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/periode/subperiode_action');
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
		<script src="assets/scripts/dashboard/view_submission.js"></script>
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

		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($user);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $user;
			$data['filled_division'] = $userdata['division_id'];

		$this->load->view('main/header', $data);
		$this->load->view('view_submit_actionplan', $data);
		$this->load->view('main/footer', $data);

		}
	}

	public function viewConfirmApexHead($user, $id) {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/library/submission_action_plan_exe');
		$data['engnya'] = base_url('index.php/libraryin/submission_action_plan_exe');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/submission_action_plan_exe');
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
		<script src="assets/scripts/dashboard/view_submission.js"></script>
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

		$this->load->model('user/usermodel');

		$userdata = $this->usermodel->getDataById($user);

		if ($userdata) {
			$data['filled_by'] = $userdata['display_name'];
			$data['filled_by_id'] = $user;
			$data['filled_division'] = $userdata['division_id'];
			$data['filled_idapex'] = $id;

		$this->load->view('main/header', $data);
		$this->load->view('view_submit_actionplan_exeprior', $data);
		$this->load->view('main/footer', $data);

		}
	}

	public function getViewConfirmHead() {
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
			'userid' => $_POST['user_id'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $_POST['divisi_id'],
		);
		  
		$data = $this->risk->getDataMode('viewSubmissionRiskOwned', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getViewConfirmApHead() {
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
			'userid' => $_POST['user_id'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $_POST['divisi_id'],
		);
		  
		$data = $this->risk->getDataMode('viewSubmissionAp', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getViewConfirmApexHead() {
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
			'userid' => $_POST['user_id'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $_POST['divisi_id'],
			'id_apex' => $_POST['id_apex'],
		);
		  
		$data = $this->risk->getDataMode('viewSubmissionApExe', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function ViewConfirmApexHead_excel($user, $idapx) {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getConfirmApexHead_report($user,$idapx);
		$data['total_data'] = count($data['datanya']);
		
		$data['d_user'] = $user;
		$data['d_idapx'] = $idapx;
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/s_action_plan_execution', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=actionplan_execution_user.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function viewConfirmRiskOwnHead_excel($user) {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getConfirmRiskOwn_Report($user);
		$data['total_data'] = count($data['datanya']);
		
		$data['d_user'] = $user;
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
 
			$stringData = $this->parser->parse('export/s_riskowned', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=s_report.xls');
			header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function viewConfirmActionPlanHead_excel($user) {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->getConfirmActionPlan_Report($user);
		$data['total_data'] = count($data['datanya']);
		
		$data['d_user'] = $user;
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
 
			$stringData = $this->parser->parse('export/s_action_plan', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=actionplan_user.xls');
			header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function viewOwnedKriLib($rid = false) {
		if ($rid && is_numeric($rid)) {
			// check mode
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/libraryin/library/kri');
			$data['engnya'] = base_url('index.php/library/kri');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('library/kri');
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
					
					<script src="assets/scripts/risk/krientry_lib.js"></script>
					<script src="assets/scripts/risk/krimodify_lib.js"></script>
					';
					
					$data['pageLevelScriptsInit'] = 'Kri.init();KriModify.init();';
					$data['indonya'] = base_url('index.php/libraryin/library/kri');
					$data['engnya'] = base_url('index.php/library/kri');
					$data['modifyKri'] = true;
					$data['id'] = $kri['id'];
					$data['risk_id'] = $kri['risk_id'];

					$this->load->model('risk/mriskregister');
					$data['division_list'] = $this->mriskregister->getDivisionList();
					
					$view = 'library/kri_modify_lib';
				
				$this->load->view('main/header', $data);
				$this->load->view($view, $data);
				$this->load->view('main/footer', $data);
		}
	}

	public function UpdateKriData_no() 
	{
		$data = $this->loadDefaultAppConfig();
		$this->load->model('Mlibrary');
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_pic' => $kri_pic[0]['username'],
			'mandatory' => $_POST['mandatory'],
			'treshold_type' => $_POST['treshold_type'],
			'timing_pelaporan' => $dd,
			'kri_owner' => $_POST['kri_owner'],
			'created_by' => $data['session']['username']
		);
		
		$tres = array();
		foreach($_POST['treshold_list'] as $v) {
			$tres[] = $v;
		}
		
		$type = $_POST['treshold_type'];

		$res = $this->Mlibrary->updateNewKri($_POST['id'], $kri, $tres);
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


	public function risk_aggregate_pdf($idp) {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->risk_aggregate_report($this->input->post(), $idp);
			  
		$this->load->view('export/list_risk_agg',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("Risk_Aggregate_Library.pdf");
		  
	}
	
	public function risk_aggregate_excel($idp) {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->risk_aggregate_report($this->input->post(), $idp);
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_risk_agg', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=Risk_Aggregate_Library.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function risk_aggregate_new_pdf($idp) {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->risk_aggregate_new_report($this->input->post(), $idp);
			  
		$this->load->view('export/list_risk_agg_new',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("Risk_Aggregate.pdf");
		  
	}
	
	public function risk_aggregate_new_excel($idp) {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->risk_aggregate_new_report($this->input->post(), $idp);
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_risk_agg_new', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=Risk_Aggregate.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function lossevent_pdf() {
	
		$this->load->model('Mlibrary');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Mlibrary->loss_event_report($this->input->post());
			  
		$this->load->view('export/list_loss_event',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("Loss Event.pdf");
		  
	}
	
	public function lossevent_excel() {
		
		$this->load->model('Mlibrary');
		    
		$data['datanya'] = $this->Mlibrary->loss_event_report($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/list_loss_event', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=Loss Event.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}
	 
}
