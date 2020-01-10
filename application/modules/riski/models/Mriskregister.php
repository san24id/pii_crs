<?php
class Mriskregister extends APP_Model {
	public function getRiskCategory($parent = 0) {
		$sql = 'select 
					cat_id as ref_key, 
					concat(cat_code, " - Category ", cat_name) as ref_value
				from m_risk_category a 
				where cat_parent = ?';
		$query = $this->db->query($sql, array('divid' => $parent));
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getUserRole($parent = 0) {
		
		if ($parent == 2){
			$sql = "select * from m_role_status where id_role_status != 4  ";
		}else{
			$sql = "select * from m_role_status where id_role_status = 4 ";
		}
		$query = $this->db->query($sql, array('divid' => $parent));
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getRiskLikelihood() {
		$sql = 'select *
				from m_likelihood order by l_id';
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getRiskImpactReference() {
		$sql = "select *
				from m_reference 
				where ref_context = 'impact.display'";
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[$row['ref_key']] = $row['ref_value'];
		}
		
		return $res;
	}

	public function getRiskReference() {
		$sql = "select *
				from m_reference 
				where ref_context = 'impact.display' and ref_key NOT LIKE 'NA'";
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getRiskImpact() {
		$sql = 'select *
				from m_risk_impact order by impact_id';
		$query = $this->db->query($sql);
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getRiskLevel($impact, $likelihood) {
		$sql = "select a.risk_level as ref_key, b.ref_value
				from m_risklevel_matrix a
				left join m_reference b on a.risk_level = b.ref_key and ref_context = 'risklevel.display'
				where a.impact_value = ? and a.likelihood_key = ?";
		$query = $this->db->query($sql, array('im' => $impact, 'lvl' => $likelihood));
		$row = $query->row_array();
		
		return $row;
	}
	
	public function getRiskLevelList() {
		$sql = "select 
				concat(impact_value, '-', likelihood_key) as ref_key, 
				risk_level as ref_value
				from m_risklevel_matrix";
				
		$query = $this->db->query($sql);
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		return $res;
	}
	
	public function getDivisionList() {
		$sql = "select 
				division_id as ref_key, 
				division_name as ref_value
				from m_division where division_name not like '%directorate%'";
				
		$query = $this->db->query($sql);
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		return $res;
	}
	
	public function getRiskImpactForList() {
		$impact_view = $this->getRiskImpactReference();
		$impact = $this->getRiskImpact();
		$res = $par_key = $par_desc = array();
		
		foreach($impact as $row) {
			$par_key[$row['impact_id']] = $row['impact_category'];
			$par_desc[$row['impact_id']] = array(
				$row['lvl_1_value'] => $impact_view[$row['lvl_1_value']].' ('.$row['lvl_1_desc'].')',
				$row['lvl_2_value'] => $impact_view[$row['lvl_2_value']].' ('.$row['lvl_2_desc'].')',
				$row['lvl_3_value'] => $impact_view[$row['lvl_3_value']].' ('.$row['lvl_3_desc'].')',
				$row['lvl_4_value'] => $impact_view[$row['lvl_4_value']].' ('.$row['lvl_4_desc'].')',
				$row['lvl_5_value'] => $impact_view[$row['lvl_5_value']].' ('.$row['lvl_5_desc'].')'
			);
		}
		
		$res['impact'] = $par_key;
		$res['impact_list'] = $par_desc;
		
		return $res;
	}
	
	public function getDataMode($mode, $defFilter, $page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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

		
				
		if ($mode == 'user') {
			$date = date("Y-m-d");
			
			$sql = "select 
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
					f.division_name as risk_owner_v
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.periode_id is not null
					and a.periode_id = ".$defFilter['periodid']."
					and a.risk_input_by = '".$defFilter['userid']."'
					and (m_periode.periode_start <= '".$date."'
					and m_periode.periode_end >= '".$date."')
					and a.existing_control_id is null
					and a.risk_library_id is null
					and a.".$filter_by." like '%".$filter_value."%'
					UNION
					select 
					a.risk_id,
                    a.risk_code,
                    g.risk_date,
                    g.risk_status,
                    g.periode_id,
                    g.risk_input_by,
                    g.risk_input_division,
                    g.risk_owner,
                    g.risk_division,
                    g.risk_library_id,
                    g.risk_event,
                    g.risk_description,
                    g.risk_category,
                    g.risk_sub_category,
                    g.risk_2nd_sub_category,
                    g.risk_cause,
                    g.risk_impact,
                                                                               
                                                                               
                    g.risk_level,
                    g.risk_impact_level,
                    g.risk_likelihood_key,
                    g.suggested_risk_treatment,
                    g.risk_treatment_owner,

                    g.created_by,
                    g.created_date,
                    g.switch_flag,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v
					from t_risk a
					join t_risk_change g on a.risk_id = g.risk_id
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 
					g.periode_id is not null
					and g.periode_id = '".$defFilter['periodid']."'
					and g.risk_input_by = '".$defFilter['userid']."'
					and (m_periode.periode_start <= '".$date."'
					and m_periode.periode_end >= '".$date."')
					and g.existing_control_id is null 
					 and g.risk_status < 3
					and g.".$filter_by." like '%".$filter_value."%'
					UNION
					select 
					a.risk_id,
                    a.risk_code,
                    a.risk_date,
                    g.risk_status,
                    a.periode_id,
                    g.risk_input_by,
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

                    g.created_by,
                    g.created_date,
                    g.switch_flag,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v
					from t_risk a
					join t_risk_change g on a.risk_id = g.risk_id
					join t_risk_add_user t on a.risk_id = t.risk_id
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 
					 g.risk_library_id is not null 
                                                                                and 
                                                                                t.risk_library_id = 1
                                                                                and g.existing_control_id is null
                                                                                and
                                                                                a.periode_id IN (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."' and g.risk_input_by = '".$defFilter['userid']."' and g.risk_status > 2
					and a.".$filter_by." like '%".$filter_value."%'
					";
		}
		
		if ($mode == 'userRollover') {
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
                                                                                a.risk_input_by,
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
                                                                                a.periode_id IN ((select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)-1)
                                                                                and y.delete_status is null
                                                                                and y.username = '".$defFilter['userid']."'
                                                                                
                                                                                and ".$filter_by." like '%".$filter_value."%'


                                                                                ";
					
		}
//ubah
		if ($mode == 'userRollover_recover') {
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
                                                                                join t_risk_add_informasi z on y.username = z.risk_input_by
                                                                                where 
                                                                                 y.delete_status = 1
       																			 and a.periode_id < (select MAX(periode_id) from m_periode)
                    															and z.periode_id = (select MAX(periode_id) from m_periode)
                    																and z.tanggal_submit is not null
                                                                                
                                                                                and ".$filter_by." like '%".$filter_value."%'
					
					";
					
		}
//user dari roll forward
		if ($mode == 'userRollover_recover_user') {
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
                                                                                a.risk_input_by,
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
                                                                                a.periode_id IN ((select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)-1)
                                                                                and y.delete_status = 1
                                                                                and y.username = '".$defFilter['userid']."'
                                                                                
                                                                                and ".$filter_by." like '%".$filter_value."%'
					
					 
					";
					
		}
//ini untuk recover modify delete
		if ($mode == 'userRollover_recover_modify') {
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
					a.risk_input_by,
					a.risk_input_division,
					a.risk_level,
					a.risk_library_id,
					a.risk_likelihood_key,
					a.risk_owner,
					a.risk_sub_category,
					a.risk_treatment_owner,
					a.suggested_risk_treatment,
					a.switch_flag,
					a.risk_status as ex,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					m_periode.periode_end,
					f.division_name as risk_owner_v,
					IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
					from t_risk_change a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id = 2 and a.risk_status <= 2 and a.risk_input_by = '".$defFilter['userid']."'
					 and a.".$filter_by." like '%".$filter_value."%'
				UNION
				select 
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
					a.risk_input_by,
					a.risk_input_division,
					a.risk_level,
					a.risk_library_id,
					a.risk_likelihood_key,
					a.risk_owner,
					a.risk_sub_category,
					a.risk_treatment_owner,
					a.suggested_risk_treatment,
					a.switch_flag,
					a.risk_status as ex,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					m_periode.periode_end,
					f.division_name as risk_owner_v,
					IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id = 2 and a.risk_status <= 2 and a.risk_input_by = '".$defFilter['userid']."'
					 and a.".$filter_by." like '%".$filter_value."%'
					";
		}

//ini untuk recover modify delete rac status > 1
		if ($mode == 'userRollover_recover_modify_rac') {
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
					a.risk_input_by,
					a.risk_input_division,
					a.risk_level,
					a.risk_library_id,
					a.risk_likelihood_key,
					a.risk_owner,
					a.risk_sub_category,
					a.risk_treatment_owner,
					a.suggested_risk_treatment,
					a.switch_flag,
					a.risk_status as ex,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					m_periode.periode_end,
					f.division_name as risk_owner_v,
					IF(m_periode.periode_end <= '".$date."', '0', a.risk_status) AS risk_status 
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id = 3

					and a.".$filter_by." like '%".$filter_value."%'";
					
		}
//ubah maintenance
		if ($mode == 'userRollover_under') {
			$date = date("Y-m-d");
			$sql = "select * from(
select 
                                                                                a.created_by,
                                                                                a.created_date,
                                                                                a.existing_control_id,
                                                                                a.risk_status,
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
                                                                                a.risk_input_by,
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
                                                                                (SELECT GROUP_CONCAT(concat('AP.', LPAD(c.id, 6, '0')) separator ' | ') from t_risk_action_plan b, m_action_plan c where a.risk_id = b.risk_id and b.action_plan = c.action_plan and b.division = c.division) as ap_id
                                                                                from t_risk a
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and a.risk_status > 1 and a.existing_control_id is null and a.risk_existing_control is null
                                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                                order by a.periode_id desc
) as libraryrisk
group by libraryrisk.risk_code
";
					
		}

		//ubah maintenance2
		if ($mode == 'userRollover_under2') {
			$date = date("Y-m-d");
			$sql = "select 
					a.created_by,
					a.created_date,
					a.existing_control_id,
					a.risk_status,
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
					a.risk_input_by,
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
					(SELECT GROUP_CONCAT(concat('AP.', LPAD(c.id, 6, '0')) separator ' | ') from t_risk_action_plan b, m_action_plan c where a.risk_id = b.risk_id and b.action_plan = c.action_plan and b.division = c.division) as ap_id
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id is null 
					and a.risk_existing_control = 'under'
					and a.".$filter_by." like '%".$filter_value."%'
					
					 
					";
					
		}
		
		$sql = $sql.$ex_filter.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
		return $res;
	}
	
	public function getDataById($id)
	{
		$sql = "select 
				a.*
				from t_risk a where risk_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function insertRiskRegister($risk, $suggested_rt, $code, $impact, $actplan, $control, $objective)
	{
		$sql = "INSERT INTO `t_risk` (
				`risk_code`, `risk_date`, 
				`risk_status`, `periode_id`, 
				`risk_input_by`, `risk_input_division`, `risk_owner`, `risk_division`, 
				`risk_library_id`, `risk_event`, `risk_description`, `risk_category`, 
				`risk_sub_category`, `risk_2nd_sub_category`, `risk_cause`, `risk_impact`, 
				`risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, 
				`created_by`, `created_date`)
		VALUES (
			?, NOW(),
			?,?,
			?,?,?,?,
			?,?,?,?,
			?,?,?,?,
			?,?,?,?,
			?, NOW() );
		";
		$res = $this->db->query($sql, $risk);
		if ($res) {
			$rid = $this->db->insert_id();
			// update risk code
			/*
			$code = $code.'-'.$rid;
			$sql = 'update t_risk set risk_code = ? where risk_id = ?';
			$res2 = $this->db->query($sql, array('rc' => $code, 'rid' => $rid));
			*/
			
			// insert impact
			$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $rid,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan

			if($suggested_rt == 'ACCEPT'){


			}else{
					$sql = "insert into t_risk_action_plan(risk_id, action_plan_status, action_plan, due_date, division) 
						values(?, 0, ?, ?, ?)";
					foreach ($actplan as $key => $value) {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'rid' => $rid,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
						);
						$res4 = $this->db->query($sql, $par);
					}
			}
			// insert control
			$sql = "insert into t_risk_control(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner) 
					values(?, ?, ?, ?, ?)";
			foreach ($control as $key => $value) {
				$ecid = $value['existing_control_id'];
				if ($value['existing_control_id'] == '') $ecid = null;
				$par = array(
					'rid' => $rid,
					'ap' => $ecid,
					'dd' => $value['risk_existing_control'],
					'div1' => $value['risk_evaluation_control'],
					'div2' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}

			//insert objective
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $rid,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}


			return $rid;
		} else {
			return false;
		}
		
		return $res;
	}

	public function insertRiskRegister2($risk, $suggested_rt, $code, $impact, $actplan, $control, $objective)
	{
	/*
	$sql_cek = "select risk_code,periode_id from t_risk where risk_code='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."' ";
	$query_cek = $this->db->query($sql_cek);
	if ($query_cek->num_rows() == 0){
		//cek risk_id terakhir
		$input = $risk['risk_input_by'];
		$sql2 = "select risk_id from t_risk where risk_input_by = '$input' order by risk_id DESC LIMIT 1";
		$query2 = $this->db->query($sql2);
		$row = $query2->row();
		$rid = $row->risk_id;
	}else{
		$sql2 = "select risk_id from t_risk_change order by risk_id DESC LIMIT 1";
		$query2 = $this->db->query($sql2);
		$row = $query2->row();
		$rid1 = $row->risk_id;
		$rid = $rid1+1;
	}
	*/
		$sql = "INSERT INTO `t_risk_change` (
				`risk_code`, `risk_date`, 
				`risk_status`, `periode_id`, 
				`risk_input_by`, `risk_input_division`, `risk_owner`, `risk_division`, 
				`risk_library_id`, `risk_event`, `risk_description`, `risk_category`, 
				`risk_sub_category`, `risk_2nd_sub_category`, `risk_cause`, `risk_impact`, 
				`risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, 
				`created_by`, `created_date`)
		VALUES (
			?, NOW(),
			?,?,
			?,?,?,?,
			?,?,?,?,
			?,?,?,?,
			?,?,?,?,
			?, NOW() );
		";
		$res = $this->db->query($sql, $risk);

		$sql = "update t_risk_change set risk_id = (select risk_id from t_risk where risk_code ='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."') where risk_id = 0";
		$res11= $this->db->query($sql);

		if ($res) {
		//	$rid = $this->db->insert_id();
			// update risk code
			/*
			$code = $code.'-'.$rid;
			$sql = 'update t_risk set risk_code = ? where risk_id = ?';
			$res2 = $this->db->query($sql, array('rc' => $code, 'rid' => $rid));
			*/
			
			// insert impact
			$sql = "insert into t_risk_impact_change(risk_id, impact_id, impact_level, switch_flag) values((select risk_id from t_risk where risk_code ='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."'), ?, ?, ?)";
			foreach ($impact as $key => $value) {
				$par = array(
					//'rid' => $rid,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level'],
					'rib' => $risk['risk_input_by']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert control
			$sql = "insert into t_risk_control_change(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner, switch_flag) 
					values((select risk_id from t_risk where risk_code ='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."'), ?, ?, ?, ?, ?)";
			foreach ($control as $key => $value) {
				$ecid = $value['existing_control_id'];
				if ($value['existing_control_id'] == '') $ecid = null;
				$par = array(
					//'rid' => $rid,
					'ap' => $ecid,
					'dd' => $value['risk_existing_control'],
					'div1' => $value['risk_evaluation_control'],
					'div2' => $value['risk_control_owner'],
					'rib' => $risk['risk_input_by']
				);
				$res5 = $this->db->query($sql, $par);
			}

			// insert Object change
			$sql = "insert into t_risk_objective_change(risk_id, objective, switch_flag) 
					values((select risk_id from t_risk where risk_code ='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."'), ?, ?)";
			foreach ($objective as $key => $value) {
				$par = array(
					//'rid' => $rid,
					'ap' => $value['objective'],
					'rib' => $risk['risk_input_by']
				);
				$res6 = $this->db->query($sql, $par);
			}

			// insert action plan
			if($suggested_rt == 'ACCEPT'){


			}else{
			$sql = "insert into t_risk_action_plan_change(risk_id, action_plan_status, action_plan, due_date, division, switch_flag) 
					values((select risk_id from t_risk where risk_code ='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."'), 0, ?, ?, ?, ?)";
			foreach ($actplan as $key => $value) {
				$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
				$par = array(
					//'rid' => $rid,
					'ap' => $value['action_plan'],
					'dd' => $dd,
					'div' => $value['division'],
					'rib' => $risk['risk_input_by']
				);
				$res4 = $this->db->query($sql, $par);
			}
			}

			//return $rid;
		} else {
			return false;
		}
		
		return $res;
	}
	
	
	public function insertRiskRegisterLibrary($risk, $suggested_rt, $code, $impact, $actplan, $control, $objective)
	{

	$sql_cek = "select risk_code,periode_id from t_risk where risk_code='".$risk['risk_code']."' and periode_id ='".$risk['periode_id']."' ";
	$query_cek = $this->db->query($sql_cek);
	if ($query_cek->num_rows() == 0){
		$rid2 = 1;
		if ($rid2 == 1) {

		//cek risk_input_by
		$sql_user = "select risk_input_by,risk_input_division from t_risk where risk_id = '".$risk['risk_library_id']."' ";
		$query_user = $this->db->query($sql_user);
		$row_user = $query_user->row();
		$hasil_user = $row_user->risk_input_by;
		$hasil_divisi = $row_user->risk_input_division;


			//$par = array('rid'=>$rid);
			
			//$sql = "select * from t_risk where risk_id = ? ";
			//$query = $this->db->query($sql,$par);
			//$new_risk = $query->row_array();
			
			$lib_par = array('rid' => $risk['risk_library_id']);
			$sql = "insert into t_risk (risk_code, risk_date, 
				risk_status, periode_id, 
				risk_input_by, risk_input_division, risk_owner, risk_division, 
				risk_library_id, risk_event, risk_description, risk_category, 
				risk_sub_category, risk_2nd_sub_category, risk_cause, risk_impact, 
				risk_level, risk_impact_level, risk_likelihood_key, suggested_risk_treatment, 
				created_by, created_date)
				
					select 
					'".$risk['risk_code']."' as risk_code,
					NOW() as risk_date,
					'".$risk['risk_status']."' as risk_status,
					'".$risk['periode_id']."' as periode_id,
					'".$hasil_user."' as risk_input_by,
					'".$hasil_divisi."' as risk_input_division,
					risk_owner,
					risk_division,
					".$risk['risk_library_id']." as risk_library_id,
					risk_event,
					risk_description,
					risk_category,
					risk_sub_category,
					risk_2nd_sub_category,
					risk_cause,
					risk_impact,
					risk_level,
					risk_impact_level,
					risk_likelihood_key,
					suggested_risk_treatment,
					created_by,
					NOW() as created_date
					from t_risk where risk_id = ? ";
			$res = $this->db->query($sql, $lib_par);

		$rid = $this->insertRiskRegister2($risk, $suggested_rt, $code, $impact, $actplan, $control, $objective);

		//cek risk_id terakhir
		$input = $risk['risk_input_by'];
		$sql2 = "select risk_id from t_risk where risk_input_by = '".$hasil_user."' order by risk_id DESC LIMIT 1";
		$query2 = $this->db->query($sql2);
		$row = $query2->row();
		$hasil = $row->risk_id;
		

			// insert impact
			$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) 
					select 
					".$hasil." as risk_id,impact_id, impact_level
					from t_risk_impact
					where risk_id = ?";
			$res = $this->db->query($sql, $lib_par);
			
			// insert action plan
					$sql = "insert into t_risk_action_plan(risk_id,action_plan_status, action_plan, due_date, division) 
							select 
					
							".$hasil." as risk_id, 0 as action_plan_status, action_plan, due_date, division
							from t_risk_action_plan
							where risk_id = ?";
							$res = $this->db->query($sql, $lib_par);
				
			// insert control
			$sql = "insert into t_risk_control(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner) 
					select 
					".$hasil." as risk_id,
					existing_control_id, risk_existing_control, 
					risk_evaluation_control, risk_control_owner
					from t_risk_control
					where risk_id = ?";
			$res = $this->db->query($sql, $lib_par);

			// insert action objective
			$sql = "insert into t_risk_objective(risk_id,objective) 
					select 
					".$hasil." as risk_id, objective
					from t_risk_objective
					where risk_id = ?";
			$res = $this->db->query($sql, $lib_par);

			return true;
		} else {
			return false;
		}
		return false;
		}else{

		$rid = $this->insertRiskRegister2($risk, $suggested_rt, $code, $impact, $actplan, $control, $objective);
		return true;
		}
	}


	public function time_compare($risk_id){
	$sql = "select created_date from t_risk where risk_id = '".$risk_id."' ";
	$query = $this->db->query($sql);
	$row = $query->row();
	return $row;
	}

	
	function cek_risk_compare($risk_id, $time_compare){
	
	$sql = "select created_date from t_risk where risk_id = '".$risk_id."' and created_date = '".$time_compare."' ";
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}	
	}
}