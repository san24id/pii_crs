<?php
include '../connection_barchart.php';

$query = $pdo->query("SELECT * FROM 
(SELECT a.risk_owner, b.short_division, 
(SELECT COUNT(b.risk_status) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM `m_periode`) AND (b.risk_status = '0' OR b.risk_status = '1') AND b.existing_control_id IS NULL) AS 'Draft',
(SELECT COUNT(b.risk_status) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM `m_periode`) AND b.risk_status = '2' AND b.existing_control_id IS NULL) AS 'Submitted',
(SELECT COUNT(b.risk_status) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM `m_periode`) AND b.risk_status > '2' AND b.existing_control_id IS NULL) AS 'Verified'
FROM t_risk a JOIN m_division b ON b.`division_id` = a.risk_owner WHERE a.risk_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CFO')) AS another
GROUP BY another.risk_owner");

$category = array();
$category['name'] = 'Division';

$series1 = array();
$series1['name'] = 'Draft';

$series2 = array();
$series2['name'] = 'Submitted to RAC';

$series3 = array();
$series3['name'] = 'Verified by RAC';


while ($r=$query->fetch(PDO::FETCH_ASSOC)){
    $category['data'][] = $r['short_division'];
    $series1['data'][] = $r['Draft'];
    $series2['data'][] = $r['Submitted'];
    $series3['data'][] = $r['Verified'];   
}

$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);
array_push($result,$series3);


print json_encode($result, JSON_NUMERIC_CHECK);


?> 
