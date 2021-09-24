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

class Monev extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Cache_monev_realtime_model', 'cache_modev_realtime');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Absensi/Absensi_model', 't_absensi');
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/App_tam_data2_model', 'app_tam_data2');
  }
  public function realtime_monev()
  {

    $view = 'monev/realtime_monev';
    $data['title_page_big']     =   '';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    $data['daily'] = $this->agent_peformance();
    $data['absensi'] = $this->agent_status();
    $data['aux'] = $this->agent_aux();

    $data['wfh_num'] = count($data['absensi']['kehadiran']['WFH']);
    $data['wfh_data'] = $data['absensi']['kehadiran']['WFH'];
    $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
    $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
    $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
    $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
    $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
    $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
    $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
    $data['aux_num'] = $data['aux']['num'];
    $data['aux_data'] = $data['aux']['data'];
    $data['aux_detail'] = $data['aux']['detail'];
    $data['aux_all_status'] = $data['aux']['all_status'];

    // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
    $data['idle_data'] = $data['daily']['peformance']['idle'];
    $afk = array();
    //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
    if ($data['logout_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
      $afk = $data['logout_data'];
    }
    if ($data['aux_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
      $afk = array_merge($afk, $data['aux_data']);
    }
    if (count($data['idle_data']) > 0) {
      $afk = array_merge($afk, $data['idle_data']);
    }
    // $data['idle_detail'] = $data['idle_data']['peformance'];
    // $data['idle_data'] = $data['daily']['peformance']['idle'];
    $data['idle_num'] = count($data['idle_data']);
    

    $afk_unix = array_unique($afk);
    $data['aval_num'] = $data['duty_num'] - count($afk_unix);
    $data['agent_status'] = $data['daily']['peformance'];
    $data['ppa_num']=number_format($data['agent_status']['total']['Agree']/$data['duty_num']);
    if($data['agent_status']['total']['Agree'] == 0){
      $data['ppa_num']=0;
    }
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
    $data['cache'] = array(
      'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
      'wfh_num' => $data['cache_monev_realtime']['wfh_num'] - $data['wfh_num'],
      'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
      'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
      'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
      'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
      'aval_num' => $data['cache_monev_realtime']['aval_num'] - $data['aval_num'],
      'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num'],
      'ppa_num' => $data['cache_monev_realtime']['ppa_num'] - $data['ppa_num'],
    );
    
    $this->template->load($view, $data);
    $update_data = array(
      'duty_num' => $data['duty_num'],
      'wfh_num' => $data['wfh_num'],
      'wfo_num' => $data['wfo_num'],
      'offline_num' => $data['offline_num'],
      'logout_num' => $data['logout_num'],
      'aux_num' => $data['aux_num'],
      'aval_num' => $data['aval_num'],
      'idle_num' => $data['idle_num'],
      'ppa_num' => $data['ppa_num'],
      'last_update' => date('Y-m-d H:i:s')
    );
    $this->cache_modev_realtime->edit(array("id" => 1), $update_data);
  }
  public function periode_monev()
  {
    $view = 'monev/periode_monev';
    $data['title_page_big']     =   '';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    $data['daily'] = $this->agent_peformance();
    $data['absensi'] = $this->agent_status();
    $data['aux'] = $this->agent_aux();

    $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
    $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
    $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
    $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
    $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
    $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
    $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
    $data['aux_num'] = $data['aux']['num'];
    $data['aux_data'] = $data['aux']['data'];
    $data['aux_detail'] = $data['aux']['detail'];
    $data['aux_all_status'] = $data['aux']['all_status'];
    $data['aux_total_status'] = $data['aux']['total'];

    // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
    $data['idle_data'] = $data['daily']['peformance']['idle'];
    $afk = array();
    //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
    if ($data['logout_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
      $afk = $data['logout_data'];
    }
    if ($data['aux_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
      $afk = array_merge($afk, $data['aux_data']);
    }
    if (count($data['idle_data']) > 0) {
      $afk = array_merge($afk, $data['idle_data']);
    }
    // $data['idle_detail'] = $data['idle_data']['peformance'];
    // $data['idle_data'] = $data['daily']['peformance']['idle'];
    $data['idle_num'] = count($data['idle_data']);


    $afk_unix = array_unique($afk);
    $data['aval_num'] = $data['duty_num'] - count($afk_unix);
    $data['agent_status'] = $data['daily']['peformance'];
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $data['cache'] = array(
      'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
      'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
      'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
      'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
      'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
      'aval_num' => $data['cache_monev_realtime']['aval_num'] - $data['aval_num'],
      'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num'],
      'ppa_num' => $data['cache_monev_realtime']['ppa_num'] - $data['ppa_num']
    );

    /**********effetive time **********/
    $data['effective_time'] = $this->get_effective_time();

    $data['aht'] = $data['effective_time']['total']['aht_sum'] / $data['effective_time']['total']['aht_count'];

    /**********end effetive time **********/
    $this->template->load($view, $data);
  }
  public function get_effective_time()
  {
    $return = array();
    $return['total']['aht_count'] = 0;
    $return['total']['aht_sum'] = 0;
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
    $query_trans_profiling = $this->trans_profiling_daily->live_query(
      "SELECT veri_call,veri_upd,handphone,email,idx,pstn1,DATE(lup) as date_lup FROM trans_profiling_daily"
    );

    $data_profiling = $query_trans_profiling->result_array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $data_agent = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
        $data_verified = $this->filter_by_value($data_agent, 'veri_call',13);

        $return[$ag->agentid]['calling'] = $this->get_recording($data_agent);
        $return[$ag->agentid]['call_count'] = array_sum(array_column($return[$ag->agentid]['calling'], 'aht_count'));
        $return[$ag->agentid]['call_sum'] = array_sum(array_column($return[$ag->agentid]['calling'], 'aht_sum'));

        $return[$ag->agentid]['veri_aht'] = $this->get_recording($data_verified);
        $return[$ag->agentid]['aht_count'] = array_sum(array_column($return[$ag->agentid]['veri_aht'], 'aht_count'));
        $return[$ag->agentid]['aht_sum'] = array_sum(array_column($return[$ag->agentid]['veri_aht'], 'aht_sum'));

        $return['total']['aht_count'] = $return['total']['aht_count'] + $return[$ag->agentid]['aht_count'];
        $return['total']['aht_sum'] = $return['total']['aht_sum'] + $return[$ag->agentid]['aht_sum'];
      }
    }
    return $return;
  }
  public function get_recording($data_verified)
  {
    $return = array();
    $n = 0;
    if (count($data_verified) > 0) {
      foreach ($data_verified as $veri) {
        $hp = $veri['handphone'];
        $pstn = $veri['pstn'];
        $query_hp = $this->trans_profiling_daily->live_query(
          "SELECT duration FROM cdr_daily WHERE dst='61$hp'"
        );
        $query_pstn = $this->trans_profiling_daily->live_query(
          "SELECT duration FROM cdr_daily WHERE dst='61$pstn'"
        );
        $rhp = $query_hp->result_array();
        $rpstn = $query_pstn->result_array();
        $aht_v = 0;
        $aht_n = 0;
        if (count($rhp) > 0) {
          foreach ($rhp as $drc) {
            $aht_n++;
            $aht_v = $aht_v + $drc['duration'];
            $veri['recording'][] = $drc;
          }
        }
        if (count($rpstn) > 0) {
          foreach ($rpstn as $drc) {
            $aht_n++;
            $aht_v = $aht_v + $drc['duration'];
            $veri['recording'][] = $drc;
          }
        }

        $veri['aht_count'] = $aht_n;
        $veri['aht_sum'] = $aht_v;
        $veri['aht'] = $aht_v / $aht_n;
        $return[] = $veri;
      }
    }
    return $return;
  }

  function agent_peformance()
  {

    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
    $total = array();
    $return = array();
    $status_kategori=array(
      'Agree','Follow UP','Decline'
    );
    
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $return[$ag->agentid] = array();
       
        foreach ($status_kategori as $kat) {
          $filter = array(
            "login" => $ag->login,
            "kategori" => $kat,
            "DATE(tgl)" => date('Y-m-d')
          );

          $return['peformance'][$ag->agentid][$kat] = $this->app_tam_data2->get_count($filter);
          $filter_nc = array(
            "login" => $ag->login,
            "status" => 'Not Contacted',
            "DATE(tgl)" => date('Y-m-d')
          );
          
          $return['peformance'][$ag->agentid]['Not Contacted'] = $this->app_tam_data2->get_count($filter_nc);
          $return['peformance']['total'][$kat] = $return['peformance']['total'][$kat] + $return['peformance'][$ag->agentid][$kat];
          $return['peformance']['total']['Not Contacted'] = $return['peformance']['total']['Not Contacted'] + $return['peformance'][$ag->agentid]['Not Contacted'];
        }
        $filter = array(
          "login" => $ag->login,
          "DATE(tgl)" => date('Y-m-d')
        );
        $row_data = $this->app_tam_data2->get_row($filter, array("tgl,TIMESTAMPDIFF(
          SECOND,
          tgl,
          CURRENT_TIMESTAMP
      ) AS idle"), array("tgl" => "DESC"));

        if ($row_data) {
          $return['peformance'][$ag->agentid]['last_update'] = $row_data->tgl;

          // echo $diff;
          if ($row_data->idle > 480) {
            $return['peformance']['idle'][] = $ag->agentid;
          }
          $return['peformance'][$ag->agentid]['idle'] = $row_data->idle;
        }
        $return['peformance'][$ag->agentid]['data'] = $ag;
      }
    }
    return $return;
  }
  function agent_status()
  {
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8));
    $total = array();
    $return = array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $absen_aplikasi = $this->t_absensi->get_count(array("agentid" => $ag->agentid, "stts" => "in", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d')));
        $out_aplikasi = $this->t_absensi->get_count(array("agentid" => $ag->agentid, "stts" => "out", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d'), "TIME(waktu_in) >" => '09:00:00'));
         if ($absen_aplikasi > 0) {
          $return['kehadiran']['WFO'][] = $ag->agentid;
          if ($out_aplikasi > 0) {
            $return['status']['LOGOUT'][] = $ag->agentid;
          }
        }
        if ($absen_aplikasi == 0) {
          $return['kehadiran']['OFFLINE'][] = $ag->agentid;
        }
      }
    }
    return $return;
  }
  function agent_aux()
  {
    $return = array();
    $aux = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user_log_in_out.ket,sys_user.nama,TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,CURRENT_TIMESTAMP) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time)='" . date('Y-m-d') . "' AND sys_user_log_in_out.ket != '' AND ISNULL(sys_user_log_in_out.logout_time) AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid ORDER BY sys_user_log_in_out.id DESC ");
    $status_aux = array("aux");
    foreach ($status_aux as $k => $v) {
      $return['total'][$v]=0;
      $aux_detail = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time)='" . date('Y-m-d') . "' AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
      if ($aux_detail->num_rows() > 0) {
        foreach ($aux_detail->result_array() as $axd) {
          $return['all_status'][$axd['agentid']][$v] = $axd['aux'];
          $return['total'][$v] = $return['total'][$v]+$axd['aux'];
        }
      }
    }
    $return['num'] = $aux->num_rows();
    if ($aux->num_rows() > 0) {
      foreach ($aux->result_array() as $ax) {
        $return['data'][] = $ax['agentid'];
        $return['detail'][$ax['agentid']] = $ax;
      }
    }
    return $return;
  }
  
  function filter_by_value($array, $index, $value)
  {
    $newarray = array();
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
    $newarray = array();
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
    $newarray = array();
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
}
