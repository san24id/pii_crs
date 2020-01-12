<?php defined('BASEPATH') OR exit('No direct script access allowed');

class APP_Model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getQueryCount($sql, $par = false) {
		$sql = "select count(1) as numcount from (".$sql.") mtable";
		if ($par) {
			$query = $this->db->query($sql, $par);
		} else {
			$query = $this->db->query($sql);
		}
		$row = $query->row_array();
		if ($row) {
			return $row['numcount'];
		} else return 0;
	}
	
	
	public function getPagingData($sql, $par, $page, $row, $tid = false, $genRowNum = false)
	{
		$offset = 0;
		if ($page <= 0) {
			$page = 1;
		}
		
		$count = $this->getQueryCount($sql, $par);
		if ($count > 0) {
			$maxPage = ceil($count/$row);
			if ($page > $maxPage) {
				$page = $maxPage;
			}
			
			if ($page == 1) $offset = 0;
			else {
				$o = ($page-1) * $row;
				$offset = $o;
			}
		}
		
		$tid_str = '';
		if ($tid) {
			$tid_str = ", ".$tid." as DT_RowId";
		}
		
		$limit = $row;
		$sql_p = "select mtable.* ".$tid_str."
			from (".$sql.") mtable
			limit ".$offset.", ".$row."
		";
		
		$query_p = $this->db->query($sql_p, $par);
		$resp = array();
		
		$resp['recordsTotal'] = $count * 1;
		$resp['recordsFiltered'] = $count * 1; //$query_p->num_rows();
		$resp['data'] = array();
		$rnStart = 1;
		if ($genRowNum) {
			$rnStart = $offset+1;
		}
		foreach ($query_p->result_array() as $qrow)
		{
			if ($genRowNum) $qrow['GenRowNum'] = $rnStart;
		    $resp['data'][] = $qrow;
		    $rnStart++;
		}
		
		return $resp;
	}
	
	public function getReference($context) {
		$sql = 'select  ref_key, ref_value
				from m_reference 
				where ref_context = ?';
		$query = $this->db->query($sql, array('c'=>$context));
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
}
