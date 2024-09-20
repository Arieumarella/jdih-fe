<?php

class Mdl_statistik extends CI_Model
{

	function ambil_unor($value)
	{
		if ($value != null) {
			$this->db->select('ppj_departemen.dept_id,ppj_departemen.deptcode,ppj_peraturan.status');
		} else {
			$this->db->select('ppj_departemen.dept_id,ppj_departemen.deptcode');
		}
		$this->db->from('ppj_departemen');
		$this->db->join('ppj_peraturan', 'ppj_peraturan.dept_id = ppj_departemen.dept_id', 'left');
		$this->db->where('parent_id', '0');
		if ($value != null) {
			if ($value == '0') {
				$this->db->where('ppj_peraturan.status', '0');
			} else if ($value == '1') {
				$this->db->where('ppj_peraturan.status', '1');
			}
		}
		$this->db->group_by('ppj_departemen.dept_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function jumlah_peraturan_unor($data)
	{
		$array = [];
		if(!empty($array)){
			foreach ($data as $row) {
				// $this->db->select('ppj_departemen.dept_id, count(ppj_peraturan.dept_id) as total');
				$this->db->select('*');
				$this->db->from('ppj_peraturan');
				$this->db->join('ppj_departemen', 'ppj_peraturan.dept_id = ppj_departemen.dept_id');
				$this->db->where('parent_id', $row['dept_id']);
				$this->db->where('kondisi', '3');
				if (array_key_exists("status", $row)) {
					$this->db->where('status', $row['status']);
				}
				$total = $this->db->get()->num_rows();
				array_push($array, $total);
			};
		}
		
		// die();
		return $array;
	}

	function ambil_peraturan_kategori($opsi)
	{
		if($opsi == 1){
			$where = "where peraturan_category_id between 1 and 8";
		}  
		else if ($opsi == 2){
			$where = "where peraturan_category_id between 1 and 8";
		}
		else {
			$where = "where tipe='1'";
		}
		$query = $this->db->query("SELECT peraturan_category_id, percategorycode from ppj_peraturan_category $where");
		return $query->result_array();
	}

	function ambil_peraturan_per_kategori($kategori, $tahun_old, $tahun, $opsi)
	{
		if($opsi == 1){
			//$where = "and tanggal between '$tahun_old' and '$tahun' and kondisi='3'";
			$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND 
				 tanggal between ? and ? and kondisi='3'";
			$query = $this->db->query($sql,array($this->db->escape_str($kategori),$this->db->escape_str($tahun_old),$this->db->escape_str($tahun)));
			return $query->num_rows();
		} else if ($opsi == 0) {
			//$where = " and kondisi='3'";
			$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND kondisi='3'";
			$query = $this->db->query($sql,array($this->db->escape_str($kategori)));
			return $query->num_rows();
		}else{
			$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND kondisi='3'";
			$query = $this->db->query($sql,array($this->db->escape_str($kategori)));
			return $query->num_rows();
		}
		
		
	}

	function ambil_peraturan_by_status($kategori, $tahun_old, $tahun, $opsi, $status)
	{
		if($opsi == 2){
			if($status=="0"){
				$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND 
					tanggal between ? and ? and (status = ? OR status='') and kondisi='3'";
				//$where = "and tanggal between ? and ? and (status = ? OR status='') and kondisi='3'";
			}else{
				//$where = "and tanggal between '$tahun_old' and '$tahun' and status = '$status' and kondisi='3'";
				$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND 
					tanggal between ? and ? and status = ? and kondisi='3'";

			}
			$query = $this->db->query($sql,array($this->db->escape_str($kategori),$this->db->escape_str($tahun_old),$this->db->escape_str($tahun),$this->db->escape_str($status)));
		} else {
			//$where = " and kondisi='3'";
			$sql="SELECT * from ppj_peraturan where peraturan_category_id = ? AND kondisi='3'";
			$query = $this->db->query($sql,array($this->db->escape_str($kategori)));
		}
		
		
		return $query->num_rows();
	}

	function ambil_peraturan()
	{
		$this->db->where('tipe', '1');
		$query = $this->db->get('ppj_peraturan_category');
		return $query->result_array();
	}

	function jumlah_peraturan_kategori($kategori)
	{
		$this->db->select('*');
		$this->db->from('ppj_peraturan');
		$this->db->where('peraturan_category_id', $kategori);
		$this->db->where('kondisi', '3');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function ambil_unduhan($kategori)
	{
		$this->db->select('download_count');
		$this->db->from('ppj_peraturan');
		$this->db->where('peraturan_category_id', $kategori);
		$query = $this->db->get();
		return $query->result_array();
	}

	function ambil_viewer($kategori)
	{
		$this->db->select('view_count');
		$this->db->from('ppj_peraturan');
		$this->db->where('peraturan_category_id', $kategori);
		$query = $this->db->get();
		return $query->result_array();
	}
}
