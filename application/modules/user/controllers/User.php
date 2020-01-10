<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('user');
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
		<script src="assets/scripts/user/user.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'User.init();';
		
		$this->load->model('user/role');
		$this->load->model('user/division');
		
		$roles = $this->role->getAll();
		$data['role_list'] = array();
		foreach($roles as $role) {
			$data['role_list'][] = array(
				'key' => $role['role_id'],
				'value' => $role['role_name']
			);
		}
		
		$divisions = $this->division->getAll();
		$data['division_list'] = array();
		foreach($divisions as $division) {
			$data['division_list'][] = array(
				'key' => $division['division_id'],
				'value' => $division['division_name']
			);
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('user', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function userGetData()
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
		$this->load->model('user/usermodel');
		$data = $this->usermodel->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function userGetData_hide()
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
		$this->load->model('user/usermodel');
		$data = $this->usermodel->getData_hide($page, $row, $order_by, $order, $filter_by, $filter_value);
		foreach($data['data'] as $k=>$v) {
			$data['data'][$k]['checkboxColumn'] = '<input type="checkbox" name="id[]" value="'.$v['id'].'" rtype="'.$v['id'].'">';
		}
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function userInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username'] != '') {
			$this->load->model('user/usermodel');
			
			$par['username'] = $_POST['username'];
			$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$par['password'] = $pass;
			$par['display_name'] = $_POST['display_name'];
			$par['role_id'] = $_POST['role_id'];
			$par['division_id'] = $_POST['division_id'];
			
			$par['created_by'] = $session_data['username'];
			
			$res = $this->usermodel->insertData($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Please Insert Username';
		}
		
		echo json_encode($data);
	}
	
	public function userEditData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username'] != 'admin') {
			$this->load->model('user/usermodel');
			
			$par['display_name'] = $_POST['display_name'];
			$par['role_id'] = $_POST['role_id'];
			$par['division_id'] = $_POST['division_id'];
			
			if (isset($_POST['password']) && $_POST['password'] != '') {
				$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$par['password'] = $pass;
			}
			
			$res = $this->usermodel->updateData($_POST['username'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator is protected and cannot be edited';
		}
		
		echo json_encode($data);
	}
	
	public function userDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('user/usermodel');
		
		if ($_POST['id'] != 'admin') {
			$res = $this->usermodel->deleteData($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator is protected and cannot be deleted';
		}
		
		echo json_encode($data);
	}

	public function userGetData_sso()
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
		$this->load->model('user/usermodel');
		$defFilter = array();
		if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
			$defFilter['filter_library'] = trim($_POST['filter_library']);
		}
		
		$data = $this->usermodel->getData_sso($defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		foreach($data['data'] as $k=>$v) {
			$data['data'][$k]['checkboxColumn'] = '<input type="checkbox" name="id[]" value="'.$v['id'].'" rtype="'.$v['id'].'">';
		}
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

	public function userGetData_Addsso()
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
		$this->load->model('user/usermodel');
		$defFilter = array();
		if (isset($_POST['filter_library']) && trim($_POST['filter_library']) != '') {
			$defFilter['filter_library'] = trim($_POST['filter_library']);
		}
		
		$data = $this->usermodel->getData_Addsso($defFilter, $page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	/* ROLE */
	public function role()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('user/role');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/jstree/dist/themes/default/style.min.css"/>
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/global/plugins/jstree/dist/jstree.min.js"></script>
		<script src="assets/scripts/user/role.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Role.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('role', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function roleGetData()
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
		$this->load->model('user/role');
		$data = $this->role->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function roleInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['role_name'] != '') {
			$this->load->model('user/role');
			
			$par['role_name'] = $_POST['role_name'];
			$par['created_by'] = $session_data['username'];
			
			$res = $this->role->insertData($par);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Please Insert Role Name';
		}
		
		echo json_encode($data);
	}
	
	public function roleEditData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['role_id'] != '1') {
			$this->load->model('user/role');
			
			$par['role_name'] = $_POST['role_name'];
			
			$res = $this->role->updateData($_POST['role_id'], $par, $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator Role is protected and cannot be edited';
		}
		
		echo json_encode($data);
	}
	
	public function roleDeleteData() {
		$session_data = $this->session->credential;
		
		if ($_POST['id'] != '1') {
			$this->load->model('user/role');
			
			$res = $this->role->deleteData($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator Role is protected and cannot be deleted';
		}
		
		
		echo json_encode($data);
	}
	
	public function roleGetMenu() {
		$rid = $_POST['role_id'];
		$this->load->model('user/role');
		
		$res = $this->role->getRecursiveMenu(0);
		$assMenu = $this->role->getRoleMenu($rid);
		
		$menu = $this->role->buildRecursiveMenu($res, $assMenu);
		
		//echo "<pre>";
		//print_r($menu);
		echo json_encode($menu);
		exit;
	}
	
	public function roleEditMenu() {
		$rid = $_POST['role_id'];
		$ids = $_POST['ids'];
		$this->load->model('user/role');
		
		$ar_id = explode('|',$ids);
		
		$res = $this->role->roleAssignMenu($rid, $ar_id);
		
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = 'Error Updating Data';
		}
		echo json_encode($data);
	}
	
	
	
	/* DIVISION */
	public function division()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/useri/division');
		$data['engnya'] = base_url('index.php/user/division');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('user/divison');
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
		<script src="assets/scripts/user/division.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Division.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('division', $data);
		$this->load->view('main/footer', $data);
	}
	
	public function divisionGetData()
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
		$this->load->model('user/division');
		$data = $this->division->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}

		public function divisionGetDataOff()
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
		$this->load->model('user/division');
		$data = $this->division->getDataOff($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function divisionInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['division_name'] != '') {
			$this->load->model('user/division');
			
			$par['division_id'] = $_POST['short_name'];
			$par['division_name'] = $_POST['division_name'];
			$par['short_division'] = $_POST['short_name'];
			$par['direksi_new'] = $_POST['direksi_new'];
			$par['created_by'] = $session_data['username'];
			
			$val = $this->division->getDataById($par['division_id']);
			if ($val) {
				$data['success'] = false;
				$data['msg'] = 'Division <b>'.$par['division_id'].'</b> Already Exists';
			} else {
				$res = $this->division->insertData($par);
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
			$data['msg'] = 'Please Insert Division Name';
		}
		
		echo json_encode($data);
	}
	
	public function divisionEditData()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('user/division');
		
		$par['division_id'] = $_POST['division_id'];
		$par['division_name'] = $_POST['division_name'];
		
		$val = $this->division->getDataById($par['division_name']);
		if ($val) {
			$data['success'] = false;
			$data['msg'] = 'Division <b>'.$par['division_id'].'</b> Already Exists';
		} else {
			$res = $this->division->updateData($par['division_id'], $par, $session_data['username']);
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
	
	public function divisionDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('user/division');
		
		$res = $this->division->deleteData($_POST['id'], $session_data['username']);
		if ($res) {
			$data['success'] = true;
			$data['msg'] = 'SUCCESS';
		} else {
			$data['success'] = false;
			$data['msg'] = 'Error Deleting Data';
		}
		
		echo json_encode($data);
	}
	
	/* Modify User */
	public function modify()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/useri/modify');
		$data['engnya'] = base_url('index.php/user/modify');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('user/modify');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link href="assets/toogle/css/bootstrap-toggle.css" rel="stylesheet">
		<link href="assets/toogle/doc/stylesheet.css" rel="stylesheet">
		';
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script src="assets/toogle/doc/script.js"></script>
		<script src="assets/toogle/js/bootstrap-toggle.js"></script>

		<script src="assets/scripts/user/modify_user.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'User.init();';
		
		$this->load->model('user/role');
		$this->load->model('user/division');
		$this->load->model('user/usermodel');
		
		$roles = $this->role->getAll();
		$data['role_list'] = array();
		foreach($roles as $role) {
			$data['role_list'][] = array(
				'key' => $role['role_id'],
				'value' => $role['role_name']
			);
		}

		//udah ga kepake akibat revisi 3
		$array_role_status = array("PR (PIC Division - RAC)","UR (User - RAC)","HR (Head Division - RAC)","NONE");
		foreach($array_role_status as $key){			
			$data['role_status'][] = array(
				'key' => $key,
				'value' => $key
			);			
		}
		
		$divisions = $this->division->getAll();
		$data['division_list'] = array();
		foreach($divisions as $division) {
			$data['division_list'][] = array(
				'key' => $division['division_id'],
				'value' => $division['division_name']
			);
		}

		$users = $this->usermodel->getAllUsername();
		$data['username_list'] = array();
		foreach($users as $user) {
			$data['username_list'][] = array(
				'key' => $user['username'],
				'value' => $user['display_name']
			);
		}

		$data['userhide'] = $this->usermodel->getAllUsernameHide();

		$this->load->model('risk/mriskregister');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('main/header', $data);
		$this->load->view('modify_user', $data);
		$this->load->view('main/footer', $data);
	}

	public function userMove()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username_id'] != 'admin') {
			$this->load->model('user/usermodel');
			
			
			$par['username_new'] = $_POST['username_new'];
			$par['username_id'] = $_POST['username_id'];
			
			$res = $this->usermodel->updateMove($_POST['username_id'], $par, $session_data['username']);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator is protected and cannot be edited';
		}
		
		echo json_encode($data);
	}
	
	public function userEditRac()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username'] != 'admin') {
			$this->load->model('user/usermodel');
			
			$par['display_name'] = $_POST['display_name'];
			$par['role_id'] = $_POST['role_id'];
			$par['role_status'] = $_POST['role_status'];
			$par['division_id'] = $_POST['division_id'];
			$par['email'] = $_POST['email'];
			$par['status_mail1'] = $_POST['status_mail1'];
			$par['status_mail2'] = $_POST['status_mail2'];

			$risk['division_old'] = $_POST['division_old'];
			$risk['username'] = $_POST['username'];
			
			$res = $this->usermodel->updateData($risk, $par, $session_data['username']);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		} else {
			$data['success'] = false;
			$data['msg'] = 'Administrator is protected and cannot be edited';
		}
		
		echo json_encode($data);
	}

	public function deleteRiskHide()
	{
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$division_id = $_POST['division_id'];
			$role_id = $_POST['role_id'];
			$this->load->model('usermodel');
			$res = $this->usermodel->deleteRiskHide($username, $division_id, $role_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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

	public function deleteUser()
	{
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$division_id = $_POST['division_id'];
			$role_id = $_POST['role_id'];
			$this->load->model('usermodel');
			$res = $this->usermodel->deleteUserPermanent($username, $division_id, $role_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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


	public function deleteSelectedUser() {
		if (isset($_POST['id']) && is_array($_POST['id']) && count($_POST['id']) > 0) {
			$this->load->model('usermodel');
			$res = $this->usermodel->deleteSelectUserPermanent($_POST['id']);
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

	public function blockLogin()
	{
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$division_id = $_POST['division_id'];
			$role_id = $_POST['role_id'];
			$this->load->model('usermodel');
			$res = $this->usermodel->mblockLogin($username, $division_id, $role_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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

	public function unblockLogin()
	{
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
			$division_id = $_POST['division_id'];
			$role_id = $_POST['role_id'];
			$this->load->model('usermodel');
			$res = $this->usermodel->munblockLogin($username, $division_id, $role_id, $this->session->credential['username'], 'RISK_REGISTER_RAC-DELETE');
			
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

	public function manage_division()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/useri/manage_division');
		$data['engnya'] = base_url('index.php/user/manage_division');			
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('user/manage_division');
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
		<script src="assets/scripts/user/manage_division.js"></script>
		';

		$data['pageLevelScriptsInit'] = 'Division.init();';

		$this->load->model('user/division');
	    $this->load->model('risk/riskdireksi');

		$data['listDivision'] = $this->riskdireksi->getDivision();
		$data['listDivision_directorat'] = $this->riskdireksi->getDivision_directorat();

		$divisions = $this->riskdireksi->Div_directoratlist();
		$data['division_list'] = array();
		foreach($divisions as $division) {
			$data['division_list'][] = array(
				'key' => $division['division_id'],
				'value' => $division['division_name']
			);
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('manage_division', $data);
		$this->load->view('main/footer', $data);
	}


	public function mdivisionEdit()
	{
		$session_data = $this->session->credential;
		
		$this->load->model('user/division');
		
		$par['division_id'] = $_POST['division_id'];
		$par['short_name'] = $_POST['short_name'];
		$par['division_name'] = $_POST['division_name'];
		$par['role'] = $_POST['role'];
		$par['direk_id'] = $_POST['direk_id'];
		$par['direksi_new'] = $_POST['direksi_new'];
		$par['status'] = $_POST['status'];
		
		
			$res = $this->division->updateDivisi($par,  $_POST['direksi_new']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = $this->db->error();
			}
		
		echo json_encode($data);
	}


		public function list_user_excel() {
		
		$this->load->model('Usermodel');
		  
		//$data['dataget'] = $this->input->get();
		 
		$data['datanya'] = $this->Usermodel->getAllUser_export($this->input->post());
		 
		$this->load->library('parser');
		
		//pass retrieved data into template and return as a string
        $stringData = $this->parser->parse('export/username_list', $data, true);
		 
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		
		header('Content-type: application/ms-excel');
		header("Expires: 0");
		header('Content-Disposition: attachment; filename=UserList.xls');
		header("Content-Description: File Transfer");
	 
		echo $stringData;
		exit;		   
	}

	public function list_user_pdf() {
	
		$this->load->model('Usermodel');		
		$this->load->library('parser');
		$this->load->library('dompdf_gen');
		
		$orientation = "landscape";
		$paper_size='a4';
		  
		$data['datanya'] = $this->Usermodel->getAllUser_export($this->input->post());
			 
		//$data['total_data'] = count($data['datanya']);
		 
		$this->load->view('export/username_list',$data);
		 
		// Get output html
		$html = $this->output->get_output();
		  
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper($paper_size, $orientation);
		$this->dompdf->render();			
		$this->dompdf->stream("UserList.pdf");
		 
	}

	public function AddNewUser()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username'] != '') {
			$this->load->model('user/usermodel');
			
			$par['username'] = $_POST['username'];
			
			$val = $this->usermodel->getDataById($par['username']);
			if ($val) {
				$data['success'] = false;
				$data['msg'] = 'Username <b>'.$par['username'].'</b> Already Exists';
			} else {
				$res = $this->usermodel->insertDataNewUser($par);
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
			$data['msg'] = 'Please Insert Username';
		}
		
		echo json_encode($data);
	}


 public function divisionGetDataDireksi()
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
		$this->load->model('user/division');
		$data = $this->division->getDataDireksi($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function loadAddUser($rid) 
	{
		if (!empty($rid) && is_numeric($rid)) {
			$this->load->model('user/usermodel');
			$data = $this->usermodel->getloadAddUserSSO($rid);
			echo json_encode($data);
		}
	}

	public function AddNewUserSSO()
	{
		$session_data = $this->session->credential;
		
		
			$this->load->model('user/usermodel');

			$user = $_POST['username'];
			$cm = $_POST['computer_name'];
			
			
				$res = $this->usermodel->insertDataUserSSO($user, $cm);
				if ($res) {
					$data['success'] = true;
					$data['msg'] = 'SUCCESS';
				} else {
					$data['success'] = false;
					$data['msg'] = $this->db->error();
				}
		
		echo json_encode($data);
	}


	public function userEditSSO()
	{
		$session_data = $this->session->credential;
		
		
			$this->load->model('user/usermodel');

			$user = $_POST['username'];
			$cm = $_POST['computer_name'];
			$on = $_POST['on_login'];
			$id = $_POST['id'];
			
			
				$res = $this->usermodel->UpdateDataUserSSO($user, $cm, $on, $id);
				if ($res) {
					$data['success'] = true;
					$data['msg'] = 'SUCCESS';
				} else {
					$data['success'] = false;
					$data['msg'] = $this->db->error();
				}
		
		echo json_encode($data);
	}


	public function deleteUserSSO()
	{

			$session_data = $this->session->credential;
			
			$user = $_POST['username'];
			$cm = $_POST['computer_name'];
			$on = $_POST['on_login'];
			$id = $_POST['id'];
		
			$this->load->model('user/usermodel');

			$res = $this->usermodel->deleteUserSSO($user, $cm, $on, $id);
			
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
			echo json_encode($data);
	}


	public function deleteSelectedUserSSO() {
		if (isset($_POST['id']) && is_array($_POST['id']) && count($_POST['id']) > 0) {
			$this->load->model('usermodel');
			$res = $this->usermodel->deleteSelectUserSSO($_POST['id']);
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

}







