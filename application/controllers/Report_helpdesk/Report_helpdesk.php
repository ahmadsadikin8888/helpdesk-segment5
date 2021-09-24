<?php
require APPPATH . '/controllers/Report_helpdesk/Report_profiling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_helpdesk extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Dapros_model', 'dapros');
		$this->load->model('Custom_model/Trans_helpdesk_model', 'trans_helpdesk');
		$this->title = new Report_profiling_config();
	}


	public function index()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data = array(
			'title_page_big'		=> 'Report Helpdesk',
		);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if (isset($_GET['start'])) {
			$data['start'] = $_GET['start'];
			$data['end'] = $_GET['end'];
		} else {
			$data['start'] = date('Y-m-d');
			$data['end'] = date('Y-m-d');
		}
		$start = $data['start'];
		$end = $data['end'];
		$filter_agent_ci = array('opt_level' => 8);
		if ($userdata->opt_level == 8) {
			$filter_agent = " AND agentid = '" . $userdata->agentid . "'";
			$filter_agent_ci['agentid'] = $userdata->agentid;
		}
		$data['agent'] = $this->Sys_user_table_model->get_results($filter_agent_ci);
		$channel = "";
		// echo "<br>";
		$response['dapros'] = $this->dapros->get_count(array("status" => 0, "(ISNULL(agentid) OR agentid = '' )" => NULL));
		$response['wo'] = $this->dapros->get_count(array("status" => 0, "(agentid <> '' )" => NULL, "DATE(tgl_distribution) >=" => $data['start'], "DATE(tgl_distribution) <=" => $data['end']));
		$response['oc'] = $this->trans_helpdesk->get_count(array("DATE(lup) >=" => $data['start'], "DATE(lup) <=" => $data['end']));
		$response['va'] = $this->dapros->get_count(array("status" => 1, "DATE(lup) >=" => $data['start'], "DATE(lup) <=" => $data['end']));
		$response['pi'] = $this->dapros->get_count(array("status" => 2, "DATE(lup) >=" => $data['start'], "DATE(lup) <=" => $data['end']));
		$response['ps'] = $this->dapros->get_count(array("status" => 3, "DATE(lup) >=" => $data['start'], "DATE(lup) <=" => $data['end']));

		$response['by_petugas'] = $this->dapros->live_query("SELECT agentid,count(*) as numna FROM dapros_helpdesk_va WHERE status = 3 AND DATE(lup)>='$start' AND DATE(lup)<='$end' $filter_agent GROUP BY agentid ")->result();
		$response['by_addon'] = $this->dapros->live_query("SELECT ADDON,count(*) as numna FROM `dapros_helpdesk_va` WHERE `status` = 3 AND DATE(lup)>='$start' AND DATE(lup)<='$end' $filter_agent GROUP BY ADDON ")->result();
		$response['chanel_petugas'] = $this->dapros->live_query("
		SELECT
	dapros_helpdesk_va.agentid,
	IF(channel.sub_channel IS NULL , 'OTHERS', channel.sub_channel ) AS channelna,
	STATUS,
	count(*) AS numna 
FROM
	dapros_helpdesk_va 
	LEFT JOIN channel ON channel.channel = dapros_helpdesk_va.CHANEL
WHERE
	dapros_helpdesk_va.STATUS > 0 
	AND dapros_helpdesk_va.sumber = 'VA'  AND
		 DATE(lup)>='$start' AND DATE(lup)<='$end' $filter_agent GROUP BY 
		 dapros_helpdesk_va.agentid,
		 channel.sub_channel,
	 dapros_helpdesk_va.STATUS
	  ")->result();
		$response['chanel_error_petugas'] = $this->dapros->live_query("SELECT agentid,STATUS,count(*) as numna FROM `dapros_helpdesk_va` WHERE status > 0 AND DATE(lup)>='$start' AND DATE(lup)<='$end' AND sumber = 'ERROR'  $filter_agent GROUP BY agentid,status ")->result();
		$response['chanel_hvc_petugas'] = $this->dapros->live_query("SELECT STATUS,count(*) as numna FROM `dapros_helpdesk_va` WHERE status > 0 AND DATE(lup)>='$start' AND DATE(lup)<='$end' AND sumber = 'HVC'  $filter_agent GROUP BY status ")->result();
		$response['status_petugas'] = $this->dapros->live_query("SELECT agentid,STATUS,count(*) as numna FROM `dapros_helpdesk_va` WHERE status > 0 AND DATE(lup)>='$start' AND DATE(lup)<='$end' $filter_agent GROUP BY agentid,status ")->result();
		$response['wo_petugas'] = $this->dapros->live_query("SELECT agentid,count(*) as numna FROM `dapros_helpdesk_va` WHERE agentid <> '' AND DATE(tgl_distribution)>='$start' AND DATE(tgl_distribution)<='$end' GROUP BY agentid ")->result();
		$response['aht'] = $this->dapros->live_query("SELECT AVG(TIMESTAMPDIFF(SECOND,  click_time,lup)) as aht FROM `trans_helpdesk` WHERE veri_call=3 AND DATE(lup)>='$start' AND DATE(lup)<='$end'")->row()->aht;
		$response['aht'] = number_format(($response['aht'] / 60), 2);
		$response['aht_persen'] = (($response['aht'] / 60) / (60 * 24) * 100);
		$response['wona'] = array();
		if (count($response['wo_petugas']) > 0) {
			foreach ($response['wo_petugas'] as $dwo) {
				$response['wona'][$dwo->agentid] = $dwo->numna;
			}
		}
		$td['byna'] = array();
		if (count($response['by_petugas']) > 0) {
			foreach ($response['by_petugas'] as $dwo) {
				$td['byna'][$dwo->agentid] = $dwo->numna;
			}
		}
		arsort($td['byna']);
		$response['byna'] = array_slice($td['byna'], 0, 5);
		$response['last_update'] = $this->trans_helpdesk->get_row(array(), array("*"), array("lup" => "DESC"));
		$response['all_agent'] = $data['agent']['num'];
		$response['agent'] = $data['agent'];
		$response['start'] = $data['start'];
		$response['end'] = $data['end'];
		$this->template->load('Report_helpdesk/Report_helpdesk_list', $response);
	}
};
