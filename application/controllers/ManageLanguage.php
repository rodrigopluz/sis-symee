<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class ManageLanguage
 */
class ManageLanguage extends CI_Controller
{   
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->helper('dump');
        $this->load->library('session');
		
        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
    }

    /**
     * LANGUAGE SETTINGS
     */
    public function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'login', 'refresh');

			
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		
        if ($param1 == 'update_phrase') {
			$language = $param2;
			$total_phrase = $this->input->post('total_phrase');

			for ($i = 1; $i < $total_phrase; $i++) {
				$data[$language] = $this->input->post('phrase') . $i;

				$this->db->where('id', $i);
				$this->db->update('language', [$language => $this->input->post('phrase' . $i)]);
			}
			
			redirect(base_url() . 'admin/gerenciar-lingua/edita-idioma/' . $language, 'refresh');
		}

		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'admin/gerenciar-lingua', 'refresh');
		}
		
        if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'admin/gerenciar-lingua', 'refresh');
		}
		
        if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = [
				$language => [
					'type' => 'LONGTEXT'
				]
			];
		
        	$this->dbforge->add_column('language', $fields);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			redirect(base_url() . 'admin/gerenciar-lingua', 'refresh');
		}

		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
			
			redirect(base_url() . 'admin/gerenciar-lingua', 'refresh');
		}

		$page_data['page_name']  = 'manage_language';
		$page_data['page_title'] = get_phrase('manage_language');

		// $page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('backend/index', $page_data);	
	}
}
