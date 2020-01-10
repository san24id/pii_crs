<?php defined('BASEPATH') OR exit('No direct script access allowed');

class APP_Controller extends MX_Controller {
	function __construct() {
        parent::__construct();
        // Load Base CodeIgniter files
        $this->load->library('session');
        $this->load->helper('url');
        
		if (!$this->session->has_userdata('credential')) {
			redirect('/login');
		}
		
        $this->load->database();

        // Load Base config file(s)
        $this->load->config('app_config');
    }
    
    function loadDefaultAppConfig() {
    	$session_data = $this->session->credential;

    	$data = array();
    	$data['app_config'] = $this->config->item('app_config');
    	$data['base_url'] = base_url();
    	$data['site_url'] = site_url();
    	$data['session'] = $session_data;
    	
    	$this->load->model('admin/mbanner');
    	$data['banner'] = $this->mbanner->getBanner();
    	
    	return $data;
    }
	
	private function __buildRecursiveMenu($menu, $active_module, $list_module) {
		$str = '';
		foreach($menu as $mitem) {
			$title = $mitem['menu']['menu_name'];
			$icon = $arrow = $selected = '';
			if ($mitem['menu']['menu_icon'] != '') {
				$icon = '<i class="'.$mitem['menu']['menu_icon'].'"></i>';
			}
			$link = $xextra = $selmarker = '';
			if ($mitem['child']) {
				$link = '<a href="javascript:;">';
				$xextra = $this->__buildRecursiveMenu($mitem['child'], $active_module, $list_module);
				if ($xextra != '') {
					$xextra = '<ul class="sub-menu">'.$xextra.'</ul>';
				}
				
				if (strpos($xextra, 'class="active"') !== false) {
					$selmarker = 'class="active"';
					$selected = '<span class="selected"></span>';
				}
				
				$arrow = '<span class="arrow "></span>';
			} else {
				$surl = site_url();
				$link = '<a target="_self" href="'.$surl.'/'.$mitem['menu']['menu_module'].'">';
			}
			
			if ($mitem['menu']['menu_module'] == $active_module) {
				$selected = '<span class="selected"></span>';
				$selmarker = 'class="active"';
			}
			
			if ($list_module !== false) {
				if (in_array($mitem['menu']['menu_id'], $list_module)) {
					
				} else {
					if ($mitem['child']) {
						if ($xextra == '') {
							continue;
						}
					} else {
						continue;
					}
				}
			}
			
			
			$str .= '<li '.$selmarker.'>
				'.$link.'
				'.$icon.'
				<span class="title">'.$title.'</span>
				'.$selected.'
				'.$arrow.'
				</a>';
			$str .= $xextra;
			$str .= '</li>';
		}
		return $str;
		
		/*
		<li class="start active open">
			<a href="javascript:;">
			<i class="icon-home"></i>
			<span class="title">Dashboard</span>
			<span class="selected"></span>
			<span class="arrow open"></span>
			</a>
			<ul class="sub-menu">
				<li class="active">
					<a href="index.html">
					<i class="icon-bar-chart"></i>
					Default Dashboard</a>
				</li>
				<li>
					<a href="index_2.html">
					<i class="icon-bulb"></i>
					New Dashboard #1</a>
				</li>
				<li>
					<a href="index_3.html">
					<i class="icon-graph"></i>
					New Dashboard #2</a>
				</li>
			</ul>
		</li>
		*/
	}
	
	private function __getRecursiveMenu($par_id) {
		$sql = "select * from m_menu where menu_parent = ? order by menu_order";
		$query = $this->db->query($sql, array('par' => $par_id));
		
		$menu = false;
		foreach($query->result_array() as $row) {
			$rec = $this->__getRecursiveMenu($row['menu_id']);
			$menu[$row['menu_id']] = array(
				'menu' => $row,
				'child' => $rec
			);
		}
		return $menu;
	}
	
	public function getSidebarMenuStructure($active_module = null) {
		$session_data = $this->session->credential;
		
		if ($session_data['role_id'] == 1) { // admin get all menu structure
			$sql = "select * from m_menu where menu_parent = 0 and menu_id > 22 order by menu_order";
			$query = $this->db->query($sql);
			
			$menu = array();
			foreach($query->result_array() as $row) {
				$rec = $this->__getRecursiveMenu($row['menu_id']);
				$menu[$row['menu_id']] = array(
					'menu' => $row,
					'child' => $rec
				);
			}
			$menu_string = $this->__buildRecursiveMenu($menu, $active_module, false);
			return $menu_string;
		} else {
			$role_id = $session_data['role_id'];		
			$this->load->model('user/role');
			$assMenu = $this->role->getRoleMenu($role_id);
			
			$sql = "select * from m_menu where menu_parent = 0 and menu_id > 22 order by menu_order";
			$query = $this->db->query($sql);
			
			$menu = array();
			foreach($query->result_array() as $row) {
				$rec = $this->__getRecursiveMenu($row['menu_id']);
				$menu[$row['menu_id']] = array(
					'menu' => $row,
					'child' => $rec
				);
			}
			$menu_string = $this->__buildRecursiveMenu($menu, $active_module, $assMenu);
			return $menu_string;
		}
	}	
}
