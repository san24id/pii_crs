<?php
class Mreminder extends APP_Model {

	public function getmailsetting()
	{
		$sql = "select * from mail_setting limit 1";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'host' => '',
			'port' => '',
			'user' => '',
			'pass' => ''
		);
		if ($row) return $row;
		else return $def;
	}
	
	public function updateMail($host, $port, $user, $pass)
	{
		$sql = "select count(1) numcount from mail_setting";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		
		$par = array(
			'host' => $host,
			'port' => $port,
			'user' => $user,
			'pass' => $pass
		);
		
		if ($row['numcount'] > 0) {
			$sql = "update mail_setting set host = ?, port = ?, user = ?, pass = ?";
			$res = $this->db->query($sql, $par);
			return $res;
		} else {
			$sql = "insert into mail_setting(host, port, user, pass) values (?, ?, ?, ?)";
			$res = $this->db->query($sql, $par);
			return $res;
		}
	}

	public function getregular_risk()
	{
		$sql = "select *, date_format(due_date, '%d-%m-%Y') as due_date_v,  date_format(reminder1, '%d-%m-%Y') as f1due_date,  date_format(reminder2, '%d-%m-%Y') as f2due_date,  date_format(reminder3, '%d-%m-%Y') as f3due_date from mail_regular_risk where id = 1";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'mail_subject' => '',
			'due_date_v' => '',
			'message' => '',
			'f1due_date' => '',
			'f2due_date' => '',
			'f3due_date' => ''
		);
		if ($row) return $row;
		else return $def;
	}

	public function updateMailRiskRegister($subject, $due_date, $message, $r1due_date, $r2due_date, $r3due_date)
	{
		
		$par = array(
			'mail_subject' => $subject,
			'due_date' => $due_date,
			'message' => $message,
			'reminder1' => $r1due_date,
			'reminder2' => $r2due_date,
			'reminder3' => $r3due_date
		);
		
			$sql = "update mail_regular_risk set mail_subject = ?, due_date = ?, message = ?, reminder1 = ?, reminder2 = ?, reminder3 = ? where id = 1";
			$res = $this->db->query($sql, $par);

			$sql = "DELETE FROM `mail_history_regular` WHERE id_mail_type = 1 and periode_id = (SELECT MAX(periode_id) FROM m_periode)";
			$res = $this->db->query($sql, $par);

			$sql = "INSERT INTO `mail_history_regular`(`id_mail_type`, `due_date`, `reminder1`, `reminder2`, `reminder3`, `periode_id`) VALUES (1,'".$due_date."','".$r1due_date."','".$r2due_date."','".$r3due_date."',(SELECT MAX(periode_id) FROM m_periode))";
			$res = $this->db->query($sql, $par);

			return $res;

	}

	public function getrisk_owner()
	{
		$sql = "select *, date_format(due_date, '%d-%m-%Y') as due_date_v,  date_format(reminder1, '%d-%m-%Y') as f1due_date,  date_format(reminder2, '%d-%m-%Y') as f2due_date,  date_format(reminder3, '%d-%m-%Y') as f3due_date from mail_regular_risk where id = 2";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'mail_subject' => '',
			'due_date_v' => '',
			'message' => '',
			'f1due_date' => '',
			'f2due_date' => '',
			'f3due_date' => ''
		);
		if ($row) return $row;
		else return $def;
	}

	public function updateMailRiskOwner($subject, $due_date, $message, $r1due_date, $r2due_date, $r3due_date)
	{
		
		$par = array(
			'mail_subject' => $subject,
			'due_date' => $due_date,
			'message' => $message,
			'reminder1' => $r1due_date,
			'reminder2' => $r2due_date,
			'reminder3' => $r3due_date
		);
		

			$sql = "update mail_regular_risk set mail_subject = ?, due_date = ?, message = ?, reminder1 = ?, reminder2 = ?, reminder3 = ? where id = 2";
			$res = $this->db->query($sql, $par);

			$sql = "DELETE FROM `mail_history_regular` WHERE id_mail_type = 2 and periode_id = (SELECT MAX(periode_id) FROM m_periode)";
			$res = $this->db->query($sql, $par);

			$sql = "INSERT INTO `mail_history_regular`(`id_mail_type`, `due_date`, `reminder1`, `reminder2`, `reminder3`, `periode_id`) VALUES (2,'".$due_date."','".$r1due_date."','".$r2due_date."','".$r3due_date."',(SELECT MAX(periode_id) FROM m_periode))";
			$res = $this->db->query($sql, $par);

			return $res;
	}
		

	public function getaction_plan()
	{
		$sql = "select *, date_format(due_date, '%d-%m-%Y') as due_date_v,  date_format(reminder1, '%d-%m-%Y') as f1due_date,  date_format(reminder2, '%d-%m-%Y') as f2due_date,  date_format(reminder3, '%d-%m-%Y') as f3due_date from mail_regular_risk where id = 3";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'mail_subject' => '',
			'due_date_v' => '',
			'message' => '',
			'f1due_date' => '',
			'f2due_date' => '',
			'f3due_date' => ''
		);
		if ($row) return $row;
		else return $def;
	}

	public function updateMailActionPlan($subject, $due_date, $message, $r1due_date, $r2due_date, $r3due_date)
	{
		
		$par = array(
			'mail_subject' => $subject,
			'due_date' => $due_date,
			'message' => $message,
			'reminder1' => $r1due_date,
			'reminder2' => $r2due_date,
			'reminder3' => $r3due_date
		);
		
			$sql = "update mail_regular_risk set mail_subject = ?, due_date = ?, message = ?, reminder1 = ?, reminder2 = ?, reminder3 = ? where id = 3";
			$res = $this->db->query($sql, $par);

			$sql = "DELETE FROM `mail_history_regular` WHERE id_mail_type = 3 and periode_id = (SELECT MAX(periode_id) FROM m_periode)";
			$res = $this->db->query($sql, $par);

			$sql = "INSERT INTO `mail_history_regular`(`id_mail_type`, `due_date`, `reminder1`, `reminder2`, `reminder3`, `periode_id`) VALUES (3,'".$due_date."','".$r1due_date."','".$r2due_date."','".$r3due_date."',(SELECT MAX(periode_id) FROM m_periode))";
			$res = $this->db->query($sql, $par);

			return $res;
	}

		public function getDataApex($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		
		$sql = "select id, m_periode.periode_name, mail_subject, due_date, message, date_format(due_date, '%d-%m-%Y') as due_date_v,  date_format(reminder1, '%d-%m-%Y') as f1due_date,  date_format(reminder2, '%d-%m-%Y') as f2due_date,  date_format(reminder3, '%d-%m-%Y') as f3due_date, date_format(create_date, '%d-%m-%Y %H:%i:%s') as create_date from mail_ap_execution join m_periode on mail_ap_execution.periode_id = m_periode.periode_id"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}

	public function insertMailActionPlan_exe($periode, $subject, $due_date, $message, $r1due_date, $r2due_date, $r3due_date)
	{
		
		$par = array(
			'periode_id' => $periode,
			'mail_subject' => $subject,
			'due_date' => $due_date,
			'message' => $message,
			'reminder1' => $r1due_date,
			'reminder2' => $r2due_date,
			'reminder3' => $r3due_date
		);
		
			$sql = "INSERT INTO `mail_ap_execution`(periode_id, `mail_subject`, `due_date`, `message`, `reminder1`, `reminder2`, `reminder3`, `mail_type`, status_mail, create_date) VALUES (?, ?, ?, ?, ?, ?, ?, 'action plan execution', 0, NOW())";
			$res = $this->db->query($sql, $par);

			$sql = "UPDATE t_risk_action_plan SET action_plan_status = 4 WHERE periode_id = '".$periode."' AND existing_control_id = 'review'";
			$res = $this->db->query($sql);

			return $res;
	}

	public function deleteDataMailapex($data_id, $uid)
	{
		// if year month start is <= current month
		
		$sql = "delete from mail_ap_execution
				where id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function getaction_apex($id)
	{
		$sql = "select id, m_periode.periode_name, mail_subject, due_date, message, date_format(due_date, '%d-%m-%Y') as due_date_v,  date_format(reminder1, '%d-%m-%Y') as f1due_date,  date_format(reminder2, '%d-%m-%Y') as f2due_date,  date_format(reminder3, '%d-%m-%Y') as f3due_date, date_format(create_date, '%d-%m-%Y %H:%i:%s') as create_date from mail_ap_execution join m_periode on mail_ap_execution.periode_id = m_periode.periode_id  where id ='".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'periode_id' => '',
			'mail_subject' => '',
			'due_date_v' => '',
			'message' => '',
			'f1due_date' => '',
			'f2due_date' => '',
			'f3due_date' => '',
			'create_date' => ''
		);
		if ($row) return $row;
		else return $def;
	}

	public function updateMailActionPlan_exe($id, $periode, $subject, $due_date, $message, $r1due_date, $r2due_date, $r3due_date)
	{
		
		$par = array(
			'mail_subject' => $subject,
			'due_date' => $due_date,
			'message' => $message,
			'reminder1' => $r1due_date,
			'reminder2' => $r2due_date,
			'reminder3' => $r3due_date
		);
		
			$sql = "UPDATE `mail_ap_execution` SET `mail_subject`= ?,`due_date`=?,`message`=?,`reminder1`=?,`reminder2`=?,`reminder3`=? WHERE id = '".$id."'";
			$res = $this->db->query($sql, $par);
			return $res;
	}

	public function getAllPeriode(){
			$sql = "SELECT * FROM (SELECT  periode_id,periode_name,periode_start,periode_end FROM m_periode ORDER BY periode_id DESC LIMIT 2) AS another ORDER BY another.periode_id ASC";
			$query = $this->db->query($sql);
			return $query->result();
	}
}