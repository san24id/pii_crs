<?php
class Mqna extends APP_Model {
	public function getMyData($page, $uid, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = array('uid' => $uid);
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' and '.$filter_by.' like ? ';
			$par['p1'] = '%'.$filter_value.'%';
		}
		
		$sql = "select
					a.*,
					concat('QA.', LPAD(a.id, 5, '0')) as qna_code,
					CASE WHEN status = 1 then 'Complete'
					ELSE 'Waiting For Response'
					END as qna_status,
					date_format(a.created_date, '%d-%m-%Y') as created_date_v
				from t_qna a
				where a.created_by = ? "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}	
	
	public function insertQuestion($uid, $data) 
	{
		$sql = "insert into t_qna(status, subject, question, created_date, created_by)
				values(0, ?, ?, NOW(), ?)";
		$par = array(
			'subject' => $data['subject'], 
			'question' => $data['question'], 
			'created_by' => $uid
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function insertAnswer($qid, $answer) 
	{
		$sql = "update t_qna
				set status = 1, answer = ?
				where id = ?";
		$par = array(
			'answer' => $answer, 
			'id' => $qid
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function deletecrRisk($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select cr_status from t_cr_risk where id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->cr_status;
		if($hasil != '0' ){

		$par['risk_id'] = $risk_id;
		$sql1 = "delete from t_cr_risk where t_cr_risk.id = ?";
		$sql2 = "delete  from t_cr_impact where change_id = ?";
		$sql3 = "delete  from t_cr_control where change_id = ?";
		$sql4 = "delete  from  t_cr_action_plan where change_id = ?";
		 
		
		$res = $this->db->query($sql1, $par);
		$res = $this->db->query($sql2, $par);
		$res = $this->db->query($sql3, $par);
		$res = $this->db->query($sql4, $par);
	 

		return $res;
		}
	}
}
