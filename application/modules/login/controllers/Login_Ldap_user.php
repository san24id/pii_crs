<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_user extends CI_Controller {
	public function index()
	{
		parent::__construct();
		$this->load->helper('url');
		

		$this->load->library('session');


		//GA JADI DI PAKEDI BUAT NOTE AJA 1 DEVICE
		/*
		//update status login
		$this->load->database();
		$user= $this->session->credential['username'];
		$sql_login_status = "update m_user_login set status_login = 'logout' where username = '$user' ";
		$res = $this->db->query($sql_login_status);
		//end
		*/

		$this->session->unset_userdata('credential');
		
		$this->load->config('app_config');
		
		$data = array();
		$data['app_config'] = $this->config->item('app_config');
		$data['base_url'] = base_url();
		$data['site_url'] = site_url();
		
		$this->load->view('login_user_ld', $data);
	}
	
	private function __ldapAuth($username, $password) {
		$rsp = false;
		if ($username =='admin' && $password == 'admin') {
			$rsp['status'] = true;
		} else {
			$rsp['status'] = false;
		}
		return $rsp;
	}
	
	private function __adGetDivision($username) {
		return 'Division Name';
	}
	
	public function authenticate()
	{
		$auth_mode = 'local';
		$this->load->library('session');
		$this->session->unset_userdata('credential');
		$data = array();
		if (isset($_POST['username']) && isset($_POST['password'])) {
			// Admin Auth
			if ($auth_mode == 'local') {
				$this->load->database();
				/*
				//-------------------------------------------- LOCAL LOGIN ---------------------->>>>>
				if ($_POST['username'] == 'admin') {
					$sql = "select * from m_user where username = 'admin' and role_id = 1";
					
					$rs = $this->db->query($sql);
					if ($rs->num_rows() > 0) {
						$row = $rs->row();
						if (password_verify($_POST['password'], $row->password)) {
							$sess = array(
									'credential' => array(
									'username' => $_POST['username'],
									'display_name' => 'Administrator',
									'role_id' => 1,
									'role_status' => 'role_status',
									'role_name' => 'System Admin',
									'main_role_id' => 1,
									'main_role_name' => 'System Admin',
									'division_id' => 'No Division',
									'division_name' => 'No Division',
									'lang' => 'english'
								)
							);
							$this->session->set_userdata($sess);
							

							//klo ga pake ajax
							$this->load->helper('url');
							redirect('main','refresh');
							//end klo ga pake ajax

							$data['success'] = true;
							$data['msg'] = 'success';
						} else {

							//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax

						   $data['success'] = false;
						   $data['msg'] = 'Invalid Username / Password';
						}
					} else {

						//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax

					   $data['success'] = false;
					   $data['msg'] = 'Invalid Username / Password';
					}
				}
				//---------------------------------------------End Local Login----> 
				*/
				
				// ----------------------------------------------- LDAP Login ----------> 
				if ($_POST['username'] != '') {
		//ngilangin Pesan Error / Notice saat Login Nih
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					// using ldap bind
	$ldaprd1  = $_POST['username']; // ldap rdn or dn
					
					$sql = "select * from m_user where username = '$ldaprd1'";
					$rs = $this->db->query($sql);
					$sql3 = "INSERT INTO m_user SET username='$ldaprd1', role_id='3', display_name='new', created_by='sistem', created_date=Now(), role_status='NONE'";
					$sql2 = "select 
							a.username,
							a.password,
							a.display_name,
							a.role_id,
							a.role_status,
							b.role_name,
							a.division_id,
							c.division_name
							from m_user a 
							left join m_role b on a.role_id = b.role_id
							left join m_division c on a.division_id = c.division_id
							where a.username = '$ldaprd1'";
					$rs2 = $this->db->query($sql2);
					
	$ldaprd2  = 'IIGF\ '.$ldaprd1; // domain\user or user@domain.com or displayname 
	$ldaprdn = str_replace(' ','', $ldaprd2);
    //$ldaprdn  = $ldaprd; // domain\user or user@domain.com or displayname //-------- To PII
	$ldappass = $_POST['password']; // associated password
	$host = '172.16.1.3';

    // connect to ldap server
    $ldapconn = ldap_connect($host)
            or die("Could not connect to LDAP server.");

    // Set some ldap options for talking to
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

    if ($ldapconn) {
            // binding to ldap server
            $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

            // verify binding
            if ($ldapbind == 1) {
						if ($rs->num_rows() > 0) {
							$data['msg'] = 'data sudah ada';
							$row = $rs2->row();
							$sess = array(
									'credential' => array(
									'username' => $row->username,
									'display_name' => $row->display_name,
									'main_role_id' => $row->role_id,
									'main_role_name' => $row->role_name,
									'role_id' => $row->role_id,
									'role_status' => $row->role_status,
									'role_name' => $row->role_name,
									'division_id' => $row->division_id,
									'division_name' => $row->division_name,
									'lang' => 'english'
								)
							);
							$this->session->set_userdata($sess);
							
							//klo ga pake ajax
							$this->load->helper('url');
							redirect('main','refresh');
							//end klo ga pake ajax

							$data['success'] = true;
						}else{
							$this->db->query($sql3);
							
							//GA JADI DI NOTE AJA 1 device
							/*
							//----- tambah untuk insert m_user_login cek device
								$sql_cek_device = "INSERT INTO m_user SET username='".$_POST['username']."'";
								$this->db->query($sql_cek_device);
							//end cek device
							*/

							$data['msg'] = 'data belum ada';
							$sql4 = "select 
							a.username,
							a.password,
							a.display_name,
							a.role_id,
							a.role_status,
							b.role_name,
							a.division_id,
							c.division_name
							from m_user a 
							left join m_role b on a.role_id = b.role_id
							left join m_division c on a.division_id = c.division_id
							where a.username = '$ldaprd1'";
					$rs4 = $this->db->query($sql4);
							$row4 = $rs4->row();
							$sess = array(
									'credential' => array(
									'username' => $row4->username,
									'display_name' => $row4->display_name,
									'main_role_id' => $row4->role_id,
									'main_role_name' => $row4->role_name,
									'role_id' => $row4->role_id,
									'role_status' => $row->role_status,
									'role_name' => $row4->role_name,
									'division_id' => $row4->division_id,
									'division_name' => $row4->division_name,
									'lang' => 'english'
								)
							);
							$this->session->set_userdata($sess);

							
							//mulai tulis log
							$file = 'log/log.txt';
							// set deault time jakarta
							date_default_timezone_set('Asia/Jakarta');
							// date of the visit that will be formated this way: 29/May/2011 12:20:03
							$date = date('d/F/Y h:i:s');
							// name of the page that was visited
							$webpage = $_SERVER['SCRIPT_NAME'];
							// ip address of the visitor
							$ipadress = $_SERVER['REMOTE_ADDR'];
							// Opening the text file and writing the visitor’s data
							$fp = fopen($file, 'a');
							fwrite($fp,  '----'.'['.$date.']'.'-------'.$_POST['username'].'----------'.$webpage.'----------'.$ipadress."\r\n");
							fclose($fp);
							// end log

							//pembatas 1 device nih
							//GA JADI DI PAKE DI BUAT NOTE AJA DULU
							
							/*
							$this->load->model('user/usermodel');
							$cekStatusLogin = $this->usermodel->cekStatusLogin($_POST['username']);
							
							if($cekStatusLogin == 'login'){
								$this->load->library('session');
								$this->session->unset_userdata('credential');
								$this->load->helper('url');
								redirect('login?status=device','refresh');
							}else{
							//update status login
							$sql_login_status = "update m_user_login set status_login = 'login' where username = '".$_POST['username']."' ";
							$this->db->query($sql_login_status);
							*/

							//klo ga pake ajax
							$this->load->helper('url');
							redirect('main','refresh');
							//end klo ga pake ajax

						/*
						}
						*/


							$data['success'] = true;
						}
			
			}else{	

							//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax
				
				$data['msg'] = 'Invalid Username Or Password';
			}
					
					
					} else {

						//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax

					   $data['success'] = false;
					   $data['msg'] = 'Invalid Username / Password';
					}
				}
				 //----------------------------------- End LDAP Login -------------->
				
				else {
					$sql = "select 
							a.username,
							a.password,
							a.display_name,
							a.role_id,
							a.role_status,
							b.role_name,
							a.division_id,
							c.division_name
							from m_user a 
							left join m_role b on a.role_id = b.role_id
							left join m_division c on a.division_id = c.division_id
							where a.username = ?";
					
					$rs = $this->db->query($sql, array('u' => $_POST['username']));
					if ($rs->num_rows() > 0) {
						$row = $rs->row();
						if (password_verify($_POST['password'], $row->password)) {
							$sess = array(
									'credential' => array(
									'username' => $_POST['username'],
									'display_name' => $row->display_name,
									'main_role_id' => $row->role_id,
									'main_role_name' => $row->role_name,
									'role_id' => $row->role_id,
									'role_status' => $row->role_status,
									'role_name' => $row->role_name,
									'division_id' => $row->division_id,
									'division_name' => $row->division_name,
									'lang' => 'english'
								)
							);
							$this->session->set_userdata($sess);

							//mulai tulis log
							$file = 'log/log.txt';
							// set deault time jakarta
							date_default_timezone_set('Asia/Jakarta');
							// date of the visit that will be formated this way: 29/May/2011 12:20:03
							$date = date('d/F/Y h:i:s');
							// name of the page that was visited
							$webpage = $_SERVER['SCRIPT_NAME'];
							// ip address of the visitor
							$ipadress = $_SERVER['REMOTE_ADDR'];
							// Opening the text file and writing the visitor’s data
							$fp = fopen($file, 'a');
							fwrite($fp,  '----'.'['.$date.']'.'-------'.$_POST['username'].'----------'.$webpage.'----------'.$ipadress."\r\n");
							fclose($fp);
							// end log


							
							//klo ga pake ajax
							$this->load->helper('url');
							redirect('main','refresh');
							//end klo ga pake ajax

							$data['success'] = true;
							$data['msg'] = 'success';

						} else {

							//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax

						   $data['success'] = false;
						   $data['msg'] = 'Invalid Username / Password';

						}
					} else {

						//klo ga pake ajax
							$this->load->helper('url');
							redirect('login?status=false','refresh');
							//end klo ga pake ajax

					   $data['success'] = false;
					   $data['msg'] = 'Invalid Username / Password';
					}
				}
				
			} else {
				// LDAP AUTHENTICATE
				$auth = $this->__ldapAuth($_POST['username'], $_POST['password']);
				
				if ($auth) {
					if ($auth['status']) {
						// FIND DIVISION IN AD
						$division = $this->__adGetDivision($_POST['username']);
						if ($division) {
							// CHECK DIVISION IN DATABASE
							$this->load->database();
							
							$par = array('uname'=>$division);
							$sql = "select * from m_division where division_id = ?";
							$rs = $this->db->query($sql, $par);
							
							if ($rs->num_rows() > 0) {
								// CHECK USER EXISTS
								$par = array('uname'=>$_POST['username']);
								$sql = "select a.*, b.role_name, c.division_name from 
										m_user a 
										join m_role b on a.role_id = b.role_id
										join m_division c on a.division_id = c.division_id
										where a.username = ?";
								$rs_user = $this->db->query($sql, $par);
								
								if ($rs_user->num_rows() > 0) { // EXISTS
									// CHECK IF DIVISION IS SAME AS AD
									$row_user = $rs_user->row();
									
									if ($row_user->division_id == $division) {
										$sess = array(
												'credential' => array(
												'username' => $_POST['username'],
												'display_name' => $row_user->display_name,
												'role_id' => $row_user->role_id,
												'role_name' => $row_user->role_name,
												'division_id' => $row_user->role_id,
												'division_name' => $row_user->role_name
											)
										);
										$this->session->set_userdata($sess);
										
										$data['success'] = true;
										$data['msg'] = 'success';
									} else {
										$data['success'] = false;
										$data['msg'] = 'Your Division [<b>'.$division.'</b>] is different in Risk Mangement System, 
														Please contact the RAC Team';
									}
								} else { 
									// NOT EXISTS, THEN REGISTER NEW USER AS USER (2)
									$display_name = $_POST['username'];
									$sql = "insert into m_user(
												username, display_name,
												role_id, division_id,
												created_by, created_date
											) values ( ?, ?, ?, ? , ?, NOW() )";
									$data = array(
									        'username' => $_POST['username'],
									        'display_name' => $display_name,
									        'role_id' => 2,
									        'division_id' => $division,
									        'created_by' => 'SYSTEM'
									);
									
									$res = $this->db->query($sql, $data);
									if ($res) {
										$sess = array(
												'credential' => array(
												'username' => $_POST['username'],
												'display_name' => $display_name,
												'role_id' => 2,
												'role_name' => 'User',
												'division_id' => $division,
												'division_name' => $division
											)
										);
										$this->session->set_userdata($sess);
										
										$data['success'] = true;
										$data['msg'] = 'success';
									} else {
										$data['success'] = false;
										$data['msg'] = 'Cannot Auto Register New User';
									}
								}
							} else {
								$data['success'] = false;
								$data['msg'] = 'Cannot Find Your Division [<b>'.$division.'</b>] in Risk Management System, 
												Please contact the RAC Team';
							}
						} else {
							$data['success'] = false;
							$data['msg'] = 'Cannot Find Your Division in Active Directory, 
											Please contact your Administrator';
						}
					} else {
						$data['success'] = false;
						$data['msg'] = 'Invalid Username / Password';
					}
				} else {
					$data['success'] = false;
					$data['msg'] = 'Cannot Connect To Authentication Server';
				}
			}
		} else {
			$data['success'] = false;
			$data['msg'] = 'Invalid Username / Password';
		}
		echo json_encode($data);
	}
	
	public function logout()
	{
		$this->load->library('session');
		$this->session->unset_userdata('credential');
		$this->load->helper('url');
		redirect('/login');
	}
	
	public function test()
	{
		
	}
}
