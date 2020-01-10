<?php
class Mlibrary extends APP_Model {
	 
	
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
	
	public function getAllRisk($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'risk_event';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}

		$date = date("Y-m-d");
		$sql = " select * from (select 
                                                                 a.risk_id,
                                                                                a.risk_code,
                                                                                a.risk_date,
                                                                                a.risk_status,
                                                                                a.periode_id,
                                                                                a.risk_input_by,
                                                                                a.risk_input_division,
                                                                                a.risk_owner,
                                                                                a.risk_division,
                                                                                a.risk_library_id,
                                                                                a.risk_event,
                                                                                a.risk_description,
                                                                                a.risk_category,
                                                                                a.risk_sub_category,
                                                                                a.risk_2nd_sub_category,
                                                                                a.risk_cause,
                                                                                a.risk_impact,
                                                                               
                                                                               
                                                                                a.risk_level,
                                                                                a.risk_impact_level,
                                                                                a.risk_likelihood_key,
                                                                                a.suggested_risk_treatment,
                                                                                a.risk_treatment_owner,

                                                                                a.created_by,
                                                                                a.created_date,
                                                                                a.switch_flag,
                                                                b.ref_value as risk_status_v,
                                                                c.ref_value as risk_level_v,
                                                                d.ref_value as impact_level_v,
                                                                e.l_title as likelihood_v,
                                                                f.division_name as risk_owner_v,
                                                                m3.cat_name AS cat_name1,
                                  								m2.cat_name AS cat_name2,
                                  								m1.cat_name AS cat_name3,
                                  								m3.cat_id AS cat_id1,
                                  								m2.cat_id AS cat_id2,
                                  								m1.cat_id AS cat_id3
                                                                from t_risk a 
                                                                JOIN m_risk_category m1 
                                                				ON a.risk_2nd_sub_category = m1.cat_id 
                                  								JOIN m_risk_category m2 
                                                				ON a.risk_sub_category = m2.cat_id 
                                  								JOIN m_risk_category m3 
                                                				ON a.risk_category = m3.cat_id 
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.risk_status >= 3 and a.existing_control_id is null
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another
                                                                group by another.risk_code





