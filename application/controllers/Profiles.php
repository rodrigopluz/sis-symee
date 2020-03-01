<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profiles Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Profiles
 */
class Profiles extends CI_Controller
{
    /**
     * @param Profile
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Profile');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of profile.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['profiles'] = $this->Profile->get_all_profile();

        $page_data['page_menu']  = 'profile';
        $page_data['page_name']  = 'profile/index';
        $page_data['page_title'] = get_phrase('profile');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified profile.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['profile'] = $this->Profile->get_profile($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new profile.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'name' => $this->input->post('name'),
                // 'acl' => $this->input->post('acl'),
            ];

            $profile_id = $this->Profile->add_profile($params);
            
            redirect('profile/index');
        } else {
            $page_data['page_name']  = 'profile/edit';
            $page_data['page_title'] = get_phrase('profile');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified profile.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['profile'] = $this->Profile->get_profile($id);

        if (isset($page_data['profile']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'name' => $this->input->post('name'),
                    // 'acl' => $this->input->post('acl'),
                ];

                $this->Profile->update_profile($id,$params);

                $this->session->set_flashdata('flash_message', get_phrase('profile_updated'));
                redirect(base_url() . 'admin/perfis', 'refresh');
            } else {
                $page_data['page_menu']  = 'profile';
                $page_data['page_name']  = 'profile/edit';
                $page_data['page_title'] = get_phrase('profile');
            }
        } else {
            show_error('The profile you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified profile from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $profile = $this->Profile->delete_profile($id);

        // check if the profile exists before trying to delete it
        if (isset($profile['id'])) {
            $this->Profile->delete_profile($id);
            redirect('profile/index');
        } else {
            show_error('The profile you are trying to delete does not exist.');
        }
    }
}