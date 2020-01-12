<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policy extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/policy');
		$data['indonya'] = base_url('index.php/maini/policy');
		$data['engnya'] = base_url('index.php/main/policy');				
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '';
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admin/mpolicy');
		$data['news'] = $this->mpolicy->getAllPublished();
		
		$this->load->view('header', $data);
		$this->load->view('policy', $data);
		$this->load->view('footer', $data);
	}
	
	public function view($nid = false)
	{
		if (isset($nid) && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/policy');
			$data['indonya'] = base_url('index.php/maini/policy');
			$data['engnya'] = base_url('index.php/main/policy');					
			
			$this->load->model('admin/mpolicy');
			$data['news'] = $this->mpolicy->getDataById($nid);
			
			$this->load->view('header', $data);
			$this->load->view('policy_view', $data);
			$this->load->view('footer', $data);
		}
	}
}
