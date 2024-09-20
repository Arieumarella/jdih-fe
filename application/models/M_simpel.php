<?php

class M_simpel extends CI_Model {


	public function getDataCapaian($idPeraturan,$idMasa)
	{

		$idPeraturan = $this->db->escape_str($idPeraturan);
		$idMasa = $this->db->escape_str($idMasa);

		$qry = "SELECT path, b.nama FROM (SELECT * FROM t_target_peraturan_melekat_pada_peraturan WHERE id_peraturan='$idPeraturan') AS a
		LEFT JOIN (SELECT * FROM t_target_capaian) AS b ON a.id_target_capaian=b.id
		LEFT JOIN (SELECT * FROM t_masa_bulan) AS c ON b.id_masa=c.id
		WHERE c.id='$idMasa'";

		return $this->db->query($qry)->result();

	}


}

?>