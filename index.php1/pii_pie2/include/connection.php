<?php 
 
class Connection {
    public function __construct() {
        // melakukan koneksi ke database
        $this->db = new PDO('mysql:host=localhost;dbname=pii_crs','root','');
        // urutannya adalah host;namadatabase;username;password
    }
 
    public function getRisk() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, COUNT(risk_level) AS levelcount FROM t_risk WHERE risk_owner='csf' AND periode_id='4' GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function getRiskStatus() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_status, COUNT(risk_status) AS statuscount, CASE WHEN risk_status=0 THEN 'draft'  WHEN risk_status=2 THEN 'submited' ELSE 'verified' END AS statusrisk FROM t_risk WHERE risk_owner='bdc' AND periode_id='4' GROUP BY risk_status";
        $query = $this->db->query($sql);
        return $query;
    }
//---------------------------------------------------------
//tab AP Pie
    public function getAp() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "
SELECT division,
CASE WHEN a.execution_status IS NULL OR a.execution_status = '' THEN 'Not Have Execution'  
WHEN a.execution_status = 'COMPLETE' THEN 'Complete' 
WHEN a.execution_status = 'EXTEND' THEN 'Extend' 
WHEN a.execution_status = 'ONGOING' THEN 'Ongoing' 
END AS executionstatus,
COUNT(DISTINCT a.action_plan, a.due_date, a.division) AS count
FROM t_risk_action_plan a WHERE a.action_plan_status > 3 and a.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode))
GROUP BY executionstatus";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getApCfo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "
SELECT division,
CASE WHEN a.execution_status IS NULL OR a.execution_status = '' THEN 'Not Have Execution'  
WHEN a.execution_status = 'COMPLETE' THEN 'Complete' 
WHEN a.execution_status = 'EXTEND' THEN 'Extend' 
WHEN a.execution_status = 'ONGOING' THEN 'Ongoing' 
END AS executionstatus,
COUNT(DISTINCT a.action_plan, a.due_date, a.division) AS count
FROM t_risk_action_plan a WHERE a.action_plan_status > 3 and a.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM `m_periode`) AND division IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO'))
GROUP BY executionstatus";
        $query = $this->db->query($sql);
        return $query;
    }

        public function getApCeo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "
SELECT division,
CASE WHEN a.execution_status IS NULL OR a.execution_status = '' THEN 'Not Have Execution'  
WHEN a.execution_status = 'COMPLETE' THEN 'Complete' 
WHEN a.execution_status = 'EXTEND' THEN 'Extend' 
WHEN a.execution_status = 'ONGOING' THEN 'Ongoing' 
END AS executionstatus,
COUNT(DISTINCT a.action_plan, a.due_date, a.division) AS count
FROM t_risk_action_plan a WHERE a.action_plan_status > 3 and a.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode) AND division IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO'))
GROUP BY executionstatus";
        $query = $this->db->query($sql);
        return $query;
    }

        public function getApCoo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "
SELECT division,
CASE WHEN a.execution_status IS NULL OR a.execution_status = '' THEN 'Not Have Execution'  
WHEN a.execution_status = 'COMPLETE' THEN 'Complete' 
WHEN a.execution_status = 'EXTEND' THEN 'Extend' 
WHEN a.execution_status = 'ONGOING' THEN 'Ongoing' 
END AS executionstatus,
COUNT(DISTINCT a.action_plan, a.due_date, a.division) AS count
FROM t_risk_action_plan a WHERE a.action_plan_status > 3 and a.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM `m_periode`) AND division IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO'))
GROUP BY executionstatus";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getAprac_div() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "
SELECT division,
CASE WHEN a.execution_status IS NULL OR a.execution_status = '' THEN 'Not Have Execution'  
WHEN a.execution_status = 'COMPLETE' THEN 'Complete' 
WHEN a.execution_status = 'EXTEND' THEN 'Extend' 
WHEN a.execution_status = 'ONGOING' THEN 'Ongoing' 
END AS executionstatus,
COUNT(DISTINCT a.action_plan, a.due_date, a.division) AS count
FROM t_risk_action_plan a WHERE a.action_plan_status > 3 and a.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode)) and division = '".$_GET['div']."'
GROUP BY executionstatus";
        $query = $this->db->query($sql);
        return $query;
    }

