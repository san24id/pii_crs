<?php
class Mcategory extends APP_Model {
	public function getDataById($id)
	{
		$sql = "select 
				a.*
				from m_risk_category a where a.cat_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		return $row;
	}
	
	public function getSequence($id)
	{
		$sql = "select 
				seq
				from t_cat_sequence where cat_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		$row = $query->row_array();
		
		if (!$row) {
			$sqls = "insert into t_cat_sequence values(?, 2)";
			$query2 = $this->db->query($sqls, array('divid' => $id));
			return '1';
		} 
		
		$sql = "update t_cat_sequence 
				set seq = seq+1
				where cat_id = ?";
		$query = $this->db->query($sql, array('divid' => $id));
		return $row['seq'];
	}
	
	public function getRiskCategory($parent = 0) {
		$res = array();
		$sql = 'select 
					cat_id as ref_key, 
					concat(cat_code, " - ", cat_name) as ref_value
				from m_risk_category a 
				where cat_parent = ?';
		$query = $this->db->query($sql, array('divid' => $parent));
		
		foreach($query->result_array() as $row) {
			$res[] = $row;
		}
		
		return $res;
	}
	
	public function insertData($pars) {
		$sql = "insert into m_risk_category(
					cat_code, cat_name, cat_desc, 
					cat_parent, created_by, created_date
				) values( ?, ?, ?, ?, ?, NOW() )";
		$res = $this->db->query($sql, $pars);
		return $res;
	}
	
	public function updateData($cat_id, $pars) {
		$sql = "update m_risk_category
				set
				cat_code = ?, cat_name = ?, cat_desc = ?, 
				created_by = ?, created_date = NOW()
				where cat_id = ?";
		$pars['cat_id'] = $cat_id;
		$res = $this->db->query($sql, $pars);
		return $res;
	}
	
	public function validateDelete($cat_id) {
		$sql = "select * from t_cat_sequence
				where cat_id in (
					select cat_id from m_risk_category where cat_id = ?
					UNION
					select cat_id from m_risk_category where cat_parent = ?
					UNION
					select cat_id from m_risk_category where cat_parent > 0 and cat_parent in (
						select cat_id from m_risk_category where cat_parent > 0 and cat_parent = ?
					)
				)";
		$pars['cat_id1'] = $cat_id;
		$pars['cat_id2'] = $cat_id;
		$pars['cat_id3'] = $cat_id;
		$res = $this->db->query($sql, $pars);
		$row = $res->row_array();
		if ($row) {
			return false;
		} else {
			return true;
		}
	}
	
	public function deleteData($cat_id) {
		if ($this->validateDelete($cat_id)) {
			$sql = "delete from m_risk_category
					where cat_id in (
						select cat_id from (select * from m_risk_category) a where cat_id = ?
						UNION
						select cat_id from (select * from m_risk_category) b where cat_parent = ?
						UNION
						select cat_id from (select * from m_risk_category) c where cat_parent > 0 and cat_parent in (
							select cat_id from (select * from m_risk_category) d where cat_parent > 0 and cat_parent = ?
						)
					)";
			$pars['cat_id1'] = $cat_id;
			$pars['cat_id2'] = $cat_id;
			$pars['cat_id3'] = $cat_id;
			$res = $this->db->query($sql, $pars);
			return $res;
		} else {
			return false;
		}
		
	}
	
}