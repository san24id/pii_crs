<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reference extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reference');
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
		<script src="assets/scripts/admin/reference.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Reference.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('reference', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function referenceGetData()
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
		$this->load->model('admin/mreference');
		$data = $this->mreference->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function referenceInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['ref_context'] != '') {
			$this->load->model('admin/mreference');
			
			$par['ref_context'] = $_POST['ref_context'];
			$par['ref_key'] = $_POST['ref_key'];
			$par['ref_value'] = $_POST['ref_value'];
			$par['created_by'] = $session_data['username'];
			
			$kid = $par['ref_context'].'|'.$par['ref_key'];
			
			$val = $this->mreference->getDataById($kid);
			if ($val) {
				$data['success'] = false;
				$data['msg'] = 'reference <b>'.$par['ref_context'].' - '.$par['ref_key'].'</b> Already Exists';
			} else {
				$res = $this->mreference->insertData($par);
				if ($res) {
					$data['success'] = true;
					$data['msg'] = 'SUCCESS';
				} else {
					$data['success'] = false;
					$data['msg'] = $this->db->error();
				}
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Please Insert reference Name';
		}
		
		echo json_encode($data);
	}
	
	public function referenceEditData()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('admin/mreference');
		
		//$par['ref_context'] = $_POST['ref_context'];
		$par['ref_key'] = $_POST['ref_key'];
		$par['ref_value'] = $_POST['ref_value'];
		
		$kid = $_POST['ref_context'].'|'.$par['ref_key'];
		
		$res = $this->mreference->updateData($_POST['ref_id'], $par, $session_data['username']);
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = $this->db->error();
		}
		
		echo json_encode($data);
	}
	
	public function referenceDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mreference');
		
		$res = $this->mreference->deleteData($_POST['id'], $session_data['username']);
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







