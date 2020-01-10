<?php
class Risk extends APP_Model {

	//-------------------------chart query RAC-------------------------------
	//risk / tab 1
    public function report(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, `risk_level` FROM t_risk
WHERE periode_id= (SELECT MAX(periode_id) FROM `m_periode`)
AND risk_existing_control IS NULL GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) asc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

//risk register tab 2
    public function report2(){
        $query = $this->db->query("SELECT COUNT(`risk_status`) AS numcount, risk_status,
CASE WHEN `risk_status` = 2 THEN 'User'
                ELSE 'User'
                END AS riskstatus
 FROM t_risk
WHERE periode_id= (SELECT MAX(periode_id) FROM t_risk)
AND risk_existing_control IS NULL AND risk_status='2'


                    ");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


    public function report3(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount, risk_level


                    FROM t_risk
                    WHERE risk_status = 5
    ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) DESC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function report4(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN `action_plan_status` = '0' THEN 'Action Plan'
       
        ELSE 'Action Plan'
    END) AS actionplan
                    FROM 
                    t_risk_action_plan
                    WHERE action_plan_status = 3
                    
");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


    public function report5(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN kri_status = '0' THEN 'KRI'
       
        ELSE 'KRI'
    END) AS kri 
                    FROM 
                    t_kri
                    WHERE 
                    kri_status = 2");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

 public function report6(){
        $query = $this->db->query("
                    
SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN cr_status = '0' THEN 'Change Request'
       
        ELSE 'Change Request'
    END) AS changerequest  

                    FROM 
                    t_cr_risk
                    WHERE 
                    cr_status = 0");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

// execution
 public function report7(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount,
                (
    CASE 
        WHEN action_plan_status = '0' THEN 'Action Plan Execution'
       
        ELSE 'Action Plan Execution'
    END) AS execution
                    FROM 
                    t_risk_action_plan
                    WHERE action_plan_status = 6");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

 public function report8(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, `risk_level` FROM t_risk
WHERE periode_id= (SELECT MAX(periode_id) FROM `m_periode`)-1
AND risk_existing_control IS NULL GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) ASC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

//===========================end chart query RAC-------------------------------------

//-------------------------chart query PIC-------------------------------
    //risk / tab 1
  
    public function report_PIC(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, `risk_level` FROM t_risk 
WHERE periode_id= (SELECT MAX(periode_id) FROM m_periode)
AND risk_existing_control IS NULL AND  risk_input_by IN (SELECT username FROM m_user WHERE role_id ='4' AND username='h.donny') GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) asc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
  public function reportpriorPIC(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, `risk_level` FROM t_risk 
WHERE periode_id= (SELECT MAX(periode_id) FROM m_periode)-1
AND risk_existing_control IS NULL AND  risk_input_by IN (SELECT username FROM m_user WHERE role_id ='4' AND username='h.donny') GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) asc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

//risk register tab 2
    public function report2PIC(){
        $query = $this->db->query("SELECT COUNT(`risk_status`) AS numcount, risk_status,
CASE WHEN `risk_status` = 2 THEN 'User'
                ELSE 'User'
                END AS riskstatus
 FROM t_risk
WHERE periode_id= (SELECT MAX(periode_id) FROM t_risk)
AND risk_existing_control IS NULL AND risk_status='2' AND `risk_input_by`='h.donny'
                    ");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


    public function report3PIC(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, `risk_level` FROM t_risk 
WHERE periode_id= (SELECT MAX(periode_id) FROM m_periode)
AND risk_existing_control IS NULL AND  risk_input_by IN (SELECT username FROM m_user WHERE role_id ='4' AND username='h.donny') GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) asc");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function report4PIC(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN `action_plan_status` = '0' THEN 'Action Plan'
       
        ELSE 'Action Plan'
    END) AS actionplan 
                    FROM 
                    t_risk_action_plan
                    WHERE action_plan_status = 3 AND `assigned_to`='h.donny'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

 public function reportexecutionPIC(){
        $query = $this->db->query("SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN `action_plan_status` = '0' THEN 'Execution'
       
        ELSE 'Execution'
    END) AS actionplan 
                    FROM 
                    t_risk_action_plan
                    WHERE action_plan_status = 3 AND `assigned_to`='h.donny'");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function report5PIC(){
        $query = $this->db->query("SELECT *,COUNT(1) AS numcount, b.risk_level 
                    FROM 
                    t_kri a JOIN t_risk b ON a.risk_id = b.risk_id
                    WHERE 
                    a.kri_status > 2 AND risk_input_by='h.donny'
                    GROUP BY b.risk_level
ORDER BY
 (CASE 
                        WHEN b.risk_level = 'HIGH' THEN 3
                        WHEN b.risk_level = 'MODERATE' THEN 2
                        WHEN b.risk_level = 'LOW' THEN 1 END) ASC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


 public function report6PIC(){
        $query = $this->db->query("
SELECT COUNT(1) AS numcount,
(
    CASE 
        WHEN cr_status = '0' THEN 'Change Request'
       
        ELSE 'Change Request'
    END) AS changerequest  

                    FROM 
                    t_cr_risk
                    WHERE 
                    cr_status = 0
");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


  
//-----------end------------------------

// ----------------chart USER -----------------------------------
    //risk / tab 1
    public function reportUser(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, risk_level FROM t_risk 
WHERE periode_id= (SELECT MAX(periode_id) FROM m_periode)
AND risk_existing_control IS NULL AND  risk_input_by IN (SELECT username FROM m_user WHERE role_id ='3' AND username='a.dori') GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) ASC");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

//risk register tab 2
    public function reportPriorUser(){
        $query = $this->db->query("SELECT COUNT(`risk_level`) AS numcount, risk_level FROM t_risk 
WHERE periode_id= (SELECT MAX(periode_id) FROM m_periode)-1
AND risk_existing_control IS NULL AND  risk_input_by IN (SELECT username FROM m_user WHERE role_id ='3' AND username='a.dori') GROUP BY risk_level 
ORDER BY 
          (CASE 
                        WHEN risk_level = 'HIGH' THEN 3
                        WHEN risk_level = 'MODERATE' THEN 2
                        WHEN risk_level = 'LOW' THEN 1 END) ASC
                    ");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }


   
  
//-----------end------------------------
	//cek change request blum di baca

	/* RISK QUERIES FUNCTION */
	public function getRiskByIdNoRef($risk_id) 
	{
		$sql = "select 
				a.*,
				l.display_name as risk_input_by_v
				from t_risk a 
				left join m_user l on a.risk_input_by = l.username
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}

/*	public function report(){
        $query = $this->db->query("select count(1) as numcount, risk_level 
					from t_risk
					where risk_status in (3)
					group by risk_level");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }*/

	//cek change request blum di baca

	public function cekChangeRequest()
	{
		return $this->db->where('cr_status','0')
						->get('t_cr_risk')
						->num_rows();
	}

	//cek change request blum Complete

	public function cekChangeRequestComplete($username)
	{
		return $this->db->where('cr_status','0')
						->where('created_by',$username)
						->get('t_cr_risk')
						->num_rows();
	}

	//cek libarary dari changes
	public function getRiskByIdNoRefChanges($risk_id, $user_by) 
	{
		$sql = "select 
				a.*,
				l.display_name as risk_input_by_v
				from t_risk_change a 
				left join m_user l on a.risk_input_by = l.username
				where a.risk_id = ? and risk_input_by='".$user_by."' ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}

	public function cekRiskList()
	{
	 	$sql = "select * from (select 
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
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id = (select max(periode_id) from m_periode) and g.risk_status = 2 and g.existing_control_id is null
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another
                                                                group by another.risk_code

                                                                UNION
                                                                select * from (select 
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
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id = (select max(periode_id) from m_periode) and a.risk_status = 2 and a.existing_control_id is null
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another
                                                                group by another.risk_code





				";

			$query = $this->db->query($sql);
			return $query->num_rows();
	}


	public function cekRegisterList()
	{
		$sql = "select * from(select * from(SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note from m_user a 
join m_division b on a.division_id = b.division_id 
join t_risk_add_informasi c on a.username = c.risk_input_by 
left join ( select min(risk_status) as risk_status, risk_input_by, periode_id from t_risk_change where risk_status > 1 and existing_control_id is null group by risk_input_by) e on a.username = e.risk_input_by  
where c.periode_id = (select max(periode_id) from m_periode) and e.risk_status is not null and e.risk_status = 2
UNION
SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note 
from m_user a 
join m_division b on a.division_id = b.division_id 
join t_risk_add_informasi c on a.username = c.risk_input_by 
left join ( select min(risk_status) as risk_status, risk_input_by, periode_id from t_risk where risk_status > 1 and existing_control_id is null group by risk_input_by) e on a.username = e.risk_input_by  
where c.periode_id = (select max(periode_id) from m_periode) and e.risk_status is not null and e.risk_status = 2
) coba2 order by coba2.risk_status asc
) coba group by coba.username
";

		$query = $this->db->query($sql);
		return $query->num_rows();

	}

	public function treatmentlist()
	{
		return $this->db->where('risk_status','5')
						->get('t_risk')
						->num_rows();
	}

	
	public function getRiskById($risk_id) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpact($risk_id);
			$row['action_plan_list'] = $this->getActionPlan($risk_id);
			$row['control_list'] = $this->getControlList($risk_id);
			$row['objective_list'] = $this->getObjectiveList($risk_id);
		}
		
		return $row;
	}


		public function getRiskByIdprimary_c($risk_id, $uid) 
	{
		$sql = "SELECT 
				a.*,
				b.ref_value AS risk_status_v,
				c.ref_value AS risk_level_v,
				d.ref_value AS impact_level_v,
				e.l_title AS likelihood_v,
				f.division_name AS risk_owner_v,
				g.division_name AS division_v,
			
				CONCAT(h.cat_code, '- Category ', h.cat_name) AS risk_category_v,
				CONCAT(i.cat_code, '- Category ', i.cat_name) AS risk_sub_category_v,
				CONCAT(j.cat_code, '- Category ', j.cat_name) AS risk_2nd_sub_category_v,
				k.ref_value AS treatment_v,
				l.display_name AS risk_input_by_v,
				m.division_name AS risk_input_division_v,
				n.risk_code AS risk_library_code
				FROM t_risk a 
				LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
				LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
				LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
				LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
				LEFT JOIN m_division f ON a.risk_owner = f.division_id
				LEFT JOIN m_division g ON a.risk_division = g.division_id
				LEFT JOIN m_risk_category h ON a.risk_category = h.cat_id
				LEFT JOIN m_risk_category i ON a.risk_sub_category = i.cat_id
				LEFT JOIN m_risk_category j ON a.risk_2nd_sub_category = j.cat_id
				LEFT JOIN m_reference k ON a.suggested_risk_treatment = k.ref_key AND k.ref_context = 'treatment.status'
				LEFT JOIN m_user l ON a.risk_input_by = l.username
				LEFT JOIN m_division m ON a.risk_input_division = m.division_id
				LEFT JOIN t_risk n ON a.risk_library_id = n.risk_id
				WHERE a.risk_id = $risk_id AND a.risk_status > 3
				UNION
				SELECT 
				y.*,
				b.ref_value AS risk_status_v,
				c.ref_value AS risk_level_v,
				d.ref_value AS impact_level_v,
				e.l_title AS likelihood_v,
				f.division_name AS risk_owner_v,
				g.division_name AS division_v,
				
				CONCAT(h.cat_code, '- Category ', h.cat_name) AS risk_category_v,
				CONCAT(i.cat_code, '- Category ', i.cat_name) AS risk_sub_category_v,
				CONCAT(j.cat_code, '- Category ', j.cat_name) AS risk_2nd_sub_category_v,
				k.ref_value AS treatment_v,
				l.display_name AS risk_input_by_v,
				m.division_name AS risk_input_division_v,
				n.risk_code AS risk_library_code
				FROM t_risk a 
				JOIN t_risk_change y ON y.risk_id = a.risk_id
				LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
				LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
				LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
				LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
				LEFT JOIN m_division f ON y.risk_owner = f.division_id
				LEFT JOIN m_division g ON y.risk_division = g.division_id
				LEFT JOIN m_risk_category h ON a.risk_category = h.cat_id
				LEFT JOIN m_risk_category i ON a.risk_sub_category = i.cat_id
				LEFT JOIN m_risk_category j ON a.risk_2nd_sub_category = j.cat_id
				LEFT JOIN m_reference k ON a.suggested_risk_treatment = k.ref_key AND k.ref_context = 'treatment.status'
				LEFT JOIN m_user l ON a.risk_input_by = l.username
				LEFT JOIN m_division m ON a.risk_input_division = m.division_id
				LEFT JOIN t_risk n ON a.risk_library_id = n.risk_id
				
				WHERE y.risk_id = '$risk_id' AND y.risk_input_by = '$uid' AND y.risk_status < 3 AND a.risk_library_id IS NOT NULL
				UNION
				SELECT 
				a.*,
				b.ref_value AS risk_status_v,
				c.ref_value AS risk_level_v,
				d.ref_value AS impact_level_v,
				e.l_title AS likelihood_v,
				f.division_name AS risk_owner_v,
				g.division_name AS division_v,
				
				CONCAT(h.cat_code, '- Category ', h.cat_name) AS risk_category_v,
				CONCAT(i.cat_code, '- Category ', i.cat_name) AS risk_sub_category_v,
				CONCAT(j.cat_code, '- Category ', j.cat_name) AS risk_2nd_sub_category_v,
				k.ref_value AS treatment_v,
				l.display_name AS risk_input_by_v,
				m.division_name AS risk_input_division_v,
				n.risk_code AS risk_library_code
				FROM t_risk a 
				LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
				LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
				LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
				LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
				LEFT JOIN m_division f ON a.risk_owner = f.division_id
				LEFT JOIN m_division g ON a.risk_division = g.division_id
				LEFT JOIN m_risk_category h ON a.risk_category = h.cat_id
				LEFT JOIN m_risk_category i ON a.risk_sub_category = i.cat_id
				LEFT JOIN m_risk_category j ON a.risk_2nd_sub_category = j.cat_id
				LEFT JOIN m_reference k ON a.suggested_risk_treatment = k.ref_key AND k.ref_context = 'treatment.status'
				LEFT JOIN m_user l ON a.risk_input_by = l.username
				LEFT JOIN m_division m ON a.risk_input_division = m.division_id
				LEFT JOIN t_risk n ON a.risk_library_id = n.risk_id
	
				WHERE a.risk_id = '$risk_id' AND a.risk_status <=3 AND a.risk_library_id IS NULL
				UNION
				SELECT 
				a.*,
				b.ref_value AS risk_status_v,
				c.ref_value AS risk_level_v,
				d.ref_value AS impact_level_v,
				e.l_title AS likelihood_v,
				f.division_name AS risk_owner_v,
				g.division_name AS division_v,
				
				CONCAT(h.cat_code, '- Category ', h.cat_name) AS risk_category_v,
				CONCAT(i.cat_code, '- Category ', i.cat_name) AS risk_sub_category_v,
				CONCAT(j.cat_code, '- Category ', j.cat_name) AS risk_2nd_sub_category_v,
				k.ref_value AS treatment_v,
				l.display_name AS risk_input_by_v,
				m.division_name AS risk_input_division_v,
				n.risk_code AS risk_library_code
				FROM t_risk a 
				LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
				LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
				LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
				LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
				LEFT JOIN m_division f ON a.risk_owner = f.division_id
				LEFT JOIN m_division g ON a.risk_division = g.division_id
				LEFT JOIN m_risk_category h ON a.risk_category = h.cat_id
				LEFT JOIN m_risk_category i ON a.risk_sub_category = i.cat_id
				LEFT JOIN m_risk_category j ON a.risk_2nd_sub_category = j.cat_id
				LEFT JOIN m_reference k ON a.suggested_risk_treatment = k.ref_key AND k.ref_context = 'treatment.status'
				LEFT JOIN m_user l ON a.risk_input_by = l.username
				LEFT JOIN m_division m ON a.risk_input_division = m.division_id
				LEFT JOIN t_risk n ON a.risk_library_id = n.risk_id
				
				JOIN t_risk_change Y ON y.risk_id = a.risk_id
				WHERE y.risk_id = '$risk_id' AND y.risk_input_by = '$uid' AND y.risk_status = 3 AND a.risk_library_id IS NOT NULL
				";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpact($risk_id);
			$row['action_plan_list'] = $this->getActionPlan($risk_id);
			$row['control_list'] = $this->getControlList($risk_id);
			$row['objective_list'] = $this->getObjectiveList($risk_id);
		}
		
		return $row;
	}
	
	public function getRiskById_change($risk_id,$risk_input_by) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_change a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? and a.risk_input_by = '".$risk_input_by."'";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpact($risk_id);
			$row['action_plan_list'] = $this->getActionPlan_change($risk_id,$risk_input_by);
			$row['control_list'] = $this->getControlList_change($risk_id,$risk_input_by);
			$row['objective_list'] = $this->getObjectiveListChange($risk_id,$risk_input_by);
		}
		
		return $row;
	}

	public function getRiskById_own($risk_id,$risk_input_by) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_own a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? and a.risk_input_by = '".$risk_input_by."'";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpactown($risk_id);
			$row['action_plan_list'] = $this->getActionPlanown($risk_id,$risk_input_by);
			$row['control_list'] = $this->getControlListown($risk_id,$risk_input_by);
			$row['objective_list'] = $this->getObjectiveList($risk_id,$risk_input_by);
		}
		
		return $row;
	}

	public function getRiskById_own2($risk_id) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_own a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpactown($risk_id);
			$row['action_plan_list'] = $this->getActionPlanown($risk_id);
			$row['control_list'] = $this->getControlListown($risk_id);
			$row['objective_list'] = $this->getObjectiveList($risk_id);
		}
		
		return $row;
	}
//actplan
	public function getRiskById_actplan($risk_id,$act_id) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpact($risk_id);
			$row['action_plan_list'] = $this->getActionPlan_actplan($risk_id,$act_id);
			$row['control_list'] = $this->getControlList($risk_id);
			$row['objective_list'] = $this->getObjectiveList($risk_id);
		}
		
		return $row;
	}
