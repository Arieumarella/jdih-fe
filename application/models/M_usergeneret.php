<?php

class M_usergeneret extends CI_Model {

	public function getDataDept()
	{
		$qry = "SELECT * FROM ppj_departemen WHERE parent_id <> 0 AND parent_id <> '10' AND dept_id <> '10' GROUP BY parent_id";

		return $this->db->query($qry)->result();
	}

	public function save($tabel, $data){
		return $this->db->insert($tabel, $data);
	}


}

?>