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
                                                                INNER JOIN (SELECT b.risk_code, MAX(b.periode_id) as periode_id from t_risk b where b.switch_flag  = 'P' and b.risk_status > 2 GROUP BY b.risk_code) bb ON a.risk_code = bb.risk_code AND a.periode_id = bb.periode_id
                                                                where a.existing_control_id is null
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id
                                                                
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

		$sql = "SET SESSION group_concat_max_len = 1000000";
		$res = $this->db->query($sql);

		$sql ="SELECT * FROM (SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name, b.due_date, DATE_FORMAT(b.due_date, '%d-%m-%Y') as due_date_v, CASE WHEN b.`due_date`= '00-00-0000' THEN 'Continuous' WHEN b.`due_date`= '0000-00-00' THEN 'Continuous'  ELSE DATE_FORMAT(b.due_date, '%d-%m-%Y') END AS due_date_x, a.periode_id AS periode_idx,

			    (SELECT DISTINCT GROUP_CONCAT(concat('<a href=index.php/main/viewRisk/',a.risk_id,'>',a.risk_code,'</a>') ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) a where a.ap_code = b.id AND a.division = b.division ) as risk_code,

			     (SELECT DISTINCT GROUP_CONCAT(concat('<table><tr><td>',periode_name,'</td</tr></table>') ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id, MAX(g.periode_name) AS periode_name FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` JOIN m_periode g ON a.periode_id = g.periode_id WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) a where a.ap_code = b.id AND a.division = b.division ) as periode_id, b.status

				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.ap_code = b.id 
				LEFT JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.division = e.division_id 
				JOIN (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id
				WHERE b.".$filter_by." like '%".$filter_value."%'
				) as ap GROUP BY ap.id asc" 

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
		 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.action_plan, b.division, e.division_name, b.due_date, DATE_FORMAT(b.due_date, '%d-%m-%Y') as due_date_v, CASE WHEN b.`due_date`= '00-00-0000' THEN 'Continuous' WHEN b.`due_date`= '0000-00-00' THEN 'Continuous'  ELSE DATE_FORMAT(b.due_date, '%d-%m-%Y') END AS due_date_x, a.periode_id AS periode_idx,

			    (SELECT DISTINCT GROUP_CONCAT(concat(a.risk_code) ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) a where a.ap_code = b.id AND a.division = b.division ) as risk_code,

			     (SELECT DISTINCT GROUP_CONCAT(concat(periode_name) ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id, MAX(g.periode_name) AS periode_name FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` JOIN m_periode g ON a.periode_id = g.periode_id WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) a where a.ap_code = b.id AND a.division = b.division ) as periode_id, b.status

				FROM t_risk_action_plan a 
				JOIN m_action_plan b ON a.ap_code = b.id 
				LEFT JOIN t_risk c ON a.risk_id = c.risk_id
				LEFT JOIN m_division e ON a.division = e.division_id 
				JOIN (SELECT a.`ap_code`, a.`action_plan`, a.`division`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_action_plan a JOIN m_action_plan b ON a.`ap_code` = b.id AND a.`division` = b.`division` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ap_code, c.risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id) as ap GROUP BY ap.id asc
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

	public function getAllRisk_kriregular_report()
	{
		 
		$sql = "SELECT t1.id, t1.kri_status, t1.kri_code, t1.key_risk_indicator, CASE(t1.mandatory) WHEN 'Y' THEN 'Mandatory' WHEN 'N' THEN 'Non Mandatory' END AS mandatory, (SELECT GROUP_CONCAT(t2.operator,' ', t2.value_1, ' = ', t2.result) FROM t_kri_treshold t2 WHERE t2.kri_id=t1.id) AS 'threshold value', t1.risk_id, t_risk.risk_code,
			t_risk.risk_event, t_risk.risk_level, t_risk.suggested_risk_treatment, m_division.division_name, DATE_FORMAT(t1.timing_pelaporan, '%d-%m-%Y') AS 'timing_pelaporan_v', 
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan`SEPARATOR ' | ') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			t1.owner_report, t1.supporting_evidence, t1.kri_warning, t1.validation, t_risk.risk_level, t_risk.risk_impact_level, t_risk.risk_likelihood_key,
			t_risk.risk_level_after_kri, t_risk.risk_impact_level_after_kri, t_risk.risk_likelihood_key_after_kri 
				FROM t_kri t1 
				JOIN t_risk ON t_risk.risk_id = t1.risk_id
				LEFT JOIN m_division ON t1.kri_owner = m_division.division_id WHERE t1.periode_id = (SELECT MAX(periode_id) FROM m_periode) 
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

	public function getAllRisk_kriprior_report()
	{
		 
		$sql = "SELECT t1.id, t1.kri_code, t1.kri_status, t1.key_risk_indicator, CASE(t1.mandatory) WHEN 'Y' THEN 'Mandatory' WHEN 'N' THEN 'Non Mandatory' END AS mandatory, (SELECT GROUP_CONCAT(t2.operator,' ', t2.value_1, ' = ', t2.result) FROM t_kri_treshold t2 WHERE t2.kri_id=t1.id) AS 'threshold value',t1.risk_id,t_risk.risk_code, 
			t_risk.risk_event, t_risk.risk_level, t_risk.suggested_risk_treatment, m_division.division_name, DATE_FORMAT(t1.timing_pelaporan, '%d-%m-%Y') AS 'timing_pelaporan_v', 
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan`SEPARATOR ' | ') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			t1.owner_report, t1.supporting_evidence, t1.kri_warning, t1.validation, t_risk.risk_level, t_risk.risk_impact_level, t_risk.risk_likelihood_key,
			t_risk.risk_level_after_kri, t_risk.risk_impact_level_after_kri, t_risk.risk_likelihood_key_after_kri 
				FROM t_kri t1 
				JOIN t_risk ON t_risk.risk_id = t1.risk_id
				LEFT JOIN m_division ON t1.kri_owner = m_division.division_id WHERE t1.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) 
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

	public function submission_report($id_period)
	{
		 
		$sql = "SELECT * FROM (SELECT a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id, CASE WHEN (c.tanggal_submit <= (select due_date from mail_history_regular where periode_id = '".$id_period."' and id_mail_type = 1)) THEN 'before' WHEN(c.tanggal_submit IS NULL) THEN 'draft' ELSE 'past' END AS status_date,
		CASE WHEN (c.tanggal_submit <= d.due_date) THEN 'On due date' WHEN(c.tanggal_submit IS NULL) THEN 'Not confirmed yet' ELSE 'Exit due date' END AS status_date_v, date_format(c.tanggal_submit, '%d/%m/%Y') as due_date_v FROM m_user a 
        JOIN m_division b ON a.division_id = b.division_id 
                LEFT JOIN t_risk_add_informasi c ON a.username = c.risk_input_by 
                JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'regular risk') d
               WHERE c.periode_id ='".$id_period."'
		UNION 
		SELECT a.username, a.display_name, b.division_id, b.division_name, NULL, NULL, 'draft' AS status_date, 'Not confirmed yet' AS status_date_v, NULL FROM m_user a 
               JOIN m_division b ON a.division_id = b.division_id 
               LEFT JOIN t_risk_add_informasi c ON a.username = c.risk_input_by
              JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'regular risk') d)tes GROUP BY tes.username";
				
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

	public function submission_riskown_report($id_period)
	{
		 
		$sql = "SELECT * FROM (SELECT a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id, CASE WHEN (c.tanggal_submit <= (select due_date from mail_history_regular where periode_id = '".$id_period."' and id_mail_type = 2)) THEN 'before' WHEN(c.tanggal_submit IS NULL) THEN 'draft' ELSE 'past' END AS status_date,
		CASE WHEN (c.tanggal_submit <= d.due_date) THEN 'On due date' WHEN(c.tanggal_submit IS NULL) THEN 'Not confirmed yet' ELSE 'Exit due date' END AS status_date_v, DATE_FORMAT(c.tanggal_submit, '%d/%m/%Y') AS due_date_v FROM m_user a 
        JOIN m_division b ON a.division_id = b.division_id 
                LEFT JOIN t_risk_add_owner c ON a.username = c.risk_input_by 
                JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'risk owner') d
               WHERE c.periode_id ='".$id_period."' AND c.type = 'risk owner' AND (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)')
		UNION 
		SELECT a.username, a.display_name, b.division_id, b.division_name, NULL, NULL, 'draft' AS status_date, 'Not confirmed yet' AS status_date_v, NULL FROM m_user a 
               JOIN m_division b ON a.division_id = b.division_id 
               LEFT JOIN t_risk_add_owner c ON a.username = c.risk_input_by
              JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'risk owner') d
               WHERE (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)'))tes GROUP BY tes.username";
				
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

	public function submission_actionplan_report($id_period)
	{
		 
		$sql = "SELECT * FROM (SELECT a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id, CASE WHEN (c.tanggal_submit <= (select due_date from mail_history_regular where periode_id = '".$id_period."' and id_mail_type = 3)) THEN 'before' WHEN(c.tanggal_submit IS NULL) THEN 'draft' ELSE 'past' END AS status_date,
		CASE WHEN (c.tanggal_submit <= d.due_date) THEN 'On due date' WHEN(c.tanggal_submit IS NULL) THEN 'Not confirmed yet' ELSE 'Exit due date' END AS status_date_v, DATE_FORMAT(c.tanggal_submit, '%d/%m/%Y') AS due_date_v FROM m_user a 
        JOIN m_division b ON a.division_id = b.division_id 
                LEFT JOIN t_risk_add_owner c ON a.username = c.risk_input_by 
                JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'action plan') d
               WHERE c.periode_id ='".$id_period."' AND c.type = 'action plan' AND (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)')
		UNION 
		SELECT a.username, a.display_name, b.division_id, b.division_name, NULL, NULL, 'draft' AS status_date, 'Not confirmed yet' AS status_date_v, NULL FROM m_user a 
               JOIN m_division b ON a.division_id = b.division_id 
               LEFT JOIN t_risk_add_owner c ON a.username = c.risk_input_by
              JOIN (SELECT due_date FROM mail_regular_risk WHERE mail_type = 'action plan') d
               WHERE (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)'))tes GROUP BY tes.username";
				
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

	public function submission_actionplanexe_report($id)
	{
		 
		$sql = "SELECT * FROM (SELECT a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id, CASE WHEN (c.tanggal_submit <= d.due_date) THEN 'before' WHEN(c.tanggal_submit IS NULL) THEN 'draft'  ELSE 'past' END AS status_date,
CASE WHEN (c.tanggal_submit <= d.due_date) THEN 'On due date' WHEN(c.tanggal_submit IS NULL) THEN 'Not confirmed yet' ELSE 'Exit due date' END AS status_date_v, DATE_FORMAT(c.tanggal_submit, '%d/%m/%Y') AS due_date_v, c.id_apex FROM m_user a JOIN m_division b ON a.division_id = b.division_id 
               LEFT JOIN t_risk_add_owner_apex c ON a.username = c.risk_input_by
               JOIN mail_ap_execution d ON c.periode_id = d.periode_id
               WHERE c.id_apex = '".$id."' AND (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)')
    UNION SELECT a.username, a.display_name, b.division_id, b.division_name, NULL, NULL, 'draft' AS status_date, 'Not confirmed yet' AS status_date_v, NULL, c.id_apex FROM m_user a 
               JOIN m_division b ON a.division_id = b.division_id 
               LEFT JOIN t_risk_add_owner_apex c ON a.username = c.risk_input_by
               JOIN (SELECT * FROM mail_ap_execution) d ON d.mail_type = 'action plan execution' WHERE (a.role_id = '4' OR a.role_status = 'HR (Head Division - RAC)'))tes GROUP BY tes.username
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

		$sql = "SET SESSION group_concat_max_len = 1000000";
		$res = $this->db->query($sql);

		$date = date("Y-m-d");
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name,

			    (SELECT DISTINCT GROUP_CONCAT(concat('<a href=index.php/main/viewRisk/',a.risk_id,'>',a.risk_code,'</a>') ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ec_code`, a.`risk_existing_control`, a.`risk_control_owner`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id , MAX(g.`periode_name`) AS periode_name FROM t_risk_control a JOIN m_control b ON a.`ec_code` = b.id AND a.`risk_control_owner` = b.`risk_control_owner` JOIN t_risk c ON a.`risk_id` = c.`risk_id` JOIN m_periode g ON a.periode_id = g.periode_id WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ec_code, c.risk_code) a where a.ec_code = b.id AND a.risk_control_owner = b.risk_control_owner ) risk_code,

			    (SELECT DISTINCT GROUP_CONCAT(concat(periode_name) ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ec_code`, a.`risk_existing_control`, a.`risk_control_owner`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id, MAX(g.`periode_name`) AS periode_name FROM t_risk_control a JOIN m_control b ON a.`ec_code` = b.id AND a.`risk_control_owner` = b.`risk_control_owner` JOIN t_risk c ON a.`risk_id` = c.`risk_id` JOIN m_periode g ON a.periode_id = g.periode_id WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ec_code, c.risk_code) a where a.ec_code = b.id AND a.risk_control_owner = b.risk_control_owner ) periode_id, b.status

				FROM t_risk_control a 
				LEFT JOIN m_control b ON a.ec_code = b.id 
				LEFT JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN m_division e ON b.risk_control_owner = e.division_id
				JOIN (SELECT a.`ec_code`, a.`risk_existing_control`, a.`risk_control_owner`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_control a JOIN m_control b ON a.`ec_code` = b.id AND a.`risk_control_owner` = b.`risk_control_owner` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ec_code, c.risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id 
				) ec where ec.".$filter_by." like '%".$filter_value."%' GROUP BY ec.id ASC 
				"
				
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}
	
	public function getAllRisk_ec_report()
	{ 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.risk_existing_control, b.risk_evaluation_control, b.risk_control_owner, e.division_name,
			    (SELECT DISTINCT GROUP_CONCAT(a.risk_code ORDER BY a.risk_code ASC SEPARATOR ' | ') FROM (SELECT a.`ec_code`, a.`risk_existing_control`, a.`risk_control_owner`, c.risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_control a JOIN m_control b ON a.`ec_code` = b.id AND a.`risk_control_owner` = b.`risk_control_owner` JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ec_code, c.risk_code) a where a.ec_code = b.id AND a.risk_control_owner = b.risk_control_owner ) risk_code

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

	public function getActionapex_regular_report()
	{ 
		$sql = "SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, 
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,
					
					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code,

          (SELECT GROUP_CONCAT(f.division_name SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_owner_v,

           (SELECT GROUP_CONCAT(f.division_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_owner,  

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT CASE WHEN DATE_FORMAT(b.due_date, '%d-%m-%Y') = '00-00-0000' THEN 'Continuous' WHEN DATE_FORMAT(b.due_date, '%d-%m-%Y') = '0000-00-00' THEN 'Continuous' ELSE DATE_FORMAT(b.due_date, '%d-%m-%Y') END SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v
					FROM 
					t_risk_action_plan a
					LEFT JOIN t_risk b ON a.risk_id = b.risk_id
					LEFT JOIN m_user c ON a.assigned_to = c.username
					LEFT JOIN m_division d ON a.division = d.division_id
					LEFT JOIN m_periode ON m_periode.periode_id = b.periode_id
					JOIN m_action_plan f ON a.action_plan = f.action_plan AND a.division = f.division

						JOIN (SELECT b.id AS id, COUNT(b.id) AS jml_id
						FROM t_risk_action_plan a 
						JOIN m_action_plan b ON a.action_plan = b.action_plan AND a.division = b.division 
						JOIN t_risk c ON a.risk_id = c.risk_id
						JOIN m_division e ON a.division = e.division_id  
						JOIN (SELECT risk_code, periode_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					WHERE 
					b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND
					a.action_plan_status > 3 AND b.switch_flag = 'P'
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

	public function getActionapex_prior_report()
	{ 
		$sql = "SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, a.periode_id, a.existing_control_id,
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,

					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code,

					(SELECT GROUP_CONCAT(c.risk_event SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_event,

					(SELECT GROUP_CONCAT(c.risk_description SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_description, 

          (SELECT GROUP_CONCAT(f.division_name SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_owner_v,

           (SELECT GROUP_CONCAT(f.division_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id) AS risk_owner,

             (SELECT GROUP_CONCAT(i.ref_value SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f, m_reference i ,m_reference j, m_likelihood k  
                                                                WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id AND c.risk_level_after_mitigation  = i.ref_key AND i.ref_context = 'risklevel.display' AND c.risk_impact_level_after_mitigation  = j.ref_key AND j.ref_context = 'impact.display' AND c.risk_likelihood_key_after_mitigation = k.l_key) AS risk_level_after_mitigation_v,

           (SELECT GROUP_CONCAT(j.ref_value SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f, m_reference i ,m_reference j, m_likelihood k  
                                                                WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id AND c.risk_level_after_mitigation  = i.ref_key AND i.ref_context = 'risklevel.display' AND c.risk_impact_level_after_mitigation  = j.ref_key AND j.ref_context = 'impact.display' AND c.risk_likelihood_key_after_mitigation = k.l_key) AS impact_level_after_mitigation_v,

           (SELECT GROUP_CONCAT(k.l_title SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e, m_division f, m_reference i ,m_reference j, m_likelihood k  
                                                                WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status AND c.risk_owner = f.division_id AND c.risk_level_after_mitigation  = i.ref_key AND i.ref_context = 'risklevel.display' AND c.risk_impact_level_after_mitigation  = j.ref_key AND j.ref_context = 'impact.display' AND c.risk_likelihood_key_after_mitigation = k.l_key) AS likelihood_after_mitigation_v,  

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT case when b.`due_date`= '00-00-0000' then 'Continuous' when b.`due_date`= '0000-00-00' then 'Continuous'  else  DATE_FORMAT(b.due_date, '%d-%m-%Y') end  SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v,

                    (SELECT GROUP_CONCAT(DISTINCT b.due_date SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date
					FROM 
					t_risk_action_plan a
					LEFT JOIN t_risk b ON a.risk_id = b.risk_id
					LEFT JOIN m_user c ON a.assigned_to = c.username
					LEFT JOIN m_division d ON a.division = d.division_id
					LEFT JOIN m_periode ON m_periode.periode_id = b.periode_id
					JOIN m_action_plan f ON a.ap_code = f.id

						JOIN (SELECT b.id AS id, COUNT(b.id) AS jml_id
						FROM t_risk_action_plan a 
						JOIN m_action_plan b ON a.ap_code = b.id
						JOIN t_risk c ON a.risk_id = c.risk_id
						JOIN m_division e ON a.division = e.division_id  
						JOIN (SELECT risk_code, periode_id FROM t_risk WHERE periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					WHERE 
					b.periode_id = ((SELECT MAX(periode_id) FROM m_periode)-1) AND
					a.action_plan_status > 3 AND b.switch_flag = 'P' ORDER BY f.id
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

		$sql = "SET SESSION group_concat_max_len = 1000000"; 
		$res = $this->db->query($sql);

		$date = date("Y-m-d");
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.objective,

			    (SELECT DISTINCT GROUP_CONCAT(CONCAT('<a href=index.php/main/viewRisk/',a.risk_id,'>',a.risk_code,'</a>') ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ob_code`, a.`objective`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_objective a JOIN m_objective b ON a.`ob_code` = b.id JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ob_code, c.risk_code) a WHERE a.ob_code = b.id) risk_code,

			    (SELECT DISTINCT GROUP_CONCAT(CONCAT(`periode_name`) ORDER BY a.risk_code ASC SEPARATOR '<hr>') FROM (SELECT a.`ob_code`, a.`objective`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id,  MAX(g.`periode_name`) AS periode_name FROM t_risk_objective a JOIN m_objective b ON a.`ob_code` = b.id JOIN t_risk c ON a.`risk_id` = c.`risk_id` JOIN m_periode g ON a.periode_id = g.periode_id WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ob_code, c.risk_code) a WHERE a.ob_code = b.id) periode_id, b.status

				FROM t_risk_objective a 
				LEFT JOIN m_objective b ON a.ob_code = b.id 
				LEFT JOIN t_risk c ON a.risk_id = c.risk_id
				JOIN (SELECT a.`ob_code`, a.`objective`, MAX(c.risk_id) AS risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_objective a JOIN m_objective b ON a.`ob_code` = b.id JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ob_code, c.risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id 
				) ob where ob.".$filter_by." like '%".$filter_value."%' GROUP BY ob.id ASC".$ex_filter.$ex_or.""; 
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
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		return $res;
	}

	public function getAllObjective_export()
	{
	 
		$sql = "SELECT * FROM (SELECT DISTINCT b.id, b.objective, 
			    (SELECT DISTINCT GROUP_CONCAT(a.risk_code ORDER BY a.risk_code ASC SEPARATOR ' | ') FROM (SELECT a.`ob_code`, a.`objective`, c.risk_id, c.`risk_code`, MAX(c.`periode_id`) AS periode_id FROM t_risk_objective a JOIN m_objective b ON a.`ob_code` = b.id JOIN t_risk c ON a.`risk_id` = c.`risk_id` WHERE c.`existing_control_id` IS NULL AND c.`risk_status` > 2 AND c.`switch_flag` = 'P' GROUP BY a.ob_code, c.risk_code) a where a.ob_code = b.id ) risk_code

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
	
	public function deleteRisk_ap($id) {
		// delete risk in child
		  
		$sql = "update m_action_plan set status = 1 where id = '".$id."'";
		$res = $this->db->query($sql);


		return $res;
	}

	public function showRisk_ap($id) {
		// delete risk in child
		  
		$sql = "update m_action_plan set status = 0 where id = '".$id."'";
		$res = $this->db->query($sql);


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
	
	public function deleteRisk_ec($id) {
		// delete risk in child
		  
		
		$sql = "update m_control set status = 1 where id = '".$id."'";
		
		$res = $this->db->query($sql);

		return $res;
	}


	public function showRisk_ec($id) {
		// delete risk in child
		  
		
		$sql = "update m_control set status = 0 where id = '".$id."'";
		
		$res = $this->db->query($sql);

		return $res;
	}

	public function deleteRisk_objective($id) {
		// delete risk in child
		$sql = "UPDATE m_objective SET status = 1 where id = '".$id."'";
		$res = $this->db->query($sql);

		return $res;
	}

	public function showRisk_objective($id) {
		// delete risk in child
		$sql = "UPDATE m_objective SET status = 0 where id = '".$id."'";
		$res = $this->db->query($sql);

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

		$dd = implode('-', array_reverse( explode('-', $data['due_date']) ));
		
		if($data['id'] == $data['ap_code']){
			$sql = " 
					update `m_action_plan`
					SET  `action_plan`='".$data['action_plan']."', due_date = '".$dd."', `division`='".$data['division']."'
					WHERE `action_plan`='".$data['action_plan_ex']."'	  AND  `division`='".$data['division_ex']."' AND id = '".$data['ap_code']."'			 
			";
			$res = $this->db->query($sql);


			$sql = "update `t_risk_action_plan`
            	 	SET `action_plan`='".$data['action_plan']."', due_date = '".$dd."', `division`='".$data['division']."'
            		WHERE periode_id = (select max(periode_id) from m_periode) AND ap_code='".$data['ap_code']."'
			";

			$res = $this->db->query($sql);

			$sql = "update `t_risk_action_plan`
            	 	SET `action_plan`='".$data['action_plan']."', due_date = '".$dd."', `division`='".$data['division']."'
            		WHERE periode_id = ((select max(periode_id) from m_periode)-1) AND ap_code='".$data['ap_code']."'
			";

			$res = $this->db->query($sql);
		}
		else{

			$sql = " 
           		 	update `t_risk_action_plan`
            	 	SET  ap_code = '".$data['id']."'
            		WHERE ap_code='".$data['ap_code']."'";
      
       		$res = $this->db->query($sql);

			$sql = "update `t_risk_action_plan`
            	 	SET `action_plan`='".$data['action_plan']."', due_date = '".$dd."', `division`='".$data['division']."'
            		WHERE periode_id = (select max(periode_id) from m_periode) AND ap_code='".$data['id']."'
			";

			$res = $this->db->query($sql);

			$sql = "update `t_risk_action_plan`
            	 	SET `action_plan`='".$data['action_plan']."', due_date = '".$dd."', `division`='".$data['division']."'
            		WHERE periode_id = ((select max(periode_id) from m_periode)-1) AND ap_code='".$data['id']."'
			";

			$res = $this->db->query($sql);

			$sql = "update `m_action_plan`
					SET  `action_plan`='".$data['action_plan']."'	 , `division`='".$data['division']."'
					WHERE `action_plan`='".$data['action_plan_ex']."'	  AND  `division`='".$data['division_ex']."' AND id = '".$data['id']."'";

			$res = $this->db->query($sql);
		}
	  
		
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
				SET ec_code='".$data['id']."'
				WHERE ec_code = '".$data['idex']."'		
			";

				$res = $this->db->query($sql);

			$sql ="				
			UPDATE t_risk_control
				SET risk_existing_control='".$data['risk_existing_control']."', risk_evaluation_control='".$data['risk_evaluation_control']."', risk_control_owner= '".$data['risk_control_owner']."'
				WHERE ec_code = '".$data['idex']."' and periode_id =(select max(periode_id) from m_periode)";

				$res = $this->db->query($sql);
		}
		else{
			$sql = " 
							
				INSERT INTO t_risk_control (risk_existing_control,risk_evaluation_control,risk_control_owner) select * FROM (select '".$data['risk_existing_control']."' ,'".$data['risk_evaluation_control']."','".$data['risk_control_owner']."') t1 where NOT EXISTS(select risk_existing_control,risk_evaluation_control,risk_control_owner from t_risk_control WHERE risk_existing_control ='".$data['risk_existing_control']."' and risk_evaluation_control ='".$data['risk_evaluation_control']."' and risk_control_owner ='".$data['risk_control_owner']."')
				 
			";

			$res = $this->db->query($sql);
		}
	  
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
		$sql = "select 
				*
				from m_division where division_id not in('Not Available', 'D-CFO', 'D-CEO', 'D-COO') and status = 0";
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

	public function getConfirmApexHead_report($user,$idapx)
	{ 
		$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, a.existing_control_id, date_format(a.revised_date, '%d-%m-%Y') as revised_date_v, concat('AP.', LPAD(f.id, 6, '0')) as act_code,

              (select group_concat(c.risk_id separator ' | ') from t_risk c, cax_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and 
                    b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

             (select group_concat(c.risk_code separator ' | ') from t_risk c, cax_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code,

              (select group_concat(c.risk_event separator ' | ') from t_risk c, cax_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_event,

              (select group_concat(c.risk_description separator ' | ') from t_risk c, cax_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_description,

          (SELECT GROUP_CONCAT(f.division_name SEPARATOR ' | ') FROM t_risk c, cax_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner_v,

           (SELECT GROUP_CONCAT(f.division_id SEPARATOR ' | ') FROM t_risk c, cax_action_plan b, m_division e, m_division f WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' AND b.action_plan_status > 3 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner, 

                    c.display_name as assigned_to_v,
                    d.division_name as division_name,
                    (select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, cax_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and b.division = (select division_id from m_user where username ='".$user."') and b.id_apex = '".$idapx."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
                    from 
                    cax_action_plan a
                    left join t_risk b on a.risk_id = b.risk_id
                    left join m_user c on a.assigned_to = c.username
                    left join m_division d on a.division = d.division_id
                    left join m_periode on m_periode.periode_id = b.periode_id
                    join m_action_plan f on a.ap_code = f.id and a.division = f.division

                    where 
                    a.action_plan_status > 3 and a.division = (select division_id from m_user where username ='".$user."') and a.id_apex = '".$idapx."' and a.switch_flag = 'P' order by a.ap_code asc
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

	function getConfirmRiskOwn_Report($user){
			$sql = "SELECT DISTINCT ch_risk.risk_code,ch_risk.`risk_status`, ch_risk.risk_event, ch_risk.risk_owner, ch_risk.risk_impact_level, ch_risk.`risk_likelihood_key`,ch_risk.`risk_level`, ch_risk.`suggested_risk_treatment`,
			m_division.division_name as risk_owner_v,
			(SELECT GROUP_CONCAT(ch_risk_control.`risk_evaluation_control` SEPARATOR ' | ') FROM ch_risk_control where ch_risk.risk_id = ch_risk_control.risk_id) AS 'Existing Control',
			(SELECT GROUP_CONCAT(ch_risk_control.`risk_existing_control` SEPARATOR ' | ') FROM ch_risk_control where ch_risk.risk_id = ch_risk_control.risk_id) AS 'Evaluation Control',
			(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM ch_risk_control, m_division where ch_risk.risk_id = ch_risk_control.risk_id and ch_risk_control.risk_control_owner = m_division.division_id) AS 'Control Owner',
			(SELECT GROUP_CONCAT(ch_risk_action_plan.`action_plan` SEPARATOR ' | ') FROM ch_risk_action_plan WHERE ch_risk.risk_id = ch_risk_action_plan.risk_id) AS 'Action Plan',
			(SELECT GROUP_CONCAT(ch_risk_action_plan.`division`SEPARATOR ' | ') FROM ch_risk_action_plan WHERE ch_risk.risk_id = ch_risk_action_plan.risk_id) AS 'Action Plan Owner',
			(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM ch_risk_action_plan, m_division WHERE ch_risk.risk_id = ch_risk_action_plan.risk_id and ch_risk_action_plan.division = m_division.division_id) AS 'Action Plan Owner_v',
			(SELECT GROUP_CONCAT(case when ch_risk_action_plan.`due_date`= '00-00-0000' then 'Continuous' when ch_risk_action_plan.`due_date`= '0000-00-00' then 'Continuous'  else ch_risk_action_plan.`due_date` end  SEPARATOR ' | ') FROM ch_risk_action_plan WHERE ch_risk.risk_id = ch_risk_action_plan.risk_id) AS 'Due Date'
			FROM ch_risk 
			LEFT JOIN m_division ON ch_risk.risk_owner = m_division.division_id
			where ch_risk.switch_flag = (select division_id from m_user where username = '".$user."') and ch_risk.periode_id = (select max(periode_id) from m_periode)";
			 
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

	function getConfirmActionPlan_Report($user){
 			$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, f.division, a.existing_control_id, date_format(a.revised_date, '%d-%m-%Y') as revised_date_v, concat('AP.', LPAD(f.id, 6, '0')) as act_code,

                    (select group_concat(c.risk_id separator ' | ') from t_risk c, ca_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.switch_flag and 
                    b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status) as risk_id,

                    (select group_concat(c.risk_code separator ' | ')from t_risk c, ca_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.switch_flag and 
                    b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status) as risk_code,

          			(SELECT GROUP_CONCAT(f.division_name SEPARATOR ' | ') FROM t_risk c, ca_action_plan b, m_division e, m_division f where c.risk_id = b.risk_id and e.division_id = b.switch_flag and b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner_v,

           			(SELECT GROUP_CONCAT(f.division_id SEPARATOR ' | ') FROM t_risk c, ca_action_plan b, m_division e, m_division f where c.risk_id = b.risk_id and e.division_id = b.switch_flag and 
              		b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_owner,

              		(SELECT GROUP_CONCAT(c.risk_event SEPARATOR ' | ') FROM t_risk c, ca_action_plan b, m_division e, m_division f where c.risk_id = b.risk_id and e.division_id = b.switch_flag and 
              		b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_event,

              		(SELECT GROUP_CONCAT(c.risk_description SEPARATOR ' | ') FROM t_risk c, ca_action_plan b, m_division e, m_division f where c.risk_id = b.risk_id and e.division_id = b.switch_flag and 
              		b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status and c.risk_owner = f.division_id) AS risk_description, 

                    c.display_name as assigned_to_v,
                    d.division_name as division_name,
                    (select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, ca_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.switch_flag and b.switch_flag = (select division_id from m_user where username = '".$user."') and b.action_plan_status > 2 and a.ap_code = b.ap_code and a.switch_flag = b.switch_flag and a.action_plan_status = b.action_plan_status) as due_date_v
                    from 
                    ca_action_plan a
                    left join t_risk b on a.risk_id = b.risk_id
                    left join m_user c on a.assigned_to = c.username
                    left join m_division d on a.division = d.division_id
                    left join m_periode on m_periode.periode_id = b.periode_id
                    join m_action_plan f on a.ap_code = f.id and a.switch_flag = f.division

                    where 
                    a.action_plan_status > 2 and a.switch_flag = (select division_id from m_user where username = '".$user."')";
			 
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

		public function updateNewKri($k_id, $kri, $treshold) {
		$sql = " update t_kri set risk_id ='".$kri['risk_id']."', kri_library_id = '".$kri['kri_library_id']."', key_risk_indicator = '".$kri['key_risk_indicator']."',
			kri_pic = '".$kri['kri_pic']."',mandatory = '".$kri['mandatory']."', treshold_type = '".$kri['treshold_type']."',
			timing_pelaporan = '".$kri['timing_pelaporan']."', kri_owner = '".$kri['kri_owner']."', created_by = '".$kri['created_by']."' where id = '".$k_id."'
			";
		$res = $this->db->query($sql);	

		if ($res) {
			$sql = "update t_kri set 
					timing_pelaporan = null
					where timing_pelaporan = '0000-00-00'";
			$res2 = $this->db->query($sql);
			
			$sql = "delete from t_kri_treshold where kri_id = '".$k_id."'";
			$res3 = $this->db->query($sql);

			// insert treshold
			$sql = "insert into t_kri_treshold(kri_id, operator, value_1, value_2, value_type, result) values(?, ?, ?, ?, ?, ?)";
			
			foreach ($treshold as $key => $value) {
				if ($value['value_2'] == '-') {
					$value['value_2'] = null;
				}
				if ($value['value_type'] == '-') {
					$value['value_type'] = null;
				}
				
				$par = array(
					'rid' => $k_id,
					'op' => $value['operator'],
					'v1' => $value['value_1'],
					'v2' => $value['value_2'],
					'r' => $value['value_type'],
					'r2' => $value['result']
				);
				$res3 = $this->db->query($sql, $par);
			}

		if ($kri['treshold_type'] == 'VALUE'){
			$sql = "select value_1 from t_kri_treshold where kri_id='".$rid."' and operator ='BELOW' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$below = $row->value_1;


			$sql = "select value_1, value_2 from t_kri_treshold where kri_id='".$rid."' and operator ='BETWEEN' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$between = $row->value_1;
			$between2 = $row->value_2;
			

			$sql = "select value_1 from t_kri_treshold where kri_id='".$rid."' and operator ='ABOVE' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$above = $row->value_1;

		}
			return $res;
		}
	}


	public function risk_aggregate_report($post = NULL, $idp)
	{ 

		$sql = "  select * from (select 
                                                                 a.risk_idag,
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
                                                                                a.risk_evaluation_control,
                                                                               
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

                                                                i.ref_value as risk_level_after_mitigation_v,
                                                                j.ref_value as impact_level_after_mitigation_v,
                                                                k.l_title as likelihood_after_mitigation_v,
                                                                f.division_name as risk_owner_v,
                                                                
                                                                (SELECT GROUP_CONCAT(tag_risk_control.`risk_evaluation_control` SEPARATOR ' | ') FROM tag_risk_control where a.risk_idag = tag_risk_control.risk_idag) AS 'Existing Control',
																(SELECT GROUP_CONCAT(tag_risk_control.`risk_existing_control` SEPARATOR ' | ') FROM tag_risk_control where a.risk_idag = tag_risk_control.risk_idag) AS 'Evaluation Control',
																(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM tag_risk_control, m_division where a.risk_idag = tag_risk_control.risk_idag and tag_risk_control.risk_control_owner = m_division.division_id) AS 'Control Owner',
																(SELECT GROUP_CONCAT(tag_risk_action_plan.`action_plan` SEPARATOR ' | ') FROM tag_risk_action_plan WHERE a.risk_idag = tag_risk_action_plan.risk_idag) AS 'Action Plan',
																(SELECT GROUP_CONCAT(tag_risk_action_plan.`division`SEPARATOR ' | ') FROM tag_risk_action_plan WHERE a.risk_idag = tag_risk_action_plan.risk_idag) AS 'Action Plan Owner',
																(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM tag_risk_action_plan, m_division WHERE a.risk_idag = tag_risk_action_plan.risk_idag and tag_risk_action_plan.division = m_division.division_id) AS 'Action Plan Owner_v',
																(SELECT GROUP_CONCAT(case when tag_risk_action_plan.`due_date`= '00-00-0000' then 'Continuous' when tag_risk_action_plan.`due_date`= '0000-00-00' then 'Continuous'  else tag_risk_action_plan.`due_date` end  SEPARATOR ' | ') FROM tag_risk_action_plan WHERE a.risk_idag = tag_risk_action_plan.risk_idag) AS 'Due Date'

                                                                from tag_risk a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                where a.existing_control_id is NULL AND a.periode_ag = '".$idp."'
                                                               
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another

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

	public function risk_aggregate_new_report($post = NULL, $idp)
	{ 

		$sql = " select * from (select 
                                                                 a.risk_idag,
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
                                                                                a.risk_evaluation_control,
                                                                               
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
                                                                
                                                                i.ref_value as risk_level_after_mitigation_v,
                                                                j.ref_value as impact_level_after_mitigation_v,
                                                                k.l_title as likelihood_after_mitigation_v,
                                                                f.division_name as risk_owner_v,

                                                                 (SELECT GROUP_CONCAT(tag_risk_new_control.`risk_evaluation_control` SEPARATOR ' | ') FROM tag_risk_new_control where a.risk_idag = tag_risk_new_control.risk_idag) AS 'Existing Control',
																(SELECT GROUP_CONCAT(tag_risk_new_control.`risk_existing_control` SEPARATOR ' | ') FROM tag_risk_new_control where a.risk_idag = tag_risk_new_control.risk_idag) AS 'Evaluation Control',
																(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM tag_risk_new_control, m_division where a.risk_idag = tag_risk_new_control.risk_idag and tag_risk_new_control.risk_control_owner = m_division.division_id) AS 'Control Owner',
																(SELECT GROUP_CONCAT(tag_risk_new_action_plan.`action_plan` SEPARATOR ' | ') FROM tag_risk_new_action_plan WHERE a.risk_idag = tag_risk_new_action_plan.risk_idag) AS 'Action Plan',
																(SELECT GROUP_CONCAT(tag_risk_new_action_plan.`division`SEPARATOR ' | ') FROM tag_risk_new_action_plan WHERE a.risk_idag = tag_risk_new_action_plan.risk_idag) AS 'Action Plan Owner',
																(SELECT GROUP_CONCAT(m_division.`division_name`SEPARATOR ' | ') FROM tag_risk_new_action_plan, m_division WHERE a.risk_idag = tag_risk_new_action_plan.risk_idag and tag_risk_new_action_plan.division = m_division.division_id) AS 'Action Plan Owner_v',
																(SELECT GROUP_CONCAT(case when tag_risk_new_action_plan.`due_date`= '00-00-0000' then 'Continuous' when tag_risk_new_action_plan.`due_date`= '0000-00-00' then 'Continuous'  else tag_risk_new_action_plan.`due_date` end  SEPARATOR ' | ') FROM tag_risk_new_action_plan WHERE a.risk_idag = tag_risk_new_action_plan.risk_idag) AS 'Due Date'

                                                                from tag_risk_new a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                where a.existing_control_id is NULL AND a.periode_ag = '".$idp."'
                                                               
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another

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


		public function loss_event_report()
	{ 
		$sql = "SELECT a.*, b.*, (SELECT GROUP_CONCAT(y.`division_name` SEPARATOR ' | ') FROM t_loss_fungsi x, m_division y WHERE x.division_id = y.division_id AND a.id_event = x.id_loss) as 'fungsi' FROM t_loss_event a, m_sektor b WHERE a.sektor_proyek = b.id_sektor"; 
				
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

}
