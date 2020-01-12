<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
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
		<script src="assets/scripts/admin/report.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/report');
		$data['engnya'] = base_url('index.php/admin/report');			
		$data['pageLevelScriptsInit'] = 'report.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('maini/header', $data);
		$this->load->view('report', $data);
		$this->load->view('maini/footer', $data);
	}
	
	public function reportInput()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/report');
		$data['engnya'] = base_url('index.php/admin/report');					
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
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
		<script src="assets/scripts/admin/reportinput.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'report.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('report_input', $data);
		$this->load->view('main/footer', $data);
	}
	
	
	
	public function reportGetData()
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
		$this->load->model('admin/mreport');
		$data = $this->mreport->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function reportInsertData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/report');
		$data['engnya'] = base_url('index.php/admin/report');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
		$data['pageLevelStyles'] = '';
		
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/reportinput.js"></script>';
		
		$data['pageLevelScriptsInit'] = 'report.init();';
		
		$report_path = $this->config->config['app_config']['UPLOAD_REPORT_PATH'];
		$upload_path = FCPATH.$report_path;
		
		$config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'pdf'; //'gif|jpg|png';
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filename'))
        {
                $error = array('error' => $this->upload->display_errors());
				$data['error'] = $error['error'];
				$this->load->view('main/header', $data);
				$this->load->view('report_input', $data);
				$this->load->view('main/footer', $data);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
				
				$this->load->model('admin/mreport');
				$status = $_POST['status'];
				$report = array(
					'title' => $_POST['title'],
					'filename' => $data['upload_data']['file_name'],
					'status' => $_POST['status'],
					'cb' => $session_data['username']
				);

				if($status == 0){
				$data = $this->mreport->insertData($report);
				}else{
				$data = $this->mreport->insertData2($report);
				}

				$this->session->set_flashdata('upload_success', true);
                redirect('admin/report');
        }
	}
	
	
	public function reportDeleteData() {
		$session_data = $this->session->credential;
		$report_path = $this->config->config['app_config']['UPLOAD_REPORT_PATH'];
		$upload_path = FCPATH.$report_path;
		
		$this->load->model('admin/mreport');
		$res = $this->mreport->deleteData($_POST['id'], $upload_path, $session_data['username']);
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = 'Error Deleting Data';
		}
		
		echo json_encode($data);
	}
	
	public function reportView($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
			$data['indonya'] = base_url('index.php/admini/report');
			$data['engnya'] = base_url('index.php/admin/report');				
			$this->load->model('admin/mreport');
			$data['report'] = $this->mreport->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('report_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function reportEdit($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/admini/report');
			$data['engnya'] = base_url('index.php/admin/report');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '<script src="assets/scripts/admin/reportedit.js"></script>';			
			$data['pageLevelScriptsInit'] = 'report.init();';
			
			$this->load->model('admin/mreport');
			$data['report'] = $this->mreport->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('report_edit', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function reportEditData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/report');
		$data['engnya'] = base_url('index.php/admin/report');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/report');
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/reportedit.js"></script>';
		$data['pageLevelScriptsInit'] = 'report.init();';
		
		$report_path = $this->config->config['app_config']['UPLOAD_REPORT_PATH'];
		$upload_path = FCPATH.$report_path;
		
		$config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'pdf'; //'gif|jpg|png';
        
        $this->load->library('upload', $config);
		$change_file = false;
		$vval = false;

        if ( ! $this->upload->do_upload('filename'))
        {
        	if ($_FILES['filename']['name'] == '') {
        		$vval = true;
        	} else {
        		$error = array('error' => $this->upload->display_errors());
        		$data['error'] = $error['error'];
        		$this->load->view('main/header', $data);
        		$this->load->view('report_edit', $data);
        		$this->load->view('main/footer', $data);
        		exit;
        	}
        } else {
            $change_file = true;
        	$vval = true;
        }
        
        if ($vval)
        {
        	$this->load->model('admin/mreport');
        	
        	if ($change_file) { // delete old file
        		$on = $this->mreport->getDataById($_POST['id']);
        		@unlink($upload_path.'/'.$on['filename']);
        	}
        	
            $data = array('upload_data' => $this->upload->data());
            if ($data['upload_data']['file_name'] == '') {
            	$report = array(
            		'title' => $_POST['title'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username']
            	);
            } else {
            	$report = array(
            		'title' => $_POST['title'],
            		'filename' => $data['upload_data']['file_name'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username']
            	);
            }
            $status = $_POST['status'];
            if ($status == 0){
			$data = $this->mreport->updateData($_POST['id'], $report, $session_data['username']);
			}else{
				$data = $this->mreport->updateData2($_POST['id'], $report, $session_data['username']);
			}
			$this->session->set_flashdata('upload_success', true);
            redirect('admin/report');
        }
	}
}
