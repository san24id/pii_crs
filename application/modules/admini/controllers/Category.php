<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/category');
		$data['engnya'] = base_url('index.php/admin/category');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/category');
		$data['pageLevelStyles'] = '
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		';
		$data['pageLevelScripts'] = '
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		
		<script src="assets/scripts/admin/category.js"></script>
		';
		$data['pageLevelScriptsInit'] = 'Category.init();
		Category.initLoadCategory();';
		
		//$this->load->model('admin/mcategory');
		
		$this->load->view('maini/header', $data);
		$this->load->view('category', $data);
		$this->load->view('maini/footer', $data);
	}
	
	public function getCategory($cid) 
	{
		$this->load->model('admin/mcategory');
		$cat = $this->mcategory->getDataById($cid);
		echo json_encode($cat);
	}
	
	public function getCategoryByParentId($parent) 
	{
		$this->load->model('admin/mcategory');
		$data = $this->mcategory->getRiskCategory($parent);
		echo json_encode($data);
		exit;
	}
	
	public function categorySubmit() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$resp['success'] = false;
		$resp['msg'] = null;
		$res = false;
		
		$this->load->model('admin/mcategory');
		if ($_POST['mode'] == 'add') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'cat_parent' => 0,
				'created_by' => $data['session']['username']
			);
			$res = $this->mcategory->insertData($par);
		}
		
		if ($_POST['mode'] == 'edit') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'created_by' => $data['session']['username']
			);
			
			$res = $this->mcategory->updateData($_POST['cat_id'], $par);
		}
		
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		echo json_encode($resp);
	}
	
	public function subCategorySubmit() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$resp['success'] = false;
		$resp['msg'] = null;
		$res = false;
		
		$this->load->model('admin/mcategory');
		if ($_POST['mode'] == 'add') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'cat_parent' => $_POST['cat_parent'],
				'created_by' => $data['session']['username']
			);
			$res = $this->mcategory->insertData($par);
		}
		
		if ($_POST['mode'] == 'edit') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'created_by' => $data['session']['username']
			);
			
			$res = $this->mcategory->updateData($_POST['cat_id'], $par);
		}
		
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		echo json_encode($resp);
	}
	
	public function subSubCategorySubmit() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$resp['success'] = false;
		$resp['msg'] = null;
		$res = false;
		
		$this->load->model('admin/mcategory');
		if ($_POST['mode'] == 'add') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'cat_parent' => $_POST['cat_parent'],
				'created_by' => $data['session']['username']
			);
			$res = $this->mcategory->insertData($par);
		}
		
		if ($_POST['mode'] == 'edit') {
			$par = array(
				'cat_code' => $_POST['cat_code'],
				'cat_name' => $_POST['cat_name'],
				'cat_desc' => $_POST['cat_desc'],
				'created_by' => $data['session']['username']
			);
			
			$res = $this->mcategory->updateData($_POST['cat_id'], $par);
		}
		
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = $this->db->error();
		}
		echo json_encode($resp);
	}
	
	public function categoryDelete() 
	{
		$data = $this->loadDefaultAppConfig();
		
		$resp['success'] = false;
		$resp['msg'] = null;
		$res = false;
		
		$this->load->model('admin/mcategory');
		$res = $this->mcategory->deleteData($_POST['id']);
		if ($res) {
			$resp['success'] = true;
			$resp['msg'] = 'SUCCESS';
		} else {
			$resp['success'] = false;
			$resp['msg'] = 'Cannot Delete Category that already have risk';
		}
		echo json_encode($resp);
	}
}







