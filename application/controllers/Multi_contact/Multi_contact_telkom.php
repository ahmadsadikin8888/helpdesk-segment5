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
class Multi_contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dbprofile_verified/Dbprofile_verified_model', 'tmodel');
        $this->title = new Multi_contact_config();
    }

    public function index() {
		$this->load->view('front-end/landing-page/agency/index');
    }
	public function check_detail()
	{
		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Multi_contact/update_detail',
			'link_back'				=> $this->agent->referrer(),
		);
		$this->load->view('Dbprofile_verified/Dbprofile_verified_check_form', $data);
		// $this->template->load('Dbprofile_verified/Dbprofile_verified_detail_form', $data);
	}
	
	public function update_detail()
	{

		$NCLI = $this->input->post('NCLI');
		$berdasarkan = $this->input->post('berdasarkan');
		$row = $this->tmodel->get_by_filter($NCLI, $berdasarkan);


		$data = array(
			'title_page_big'		=> 'DETAIL DATA PELANGGAN',
			'title'					=> $this->title,
			'link_detail'				=> site_url() . 'Multi_contact/detail',
			'link_back'				=> $this->agent->referrer(),
			'data'					=> $row,
			'berdasarkan' => $berdasarkan,
			'ncli' => $NCLI,
		);
		if (isset($NCLI)) {
            $this->load->view('Dbprofile_verified/Dbprofile_verified_list_detail_filter', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}
	public function detail()
	{

		$NCLI = $this->input->get('ncli');
		$berdasarkan = $this->input->get('berdasarkan');
		$tgl_veri = $this->input->get('tgl_veri');
		$row = $this->tmodel->get_by_id_2($NCLI, $berdasarkan, $tgl_veri);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'DETAIL DATA PELANGGAN',
				'title'					=> $this->title,
				'link_back'				=> site_url() . 'Multi_contact/check_detail',
				'data'					=> $row,
				'berdasarkan' => $berdasarkan
			);

            $this->load->view('Dbprofile_verified/Dbprofile_verified_form_detail', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}
	
	

		

}
