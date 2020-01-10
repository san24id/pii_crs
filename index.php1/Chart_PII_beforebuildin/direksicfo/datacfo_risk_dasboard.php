<?php

include '../connection_barchart.php';

$query = $pdo->query("SELECT * FROM (SELECT c.under_direksi, b.short_division,
(SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND risk_level = 'HIGH' AND risk_status > 2 AND existing_control_id IS NULL) AS 'HIGH',
(SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND risk_level = 'MODERATE'  AND risk_status > 2 AND existing_control_id IS NULL) AS 'MODERATE',
(SELECT COUNT(b.risk_level) FROM t_risk b WHERE b.risk_owner = a.risk_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND risk_level = 'LOW'  AND risk_status > 2 AND existing_control_id IS NULL) AS 'LOW'
FROM m_direksi c  LEFT JOIN t_risk a  ON a.risk_owner = c.under_direksi LEFT JOIN m_division b ON b.division_id = c.under_direksi WHERE c.division_id = 'D-CFO') AS another
GROUP BY another.under_direksi");

$category = array();
$category['name'] = 'Division';

$series1 = array();
$series1['name'] = 'High';

$series2 = array();
$series2['name'] = 'Moderate';

$series3 = array();
$series3['name'] = 'Low';


while ($r=$query->fetch(PDO::FETCH_ASSOC)){
    $category['data'][] = $r['short_division'];
    $series1['data'][] = $r['HIGH'];
    $series2['data'][] = $r['MODERATE'];
    $series3['data'][] = $r['LOW'];   
}

$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);
array_push($result,$series3);


print json_encode($result, JSON_NUMERIC_CHECK);


?> 
