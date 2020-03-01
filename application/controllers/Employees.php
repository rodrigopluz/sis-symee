<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employees Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Employees
 */
class Employees extends CI_Controller
{
    /**
     * @param Employee
     * @param Person
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Crud');
        $this->load->model('Person');
        $this->load->model('Company');
        $this->load->model('Profile');
        $this->load->model('Employee');

        $this->load->model('Address');
        $this->load->model('Places');
        $this->load->model('Neighborhood');
        $this->load->model('City');
        $this->load->model('States');
        $this->load->model('Country');

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of employee.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['employees'] = $this->Employee->get_all_employee();

        $page_data['page_menu']  = 'employee';
        $page_data['page_name']  = 'employee/index';
        $page_data['page_title'] = get_phrase('employee');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified employee.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['employee'] = $this->Employee->get_employee($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new employee.
     *
     * @return void
     */
    public function create()
    {
        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        /*- profile -*/
        $id = $page_data['employee']['id_profile'];;
        $page_data['profile'] = $this->Profile->get_all_profile($id);

        if (isset($_POST) && count($_POST) > 0) {
            $password = $this->input->post('password');
            $c_password = $this->input->post('confirm_password');

            //* check if cpf already exists
            $person = $this->Person->get_all_newperson(notformat_cpf($this->input->post('cpf_cnpj')), null);
            
            if ($password === $c_password and empty($person['cpf_cnpj'])) {
                /** select city from the chosen state */
                $city_state = $this->City->get_all_cityState($this->input->post('state_name'), $this->input->post('city'));
                
                //* save tb-neighborhood
                $p_neighborhood = [
                    'id_city' => $city_state['id'],
                    'name' => mb_strtoupper($this->input->post('neighborhood'))
                ];
                
                $this->Neighborhood->add_neighborhood($p_neighborhood);

                /** select neighborhood from the chosen city */
                $neighborhood_city = $this->Neighborhood->get_all_neighborhoodCity($city_state['id'], $this->input->post('neighborhood'));

                //* save tb-place
                $p_place = [
                    'name' => $this->input->post('place'),
                    'id_neighborhood' => $neighborhood_city['id']
                ];
                
                $this->Places->add_places($p_place);

                /** select place from the chosen neighborhood */
                $place_neighborhood = $this->Places->get_all_placeNeighborhood($neighborhood_city['id'], $this->input->post('place'));

                //* save tb-address
                $p_address = [
                    'id_place' => $place_neighborhood['id'],
                    'number' => $this->input->post('number'),
                    'complement' => $this->input->post('complement'),
                    'zipcode' => notformat_zipcode($this->input->post('zipcode'))
                ];
                
                $this->Address->add_address($p_address);

                /** select address from the chosen place */
                $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('zipcode')));
                
                $data_nasc = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('data_nasc'))));

                //* save tb-person
                $p_person = [
                    'data_nasc' => $data_nasc,
                    'id_address' => $address_place['id'],
                    'sexo' => $this->input->post('sexo'),
                    'type' => $this->input->post('type_pf'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'status' => $this->input->post('status'),
                    'name' => $this->input->post('person_name'),
                    'cpf_cnpj' => notformat_cpf($this->input->post('cpf_cnpj')),
                    'nationality' => $this->input->post('nationality')
                ];
                
                $this->Person->add_person($p_person);

                /** select person from the chosen person */
                $person_address = $this->Person->get_all_personEmployee($address_place['id'], notformat_cpf($this->input->post('cpf_cnpj')));
                
                //* save tb-employee
                $p_employee = [
                    'id_person' => $person_address['id'],
                    'status' => $this->input->post('status'),
                    'login' => notformat_cpf($this->input->post('cpf_cnpj')),
                    'password' => $this->input->post('password'),
                    'occupation' => $this->input->post('occupation'),
                    'last_login' => $this->input->post('last_login'),
                ];

                $this->Employee->add_employee($p_employee);
                $this->session->set_flashdata('flash_message', get_phrase('employee_create'));
            } else {
                $this->session->set_flashdata('flash_message_error', get_phrase('password_mismatch'));
            }

            redirect(base_url() .'admin/usuario-empregado', 'refresh');
        } else {
            $page_data['page_name']  = 'employee/create';
            $page_data['page_title'] = get_phrase('employee');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified employee.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) { show_404(); }

        $page_data['employee'] = $this->Employee->get_employee($id);

        /*- person -*/
        $id_person = $page_data['employee']['id_person'];
        $page_data['person'] = $this->Person->get_all_person($id_person);

        /*- profile -*/
        $id_profile = $page_data['employee']['id_profile'];
        $page_data['profile'] = $this->Profile->get_all_profile($id_profile);

        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        if (isset($page_data['employee']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                /** select city from the chosen state */
                $city_state = $this->City->get_all_cityState($this->input->post('state_name'), $this->input->post('city'));
                
                //* save tb-neighborhood
                $p_neighborhood = [
                    'id_city' => $city_state['id'],
                    'name' => mb_strtoupper($this->input->post('neighborhood'))
                ];
                
                $this->Neighborhood->update_neighborhood($this->input->post('id_neighborhood'), $p_neighborhood);

                /** select neighborhood from the chosen city */
                $neighborhood_city = $this->Neighborhood->get_all_neighborhoodCity($city_state['id'], $this->input->post('neighborhood'));
                
                //* save tb-place
                $p_place = [
                    'name' => $this->input->post('place'),
                    'id_neighborhood' => $neighborhood_city['id']
                ];
                
                $this->Places->update_places($this->input->post('id_place'), $p_place);
                
                /** select place from the chosen neighborhood */
                $place_neighborhood = $this->Places->get_all_placeNeighborhood($neighborhood_city['id'], $this->input->post('place'));
                
                //* save tb-address
                $p_address = [
                    'id_place' => $place_neighborhood['id'],
                    'number' => $this->input->post('number'),
                    'complement' => $this->input->post('complement'),
                    'zipcode' => notformat_zipcode($this->input->post('zipcode'))
                ];
                
                $this->Address->update_address($this->input->post('id_address'), $p_address);
                
                /** select address from the chosen place */
                $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('zipcode')));
                
                $data_nasc = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('data_nasc'))));

                //* save tb-person
                $p_person = [
                    'data_nasc' => $data_nasc,
                    'id_address' => $address_place['id'],
                    'sexo' => $this->input->post('sexo'),
                    'type' => $this->input->post('type_pf'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'status' => $this->input->post('status'),
                    'name' => $this->input->post('name'),
                    'cpf_cnpj' => notformat_cpf($this->input->post('login')),
                    'nationality' => $this->input->post('nationality')
                ];
                
                $this->Person->update_person($this->input->post('id_person'), $p_person);
                
                /** select person from the chosen person */
                $person_address = $this->Person->get_all_personEmployee($address_place['id'], notformat_cpf($this->input->post('login')));

                //* save tb-employee
                $params = [
                    'id_person' => $person_address['id'],
                    'status' => $this->input->post('status'),
                    'occupation' => $this->input->post('occupation'),
                    'login' => $this->input->post('login'),
                    'password' => $this->input->post('password'),
                    'reset' => '0',
                ];

                $this->Employee->update_employee($id,$params);

                //* method upload file image
                if ($_FILES["file"]['name'] != null) {
                    $avatar = $id;
                    $upload_dir = "./uploads/admin_image";
                    $ext = pathinfo($this->input->post('avatar'), PATHINFO_EXTENSION);
                    
                    $input_file = $avatar .'.'. $ext;

                    // Check the upload and do it
                    if (!isset($_FILES["file"]) || !is_uploaded_file($_FILES["file"]["tmp_name"]) || $_FILES["file"]["error"] != 0):
                        echo "ERROR: invalid upload";
                        exit(0);
                    endif;

                    $tmp_file = $_FILES['file']['tmp_name'];
                    $filename = $upload_dir .'/'. $input_file;
                    move_uploaded_file($tmp_file, $filename);

                    $p_person = [
                        'avatar' => $input_file
                    ];

                    $this->Person->update_person($avatar, $p_person);
                }

                $this->session->set_flashdata('flash_message', 'salvo');
                redirect(base_url() .'admin/usuario-empregado', 'refresh');
            } else {
                $page_data['page_menu']  = 'employee';
                $page_data['page_name']  = 'employee/edit';
                $page_data['page_title'] = get_phrase('employee');
            }
        } else {
            show_error('The employee you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified employee from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        // check if the employee exists before trying to delete it
        if (isset($id)) {
            $param = ['status' => '-1'];
            $this->Person->update_person($id, $param);

            $this->session->set_flashdata('flash_message', get_phrase('delete_success'));
            redirect(base_url() .'admin/usuario-empregado', 'refresh');
        } else {
            show_error('The employee you are trying to delete does not exist.');
        }
    }
}