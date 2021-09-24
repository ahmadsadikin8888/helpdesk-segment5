<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */

// require APPPATH . "/reports/Wallboard_wfh.php";

class Dashboard_v2 extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
  }

  public function wallboard_reguler_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }

    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg_v2', $data);
  }
  public function wallboard_wfh_v2()
  {
    $data = array();
    $report = new Wallboard_wfh;
    $data['report'] = $report->run();

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_wfh_v2', $data);
  }
  public function wallboard_grafik_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }

    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_grafik_v2', $data);
  }
  public function wallboard_moss_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_moss_v2', $data);
  }
  public function dashboard()
  {

    $view = 'front-end/landing-page/dashboard_v2/dashboard';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['TLLM'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLM"));
    $data['TLRGA'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLRGA"));
    $data['TLAMR'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLAMR"));
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $this->template->load($view, $data);
  }
  public function wallboard_verified()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $start = $data['start'];
    $end = $data['end'];
    $reguler = $this->trans_profiling->live_query(
      "SELECT count(*) as jumlah,DATE(lup) as day_lup FROM trans_profiling_verifikasi WHERE DATE(lup) >= '" . $start . "' AND DATE(lup) <= '" . $end . "' GROUP BY day_lup "
    );
    $moss = $this->trans_profiling->live_query(
      "SELECT count(*) as jumlah,DATE(lup) as day_lup FROM trans_profiling_validasi_mos 
      WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end' AND reason_call=13 GROUP BY day_lup
      "
    );
    $data['reg']=$reguler->result_array();
    
    $data['moss']=$moss->result_array();
    
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_verified', $data);
  }
  public function wallboard_telkom()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }


    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_telkom', $data);
  }
  public function realtime_monev()
  {

    $view = 'front-end/landing-page/dashboard_v2/realtime_monev';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
    $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "AR180293"));
    $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLATEU"));
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $this->template->load($view, $data);
  }
  public function wallboard_reguler()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['bulan'])) {
      $data['bulan'] = $_GET['bulan'];
    } else {
      $data['bulan'] = 5;
    }

    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg_v1', $data);
  }
  public function wallboard_moss()
  {
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    if (isset($_GET['bulan'])) {
      $data['bulan'] = $_GET['bulan'];
    } else {
      $data['bulan'] = $data['bulan'] = 5;;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_moss_v1', $data);
  }
}
