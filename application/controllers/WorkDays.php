<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkDays Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class WorkDays
 */
class WorkDays extends CI_Controller
{
    /**
     * @param WorkDay
     * @param WorkPlace
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('WorkDay');
        $this->load->model('WorkPlace');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of workday.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['workdays'] = $this->WorkDay->get_all_workday();

        $page_data['page_menu']  = 'work_days';
        $page_data['page_name']  = 'work_day/index';
        $page_data['page_title'] = get_phrase('work_days');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified workday.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['workday'] = $this->Workday->get_workday($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new workday.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'id_workplace' => $this->input->post('id_workplace'),
                'end_date_time' => $this->input->post('end_date_time'),
                'start_date_time' => $this->input->post('start_date_time'),
                'description' => $this->input->post('description'),
                'amount_employees' => $this->input->post('amount_employees'),
            ];

            $workday_id = $this->WorkDay->add_workday($params);
            redirect('work_day/index');
        } else {
            $page_data['page_name']  = 'work_day/create';
            $page_data['page_title'] = get_phrase('work_days');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified workday.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['workday'] = $this->WorkDay->get_workday($id);

        /*- workplace -*/
        $id_workplace = $page_data['workday']['id_workplace'];
        $page_data['workplace'] = $this->WorkPlace->get_all_workplace($id_workplace);


        if (isset($page_data['workday']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'id_workplace' => $this->input->post('id_workplace'),
                    'end_date_time' => $this->input->post('end_date_time'),
                    'start_date_time' => $this->input->post('start_date_time'),
                    'description' => $this->input->post('description'),
                    'amount_employees' => $this->input->post('amount_employees'),
                ];

                $this->WorkDay->update_workday($id,$params);

                redirect('work_day/index');
            } else {
                $page_data['page_name']  = 'work_day/edit';
                $page_data['page_title'] = get_phrase('work_days');
            }
        } else {
            show_error('The workday you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified workday from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $workday = $this->WorkDay->delete_workday($id);

        // check if the workday exists before trying to delete it
        if (isset($workday['id'])) {
            $this->WorkDay->delete_workday($id);
            redirect('work_day/index');
        } else {
            show_error('The workday you are trying to delete does not exist.');
        }
    }
}