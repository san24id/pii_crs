<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MainDireksiswitch extends APP_Controller {
	
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/MainDireksiswitchswitch');
		$data['engnya'] = base_url('index.php/main/MainDireksiswitch');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/MainDireksiswitch');
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
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/scripts/dashboard/main_direksi.js"></script>
		
		';
		
		$data['pageLevelScriptsInit'] = 'Dashboard.init();
		Dashboard.initUserChart();
		';
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
		//riskmap
		$data['data']=$this->riskdireksi->tampilData();
		$data['dashboardRiskMap']=$this->riskdireksi->DashboardRiskMap();
		//----
		//top five risk
		$data['tabTopFiveRisk']=$this->riskdireksi->tabTopFiveRisk();
		//----

        $this->load->model('mdireksi1/chartdireksi');
		$this->load->view('header_dir', $data);
		$this->load->view('direksi1/dashboard_direksi', $data);
		$this->load->view('footer', $data);
	}
	
public function getriskregisterdireksi()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/mainrac');
		$data['engnya'] = base_url('index.php/main/MainDireksiswitch');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/MainDireksiswitch');
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

		$this->load->view('header_dir', $data);
		$this->load->view('direksi1/v_register_direksi', $data);
		$this->load->view('footer', $data);
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
