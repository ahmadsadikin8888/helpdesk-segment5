<?php
require APPPATH . '/controllers/Distribution/Distribution_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Distribution extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();

		$this->log_key = 'log_Distributon';
		$this->title = new Distribution_config();
		$this->load->model('sys/Sys_dapros_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/Dapros_model', 'distribution');
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DATA PROSPEK',
			'title'					=> $this->title,
			'link_create_multiple'			=> site_url() . 'Distribution/Distribution/create_multiple',
			'link_download_template_dapros'	=> site_url() . 'Distribution/Distribution/download_template_user/' . $this->_token,
			'link_upload_template'			=> site_url() . 'Distribution/Distribution/upload_template_user/' . $this->_token,
			'link_filter'				=> site_url() . 'Distribution/Distribution/get_data',
			'link_duplicate'				=> site_url() . 'Distribution/Distribution/check_duplicate',
			'link_close'				=> site_url() . 'Distribution/Distribution',
			'link_back'				=> site_url() . 'Distribution/Distribution',
		);

		$this->template->load('Distribution/Distribution_filter_form', $data);
	}
	public function check_kolom()
	{
		$array = array(
			"A" => "Ini_A",
			"B" => "Ini_B",
			"C" => "Ini_C",
		);
		$key_A = array_keys($array, 'Ini_B');
		echo $key_A[0];
	}
	public function get_data()
	{
		$post = $this->input->post();
		$data = array(
			'title_page_big'		=> 'CHECK DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution/get_data',
			'link_submit'				=> site_url() . 'Distribution/Distribution/proses_data',
			'link_back'				=> site_url() . 'Distribution/Distribution',
		);
		$filter_agent = array("opt_level" => 8);
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		if ($post) {
			$filter = array();
			if ($post['error'] != "semua") {
				$filter["STATUS_MESSAGE LIKE '%|" . $post['error'] . ":%' "] = NULL;
			}
			if ($post['addon'] != "semua") {
				$filter["ADDON = '" . $post['addon'] . "' "] = NULL;
			}
			$filter["(ISNULL(agentid) OR agentid = '' )"] = null;
			$filter['status'] = 0;
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
			}


			$data['jumlah_data'] = $this->distribution->get_count($filter);
			$data['filter'] = $post;
			$this->template->load('Distribution/Distribution_list', $data);
		} else {
			$this->template->load('Distribution/Distribution_filter_form', $data);
		}
	}
	function proses_data()
	{
		$post = $this->input->post();
		$filter_agent = array("opt_level" => 8);
		$dc = false;
		if (count($post['agentid']) > 1) {
			$n_agent_pick = count($post['agentid']);
			foreach ($post['agentid'] as $k_agentid => $v_agentid) {

				if ($k_agentid == 0) {
					$where_agent_multi = "( agentid = '$v_agentid'";
				} else {
					if ($k_agentid == ($n_agent_pick - 1)) {
						$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
					} else {
						$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
					}
				}
			}
			$filter_agent['or_where_null'] = array($where_agent_multi);
		} else {

			if ($post['agentid'][0] != '0') {
				// echo $agentid[0];
				$filter_agent['agentid'] = $post['agentid'][0];
			}
		}
		$list_agent_d = $this->sys_user->get_results($filter_agent, array("*"), array(), array("id" => "RANDOM"));

		if ($post) {
			$filter = array();
			if ($post['error'] != "semua") {
				$filter["STATUS_MESSAGE LIKE '%|" . $post['error'] . ":%' "] = NULL;
			}
			if ($post['addon'] != "semua") {
				$filter["ADDON = '" . $post['addon'] . "' "] = NULL;
			}
			$filter["(ISNULL(agentid) OR agentid = '' )"] = null;
			$filter['status'] = 0;
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
			}
			// if ($post['agentid'] == "0") {
			$n = 0;

			if ($list_agent_d['num'] > 0) {
				foreach ($list_agent_d['results'] as $list_agent) {
					$n++;
					$data_insert = array(
						"agentid" => $list_agent->agentid,
						"petugas" => $list_agent->nama,
						"tgl_distribution" => date('Y-m-d H:i:s'),
					);
					if (isset($post['limit'])) {

						if ($post['limit'] > 0) {
							$this->distribution->edit($filter, $data_insert, $post['limit']);
						}
					}
				}
			}
			redirect(site_url() . 'Distribution/Distribution?success=1&dibagi=' . $post['dibagi']);
		}
	}
	public function upload_dapros()
	{
		$data = array(
			'title_page_big'		=> 'UPLOAD DATA PROSPEK',
			'title'					=> $this->title,
			'link_create_multiple'			=> site_url() . 'Distribution/Distribution/create_multiple',
			'link_download_template_dapros'	=> site_url() . 'Distribution/Distribution/download_template_user/' . $this->_token,
			'link_upload_template'			=> site_url() . 'Distribution/Distribution/upload_template_user/' . $this->_token,
		);

		$this->template->load('Distribution/Index', $data);
	}
	public function upload_template_user($token)
	{

		$tm = time();
		$config['upload_path']          = './temp_upload/';
		$config['allowed_types']        = '*';
		$config['max_size']             = 60000000;
		$config['file_name']			= 'template_dapros.xls';
		$config['overwrite']			= TRUE;


		$this->load->library('upload', $config);

		$o = array();
		if (!$this->upload->do_upload('inputfile')) {

			$em = $this->upload->display_errors();
			$em = str_replace('You did not select a file to upload.', 'Tidak ada file yang di pilih', $em);

			$o['success'] 	= 'false';
			$o['message']	= $em;
			$o['elementid'] = '#inputfile';
			$o['sec_val']	=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
			$o = json_encode($o);
			echo $o;
			return;
		} else {
			$path_file = $config['upload_path'] . $config['file_name'];
			$this->load->library("YBSExcelReader");
			$dataError = array();
			try {
				$excel  = new YBSExcelReader();
				$excel->set_file($path_file, "UPLOAD");
			} catch (Exception $e) {
				$msgError = $e->getMessage();
				$msgError = str_replace("Your requested sheet index: -1 is out of bounds. The actual number of sheets is 0.", "Error : Sheet tidak di temukan", $msgError);
				$dataError[] = "<small>" . $msgError . "</small><br>";
			}
			if (count($dataError) > 0) {
				unlink($path_file);
				$o['success']		= 'false';
				$o['message'] 		= $dataError;
				$o['original_name']	= $this->upload->data('client_name');
				$o['sec_val']		=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			} else {
				$sumber = $_POST['sumber'];
				$o['success']		= 'true';
				$o['message'] 		= "<small> File Ready in Process,,click save</small><br><a onclick=\"save('" . site_url() . "Distribution/Distribution/create_user_by_template/" . $this->_token . "/" . $sumber . "')\" href=\"javascript:void(0)\" class=\"btn btn-success\">Save<a/>";
				$o['original_name']	= $this->upload->data('client_name');
				$o['sec_val']		=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			}
		}
	}
	public function create_user_by_template($token, $sumber)
	{
		if ($this->_token == $token) {
			$path_file = './temp_upload/template_dapros.xls';

			$this->load->library("YBSExcelReader");
			$excel  = new YBSExcelReader();
			$excel->set_file($path_file, "UPLOAD");
			$rangena = array(
				"A",
				"B",
				"C",
				"D",
				"E",
				"F",
				"G",
				"H",
				"I",
				"J",
				"K",
				"L",
				"M",
				"N",
				"O",
				"P",
				"Q",
				"R",
				"S",
				"T",
				"U",
				"V",
				"W",
				"X",
				"Y",
				"Z",
				"AA",
				"AB",
				"AC",
				"AD",
				"AE",
				"AF",
				"AG",
				"AH",
				"AI",
				"AJ",
				"AK",
				"AL",
				"AM"
			);

			$kolom_default['ADDON'] = 'A';
			$kolom_default['STATUS_SC'] = 'B';
			$kolom_default['NDEM'] = 'C';
			$kolom_default['COPER'] = 'D';
			$kolom_default['CAGENT'] = 'E';
			$kolom_default['KAWASAN'] = 'F';
			$kolom_default['WITEL'] = 'G';
			$kolom_default['C_WITEL'] = 'H';
			$kolom_default['C_DATEL_NEW'] = 'I';
			$kolom_default['STO'] = 'J';
			$kolom_default['CHANEL'] = 'K';
			$kolom_default['ALPRO'] = 'L';
			$kolom_default['umur'] = 'N';
			$kolom_default['cek'] = 'O';
			$kolom_default['CGEST'] = 'P';
			$kolom_default['CSEG'] = 'Q';
			$kolom_default['CCAT'] = 'R';
			$kolom_default['LINECATS_FAMILY_LNAME'] = 'S';
			$kolom_default['TEMATIK'] = 'T';
			$kolom_default['ITEM'] = 'U';
			$kolom_default['CPACK'] = 'V';
			$kolom_default['PSB'] = 'W';
			$kolom_default['CBT'] = 'X';
			$kolom_default['MIG'] = 'Y';
			$kolom_default['PRICE_PSB'] = 'Z';
			$kolom_default['PRICE_CBT'] = 'AA';
			$kolom_default['PRICE_MIG'] = 'AB';
			$kolom_default['FLAG_BUNDLING'] = 'AC';
			$kolom_default['BUNDLING_2P3P'] = 'AD';
			$kolom_default['BUNDLING_STB'] = 'AE';
			$kolom_default['BUNDLING_WIFIEXT'] = 'AF';
			$kolom_default['EXTERNAL_ORDER_ID'] = 'AG';
			$kolom_default['BUNDLING_INDIBOX'] = 'AH';
			$kolom_default['ND_SPEEDY'] = 'AI';
			$kolom_default['KCONTACT'] = 'AJ';
			$kolom_default['XS6'] = 'AK';
			$kolom_default['HASIL'] = 'AL';
			$kolom_default['KETERANGAN'] = 'AM';

			$kolom_default_ds['NDEM'] = 'B';
			$kolom_default_ds['ADDON'] = 'C';
			$kolom_default_ds['SUB ADDON'] = 'D';
			$kolom_default_ds['KAWASAN'] = 'E';
			$kolom_default_ds['WITEL'] = 'F';
			$kolom_default_ds['DATEL'] = 'G';
			$kolom_default_ds['STO'] = 'H';
			$kolom_default_ds['CHANEL'] = 'I';
			$kolom_default_ds['UMUR'] = 'K';
			$kolom_default_ds['GROUP_TTI'] = 'L';
			$kolom_default_ds['EXTERNAL_ORDER_ID'] = 'M';
			$kolom_default_ds['ND_SERVICE'] = 'N';
			$kolom_default_ds['KCONTACT'] = 'O';
			$kolom_default_ds['STATUS_SC'] = 'P';
			$kolom_default_ds['ORDER_STATUS_ID'] = 'Q';
			$kolom_default_ds['ORDER_STATUS_DETAIL'] = 'AM';


			$dataFinal = $excel->read(1, 10000, $rangena);

			$val = array();
			$val_exist = array();
			$val_final = array();
			$x = 0;
			foreach ($dataFinal as $key) {
				if ($x > 0) {
					switch ($sumber) {
						case "VA":
							$s = (string)$key['M'];
							$date = strtotime($s);
							$mna = date('Y-m-d H:i:s', $date);
							$val['ADDON'] = (string)$key[$kolom_default['ADDON']];
							$val['STATUS_SC'] = (string)$key[$kolom_default['STATUS_SC']];
							$val['NDEM'] = (string)$key[$kolom_default['NDEM']];
							$val['COPER'] = (string)$key[$kolom_default['COPER']];
							$val['CAGENT'] = (string)$key[$kolom_default['CAGENT']];
							$val['KAWASAN'] = (string)$key[$kolom_default['KAWASAN']];
							$val['WITEL'] = (string)$key[$kolom_default['WITEL']];
							$val['C_WITEL'] = (string)$key[$kolom_default['C_WITEL']];
							$val['C_DATEL_NEW'] = (string)$key[$kolom_default['C_DATEL_NEW']];
							$val['STO'] = (string)$key[$kolom_default['STO']];
							$val['CHANEL'] = (string)$key[$kolom_default['CHANEL']];
							$val['ALPRO'] = (string)$key[$kolom_default['ALPRO']];
							$val['TGL_VA'] = $mna;
							$val['umur'] = (string)$key[$kolom_default['umur']];
							$val['cek'] = (string)$key[$kolom_default['cek']];
							$val['CGEST'] = (string)$key[$kolom_default['CGEST']];
							$val['CSEG'] = (string)$key[$kolom_default['CSEG']];
							$val['CCAT'] = (string)$key[$kolom_default['CCAT']];
							$val['LINECATS_FAMILY_LNAME'] = (string)$key[$kolom_default['LINECATS_FAMILY_LNAME']];
							$val['TEMATIK'] = (string)$key[$kolom_default['TEMATIK']];
							$val['ITEM'] = (string)$key[$kolom_default['ITEM']];
							$val['CPACK'] = (string)$key[$kolom_default['CPACK']];
							$val['PSB'] = (string)$key[$kolom_default['PSB']];
							$val['CBT'] = (string)$key[$kolom_default['CBT']];
							$val['MIG'] = (string)$key[$kolom_default['MIG']];
							$val['PRICE_PSB'] = (string)$key[$kolom_default['PRICE_PSB']];
							$val['PRICE_CBT'] = (string)$key[$kolom_default['PRICE_CBT']];
							$val['PRICE_MIG'] = (string)$key[$kolom_default['PRICE_MIG']];
							$val['FLAG_BUNDLING'] = (string)$key[$kolom_default['FLAG_BUNDLING']];
							$val['BUNDLING_2P3P'] = (string)$key[$kolom_default['BUNDLING_2P3P']];
							$val['BUNDLING_STB'] = (string)$key[$kolom_default['BUNDLING_STB']];
							$val['BUNDLING_WIFIEXT'] = (string)$key[$kolom_default['BUNDLING_WIFIEXT']];
							$val['EXTERNAL_ORDER_ID'] = (string)$key[$kolom_default['EXTERNAL_ORDER_ID']];
							$val['BUNDLING_INDIBOX'] = (string)$key[$kolom_default['BUNDLING_INDIBOX']];
							$val['ND_SPEEDY'] = (string)$key[$kolom_default['ND_SPEEDY']];
							$val['KCONTACT'] = (string)$key[$kolom_default['KCONTACT']];
							$val['XS6'] = (string)$key[$kolom_default['XS6']];
							$val['HASIL'] = (string)$key[$kolom_default['HASIL']];
							$val['KETERANGAN'] = (string)$key[$kolom_default['KETERANGAN']];
							$val['SUMBER'] = "VA";
							break;
						case "DASHBOARD":
							$s = (string)$key['J'];
							$date = strtotime($s);
							$mna = date('Y-m-d H:i:s', $date);

							$val['NDEM'] = (string)$key[$kolom_default_ds['NDEM']];
							$val['ADDON'] = (string)$key[$kolom_default_ds['ADDON']];
							$val['SUB_ADDON'] = (string)$key[$kolom_default_ds['SUB ADDON']];
							$val['KAWASAN'] = (string)$key[$kolom_default_ds['KAWASAN']];
							$val['WITEL'] = (string)$key[$kolom_default_ds['WITEL']];
							$val['C_DATEL_NEW'] = (string)$key[$kolom_default_ds['DATEL']];
							$val['STO'] = (string)$key[$kolom_default_ds['STO']];
							$val['CHANEL'] = (string)$key[$kolom_default_ds['CHANEL']];
							$val['umur'] = (string)$key[$kolom_default_ds['UMUR']];
							$val['cek'] = (string)$key[$kolom_default_ds['GROUP_TTI']];
							$val['EXTERNAL_ORDER_ID'] = (string)$key[$kolom_default_ds['EXTERNAL_ORDER_ID']];

							if (strlen((string)$key[$kolom_default_ds['EXTERNAL_ORDER_ID']]) < 2) {
								$val['EXTERNAL_ORDER_ID'] = (string)$key[$kolom_default_ds['NDEM']];
							}

							$val['ND_SPEEDY'] = (string)$key[$kolom_default_ds['ND_SERVICE']];
							$val['KCONTACT'] = (string)$key[$kolom_default_ds['KCONTACT']];
							$val['STATUS_SC'] = (string)$key[$kolom_default_ds['STATUS_SC']];
							$val['HASIL'] = (string)$key[$kolom_default_ds['HASIL']];
							$val['KETERANGAN'] = (string)$key[$kolom_default_ds['ORDER_STATUS_DETAIL']];
							$val['TGL_VA'] = $mna;

							$val['SUMBER'] = "VA";
							break;
						case "ERROR":
							$val['EXTERNAL_ORDER_ID'] = (string)$key['A'];
							$val['KAWASAN'] = (string)$key['B'];
							$val['WITEL'] = (string)$key['C'];
							$val['C_DATEL_NEW'] = (string)$key['D'];
							$val['STO'] = (string)$key['E'];
							$val['EXTERN_ORDER_ID'] = (string)$key['F'];
							$val['JENISPSB'] = (string)$key['G'];
							$val['TYPE_TRANS'] = (string)$key['H'];
							$val['STATUS_RESUME'] = (string)$key['I'];
							$val['STATUS_MESSAGE'] = (string)$key['J'];
							$val['HASIL'] = (string)$key['K'];
							$val['KETERANGAN'] = (string)$key['L'];
							$val['TGL_VA'] = DATE('Y-m-d H:i:s');
							$val['umur'] = 0;
							$val['SUMBER'] = "ERROR";
							break;
						case "HVC":
							$s = (string)$key['L'];
							$date = strtotime($s);
							$mna = date('Y-m-d H:i:s', $date);
							$val['ORDER_NUM'] = (string)$key['A'];
							$val['NCLI'] = (string)$key['B'];
							$val['NOTEL_POTS'] = (string)$key['C'];
							$val['ND_SPEEDY'] = (string)$key['D'];
							$val['KAWASAN'] = (string)$key['E'];
							$val['WITEL'] = (string)$key['F'];
							$val['PRODUCT_TYPE'] = (string)$key['G'];
							$val['KAT_HVC'] = (string)$key['H'];
							$val['NCX_ID'] = (string)$key['I'];
							$val['EXTERNAL_ORDER_ID'] = (string)$key['J'];
							$val['FULFLMNT_STATUS_CD'] = (string)$key['K'];
							$val['TGL_VA'] = $mna;
							$val['umur'] = (string)$key['M'];
							$val['cek'] = (string)$key['N'];
							$val['ADDON'] = (string)$key['O'];
							$val['STATUS_DATA_HVC'] = (string)$key['P'];
							$val['HASIL'] = (string)$key['Q'];
							$val['KETERANGAN'] = (string)$key['R'];
							$val['SUMBER'] = "HVC";
							break;

						case "HVC_DASHBOARD":
							$s = (string)$key['J'];
							$date = strtotime($s);
							$mna = date('Y-m-d H:i:s', $date);

							$val['NDEM'] = (string)$key[$kolom_default_ds['NDEM']];
							$val['ADDON'] = (string)$key[$kolom_default_ds['ADDON']];
							$val['SUB_ADDON'] = (string)$key[$kolom_default_ds['SUB ADDON']];
							$val['KAWASAN'] = (string)$key[$kolom_default_ds['KAWASAN']];
							$val['WITEL'] = (string)$key[$kolom_default_ds['WITEL']];
							$val['C_DATEL_NEW'] = (string)$key[$kolom_default_ds['DATEL']];
							$val['STO'] = (string)$key[$kolom_default_ds['STO']];
							$val['CHANEL'] = (string)$key[$kolom_default_ds['CHANEL']];
							$val['umur'] = (string)$key[$kolom_default_ds['UMUR']];
							$val['cek'] = (string)$key[$kolom_default['GROUP_TTI']];
							$val['EXTERNAL_ORDER_ID'] = (string)$key[$kolom_default_ds['EXTERNAL_ORDER_ID']];
							if (strlen((string)$key[$kolom_default_ds['EXTERNAL_ORDER_ID']]) < 2) {
								$val['EXTERNAL_ORDER_ID'] = (string)$key[$kolom_default_ds['NDEM']];
							}
							$val['ND_SPEEDY'] = (string)$key[$kolom_default_ds['ND_SERVICE']];
							$val['KCONTACT'] = (string)$key[$kolom_default_ds['KCONTACT']];
							$val['STATUS_SC'] = (string)$key[$kolom_default_ds['STATUS_SC']];
							$val['HASIL'] = (string)$key[$kolom_default_ds['HASIL']];
							$val['KETERANGAN'] = (string)$key[$kolom_default_ds['ORDER_STATUS_DETAIL']];
							$val['TGL_VA'] = $mna;

							$val['SUMBER'] = "HVC";
							break;
					}


					$val['tgl_insert'] = DATE('Y-m-d H:i:s');
					$val['status'] = 0;
					$val['unixidx'] = (string)$key['A'] . (string)$key['C'] . $mna . (string)$key['AI'];
					if ($sumber == "DASHBOARD" || $sumber == "HVC_DASHBOARRD") {
						$val['unixidx'] = (string)$key['C'] . (string)$key['B'] . $mna . (string)$key['N'];
					}

					$field = array();

					$field['unixidx'] = $val['unixidx'];

					$exist = $this->tmodel->if_exist('', $field);
					if ($exist) {
						unset($val['tgl_insert']);
						unset($val['status']);
						$val_update = $val;
						$val_exist[] = $val_update;
					} else {
						$val_final[] = $val;
					}
				} else {
					if ($sumber == "VA") {
						foreach ($kolom_default as $key_col => $val_col) {
							$array_key = array_keys($key, $key_col);
							// if (count($array_key) > 0) {
							
							$kolom_default[$key_col] = $array_key[0];
							// }
						}
					}
					if ($sumber == "DASHBOARD" || $sumber == "HVC_DASHBOARRD") {
						foreach ($kolom_default_ds as $key_col => $val_col) {
							$array_key = array_keys($key, $key_col);
							// if (count($array_key) > 0) {
							
							$kolom_default_ds[$key_col] = $array_key[0];
							// }
						}
					}
				}

				$x++;
			}
			if (count($val_exist) > 0) {
				$split_data_exist = array_chunk($val_exist, 100);

				foreach ($split_data_exist as $val) {
					$this->tmodel->update_multiple($val, "unixidx");
				}
			}
			$o = new Outputview();
			$split_data = array_chunk($val_final, 100);

			foreach ($split_data as $val) {

				$this->tmodel->insert_multiple($val);
			}

			$o->success = 'true';
			$o->message = "<small>data berhasil di simpan.. " . count($val_final) . " Data Berhasil Ditambahkan," . count($val_exist) . " Data Berhasil Diupdate </small><br>";
			echo $o->result();

			return;
		} else {
			redirect("Auth");
		}
	}
	public function download_template_user($token)
	{
		// if ($token == $this->_token && $this->_user_id == 1) {

		//mendapatkan data level


		$this->load->library("PHPExcel");
		$objPHPExcel = new PHPExcel();

		//SET BORDER
		$thick = array();
		$thick['borders'] = array();
		$thick['borders']['allborders'] = array();
		$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;


		$objPHPExcel->getProperties()->setCreator("Ahmad Sadikin")
			->setLastModifiedBy("Ahmad Sadikin")
			->setTitle("Office 2007 XLSX Test Document")
			->setSubject("Office 2007 XLSX Test Document")
			->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
			->setKeywords("office 2007 openxml php")
			->setCategory("Test result file");


		//========================================//
		/* 	 MEMBUAT TABLE ISIAN PADA COLUMN A1	  */
		//========================================//					 

		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'ISI PADA TABEL DI BAWAH INI (MAX 5000 ROW)')
			->setCellValue('A2', 'pastikan anda mengisi dengan benar, cek kembali isian anda sebelum melakukan upload ke system')
			->setCellValue('A3', 'ADDON')
			->setCellValue('B3', 'STATUS_SC')
			->setCellValue('C3', 'NDEM')
			->setCellValue('D3', 'COPER')
			->setCellValue('E3', 'CAGENT')
			->setCellValue('F3', 'KAWASAN')
			->setCellValue('G3', 'WITEL')
			->setCellValue('H3', 'C_WITEL')
			->setCellValue('I3', 'C_DATEL_NEW')
			->setCellValue('J3', 'STO')
			->setCellValue('K3', 'CHANEL')
			->setCellValue('L3', 'ALPRO')
			->setCellValue('M3', 'TGL_VA')
			->setCellValue('N3', 'umur')
			->setCellValue('O3', 'cek')
			->setCellValue('P3', 'CGEST')
			->setCellValue('Q3', 'CSEG')
			->setCellValue('R3', 'CCAT')
			->setCellValue('S3', 'LINECATS_FAMILY_LNAME')
			->setCellValue('T3', 'TEMATIK')
			->setCellValue('U3', 'ITEM')
			->setCellValue('V3', 'CPACK')
			->setCellValue('W3', 'PSB')
			->setCellValue('X3', 'CBT')
			->setCellValue('Y3', 'MIG')
			->setCellValue('Z3', 'PRICE_PSB')
			->setCellValue('AA3', 'PRICE_CBT')
			->setCellValue('AB3', 'PRICE_MIG')
			->setCellValue('AC3', 'FLAG_BUNDLING')
			->setCellValue('AD3', 'BUNDLING_2P3P')
			->setCellValue('AE3', 'BUNDLING_STB')
			->setCellValue('AF3', 'BUNDLING_WIFIEXT')
			->setCellValue('AG3', 'EXTERNAL_ORDER_ID')
			->setCellValue('AH3', 'BUNDLING_INDIBOX')
			->setCellValue('AI3', 'ND_SPEEDY')
			->setCellValue('AJ3', 'KCONTACT')
			->setCellValue('AK3', 'XS6')
			->setCellValue('AL3', 'HASIL')
			->setCellValue('AM3', 'KETERANGAN');

		//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');

		//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
		$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');


		//MEMBUAT COLOR FONT RED A1
		$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getFont()
			->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);


		//WRAP TEST A2
		$objPHPExcel->getActiveSheet()->getStyle('A2')
			->getAlignment()->setWrapText(true);

		//Set Height Row 2
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);


		//SET ALIGNMENT -CENTER-CENTER A1-A2
		$objPHPExcel->getActiveSheet()->getStyle('A1:AM5000')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:AM5000')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


		//MEMBUAT COLOR FONT WHITE A3-D3	
		$objPHPExcel->getActiveSheet()->getStyle('A3:AM3')->getFont()
			->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);


		//BOLD A1
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

		//BOLD A3-D3
		$objPHPExcel->getActiveSheet()->getStyle('A3:AM3')->getFont()->setBold(true);


		//SET WIDTH COLUMN



		//SET COLOR CELL BLACK A3-D3
		$objPHPExcel->getActiveSheet()->getStyle('A3:AM3')->getFill()
			->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
			->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);

		//PROTECTION SHEET
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);

		//UNPROTECT TABLE ISIAN MAX 2000 ROW
		$objPHPExcel->getActiveSheet()->getStyle('A4:AM5000')->getProtection()->setLocked(
			PHPExcel_Style_Protection::PROTECTION_UNPROTECTED
		);

		//membuat border				
		$objPHPExcel->getActiveSheet()->getStyle('A4:AM5000')->applyFromArray($thick);


		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('UPLOAD');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Template_Dapros.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		// } else {
		// 	redirect("Auth");
		// }
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
