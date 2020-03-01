<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionRoles Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class FunctionRoles
 */
class FunctionRoles extends CI_Controller
{
    /**
     * @param FunctionRole
     * @param FunctionCategory
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('FunctionRole');
        $this->load->model('FunctionCategory');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of function_role.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['function_roles'] = $this->FunctionRole->get_all_function_role();

        $page_data['page_menu']  = 'function_role';
        $page_data['page_name']  = 'function_role/index';
        $page_data['page_title'] = get_phrase('function_role');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified function-role.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['function_role'] = $this->FunctionRole->get_function_role($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new function-role.
     *
     * @return void
     */
    public function create()
    {
        $page_data['category'] = $this->FunctionCategory->get_all_function_category();

        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'name' => $this->input->post('name'),
                'status' => $this->input->post('status'),
                'id_function_category' => $this->input->post('category'),
            ];

            $this->FunctionRole->add_function_role($params);

            $this->session->set_flashdata('flash_message', get_phrase('function_create'));
            redirect(base_url() . 'admin/funcoes', 'refresh');
        } else {
            $page_data['page_name']  = 'function_role/create';
            $page_data['page_title'] = get_phrase('function_role');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified function-role.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['function_role'] = $this->FunctionRole->get_function_role($id);

        /*- function_category -*/
        $id_function_category = $page_data['function_role']['id_function_category'];
        $page_data['category'] = $this->FunctionCategory->get_all_function_category($id_function_category);

        if (isset($page_data['function_role']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'name' => $this->input->post('name'),
                    'status' => $this->input->post('status'),
                    'id_function_category' => $this->input->post('category'),
                ];

                $this->FunctionRole->update_function_role($id, $params);

                $this->session->set_flashdata('flash_message', get_phrase('function_updated'));
                redirect(base_url() . 'admin/funcoes', 'refresh');
            } else {
                $page_data['page_name']  = 'function_role/edit';
                $page_data['page_title'] = get_phrase('function_role');
            }
        } else {
            show_error('The function_role you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified function-role from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $function_role = $this->FunctionRole->delete_function_role($id);

        // check if the function_role exists before trying to delete it
        if (isset($function_role['id'])) {
            $this->FunctionRole->delete_function_role($id);
            redirect('function_role/index');
        } else {
            show_error('The function_role you are trying to delete does not exist.');
        }
    }
}