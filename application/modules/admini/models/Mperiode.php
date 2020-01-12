<?php
class Mperiode extends APP_Model {
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
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode a "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
	}

	public function getDataKri($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode_kri a "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
	}
	
	public function getAll()
	{
		$sql = "select 
				a.*,
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode a order by a.periode_year, a.periode_start";
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
				a.*,
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode a where a.periode_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function validatePeriode($periode_start, $periode_end) {
		/* TODO : Validation for insert and update */
		$resp_arr = array('status' => true, 'msg' => null);
		$dints = str_replace('-', '', $periode_start) * 1;
		$dinte = str_replace('-', '', $periode_end) * 1;
		
		if ($dints > $dinte) {
			$resp_arr['status'] = false;
			$resp_arr['msg'] = 'End Date must be after Start Date';
		}
		return $resp_arr;
	}
	
	public function validatePeriodeDelete($periode_start, $periode_end) {
		/* TODO : Validation for delete */
		$resp_arr = array('status' => true, 'msg' => null);
		return $resp_arr;
	}
	
	public function insertData($data)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$sql = "insert into m_periode
				(periode_name, periode_start, periode_end, created_by, created_date)
				values(?, ?, ?, ?, NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function insertDataKri($data)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$sql = "insert into m_periode_kri
				(periode_name, periode_start, periode_end, created_by, created_date)
				values(?, ?, ?, ?, NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function updateData($data_id, $data, $uid)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$this->_logHistory($data_id, $uid, 'U');
		
		$sql = "update m_periode
				set periode_name = ?, periode_start = ?, periode_end = ?,
					created_by = ?, 
					created_date = NOW()
				where periode_id = ?
				";
		$par = $data;
		$par['user_id'] = $uid;
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function updateDataKri($data_id, $data, $uid)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$this->_logHistory($data_id, $uid, 'U');
		
		$sql = "update m_periode_kri
				set periode_name = ?, periode_start = ?, periode_end = ?,
					created_by = ?, 
					created_date = NOW()
				where periode_id = ?
				";
		$par = $data;
		$par['user_id'] = $uid;
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function deleteData($data_id, $uid)
	{
		// if year month start is <= current month
		
		$this->_logHistory($data_id, $uid, 'D');
		
		$sql = "delete from m_periode
				where periode_id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function deleteDataKri($data_id, $uid)
	{
		// if year month start is <= current month
		
		$this->_logHistory($data_id, $uid, 'D');
		
		$sql = "delete from m_periode_kri
				where periode_id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	private function _logHistory($data_id, $uid, $mode) {
		$sql = "insert into m_periode_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from m_periode a
				where a.periode_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	public function getCurrentPeriode() 
	{
		$sql = "select * from m_periode where DATE(NOW()) between periode_start and periode_end";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	
	public function getMaxPeriode() 
	{
		$sql = "select max(periode_id) as periode_id from m_periode";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	public function getCurrentPeriodeKri() 
	{
		$sql = "select * from m_periode_kri where DATE(NOW()) between periode_start and periode_end";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	
	//periode AP Exec
	public function getCurrentPeriode_exec() 
	{
		$sql = "select * from m_periode_plan where DATE(NOW()) between periode_start and periode_end";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
	// ACTION PLAN PERIODE
	public function getDataPlan($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode_plan a "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
	}
	
	public function getAllPlan()
	{
		$sql = "select 
				a.*,
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode_plan a order by a.periode_year, a.periode_start";
		$query = $this->db->query($sql);
		
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getDataByIdPlan($id)
	{
		$sql = "select 
				a.*,
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode_plan a where a.periode_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function validatePeriodePlan($periode_start, $periode_end) {
		/* TODO : Validation for insert and update */
		$resp_arr = array('status' => true, 'msg' => null);
		$dints = str_replace('-', '', $periode_start) * 1;
		$dinte = str_replace('-', '', $periode_end) * 1;
		
		if ($dints > $dinte) {
			$resp_arr['status'] = false;
			$resp_arr['msg'] = 'End Date must be after Start Date';
		}
		return $resp_arr;
	}
	
	public function validatePeriodeDeletePlan($periode_start, $periode_end) {
		/* TODO : Validation for delete */
		$resp_arr = array('status' => true, 'msg' => null);
		return $resp_arr;
	}
	
	public function insertDataPlan($data)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$sql = "insert into m_periode_plan
				(periode_name, periode_start, periode_end, created_by, created_date)
				values(?, ?, ?, ?, NOW())
				";
		$par = $data;
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function updateDataPlan($data_id, $data, $uid)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$this->_logHistoryPlan($data_id, $uid, 'U');
		
		$sql = "update m_periode_plan
				set periode_name = ?, periode_start = ?, periode_end = ?,
					created_by = ?, 
					created_date = NOW()
				where periode_id = ?
				";
		$par = $data;
		$par['user_id'] = $uid;
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function deleteDataPlan($data_id, $uid)
	{
		// if year month start is <= current month
		
		$this->_logHistoryPlan($data_id, $uid, 'D');
		
		$sql = "delete from m_periode_plan
				where periode_id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	private function _logHistoryPlan($data_id, $uid, $mode) {
		$sql = "insert into m_periode_plan_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from m_periode_plan a
				where a.periode_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	public function getCurrentPlanPeriode() 
	{
		$sql = "select * from m_periode_plan where DATE(NOW()) between periode_start and periode_end";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	//report

	public function validatePeriodeReport($periode_start, $periode_end) {
		/* TODO : Validation for insert and update */
		$resp_arr = array('status' => true, 'msg' => null);
		$dints = str_replace('-', '', $periode_start) * 1;
		$dinte = str_replace('-', '', $periode_end) * 1;
		
		if ($dints > $dinte) {
			$resp_arr['status'] = false;
			$resp_arr['msg'] = 'End Date must be after Start Date';
		}
		return $resp_arr;
	}

	public function insertDataReport($data)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$sql = "insert into m_periode_report
				(periode_name, periode_start, periode_end)
				values(?, ?, ?)
				";
		$par = $data;
		$res = $this->db->query($sql, $par);

		
$query2 = $this->db->query("select periode_id from m_periode_report where periode_name = '".$data['periode_name']."' ");
$row2 = $query2->row(); 

$query = $this->db->query("select risk_id from t_risk where cast(risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and risk_status >2 ");
if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   	$sql = "insert into t_report_risk(periode_id, risk_id)
			values('".$row2->periode_id."' ,'".$row->risk_id."' )";
		$res = $this->db->query($sql);


   }
} 

$query3 = $this->db->query("select distinct t1.risk_2nd_sub_category, t2.cat_code, t2.cat_name,
(
CASE WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) is null THEN null

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '0,2500' AND '1,2400' THEN 'Insignificant' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '1,2500' AND '2,2400' THEN 'Minor' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '2,2500' AND '3,2400' THEN 'Moderate' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '3,2500' AND '4,2400' THEN 'Moderate'
ELSE  'Catastrophic'
END) as impact_level,




(CASE WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
)is null THEN null

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '0,2500' AND '1,2400' THEN 'Very Low'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '1,2500' AND '2,2400' THEN 'Low'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '2,2500' AND '3,2400' THEN 'Medium'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '3,2500' AND '4,2400' THEN 'High'
ELSE 'Very High'
END) as likelihood_level,


(
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) as impact_score
,
(
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) as likelihood_score
			from t_risk t1 join t_report_risk z1 on t1.risk_id = z1.risk_id
			join m_risk_category t2 on t1.risk_2nd_sub_category = t2.cat_id");


if ($query3->num_rows() > 0)
{
   foreach ($query3->result() as $row3)
   {
   	$sql3 = "insert into t_report_2ndsub(periode_id, cat_id, cat_code, cat_name, impact_level, likelihood_level, risk_level, impact_score, likelihood_score)
			values('".$row2->periode_id."', '".$row3->risk_2nd_sub_category."', '".$row3->cat_code."', '".$row3->cat_name."', '".$row3->impact_level."' , '".$row3->likelihood_level."',
			(select m1.risk_level from m_risklevel_matrix m1 where m1.impact_value = '".$row3->impact_level."' and m1.likelihood_key = '".$row3->likelihood_level."'), '".$row3->impact_score."', '".$row3->likelihood_score."'
			)";
		$res = $this->db->query($sql3);

   }
} 
		return $res;
	}

	// ACTION PLAN PERIODE
	public function getDataReport($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
				date_format(a.periode_start, '%d-%m-%Y') as periode_start_v,
				date_format(a.periode_end, '%d-%m-%Y') as periode_end_v
				from m_periode_report a "
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
	}

	// ACTION PLAN PERIODE
	public function getDataReportList($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null, $id)
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
		
		$sql = "select * from t_risk  where risk_id IN (select risk_id from t_report_risk where periode_id = '$id') ";
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
		
	}

	// ACTION PLAN PERIODE
	public function getDataReportListExclude($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null, $id)
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
		
		$sql = "select * from t_risk  where risk_id IN (select risk_id from t_report_risk where periode_id = '$id') and risk_evaluation_control is not null or risk_evaluation_control != '' ";
		$res = $this->getPagingData($sql, $par, $page, $row, 'periode_id', true);
		return $res;
		
	}

	public function updateDataReport($data_id, $data, $uid)
	{
		// if year month start is >= next month
		// if year month periode is overlapping with existing data
		
		$this->_logHistoryPlan($data_id, $uid, 'U');
		
		$sql = "update m_periode_report
				set periode_name = ?, periode_start = ?, periode_end = ?
					
				where periode_id = ?
				";
		$par = $data;
		
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);


		//batas tambahan untuk refresh

$query2 = $this->db->query("select periode_id from m_periode_report where periode_name = '".$data['periode_name']."' ");
$row2 = $query2->row(); 

$query = $this->db->query("select risk_id from t_risk where cast(risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."'and risk_status > 2 ");
if ($query->num_rows() > 0)
{
	$sql = "delete from t_report_risk where periode_id = '".$data_id."' ";
	$res = $this->db->query($sql);
   
   foreach ($query->result() as $row)
   {
   	$sql = "insert into t_report_risk(periode_id, risk_id)
			values('".$row2->periode_id."' ,'".$row->risk_id."' )";
		$res = $this->db->query($sql);
   }
} 

$query3 = $this->db->query("select distinct t1.risk_2nd_sub_category, t2.cat_code, t2.cat_name,
(
CASE WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) is null THEN null

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '0,2500' AND '1,2400' THEN 'Insignificant' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '1,2500' AND '2,2400' THEN 'Minor' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '2,2500' AND '3,2400' THEN 'Moderate' 

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '3,2500' AND '4,2400' THEN 'Moderate'
ELSE  'Catastrophic'
END) as impact_level,




(CASE WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
)is null THEN null

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '0,2500' AND '1,2400' THEN 'Very Low'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '1,2500' AND '2,2400' THEN 'Low'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '2,2500' AND '3,2400' THEN 'Medium'

WHEN
((CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) BETWEEN '3,2500' AND '4,2400' THEN 'High'
ELSE 'Very High'
END) as likelihood_level,


(
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Insignificant' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Minor' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Moderate' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Major' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_impact_level ='Catastrophic' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) as impact_score
,
(
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 12 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*1
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 12
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-12)*2+12)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 10 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*2
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 10
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-10)*3+20)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 8 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*3
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 8
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-8)*4+24)END)
+
(CASE WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) <= 5 
THEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*4
WHEN (select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) > 5
THEN (((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)-5)*5+20)END)
+
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)*5))
/
((select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Low' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='medium' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) +
(select count(t3.risk_id) from t_risk t3 where t3.risk_likelihood_key ='Very High' and cast(t3.risk_date as date) between '".$data['periode_start']."' and '".$data['periode_end']."' and t3.risk_status > 2 and t3.risk_2nd_sub_category = t1.risk_2nd_sub_category)
) as likelihood_score
			from t_risk t1 join t_report_risk z1 on t1.risk_id = z1.risk_id
			join m_risk_category t2 on t1.risk_2nd_sub_category = t2.cat_id");


if ($query3->num_rows() > 0)
{
	$sql = "delete from t_report_2ndsub where periode_id = '".$data_id."' ";
	$res = $this->db->query($sql);

   foreach ($query3->result() as $row3)
   {
   	
   	$sql3 = "insert into t_report_2ndsub(periode_id, cat_id, cat_code, cat_name, impact_level, likelihood_level, risk_level, impact_score, likelihood_score)
			values('".$row2->periode_id."', '".$row3->risk_2nd_sub_category."', '".$row3->cat_code."', '".$row3->cat_name."', '".$row3->impact_level."' , '".$row3->likelihood_level."',
			(select m1.risk_level from m_risklevel_matrix m1 where m1.impact_value = '".$row3->impact_level."' and m1.likelihood_key = '".$row3->likelihood_level."'), '".$row3->impact_score."', '".$row3->likelihood_score."'
			)";
		$res = $this->db->query($sql3);

   }
} 
//ending refresh

		return $res;
	}

	public function validatePeriodeDeleteReport($periode_start, $periode_end) {
		/* TODO : Validation for delete */
		$resp_arr = array('status' => true, 'msg' => null);
		return $resp_arr;
	}

	public function deleteDataReport($data_id, $uid)
	{
		// if year month start is <= current month
		
		$this->_logHistoryPlan($data_id, $uid, 'D');
		
		$sql = "delete from m_periode_report
				where periode_id = ?
				";
		$par['data_id'] = $data_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function deleteDataReportList($data_id, $uid, $risk_id)
	{
		// if year month start is <= current month
		
		$this->_logHistoryPlan($data_id, $uid, 'D');
		
		$sql = "update t_risk set risk_evaluation_control = 'delete_from_report'
				where risk_id = ?
				";
		$par['data_id'] = $risk_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function deleteDataReportListExclude($data_id, $uid, $risk_id)
	{
		// if year month start is <= current month
		
		$this->_logHistoryPlan($data_id, $uid, 'D');
		
		$sql = "update t_risk set risk_evaluation_control = NULL
				where risk_id = ?
				";
		$par['data_id'] = $risk_id;
		
		$res = $this->db->query($sql, $par);
		return $res;
	}

	public function userRollover_recover_periode(){
			$date = date("Y-m-d");
			$sql = "select 
                                                                                a.created_by,
                                                                                a.created_date,
                                                                                a.existing_control_id,
                                                                                a.periode_id,
                                                                                a.risk_2nd_sub_category,
                                                                                a.risk_category,
                                                                                a.risk_cause,
                                                                                a.risk_code,
                                                                                a.risk_control_owner,
                                                                                a.risk_date,
                                                                                a.risk_description,
                                                                                a.risk_division,
                                                                                a.risk_evaluation_control,
                                                                                a.risk_event,
                                                                                a.risk_existing_control,
                                                                                a.risk_id,
                                                                                a.risk_impact,
                                                                                a.risk_impact_level,
                                                                                y.username,
                                                                                a.risk_input_division,
                                                                                a.risk_level,
                                                                                a.risk_library_id,
                                                                                a.risk_likelihood_key,
                                                                                a.risk_owner,
                                                                                a.risk_sub_category,
                                                                                a.risk_treatment_owner,
                                                                                a.suggested_risk_treatment,
                                                                                a.switch_flag,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                m_periode.periode_end,
                                                                                f.division_name as risk_owner_v,
                                                                                IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
                                                                                from t_risk_add_user y

                                                                                join t_risk a on y.risk_id = a.risk_id
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                join m_periode on m_periode.periode_id = a.periode_id
                                                                                where 

                                                                                 y.delete_status = 1";

        $query = $this->db->query($sql);
		if ($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return FALSE;
			}	
	}

}