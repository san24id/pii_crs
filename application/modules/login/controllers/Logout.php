<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index(){

		$this->load->library('session');

		$user= $this->session->credential['username'];

		$this->load->database();
		$sql = "update m_user_sso set on_login = 1 where username = '$user' and computer_name = '".strtolower(gethostbyaddr($_SERVER['REMOTE_ADDR']))."'";
		$rs_user = $this->db->query($sql);

		$this->session->unset_userdata('credential');
		$this->load->helper('url');
		redirect('/login');

	}


}