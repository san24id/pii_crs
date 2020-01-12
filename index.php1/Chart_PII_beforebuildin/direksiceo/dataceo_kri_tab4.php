<?php
include '../connection_barchart.php';

$query = $pdo->query("SELECT * FROM 
(SELECT a.kri_owner, CASE WHEN b.short_division = '' THEN 'unassigned' WHEN b.short_division IS NULL THEN 'unassigned' ELSE b.short_division END AS short_division,
(SELECT COUNT(b.kri_status) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND (b.kri_status = '1' OR b.kri_status = '2')) AS 'Draft',
(SELECT COUNT(b.kri_status) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND  b.kri_status = '3') AS 'Submitted',
(SELECT COUNT(b.kri_status) FROM t_kri b WHERE b.kri_owner = a.kri_owner AND b.periode_id = (SELECT MAX(periode_id) FROM m_periode) AND b.kri_status = '4') AS 'Verified'
FROM t_kri a LEFT JOIN m_division b ON b.`division_id` = a.`kri_owner` WHERE a.kri_owner IN (SELECT under_direksi FROM m_direksi WHERE division_id = 'D-CEO')) AS another
GROUP BY another.kri_owner
");

$category = array();
$category['name'] = 'kri owner';

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
