<?php
require APPPATH . '/controllers/Report_profiling/Report_profiling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Outbound extends CI_Controller
{
	private $log_key, $log_temp, $title;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Dapros_model', 'tmodel');
		$this->load->model('Custom_model/Trans_helpdesk_model', 'trans_helpdesk');
		$this->load->model('Custom_model/T_handle_time_model', 'T_handle_time_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');

		$this->infomedia = $this->load->database('infomedia', TRUE);
		// $this->log_key ='log_Form_caring';
		$this->title = new Report_profiling_config();
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
		if ($data['userdata']->opt_level == 8) {
			$log_where = array(
				'id_user' => $logindata->id_user,
				'agentid' => $data['userdata']->agentid,
			);
			$log = $this->Sys_log->get_row($log_where, array("id,logout_time"), array("id" => "DESC"));
			if ($log) {
				if ($log->logout_time == '') {
					redirect('Lockscreen', 'refresh');
				}
			}
		}
	}


	function index()
	{

		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$no = 0;
		$data['list_count'] = $this->tmodel->live_query("SELECT COUNT(*) AS hitung FROM dapros_helpdesk_va WHERE agentid='$userdata->agentid' AND (status='0' OR status='1' OR status='2')")->row();
		$data['list_outbound'] = $this->tmodel->live_query("SELECT *,status as v_status from dapros_helpdesk_va WHERE agentid='$userdata->agentid' AND (status='0' OR status='1' OR status='2')")->result();
		$data['list_pending'] = $this->tmodel->live_query("SELECT *,status as v_status from dapros_helpdesk_va WHERE (status='7')")->result();
		$data['list_handle'] = $this->T_handle_time_model->get_results(array("agentid" => $userdata->agentid));
		$data['controller'] = $this;
		$this->template->load('Outbound/List_outbound', $data);
	}



	public function get()
	{

		/* $query1="SELECT COUNT(1) AS jml FROM dbprofile_validate_forcall_3p WHERE update_by='$upd'
							AND `status` in (0,3)"; */
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$query1 = $this->tmodel->live_query("SELECT COUNT(*) AS jml FROM dapros_helpdesk_va WHERE agentid='$userdata->agentid' AND status='0'")->row();
		$jml = $query1->jml;
		// while($rows1 = @mysql_fetch_assoc($result1))@extract($rows1,EXTR_OVERWRITE);

		if ($jml > 100) {
			$onload = "Jumlah data anda,  $jml Anda tidak diperkenankan menambah data";
			print "<script type=\"text/javascript\">alert('$onload');</script>";
			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Outbound/Outbound";
			echo "';
			</script>";
		} else {
			$jml = 100 - $jml;
			$jml = 5;
			$filter = array();
			$filter["(ISNULL(agentid) OR agentid = '' )"] = null;
			$filter['status'] = 0;
			$data_insert = array(
				"agentid" => $userdata->agentid,
				"petugas" => $userdata->nama,
				"tgl_distribution" => date('Y-m-d H:i:s'),
			);

			$this->tmodel->edit($filter, $data_insert, $jml);
			$onload = "Penambahan $jml data Work Order sukses";

			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Outbound/Outbound";
			echo "';
			</script>";
		}
	}

	function set_session()
	{
		$random_char = 1;
		$characters = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		$keys = array();
		while (count($keys) < 8) {
			$x = mt_rand(0, count($characters) - 1);
			if (!in_array($x, $keys)) {
				$keys[] = $x;
			}
		}
		foreach ($keys as $key) {
			$random_char .= $characters[$key];
		}
		$today = date('mdH');
		$var_tiket = $today . $random_char;

		return $var_tiket;
	}
	public function insertdata()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$id = $val['id'];
		$o = new Outputview();
		$lup = date("Y-m-d H:i:s");
		$random_num = $this->set_session();
		$status = 0;
		$pc = $_SERVER['REMOTE_ADDR'];

		///////reguler/////

		if ($userdata->agentid != NULL) {
			$data_status = array("VA" => 1, "PI" => 2, "PS" => 3, "CA" => 4, "CLEANSING" => 5, "BACK TO INPUTER" => 6, "PENDING" => 7);
			if (isset($val['id'])) {
				$data1 = array(
					'id_dapros'	=>  $val['id'],
					'click_time'	=>  $val['click_time'],
					'reason_va'	=>  $val['reason_va'],
					'veri_call'	=>  $data_status[$val['veri_call']],
					'veri_upd'	=>  $userdata->agentid,
					'lup'	=>  $lup,
					'ip_address'	=>  $pc
				);
				// if ($data_status[$val['veri_call']] > 2) {
				// 	$data_insert = array(
				// 		"agentid" => $userdata->agentid,
				// 		"id_user" => $logindata->id_user,
				// 		"id_proses" => $val['id']
				// 	);
				// 	$n=$this->T_handle_time_model->delete($data_insert);
				// }
				$this->trans_helpdesk->add($data1);
				$success = $this->tmodel->edit(array("id" => $val['id']), array('reason_va'	=>  $val['reason_va'], "click_time" => $val['click_time'], "status" => $data_status[$val['veri_call']], "lup" => $lup, "veri_call" => $data_status[$val['veri_call']], "veri_upd" => $userdata->agentid));

				if ($success) {

					$o->success = 'true';
					$o->message = "Status Work Order Berhasil Dirubah";
					$o->elementid = '#input-nama-user';
					echo $o->result();
				} else {
					$o->success = 'false';
					$o->message = "Opps..gagal";
					$o->elementid = '';
					echo $o->result();
				}
			} else {
				$val	= $this->input->post();
				$data_insert = array(
					"EXTERNAL_ORDER_ID" => $val['EXTERNAL_ORDER_ID'],
					"ND_SPEEDY" => $val['ND_SPEEDY'],
					"NDEM" => $val['NDEM'],
					"ADDON" => $val['ADDON'],
					"KAWASAN" => $val['KAWASAN'],
					"WITEL" => $val['WITEL'],
					"CHANEL" => $val['CHANEL'],
					"TGL_VA" => $lup,
					"umur" => 0,
					"ITEM" => $val['ITEM'],
					"CPACK" => $val['CPACK'],
					"STATUS_SC" => $val['STATUS_SC'],
					"sumber" => $val['sumber'],
					"status" => 0,
					"agentid" => $userdata->agentid,
					"petugas" => $userdata->nama,
					'reason_va'	=>  $val['reason_va'],
					"tgl_distribution" => date('Y-m-d H:i:s'),
				);
				$insert_id = $this->tmodel->add($data_insert);
				$cek_handle = $this->T_handle_time_model->get_count(array("id_proses" => $insert_id, "agentid" => $userdata->agentid));

				if ($cek_handle == 0) {
					$data_insert = array(
						"proses_time" => date('Y-m-d H:i:s'),
						"agentid" => $userdata->agentid,
						"id_user" => $logindata->id_user,
						"id_proses" => $insert_id,
						"EXTERNAL_ORDER_ID" => $val['EXTERNAL_ORDER_ID']
					);
					$this->T_handle_time_model->add($data_insert);
				}
				redirect(site_url() . 'Outbound/Outbound');
			}
		}
	}
	public function add()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $userdata;

		$this->load->view('Outbound/Form_add_outbound', $data);
	}
	public function edit()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $userdata;
		$nd   = $this->input->get('order_id');
		$id   = $this->input->get('id');

		// $data['agent'] = $this->tmodel->live_query('SELECT * FROM Form_caring')->result_array();
		// $data['agentcount'] = $this->tmodel->live_query('SELECT COUNT(*) FROM Form_caring');

		$today = date('Y-m-d') . " 00:00:01";
		$vtoday = date('Y-m-d') . " 23:59:01";
		$data['datanya'] = $this->tmodel->live_query("SELECT * FROM  dapros_helpdesk_va WHERE id='$id'")->row();
		$data['history'] = $this->tmodel->live_query("SELECT * FROM  trans_helpdesk WHERE id_dapros='$id'")->result();
		
		if ($data['datanya']->status > 2 && $data['datanya']->status != 7 ) {
			$del_stat = $this->T_handle_time_model->delete(array("id_proses" => $id, "agentid" => $userdata->agentid));
		} else {
			$cek_handle = $this->T_handle_time_model->get_count(array("id_proses" => $id, "agentid" => $userdata->agentid));

			if ($cek_handle == 0) {
				$data_insert = array(
					"proses_time" => date('Y-m-d H:i:s'),
					"agentid" => $userdata->agentid,
					"id_user" => $logindata->id_user,
					"id_proses" => $id,
					"EXTERNAL_ORDER_ID" => $nd
				);
				$this->T_handle_time_model->add($data_insert);
			}
			$this->load->view('Outbound/Form_outbound', $data);
		}

		// var_dump($data['datanya']);

	}
	function delete_tab()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $userdata;
		$id = $this->input->get("id");

		$data_insert = array(
			"agentid" => $userdata->agentid,
			"id_user" => $logindata->id_user,
			"id_proses" => $id
		);
		$this->T_handle_time_model->delete($data_insert);
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/