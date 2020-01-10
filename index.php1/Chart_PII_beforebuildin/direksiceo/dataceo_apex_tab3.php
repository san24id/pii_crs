<?php
include '../connection_barchart.php';

$query = $pdo->query("SELECT * FROM 
(SELECT a.division, b.short_division,
(SELECT COUNT(DISTINCT b.action_plan, b.due_date, b.division) FROM t_risk_action_plan b WHERE b.division = a.division AND b.risk_id IN (SELECT risk_id FROM t_risk WHERE  periode_id = (SELECT MAX(periode_id) FROM m_periode)) AND (b.action_plan_status = '4' OR b.action_plan_status = '5')) AS 'Draft',
(SELECT COUNT(DISTINCT b.action_plan, b.due_date, b.division) FROM t_risk_action_plan b WHERE b.division = a.division AND b.risk_id IN (SELECT risk_id FROM t_risk WHERE  periode_id = (SELECT MAX(periode_id) FROM m_periode)) AND b.action_plan_status = '6') AS 'Submitted',
(SELECT COUNT(DISTINCT b.action_plan, b.due_date, b.division) FROM t_risk_action_plan b WHERE b.division = a.division AND b.risk_id IN (SELECT risk_id FROM t_risk WHERE  periode_id = (SELECT MAX(periode_id) FROM m_periode)) AND b.action_plan_status = '7') AS 'Verified'
FROM t_risk_action_plan a JOIN m_division b ON a.`division` = b.`division_id` WHERE a.division IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO')) AS another
GROUP BY another.division");

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
