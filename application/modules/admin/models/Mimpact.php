<?php
class Mimpact extends APP_Model {
	public function getData($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by a.'.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where a.'.$filter_by.' like ? ';
			$par['p1'] = '% a.'.$filter_value.'%';
		}
		
		$sql = "SELECT a.*, CONCAT(LEFT(a.`lvl_1_value`, 1), LCASE(SUBSTRING(a.`lvl_1_value`,2))) AS 'lvl_1',CONCAT(LEFT(a.`lvl_2_value`, 1), LCASE(SUBSTRING(a.`lvl_2_value`,2))) AS 'lvl_2', 
CONCAT(LEFT(a.`lvl_3_value`, 1), LCASE(SUBSTRING(a.`lvl_3_value`,2))) AS 'lvl_3', CONCAT(LEFT(a.`lvl_4_value`, 1), LCASE(SUBSTRING(a.`lvl_4_value`,2))) AS 'lvl_4', CONCAT(LEFT(a.`lvl_5_value`, 1), LCASE(SUBSTRING(a.`lvl_5_value`,2))) AS 'lvl_5'
FROM m_risk_impact a";
		$res = $this->getPagingData($sql, $par, $page, $row, 'impact_id', true);
		return $res;
	}
	

	public function impact_update($data){

            $sql = " 
           UPDATE `m_risk_impact` SET `impact_category`='".$data['impact_category']."',`lvl_1_value`='".$data['level_1']."',`lvl_1_desc`='".$data['level_1_desc']."',`lvl_2_value`='".$data['level_2']."',`lvl_2_desc`='".$data['level_2_desc']."',`lvl_3_value`='".$data['level_3']."',`lvl_3_desc`='".$data['level_3_desc']."',`lvl_4_value`='".$data['level_4']."',`lvl_4_desc`='".$data['level_4_desc']."',`lvl_5_value`='".$data['level_5']."',`lvl_5_desc`='".$data['level_5_desc']."' WHERE `impact_id`='".$data['impact_id']."'";

      
        $res = $this->db->query($sql);
        return $res;
    
    }

    public function impact_insert($data){

            $sql = " 
           INSERT INTO `m_risk_impact`(`impact_category`, `lvl_1_value`, `lvl_1_desc`, `lvl_2_value`, `lvl_2_desc`, `lvl_3_value`, `lvl_3_desc`, `lvl_4_value`, `lvl_4_desc`, `lvl_5_value`, `lvl_5_desc`) VALUES ('".$data['impact_category']."','".$data['level_1']."','".$data['level_1_desc']."','".$data['level_2']."','".$data['level_2_desc']."','".$data['level_3']."','".$data['level_3_desc']."','".$data['level_4']."','".$data['level_4_desc']."','".$data['level_5']."','".$data['level_5_desc']."')";

      
        $res = $this->db->query($sql);
        return $res;
    
    }

    public function impact_update_status($status_impact){

            $sql = " 
           UPDATE `m_risk_impact` SET status_impact = 1 WHERE `impact_id`='".$status_impact."'";

      
        $res = $this->db->query($sql);
        return $res;
    
    }

	public function impact_update_show($status_impact){

            $sql = " 
           UPDATE `m_risk_impact` SET status_impact = 0 WHERE `impact_id`='".$status_impact."'";

      
        $res = $this->db->query($sql);
        return $res;
    
    }

    public function getDataLike($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '% '.$filter_value.'%';
		}
		
		$sql = "SELECT * FROM `m_likelihood`";
		$res = $this->getPagingData($sql, $par, $page, $row, 'l_id', true);
		return $res;
	}

	public function likelihood_update($data){

			$sql = "UPDATE m_risklevel_matrix SET likelihood_key = UCASE('".$data['l_title']."') WHERE likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE ch_risk SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_risk SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_risk_change SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_change SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_own SET risk_likelihood_key = UCASE('".$data['l_title']."') WHERE risk_likelihood_key = '".$data['l_key']."'";
			$res = $this->db->query($sql);

            $sql = "UPDATE `m_likelihood` SET l_key = UCASE('".$data['l_title']."'), l_title = CONCAT(LEFT('".$data['l_title']."', 1), LCASE(SUBSTRING('".$data['l_title']."',2))), `l_desc`='".$data['l_desc']."' WHERE `l_id`='".$data['l_id']."'";
			$res = $this->db->query($sql);

        return $res;
    
    }

    public function getDataRriskLevel($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '% '.$filter_value.'%';
		}
		
		$sql = "SELECT a.*, CONCAT(LEFT(a.`impact_value`, 1), LCASE(SUBSTRING(a.`impact_value`,2))) AS 'v_impact',CONCAT(LEFT(a.`likelihood_key`, 1), LCASE(SUBSTRING(a.`likelihood_key`,2))) AS 'v_likelihood', CONCAT(LEFT(a.`risk_level`, 1), LCASE(SUBSTRING(a.`risk_level`,2))) AS 'v_risk_level' FROM `m_risklevel_matrix` a";
		$res = $this->getPagingData($sql, $par, $page, $row, 'impact_value', true);
		return $res;
	}

	public function getLevelImpact($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by != null && $filter_value != null) {
			$ex_filter = ' where '.$filter_by.' like ? ';
			$par['p1'] = '% '.$filter_value.'%';
		}
		
		$sql = "select a.*, CONCAT(LEFT(a.`name_level`, 1), LCASE(SUBSTRING(a.`name_level`,2))) AS 'level_name'
				from m_risklevel_name a where a.type ='impact_level'";
		$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
		
		return $res;
	}
	
	public function levelname_edit($data){


			$sql = "UPDATE ch_risk SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE ch_risk_impact SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_change SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_own SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_impact SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_impact_change SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_risk_impact_own SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_risk SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_risk_change SET risk_impact_level = UCASE('".$data['level_name']."') WHERE risk_impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_impact SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE t_cr_impact_change SET impact_level = UCASE('".$data['level_name']."') WHERE impact_level = '".$data['name_level']."'";
			$res = $this->db->query($sql);

			$sql = "UPDATE m_risklevel_matrix SET impact_value = UCASE('".$data['level_name']."') WHERE impact_value = '".$data['name_level']."'";
			$res = $this->db->query($sql);

            $sql = "UPDATE m_impact_level SET level_impact = UCASE('".$data['level_name']."') WHERE level_impact = '".$data['name_level']."'";
            $res = $this->db->query($sql);

			$sql = "UPDATE m_reference SET ref_key = UCASE('".$data['level_name']."'), ref_value = CONCAT(LEFT('".$data['level_name']."', 1), LCASE(SUBSTRING('".$data['level_name']."',2))) WHERE ref_context = 'impact.display' and ref_key = '".$data['name_level']."'";
			$res = $this->db->query($sql);

            $sql = "UPDATE m_risk_impact SET ".$data['level_id']." = UCASE('".$data['level_name']."')";
			$res = $this->db->query($sql);

			$sql = "UPDATE m_risklevel_name SET name_level = UCASE('".$data['level_name']."') WHERE level = '".$data['level_id']."' and type = 'impact_level'";
			$res = $this->db->query($sql);

        return $res;
    }

    public function getListRisk($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null, $id_impact)
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


         if($filter_by == 'risk_status'){
            if($filter_value == 'draft'){
                $filtered1 = 'and a.risk_status IN (0,1)';
                $filtered2 = 'and b.risk_status IN (0,1)';
            }else if($filter_value == 'submitted'){
                $filtered1 = 'and a.risk_status IN (2)';
                $filtered2 = 'and b.risk_status IN (2)';
            }else if($filter_value == 'verify'){
                $filtered1 = 'and a.risk_status IN (99)';
                $filtered2 = 'and b.risk_status IN (99)';
            }else if($filter_value == 'treatment'){
                $filtered1 = 'and a.risk_status IN (3,4,5)';
                $filtered2 = 'and b.risk_status IN (3,4,5)';
            }else if($filter_value == 'action_plan'){
                $filtered1 = 'and a.risk_status IN (6)';
                $filtered2 = 'and b.risk_status IN (6)';
            }else if($filter_value == 'action_plan_execution'){
                $filtered1 = 'and a.risk_status IN (10)';
                $filtered2 = 'and b.risk_status IN (10)';
            }else if($filter_value == 'verified_final'){
                $filtered1 = 'and a.risk_status IN (20)';
                $filtered2 = 'and b.risk_status IN (20)';
            }else if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }
        }else if($filter_by == '' || $filter_by == 'risk_impact_level' || $filter_by == 'risk_likelihood_key' || $filter_by == 'risk_owner' || $filter_by == 'risk_level_after_mitigation' || $filter_by == 'risk_impact_level_after_mitigation' || $filter_by == 'risk_likelihood_key_after_mitigation'){
            if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }else{
                $filtered1 = "and a.".$filter_by."  like '".$filter_value."'";
                $filtered2 = "and b.".$filter_by."  like '".$filter_value."'";
            }
        } else{
            if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }else{
                $filtered1 = "and a.".$filter_by."  like '%".$filter_value."%'";
                $filtered2 = "and b.".$filter_by."  like '%".$filter_value."%'";
            }
        }

       
         //$_SESSION['filterby'] = $filter_by;


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
                                                                'PRIMARY' as type
                                                                from t_risk a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and y.impact_id = '".$id_impact."'
                                                                ".$filtered1."
                                                                UNION
                                                                select 
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
                                                                'CHANGES' as type
                                                                from t_risk_change a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact_change y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where a.risk_status >= 0 and a.risk_status < 3 and a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and y.impact_id = '".$id_impact."'
                                                                ".$filtered1."
                                                                                                                                UNION
                                                                select 
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
                                                                'OWNER' as type
                                                                from t_risk_own a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact_own y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where a.risk_status > 2 and a.risk_status < 7 and a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and y.impact_id = '".$id_impact."'
                                                                ".$filtered1."
                "
                .$ex_filter
                
                .$ex_or;
        $res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
        return $res;
    }

     public function getLikelihoodRisk($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null, $id_likelihood)
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


         if($filter_by == 'risk_status'){
            if($filter_value == 'draft'){
                $filtered1 = 'and g.risk_status IN (0,1)';
                $filtered2 = 'and a.risk_status IN (0,1)';
            }else if($filter_value == 'submitted'){
                $filtered1 = 'and g.risk_status IN (2)';
                $filtered2 = 'and a.risk_status IN (2)';
            }else if($filter_value == 'verify'){
                $filtered1 = 'and a.risk_status IN (99)';
                $filtered2 = 'and b.risk_status IN (99)';
            }else if($filter_value == 'treatment'){
                $filtered1 = 'and g.risk_status IN (3,4,5)';
                $filtered2 = 'and a.risk_status IN (3,4,5)';
            }else if($filter_value == 'action_plan'){
                $filtered1 = 'and g.risk_status IN (6)';
                $filtered2 = 'and a.risk_status IN (6)';
            }else if($filter_value == 'action_plan_execution'){
                $filtered1 = 'and g.risk_status IN (10)';
                $filtered2 = 'and a.risk_status IN (10)';
            }else if($filter_value == 'verified_final'){
                $filtered1 = 'and g.risk_status IN (20)';
                $filtered2 = 'and a.risk_status IN (20)';
            }else if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }
        }else if($filter_by == '' || $filter_by == 'risk_impact_level' || $filter_by == 'risk_likelihood_key' || $filter_by == 'risk_owner' || $filter_by == 'risk_level_after_mitigation' || $filter_by == 'risk_impact_level_after_mitigation' || $filter_by == 'risk_likelihood_key_after_mitigation'){
            if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }else{
                $filtered1 = "and g.".$filter_by."  like '".$filter_value."'";
                $filtered2 = "and a.".$filter_by."  like '".$filter_value."'";
            }
        } else{
            if($filter_value == ''){
                $filtered1 = '';
                $filtered2 = '';
            }else{
                $filtered1 = "and g.".$filter_by."  like '%".$filter_value."%'";
                $filtered2 = "and a.".$filter_by."  like '%".$filter_value."%'";
            }
        }

       
         //$_SESSION['filterby'] = $filter_by;


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
                                                                'PRIMARY' as type
                                                                from t_risk a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and e.l_id = '".$id_likelihood."'
                                                                ".$filtered2."
                                                                UNION

                                                                select 
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
                                                                'CHANGES' as type
                                                                from t_risk_change a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact_change y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where a.risk_status >= 0 and a.risk_status < 3 and a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and e.l_id = '".$id_likelihood."'
                                                                ".$filtered2."
                                                                UNION
                                                                select 
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
                                                                'OWNER' as type
                                                                from t_risk_own a 
                                                               
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                left join m_reference i on a.risk_level_after_mitigation  = i.ref_key and i.ref_context = 'risklevel.display'
                                                                left join m_reference j on a.risk_impact_level_after_mitigation  = j.ref_key and j.ref_context = 'impact.display'
                                                                left join m_likelihood k on a.risk_likelihood_key_after_mitigation = k.l_key
                                                                join t_risk_impact_own y on a.risk_id = y.risk_id and a.risk_impact_level = y.impact_level
                                                                where a.risk_status > 2 and a.risk_status < 7 and a.periode_id IN (select max(periode_id) from m_periode) and a.existing_control_id is null and e.l_id = '".$id_likelihood."'
                                                                ".$filtered2."

                "
                .$ex_filter
                
                .$ex_or;
        $res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
        return $res;
    }
}