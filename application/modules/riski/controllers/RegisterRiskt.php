<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterRiskt extends APP_Controlleri {
	function __construct()
    {
        parent::__construct();
        
        $this->load->model('admini/mperiode');
        $this->load->model('riski/risk');
        $this->load->model('riski/mriskregister');
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
					//$menu = 'riski/RiskRegister';
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
				
				<script src="assets/scripts/riski/riskinput.js"></script>
				<script src="assets/scripts/riski/riskubah.js"></script>
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
				$this->load->view('riskregister_masuk', $data);
				$this->load->view('main/footer', $data);
			}
		}
	}
}