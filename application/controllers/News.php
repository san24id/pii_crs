<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends APP_Controller {
	public function index()
	{
		$data = $this->loadDefaultAppConfig();
		$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/news');
		$data['indonya'] = base_url('index.php/maini/news');
		$data['engnya'] = base_url('index.php/main/news');				
		$data['pageLevelStyles'] = '';
		$data['pageLevelScripts'] = '';
		$data['pageLevelScriptsInit'] = '';
		
		$this->load->model('admin/mnews');
		$data['news'] = $this->mnews->getAllPublished();
		
		$this->load->view('header', $data);
		$this->load->view('news', $data);
		$this->load->view('footer', $data);
	}
	
	public function view($nid = false)
	{
		if (isset($nid) && is_numeric($nid)) {
			$data = $this->loadDefaultAppConfig();
			$data['sidebarMenu'] = $this->getSidebarMenuStructure('main/news');
			$data['indonya'] = base_url('index.php/maini/news');
			$data['engnya'] = base_url('index.php/main/news');					
			
			$this->load->model('admin/mnews');
			$data['news'] = $this->mnews->getDataById($nid);
			
			$this->load->view('header', $data);
			$this->load->view('news_view', $data);
			$this->load->view('footer', $data);
		}
	}
}
