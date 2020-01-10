<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/policy');
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
		<script src="assets/scripts/admin/policy.js"></script>
		';
		$data['indonya'] = base_url('index.php/admini/news');
		$data['engnya'] = base_url('index.php/admin/news');			
		$data['pageLevelScriptsInit'] = 'News.init();';
		if ($this->session->flashdata('upload_success') != null) {
			$data['upload_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('policy', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function newsInput()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/news');
		$data['engnya'] = base_url('index.php/admin/news');					
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/news');
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
		<script src="assets/scripts/admin/newsinput.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('policy_input', $data);
		$this->load->view('main/footer', $data);
	}
	
	
	
	public function newsGetData()
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
		$this->load->model('admin/mpolicy');
		$data = $this->mpolicy->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function newsInsertData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/news');
		$data['engnya'] = base_url('index.php/admin/news');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/news');
		$data['pageLevelStyles'] = '';
		
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/newsinput.js"></script>';
		
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$news_path = $this->config->config['app_config']['UPLOAD_NEWS_PATH'];
		$upload_path = FCPATH.$news_path;
		
		$config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'pdf'; //'gif|jpg|png';
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filename'))
        {
                $error = array('error' => $this->upload->display_errors());
				$data['error'] = $error['error'];
				$this->load->view('main/header', $data);
				$this->load->view('news_input', $data);
				$this->load->view('main/footer', $data);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
				
				$this->load->model('admin/mpolicy');
				$status = $_POST['status'];
				$news = array(
					'title' => $_POST['title'],
					'filename' => $data['upload_data']['file_name'],
					'status' => $_POST['status'],
					'cb' => $session_data['username']
				);

				if($status == 0){
				$data = $this->mpolicy->insertData($news);
				}else{
				$data = $this->mpolicy->insertData2($news);
				}

				$this->session->set_flashdata('upload_success', true);
                redirect('admin/policy');
        }
	}
	
	
	public function newsDeleteData() {
		$session_data = $this->session->credential;
		$news_path = $this->config->config['app_config']['UPLOAD_NEWS_PATH'];
		$upload_path = FCPATH.$news_path;
		
		$this->load->model('admin/mpolicy');
		$res = $this->mpolicy->deleteData($_POST['id'], $upload_path, $session_data['username']);
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = 'Error Deleting Data';
		}
		
		echo json_encode($data);
	}
	
	public function newsView($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/policy');
			$data['indonya'] = base_url('index.php/admini/news');
			$data['engnya'] = base_url('index.php/admin/news');				
			$this->load->model('admin/mpolicy');
			$data['news'] = $this->mpolicy->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('news_view', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function newsEdit($nid=false) {
		if ($nid && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['indonya'] = base_url('index.php/admini/news');
			$data['engnya'] = base_url('index.php/admin/news');				
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/news');
			$data['pageLevelStyles'] = '';
			$data['pageLevelScripts'] = '<script src="assets/scripts/admin/newsedit.js"></script>';			
			$data['pageLevelScriptsInit'] = 'News.init();';
			
			$this->load->model('admin/mpolicy');
			$data['news'] = $this->mpolicy->getDataById($nid);
			
			$this->load->view('main/header', $data);
			$this->load->view('policy_edit', $data);
			$this->load->view('main/footer', $data);
		}
	}
	
	public function newsEditData()
	{
		$session_data = $this->session->credential;
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/news');
		$data['engnya'] = base_url('index.php/admin/news');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/news');
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '<script src="assets/scripts/admin/newsedit.js"></script>';
		$data['pageLevelScriptsInit'] = 'News.init();';
		
		$news_path = $this->config->config['app_config']['UPLOAD_NEWS_PATH'];
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
        		$this->load->view('news_edit', $data);
        		$this->load->view('main/footer', $data);
        		exit;
        	}
        } else {
            $change_file = true;
        	$vval = true;
        }
        
        if ($vval)
        {
        	$this->load->model('admin/mpolicy');
        	
        	if ($change_file) { // delete old file
        		$on = $this->mpolicy->getDataById($_POST['id']);
        		@unlink($upload_path.'/'.$on['filename']);
        	}
        	
            $data = array('upload_data' => $this->upload->data());
            if ($data['upload_data']['file_name'] == '') {
            	$news = array(
            		'title' => $_POST['title'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username']
            	);
            } else {
            	$news = array(
            		'title' => $_POST['title'],
            		'filename' => $data['upload_data']['file_name'],
            		'status' => $_POST['status'],
            		'cb' => $session_data['username']
            	);
            }
            $status = $_POST['status'];
            if ($status == 0){
			$data = $this->mpolicy->updateData($_POST['id'], $news, $session_data['username']);
			}else{
				$data = $this->mpolicy->updateData2($_POST['id'], $news, $session_data['username']);
			}
			$this->session->set_flashdata('upload_success', true);
            redirect('admin/policy');
        }
	}
}







