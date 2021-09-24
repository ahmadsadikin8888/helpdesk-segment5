<?php
require APPPATH . '/controllers/Multi_contact/Multi_contact_config.php';
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
class Multi_contact extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'tmodel');
		$this->title = new Multi_contact_config();
	}

	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Multi_contact/Multi_contact/update_detail',
			'link_back'				=> $this->agent->referrer(),
		);
		$this->template->load('Dbprofile_verified_infomedia/Dbprofile_verified_check_form', $data);
	}
	public function check_detail()
	{
		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Multi_contact/Multi_contact/update_detail',
			'link_back'				=> $this->agent->referrer(),
		);
		$this->template->load('Dbprofile_verified_infomedia/Dbprofile_verified_check_form', $data);
		// $this->template->load('Dbprofile_verified/Dbprofile_verified_detail_form', $data);
	}

	public function update_detail()
	{
		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Multi_contact/Multi_contact/update_detail',
			'link_back'				=> $this->agent->referrer(),
		);
		$NCLI = $this->input->post('ncli');
		$berdasarkan = $this->input->post('berdasarkan');

		$row = $this->tmodel->get_results_array(array($berdasarkan => $NCLI), array("*"), array(), array("lup" => "DESC"));


		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_detail'				=> site_url() . 'Multi_contact/Multi_contact/detail',
			'link_back'				=> $this->agent->referrer(),
			'data'					=> $row,
			'berdasarkan' => $berdasarkan,
			'ncli' => $NCLI,
		);
		if (isset($NCLI)) {
			$this->template->load('Dbprofile_verified_infomedia/Dbprofile_verified_list_detail_filter', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}
	public function detail()
	{

		$NCLI = $this->input->get('ncli');
		$berdasarkan = $this->input->get('berdasarkan');
		$tgl_veri = $this->input->get('tgl_veri');
		$row = $this->tmodel->get_row(array($berdasarkan => $NCLI, "lup" => $tgl_veri));

		if ($row) {
			$data = array(
				'title_page_big'		=> 'DETAIL DATA PELANGGAN',
				'title'					=> $this->title,
				'link_back'				=> site_url() . 'Multi_contact/Multi_contact',
				'data'					=> $row,
				'berdasarkan' => $berdasarkan
			);
			if($row->no_speedy != ""){
				$data['payment']=$this->check_payment($row->no_speedy);
			}else{
				$data['payment']=$this->check_payment($row->no_pstn);
			}
			$this->template->load('Dbprofile_verified_infomedia/Dbprofile_verified_form_detail', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function check_payment($nd)
	{
		$ch = curl_init('http://10.16.7.5/pcf/i_payment.php?nd='.$nd);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($ch);
		curl_close($ch);
		$jumlah_tagihan = $this->pecah_row(1, 3, $html);
		if ($this->pecah_row(1, 8, $html) != "") {
			$terakhir_bayar = $this->pecah_row(1, 8, $html);
		} else {
			if ($this->pecah_row(2, 8, $html) != "") {
				$terakhir_bayar = $this->pecah_row(2, 8, $html);
			} else {
				if ($this->pecah_row(3, 8, $html) != "") {
					$terakhir_bayar = $this->pecah_row(3, 8, $html);
				}else {
					if ($this->pecah_row(4, 8, $html) != "") {
						$terakhir_bayar = $this->pecah_row(4, 8, $html);
					}
				}
			}
		}
		$rn=array(
			"jumlah_tagihan"=>$jumlah_tagihan,
			"terakhir_bayar"=>$terakhir_bayar,
		);
		return $rn;
	}

	public function pecah_row($urutan = 1, $field = 8, $html)
	{
		$perrow = explode('eid' . $urutan, $html);
		if (count($perrow > 0)) {
			$perrow = explode('rid1', $perrow[1]);
			$per_td = explode('mgrid', $perrow[0]);
			if (count($per_td) > 0) {
				$pertd_single = explode('</td>', $per_td[$field]);
				$single_data = explode('>', $pertd_single[0]);
				return $single_data[1];
			}
		}
	}
}
