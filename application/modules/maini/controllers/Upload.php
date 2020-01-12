<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/report');
		$data['indonya'] = base_url('index.php/maini/report');
		$data['engnya'] = base_url('index.php/main/report');				
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '';
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admin/mreport');
		$data['report'] = $this->mreport->getAllPublished();
		
		$this->load->view('header', $data);
		$this->load->view('report', $data);
		$this->load->view('footer', $data);
	}
	
	public function view($nid = false)
	{
		if (isset($nid) && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/report');
			$data['indonya'] = base_url('index.php/maini/report');
			$data['engnya'] = base_url('index.php/main/report');					
			
			$this->load->model('admin/mreport');
			$data['report'] = $this->mreport->getDataById($nid);
			
			$this->load->view('header', $data);
			$this->load->view('report_view', $data);
			$this->load->view('footer', $data);
		}
	}
}
