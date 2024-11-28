<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class Modal
 *  portfolio     : http://
 *  website       : http://
 *  support       : http://
 */
class Modal extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
		$this->load->library('session');

		$this->load->model('WorkDay');
		$this->load->model('FilePdf');
		$this->load->model('Contract');
	
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
    }
	
	/**
	 * default functin, redirects to login page if no admin logged in yet
	 */
	public function index()
	{
	}
	
	/**
	 * $page_name =	The name of page - contract
	 */
	public function popup($page_name = '', $param2 = '', $param3 = '')
	{
		$account_type =	$this->session->userdata('login_type');
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;

		$page_data['contract'] = $this->Contract->get_contract_files($param3);

		$this->load->view('backend/'. $account_type .'/'. $page_name .'/'. $param2 .'.php', $page_data);
		
		echo '<script type="text/javascript" src="'. base_url() .'assets/js/symee/symee-custom.js"></script>';

		switch ($param2) {
			case 'show':
				// echo '<script type="text/javascript" src="'. base_url() .'assets/js/symee/symeecustom-ajax.js"></script>';
				echo '<script type="text/javascript" src="'. base_url() .'assets/js/symee/symee-dropzone.js"></script>';
				break;
			case 'close':
				echo '<script type="text/javascript" src="'. base_url() .'assets/js/datepicker/js/bootstrap-datepicker.js"></script>';
				echo '<script type="text/javascript" src="'. base_url() .'assets/js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>';
				echo '<script type="text/javascript" src="'. base_url() .'assets/js/scripts-symee.js"></script>';
				break;
		}
	}

	/**
     * upload-file by server for php
     */
    public function upload_file()
    {
		header('Content-Type: application/json');
        $resp = [];
		
		$id = $this->uri->segment(4);
        $errors = mt_rand(0,10) % 2 == 0; // random response
		
        # normal response code
        if (function_exists('http_response_code')) http_response_code(200);
		
		//* 
		$contract = $this->Contract->get_contract($id);

		# on error
        // if ($errors) {
		// 	if (function_exists('http_response_code')) http_response_code(400);
        // 	$resp['error'] = get_phrase('error_upload_file'); // "Couldn't upload file, reason: ~";
		// } else {
			//* save the file in the directory - uploads/document
			$upload_dir = './uploads/document';
			
			if (!empty($_FILES)) {
				$file_name = $id .'-'. date('Y.m-H.i.s') .'-'. $_FILES['file']['name'];
				
				$tmp_file = $_FILES['file']['tmp_name'];
				$filename = $upload_dir .'/'. $file_name;
				move_uploaded_file($tmp_file, $filename);
			}

			//* filesize conversion
			$filesize = $_FILES['file']['size'];
			$units = ['KB','MB','GB','TB'];
			$curr_unit = '';
			while (count($units) > 0 && $filesize > 1024) {
				$curr_unit = array_shift($units);
				$filesize /= 1024;
			}

			$file_size = ($filesize | 0) .' '. $curr_unit;

			//* select params
			$params = [
				'id_contract' => $id,
				'id_user_company' => $this->session->userdata('login_user_id'),
				'file_name' => $file_name,
				'file_size' => $file_size,
				'file_type' => $_FILES['file']['type'],
				'file_status' => 1
			];

			$this->FilePdf->add_file_pdf($params);
		// }

        echo json_encode($resp);
	}
	
	/**
     * Deletes the specified file-pdf from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
		}
		
		$upload_dir = 'uploads/document';
		$file = $this->FilePdf->get_file_pdf($id);
		
		// check if the contract exists before trying to delete it
        if (isset($file['id'])) {
			unlink($upload_dir .'/'. $file['file_name']);
			$this->FilePdf->delete_file_pdf($id);
			
            redirect(base_url() . 'admin/vinculos', 'refresh');
        } else {
            show_error('The contract you are trying to delete does not exist.');
        }
	}

	/**
	 * $page_name = the name of page - work-day
	 */
	public function popup_work($page_name = '', $param2 = '', $param3 = '')
	{
		$account_type = $this->session->userdata('login_type');
		$page_data['param2'] = $param2;
		$page_data['param3'] = $param3;

		// $page_data['work_day'] = $this->WorkDay->get_workday($param3);

		$this->load->view('backend/'. $account_type .'/'. $page_name .'/'. $param2 .'.php', $page_data);

		echo '<script type="text/javascript" src="'. base_url() .'assets/js/symee/symee-custom.js"></script>';
		echo '<script type="text/javascript" src="'. base_url() .'assets/js/datepicker/js/bootstrap-datepicker.js"></script>';
	}
}
