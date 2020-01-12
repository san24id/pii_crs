<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends APP_Controlleri {
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
		<script src="assets/scripts/useri/user.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'User.init();';
		
		$this->load->model('useri/role');
		$this->load->model('useri/division');
		
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
		
		$this->load->view('maini/header', $data);
		$this->load->view('user', $data);
		$this->load->view('maini/footer', $data);
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
		$this->load->model('useri/usermodel');
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
		$this->load->model('useri/usermodel');
		$data = $this->usermodel->getData_hide($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function userInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username'] != '') {
			$this->load->model('useri/usermodel');
			
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
			$this->load->model('useri/usermodel');
			
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
		$this->load->model('useri/usermodel');
		
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
	
	/* ROLE */
	public function role()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('useri/role');
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
		<script src="assets/scripts/useri/role.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Role.init();';
		
		$this->load->view('maini/header', $data);
		$this->load->view('role', $data);
		$this->load->view('maini/footer', $data);
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
		$this->load->model('useri/role');
		$data = $this->role->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function roleInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['role_name'] != '') {
			$this->load->model('useri/role');
			
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
			$this->load->model('useri/role');
			
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
			$this->load->model('useri/role');
			
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
		$this->load->model('useri/role');
		
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
		$this->load->model('useri/role');
		
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
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('useri/division');
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
		<script src="assets/scripts/useri/division.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'Division.init();';
		
		$this->load->view('maini/header', $data);
		$this->load->view('division', $data);
		$this->load->view('maini/footer', $data);
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
		$this->load->model('useri/division');
		$data = $this->division->getData($page, $row, $order_by, $order, $filter_by, $filter_value);
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}
	
	public function divisionInsertData()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['division_name'] != '') {
			$this->load->model('useri/division');
			
			$par['division_id'] = $_POST['division_name'];
			$par['division_name'] = $_POST['division_name'];
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
		
		$this->load->model('useri/division');
		
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
		$this->load->model('useri/division');
		
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
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('useri/modify');
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
		<script src="assets/scripts/useri/modify_user.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = 'User.init();';
		
		$this->load->model('useri/role');
		$this->load->model('useri/division');
		$this->load->model('useri/usermodel');
		
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

		$this->load->model('riski/mriskregister');
		$data['division_list'] = $this->mriskregister->getDivisionList();
		
		$this->load->view('maini/header', $data);
		$this->load->view('modify_user', $data);
		$this->load->view('maini/footer', $data);
	}

	public function userMove()
	{
		$session_data = $this->session->credential;
		
		if ($_POST['username_id'] != 'admin') {
			$this->load->model('useri/usermodel');
			
			
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
			$this->load->model('useri/usermodel');
			
			$par['display_name'] = $_POST['display_name'];
			$par['role_id'] = $_POST['role_id'];
			$par['role_status'] = $_POST['role_status'];
			$par['division_id'] = $_POST['division_id'];
			$par['email'] = $_POST['email'];

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
}







