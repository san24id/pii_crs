<?php 
	class Risk_model extends APP_Model {

		public function getAllrisk(){
			$sql = "SELECT m_risk_category.`cat_name`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`,
					t_risk.`risk_cause`, t_risk.`risk_impact`, t_risk_control.`risk_existing_control`, t_risk_control.`risk_evaluation_control`,t_risk_control.`risk_control_owner`,t_risk.`risk_impact_level`,
					t_risk.`risk_likelihood_key`,t_risk.`risk_level` 
					FROM t_risk
					LEFT JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id`
					LEFT JOIN t_risk_control ON t_risk.`risk_id`=t_risk_control.`risk_id`
					where t_risk.risk_evaluation_control is null or t_risk.risk_evaluation_control = '' ";
			$res = $this->db->query($sql);
			return $res;
		}

		public function getAllriskperiode($periode){
			$sql = "SELECT m_risk_category.`cat_name`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`,
					t_risk.`risk_cause`, t_risk.`risk_impact`, t_risk_control.`risk_existing_control`,t_risk_control.`risk_evaluation_control`,t_risk_control.`risk_control_owner`,t_risk.`risk_impact_level`,
					t_risk.`risk_likelihood_key`,t_risk.`risk_level` 
					FROM t_risk
					LEFT JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id`
					LEFT JOIN t_risk_control ON t_risk.`risk_id`=t_risk_control.`risk_id`
					WHERE t_risk.`periode_id`='".$periode."' 
					and t_risk.risk_evaluation_control is null or t_risk.risk_evaluation_control = '' "
					;
			$res = $this->db->query($sql);
			return $res;
		}

		public function getActionPlanPeriode($periode){
			$sql = "SELECT t_risk_action_plan.`id`,t_risk_action_plan.`action_plan`,t_risk_action_plan.`due_date`,t_risk_action_plan.`division`, 
					t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_owner`,
					t_risk.`risk_impact_level`,
					t_risk.`risk_likelihood_key`,t_risk.`risk_level` 
					FROM t_risk
					LEFT JOIN t_risk_action_plan ON t_risk.`risk_id` = t_risk_action_plan.`risk_id`
					WHERE t_risk_action_plan.`execution_evidence` IS NULL AND t_risk_action_plan.`execution_explain` IS NULL
					AND t_risk_action_plan.`execution_reason` IS NULL AND t_risk_action_plan.`revised_date` IS NULL AND
					t_risk_action_plan.`action_plan_status` = 4 AND t_risk.`periode_id` = '".$periode."' 
					and t_risk.risk_evaluation_control is null or t_risk.risk_evaluation_control = '' ";
			$res = $this->db->query($sql);
			return $res;					
		}

		public function getRiskTreatment($periode){
			$sql = "SELECT t_risk_action_plan.`action_plan`,t_risk_action_plan.`due_date`,t_risk_action_plan.`division`, 
					t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_owner`,
					t_risk.`risk_impact_level`,
					t_risk.`risk_likelihood_key`,t_risk.`risk_level`,t_risk.`suggested_risk_treatment` 
					FROM t_risk
					LEFT JOIN t_risk_action_plan ON t_risk.`risk_id` = t_risk_action_plan.`risk_id`
					WHERE t_risk.`risk_status` = 6 AND t_risk.`periode_id` = '".$periode."' 
					and t_risk.risk_evaluation_control is null or t_risk.risk_evaluation_control = '' ";
			$res = $this->db->query($sql);
			return $res;
		}	

		public function getTopTenRisk(){
			$sql = "SELECT risk_code, risk_event, risk_description, risk_owner, risk_impact_level, risk_likelihood_key, risk_level,
					COUNT(risk_event)AS jumlah 
					FROM t_risk 
					WHERE risk_level = 'HIGH' 
					GROUP BY risk_event ORDER BY jumlah DESC
					LIMIT 10";
			$res = $this->db->query($sql);
			return $res;					
		}	

		public function getkri($periode){
			$sql = "SELECT t_risk.risk_code, t_risk.risk_event, t_risk.risk_level, t_risk.suggested_risk_treatment, 
					t_kri.kri_code, t_kri.key_risk_indicator, t_kri.kri_owner, t_kri.treshold, t_kri.timing_pelaporan, 
					t_kri.owner_report, t_kri.kri_warning 
					FROM t_kri 
					LEFT JOIN t_risk ON t_kri.risk_id=t_risk.risk_id WHERE periode_id='".$periode."'";
			$res = $this->db->query($sql);
			return $res;					
		}		

		public function getoutcome($periode1,$periode2,$level){
			$sql = "SELECT DISTINCT risk_level, 
					(SELECT COUNT(risk_id) FROM t_risk WHERE risk_level ='$level' AND periode_id='$periode1') AS 'rp1' , 
					(SELECT COUNT(risk_id) FROM t_risk WHERE risk_level='$level' AND periode_id='$periode2') AS 'rp2' 
					FROM t_risk WHERE risk_level ='$level'";
			$res = $this->db->query($sql);
			return $res;		
		}	

		public function gettable($periode){
			$sql = "SELECT t1.risk_code, t1.risk_event, t1.risk_description, t1.risk_impact_level, t1.risk_likelihood_key, 
					t1.risk_level AS 'curr', 
					(SELECT t2.risk_level FROM t_risk t2 WHERE t2.risk_id = t1.risk_library_id) AS 'prev' 
					FROM t_risk t1 WHERE t1.periode_id='$periode' AND t1.risk_library_id IS NOT NULL";
			$res = $this->db->query($sql);
			return $res;						
		}	

		public function get2ndcategory($periode,$category){
			$sql = "SELECT DISTINCT t1.risk_2nd_sub_category, t2.cat_name,
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_impact_level ='Insignificant' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Insignificant',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_impact_level ='Minor' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Minor',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_impact_level ='Moderate' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Moderate',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_impact_level ='Major' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Major',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_impact_level ='Catastrophic' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Catastrophic',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_likelihood_key ='Very Low' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Very_Low',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_likelihood_key ='Low' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Low',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_likelihood_key ='Moderate' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Moderate',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_likelihood_key ='High' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'High',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_likelihood_key ='Very High' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'Very_High',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_level ='Low' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'rLow',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_level ='Medium' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'rMedium',
					(SELECT COUNT(t3.risk_id) FROM t_risk t3 WHERE t3.risk_level ='High' AND t3.periode_id=$periode AND t3.risk_2nd_sub_category = t1.risk_2nd_sub_category) AS 'rHigh'
					FROM t_risk t1 JOIN m_risk_category t2 ON t1.risk_2nd_sub_category = t2.cat_id WHERE risk_2nd_sub_category = $category";
			$res = $this->db->query($sql);
			return $res;									
		}

		public function getRiskLevel($im,$lk){
			$sql = "SELECT risk_level FROM m_risklevel_matrix WHERE impact_value = '$im' AND likelihood_key = '$lk'";
			$res = $this->db->query($sql);
			return $res;			
		}

		public function getPeriode($periode){
			$data = array(
						'periode_id' => $periode
					);
			$query = $this->db->select('periode_name,periode_start,periode_end')
					 		  ->get_where('m_periode',$data);
			return $query->result();
		}

		public function getallPeriode(){
			$query = $this->db->select('periode_id,periode_name,periode_start,periode_end')
					 		  ->get('m_periode_report');
			return $query->result();
		}

		public function getcategory(){
			$query = $this->db->select('cat_id,cat_name')
					 		  ->get('m_risk_category');
			return $query->result();
		}

		public function getcategoryname($cat_id){
			$data = array(
						'cat_id' => $cat_id
					);
			$query = $this->db->select('cat_name,cat_code')
					 		  ->get_where('m_risk_category',$data);
			return $query->result();
		}	

		function listofrisk($data){
			$querynya = "SELECT DISTINCT m_risk_category.`cat_name`,t_risk.`risk_status`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`, t_risk.`risk_cause`, t_risk.`risk_impact`, t_risk.`risk_input_by`,DATE_FORMAT(t_risk.`risk_date`,'%d/%m/%Y') AS tanggalrisk,
			(SELECT GROUP_CONCAT(t_risk_add_user.`username` SEPARATOR '|') FROM t_risk_add_user WHERE t_risk.risk_id = t_risk_add_user.risk_id) AS 'username',
			(SELECT GROUP_CONCAT(t_risk_add_user.`date_changed` SEPARATOR '|') FROM t_risk_add_user WHERE t_risk.risk_id = t_risk_add_user.risk_id) AS 'date_changed',      
			(SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR '|') FROM t_risk_objective WHERE t_risk.risk_id = t_risk_objective.risk_id) AS 'Objective', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR '|') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Existing Control', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR '|') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Evaluation', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR '|') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Owner', t_risk.`risk_impact_level`, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR '|') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR '|') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR '|') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
			FROM t_risk JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id` JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_report_risk.`periode_id`=".$data['periode']."";

			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}	
		
		function listofrisketc($data){
			$querynya = 
			"SELECT DISTINCT m_risk_category.`cat_name`,t_risk.`risk_status`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`, t_risk.`risk_cause`, t_risk.`risk_impact`,t_risk.`risk_input_by`,DATE_FORMAT(t_risk.`risk_date`,'%d/%m/%Y') AS tanggalrisk,
			(SELECT GROUP_CONCAT(t_risk_add_user.`username` SEPARATOR '|') FROM t_risk_add_user WHERE t_risk.risk_id = t_risk_add_user.risk_id) AS 'username',
      (SELECT GROUP_CONCAT(t_risk_add_user.`date_changed` SEPARATOR '|') FROM t_risk_add_user WHERE t_risk.risk_id = t_risk_add_user.risk_id) AS 'date_changed',
			(SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR '\n') FROM t_risk_objective WHERE t_risk.risk_id = t_risk_objective.risk_id) AS 'Objective', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR '\n') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Existing Control', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR '\n') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Evaluation', 
			(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR '\n') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Owner', t_risk.`risk_impact_level`, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
			FROM t_risk JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id` JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id  WHERE t_report_risk.`periode_id`='".$data['periode']."' AND t_risk.risk_library_id IS NULL";
 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function risktreatmentreport($data=null){
			$querynya = "
			SELECT DISTINCT t_risk.risk_code,t_risk.`risk_status`, t_risk.risk_event, t_risk.risk_owner, t_risk.risk_impact_level, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan`SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`division`SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
			(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date`SEPARATOR '\n') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
			FROM t_risk JOIN t_report_risk ON t_risk.risk_id = t_report_risk.risk_id
			WHERE t_report_risk.periode_id='".$data['periode']."'
			";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function listofall($data=null){
			if($data['status'] == 'ALL'){
				$querynya = "
					select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, 
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code,

					(select group_concat(c.risk_event separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_event,

					(select group_concat(c.risk_description separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_description,  

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id
					left join m_periode on m_periode.periode_id = b.periode_id
					join m_action_plan f on a.action_plan = f.action_plan and a.division = f.division

						JOIN (SELECT b.id as id, count(b.id) as jml_id
						FROM t_risk_action_plan a 
						JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
						JOIN t_risk c ON a.risk_id = c.risk_id
						JOIN m_division e ON a.division = e.division_id  
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = '".$data['periode']."' GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = '".$data['periode']."' and
					a.action_plan_status > 3 and b.switch_flag = 'P'";

			}else{
			$querynya = "
					select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, 
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code,

					(select group_concat(c.risk_event separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_event,

					(select group_concat(c.risk_description separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_description,  

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = '".$data['periode']."' and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id
					left join m_periode on m_periode.periode_id = b.periode_id
					join m_action_plan f on a.action_plan = f.action_plan and a.division = f.division

						JOIN (SELECT b.id as id, count(b.id) as jml_id
						FROM t_risk_action_plan a 
						JOIN m_action_plan b ON a.action_plan = b.action_plan and a.division = b.division 
						JOIN t_risk c ON a.risk_id = c.risk_id
						JOIN m_division e ON a.division = e.division_id  
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = '".$data['periode']."' GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = '".$data['periode']."' and
					a.action_plan_status > 3 and b.switch_flag = 'P' and a.execution_status = '".$data['status']."'
					";
			 
			 }
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function listofall1($data=null){
			$querynya = "
			SELECT t_risk_action_plan.`id`,t_risk_action_plan.`action_plan`,t_risk_action_plan.`division`,t_risk_action_plan.`due_date`,
					t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_owner`,
					t_risk.`risk_level`, (select ifnull(t_risk_action_plan.`execution_status`, 'Have Not been Updated')) as 'Execution Status', t_risk.risk_level_after_mitigation
					FROM t_risk_action_plan
					JOIN t_risk ON t_risk_action_plan.risk_id=t_risk.risk_id JOIN t_report_risk ON t_risk_action_plan.risk_id = t_report_risk.risk_id
                    			WHERE t_report_risk.periode_id='".$data['periode']."'
			and t_risk.existing_control_id is null and t_risk.risk_existing_control is null and risk_evaluation_control is null and risk_control_owner is null ";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function topten($data=null){
			$querynya = "
					SELECT 
					risk_code,
					risk_status,
					risk_event,
					risk_description,
					risk_owner,
					risk_impact_level,
					risk_likelihood_key,
					risk_level 
					FROM
					t_risk
          			JOIN t_report_risk ON t_risk.risk_id = t_report_risk.risk_id
          			where t_report_risk.periode_id = '".$data['periode']."'
     				GROUP BY risk_event,
					risk_level 
         			ORDER BY 
          			(CASE
					WHEN risk_level = 'High' THEN 1 
					WHEN risk_level = 'Moderate' THEN 2 
   		    		WHEN risk_level = 'Low' THEN 3 
					END) ASC,
          			(CASE
					WHEN risk_impact_level = 'CATASTROPHIC' THEN 1 
					WHEN risk_impact_level = 'MAJOR' THEN 2 
					WHEN risk_impact_level = 'MODERATE' THEN 3 
          			WHEN risk_impact_level = 'MINOR' THEN 4 
          			WHEN risk_impact_level = 'INSIGNIFICANT' THEN 5 
					END) ASC,
         			(CASE
					WHEN risk_likelihood_key = 'VERY HIGH' THEN 1 
					WHEN risk_likelihood_key = 'HIGH' THEN 2 
					WHEN risk_likelihood_key = 'MEDIUM' THEN 3
          			WHEN risk_likelihood_key = 'LOW' THEN 4 
					WHEN risk_likelihood_key = 'VERY LOW' THEN 5 
					END) ASC
					LIMIT 10
			";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function topten2($data=null){
			$querynya ="			
						SELECT cat_code, cat_name, impact_level, likelihood_level, risk_level 
			FROM t_report_2ndsub
      		WHERE periode_id = '".$data['periode']."' and risk_level is not null
			GROUP BY cat_id, risk_level
			ORDER BY 
			(CASE
					WHEN risk_level = 'High' THEN 1 
					WHEN risk_level = 'Moderate' THEN 2 
   		    		WHEN risk_level = 'Low' THEN 3 
					END) ASC,
			(CASE
					WHEN impact_level = 'CATASTROPHIC' THEN 1 
					WHEN impact_level = 'MAJOR' THEN 2 
					WHEN impact_level = 'MODERATE' THEN 3 
  			  		WHEN impact_level = 'MINOR' THEN 4 
    				WHEN impact_level = 'INSIGNIFICANT' THEN 5 
					END) ASC,
			(CASE
					WHEN likelihood_level = 'VERY HIGH' THEN 1 
					WHEN likelihood_level = 'HIGH' THEN 2 
					WHEN likelihood_level = 'MEDIUM' THEN 3
  			  		WHEN likelihood_level = 'LOW' THEN 4 
					WHEN likelihood_level = 'VERY LOW' THEN 5 
					END) ASC,
     		(impact_score*likelihood_score) DESC
     		LIMIT 10";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function KRI_monitoring($data=null){
			$querynya ="			
			
			SELECT t1.id, t1.kri_code, t1.key_risk_indicator, CASE(t1.mandatory) WHEN 'Y' THEN 'Already' WHEN 'N' THEN 'Not Yet' END AS mandatory, (SELECT GROUP_CONCAT(t2.operator,' ', t2.value_1, ' = ', t2.result) FROM t_kri_treshold t2 WHERE t2.kri_id=t1.id) AS 'threshold value',t1.risk_id,t_risk.risk_code, 
			t_risk.risk_event, t_risk.risk_level, m_division.division_name, DATE_FORMAT(t1.timing_pelaporan, '%d-%m-%Y') AS 'timing_pelaporan_v', 
			(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan`SEPARATOR ' | ') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
			t1.owner_report, t1.supporting_evidence, t1.kri_warning, t1.validation, t_risk.risk_level, t_risk.risk_impact_level, t_risk.risk_likelihood_key,
			t_risk.risk_level_after_kri, t_risk.risk_impact_level_after_kri, t_risk.risk_likelihood_key_after_kri 
				FROM t_kri t1 
				JOIN t_risk ON t_risk.risk_id = t1.risk_id
				LEFT JOIN m_division ON t1.kri_owner = m_division.division_id
				";
		  
			 
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function comparison1($data=null){
			$querynya ="			
			
			SELECT t1.risk_code, t1.risk_event, t1.risk_description, t1.risk_owner, t1.risk_impact_level AS 'current impact', t1.risk_likelihood_key AS 'current likelihood' , t1.risk_level AS 'current risk level',
			(SELECT t2.risk_impact_level FROM t_risk t2 JOIN t_report_risk r1 ON t2.risk_id = r1.risk_id WHERE r1.periode_id = '".$data['periode_prev']."' AND t2.risk_code = t1.risk_code) AS 'previous impact',
			(SELECT t2.risk_likelihood_key FROM t_risk t2 JOIN t_report_risk r1 ON t2.risk_id = r1.risk_id WHERE r1.periode_id = '".$data['periode_prev']."' AND t2.risk_code = t1.risk_code) AS 'previous likelihood',
			(SELECT t2.risk_level FROM t_risk t2 JOIN t_report_risk r1 ON t2.risk_id = r1.risk_id WHERE r1.periode_id = '".$data['periode_prev']."' AND t2.risk_code = t1.risk_code) AS 'previous risk Level'
			FROM t_risk t1 JOIN t_report_risk r1 ON t1.risk_id = r1.risk_id WHERE r1.periode_id = '".$data['periode_cur']."' AND t1.risk_library_id IS NOT NULL
			";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function comparison2($data=null){
			$querynya ="	 
			SELECT t1.cat_code, t1.cat_name, t1.impact_level AS 'current impact', t1.likelihood_level AS 'current likelihood', t1.risk_level AS 'current risk level',
			(SELECT t2.impact_level FROM t_report_2ndsub t2 WHERE t2.periode_id = '".$data['periode_prev']."' AND t2.cat_id =  t1.cat_id) AS 'previous impact',
			(SELECT t2.likelihood_level FROM t_report_2ndsub t2 WHERE t2.periode_id = '".$data['periode_prev']."' AND t2.cat_id =  t1.cat_id) AS 'previous impact',
			(SELECT t2.risk_level FROM t_report_2ndsub t2 WHERE t2.periode_id = '".$data['periode_prev']."' AND t2.cat_id =  t1.cat_id) AS 'previous impact'
			FROM t_report_2ndsub t1 WHERE periode_id = '".$data['periode_cur']."'";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function getcomparison1($data=null){
			$querynya = "
			SELECT DISTINCT risk_level,
			(CASE
			WHEN t_risk.risk_level = 'LOW' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='low' AND t_report_risk.`periode_id`='".$data['periode_prev']."')
			WHEN t_risk.risk_level = 'MODERATE' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='moderate' AND t_report_risk.`periode_id`='".$data['periode_prev']."')
			WHEN t_risk.risk_level = 'HIGH' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='high' AND t_report_risk.`periode_id`='".$data['periode_prev']."')
			END) AS 'jumlah risk periode 1',
			(CASE
      WHEN t_risk.risk_level = 'LOW' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='low' AND t_report_risk.`periode_id`='".$data['periode_cur']."')
			WHEN t_risk.risk_level = 'MODERATE' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='moderate' AND t_report_risk.`periode_id`='".$data['periode_cur']."')
			WHEN t_risk.risk_level = 'HIGH' THEN (SELECT COUNT(t_risk.risk_id) FROM t_risk JOIN t_report_risk ON t_report_risk.risk_id=t_risk.risk_id WHERE t_risk.risk_level ='high' AND t_report_risk.`periode_id`='".$data['periode_cur']."')
			END) AS 'jumlah risk periode 2'
			FROM t_risk

			";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function getcomparison2($data=null){
			$querynya = "
				SELECT DISTINCT m1.cat_code, z.ref_key as 'risk_level',
				(CASE
				WHEN z.ref_key = 'LOW' THEN (SELECT COUNT(t2.risk_id) FROM t_risk t2 JOIN t_report_risk ON t_report_risk.risk_id=t2.risk_id WHERE t2.risk_level = z.ref_key AND t2.risk_level ='low' AND t_report_risk.`periode_id`= '".$data['periode_prev']."' AND m1.cat_id = t2.risk_2nd_sub_category)
				WHEN z.ref_key = 'MODERATE' THEN (SELECT COUNT(t2.risk_id) FROM t_risk t2 JOIN t_report_risk ON t_report_risk.risk_id=t2.risk_id WHERE t2.risk_level = z.ref_key AND t2.risk_level ='moderate' AND t_report_risk.`periode_id`= '".$data['periode_prev']."' AND m1.cat_id = t2.risk_2nd_sub_category)
				WHEN z.ref_key = 'HIGH' THEN (SELECT COUNT(t2.risk_id) FROM t_risk t2 JOIN t_report_risk ON t_report_risk.risk_id=t2.risk_id WHERE t2.risk_level = z.ref_key AND t2.risk_level ='high' AND t_report_risk.`periode_id`= '".$data['periode_prev']."' AND m1.cat_id = t2.risk_2nd_sub_category)
				END) AS 'jumlah risk periode 1',
				(CASE
				WHEN z.ref_key = 'LOW' THEN (SELECT COUNT(t3.risk_id) FROM t_risk t3 JOIN t_report_risk ON t_report_risk.risk_id=t3.risk_id WHERE t3.risk_level = z.ref_key AND t3.risk_level ='low' AND  t_report_risk.`periode_id`= '".$data['periode_cur']."' AND m1.cat_id = t3.risk_2nd_sub_category)
				WHEN z.ref_key = 'MODERATE' THEN (SELECT COUNT(t3.risk_id) FROM t_risk t3 JOIN t_report_risk ON t_report_risk.risk_id=t3.risk_id WHERE t3.risk_level = z.ref_key AND t3.risk_level ='moderate' AND  t_report_risk.`periode_id`= '".$data['periode_cur']."' AND m1.cat_id = t3.risk_2nd_sub_category)
				WHEN z.ref_key = 'HIGH' THEN (SELECT COUNT(t3.risk_id) FROM t_risk t3 JOIN t_report_risk ON t_report_risk.risk_id=t3.risk_id WHERE t3.risk_level = z.ref_key AND t3.risk_level ='high' AND  t_report_risk.`periode_id`= '".$data['periode_cur']."' AND m1.cat_id = t3.risk_2nd_sub_category)
				END) AS 'jumlah risk periode 2'
				FROM t_risk t1 JOIN m_risk_category m1 ON t1.risk_2nd_sub_category = m1.cat_id
        		CROSS JOIN m_reference z
				where z.ref_context = 'risklevel.display'
				ORDER BY m1.cat_code,
				(CASE 
				WHEN z.ref_key = 'High' THEN 1
				WHEN z.ref_key = 'Moderate' THEN 2
				WHEN z.ref_key = 'Low' THEN 3
				END)
			";
			 
			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}
		
		function cekperiode($periode_ID){
			 
			$this->db->where("periode_ID",$periode_ID);
			
			$query = $this->db->get("m_periode_report");
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
			
		}
		
		function riskmap($data=null){
			
			if($data==null){
				$data['periode'] = 1;				
			}
			
			$sql = '
					SELECT ref_key,
					(SELECT GROUP_CONCAT(t2.cat_code, " ", t2.cat_name SEPARATOR ", <br>") from t_report_2ndsub t2 where t2.impact_level = ref_key and t2.periode_id = "'.$data['periode'].'" and t2.likelihood_level = "Very Low") as "Very Low",
					(SELECT GROUP_CONCAT(t2.cat_code, " ", t2.cat_name SEPARATOR ", <br>") from t_report_2ndsub t2 where t2.impact_level = ref_key and t2.periode_id = "'.$data['periode'].'" and t2.likelihood_level = "Low") as "Low",
					(SELECT GROUP_CONCAT(t2.cat_code, " ", t2.cat_name SEPARATOR ", <br>") from t_report_2ndsub t2 where t2.impact_level = ref_key and t2.periode_id = "'.$data['periode'].'" and t2.likelihood_level = "Medium") as "Medium",
					(SELECT GROUP_CONCAT(t2.cat_code, " ", t2.cat_name SEPARATOR ", <br>") from t_report_2ndsub t2 where t2.impact_level = ref_key and t2.periode_id = "'.$data['periode'].'" and t2.likelihood_level = "High") as "High",
					(SELECT GROUP_CONCAT(t2.cat_code, " ", t2.cat_name SEPARATOR ", <br>") from t_report_2ndsub t2 where t2.impact_level = ref_key and t2.periode_id = "'.$data['periode'].'" and t2.likelihood_level = "Very High") as "Very High"
					from m_reference
					where ref_context = "impact.display" and ref_key <> "NA"
					ORDER BY
					(CASE 
						WHEN ref_key = "INSIGNIFICANT" THEN 5
						WHEN ref_key = "MINOR" THEN 4
						WHEN ref_key = "MODERATE" THEN 3
						WHEN ref_key = "MAJOR" THEN 2
						WHEN ref_key = "CATASTROPHIC" THEN 1 END) ASC
			';
			 
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
		
		function get_periode(){
			
			 
			$query = $this->db->get("m_periode");
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}
			
			
		}


		function listofrisk_user($username, $periode){
			$querynya = "SELECT DISTINCT m_risk_category.`cat_name`, t_risk.`risk_status`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`, t_risk.`risk_cause`, t_risk.`risk_impact`,
(SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR ',') FROM t_risk_objective WHERE t_risk.risk_id = t_risk_objective.risk_id) AS 'Objective', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Existing Control', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Evaluation', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Owner', t_risk.`risk_impact_level`, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
(SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
FROM t_risk 
JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id` 
WHERE t_risk.`risk_input_by`='$username' and t_risk.`periode_id`='$periode' and t_risk.`risk_code` not in (select risk_code from t_risk_change where periode_id = '$periode' and risk_input_by = '$username') and t_risk.`existing_control_id` is null

UNION 

SELECT DISTINCT m_risk_category.`cat_name`, t_risk_change.`risk_status`, t_risk_change.`risk_code`, t_risk_change.`risk_event`, t_risk_change.`risk_description`, t_risk_change.`risk_owner`, t_risk_change.`risk_cause`, t_risk_change.`risk_impact`,
(SELECT GROUP_CONCAT(t_risk_objective_change.`objective` SEPARATOR ',') FROM t_risk_objective_change WHERE t_risk_change.risk_id = t_risk_objective_change.risk_id) AS 'Objective', 
(SELECT GROUP_CONCAT(t_risk_control_change.`risk_existing_control` SEPARATOR ',') FROM t_risk_control_change WHERE t_risk_change.risk_id = t_risk_control_change.risk_id) AS 'Existing Control', 
(SELECT GROUP_CONCAT(t_risk_control_change.`risk_evaluation_control` SEPARATOR ',') FROM t_risk_control_change WHERE t_risk_change.risk_id = t_risk_control_change.risk_id) AS 'Control Evaluation', 
(SELECT GROUP_CONCAT(t_risk_control_change.`risk_control_owner` SEPARATOR ',') FROM t_risk_control_change WHERE t_risk_change.risk_id = t_risk_control_change.risk_id) AS 'Control Owner', t_risk_change.`risk_impact_level`, t_risk_change.`risk_likelihood_key`,t_risk_change.`risk_level`, t_risk_change.`suggested_risk_treatment`,
(SELECT GROUP_CONCAT(t_risk_action_plan_change.`action_plan` SEPARATOR ',') FROM t_risk_action_plan_change WHERE t_risk_change.risk_id = t_risk_action_plan_change.risk_id) AS 'Action Plan',
(SELECT GROUP_CONCAT(t_risk_action_plan_change.`division` SEPARATOR ',') FROM t_risk_action_plan_change WHERE t_risk_change.risk_id = t_risk_action_plan_change.risk_id) AS 'Action Plan Owner',
(SELECT GROUP_CONCAT(t_risk_action_plan_change.`due_date` SEPARATOR ',') FROM t_risk_action_plan_change WHERE t_risk_change.risk_id = t_risk_action_plan_change.risk_id) AS 'Due Date'
FROM t_risk_change 
JOIN m_risk_category ON t_risk_change.`risk_2nd_sub_category` = m_risk_category.`cat_id` 
WHERE t_risk_change.`risk_input_by`='$username' and t_risk_change.`periode_id`='$periode' and t_risk_change.`existing_control_id` is null

UNION

SELECT DISTINCT m_risk_category.`cat_name`, t_risk.`risk_status`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`, t_risk.`risk_cause`, t_risk.`risk_impact`,
(SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR ',') FROM t_risk_objective WHERE t_risk.risk_id = t_risk_objective.risk_id) AS 'Objective', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Existing Control', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Evaluation', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Owner', t_risk.`risk_impact_level`, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
(SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
FROM t_risk 
JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id` 
WHERE t_risk.`risk_input_by`='$username' and t_risk.`risk_code` not in (select risk_code from t_risk_change where periode_id = '$periode' and risk_input_by = '$username') and t_risk.`existing_control_id` is null

UNION

SELECT DISTINCT m_risk_category.`cat_name`, t_risk.`risk_status`, t_risk.`risk_code`, t_risk.`risk_event`, t_risk.`risk_description`, t_risk.`risk_owner`, t_risk.`risk_cause`, t_risk.`risk_impact`,
(SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR ',') FROM t_risk_objective WHERE t_risk.risk_id = t_risk_objective.risk_id) AS 'Objective', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Existing Control', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Evaluation', 
(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR ',') FROM t_risk_control WHERE t_risk.risk_id = t_risk_control.risk_id) AS 'Control Owner', t_risk.`risk_impact_level`, t_risk.`risk_likelihood_key`,t_risk.`risk_level`, t_risk.`suggested_risk_treatment`,
(SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan',
(SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Action Plan Owner',
(SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR ',') FROM t_risk_action_plan WHERE t_risk.risk_id = t_risk_action_plan.risk_id) AS 'Due Date'
FROM t_risk 
JOIN m_risk_category ON t_risk.`risk_2nd_sub_category` = m_risk_category.`cat_id` 
JOIN t_risk_add_user t on t_risk.risk_id = t.risk_id
WHERE t_risk.`risk_code` not in (select risk_code from t_risk_change where periode_id = '$periode' and risk_input_by = '$username') and t_risk.`existing_control_id` is null and t.username = '$username' and t.delete_status is null
 ";

			$query = $this->db->query($querynya);
			
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}		
			
		}


		public function listofrisk_recover($periode){
			$date = date("Y-m-d");
			$sql = "select 														
																				a.risk_id,
                                                                                a.created_by,
                                                                                a.created_date,
                                                                                a.risk_input_by,
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
                                                                                m_periode.periode_name,
                                                                                (SELECT GROUP_CONCAT(t_risk_objective.`objective` SEPARATOR ' | ') FROM t_risk_objective WHERE a.risk_id = t_risk_objective.risk_id) AS 'objective', 
																				(SELECT GROUP_CONCAT(t_risk_control.`risk_existing_control` SEPARATOR ' | ') FROM t_risk_control WHERE a.risk_id = t_risk_control.risk_id) AS 'risk_existing_control', 
																				(SELECT GROUP_CONCAT(t_risk_control.`risk_evaluation_control` SEPARATOR ' | ') FROM t_risk_control WHERE a.risk_id = t_risk_control.risk_id) AS 'risk_evaluation_control', 
																				(SELECT GROUP_CONCAT(t_risk_control.`risk_control_owner` SEPARATOR ' | ') FROM t_risk_control WHERE a.risk_id = t_risk_control.risk_id) AS 'risk_control_owner', 
                                                                                (SELECT GROUP_CONCAT(t_risk_action_plan.`action_plan` SEPARATOR ' | ') FROM t_risk_action_plan WHERE a.risk_id = t_risk_action_plan.risk_id) AS 'action_plan',
                                                                                (SELECT GROUP_CONCAT(t_risk_action_plan.`due_date` SEPARATOR ' | ') FROM t_risk_action_plan WHERE a.risk_id = t_risk_action_plan.risk_id) AS 'due_date',
                                                                                 (SELECT GROUP_CONCAT(t_risk_action_plan.`division` SEPARATOR ' | ') FROM t_risk_action_plan WHERE a.risk_id = t_risk_action_plan.risk_id) AS 'division',
                                                                                IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
                                                                                from t_risk_add_user y

                                                                                join t_risk a on y.risk_id = a.risk_id
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                join m_periode on m_periode.periode_id = a.periode_id
                                                                                join t_risk_add_informasi z on y.username = z.risk_input_by
                                       
                                                                                where 
                                                                                 y.delete_status = 1
       																			 and a.periode_id < (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
                    															and z.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
                    																and z.tanggal_submit is not null";

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

		function score2($data=null){
			$querynya ="SELECT cat_code, cat_name, impact_level, likelihood_level, risk_level, impact_score, likelihood_score
						FROM t_report_2ndsub WHERE periode_id = '".$data['periode']."' and risk_level is not null GROUP BY cat_id, risk_level";
			 
			$query = $this->db->query($querynya);
			
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
?>