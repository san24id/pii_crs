<?php
class Mreference extends APP_Model {
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
		
		$sql = "select 
				CONCAT_WS('|', a.ref_context, a.ref_key) as ref_id,
				a.*
				from m_reference a "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'ref_id', true);
		return $res;
	}
	
	public function getAll()
	{
		$sql = "select 
				*
				from m_reference order by ref_context, ref_value";
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
				from m_reference a where CONCAT_WS('|', ref_context, ref_key) = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function insertData($data)
	{
	
		$sql = "insert into m_reference
				(ref_context, ref_key, ref_value, created_by, created_date)
				values(?, ?, ?, ?, NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function updateData($data_id, $data, $uid)
	{
		$this->_logHistory($data_id, $uid, 'U');
		
		$sql = "update m_reference
				set ref_key = ?, 
					ref_value = ?, 
					created_by = ?, 
					created_date = NOW()
				where CONCAT_WS('|', ref_context, ref_key) = ?
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
		
		$sql = "delete from m_reference
				where CONCAT_WS('|', ref_context, ref_key) = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	private function _logHistory($data_id, $uid, $mode) {
		return true;
	}
}