//get risk owner
	public function getRiskByIdowner($risk_id) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_own a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? and a.switch_flag = 'P' ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpactown($risk_id);
			$row['action_plan_list'] = $this->getActionPlanown($risk_id);
			$row['control_list'] = $this->getControlListown($risk_id);
			$row['objective_list'] = $this->getObjectiveown($risk_id);
		}
		
		return $row;
	}



	// get risk untuk change request head t_risk_change
	public function getRiskByIdchanges($risk_id) 
	{
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_change a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpactchanges($risk_id);
			$row['action_plan_list'] = $this->getActionPlanchanges($risk_id);
			$row['control_list'] = $this->getControlListchanges($risk_id);
			$row['objective_list'] = $this->getObjectiveListChange2($risk_id);
		}
		
		return $row;
	}

	public function getControlById($risk_id) 
	{
		$sql = "select b.id as ec_id, a.*
				from t_risk_control a
				LEFT JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				where a.id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}

	public function getControlById2($risk_id) 
	{
		$sql = "select 
				a.existing_control
				from m_risk_existing_control a
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}

	public function getControlById3($risk_id) 
	{
		$sql = "select t_risk_objective.id, m_objective.id as objid, t_risk_objective.objective, t_risk_objective.risk_id
				from t_risk_objective
				JOIN m_objective ON m_objective.objective = t_risk_objective.objective where t_risk_objective.id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}
	
	public function getActionById($risk_id) 
	{
		$sql = "select date_format(a.due_date, '%d-%m-%Y') as due_date, a.id, a.risk_id, a.action_plan, a.division
				from t_risk_action_plan a
				where a.id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}
	
	public function getRiskImpact($risk_id) 
	{
		$sql = "select * from t_risk_impact
				where risk_id = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
//get risk impact dari changes
	public function getRiskImpactchanges($risk_id) 
	{
		$sql = "select * from t_risk_impact_change
				where risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getRiskImpactown($risk_id) 
	{
		$sql = "select * from t_risk_impact_own
				where risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getActionPlan($risk_id) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getActionPlan_change($risk_id,$risk_input_by) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan_change a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and a.switch_flag = '".$risk_input_by."'";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getActionPlanStatus($risk_id) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$res = $query->result_array();
		
		return $res;
	}

	public function getActionPlan_actplan($risk_id,$act_id) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and id= ? ";
		$par = array('uid' => $risk_id,'uid2' => $act_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
//get action plan dari changes
	public function getActionPlanchanges($risk_id) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan_change a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getActionPlanown($risk_id) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan_own a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
//get objective untuk library
	public function getObjectiveList($risk_id) 
	{
		$sql = "select a.id, b.id as objid, a.objective, a.risk_id
				from t_risk_objective a
				LEFT JOIN m_objective b ON a.objective = b.objective where a.risk_id = ? ORDER BY b.id ASC ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}


	public function getObjectiveown($risk_id) 
	{
		$sql = "select b.id as objid, a.objective, a.risk_id
				from t_risk_objective_own a
				LEFT JOIN m_objective b ON a.objective = b.objective where a.risk_id = ? and switch_flag = 'P' ORDER BY b.id ASC ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getControlList($risk_id) 
	{
		$sql = "select a.id, b.id as ec_id, a.existing_control_id, a.risk_existing_control, a.risk_evaluation_control, a.risk_control_owner, a.switch_flag
				from t_risk_control a
				LEFT JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner 
				where a.risk_id = ? ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getControlList_change($risk_id,$risk_input_by) 
	{
		$sql = "select a.*
				from t_risk_control_change a
				where a.risk_id = ? and a.switch_flag = '".$risk_input_by."'";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

//get control dari changes
	public function getControlListchanges($risk_id) 
	{
		$sql = "select a.*
				from t_risk_control_change a
				where a.risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getControlListown($risk_id) 
	{
		$sql = "select a.*
				from t_risk_control_own a
				where a.risk_id = ? and switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getRiskChangeByIdNoRef($risk_id) 
	{
		$sql = "select 
				a.*
				from t_risk_change a 
				where a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		return $row;
	}
	
	public function getRiskChangeById($risk_id,$risk_input_by) 
	{
		
		//$user =$_GET['tes'];
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_change a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				where a.risk_id = '".$risk_id."' and a.risk_input_by = '".$risk_input_by."' ";
//ubah
		$query = $this->db->query($sql);
		$row = $query->row_array();

		if ($row) {
			$row['impact_list'] = $this->getRiskImpactChange($risk_id,$risk_input_by);
			$row['action_plan_list'] = $this->getActionPlanChange($risk_id,$risk_input_by);
			$row['control_list'] = $this->getControlListChange($risk_id,$risk_input_by);
			$row['objective_list'] = $this->getObjectiveListChange($risk_id,$risk_input_by);
		}
		
		return $row;
	}
	
	public function getRiskImpactChange($risk_id,$risk_input_by) 
	{
		$sql = "select * from t_risk_impact_change
				where risk_id = ? and switch_flag = '".$risk_input_by."' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getActionPlanChange($risk_id,$risk_input_by) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan_change a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and switch_flag = '".$risk_input_by."' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getControlListChange($risk_id,$risk_input_by) 
	{
		$sql = "select a.*
				from t_risk_control_change a
				where a.risk_id = ? and switch_flag = '".$risk_input_by."' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getObjectiveListChange($risk_id,$risk_input_by) 
	{
		$sql = "select a.*
				from t_risk_objective_change a
				where a.risk_id = ? and switch_flag = '".$risk_input_by."' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getObjectiveListChange2($risk_id) 
	{
		$sql = "select a.*
				from t_risk_objective_change a
				where a.risk_id = ? and a.switch_flag='P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

//ini get risk change untuk verify risk owner
	public function getRiskOwnById2($risk_id) 
	{
		
		//$user =$_GET['tes'];
		$sql = "select 
				a.*,
				b.ref_value as risk_status_v,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				g.division_name as division_v,
				t_risk_add_user.username,
				concat(h.cat_code, '- Category ', h.cat_name) as risk_category_v,
				concat(i.cat_code, '- Category ', i.cat_name) as risk_sub_category_v,
				concat(j.cat_code, '- Category ', j.cat_name) as risk_2nd_sub_category_v,
				k.ref_value as treatment_v,
				l.display_name as risk_input_by_v,
				m.division_name as risk_input_division_v,
				n.risk_code as risk_library_code
				from t_risk_own a 
				left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				left join m_division g on a.risk_division = g.division_id
				left join m_risk_category h on a.risk_category = h.cat_id
				left join m_risk_category i on a.risk_sub_category = i.cat_id
				left join m_risk_category j on a.risk_2nd_sub_category = j.cat_id
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				left join m_user l on a.risk_input_by = l.username
				left join m_division m on a.risk_input_division = m.division_id
				left join t_risk n on a.risk_library_id = n.risk_id
				left join t_risk_add_user on a.risk_id = t_risk_add_user.risk_id
				
				where a.risk_id = ? and a.switch_flag = 'P' ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getRiskImpactown($risk_id);
			$row['action_plan_list'] = $this->getActionPlanown($risk_id);
			$row['control_list'] = $this->getControlListown($risk_id);
			$row['objective_list'] = $this->getObjectiveown($risk_id);
		}
		
		return $row;
	}


	public function getRiskImpactOwn2($risk_id,$risk_input_by) 
	{
		$sql = "select * from t_risk_impact_own
				where risk_id = ? and switch_flag = 'P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getActionPlanOwn2($risk_id,$risk_input_by) 
	{
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_risk_action_plan_own a
				left join m_division b on a.division = b.division_id 
				where a.risk_id = ? and switch_flag = 'P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getControlListOwn2($risk_id,$risk_input_by) 
	{
		$sql = "select a.*
				from t_risk_control_own a
				where a.risk_id = ? and switch_flag = 'P' ";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	

	//get all risk rac tab 1 hilangkan yang draft nya
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
		$sql = "select * from (select 
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
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and g.risk_status > 1 and g.risk_status < 3 and g.existing_control_id is null
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another
                                                                group by another.risk_code

                                                                UNION
                                                                select * from (select 
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
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and a.risk_status > 1 and a.existing_control_id is null
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

	public function getAllOldRisk($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		$sql = "select * from (select 
                                                                a.*,
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
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id IN ((select max(periode_id) from m_periode)-1)
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id desc ) as another
                                                                group by another.risk_code


				"
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
		return $res;
	}

	public function getAllRiskPeriode($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		$sql = "select * from (select 
                                                                a.*,
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
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id = 0
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id desc ) as another
                                                                group by another.risk_code


				"
				.$ex_filter
				
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
		return $res;
	}

	public function getAllRiskCeo($page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
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
		$sql = "select * from (select 
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
                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                left join m_division f on a.risk_owner = f.division_id
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and g.risk_status > 1 and g.risk_status < 3 and g.existing_control_id is null and (a.risk_division = 'IA' OR a.risk_division = 'BDC' OR a.risk_division = 'IIGFI' OR a.risk_division='CSR' OR a.risk_division = 'CEO Office')
                                                                and a.".$filter_by." like '%".$filter_value."%'
                                                                order by a.risk_id desc
                                                                
                                                                 ) as another
                                                                group by another.risk_code

                                                                UNION
                                                                select * from (select 
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
                                                                left join m_periode on m_periode.periode_id = a.periode_id
                                                                where  a.periode_id IN (select max(periode_id) from m_periode) and a.risk_status > 1 and a.existing_control_id is null and (a.risk_division = 'IA' OR a.risk_division = 'BDC' OR a.risk_division = 'IIGFI' OR a.risk_division='CSR' OR a.risk_division = 'CEO Office')
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
			$filter_by = 'risk_id';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		
		if ($mode == 'allRiskLibrary') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' and (UPPER(a.risk_code) like ? or UPPER(a.risk_event) like ? or UPPER(a.risk_description) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}

			$sql = "select 
					a.risk_id,
					a.risk_code,
					a.risk_event,
					a.risk_description
					from t_risk a
					where a.periode_id = (SELECT MAX(b.periode_id) from t_risk b where b.risk_code = a.risk_code and a.risk_status >2 and b.switch_flag = 'P')
					".$ext;
			/*
			$sql = "select 					
					risk_id,
					risk_code,
					risk_event,
					risk_description
					 from t_risk where periode_id = (SELECT MAX(periode_id) FROM t_risk as a WHERE a.risk_code = t_risk.risk_code  and risk_status > 2 and switch_flag = 'P') GROUP BY risk_code
					".$ext;*/
		}
		
		if ($mode == 'allActionLibrary') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = 'and (UPPER(a.action_plan) like ? or UPPER(a.id) like ? or UPPER(a.risk_id) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select 
					a.id,
					a.action_plan,
					a.risk_id,
					date_format(a.due_date, '%d-%m-%Y') as due_date_v, 
					b.division_name as division_v
					from t_risk_action_plan a, m_division b where b.division_id = a.division
					
					".$ext."GROUP BY a.action_plan, a.division";
		}
		
		if ($mode == 'allControlLibrary') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(a.risk_existing_control) like ? or UPPER(a.risk_evaluation_control) like ? or UPPER(a.risk_control_owner) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select b.id as ec_id, a.*
				from t_risk_control a
				JOIN m_control b ON a.risk_existing_control = b.risk_existing_control and a.risk_evaluation_control = b.risk_evaluation_control and a.risk_control_owner = b.risk_control_owner
					".$ext." GROUP BY a.risk_evaluation_control"; //tadinya group risk_evaluation_control
		}

		if ($mode == 'allControlLibraryobjective') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(a.objective) like ? ) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select a.id, b.id as objid, a.objective, a.risk_id
				from t_risk_objective a
				JOIN m_objective b ON a.objective = b.objective ".$ext." 
				group by a.objective";
		}

		if ($mode == 'allControlLibraryExisting') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(a.existing_control) like ? or UPPER(a.description) like ? ) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select a.* from m_risk_existing_control a
					".$ext." ";
		}

		if ($mode == 'RiskInputBy_Id') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' where (UPPER(a.existing_control) like ? or UPPER(a.description) like ? ) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select * from t_risk_change where risk_id = '893'
					 ";
		}

		
		if ($mode == 'allRiskByOwner') {
			
			if (isset($defFilter['risk_cat'])) {
				//$sql .= " and a.risk_2nd_sub_category = ?";
				//$rpar['cat'] = $defFilter['risk_cat'];
				$operator = '=';
				$cat = $defFilter['risk_cat'];
			}else{
				$cat = 'is not null';
				$operator = '';
			}

			$date = date("Y-m-d");
			
			$sql = "
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
                                                                               
                    a.risk_existing_control,                                                           
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
					and a.periode_id = (select max(periode_id) from m_periode)
					and a.risk_input_by = '".$defFilter['userid']."'
					and a.existing_control_id is null
					and a.risk_library_id is null
					 and a.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
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
                                                                               
                    g.risk_existing_control,                                                            
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
					and g.periode_id = (select max(periode_id) from m_periode)
					and g.risk_input_by = '".$defFilter['userid']."'
					and g.existing_control_id is null 
					 and g.risk_status < 3
					 and g.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
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
                                                                               
                    a.risk_existing_control,                                                            
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
					join t_risk_add_user t on a.risk_id = t.risk_id
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 														
																				t.risk_library_id = 1 and
                    															a.risk_library_id is not null and
                                                                                a.existing_control_id is null
                                                                                and a.periode_id = (select max(periode_id) from m_periode)
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."' and a.risk_status > 2
                    and a.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
                                                                               

					";
			$rpar = array('user_id' => $defFilter['userid']);
			

			if ($par)	{ 
				$rpar['p1'] = $par['p1'];
			}
			$par = $rpar;
		}

		if ($mode == 'allOldRiskByOwner') {
			
			if (isset($defFilter['risk_cat'])) {
				//$sql .= " and a.risk_2nd_sub_category = ?";
				//$rpar['cat'] = $defFilter['risk_cat'];
				$operator = '=';
				$cat = $defFilter['risk_cat'];
			}else{
				$cat = 'is not null';
				$operator = '';
			}

			$date = date("Y-m-d");
			
			$sql = "
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
                                                                               
                    a.risk_existing_control,                                                           
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
					and a.periode_id = ((select max(periode_id) from m_periode)-1)
					and a.risk_input_by = '".$defFilter['userid']."'
					and a.existing_control_id is null
					and a.risk_library_id is null
					 and a.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
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
                                                                               
                    g.risk_existing_control,                                                            
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
					and g.periode_id = ((select max(periode_id) from m_periode)-1)
					and g.risk_input_by = '".$defFilter['userid']."'
					and g.existing_control_id is null 
					 and g.risk_status < 3
					 and g.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
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
                                                                               
                    a.risk_existing_control,                                                            
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
					join t_risk_add_user t on a.risk_id = t.risk_id
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					join m_periode on m_periode.periode_id = a.periode_id
					where 														t.risk_library_id = 1 and
                    															a.risk_library_id is not null and
                                                                                a.existing_control_id is null
                                                                                and a.periode_id = ((select max(periode_id) from m_periode)-1)
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."' and a.risk_status > 2
                    and a.risk_2nd_sub_category ".$operator.$cat." and a.".$filter_by." like '%".$filter_value."%'
					";
			$rpar = array('user_id' => $defFilter['userid']);
			

			if ($par)	{ 
				$rpar['p1'] = $par['p1'];
			}
			$par = $rpar;
		}

		if ($mode == 'allRiskByOwnerPeriod') {
			
			if (isset($defFilter['risk_cat'])) {
				//$sql .= " and a.risk_2nd_sub_category = ?";
				//$rpar['cat'] = $defFilter['risk_cat'];
				$operator = '=';
				$cat = $defFilter['risk_cat'];
			}else{
				$cat = 'is not null';
				$operator = '';
			}

			$date = date("Y-m-d");
			
			$sql = "
					select * from (select * from (select 
                                                                                a.*,
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
                                                                                where   
                                                                                a.risk_input_by = ? and a.existing_control_id is null
                                                                                and a.risk_2nd_sub_category ".$operator.$cat."
                                                                                and a.periode_id = 0
                                                                                UNION
                                                                                select 
                                                                                a.*,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                f.division_name as risk_owner_v
                                                                                from t_risk_change a
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                where   
                                                                                a.risk_input_by = '".$defFilter['userid']."' and a.existing_control_id is null
                                                                                and a.risk_2nd_sub_category ".$operator.$cat." and a.periode_id = 0
                                                                                UNION
                                                                                select 
                                                                                a.*,
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
                                                                                join t_risk_add_user t on a.risk_id = t.risk_id
                                                                                where   
                                                                                t.username = '".$defFilter['userid']."' and t.delete_status is null and a.existing_control_id is null
                                                                                and a.risk_2nd_sub_category ".$operator.$cat." and a.periode_id IN ((select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end))
																				) as orderin
																				order by orderin.risk_id desc
																				) as groupin
																				group by groupin.risk_code

					";
			$rpar = array('user_id' => $defFilter['userid']);
			

			if ($par)	{ 
				$rpar['p1'] = $par['p1'];
			}
			$par = $rpar;
		}
		
		if ($mode == 'racPeriode') {
			$sql = "

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
                                                                                left join m_reference b on g.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on g.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on g.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on g.risk_likelihood_key = e.l_key
                                                                                left join m_division f on g.risk_owner = f.division_id
                                                                                where 
                                                                                g.periode_id = (select max(periode_id) from m_periode)
                                                                                and g.risk_input_by = '".$defFilter['userid']."' 
                                                                                and g.existing_control_id is null and g.risk_status < 3
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
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
        																		join t_risk_add_user t on a.risk_id = t.risk_id
                                                                                where
                                                                                g.risk_library_id is not null 
                                                                                and 
                                                                                t.risk_library_id = 1
                                                                                and g.risk_input_by = '".$defFilter['userid']."'
                                                                                and g.existing_control_id is null
                                                                                and g.risk_status > 2 and 
                                                                                a.periode_id = (select max(periode_id) from m_periode)
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."'
                                                                                and a.".$filter_by." like '%".$filter_value."%'

 
			";
		}
		
		
		if ($mode == 'racRollover') {
			$sql = "select 
                                                                                a.*,
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
                                                                                and a.risk_status >= 0
                                                                                and a.risk_input_by = '".$defFilter['userid']."'
                                                                                and a.existing_control_id is null
                                                                                and a.risk_library_id is null
                                                                                and a.periode_id = (SELECT MAX(periode_id) from t_risk where risk_input_by = '".$defFilter['userid']."')
                                                                                and a.".$filter_by." like '%".$filter_value."%'
                    UNION
                    select 
                                                                                a.*,
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
                                                                                and a.risk_status >= 0
                                                                                and a.risk_input_by = '".$defFilter['userid']."'
                                                                                and a.existing_control_id is null
                                                                                and a.risk_library_id is null
                                                                                and a.periode_id = (SELECT MAX(periode_id) from t_risk where risk_input_by = '".$defFilter['userid']."')
                                                                                and a.".$filter_by." like '%".$filter_value."%'

					";
		}

		if ($mode == 'racPeriode_okto') {
			$sql = "select 
                                                                                a.*,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                f.division_name as risk_owner_v
                                                                                from t_risk_change a
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                where 
                                                                                a.periode_id = '".$defFilter['periodid']."'
                                                                                and a.risk_input_by = '".$defFilter['userid']."'
                                                                                and a.existing_control_id is null
                                                                                and a.risk_id NOT IN (select r.risk_id from t_risk r where a.risk_id = r.risk_id and r.periode_id = '".$defFilter['periodid']."' and r.risk_input_by = '".$defFilter['userid']."' and r.risk_status > 1)
                                                                                and a.".$filter_by." like '%".$filter_value."%'
                        UNION
                                                                                select 
                                                                                a.*,
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
                                                                                where 
                                                                                																			     

                                                                                a.periode_id is not null
                                                                                and a.risk_status = 2
                                                                                and a.risk_input_by = '".$defFilter['userid']."' 
 	
                                                                                and a.periode_id = '".$defFilter['periodid']."'
                                                                                and a.periode_id = (SELECT MAX(periode_id) from t_risk)
                        
                                                                                and a.".$filter_by." like '%".$filter_value."%'
UNION
select 
                                                                                a.*,
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
        																		join t_risk_add_user t on a.risk_id = t.risk_id
                                                                                where
                                                                                a.risk_library_id is null
                                                                                and a.risk_status = 2 
                                                                                and 
                                                                                t.risk_library_id is not null
                                                                                and
                                                                                a.periode_id = '".$defFilter['periodid']."'
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."'
                                                                                and a.".$filter_by." like '%".$filter_value."%'

			";
		}

		if ($mode == 'racPeriode_okto2') {
			$sql = "select 
                                                                                a.*,
                                                                                b.ref_value as risk_status_v,
                                                                                c.ref_value as risk_level_v,
                                                                                d.ref_value as impact_level_v,
                                                                                e.l_title as likelihood_v,
                                                                                f.division_name as risk_owner_v
                                                                                from t_risk_change a
                                                                                left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
                                                                                left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
                                                                                left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
                                                                                left join m_likelihood e on a.risk_likelihood_key = e.l_key
                                                                                left join m_division f on a.risk_owner = f.division_id
                                                                                where 
                                                                                a.periode_id = '".$defFilter['periodid']."'
                                                                                and a.risk_input_by = '".$defFilter['userid']."'
                                                                                and a.existing_control_id is null
                                                                                and a.risk_id NOT IN (select r.risk_id from t_risk r where a.risk_id = r.risk_id and r.periode_id = '".$defFilter['periodid']."' and r.risk_input_by = '".$defFilter['userid']."' and r.risk_status > 1)
                                                                                and a.".$filter_by." like '%".$filter_value."%'
                        UNION
                                                                                select 
                                                                                a.*,
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
                                                                                where 
                                                                                																			     

                                                                                a.periode_id is not null
                                                                                and a.risk_status > 2
                                                                                and a.risk_input_by = '".$defFilter['userid']."' 
 
                                                                                and a.periode_id = '".$defFilter['periodid']."'
                                                                                and a.periode_id = a.periode_id = (SELECT MAX(periode_id) from t_risk)
                        
                                                                                and a.".$filter_by." like '%".$filter_value."%'
UNION
select 
                                                                                a.*,
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
        																		join t_risk_add_user t on a.risk_id = t.risk_id
                                                                                where
                                                                                a.risk_library_id is null
                                                                                and a.risk_status > 2 
                                                                                and 
                                                                                t.risk_library_id is not null
                                                                                and
                                                                                a.periode_id = '".$defFilter['periodid']."'
                                                                                and 
                                                                                t.username = '".$defFilter['userid']."'
                                                                                and a.".$filter_by." like '%".$filter_value."%'

			";
		}
		
		if ($mode == 'racTreatmentList') {
			
			$date = date("Y-m-d");
			
			$sql = "select * from (select 
					a.*,
					b.division_name as risk_owner_v,
					c.ref_value as suggested_risk_treatment_v
					from t_risk a
					left join m_division b on a.risk_owner = b.division_id
					left join m_reference c on a.suggested_risk_treatment = c.ref_key and c.ref_context = 'treatment.status'
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.periode_id is not null and a.periode_id IN (select max(periode_id) from m_periode)
					and a.risk_status > 2
					and a.".$filter_by." like '%".$filter_value."%') as another group by another.risk_code 
					
					";
		}
		
		if ($mode == 'ownedRisk') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.risk_treatment_owner = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}

			
				$date = date("Y-m-d");
				$sql = "select * from (select 
						a.*,
						b.ref_value as risk_status_v,
						c.ref_value as risk_level_v,
						d.ref_value as impact_level_v,
						e.l_title as likelihood_v,
						f.division_name as risk_owner_v,
						g.display_name as risk_treatment_owner_v,
						h.ref_value as suggested_risk_treatment_v
						from t_risk a
						left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
						left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
						left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
						left join m_likelihood e on a.risk_likelihood_key = e.l_key
						left join m_division f on a.risk_owner = f.division_id
						left join m_user g on a.risk_treatment_owner = g.username
						left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
						left join m_periode on m_periode.periode_id = a.periode_id
						where 
						 a.periode_id is not null and a.periode_id = (select max(periode_id) from m_periode)
						and a.risk_status > 2
						and a.risk_division = ?
						".$ext."and a.".$filter_by." like '%".$filter_value."%') as another group by another.risk_code";
				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			} else {
				return false;
			}
		}
		
		if ($mode == 'ownedActionPlan') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				$date = date("Y-m-d");
				
				$sql = "SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, f.division, a.assigned_to, a.existing_control_id, g.jml_id,
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,

					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code, 

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT DATE_FORMAT(b.due_date, '%d-%m-%Y') SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v,
					h.action_plan AS haction_plan, h.due_date AS hdue_date, h.division AS hdivision, DATE_FORMAT(h.due_date, '%d-%m-%Y') AS hdue_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = (select MAX(periode_id) from m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					
					LEFT JOIN t_action_plan_change h ON f.id = h.id_ap
					WHERE 
					b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND
					a.action_plan_status > 0 AND a.division = ? AND a.switch_flag = 'P'
						".$ext."and a.".$filter_by." like '%".$filter_value."%'";
				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id_p', true);
				return $res;
			} else {
				return false;
			}
		}

		if ($mode == 'ownedActionPlanChange') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				$date = date("Y-m-d");
				
				$sql = "select 
						a.*,
						concat('AP.', LPAD(a.id, 6, '0')) as act_code,
						b.risk_code,
						c.display_name as assigned_to_v,
						d.division_name as division_name,
						date_format(a.due_date, '%d-%m-%Y') as due_date_v
						from 
						t_risk_action_plan_change a
						left join t_risk b on a.risk_id = b.risk_id
						left join m_user c on a.assigned_to = c.username
						left join m_division d on a.division = d.division_id
						left join m_periode on m_periode.periode_id = b.periode_id
						where 
						b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
						a.action_plan_status > 0
						and a.division = ? and a.switch_flag = 'P'
						
						".$ext;
				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
				return $res;
			} else {
				return false;
			}
		}
		
		if ($mode == 'ownedActionPlanExec') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				
				$date = date("Y-m-d");
				
				/*$sql = "select
                                                                                                a.*,
                                                                                                concat('AP.', LPAD(a.id, 6, '0')) as act_code,
                                                                                                b.risk_code,b.periode_id,
                                                                                                c.display_name as assigned_to_v,
                                                                                                d.division_name as division_name,
                                                                                                date_format(a.due_date, '%d-%m-%Y') as due_date_v,
                                                                                                case 
                                                                                                when a.assigned_to = '".$defFilter['userid']."' then 1
                                                                                                else 0
                                                                                                end as is_owner,
                                                                                                case 
                                                                                                when '4' = '".$defFilter['role_id']."' then 1
                                                                                                else 0
                                                                                                end as is_head,
                                                                                                date_format(a.revised_date, '%d-%m-%Y') as revised_date_v,
                                                                                                case
                                                                                                when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
                                                                                                else 0
                                                                                                end as status_periode                                                                                                                               
                                                                                                from 
                                                                                                t_risk_action_plan a
                                                                                                left join t_risk b on a.risk_id = b.risk_id
                                                                                                left join m_user c on a.assigned_to = c.username
                                                                                                left join m_division d on a.division = d.division_id

                                                                                                where 
                                  																b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
                                                                                                a.action_plan_status > 3
                                                                                                and a.division = ?
                                                                                                ".$ext;*/


						//AND b.periode_id is null
                $sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, a.existing_control_id, f.division, g.jml_id,                            
                																				case 
                                                                                                when a.assigned_to = '".$defFilter['userid']."' then 1
                                                                                                else 0
                                                                                                end as is_owner,
                                                                                                case 
                                                                                                when '4' = '".$defFilter['role_id']."' then 1
                                                                                                else 0
                                                                                                end as is_head,
                                                                                                date_format(a.revised_date, '%d-%m-%Y') as revised_date_v,
                                                                                                case
                                                                                                when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
                                                                                                else 0
                                                                                                end as status_periode,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status > 3 and a.division = ? and a.switch_flag = 'P'
						".$ext." and a.".$filter_by." like '%".$filter_value."%'";

				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id_p', true);
				return $res;
			} else {
				return false;
			}
		}
		
		if ($mode == 'ownedActionPlanExec_adt') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				
				$date = date("Y-m-d");
				
				$sql = "select 
						a.*,
						concat('AP.', LPAD(a.id, 6, '0')) as act_code,
						b.risk_code,
						c.display_name as assigned_to_v,
						d.division_name as division_name,
						date_format(a.due_date, '%d-%m-%Y') as due_date_v,
						case 
							when a.assigned_to = '".$defFilter['userid']."' then 1
							else 0
						end as is_owner,
						case 
							when '4' = '".$defFilter['role_id']."' then 1
							else 0
						end as is_head,
						date_format(a.revised_date, '%d-%m-%Y') as revised_date_v
						from 
						t_risk_action_plan a
						left join t_risk b on a.risk_id = b.risk_id
						left join m_user c on a.assigned_to = c.username
						left join m_division d on a.division = d.division_id
						 
						where
						b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and 
						a.action_plan_status > 3
						and a.division = ?
						AND b.periode_id is not null
					  
						".$ext;
				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id', true);
				return $res;
			} else {
				return false;
			}
		}
		
		if ($mode == 'racActionPlan') {
			
			$date = date("Y-m-d");
			
			/*$sql = "select t2.action_plan_status, t1.id, t1.risk_id, t1.id_ap, t1.act_code, t1.action_plan, t1.division, t2.due_date_v, t2.division_name, t1.risk_code from (select distinct a.id as id_ap, concat('AP.', LPAD(a.id, 6, '0')) as act_code, a.action_plan, b.action_plan_status, b.division,
			d.display_name as assigned_to_v,
			e.division_name as division_name,
			date_format(b.due_date, '%d-%m-%Y') as due_date_v, b.id, c.risk_id, c.risk_code
					from m_action_plan a
					join t_risk_action_plan b on a.action_plan = b.action_plan and a.division = b.division
					left join t_risk c on b.risk_id = c.risk_id
					left join m_user d on b.assigned_to = d.username
					left join m_division e on b.division = e.division_id
					left join m_periode on m_periode.periode_id = c.periode_id
					where 
					c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					b.action_plan_status > 0 and b.switch_flag = 'P') t1 left join 
                    
                    (select distinct a.id as id_ap, concat('AP.', LPAD(a.id, 6, '0')) as act_code, a.action_plan, b.action_plan_status, b.division,
			d.display_name as assigned_to_v,
			e.division_name as division_name,
			date_format(b.due_date, '%d-%m-%Y') as due_date_v, b.id, c.risk_id, c.risk_code
					from m_action_plan a
					join t_risk_action_plan b on a.action_plan = b.action_plan and a.division = b.division
					left join t_risk c on b.risk_id = c.risk_id
					left join m_user d on b.assigned_to = d.username
					left join m_division e on b.division = e.division_id
					left join m_periode on m_periode.periode_id = c.periode_id
					where 
					c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					b.action_plan_status > 0 and b.switch_flag = 'P' group by a.id) t2 on t1.id_ap = t2.id_ap and t1.risk_code = t2.risk_code where t1.".$filter_by." like '%".$filter_value."%'";*/

			/*$sql = "select distinct a.id as id_ap, concat('AP.', LPAD(a.id, 6, '0')) as act_code, a.action_plan, b.action_plan_status, b.division,
(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b where c.risk_id = b.risk_id and c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division) as risk_id, 
(select group_concat(b.id separator ' | ') from t_risk c, t_risk_action_plan b where c.risk_id = b.risk_id and c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division) as id, 
			d.display_name as assigned_to_v,
			e.division_name as division_name,
			date_format(b.due_date, '%d-%m-%Y') as due_date_v,
(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division) as risk_code 
					from m_action_plan a
					join t_risk_action_plan b on a.action_plan = b.action_plan and a.division = b.division
					left join t_risk c on b.risk_id = c.risk_id
					left join m_user d on b.assigned_to = d.username
					left join m_division e on b.division = e.division_id
					left join m_periode on m_periode.periode_id = c.periode_id
					where 
					c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					b.action_plan_status > 0 and b.switch_flag = 'P'
					and b.".$filter_by." like '%".$filter_value."%'";*/

			$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.existing_control_id, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v, h.action_plan AS haction_plan, h.due_date AS hdue_date, i.division_name AS hdivision, DATE_FORMAT(h.due_date, '%d-%m-%Y') AS hdue_date_v 
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = (select MAX(periode_id) from m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
						
					LEFT JOIN t_action_plan h ON f.id = h.id_ap
					left join m_division i on h.division = i.division_id
					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status > 0 and b.switch_flag = 'P'
					and a.".$filter_by." like '%".$filter_value."%'
					";
		}
		
		if ($mode == 'racActionPlanExec') {
			
			$date = date("Y-m-d");
			/*$sql = "

					select
					a.*,
					concat('AP.', LPAD(a.id, 6, '0')) as act_code,
					b.risk_code,b.periode_id,
					c.display_name as assigned_to_v,
					d.division_name as division_name,
					date_format(a.due_date, '%d-%m-%Y') as due_date_v,
					case 
                    when a.assigned_to = '".$defFilter['userid']."' then 0
                    else 1
                    end as is_owner,
                    case 
                    when '4' = '".$defFilter['role_id']."' then 0
                    else 1
                    end as is_head,
					case
					when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
					else 0
					end as status_periode  
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id					
					where
					b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and 
					a.action_plan_status > 3 and a.switch_flag = 'P'
					and a.".$filter_by." like '%".$filter_value."%'
						
					";*/
					//AND b.periode_id is null

			$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, 
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					case 
                    when a.assigned_to = '".$defFilter['userid']."' then 0
                    else 1
                    end as is_owner,
                    case 
                    when '4' = '".$defFilter['role_id']."' then 0
                    else 1
                    end as is_head,
					case
					when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
					else 0
					end as status_periode, 

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select MAX(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select MAX(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select MAX(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = (select MAX(periode_id) from m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = (select MAX(periode_id) from m_periode) and
					a.action_plan_status > 3 and b.switch_flag = 'P'
					and a.".$filter_by." like '%".$filter_value."%'";
		}
		
		if ($mode == 'racActionPlanExec_adt') {
			
			$date = date("Y-m-d");
			$sql = "select 
					a.*,
					concat('AP.', LPAD(a.id, 6, '0')) as act_code,
					b.risk_code,
					c.display_name as assigned_to_v,
					d.division_name as division_name,
					date_format(a.due_date, '%d-%m-%Y') as due_date_v
					from 
					t_risk_action_plan a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.assigned_to = c.username
					left join m_division d on a.division = d.division_id
				 
					where 
					b.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) and
					a.action_plan_status > 3
					 AND b.periode_id is not null
						 
					";
		}

		if ($mode == 'racActionPlanExec_prior') {
			
			$date = date("Y-m-d");
			$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					case 
                    when a.assigned_to = '".$defFilter['userid']."' then 0
                    else 1
                    end as is_owner,
                    case 
                    when '4' = '".$defFilter['role_id']."' then 0
                    else 1
                    end as is_head,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = ((select max(periode_id) from m_periode)-1) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = ((select max(periode_id) from m_periode)-1) and
					a.action_plan_status > 3 and b.switch_flag = 'P'
					and a.".$filter_by." like '%".$filter_value."%'";
		}

		if ($mode == 'picActionPlanExec_prior') {
			
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				
				$date = date("Y-m-d");
				
				
                $sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, a.existing_control_id,                            
                																				case 
                                                                                                when a.assigned_to = '".$defFilter['userid']."' then 1
                                                                                                else 0
                                                                                                end as is_owner,
                                                                                                case 
                                                                                                when '4' = '".$defFilter['role_id']."' then 1
                                                                                                else 0
                                                                                                end as is_head,
                                                                                                date_format(a.revised_date, '%d-%m-%Y') as revised_date_v,
                                                                                                
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = ((select MAX(periode_id) from m_periode)-1) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = ((select max(periode_id) from m_periode)-1) and
					a.action_plan_status > 3 and a.division = ? and a.switch_flag = 'P' and a.".$filter_by." like '%".$filter_value."%'
						".$ext;

				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id_p', true);
				return $res;
			} else {
				return false;
			}
		}

		if ($mode == 'picActionPlanExec_now') {
			
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.assigned_to = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				
				$date = date("Y-m-d");
				
				
                $sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, a.existing_control_id, f.division, g.jml_id,                            
                																				case 
                                                                                                when a.assigned_to = '".$defFilter['userid']."' then 1
                                                                                                else 0
                                                                                                end as is_owner,
                                                                                                case 
                                                                                                when '4' = '".$defFilter['role_id']."' then 1
                                                                                                else 0
                                                                                                end as is_head,
                                                                                                date_format(a.revised_date, '%d-%m-%Y') as revised_date_v,
                                                                                                case
                                                                                                when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
                                                                                                else 0
                                                                                                end as status_periode,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = (select MAX(periode_id) from m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status > 3 and a.division = ? and a.switch_flag = 'P' and a.".$filter_by." like '%".$filter_value."%'
						".$ext;

				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
				
				$sql = $sql.$ex_filter.$ex_or;
				$res = $this->getPagingData($sql, $par, $page, $row, 'id_p', true);
				return $res;
			} else {
				return false;
			}
		}

		if ($mode == 'racActionPlanExec_now') {
			
			$date = date("Y-m-d");
			$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id, 
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					case 
                    when a.assigned_to = '".$defFilter['userid']."' then 0
                    else 1
                    end as is_owner,
                    case 
                    when '4' = '".$defFilter['role_id']."' then 0
                    else 1
                    end as is_head,
					case
					when DATE(NOW()) = (select DATE(NOW()) from m_periode_plan where DATE(NOW()) between periode_start and periode_end) then 1
					else 0
					end as status_periode, 

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, periode_id FROM t_risk where periode_id = (select MAX(periode_id) from m_periode) GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status > 3 and b.switch_flag = 'P'
					and a.".$filter_by." like '%".$filter_value."%'";
		}

		
		
		if ($mode == 'ownedKri') {
			if (isset($defFilter['role_id']) && ($defFilter['role_id'] == '4' || $defFilter['role_id'] == '5')) {
				$ext = '';
				$rpar = array('division_id' => $defFilter['division_id']);
				
				if ($defFilter['role_id'] == '4') { // division_head
				} else {  // pic
					$ext = ' and a.kri_pic = ? ';
					$rpar['uid'] = $defFilter['userid'];
				}
				
				$date = date("Y-m-d");
				
				$sql = "select 
						a.*,
						date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
						b.risk_code,
						c.division_name as kri_owner_v,
						d.display_name as kri_pic_v
						from t_kri a
						left join t_risk b on a.risk_id = b.risk_id
						left join m_division c on a.kri_owner = c.division_id
						left join m_user d on a.kri_pic = d.username
						left join m_periode on m_periode.periode_id = b.periode_id
						where 
						a.kri_owner = ? and a.kri_status > 0  and a.mandatory = 'Y'
						
						".$ext." and a.".$filter_by." like '%".$filter_value."%'";
				if ($par) {
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			} else {
				return false;
			}
		}
		
		if ($mode == 'racKri') {
			
			$date = date("Y-m-d");
			
			$sql = "select 
					a.*,
					date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
					b.risk_code,
					c.division_name as kri_owner_v,
					d.display_name as kri_pic_v
					from t_kri a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_division c on a.kri_owner = c.division_id
					left join m_user d on a.kri_pic = d.username
					left join m_periode on m_periode.periode_id = b.periode_id
					where 
					a.kri_status >= 0 and a.mandatory = 'Y' and a.".$filter_by." like '%".$filter_value."%'";
		}

		if ($mode == 'racKri_non') {
			
			$date = date("Y-m-d");
			
			$sql = "select 
					a.*,
					date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
					b.risk_code,
					c.division_name as kri_owner_v,
					d.display_name as kri_pic_v
					from t_kri a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_division c on a.kri_owner = c.division_id
					left join m_user d on a.kri_pic = d.username
					left join m_periode on m_periode.periode_id = b.periode_id
					where 
					a.kri_status >= 0 and a.mandatory ='N' and a.".$filter_by." like '%".$filter_value."%'";
					
		}
		
		if ($mode == 'kriRisk') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' and (UPPER(a.risk_code) like ? or UPPER(a.risk_event) like ? or UPPER(a.risk_description) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			$sql = "select * from (select 
					a.*,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v,
					g.display_name as risk_treatment_owner_v,
					h.ref_value as suggested_risk_treatment_v
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_user g on a.risk_treatment_owner = g.username
					left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
					where 
					risk_id in (select risk_id from t_kri_risk) and a.".$filter_by." like '%".$filter_value."%'".$ext.") as another group by another.risk_code";
		}
		
		if ($mode == 'kriNotRisk') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' and (UPPER(a.risk_code) like ? or UPPER(a.risk_event) like ? or UPPER(a.risk_description) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select * from(select 
					a.*,
					b.ref_value as risk_status_v,
					c.ref_value as risk_level_v,
					d.ref_value as impact_level_v,
					e.l_title as likelihood_v,
					f.division_name as risk_owner_v,
					g.display_name as risk_treatment_owner_v,
					h.ref_value as suggested_risk_treatment_v
					from t_risk a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_user g on a.risk_treatment_owner = g.username
					left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
					where 
					a.periode_id IN ((select max(periode_id) from m_periode)-1)

					and a.risk_status > 2
					and a.risk_id not in (select risk_id from t_kri_risk) and a.".$filter_by." like '%".$filter_value."%'".$ext.") as another group by another.risk_code asc";
					
		}
		
		if ($mode == 'kriLibrary') {
			$ext = '';
			if (isset($defFilter['filter_library'])) {
				$ext = ' and (UPPER(a.kri_code) like ? or UPPER(a.key_risk_indicator) like ? or UPPER(a.mandatory) like ?) ';
				$rpar = array(
					'x1' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x2' => '%'.strtoupper($defFilter['filter_library']).'%',
					'x3' => '%'.strtoupper($defFilter['filter_library']).'%'
				);
		
				if ($par)	{ 
					$rpar['p1'] = $par['p1'];
				}
				$par = $rpar;
			}
			
			$sql = "select 
					a.*,
					date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
					case mandatory when 'Y' then 'Already'
					when 'N' then 'Not Yet' end mitigation,
					b.risk_code,
					c.division_name as kri_owner_v,
					d.display_name as kri_pic_v
					from t_kri a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_division c on a.kri_owner = c.division_id
					left join m_user d on a.kri_pic = d.username where kri_library_id is null
					".$ext;
		}
		
		if ($mode == 'allChangeByOwner') {
			$date = date("Y-m-d");
			$sql = "select a.*,
				b.risk_code
				from 
				t_cr_risk a LEFT OUTER JOIN t_risk b on a.risk_id = b.risk_id
				LEFT OUTER JOIN m_periode on m_periode.periode_id = b.periode_id
				where 
				a.created_by = ? ";
			/*$sql = "select 
					a.*,
					b.risk_code,
					b.risk_event
					from 
					t_cr_risk a join t_risk b on a.risk_id = b.risk_id
					join m_periode on m_periode.periode_id = b.periode_id
					where 
					a.created_by = ?
					
					";
			*/
			$rpar = array('user_id' => $defFilter['userid']);

			if ($par)	{ 
				$rpar['p1'] = $par['p1'];
			}
			$par = $rpar;
		}
		
		if ($mode == 'changesRac') {
			
			$date = date("Y-m-d");
			$sql = "select 
					a.*,
					b.risk_code,
					c.display_name as created_by_v
					from 
					t_cr_risk a LEFT OUTER JOIN t_risk b on a.risk_id = b.risk_id
					LEFT OUTER JOIN m_user c on a.created_by = c.username
					LEFT OUTER JOIN m_periode on m_periode.periode_id = b.periode_id
					
					
					";
		}
		
		$sql = $sql.$ex_filter.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'risk_id', true);
		return $res;
	}
	
	public function getRiskUsername($periode, $page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by == 'division_name') {
			$var = 'b.';
		}else{
			$var = 'a.';
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'display_name';
		}
		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		/*
		$sql = "SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note from m_user a join m_division b on a.division_id = b.division_id join t_risk_add_informasi c on a.username = c.risk_input_by join (SELECT risk_input_by, MAX(periode_id) AS MaxDateSubmit FROM t_risk_add_informasi GROUP BY risk_input_by) d on c.risk_input_by = d.risk_input_by and c.periode_id = d.MaxDateSubmit left join ( select min(risk_status) as risk_status, risk_input_by, periode_id from t_risk_change where risk_status > 1 and existing_control_id is null group by risk_input_by) e on a.username = e.risk_input_by  where ".$var.$filter_by." like '%".$filter_value."%'"
		*/
		$sql = "select * from(select * from(SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note 
