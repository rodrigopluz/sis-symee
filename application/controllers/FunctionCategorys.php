<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FunctionCategorys Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class FunctionCategorys
 */
class FunctionCategorys extends CI_Controller
{
    /**
     * @param FunctionCategory
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('FunctionCategory');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of function_category.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['function_categories'] = $this->FunctionCategory->get_all_function_category();

        $page_data['page_menu']  = 'function_category';
        $page_data['page_name']  = 'function_category/index';
        $page_data['page_title'] = get_phrase('function_category');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified function-category.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['function_category'] = $this->FunctionCategory->get_function_category($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new function-category.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'category' => $this->input->post('category'),
            ];

            $function_category_id = $this->FunctionCategory->add_function_category($params);

            $this->session->set_flashdata('flash_message', get_phrase('function_category_create'));
            redirect(base_url() . 'admin/categoria-funcoes', 'refresh');
        } else {
            $page_data['page_name']  = 'function_category/create';
            $page_data['page_title'] = get_phrase('function_category');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified function-category.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['function_category'] = $this->FunctionCategory->get_function_category($id);

        if (isset($page_data['function_category']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'category' => $this->input->post('category'),
                ];

                $this->FunctionCategory->update_function_category($id,$params);

                $this->session->set_flashdata('flash_message', get_phrase('function_category_updated'));
                redirect(base_url() . 'admin/categoria-funcoes', 'refresh');
            } else {
                $page_data['page_name']  = 'function_category/edit';
                $page_data['page_title'] = get_phrase('function_category');
            }
        } else {
            show_error('The function_category you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified function-category from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $function_category = $this->FunctionCategory->delete_function_category($id);

        // check if the function_category exists before trying to delete it
        if (isset($function_category['id'])) {
            $this->FunctionCategory->delete_function_category($id);
            redirect('function_category/index');
        } else {
            show_error('The function_category you are trying to delete does not exist.');
        }
    }
}