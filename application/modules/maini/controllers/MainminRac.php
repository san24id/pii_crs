<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainminRac extends APP_Controlleri {

	public function riskRegisterForm($risk_id = null,$user_by=null)
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

		$page_view = 'risk/risk_register_view';
		$sql = "select risk_id from t_risk_change where risk_id='".$risk_id."' and risk_input_by ='".$user_by."' " ;
		$query = $this->db->query($sql);

	if ($query->num_rows() > 0){
		$res = $this->risk->getRiskByIdNoRefChanges($risk_id,$user_by);
	}else{
		$res = $this->risk->getRiskByIdNoRef($risk_id);
	}
		if ($res) {

				$verifyJs = '<script src="assets/scripts/risk/riskinput.js"></script>
				<script src="assets/scripts/risk/riskubah.js"></script>';
				
				$data['pageLevelScriptsInit'] = "RiskInput.init('".$data['submit_mode']."');
				RiskVerify.init();";
				
				$lib_risk = $this->risk->getRiskByIdNoRef($res['risk_library_id']);
				$data['library_risk'] = $lib_risk;
				$data['library_risk_id'] = $res['risk_library_id'];
				$page_view = 'risk/riskregister_masuk';

				//cari tanggal submit
				$periode = $this->mperiode->getCurrentPeriode();
				$data['tanggal_submit'] = $this->risk->cari_tanggal_submit($user_by,$periode['periode_id']);


			
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
			$data['indonya'] = base_url('index.php/maini/mainrac');
			$data['engnya'] = base_url('index.php/main/mainrac');			
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

}