from m_user a 
join m_division b on a.division_id = b.division_id 
join t_risk_add_informasi c on a.username = c.risk_input_by 
left join ( select min(risk_status) as risk_status, risk_input_by, periode_id from t_risk_change where risk_status > 1 and existing_control_id is null group by risk_input_by) e on a.username = e.risk_input_by  
where ".$var.$filter_by." like '%".$filter_value."%' and c.periode_id = (select max(periode_id) from m_periode) and e.risk_status is not null
UNION
SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note 
from m_user a 
join m_division b on a.division_id = b.division_id 
join t_risk_add_informasi c on a.username = c.risk_input_by 
left join ( select min(risk_status) as risk_status, risk_input_by, periode_id from t_risk where risk_status > 1 and existing_control_id is null group by risk_input_by) e on a.username = e.risk_input_by  
where ".$var.$filter_by." like '%".$filter_value."%' and c.periode_id = (select max(periode_id) from m_periode) and e.risk_status is not null
) coba2 order by coba2.risk_status asc
) coba group by coba.username"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}


	public function getRiskSubmission($periode, $page, $row, $order_by = null, $order = null, $filter_by = null, $filter_value = null)
	{
		$ex_or = $ex_filter = '';
		$par = false;
		
		if ($order_by != null) {
			$order_by = $order_by;
			$ex_or = ' order by '.$order_by.' '.$order;
		}
		
		if ($filter_by == 'division_name') {
			$var = 'b.';
		}else{
			$var = 'a.';
		}

		if ($filter_by == null || $filter_by == '' ) {
			//dibuat risk event aja biar ga error
			$filter_by = 'display_name';
		}

		
		if ($filter_by != null && $filter_value != null) {
			if($filter_value == 'ALL'){
					$filter_value = '';
				}
			
		}
		
		$sql = "select * from (select a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.periode_id from m_user a join m_division b on a.division_id = b.division_id left join t_risk_add_informasi c on a.username = c.risk_input_by where ".$var.$filter_by." like '%".$filter_value."%' and c.periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end) 
		UNION select a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, null from m_user a join m_division b on a.division_id = b.division_id left join t_risk_add_informasi c on a.username = c.risk_input_by where ".$var.$filter_by." like '%".$filter_value."%')tes group by tes.username"
				.$ex_filter
				.$ex_or;
		$res = $this->getPagingData($sql, $par, $page, $row, 'username', true);
		return $res;
	}
	
	public function getSummaryCount($mode, $defFilter) 
	{
		// MODE : risk riskregister treatment actionplan kri change
		if ($mode == 'riskLevel') {
			$sql = "select count(1) as numcount, risk_level 
					from t_risk
					where risk_input_by = ?
					group by risk_level";
			$par = array('uid' => $defFilter['userid']);
		}
		
		if ($mode == 'risk') {
			$sql = "select count(1) as numcount, risk_level 
					from t_risk
					where risk_status in (3)
					group by risk_level";
			$par = array();
		}
		
		if ($mode == 'riskregister') {
			$sql = "select count(1) as numcount
				from m_user a 
				join m_division b on a.division_id = b.division_id
				join (
					select min(risk_status) as risk_status, risk_input_by from t_risk
					where
					risk_status = 2
					group by risk_input_by
				) b on a.username = b.risk_input_by
					";
			$par = array();
		}
		
		if ($mode == 'treatment') {
			$sql = "select count(1) as numcount, risk_level 
					from t_risk
					where risk_status = 5
					group by risk_level";
			$par = array();
		}
		
		if ($mode == 'actionplan') {
			$sql = "select count(1) as numcount, b.risk_level 
					from 
					t_risk_action_plan a join t_risk b on a.risk_id = b.risk_id
					where a.action_plan_status = 3
					group by b.risk_level";
			$par = array();
		}
		
		if ($mode == 'kri') {
			$sql = "select count(1) as numcount, b.risk_level 
					from 
					t_kri a join t_risk b on a.risk_id = b.risk_id
					where 
					a.kri_status = 2
					group by b.risk_level";
			$par = array();
		}
		
		if ($mode == 'change') {
			$sql = "select count(1) as numcount, b.risk_level 
					from 
					t_cr_risk a join t_risk b on a.risk_id = b.risk_id
					where 
					a.cr_status = 0
					group by b.risk_level";
			$par = array();
		}
		
		if ($mode == 'myriskowned') {
			$sql = "select count(1) as numcount, risk_level 
					from t_risk
					where risk_status > 2
					and risk_division = ?
					group by risk_level";
			$par = array('uid' => $defFilter['division_id']);
		}
		
		if ($mode == 'myactionplan') {
			$sql = "select count(1) as numcount, b.risk_level 
					from 
					t_risk_action_plan a join t_risk b on a.risk_id = b.risk_id
					where 
					a.action_plan_status > 0
					and b.risk_division = ?
					group by b.risk_level";
			$par = array('uid' => $defFilter['division_id']);
		}
		
		if ($mode == 'mykri') {
			$sql = "select count(1) as numcount, b.risk_level 
					from 
					t_kri a join t_risk b on a.risk_id = b.risk_id
					where 
					a.kri_owner = ?
					group by b.risk_level";
			$par = array('uid' => $defFilter['division_id']);
		}
		
		
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	/* RISK QUERIES FUNCTION */
		
	/* RISK ACTION FUNCTION */
	public function riskSetConfirm($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		
		
	$periode = $data['periode_id'];

		$sql_status = "select * from t_risk where risk_library_id='$risk_id' and periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)";
		$res_status = $this->db->query($sql_status);

		if($res_status->num_rows() != true){
		$sql = "insert into t_risk(risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_code,NOW(),0,'$periode',risk_input_by,risk_input_division,risk_owner,risk_division,risk_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,null,null,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,created_by from t_risk where risk_id='$risk_id'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_control(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner, a.created_by from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$risk_id'";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,null,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, a.created_by from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$risk_id'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_impact(risk_id,impact_id,impact_level,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id ,b.impact_id,b.impact_level,a.created_by from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id ='$risk_id'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective(risk_id,objective,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,b.objective,a.created_by from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id ='$risk_id'";
		$res = $this->db->query($sql);

		//ngambil risk id terakhir
		$sql_id = "select risk_id from t_risk a where a.periode_id = '$periode' and a.risk_library_id='$risk_id'";
		$res_id = $this->db->query($sql_id);
		$row = $res_id->row();
		$hasil = $row->risk_id;

		//insert T_RISK CHANGE NYA JUGA!
		$sql = "insert into t_risk_change(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,NOW(),1,periode_id,'$uid',risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,'$uid',NOW(),'$uid' from t_risk where risk_id='$hasil'";
		$res = $this->db->query($sql);


		$sql = "insert into t_risk_control_change(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select a.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'$uid' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan_change(id,risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason,switch_flag)
				select b.id,a.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason,'$uid' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_impact_change(risk_id,impact_id,impact_level,switch_flag)
				select a.risk_id,b.impact_id,b.impact_level,'$uid' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective_change(risk_id,objective,switch_flag)
				select a.risk_id,b.objective,'$uid' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_add_user set delete_status = (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') where risk_id = '$risk_id' and username = '$uid'";
		$res = $this->db->query($sql);

		return $res;
		}else{
			//ngambil risk id terakhir
		$sql_id = "select risk_id from t_risk a where a.periode_id = '$periode' and a.risk_library_id='$risk_id'";
		$res_id = $this->db->query($sql_id);
		$row = $res_id->row();
		$hasil = $row->risk_id;

		//insert T_RISK CHANGE NYA JUGA!
		$sql = "insert into t_risk_change(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,NOW(),1,periode_id,'$uid',risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,'$uid',NOW(),'$uid' from t_risk where risk_id='$hasil'";
		$res = $this->db->query($sql);


		$sql = "insert into t_risk_control_change(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select a.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'$uid' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan_change(id,risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason,switch_flag)
				select b.id,a.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason,'$uid' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_impact_change(risk_id,impact_id,impact_level,switch_flag)
				select a.risk_id,b.impact_id,b.impact_level,'$uid' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective_change(risk_id,objective,switch_flag)
				select a.risk_id,b.objective,'$uid' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_add_user set delete_status = (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') where risk_id = '$risk_id' and username = '$uid'";
		$res = $this->db->query($sql);

		return $res;
		}


		// LOG HISTORY
		//$sql = "insert into t_risk (risk_status, periode_id, created_by, created_date) values(1, ?, ?, NOW() )";

		//$sql = "update t_risk set 
		//		risk_status = 1,
		//		periode_id = ?,
		//		created_by = ?, 
		//		created_date = NOW()
		//		where risk_id = ?";
		//$par = array(
		//	'pid' => $data['periode_id'],
		//	'uid' => $uid,
			//'rid' => $risk_id
		//);
		//$res = $this->db->query($sql, $par);

		// LOG HISTORY
		//$sql = "insert into t_risk (risk_status, periode_id, created_by, created_date) values(1, ?, ?, NOW() )";

		//$sql = "update t_risk set 
		//		risk_status = 1,
		//		periode_id = ?,
		//		created_by = ?, 
		//		created_date = NOW()
		//		where risk_id = ?";
		//$par = array(
		//	'pid' => $data['periode_id'],
		//	'uid' => $uid,
			//'rid' => $risk_id
		//);
		//$res = $this->db->query($sql, $par);
	}


	public function riskSetConfirm_recover_1($risk_id, $username, $data, $uid, $update_point = 'U') {
	
			$periode = $data['periode_id'];

		$sql_status = "select * from t_risk where risk_library_id='$risk_id' and periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)";
		$res_status = $this->db->query($sql_status);

		if($res_status->num_rows() != true){
		$sql = "insert into t_risk(risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_code,NOW(),0,'$periode',risk_input_by,risk_input_division,risk_owner,risk_division,risk_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,null,null,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,created_by from t_risk where risk_id='$risk_id'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_control(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner, a.created_by from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$risk_id'";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,null,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, a.created_by from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$risk_id'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_impact(risk_id,impact_id,impact_level,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id ,b.impact_id,b.impact_level,a.created_by from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id ='$risk_id'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective(risk_id,objective,switch_flag)
				select (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') as risk_id,b.objective,a.created_by from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id ='$risk_id'";
		$res = $this->db->query($sql);

		//ngambil risk id terakhir
		$sql_id = "select risk_id from t_risk a where a.periode_id = '$periode' and a.risk_library_id='$risk_id'";
		$res_id = $this->db->query($sql_id);
		$row = $res_id->row();
		$hasil = $row->risk_id;


		//insert T_RISK CHANGE NYA JUGA!
		$sql = "insert into t_risk_change(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,NOW(),2,periode_id,'$username',risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,'$username',NOW(),'$username' from t_risk where risk_id='$hasil'";
		$res = $this->db->query($sql);


		$sql = "insert into t_risk_control_change(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select a.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'$username' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan_change(id,risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason,switch_flag)
				select b.id,a.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason,'$username' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_impact_change(risk_id,impact_id,impact_level,switch_flag)
				select a.risk_id,b.impact_id,b.impact_level,'$username' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective_change(risk_id,objective,switch_flag)
				select a.risk_id,b.objective,'$username' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_add_user set delete_status = (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') where risk_id = '$risk_id' and username = '$username'";
		$res = $this->db->query($sql);

		return $res;
		}else{
			//ngambil risk id terakhir
		$sql_id = "select risk_id from t_risk a where a.periode_id = '$periode' and a.risk_library_id='$risk_id'";
		$res_id = $this->db->query($sql_id);
		$row = $res_id->row();
		$hasil = $row->risk_id;

		$sql_riskby = "select username from t_risk_add_user a, t_risk b where a.risk_id = b.risk_id and a.risk_id = '$risk_id'";
		$res_riskby = $this->db->query($sql_riskby);
		$row2 = $res_riskby->row();
		$userisk = $row2->username;
		//insert T_RISK CHANGE NYA JUGA!
		$sql = "insert into t_risk_change(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,NOW(),2,periode_id,'$username',risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,'$username',NOW(),'$username' from t_risk where risk_id='$hasil'";
		$res = $this->db->query($sql);


		$sql = "insert into t_risk_control_change(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select a.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'$username' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);
		

		$sql = "insert into t_risk_action_plan_change(id,risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason,switch_flag)
				select b.id,a.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason,'$uid' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);
		
		$sql = "insert into t_risk_impact_change(risk_id,impact_id,impact_level,switch_flag)
				select a.risk_id,b.impact_id,b.impact_level,'$username' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id='$hasil'";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_objective_change(risk_id,objective,switch_flag)
				select a.risk_id,b.objective,'$username' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id='$hasil' ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_add_user set delete_status = (select risk_id FROM t_risk where periode_id = '$periode' and risk_library_id = '$risk_id') where risk_id = '$risk_id' and username = '$username'";
		$res = $this->db->query($sql);

		return $res;
		}
	}

	public function riskSetConfirm_recover($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		$periode = $data['periode_id'];

		//$sql = "update t_risk_add_user set delete_status = null where risk_id='$risk_id' and username = '$uid' ";
		//$res = $this->db->query($sql);

		$sql = "update t_risk set existing_control_id = null where risk_id='$risk_id' and risk_input_by = '$uid' ";
		$res = $this->db->query($sql);


		return $res;
	}

	public function riskSetConfirm_recover_library($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		$periode = $data['periode_id'];

		$sql = "update t_risk_change set existing_control_id = null where risk_id='$risk_id' and risk_input_by = '$uid' ";
		$res = $this->db->query($sql);

		//$sql = "update t_risk set existing_control_id = null where risk_id='$risk_id' and risk_input_by = '$uid' ";
		//$res = $this->db->query($sql);

		$sql = "update t_risk_add_user set delete_status = null where risk_id='$risk_id' and username = '$uid' ";
		$res = $this->db->query($sql);
		

		return $res;

		//kaya nya ga perlu update soal nya 1 t_risk punya banya orang di t_risk_change
		//$sql = "update t_risk set existing_control_id = null where risk_id='$risk_id' and risk_input_by = '$uid' ";
		//$res = $this->db->query($sql);
	}

	public function riskSetConfirm_recover_from_add($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		$periode = $data['periode_id'];

		$sql_cek_status = "select * from t_risk where periode_id ='$periode' and risk_status > 1 and risk_input_by = '$uid'
						   UNION
						   select * from t_risk_change where periode_id ='$periode' and risk_status > 1 and risk_input_by = '$uid' ";
		$res_cek = $this->db->query($sql_cek_status);

		if($res_cek->num_rows() > 0){
		return false;
		}else{
		$sql = "update t_risk_add_user set delete_status = null where risk_id='$risk_id' and username = '$uid' ";
		$res = $this->db->query($sql);
		return $res;
		}
	}

	public function riskSetConfirm_recover_rac($risk_id, $username, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		$periode = $data['periode_id'];
		$sql = "update t_risk_add_user set delete_status = 2 where risk_id='$risk_id' and username = '$username'";
		$res = $this->db->query($sql);

		$sql = "update t_risk_change set existing_control_id = null, risk_existing_control = 3 where risk_id='$risk_id' and risk_input_by = '$username'";
		$res = $this->db->query($sql);

		return $res;
		
	}

	public function riskSetConfirm_recover_bawah_rac($risk_id, $username, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);

		$sql = "update t_risk set existing_control_id = null where risk_id='$risk_id'";
		$res = $this->db->query($sql);

		$sql = "update t_risk_change set existing_control_id = null where risk_id='$risk_id'";
		$res = $this->db->query($sql);

		return $res;
		
	}

	public function riskSetDelete_recover_rac($risk_id, $username, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		$periode = $data['periode_id'];
		$sql = "update t_risk_add_user set delete_status = 2 where risk_id='$risk_id' and username = '$username'";
		$res = $this->db->query($sql);

		$sql = "update t_risk_change set existing_control_id = null, risk_existing_control = 4 where risk_id='$risk_id' and risk_input_by = '$username'";
		$res = $this->db->query($sql);

		return $res;
		
	}

//ubah maintenance
	public function riskSetConfirm_under($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		//$periode = $data['periode_id'];
		$sql = "update t_risk set risk_existing_control = 'under' where risk_id='$risk_id'";
		$res = $this->db->query($sql);
		
		return $res;
	}
	
	public function riskSetDraft($risk_id, $data, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		
		$sql = "update t_risk set 
				risk_status = 0,
				created_by = ?, 
				created_date = NOW()
				where risk_id = ?";
		$par = array(
			'uid' => $uid,
			'rid' => $risk_id
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function riskSetDraftByPeriode($periode_id, $uid) {
		// LOG HISTORY
		$sql = "insert into t_risk_hist
				select a.*, 
					'RISK_REGISTER-SETDRAFT_PERIODE' as update_status, '".$uid."' as update_by, NOW() as update_date
				from t_risk a
				where 
				a.periode_id is not null
				and a.periode_id = ?
				and a.risk_status = '1'
				and a.risk_input_by = ?
				";
		$par = array(
			'pid'=>$periode_id,
			'uid'=>$uid
		);
		$this->db->query($sql, $par);	
		
		$sql = "update t_risk set 
				risk_status = 1,
				created_by = ?, 
				created_date = NOW()
				where
				periode_id is not null
				and periode_id = ?
				and risk_status = '1'
				and risk_input_by = ?
				";
		$par = array(
			'uid' => $uid,
			'pid' =>$periode_id,
			'uid2' =>$uid
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	
	
	public function riskSetSubmitByPeriode($periode_id, $uid) {
		// LOG HISTORY
		$sql = "insert into t_risk_hist
				select a.*, 
					'RISK_REGISTER-SUBMIT_PERIODE' as update_status, '".$uid."' as update_by, NOW() as update_date
				from t_risk a
				where 
				a.periode_id is not null
				and a.periode_id = ?
				and a.risk_status in ('0', '1')
				and a.risk_input_by = ?
				";
		$par = array(
			'pid'=>$periode_id,
			'uid'=>$uid
		);
		$this->db->query($sql, $par);	

		$sql = "insert into t_risk_add_informasi (risk_input_by,periode_id,tanggal_submit) values (?, ?, NOW())";
		$par = array(
			'uid'=>$uid,
			'pid'=>$periode_id
		);
		$this->db->query($sql, $par);	
		
		$sql = "update t_risk set 
				risk_status = 2,
				created_by = ?, 
				created_date = NOW(),
				risk_date = NOW()
				where
				periode_id is not null
				and periode_id = ?
				and risk_status in ('0', '1')
				and risk_input_by = ? and risk_library_id is null
				";
		$par = array(
			'uid' => $uid,
			'pid' =>$periode_id,
			'uid2' =>$uid
		);

		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_change set 
				risk_status = 2,
				created_by = ?, 
				created_date = NOW(),
				risk_date = NOW()
				where
				periode_id is not null
				and periode_id = ?
				and risk_status in ('0', '1')
				and risk_input_by = ?
				";
		$par = array(
			'uid' => $uid,
			'pid' =>$periode_id,
			'uid2' =>$uid
		);
		$res = $this->db->query($sql, $par);

		return $res;
	}
	
	public function riskSetSubmitByPeriode2($periode_id, $uid) {
		// LOG HISTORY
		$sql2 = "select cr_code from t_cr_risk ORDER BY id DESC LIMIT 1  ";
		$query = $this->db->query($sql2);
		if ($query->num_rows() > 0){	
		$row = $query->row();	
		$hasil1 = $row->cr_code;
		}else{
		$hasil1 = 'CH.000001';
		} 
		$hasil2 = substr($hasil1, 4);
		$hasil3 = $hasil2 + 1 ;
		$hasil4 = strlen($hasil3);
		$hasil5 = 9 - $hasil4;
		$hasil6 = substr($hasil1,0,$hasil5);
		$hasil = $hasil6.$hasil3;
		$cr_type = "Risk Register";

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sql = "insert into t_cr_risk (cr_code,cr_type,cr_status,created_by,created_date) values ('$hasil','$cr_type',0,'$uid',NOW())";
		
		$res = $this->db->query($sql);
		return $res;
	}

	public function riskSetSubmitByPeriode2_change($periode_id, $uid) {
		
		$sql = "update t_cr_risk set cr_status = 1 where created_by = '$uid' and cr_type= 'Risk Register' " ;
		
		$sql2 = "update t_risk set risk_status = 0 where periode_id='$periode_id' and risk_input_by='$uid' and risk_library_id is null";

		$sql3 = "update t_risk_change set risk_status = 0 where periode_id='$periode_id' and risk_input_by='$uid' ";

		$sql4 = "delete from t_risk_add_informasi where periode_id='$periode_id' and risk_input_by='$uid' ";
		
		$res = $this->db->query($sql);
		$res = $this->db->query($sql2);
		$res = $this->db->query($sql3);
		$res = $this->db->query($sql4);
		
		
		return $res;
	}
	public function riskSetSubmitByPeriode2_ignore($periode_id, $uid) {
		
		$sql = "update t_cr_risk set cr_status = 1 where created_by = '$uid' and cr_type= 'Risk Register' " ;
		$res = $this->db->query($sql);
		return $res;
	}

	public function deleteRisk($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['risk_id'] = $risk_id;
		
		

		$sql = "update t_risk_add_user set delete_status = 1 where risk_id = '$risk_id' and username = '$uid' ";
		$res = $this->db->query($sql);

		//$sql = "update t_risk set existing_control_id = 1 where risk_id = ? and risk_input_by = '$uid' ";
		//$res = $this->db->query($sql, $par);

		$sql = "update t_risk_change set existing_control_id = 1 where risk_id = ? and risk_input_by = '$uid' ";
		$res = $this->db->query($sql, $par);

		return $res;
	}

//Oktober 10/16

	public function deleteRisk_up($risk_id, $data, $uid, $update_point = 'U') {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		//$periode = $data['periode_id'];
		$sql = "update t_risk set risk_existing_control = 'under' where risk_id='$risk_id'";
		$res = $this->db->query($sql);
		
		return $res;
	}

	public function deleteRiskgrid2($risk_id, $uid, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;
		
		$sql = "delete from t_risk where risk_id = ? and risk_input_by = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_control where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_impact where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_objective where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function deleteRiskgrid2Bentrok($risk_id, $uid, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;
		
		$sql = "update t_risk set risk_evaluation_control = 'delete_roll_from_modify' where risk_id = ? and risk_input_by = '$uid' ";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function deleteRiskgrid2fromlibrary($risk_id, $uid, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;
		
		$sql = "update t_risk_add_user set delete_status = 1 where delete_status = '$risk_id' and username = '$uid'";
		$res = $this->db->query($sql);

		$sql = "delete from t_risk_change where risk_id = ? and risk_input_by = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_impact_change where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_control_change where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_objective_change where risk_id = ? and switch_flag = '$uid' ";
		$res = $this->db->query($sql, $par);

		return $res;
	}

// oktober 11/16
	public function deleteRiskgrid2_rac($risk_id, $username, $uid, $data, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;

		$sql = "update t_risk set existing_control_id = 10, risk_existing_control = 'delete_permanent' where risk_id= ?";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_change set existing_control_id = 10, risk_existing_control = 'delete_permanent' where risk_id= ?";
		$res = $this->db->query($sql, $par);
/*
		$sql = "delete from t_risk_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_action_plan_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_control_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_impact_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_objective_change where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk where risk_id = ? and risk_input_by = '$username'";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_action_plan where risk_id = ? and risk_input_by = '$username'";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_control where risk_id = ? and risk_input_by = '$username'";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_impact where risk_id = ? and risk_input_by = '$username'";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_objective where risk_id = ? and risk_input_by = '$username'";
		$res = $this->db->query($sql, $par);
*/
		return $res;
	}

	public function deleteRiskgrid2Bentrok_rac($risk_id, $uid, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;
		
		$sql = "update t_risk set risk_evaluation_control = 'delete_roll_from_modify' where risk_id = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function deleteRiskgrid2fromlibrary_rac($risk_id, $uid, $update_point = 'D') {
		
		$par['risk_id'] = $risk_id;
		
		
		$sql = "delete from t_risk_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_impact_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_action_plan_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_control_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$sql = "delete from t_risk_objective_change where risk_id = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}

//---------------------------------


	public function deleteRiskrac($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set existing_control_id = 3 where risk_id = ?";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_change set existing_control_id = 3 where risk_id = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}
//ubah
	public function deleteRiskModify($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['risk_id'] = $risk_id;

		$sql_change = "select * from t_risk_change where risk_id = '$risk_id' and risk_input_by = '$uid'";
		$res_change = $this->db->query($sql_change);

		if($res_change->num_rows() > 0){
			$sql = "update t_risk_change set existing_control_id = 2 where risk_id = ? and risk_input_by ='$uid' ";
			$res = $this->db->query($sql, $par);
			return $res;
		}else{
			$sql = "update t_risk set existing_control_id = 2 where risk_id = ? and risk_input_by ='$uid' ";
			$res = $this->db->query($sql, $par);
			return $res;
		}

		return true;
	}

	
//ubah under
	public function deleteRisk_under($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['risk_id'] = $risk_id;
		
		$sql = "update t_risk set risk_existing_control = null where risk_id = ?";
		$res = $this->db->query($sql, $par);

		return $res;
	}
	/*
	public function deleteRisk($risk_id, $uid, $update_point = 'D') {
		// delete risk in child
		// t_risk t_risk_change t_risk_action_plan t_risk_action_plan_change 
		// t_risk_control t_risk_control_change t_risk_impact t_risk_impact_change
		
		$par['risk_id'] = $risk_id;
		
		$sql = "delete from t_risk_action_plan where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_action_plan_change where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_control where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_control_change where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_impact where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_impact_change where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_change where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		$this->_logHistory($risk_id, $uid, $update_point);
		
		$sql = "delete from t_risk where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		return $res;
	}
	*/

	public function updateRiskModify($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
					

			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				
					/*$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division, switch_flag) 
							values('27', 'not action plan', '1111-11-11', 'not action plan', 'A)";
					$this->db->query($sql);*/
					
				}else{
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division) 
							values(?, ?, ?, ?)";
							foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
						);
					$res4 = $this->db->query($sql, $par);
					}
				}
			}
				
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			// insert objective
			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRiskModifyLibrary($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_change set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ? and risk_input_by = '$uid'";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact_change where risk_id = ? and switch_flag = '$uid'";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact_change(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, '$uid')";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '$uid'";
					$this->db->query($sql, array('rid' => $risk_id));
				
					/*$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division, switch_flag) 
							values('27', 'not action plan', '1111-11-11', 'not action plan', 'A)";
					$this->db->query($sql);*/
					
				}else{
					$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '$uid'";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan_change(risk_id, action_plan, due_date, division, switch_flag) 
							values(?, ?, ?, ?, '$uid')";
					foreach ($actplan as $key => $value) {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
						);
						$res4 = $this->db->query($sql, $par);
					}
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control_change where risk_id = ? and switch_flag = '$uid' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control_change(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag) 
						values(?, ?, ?, ?, ?, '$uid')";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			// insert objective
			if ($objective !== false) {
				$sql = "delete from t_risk_objective_change where risk_id = ? and switch_flag = '$uid' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective_change(
							risk_id, objective, switch_flag) 
						values(?, ?, '$uid')";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRiskModify_tmp($risk_id, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

			// insert action plan
			if ($actplan !== false) {
				$sql = "delete from t_risk_action_plan_tmp where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_action_plan_tmp(risk_id, action_plan, due_date, division) 
						values(?, ?, ?, ?)";
				foreach ($actplan as $key => $value) {
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
				return true;
			}else{
				return false;
			}
			
		
	}

	public function updateRisk($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?  and risk_input_by = '$uid'";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? and switch_flag = '$uid'";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, '$uid')";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag = '$uid'";
					$this->db->query($sql, array('rid' => $risk_id));
				}else{
						$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag = '$uid'";
						$this->db->query($sql, array('rid' => $risk_id));
				
						$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division, switch_flag) 
								values(?, ?, ?, ?, '$uid')";
						foreach ($actplan as $key => $value) {
								$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
								$par = array(
									'rid' => $risk_id,
									'ap' => $value['action_plan'],
									'dd' => $dd,
									'div' => $value['division']
						);
						$res4 = $this->db->query($sql, $par);
					}
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ? and switch_flag = '$uid'";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag) 
						values(?, ?, ?, ?, ?, '$uid')";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRisk_cr($ch_id, $risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		return $res;
	}

	public function updateRiskDelete($risk_id, $code, $risk, $impact, $actplan, $control, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		//$par['risk_id'] = $risk_id;
		//$sql = "update t_risk set ".$keyupdate
		//	  ."created_date = now()
		//	  	where risk_id = ?  and risk_input_by = '$uid'";
		//$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set existing_control_id = 2 where risk_id = '$risk_id'";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_change set existing_control_id = 2 where risk_id = '$risk_id'";
		$res = $this->db->query($sql, $par);


		/* Di ganti karena ada recycle bin
		$sql = "delete from t_risk where risk_id = '$risk_id'";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
				$sql = "delete from t_risk_impact where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));
				
			// insert action plan
				$sql = "delete from t_risk_action_plan where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));
				
			// insert control
				$sql = "delete from t_risk_control where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));

			// insert control
				$sql = "delete from t_risk_objective where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));


		// ini delete change nya
				$sql = "delete from t_risk_change where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));
				
			// insert action plan
				$sql = "delete from t_risk_action_plan_change where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));
				
			// insert control
				$sql = "delete from t_risk_control_change where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));

			// insert control
				$sql = "delete from t_risk_objective_change where risk_id = '$risk_id'";
				$res = $this->db->query($sql, array('rid' => $risk_id));
			
			
			return true;
		} else {
			return false;
		} */
		
		return true;
		
	}

//ini untuk verify risk owner
	public function updateRiskverify($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set 
				risk_status = '".$risk['risk_status']."', 
				risk_level = '".$risk['risk_level']."', 
				risk_impact_level = '".$risk['risk_impact_level']."', 
				risk_likelihood_key = '".$risk['risk_likelihood_key']."', 
				risk_owner = '".$risk['risk_owner']."', 
				suggested_risk_treatment = '".$risk['suggested_risk_treatment']."',
				risk_cause = '".$risk['risk_cause']."', 
				risk_impact = '".$risk['risk_impact']."'
			  	where risk_id = ".$risk_id." ";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_owner']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);

		
		// insert action plan
			if ($actplan !== false) {

				$sql = "select * from t_risk_action_plan where risk_id = ?  ";
				$data_ap = $this->db->query($sql, array('rid' => $risk_id))->row_array();

				$sql = "delete from t_risk_action_plan where risk_id = ?  ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				if($suggested_rt == 'ACCEPT'){

				}else{
						$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division, switch_flag) 
							values(?, ?, ?, ?, 'P')";
						foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
								'rid' => $risk_id,
								'ap' => $value['action_plan'],
								'dd' => $dd,
								'div' => $value['division']
						);
						$res4 = $this->db->query($sql, $par);
					}


							$par['risk_id'] = $risk_id;
							$sql = "insert into m_action_plan(action_plan, division) 
									select t1.action_plan, t1.division from t_risk_action_plan t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
									$res = $this->db->query($sql, $par);
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?  ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag) 
						values(?, ?, ?, ?, ?, 'P' )";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}

				$par['risk_id'] = $risk_id;
				$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
						select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
				$res = $this->db->query($sql, $par);
			}

			//objective
			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?  ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id, objective, switch_flag) 
						values(?, ?, 'P' )";
				$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
				foreach ($objective as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}

				$par['risk_id'] = $risk_id;
					$sql = "insert ignore into m_objective(objective) 
							select t1.objective from t_risk_objective t1 where t1.risk_id = '".$risk_id."'";
				$res = $this->db->query($sql, $par);
			}

		//update assgin to action plan nih
		
		// insert action plan
		if($suggested_rt == 'ACCEPT'){

		}else{
				$sql = "update t_risk_action_plan set assigned_to = (select username from m_user where division_id = ? and role_id = 4)
			  	where risk_id = ? and division = ? ";
				foreach ($actplan as $key => $value) {
					$par = array(
						'div' => $value['division'],
						'rid' => $risk_id,
						'div2' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
		}
		

		//$sql = "update t_risk_action_plan set assigned_to = (select username from m_user where division_id = '".$risk['risk_owner']."' and role_id = 4)
		//	  	where risk_id = '".$risk_id."' ";
		//$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set action_plan_status = 1 where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql, $par);
		
			$par['risk_id'] = $risk_id;
			$sql="delete from t_risk_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_impact_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_action_plan_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_control_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_objective_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_own 
				  select * from t_risk where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_impact_own (risk_id, impact_id, impact_level, switch_flag) 
				  select risk_id, impact_id, impact_level, switch_flag from t_risk_impact where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, b.switch_flag from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_control_own (risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag) 
				  select risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag from t_risk_control where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_objective_own (risk_id, objective, switch_flag) 
				  select risk_id, objective, switch_flag from t_risk_objective where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

			return true;
		
	}

//november 2016
	public function updateRiskverifyPrimary($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;

		$sql = "update t_risk set 
				risk_status = '".$risk['risk_status']."', 
				risk_owner = '".$risk['risk_owner']."'
			  	where risk_id = ".$risk_id." ";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_owner']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);

		if($suggested_rt == 'ACCEPT'){

		}else{
			$sql = "update t_risk_action_plan set switch_flag = 'P' where risk_id = '".$risk_id."'";
			$res = $this->db->query($sql, $par);
		}

		$sql = "update t_risk_control set switch_flag = 'P' where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_objective set switch_flag = 'P' where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		if($suggested_rt == 'ACCEPT'){

		}else{
				$sql = "update t_risk_action_plan set assigned_to = (select username from m_user where division_id = ? and role_id = 4)
			  	where risk_id = ? and division = ? ";
				foreach ($actplan as $key => $value) {
					$par = array(
						'div' => $value['division'],
						'rid' => $risk_id,
						'div2' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
		}


		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_owner']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set action_plan_status = 1 where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into m_action_plan(action_plan, division) 
				select t1.action_plan, t1.division from t_risk_action_plan t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
				select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert ignore into m_objective(objective) 
				select t1.objective from t_risk_objective t1 where t1.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
			$par['risk_id'] = $risk_id;
			$sql="delete from t_risk_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_impact_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_action_plan_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_control_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$sql="delete from t_risk_objective_own where risk_id = '".$risk_id."' and switch_flag = 'P' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_own 
				  select * from t_risk where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_impact_own (risk_id, impact_id, impact_level, switch_flag) 
				  select risk_id, impact_id, impact_level, switch_flag from t_risk_impact where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, b.switch_flag from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_control_own (risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag) 
				  select risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag from t_risk_control where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_objective_own (risk_id, objective, switch_flag) 
				  select risk_id, objective, switch_flag from t_risk_objective where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

			return true;
	}

// save verify RAC pada bagian changes
	public function updateRisksave($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $userasli, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_change set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?  and risk_input_by = '".$userasli."'";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact_change where risk_id = ? and switch_flag = '".$userasli."' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact_change(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, '".$userasli."' )";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '".$userasli."' ";
					$this->db->query($sql, array('rid' => $risk_id));
				}else{
					$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '".$userasli."' ";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan_change(risk_id, action_plan, due_date, division, switch_flag) 
							values(?, ?, ?, ?, '".$userasli."')";
					foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
						);
					$res4 = $this->db->query($sql, $par);
					}
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control_change where risk_id = ? and switch_flag = '".$userasli."' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control_change(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag) 
						values(?, ?, ?, ?, ?, '".$userasli."' )";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			// insert objective
			if ($objective !== false) {
				$sql = "delete from t_risk_objective_change where risk_id = ? and switch_flag = '".$userasli."' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective_change(
							risk_id, objective, switch_flag) 
						values(?, ?, '".$userasli."' )";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}
			
			return true;
		} else {
			return false;
		}
		
	}

