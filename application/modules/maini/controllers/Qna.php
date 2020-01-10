<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qna extends APP_Controlleri {
	
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/qna');
		$data['engnya'] = base_url('index.php/main/qna');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/qna');
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
		<script type="text/javascript" src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
		
		<script src="assets/scripts/main/qna.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = '
		Qna.init();
		';
		
		$this->load->view('header', $data);
		$this->load->view('qna', $data);
		$this->load->view('footer', $data);
	}
	
	public function qnaGetData()
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
		$this->load->model('main/mqna');
		$data = $this->mqna->getMyData($page, $this->session->credential['username'], $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function submitQuestion()
	{
		$data['success'] = false;
		$data['msg'] = '';
		if (isset($_POST['subject']) && isset($_POST['question'])) {
			$uid = $this->session->credential['username'];
			$data = array(
				'subject' => $_POST['subject'],
				'question' => $_POST['question']
			);
			$this->load->model('main/mqna');
			$res = $this->mqna->insertQuestion($uid, $data) ;
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		}
		
		echo json_encode($data);
	}
}
