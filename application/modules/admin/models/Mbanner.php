<?php
class Mbanner extends APP_Model {
	public function getBanner()
	{
		$sql = "select * from m_banner limit 1";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$def = array(
			'banner_text' => '',
			'banner_status' => '0'
		);
		if ($row) return $row;
		else return $def;
	}
	
	public function updateBanner($banner_text, $banner_status)
	{
		$sql = "select count(1) numcount from m_banner";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		
		$par = array(
			'banner_text' => $banner_text,
			'banner_status' => $banner_status
		);
		
		if ($row['numcount'] > 0) {
			$sql = "update m_banner set banner_text = ?, banner_status = ?";
			$res = $this->db->query($sql, $par);
			return $res;
		} else {
			$sql = "insert into m_banner(banner_text, banner_status) values (?, ?)";
			$res = $this->db->query($sql, $par);
			return $res;
		}
	}
}