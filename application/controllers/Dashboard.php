<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class Dashboard
 */
class Dashboard extends CI_Controller
{
    public function __construct()
	{
        parent::__construct();
        
        if (empty($this->session->userdata('login_session_user'))) {
            redirect(base_url() . 'login', 'refresh');
        }
        
		$this->load->database();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Contract');
		
        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
    }

    /**
     * DASHBOARD
     */
    public function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        //* users who have active contract with the company
        $page_data['count_contracts'] = $this->Contract->get_count_contract();

        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index', $page_data);
    }
}