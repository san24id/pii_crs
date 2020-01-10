<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends APP_Controller {
	function __construct()
    {
        parent::__construct();
        
    }

	
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder');
		$data['engnya'] = base_url('index.php/admin/reminder');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder');
		$data['pageLevelStyles'] = '
		';
		
		$data['pageLevelScripts'] = '
		';
		
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getmailsetting();
		
		$data['update_success'] = false;
		if ($this->session->flashdata('update_success') != null) {
			$data['update_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_setting', $data);
		$this->load->view('main/footer', $data);
	}
		
	public function updateMail()
	{
		$this->load->model('admin/mreminder');
		$data = $this->mreminder->updateMail($_POST['host'], $_POST['port'],$_POST['user'], $_POST['pass']);
		$this->session->set_flashdata('update_success', true);	
		redirect('admin/reminder');
	}

	public function Regular_risk()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Regular_risk');
		$data['engnya'] = base_url('index.php/admin/reminder/Regular_risk');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Regular_risk');
		
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
		
		<script src="assets/scripts/mail/send_register.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "Send_Register.init();";
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getregular_risk();
		
		$data['send_success'] = false;
		if ($this->session->flashdata('send_success') != null) {
			$data['send_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_regular_risk', $data);
		$this->load->view('main/footer', $data);
	}

	public function Risk_owner()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Risk_owner');
		$data['engnya'] = base_url('index.php/admin/reminder/Risk_owner');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Risk_owner');
		
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
		
		<script src="assets/scripts/mail/send_register.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "Send_Register.init();";
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getrisk_owner();
		
		$data['send_success'] = false;
		if ($this->session->flashdata('send_success') != null) {
			$data['send_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_risk_owner', $data);
		$this->load->view('main/footer', $data);
	}

	public function Action_plan()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Action_plan');
		$data['engnya'] = base_url('index.php/admin/reminder/Action_plan');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Action_plan');
		
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
		
		<script src="assets/scripts/mail/send_register.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "Send_Register.init();";
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getaction_plan();
		
		$data['send_success'] = false;
		if ($this->session->flashdata('send_success') != null) {
			$data['send_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_action_plan', $data);
		$this->load->view('main/footer', $data);
	}

	public function send_mail_risk()
	{

	if(isset($_POST['send_register'])){

		$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailRiskRegister($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);

		$session_data = $this->session->credential;

		$sql_mail = "select * from mail_setting where id = 1";
		$query_mail = $this->db->query($sql_mail);
		$hasil_mail = $query_mail->row();

		$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => $hasil_mail->host,
			      'smtp_port' => $hasil_mail->port,
			      'smtp_user' => $hasil_mail->user,
			      'smtp_pass' => $hasil_mail->pass,
			      //'smtp_crypto' => 'tls', //port: 465:ssl
				  'mailtype' => 'html',
				  'newline'  => "\r\n",
               	  'crlf' => "\r\n",
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
		);

			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");	
		
			$sql_user = "select * from tes_mail where status = 0";
			$query_user = $this->db->query($sql_user);
			$hasil_user = $query_user->result();

			foreach($hasil_user as $row_user => $address){

				$this->email->clear();

				$this->email->to($address->email);
				$this->email->from($hasil_mail->user,'iRisk.Admin');
				$this->email->subject($_POST['subject']);
				$this->email->message($_POST['message']);
				
				$result = $this->email->send();
			}

			if($result == true){
				redirect('admin/reminder/Regular_risk');
			}else{
				echo $this->email->print_debugger();
			}

		}else if(isset($_POST['save_register'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailRiskRegister($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	
			redirect('admin/reminder/Regular_risk');

		}else if(isset($_POST['send_owner_risk'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailRiskOwner($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	

		$session_data = $this->session->credential;

		$sql_mail = "select * from mail_setting where id = 1";
		$query_mail = $this->db->query($sql_mail);
		$hasil_mail = $query_mail->row();

		$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => $hasil_mail->host,
			      'smtp_port' => $hasil_mail->port,
			      'smtp_user' => $hasil_mail->user,
			      'smtp_pass' => $hasil_mail->pass,
				  'mailtype' => 'html',
				  'newline'  => "\r\n",
               	  'crlf' => "\r\n",
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
		);
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			
			$sql_user = "select * from tes_mail where status = 0";
			$query_user = $this->db->query($sql_user);
			$hasil_user = $query_user->result();

			foreach($hasil_user as $row_user => $address){

				$this->email->clear();

				$this->email->to($address->email);
				$this->email->from($hasil_mail->user,'iRisk.Admin');
				$this->email->subject($_POST['subject']);
				$this->email->message($_POST['message']);
				
				$result = $this->email->send();
			}

			if($result == true){
				redirect('admin/reminder/Risk_owner');
			}else{
				echo $this->email->print_debugger();
			}

		}else if(isset($_POST['save_owner_risk'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailRiskOwner($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	
			redirect('admin/reminder/Risk_owner');

		}else if(isset($_POST['send_action_plan'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailActionPlan($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	

		$session_data = $this->session->credential;

		$sql_mail = "select * from mail_setting where id = 1";
		$query_mail = $this->db->query($sql_mail);
		$hasil_mail = $query_mail->row();

		$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => $hasil_mail->host,
			      'smtp_port' => $hasil_mail->port,
			      'smtp_user' => $hasil_mail->user,
			      'smtp_pass' => $hasil_mail->pass,
				  'mailtype' => 'html',
				  'newline'  => "\r\n",
               	  'crlf' => "\r\n",
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
		);
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			
			$sql_user = "select * from tes_mail where status = 0";
			$query_user = $this->db->query($sql_user);
			$hasil_user = $query_user->result();

			foreach($hasil_user as $row_user => $address){

				$this->email->clear();

				$this->email->to($address->email);
				$this->email->from($hasil_mail->user,'iRisk.Admin');
				$this->email->subject($_POST['subject']);
				$this->email->message($_POST['message']);
				
				$result = $this->email->send();
			}

			if($result == true){
				redirect('admin/reminder/Action_plan');
			}else{
				echo $this->email->print_debugger();
			}

		}else if(isset($_POST['save_action_plan'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailActionPlan($_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	
			redirect('admin/reminder/Action_plan');

		}

	}

	public function Ap_execution(){
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Ap_execution');
		$data['engnya'] = base_url('index.php/admin/reminder/Ap_execution');	
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Ap_execution');
		$data['pageLevelStyles'] = '
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
		<link href="assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
		';
//		<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
		
		$data['pageLevelScripts'] = '
		<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/scripts/mail/mail_execution.js"></script>
		';
//		<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		$data['pageLevelScriptsInit'] = 'MailApex.init();';
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_action_plan_exe', $data);
		$this->load->view('main/footer', $data);
	}

	public function getdataApex()
	{
		$order_by = $order = $filter_by = $filter_value = null;
		
		if (isset($_POST['order'][0]['column'])) {
			$order_idx = $_POST['order'][0]['column'];
			$order_by = $_POST['columns'][$order_idx]['data'];
			$order = $_POST['order'][0]['dir'];
		}
		
		if (isset($_POST['filter_by']) && isset($_POST['filter_value']) && $_POST['filter_value'] != '' ) {
			$filter_by = $_POST['filter_by'];
			$filter_value = implode('-', array_reverse( explode('-', $_POST['filter_value']) ));
		}
		
		$page = ceil($_POST['start'] / $_POST['length'])+1;

		$row = $_POST['length'];
		$this->load->model('admin/mreminder');
		$data = $this->mreminder->getDataApex($page, $row, $order_by, $order, $filter_by, $filter_value);
		
		$data['draw'] = $_POST['draw']*1;
		$data['page'] = $page;
		echo json_encode($data);
	}


	public function apex_input()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Ap_execution');
		$data['engnya'] = base_url('index.php/admin/reminder/Ap_execution');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Ap_execution');
		
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
		
		<script src="assets/scripts/mail/send_register.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "Send_Register.init();";
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getaction_plan();
		$data['periode'] = $this->mreminder->getAllPeriode();
		
		$data['send_success'] = false;
		if ($this->session->flashdata('send_success') != null) {
			$data['send_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_apex_input', $data);
		$this->load->view('main/footer', $data);
	}

	public function send_mail_execution(){

		if(isset($_POST['insert_apex'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->insertMailActionPlan_exe($_POST['periode'], $_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	
			redirect('admin/reminder/Ap_execution');

		}else if(isset($_POST['send_apex'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->insertMailActionPlan_exe($_POST['periode'], $_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	


			$session_data = $this->session->credential;

			$sql_mail = "select * from mail_setting where id = 1";
			$query_mail = $this->db->query($sql_mail);
			$hasil_mail = $query_mail->row();

			$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => $hasil_mail->host,
			      'smtp_port' => $hasil_mail->port,
			      'smtp_user' => $hasil_mail->user,
			      'smtp_pass' => $hasil_mail->pass,
				  'mailtype' => 'html',
				  'newline'  => "\r\n",
               	  'crlf' => "\r\n",
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			
			$sql_user = "select * from tes_mail where status = 0";
			$query_user = $this->db->query($sql_user);
			$hasil_user = $query_user->result();

			foreach($hasil_user as $row_user => $address){

				$this->email->clear();

				$this->email->to($address->email);
				$this->email->from($hasil_mail->user,'iRisk.Admin');
				$this->email->subject($_POST['subject']);
				$this->email->message($_POST['message']);
				
				$result = $this->email->send();
			}

			if($result == true){
				redirect('admin/reminder/Ap_execution');
			}else{
				echo $this->email->print_debugger();
			}

		}

	}

	public function MailapexDeleteData() {
		$session_data = $this->session->credential;
		$this->load->model('admin/mreminder');

			$res = $this->mreminder->deleteDataMailapex($_POST['id'], $session_data['username']);
			if ($res) {
				$data['success'] = true;
				$data['msg'] = 'SUCCESS';
			} else {
				$data['success'] = false;
				$data['msg'] = 'Error Deleting Data';
			}
		
		
		echo json_encode($data);
	}

	public function apex_edit($id = null)
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/admini/reminder/Ap_execution');
		$data['engnya'] = base_url('index.php/admin/reminder/Ap_execution');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('admin/reminder/Ap_execution');
		
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
		
		<script src="assets/scripts/mail/send_register.js"></script>
		';
		
		$data['pageLevelScriptsInit'] = "Send_Register.init();";
		
		$this->load->model('admin/mreminder');
		$data['mail'] = $this->mreminder->getaction_apex($id);
		
		$data['send_success'] = false;
		if ($this->session->flashdata('send_success') != null) {
			$data['send_success'] = true;
		}
		
		$this->load->view('main/header', $data);
		$this->load->view('mail_apex_edit', $data);
		$this->load->view('main/footer', $data);
	}


	public function save_mail_execution($id = null){

		if(isset($_POST['save_apex'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailActionPlan_exe($id, $_POST['periode'], $_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);	
			redirect('admin/reminder/apex_edit/'.$id);

		}else if(isset($_POST['send_apex'])){

			$due_date = implode('-', array_reverse( explode('-', $_POST['due_date']) ));
			$r1due_date = implode('-', array_reverse( explode('-', $_POST['r1due_date']) ));
			$r2due_date = implode('-', array_reverse( explode('-', $_POST['r2due_date']) ));
			$r3due_date = implode('-', array_reverse( explode('-', $_POST['r3due_date']) ));

			$this->load->model('admin/mreminder');
			$data = $this->mreminder->updateMailActionPlan_exe($id, $_POST['periode'], $_POST['subject'], $due_date, $_POST['message'], $r1due_date, $r2due_date, $r3due_date);


			$session_data = $this->session->credential;

			$sql_mail = "select * from mail_setting where id = 1";
			$query_mail = $this->db->query($sql_mail);
			$hasil_mail = $query_mail->row();

			$config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => $hasil_mail->host,
			      'smtp_port' => $hasil_mail->port,
			      'smtp_user' => $hasil_mail->user,
			      'smtp_pass' => $hasil_mail->pass,
				  'mailtype' => 'html',
				  'charset' => 'iso-8859-1',
				  'wordwrap'=> TRUE
			);
			
		
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			
			$sql_user = "select * from tes_mail where status = 0";
			$query_user = $this->db->query($sql_user);
			$hasil_user = $query_user->result();

			foreach($hasil_user as $row_user => $address){

				$this->email->clear();

				$this->email->to($address->email);
				$this->email->from($hasil_mail->user,'iRisk.Admin');
				$this->email->subject($_POST['subject']);
				$this->email->message($_POST['message']);
				
				$result = $this->email->send();
			}

			if($result == true){
				redirect('admin/reminder/apex_edit/'.$id);
			}else{
				echo $this->email->print_debugger();
			}

		}

	}


	function tes_email() {

        $this->load->library('email');

        $this->email->set_newline("\r\n");

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.iigf.co.id';
        $config['smtp_port'] = '25';
        $config['smtp_user'] = 'irisk.admin@iigf.co.id';
        $config['smtp_from_name'] = 'IRisk.admin';
        $config['smtp_pass'] = 'R15k.2017';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';                       

        $this->email->initialize($config);

        $this->email->from($config['smtp_user'], $config['smtp_from_name']);
        $this->email->to('efrizal@denbe.co.id', 'dezkae.dc@gmail.com');
        $this->email->subject('tes');

        $this->email->message('coba');
        $this->email->send();
        echo $this->email->print_debugger();     

}

	function tes_email2(){
		$config = array();
               //$config['useragent']           = "CodeIgniter";
                //$config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
                $config['smtp_host']           = "mail.iigf.co.id";
                $config['smtp_port']           = "25";
                $config['smtp_user'] = 'irisk.admin@iigf.co.id';
                $config['smtp_pass'] = 'R15k.2017';
                $config['mailtype'] = 'html';
                $config['charset']  = 'utf-8';
                $config['smtp_crypto'] = 'tls';
                $config['newline']  = "\r\n";
                $config['crlf'] = "\r\n";
                $config['wordwrap'] = TRUE;

                $this->load->library('email');

                $this->email->initialize($config);

                $this->email->from('irisk.admin@iigf.co.id', 'admin');
                $this->email->to('efrizal@denbe.co.id', 'dezkae.dc@gmail.com');
                $this->email->subject('Registration Verification: Continuous Imapression');
                $msg = "Thanks for signing up!
            Your account has been created, 
            you can login with your credentials after you have activated your account by pressing the url below.
           ";

            $this->email->message($msg);   
            //$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));

            $this->email->send();
            echo $this->email->print_debugger(); 
	}

}