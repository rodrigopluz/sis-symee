<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Convocations Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Convocations
 */
class Convocations extends CI_Controller
{
    /**
     * @param Convocation
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Convocation');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of convocation.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['convocations'] = $this->Convocation->get_all_convocation();

        $page_data['page_menu']  = 'convocation';
        $page_data['page_name']  = 'convocation/index';
        $page_data['page_title'] = get_phrase('convocation');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified convocation.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['convocation'] = $this->Convocation->get_convocation($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new convocation.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'id_workday' => $this->input->post('id_workday'),
                'id_employee' => $this->input->post('id_employee'),
                'status' => $this->input->post('status'),
                'date_time_send' => $this->input->post('date_time_send'),
                'date_time_last_reponse' => $this->input->post('date_time_last_reponse'),
                'justification' => $this->input->post('justification'),
                'company_response' => $this->input->post('company_response'),
                'company_justification' => $this->input->post('company_justification'),
                'attachment' => $this->input->post('attachment'),
                'description' => $this->input->post('description'),
            ];

            $convocation_id = $this->Convocation->add_convocation($params);
            redirect('convocation/index');
        } else {
            $page_data['page_name']  = 'convocation/create';
            $page_data['page_title'] = get_phrase('convocation');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified convocation.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['convocation'] = $this->Convocation->get_convocation($id);

        if (isset($page_data['convocation']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'id_workday' => $this->input->post('id_workday'),
                    'id_employee' => $this->input->post('id_employee'),
                    'status' => $this->input->post('status'),
                    'date_time_send' => $this->input->post('date_time_send'),
                    'date_time_last_reponse' => $this->input->post('date_time_last_reponse'),
                    'justification' => $this->input->post('justification'),
                    'company_response' => $this->input->post('company_response'),
                    'company_justification' => $this->input->post('company_justification'),
                    'attachment' => $this->input->post('attachment'),
                    'description' => $this->input->post('description'),
                ];

                $this->Convocation->update_convocation($id,$params);

                redirect('convocation/index');
            } else {
                $page_data['page_name']  = 'convocation/edit';
                $page_data['page_title'] = get_phrase('convocation');
            }
        } else {
            show_error('The convocation you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified convocation from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $convocation = $this->Convocation->delete_convocation($id);

        // check if the convocation exists before trying to delete it
        if (isset($convocation['id'])) {
            $this->Convocation->delete_convocation($id);
            redirect('convocation/index');
        } else {
            show_error('The convocation you are trying to delete does not exist.');
        }
    }
}