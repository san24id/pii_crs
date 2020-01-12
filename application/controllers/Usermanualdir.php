<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanualdir extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/usermanual');
		$data['engnya'] = base_url('index.php/main/usermanual');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/usermanual');
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '';
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admin/musermanual');
		$data['news'] = $this->musermanual->getAllPublished();
		
		$this->load->view('header_dir', $data);
		$this->load->view('usermanual', $data);
		$this->load->view('footer', $data);
	}
	
	public function view($nid = false)
	{
		if (isset($nid) && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/usermanual');
			$data['indonya'] = base_url('index.php/maini/usermanual');
			$data['engnya'] = base_url('index.php/main/usermanual');				
			$this->load->model('admin/musermanual');
			$data['news'] = $this->musermanual->getDataById($nid);

			$data['nid'] = $nid;
			
			$this->load->view('header_dir', $data);
			$this->load->view('usermanual_view', $data);
			$this->load->view('footer', $data);
		}
	}
}
