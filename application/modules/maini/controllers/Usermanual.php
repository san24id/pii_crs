<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanual extends APP_Controlleri {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['indonya'] = base_url('index.php/maini/usermanual');
		$data['engnya'] = base_url('index.php/main/usermanual');		
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/usermanual');
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '';
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admini/musermanual');
		$data['news'] = $this->musermanual->getAllPublished();
		
		$this->load->view('header', $data);
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
			$this->load->model('admini/musermanual');
			$data['news'] = $this->musermanual->getDataById($nid);

			$data['nid'] = $nid;
			
			$this->load->view('header', $data);
			$this->load->view('usermanual_view', $data);
			$this->load->view('footer', $data);
		}
	}
}
