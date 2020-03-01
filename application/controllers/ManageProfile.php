<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class ManageProfile
 */
class ManageProfile extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->database();

        $this->load->helper('url');
        $this->load->helper('js');
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Crud');
        $this->load->model('Person');
    }

    /***
     * MANAGE OWN PROFILE AND CHANGE PASSWORD
     */
    public function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $id = $this->session->userdata('admin_id');
        
        // aba = gerenciar perfil
        if ($param1 == 'update_profile_info') {
            $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
            $data_nasc = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('data_nasc'))));
            
            $avatar = $id .'.'. $ext;
            
            $data['avatar'] = $avatar;
            $data['data_nasc'] = $data_nasc;
            $data['sexo'] = $this->input->post('sexo');
            $data['type'] = $this->input->post('type');
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['status'] = $this->input->post('status');
            $data['cpf_cnpj'] = notformat_cpf($this->input->post('cpf_cnpj'));
            $data['nationality'] = $this->input->post('nationality');

            $this->Person->update_person($id, $data);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $avatar);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'admin/conta', 'refresh');
        }
        
        // aba = alterar senha
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('user_company', ['id_person' => $this->session->userdata('admin_id')])->row()->password;
            
            if ($current_password == md5($data['password']) && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('id_person', $this->session->userdata('admin_id'));
                $this->db->update('user_company', ['password' => md5($data['new_password']), 'reset' => '0']);

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));

                $this->session->sess_destroy();
                // $this->session->set_flashdata('logout_notification', 'logged_out');
                redirect(base_url(), 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }

            redirect(base_url() . 'admin/conta', 'refresh');
        }

        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['row']  = $this->Person->get_person($id);

        $page_data['js'] = load_js(['symee/manager-profile/script.js']);

        $this->load->view('backend/index', $page_data);
    }
}