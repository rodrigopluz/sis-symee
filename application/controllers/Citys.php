<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Citys Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Citys
 */
class Citys extends CI_Controller
{
    /**
     * @param City
     * @param States
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('City');
        $this->load->model('States');
        $this->load->model('Country');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of city.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['cities'] = $this->City->get_all_city();

        $page_data['page_menu']  = 'city';
        $page_data['page_name']  = 'city/index';
        $page_data['page_title'] = get_phrase('city');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified city.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['city'] = $this->City->get_city($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new city.
     *
     * @return void
     */
    public function create()
    {
        $page_data['city'] = $this->City->get_city($id);

        /*- states -*/
        $sigla = $page_data['city']['sigla'];
        $page_data['states'] = $this->States->get_all_states($sigla);

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();
        
        if (isset($_POST) && count($_POST) > 0) {   
            $params = [
                'nome' => $this->input->post('nome'),
                'sigla' => $this->input->post('sigla'),
                'initial' => $this->input->post('initial'),
                'cod_siafi' => $this->input->post('cod_siafi'),
                'subst_tributaria' => $this->input->post('subst_tributaria'),
                'cod_municipio_ibge' => $this->input->post('cod_municipio_ibge'),
            ];

            $city_id = $this->City->add_city($params);
            redirect('city/index');
        } else {
            $page_data['page_name']  = 'city/create';
            $page_data['page_title'] = get_phrase('city');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified city.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['city'] = $this->City->get_city($id);

        /*- states -*/
        $sigla = $page_data['city']['sigla'];
        $page_data['states'] = $this->States->get_all_states($sigla);

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        if (isset($page_data['city']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = [
                    'nome' => $this->input->post('nome'),
                    'sigla' => $this->input->post('sigla'),
                    'initial' => $this->input->post('initial'),
                    'cod_municipio_ibge' => $this->input->post('cod_municipio_ibge')
                ];

                $this->City->update_city($id, $params);

                $this->session->set_flashdata('flash_message', get_phrase('city_updated'));
                redirect(base_url() . 'admin/cidades', 'refresh');
            } else {
                $page_data['page_name']  = 'city/edit';
                $page_data['page_title'] = get_phrase('city');
            }
        } else {
            show_error('The city you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified city from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $city = $this->City->delete_city($id);

        // check if the city exists before trying to delete it
        if (isset($city['id'])) {
            $this->City->delete_city($id);
            redirect('city/index');
        } else {
            show_error('The city you are trying to delete does not exist.');
        }
    }
}