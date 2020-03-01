<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkPlaces Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class WorkPlaces
 */
class WorkPlaces extends CI_Controller
{
    /**
     * @param Workplace
     * @param Address
     * @param Company
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('js');
        $this->load->helper('url');
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('City');
        $this->load->model('States');
        $this->load->model('Places');
        $this->load->model('Address');
        $this->load->model('Company');
        $this->load->model('Country');
        $this->load->model('WorkPlace');
        $this->load->model('Neighborhood');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of workplace.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');

        if ($this->session->userdata('profile_id') == 1)
            $page_data['workplaces'] = $this->WorkPlace->get_all_workplace();
        else
            $page_data['workplaces'] = $this->WorkPlace->get_session_workplace($this->session->userdata('company_id'));

        $page_data['page_menu']  = 'work_place';
        $page_data['page_name']  = 'work_place/index';
        $page_data['page_title'] = get_phrase('work_places');

        $page_data['js'] = load_js(['symee/work-place/script.js']);
        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified workplace.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['workplace'] = $this->Workplace->get_workplace($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new workplace.
     *
     * @return void
     */
    public function create()
    {
        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        /*- company -*/
        if ($this->session->userdata('profile_id') == 1)
            $page_data['company'] = $this->Company->get_all_company();
        else
            $page_data['company'] = $this->Company->get_session_company($this->session->userdata('company_id'));

        if (isset($_POST) && count($_POST) > 0) {
            /** if address exist */
            if ($this->input->post('id_address') != '') {
                $params = [
                    'name' => $this->input->post('name'),
                    'id_address' => intval($this->input->post('id_address')),
                    'id_company' => intval($this->input->post('id_company')),
                    'information' => $this->input->post('information'),
                ];

                $this->WorkPlace->add_workplace($params);

                /** update address */
                $google = [
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')
                ];

                $this->Address->update_address($this->input->post('id_address'), $google);
            }
            else {
                /** select city from the chosen state */
                $city_state = $this->City->get_all_cityState($this->input->post('n_map_state'), $this->input->post('n_map_city'));
                
                //* save tb-neighborhood
                $params_neighborhood = [
                    'name' => mb_strtoupper($this->input->post('n_map_neighborhood')),
                    'id_city' => $city_state['id']
                ];
                
                $this->Neighborhood->add_neighborhood($params_neighborhood);
                
                /** select neighborhood from the chosen city */
                $neighborhood_city = $this->Neighborhood->get_all_neighborhoodCity($city_state['id'], $this->input->post('n_map_neighborhood'));

                //* save tb-place
                $params_place = [
                    'name' => $this->input->post('n_map_place'),
                    'id_neighborhood' => $neighborhood_city['id']
                ];
                
                $this->Places->add_places($params_place);

                /** select place from the chosen neighborhood */
                $place_neighborhood = $this->Places->get_all_placeNeighborhood($neighborhood_city['id'], $this->input->post('n_map_place'));

                //* save tb-address
                $params_address = [
                    'zipcode' => notformat_zipcode($this->input->post('n_map_zipcode')),
                    'id_place' => $place_neighborhood['id'],
                    'number' => $this->input->post('n_map_number')
                ];
                
                $this->Address->add_address($params_address);

                /** select address from the chosen place */
                $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('n_map_zipcode')));

                $params = [
                    'name' => $this->input->post('name'),
                    'id_address' => $address_place['id'],
                    'id_company' => intval($this->input->post('id_company')),
                    'information' => $this->input->post('information'),
                ];

                $this->WorkPlace->add_workplace($params);

                /** update address */
                $google = [
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')
                ];

                $this->Address->update_address($this->input->post('id_address'), $google);
            }

            $this->session->set_flashdata('flash_message', get_phrase('work_place_create'));
            redirect(base_url() .'admin/locais-trabalho', 'refresh');
        } else {
            $page_data['page_name']  = 'work_place/create';
            $page_data['page_title'] = get_phrase('work_places');
        }

        $page_data['js'] = load_js(['symee/google-maps/script-go-maps.js', 'symee/work-place/script.js']);
        $this->load->view('backend/index', $page_data);
    }

    /**
     * Edit the form for editing the specified workplace.
     *
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) { show_404(); }

        $page_data['workplace'] = $this->WorkPlace->get_workplace($id);

        /*- address -*/
        $id_adress = $page_data['workplace']['id_adress'];
        $page_data['address'] = $this->Address->get_all_address($id_adress);

        /*- company -*/
        if ($this->session->userdata('profile_id') == 1)
            $page_data['company'] = $this->Company->get_all_company();
        else
            $page_data['company'] = $this->Company->get_session_company($this->session->userdata('company_id'));
        
        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        if (isset($page_data['workplace']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {
                $params = [
                    'name' => $this->input->post('name'),
                    'id_address' => $this->input->post('id_address'),
                    'id_company' => $this->input->post('id_company'),
                    'information' => $this->input->post('information'),
                ];

                $this->WorkPlace->update_workplace($id, $params);

                /** update address */
                $google = [
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')
                ];

                $this->Address->update_address($params['id_address'], $google);

                $this->session->set_flashdata('flash_message', get_phrase('work_place_edit'));
                redirect(base_url() .'admin/locais-trabalho', 'refresh');
            } else {
                $page_data['page_name']  = 'work_place/edit';
                $page_data['page_title'] = get_phrase('work_places');
            }
        } else {
            show_error('The workplace you are trying to edit does not exist.');
        }

        $page_data['js'] = load_js(['symee/google-maps/script-go-maps.js']);
        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified workplace from storage.
     *
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $workplace = $this->Workplace->delete_workplace($id);

        // check if the workplace exists before trying to delete it
        if (isset($workplace['id'])) {
            $this->Workplace->delete_workplace($id);
            redirect('workplace/index');
        } else {
            show_error('The workplace you are trying to delete does not exist.');
        }
    }
}