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
class Check_payment extends CI_Controller {
	private $log_key,$log_temp;
	
    public function __construct() {
		parent::__construct();
		$this->load->model('sys/Dapros_cto_model','tmodel');
		// $this->load->model('Pract0_spd_bayar/Pract0_spd_bayar_model','pract0_spd_bayar');
    }

    
	
	// public function create_multiple(){
	// 	$data =array(
	// 		'title_page_big'				=> 'Buat Multiple',
	// 		'link_save'						=> site_url().'Cto/Check_payment/create_action',
	// 		'link_prepare_picture'			=> site_url().'prepare_picture'.$this->_token,
	// 		'link_download_template_user'	=> site_url().'Cto/Check_payment/download_template_user/'.$this->_token,
	// 		'link_upload_template'			=> site_url().'Cto/Check_payment/upload_template_user/'.$this->_token,
	// 		'link_back'						=> $this->agent->referrer(),

	// 	);
		
	// 	$this->template->load('Cto/Check_payment_form_multiple',$data);
	// }
	public function create_multiple(){
		$data =array(
			'title_page_big'				=> 'Customers status',
			'link_save'						=> site_url().'Cto/Check_payment/create_action',
			'link_prepare_picture'			=> site_url().'prepare_picture'.$this->_token,
			'link_download_template_user'	=> site_url().'Cto/Check_payment/download_template_user/'.$this->_token,
			'link_upload_template'			=> site_url().'Cto/Check_payment/upload_template_user/'.$this->_token,
			'link_back'						=> $this->agent->referrer(),

		);
		$datana="";
		if(isset($_POST['no_internet'])){
			$inet=$this->input->post('no_internet');
			$result=explode(",",$inet);
			$n=0;
			foreach($result as $row ){
				// echo $row;
				$hasil=$this->loadBillData(preg_replace('/[^A-Za-z0-9\-]/', '', $row));
				$datana=$datana.$hasil;
				$n++;
			}
		}
		$data['list']=$datana;
		$this->template->load('Cto/Check_payment_form_manual',$data);
	}
	public function check_connect(){
		$data=$this->pract0_spd_bayar->live_query("select *
		from pract0_spd_bayar
		where ct0 = 'Y'
		and segment = 'DCS'
		and (profile = 'ADA USAGE N-1 PERNAH BAYAR' or profile = 'ADA USAGE PERNAH BAYAR' or profile = 'ADA USAGE N-1 TIDAK PERNAH BAYAR')
		and saldo_bln1 = 0
		and bayar1 is not null 
		AND SND = '122303203937'
		");
		$row=$data->row();
		if($row){
			echo $row->CPROD;
		}else{
			echo "gagal";
		}
	}
	public function download_template_user($token){
		if($token == $this->_token ){
		
			//mendapatkan data level
			
			
			$this->load->library("PHPExcel");
			$objPHPExcel = new PHPExcel();
			
			//SET BORDER
			$thick = array ();
			$thick['borders']=array();
			$thick['borders']['allborders']=array();
			$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
			

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
						->setCellValue('A1', 'ISI PADA TABEL DI BAWAH INI (MAX 10.000 DATA)')
						->setCellValue('A2', 'pastikan anda mengisi dengan benar, cek kembali isian anda sebelum melakukan upload ke system')
						->setCellValue('A3', 'NCLI')
						->setCellValue('B3', 'PSTN')
						->setCellValue('C3', 'INTERNET');
						
			//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A1:C1');	
			
			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A2:C2');	
			
				
			//MEMBUAT COLOR FONT RED A1
			$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);		
			
			
			//WRAP TEST A2
			$objPHPExcel->getActiveSheet()->getStyle('A2')
						->getAlignment()->setWrapText(true);
			
			//Set Height Row 2
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);			

			
			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A1:C10003')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:C10003')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
			
			
			//MEMBUAT COLOR FONT WHITE A3-D3	
			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
						
			
			//BOLD A1
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			
			//BOLD A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->getFont()->setBold(true);
			
			
			//SET WIDTH COLUMN
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			
			
			
			//SET COLOR CELL BLACK A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
						->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
						
						
			//========================================//
			/* 	 END TABLE ISIAN PADA COLUMN A1	  */
			//========================================//	

					


			
						
			
			//PROTECTION SHEET
			$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
			$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);

			//UNPROTECT TABLE ISIAN MAX 2000 ROW
			$objPHPExcel->getActiveSheet()->getStyle('A4:C10003')->getProtection()->setLocked(
				PHPExcel_Style_Protection::PROTECTION_UNPROTECTED
			);
			
			//membuat border				
		   $objPHPExcel->getActiveSheet()->getStyle ( 'A4:C10003' )->applyFromArray ($thick);

						
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('TEMPLATE');		

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Template_Dapros.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;	
		}else{
			redirect("Auth");			
		}		
		
	}
	
	public function upload_template_user($token){
		if($token == $this->_token ){
				
			
				$tm = time();
				$config['upload_path']          = './temp_upload/';
                $config['allowed_types']        = 'xls';
                $config['max_size']             = 60000;
				$config['file_name']			= 'template_dapros_'.$tm.'.xls';
				$config['overwrite']			= TRUE;
				
				
                $this->load->library('upload', $config);	
				
				$o = array();
			 if ( !$this->upload->do_upload('inputfile')){
				 
						$em = $this->upload->display_errors();
						$em = str_replace('You did not select a file to upload.','Tidak ada file yang di pilih',$em);
					
						$o['success'] 	= 'false';
						$o['message']	= $em;
						$o['elementid'] = '#inputfile';
						$o['sec_val']	=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;		
                }else{
					$path_file = $config['upload_path'].$config['file_name']; 
					$this->load->library("YBSExcelReader");
					$dataError = array();
		
					try{
						$excel  = new YBSExcelReader();
						$excel->set_file($path_file,"TEMPLATE");
						$dataFinal = $excel->read(4,10003,range('A','C'));
						
						$x=4;
						foreach($dataFinal as $key){
							// if($key["A"]=="" || $key["B"]=="" || $key["C"]==""){
							// 	$dataError[]= "<small>ERROR : ROW (". $x . ") ADA DATA YANG KOSONG, data tidak boleh kosong.. </small><br>";
							// }
							
							
							if($double !==""){
								$dataError[] = $double;
							}
							
							//membatasi pembacaan error ,max 10 error
							if(count($dataError)>10){
								break;
							}
							
							
							$x++;
						}
						
						
						
					} catch(Exception $e) {
						$msgError = $e->getMessage();
						$msgError = str_replace("Your requested sheet index: -1 is out of bounds. The actual number of sheets is 0.","Error : Sheet tidak di temukan",$msgError);
						$dataError[]= "<small>".$msgError."</small><br>";
					}
				
					
						

					if(count($dataError) > 0){
						unlink($path_file);
						
						$o['success']		= 'false';
						$o['message'] 		= $dataError;
						$o['original_name']	= $this->upload->data('client_name');
						$o['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;	
					}else{		
						$o['success']		= 'true';
						$o['message'] 		= "<small> File Ready in Process,,click save</small><br><a onclick=\"save('".site_url()."Cto/Check_payment/create_user_by_template/".$this->_token."/".$tm."')\" href=\"javascript:void(0)\" class=\"btn btn-success\">Save<a/>";
						$o['original_name']	= $this->upload->data('client_name');
						$o['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;		
					}
                }	
		
		}else{
			redirect("Auth");
		}	
	
	
	
	}
	public function create_user_by_template($token,$tm){
		if($this->_token ==$token){
			$path_file = './temp_upload/template_dapros_'.$tm.'.xls';
			
			$this->load->library("YBSExcelReader");
			$excel  = new YBSExcelReader();
			$excel->set_file($path_file,"TEMPLATE");
			$dataFinal = $excel->read(4,10003,range('A','C'));
			
			$val = array();
			$val_exist= array();
			$val_final = array();
			$x=4;
			foreach($dataFinal as $key){
				$val["internet"]  	= $key["C"];
				$val["ncli"]  	= $key["A"];
				$val["pstn"]  	= $key["B"];
				$val["tm"]  	= $tm;
				
				
				
					$val_final [] = $val;
				
				$x++;
			
			}
			
			$o = new Outputview();
			if(count($val_exist)>0){
				 $o->success = 'false';
				 $o->message = $val_exist;
				 echo $o->result();
				 return;
			}else{
				
				$split_data = array_chunk($val_final,100);
				foreach($split_data as $val){
					$this->tmodel->insert_multiple($val);
				}
				
				$o->success = 'true';
				$o->message = "<small>data berhasil di simpan..total data ".count($val_final)." row </small><br>";
				echo $o->result();
				return;
				
				
			}
			
			
		
			
		}else{
			redirect("Auth");
		}
	}
	public function loadBillData($inet){
		$url = "http://i-payment.telkom.co.id/script/intag_search_trems.php?phone=$inet&rname=&raddr=&rphone=&via=TREMS";
		$return="";
		$payload = file_get_contents($url);
		echo $payload;
		if (strpos($payload, "silakan hubungi helpdesk") !== false || strpos($payload, "tidak mempunyai billing") !== false || strpos($payload, "No such host") !== false) {
			$return=$return."<tr><td>".$inet."</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td></tr>";
		}
		else{
			$dom = new domDocument;
			@$dom->loadHTML($payload);
			$dom->preserveWhiteSpace = true;
			$tab = $dom->getElementsByTagName('table')[1];
			$num_one=$tab->getElementsByTagName('tr')->length;
			if($tab->getElementsByTagName('tr')->length > 4){
				$num_one=4;
			}
			for($k=0; $k<=$num_one; $k++){
				//billing payload
				$tableid = $dom->getElementsByTagName('table')[0];
				$dataid = [];
				$idval = '<tr><td nowrap>'.$inet.'</td>';
				$row0 = $tableid->getElementsByTagName('tr')[0];
				for($i=0; $i<$row0->childNodes->length; $i++){
					$load = $row0->getElementsByTagName('td')[$i]->textContent;
					if($i==1){
						$idval .= "<td nowrap>".$load."</td>";
					}
				};

				//billing payload
				$tables = $dom->getElementsByTagName('table')[1];
				$rows = $tables->getElementsByTagName('tr')[0];
				$rows = $rows->parentNode->removeChild($rows);
				$rows = $tables->getElementsByTagName('tr')[0];
				$bill = [];
				$rowval = '';
				for($i=0; $i<$rows->childNodes->length; $i++){
					$load = $rows->getElementsByTagName('td')[$i]->textContent;
					if(($i==1||$i==4||$i==3||$i==5||$i==7||$i==8)){
						if($i==3||$i==4){
							$load = preg_replace('/,/', '', $load);
						}
						$rowval .= "<td nowrap>".$load."</td>";
					}
				};
				if (strlen($rowval)>0){
					$return=$return.$idval.$rowval."</tr>";
				}
			}
		}
		return $return;
	}
	
	
}
