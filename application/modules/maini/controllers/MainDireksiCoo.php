<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MainDireksiCOO extends APP_Controlleri {
	
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/MainDireksiCoo');
		$data['engnya'] = base_url('index.php/main/MainDireksiCoo');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/MainDireksiCoo');
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
		<script src="assets/scripts/dashboard/main_direksi_coo.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		 
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';

		 $this->load->model('risk/riskdireksi');
		$data['listDivision'] = $this->riskdireksi->getDivision_coo();
		
		$data['sumAllRisk'] = $this->riskdireksi->sumAllRisk_coo();
		$data['sumAllRisk_prior'] = $this->riskdireksi->sumAllRisk_prior_coo();
	
		
		$data['sumHighRisk'] = $this->riskdireksi->sumHighRisk_coo();
		$data['sumModerateRisk'] = $this->riskdireksi->sumModerateRisk_coo();
		$data['sumLowRisk'] = $this->riskdireksi->sumLowRisk_coo();
		$data['sumHighRisk_prior'] = $this->riskdireksi->sumHighRisk_prior_coo();
		$data['sumModerateRisk_prior'] = $this->riskdireksi->sumModerateRisk_prior_coo();
		$data['sumLowRisk_prior'] = $this->riskdireksi->sumLowRisk_prior_coo();
		$data['data']=$this->riskdireksi->tampilData();
		$data['dashboardRiskMap']=$this->riskdireksi->DashboardRiskMap();
		//top five risk
		$data['tabTopFiveRisk']=$this->riskdireksi->tabTopFiveRisk();
		//----
		//actiopn plan
		$data['AP_total_prior_COO'] = $this->riskdireksi->AP_total_prior_COO();
		$data['AP_total_cur_COO'] = $this->riskdireksi->AP_total_cur_COO();

		$data['AP_ongoing_prior_COO'] = $this->riskdireksi->AP_ongoing_prior_COO();
		$data['AP_extend_prior_COO'] = $this->riskdireksi->AP_extend_prior_COO();
		$data['AP_complete_prior_COO'] = $this->riskdireksi->AP_complete_prior_COO();


		$data['AP_ongoing_cur_COO'] = $this->riskdireksi->AP_ongoing_cur_COO();
		$data['AP_extend_cur_COO'] = $this->riskdireksi->AP_extend_cur_COO();
		$data['AP_complete_cur_COO'] = $this->riskdireksi->AP_complete_cur_COO();

		//kri
		$data['AP_kri_prior_COO'] = $this->riskdireksi->AP_kri_prior_COO();
		$data['AP_kri_curent_COO'] = $this->riskdireksi->AP_kri_curent_COO();

		$data['AP_kri_green_prior_COO'] = $this->riskdireksi->AP_kri_green_prior_COO();
		$data['AP_kri_yellow_prior_COO'] = $this->riskdireksi->AP_kri_yellow_prior_COO();
		$data['AP_kri_red_prior_COO'] = $this->riskdireksi->AP_kri_red_prior_COO();


		$data['AP_kri_red_cur_COO'] = $this->riskdireksi->AP_kri_red_cur_COO();
		$data['AP_kri_yellow_cur_COO'] = $this->riskdireksi->AP_kri_yellow_cur_COO();
		$data['AP_kri_green_cur_COO'] = $this->riskdireksi->AP_kri_green_cur_COO();

		$this->load->model('risk/mriskregister');
		$data['category'] = $this->mriskregister->getRiskCategory();
		$data['likelihood'] = $this->mriskregister->getRiskLikelihood();
		$data['impact_list'] = $this->mriskregister->getRiskReference();

		$this->load->view('header_dir', $data);
		$this->load->view('direksicoo/v_register_direksicoo', $data);
		$this->load->view('footer', $data);
	}

	
