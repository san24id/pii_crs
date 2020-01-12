<?php
include '../connection_barchart.php';

$query = $pdo->query("SELECT * FROM 
(SELECT a.kri_owner, CASE WHEN b.short_division = '' THEN 'unassigned' WHEN b.short_division IS NULL THEN 'unassigned' ELSE b.short_division END AS short_division, 
(SELECT COUNT(b.id) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.kri_status > 0  AND b.kri_warning IS NULL) AS 'Not',
(SELECT COUNT(b.id) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.kri_status > 0 AND b.kri_warning = 'RED') AS 'Red',
(SELECT COUNT(b.id) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.kri_status > 0 AND b.kri_warning = 'YELLOW') AS 'Yellow',
(SELECT COUNT(b.id) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id =(SELECT MAX(periode_id) FROM m_periode) AND b.kri_status > 0 AND b.kri_warning = 'GREEN') AS 'Green'
FROM t_kri a LEFT JOIN m_division b ON b.`division_id` = a.`kri_owner` WHERE a.kri_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-COO')) AS another
GROUP BY another.kri_owner");

$category = array();
$category['name'] = 'KRI Owner';

$series1 = array();
$series1['name'] = 'Mitigation on Progress';

$series2 = array();
$series2['name'] = 'Red';

$series3 = array();
$series3['name'] = 'Yellow';

$series4 = array();
$series4['name'] = 'Green';


while ($r=$query->fetch(PDO::FETCH_ASSOC)){
    $category['data'][] = $r['short_division'];
    $series1['data'][] = $r['Not'];
    $series2['data'][] = $r['Red'];
    $series3['data'][] = $r['Yellow'];
    $series4['data'][] = $r['Green'];   
}

$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);
array_push($result,$series3);
array_push($result,$series4);



print json_encode($result, JSON_NUMERIC_CHECK);

?> 