//verify rac to T-risk pertama kali
	public function updateRiskrac($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ? ";
		$res = $this->db->query($sql, $par);

		//update assign to suggested risk treatment
		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);
		
		/*$sql = "insert into t_verify_by(risk_id,verify_by,date_verify)values('$risk_id', '$uid', NOW())";
		$res = $this->db->query($sql);*/

		$sql = "delete from t_risk_add_user where risk_id ='".$risk_id."' and username ='".$risk['risk_input_by']."' ";
		$res = $this->db->query($sql);

		$sql_date = "SELECT tanggal_submit FROM t_risk_add_informasi WHERE periode_id = (SELECT MAX(periode_id) FROM t_risk_add_informasi) AND risk_input_by ='".$risk['risk_input_by']."'";
		$res_date = $this->db->query($sql_date)->row();
		$date_changed = $res_date->tanggal_submit;

		$sql = "insert into t_risk_add_user (risk_id,username,date_changed) values(?, ? ,'$date_changed')";
		$par = array(
			'rid' => $risk_id,
			'un' => $risk['risk_input_by']
		);
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_properties set status = 'change request' where risk_id ='".$risk_id."' and username ='".$risk['risk_input_by']."' and status = 'submitted'";
		$res = $this->db->query($sql);


		$sql = "insert into t_risk_properties (risk_id, risk_code, username, date_changed, status) values(?, ? ,? ,'$date_changed', 'submitted')";
		$par = array(
			'rid' => $risk_id,
			'ric' => $code,
			'un' => $risk['risk_input_by']
		);
		$res = $this->db->query($sql, $par);		

		$sql = "insert into t_risk_properties (risk_id, risk_code, username, date_changed, status) values(?, ? ,? ,NOW(), 'verify')";
		$par = array(
			'rid' => $risk_id,
			'ric' => $code,
			'un' => $uid
		);
		$res = $this->db->query($sql, $par);


		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				}else{
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division) 
							values(?, ?, ?, ?)";
					foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
					}

					$par['risk_id'] = $risk_id;
							$sql = "insert into m_action_plan(action_plan, division) 
									select t1.action_plan, t1.division from t_risk_action_plan t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
									$res4 = $this->db->query($sql, $par);
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
				$par['risk_id'] = $risk_id;
				$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
						select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
				$res5 = $this->db->query($sql, $par);
			}

			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}

				$sql = "insert ignore into m_objective(objective) 
						values(?)";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}

//update P pada T-risk nya walaupun bukan dari library
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_impact set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_control set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_objective set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_own(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,risk_date,'3' as risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,'P' from t_risk where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_control_own(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select b.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'P' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, 'P' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_impact_own(risk_id,impact_id,impact_level,switch_flag)
				select b.risk_id,b.impact_id,b.impact_level,'P' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_objective_own(risk_id,objective,switch_flag)
				select b.risk_id,b.objective,'P' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
	 		
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRiskracUnder($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  where risk_id = ? ";
		$res = $this->db->query($sql, $par);

		//update assign to suggested risk treatment
		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);
		
		/*$sql = "insert into t_verify_by(risk_id,verify_by,date_verify)values('$risk_id', '$uid', NOW())";
		$res = $this->db->query($sql);*/
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				}else{
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division) 
							values(?, ?, ?, ?)";
					foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
					}

					$par['risk_id'] = $risk_id;
							$sql = "insert into m_action_plan(action_plan, division) 
									select t1.action_plan, t1.division from t_risk_action_plan t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
									$res4 = $this->db->query($sql, $par);
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
				$par['risk_id'] = $risk_id;
				$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
						select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
				$res5 = $this->db->query($sql, $par);
			}

			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}

				$sql = "insert ignore into m_objective(objective) 
						values(?)";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}

//update P pada T-risk nya walaupun bukan dari library
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_impact set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_control set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_objective set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_control_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_action_plan_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_impact_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_objective_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_own(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,risk_date,'3' as risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,'P' from t_risk where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_control_own(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select b.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,'P' from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, 'P' from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_impact_own(risk_id,impact_id,impact_level,switch_flag)
				select b.risk_id,b.impact_id,b.impact_level,'P' from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;	
		$sql = "insert into t_risk_objective_own(risk_id,objective,switch_flag)
				select b.risk_id,b.objective,'P' from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
	 		
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRiskracUnder2($risk_id, $suggested_rt, $code, $risk, $impact, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  where risk_id = ? ";
		$res = $this->db->query($sql, $par);

		//update assign to suggested risk treatment
		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);
		
		/*$sql = "insert into t_verify_by(risk_id,verify_by,date_verify)values('$risk_id', '$uid', NOW())";
		$res = $this->db->query($sql);*/
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan

			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
				$par['risk_id'] = $risk_id;
				$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
						select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
				$res5 = $this->db->query($sql, $par);
			}

			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}

				$sql = "insert ignore into m_objective(objective) 
						values(?)";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}

//update P pada T-risk nya walaupun bukan dari library
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_impact set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_control set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_objective set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);	 		
			
			return true;
		} else {
			return false;
		}
		
	}

	//verify rac to T-risk pertama kali (SAVE)
	public function updateRiskracsave($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ? ";
		$res = $this->db->query($sql, $par);

		//update assign to suggested risk treatment
		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_risk_action_plan where risk_id = ?";
					$this->db->query($sql, array('rid' => $risk_id));
				}else{
				$sql = "delete from t_risk_action_plan where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_action_plan(risk_id, action_plan_status, action_plan, due_date, division, assigned_to) 
						values(?, 1, ?, ?, ?, (select username from m_user where division_id = ?  and role_id = 4))";
				foreach ($actplan as $key => $value) {
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division'],
						'asg' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			// insert objective
			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_objective(
							risk_id,objective) 
						values(?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}

//update P pada T-risk nya walaupun bukan dari library
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_impact set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_control set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_objective set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

			/* ini untuk sava kayak nya ga kepake
			$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_change 
				  select * from t_risk where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_impact_change (risk_id, impact_id, impact_level, switch_flag) 
				  select risk_id, impact_id, impact_level, switch_flag from t_risk_impact where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_action_plan_change ( )
				  select * from t_risk_action_plan where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_control_change (risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag) 
				  select risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag from t_risk_control where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);

	 		$par['risk_id'] = $risk_id;
			$sql="insert into t_risk_objective_change ( )
				  select * from t_risk_objective where risk_id = '".$risk_id."' ";
	 		$res = $this->db->query($sql, $par);
	 		*/
			
			return true;
		} else {
			return false;
		}
		
	}

//verify rac lanjutan to T-risk changes
	public function updateRiskracchanges($risk_id, $code, $risk, $impact, $actplan, $control, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		//$par = array();
		//$keyupdate = '';
		//foreach($risk as $k=>$v) {
		//	$keyupdate .= $k.' = ?, ';
		//	$par[$k] = $v;
		//}

		//insert baru dulu buat dapet ID
		$sql = "INSERT INTO t_risk_change SELECT * FROM t_risk where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);

		//$par['risk_id'] = $risk_id;
		//$sql = "update t_risk_change set ".$keyupdate
		//	  ."created_date = now()
		//	  	where risk_id = ? ";
		//$res = $this->db->query($sql, $par);

		//update assign to suggested risk treatment
		//$sql = "update t_risk_change
		//		set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
		//	  	where risk_id = '".$risk_id."' ";
		//$res = $this->db->query($sql);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				//$sql = "delete from t_risk_impact_change where risk_id = ? ";
				//$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact_change(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				//$sql = "delete from t_risk_action_plan_change where risk_id = ?";
				//$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_action_plan_change(risk_id, action_plan, due_date, division) 
						values(?, ?, ?, ?)";
				foreach ($actplan as $key => $value) {
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
			}
			
			// insert control
			if ($control !== false) {
				//$sql = "delete from t_risk_control_change where risk_id = ?";
				//$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control_change(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRisk1($risk_id, $code, $risk, $impact, $actplan, $control, $objective, $uid, $userasli, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		//update assign to suggested risk treatment
		$sql = "update t_risk 
				set risk_treatment_owner = (select username from m_user where division_id = '".$risk['risk_division']."'  and role_id = 4) 
			  	where risk_id = '".$risk_id."' ";
		$res = $this->db->query($sql);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now(),switch_flag = 'P'
			  	where risk_id = ?  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_impact set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into m_action_plan(action_plan, division) 
				select t1.action_plan, t1.division from t_risk_action_plan t1 where t1.risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_control set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into m_control(risk_existing_control, risk_evaluation_control, risk_control_owner) 
				select t1.risk_existing_control, t1.risk_evaluation_control, t1.risk_control_owner from t_risk_control t1 where t1.risk_id = '".$risk_id."' and NOT EXISTS(select t2.risk_existing_control, t2.risk_evaluation_control, t2.risk_control_owner from m_control t2 where t1.risk_existing_control = t2.risk_existing_control and t1.risk_evaluation_control = t2.risk_evaluation_control and t1.risk_control_owner = t2.risk_control_owner)";
		$res = $this->db->query($sql, $par);

		//update objective
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_objective set switch_flag = 'P'
			  	where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert ignore into m_objective(objective) 
				select t1.objective from t_risk_objective t1 where t1.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);


		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_change set risk_status = '3', switch_flag = 'P'
		 where risk_id = '".$risk_id."' and created_by = '".$userasli."' and periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)";
	 	$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql_own = "select * from t_risk_own where risk_id = '".$risk_id."' and periode_id = (select periode_id from m_periode where DATE(NOW()) between periode_start and periode_end)";
		$res_own = $this->db->query($sql_own, $par);

		if($res_own->num_rows() != true){
			$par['risk_id'] = $risk_id;
			$sql = "insert into t_risk_own(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag from t_risk where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_control_own(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select b.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,b.switch_flag from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, b.switch_flag from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_impact_own(risk_id,impact_id,impact_level,switch_flag)
				select b.risk_id,b.impact_id,b.impact_level,b.switch_flag from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_objective_own(risk_id,objective,switch_flag)
				select b.risk_id,b.objective,b.switch_flag from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		return $res;
		}else{

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_control_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_action_plan_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_impact_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_objective_own where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_own(risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag)
				select risk_id,risk_code,risk_date,risk_status,periode_id,risk_input_by,risk_input_division,risk_owner,risk_division,risk_library_id,risk_event,risk_description,risk_category,risk_sub_category,risk_2nd_sub_category,risk_cause,risk_impact,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,risk_level,risk_impact_level,risk_likelihood_key,suggested_risk_treatment,risk_treatment_owner,created_by,created_date,switch_flag from t_risk where risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_control_own(risk_id,existing_control_id,risk_existing_control,risk_evaluation_control,risk_control_owner,switch_flag)
				select b.risk_id,b.existing_control_id,b.risk_existing_control,b.risk_evaluation_control,b.risk_control_owner,b.switch_flag from t_risk a,t_risk_control b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		
		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_action_plan_own(risk_id,action_plan_status,action_plan,due_date,division,execution_status,execution_explain,execution_evidence,execution_reason, switch_flag)
				select b.risk_id,b.action_plan_status,b.action_plan,b.due_date,b.division,b.execution_status,b.execution_explain,b.execution_evidence,b.execution_reason, b.switch_flag from t_risk a,t_risk_action_plan b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_impact_own(risk_id,impact_id,impact_level,switch_flag)
				select b.risk_id,b.impact_id,b.impact_level,b.switch_flag from t_risk a,t_risk_impact b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into t_risk_objective_own(risk_id,objective,switch_flag)
				select b.risk_id,b.objective,b.switch_flag from t_risk a,t_risk_objective b where a.risk_id = b.risk_id and a.risk_id = '".$risk_id."'";
		$res = $this->db->query($sql, $par);
		/*$sql = "insert into t_verify_by(risk_id,verify_by,date_verify)values('$risk_id', '$uid', NOW())";
		$res = $this->db->query($sql);*/

		return $res;
		}	 	

		return true;
	}



	public function updateRisk2($risk_id, $risk_library, $suggested_rt, $risk_input_by, $code, $risk, $impact, $actplan, $control, $objective, $uid, $update_point = 'U') {
		 
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$par['risk_library_id'] = $risk_library;

		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?  ";
		$res = $this->db->query($sql, $par);


		/*$sql = "update t_risk set risk_status = 2
			  	where risk_id = '$risk_id' ";
		$res = $this->db->query($sql, $par);*/

		/*$sql = "update t_risk_change set risk_status = 2
			  	where risk_id = '$risk_id' and risk_input_by = '$risk_input_by' ";
		$res = $this->db->query($sql, $par);*/


		if ($res) {
			 
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
					$sql = "update t_risk_action_plan set switch_flag = 'C' where risk_id = ? ";
					$this->db->query($sql, array('rid' => $risk_id));
				
				if($suggested_rt == 'ACCEPT'){

				}else{
					$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division) 
							values(?, ?, ?, ?)";
					foreach ($actplan as $key => $value) {
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
								'rid' => $risk_id,
								'ap' => $value['action_plan'],
								'dd' => $dd,
								'div' => $value['division']
							);
					$res4 = $this->db->query($sql, $par);
					}
				}

					$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '$risk_input_by' ";
					$this->db->query($sql, array('rid' => $risk_id));
				
					$sql = "insert into t_risk_action_plan_change(risk_id, action_plan, due_date, division, switch_flag) 
							select risk_id, action_plan, due_date, division, '$risk_input_by' from t_risk_action_plan where risk_id = ? and switch_flag = 'C'";
							$this->db->query($sql, array('rid' => $risk_id));

					$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag = 'C' ";
					$this->db->query($sql, array('rid' => $risk_id));
			}
			
			// insert control
			if ($control !== false) {
				$sql = "update t_risk_control set switch_flag = 'C' where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}

				$sql = "delete from t_risk_control_change where risk_id = ? and switch_flag = '$risk_input_by' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control_change(risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag) 
						select risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, '$risk_input_by' from t_risk_control where risk_id = ? and switch_flag = 'C'";
						$this->db->query($sql, array('rid' => $risk_id));

				$sql = "delete from t_risk_control where risk_id = ? and switch_flag = 'C' ";
				$this->db->query($sql, array('rid' => $risk_id));
			}

			// insert objective
			if ($objective !== false) {
				$sql = "update t_risk_objective set switch_flag = 'C' where risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));

				
				$sql = "insert ignore into t_risk_objective(
							 id, risk_id, objective) 
						values(?, ?, ? )";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'id' => $value['objective_id'],
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}

				$sql = "delete from t_risk_objective where risk_id = ? and objective = ? and switch_flag = ?";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => 0,
						'ob' => $value['objective'],
						'sf' => 'D'

					);
					$res7 = $this->db->query($sql, $par);
				}


				$sql = "delete from t_risk_objective_change where risk_id = ? and switch_flag = '$risk_input_by' ";
				$this->db->query($sql, array('rid' => $risk_id));

				$sql = "insert into t_risk_objective_change(risk_id, objective, switch_flag) 
						select risk_id, objective, '$risk_input_by' from t_risk_objective where risk_id = ? and switch_flag = 'C'";
				$this->db->query($sql, array('rid' => $risk_id));


				$sql = "delete from t_risk_objective where switch_flag = 'C' and risk_id = ? ";
				$this->db->query($sql, array('rid' => $risk_id));

				$sql = "insert ignore into t_risk_objective(
						id, risk_id, objective, switch_flag) 
						values(?, ?, ?, ? )";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'id' => $value['objective_id'],
						'rid' => 0,
						'ob' => $value['objective'],
						'sf' => 'D'

					);
					$res8 = $this->db->query($sql, $par);
				}

			}
			
			return true;
		} else {
			return false;
		}
		
	}

	public function updateRisk_primary($risk_id, $suggested_rt, $code, $risk, $impact, $actplan, $control, $uid, $update_point = 'U') {
		$this->_logHistory($risk_id, $uid, $update_point);
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_risk_impact where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			if ($actplan !== false) {
				$sql = "delete from t_risk_action_plan where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				if($suggested_rt == 'ACCEPT'){

				}else{
					$sql = "insert into t_risk_action_plan(risk_id, action_plan, due_date, division) 
						values(?, ?, ?, ?)";
					foreach ($actplan as $key => $value) {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'rid' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division']
						);
						$res4 = $this->db->query($sql, $par);
					}
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			if ($objective !== false) {
				$sql = "delete from t_risk_objective where risk_id = ?";
				$this->db->query($sql, array('rid' => $risk_id));

				$sql = "insert into t_risk_objective(
						risk_id, objective, switch_flag) 
						values(?, ?, 'P')";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			}
			return true;
		} else {
			return false;
		}
		
	}
	
	public function getRiskValidate($mode, $risk_id, $credential) {
		$ret = false;
		if ($mode == 'viewMyRisk') {
			 
			$res = $this->getRiskById($risk_id);

			$res_change = $this->getRiskByIdchanges($risk_id);
			
			/*echo "<pre>";
			print_r($res);
			exit;*/
			
			if ($res) {
				// check if id is same
				if ($res['risk_input_by'] == $credential['username']) {
					$risk = $res;
					return $risk;
					
				}/*else if ($res_change['risk_input_by'] == $credential['username']) {
					$res_ = $this->getRiskById_change($risk_id,$credential['username']);
					return $res_;

				}*/ else {
					$risk = $res;
					return $risk;
				}
			}
		}

		if ($mode == 'viewMyRiskChange') {
			 
			//$res = $this->getRiskById($risk_id);

			//$res_change = $this->getRiskByIdchanges($risk_id);
			$res_change = $this->getRiskById_change($risk_id,$credential['username']);
			
			/*echo "<pre>";
			print_r($res);
			exit;*/
			
			if ($res_change) {
				// check if id is same
				if ($res_change['risk_input_by'] == $credential['username']) {
					$res_ = $this->getRiskById_change($risk_id,$credential['username']);
					return $res_;

				}/*else if ($res['risk_input_by'] == $credential['username']) {
					$risk = $res;
					return $risk;
					
				}*/ else {
					$risk = $res_change;
					return $risk;
				}
			}
		}

		if ($mode == 'viewMyRiskMyOwn') {
			 
			 
			$res = $this->getRiskById_own2($risk_id);

			//$res_change = $this->getRiskByIdchanges($risk_id);
			
			/*echo "<pre>";
			print_r($res);
			exit;*/
			
			if ($res) {
				// check if id is same
				if ($res['risk_input_by'] == $credential['username']) {
					$risk = $res;
					return $risk;
					
				}/*else if ($res_change['risk_input_by'] == $credential['username']) {
					$res_ = $this->getRiskById_change($risk_id,$credential['username']);
					return $res_;

				}*/ else {
					$risk = $res;
					return $risk;
				}
			}
		}
		
		if ($mode == 'viewRiskByRac') {
			if ($credential['role_id'] == '2') {
				$res = $this->getRiskById($risk_id);
				if ($res) {
					$risk = $res;
					return $risk;
				}
			} 
		}

		if ($mode == 'viewRiskByRacChange') {
			if ($credential['role_id'] == '2') {
				$res = $this->getRiskByIdchanges($risk_id);
				if ($res) {
					$risk = $res;
					return $risk;
				}
			} 
		}
    
		if ($mode == 'viewRiskByDivision') {
			$res = $this->getRiskById($risk_id);

			if ($res) {
				// check if id is same
				if ($res['risk_division'] == $credential['division_id']) {
					$risk = $res;
					return $risk;
				} else {
					return $ret;
				}
			}
		}

		if ($mode == 'viewRiskByDivisionRac') {
			$res = $this->getRiskById($risk_id);

			return $res;
		}
		
		if ($mode == 'viewActionByRac') {
			$res = $this->getActionPlanById($risk_id);

			if ($res) {
				$resRisk = $this->getRiskById($res['risk_id']);
				$resActionChange = $this->getActionPlanForChange($risk_id);
				$resAction = $this->getActionPlan_byid($risk_id);
				$res['risk_data'] = $resRisk;
				$res['change_data'] = $resActionChange;
				$res['plan_data'] = $resAction;
				return $res;
			}
		}

		if ($mode == 'viewActionByRacPrior') {
			$res = $this->getActionPlanByIdPrior($risk_id);

			if ($res) {
				$resRisk = $this->getRiskById($res['risk_id']);
				$resActionChange = $this->getActionPlanForChange($risk_id);
				$resAction = $this->getActionPlan_byid($risk_id);
				$res['risk_data'] = $resRisk;
				$res['change_data'] = $resActionChange;
				$res['plan_data'] = $resAction;
				return $res;
			}
		}

		if ($mode == 'viewActionByRac_un') {
			$res = $this->getActionPlanById_un($risk_id);

			if ($res) {
				$resRisk = $this->getRiskById($res['risk_id']);
				$resActionChange = $this->getActionPlanById_un($risk_id);
				$res['risk_data'] = $resRisk;
				$res['change_data'] = $resActionChange;
				return $res;
			}
		}
		
		if ($mode == 'viewActionByRac_cr') {
			$res = $this->getActionPlanById_cr($risk_id);

			if ($res) {
				$resActionChange = $this->ActionPlanChangeRequest($risk_id);
				$res['change_data'] = $resActionChange;
				return $res;
			}
		}

		if ($mode == 'viewActionExecByRac_cr') {

				$res = $this->ActionPlanChangeRequest($risk_id);
				$res['change_data'] = $res;
				return $res;
		}

		if ($mode == 'valEntryRiskChange') {
			$res_p = $this->getPendingChangeByRiskId($risk_id);
			
			if ($res_p) {
				return false;
			} else {
				return true;
			}
		}
		
		if ($mode == 'valEntryActionChange') {
			$res_p = $this->getPendingChangeByActionId($risk_id);
			
			if ($res_p) {
				return false;
			} else {
				return true;
			}
		}
		
		if ($mode == 'viewMyChange') {
			$res = $this->getChangeById($risk_id);
			
			if ($res['created_by'] == $credential['username'] ) {
				$risk = $res;
				return $risk;
			} else {
				return $ret;
			}
		}
		
		return $ret;
	}
	
	public function assignPic($risk_id, $pic) {
		$sql = "update t_risk set 
				risk_treatment_owner = ?
				where
				risk_id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		$res = $this->db->query($sql, $par);

		$sql = "update t_risk_change set 
				risk_treatment_owner = ?
				where
				risk_id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	//kepake buat save sama submit risk owner
	public function treatmentSaveDraft($risk_id, $suggested_rt, $risk, $impact, $actplan, $control, $objective, $uid)
	{
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){


		$sql = "delete from t_risk_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_impact_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_action_plan_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_control_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));

		$sql = "delete from t_risk_objective_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "insert into t_risk_own 
				select * from t_risk where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$risk['risk_id'] = $risk_id;
		$sql = "update t_risk_own set
				risk_owner = ?,
				risk_division = ?,
				risk_status = ?,
				risk_cause = ?,
				risk_impact = ?,
				risk_level = ?,
				risk_impact_level = ?,
				risk_likelihood_key = ?,
				suggested_risk_treatment = ?,
				created_by = ?,
				created_date = NOW()
				where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, $risk);
		if ($res) {
			// insert impact
			$sql = "insert into t_risk_impact_own(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, 'P')";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			if($suggested_rt == 'ACCEPT'){

			}else{
				$sql = "insert into t_risk_action_plan_own(risk_id, action_plan_status, action_plan, due_date, division, switch_flag) 
					values(?, 0, ?, ?, ?, 'P')";
					foreach ($actplan as $key => $value) {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
								'rid' => $risk_id,
								'ap' => $value['action_plan'],
								'dd' => $dd,
								'div' => $value['division']
					);
				$res4 = $this->db->query($sql, $par);
				}
			}
			
			// insert action plan
			$sql = "insert into t_risk_control_own(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner,switch_flag) 
					values(?, ?, ?, ?, ?, 'P')";
			foreach ($control as $key => $value) {
				$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['existing_control_id'],
					'dd' => $value['risk_existing_control'],
					'da' => $value['risk_evaluation_control'],
					'div' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}

			$sql = "insert into t_risk_objective_own(
							 risk_id, objective, switch_flag) 
						values(?, ?, 'P')";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			
			return true;
		} else {
			return false;
		}
		
		return $res;
	}
	}