//------------------------------------------------------------------------
public function getAp_div() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT * FROM
(SELECT a.division, a.execution_status,
(SELECT COUNT(b.execution_status) FROM t_risk_action_plan b WHERE b.division = a.division AND b.risk_id IN (SELECT risk_id FROM t_risk WHERE periode_id IN (SELECT MAX(periode_id) FROM `m_periode`) AND risk_status > 2) AND b.execution_status = a.execution_status) AS 'count'
FROM t_risk_action_plan a WHERE  a.execution_status IS NOT NULL AND a.execution_status <> '') AS another
GROUP BY another.execution_status";
        $query = $this->db->query($sql);
        return $query;
    }

// menampilkan tab kri pie

  public function getKRI() {
        $sql = "SELECT kri_owner,
CASE WHEN kri_warning IS NULL OR kri_warning = '' THEN 'Mitigation on Progress'  
WHEN kri_warning = 'GREEN' THEN 'Green' 
WHEN kri_warning = 'YELLOW' THEN 'Yellow'
WHEN kri_warning = 'RED' THEN 'Red'
END AS statuskri, 
COUNT(id) AS kricount 
FROM t_kri 
WHERE t_kri.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND t_kri.kri_status > 0 
GROUP BY statuskri";
        $query = $this->db->query($sql);
        return $query;
    }

public function getKRIcfo() {
        $sql = "SELECT kri_owner,
CASE WHEN kri_warning IS NULL OR kri_warning = '' THEN 'Mitigation on Progress'  
WHEN kri_warning = 'GREEN' THEN 'Green' 
WHEN kri_warning = 'YELLOW' THEN 'Yellow'
WHEN kri_warning = 'RED' THEN 'Red'
END AS statuskri, 
COUNT(id) AS kricount 
FROM t_kri 
WHERE t_kri.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND t_kri.kri_status > 0 AND t_kri.kri_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO')
GROUP BY statuskri";
        $query = $this->db->query($sql);
        return $query;
    }

public function getKRIcoo() {
        $sql = "SELECT kri_owner,
CASE WHEN kri_warning IS NULL OR kri_warning = '' THEN 'Mitigation on Progress'  
WHEN kri_warning = 'GREEN' THEN 'Green' 
WHEN kri_warning = 'YELLOW' THEN 'Yellow'
WHEN kri_warning = 'RED' THEN 'Red'
END AS statuskri, 
COUNT(id) AS kricount 
FROM t_kri 
WHERE t_kri.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND t_kri.kri_status > 0 AND t_kri.kri_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO')
GROUP BY statuskri";
        $query = $this->db->query($sql);
        return $query;
    }


 public function getKRIceo() {
        $sql = "SELECT kri_owner,
CASE WHEN kri_warning IS NULL OR kri_warning = '' THEN 'Mitigation on Progress'  
WHEN kri_warning = 'GREEN' THEN 'Green' 
WHEN kri_warning = 'YELLOW' THEN 'Yellow'
WHEN kri_warning = 'RED' THEN 'Red'
END AS statuskri, 
COUNT(id) AS kricount 
FROM t_kri 
WHERE t_kri.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND t_kri.kri_status > 0 AND t_kri.kri_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO')
GROUP BY statuskri";
        $query = $this->db->query($sql);
        return $query;
    }

 public function getKRI_div() {
        $sql = "SELECT kri_owner,
CASE WHEN kri_warning IS NULL OR kri_warning = '' THEN 'Mitigation on Progress'  
WHEN kri_warning = 'GREEN' THEN 'Green' 
WHEN kri_warning = 'YELLOW' THEN 'Yellow'
WHEN kri_warning = 'RED' THEN 'Red'
END AS statuskri, 
COUNT(id) AS kricount 
FROM t_kri 
WHERE t_kri.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND t_kri.kri_status > 0 AND t_kri.kri_owner = '".$_GET['div']."'
GROUP BY statuskri";
        $query = $this->db->query($sql);
        return $query;
    }
