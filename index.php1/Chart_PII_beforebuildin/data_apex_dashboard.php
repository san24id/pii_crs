<?php
include 'connection_barchart.php';

$query = $pdo->query("SELECT * FROM 
(SELECT a.division, b.short_division,
(SELECT COUNT(b.action_plan) FROM t_risk_action_plan b, t_risk c WHERE b.division = a.division AND b.risk_id = c.risk_id AND b.`action_plan_status` > 3 AND c.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.execution_status IS NULL) AS 'Not',
(SELECT COUNT(b.action_plan) FROM t_risk_action_plan b, t_risk c WHERE b.division = a.division AND b.risk_id = c.risk_id AND b.`action_plan_status` > 3 AND c.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.execution_status = 'COMPLETE') AS 'Complete',
(SELECT COUNT(b.action_plan) FROM t_risk_action_plan b, t_risk c WHERE b.division = a.division AND b.risk_id = c.risk_id AND b.`action_plan_status` > 3 AND c.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.execution_status = 'ONGOING') AS 'Ongoing',
(SELECT COUNT(b.action_plan) FROM t_risk_action_plan b, t_risk c WHERE b.division = a.division AND b.risk_id = c.risk_id AND b.`action_plan_status` > 3 AND c.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.execution_status = 'EXTEND') AS 'Extend'
FROM t_risk_action_plan a JOIN m_division b ON b.division_id = a.`division` ) AS another
GROUP BY another.division");

$category = array();
$category['name'] = 'Division';

$series1 = array();
$series1['name'] = 'Not Have Execution';

$series2 = array();
$series2['name'] = 'Extend';

$series3 = array();
$series3['name'] = 'Ongoing';


$series4 = array();
$series4['name'] = 'Complete';

while ($r=$query->fetch(PDO::FETCH_ASSOC)){
    $category['data'][] = $r['short_division'];
    $series1['data'][] = $r['Not'];
    $series2['data'][] = $r['Complete'];
    $series3['data'][] = $r['Ongoing'];
    $series4['data'][] = $r['Extend'];   
}

$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);
array_push($result,$series3);
array_push($result,$series4);


print json_encode($result, JSON_NUMERIC_CHECK);

?> 
