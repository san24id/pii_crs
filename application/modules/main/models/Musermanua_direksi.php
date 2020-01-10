<?php
class Musermanual extends APP_Model {
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
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAll()
	{
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username";
		$query = $this->db->query($sql);
		
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getAllPublished()
	{
		$role = $this->session->credential['role_id'];
		if($role == 3){
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username
				where a.status = 1 and a.id_user = 3";
		}else if($role == 4){
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username
				where a.status = 1 and a.id_user = 4";
		}else if($role == 5){
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username
				where a.status = 1 and a.id_user = 5";
		}else if($role == 2){
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username
				where a.status = 1 and a.id_user = 2";
		}else if($role == 1){
		$sql = "select 
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username
				where a.status = 1";
		}
		
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
				a.*, b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				case when status = 1 then 'Published'
				else 'Unpublished'
				end as status_v
				from t_user_manual a left join
				m_user b on a.created_by = b.username 
				where a.id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function insertData($data)
	{
		$sql = "insert into t_user_manual
				(title, filename, status, created_by, created_date,content,id_user)
				values(?, ?, ?, ?, NOW(), ?, ?)
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function updateData($data_id, $data, $uid)
	{
		if (isset($data['filename'])) {
			$sql = "update t_user_manual
					set title = ?, filename = ?, status = ?, created_by = ?,
						created_date = NOW(), content = ?, id_user = ?
					where id = ?
					";
			$par = $data;
			$par['data_id'] = $data_id;
			
		} else {
			$sql = "update t_user_manual
					set title = ?, status = ?, created_by = ?, 
						created_date = NOW(), content = ?, id_user = ?
					where id = ?
					";
			$par = $data;
			$par['data_id'] = $data_id;
		}
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function deleteData($data_id, $path, $uid)
	{
		$news = $this->getDataById($data_id);
		if ($news) {
			@unlink($path.'/'.$news['filename']);
			
			$sql = "delete from t_user_manual
					where id = ?
					";
			$par['data_id'] = $data_id;
			
			$res = $this->db->query($sql, $par);
			return $res;
		}
		return false;
	}
	
}