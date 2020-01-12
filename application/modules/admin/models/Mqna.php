<?php
class Mqna extends APP_Model {
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
				a.*, 
				b.display_name as created_by_v,
				date_format(a.created_date, '%d-%m-%Y') as created_date_v,
				concat('QA.', LPAD(a.id, 5, '0')) as qna_code,
				CASE WHEN status = 1 then 'Complete'
				ELSE 'Waiting For Response'
				END as qna_status
				from t_qna a left join
				m_user b on a.created_by = b.username"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function submitAnswer($data_id, $answer)
	{
		$sql = "update t_qna
				set status = 1, answer = ?
				where id = ?
				";
		$par = array(
			'a' => $answer,
			'i' => $data_id
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function deleteData($data_id, $uid)
	{
		// if year month start is <= current month
		
		//$this->_logHistory($data_id, $uid, 'D');
		
		$sql = "delete from t_qna
				where id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
}