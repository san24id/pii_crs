<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanual extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');		
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
		<script src="assets/scripts/admin/manual.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');			
		$data['pageLevelScriptsInit'] = 'News.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('manual', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function manualInput()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
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
		<script src="assets/scripts/admin/manualinput.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('manual_input', $data);
		$this->load->view('main/footer', $data);
	}
	
	
	
	public function manualGetData()
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
		$this->load->model('admin/musermanual');
		$data = $this->musermanual->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function manualInsertData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
		$data['pageLevelStyles'] = '';
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');		
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/manualinput.js"></script>';
		
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$news_path = $this->config->config['app_config']['UPLOAD_MANUAL_PATH'];
		$upload_path = FCPATH.$news_path;
		
		$config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'pdf'; //'gif|jpg|png';
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filename'))
        {
        		$data = array('upload_data' => $this->upload->data());
				
				$this->load->model('admin/musermanual');
				$news = array(
					'title' => $_POST['title'],
					'filename' => $data['upload_data']['file_name'],
					'status' => $_POST['status'],
					'cb' => $session_data['username'],
					'content' => $_POST['content'],
            		'id_user' => $_POST['role_user']
				);
				$data = $this->musermanual->insertData($news);
				
				$this->session->set_flashdata('upload_success', true);
                redirect('admin/usermanual');
        	/*
                $error = array('error' => $this->upload->display_errors());
				$data['error'] = $error['error'];
				$this->load->view('maini/header', $data);
				$this->load->view('manual_input', $data);
				$this->load->view('main/footer', $data);
				*/
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
				
				$this->load->model('admin/musermanual');
				$news = array(
					'title' => $_POST['title'],
					'filename' => $data['upload_data']['file_name'],
					'status' => $_POST['status'],
					'cb' => $session_data['username'],
					'content' => $_POST['content'],
            		'id_user' => $_POST['role_user']
				);
				$data = $this->musermanual->insertData($news);
				
				$this->session->set_flashdata('upload_success', true);
                redirect('admin/usermanual');
        }
	}
	
	
	public function manualDeleteData() {
		$session_data = $this->session->credential;
		$news_path = $this->config->config['app_config']['UPLOAD_MANUAL_PATH'];
		$upload_path = FCPATH.$news_path;
		
		$this->load->model('admin/musermanual');
		$res = $this->musermanual->deleteData($_POST['id'], $upload_path, $session_data['username']);
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = 'Error Deleting Data';
		}
		
		echo json_encode($data);
	}
	
	public function manualView($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
			$data['indonya'] = base_url('index.php/admini/usermanual');
			$data['engnya'] = base_url('index.php/admin/usermanual');			
			$this->load->model('admin/musermanual');
			$data['news'] = $this->musermanual->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('manual_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function manualEdit($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/admini/manualEdit');
			$data['engnya'] = base_url('index.php/admin/manualEdit');			
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '<script src="assets/scripts/admin/manualedit.js"></script>';			
			$data['pageLevelScriptsInit'] = 'News.init();';
			
			$this->load->model('admin/musermanual');
			$data['news'] = $this->musermanual->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('manual_edit', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function manualEditData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/usermanual');
		$data['engnya'] = base_url('index.php/admin/usermanual');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/usermanual');
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/manualedit.js"></script>';
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$news_path = $this->config->config['app_config']['UPLOAD_MANUAL_PATH'];
		$upload_path = FCPATH.$news_path;
		
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
        		$this->load->view('manual_edit', $data);
        		$this->load->view('main/footer', $data);
        		exit;
        	}
        } else {
            $change_file = true;
        	$vval = true;
        }
        
        if ($vval)
        {
        	$this->load->model('admin/musermanual');
        	
        	if ($change_file) { // delete old file
        		$on = $this->musermanual->getDataById($_POST['id']);
        		@unlink($upload_path.'/'.$on['filename']);
        	}
        	
            $data = array('upload_data' => $this->upload->data());
            if ($data['upload_data']['file_name'] == '') {
            	$news = array(
            		'title' => $_POST['title'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username'],
            		'content' => $_POST['content'],
            		'role_user' => $_POST['role_user']
            	);
            } else {
            	$news = array(
            		'title' => $_POST['title'],
            		'filename' => $data['upload_data']['file_name'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username'],
            		'content' => $_POST['content'],
            		'role_user' => $_POST['role_user']
            	);
            }

			$data = $this->musermanual->updateData($_POST['id'], $news, $session_data['username']);
			
			$this->session->set_flashdata('upload_success', true);
            redirect('admin/usermanual');
        }
	}
}







