<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends APP_Controller {
	private function dashboardRoute($role_id){
		if ($role_id == 2) {
			redirect($this->config->config['app_config']['DASHBOARD_RAC']);
			exit;
		} else if ($role_id == 3) {
			redirect($this->config->config['app_config']['DASHBOARD_USER']);
			exit;
		} else if ($role_id == 4 || $role_id == 5) {
			redirect($this->config->config['app_config']['DASHBOARD_PIC']);
			exit;
		}else if($role_id==6) {
			redirect($this->config->config['app_config']['DASHBOARD_DIREKSI']);
			exit;
		}else if($role_id==7) {
			redirect($this->config->config['app_config']['DASHBOARD_DIREKSIRAC']);
			exit;
		}else if($role_id==8) {
			redirect($this->config->config['app_config']['DASHBOARD_DIREKSICOO']);
			exit;		
		} else {
			redirect($this->config->config['app_config']['DASHBOARD_USER']);
			exit;
		}
	}
		
	public function index()
	{
		if ($this->session->credential['role_id'] != '3' && $this->session->credential['role_id'] != '1') {
			$this->dashboardRoute($this->session->credential['role_id']);
		}

		if ($this->session->credential['role_id'] == '1') {
			$user = '';
		}

		if ($this->session->credential['role_id'] == '3'){
			$user= $this->session->credential['username'];
			$sql = "select display_name from m_user where username='$user' and display_name='new' ";
			$this->load->database();
			$rs = $this->db->query($sql);
			if ($rs->num_rows() > 0){
					//$this->load->view('userbaru');
					//echo"$rs";
					echo"<script type='text/javascript'>alert('Thank You $user, Your Account Has Been Created, Please Inform the RAC Team to Make Your Account Active!');document.location = '../index.php'</script>";	
			}
		}
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini');
		$data['engnya'] = base_url('index.php/main');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		';
		/*
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_user.js"></script>
		';
		
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

		<script src="assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
		<script src="assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
		<script src="assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>

		<script src="assets/scripts/dashboard/main_user.js"></script>
		';
		
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

		<script src="assets/scripts/highcharts-custom.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_user.js"></script>
		';
		*/
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_user.js"></script>
		';
		
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
		
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();
		$data['adhoc_button'] = true;
		if ($periode) $data['adhoc_button'] = false;

		//cek change request
		$this->load->model('risk/risk');
		$data['cekChangeRequest'] = $this->risk->cekChangeRequestComplete($user);
		
		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		
		$this->load->view('header', $data);
		$this->load->view('main', $data);
		$this->load->view('footer', $data);
		
	}

	//CHART
		public function ChartriskToVerifyUser()
	
	{
		//cek change request
		$this->load->model('risk/risk');
		$data['reportUser'] = $this->risk->reportUser();	
		$this->load->view('chart_risk_to_verify_User', $data);
		
	}

	public function ChartriskToVerifyPriorUser()
	
	{
		//cek change request
		$this->load->model('risk/risk');
		$data['reportPriorUser'] = $this->risk->reportPriorUser();	
		$this->load->view('chart_risk_to_verify_prior_User', $data);
		
	}

	//END CHART
	
	public function getSummaryCount() {
		$this->load->model('risk/risk');
		
		$defFilter = array(
			'userid' => $this->session->credential['username']
		);
		
		$data = $this->risk->getSummaryCount('riskLevel', $defFilter);
		$tmp = array();
		foreach($data as $row) {
			$tmp[$row['risk_level']] = $row['numcount'];
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

		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

		if ($periode == true) {
			$data = $this->risk->getDataMode('allRiskByOwner', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		} else{
			//$data = $this->risk->getDataMode('allRiskByOwnerPeriod', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
			$data = $this->risk->getDataMode('allRiskByOwner', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		}

		
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getOldMyRiskRegister() {
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

		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();

			$data = $this->risk->getDataMode('allOldRiskByOwner', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		 

		
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function viewRisk($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini');
			$data['engnya'] = base_url('index.php/main');			
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

			$data['risk_user']['nama'] ='';
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_register_view', $data);
			$this->load->view('main/footer', $data);
		}
	}

	public function viewRiskChange($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini');
			$data['engnya'] = base_url('index.php/main');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;

			$this->load->database();
			$sql = "select * from t_risk_change where risk_id ='$rid'";
			$query = $this->db->query($sql);
			
			if($query->num_rows() == true){
			$risk = $this->risk->getRiskValidate('viewMyRiskChange', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}

			$data['risk_user']['nama'] ='';
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_registerview_change', $data);
			$this->load->view('main/footer', $data);
			}else{
				redirect('main/viewRisk/'.$rid);
			}
		}
	}

	public function viewRiskOwn($rid = false) {
		if ($rid && is_numeric($rid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/maini');
			$data['engnya'] = base_url('index.php/main');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '';
			$data['pageLevelScriptsInit'] = '';
			
			$data['valid_mode'] = false;
			
			$this->load->model('risk/risk');
			$cred = $this->session->credential;
			
			$risk = $this->risk->getRiskValidate('viewMyRiskMyOwn', $rid, $cred);
			if ($risk) {
				$data['valid_mode'] = true;
				$data['risk'] = $risk;
			}

			$data['risk_user']['nama'] ='';
			
			$this->load->view('main/header', $data);
			$this->load->view('risk/risk_register_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function getMyChangeRequest() {
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
		$data = $this->risk->getDataMode('allChangeByOwner', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function getAllRiskUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskUser_export($data['dataget']);
		  
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
	
	public function getAllRiskUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskUser_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	
	public function getAllRiskOwned_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getRiskOwned_export($data['dataget']);
		  
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
	
	public function getAllRiskOwned_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getRiskOwned_export($data['dataget']);
		 
		$this->load->view('export/treatment_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("treatment_list.pdf");
	 
	}
	
		public function getActionplanUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getActionplanUser_export($data['dataget']);
		  
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
	
	
	public function getActionplanUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getActionplanUser_export($data['dataget']);
		 
		$this->load->view('export/actionplan_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("actionplan_list.pdf");
	 
	}
	
	public function getExecutionUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUser_export($data['dataget']);
		  
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
	
	public function getExecutionUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUser_export($data['dataget']);
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRIUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUser_export($data['dataget']);
		  
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
	
	
	public function getKRIUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUser_export($data['dataget']);
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}
	
	public function getChangereqUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getChangeReqUser_export($data['dataget'] );
		  
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
	
	public function getChangereqUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getChangeReqUser_export($data['dataget']);
		 
		$this->load->view('export/changereq_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("changereq_list.pdf");
	 
	}


	public function getAllRiskPriorUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskPriorUser_export($data['dataget']);
		  
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
	
	public function getAllRiskPriorUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskPriorUser_export($data['dataget']);
		 
		$this->load->view('export/risk_list_prior',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list_prior.pdf");
	 
	}

	public function getExecutionRegularUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUser_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/execution_listregular_pic', $data, true);
		 
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
	
	public function getExecutionRegularUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUser_export($data['dataget']);
		 
		$this->load->view('export/execution_listregular_pic',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}


	public function getExecutionPriorUser_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUserprior_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/execution_listprior_pic', $data, true);
		 
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
	
	public function getExecutionPriorUser_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionUserprior_export($data['dataget']);
		 
		$this->load->view('export/execution_listprior_pic',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}

	public function getKRIUserRegular_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUser_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_listregular_pic', $data, true);
		 
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
	
	
	public function getKRIUserRegular_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUser_export($data['dataget']);
		 
		$this->load->view('export/kri_listregular_pic',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}

	public function getKRIUserPrior_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUserPrior_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_listprior_pic', $data, true);
		 
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
	
	public function getKRIUserPrior_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIUserPrior_export($data['dataget']);
		 
		$this->load->view('export/kri_listprior_pic',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}


	public function getAllRiskDireksi_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskDireksi_export($data['dataget']);
		  
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
	
	public function getAllRiskDireksi_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskDireksi_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	
	public function getExecutionDireksi_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksi_export($data['dataget']);
		  
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
	
	public function getExecutionDireksi_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksi_export($data['dataget']);
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRIDireksi_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksi_export($data['dataget']);
		  
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
	
	public function getKRIDireksi_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksi_export($data['dataget']);
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}

	public function getAllRiskDireksicfo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskDireksicfo_export($data['dataget']);
		  
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
	
	public function getAllRiskDireksicfo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskDireksicfo_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	
	public function getExecutionDireksicfo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksicfo_export($data['dataget']);
		  
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
	
	public function getExecutionDireksicfo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksicfo_export($data['dataget']);
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRIDireksicfo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksicfo_export($data['dataget']);
		  
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
	
	public function getKRIDireksicfo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksicfo_export($data['dataget']);
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}

	public function getAllRiskDireksiceo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskDireksiceo_export($data['dataget']);
		  
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
	
	public function getAllRiskDireksiceo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskDireksiceo_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	
	public function getExecutionDireksiceo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksiceo_export($data['dataget']);
		  
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
	
	public function getExecutionDireksiceo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksiceo_export($data['dataget']);
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRIDireksiceo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksiceo_export($data['dataget']);
		  
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
	
	public function getKRIDireksiceo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksiceo_export($data['dataget']);
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}	

	public function getAllRiskDireksicoo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->risk->getAllRiskDireksicoo_export($data['dataget']);
		  
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
	
	public function getAllRiskDireksicoo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getAllRiskDireksicoo_export($data['dataget']);
		 
		$this->load->view('export/risk_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list.pdf");
	 
	}
	
	
	public function getExecutionDireksicoo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksicoo_export($data['dataget']);
		  
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
	
	public function getExecutionDireksicoo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getExecutionDireksicoo_export($data['dataget']);
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRIDireksicoo_excel() {
	  
		$this->load->model('risk/risk');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksicoo_export($data['dataget']);
		  
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
	
	public function getKRIDireksicoo_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/risk');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->risk->getKRIDireksicoo_export($data['dataget']);
		 
		$this->load->view('export/kri_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("kri_list.pdf");
	 
	}


	public function email_tes2(){
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

	public function email_tes3(){
                                $config = Array(
                                                      'protocol' => 'smtp',
                                                      'smtp_host' => 'ssl://smtp.googlemail.com',
                                                      'smtp_port' => 465,
                                                      //'smtp_host' => 'smtp.gmail.com',
                                                      //'smtp_port' => 587,
                                                      'smtp_user' => 'iigfirisk@gmail.com',
                                                      'smtp_pass' => 'R15k.2017',
                                                      'mailtype' => 'html',
                                                      'charset' => 'iso-8859-1',
                                                      'wordwrap'=> TRUE
                                                );
                                                
                                
                                                $this->load->library('email', $config);
                                                $this->email->set_newline("\r\n");

                                                // Set to, from, message, etc.
                                                $this->email->to("irisk.admin@iigf.co.id");
                                                $this->email->from("iigfirisk@gmail.com","Admin irisk");
                                                //$this->email->bcc(""); 
                                                $this->email->subject("Email library Test");
                                                $this->email->message("<b>Remainder 22 Septmeber harap submit risk</b> Body Content");
                                                
                                                
                                                $result = $this->email->send();
                                                echo $this->email->print_debugger();
}

	public function email_tes5(){
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
                                                $this->email->to("irisk.admin@iigf.co.id");
                                                $this->email->from("andes.zal@gmail.com","Admin irisk");
                                                //$this->email->bcc(""); 
                                                $this->email->subject("Email library Test");
                                                $this->email->message("<b>Remainder 22 Septmeber harap submit risk</b> Body Content");
                                                
                                                
                                                $result = $this->email->send();
                                                echo $this->email->print_debugger();
}

	
}