public function getriskregisterdireksi()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/MainDireksiCoo');
		$data['engnya'] = base_url('index.php/main/MainDireksiCoo');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/MainDireksiCoo');
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
		<script src="assets/scripts/dashboard/main_direksi.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		 
		';
		
		//$data['pageLevelScriptsInit'] = 'Dashboard.init();
		//Dashboard.initUserChart();
		//';
		 $this->load->model('risk/riskdireksi');
		$data['cekAllRiskCEO'] = $this->riskdireksi->cekAllRiskCEO();
		$data['cekHighRiskCEO'] = $this->riskdireksi->cekHighRiskCEO();
		$data['cekModerateRiskCEO'] = $this->riskdireksi->cekModerateRiskCEO();
		$data['cekLowRiskCEO'] = $this->riskdireksi->cekLowRiskCEO();

		$data['cekPriorAllRiskCEO'] = $this->riskdireksi->cekPriorAllRiskCEO();
		$data['cekPriorHighRiskCEO'] = $this->riskdireksi->cekPriorHighRiskCEO();
		$data['cekPriorModerateRiskCEO'] = $this->riskdireksi->cekPriorModerateRiskCEO();
		$data['cekPriorLowRiskCEO'] = $this->riskdireksi->cekPriorLowRiskCEO();

		$data['cekAllActionPlanPriorCEO'] = $this->riskdireksi->cekAllActionPlanPriorCEO();
		$data['cekComAllActionPlanPriorCEO'] = $this->riskdireksi->cekComAllActionPlanPriorCEO();
		$data['cekOngAllActionPlanPriorCEO'] = $this->riskdireksi->cekOngAllActionPlanPriorCEO();
		$data['cekExtAllActionPlanPriorCEO'] = $this->riskdireksi->cekExtAllActionPlanPriorCEO();

		
		$data['cekHigh'] = $this->riskdireksi->cekHigh();
		$data['cekModerate'] = $this->riskdireksi->cekModerate();
		$data['cekLow'] = $this->riskdireksi->cekLow();
		$data['cekAllRiskCurent'] = $this->riskdireksi->cekAllRiskCurent();
		$data['cekAllRiskPrior'] = $this->riskdireksi->cekAllRiskPrior();
		$data['cekDivision'] = $this->riskdireksi->cekDivision();
		$data['cekTrend'] = $this->riskdireksi->cekTrend();
		//top five risk
		$data['tabTopFiveRisk']=$this->riskdireksi->tabTopFiveRisk();
		//----

		//riskmap
		$data['data']=$this->riskdireksi->tampilData();
		$data['dashboardRiskMap']=$this->riskdireksi->DashboardRiskMap();
		//----

		$this->load->view('header_dir', $data);
		$this->load->view('direksicoo/v_register_direksicoo', $data);
		$this->load->view('footer', $data);
	}

	public function getAllRisk() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_divisi = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}

		if (isset($_POST['filter_divisi']) && $_POST['filter_divisi'] != '' ) {
			$filter_divisi = $_POST['filter_divisi'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/riskdireksi');
		
		$defFilter = array(
			'userid' => $sess['session']['username']
		);
		$this->load->model('admin/mperiode');
		$periode = $this->mperiode->getCurrentPeriode();


		$data = $this->riskdireksi->getAllRisk_coo($page, $row, $order_by, $order, $filter_by, $filter_value, $filter_divisi);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getActionPlanExec() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_divisi = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_divisi']) && $_POST['filter_divisi'] != '' ) {
			$filter_divisi = $_POST['filter_divisi'];
		}

		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/riskdireksi');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->riskdireksi->getDataMode('cooActionPlanExec', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $filter_divisi);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getKri() {
		$sess = $this->loadDefaultAppConfig();
		$order_by = $order = $filter_by = $filter_value = $filter_divisi = null;
						
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_divisi']) && $_POST['filter_divisi'] != '' ) {
			$filter_divisi = $_POST['filter_divisi'];
		}

		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('risk/riskdireksi');
		
		$defFilter = array(
			'userid' => $sess['session']['username'],
			'role_id' => $sess['session']['role_id'], // 4 div head, 5 PIC
			'division_id' => $sess['session']['division_id']
		);
		
		$data = $this->riskdireksi->getDataMode('cooKri', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value, $filter_divisi);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function getAllRisk_excel() {
	  
		$this->load->model('risk/riskdireksi');
		  
		$data['dataget'] = $this->input->get();
		  
		$data['datatable'] = $this->riskdireksi->getAllRisk_export($data['dataget']);
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/risk_list_direksi', $data, true);
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=risk_list_direksi.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	public function getAllRisk_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/riskdireksi');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getAllRisk_export($data['dataget']);
		 
		$this->load->view('export/risk_list_direksi',$data);
	// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("risk_list_direksi.pdf");
	 
	}
	
	public function getAllRiskregister_excel() {
	  
		$this->load->model('risk/riskdireksi');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getUserList_export($data['dataget']);
		  
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
		 
		$this->load->model('risk/riskdireksi');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getUserList_export($data['dataget']);
		 
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
	  
		$this->load->model('risk/riskdireksi');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getExecution_export();
		  
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
		 
		$this->load->model('risk/riskdireksi');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getExecution_export();
		 
		$this->load->view('export/execution_list',$data);
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("execution_list.pdf");
	 
	}
	
	
	public function getKRI_excel() {
	  
		$this->load->model('risk/riskdireksi');
		  
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getKRI_export();
		  
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/kri_list_direksi', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=kri_list_direksi.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
		
	}
	
	
	public function getKRI_pdf() {
	
		$this->load->library('dompdf_gen');
		 
		$this->load->model('risk/riskdireksi');
		
		$data['dataget'] = $this->input->get();
		 
		$data['datatable'] = $this->riskdireksi->getKRI_export();
		 
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

	//kurawal penutup controller
}
