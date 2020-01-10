<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Risk extends APP_Controlleri {
		public function index()
		{
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('maini/mainpic');
			$data['pageLevelStyles'] = '
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
			<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
			';
			$data['indonya'] = base_url('index.php/maini/mainpic');
			$data['engnya'] = base_url('index.php/main//mainpic');		
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
			
			$this->load->model('useri/usermodel');
			$data['pic_list'] = $this->usermodel->getUserPicByDivision($this->session->credential['division_id']);
			
			$this->load->model('admini/mperiode');
			$periode = $this->mperiode->getCurrentPeriode();
			$data['adhoc_button'] = true;
			if ($periode) $data['adhoc_button'] = false;
			
			$this->load->view('header', $data);
			$this->load->view('main_pic', $data);
			$this->load->view('footer', $data);
		}

		public function getallrisk(){
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getallrisk');
			$data['engnya'] = base_url('index.php/report/risk/getallrisk');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getallrisk');
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>
			';
			
			$this->load->view('maini/header', $data);
			//$this->load->view('getallrisk_option', $data); -->>>> prepare lap pertgl
			$this->load->view('getallrisk', $data);
			$this->load->view('footer', $data);
		}

		public function getallrisk2(){
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getallrisk');
			$data['engnya'] = base_url('index.php/report/risk/getallrisk');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getallrisk');
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>
			';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getallrisk', $data);
			$this->load->view('footer', $data);
		}

		public function getallrisk3(){
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getallrisk');
			$data['engnya'] = base_url('index.php/report/risk/getallrisk');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getallrisk');
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>
			';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getallrisk_pertgl', $data);
			$this->load->view('footer', $data);
		}

		public function getallriskperiode(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getallriskperiode');
			$data['engnya'] = base_url('index.php/report/risk/getallriskperiode');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getallriskperiode');
			$data['periode'] = $this->risk->getAllPeriode();
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getallriskperiode', $data);
			$this->load->view('footer', $data);
		}

		public function get2ndcategory(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getallriskperiode');
			$data['engnya'] = base_url('index.php/report/risk/getallriskperiode');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getallriskperiode');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['category'] = $this->risk->getcategory();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('get2ndcategory', $data);
			$this->load->view('footer', $data);
		}		

		public function getactionplan(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getactionplan');
			$data['engnya'] = base_url('index.php/report/risk/getactionplan');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getactionplan');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getactionplan', $data);
			$this->load->view('footer', $data);
		}		

		public function gettreatment(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/gettreatment');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('gettreatment', $data);
			$this->load->view('footer', $data);
		}

		public function gettable(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettable');
			$data['engnya'] = base_url('index.php/report/risk/gettable');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/gettable');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('gettable', $data);
			$this->load->view('footer', $data);
		}		

		public function getkri(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getkri');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getkri', $data);
			$this->load->view('footer', $data);
		}	

		public function getcomparison(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getkri');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('getcomparison', $data);
			$this->load->view('footer', $data);
		}				

		public function gettopten(){
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettopten');
			$data['engnya'] = base_url('index.php/report/risk/gettopten');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/gettopten');
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>
			';
			
			$this->load->view('maini/header', $data);
			$this->load->view('gettopten', $data);
			$this->load->view('footer', $data);
		}
				
		/* Excel */

		public function allrisk(){
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getAllrisk();
			$rows = $allrisk->num_rows();
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;
			
			$this->load->view('excelAllrisk',$res);	
		}

		public function allriskperiode(){
			$periode = $this->input->post('periode');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getAllriskperiode($periode);
			$periode = $this->risk->getPeriode($periode);
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;
			$res['rows'] = $allrisk->num_rows();
			$res['data'] = $allrisk->result();
			
			$this->load->view('excelAllriskPeriode',$res);	
		}

		public function apperiode(){
			$periode = $this->input->post('periode');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');				
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getActionPlanPeriode($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;
			$res['rows'] = $allrisk->num_rows();
			$res['data'] = $allrisk->result();
			
			$this->load->view('excelActionplan',$res);	

		}

		public function risktreatmentperiode(){
			$periode = $this->input->post('periode');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');				
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getRiskTreatment($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;
			$res['rows'] = $this->getRowsTreatment($allrisk);
			$res['data'] = $allrisk->result();
			
			$this->load->view('excelriskTreatment',$res);	

		}

		public function getRowsTreatment($allrisk){
			foreach ($allrisk->result() as $key) {
				$arr[] = $key->risk_event;
			}			
				$unique = array_unique($arr);
				return count($unique);	

		}

		public function toptenrisk(){
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getTopTenRisk();
			$rows = $allrisk->num_rows();
			$res['rows'] = $rows;
			$res['data'] = $allrisk->result();
			
			$this->load->view('exceltopten',$res);	
		}

		public function krimonitoring(){
			$periode = $this->input->post('periode');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getkri($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;	
			$res['rows'] = $rows;
			$res['data'] = $allrisk->result();			
			$this->load->view('excelkri',$res);
		}

		public function outofcome(){
			$periode1 = $this->input->post('periode1');
			$periode2 = $this->input->post('periode2');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);			
			$h = $this->risk->getoutcome($periode1,$periode2,'high');
			$m = $this->risk->getoutcome($periode1,$periode2,'moderate');
			$l = $this->risk->getoutcome($periode1,$periode2,'low');
			foreach ($h->result() as $key) {
				$h1 = $key->rp1;
				$h2 = $key->rp2;
			}

			foreach ($m->result() as $key) {
				$m1 = $key->rp1;
				$m2 = $key->rp2;
			}

			foreach ($l->result() as $key) {
				$l1 = $key->rp1;
				$l2 = $key->rp2;
			}			
			
			$p1 = $l1 + $m1 + $h1;
			$p2 = $l2 + $m2 + $h2;

			$res['h1'] = $h1;
			$res['h2'] = $h2;
			$res['l1'] = $l1;
			$res['l2'] = $l2;
			$res['m1'] = $m1;
			$res['m2'] = $m2;
			$res['p1'] = $p1;
			$res['p2'] = $p2;
			$this->load->view('exceloutcome',$res);

		}

		public function alltable(){
			$periode = $this->input->post('periode');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->gettable($periode);
			$rows = $allrisk->num_rows();
			$res['rows'] = $rows;
			$res['data'] = $allrisk->result();			
			$this->load->view('excelrisktable',$res);
		}	

		public function categorize(){
			$this->load->model('reporti/risk_model','risk',true);
			$periode = $this->input->post('periode');
			$category = $this->input->post('category');
	        $this->load->library('excel/Biffwriter');
	        $this->load->library('excel/Format');
	        $this->load->library('excel/OLEwriter');
	        $this->load->library('excel/Parser');
	        $this->load->library('excel/Workbook');
	        $this->load->library('excel/Worksheet');			
			// $this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->get2ndcategory($periode,$category);
			$catname = $this->risk->getcategoryname($category);
			foreach ($allrisk->result() as $key) {
				$impact = array($key->Insignificant,$key->Minor,$key->Major,$key->Moderate,$key->Catastrophic);
				$likelihood = array($key->Very_Low,$key->Low,$key->Moderate,$key->High,$key->Very_High);
			}

			foreach ($catname as $key) {
				$ca = $key->cat_name;
				$cc = $key->cat_code;
			}

			$periode = $this->risk->getPeriode($periode);
			foreach ($periode as $key) {
				$pa = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}			

			$maxImpact = max($impact);		
			$maxLikelihood = max($likelihood);

			$a = $this->getImpact1($impact,$maxImpact);
			$b = $this->getImpact2($impact,$maxImpact,$a);
			$c = $this->getImpact3($impact,$maxImpact,$b);
			$il = $this->getRealImpact($b,$c);

			$d = $this->getLikehood1($likelihood,$maxLikelihood);
			$e = $this->getLikehood2($likelihood,$maxLikelihood,$d);
			$f = $this->getLikehood3($likelihood,$maxLikelihood,$e);
			$li = $this->getRealLikehood($e,$f);

			$ri = $this->getRiskLevel($il,$li);

			//echo $il . '<br/>' . $li . '<br/>' . $ri;			
			$res['il'] = $il;
			$res['li'] = $li;
			$res['ri'] = $ri;	
			$res['cn'] = $ca;
			$res['cc'] = $cc;
			$res['pa'] = $pa;	
			$this->load->view('excel2ndcategory',$res);			

		}	

		public function getImpact1($impact,$max){
			if($impact[0] == $max){
				$a = 'INSIGNIFICANT'; 
			}
			else{
				if($impact[1] == $max){
					$a = 'MINOR';
				}
				else{
					$a = 'MODERATE';
				}
			}

			return $a;
		}

		public function getImpact2($impact,$max,$a){
			if($impact[2] == $max){
				$b = 'MAJOR'; 
			}
			else{
				if($impact[3] == $max){
					$b = 'CATASTROPHIC';
				}
				else{
					$b = $a;
				}
			}

			return $b;
		}	

		public function getImpact3($impact,$max,$b){
			if($impact[3] == $max){
				$c = 'CATASTROPHIC'; 
			}
			else{
				$c = $b;
			}

			return $c;
		}

		public function getRealImpact($b,$c){
			if($b == $c){
				$il = $b;
			}
			else{
				$il = 0;
			}

			return $il;
		}

		public function getLikehood1($likelihood,$max){
			if($likelihood[0] == $max){
				$d = 'VERY LOW';
			}
			else{
				if($likelihood[1] == $max){
					$d = 'LOW';
				}
				else{
					$d = 'MODERATE';
				}
			}

			return $d;
		}

		public function getLikehood2($likelihood,$max,$d){
			if($likelihood[3] == $max){
				$e = 'HIGH';
			}
			else{
				if($likelihood[4] == $max){
					$e = 'VERY HIGH';
				}
				else{
					$e = $d;
				}
			}

			return $e;
		}

		public function getLikehood3($likelihood,$max,$e){
			if($likelihood[4] == $max){
				$f = 'VERY HIGH';
			}
			else{
				$f = $e;
			}

			return $f;
		}			

		public function getRealLikehood($e,$f){
			if($e == $f){
				$ll = $e;
			}
			else{
				$ll = 0;
			}

			return $ll;
		}	

		public function getRiskLevel($im,$lk){
			$this->load->model('reporti/risk_model','risk',true);
			$allrisk = $this->risk->getRiskLevel($im,$lk);
			if($allrisk->num_rows() > 0){
				foreach ($allrisk->result() as $key) {
					$risk = $key->risk_level;
				}
			}	
			else{
				$risk = 0;
			}	

			return $risk;
		}


		/* PDF */

		public function allRiskpdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$allrisk = $this->risk->getAllrisk();
			$rows = $allrisk->num_rows();
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;			 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/risk_list',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_list.pdf");
		}	

		public function allriskperiodepdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$periode = $this->input->post('periode');
			$allrisk = $this->risk->getAllriskperiode($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;			
			$rows = $allrisk->num_rows();
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;			 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/risk_listp',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_listp.pdf");
		}

		public function actionplanpdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$periode = $this->input->post('periode');
			$allrisk = $this->risk->getActionPlanPeriode($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;			
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;			 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/actionp',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("actionp.pdf");
		}

		public function risktreatmentpdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$periode = $this->input->post('periode');
			$allrisk = $this->risk->getRiskTreatment($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;			
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $this->getRowsTreatment($allrisk);		 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/risk_treatment',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_treatment.pdf");
		}

		public function toptenpdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$allrisk = $this->risk->getTopTenRisk();
			$rows = $allrisk->num_rows();
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;			 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/risk_topten',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_topten.pdf");
		}

		public function kripdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$periode = $this->input->post('periode');
			$allrisk = $this->risk->getkri($periode);
			$periode = $this->risk->getPeriode($periode);
			$rows = $allrisk->num_rows();
			foreach ($periode as $key) {
				$p = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}
			
			$res['periode'] = $p;			
			//$res['rows'] = 
			$res['data'] = $allrisk->result();
			$res['rows'] = $rows;			 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/kri_monitoring',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("kri_monitoring.pdf");
		}	

		public function outcomepdf(){
			$this->load->library('dompdf_gen');
			$this->load->model('reporti/risk_model','risk',true);	
			$periode1 = $this->input->post('periode1');
			$periode2 = $this->input->post('periode2');					
			$h = $this->risk->getoutcome($periode1,$periode2,'high');
			$m = $this->risk->getoutcome($periode1,$periode2,'moderate');
			$l = $this->risk->getoutcome($periode1,$periode2,'low');
			foreach ($h->result() as $key) {
				$h1 = $key->rp1;
				$h2 = $key->rp2;
			}

			foreach ($m->result() as $key) {
				$m1 = $key->rp1;
				$m2 = $key->rp2;
			}

			foreach ($l->result() as $key) {
				$l1 = $key->rp1;
				$l2 = $key->rp2;
			}			
			
			$p1 = $l1 + $m1 + $h1;
			$p2 = $l2 + $m2 + $h2;

			$res['h1'] = $h1;
			$res['h2'] = $h2;
			$res['l1'] = $l1;
			$res['l2'] = $l2;
			$res['m1'] = $m1;
			$res['m2'] = $m2;
			$res['p1'] = $p1;
			$res['p2'] = $p2;		 
		 
			//$data['datatable'] = $this->risk->getAllRisk_export();
			 
			$this->load->view('pdf/outcome',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("comparison_of_outcome.pdf");
		}

		public function risktablepdf(){
			$periode = $this->input->post('periode');
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');

			$allrisk = $this->risk->gettable($periode);
			$rows = $allrisk->num_rows();
			$res['rows'] = $rows;
			$res['data'] = $allrisk->result();	
	 
			$this->load->view('pdf/risk_table',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_table.pdf");
		}

		public function categorypdf(){
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('dompdf_gen');
			$periode = $this->input->post('periode');
			$category = $this->input->post('category');

			$allrisk = $this->risk->get2ndcategory($periode,$category);
			$catname = $this->risk->getcategoryname($category);
			foreach ($allrisk->result() as $key) {
				$impact = array($key->Insignificant,$key->Minor,$key->Major,$key->Moderate,$key->Catastrophic);
				$likelihood = array($key->Very_Low,$key->Low,$key->Moderate,$key->High,$key->Very_High);
			}

			foreach ($catname as $key) {
				$ca = $key->cat_name;
				$cc = $key->cat_code;
			}

			$periode = $this->risk->getPeriode($periode);
			foreach ($periode as $key) {
				$pa = $key->periode_name . ' ' . $key->periode_start . ' s/d ' . $key->periode_end;
			}			

			$maxImpact = max($impact);		
			$maxLikelihood = max($likelihood);

			$a = $this->getImpact1($impact,$maxImpact);
			$b = $this->getImpact2($impact,$maxImpact,$a);
			$c = $this->getImpact3($impact,$maxImpact,$b);
			$il = $this->getRealImpact($b,$c);

			$d = $this->getLikehood1($likelihood,$maxLikelihood);
			$e = $this->getLikehood2($likelihood,$maxLikelihood,$d);
			$f = $this->getLikehood3($likelihood,$maxLikelihood,$e);
			$li = $this->getRealLikehood($e,$f);

			$ri = $this->getRiskLevel($il,$li);

			//echo $il . '<br/>' . $li . '<br/>' . $ri;			
			$res['il'] = $il;
			$res['li'] = $li;
			$res['ri'] = $ri;	
			$res['cn'] = $ca;
			$res['cc'] = $cc;
			$res['pa'] = $pa;		 
			$this->load->view('pdf/risk_category',$res);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->render();
			$this->dompdf->stream("risk_category.pdf");
		}		

		public function listofrisk(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/listofrisk');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_listofrisk', $data);
			$this->load->view('footer', $data);
		}	
		
		function listofrisk_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->listofrisk($this->input->post());
			 
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			 
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofrisk_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=listofrisk.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
			function listofrisk_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->listofrisk($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			 
			$data['total_data'] = count($data['datanya']); 
			 
			$this->load->view('listofrisk_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("listofrisk.pdf");
			
		}
		
		public function listofrisketc(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/listofrisketc');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_listofrisketc', $data);
			$this->load->view('footer', $data);
		}	
		
		function listofrisketc_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->listofrisketc($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofrisketc_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=listofrisketc.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function listofrisketc_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->listofrisketc($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('listofrisketc_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("listofrisketc.pdf");
			
		}
		
		function risktreatmentreport(){
			
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/risktreatmentreport');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_risktreatmentreport', $data);
			$this->load->view('footer', $data);
			
		}
		
		function risktreatmentreport_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->risktreatmentreport($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('risktreatmentreport_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=risktreatmentreport.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function risktreatmentreport_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->risktreatmentreport($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('risktreatmentreport_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("risktreatmentreport.pdf");
			
		}
		
		public function listofall(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/listofall');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_listofall', $data);
			$this->load->view('footer', $data);
		}	
		
		function listofall_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->listofall($this->input->post());
			
			$data['postnya']=$this->input->post();
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofall_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=listofall.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function listofall_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->listofall($this->input->post());
			
			$data['postnya']=$this->input->post();
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('listofall_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("listofall.pdf");
			
		}
		
		public function listofall1(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/listofall1');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_listofall1', $data);
			$this->load->view('footer', $data);
		}	
		
		function listofall1_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->listofall1($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofall1_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=listofall1.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function listofall1_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->listofall1($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('listofall1_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("listofall1.pdf");
			
		}
		
		public function comparison1(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/comparison1');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_comparison1', $data);
			$this->load->view('footer', $data);
		}	
		
		function comparison1_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->comparison1($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('comparison1_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=comparison1.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function comparison1_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->comparison1($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('comparison1_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("comparison1.pdf");
			
		}
		
		public function comparison2(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/comparison2');
			$data['engnya'] = base_url('index.php/report/risk/comparison2');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/comparison2');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_comparison2', $data);
			$this->load->view('footer', $data);
		}	
		
		function comparison2_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->comparison2($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('comparison2_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=comparison2.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function comparison2_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->comparison2($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('comparison2_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("comparison2.pdf");
			
		}
		
		public function topten(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/topten');
			$data['engnya'] = base_url('index.php/report/risk/topten');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/topten');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_topten', $data);
			$this->load->view('footer', $data);
		}	
		
		function topten_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->topten($this->input->post());
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('topten_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=topten.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function topten_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->topten($this->input->post());
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('topten_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("topten.pdf");
			
		}
		
		public function topten2(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/topten2');
			$data['engnya'] = base_url('index.php/report/risk/topten2');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/topten2');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_topten2', $data);
			$this->load->view('footer', $data);
		}	
		
		function topten2_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->topten2($this->input->post());
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('topten_table2', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=topten2.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function topten2_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->topten2($this->input->post());
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('topten_table2',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("topten2.pdf");
			
		}
		
		public function KRI_monitoring(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/KRI_monitoring');
			$data['engnya'] = base_url('index.php/report/risk/KRI_monitoring');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/KRI_monitoring');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_KRI_monitoring', $data);
			$this->load->view('footer', $data);
		}	
		
		function KRI_monitoring_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->KRI_monitoring($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('KRI_monitoring_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=KRI_monitoring.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function KRI_monitoring_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->KRI_monitoring($this->input->post());
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('KRI_monitoring_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("KRI_monitoring.pdf");
			
		}
		
		
		public function getcomparison1(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getcomparison1');
			$data['engnya'] = base_url('index.php/report/risk/getcomparison1');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getcomparison1');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_getcomparison1', $data);
			$this->load->view('footer', $data);
		}	
		
		function getcomparison1_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->getcomparison1($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('getcomparison1_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=getcomparison1.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function getcomparison1_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "potrait";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->getcomparison1($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('getcomparison1_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("getcomparison1.pdf");
			
		}
		
		public function getcomparison2(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/getcomparison2');
			$data['engnya'] = base_url('index.php/report/risk/getcomparison2');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/getcomparison2');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_getcomparison2', $data);
			$this->load->view('footer', $data);
		}	
		
		function getcomparison2_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->getcomparison2($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('getcomparison2_table', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=getcomparison2.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function getcomparison2_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "potrait";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->getcomparison2($this->input->post());
			
			$data['cekperiode1'] = $this->risk->cekperiode($this->input->post('periode_prev'));
			
			$data['cekperiode2'] = $this->risk->cekperiode($this->input->post('periode_cur'));
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('getcomparison2_table',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("getcomparison2.pdf");
			
		}
		 
		public function riskmap(){
			 
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/riskmap');
			$data['engnya'] = base_url('index.php/report/risk/riskmap');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/riskmap');
			
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>
			';
			
			$this->load->model('reporti/risk_model','risk',true);
			$data['periode'] = $this->risk->getAllPeriode();			
			
			$this->load->view('maini/header', $data); 
			$this->load->view('riskmap', $data);
			$this->load->view('footer', $data);
		}
		
		public function riskmap_data(){
			 
			$this->load->model('reporti/risk_model','risk',true);
			$data['datanya'] = $this->risk->riskmap();
			
			$this->load->view('riskmap_data', $data);
		}
		
		function riskmap_data_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			 
			$data['datanya'] = $this->risk->riskmap($this->input->post());

			$data['periodenya'] = $this->risk->cekperiode($this->input->post('periode'));	 		
 
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('riskmap_data', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=Periode_risk_map.xls');
			header("Content-Description: File Transfer");
		 
			echo $stringData;
			exit;
			
		}
		
		
		function riskmap_data_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "potrait";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->riskmap($this->input->post());
			
			$data['periodenya'] = $this->risk->cekperiode($this->input->post('periode'));	 		
 
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('riskmap_data',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("Periode_risk_map.pdf");
			
		}


		public function listofrisk_user($username){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/gettreatment');
			$data['engnya'] = base_url('index.php/report/risk/gettreatment');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/listofrisk');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';

			$data['username'] = $username;
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_listofrisk_user', $data);
			$this->load->view('footer', $data);
		}	

		function listofrisk_excel_user($username){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->model('admini/mperiode');
			$this->load->library('parser');

			//periode saat ini
			$periode = $this->mperiode->getCurrentPeriode();
			  
			$data['datanya'] = $this->risk->listofrisk_user($username, $periode['periode_id']);
			 
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));

			
			 
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofrisk_table_user', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=listofrisk.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}

		function listofrisk_pdf_user($username){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			$this->load->model('admini/mperiode');
			
			$orientation = "landscape";
			$paper_size='a4';
			 

			//periode saat ini
			$periode = $this->mperiode->getCurrentPeriode();

			$data['datanya'] = $this->risk->listofrisk_user($username, $periode['periode_id']);
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			 
			$data['total_data'] = count($data['datanya']); 
			 
			$this->load->view('listofrisk_table_user',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("listofrisk.pdf");
			
		}

		function listofrisk_pdf_recover(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			$this->load->model('admini/mperiode');
			
			$orientation = "landscape";
			$paper_size='a4';
			 

			//periode saat ini
			$periode = $this->mperiode->getCurrentPeriode();

			$data['datanya'] = $this->risk->listofrisk_recover($periode['periode_id']);
			
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));
			 
			$data['total_data'] = count($data['datanya']); 
			 
			$this->load->view('listofrisk_table_recover',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("Recover_Roll_Forward_Risk_RAC.pdf");
			
		}

		function listofrisk_excel_recover(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->model('admini/mperiode');
			$this->load->library('parser');

			//periode saat ini
			$periode = $this->mperiode->getCurrentPeriode();
			  
			$data['datanya'] = $this->risk->listofrisk_recover($periode['periode_id']);
			 
			$data['cekperiode'] = $this->risk->cekperiode($this->input->post('periode'));

			
			 
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('listofrisk_table_recover', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=Recover_Roll_Forward_Risk_RAC.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}

		public function score2(){
			$this->load->model('reporti/risk_model','risk',true);

			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/reporti/risk/score2');
			$data['engnya'] = base_url('index.php/report/risk/score2');		
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('reporti/risk/score2');
			$data['periode'] = $this->risk->getAllPeriode();
			$data['pageLevelStyles'] = '
			<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
			';
			
			$data['pageLevelScripts'] = '
			<script src="assets/scripts/dashboard/getallrisk.js"></script>';
			
			$this->load->view('maini/header', $data);
			$this->load->view('report_score2', $data);
			$this->load->view('footer', $data);
		}	
		
		function score2_excel(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			  
			$data['datanya'] = $this->risk->score2($this->input->post());
			
			$data['total_data'] = count($data['datanya']);
			 
			$stringData = $this->parser->parse('score_table2', $data, true);
			 
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");			
			header('Content-type: application/ms-excel');
			header("Expires: 0");
			header('Content-Disposition: attachment; filename=score2n_sub.xls');
			header("Content-Description: File Transfer");
	  
			echo $stringData;
			exit;
			
		}
		
		function score2_pdf(){
			
			$this->load->model('reporti/risk_model','risk',true);
			$this->load->library('parser');
			$this->load->library('dompdf_gen');
			
			$orientation = "landscape";
			$paper_size='a4';
			 
			$data['datanya'] = $this->risk->score2($this->input->post());
			  
			$data['total_data'] = count($data['datanya']);
			 
			$this->load->view('score_table2',$data);
			// Get output html
			$html = $this->output->get_output();
			  
			// Convert to PDF
			$this->dompdf->load_html($html);
			$this->dompdf->set_paper($paper_size, $orientation);
			$this->dompdf->render();			
			$this->dompdf->stream("score2n_sub.pdf");
			
		}
		 
		
	}

?>