//--------------------------------------------------------------------------
public function getRiskRAC() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, 
CASE 
WHEN risk_level= 'HIGH'  THEN 'High'  
WHEN risk_level= 'LOW'  THEN 'Low'  
WHEN risk_level= 'MODERATE'  THEN 'Moderate'  
END AS risklevel, 
COUNT(risk_level) AS levelcount 
FROM t_risk 
WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode) AND  existing_control_id IS NULL 
GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getRiskcfo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, 
CASE 
WHEN risk_level= 'HIGH'  THEN 'High'  
WHEN risk_level= 'LOW'  THEN 'Low'  
WHEN risk_level= 'MODERATE'  THEN 'Moderate'  
END AS risklevel, 
COUNT(risk_level) AS levelcount 
FROM t_risk 
WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode) AND  existing_control_id IS NULL AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO')
GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getRiskcoo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, 
CASE 
WHEN risk_level= 'HIGH'  THEN 'High'  
WHEN risk_level= 'LOW'  THEN 'Low'  
WHEN risk_level= 'MODERATE'  THEN 'Moderate'  
END AS risklevel, 
COUNT(risk_level) AS levelcount 
FROM t_risk 
WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode) AND  existing_control_id IS NULL AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO')
GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getRiskceo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, 
CASE 
WHEN risk_level= 'HIGH'  THEN 'High'  
WHEN risk_level= 'LOW'  THEN 'Low'  
WHEN risk_level= 'MODERATE'  THEN 'Moderate'  
END AS risklevel, 
COUNT(risk_level) AS levelcount 
FROM t_risk 
WHERE periode_id IN (SELECT MAX(periode_id) FROM m_periode) AND  existing_control_id IS NULL AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO')
GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
    }
	
public function getRiskRAC_div() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT risk_owner,risk_level, COUNT(risk_level) AS levelcount FROM t_risk WHERE periode_id IN (SELECT MAX(periode_id) from m_periode) and  existing_control_id is null and risk_owner = '".$_GET['div']."' GROUP BY risk_level";
        $query = $this->db->query($sql);
        return $query;
}

//------------------------------------------------------------------
//donut
     public function getRiskStatusRAC() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT COUNT(risk_status) AS statuscount, 
CASE WHEN risk_status = 0 OR risk_status = 1 or risk_status is null THEN 'Draft'  
WHEN risk_status = 2 THEN 'Submitted' 
WHEN risk_status > 2 THEN 'Verified'
END AS statusrisk 
FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) from m_periode) AND existing_control_id is null
GROUP BY statusrisk";
        $query = $this->db->query($sql);
        return $query;
    }
 public function getRiskStatusCfo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT COUNT(risk_status) AS statuscount, 
CASE WHEN risk_status = 0 OR risk_status = 1  or risk_status is null THEN 'Draft'  
WHEN risk_status = 2 THEN 'Submitted' 
WHEN risk_status > 2 THEN 'Verified'
END AS statusrisk 
FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode) AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO') AND existing_control_id IS NULL
GROUP BY statusrisk";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRiskStatusCoo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT COUNT(risk_status) AS statuscount, 
CASE WHEN risk_status = 0 OR risk_status = 1 or risk_status is null THEN 'Draft'  
WHEN risk_status = 2 THEN 'Submitted' 
WHEN risk_status > 2 THEN 'Verified'
END AS statusrisk 
FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode) AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO') AND existing_control_id IS NULL
GROUP BY statusrisk";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getRiskStatusCeo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT COUNT(risk_status) AS statuscount, 
CASE WHEN risk_status = 0 OR risk_status = 1 or risk_status is null THEN 'Draft'  
WHEN risk_status = 2 THEN 'Submitted' 
WHEN risk_status > 2 THEN 'Verified'
END AS statusrisk 
FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) FROM m_periode)  AND risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO') AND existing_control_id IS NULL
GROUP BY statusrisk";
        $query = $this->db->query($sql);
        return $query;
    }

