<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kri extends APP_Controlleri {
	function __construct()
    {
        parent::__construct();
        
        $this->load->model('risk/risk');
    }
	
	public function krientry()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/riski/kri/krientry');
		$data['engnya'] = base_url('index.php/risk/kri/krientry');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('riski/kri/krientry');
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
		
		<script src="assets/scripts/riski/krientry.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Kri.init();';
		
		$this->load->model('riski/mriskregister');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('maini/header', $data);
		$this->load->view('kri_entry', $data);
		$this->load->view('maini/footer', $data);
	}
	
	public function insertKriData_no() 
	{
		$data = $this->loadDefaultAppConfig();
		if ($_POST['kri_library_id'] == '') $_POST['kri_library_id'] = null;
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 0,
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
		if ($type == 'SELECTION')
		{
		$cek_color = $this->risk->insertNewKriTmp($kri, $tres);
		
		if($cek_color == true){
		$res = $this->risk->insertNewKri($kri, $tres);
		$resp = array();
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		}else{
			$resp['success'] = false;
			$resp['msg'] = 'Duplicate Warning Color is Found!';
		}
		
		}else{

		$res = $this->risk->insertNewKri($kri, $tres);
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

	public function UpdateKriData_no() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 0,
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
		if ($type == 'SELECTION')
		{
		$cek_color = $this->risk->insertNewKriTmp($kri, $tres);
		
		if($cek_color == true){
		$res = $this->risk->updateNewKri($_POST['id'], $kri, $tres);
		$resp = array();
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		}else{
			$resp['success'] = false;
			$resp['msg'] = 'Duplicate Warning Color is Found!';
		}
		
		}else{

		$res = $this->risk->updateNewKri($_POST['id'], $kri, $tres);
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

	public function UpdateKriData_no_verify() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 1,
			'kri_pic' => $kri_pic[0]['username'],
			'mandatory' => $_POST['mandatory'],
			'treshold_type' => $_POST['treshold_type'],
			'timing_pelaporan' => $dd,
			'kri_owner' => $_POST['kri_owner'],
			'owner_report' => $_POST['owner_report'],
			'created_by' => $data['session']['username'],
			'supporting_evidence' => $_POST['supporting_evidence'],
			'validation' => $_POST['validation']
		);
		
		$tres = array();
		foreach($_POST['treshold_list'] as $v) {
			$tres[] = $v;
		}

		$res = $this->risk->updateNewKri_verify($_POST['id'], $kri, $tres);
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

	public function insertKriData() 
	{
		$data = $this->loadDefaultAppConfig();
		if ($_POST['kri_library_id'] == '') $_POST['kri_library_id'] = null;
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 1,
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
		if ($type == 'SELECTION')
		{
		$cek_color = $this->risk->insertNewKriTmp($kri, $tres);
		
		if($cek_color == true){
		$res = $this->risk->insertNewKri_head($kri, $tres);
		$resp = array();
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		}else{
			$resp['success'] = false;
			$resp['msg'] = 'Duplicate Warning Color is Found!';
		}
		
		}else{

		$res = $this->risk->insertNewKri_head($kri, $tres);
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

	public function UpdateKriData_sub() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 1,
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
		if ($type == 'SELECTION')
		{
		$cek_color = $this->risk->insertNewKriTmp($kri, $tres);
		
		if($cek_color == true){
		$res = $this->risk->updateNewKri_sub($_POST['id'], $kri, $tres);
		$resp = array();
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		}else{
			$resp['success'] = false;
			$resp['msg'] = 'Duplicate Warning Color is Found!';
		}
		
		}else{

		$res = $this->risk->updateNewKri_sub($_POST['id'], $kri, $tres);
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

	public function DeleteKriData_no() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 0,
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
		
		

		$res = $this->risk->deleteNewKri($_POST['id'], $kri, $tres);
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
	
	public function submitKriReport()
	{
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$rid = $_POST['id'];
			
			$kri = $this->risk->getKriById($rid);
			$kri_warning = null;
			$report = $_POST['owner_report'];
			$support = $_POST['support'];
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			} else {

				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
				/*
				$tt = 'NUMERIC';
				if ($report <= 100) $tt = 'PERCENTAGE';
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_type'] == $tt && $value['operator'] == 'BELOW'
						&& $report < $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'BETWEEN' 
						&& ($report >= $value['value_1'] && $report <= $value['value_2']) ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'ABOVE'
						&& $report > $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
				}
				*/
			}
			
			// if is div head then submit for verification, if pic for div head verify
			//tambah role 2 karena rac pengen bisa submit juga
			if ($this->session->credential['role_id'] == 4) {
				$stat = 3;
			}else if ($this->session->credential['role_id'] == 2) {
				$stat = 3;
			} else {
				$stat = 2;
			}
			
			$par = array(
				'kri_status' => $stat,
				'owner_report' => $report,
				'kri_warning' => $kri_warning,
				'supporting_evidence' => $support
			);
			
			$res = $this->risk->updateKri($rid, $par, $this->session->credential['username']);
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
	
	public function verifyKri()
	{
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$rid = $_POST['id'];
			$kri = $this->risk->getKriById($rid);
			$kri_warning = null;
			$report = $_POST['owner_report'];
			$support = $_POST['support'];
			$validation = $_POST['validation'];
			$description = $_POST['description'];
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			}else if ($kri['treshold_type'] == 'VALUE') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			} else {
				$tt = 'NUMERIC';
				if ($report <= 100) $tt = 'PERCENTAGE';
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_type'] == $tt && $value['operator'] == 'BELOW'
						&& $report < $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'BETWEEN' 
						&& ($report >= $value['value_1'] && $report <= $value['value_2']) ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'ABOVE'
						&& $report > $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
				}
			}
			
			$stat = 4;
			
			$par = array(
				'kri_status' => $stat,
				'owner_report' => $report,
				'kri_warning' => $kri_warning,
				'supporting_evidence' => $support,
				'validation' => $validation,
				//'description' => $description
				'description' => null
			);

			
			
			//--------update level
			$this->risk->updateRisk_level($kri['risk_id'], $this->input->post());
			//-------end
			
			$res = $this->risk->updateKri($rid, $par, $this->session->credential['username']);
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

	public function verifyKri_no()
	{
		$data = $this->loadDefaultAppConfig();

		
		$dd = implode('-', array_reverse( explode('-', $_POST['timing_pelaporan']) ));
		
		$kri_pic = $this->risk->kri_pic($_POST['kri_owner']);
		
		$kri = array(
			'risk_id' => $_POST['risk_id'],
			'kri_library_id' => $_POST['kri_library_id'],
			'key_risk_indicator' => $_POST['key_risk_indicator'],
			'kri_status' => 4,
			'kri_pic' => $kri_pic[0]['username'],
			'mandatory' => $_POST['mandatory'],
			'treshold_type' => $_POST['treshold_type'],
			'timing_pelaporan' => $dd,
			'kri_owner' => $_POST['kri_owner'],
			'owner_report' => $_POST['owner_report'],
			'created_by' => $data['session']['username'],
			'supporting_evidence' => $_POST['supporting_evidence'],
			'validation' => $_POST['validation']
		);

		$par = array(
			'risk_impact_level_after_mitigation' => strtoupper($_POST['risk_impact_level_after_kri']),
			'risk_likelihood_key_after_mitigation' => strtoupper($_POST['risk_likelihood_key_after_kri']),
			'risk_level_after_mitigation' => strtoupper($_POST['risk_level_after_kri'])
		);

		
		$tres = array();
		foreach($_POST['treshold_list'] as $v) {
			$tres[] = $v;
		}

		//--------update level
			$this->risk->updateRisk_level_no($_POST['risk_id'], $par);
		//-------end

		$res = $this->risk->updateNewKri_verify($_POST['id'], $kri, $tres);
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

	public function deleteKri()
	{
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$rid = $_POST['id'];
			$kri = $this->risk->getKriById($rid);
			$kri_warning = null;
			$report = $_POST['owner_report'];
			$support = $_POST['support'];
			$validation = $_POST['validation'];
			$description = $_POST['description'];
			
			if ($kri['treshold_type'] == 'SELECTION') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			}else if ($kri['treshold_type'] == 'VALUE') {
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_1'] == $_POST['owner_report']) {
						$kri_warning = $value['result'];
					}
				}
			} else {
				$tt = 'NUMERIC';
				if ($report <= 100) $tt = 'PERCENTAGE';
				
				foreach ($kri['treshold_list'] as $key => $value) {
					if ($value['value_type'] == $tt && $value['operator'] == 'BELOW'
						&& $report < $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'BETWEEN' 
						&& ($report >= $value['value_1'] && $report <= $value['value_2']) ) {
						$kri_warning = $value['result'];
					}
					
					if ($value['value_type'] == $tt && $value['operator'] == 'ABOVE'
						&& $report > $value['value_1'] ) {
						$kri_warning = $value['result'];
					}
				}
			}
			
			$stat = 4;
			
			$par = array(
				'kri_status' => $stat,
				'owner_report' => $report,
				'kri_warning' => $kri_warning,
				'supporting_evidence' => $support,
				'validation' => $validation,
				//'description' => $description
				'description' => null
			);

			
			
			//--------update level
			$this->risk->updateRisk_level($kri['risk_id'], $this->input->post());
			//-------end
			
			$res = $this->risk->deleteKri($rid, $par, $this->session->credential['username']);
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
	
	public function krisetting() {
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/riski/kri/krisetting');
		$data['engnya'] = base_url('index.php/risk/kri/krisetting');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('riski/kri/krisetting');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.min.js"></script>
		<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/js_highchart/highcharts.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/dataTables.rowsGroup.js"></script>
		
		<script src="assets/scripts/riski/krisetting.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Kri.init();';
		
		$this->load->view('maini/header', $data);
		$this->load->view('kri_setting', $data);
		$this->load->view('maini/footer', $data);
	}
	
	public function getRiskForKri() 
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
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = $_POST['filter_value'];
		}
		
		$data = $this->risk->getDataMode('kriNotRisk', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		foreach($data['data'] as $k=>$v) {
			$data['data'][$k]['checkboxColumn'] = '<input type="checkbox" name="id[]" value="'.$v['risk_id'].'" rtype="'.$v['risk_level'].'">';
		}
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getRiskKri() 
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
		
		$data = $this->risk->getDataMode('kriRisk', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function deleteRiskKri()
	{
	
		if (isset($_POST['id']) && is_numeric($_POST['id'])) {
			$risk_id = $_POST['id'];
			$this->load->model('risk/risk');
			$res = $this->risk->deleteRiskri($risk_id);
			
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
	
	public function kriAddRisk() {
		if (isset($_POST['risk_id']) && is_array($_POST['risk_id']) && count($_POST['risk_id']) > 0) {
			$res = $this->risk->addRiskToKri($_POST['risk_id']);
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
	
	public function getKriLibrary() 
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
		
		$data = $this->risk->getDataMode('kriLibrary', $defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function getKri($rid) {
		if ($rid && is_numeric($rid)) {
			$kri = $this->risk->getKriById($rid);
			echo json_encode($kri);
		}
	}
}







