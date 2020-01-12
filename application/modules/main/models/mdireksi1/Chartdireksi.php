
<?php
class Chartdireksi extends APP_Model {
    
    public function getchartrisk() 
  {
        $sql = "SELECT * FROM 
(SELECT a.risk_owner, (SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = '4' AND risk_level = 'HIGH') AS 'HIGH',
(SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = '4' AND risk_level = 'MODERATE') AS 'MODERATE',
(SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = '4' AND risk_level = 'LOW') AS 'LOW'
FROM t_risk a) AS another
GROUP BY another.risk_owner ";
 $query = $this->db->query($sql);
 return $query->rows();


    }
 
 public function getchartap() 
  {
        $sql = "select * from 
(select a.division, 
(select count(b.execution_status is null) from t_risk_action_plan b where b.division = a.division and b.risk_id in (select risk_id from t_risk where periode_id = '3' and risk_status > 2)) as 'Not',
(select count(b.execution_status) from t_risk_action_plan b where b.division = a.division and b.risk_id in (select risk_id from t_risk where periode_id = '3' and risk_status > 2) and b.execution_status = 'COMPLETE') as 'Complete',
(select count(b.execution_status) from t_risk_action_plan b where b.division = a.division and b.risk_id in (select risk_id from t_risk where periode_id = '3' and risk_status > 2) and b.execution_status = 'ONGOING') as 'Ongoing',
(select count(b.execution_status) from t_risk_action_plan b where b.division = a.division and b.risk_id in (select risk_id from t_risk where periode_id = '3' and risk_status > 2) and b.execution_status = 'EXTEND') as 'Extend'
from t_risk_action_plan a) as another
group by another.division ";
 $query = $this->db->query($sql);
 return $query->num_rows();


    }


}