//ini buat update t risk nya pada saat submit risk owner by me
	public function treatmentSaveDraft2($risk_id, $suggested_rt, $risk, $impact, $actplan, $control, $objective, $uid)
	{
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		$r_status = $risk['risk_status'];
		//update T-risk risk status sama switch_flag
		$sql = "update t_risk set risk_status = '".$r_status."', switch_flag='P'  where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_impact set switch_flag='P' where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql);

		if($suggested_rt == 'ACCEPT'){

		}else{

			$sql = "update t_risk_action_plan set switch_flag='P' where risk_id = '".$risk_id."'  ";
			$res = $this->db->query($sql);
		}

		$sql = "update t_risk_control set switch_flag='P' where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_objective set switch_flag='P' where risk_id = '".$risk_id."'  ";
		$res = $this->db->query($sql);

/*
		$sql = "delete from t_risk where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_impact where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_control where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "insert into t_risk 
				select * from t_risk_change where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		if ($res) {
			// insert impact
			$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, 'P')";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			$sql = "insert into t_risk_action_plan(risk_id, action_plan_status, action_plan, due_date, division, switch_flag) 
					values(?, 0, ?, ?, ?, 'P')";
			foreach ($actplan as $key => $value) {
				$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['action_plan'],
					'dd' => $dd,
					'div' => $value['division']
				);
				$res4 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			$sql = "insert into t_risk_control(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner,switch_flag) 
					values(?, ?, ?, ?, ?, 'P')";
			foreach ($control as $key => $value) {
				$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['existing_control_id'],
					'dd' => $value['risk_existing_control'],
					'da' => $value['risk_evaluation_control'],
					'div' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}
			
			return true;
		} else {
			return false;
		}
		*/
		
		return $res;
	}

	}

	
	public function riskChangeUpdate1ajah($risk_id, $suggested_rt, $risk, $impact, $actplan, $control, $objective, $username)
	{
		
		$sql = "delete from t_risk_impact_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_action_plan_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_control_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));

		$sql = "delete from t_risk_objective_own where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		
		//$risk['risk_id'] = $risk_id;
		
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}
		$par['risk_id'] = $risk_id;

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_own set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ? and switch_flag='P' ";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			$sql = "insert into t_risk_impact_own(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?,'P')";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			if($suggested_rt == 'ACCEPT'){

			}else{
				$sql = "insert into t_risk_action_plan_own(risk_id, action_plan_status, action_plan, due_date, division,switch_flag) 
						values(?, 0, ?, ?, ?,'P')";
				foreach ($actplan as $key => $value) {
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
			}
			// insert action control
			$sql = "insert into t_risk_control_own(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner,switch_flag) 
					values(?, ?, ?, ?, ?, 'P')";
			foreach ($control as $key => $value) {
				$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['existing_control_id'],
					'dd' => $value['risk_existing_control'],
					'da' => $value['risk_evaluation_control'],
					'div' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}

			$sql = "insert into t_risk_objective_own(
						risk_id, objective, switch_flag) 
						values(?, ?, 'P')";
				foreach ($objective as $key => $value) {
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective']
					);
					$res6 = $this->db->query($sql, $par);
				}
			
			return true;
		} else {
			return false;
		}
		
		return $res;
	}

	public function riskChangeUpdate($risk_id, $suggested_rt, $risk, $impact, $actplan, $control, $objective, $uid)
	{
		
		$sql = "delete from t_risk_impact where risk_id = ?";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "update t_risk_action_plan set switch_flag = 'C' where risk_id = ?";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "update t_risk_control set switch_flag = 'C' where risk_id = ? ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "update t_risk_objective set switch_flag = 'C' where risk_id = ? ";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		//$risk['risk_id'] = $risk_id;
		
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}
		$par['risk_id'] = $risk_id;

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now(), switch_flag='P'
			  	where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, 'P')";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			if($suggested_rt == 'ACCEPT'){

			}else{

				$sql = "insert into t_risk_action_plan(risk_id, action_plan_status, action_plan, due_date, division,switch_flag) 
						values(?, 0, ?, ?, ?, 'P')";
				foreach ($actplan as $key => $value) {
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}

				$sql = "update t_risk_action_plan set assigned_to = (select username from m_user where division_id = ? and role_id = 4)
			  	where risk_id = ? and division = ? ";
				foreach ($actplan as $key => $value) {
					$par = array(
						'div' => $value['division'],
						'rid' => $risk_id,
						'div2' => $value['division']
					);
					$res4 = $this->db->query($sql, $par);
				}
			}

			$sql = "delete from t_risk_action_plan_own where risk_id = ? and switch_flag = 'P' ";
					$this->db->query($sql, array('rid' => $risk_id));
				
			$sql = "insert into t_risk_action_plan_own(risk_id, action_plan, due_date, division, switch_flag) 
					select risk_id, action_plan, due_date, division, 'P' from t_risk_action_plan where risk_id = ? and switch_flag = 'C'";
			$this->db->query($sql, array('rid' => $risk_id));

			$sql = "delete from t_risk_action_plan where risk_id = ? and switch_flag = 'C' ";
			$this->db->query($sql, array('rid' => $risk_id));


			// insert action control
			$sql = "insert into t_risk_control(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner,switch_flag) 
					values(?, ?, ?, ?, ?, 'P')";
			foreach ($control as $key => $value) {
				$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['existing_control_id'],
					'dd' => $value['risk_existing_control'],
					'da' => $value['risk_evaluation_control'],
					'div' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}

			$sql = "delete from t_risk_control_own where risk_id = ? and switch_flag = 'P' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
			$sql = "insert into t_risk_control_own(risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, switch_flag) 
					select risk_id, existing_control_id, risk_existing_control, risk_evaluation_control, risk_control_owner, 'P' from t_risk_control where risk_id = ? and switch_flag = 'C'";
			$this->db->query($sql, array('rid' => $risk_id));

			$sql = "delete from t_risk_control where risk_id = ? and switch_flag = 'C' ";
			$this->db->query($sql, array('rid' => $risk_id));

			//objective
			$sql = "insert into t_risk_objective(
						risk_id, objective, switch_flag) 
					values(?, ?, 'P')";
			foreach ($objective as $key => $value) {
				
				$par = array(
					'rid' => $risk_id,
					'ob' => $value['objective']
				);
				$res6 = $this->db->query($sql, $par);
			}

			$sql = "delete from t_risk_objective_own where risk_id = ? and switch_flag = 'P' ";
				$this->db->query($sql, array('rid' => $risk_id));
				
			$sql = "insert into t_risk_objective_own(risk_id, objective, switch_flag) 
					select risk_id, objective, 'P' from t_risk_objective where risk_id = ? and switch_flag = 'C'";
			$this->db->query($sql, array('rid' => $risk_id));

			$sql = "delete from t_risk_objective where risk_id = ? and switch_flag = 'C' ";
			$this->db->query($sql, array('rid' => $risk_id));			
			
			return true;
		} else {
			return false;
		}
		
		return $res;
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function riskChangeUpdateprimary($risk_id, $risk, $impact, $actplan, $control, $uid)
	{
		$sql = "delete from t_risk_impact where risk_id = ?";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_action_plan where risk_id = ?";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		$sql = "delete from t_risk_control where risk_id = ?";
		$res = $this->db->query($sql, array('rid'=>$risk_id));
		
		//$risk['risk_id'] = $risk_id;
		
		$par = array();
		$keyupdate = '';
		foreach($risk as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}
		$par['risk_id'] = $risk_id;

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk set ".$keyupdate
			  ."created_date = now()
			  	where risk_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			// insert impact
			$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level) values(?, ?, ?)";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			$sql = "insert into t_risk_action_plan(risk_id, action_plan_status, action_plan, due_date, division) 
					values(?, 0, ?, ?, ?)";
			foreach ($actplan as $key => $value) {
				$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['action_plan'],
					'dd' => $dd,
					'div' => $value['division']
				);
				$res4 = $this->db->query($sql, $par);
			}
			
			// insert action plan
			$sql = "insert into t_risk_control(
						risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner) 
					values(?, ?, ?, ?, ?)";
			foreach ($control as $key => $value) {
				$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
				$par = array(
					'rid' => $risk_id,
					'ap' => $value['existing_control_id'],
					'dd' => $value['risk_existing_control'],
					'da' => $value['risk_evaluation_control'],
					'div' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}
			
			return true;
		} else {
			return false;
		}
		
		return $res;
	}
	
	public function treatmentSubmit($risk_id, $risk, $uid)
	{
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		$this->_logHistory($risk_id, $uid, 'U');
		
		$sql = "update t_risk set
				risk_status = ?,
				created_by = ?,
				created_date = NOW()
				where risk_id = ?";
		
		$risk['risk_id'] = $risk_id;
		$res = $this->db->query($sql, $risk);
		
		return $res;
		}
	}
	
	public function riskSwitchPrimary($risk_id)
	{
		$res = false;
		$this->db->trans_start();
		$risk_change = $this->getRiskChangeByIdNoRef($risk_id);
		if ($risk_change) {
			$par['risk_id'] = $risk_id;
			
			// RISK
			$sql = "update t_risk set switch_flag = 'P' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "update t_risk_change set switch_flag = 'C' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			/*
			$sql = "insert into t_risk_change select * from t_risk where risk_id = ?";
			$res = $this->db->query($sql, $par);
			*/
			if ($res) {
				$sql = "delete from t_risk where risk_id = ?";
				$res2 = $this->db->query($sql, $par);
				
				$sql = "insert into t_risk select * from t_risk_change where switch_flag = 'C' and risk_id = ?";
				$res3 = $this->db->query($sql, $par);
				/*
				$sql = "delete from t_risk_change where switch_flag = 'C' and risk_id = ?";
				$res4 = $this->db->query($sql, $par);
				*/
			}
			
			// IMPACT
			$sql = "update t_risk_impact set switch_flag = 'P' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "update t_risk_impact_change set switch_flag = 'C' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			/*
			$sql = "insert into t_risk_impact_change 
					select 
					risk_id, impact_id, impact_level, switch_flag
					from t_risk_impact where risk_id = ?";
			$res = $this->db->query($sql, $par);
			*/
			if ($res) {
				$sql = "delete from t_risk_impact where risk_id = ?";
				$res2 = $this->db->query($sql, $par);
				
				$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level, switch_flag) 
						select risk_id, impact_id, impact_level, switch_flag
						from t_risk_impact_change where switch_flag = 'C' and risk_id = ?";
				$res3 = $this->db->query($sql, $par);
				/*
				$sql = "delete from t_risk_impact_change where switch_flag = 'C' and risk_id = ?";
				$res4 = $this->db->query($sql, $par);
				*/
			}
			
			// CONTROL
			$sql = "update t_risk_control set switch_flag = 'P' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "update t_risk_control_change set switch_flag = 'C' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			/*
			$sql = "insert into t_risk_control_change 
					select 
					risk_id, existing_control_id, risk_existing_control,
					risk_evaluation_control, risk_control_owner, switch_flag 
					from t_risk_control where risk_id = ?";
			$res = $this->db->query($sql, $par);
			*/
			if ($res) {
				$sql = "delete from t_risk_control where risk_id = ?";
				$res2 = $this->db->query($sql, $par);
				
				$sql = "insert into t_risk_control(
							risk_id, existing_control_id, risk_existing_control,
							risk_evaluation_control, risk_control_owner, switch_flag
						) 
						select 
						risk_id, existing_control_id, risk_existing_control,
						risk_evaluation_control, risk_control_owner, switch_flag
						from t_risk_control_change where switch_flag = 'C' and risk_id = ?";
				$res3 = $this->db->query($sql, $par);
				/*
				$sql = "delete from t_risk_control_change where switch_flag = 'C' and risk_id = ?";
				$res4 = $this->db->query($sql, $par);
				*/
			}
			
			// ACTION PLAN
			$sql = "update t_risk_action_plan set switch_flag = 'P' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "update t_risk_action_plan_change set switch_flag = 'C' where risk_id = ?";
			$res = $this->db->query($sql, $par);
			/*
			$sql = "insert into t_risk_action_plan_change 
					select 
					id, risk_id, action_plan_status, action_plan, 
					due_date, division, assigned_to, 
					execution_status, execution_explain, execution_evidence, 
					execution_reason, revised_date, switch_flag
					from t_risk_action_plan where risk_id = ?";
			$res = $this->db->query($sql, $par);
			*/
			if ($res) {
				$sql = "delete from t_risk_action_plan where risk_id = ?";
				$res2 = $this->db->query($sql, $par);
				
				$sql = "insert into t_risk_action_plan(
							risk_id, action_plan_status, action_plan, 
							due_date, division, assigned_to, 
							execution_status, execution_explain, execution_evidence, 
							execution_reason, revised_date, switch_flag
						) 
						select 
						risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, 
						execution_status, execution_explain, execution_evidence, 
						execution_reason, revised_date, switch_flag
						from t_risk_action_plan_change where switch_flag = 'C' and risk_id = ?";
				$res3 = $this->db->query($sql, $par);
				
				/*
				$sql = "delete from t_risk_action_plan_change where switch_flag = 'C' and risk_id = ?";
				$res4 = $this->db->query($sql, $par);
				*/
			}
		}
		$this->db->trans_complete();
		return $res;
	}
	
	public function riskDeleteChange($risk_id,$user)
	{
		$par['risk_id'] = $risk_id;
		$sql = "delete from t_risk_change where risk_id = ? and risk_input_by = '$user'";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_action_plan_change where risk_id = ? and switch_flag = '$user'";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_control_change where risk_id = ? and switch_flag ='$user'";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_risk_impact_change where risk_id = ? and switch_flag='$user'";
		$res = $this->db->query($sql, $par);
		
		return true;
	}
	
	public function actionPlanSetToDraft($risk_id)
	{
		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_action_plan set action_plan_status = 1 where risk_id = ?";
		$res = $this->db->query($sql, $par);
		return true;
	}
	
	public function assignPicAction($risk_id, $pic) {
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set 
				assigned_to = ?
				where
				a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (SELECT max(periode_id) FROM m_periode) and b.id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		
		$res = $this->db->query($sql, $par);

		/*$sql = "update t_risk_action_plan_change set 
				assigned_to = ?
				where
				id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		$res = $this->db->query($sql, $par);*/
		return $res;
	}

	public function assignPicActionPrior($risk_id, $pic) {
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set 
				assigned_to = ?
				where
				a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((SELECT max(periode_id) FROM m_periode)-1) and b.id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	/*
	public function assignPicAction($risk_id, $pic) {
		$sql = "update t_risk_action_plan set 
				assigned_to = ?,action_plan_status = 5
				where
				id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	*/
	public function getActionPlanById($risk_id) 
	{
		$sql = "select d.id as id_ap, a.id, a.risk_id,a.action_plan_status, a.action_plan, a.assigned_to, a.division, a.existing_control_id, concat('AP.', LPAD(d.id, 6, '0')) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date from t_risk_action_plan a 
				left join m_division b on a.division = b.division_id left 
				join m_user c on a.assigned_to = c.username 
				join m_action_plan d on a.action_plan = d.action_plan and a.division = d.division
				join t_risk e on a.risk_id = e.risk_id 
				where d.id = ? and a.action_plan_status > 0";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}

	public function getActionPlan_byid($risk_id) 
	{
		$sql = "select a.id_ap, 
				a.action_plan_status, a.action_plan, a.assigned_to, a.division, concat('AP.', LPAD(a.id_ap, 6, '0')) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name from t_action_plan a 
				left join m_division b on a.division = b.division_id 
                left join m_user c on a.assigned_to = c.username
				where a.id_ap = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}

		public function getActionPlanByIdPrior($risk_id) 
	{
		$sql = "select d.id as id_ap, a.id, a.risk_id,a.action_plan_status, a.action_plan, a.assigned_to, a.division, concat('AP.', LPAD(d.id, 6, '0')) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date from t_risk_action_plan a 
				left join m_division b on a.division = b.division_id left 
				join m_user c on a.assigned_to = c.username 
				join m_action_plan d on a.action_plan = d.action_plan and a.division = d.division
				join t_risk e on a.risk_id = e.risk_id 
				where d.id = ? and a.action_plan_status > 0 and e.periode_id = ((select max(periode_id) from m_periode)-1)";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}

	public function getActionPlanById_un($risk_id) 
	{
		$sql = "select d.id as id_ap, a.id, a.risk_id,a.action_plan_status, a.action_plan, a.assigned_to, a.division, concat('AP.', LPAD(d.id, 6, '0')) as act_code, date_format(a.due_date, '%d-%m-%Y') as due_date_v, b.division_name as division_v, c.display_name as display_name, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date from t_risk_action_plan a 
				left join m_division b on a.division = b.division_id left 
				join m_user c on a.assigned_to = c.username 
				join m_action_plan d on a.action_plan = d.action_plan and a.division = d.division
				join t_risk e on a.risk_id = e.risk_id 
				where a.id = ? and e.periode_id = (select max(periode_id) from m_periode)";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}


	public function getActionPlanById_cr($risk_id) 
	{
		$sql = "select a.*,
				concat('AP.', LPAD(a.id_ap, 6, '0')) as act_code,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_action_plan_cr a
				left join m_division b on a.division = b.division_id
				where a.change_id = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}
	
	public function getActionPlanChangeById($risk_id) 
	{
		$sql = "select a.id_ap, a.action_plan, a.due_date, a.division, a.switch_flag,
				concat('AP.', LPAD(c.id, 6, '0')) as act_code,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_action_plan_change a
			    join m_division b on a.division = b.division_id
			    join m_action_plan c on a.id_ap = c.id 
				where a.id_ap = ? and a.switch_flag = 'P'";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}

	public function getActionPlanRequestById($risk_id) 
	{
		$sql = "select a.*,
				concat('AP.', LPAD(a.id_ap, 6, '0')) as act_code,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from t_action_plan_cr_change a
			    join m_division b on a.division = b.division_id 
				where a.change_id = ? and switch_flag = 'P'";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		return $row;
	}
	
	public function getActionPlanForChange($rid)
	{
		$data = $this->getActionPlanChangeById($rid);
		if (!$data) {
			$data = $this->getActionPlanById($rid);
		}
		return $data;
	}

	public function getActionPlanForRequest($rid)
	{
		$data = $this->getActionPlanChangeById($rid);
		return $data;
	}


	public function ActionPlanChangeRequest($rid)
	{
		$data = $this->getActionPlanRequestById($rid);
		if (!$data) {
			$data = $this->getActionPlanById_cr($rid);
		}
		return $data;
	}

	public function actionplanrequestsubmit($action_id, $uid) {
		// LOG HISTORY
		$sql2 = "select cr_code from t_cr_risk ORDER BY id DESC LIMIT 1  ";
		$query = $this->db->query($sql2);
		if ($query->num_rows() > 0){	
		$row = $query->row();	
		$hasil1 = $row->cr_code;
		}else{
		$hasil1 = 'CH.000001';
		} 
		$hasil2 = substr($hasil1, 4);
		$hasil3 = $hasil2 + 1 ;
		$hasil4 = strlen($hasil3);
		$hasil5 = 9 - $hasil4;
		$hasil6 = substr($hasil1,0,$hasil5);
		$hasil = $hasil6.$hasil3;
		$cr_type = "Action Plan Form";

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sql = "insert into t_cr_risk (cr_code,cr_type,cr_status,switch_flag,created_by,created_date) values ('$hasil','$cr_type',0,'$action_id','$uid',NOW())";
		$res = $this->db->query($sql);

		return $res;
	}

	public function actionplanexcerequestsubmit($action_id, $uid) {
		// LOG HISTORY
		$sql2 = "select cr_code from t_cr_risk ORDER BY id DESC LIMIT 1  ";
		$query = $this->db->query($sql2);
		if ($query->num_rows() > 0){	
		$row = $query->row();	
		$hasil1 = $row->cr_code;
		}else{
		$hasil1 = 'CH.000001';
		} 
		$hasil2 = substr($hasil1, 4);
		$hasil3 = $hasil2 + 1 ;
		$hasil4 = strlen($hasil3);
		$hasil5 = 9 - $hasil4;
		$hasil6 = substr($hasil1,0,$hasil5);
		$hasil = $hasil6.$hasil3;
		$cr_type = "Action Plan Execution Form";

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sql = "insert into t_cr_risk (cr_code,cr_type,cr_status,switch_flag,created_by,created_date) values ('$hasil','$cr_type',0,'$action_id','$uid',NOW())";
		$res = $this->db->query($sql);

		return $res;
	}

	public function actionplanexcerequestsubmitPrior($action_id, $uid) {
		// LOG HISTORY
		$sql2 = "select cr_code from t_cr_risk ORDER BY id DESC LIMIT 1  ";
		$query = $this->db->query($sql2);
		if ($query->num_rows() > 0){	
		$row = $query->row();	
		$hasil1 = $row->cr_code;
		}else{
		$hasil1 = 'CH.000001';
		} 
		$hasil2 = substr($hasil1, 4);
		$hasil3 = $hasil2 + 1 ;
		$hasil4 = strlen($hasil3);
		$hasil5 = 9 - $hasil4;
		$hasil6 = substr($hasil1,0,$hasil5);
		$hasil = $hasil6.$hasil3;
		$cr_type = "Action Plan Execution Prior Form";

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$sql = "insert into t_cr_risk (cr_code,cr_type,cr_status,switch_flag,created_by,created_date) values ('$hasil','$cr_type',0,'$action_id','$uid',NOW())";
		$res = $this->db->query($sql);

		return $res;
	}

	public function insertaction_plan_cr($action_id, $risk, $uid) 
	{
		//ubah


		$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, 'P')";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 3,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, switch_flag) 
				select 0, id_ap, 3, action_plan, due_date, division, assigned_to, 'P' from t_action_plan where id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 2 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;
	}

	public function insertaction_plan_exe_cr($action_id, $risk, $uid) 
	{
		//ubah

		if($risk['execution_status'] == 'COMPLETE'){
					$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'een' => $risk['execution_explain'],
			'exe' => $risk['execution_evidence'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (SELECT max(periode_id) FROM m_periode) and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;
		}else if($risk['execution_status'] == 'ONGOING'){
			$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'een' => $risk['execution_explain'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (SELECT max(periode_id) FROM m_periode) and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;			
		}else{


		$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_reason, revised_date, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'er' => $risk['execution_reason'],
			'rd' => $risk['revised_date'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (SELECT max(periode_id) FROM m_periode) and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;
		}
	}

	public function insertaction_plan_exe_prior_cr($action_id, $risk, $uid) 
	{
		//ubah

		if($risk['execution_status'] == 'COMPLETE'){
					$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'een' => $risk['execution_explain'],
			'exe' => $risk['execution_evidence'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;
		}else if($risk['execution_status'] == 'ONGOING'){
			$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'een' => $risk['execution_explain'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;			
		}else{


		$sql = "insert into t_action_plan_cr_change(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_reason, revised_date, switch_flag)
				values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$par = array(
			'cs' => 0,
			'id' => $action_id,
			'aps' => 6,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'div' => $risk['division'],
			'ui' => $uid,
			'es' => $risk['execution_status'],
			'er' => $risk['execution_reason'],
			'rd' => $risk['revised_date'],
			'sf' => 'P'
			
		);
		$query = $this->db->query($sql, $par);

		
		$sql = "insert into t_action_plan_cr(cr_status, id_ap, action_plan_status, action_plan, due_date, division, assigned_to, execution_status, execution_explain, execution_evidence, execution_reason, revised_date, switch_flag) select 0, b.id, 6, b.action_plan, a.due_date, b.division, a.assigned_to, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, 'P' from t_risk_action_plan a, m_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change a, t_cr_risk b set a.change_id = (select id from t_cr_risk where cr_type = 'Action Plan Execution Prior Form' and cr_status = '0' and switch_flag = '$action_id')  
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Execution Prior Form' and b.cr_status = '0' and a.cr_status = '0' and a.id_ap = '$action_id'";
		$query = $this->db->query($sql);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = '1'  
				where a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status > 5 and b.id = '$action_id'";
		$query = $this->db->query($sql);

		return true;
		}
	}
	
	//ubah2
	public function actionPlanSaveDraft($action_id, $risk_id, $risk, $uid) 
	{
		//ubah
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		/*
		$sql = "delete from t_risk_action_plan_change where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "insert into t_risk_action_plan_change 
				select * from t_risk_action_plan
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
	*/
		
		$sql = "delete from t_action_plan_change where id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "delete from t_action_plan where id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "replace into t_action_plan(id_ap, action_plan_status, action_plan, due_date, division, assigned_to, request_by, switch_flag)
				values(?,?,?,?,?,?,?,'P')"; 
		$par = array(
			'id' => $action_id,
			'as' => $risk['action_plan_status'],
			'ap' => $risk['action_plan_p'], 
			'dd' => $risk['due_date_p'], 
			'division' => $risk['division_p'],
			'cby' => $risk['created_by'],
			'rby' => $risk['created_by']
			
		);
		$query = $this->db->query($sql, $par);		

		$sql = "replace into t_action_plan_change(id_ap, action_plan, due_date, division, switch_flag)
				values(?,?,?,?, 'P')"; 
		$par = array(
			'id' => $action_id,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'division' => $risk['division']
			
		);
		$query = $this->db->query($sql, $par);

		//update juga di t risk action plan nya tapi bakalan sama nanti pas verify RAC!
		/*
		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);
		*/

		return true;
		}
	}

	public function actionPlanSaveDraft_rac($action_id, $risk_id, $risk, $uid) 
	{
		//ubah
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		/*
		$sql = "delete from t_risk_action_plan_change where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "insert into t_risk_action_plan_change 
				select * from t_risk_action_plan
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
	*/
		
		$sql = "delete from t_action_plan_change where id_ap = '$action_id'";
		$query = $this->db->query($sql);	

		$sql = "replace into t_action_plan_change(id_ap, action_plan, due_date, division, switch_flag)
				values(?,?,?,?, 'P')"; 
		$par = array(
			'id' => $action_id,
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'division' => $risk['division']
			
		);
		$query = $this->db->query($sql, $par);

		//update juga di t risk action plan nya tapi bakalan sama nanti pas verify RAC!
		/*
		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);
		*/

		return true;
		}
	}

	public function actionPlanChngeDuedate($action_id, $risk_id, $risk, $uid) 
	{
		//ubah
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		/*
		$sql = "delete from t_risk_action_plan_change where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "insert into t_risk_action_plan_change 
				select * from t_risk_action_plan
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
	*/
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.due_date = ? where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = ?";
		$par = array(
			'dd' => $risk['due_date'],
			'id' => $action_id
		);
		$query = $this->db->query($sql, $par);

		//update juga di t risk action plan nya tapi bakalan sama nanti pas verify RAC!
		/*
		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);
		*/

		return true;
		}
	}

	public function actionPlanSaveDraft_cr($action_id, $risk_id, $risk, $uid) 
	{
		//ubah
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		/*
		$sql = "delete from t_risk_action_plan_change where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "insert into t_risk_action_plan_change 
				select * from t_risk_action_plan
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
	*/
		$sql = "update t_action_plan_cr_change 
				set action_plan = ?, due_date = ?, division = ?
				where change_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id
		);
		$query = $this->db->query($sql, $par);

		//update juga di t risk action plan nya tapi bakalan sama nanti pas verify RAC!
		/*
		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);
		*/

		return true;
		}
	}
//ubah
	public function actionPlanSaveDraft2($action_id, $risk_id, $risk, $uid) 
	{

		$sql = "insert into t_action_plan_change(id_ap, action_plan, due_date, division, switch_flag) 
				SELECT a.id_ap, a.action_plan, a.due_date, a.division, 'C' FROM t_action_plan a where a.id_ap = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan a
				set a.action_plan = ?, a.due_date = ?, a.division = ?
				where a.id_ap = ?";
		$par = array(
			'ap' => $risk['action_plan'], 
			'dd' => $risk['due_date'], 
			'division' => $risk['division'],
			'id' => $action_id
		);
		$query = $this->db->query($sql, $par);

		$sql = "delete from t_action_plan_change where id_ap = '$action_id' and switch_flag = 'P'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_change set switch_flag = 'P' where id_ap = '$action_id' and switch_flag = 'C'";
		$query = $this->db->query($sql);

		return true;
	}
//ubah
	public function actionPlanSaveDraftprimary($action_id, $risk_id, $risk, $uid) 
	{
		$sql = "delete from t_risk_action_plan_change where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "insert into t_risk_action_plan_change 
				select * from t_risk_action_plan
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, array('id' => $action_id, 'risk_id' => $risk_id));
		
		$sql = "update t_risk_action_plan_change 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);

		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);
		return true;
	}

	public function actionPlanSaveDraftprimary2($action_id, $risk_id, $risk, $uid) 
	{
			
		$sql = "update t_risk_action_plan 
				set action_plan = ?, due_date = ?, division = ?
				where id = ? and risk_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$query = $this->db->query($sql, $par);

		$par['risk_id'] = $risk_id;
		$sql = "insert into m_action_plan(action_plan, division) 
				select t1.action_plan, t1.division from t_risk_action_plan t1 where risk_id = '".$risk_id."' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
		$res = $this->db->query($sql, $par);

		return true;
	}
	
	public function actionPlanSubmit($action_id, $risk_id, $risk, $uid, $role_id) 
	{
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){
		
			if($role_id == 5){
				$status_ap = '2';
			}else if($role_id == 4){
				$status_ap = '3';
			}

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set a.action_plan_status = '".$status_ap."'
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id= ? and a.action_plan_status > 0";
		$par = array(
			'id' => $action_id
		);
		$query = $this->db->query($sql, $par);


		return true;
	}
}
	//ubah
	public function actionSwitchPrimary($id)
	{
		$this->db->trans_start();
		$action = $this->getActionPlanChangeById($id);
		if ($action) {
			$par['id'] = $id;
			$par['risk_id'] = $action['risk_id'];
						
			// ACTION PLAN
			/*
			$sql = "update t_risk_action_plan set switch_flag = 'P' where id = ? and risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "update t_risk_action_plan_change set switch_flag = 'C' where id = ? and risk_id = ?";
			$res = $this->db->query($sql, $par);
			
			$sql = "insert into t_risk_action_plan_change (
						id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, switch_flag
					)
					select 
					id, risk_id, action_plan_status, action_plan, 
					due_date, division, assigned_to, switch_flag
					from t_risk_action_plan where id = ? and risk_id = ?";
			$res = $this->db->query($sql, $par);
			*/
			if ($res) {

				//$sql = "delete from t_risk_action_plan where id = ? and risk_id = ?";
				//$res2 = $this->db->query($sql, $par);
				
				$sql = "insert into t_risk_action_plan(
							id, risk_id, action_plan_status, action_plan, 
							due_date, division, assigned_to
						) 
						select 
						id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to
						from t_risk_action_plan_change where id = ?  and risk_id = ?";
				$res3 = $this->db->query($sql, $par);
				/*
				$sql = "delete from t_risk_action_plan_change where id = ?  and risk_id = ?";
				$res4 = $this->db->query($sql, $par);
				*/
			}
		}
		$this->db->trans_complete();
		return $res;
	}
	//ubah
	public function actionPlanVerify($action_id, $risk_id, $risk, $uid) 
	{	
		
		$sql = "insert into m_action_plan(action_plan, division) 
				select t1.action_plan, t1.division from t_action_plan t1 where t1.id_ap = '$action_id' and NOT EXISTS(select t2.action_plan, t2.division from m_action_plan t2 where t1.action_plan = t2.action_plan and t1.division = t2.division)";
		$query = $this->db->query($sql);

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c, (SELECT risk_id, COUNT(1) AS jml_ap FROM t_risk_action_plan WHERE t_risk_action_plan.action_plan_status < 4 and t_risk_action_plan.action_plan_status > 0  GROUP BY risk_id) d
				set 
					c.risk_status = '10'
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.risk_id = d.risk_id and c.periode_id = (select max(periode_id) from m_periode) and d.jml_ap = '1' and b.id = '$action_id'";
		$query = $this->db->query($sql);

		$division = $risk['division'];
		$par = array(
			'ap' => $risk['action_plan_status'],
			//'ac' => $risk['action_plan'],
			//'dd' => $risk['due_date'],
			//'dv' => $risk['division'],
			'id' => $action_id, 
		);

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
					a.action_plan_status = ?, a.action_plan = (select action_plan from t_action_plan where id_ap = '$action_id'), a.due_date = (select due_date from t_action_plan where id_ap = '$action_id'), a.division = (select division from t_action_plan where id_ap = '$action_id'),
					a.assigned_to = (select username from m_user where division_id in(select division from t_action_plan where id_ap = '$action_id') and role_id = 4)
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 2 and b.id = ?";
		$query = $this->db->query($sql, $par); 



		/*$sql = "select count(1) numcount from t_risk_action_plan 
				where risk_id =? and action_plan_status < 4";
		foreach ($risk_id as $key => $value) {
						$par = array(
							'rd' => $value['risk_id']
						);
						$query = $this->db->query($sql, $par);
				}

   
		$row = $query->row_array();
		if ($row['numcount'] == 0) {
			$sql = "update t_risk 
					set risk_status = 10
					where risk_id = ?";
			foreach ($risk_id as $key => $value) {
						$par = array(
							'rd' => $value['risk_id']
						);
						$query = $this->db->query($sql, $par);
						return $query;
				}
		}*/

		
		return true;
	}
	
	public function actionPlanVerify1form($action_id, $risk_id, $dac, $risk, $uid) 
	{	

		$division = $risk['division'];
		$par = array(
			'ap' => $risk['action_plan_status'],
			'action_plan' => $risk['action_plan'],
			'due_date' => $risk['due_date'],
			'division' => $risk['division'],
			'id' => $action_id, 
			'risk_id' => $risk_id
		);
		
		$sql = "update t_risk_action_plan 
				set action_plan_status = ?,action_plan = ?,due_date = ?,division = ?,assigned_to = (select username from m_user where division_id = '$division' and role_id = 4)
				where id = ? and risk_id = ?";
		$query = $this->db->query($sql, $par);

				$sql = "select count(1) numcount from t_risk_action_plan 
				where risk_id = ? and action_plan_status < 4";
		$par = array('risk_id' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		if ($row['numcount'] == 0) {
			$sql = "update t_risk 
					set risk_status = 10
					where risk_id = ?";
			$query = $this->db->query($sql, $par);
		}

				//ambil data lama untuk status berkala buat ngakalin execution yg ke delete
		$par = array(
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$sql = "select * from t_risk_action_plan where id = ? and risk_id = ?";
		$data_aman = $this->db->query($sql, $par)->row_array();
		$action_plan_x = $data_aman['action_plan'];
		$due_date_x = $data_aman['due_date'];
		$division_x = $data_aman['division'];
		//batas data aman


//kalo berkala
		
		$par = array(
			'a' => $action_plan_x, 'b' => $due_date_x, 'c' => $division_x
		);
		$sql = "select * from t_risk_action_plan where action_plan_status > '4' and action_plan = ? and due_date = ? and division = ? order by id desc limit 1";
		$datanya = $this->db->query($sql, $par)->row_array();
		
		$execution_status_x = $datanya['execution_status'];
		$execution_explain_x = $datanya['execution_explain'];
		$execution_evidence_x = $datanya['execution_evidence'];
		$execution_reason_x = $datanya['execution_reason'];

		if($dac == '00-00-0000'){
		$par = array(
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$sql = "update t_risk_action_plan 
				set action_plan_status = '7', due_date ='0000-00-00' , execution_status = 'COMPLETE', execution_explain = '$execution_explain_x', execution_evidence = '$execution_evidence_x', execution_reason='$execution_reason_x' where id = ? and risk_id = ?";
		$query = $this->db->query($sql, $par);

		$sql = "select count(1) numcount from t_risk_action_plan 
				where risk_id = ? and action_plan_status < 7";
		$par = array('risk_id' => $risk_id);

		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		if ($row['numcount'] == 0) {
			$sql = "update t_risk 
					set risk_status = 20
					where risk_id = ?";
			$query = $this->db->query($sql, $par);
		}

		}else{
		$par = array(
			'id' => $action_id, 'risk_id' => $risk_id
		);
		$sql = "update t_risk_action_plan 
				set execution_status = '$execution_status_x', execution_explain = '$execution_explain_x', execution_evidence = '$execution_evidence_x', execution_reason='$execution_reason_x' where id = ? and risk_id = ?";
		$query = $this->db->query($sql, $par);
		}
//end berkala

		return true;
	}

	public function actionUpdateRiskStatus($risk_id, $uid) 
	{
		//ubah2
		$risk_id_cek = $risk_id;
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		$sql = "select count(1) numcount from t_risk_action_plan 
				where risk_id = ? and action_plan_status < 3";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$row = $query->row_array();
		if ($row['numcount'] == 0) {
			$sql = "update t_risk 
					set risk_status = 10
					where risk_id = ?";
			$query = $this->db->query($sql, $par);

			/*$sql = "update t_risk_change 
					set risk_status = 10
					where risk_id = ? and switch_flag='P' ";
			$query = $this->db->query($sql, $par);*/
		}
		
		return true;
	}
	}
	
	public function execSaveDraft($id, $risk, $uid) 
	{
		//ubah2
		//$risk_id_cek = $risk_id;
		$sql="select t1.risk_existing_control from t_risk t1 join t_risk_action_plan t2 on t1.risk_id = t2.risk_id where t1.risk_id = (select t3.risk_id from t_risk_action_plan t3 where t3.id =  '$id') ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.execution_status = ?,
				a.execution_explain = ?,
				a.execution_evidence = ?,
				a.execution_reason = ?,
				a.revised_date = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id  = (select max(periode_id) from m_periode) and b.id = ? and a.action_plan_status > 3
				";
		$par = array(
			'execution_status' => $risk['execution_status'],
			'execution_explain' => $risk['execution_explain'],
			'execution_evidence' => $risk['execution_evidence'],
			'execution_reason' => $risk['execution_reason'],
			'revised_date' => $risk['revised_date'],
			'rid' => $id
		);
		
		$query = $this->db->query($sql, $par);
		return true;
	}
}

	public function execSaveDraftPrior($id, $risk, $uid) 
	{
		//ubah2
		//$risk_id_cek = $risk_id;
		$sql="select t1.risk_existing_control from t_risk t1 join t_risk_action_plan t2 on t1.risk_id = t2.risk_id where t1.risk_id = (select t3.risk_id from t_risk_action_plan t3 where t3.id =  '$id') ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.execution_status = ?,
				a.execution_explain = ?,
				a.execution_evidence = ?,
				a.execution_reason = ?,
				a.revised_date = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = ? and a.action_plan_status > 3
				";
		$par = array(
			'execution_status' => $risk['execution_status'],
			'execution_explain' => $risk['execution_explain'],
			'execution_evidence' => $risk['execution_evidence'],
			'execution_reason' => $risk['execution_reason'],
			'revised_date' => $risk['revised_date'],
			'rid' => $id
		);
		
		$query = $this->db->query($sql, $par);
		return true;
	}
}
	
	public function execSubmit($id, $status, $uid) 
	{
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.action_plan_status = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = ? and a.action_plan_status > 3
				";
		$par = array(
			'stat' => $status,
			'rid' => $id
		);
		
		$query = $this->db->query($sql, $par);
		return true;
	}

		public function execSubmitPrior($id, $status, $uid) 
	{
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.action_plan_status = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = ? and a.action_plan_status > 3
				";
		$par = array(
			'stat' => $status,
			'rid' => $id
		);
		
		$query = $this->db->query($sql, $par);
		return true;
	}
	
	public function execComplete($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'COMPLETE',
			'eexplain' => $risk['execution_explain'],
			'eevi' => $risk['execution_evidence'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				action_plan_status = ?,
				execution_status = ?,
				execution_explain = ?,
				execution_evidence = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = ? and a.action_plan_status > 5";
		$query = $this->db->query($sql, $par);
		return true;
	}
	
	public function execOngoing($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'ONGOING',
			'eexplain' => $risk['execution_explain'],
			'eevi' => $risk['execution_evidence'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.action_plan_status = ?,
				a.execution_status = ?,
				a.execution_explain = ?,
				a.execution_evidence = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = ? and a.action_plan_status > 5";
		$query = $this->db->query($sql, $par);
		return true;
	}
	
	public function execExtend($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'EXTEND',
			'eexplain' => $risk['execution_reason'],
			'dd1' => $risk['revised_date'],
			'dd2' => $risk['revised_date'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set
				a.action_plan_status = ?, 
				a.execution_status = ?,
				a.execution_reason = ?,
				a.revised_date = ?,
				a.due_date = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = ? and a.action_plan_status > 5";
		
		$query = $this->db->query($sql, $par);
		
		/*$sql = "insert into t_risk_action_plan_extend
				select * from t_risk_action_plan where id = ?";
		$query = $this->db->query($sql, array('aid'=>$action_id));		
		
		$sql = "update t_risk_action_plan 
				set 
				action_plan_status = 4,
				execution_status = NULL,
				execution_reason = NULL,
				revised_date = NULL,
				due_date = ?
				where id = ?";
				
		$query = $this->db->query($sql, array('dd' => $risk['revised_date'], 'aid'=>$action_id));*/		
		return true;
	}


		public function execCompletePrior($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'COMPLETE',
			'eexplain' => $risk['execution_explain'],
			'eevi' => $risk['execution_evidence'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.action_plan_status = ?,
				a.execution_status = ?,
				a.execution_explain = ?,
				a.execution_evidence = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = ? and a.action_plan_status > 5";
		$query = $this->db->query($sql, $par);
		return true;
	}
	
	public function execOngoingPrior($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'ONGOING',
			'eexplain' => $risk['execution_explain'],
			'eevi' => $risk['execution_evidence'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				a.action_plan_status = ?,
				a.execution_status = ?,
				a.execution_explain = ?,
				a.execution_evidence = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = ? and a.action_plan_status > 5";
		$query = $this->db->query($sql, $par);
		return true;
	}
	
	public function execExtendPrior($action_id, $risk, $uid) 
	{
		$par = array(
			'stat' => 7,
			'es' => 'EXTEND',
			'eexplain' => $risk['execution_reason'],
			'dd1' => $risk['revised_date'],
			'dd2' => $risk['revised_date'],
			'id' => $action_id
		);
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set
				a.action_plan_status = ?, 
				a.execution_status = ?,
				a.execution_reason = ?,
				a.revised_date = ?,
				a.due_date = ?
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = ? and a.action_plan_status > 5";
		
		$query = $this->db->query($sql, $par);
		
		$sql = "insert into t_risk_action_plan_extend
				select * from t_risk_action_plan where id = ?";
		$query = $this->db->query($sql, array('aid'=>$action_id));		
		
		/*$sql = "update t_risk_action_plan 
				set 
				action_plan_status = 4,
				execution_status = NULL,
				execution_reason = NULL,
				revised_date = NULL,
				due_date = ?
				where id = ?";
				
		$query = $this->db->query($sql, array('dd' => $risk['revised_date'], 'aid'=>$action_id));*/		
		return true;
	}
	
	public function execUpdateRiskStatus($action_id, $uid) 
	{
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c, (SELECT risk_id, COUNT(1) AS jml_ap FROM t_risk_action_plan WHERE t_risk_action_plan.action_plan_status < 7 and t_risk_action_plan.action_plan_status > 0  GROUP BY risk_id) d
				set 
					c.risk_status = '20'
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.risk_id = d.risk_id and c.periode_id = (select max(periode_id) from m_periode) and d.jml_ap = '1' and b.id = '$action_id'";
		$query = $this->db->query($sql);
		
		return true;
	}

	public function execUpdateRiskStatusPrior($action_id, $uid) 
	{
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c, (SELECT risk_id, COUNT(1) AS jml_ap FROM t_risk_action_plan WHERE t_risk_action_plan.action_plan_status < 7 and t_risk_action_plan.action_plan_status > 0  GROUP BY risk_id) d
				set 
					c.risk_status = '20'
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.risk_id = d.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and d.jml_ap = '1' and b.id = '$action_id'";
		$query = $this->db->query($sql);
		
		return true;
	}

	public function actionPlanSaveDraft2_cr($action_id, $risk_id, $risk, $uid) 
	{

		$sql = "insert into t_action_plan_cr_change(change_id, id_ap, action_plan, due_date, division, switch_flag) 
				select change_id, id_ap, action_plan, due_date, division, 'C' from t_action_plan_cr where change_id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr 
				set action_plan = ?, due_date = ?, division = ?
				where change_id = ?";
		$par = array(
			'ap' => $risk['action_plan'], 'dd' => $risk['due_date'], 'division' => $risk['division'],
			'id' => $action_id
		);
		$query = $this->db->query($sql, $par);

		$sql = "delete from t_action_plan_cr_change where change_id = '$action_id' and switch_flag = 'P'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change set switch_flag = 'P' where change_id = '$action_id' and switch_flag = 'C'";
		$query = $this->db->query($sql);

		return true;
	}

	public function actionPlanVerify_cr($action_id, $risk_id, $dac, $risk, $uid) 
	{	
		$id = $risk['id'];
		$action_plan = $risk['action_plan'];
		$due_date = $risk['due_date'];
		$division = $risk['division'];


		$sql = "update t_action_plan a, t_cr_risk b, t_action_plan_cr c
				set a.action_plan = '$action_plan', a.due_date = '$due_date', a.division = '$division', a.assigned_to = (select username from m_user where division_id = '$division' and role_id = 4)
				where a.id_ap = b.switch_flag and b.cr_type = 'Action Plan Form' and b.cr_status = '0' and b.id = c.change_id and c.change_id = '$action_id' and a.id_ap = '$id'";
		$query = $this->db->query($sql);

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.existing_control_id = null  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and a.action_plan_status > 2 and b.id = '$id'";
		$query = $this->db->query($sql);

		$sql = "update t_cr_risk 
				set cr_status = '1', switch_flag = null
				where id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr 
				set cr_status = '1'
				where change_id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change 
				set cr_status = '1'
				where change_id = '$action_id'";
		$query = $this->db->query($sql);
		
		return true;
	}

	public function actionPlanExeVerify_cr($action_id, $risk, $uid) 
	{	

		if($risk['execution_status'] == 'COMPLETE'){
				
				$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.execution_status = '".$risk['execution_status']."', execution_explain = '".$risk['execution_explain']."', execution_evidence = '".$risk['execution_evidence']."', execution_reason = null, revised_date = null, a.existing_control_id = null  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and a.action_plan_status > 2 and b.id = '".$risk['id']."'";
				$query = $this->db->query($sql);

		}else if($risk['execution_status'] == 'ONGOING'){

				$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.execution_status = '".$risk['execution_status']."', execution_explain = '".$risk['execution_explain']."', execution_evidence = null, execution_reason = null, revised_date = null, a.existing_control_id = null  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and a.action_plan_status > 2 and b.id = '".$risk['id']."'";
				$query = $this->db->query($sql);
		}else{

				$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c set a.execution_status = '".$risk['execution_status']."', execution_explain = null, execution_evidence = null, execution_reason = '".$risk['execution_reason']."', revised_date = '".$risk['revised_date']."', a.existing_control_id = null  
				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and a.action_plan_status > 2 and b.id = '".$risk['id']."'";
				$query = $this->db->query($sql);
		}

		$sql = "update t_cr_risk 
				set cr_status = '1', switch_flag = null
				where id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr 
				set cr_status = '1'
				where change_id = '$action_id'";
		$query = $this->db->query($sql);

		$sql = "update t_action_plan_cr_change 
				set cr_status = '1'
				where change_id = '$action_id'";
		$query = $this->db->query($sql);
		
		return true;
	}
	
	private function _logHistory($data_id, $uid, $mode) {
		$sql = "insert into t_risk_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from t_risk a
				where a.risk_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	/* RISK ACTION FUNCTION */
	
	/* KRI FUNCTION */
	public function insertNewKri($kri, $treshold) {
		$sql = "insert into t_kri (
			risk_id, kri_library_id, key_risk_indicator,
			kri_status, kri_pic,mandatory, treshold_type,
			timing_pelaporan, kri_owner, created_by
		) values (
			?, ?, ?,?,
			?, ?, ?,
			?, ?, ?
		)";
		$res = $this->db->query($sql, $kri);	
		if ($res) {
			$rid = $this->db->insert_id();
			$sql = "update t_kri set 
					kri_code = concat('KRI.', LPAD(id, 6, '0'))
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));

			$sql = "update t_kri set 
					timing_pelaporan = null
					where timing_pelaporan = '0000-00-00'";
			$res2 = $this->db->query($sql);	
			
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
					'rid' => $rid,
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

			/*if($below == $between){
			$tambah = $between+1;
			$sql = "update t_kri_treshold set value_1='".$tambah."'  where kri_id='".$rid."' and operator ='BETWEEN' ";
			$res7 = $this->db->query($sql);
			}
			if($between2 == $above){
			$tambah2 = $above+1;
			$sql = "update t_kri_treshold set value_1='".$tambah2."'  where kri_id='".$rid."' and operator ='ABOVE' ";
			$res8 = $this->db->query($sql);
			}*/
		}
			return $res;
		}
	}

	public function updateNewKri($k_id, $kri, $treshold) {
		$sql = " update t_kri set risk_id ='".$kri['risk_id']."', kri_library_id = '".$kri['kri_library_id']."', key_risk_indicator = '".$kri['key_risk_indicator']."',
			kri_status = '".$kri['kri_status']."', kri_pic = '".$kri['kri_pic']."',mandatory = '".$kri['mandatory']."', treshold_type = '".$kri['treshold_type']."',
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

	public function updateNewKri_verify($k_id, $kri, $treshold) {
		$sql = " update t_kri set risk_id ='".$kri['risk_id']."', kri_library_id = '".$kri['kri_library_id']."', key_risk_indicator = '".$kri['key_risk_indicator']."',
			kri_status = '".$kri['kri_status']."', kri_pic = '".$kri['kri_pic']."',mandatory = '".$kri['mandatory']."', treshold_type = '".$kri['treshold_type']."',
			timing_pelaporan = '".$kri['timing_pelaporan']."', kri_owner = '".$kri['kri_owner']."', owner_report = '".$kri['owner_report']."', created_by = '".$kri['created_by']."', supporting_evidence = '".$kri['supporting_evidence']."', validation = '".$kri['validation']."' where id = '".$k_id."'
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

		public function insertNewKri_head($kri, $treshold) {
		$sql = "insert into t_kri (
			risk_id, kri_library_id, key_risk_indicator,
			kri_status, kri_pic,mandatory, treshold_type,
			timing_pelaporan, kri_owner, created_by
		) values (
			?, ?, ?,?,
			?, ?, ?,
			?, ?, ?
		)";
		$res = $this->db->query($sql, $kri);	
		if ($res) {
			$rid = $this->db->insert_id();
			$sql = "update t_kri set 
					kri_code = concat('KRI.', LPAD(id, 6, '0'))
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));

			$sql = "update t_kri set 
					timing_pelaporan = null
					where timing_pelaporan = '0000-00-00'";
			$res2 = $this->db->query($sql);	
			
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
					'rid' => $rid,
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

			/*if($below == $between){
			$tambah = $between+1;
			$sql = "update t_kri_treshold set value_1='".$tambah."'  where kri_id='".$rid."' and operator ='BETWEEN' ";
			$res7 = $this->db->query($sql);
			}
			if($between2 == $above){
			$tambah2 = $above+1;
			$sql = "update t_kri_treshold set value_1='".$tambah2."'  where kri_id='".$rid."' and operator ='ABOVE' ";
			$res8 = $this->db->query($sql);
			}*/
		}
			return $res;
		}
	}

	public function updateNewKri_sub($k_id, $kri, $treshold) {
		$sql = " update t_kri set risk_id ='".$kri['risk_id']."', kri_library_id = '".$kri['kri_library_id']."', key_risk_indicator = '".$kri['key_risk_indicator']."',
			kri_status = '".$kri['kri_status']."', kri_pic = '".$kri['kri_pic']."',mandatory = '".$kri['mandatory']."', treshold_type = '".$kri['treshold_type']."',
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

	/*MAsukin TMP dulu buat cek double color*/
	public function insertNewKriTmp($kri, $treshold) {
		$sql = "insert into t_kri_tmp (
			risk_id, kri_library_id, key_risk_indicator,
			kri_status, kri_pic,mandatory, treshold_type,
			timing_pelaporan, kri_owner, created_by
		) values (
			?, ?, ?,?,
			?, ?, ?,
			?, ?, ?
		)";
		$res = $this->db->query($sql, $kri);	
		if ($res) {
			$rid = $this->db->insert_id();
			$sql = "update t_kri_tmp set 
					kri_code = concat('KRI.', LPAD(id, 6, '0'))
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));	
			
			// insert treshold
			$sql = "insert into t_kri_treshold_tmp(kri_id, operator, value_1, value_2, value_type, result) values(?, ?, ?, ?, ?, ?)";
			
			foreach ($treshold as $key => $value) {
				if ($value['value_2'] == '-') {
					$value['value_2'] = null;
				}
				if ($value['value_type'] == '-') {
					$value['value_type'] = null;
				}
				
				$par = array(
					'rid' => $rid,
					'op' => $value['operator'],
					'v1' => $value['value_1'],
					'v2' => $value['value_2'],
					'r' => $value['value_type'],
					'r2' => $value['result']
				);
				$res3 = $this->db->query($sql, $par);
			}

		if ($kri['treshold_type'] == 'VALUE'){
			$sql = "select value_1 from t_kri_treshold_tmp where kri_id='".$rid."' and operator ='BELOW' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$below = $row->value_1;


			$sql = "select value_1, value_2 from t_kri_treshold_tmp where kri_id='".$rid."' and operator ='BETWEEN' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$between = $row->value_1;
			$between2 = $row->value_2;
			

			$sql = "select value_1 from t_kri_treshold_tmp where kri_id='".$rid."' and operator ='ABOVE' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$above = $row->value_1;

			if($below == $between){
			$tambah = $between+1;
			$sql = "update t_kri_treshold_tmp set value_1='".$tambah."'  where kri_id='".$rid."' and operator ='BETWEEN' ";
			$res7 = $this->db->query($sql);
			}
			if($between2 == $above){
			$tambah2 = $above+1;
			$sql = "update t_kri_treshold_tmp set value_1='".$tambah2."'  where kri_id='".$rid."' and operator ='ABOVE' ";
			$res8 = $this->db->query($sql);
			}
		}
			$sql = "select result from t_kri_treshold_tmp where result = 'GREEN' and kri_id='".$rid."' ";
			$res_cek1 = $this->db->query($sql);
			$sql = "select result from t_kri_treshold_tmp where result = 'RED' and kri_id='".$rid."' ";
			$res_cek2 = $this->db->query($sql);
			$sql = "select result from t_kri_treshold_tmp where result = 'YELLOW' and kri_id='".$rid."' ";
			$res_cek3 = $this->db->query($sql);

			if ($res_cek1->num_rows() > 1){
				$sql = "delete from t_kri_tmp where id='".$rid."' ";
				$this->db->query($sql);
				$sql = "delete from t_kri_treshold_tmp where kri_id='".$rid."' ";
				$this->db->query($sql);
				return false;
			}else if($res_cek2->num_rows() > 1){
				$sql = "delete from t_kri_tmp where id='".$rid."' ";
				$this->db->query($sql);
				$sql = "delete from t_kri_treshold_tmp where kri_id='".$rid."' ";
				$this->db->query($sql);
				return false;
			}else if($res_cek3->num_rows() > 1){
				$sql = "delete from t_kri_tmp where id='".$rid."' ";
				$this->db->query($sql);
				$sql = "delete from t_kri_treshold_tmp where kri_id='".$rid."' ";
				$this->db->query($sql);
				return false;
			}else{
				$sql = "delete from t_kri_tmp where id='".$rid."' ";
				$this->db->query($sql);
				$sql = "delete from t_kri_treshold_tmp where kri_id='".$rid."' ";
				$this->db->query($sql);
				return true;
			}
		}
	}

	public function deleteNewKri($k_id, $kri, $treshold) {
		$sql = "delete from t_kri where id = '".$k_id."'";
		$res = $this->db->query($sql);	
		
		$sql = "delete from t_kri_treshold where kri_id = '".$k_id."'";
		
		$res = $this->db->query($sql);
		
		return $res;
	}
	
	public function assignPicKri($risk_id, $pic) {
		$sql = "update t_kri set 
				kri_pic = ?
				where
				id = ?
				";
		$par = array(
			'pic' => $pic,
			'rid' => $risk_id
		);
		
		$res = $this->db->query($sql, $par);
		return $res;
	}
	
	public function getTreshold($risk_id) 
	{
		$sql = "select * from t_kri_treshold
				where kri_id = ?";
		$par = array('uid' => $risk_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getKriById($risk_id) 
	{
		$sql = "select 
				a.*,
				date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
				b.risk_code,
				c.division_name as kri_owner_v,
				d.display_name as kri_pic_v
				from t_kri a
				left join t_risk b on a.risk_id = b.risk_id
				left join m_division c on a.kri_owner = c.division_id
				left join m_user d on a.kri_pic = d.username
				where a.id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['treshold_list'] = $this->getTreshold($risk_id);
		}
		
		return $row;
	}
	
	public function updateKri($id, $kri, $uid) {
		//$this->_logHistory($risk_id, $uid, 'U');
		
		$par = array();
		$keyupdate = '';
		foreach($kri as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['id'] = $id;
		$sql = "update t_kri set ".$keyupdate
			  ."created_date = now()
			  	where id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			return true;
		} else {
			return false;
		}
	}

	public function updateKri_no($id, $kri, $uid, $treshold) {
		//$this->_logHistory($risk_id, $uid, 'U');
		
		$par = array();
		$keyupdate = '';
		foreach($kri as $k=>$v) {
			$keyupdate .= $k.' = ?, ';
			$par[$k] = $v;
		}

		$par['id'] = $id;
		$sql = "update t_kri set ".$keyupdate
			  ."created_date = now()
			  	where id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			$sql = "update t_kri set 
					timing_pelaporan = null
					where timing_pelaporan = '0000-00-00'";
			$res2 = $this->db->query($sql);
			
			$sql = "delete from t_kri_treshold where kri_id = '".$id."'";
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
					'rid' => $id,
					'op' => $value['operator'],
					'v1' => $value['value_1'],
					'v2' => $value['value_2'],
					'r' => $value['value_type'],
					'r2' => $value['result']
				);
				$res3 = $this->db->query($sql, $par);
			}

		if ($kri['treshold_type'] == 'VALUE'){
			$sql = "select value_1 from t_kri_treshold where kri_id='".$id."' and operator ='BELOW' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$below = $row->value_1;


			$sql = "select value_1, value_2 from t_kri_treshold where kri_id='".$id."' and operator ='BETWEEN' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$between = $row->value_1;
			$between2 = $row->value_2;
			

			$sql = "select value_1 from t_kri_treshold where kri_id='".$id."' and operator ='ABOVE' ";
			$query = $this->db->query($sql);
			$row = $query->row();
			$above = $row->value_1;

		}
			return true;
		} else {
			return false;
		}
	}

	public function deleteKri($id, $kri, $uid) {
		//$this->_logHistory($risk_id, $uid, 'U');
		
		$par = array();

		$par['id'] = $id;
		$sql = "delete from t_kri
			  	where id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			return true;
		} else {
			return false;
		}
	}
	
	public function addRiskToKri($rids)
	{
		$ex = '('.implode("),(", $rids).')';
		$sql = "insert into t_kri_risk values ".$ex;
		$res = $this->db->query($sql);
		return $res;
	}
	
	public function riskAddUser($risk_id, $risk_code, $username, $date_changed, $uid)
	{
		//delete dulu yang ada add user nya
		$sql = "delete from t_risk_add_user where risk_id ='".$risk_id."' and username ='".$username."' ";
		$res = $this->db->query($sql);

		$sql = "update t_risk_properties set status = 'change request' where risk_id ='".$risk_id."' and username ='".$username."' and status = 'submitted'";
		$res = $this->db->query($sql);

		/*$sql = "delete from t_risk_properties where risk_id ='".$risk_id."' and username ='".$uid."' and date_changed = '".$date_changed."' and status = 'verify'"*/;
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_add_user (risk_id,username,date_changed,risk_library_id) values(?, ? ,? ,?)";
		$par = array(
			'rid' => $risk_id,
			'un' => $username,
			'dc' => $date_changed,
			'lib' => 1
		);
		$res = $this->db->query($sql, $par);

		$sql = "insert into t_risk_properties (risk_id, risk_code, username, date_changed, status) values(?, ? ,? ,?, 'submitted')";
		$par = array(
			'rid' => $risk_id,
			'ric' => $risk_code,
			'un' => $username,
			'dc' => $date_changed
		);
		$res = $this->db->query($sql, $par);		

		$sql = "insert into t_risk_properties (risk_id, risk_code, username, date_changed, status) values(?, ? ,? ,NOW(), 'verify')";
		$par = array(
			'rid' => $risk_id,
			'ric' => $risk_code,
			'un' => $uid
		);
		$res = $this->db->query($sql, $par);

		return $res;
	}

	public function riskAddUser1form($risk_id, $username, $date_changed)
	{
		//delete dulu yang ada add user nya
		$sql = "delete from t_risk_add_user where risk_id ='".$risk_id."' and username ='".$username."' ";
		$res = $this->db->query($sql);

		$sql = "insert into t_risk_add_user (risk_id,username,date_changed) values(?, ? ,?)";
		$par = array(
			'rid' => $risk_id,
			'un' => $username,
			'dc' => $date_changed
			
		);
		$res = $this->db->query($sql, $par);
		return $res;
	}
	/* KRI FUNCTION */
	
	/* CHANGE REQUEST */
	public function getPendingChangeByRiskId($risk_id) {
		$sql = "select 
				a.*
				from t_cr_risk a 
				where a.cr_status = 0 and a.risk_id = ? ";
		$query = $this->db->query($sql, array('divid' => $risk_id));
		$row = $query->row_array();
		return $row;
	}
	
	public function getPendingChangeByActionId($act_id) {
		$sql = "select 
				a.*
				from t_cr_action_plan a join t_cr_risk b on a.change_id = b.id
				where b.cr_status = 0 and a.id = ? ";
		$query = $this->db->query($sql, array('divid' => $act_id));
		$row = $query->row_array();
		return $row;
	}
	
	
	
	public function getChangeById($ch_id, $change = false) {
		$tab = 't_cr_risk';
		if ($change) $tab = 't_cr_risk_change';
		
		$sql = "select 
				a.*,
				b.risk_code,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				
				k.ref_value as treatment_v
				from ".$tab." a 
				left join t_risk b on a.risk_id = b.risk_id
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				where a.id = ? ";
				
		$query = $this->db->query($sql, array('divid' => $ch_id));
		$row = $query->row_array();
		
		if ($row) {
			$row['impact_list'] = $this->getChangeRequestRiskImpact($ch_id, $change);
			$row['action_plan_list'] = $this->getChangeRequestActionPlan($ch_id, $change);
			$row['control_list'] = $this->getChangeRequestControlList($ch_id, $change);
			$row['objective_list'] = $this->getChangeRequestObjectiveList($ch_id, $change);
		}
		
		return $row;
	}
	
	public function getChangeByIdNoRef($ch_id, $change = false) {
		$tab = 't_cr_risk';
		if ($change) {
			$tab = 't_cr_risk_change';
		}
		
		$sql = "select 
				a.*,
				b.risk_code,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				
				k.ref_value as treatment_v
				from ".$tab." a 
				left join t_risk b on a.risk_id = b.risk_id
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				where a.id = ?";
				
		$query = $this->db->query($sql, array('divid' => $ch_id));
		$row = $query->row_array();
		return $row;
	}

	public function getChangeById_risk($ch_id) {
		$tab = 't_cr_risk';
		    
		$sql = "select 
				a.*,
				b.risk_code,
				c.ref_value as risk_level_v,
				d.ref_value as impact_level_v,
				e.l_title as likelihood_v,
				f.division_name as risk_owner_v,
				
				k.ref_value as treatment_v
				from ".$tab." a 
				left join t_risk b on a.risk_id = b.risk_id
				left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
				left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
				left join m_likelihood e on a.risk_likelihood_key = e.l_key
				left join m_division f on a.risk_owner = f.division_id
				
				left join m_reference k on a.suggested_risk_treatment = k.ref_key and k.ref_context = 'treatment.status'
				where a.id = ? ";
				
		$query = $this->db->query($sql, array('divid' => $ch_id));
		$row = $query->row_array();
		return $row;
	}
	
	public function getChangeRequestRiskImpact($ch_id, $change = false) 
	{
		$tab = 't_cr_impact';
		if ($change) {
			$tab = 't_cr_impact_change';
		}
		
		$sql = "select * from ".$tab."
				where change_id = ?";
		$par = array('uid' => $ch_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getChangeRequestActionPlan($ch_id, $change = false) 
	{
		$tab = 't_cr_action_plan';
		if ($change) {
			$tab = 't_cr_action_plan_change';
		}
		
		$sql = "select a.*,
				date_format(a.due_date, '%d-%m-%Y') as due_date_v,
				b.division_name as division_v
				from ".$tab." a
				left join m_division b on a.division = b.division_id 
				where a.change_id = ?";
		$par = array('uid' => $ch_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function getChangeRequestControlList($ch_id, $change = false) 
	{
		$tab = 't_cr_control';
		if ($change) {
			$tab = 't_cr_control_change';
		}
		
		$sql = "select a.*
				from ".$tab." a
				where a.change_id = ?";
		$par = array('uid' => $ch_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}

	public function getChangeRequestObjectiveList($ch_id, $change = false) 
	{
		$tab = 't_cr_objective';
		if ($change) {
			$tab = 't_cr_objective_change';
		}
		
		$sql = "select a.*
				from ".$tab." a
				where a.change_id = ?";
		$par = array('uid' => $ch_id);
		
		$query = $this->db->query($sql, $par);
		$res = array();
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function insertChangeRequest($risk, $suggested_rt, $sts_risk, $impact, $actplan, $control, $objective, $uid)
	{
		//ubah
		$risk_id_cek = $_POST['risk_id'];
		$sql="select risk_existing_control from t_risk where risk_id = '$risk_id_cek' ";
		$query = $this->db->query($sql);
		$row = $query->row(); 
		$hasil = $row->risk_existing_control;
		if($hasil != 'under'){


		$this->db->trans_start();
		$retval = false;
		
		$sql = "INSERT INTO t_cr_risk (
			cr_type, cr_status, risk_id, risk_status, risk_owner, risk_division, risk_event, risk_description, risk_cause, risk_impact, 
			risk_level, risk_impact_level, risk_likelihood_key, 
			suggested_risk_treatment, switch_flag, created_by, created_date
		) VALUES (
			?, 0, ?, ?, ?, ?, ?, ?, ?, ?,
			?, ?, ?,
			?, 'P', ?, NOW() 
		)";
		$res = $this->db->query($sql, $risk);
		if ($res) {
			$rid = $this->db->insert_id();
			$risk_id = $_POST['risk_id'];
			
			$sql = "update t_cr_risk set 
					cr_code = concat('CH.', LPAD(id, 6, '0'))
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));	
			
			// copy to change
			$sql = "INSERT INTO `t_cr_risk_change`(`id`, `cr_code`, `cr_type`, `cr_status`, `risk_id`, `risk_status`, `risk_owner`, `risk_division`, `risk_event`, `risk_description`, `risk_cause`, `risk_impact`, `risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, `switch_flag`, `created_by`, `created_date`) SELECT `id`, `cr_code`, `cr_type`, `cr_status`, `risk_id`, `risk_status`, `risk_owner`, `risk_division`, `risk_event`, `risk_description`, `risk_cause`, `risk_impact`, `risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, `switch_flag`, `created_by`, `created_date` FROM t_cr_risk WHERE id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));	

			// update from primary
			$sql = "update t_cr_risk a
					join t_risk b on a.risk_id = b.risk_id
					set
						a.risk_status = '".$risk['risk_status']."',
						a.risk_owner = b.risk_owner,
						a.risk_division = b.risk_division, 
						a.risk_event = b.risk_event,
						a.risk_description = b. risk_description,
						a.risk_cause = b.risk_cause,
						a.risk_impact = b.risk_impact,
						a.risk_level = b.risk_level,
						a.risk_impact_level = b.risk_impact_level,
						a.risk_likelihood_key = b.risk_likelihood_key,
						a.suggested_risk_treatment = b.suggested_risk_treatment
					where a.id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));

			$sql_cek_lib = "select * from t_risk a, t_risk_change b where a.risk_id = b.risk_id and a.risk_id = '".$risk['risk_id']."' and b.risk_input_by = '".$uid."'";
			$res_cek_lib = $this->db->query($sql_cek_lib);
    			
			if($sts_risk >= 3){
				$sql = "update t_risk set risk_existing_control = 'request' where risk_id = '".$risk['risk_id']."'";
					$res2 = $this->db->query($sql);
			}else{
				if($res_cek_lib->num_rows() > 0){
					$sql = "update t_risk_change set risk_existing_control = 'request' where risk_id = '".$risk['risk_id']."' and risk_input_by = '".$uid."'";
					$res2 = $this->db->query($sql);
				}else{
					$sql = "update t_risk set risk_existing_control = 'request' where risk_id = '".$risk['risk_id']."'";
					$res2 = $this->db->query($sql);
				}
			}
			//delete dulu biar ga bentrok di Change request owner
			$sql = "delete from t_cr_impact_change where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);
			
			// insert impact
			$sql = "insert into t_cr_impact_change(change_id, risk_id, impact_id, impact_level, switch_flag) 
					values(?, ?, ?, ?, 'P')";
			foreach ($impact as $key => $value) {
				$par = array(
					'rid' => $rid,
					'risk_id' => $risk_id,
					'iid' => $value['impact_id'],
					'il' => $value['impact_level']
				);
				$res3 = $this->db->query($sql, $par);
			}
			
			$sql = "delete from t_cr_impact where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);

			// copy to change
			$sql = "INSERT INTO t_cr_impact 
					select 
						id, ".$rid." as change_id, risk_id, impact_id, impact_level, switch_flag 
					from t_risk_impact
					where risk_id = ?";
			$res2 = $this->db->query($sql, array('a'=>$risk_id));	
			
			$sql = "delete from t_cr_control_change where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);
			
			// insert control
			$sql = "insert into t_cr_control_change(
						change_id, risk_id, existing_control_id, risk_existing_control, 
						risk_evaluation_control, risk_control_owner, switch_flag) 
					values(
						?, ?, ?, ?, 
					?, ?, 'P')";

			foreach ($control as $key => $value) {
				$ecid = $value['existing_control_id'];
				if ($value['existing_control_id'] == '') $ecid = null;
				$par = array(
					'rid' => $rid,
					'risk_id' => $risk_id,
					'ap' => $ecid,
					'dd' => $value['risk_existing_control'],
					'div1' => $value['risk_evaluation_control'],
					'div2' => $value['risk_control_owner']
				);
				$res5 = $this->db->query($sql, $par);
			}

			$sql = "delete from t_cr_control where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);
			
			$sql = "INSERT INTO t_cr_control
					select 
						id, ".$rid." as change_id, risk_id, existing_control_id, 
						risk_existing_control, risk_evaluation_control, risk_control_owner,
						switch_flag 
					from t_risk_control
					where risk_id = ?";
			$res2 = $this->db->query($sql, array('a'=>$risk_id));	

			$sql = "delete from t_cr_action_plan where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);

			// insert action plan
			$add = '';
			$par = array('i' => $risk_id);
			if ($risk['cr_type'] == 'Action Plan Form') {
				$act_id = $actplan[0]['id'];
				$add = ' and id = ? ';
				$par = array('i' => $risk_id, 'a' => $act_id);
			}
			$sql = "insert into t_cr_action_plan(change_id, id, risk_id, action_plan_status, action_plan, due_date, division, switch_flag)
					select 
					".$rid." as change_id, id, risk_id, action_plan_status, action_plan, due_date, division, switch_flag
					from t_risk_action_plan
					where risk_id = ? ".$add;
			$res4 = $this->db->query($sql, $par);

			if($suggested_rt == 'ACCEPT'){
				$sql = "delete from t_cr_action_plan_change where risk_id = ?";
				$par = array('risk_id' => $risk_id);
				$res = $this->db->query($sql, $par);
			}else{
			$sql = "delete from t_cr_action_plan_change where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);

			foreach ($actplan as $key => $value) {
					$sql = "insert into t_cr_action_plan_change(
								change_id, risk_id, action_plan_status, action_plan, 
								due_date, division, switch_flag,
								change_flag, data_flag
							) values(
								?, ?, 0, ?, 
								?, ?, 'P',
								?, ?
							)";
					$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
					$par = array(
						'rid' => $rid,
						'risk_id' => $risk_id,
						'ap' => $value['action_plan'],
						'dd' => $dd,
						'div' => $value['division'],
						'cf' => $value['change_flag'],
						'df' => $value['data_flag']
					);
					$res4 = $this->db->query($sql, $par);
				}
			}

			$sql = "delete from t_cr_objective_change where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);

			// insert objective
			$sql = "insert into t_cr_objective_change(
					risk_id, objective, change_id, switch_flag) 
					values(?, ?, ?, 'P')";
			foreach ($objective as $key => $value) {
				$ecid = $value['objective_id'];
				if ($value['objective_id'] == '') $ecid = null;
				$par = array(
					'risk_id' => $risk_id,
					'dd' => $value['objective'],
					'rid' => $rid,
				);
				$res5 = $this->db->query($sql, $par);
			}
			
			$sql = "delete from t_cr_objective where risk_id = ?";
			$par = array('risk_id' => $risk_id);
			$res = $this->db->query($sql, $par);

			// copy to change
			$sql = "INSERT INTO t_cr_objective(risk_id,objective,change_id, switch_flag)
					select 
						  risk_id, objective , ? as change_id , 'P'
					from t_risk_objective
					where risk_id = ?";

			$res2 = $this->db->query($sql, array('rid' => $rid,'a'=>$risk_id));		
			
			$retval = $rid;
		} else {
			$retval = false;
		}
		$this->db->trans_complete();
		return $retval;
		}
	}
	
	
	public function insertChangeRequestKri($risk)
	{
		$this->db->trans_start();
		$retval = false;
		
		$sql = "INSERT INTO t_cr_risk (
			cr_type, cr_status, risk_id, risk_cause, risk_impact, 
			risk_level, risk_impact_level, risk_likelihood_key, 
			suggested_risk_treatment, created_by, created_date
		) VALUES (
			?, 0, ?, ?, ?,
			?, ?, ?,
			?, ?, NOW() 
		)";
		$res = $this->db->query($sql, $risk);
		if ($res) {
			$rid = $this->db->insert_id();
			$risk_id = $_POST['risk_id'];
			
			$sql = "update t_cr_risk set 
					cr_code = concat('CH.', LPAD(id, 6, '0'))
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));	
			
			// copy to change
			$sql = "INSERT INTO t_cr_risk_change select * from t_cr_risk
					where id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));	
			
			// update from primary
			$sql = "update t_cr_risk_change a
					join t_kri b on a.risk_cause = b.id
					set 
						a.risk_impact = b.owner_report,
						a.risk_level = b.kri_warning
					where a.id = ?";
			$res2 = $this->db->query($sql, array('a'=>$rid));
			
			$retval = $res2;
		} else {
			$retval = false;
		}
		$this->db->trans_complete();
		return $retval;
	}
	
	public function changeRequestSaveDraft($ch_id, $risk_id, $suggested_rt, $change, $impact, $actplan, $control, $objective, $uid)
	{
		$par = array();
		$keyupdate = '';
		$res = true;
		

		if ($change) {
			foreach($change as $k=>$v) {
				$keyupdate .= $k.' = ?, ';
				$par[$k] = $v;
			}
	
			$par['ch_id'] = $ch_id;
			$sql = "update t_cr_risk set ".$keyupdate
				  ."created_date = now()
				  	where id = ?";
			$res = $this->db->query($sql, $par);

		}
		
		//ini buat AP change set as primary yahh ga jadi kayaknya
		/*
		if ($change == false) {
			foreach ($actplan as $key => $value) {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch_flag' => $value['change_flag'],
							'change_id' => $value['change_id']
						);
						$sql = "update t_cr_action_plan	
									set action_plan = ?, due_date = ?, division = ?, change_flag = ?
								where change_id = ?";
						$res4 = $this->db->query($sql, $par);
				}
			}
			*/
		

		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "update t_cr_impact set switch_flag = 'C' where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_impact(change_id, risk_id, impact_id, impact_level, switch_flag) values(?, ?, ?, ?, 'P')";
				foreach ($impact as $key => $value) {
					$par = array(
						'cid' => $ch_id,
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}

				$sql = "delete from t_cr_impact_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "insert into t_cr_impact_change(change_id, risk_id, impact_id, impact_level, switch_flag)select 
						change_id, risk_id, impact_id, impact_level, 'P'
						from t_cr_impact where change_id = ? and switch_flag = 'C'";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "delete from t_cr_impact where switch_flag = 'C' and change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
			}
			
			// insert control
			if ($control !== false) {
				$sql = "update t_cr_control set switch_flag = 'C' where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_control(
							change_id, risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag) 
						values(?, ?, ?, ?, ?, ?, 'P')";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'cid' => $ch_id,
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
				$sql = "delete from t_cr_control_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "insert into t_cr_control_change(change_id, risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, switch_flag)select 
						change_id, risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner, 'P'
						from t_cr_control where change_id = ? and switch_flag = 'C'";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "delete from t_cr_control where switch_flag = 'C' and change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
			}

			// insert objective
			if ($objective !== false) {
				$sql = "update t_cr_objective set switch_flag = 'C' where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_objective(
							risk_id, objective, change_id, switch_flag) 
						values(?, ?, ?, 'P')";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective'],
						'cid' => $ch_id
					);
					$res5 = $this->db->query($sql, $par);
				}
				$sql = "delete from t_cr_objective_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "insert into t_cr_objective_change(risk_id, objective, change_id, switch_flag)
				select risk_id, objective, change_id, 'P'
						from t_cr_objective where change_id = ? and switch_flag = 'C'";
				$this->db->query($sql, array('rid' => $ch_id));

				$sql = "delete from t_cr_objective where switch_flag = 'C' and change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));	

			}


			if ($actplan !== false) {
				$sql = "update t_cr_action_plan set switch_flag = 'C' where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));

				if($suggested_rt == 'ACCEPT'){

				}else{
					foreach ($actplan as $key => $value) {
					
							$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
							$par = array(
								'change_id' => $ch_id,
								'risk_id' => $risk_id,
								'ap' => $value['action_plan'],
								'dd' => $dd,
								'div' => $value['division'],
								'sf' => 'P',
								'ch' => 'ADD'
							);
							$sql = "insert into t_cr_action_plan	
									(change_id, id, risk_id, action_plan_status, action_plan,
									due_date, division, switch_flag, change_flag)
									values(?, NULL, ?, 0, ?,
									?, ?, ?, ?)";
							$res4 = $this->db->query($sql, $par);

					}
				}

				$sql = "delete from t_cr_action_plan_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "insert into t_cr_action_plan_change(cr_id, change_id, id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, 
						execution_status, execution_explain, execution_evidence, 
						execution_reason, revised_date, switch_flag, change_flag, data_flag) select 
						cr_id, change_id, id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, 
						execution_status, execution_explain, execution_evidence, 
						execution_reason, revised_date, 'P', change_flag, data_flag
						from t_cr_action_plan where change_id = ? and switch_flag = 'C'";
				$this->db->query($sql, array('rid' => $ch_id));


				$sql = "delete from t_cr_action_plan where switch_flag = 'C' and change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));

				}

			
			/*
			// insert action plan
			if ($actplan !== false) {
				$sql = "delete from t_cr_action_plan where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));

				foreach ($actplan as $key => $value) {
					if ($value['change_id'] != '') {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'change_id' => $ch_id,
							'risk_id' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch' => 'ADD'
						);
						$sql = "insert into t_cr_action_plan	
									(change_id, id, risk_id, action_plan_status, action_plan,
									due_date, division, change_flag)
								values(?, NULL, ?, 0, ?,
									?, ?, ?)";
						$res4 = $this->db->query($sql, $par);
						
					} else {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'change_id' => $ch_id,
							'risk_id' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch' => 'ADD'
						);
						$sql = "insert into t_cr_action_plan	
									(change_id, id, risk_id, action_plan_status, action_plan,
									due_date, division, change_flag)
								values(?, NULL, ?, 0, ?,
									?, ?, ?)";
						$res4 = $this->db->query($sql, $par);
					}
				}
			}
			*/
			
			
			return true;
		} else {
			return false;
		}
	}

	function insertt_cr_risk($id){
		  
		$sql = "INSERT INTO `t_cr_risk_change`(`id`, `cr_code`, `cr_type`, `cr_status`, `risk_id`, `risk_status`, `risk_owner`, `risk_division`, `risk_event`, `risk_description`, `risk_cause`, `risk_impact`, `risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, `switch_flag`, `created_by`, `created_date`) SELECT `id`, `cr_code`, `cr_type`, `cr_status`, `risk_id`, `risk_status`, `risk_owner`, `risk_division`, `risk_event`, `risk_description`, `risk_cause`, `risk_impact`, `risk_level`, `risk_impact_level`, `risk_likelihood_key`, `suggested_risk_treatment`, 'C', `created_by`, `created_date` from t_cr_risk where id = '".$id."'";
		$res = $this->db->query($sql);
		

		return $res;

	}

	function updatet_cr_risk($id){
		  
		$sql = "delete from `t_cr_risk_change` where id = '".$id."' and switch_flag = 'P'";
		$res = $this->db->query($sql);

		$sql = "update `t_cr_risk_change` set switch_flag = 'P' where id = '".$id."' and switch_flag = 'C'";
		$res = $this->db->query($sql);
		return $res;

	}

	public function changeRequestSaveDraftchanges($ch_id, $risk_id, $suggested_rt, $change, $impact, $actplan, $control, $objective, $uid)
	{
		$par = array();
		$keyupdate = '';
		$res = true;
		
		if ($change) {
			foreach($change as $k=>$v) {
				$keyupdate .= $k.' = ?, ';
				$par[$k] = $v;
			}
	
			$par['ch_id'] = $ch_id;
			$sql = "update t_cr_risk_change set ".$keyupdate
				  ."created_date = now()
				  	where id = ?";
			$res = $this->db->query($sql, $par);
		}
		
		if ($res) {
			// insert impact
			if ($impact !== false) {
				$sql = "delete from t_cr_impact_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_impact_change(change_id, risk_id, impact_id, impact_level) values(?, ?, ?, ?)";
				foreach ($impact as $key => $value) {
					$par = array(
						'cid' => $ch_id,
						'rid' => $risk_id,
						'iid' => $value['impact_id'],
						'il' => $value['impact_level']
					);
					$res3 = $this->db->query($sql, $par);
				}
			}
			
			// insert control
			if ($control !== false) {
				$sql = "delete from t_cr_control_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_control_change(
							change_id, risk_id, existing_control_id, risk_existing_control, 
							risk_evaluation_control, risk_control_owner) 
						values(?, ?, ?, ?, ?, ?)";
				foreach ($control as $key => $value) {
					$value['existing_control_id'] = $value['existing_control_id'] == '' || $value['existing_control_id'] == '0' ? null : $value['existing_control_id'];
					
					$par = array(
						'cid' => $ch_id,
						'rid' => $risk_id,
						'ap' => $value['existing_control_id'],
						'dd' => $value['risk_existing_control'],
						'da' => $value['risk_evaluation_control'],
						'div' => $value['risk_control_owner']
					);
					$res5 = $this->db->query($sql, $par);
				}
			}

			// insert objective
			if ($objective !== false) {
				$sql = "delete from t_cr_objective_change where change_id = ?";
				$this->db->query($sql, array('rid' => $ch_id));
				
				$sql = "insert into t_cr_objective_change(
							risk_id, objective, change_id) 
						values(?, ?, ?)";
				foreach ($objective as $key => $value) {
					$value['objective_id'] = $value['objective_id'] == '' || $value['objective_id'] == '0' ? null : $value['objective_id'];
					
					$par = array(
						'rid' => $risk_id,
						'ob' => $value['objective'],
						'cid' => $ch_id
					);
					$res5 = $this->db->query($sql, $par);
				}
			}
			

			if ($actplan !== false) {
				if($suggested_rt == 'ACCEPT'){
					$sql = "delete from t_cr_action_plan_change where change_id = ?";
					$this->db->query($sql, array('rid' => $ch_id));
				}else{
					$sql = "delete from t_cr_action_plan_change where change_id = ?";
					$this->db->query($sql, array('rid' => $ch_id));

					foreach ($actplan as $key => $value) {
					
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'change_id' => $ch_id,
							'risk_id' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch' => 'ADD'
						);
						$sql = "insert into t_cr_action_plan_change	
									(change_id, id, risk_id, action_plan_status, action_plan,
									due_date, division, change_flag)
								values(?, NULL, ?, 0, ?,
									?, ?, ?)";
						$res4 = $this->db->query($sql, $par);

					}
				}
			}

			/*
			// insert action plan
			if ($actplan !== false) {
				foreach ($actplan as $key => $value) {
					if ($value['cr_id'] != '') {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch_flag' => $value['change_flag'],
							'cr_id' => $value['cr_id']
						);
						$sql = "update t_cr_action_plan_change	
									set action_plan = ?, due_date = ?, division = ?, change_flag = ?
								where cr_id = ?";
						$res4 = $this->db->query($sql, $par);
					} else {
						$dd = implode('-', array_reverse( explode('-', $value['due_date']) ));
						$par = array(
							'change_id' => $ch_id,
							'risk_id' => $risk_id,
							'ap' => $value['action_plan'],
							'dd' => $dd,
							'div' => $value['division'],
							'ch' => 'ADD'
						);
						$sql = "insert into t_cr_action_plan_change	
									(change_id, id, risk_id, action_plan_status, action_plan,
									due_date, division, change_flag)
								values(?, NULL, ?, 0, ?,
									?, ?, ?)";
						$res4 = $this->db->query($sql, $par);
					}
				}
			}
			*/
			
			
			return true;
		} else {
			return false;
		}
	}

	
	public function changeRequestSwitchPrimary($change_id, $suggested_rt)
	{
		$res = false;
		$this->db->trans_start();
		
		$par['change_id'] = $change_id;
		
		// Risk Change
		$sql = "delete from t_cr_risk_change where switch_flag = 'C' and id = ?";
		$res4 = $this->db->query($sql, $par); 
		 
		$sql = "update t_cr_risk_change set switch_flag = 'C' where id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_risk_change select * from t_cr_risk where id = ?";
		$res = $this->db->query($sql, $par);
		
		
		// IMPACT
		 $sql = "update t_cr_impact set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "update t_cr_impact_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_impact_change 
				(change_id, risk_id, impact_id, impact_level, switch_flag)
				select 
				change_id, risk_id, impact_id, impact_level, switch_flag
				from t_cr_impact where change_id = ?";
		$res = $this->db->query($sql, $par);
		if ($res) {
			/*$sql = "delete from t_cr_impact where change_id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_impact(change_id, risk_id, impact_id, impact_level, switch_flag) 
					select change_id, risk_id, impact_id, impact_level, switch_flag
					from t_cr_impact_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			*/
			$sql = "delete from t_cr_impact_change where switch_flag = 'C' and change_id = ?";
			$res4 = $this->db->query($sql, $par);
		}
		 
		
		// CONTROL
		$sql = "update t_cr_control set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "update t_cr_control_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_control_change 
				select 
				id, change_id, risk_id, existing_control_id, risk_existing_control,
				risk_evaluation_control, risk_control_owner, switch_flag 
				from t_cr_control where change_id = ?";
		$res = $this->db->query($sql, $par);
		if ($res) {
			/*$sql = "delete from t_cr_control where change_id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_control(
						change_id, risk_id, existing_control_id, risk_existing_control,
						risk_evaluation_control, risk_control_owner, switch_flag
					) 
					select 
					change_id, risk_id, existing_control_id, risk_existing_control,
					risk_evaluation_control, risk_control_owner, switch_flag
					from t_cr_control_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			*/
			$sql = "delete from t_cr_control_change where switch_flag = 'C' and change_id = ?";
			$res4 = $this->db->query($sql, $par);
		} 
		
		
		// ACTION PLAN

		$sql = "update t_cr_action_plan set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "update t_cr_action_plan_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_action_plan_change 
				select 
				cr_id, change_id, id, risk_id, action_plan_status, action_plan, 
				due_date, division, assigned_to, 
				execution_status, execution_explain, execution_evidence, 
				execution_reason, revised_date, switch_flag, change_flag, data_flag
				from t_cr_action_plan where change_id = ?";
		$res = $this->db->query($sql, $par);
		if ($res) {
			//$sql = "delete from t_cr_action_plan where change_id = ?";
			//$res2 = $this->db->query($sql, $par);
			
			/*$sql = "insert into t_cr_action_plan(
						change_id, id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, 
						execution_status, execution_explain, execution_evidence, 
						execution_reason, revised_date, switch_flag, change_flag, data_flag
					) 
					select 
					change_id, id, risk_id, action_plan_status, action_plan, 
					due_date, division, assigned_to, 
					execution_status, execution_explain, execution_evidence, 
					execution_reason, revised_date, switch_flag, change_flag, data_flag
					from t_cr_action_plan_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			*/
			
			//$sql = "delete from t_cr_action_plan_change where switch_flag = 'C' and change_id = ?";
			
			$res4 = $this->db->query($sql, $par);
		}
		 
		
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestSwitchPrimary_($change_id)
	{
		$res = false;
		$this->db->trans_start();
		
		$par['change_id'] = $change_id;
		
		// Risk Change
		/*$sql = "update t_cr_risk set switch_flag = 'P' where id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "update t_cr_risk_change set switch_flag = 'C' where id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_risk_change select * from t_cr_risk where id = ?";
		$res = $this->db->query($sql, $par);
		if ($res) {
			$sql = "delete from t_cr_risk where id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_risk select * from t_cr_risk_change where switch_flag = 'C' and id = ?";
			$res3 = $this->db->query($sql, $par);
			
			$sql = "delete from t_cr_risk_change where switch_flag = 'C' and id = ?";
			$res4 = $this->db->query($sql, $par);
		}
		*/
		
		$sql = "delete from t_cr_risk_change where switch_flag = 'C' and id = ?";
		$res4 = $this->db->query($sql, $par); 
		 
		$sql = "update t_cr_risk_change set switch_flag = 'C' where id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_risk_change select * from t_cr_risk where id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			/*
			$sql = "delete from t_cr_risk where id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_risk select * from t_cr_risk_change where switch_flag = 'C' and id = ?";
			$res3 = $this->db->query($sql, $par);
			
			$sql = "delete from t_cr_risk_change where switch_flag = 'C' and id = ?";
			$res4 = $this->db->query($sql, $par);*/
		}
		
		// IMPACT
		 
		$sql = "update t_cr_impact set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_cr_impact_change where switch_flag = 'C' and change_id = ?";
		$res4 = $this->db->query($sql, $par);
		
		$sql = "update t_cr_impact_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_impact_change 
				(change_id, risk_id, impact_id, impact_level, switch_flag)
				select 
				change_id, risk_id, impact_id, impact_level, switch_flag
				from t_cr_impact where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			/*$sql = "delete from t_cr_impact where change_id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_impact(change_id, risk_id, impact_id, impact_level, switch_flag) 
					select change_id, risk_id, impact_id, impact_level, switch_flag
					from t_cr_impact_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			*/
			
		}
		
		// CONTROL
		
		
		$sql = "update t_cr_control set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "delete from t_cr_control_change where switch_flag = 'C' and change_id = ?";
		$res4 = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_control_change 
				select 
				id, change_id, risk_id, existing_control_id, risk_existing_control,
				risk_evaluation_control, risk_control_owner, switch_flag 
				from t_cr_control where change_id = ?";
		$res = $this->db->query($sql, $par);
		 /*
		$sql = "update t_cr_control_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		if ($res) {
			/*$sql = "delete from t_cr_control where change_id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_control(
						change_id, risk_id, existing_control_id, risk_existing_control,
						risk_evaluation_control, risk_control_owner, switch_flag
					) 
					select 
					change_id, risk_id, existing_control_id, risk_existing_control,
					risk_evaluation_control, risk_control_owner, switch_flag
					from t_cr_control_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			
			$sql = "delete from t_cr_control_change where switch_flag = 'C' and change_id = ?";
			$res4 = $this->db->query($sql, $par);
			
		}*/
		
		// ACTION PLAN
		$sql = "update t_cr_action_plan set switch_flag = 'P' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "update t_cr_action_plan_change set switch_flag = 'C' where change_id = ?";
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_cr_action_plan_change 
				select 
				cr_id, change_id, id, risk_id, action_plan_status, action_plan, 
				due_date, division, assigned_to, 
				execution_status, execution_explain, execution_evidence, 
				execution_reason, revised_date, switch_flag, change_flag, data_flag
				from t_cr_action_plan where change_id = ?";
		$res = $this->db->query($sql, $par);
		if ($res) {
			$sql = "delete from t_cr_action_plan where change_id = ?";
			$res2 = $this->db->query($sql, $par);
			
			$sql = "insert into t_cr_action_plan(
						change_id, id, risk_id, action_plan_status, action_plan, 
						due_date, division, assigned_to, 
						execution_status, execution_explain, execution_evidence, 
						execution_reason, revised_date, switch_flag, change_flag, data_flag
					) 
					select 
					change_id, id, risk_id, action_plan_status, action_plan, 
					due_date, division, assigned_to, 
					execution_status, execution_explain, execution_evidence, 
					execution_reason, revised_date, switch_flag, change_flag, data_flag
					from t_cr_action_plan_change where switch_flag = 'C' and change_id = ?";
			$res3 = $this->db->query($sql, $par);
			
			$sql = "delete from t_cr_action_plan_change where switch_flag = 'C' and change_id = ?";
			$res4 = $this->db->query($sql, $par);
		}
		
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestApplyVerify($change_id, $uid, $risk = true, $control = true, $action = true, $objective = true)
	{
		$res = false;
		$this->db->trans_start();
		
		$par['change_id'] = $change_id;
		$change = $this->getChangeById_risk($change_id, false);
		
		if ($change) {
			// Risk Change
			$par = array(
				'risk_event' => $change['risk_event'],
				'risk_description' => $change['risk_description'],
				'risk_owner' => $change['risk_division'],
				'risk_division' => $change['risk_division'],
				'risk_cause' => $change['risk_cause'],
				'risk_impact' => $change['risk_impact'],
				'risk_level' => $change['risk_level'],
				'risk_impact_level' => $change['risk_impact_level'],
				'risk_likelihood_key' => $change['risk_likelihood_key'],
				'suggested_risk_treatment' => $change['suggested_risk_treatment']
			);
			
			if ($risk) {
				//$this->updateRisk($change['risk_id'], $change['suggested_risk_treatment'], null, $par, false, false, false, $uid, 'CHANGE_REQUEST-VERIFY');
				$this->updateRisk_cr($change_id, $change['risk_id'], $change['suggested_risk_treatment'], null, $par, false, false, false, $uid, 'CHANGE_REQUEST-VERIFY');

				$this->changeRequestUpdateImpact($change_id, $change['risk_id'], $uid);
			}
			
			if ($control) {
				$this->changeRequestUpdateControl($change_id, $change['risk_id'], $uid);
			}
			
			if ($action) {
				$this->changeRequestUpdateActionPlan($change_id, $change['risk_id'], $change['suggested_risk_treatment'], $uid);
			}

			if ($objective) {
				$this->changeRequestUpdateObjective($change_id, $change['risk_id'], $uid);
			}

			if($change['risk_status'] < 3){
				$sql="update t_risk_change set risk_existing_control = null where risk_id ='".$change['risk_id']."' and risk_input_by = '".$change['created_by']."' and risk_status < 3";
				$res = $this->db->query($sql);

				$sql="update t_risk set risk_existing_control = null where risk_id ='".$change['risk_id']."' and risk_status < 3 and risk_library_id is null";
				$res = $this->db->query($sql);
			}else{
				$sql="update t_risk set risk_existing_control = null where risk_id ='".$change['risk_id']."'";
				$res = $this->db->query($sql);
			}

			$sql = "update t_cr_risk set cr_status = 1 where id = ?";
			$par = array('cid' => $change_id);
			$res = $this->db->query($sql, $par);
		}
		
		$this->db->trans_complete();
		return $res;
	}

	public function changeRequestApplyDelete($change_id, $uid, $risk = true, $control = true, $action = true, $objective = true)
	{
		$res = false;
		$this->db->trans_start();
		
		$par['change_id'] = $change_id;
		$change = $this->getChangeByIdNoRef($change_id, false);
		
		if ($change) {
			// Risk Change
			$par = array(
				'risk_cause' => $change['risk_cause'],
				'risk_impact' => $change['risk_impact'],
				'risk_level' => $change['risk_level'],
				'risk_impact_level' => $change['risk_impact_level'],
				'risk_likelihood_key' => $change['risk_likelihood_key'],
				'suggested_risk_treatment' => $change['suggested_risk_treatment'],
				'risk_event' => $change['risk_event'],
				'risk_description' => $change['risk_description']
			);
			
			if ($risk) {
				$this->updateRiskDelete($change['risk_id'], null, $par, false, false, false, $uid, 'CHANGE_REQUEST-VERIFY');

				//$this->changeRequestUpdateImpact($change_id, $change['risk_id'], $uid);
			}
			
			/*
			if ($control) {
				$this->changeRequestUpdateControl($change_id, $change['risk_id'], $uid);
			}
			
			if ($action) {
				$this->changeRequestUpdateActionPlan($change_id, $change['risk_id'], $uid);
			}

			if ($objective) {
				$this->changeRequestUpdateObjective($change_id, $change['risk_id'], $uid);
			}
			*/

			$sql = "update t_cr_risk set cr_status = 1 where id = ?";
			$par = array('cid' => $change_id);
			$res = $this->db->query($sql, $par);
		}
		
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestApplyKri($change_id, $uid)
	{
		$res = false;
		$this->db->trans_start();
		
		$par['change_id'] = $change_id;
		$change = $this->getChangeByIdNoRef($change_id, false);
		
		if ($change) {
			// Risk Change
			$id = $change['risk_cause'];
			$kri = array(
				'owner_report' => $change['risk_impact'],
				'kri_warning' => $change['risk_level']
			);
			
			$res = $this->updateKri($id, $kri, $uid);
			
			$sql = "update t_cr_risk set cr_status = 1 where id = ?";
			$par = array('cid' => $change['id']);
			$res = $this->db->query($sql, $par);
		}
		
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestUpdateImpact($change_id, $risk_id, $uid)
	{
		$res = false;
		$this->db->trans_start();
		
		$this->_logHistoryImpact($risk_id, $uid, 'CHANGE_REQUEST-VERIFY');
		
		$sql = "delete from t_risk_impact where risk_id = ?";
		$par = array('rid' => $risk_id);
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_risk_impact(risk_id, impact_id, impact_level, switch_flag) 
				select risk_id, impact_id, impact_level, switch_flag
				from t_cr_impact where change_id = ?";
		$par = array('cid' => $change_id);
		$res = $this->db->query($sql, $par);
				
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestUpdateControl($change_id, $risk_id, $uid)
	{
		$res = false;
		$this->db->trans_start();
		
		$this->_logHistoryControl($risk_id, $uid, 'CHANGE_REQUEST-VERIFY');
		
		$sql = "delete from t_risk_control where risk_id = ?";
		$par = array('rid' => $risk_id);
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_risk_control
				(risk_id, existing_control_id, risk_existing_control, 
				risk_evaluation_control, risk_control_owner, switch_flag) 
				select 
				risk_id, existing_control_id, risk_existing_control, 
				risk_evaluation_control, risk_control_owner, switch_flag
				from t_cr_control where change_id = ?";
		$par = array('cid' => $change_id);
		$res3 = $this->db->query($sql, $par);
				
		$this->db->trans_complete();
		return $res;
	}

	public function changeRequestUpdateObjective($change_id, $risk_id, $uid)
	{
		$res = false;
		$this->db->trans_start();
		
		//$this->_logHistoryControl($risk_id, $uid, 'CHANGE_REQUEST-VERIFY');
		
		$sql = "delete from t_risk_objective where risk_id = ?";
		$par = array('rid' => $risk_id);
		$res = $this->db->query($sql, $par);
		
		$sql = "insert into t_risk_objective
				(risk_id, objective, switch_flag) 
				select 
				risk_id, objective, switch_flag
				from t_cr_objective where change_id = ?";
		$par = array('cid' => $change_id);
		$res3 = $this->db->query($sql, $par);
				
		$this->db->trans_complete();
		return $res;
	}
	
	public function changeRequestUpdateActionPlan($change_id, $risk_id, $suggested_rt, $uid)
	{

		$res = false;
		$this->db->trans_start();
		
		//$this->_logHistoryAction($risk_id, $uid, 'CHANGE_REQUEST-VERIFY');
		
		//$cr_actplan = $this->getChangeRequestActionPlan($change_id, false);
		

		$sql = "delete from t_risk_action_plan where risk_id = '$risk_id'";
		$par = array('rid' => $risk_id);
		$res = $this->db->query($sql, $par);

		$sql = "insert into t_risk_action_plan
				(risk_id, action_plan_status, action_plan, due_date, division, switch_flag)
				select risk_id, 0, action_plan, due_date, division, 'P' from t_cr_action_plan  where change_id = ?";
		$par = array('cid' => $change_id);
		$res3 = $this->db->query($sql, $par);

		$this->db->trans_complete();
		return $res;
	}
	/* CHANGE REQUEST */
	
	private function _logHistoryImpact($data_id, $uid, $mode) {
		$sql = "insert into t_risk_impact_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from t_risk_impact a
				where a.risk_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	private function _logHistoryControl($data_id, $uid, $mode) {
		$sql = "insert into t_risk_control_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date
				from t_risk_control a
				where a.risk_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	private function _logHistoryAction($data_id, $uid, $mode) {
		$sql = "insert into t_risk_action_plan_hist
				select a.*, 
					'".$mode."' as update_status, '".$uid."' as update_by, NOW() as update_date,
				NULL AS status_act 
				from t_risk_action_plan a
				where a.risk_id = ?
				";
		$this->db->query($sql, array('did'=>$data_id));	
	}
	
	
	function getAllRisk_export($filter){
	 
			$filtaradd = "";
			
				if(isset($filter['search'])){
					if($filter['search']!=""){
						$filtaradd = "where risk_event like '%".$filter['search']."%'";
					}
				}	
		
		 $sql ="SELECT * FROM (SELECT 
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
                                                                b.ref_value AS risk_status_v,
                                                                c.ref_value AS risk_level_v,
                                                                d.ref_value AS impact_level_v,
                                                                e.l_title AS likelihood_v,
                                                                f.division_name AS risk_owner_v
                                                                FROM t_risk a 
                                                                JOIN t_risk_change g ON a.risk_id = g.risk_id
                                                                LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
                                                                LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
                                                                LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
                                                                LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
                                                                LEFT JOIN m_division f ON a.risk_owner = f.division_id
                                                                LEFT JOIN m_periode ON m_periode.periode_id = a.periode_id
                                                                WHERE  a.periode_id IN (SELECT periode_id FROM m_periode WHERE DATE(NOW()) BETWEEN periode_start AND periode_end) AND g.risk_status > 1 AND g.risk_status < 3
                                                                AND a.risk_event LIKE '%'
                                                                ORDER BY a.risk_id DESC
                                                                
                                                                 ) AS another
                                                                GROUP BY another.risk_code

                                                                UNION
                                                                SELECT * FROM (SELECT 
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
                                                                b.ref_value AS risk_status_v,
                                                                c.ref_value AS risk_level_v,
                                                                d.ref_value AS impact_level_v,
                                                                e.l_title AS likelihood_v,
                                                                f.division_name AS risk_owner_v
                                                                FROM t_risk a 
                                                               
                                                                LEFT JOIN m_reference b ON a.risk_status = b.ref_key AND b.ref_context = 'risk.status.user'
                                                                LEFT JOIN m_reference c ON a.risk_level = c.ref_key AND c.ref_context = 'risklevel.display'
                                                                LEFT JOIN m_reference d ON a.risk_impact_level = d.ref_key AND d.ref_context = 'impact.display'
                                                                LEFT JOIN m_likelihood e ON a.risk_likelihood_key = e.l_key
                                                                LEFT JOIN m_division f ON a.risk_owner = f.division_id
                                                                LEFT JOIN m_periode ON m_periode.periode_id = a.periode_id
                                                                WHERE  a.periode_id IN (SELECT periode_id FROM m_periode WHERE DATE(NOW()) BETWEEN periode_start AND periode_end) AND a.risk_status > 1
                                                                AND a.risk_event LIKE '%'
                                                                ORDER BY a.risk_id DESC
                                                                
                                                                 ) AS another
                                                                GROUP BY another.risk_code".$filtaradd;
		
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
	
	function getUserList_export($filter){
		 
		$filtaradd = "";
			
		$sql = "SELECT e.risk_status, a.username, a.display_name, b.division_id, b.division_name, c.tanggal_submit, c.note FROM m_user a JOIN m_division b ON a.division_id = b.division_id JOIN t_risk_add_informasi c ON a.username = c.risk_input_by LEFT JOIN ( SELECT MIN(risk_status) AS risk_status, risk_input_by, periode_id FROM t_risk_change WHERE risk_status > 1 AND existing_control_id IS NULL GROUP BY risk_input_by) e ON a.username = e.risk_input_by  WHERE '%' LIKE '%' AND c.periode_id = (SELECT periode_id FROM m_periode WHERE DATE(NOW()) BETWEEN periode_start AND periode_end)order by display_name asc


				".$filtaradd;
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
	
	function getTreatment_export($filter){
		
				$filtaradd = "";
			
				if(isset($filter['search'])){
					if($filter['search']!=""){
						$filtaradd = "and risk_event like '%".$filter['search']."%'";
					}
				}	
				 		
			$sql = "SELECT 
					a.*,
				
					b.division_name AS risk_owner_v,
					c.ref_value AS suggested_risk_treatment_v
					FROM t_risk a
					LEFT JOIN m_division b ON a.risk_owner = b.division_id
					LEFT JOIN m_reference c ON a.suggested_risk_treatment = c.ref_key AND c.ref_context = 'treatment.status'
					WHERE 
					a.periode_id
					AND a.risk_status =3 AND periode_id>=4			 ".$filtaradd;
		
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
	
	function getActionplan_export($filter){
		
				$filtaradd = "";
				
					if(isset($filter['search'])){
						if($filter['search']!=""){
							$filtaradd = "and action_plan like '%".$filter['search']."%'";
						}
					}	
		  
					$sql = "SELECT 
					a.*,
					CONCAT('AP.', LPAD(a.id, 6, '0')) AS act_code,
					b.risk_code,
					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					
					DATE_FORMAT(a.due_date, '%d-%m-%Y') AS due_date_v
					FROM 
					t_risk_action_plan a
					LEFT JOIN t_risk b ON a.risk_id = b.risk_id
					LEFT JOIN m_user c ON a.assigned_to = c.username
					LEFT JOIN m_division d ON a.division = d.division_id
					WHERE 
					a.action_plan_status =4 AND periode_id>=4
					".$filtaradd;
		
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
	
	function getExecution_export(){
		 
		$sql = "SELECT 
					a.*,
					CONCAT('AP.', LPAD(a.id, 6, '0')) AS act_code,
					b.risk_code,
					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					
					DATE_FORMAT(a.due_date, '%d-%m-%Y') AS due_date_v
					FROM 
					t_risk_action_plan a
					LEFT JOIN t_risk b ON a.risk_id = b.risk_id
					LEFT JOIN m_user c ON a.assigned_to = c.username
					LEFT JOIN m_division d ON a.division = d.division_id
					WHERE 
					a.action_plan_status >5 AND periode_id>=4
					
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
	
	function getKRI_export(){
		 
			$sql = "select 
					a.*,
					date_format(a.timing_pelaporan, '%d-%m-%Y') as timing_pelaporan_v,
					b.risk_code,
					c.division_name as kri_owner_v,
					d.display_name as kri_pic_v
					from t_kri a
					left join t_risk b on a.risk_id = b.risk_id
					left join m_division c on a.kri_owner = c.division_id
					left join m_user d on a.kri_pic = d.username
					where 
					a.kri_status >= 0";
		
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
	
	function getChangeReq_export(){
		 
			$sql = "select 
					a.*,
					b.risk_code,
					b.risk_event,
					c.display_name as created_by_v
					from 
					t_cr_risk a join t_risk b on a.risk_id = b.risk_id
					left join m_user c on a.created_by = c.username";
		
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
	
	function updateRisk_level($risk_id,$data){
		
		unset($data['id']);
		unset($data['owner_report']);
		unset($data['validation']);
		unset($data['support']);
		unset($data['description']);
		
		 
		$this->db->where("risk_id" , $risk_id);
		
		$this->db->update("t_risk",$data);
		 
	}


	function updateRisk_level_no($risk_id, $data){
		$sql = "update t_risk c
				set 
				c.risk_impact_level_after_kri = '".$data['risk_impact_level_after_mitigation']."',
				c.risk_likelihood_key_after_kri = '".$data['risk_likelihood_key_after_mitigation']."',
				c.risk_level_after_kri = '".$data['risk_level_after_mitigation']."'

				where c.risk_id = '".$risk_id."'";
		$query = $this->db->query($sql);
		return true;

	}
	
	function updateKRI_Risk_level($id,$risk_id,$data){
		
		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				c.risk_impact_level_after_mitigation = '".$data['risk_impact_level_after_mitigation']."',
				c.risk_likelihood_key_after_mitigation = '".$data['risk_likelihood_key_after_mitigation']."',
				c.risk_level_after_mitigation = '".$data['risk_level_after_mitigation']."'

				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.id = '$id' and a.action_plan_status > 5";
		$query = $this->db->query($sql);
		return true;
		 
	}

	function updateKRI_Risk_level_prior($id,$risk_id,$data){
		
		/*$this->db->set("risk_impact_level_after_mitigation",$data['risk_impact_level_after_mitigation']);
		$this->db->set("risk_likelihood_key_after_mitigation",$data['risk_likelihood_key_after_mitigation']);	
		$this->db->set("risk_level_after_mitigation",$data['risk_level_after_mitigation']);			
		 
		$this->db->where("risk_id" , $risk_id);
		
		$this->db->update("t_risk");*/

		$sql = "update t_risk_action_plan a, m_action_plan b, t_risk c
				set 
				c.risk_impact_level_after_mitigation = '".$data['risk_impact_level_after_mitigation']."',
				c.risk_likelihood_key_after_mitigation = '".$data['risk_likelihood_key_after_mitigation']."',
				c.risk_level_after_mitigation = '".$data['risk_level_after_mitigation']."'

				where a.action_plan = b.action_plan and a.division = b.division and a.risk_id = c.risk_id and c.periode_id = ((select max(periode_id) from m_periode)-1) and b.id = '$id' and a.action_plan_status > 5";
		$query = $this->db->query($sql);
		return true;
	}
	
	function kri_pic($div){
	
	$sql = "select username from m_user where division_id = '".$div."' and role_id = 4";
	
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

	function cek_changerequest($risk_id){
	
	$sql = "select risk_id from t_cr_risk where risk_id = '".$risk_id."' and cr_status = 0";
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

	function cek_changerequest_action($action_id){
	
	$sql = "SELECT b.existing_control_id FROM m_action_plan a, t_risk_action_plan b, t_risk c where a.action_plan = b.action_plan and a.division = b.division and b.risk_id = c.risk_id and c.periode_id = (select max(periode_id) from m_periode) and b.existing_control_id = '1' and a.id = '".$action_id."'";
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

	function getRiskUser($risk_id){
	$sql = "SELECT GROUP_CONCAT(t_risk.risk_input_by, ' | ', (SELECT GROUP_CONCAT(t_risk_add_user.username ) 
from t_risk_add_user where t_risk.risk_id = t_risk_add_user.risk_id AND t_risk.risk_input_by <> t_risk_add_user.username)) as 'nama'
FROM t_risk
WHERE t_risk.risk_id = '".$risk_id."' ";
	$query = $this->db->query($sql);
	$res = $query->row_array();
	return $res;
	}

	function cek_change($risk_id){
	$sql = "select risk_id from t_risk_change where risk_id = '".$risk_id."' ";
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

	function cekOwned($username,$division_nya){

			$sql = 		"select 
						a.*,
						b.ref_value as risk_status_v,
						c.ref_value as risk_level_v,
						d.ref_value as impact_level_v,
						e.l_title as likelihood_v,
						f.division_name as risk_owner_v,
						g.display_name as risk_treatment_owner_v,
						h.ref_value as suggested_risk_treatment_v
						from t_risk a
						left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
						left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
						left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
						left join m_likelihood e on a.risk_likelihood_key = e.l_key
						left join m_division f on a.risk_owner = f.division_id
						left join m_user g on a.risk_treatment_owner = g.username
						left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
						left join m_periode on m_periode.periode_id = a.periode_id
						where 
						 a.periode_id is not null and a.periode_id = (select max(periode_id) from m_periode)
						and a.risk_status = 4
						and a.risk_division = '".$division_nya."'
						UNION
						select 
						a.*,
						b.ref_value as risk_status_v,
						c.ref_value as risk_level_v,
						d.ref_value as impact_level_v,
						e.l_title as likelihood_v,
						f.division_name as risk_owner_v,
						g.display_name as risk_treatment_owner_v,
						h.ref_value as suggested_risk_treatment_v
						from t_risk a
						left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
						left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
						left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
						left join m_likelihood e on a.risk_likelihood_key = e.l_key
						left join m_division f on a.risk_owner = f.division_id
						left join m_user g on a.risk_treatment_owner = g.username
						left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
						left join m_periode on m_periode.periode_id = a.periode_id
						where 
						 a.periode_id is not null and a.periode_id = (select max(periode_id) from m_periode)
						and a.risk_status = 3
						and a.risk_division = '".$division_nya."' and a.risk_treatment_owner = '".$username."'" ;

						$query = $this->db->query($sql);     
	
	return $query->num_rows();
	} 

	function cekOwnedpic($username,$division_nya){

			$sql = 		"select 
						a.*,
						b.ref_value as risk_status_v,
						c.ref_value as risk_level_v,
						d.ref_value as impact_level_v,
						e.l_title as likelihood_v,
						f.division_name as risk_owner_v,
						g.display_name as risk_treatment_owner_v,
						h.ref_value as suggested_risk_treatment_v
						from t_risk a
						left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
						left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
						left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
						left join m_likelihood e on a.risk_likelihood_key = e.l_key
						left join m_division f on a.risk_owner = f.division_id
						left join m_user g on a.risk_treatment_owner = g.username
						left join m_reference h on a.suggested_risk_treatment = h.ref_key and h.ref_context = 'treatment.status'
						left join m_periode on m_periode.periode_id = a.periode_id
						where 
						 a.periode_id is not null and a.periode_id = (select max(periode_id) from m_periode)
						and a.risk_status = 3
						and a.risk_division = '".$division_nya."' and a.risk_treatment_owner = '".$username."'" ;

						$query = $this->db->query($sql);      
	
	return $query->num_rows();
	} 



	function cekPlan($username,$division_nya){
	$sql = "SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, f.division, a.assigned_to, g.jml_id,
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,

					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code, 

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT DATE_FORMAT(b.due_date, '%d-%m-%Y') SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v,
					h.action_plan AS haction_plan, h.due_date AS hdue_date, h.division AS hdivision, DATE_FORMAT(h.due_date, '%d-%m-%Y') AS hdue_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) AS periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					
					LEFT JOIN t_action_plan_change h ON f.id = h.id_ap
					WHERE 
					b.periode_id = (select max(periode_id) from m_periode) AND
					a.action_plan_status  = 1 AND a.division = '".$division_nya."' AND a.assigned_to = '".$username."' AND a.switch_flag = 'P'
					UNION
					SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, f.division, a.assigned_to, g.jml_id,
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,

					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code, 

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT DATE_FORMAT(b.due_date, '%d-%m-%Y') SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v,
					h.action_plan AS haction_plan, h.due_date AS hdue_date, h.division AS hdivision, DATE_FORMAT(h.due_date, '%d-%m-%Y') AS hdue_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) AS periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					
					LEFT JOIN t_action_plan_change h ON f.id = h.id_ap
					WHERE 
					b.periode_id = (select max(periode_id) from m_periode) AND
					a.action_plan_status  = 2 AND a.division = '".$division_nya."' AND a.switch_flag = 'P'
					";

	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekPlanpic($username,$division_nya){
	$sql = "SELECT DISTINCT f.id AS id_p, a.action_plan_status, a.action_plan, f.division, a.assigned_to, g.jml_id,
					CONCAT('AP.', LPAD(f.id, 6, '0')) AS act_code,

					(SELECT GROUP_CONCAT(c.risk_id SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_id,

					(SELECT GROUP_CONCAT(c.risk_code SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS risk_code, 

					c.display_name AS assigned_to_v,
					d.division_name AS division_name,
					(SELECT GROUP_CONCAT(DISTINCT DATE_FORMAT(b.due_date, '%d-%m-%Y') SEPARATOR ' | ') FROM t_risk c, t_risk_action_plan b, m_division e WHERE c.risk_id = b.risk_id AND e.division_id = b.division AND c.periode_id = (select max(periode_id) from m_periode) AND b.action_plan_status > 0 AND a.action_plan = b.action_plan AND a.division = b.division AND a.action_plan_status = b.action_plan_status) AS due_date_v,
					h.action_plan AS haction_plan, h.due_date AS hdue_date, h.division AS hdivision, DATE_FORMAT(h.due_date, '%d-%m-%Y') AS hdue_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) AS periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					
					LEFT JOIN t_action_plan_change h ON f.id = h.id_ap
					WHERE 
					b.periode_id = (select max(periode_id) from m_periode) AND
					a.action_plan_status  = 1 AND a.division = '".$division_nya."' AND a.assigned_to = '".$username."' AND a.switch_flag = 'P'";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekPlanRac(){
	$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status = 3 and b.switch_flag = 'P'";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekPlanExec($username,$division_nya){
	$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status = 4 and a.division = '".$division_nya."' and a.assigned_to = '".$username."' and a.switch_flag = 'P'
					UNION
					select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status = 5 and a.division = '".$division_nya."' and a.switch_flag = 'P'";
	
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekPlanExecpic($username,$division_nya){
	$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, a.execution_status, a.execution_explain, a.execution_evidence, a.execution_reason, a.revised_date, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 3 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id

					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status = 4 and a.division = '".$division_nya."' and a.assigned_to = '".$username."' and a.switch_flag = 'P'";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekPlanExecRac(){
	$sql = "select distinct f.id as id_p, a.action_plan_status, a.action_plan, f.division, g.jml_id,
					concat('AP.', LPAD(f.id, 6, '0')) as act_code,

					(select group_concat(c.risk_id separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_id,

					(select group_concat(c.risk_code separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as risk_code, 

					c.display_name as assigned_to_v,
					d.division_name as division_name,
					(select group_concat(distinct date_format(b.due_date, '%d-%m-%Y') separator ' | ') from t_risk c, t_risk_action_plan b, m_division e where c.risk_id = b.risk_id and e.division_id = b.division and c.periode_id = (select max(periode_id) from m_periode) and b.action_plan_status > 0 and a.action_plan = b.action_plan and a.division = b.division and a.action_plan_status = b.action_plan_status) as due_date_v
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
						JOIN (SELECT risk_code, MAX(periode_id) as periode_id FROM t_risk GROUP BY risk_code) d ON c.risk_code = d.risk_code AND c.periode_id = d.periode_id GROUP BY b.id) g ON f.id = g.id
					where 
					b.periode_id = (select max(periode_id) from m_periode) and
					a.action_plan_status = 6 and b.switch_flag = 'P'";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}
	
	function cekKri($username,$division_nya){
	$sql = "select id from t_kri where kri_owner = '".$division_nya."' and kri_pic = '".$username."'  and kri_status = 1
			union select id from t_kri where kri_owner = '".$division_nya."' and kri_status = 1 and mandatory = 'Y'
	";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekKripic($username,$division_nya){
	$sql = "select id from t_kri where kri_owner = '".$division_nya."' and kri_pic = '".$username."'  and kri_status = 0";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}

	function cekKriRac(){
	$sql = "select id from t_kri where kri_status = 2";
	//$sql = "select risk_id from t_risk where risk_input_by = '".$username."' and risk_status < 5";
	$query = $this->db->query($sql);
	return $query->num_rows();
	}
	
	function get_t_risk($risk_id){
		
		$this->db->where("risk_id",$risk_id);
		
		$query = $this->db->get('t_risk');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function get_t_risk_change($risk_id,$risk_input_by ){
		
		$this->db->where("risk_id",$risk_id);
		
		$this->db->where("risk_input_by",$risk_input_by);
		
		$query = $this->db->get('t_risk_change');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function update_t_risk_change($data,$risk_id,$risk_library,$risk_input_by=null){
		  
		$this->db->where('risk_id',$risk_id);
		if($risk_input_by!=null){
			$data[0]['risk_input_by'] = $risk_input_by;
			$this->db->where('risk_input_by',$risk_input_by);

			$data[0]['created_by'] = $risk_input_by;
			$this->db->where('created_by',$risk_input_by);

			$data[0]['risk_status'] = 2;
			$this->db->where('risk_status',2);
		}
		
		$query = $this->db->update('t_risk_change',$data[0]);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_change set risk_library_id = '$risk_library'
			  	where risk_id = ?  and risk_input_by = '$risk_input_by' ";
		$res = $this->db->query($sql, $par);

		return true;

	}

	function update_t_risk_own($data,$risk_id,$risk_library,$risk_input_by=null){
		  
		$this->db->where('risk_id',$risk_id);
		if($risk_input_by!=null){
			$data[0]['risk_input_by'] = $risk_input_by;
			$this->db->where('risk_input_by',$risk_input_by);
		}
		
		$query = $this->db->update('t_risk_own',$data[0]);

		$par['risk_id'] = $risk_id;
		$sql = "update t_risk_own set risk_library_id = '$risk_library'
			  	where risk_id = ?  and risk_input_by = '$risk_input_by' ";
		$res = $this->db->query($sql, $par);

		return true;

	}
	
	function get_t_risk_actionplan($id){
		
		$this->db->where("id",$id);
		
		$query = $this->db->get('t_risk_action_plan');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}

	function get_t_risk_actionplan_cr($id){
		
		$this->db->where("change_id",$id);
		
		$query = $this->db->get('t_action_plan_cr');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function get_t_cr_risk($id){
		
		$this->db->where("id",$id);
		
		$query = $this->db->get('t_cr_risk');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function get_t_cr_action_plan($id){
		
		$this->db->where("change_id",$id);
		
		$query = $this->db->get('t_cr_action_plan');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function get_t_cr_control($id){
		
		$this->db->where("change_id",$id);
		
		$query = $this->db->get('t_cr_control');
	 
			if ($query->num_rows())
			{
				return $query->result_array();
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function update_t_cr_control($data,$id){
		  
		$this->db->where('change_id',$id);
		 
		$query = $this->db->update('t_cr_control_change',$data[0]);
	  
	}
	
	function update_t_cr_action_plan($data,$id){
		  
		$this->db->where('change_id',$id);
		 
		$query = $this->db->update('t_cr_action_plan_change',$data[0]);
	  
	}
	
	function update_t_cr_risk($data,$id){
		  
		$this->db->where('id',$id);
		 
		$query = $this->db->update('t_cr_risk_change',$data[0]);
	  
	}
	
	function update_t_risk_actionplan_change($data,$id){
		  
		$this->db->where('id',$id);
		 
		$query = $this->db->update('t_risk_action_plan_change',$data[0]);
	  
	}

	function cek_ap_change($division){
		
		$this->db->where("division",$division);
		
		$query = $this->db->get('t_risk_action_plan_change');
	 
			if ($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return FALSE;
			}	
		
	}
	
	function submit_note($data){
		
		$this->db->where("periode_id",$data['periode']['periode_id']);
		$this->db->where("risk_input_by",$data['param']['risk_input_by']);
		$this->db->set("note",$data['param']['note']);
		$this->db->update("t_risk_add_informasi");
		
	}

	function cek_control_submit($username,$periode_id){
		$sql = "select * from t_risk_change a 
				where a.risk_input_by = '$username' and a.periode_id='$periode_id' 
				and a.risk_id not in (select risk_id from t_risk_control_change) and a.existing_control_id is null and a.existing_control_id <> 2";
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

	function cek_ap_submit($username,$periode_id){
		$sql = "select * from t_risk_change a 
				join t_risk_action_plan_change ap on a.risk_id = ap.risk_id
				where a.risk_input_by = '$username' and a.periode_id='$periode_id'
				and ap.due_date is null and a.existing_control_id is null";
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

	function cek_plan_duedate($risk_id){
		$sql = "select * from t_risk_action_plan_tmp 
				where risk_id = '$risk_id' and due_date = null ";
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

//oktober
	function cek_ap_recylebin($username,$periode_id){
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
					a.existing_control_id = 2 and a.risk_status <= 2 and a.risk_input_by = '$username'
					and a.risk_library_id is null

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
					from t_risk_change a
					left join m_reference b on a.risk_status = b.ref_key and b.ref_context = 'risk.status.user'
					left join m_reference c on a.risk_level = c.ref_key and c.ref_context = 'risklevel.display'
					left join m_reference d on a.risk_impact_level = d.ref_key and d.ref_context = 'impact.display'
					left join m_likelihood e on a.risk_likelihood_key = e.l_key
					left join m_division f on a.risk_owner = f.division_id
					left join m_periode on m_periode.periode_id = a.periode_id
					where 
					a.existing_control_id = 2 and a.risk_status <= 2 and a.risk_input_by = '$username'
					";
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

	function cek_from_library($risk_id){
		$sql = "select risk_library_id from t_risk 
				where risk_id = '$risk_id' and risk_library_id is not null ";
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

	function cek_from_add($risk_id, $uid){
		$sql = "select risk_id from t_risk 
				where risk_id = '$risk_id'";
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

	function cek_from_roll_forward($risk_id,$periode_id,$uid){
		$sql = "select * from t_risk_change 
				where risk_id = '$risk_id' and periode_id = '$periode_id' and risk_input_by <> '$uid' ";
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


	function cari_tanggal_submit($uid, $periode_id){
		$sql = "select tanggal_submit from t_risk_add_informasi 
				where risk_input_by = '$uid' and periode_id = '$periode_id' ";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		return $row;

	}

	function cekLibraryId($rid){

		$res = $this->getActionPlanById($rid);

			if ($res) {
				$resRisk = $this->getRiskById($res['risk_id']);
				return $resRisk;
			}

	}

	function cekLibraryBefore($rid){
				$resRisk = $this->getRiskById($rid);
				return $resRisk;
	}

	public function deleteRiskri($risk_id) {
		//$this->_logHistory($risk_id, $uid, $update_point);
		
		//$periode = $data['periode_id'];
		$sql = "delete from t_kri_risk where risk_id='$risk_id'";
		$res = $this->db->query($sql);
		
		return $res;
	}

	
}