public function getRiskStatusRAC_div() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT COUNT(risk_status) AS statuscount, 
CASE WHEN risk_status = 0 OR risk_status = 1 or risk_status is null THEN 'Draft'  
WHEN risk_status = 2 THEN 'Submitted' 
WHEN risk_status > 2 THEN 'Verified'
END AS statusrisk 
FROM t_risk WHERE periode_id = (SELECT MAX(periode_id) from m_periode) AND existing_control_id is null AND risk_owner = '".$_GET['div']."' GROUP BY risk_status";
        $query = $this->db->query($sql);
        return $query;
    }

//------------------------------------------------------------------------------
    public function getapRAC() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "select * from
(select a.division, a.execution_status,
(select count(b.execution_status) from t_risk_action_plan b where b.division = a.division and b.risk_id in (select risk_id from t_risk where periode_id = '4' and risk_status > 2) and b.execution_status = a.execution_status) as 'count'
from t_risk_action_plan a WHERE a.division = 'COO Office' and a.execution_status is not null and a.execution_status <> '') as another
group by another.execution_status";
        $query = $this->db->query($sql);
        return $query;
    }

  public function getKRIRAC() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT kri_owner , kri_warning, COUNT(kri_warning) AS kricount FROM t_kri WHERE periode_id='4'";
        $query = $this->db->query($sql);
        return $query;
    }
public function getMyCfo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  t_risk.risk_owner,COUNT(t_risk.risk_status) AS numberrisk, m_division.short_division FROM t_risk JOIN m_division ON m_division.`division_id` = t_risk.`risk_owner` WHERE risk_status > 2 AND periode_id=(SELECT MAX(periode_id) FROM m_periode) AND t_risk.risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO') AND existing_control_id IS NULL GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }

public function getMyceo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  t_risk.risk_owner,COUNT(t_risk.risk_status) AS numberrisk, m_division.short_division FROM t_risk JOIN m_division ON m_division.`division_id` = t_risk.`risk_owner` WHERE risk_status > 2 AND periode_id=(SELECT MAX(periode_id) FROM m_periode) AND t_risk.risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO') AND existing_control_id IS NULL GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }

public function getMycoo() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  t_risk.risk_owner,COUNT(t_risk.risk_status) AS numberrisk, m_division.short_division FROM t_risk JOIN m_division ON m_division.`division_id` = t_risk.`risk_owner` WHERE risk_status > 2 AND periode_id=(SELECT MAX(periode_id) FROM m_periode) AND t_risk.risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO') AND existing_control_id IS NULL GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }

public function getRACDash() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  risk_owner,COUNT(risk_status) AS numberrisk FROM t_risk WHERE risk_status='3' AND periode_id='4' GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }
public function getCFRACDash() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  t_risk.risk_owner,COUNT(t_risk.risk_status) AS numberrisk, m_division.short_division FROM t_risk JOIN m_division ON m_division.`division_id` = t_risk.`risk_owner` WHERE risk_status > 2 AND periode_id=(SELECT MAX(periode_id) FROM m_periode) AND existing_control_id IS NULL GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }

public function getCEODash() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  risk_owner,COUNT(risk_status) AS numberrisk FROM t_risk WHERE risk_status='3' AND periode_id='4' GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }
public function getAllriskCF() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  risk_owner,COUNT(risk_status) AS numberrisk FROM t_risk WHERE risk_status='3' AND periode_id='4' GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }
public function getcoba() {
        // menampilkan seluruh data pada tabel hasilvoting
        $sql = "SELECT  risk_owner,COUNT(risk_status) AS numberrisk FROM t_risk WHERE risk_status='3' AND periode_id='4' GROUP BY risk_owner";
        $query = $this->db->query($sql);
        return $query;
    }

//tutup 
}
 

?>