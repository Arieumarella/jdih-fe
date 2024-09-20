<?php
defined("BASEPATH") or exit("No direct script access allowed");
date_default_timezone_set('Asia/Jakarta');

class Pencarian extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'html', 'form'));
		$this->load->library('session');
		$this->load->model('Mdl_fungsi');
		$this->load->model('Mdl_home');
	}


	function pencarian_cepat()
	{
		$judul = '';
		$tipe_dokumen = '';
		$peraturan_category_id = '';
		$noperaturan = '';
		$tahun = '';
		$tag_id = '';
		$status = '';
		$dept_id = '';
		$tcari = '';

		if (!empty($_REQUEST['judul'])) {
			$judul = htmlspecialchars($_REQUEST['judul']);
		} else {
			$judul = $this->security->xss_clean(htmlspecialchars($this->input->post("judul")));
		}

		if (!empty($_REQUEST['tipe_dokumen'])) {
			$tipe_dokumen = htmlspecialchars($_REQUEST['tipe_dokumen']);
		} else {
			$tipe_dokumen = $this->security->xss_clean(htmlspecialchars($this->input->post("tipe_dokumen")));
		}

		if (!empty($_REQUEST['peraturan_category_id'])) {
			$peraturan_category_id = htmlspecialchars($_REQUEST['peraturan_category_id']);
		} else {
			$peraturan_category_id = $this->security->xss_clean(htmlspecialchars($this->input->post("peraturan_category_id")));
		}


		if (!empty($_REQUEST['noperaturan'])) {
			$noperaturan = htmlspecialchars($_REQUEST['noperaturan']);
		} else {
			$noperaturan = $this->security->xss_clean(htmlspecialchars($this->input->post("noperaturan")));
		}

		if (!empty($_REQUEST['tahun'])) {
			$tahun = htmlspecialchars($_REQUEST['tahun']);
		} else {
			$tahun = $this->security->xss_clean(htmlspecialchars($this->input->post("tahun")));
		}

		if (!empty($_REQUEST['tag_id'])) {
			$tag_id = htmlspecialchars($_REQUEST['tag_id']);
		} else {
			$tag_id = $this->security->xss_clean(htmlspecialchars($this->input->post("tag_id")));
		}


		if (!empty($_REQUEST['status'])) {
			$status = htmlspecialchars($_REQUEST['status']);
		} else {
			$status = $this->security->xss_clean(htmlspecialchars($this->input->post("status")));
		}

		if (!empty($_REQUEST['dept_id'])) {
			$dept_id = htmlspecialchars($_REQUEST['dept_id']);
		} else {
			$dept_id = $this->security->xss_clean(htmlspecialchars($this->input->post("dept_id")));
		}

		if (!empty($_REQUEST['tcari'])) {
			$tcari = htmlspecialchars($_REQUEST['tcari']);
		} else {
			$tcari = $this->security->xss_clean(htmlspecialchars($this->input->post("tcari")));
		}

		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");


		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));
		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));
		$noperaturan = str_replace($entities, $replacements, urlencode($noperaturan));
		$tahun = str_replace($entities, $replacements, urlencode($tahun));
		$judul = str_replace($entities, $replacements, urlencode($judul));
		$status = str_replace($entities, $replacements, urlencode($status));
		$tag_id = str_replace($entities, $replacements, urlencode($tag_id));
		$tcari = str_replace($entities, $replacements, urlencode($tcari));

		if (preg_match($pattern, $tipe_dokumen, $match)) {
			$tipe_dokumen = '%%';
		}
		if (preg_match($pattern, $peraturan_category_id, $match)) {
			$peraturan_category_id = '%%';
		}
		if (preg_match($pattern, $tahun, $match)) {
			$tahun = '%%';
		}
		if (preg_match($pattern, $judul, $match)) {
			$judul = '%%';
		}
		if (preg_match($pattern, $tag_id, $match)) {
			$tag_id = '%%';
		}
		if (preg_match($pattern, $status, $match)) {
			$status = '%%';
		}
		if (preg_match($pattern, $tcari, $match)) {
			$tcari = '%%';
		}

		$data['tipe_dokumen'] = $tipe_dokumen;
		$data['peraturan_category_id'] = $peraturan_category_id;
		$data['noperaturan'] = $noperaturan;
		$data['tahun'] = $tahun;
		$data['judul'] = $judul;
		$data['status'] = $status;
		$data['tag_id'] = $tag_id;
		$data['tcari'] = $tcari;
		$data['dataaktif'] = "produk_hukum";
		$data['tipe_cari'] = 'cepat';
		$data['user_online'] = $this->Mdl_fungsi->simpan_session('2');
		$this->load->view("pencarian_cepat", $data);
	}

	function pencarian_cepat_error()
	{

		$tipe_dokumen = "";
		$peraturan_category_id = "";
		$noperaturan = "";
		$tahun = "";
		$judul = "";
		$tag_id = "";
		$status = "";
		$tcari = "";
		$dept_id = "";
		$data['tcari'] = $tcari;
		$status = "dept_id";
		$data['dept_id'] = $dept_id;

		$data['tipe_dokumen'] = $tipe_dokumen;
		$data['peraturan_category_id'] = $peraturan_category_id;
		$data['noperaturan'] = $noperaturan;
		$data['tahun'] = $tahun;
		$data['judul'] = $judul;
		$data['status'] = $status;
		$data['tag_id'] = $tag_id;
		$data['tcari'] = $tcari;
		$data['dataaktif'] = "produk_hukum";
		$data['tipe_cari'] = 'cepat';
		$data['user_online'] = $this->Mdl_fungsi->simpan_session('2');
		$this->load->view("pencarian_cepat_error", $data);
	}

	function pencarian_detail()
	{
		$judul = '';
		$tipe_dokumen = '';
		$peraturan_category_id = '';
		$noperaturan = '';
		$tahun = '';
		$tag_id = '';
		$status = '';
		$dept_id = '';
		$tcari = '';

		if (!empty($_REQUEST['judul'])) {
			$judul = htmlspecialchars($_REQUEST['judul']);
		} else {
			$judul = $this->security->xss_clean(htmlspecialchars($this->input->post("judul")));
		}

		if (!empty($_REQUEST['tipe_dokumen'])) {
			$tipe_dokumen = htmlspecialchars($_REQUEST['tipe_dokumen']);
		} else {
			$tipe_dokumen = $this->security->xss_clean(htmlspecialchars($this->input->post("tipe_dokumen")));
		}

		if (!empty($_REQUEST['peraturan_category_id'])) {
			$peraturan_category_id = htmlspecialchars($_REQUEST['peraturan_category_id']);
		} else {
			$peraturan_category_id = $this->security->xss_clean(htmlspecialchars($this->input->post("peraturan_category_id")));
		}


		if (!empty($_REQUEST['noperaturan'])) {
			$noperaturan = htmlspecialchars($_REQUEST['noperaturan']);
		} else {
			$noperaturan = $this->security->xss_clean(htmlspecialchars($this->input->post("noperaturan")));
		}

		if (!empty($_REQUEST['tahun'])) {
			$tahun = htmlspecialchars($_REQUEST['tahun']);
		} else {
			$tahun = $this->security->xss_clean(htmlspecialchars($this->input->post("tahun")));
		}

		if (!empty($_REQUEST['tag_id'])) {
			$tag_id = htmlspecialchars($_REQUEST['tag_id']);
		} else {
			$tag_id = $this->security->xss_clean(htmlspecialchars($this->input->post("tag_id")));
		}


		if (!empty($_REQUEST['status'])) {
			$status = htmlspecialchars($_REQUEST['status']);
		} else {
			$status = $this->security->xss_clean(htmlspecialchars($this->input->post("status")));
		}

		if (!empty($_REQUEST['dept_id'])) {
			$dept_id = htmlspecialchars($_REQUEST['dept_id']);
		} else {
			$dept_id = $this->security->xss_clean(htmlspecialchars($this->input->post("dept_id")));
		}

		if (!empty($_REQUEST['tcari'])) {
			$tcari = htmlspecialchars($_REQUEST['tcari']);
		} else {
			$tcari = $this->security->xss_clean(htmlspecialchars($this->input->post("tcari")));
		}

		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");


		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));
		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));
		$noperaturan = str_replace($entities, $replacements, urlencode($noperaturan));
		$tahun = str_replace($entities, $replacements, urlencode($tahun));
		$judul = str_replace($entities, $replacements, urlencode($judul));
		$status = str_replace($entities, $replacements, urlencode($status));
		$tag_id = str_replace($entities, $replacements, urlencode($tag_id));
		$tcari = str_replace($entities, $replacements, urlencode($tcari));

		if (preg_match($pattern, $tipe_dokumen, $match)) {
			$tipe_dokumen = '%%';
		}
		if (preg_match($pattern, $peraturan_category_id, $match)) {
			$peraturan_category_id = '%%';
		}
		if (preg_match($pattern, $tahun, $match)) {
			$tahun = '%%';
		}
		if (preg_match($pattern, $judul, $match)) {
			$judul = '%%';
		}
		if (preg_match($pattern, $tag_id, $match)) {
			$tag_id = '%%';
		}
		if (preg_match($pattern, $status, $match)) {
			$status = '%%';
		}
		if (preg_match($pattern, $tcari, $match)) {
			$tcari = '%%';
		}

		$data['tcari'] = $tcari;
		$data['dept_id'] = $dept_id;
		$data['tipe_dokumen'] = $tipe_dokumen;
		$data['peraturan_category_id'] = $peraturan_category_id;
		$data['noperaturan'] = $noperaturan;
		$data['tahun'] = $tahun;
		$data['judul'] = $judul;
		$data['tag_id'] = $tag_id;
		$data['status'] = $status;
		$data['tcari'] = $tcari;
		$data['tipe_cari'] = 'detail';
		$data['dataaktif'] = "produk_hukum";

		$data['user_online'] = $this->Mdl_fungsi->simpan_session('3');
		$this->load->view("pencarian_detail", $data);
	}

	function pencarian_detail_error()
	{

		$tipe_dokumen = "";
		$peraturan_category_id = "";
		$noperaturan = "";
		$tahun = "";
		$judul = "";
		$tag_id = "";
		$status = "";
		$dept_id = "";
		$tcari = "";
		$data['dept_id'] = $dept_id;
		$data['tipe_dokumen'] = $tipe_dokumen;
		$data['peraturan_category_id'] = $peraturan_category_id;
		$data['noperaturan'] = $noperaturan;
		$data['tahun'] = $tahun;
		$data['judul'] = $judul;
		$data['tag_id'] = $tag_id;
		$data['status'] = $status;
		$data['tcari'] = $tcari;
		$data['tipe_cari'] = 'detail';
		$data['dataaktif'] = "produk_hukum";

		$data['user_online'] = $this->Mdl_fungsi->simpan_session('3');
		$this->load->view("pencarian_detail_error", $data);
	}

	function pencarian_jenis_produk($tipe_dokumen, $peraturan_category_id)
	{

		$tipe_dokumen = $this->security->xss_clean(htmlspecialchars($tipe_dokumen));
		$peraturan_category_id = $this->security->xss_clean(htmlspecialchars($peraturan_category_id));

		if ($tipe_dokumen == "") {
			$tipe_dokumen = "";
		}
		if ($peraturan_category_id == "") {
			$peraturan_category_id = "";
		}

		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));

		$dept_id = '';

		if (preg_match($pattern, $tipe_dokumen, $match)) {
			$dept_id = '%%';
		}
		if (preg_match($pattern, $peraturan_category_id, $match)) {
			$dept_id = '%%';
		}

		$data['dept_id'] = $dept_id;
		$data['tipe_dokumen'] = $tipe_dokumen;
		$data['peraturan_category_id'] = $peraturan_category_id;
		$data['noperaturan'] = '';
		$data['tahun'] = '';
		$data['judul'] = '';
		$data['tag_id'] = '';
		$data['status'] = '';
		$data['dataaktif'] = "produk_hukum";
		$data['tcari'] = '';
		$data['tipe_cari'] = 'detail';

		$data['user_online'] = $this->Mdl_fungsi->simpan_session('4');
		$this->load->view("pencarian_detail", $data);
	}

	function pencarian_unor($dept_id)
	{

		if ($dept_id == "") {
			$dept_id = "";
		}

		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';


		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$dept_id = str_replace($entities, $replacements, urlencode($dept_id));


		if (preg_match($pattern, $dept_id, $match)) {
			$dept_id = '%%';
		}


		$data['dept_id'] = $dept_id;
		$data['tipe_dokumen'] = '';
		$data['peraturan_category_id'] = '';
		$data['noperaturan'] = '';
		$data['tahun'] = '';
		$data['judul'] = '';
		$data['tag_id'] = '';
		$data['status'] = '';
		$data['tcari'] = '';
		$data['tipe_cari'] = 'detail';
		$data['dataaktif'] = "produk_hukum";

		$data['user_online'] = $this->Mdl_fungsi->simpan_session('5');
		$this->load->view("pencarian_detail", $data);
	}

	function pencarian_substansi($tags_id)
	{

		if ($tags_id == "") {
			$tags_id = "";
		}
		$data['tags_id'] = $tags_id;
		$data['dept_id'] = '';
		$data['tipe_dokumen'] = '';
		$data['peraturan_category_id'] = '';
		$data['noperaturan'] = '';
		$data['tahun'] = '';
		$data['judul'] = '';
		$data['tag_id'] = '';
		$data['status'] = '';
		$data['tcari'] = '';
		$data['dataaktif'] = "produk_hukum";
		$data['tipe_cari'] = 'detail';

		$data['user_online'] = $this->Mdl_fungsi->simpan_session('7');
		$this->load->view("pencarian_tags", $data);
	}


	function create_json()
	{
		header("Access-Control-Allow-Origin: *");
		if (!empty($_REQUEST['tcari'])) {
			$tcari = htmlspecialchars($tcari = $_REQUEST['tcari']);
		} else {
			$tcari = '';
		}
		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		$tcari = str_replace($entities, $replacements, urlencode($tcari));
		$tcari = str_replace("+", " ", $tcari);
		if (preg_match($pattern, $tcari, $match)) {
			echo "error";
		} else {


			$limit = 10;
			$start = 0;


			$start = intval(htmlspecialchars($this->input->post('start')));
			$limit = intval(htmlspecialchars($this->input->post('length')));
			if ($limit == "") {
				$start = 0;
				$limit = 10;
			}
			$totalData = $this->Mdl_fungsi->cari_cepat_count_result($tcari);
			$totalFiltered = $this->Mdl_fungsi->cari_cepat_count_result($tcari);
			$posts = $this->Mdl_fungsi->cari_cepat_limit($limit, $start, $tcari);

			$data = array();
			if (!empty($posts)) {
				$i = 0;
				foreach ($posts->result_array() as $post) {
					$nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
					$peraturan_id = $post['peraturan_id'];
					$judul3 = str_ireplace("<p>", "", $post['judul']);
					$judul4 = str_ireplace("</p>", "", $judul3);
					$judul2 = str_ireplace("\r", "", $judul4);
					$judul = str_ireplace("\n", "", $judul2);
					$bln = substr($post['tanggal'], 4, 2);
					$tahun = substr($post['tanggal'], 0, 4);
					$bln2 = $this->Mdl_home->cari_bulan($bln);
					$tgl_asli = substr($post['tanggal'], 6, 2) . " " . $bln2 . " " . substr($post['tanggal'], 0, 4);
					$dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
					foreach ($dtktg as $dkt) {
						$kdkt = $dkt['percategorycode'];
					}
					if ($post['tipe_dokumen'] == "1") {
						if ($post['file_abstrak'] != "") {
							$path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						} else {
							$path_abstrak = "tidak ada";
						}

						$path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "2") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "3") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "4") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					}

					$stat = $post['status'];
					$tambahan = '';
					if ($stat == '1') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
					} elseif ($stat == '0' or $stat == '') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
					}
					$pwds = md5($post['peraturan_id'] . date("YmYmmY"));
					$path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;

					$data_produk = '';
					$data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
					$data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . $post['download_count'] . ' kali</i>&nbsp;' . $tambahan . '</p></div>';
					$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> Abstrak</a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> Unduh</a> </div>';
					$nestedData['data_produk'] = $data_produk;
					$data[] = $nestedData;
					$i++;
				}
			}

			$json_data = array(
				"draw" => intval(htmlspecialchars($this->input->post('draw'))),
				"recordsTotal" => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data" => $data
			);

			echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
		}
	}

	function create_json_detail()
	{
		header("Access-Control-Allow-Origin: *");
		if (!empty($_REQUEST['tipe_dokumen'])) {
			$tipe_dokumen = htmlspecialchars($tipe_dokumen = $_REQUEST['tipe_dokumen']);
		} else {
			$tipe_dokumen = '';
		}
		if (!empty($_REQUEST['peraturan_category_id'])) {
			$peraturan_category_id = htmlspecialchars($peraturan_category_id = $_REQUEST['peraturan_category_id']);
		} else {
			$peraturan_category_id = '';
		}
		if (!empty($_REQUEST['noperaturan'])) {
			$noperaturan = htmlspecialchars($noperaturan = $_REQUEST['noperaturan']);
		} else {
			$noperaturan = '';
		}
		if (!empty($_REQUEST['judul'])) {
			$judul = htmlspecialchars($judul = $_REQUEST['judul']);
		} else {
			$judul = '';
		}
		if (!empty($_REQUEST['status'])) {
			$status = htmlspecialchars($status = $_REQUEST['status']);
		} else {
			$status = '';
		}
		if (!empty($_REQUEST['dept_id'])) {
			$dept_id = htmlspecialchars($dept_id = $_REQUEST['dept_id']);
		} else {
			$dept_id = '';
		}
		if (!empty($_REQUEST['tag_id'])) {
			$tag_id = htmlspecialchars($tag_id = $_REQUEST['tag_id']);
		} else {
			$tag_id = '';
		}
		if (!empty($_REQUEST['tahun'])) {
			$tahun = htmlspecialchars($tahun = $_REQUEST['tahun']);
		} else {
			$tahun = '';
		}
		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));
		$peraturan_category_id = str_replace("+", " ", $peraturan_category_id);

		$tag_id = str_replace($entities, $replacements, urlencode($tag_id));
		$tag_id = str_replace("+", " ", $tag_id);

		$status = str_replace($entities, $replacements, urlencode($status));
		$status = str_replace("+", " ", $status);

		$judul = str_replace($entities, $replacements, urlencode($judul));
		$judul = str_replace("+", " ", $judul);

		$tahun = str_replace($entities, $replacements, urlencode($tahun));
		$tahun = str_replace("+", " ", $tahun);

		$noperaturan = str_replace($entities, $replacements, urlencode($noperaturan));
		$noperaturan = str_replace("+", " ", $noperaturan);

		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));
		$tipe_dokumen = str_replace("+", " ", $tipe_dokumen);

		$dept_id = str_replace($entities, $replacements, urlencode($dept_id));
		$dept_id = str_replace("+", " ", $dept_id);

		if (preg_match($pattern, $tahun, $match)) {
			echo "error";
		} else if (preg_match($pattern, $judul, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tipe_dokumen, $match)) {
			echo "error";
		} else if (preg_match($pattern, $noperaturan, $match)) {
			echo "error";
		} else if (preg_match($pattern, $dept_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $peraturan_category_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $status, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tag_id, $match)) {
			echo "error";
		} else {



			$limit = 10;
			$start = 0;


			$start = intval(htmlspecialchars($this->input->post('start')));
			$limit = intval(htmlspecialchars($this->input->post('length')));
			if ($limit == "") {
				$start = 0;
				$limit = 10;
			}
			$totalData = $this->Mdl_fungsi->cari_detail_count_result($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$totalFiltered = $this->Mdl_fungsi->cari_detail_count_result($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$posts = $this->Mdl_fungsi->cari_detail_limit($limit, $start, $tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);

			$data = array();
			if (!empty($posts)) {
				$i = 0;
				foreach ($posts->result_array() as $post) {
					$nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
					$peraturan_id = $post['peraturan_id'];
					$judul3 = str_ireplace("<p>", "", $post['judul']);
					$judul4 = str_ireplace("</p>", "", $judul3);
					$judul2 = str_ireplace("\r", "", $judul4);
					$judul = str_ireplace("\n", "", $judul2);
					$stat = $post['status'];
					$bln = substr($post['tanggal'], 4, 2);
					$tahun = substr($post['tanggal'], 0, 4);
					$bln2 = $this->Mdl_home->cari_bulan($bln);
					$tgl_asli = substr($post['tanggal'], 6, 2) . " <span class='translatable'>$bln2</span> " . substr($post['tanggal'], 0, 4);
					$dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
					foreach ($dtktg as $dkt) {
						$kdkt = $dkt['percategorycode'];
					}
					if ($post['tipe_dokumen'] == "1") {
						if ($post['file_abstrak'] != "") {
							$path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						} else {
							$path_abstrak = "tidak ada";
						}

						$path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "2") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "3") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "4") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					}

					$stat = $post['status'];
					$tambahan = '';
					if ($stat == '1') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
					} elseif ($stat == '0' or $stat == '') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
					}
					$pwds = md5($post['peraturan_id'] . date("YmYmmY"));
					$path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;
					$data_produk = '';
					$data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
					$data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . ($post['download_count'] ?? 0) . ' <span class="translatable">kali</span></i>&nbsp;' . $tambahan . '</p></div>';
					if ( $tipe_dokumen == 4 || $tipe_dokumen == 2 ) {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="btn btn-primary btn-sm" style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Selengkapnya</span></a></div>';
					}
					else {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Abstrak</span></a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> <span class="translatable">Unduh</span></a> </div>';
					}
					$nestedData['data_produk'] = $data_produk;
					$data[] = $nestedData;
					$i++;
				}
			}

			$json_data = array(
				"draw" => intval(htmlspecialchars($this->input->post('draw'))),
				"recordsTotal" => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data" => $data
			);

			echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
		}
	}

	function create_json_detail_putusan()
	{
		header("Access-Control-Allow-Origin: *");
		if (!empty($_REQUEST['tipe_dokumen'])) {
			$tipe_dokumen = htmlspecialchars($tipe_dokumen = $_REQUEST['tipe_dokumen']);
		} else {
			$tipe_dokumen = '';
		}
		if (!empty($_REQUEST['peraturan_category_id'])) {
			$peraturan_category_id = htmlspecialchars($peraturan_category_id = $_REQUEST['peraturan_category_id']);
		} else {
			$peraturan_category_id = '';
		}
		if (!empty($_REQUEST['noperaturan'])) {
			$noperaturan = htmlspecialchars($noperaturan = $_REQUEST['noperaturan']);
		} else {
			$noperaturan = '';
		}
		if (!empty($_REQUEST['judul'])) {
			$judul = htmlspecialchars($judul = $_REQUEST['judul']);
		} else {
			$judul = '';
		}
		if (!empty($_REQUEST['status'])) {
			$status = htmlspecialchars($status = $_REQUEST['status']);
		} else {
			$status = '';
		}
		if (!empty($_REQUEST['dept_id'])) {
			$dept_id = htmlspecialchars($dept_id = $_REQUEST['dept_id']);
		} else {
			$dept_id = '';
		}
		if (!empty($_REQUEST['tag_id'])) {
			$tag_id = htmlspecialchars($tag_id = $_REQUEST['tag_id']);
		} else {
			$tag_id = '';
		}
		if (!empty($_REQUEST['tahun'])) {
			$tahun = htmlspecialchars($tahun = $_REQUEST['tahun']);
		} else {
			$tahun = '';
		}
		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));
		$peraturan_category_id = str_replace("+", " ", $peraturan_category_id);

		$tag_id = str_replace($entities, $replacements, urlencode($tag_id));
		$tag_id = str_replace("+", " ", $tag_id);

		$status = str_replace($entities, $replacements, urlencode($status));
		$status = str_replace("+", " ", $status);

		$judul = str_replace($entities, $replacements, urlencode($judul));
		$judul = str_replace("+", " ", $judul);

		$tahun = str_replace($entities, $replacements, urlencode($tahun));
		$tahun = str_replace("+", " ", $tahun);

		$noperaturan = str_replace($entities, $replacements, urlencode($noperaturan));
		$noperaturan = str_replace("+", " ", $noperaturan);

		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));
		$tipe_dokumen = str_replace("+", " ", $tipe_dokumen);

		$dept_id = str_replace($entities, $replacements, urlencode($dept_id));
		$dept_id = str_replace("+", " ", $dept_id);

		if (preg_match($pattern, $tahun, $match)) {
			echo "error";
		} else if (preg_match($pattern, $judul, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tipe_dokumen, $match)) {
			echo "error";
		} else if (preg_match($pattern, $noperaturan, $match)) {
			echo "error";
		} else if (preg_match($pattern, $dept_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $peraturan_category_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $status, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tag_id, $match)) {
			echo "error";
		} else {



			$limit = 10;
			$start = 0;


			$start = intval(htmlspecialchars($this->input->post('start')));
			$limit = intval(htmlspecialchars($this->input->post('length')));
			if ($limit == "") {
				$start = 0;
				$limit = 10;
			}
			$totalData = $this->Mdl_fungsi->cari_detail_count_result_putusan($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$totalFiltered = $this->Mdl_fungsi->cari_detail_count_result_putusan($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$posts = $this->Mdl_fungsi->cari_detail_limit_putusan($limit, $start, $tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);

			$data = array();
			if (!empty($posts)) {
				$i = 0;
				foreach ($posts->result_array() as $post) {
					$nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
					$peraturan_id = $post['peraturan_id'];
					$judul3 = str_ireplace("<p>", "", $post['judul']);
					$judul4 = str_ireplace("</p>", "", $judul3);
					$judul2 = str_ireplace("\r", "", $judul4);
					$judul = str_ireplace("\n", "", $judul2);
					$stat = $post['status'];
					$bln = substr($post['tanggal'], 4, 2);
					$tahun = substr($post['tanggal'], 0, 4);
					$bln2 = $this->Mdl_home->cari_bulan($bln);
					$tgl_asli = substr($post['tanggal'], 6, 2) . " <span class='translatable'>$bln2</span> " . substr($post['tanggal'], 0, 4);
					$dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
					foreach ($dtktg as $dkt) {
						$kdkt = $dkt['percategorycode'];
					}
					if ($post['tipe_dokumen'] == "1") {
						if ($post['file_abstrak'] != "") {
							$path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						} else {
							$path_abstrak = "tidak ada";
						}

						$path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "2") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "3") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "4") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					}

					$stat = $post['status'];
					$tambahan = '';
					if ($stat == '1') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
					} elseif ($stat == '0' or $stat == '') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
					}
					$pwds = md5($post['peraturan_id'] . date("YmYmmY"));
					$path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;
					$data_produk = '';
					$data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
					$data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . ($post['download_count'] ?? 0) . ' <span class="translatable">kali</span></i>&nbsp;' . $tambahan . '</p></div>';
					if ( $tipe_dokumen == 4 || $tipe_dokumen == 2 ) {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="btn btn-primary btn-sm" style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Selengkapnya</span></a></div>';
					}
					else {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Abstrak</span></a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> <span class="translatable">Unduh</span></a> </div>';
					}
					$nestedData['data_produk'] = $data_produk;
					$data[] = $nestedData;
					$i++;
				}
			}

			$json_data = array(
				"draw" => intval(htmlspecialchars($this->input->post('draw'))),
				"recordsTotal" => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data" => $data
			);

			echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
		}
	}


	function create_json_detail_monografi()
	{
		header("Access-Control-Allow-Origin: *");
		if (!empty($_REQUEST['tipe_dokumen'])) {
			$tipe_dokumen = htmlspecialchars($tipe_dokumen = $_REQUEST['tipe_dokumen']);
		} else {
			$tipe_dokumen = '';
		}
		if (!empty($_REQUEST['peraturan_category_id'])) {
			$peraturan_category_id = htmlspecialchars($peraturan_category_id = $_REQUEST['peraturan_category_id']);
		} else {
			$peraturan_category_id = '';
		}
		if (!empty($_REQUEST['noperaturan'])) {
			$noperaturan = htmlspecialchars($noperaturan = $_REQUEST['noperaturan']);
		} else {
			$noperaturan = '';
		}
		if (!empty($_REQUEST['judul'])) {
			$judul = htmlspecialchars($judul = $_REQUEST['judul']);
		} else {
			$judul = '';
		}
		if (!empty($_REQUEST['status'])) {
			$status = htmlspecialchars($status = $_REQUEST['status']);
		} else {
			$status = '';
		}
		if (!empty($_REQUEST['dept_id'])) {
			$dept_id = htmlspecialchars($dept_id = $_REQUEST['dept_id']);
		} else {
			$dept_id = '';
		}
		if (!empty($_REQUEST['tag_id'])) {
			$tag_id = htmlspecialchars($tag_id = $_REQUEST['tag_id']);
		} else {
			$tag_id = '';
		}
		if (!empty($_REQUEST['tahun'])) {
			$tahun = htmlspecialchars($tahun = $_REQUEST['tahun']);
		} else {
			$tahun = '';
		}
		$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

		$peraturan_category_id = str_replace($entities, $replacements, urlencode($peraturan_category_id));
		$peraturan_category_id = str_replace("+", " ", $peraturan_category_id);

		$tag_id = str_replace($entities, $replacements, urlencode($tag_id));
		$tag_id = str_replace("+", " ", $tag_id);

		$status = str_replace($entities, $replacements, urlencode($status));
		$status = str_replace("+", " ", $status);

		$judul = str_replace($entities, $replacements, urlencode($judul));
		$judul = str_replace("+", " ", $judul);

		$tahun = str_replace($entities, $replacements, urlencode($tahun));
		$tahun = str_replace("+", " ", $tahun);

		$noperaturan = str_replace($entities, $replacements, urlencode($noperaturan));
		$noperaturan = str_replace("+", " ", $noperaturan);

		$tipe_dokumen = str_replace($entities, $replacements, urlencode($tipe_dokumen));
		$tipe_dokumen = str_replace("+", " ", $tipe_dokumen);

		$dept_id = str_replace($entities, $replacements, urlencode($dept_id));
		$dept_id = str_replace("+", " ", $dept_id);

		if (preg_match($pattern, $tahun, $match)) {
			echo "error";
		} else if (preg_match($pattern, $judul, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tipe_dokumen, $match)) {
			echo "error";
		} else if (preg_match($pattern, $noperaturan, $match)) {
			echo "error";
		} else if (preg_match($pattern, $dept_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $peraturan_category_id, $match)) {
			echo "error";
		} else if (preg_match($pattern, $status, $match)) {
			echo "error";
		} else if (preg_match($pattern, $tag_id, $match)) {
			echo "error";
		} else {



			$limit = 10;
			$start = 0;


			$start = intval(htmlspecialchars($this->input->post('start')));
			$limit = intval(htmlspecialchars($this->input->post('length')));
			if ($limit == "") {
				$start = 0;
				$limit = 10;
			}
			$totalData = $this->Mdl_fungsi->cari_detail_count_result_monografi($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$totalFiltered = $this->Mdl_fungsi->cari_detail_count_result_monografi($tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);
			$posts = $this->Mdl_fungsi->cari_detail_limit_monografi($limit, $start, $tipe_dokumen, $peraturan_category_id, $noperaturan, $tahun, $judul, $status, $dept_id, $tag_id);

			$data = array();
			if (!empty($posts)) {
				$i = 0;
				foreach ($posts->result_array() as $post) {
					$nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
					$peraturan_id = $post['peraturan_id'];
					$judul3 = str_ireplace("<p>", "", $post['judul']);
					$judul4 = str_ireplace("</p>", "", $judul3);
					$judul2 = str_ireplace("\r", "", $judul4);
					$judul = str_ireplace("\n", "", $judul2);
					$stat = $post['status'];
					$bln = substr($post['tanggal'], 4, 2);
					$tahun = substr($post['tanggal'], 0, 4);
					$bln2 = $this->Mdl_home->cari_bulan($bln);
					$tgl_asli = substr($post['tanggal'], 6, 2) . " <span class='translatable'>$bln2</span> " . substr($post['tanggal'], 0, 4);
					$dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
					foreach ($dtktg as $dkt) {
						$kdkt = $dkt['percategorycode'];
					}
					if ($post['tipe_dokumen'] == "1") {
						if ($post['file_abstrak'] != "") {
							$path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						} else {
							$path_abstrak = "tidak ada";
						}

						$path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "2") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "3") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					} else if ($post['tipe_dokumen'] == "4") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
						$path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
					}

					$stat = $post['status'];
					$tambahan = '';
					if ($stat == '1') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
					} elseif ($stat == '0' or $stat == '') {
						$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
					}
					$pwds = md5($post['peraturan_id'] . date("YmYmmY"));
					$path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;
					$data_produk = '';
					$data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
					$data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . ($post['download_count'] ?? 0) . ' <span class="translatable">kali</span></i>&nbsp;' . $tambahan . '</p></div>';
					if ( $tipe_dokumen == 4 || $tipe_dokumen == 2 ) {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="btn btn-primary btn-sm" style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Selengkapnya</span></a></div>';
					}
					else {
						$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> <span class="translatable">Abstrak</span></a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> <span class="translatable">Unduh</span></a> </div>';
					}
					$nestedData['data_produk'] = $data_produk;
					$data[] = $nestedData;
					$i++;
				}
			}

			$json_data = array(
				"draw" => intval(htmlspecialchars($this->input->post('draw'))),
				"recordsTotal" => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data" => $data
			);

			echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
		}
	}

	function create_json_detail_tags($tag_id)
	{

		$limit = 10;
		$start = 0;


		$start = intval(htmlspecialchars($this->input->post('start')));
		$limit = intval(htmlspecialchars($this->input->post('length')));
		if ($limit == "") {
			$start = 0;
			$limit = 10;
		}
		$totalData = $this->Mdl_fungsi->cari_tag_count_result($tag_id);
		$totalFiltered = $this->Mdl_fungsi->cari_tag_count_result($tag_id);
		$posts = $this->Mdl_fungsi->cari_tag_limit($limit, $start, $tag_id);

		$data = array();
		if (!empty($posts)) {
			$i = 0;
			foreach ($posts->result_array() as $post) {
				$nama_peraturan = $this->Mdl_home->cari_peraturan_id_2($post['peraturan_category_id']);
				$peraturan_id = $post['peraturan_id'];
				$judul3 = str_ireplace("<p>", "", $post['judul']);
				$judul4 = str_ireplace("</p>", "", $judul3);
				$judul2 = str_ireplace("\r", "", $judul4);
				$judul = str_ireplace("\n", "", $judul2);
				$stat = $post['status'];
				$bln = substr($post['tanggal'], 4, 2);
				$tahun = substr($post['tanggal'], 0, 4);
				$bln2 = $this->Mdl_home->cari_bulan($bln);
				$tgl_asli = substr($post['tanggal'], 6, 2) . " " . $bln2 . " " . substr($post['tanggal'], 0, 4);
				$dtktg = $this->Mdl_home->get_kategori($post['peraturan_category_id']);
				foreach ($dtktg as $dkt) {
					$kdkt = $dkt['percategorycode'];
				}
				if ($post['tipe_dokumen'] == "1") {
					if ($post['file_abstrak'] != "") {
						$path_abstrak = base_url('internal/assets/assets/produk_abstrak/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
					} else {
						$path_abstrak = "tidak ada";
					}

					$path_upload = base_url('internal/assets/assets/produk/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
				} else if ($post['tipe_dokumen'] == "2") {
					$path_abstrak = base_url('internal/assets/assets/produk_abstrak/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
					$path_upload = base_url('internal/assets/assets/produk/monografi/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
				} else if ($post['tipe_dokumen'] == "3") {
					$path_abstrak = base_url('internal/assets/assets/produk_abstrak/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
					$path_upload = base_url('internal/assets/assets/produk/artikel/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
				} else if ($post['tipe_dokumen'] == "4") {
					$path_abstrak = base_url('internal/assets/assets/produk_abstrak/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_abstrak']);
					$path_upload = base_url('internal/assets/assets/produk/putusan/' . $kdkt . '/' . $tahun . '/' . $bln . '/' . $post['file_upload']);
				}

				$stat = $post['status'];
				$tambahan = '';
				if ($stat == '1') {
					$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon2.png" style="width:20px;height:20px">';
				} elseif ($stat == '0' or $stat == '') {
					$tambahan = '<img src="' . base_url() . 'assets/img/core-img/icon1.png" style="width:20px;height:20px">';
				}
				$pwds = md5($post['peraturan_id'] . date("YmYmmY"));
				$path_abs = base64_encode($post['peraturan_id']) . "^" . $pwds;
				$data_produk = '';
				$data_produk .= '<div class="post-content" style="margin-left:10px;min-height:10px;margin-top:5px"><a href="' . base_url() . 'detail-dokumen/' . $post['peraturan_id'] . '/' . $post['tipe_dokumen'] . '" class="headline"><label style="font-size:16px;font-weight:bold;color:#6d6e70;text-align:left;float:left">' . $judul . '<label></a></div>';
				$data_produk .= '<br><div class="post-meta" style="margin-left:10px;"><p><i class="fa fa-clock-o"></i> ' . $tgl_asli . '&nbsp;&nbsp;<i class="fa fa-download"> ' . $post['download_count'] . ' kali</i>&nbsp;' . $tambahan . '</p></div>';
				$data_produk .= '<div align="right" style="margin-top:-10px;color:#000;"><a href="#abstrak_' . $i . '" class="btn btn-primary btn-sm" onclick=panggil_abstrak("' . $path_abs . '") style="color:#fff"><i class="fa fa-eye"></i> Abstrak</a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . $path_upload . '" class="btn btn-primary btn-sm" download style="color:#fff" onclick=klikunduh(' . $peraturan_id . ')><i class="fa fa-download"></i> Unduh</a> </div>';
				$nestedData['data_produk'] = $data_produk;
				$data[] = $nestedData;
				$i++;
			}
		}



		$json_data = array(
			"draw" => intval(htmlspecialchars($this->input->post('draw'))),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
	}

	function tambah_unduh()
	{
		$peraturan_id = '';
		if (!empty($_REQUEST['peraturan_id'])) {
			$peraturan_id = htmlspecialchars($_REQUEST['peraturan_id']);
		}
		$data_unduh = $this->Mdl_home->ambil_unduh($peraturan_id);
		$data_unduh_baru = $data_unduh + 1;
		$data = array(
			"download_count" => $data_unduh_baru
		);
		$this->Mdl_home->update_unduh($peraturan_id, $data);
		$json_data = array(
			"peraturan_id" => $peraturan_id,
			"jumlah" => $data_unduh,
			"jumlah_baru" => $data_unduh_baru
		);
		echo json_encode($json_data);
	}

	function create_json_detail_simpel()
	{
		header("Access-Control-Allow-Origin: *");

		$limit = 10;
		$start = 0;


		$start = intval(htmlspecialchars($this->input->post('start')));
		$limit = intval(htmlspecialchars($this->input->post('length')));
		$idPeraturan = $this->input->post('idPeraturan');


		if ($limit == "") {
			$start = 0;
			$limit = 10;
		}
		$totalData = $this->Mdl_fungsi->cari_detail_count_result_simpel($idPeraturan);
		$totalFiltered = $this->Mdl_fungsi->cari_detail_count_result_simpel($idPeraturan);
		$posts = $this->Mdl_fungsi->cari_detail_limit_simepel($limit, $start, $idPeraturan);



		$data = array();
		if (!empty($posts)) {

			$i = 0;
			foreach ($posts->result() as $post) {

				$date = new DateTime($post->created_at);

				$bulan = array(
					'January' => 'Januari',
					'February' => 'Februari',
					'March' => 'Maret',
					'April' => 'April',
					'May' => 'Mei',
					'June' => 'Juni',
					'July' => 'Juli',
					'August' => 'Agustus',
					'September' => 'September',
					'October' => 'Oktober',
					'November' => 'November',
					'December' => 'Desember'
				);


				$nestedData['data_produk'] = '<div class="post-content" style="margin-left: 10px; min-height: 10px; margin-top: 5px;">
				<a href="javascript:void(0)" class="headline">
				<label style="font-size: 16px; font-weight: bold; color: #6d6e70; text-align: left; float: left;">
				'.$post->nm_produk_hukum.'
				</label>
				</a>
				</div>
				<br>
				<div class="post-meta" style="margin-left: 10px;">
				<p>
				<i class="fa fa-clock-o"></i> '.$date->format('d').' <span class="translatable">'.$bulan[$date->format('F')].'</span> '.$date->format('Y').'&nbsp;&nbsp;
				</p>
				</div>
				<div align="right" style="margin-top: -10px; color: #000;">
				<a href="javascript:void(0)" class="btn btn-primary btn-sm" download style="color: #fff;" onclick="shwoModal('.$post->id.')">
				<span class="translatable">Detail</span>
				</a>
				</div>';

				$data[] = $nestedData;
				$i++;
			}
		}

		$json_data = array(
			"draw" => intval(htmlspecialchars($this->input->post('draw'))),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data, JSON_UNESCAPED_SLASHES);
		
	}

}
