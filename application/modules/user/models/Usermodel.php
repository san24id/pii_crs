<?php
class Usermodel extends APP_Model {
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
		
		$sql = "select mtable.* from (
				select 
				a.username,
				a.display_name,
				a.email,
				a.role_id,
				a.role_status,
				a.status_login,
				a.status_mail1,
				a.status_mail2,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where a.role_id <> 1 and password <> 1
				) mtable "
				.$ex_filter
				.$ex_or ;
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}

	public function getData_hide($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		
		$sql = "select mtable.* from (
				select 
				a.id,
				a.username,
				a.display_name,
				a.email,
				a.role_id,
				a.role_status,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where a.role_id != 1 and password = 1
				) mtable "
				.$ex_filter
				.$ex_or ;
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}

	public function getData_sso($defFilter, $page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{

		$par = false;

		$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(username) like ? ) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%'
				);

				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
		

		
		$sql = "select mtable.* from ( select a.id, a.username, a.computer_name, a.on_login, case when a.on_login = 0 then 'Active' else 'Not Active' end as status from m_user_sso a ) mtable ".$ext."";
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}

	public function getData_Addsso($defFilter, $page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{

		$par = false;

		$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(mtable.username) like ? ) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%'
				);

				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
		

		$sql = "select mtable.* from (
				select
				a.id, 
				a.username,
				a.display_name,
				a.email,
				a.role_id,
				a.role_status,
				a.status_login,
				a.status_mail1,
				a.status_mail2,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where a.role_id <> 1 and password <> 1
				) mtable ".$ext."";
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}


	public function getAllUsername()
	{
		$sql = "select 
				*
				from m_user where role_id != 1 and password != 1 ";
		$query = $this->db->query($sql);
		
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getAllUsernameHide()
	{
		$sql = "select 
				*
				from m_user where role_id != 1 and password = 1 ";
		$query = $this->db->query($sql);
		
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function updateMove($data_id, $data, $uid)
	{
		//$this->_logHistory($data_id, $uid, 'U');
		$sql = "update t_risk
				set risk_input_by = ?
				where risk_input_by = ?";

		$par = $data;
		
		$res = $this->db->query($sql, $par);

		$sql = "update m_user
				set password = 1
				where username = '$data_id' ";

		$par = $data;
		
		$res2 = $this->db->query($sql, $par);

		return $res;
	}
	
	public function getDataById($id)
	{
		$sql = "select 
				a.username,
				a.display_name,
				a.role_id,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where a.username = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function getUserPicByDivision($div_id)
	{
		$sql = "select 
				a.username,
				a.display_name,
				a.role_id,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where 
				a.role_id in (4, 5)
				and a.division_id = ?
				";
		$query = $this->db->query($sql, array('divid' => $div_id));
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getUserRACByDivision($div_id)
	{
		$sql = "select 
				a.username,
				a.display_name,
				a.role_id,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where 
				a.role_id in (2, 4, 5)
				and a.division_id = ?
				";
		$query = $this->db->query($sql, array('divid' => $div_id));
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function insertData($data)
	{
	
		$sql = "insert into m_user
				(username, password, display_name, 
				 role_id, division_id, 
				 created_by, created_date)
				values(?, ?, ?, 
				 ?, ?, 
				 ?, NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function updateData($risk, $data, $uid)
	{
		//$this->_logHistory($data_id, $uid, 'U');
		
		$sql_cek = "select * from m_user where role_id = 4 and division_id = '".$par['division_id']."'";
		$res_cek = $this->db->query($sql_cek);


		$pass = '';
		if (isset($data['password']) && $data['password'] != '') {
			$pass = ' username <> ?, ';
			//$pass = ' password = ?, ';
		}
		$sql = "update m_user
				set display_name = ?,
					role_id = ?,
					role_status = ?,
					division_id = ?,
					email = ?,
					status_mail1 = ?,
					status_mail2 = ?,					
					".$pass." 
					created_by = ?, 
					created_date = NOW()
				where username = ?";

		$par = $data;
		$par['user_id'] = $uid;
		$par['data_id'] = $risk['username'];

		$res = $this->db->query($sql, $par);

		if($res_cek->num_rows() == 0){
			$sql = "update t_risk set risk_treatment_owner = (select username from m_user where role_id = '4' and division_id = '".$par['division_id']."') where risk_division = '".$par['division_id']."' and periode_id = (select max(periode_id) from m_periode) and risk_treatment_owner is null";
			$res = $this->db->query($sql);

			$sql = "update t_risk a, t_risk_action_plan b set b.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$par['division_id']."') where a.risk_id = b.risk_id and b.division = '".$par['division_id']."' and a.periode_id = (select max(periode_id) from m_periode) and b.assigned_to is null";
			$res = $this->db->query($sql);

			$sql = "update t_action_plan a set a.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$par['division_id']."') where a.division = '".$par['division_id']."' and a.assigned_to is null";
			$query = $this->db->query($sql);

			$sql = "update t_kri set kri_pic = (select username from m_user where role_id = '4' and division_id = '".$par['division_id']."') where kri_owner = '".$par['division_id']."' and kri_pic is null";
			$query = $this->db->query($sql);
		}

			$sql = "update t_risk set risk_treatment_owner = (select username from m_user where role_id = '4' and division_id = '".$risk['division_old']."') where risk_treatment_owner = '".$risk['username']."' and risk_division = '".$risk['division_old']."' and periode_id = (select max(periode_id) from m_periode)";
			$res = $this->db->query($sql);

			$sql = "update t_risk a, t_risk_action_plan b set b.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$risk['division_old']."') where a.risk_id = b.risk_id and b.assigned_to = '".$risk['username']."' and b.division = '".$risk['division_old']."' and a.periode_id = (select max(periode_id) from m_periode)";
			$res = $this->db->query($sql);

			$sql = "update t_action_plan a set a.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$risk['division_old']."') where a.assigned_to = '".$risk['username']."' and a.division = '".$risk['division_old']."'";
			$query = $this->db->query($sql);

			$sql = "update t_kri set kri_pic = (select username from m_user where role_id = '4' and division_id = '".$risk['division_old']."') where kri_pic = '".$risk['username']."' and kri_owner = '".$risk['division_old']."'";
			$query = $this->db->query($sql);

		return $res;
	}
	
	public function deleteData($data_id, $uid)
	{
		$this->_logHistory($data_id, $uid, 'D');
		
		$sql = "delete from m_user
				where username = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	
	
	private function _logHistory($data_id, $uid, $mode) {
		$sql = "insert into m_user_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from m_user a
				where a.username = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	function get_role($id){
		$this->db->where("role_id");
		$res = $this->db->get("m_role");
		return $res;
		
		
		
		
	}


	public function deleteRiskHide($username, $division_id, $role_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['username'] = $username;
		$sql = "update m_user set password = 1 where username = ?";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk set risk_treatment_owner = null where risk_division = '".$division_id."' and risk_treatment_owner = '".$username."' and periode_id = (select max(periode_id) from m_periode)";
		$res = $this->db->query($sql);

		$sql = "update t_risk a, t_risk_action_plan b set b.assigned_to = null where a.risk_id = b.risk_id and b.assigned_to = '".$username."' and b.division = '".$division_id."' and a.periode_id = (select max(periode_id) from m_periode)";
		$res = $this->db->query($sql);

		$sql = "update t_action_plan a set a.assigned_to = null where a.assigned_to = '".$username."' and a.division = '".$division_id."'";
		$query = $this->db->query($sql);

		$sql = "update t_kri set kri_pic = null where kri_pic = '".$username."' and kri_owner = '".$division_id."'";
		$query = $this->db->query($sql);

		$sql_cek = "select * from m_user where role_id = 4 and division_id = '".$division_id."' and password != 1 ";
		$res_cek = $this->db->query($sql_cek);

		if($res_cek->num_rows() == 1){
			$sql = "update t_risk set risk_treatment_owner = (select username from m_user where role_id = '4' and division_id = '".$division_id."' and password != 1) where risk_division = '".$division_id."' and periode_id = (select max(periode_id) from m_periode) and risk_treatment_owner is null";
			$res = $this->db->query($sql);

			$sql = "update t_risk a, t_risk_action_plan b set b.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$division_id."' and password != 1) where a.risk_id = b.risk_id and b.division = '".$division_id."' and a.periode_id = (select max(periode_id) from m_periode) and b.assigned_to is null";
			$res = $this->db->query($sql);

			$sql = "update t_action_plan a set a.assigned_to = (select username from m_user where role_id = '4' and division_id = '".$division_id."' and password != 1) where a.division = '".$division_id."' and a.assigned_to is null";
			$query = $this->db->query($sql);

			$sql = "update t_kri set kri_pic = (select username from m_user where role_id = '4' and division_id = '".$division_id."' and password != 1) where kri_owner = '".$division_id."' and kri_pic is null";
			$query = $this->db->query($sql);
		}

		return $res;
	}

	public function deleteUserPermanent($username, $division_id, $role_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['username'] = $username;
		$sql = "delete from m_user where username = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function mblockLogin($username, $division_id, $role_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['username'] = $username;
		$sql = "update m_user set status_login = 1 where username = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function munblockLogin($username, $division_id, $role_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['username'] = $username;
		$sql = "update m_user set status_login = 0 where username = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	function cekStatusLogin($username){

	$sql = "select status_login from m_user_login where username = '".$username."' ";
	$query = $this->db->query($sql);
	$row = $query->row();
	$hasil = $row->status_login;
	return $hasil;
	}


public function getAllUser_export()
	{
	 
		$sql = "select mtable.* from (
				select 
				a.username,
				a.display_name,
				a.email,
				a.role_id,
				a.role_status,
				a.status_login,
				b.role_name,
				a.division_id,
				c.division_name
				from m_user a 
				left join m_role b on a.role_id = b.role_id
				left join m_division c on a.division_id = c.division_id
				where a.role_id <> 1 and password <> 1
				) mtable";
				 
		$query = $this->db->query($sql);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
	}

	public function deleteSelectUserPermanent($rids)
	{
		$ex = '('.implode("),(", $rids).')';
		$sql = "delete from m_user where id in(".$ex.")";
		$res = $this->db->query($sql);
		return $res;
	}

	public function insertDataNewUser($data)
	{
	
		$sql = "insert into m_user
				(username, display_name, role_id, created_by, created_date, role_status)
				values(?, 'new', 3, 'sistem', NOW(), 'NONE')
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}


	    public function getloadAddUserSSO($risk_id) 
    {
        $sql = "select * from m_user where id = ? ";
        $query = $this->db->query($sql, array('divid' => $risk_id));
        $row = $query->row_array();
        
        return $row;
    }

    	public function insertDataUserSSO($user, $cm)
	{
	
		$sql = "insert into m_user_sso
				(username, computer_name, on_login)
				values('$user', '$cm', 0)";
		$res = $this->db->query($sql);
		return $res;
	}

	public function UpdateDataUserSSO($user, $cm, $on, $id)
	{
	
		$sql = "UPDATE `m_user_sso` SET username = '$user', `computer_name` = '$cm', on_login = '$on' WHERE `m_user_sso`.`id` = $id";
		$res = $this->db->query($sql);
		return $res;
	}


	public function deleteSelectUserSSO($rids)
	{
		$ex = '('.implode("),(", $rids).')';
		$sql = "delete from m_user_sso where id in(".$ex.")";
		$res = $this->db->query($sql);
		return $res;
	}

	public function deleteUserSSO($user, $cm, $on, $id) {
		
		$sql = "delete from m_user_sso where id = $id";
		$res = $this->db->query($sql);

		return $res;
	}


}