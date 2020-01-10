<?php
class Division extends APP_Model {
	public function getData($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '%'.$filter_value.'%';
		}
		
		$sql = "select  a.division_id, a.division_name, a.short_division, a.status,  b.role_direk, b.group_direk_id, c.group_direk_name from m_division a LEFT JOIN (select 
				a.division_id, a.division_name, a.short_division, a.status , b.division_id as group_direk_id, b.role_id as role_direk
				from m_division a LEFT JOIN m_direksi b ON a.division_id = b.under_direksi where a.division_id not in('Not Available', 'D-CFO', 'D-COO', 'D-CEO') and b.division_id not in('D-CFRAC')) b on a.division_id = b.division_id LEFT JOIN (select a.division_id, a.division_name as group_direk_name from m_division a) c ON c.division_id = b.group_direk_id where a.division_id not in('Not Available', 'D-CFO', 'D-COO', 'D-CEO') and a.status = 0"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'division_id', true);
		return $res;
	}


	public function getDataOff($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '%'.$filter_value.'%';
		}
		
		$sql = "select  a.division_id, a.division_name, a.short_division, a.status,  b.role_direk, b.group_direk_id, c.group_direk_name from m_division a LEFT JOIN (select 
				a.division_id, a.division_name, a.short_division, a.status , b.division_id as group_direk_id, b.role_id as role_direk
				from m_division a LEFT JOIN m_direksi b ON a.division_id = b.under_direksi where a.division_id not in('Not Available', 'D-CFO', 'D-COO', 'D-CEO') and b.division_id not in('D-CFRAC')) b on a.division_id = b.division_id LEFT JOIN (select a.division_id, a.division_name as group_direk_name from m_division a) c ON c.division_id = b.group_direk_id where a.division_id not in('Not Available', 'D-CFO', 'D-COO', 'D-CEO') and a.status = 1"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'division_id', true);
		return $res;
	}
	
	public function getAll()
	{
		$sql = "select 
				*
				from m_division order by division_name";
		$query = $this->db->query($sql);
		
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getDataById($id)
	{
		$sql = "select 
				a.*
				from m_division a where division_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function insertData($data)
	{
	
		$sql = "insert into m_division
				(division_id, division_name, short_division, created_by, created_date)
				values('".$data['division_id']."', '".$data['division_name']."', '".$data['short_division']."', '".$data['created_by']."', NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);

		if($data['direksi_new'] == 'D-CEO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('6','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);
		}
		else if($data['direksi_new'] == 'D-CFO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('9','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);

		}
		else if($data['direksi_new'] == 'D-COO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('8','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);

		}

		$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('7','D-CFRAC','".$data['division_id']."')";
		$res = $this->db->query($sql);	

		return $res;
	}
	
	public function updateData($data_id, $data, $uid)
	{
		$this->_logHistory($data_id, $uid, 'U');
		
		$sql = "update m_division
				set 
					division_name = ?, 
					created_by = ?, 
					created_date = NOW()
				where division_id = ?
				";
		$par = $data;
		$par['user_id'] = $uid;
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function deleteData($data_id, $uid)
	{
		$this->_logHistory($data_id, $uid, 'D');
		
		$sql = "delete from m_division
				where division_id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	private function _logHistory($data_id, $uid, $mode) {
		$sql = "insert into m_division_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from m_division a
				where a.division_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}

	public function updateDivisi($data, $d_new)
	{
		
		$sql = "update m_division
				set 
					division_id = '".$data['division_id']."',
					division_name ='".$data['division_name']."',
					short_division ='".$data['short_name']."',  
					created_date = NOW(),
					status = '".$data['status']."'
				where division_id = '".$data['division_id']."';
				";
		
		$res = $this->db->query($sql);


		$sql = "delete from m_direksi where under_direksi = '".$data['division_id']."'";
		$res = $this->db->query($sql);

		if($d_new == 'D-CEO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('6','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);
		}
		else if($d_new == 'D-CFO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('9','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);

		}
		else if($d_new == 'D-COO'){

			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('8','".$data['direksi_new']."','".$data['division_id']."')";
			$res = $this->db->query($sql);

		}else{
			
			$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('".$data['role']."','".$data['direk_id']."','".$data['division_id']."')";
			$res = $this->db->query($sql);
		}

		$sql = "INSERT INTO `m_direksi`(`role_id`, `division_id`, `under_direksi`) VALUES ('7','D-CFRAC','".$data['division_id']."')";
		$res = $this->db->query($sql);	
		
		return $res;
	}


	public function getDataDireksi($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '%'.$filter_value.'%';
		}
		
		$sql = "select 
				a.division_id, a.division_name, a.short_division, a.status, b.role_id, b.division_id as div_direksi, b.under_direksi, c.division_name as direk_name
				from m_division a, m_direksi b, (select division_id, division_name from m_division where division_name LIKE '%Directorat%' and status = 0) c where a.division_id = b.under_direksi and a.division_id not in('Not Available') and b.division_id not in('D-CFRAC') and a.status = 0 and c.division_id = b.division_id"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'division_id', true);
		return $res;
	}

	public function updateMove($div_id, $direk_id, $direk_new, $data, $uid)
	{
		//$this->_logHistory($data_id, $uid, 'U');

		if($direk_new == 'D-CEO'){
			$role = 6;
		}else if($direk_new == 'D-COO'){
			$role = 8;
		}else if($direk_new == 'D-CFO'){
			$role = 9;
		}

		$sql = "update m_direksi
				set 
					role_id = '".$role."',
				 	division_id = '".$direk_new."'
				where division_id = '".$direk_id."' and under_direksi = '".$div_id."'";
		
		$res = $this->db->query($sql);

		return $res;
	}
	
}