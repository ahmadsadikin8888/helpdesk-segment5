<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		// $this->load->model('Custom_model/Trans_profiling_model', 'trans_profiling');
		$this->load->model('Custom_model/App_tam_data2_model', 'app_tam_data2');
	}




	////render by ajax
	public function index()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		$data = array(
			'title_page_big'		=> 'Report',
			'title'					=> "Report " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8);
		if ($userdata->opt_level == 8) {
			$filter_agent = array("login" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$where_agent = array("opt_level" => 8);




			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}
			$data['user_categori'] = '-';
			if ($userdata->opt_level == 8) {
				$filter_agent = array("agentid" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 9) {
				$filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 7) {
				// $filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
				$where_agent = array("opt_level" => 8);
			}

			$data['list_agent'] = $this->sys_user->get_results($filter_agent);
			$filter_agent = "";

			if (isset($agentid)) {

				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (login = '$v_agentid'";
								$filter_agent_veri = " AND (login = '$v_agentid'";
								$where_agent_multi = "( login = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR login = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR login = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {

						if ($agentid[0] != '0') {
							// echo $agentid[0];
							$where_agent['login'] = $agentid[0];
							$filter_agent = " AND login = '$agentid[0]'";
							$filter_agent_veri = " AND login = '$agentid[0]'";
						}
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}

			$agent = $this->sys_user->get_results($where_agent, array("*"));
			$query_trans_profiling = $this->app_tam_data2->live_query(
				"SELECT * FROM app_tam_data2 
				WHERE DATE_FORMAT(tgl ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(tgl,'%Y-%m-%d') <= '$end_filter'
				AND jenis = 'CT0'
				$filter_agent
				"
			);
			$query_trans_profiling_pra = $this->app_tam_data2->live_query(
				"SELECT * FROM app_tam_data2 
				WHERE DATE_FORMAT(tgl ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(tgl,'%Y-%m-%d') <= '$end_filter'
				AND jenis = 'PRA NPC'
				$filter_agent
				"
			);

			$no = 1;
			$total = array();
			$total['contacted'] = 0;
			$total['uncontacted'] = 0;
			$total['agent_online'] = 0;
			$total['ct0']['duty'] = 0;
			$data_profiling = $query_trans_profiling->result_array();
			$data_profiling_pra = $query_trans_profiling_pra->result_array();
			// $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();
			$regional = array("I", "II", "III", "IV", "V", "VI", "VII");
			foreach ($regional as $rg) {
				$data['regional'][$rg] = count($this->filter_by_value($data_profiling, 'reg', $rg)) + count($this->filter_by_value($data_profiling_pra, 'reg', $rg));
			}
			if ($agent['num'] > 0) {
				foreach ($agent['results'] as $ag) {
					$data['agent'][$ag->agentid]['data'] = $ag;

					$data_agent = $this->filter_by_value($data_profiling, 'login', $ag->login);
					$contacted = $this->filter_by_value($data_agent, 'status', 'Contacted');
					$uncontacted = $this->filter_by_value($data_agent, 'status', 'Not Contacted');
					$agree = count($this->filter_by_value($contacted, 'kategori', 'Agree'));
					$followup = count($this->filter_by_value($contacted, 'kategori', 'Follow UP'));
					$decline = count($this->filter_by_value($contacted, 'kategori', 'Decline'));
					$dc1 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon Tidak Diangkat - RNA'));
					$dc2 = count($this->filter_by_value($uncontacted, 'kategori', 'Line Busy'));
					$dc3 = count($this->filter_by_value($uncontacted, 'kategori', 'Invalid Phone Number'));
					$dc4 = count($this->filter_by_value($uncontacted, 'kategori', 'Call Rejected'));
					$dc5 = count($this->filter_by_value($uncontacted, 'kategori', 'Mail Box - Memo'));
					$dc6 = count($this->filter_by_value($uncontacted, 'kategori', 'Fax - Modem'));
					$dc7 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon Isolir'));
					$dc8 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon salah sambung'));
					$dc9 = count($this->filter_by_value($uncontacted, 'kategori', 'NO USAGE (TIDAK AKAN DIMASUKKAN PROSPEK KEMUDIAN)'));
					$data['agent']['total'] = 0;

					$data['agent'][$ag->agentid]['sub_total_contacted'] = $data['agent'][$ag->agentid]['sub_total_contacted'] + count($contacted);
					$data['agent'][$ag->agentid]['sub_total_uncontacted'] = $data['agent'][$ag->agentid]['sub_total_uncontacted'] + count($uncontacted);
					$data['agent'][$ag->agentid]['agree'] = $data['agent'][$ag->agentid]['agree'] + $agree;
					$data['agent'][$ag->agentid]['followup'] = $data['agent'][$ag->agentid]['followup'] + $followup;
					$data['agent'][$ag->agentid]['decline'] = $data['agent'][$ag->agentid]['decline'] + $decline;
					$data['agent'][$ag->agentid]['dc1'] = $data['agent'][$ag->agentid]['dc1'] + $dc1;
					$data['agent'][$ag->agentid]['dc2'] = $data['agent'][$ag->agentid]['dc2'] + $dc2;
					$data['agent'][$ag->agentid]['dc3'] = $data['agent'][$ag->agentid]['dc3'] + $dc3;
					$data['agent'][$ag->agentid]['dc4'] = $data['agent'][$ag->agentid]['dc4'] + $dc4;
					$data['agent'][$ag->agentid]['dc5'] = $data['agent'][$ag->agentid]['dc5'] + $dc5;
					$data['agent'][$ag->agentid]['dc6'] = $data['agent'][$ag->agentid]['dc6'] + $dc6;
					$data['agent'][$ag->agentid]['dc7'] = $data['agent'][$ag->agentid]['dc7'] + $dc7;
					$data['agent'][$ag->agentid]['dc8'] = $data['agent'][$ag->agentid]['dc8'] + $dc8;
					$data['agent'][$ag->agentid]['dc9'] = $data['agent'][$ag->agentid]['dc9'] + $dc9;
					$total['contacted'] = $total['contacted'] + $data['agent'][$ag->agentid]['sub_total_contacted'];
					$total['uncontacted'] = $total['uncontacted'] + $data['agent'][$ag->agentid]['sub_total_uncontacted'];
					$total['cto']['agree'] = $total['cto']['agree'] + $agree;
					$total['cto']['followup'] = $total['cto']['followup'] + $followup;
					$total['cto']['decline'] = $total['cto']['decline'] + $decline;
					$total['cto']['dc1'] = $total['cto']['dc1'] + $dc1;
					$total['cto']['dc2'] = $total['cto']['dc2'] + $dc2;
					$total['cto']['dc3'] = $total['cto']['dc3'] + $dc3;
					$total['cto']['dc4'] = $total['cto']['dc4'] + $dc4;
					$total['cto']['dc5'] = $total['cto']['dc5'] + $dc5;
					$total['cto']['dc6'] = $total['cto']['dc6'] + $dc6;
					$total['cto']['dc7'] = $total['cto']['dc7'] + $dc7;
					$total['cto']['dc8'] = $total['cto']['dc8'] + $dc8;
					$total['cto']['dc9'] = $total['cto']['dc9'] + $dc9;
					$total['agree'] = $total['agree'] + $agree;
					$total['followup'] = $total['followup'] + $followup;
					$total['decline'] = $total['decline'] + $decline;
					$total['dc1'] = $total['dc1'] + $dc1;
					$total['dc2'] = $total['dc2'] + $dc2;
					$total['dc3'] = $total['dc3'] + $dc3;
					$total['dc4'] = $total['dc4'] + $dc4;
					$total['dc5'] = $total['dc5'] + $dc5;
					$total['dc6'] = $total['dc6'] + $dc6;
					$total['dc7'] = $total['dc7'] + $dc7;
					$total['dc8'] = $total['dc8'] + $dc8;
					$total['dc9'] = $total['dc9'] + $dc9;
					if ($data['agent'][$ag->agentid]['sub_total_contacted'] > 0 || $$data['agent'][$ag->agentid]['sub_total_uncontacted'] > 0) {
						$total['cto']['duty']++;
						$total['duty']++;
					}


					$data_agent = $this->filter_by_value($data_profiling_pra, 'login', $ag->login);
					$contacted = $this->filter_by_value($data_agent, 'status', 'Contacted');
					$uncontacted = $this->filter_by_value($data_agent, 'status', 'Not Contacted');
					$agree = count($this->filter_by_value($contacted, 'kategori', 'Agree'));
					$followup = count($this->filter_by_value($contacted, 'kategori', 'Follow UP'));
					$decline = count($this->filter_by_value($contacted, 'kategori', 'Decline'));
					$dc1 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon Tidak Diangkat - RNA'));
					$dc2 = count($this->filter_by_value($uncontacted, 'kategori', 'Line Busy'));
					$dc3 = count($this->filter_by_value($uncontacted, 'kategori', 'Invalid Phone Number'));
					$dc4 = count($this->filter_by_value($uncontacted, 'kategori', 'Call Rejected'));
					$dc5 = count($this->filter_by_value($uncontacted, 'kategori', 'Mail Box - Memo'));
					$dc6 = count($this->filter_by_value($uncontacted, 'kategori', 'Fax - Modem'));
					$dc7 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon Isolir'));
					$dc8 = count($this->filter_by_value($uncontacted, 'kategori', 'Telepon salah sambung'));
					$dc9 = count($this->filter_by_value($uncontacted, 'kategori', 'NO USAGE (TIDAK AKAN DIMASUKKAN PROSPEK KEMUDIAN)'));
					$data['agent']['total'] = 0;

					$data['agent'][$ag->agentid]['sub_total_contacted'] = $data['agent'][$ag->agentid]['sub_total_contacted'] + count($contacted);
					$data['agent'][$ag->agentid]['sub_total_uncontacted'] = $data['agent'][$ag->agentid]['sub_total_uncontacted'] + count($uncontacted);
					$data['agent'][$ag->agentid]['agree'] = $data['agent'][$ag->agentid]['agree'] + $agree;
					$data['agent'][$ag->agentid]['followup'] = $data['agent'][$ag->agentid]['followup'] + $followup;
					$data['agent'][$ag->agentid]['decline'] = $data['agent'][$ag->agentid]['decline'] + $decline;
					$data['agent'][$ag->agentid]['dc1'] = $data['agent'][$ag->agentid]['dc1'] + $dc1;
					$data['agent'][$ag->agentid]['dc2'] = $data['agent'][$ag->agentid]['dc2'] + $dc2;
					$data['agent'][$ag->agentid]['dc3'] = $data['agent'][$ag->agentid]['dc3'] + $dc3;
					$data['agent'][$ag->agentid]['dc4'] = $data['agent'][$ag->agentid]['dc4'] + $dc4;
					$data['agent'][$ag->agentid]['dc5'] = $data['agent'][$ag->agentid]['dc5'] + $dc5;
					$data['agent'][$ag->agentid]['dc6'] = $data['agent'][$ag->agentid]['dc6'] + $dc6;
					$data['agent'][$ag->agentid]['dc7'] = $data['agent'][$ag->agentid]['dc7'] + $dc7;
					$data['agent'][$ag->agentid]['dc8'] = $data['agent'][$ag->agentid]['dc8'] + $dc8;
					$data['agent'][$ag->agentid]['dc9'] = $data['agent'][$ag->agentid]['dc9'] + $dc9;
					$total['contacted'] = $total['contacted'] + $data['agent'][$ag->agentid]['sub_total_contacted'];
					$total['uncontacted'] = $total['uncontacted'] + $data['agent'][$ag->agentid]['sub_total_uncontacted'];
					$total['pranpc']['agree'] = $total['pranpc']['agree'] + $agree;
					$total['pranpc']['followup'] = $total['pranpc']['followup'] + $followup;
					$total['pranpc']['decline'] = $total['pranpc']['decline'] + $decline;
					$total['pranpc']['dc1'] = $total['pranpc']['dc1'] + $dc1;
					$total['pranpc']['dc2'] = $total['pranpc']['dc2'] + $dc2;
					$total['pranpc']['dc3'] = $total['pranpc']['dc3'] + $dc3;
					$total['pranpc']['dc4'] = $total['pranpc']['dc4'] + $dc4;
					$total['pranpc']['dc5'] = $total['pranpc']['dc5'] + $dc5;
					$total['pranpc']['dc6'] = $total['pranpc']['dc6'] + $dc6;
					$total['pranpc']['dc7'] = $total['pranpc']['dc7'] + $dc7;
					$total['pranpc']['dc8'] = $total['pranpc']['dc8'] + $dc8;
					$total['pranpc']['dc9'] = $total['pranpc']['dc9'] + $dc9;
					$total['agree'] = $total['agree'] + $agree;
					$total['followup'] = $total['followup'] + $followup;
					$total['decline'] = $total['decline'] + $decline;
					$total['dc1'] = $total['dc1'] + $dc1;
					$total['dc2'] = $total['dc2'] + $dc2;
					$total['dc3'] = $total['dc3'] + $dc3;
					$total['dc4'] = $total['dc4'] + $dc4;
					$total['dc5'] = $total['dc5'] + $dc5;
					$total['dc6'] = $total['dc6'] + $dc6;
					$total['dc7'] = $total['dc7'] + $dc7;
					$total['dc8'] = $total['dc8'] + $dc8;
					$total['dc9'] = $total['dc9'] + $dc9;
					if ($data['agent'][$ag->agentid]['sub_total_contacted'] > 0 || $$data['agent'][$ag->agentid]['sub_total_uncontacted'] > 0) {
						$total['pranpc']['duty']++;
						$total['duty']++;
					}


					$no++;
				}
			}
		}
		$data['total'] = $total;
		$data['level'] = $userdata->opt_level;
		$this->template->load('Report/Report_profiling_list', $data);
	}
	public function report_qc()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		$data = array(
			'title_page_big'		=> 'Report',
			'title'					=> "Report " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8);
		if ($userdata->opt_level == 8) {
			$filter_agent = array("login" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$where_agent = array("opt_level" => 8);




			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}
			$data['user_categori'] = '-';
			if ($userdata->opt_level == 8) {
				$filter_agent = array("agentid" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 9) {
				$filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 7) {
				// $filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
				$where_agent = array("opt_level" => 8);
			}

			$data['list_agent'] = $this->sys_user->get_results($filter_agent);
			$filter_agent = "";

			if (isset($agentid)) {

				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (app_tam_data2.login = '$v_agentid'";
								$filter_agent_veri = " AND (login = '$v_agentid'";
								$where_agent_multi = "( login = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR app_tam_data2.login = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR app_tam_data2.login = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {

						if ($agentid[0] != '0') {
							// echo $agentid[0];
							$where_agent['login'] = $agentid[0];
							$filter_agent = " AND app_tam_data2.login = '$agentid[0]'";
							$filter_agent_veri = " AND login = '$agentid[0]'";
						}
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}

			$agent = $this->sys_user->get_results($where_agent, array("*"));
			$query_trans_profiling = $this->app_tam_data2->live_query(
				"SELECT app_tam_data2.*,agent.name as nama_agent,qco.name as nama_qco FROM app_tam_data2 
				LEFT JOIN cc147_main_users as agent ON agent.user_id = app_tam_data2.login
				LEFT JOIN cc147_main_users as qco ON agent.user_id = app_tam_data2.upd_qco
				WHERE DATE_FORMAT(app_tam_data2.tgl_qco1 ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(app_tam_data2.tgl_qco1,'%Y-%m-%d') <= '$end_filter'
				AND app_tam_data2.kategori = 'Agree'
				AND app_tam_data2.upd_qco != ''
				$filter_agent
				"
			);
			$no = 1;
			$total = array();
			$data['data_result'] = $query_trans_profiling->result_array();
			// $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();

			
		}
		$this->template->load('Report/Report_qc_list', $data);
	}

	function get_data_list()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$where_agent = array("opt_level" => 8);
			$filter_agent = "";

			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}

			if (isset($agentid)) {
				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND ( login = '$v_agentid'";
								$filter_agent_veri = " AND ( login = '$v_agentid'";
								$where_agent_multi = "( login = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR login = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR login = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR login = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR login = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['login'] = $agentid[0];
						$filter_agent = " AND login = '$agentid[0]'";
						$filter_agent_veri = " AND login = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			$data['agent'] = $this->sys_user->get_results($where_agent, array("*"));
			$filter = array();
			$data['query_trans_profiling'] = $this->app_tam_data2->live_query(
				"SELECT * FROM app_tam_data2 
				WHERE DATE_FORMAT(tgl ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(tgl ,'%Y-%m-%d') <= '$end_filter'
				$filter_agent
				"
			);
			// $data['query_trans_profiling_verifikasi'] = $this->trans_profiling_verifikasi->live_query(
			// 	"SELECT update_by,no_handpone,email FROM trans_profiling_verifikasi 
			// 	WHERE DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
			// 	AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter'
			// 	$filter_agent_veri
			// 	"
			// );
		}
		$this->load->view('Report/list_area', $data);
	}

	function download_excel()
	{

		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');

		if (isset($_GET['start']) && isset($_GET['end'])) {

			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8);
			$filter_agent = "";

			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);
			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			if ($userdata->opt_level == 8) {
				$agentid = $userdata->agentid;
			}

			if (isset($agentid)) {

				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (trans_profiling.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['agentid'] = $agentid[0];
						$filter_agent = " AND trans_profiling.veri_upd = '$agentid[0]'";
						$filter_agent_veri = " AND update_by = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));
			$filter = array();
			$data['query_trans_profiling'] = $this->trans_profiling->live_query(
				"SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
				WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') <= '$end_filter'
				$filter_agent
				-- AND trans_profiling.veri_status <> 13
				"
			);
			// $data['query_trans_profiling_verifikasi'] = $this->trans_profiling_verifikasi->live_query(
			// 	"SELECT update_by,no_handpone,email FROM trans_profiling_verifikasi 
			// 	WHERE DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
			// 	AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter'
			// 	$filter_agent_veri
			// 	"
			// );
			$this->download_excel_profiling($data);
		}
	}
	private function download_excel_profiling($data)
	{


		$no = 1;
		$total = array();
		$total['contacted'] = 0;
		$total['uncontacted'] = 0;
		$total['hp_email'] = 0;
		$total['hp_only'] = 0;
		$total['agent_online'] = 0;
		for ($i = 1; $i < 16; $i++) {
			$total[$i] = 0;
		}
		if ($data['agent']['num'] > 0) {
			$sub_total_contacted = 0;
			$sub_total_uncontacted = 0;
			$this->load->library("PHPExcel");
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Infomedia")
				->setLastModifiedBy("Infomedia")
				->setTitle("Office 2007 XLSX Test Document")
				->setSubject("Office 2007 XLSX Test Document")
				->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
				->setKeywords("office 2007 openxml php")
				->setCategory("Test result file");


			//========================================//
			/* 	 MEMBUAT TABLE ISIAN PADA COLUMN A1	  */
			//========================================//					 

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Nama Agent')
				->setCellValue('C1', 'Agent ID')
				->setCellValue('D1', 'Contacted')
				->setCellValue('K1', 'Not Contacted');

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D2', 'BP')
				->setCellValue('E2', 'Verified')
				->setCellValue('F2', 'TBP')
				->setCellValue('G2', 'FLUP')
				->setCellValue('H2', 'Sub Total')
				->setCellValue('I2', 'Hp & Email')
				->setCellValue('J2', 'Hp Only')
				->setCellValue('K2', 'RNA')
				->setCellValue('L2', 'SS')
				->setCellValue('M2', 'Isolir')
				->setCellValue('N2', 'Decline')
				->setCellValue('O2', 'Reject')
				->setCellValue('P2', 'Lain Reject')
				->setCellValue('Q2', 'Sub Total');

			//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
			$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
			$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');

			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('D1:J1');
			$objPHPExcel->getActiveSheet()->mergeCells('K1:Q1');

			// //MEMBUAT COLOR FONT WHITE A3-D3	
			// $objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFont()
			// 	->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

			//BOLD G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFont()->setBold(true);

			//SET COLOR CELL BLACK A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFill()
				->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
				->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);



			//========================================//
			/* 	 END TABLE ISIAN PADA COLUMN A1	  */
			//========================================//
			$i_excel = 3;
			foreach ($data['agent']['results'] as $ag) {

				$data_agent = $this->filter_by_value($data['query_trans_profiling']->result_array(), 'veri_upd', $ag->agentid);
				$status_1 = count($this->filter_by_value($data_agent, 'veri_call', '1'));
				// $verified = $this->filter_by_value($data['query_trans_profiling_verifikasi']->result_array(), 'update_by', $ag->agentid);

				$verified = $this->filter_by_value($data_agent, 'veri_call', '13');
				$status_3 = count($this->filter_by_value($data_agent, 'veri_call', '3'));
				$status_12 = count($this->filter_by_value($data_agent, 'veri_call', '12'));
				$status_2 = count($this->filter_by_value($data_agent, 'veri_call', '2'));
				$status_4 = count($this->filter_by_value($data_agent, 'veri_call', '4'));
				$status_7 = count($this->filter_by_value($data_agent, 'veri_call', '7'));
				$status_11 = count($this->filter_by_value($data_agent, 'veri_call', '11'));
				$status_10 = count($this->filter_by_value($data_agent, 'veri_call', '10'));
				$status_14 = count($this->filter_by_value($data_agent, 'veri_call', '14'));
				$sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12;
				$sub_total_uncontacted = $status_4 + $status_7 + $status_11 + $status_10 + $status_14 + $status_2;
				$total['contacted'] = $total['contacted'] + $sub_total_contacted;
				$total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
				$hp_email = $this->filter_by_hp_email($verified, array("handphone", "email"), array("08", "@"));
				$hp_only = $this->filter_by_hp_only($verified, array("handphone", "email"), array("08", "@"));
				$total['hp_email'] = $total['hp_email'] + count($hp_email);
				$total['hp_only'] = $total['hp_only'] + count($hp_only);
				$total[1] = $status_1 + $total[1];
				$total[2] = $status_2 + $total[2];
				$total[3] = $status_3 + $total[3];
				$total[4] = $status_4 + $total[4];
				$total[5] = $status_5 + $total[5];
				$total[6] = $status_6 + $total[6];
				$total[7] = $status_7 + $total[7];
				$total[8] = $status_8 + $total[8];
				$total[9] = $status_9 + $total[9];
				$total[10] = $status_10 + $total[10];
				$total[11] = $status_11 + $total[11];
				$total[12] = $status_12 + $total[12];
				$total[13] = count($verified) + $total[13];
				$total[14] = $status_14 + $total[14];
				$total[15] = $status_15 + $total[15];
				$total[16] = $status_16 + $total[16];

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A' . $i_excel, $no)
					->setCellValue('B' . $i_excel, $ag->nama)
					->setCellValue('C' . $i_excel, $ag->agentid)
					->setCellValue('D' . $i_excel, number_format($status_1))
					->setCellValue('E' . $i_excel, number_format(count($verified)))
					->setCellValue('F' . $i_excel, number_format($status_3))
					->setCellValue('G' . $i_excel, number_format($status_12))
					->setCellValue('H' . $i_excel, number_format($sub_total_contacted))
					->setCellValue('I' . $i_excel, number_format(count($hp_email)))
					->setCellValue('J' . $i_excel, number_format(count($hp_only)))
					->setCellValue('K' . $i_excel, number_format($status_2))
					->setCellValue('L' . $i_excel, number_format($status_4))
					->setCellValue('M' . $i_excel, number_format($status_7))
					->setCellValue('N' . $i_excel, number_format($status_11))
					->setCellValue('O' . $i_excel, number_format($status_10))
					->setCellValue('P' . $i_excel, number_format($status_14))
					->setCellValue('Q' . $i_excel, number_format($sub_total_uncontacted));
				if ($sub_total_contacted > 0 || $sub_total_uncontacted > 0) {
					$total['agent_online']++;
				}
				$i_excel++;
				$no++;
			}
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A' . $i_excel, 'TOTAL')
				->setCellValue('D' . $i_excel, number_format($total[1]))
				->setCellValue('E' . $i_excel, number_format($total[13]))
				->setCellValue('F' . $i_excel, number_format($total[3]))
				->setCellValue('G' . $i_excel, number_format($total[12]))
				->setCellValue('H' . $i_excel, number_format($total['contacted']))
				->setCellValue('I' . $i_excel, number_format($total['hp_email']))
				->setCellValue('J' . $i_excel, number_format($total['hp_only']))
				->setCellValue('K' . $i_excel, number_format($total[2]))
				->setCellValue('L' . $i_excel, number_format($total[4]))
				->setCellValue('M' . $i_excel, number_format($total[7]))
				->setCellValue('N' . $i_excel, number_format($total[11]))
				->setCellValue('O' . $i_excel, number_format($total[10]))
				->setCellValue('P' . $i_excel, number_format($total[14]))
				->setCellValue('Q' . $i_excel, number_format($total['uncontacted']));


			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A' . $i_excel . ':C' . $i_excel);

			//BOLD G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel . ':Q' . $i_excel)->getFont()->setBold(true);

			//MEMBUAT BORDER TABLE
			$thick = array();
			$thick['borders'] = array();
			$thick['borders']['allborders'] = array();
			$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q' . $i_excel)->applyFromArray($thick);

			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('REPORT');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Report_profiling.xls"');
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
		}
	}
	function filter_by_value($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				$temp[$key] = $array[$key][$index];

				if ($temp[$key] == $value) {
					$newarray[$key] = $array[$key];
				}
			}
		}
		return $newarray;
	}
	function filter_by_hp_email($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				if (is_array($index) && count($index) > 0) {
					$email = 0;
					$handphone = 0;
					foreach ($index as $idx => $idv) {
						$temp[$key] = $array[$key][$idv];

						if ($idv == "email") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {
								$email = 1;
							}
						}
						if ($idv == "handphone") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {

								$handphone = 1;
							}
						}
						if ($email == 1 && $handphone == 1) {
							$newarray[$key] = $array[$key];
						}
					}
				}
			}
		}
		return $newarray;
	}
	function filter_by_hp_only($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				if (is_array($index) && count($index) > 0) {
					$email = 0;
					$handphone = 0;
					foreach ($index as $idx => $idv) {
						$temp[$key] = $array[$key][$idv];

						if ($idv == "email") {
							if ($temp[$key] == '') {
								// if (stripos($temp[$key], $value[$idx]) !== true) {
								$email = 1;
							}
						}
						if ($idv == "handphone") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {

								$handphone = 1;
							}
						}
						if ($email == 1 && $handphone == 1) {
							$newarray[$key] = $array[$key];
						}
					}
				}
			}
		}
		return $newarray;
	}

	function report_dapros()
	{

		$view = 'report_profiling/dapros';
		$data['title_page_big']     =   '';

		$this->template->load($view, $data);
	}
};
