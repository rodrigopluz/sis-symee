<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Plans Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Plans
 */
class Plans extends CI_Controller
{
    /**
     * @param Plans
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Plan');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of plan.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['plans'] = $this->Plan->get_all_plan();

        $page_data['page_menu']  = 'plan';
        $page_data['page_name']  = 'plans/index';
        $page_data['page_title'] = get_phrase('plans');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified plan.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['plan'] = $this->Plan->get_plan($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new plan.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $params = [
                'type' => $this->input->post('type'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'description' => $this->input->post('description'),
                'collaborator' => $this->input->post('collaborator'),
            ];

            $plan_id = $this->Plan->add_plan($params);

            $this->session->set_flashdata('flash_message', get_phrase('plan_create'));
            redirect(base_url() . 'admin/planos', 'refresh');
        } else {
            $page_data['page_name']  = 'plans/create';
            $page_data['page_title'] = get_phrase('plan');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Edit the form for editing the specified plan.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['plan'] = $this->Plan->get_plan($id);

        if (isset($page_data['plan']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'type' => $this->input->post('type'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'collaborator' => $this->input->post('collaborator'),
                    'description' => $this->input->post('description'),
                ];

                $this->Plan->update_plan($id,$params);

                $this->session->set_flashdata('flash_message', get_phrase('plan_edit'));
                redirect(base_url() . 'admin/planos', 'refresh');
            } else {
                $page_data['page_name']  = 'plans/edit';
                $page_data['page_title'] = get_phrase('plan');
            }
        } else {
            show_error('The plan you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified plan from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $plan = $this->Plan->delete_plan($id);

        // check if the plan exists before trying to delete it
        if (isset($plan['id'])) {
            $this->Plan->delete_plan($id);
            redirect('plans/index');
        } else {
            show_error('The plan you are trying to delete does not exist.');
        }
    }
}