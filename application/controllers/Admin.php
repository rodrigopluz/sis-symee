<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class Admin
 */
class Admin extends CI_Controller
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
		
        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');		
    }
    
    /**
     * default functin, redirects to login page if no admin logged in yet
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }
    
    /***
     * private messaging
     */
    private function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->Crud->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->Crud->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->Crud->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name'] = $param1;
        $page_data['page_name']               = 'message';
        $page_data['page_title']              = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }

    /***
     * BACKUP / RESTORE / DELETE DATA PAGE
     */
    public function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->Crud->create_backup($type);
        }

        if ($operation == 'restore') {
            $this->Crud->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        
        if ($operation == 'delete') {
            $this->Crud->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
}
