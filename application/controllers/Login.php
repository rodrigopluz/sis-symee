<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos SYMEE
 *  specification : Class Login
 */
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->database();

        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Crud');
        $this->load->model('Email');
        $this->load->model('Person');
        $this->load->model('UserCompany');

        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    /**
     * Default function, redirects to logged in user area
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') == 1) {
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }

        $this->load->view('backend/login');
    }

    /**
     * Ajax login function
     */
    public function ajax_login()
    {
        $data = [];
        $response = [];

        // Recieving post input of cpf, password from ajax request
        $cpf = $this->input->post('cpf');
        $password = $this->input->post('password');

        $response['submitted_data'] = $_POST;

        // Validating login
        $login_status = $this->validate_login($cpf, $password);
        $response['login_status'] = $login_status;

        switch ($login_status) {
            case 'success':
                $response['redirect_url'] = 'admin/dashboard';
                break;
            case 'reset':
                $response['redirect_url'] = 'admin/conta';
                break;
        }

        // create-log access
        // $data = [
        //     'ip' => '',
        //     'location' => '',
        //     'timestamp' => ''
        // ];

        // $access = $this->Crud->get_ip();
        // print_r($access);
        // exit;

        // Replying ajax request with validation response
        echo json_encode($response);
    }

    /**
     * Validating login from ajax request
     */
    public function validate_login($cpf = '', $pass = '')
    {
        $password = md5($pass);
        $credential = ['user_company.login' => $cpf, 'user_company.password' => $password, 'user_company.status' => '1'];

        // Checking login credential for admin
        $query = $this->UserCompany->get_validate_login($credential);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->id);                // id da tb user_company
            $this->session->set_userdata('admin_id', $row->id_person);              // id da tb person
            $this->session->set_userdata('company_id', $row->id_company);           // id da tb company
            $this->session->set_userdata('profile_id', $row->id_profile);           // id da tb profile
            $this->session->set_userdata('name', $row->name_person);                // nome do usuario
            $this->session->set_userdata('avatar', $row->avatar_person);            // avatar do usuario
            $this->session->set_userdata('login_session_user', $row->login);        // cpf do login 
            $this->session->set_userdata('login_type', 'admin');                    // nome do diretorio
            $this->session->set_userdata('plan_name', $row->plan_name);             // nome do plano contratado
            $this->session->set_userdata('plan_type', $row->type);                  // tipo do plano contratado
            $this->session->set_userdata('plan_quantity', $row->quantity);          // quantidade de chamadas que o plano fornece
            $this->session->set_userdata('plan_collaborator', $row->collaborator);  // plano colaborador
            $this->session->set_userdata('reset', $row->reset);                     // situacao do usuario logado

            if ($row->password === $password and $row->reset == '0' and $row->status_person == '1') {
                return 'success';
            }

            if ($row->password === $password and $row->reset == '1' and $row->status_person == '1') {
                return 'reset';
            }

            if ($row->status_person == '-1') {
                $this->session->sess_destroy();
                return 'cancel';
            }
        }

        $this->session->sess_destroy();
        return 'invalid';
    }

    /**
     * DEFAULT NOR FOUND PAGE
     */
    public function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }

    /**
     * PASSWORD RESET BY EMAIL
     */
    public function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    /**
     * ajax que redefine senha - sistema web
     */
    public function ajax_forgot_password()
    {
        $resp           = [];
        $resp['status'] = 'false';
        $email          = $this->input->post('email');

        // redefinindo a senha do usuário aqui
        $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);

        // verificando a credencial para admin
        $query = $this->Person->ajax_forgot_password($email);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->db->where('id_person', $row->id_person);
            $this->db->update('user_company', ['password' => md5($new_password), 'reset' => '1']);
            $resp['status'] = 'true';

            // send new password to user email  
            $this->Email->password_reset_email($new_password, $email, $row);
        }

        $resp['submitted_data'] = $_POST;
        echo json_encode($resp);
    }

    /**
     * LOGOUT FUNCTION
     */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url(), 'refresh');
    }

    /**
     * HIT POINT - QRCODE
     */
    public function hit_point()
    {
        $this->load->view('backend/hit_point');
    }
}