				"
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
		return $res;
	}
	
	public function getAllRisk_export()
	{
	 
		$sql = "
		SELECT
		  t_risk.risk_id,
		  t_risk.risk_code,
		  t_risk.risk_event,
		  t_risk.risk_description,
		  t_risk.risk_cause,
		  t_risk.risk_impact,
		  m3.cat_name AS cat_name1,
		  m2.cat_name AS cat_name2,
		  m1.cat_name AS cat_name3,
		  m3.cat_id AS cat_id1,
		  m2.cat_id AS cat_id2,
		  m1.cat_id AS cat_id3
		  
		FROM
		  t_risk 
		  JOIN m_risk_category m1 
			ON t_risk.risk_2nd_sub_category = m1.cat_id 
		  JOIN m_risk_category m2 
			ON t_risk.risk_sub_category = m2.cat_id 
		  JOIN m_risk_category m3 
			ON t_risk.risk_category = m3.cat_id 
		WHERE t_risk.risk_library_id IS NULL 
				";
				 
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

public function getAllObjective_export()
	{
	 
		$sql = "SELECT b.id, b.objective
				FROM t_risk_objective a 
				JOIN m_objective b ON a.objective = b.objective 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id where c.risk_code is not null and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' GROUP BY b.id ORDER BY b.id ASC";
				 
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

public function getAllObjective_export_pdf()
	{
	 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.objective, 
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_objective a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.objective = a.objective and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code 

				FROM t_risk_objective a 
				JOIN m_objective b ON a.objective = b.objective 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id ORDER BY b.id ASC) as ob_pdf WHERE ob_pdf.risk_code is not null ORDER BY ob_pdf.id";
				 
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
	
	public function getAllRisk_ap($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'action_plan';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		$date = date("Y-m-d");
		$sql ="SELECT * FROM (SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name, f.jml_id,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_action_plan a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.action_plan = a.action_plan and b.division = a.division and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_id ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_action_plan a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.action_plan = a.action_plan and b.division = a.division and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_id

				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id 
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id
                
                JOIN (SELECT b.id as id, count(b.id) as jml_id
				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id  
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) f ON b.id = f.id) as ap

				where ap.risk_id is not null and ap.".$filter_by." like '%".$filter_value."%'" 

			/*"select @r:=@r+1 as id, z.* from(select t_risk_action_plan.action_plan, t_risk_action_plan.due_date, t_risk_action_plan.division,
				t_risk_action_plan.risk_id,t_risk.risk_code
					from t_risk_action_plan
					JOIN t_risk ON t_risk.risk_id = t_risk_action_plan.risk_id 
					group by t_risk_action_plan.division, t_risk_action_plan.action_plan)z, (select @r:=0)y
				"*/
				
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAllRisk_ap_report()
	{
		 
		$sql = "SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name
				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id where c.risk_code is not null and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' GROUP BY b.id ORDER BY b.id ASC
				";
				
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

	public function getAllRisk_ap_report_pdf()
	{
		 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_action_plan a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.action_plan = a.action_plan and b.division = a.division and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code 

				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON a.division = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id order by b.id) as ap_pdf where ap_pdf.risk_code is not null ORDER BY ap_pdf.id ASC
				";
				
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
	
	public function getAllRisk_kri($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		$date = date("Y-m-d");
		$sql = "select t1.id, t1.kri_code, t1.key_risk_indicator, case(t1.mandatory) when 'Y' then 'Already' when 'N' then 'Not Yet' END as mandatory, (select GROUP_CONCAT(t2.operator,' ', t2.value_1, ' = ', t2.result) from t_kri_treshold t2 where t2.kri_id=t1.id) as 'threshold value',t1.risk_id,t_risk.risk_code from t_kri t1 join t_risk on t_risk.risk_id = t1.risk_id 
				"
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAllRisk_kri_report()
	{
		 
		$sql = "select t1.id, t1.kri_code, t1.key_risk_indicator, t1.treshold, (select GROUP_CONCAT(t2.operator,' ', t2.value_1, ' = ', t2.result) from t_kri_treshold t2 where t2.kri_id=t1.id) as 'threshold value' 
from t_kri t1 where kri_library_id is null
				";
				
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
	
	public function getAllRisk_tax($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		 
		$sql = "select cat_id as id,cat_code, cat_name, cat_desc
from m_risk_category
				"
				
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAllRisk_tax_report()
	{
		 
		$sql = "select cat_id as id,cat_code, cat_name, cat_desc
		from m_risk_category
				";
				
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

	public function submission_report()
	{
		 
		$sql = "select * from (select a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id from m_user a join m_division b on a.division_id = b.division_id left join t_risk_add_informasi c on a.username = c.risk_input_by where c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) 
		UNION select a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, null from m_user a join m_division b on a.division_id = b.division_id left join t_risk_add_informasi c on a.username = c.risk_input_by)tes group by tes.display_name
				";
				
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
	
	public function getAllRisk_ec($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'risk_existing_control';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		$date = date("Y-m-d");
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name, f.jml_id,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_control a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.risk_existing_control = a.risk_existing_control and b.risk_evaluation_control = a.risk_evaluation_control and b.risk_control_owner = a.risk_control_owner and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_id ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_control a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.risk_existing_control = a.risk_existing_control and b.risk_evaluation_control = a.risk_evaluation_control and b.risk_control_owner = a.risk_control_owner and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_id 

				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id 

				JOIN (SELECT b.id as id, COUNT(b.id) as jml_id
				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id)f ON b.id = f.id) as ec

				where ec.risk_id is not null and ec.".$filter_by." like '%".$filter_value."%'
				"
				
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAllRisk_ec_report_pdf()
	{ 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_control a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.risk_existing_control = a.risk_existing_control and b.risk_evaluation_control = a.risk_evaluation_control and b.risk_control_owner = a.risk_control_owner and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code 

				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id ORDER BY b.id) as ec_pdf where ec_pdf.risk_code is not null order by ec_pdf.id ASC
				"; 
				
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

	public function getAllRisk_ec_report()
	{ 
		$sql = "SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name

				FROM t_risk_control a 
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.risk_control_owner = e.division_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id where c.risk_code is not null and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P' GROUP BY b.id ORDER BY b.id ASC
				"; 
				
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
	
	public function getAllRisk_objective($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'objective';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		$date = date("Y-m-d");
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.objective, e.jml_id,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_code ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_objective a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.objective = a.objective and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_code,
			    (SELECT DISTINCT GROUP_CONCAT(c.risk_id ORDER BY c.risk_code ASC SEPARATOR ' | ') FROM t_risk_objective a, t_risk c, (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d  where b.objective = a.objective and a.risk_id = c.risk_id and c.risk_code = d.risk_code and c.periode_id = d.periode_id and c.existing_control_id is null and c.risk_status > 2 and c.switch_flag = 'P') as risk_id

				FROM t_risk_objective a 
				JOIN m_objective b ON a.objective = b.objective 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id 

				JOIN(SELECT DISTINCT b.id as id, COUNT(b.id) as jml_id
				FROM t_risk_objective a 
				JOIN m_objective b ON a.objective = b.objective 
				JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id)e ON b.id = e.id) ob where ob.risk_id is not null and ob.".$filter_by." like '%".$filter_value."%'"
		/*
		$sql = "select @r := @r+1 as no, z.* from(
                 select t_risk_objective.id, t_risk_objective.objective, t_risk_objective.risk_id,
				t_risk.risk_code
				from t_risk_objective
				JOIN t_risk ON t_risk.risk_id = t_risk_objective.risk_id
				group by t_risk_objective.objective order by t_risk_objective.id asc)z, (select @r:=0)y"


		$sql = "select t_risk_objective.id, t_risk_objective.objective, t_risk_objective.risk_id,
				t_risk.risk_code
				from t_risk_objective
				JOIN t_risk ON t_risk.risk_id = t_risk_objective.risk_id
				group by t_risk_objective.objective
				"
		*/		
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	public function deleteRisk($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;
		
		$sql1 = "delete  from t_risk where risk_id = ?";
		$sql2 = "delete  from t_risk_change where risk_id = ?";
		$sql3 = "delete  from t_risk_action_plan where risk_id = ?";
		$sql4 = "delete  from  t_risk_action_plan_change where risk_id = ?";
		$sql5 = "delete  from t_risk_add_user where risk_id = ?";
		$sql6 = "delete  from t_risk_control where risk_id = ?";
		$sql7 = "delete  from t_risk_control_change where risk_id = ?";
		$sql8 = "delete  from t_risk_impact where risk_id = ?";
		
		$res = $this->db->query($sql1, $par);
		$res = $this->db->query($sql2, $par);
		$res = $this->db->query($sql3, $par);
		$res = $this->db->query($sql4, $par);
		$res = $this->db->query($sql5, $par);
		$res = $this->db->query($sql6, $par);
		$res = $this->db->query($sql7, $par);
		$res = $this->db->query($sql8, $par);

		return $res;
	}
	
	public function deleteRisk_ap($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;

		$sql = "select action_plan,division from t_risk_action_plan where id = ?";
		$res = $this->db->query($sql, $par);
		$row = $res->row();
		$action_plan = $row->action_plan;
		$division = $row->division;
		
		$sql1 = "delete  from t_risk_action_plan where action_plan = '".$action_plan."' and division= '".$division."' ";
		$sql2 = "delete  from t_risk_action_plan_change where action_plan = '".$action_plan."' and division= '".$division."' "; 
		
		$res = $this->db->query($sql1);
		$res = $this->db->query($sql2); 

		return $res;
	}
	
	public function deleteRisk_kri($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;
		
		$sql1 = "delete from t_kri where id=?";
		$sql2 = "delete from t_kri_treshold where id=?"; 
		
		$res = $this->db->query($sql1, $par);
		$res = $this->db->query($sql2, $par); 

		return $res;
	}
	
	public function deleteRisk_ec($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;
		
		$sql1 = "delete   from t_risk_control where id = ?";
		//$sql2 = "delete   from t_risk_control_change where id = ?"; 
		
		$res = $this->db->query($sql1, $par);
		//$res = $this->db->query($sql2, $par); 

		return $res;
	}

	public function deleteRisk_objective($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;
		
		$sql = "select objective from m_objective where id = ?";
		$res = $this->db->query($sql, $par);
		$row = $res->row();
		$hasil = $row->objective;

		$sql1 = "delete   from t_risk_objective where objective = '".$hasil."'";
		$res = $this->db->query($sql1);

		$sql2 = "delete   from t_risk_objective_change where objective = '".$hasil."'";
		$res = $this->db->query($sql2, $par); 

		$sql3 = "delete   from m_objective where objective = '".$hasil."'";
		$res = $this->db->query($sql3, $par); 

		$sql4 = "ALTER TABLE m_objective AUTO_INCREMENT = 1";
		$res = $this->db->query($sql4); 

		return $res;
	}
	
	public function deleteRisk_tax($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		  
		$par['risk_id'] = $risk_id;
		
		$sql1 = "delete  from m_risk_category where cat_id = ?";
		//$sql2 = "delete   from t_risk_control_change where id = ?"; 
		
		$res = $this->db->query($sql1, $par);
		//$res = $this->db->query($sql2, $par); 

		return $res;
	}
	
	function listrisk_update($data){
	
	$sql = "update `t_risk`
		SET `risk_code`='".$data['risk_id']."',
		`risk_impact`='".$data['risk_impact']."',
		`risk_cause`='".$data['risk_cause']."',
		`risk_event`='".$data['risk_event']."',
		`risk_description`='".$data['risk_description']."',
		`risk_category`='".$data['risk_category']."',
		`risk_sub_category`='".$data['risk_sub_category']."',
		`risk_2nd_sub_category`='".$data['cat_name']."'
		WHERE `risk_code`= '".$data['risk_id']."'";
  
	$res = $this->db->query($sql);
	return $res;
	
	}

	function listmap_update($data){
	 
		$idnya = explode("AP.",$data['id']);
		
		if($data['id'] !=""){
			$sql = " 
			update `m_action_plan`
			SET  `action_plan`='".$data['action_plan']."'	 , `division`='".$data['division']."'
			WHERE `action_plan`='".$data['action_plan_ex']."'	  AND  `division`='".$data['division_ex']."'			 
			";
		}
		else{
			$sql = "insert into m_action_plan(action_plan, division) 
									select * FROM (select '".$data['action_plan']."' ,'".$data['division']."') t1 where NOT EXISTS(select action_plan, division from m_action_plan where action_plan ='".$data['action_plan']."'  and division = '".$data['division']."')
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}
	 
	function listriskap_update($data){
	 
		$idnya = explode("AP.",$data['id']);
		
		if($data['id'] !=""){
			$sql = " 
			update `t_risk_action_plan`
			SET  `action_plan`='".$data['action_plan']."'	 , `division`='".$data['division']."'
			WHERE `action_plan`='".$data['action_plan_ex']."'	  AND  `division`='".$data['division_ex']."'			 
			";
		}
		else{
			$sql = " 
			INSERT INTO `t_risk_action_plan`( `action_plan` ,`division` ) 
			select * FROM (select '".$data['action_plan']."' ,'".$data['division']."') t1 where NOT EXISTS(select action_plan, division from t_risk_action_plan where action_plan ='".$data['action_plan']."'  and division = '".$data['division']."')
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}
	
	function listriskkri_update($data){
	 
			$sql = " 
			UPDATE t_kri
			SET key_risk_indicator='".$data['kri_code']."', treshold='".$data['treshold']."', treshold_type='".$data['treshold_type']."'
			WHERE kri_code= '".$data['kri_code']."'	
			 
			";
		 
		$res = $this->db->query($sql);
		return $res;
	
	}

	function listmec_update($data){
	 
		$idnya = explode("EC.",$data['id']);
		  
		if($data['id'] !=""){
			$sql = " 			 
				UPDATE m_control
				SET risk_existing_control='".$data['risk_existing_control']."', risk_evaluation_control='".$data['risk_evaluation_control']."', risk_control_owner= '".$data['risk_control_owner']."'
				WHERE risk_existing_control ='".$data['risk_existing_control_ex']."' and risk_evaluation_control ='".$data['risk_evaluation_control_ex']."' and risk_control_owner ='".$data['risk_control_owner_ex']."'
			";
		}
		else{
			$sql = " 
							
				INSERT INTO m_control (risk_existing_control,risk_evaluation_control,risk_control_owner) select * FROM (select '".$data['risk_existing_control']."' ,'".$data['risk_evaluation_control']."','".$data['risk_control_owner']."') t1 where NOT EXISTS(select risk_existing_control,risk_evaluation_control,risk_control_owner from m_control WHERE risk_existing_control ='".$data['risk_existing_control']."' and risk_evaluation_control ='".$data['risk_evaluation_control']."' and risk_control_owner ='".$data['risk_control_owner']."')
				 
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}
	
	function listriskec_update($data){
	 
		$idnya = explode("EC.",$data['id']);
		  
		if($data['id'] !=""){
			$sql = " 			 
				UPDATE t_risk_control
				SET risk_existing_control='".$data['risk_existing_control']."', risk_evaluation_control='".$data['risk_evaluation_control']."', risk_control_owner= '".$data['risk_control_owner']."'
				WHERE risk_existing_control ='".$data['risk_existing_control_ex']."' and risk_evaluation_control ='".$data['risk_evaluation_control_ex']."' and risk_control_owner ='".$data['risk_control_owner_ex']."'	
			";
		}
		else{
			$sql = " 
							
				INSERT INTO t_risk_control (risk_existing_control,risk_evaluation_control,risk_control_owner) select * FROM (select '".$data['risk_existing_control']."' ,'".$data['risk_evaluation_control']."','".$data['risk_control_owner']."') t1 where NOT EXISTS(select risk_existing_control,risk_evaluation_control,risk_control_owner from t_risk_control WHERE risk_existing_control ='".$data['risk_existing_control']."' and risk_evaluation_control ='".$data['risk_evaluation_control']."' and risk_control_owner ='".$data['risk_control_owner']."')
				 
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}

	function listmobjective_update($data){
	 
		$idnya = explode("OB.",$data['id']);
		  
		if($data['id'] !=""){
			$sql = " 			 
				UPDATE m_objective
				SET objective='".$data['objective']."'
				WHERE `objective`='".$data['objective_ex']."'	
			";
		}
		else{
			$sql = " 
							
				insert into `m_objective`(objective) select * FROM (select '".$data['objective']."') t1 where NOT EXISTS(select objective from m_objective where objective = '".$data['objective']."')
				 
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}

	function listriskobjective_update($data){
	 
		$idnya = explode("OB.",$data['id']);
		  
		if($data['id'] !=""){
			$sql = " 			 
				UPDATE t_risk_objective
				SET objective='".$data['objective']."'
				WHERE `objective`='".$data['objective_ex']."'	
			";
		}
		else{
			$sql = " 
							
				insert into `t_risk_objective`(objective) select * FROM (select '".$data['objective']."') t1 where NOT EXISTS(select objective from t_risk_objective where objective = '".$data['objective']."')
				 
			";
		}
	  
		$res = $this->db->query($sql);
		return $res;
	
	}
	
	function listrisktax_update($data){
	  
			$sql = " 			 
				 update m_risk_category
				SET cat_code='".$data['cat_code']."', cat_name='".$data['cat_name']."', cat_desc='".$data['cat_desc']."'
				WHERE cat_code='".$data['cat_code']."'
			";
	 
		$res = $this->db->query($sql);
		return $res;
	
	}
	
	function getRiskCategory_bycatname($catname) {
		$sql = 'select 
					cat_parent
				from m_risk_category a 
				where cat_name = "'.$catname.'"';
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	function getDivision() {
		$sql = 'select 
					*
				from m_division ';
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	function getExistingControl() {
		$sql = 'select 
					*
				from m_risk_existing_control ';
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	function get_tresholddetail($data){
	
	$sql = 'SELECT kri_id FROM t_kri_treshold WHERE id = "'.$data['id'].'" ';
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
	
	function delete_tresholddetail($data,$kri_id){
	
	$this->db->where('id',$data['id']);
	$this->db->delete('t_kri_treshold');
	 
	$sql = 'SELECT * FROM t_kri_treshold WHERE kri_id =  "'.$kri_id.'"';
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
	
	function add_treshold($data){
	
		$this->db->insert("t_kri_treshold",$data);
		 $res = "true";
		return $res;
	
	}
	
	function add_treshold2($data){
	
	
		//set value below
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","BELOW");
		$this->db->set("value_1",$data['value-below-1']);
		$this->db->set("value_2",$data['value-below-2']);
		$this->db->set("value_type",$data['value-below-value_type']);
		$this->db->set("result",$data['value-below-result']);
		$this->db->insert("t_kri_treshold");
		
		//set value between
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","BETWEEN");
		$this->db->set("value_1",$data['value-between-1']);
		$this->db->set("value_2",$data['value-between-2']);
		$this->db->set("value_type",$data['value-between-value_type']);
		$this->db->set("result",$data['value-between-result']);
		$this->db->insert("t_kri_treshold");
		
		//set value above
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","ABOVE");
		$this->db->set("value_1",$data['value-above-1']);
		$this->db->set("value_2",$data['value-above-2']);
		$this->db->set("value_type",$data['value-above-value_type']);
		$this->db->set("result",$data['value-above-result']);
		$this->db->insert("t_kri_treshold");
		
		if(isset($data['is_percentage_treshold'])){
		//perc value below
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","BELOW");
		$this->db->set("value_1",$data['perc-below-1']);
		$this->db->set("value_2",$data['perc-below-2']);
		$this->db->set("value_type",$data['perc-below-value_type']);
		$this->db->set("result",$data['perc-below-result']);
		$this->db->insert("t_kri_treshold");
		
		//perc value between
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","BETWEEN");
		$this->db->set("value_1",$data['perc-between-1']);
		$this->db->set("value_2",$data['perc-between-2']);
		$this->db->set("value_type",$data['perc-between-value_type']);
		$this->db->set("result",$data['perc-between-result']);
		$this->db->insert("t_kri_treshold");
		
		//perc value above
		$this->db->set("kri_id",$data['kri_id']);
		$this->db->set("operator","ABOVE");
		$this->db->set("value_1",$data['perc-above-1']);
		$this->db->set("value_2",$data['perc-above-2']);
		$this->db->set("value_type",$data['perc-above-value_type']);
		$this->db->set("result",$data['perc-above-result']);
		$this->db->insert("t_kri_treshold");
		}
		
		$res = "true";
		return $res;
	
	}
	
	function yap_tresholddetail($kri_id){
	 
	$sql = 'SELECT * FROM t_kri_treshold WHERE kri_id =  "'.$kri_id.'"';
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

	function get_properties($risk_code){
		$sql = "select risk_id from t_risk where risk_code = '".$risk_code."'";
		$run_sql = $this->db->query($sql)->row();
		$risk_id = $run_sql->risk_id;


		$sql2 = "select a.*,  date_format(a.date_changed, '%d-%m-%Y') as date_changed_v from t_risk_properties a
				where a.risk_id IN (select risk_id from t_risk where risk_code = (select risk_code from t_risk where risk_id = '".$risk_id."'))";
		$run_sql2 = $this->db->query($sql2)->result_array(); 
		return $run_sql2;
	}
	
	function get_all_username(){
		$sql2 = "select * from m_user order by username ";
		$run_sql2 = $this->db->query($sql2)->result_array(); 
		return $run_sql2;
	}

	function get_all_username_edit($username){
		$sql2 = "select * from m_user  where username != '$username' order by username ";
		$run_sql2 = $this->db->query($sql2)->result_array(); 
		return $run_sql2;
	}

	function update_properties($data){
		$username_asli = $data['username_asli'];
		$date_asli = $data['date_asli'];
		$username = $data['username'];
		$date_change = date("Y-m-d", strtotime($data['date_change']));



		$sql2 = "update t_risk_add_user set username = '$username', date_changed = '$date_change' where username = '$username_asli' and date_changed = '$date_asli' ";
		$run_sql2 = $this->db->query($sql2); 
		return true;
	}

	function delete_properties($risk_id,$username){
		$sql2 = "delete from t_risk_add_user where risk_id = '$risk_id' and username = '$username' ";
		$run_sql2 = $this->db->query($sql2); 
		return true;
	}
	 
}
