<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserCompanys Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class UserCompanys
 */
class UserCompanys extends CI_Controller
{
    /**
     * @param Person
     * @param Company
     * @param Profile
     * @param UserCompany
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('js');
        $this->load->helper('dump');
        $this->load->library('session');

        $this->load->model('Crud');
        $this->load->model('Person');
        $this->load->model('Company');
        $this->load->model('Profile');
        $this->load->model('UserCompany');

        $this->load->model('Address');
        $this->load->model('Places');
        $this->load->model('Neighborhood');
        $this->load->model('City');
        $this->load->model('States');
        $this->load->model('Country');

        /* cache control */
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of user_company.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        if ($this->session->userdata('profile_id') == 1)
            $page_data['user_companies'] = $this->UserCompany->get_all_user_company();
        else
            $page_data['user_companies'] = $this->UserCompany->get_session_user_company($this->session->userdata('company_id'));

        $page_data['page_menu']  = 'user_company';
        $page_data['page_name']  = 'user_company/index';
        $page_data['page_title'] = get_phrase('users') .' '. get_phrase('employers');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified user-company.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['user_company'] = $this->UserCompany->get_user_company($id);
        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new user-company.
     *
     * @return void
     */
    public function create()
    {
        $page_data['user_company'] = $this->UserCompany->get_user_company($id);
        
        /*- company -*/
        $id_company = $page_data['user_company']['id_company'];
        $page_data['company'] = $this->Company->get_all_company($id_company);

        /*- profile -*/
        $id_profile = $page_data['user_company']['id_profile'];
        $page_data['profile'] = $this->Profile->get_all_profile($id_profile);

        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        if (isset($_POST) && count($_POST) > 0) {
            //* check if cpf_cnpj or email already exists
            // $password = $this->input->post('password');
            // $c_password = $this->input->post('confirm_password');
            // $email = $this->input->post('email');
            // $person = $this->Person->get_all_newperson(notformat_cpf($this->input->post('login')), $email);
            // if (empty($person['cpf_cnpj']) or empty($person['email'])) {
            // } else {
            //     if ($person['email']) $this->session->set_flashdata('flash_message_error', 'Email já cadastrado no sistema.');
            //     if ($person['cpf']) $this->session->set_flashdata('flash_message_error', 'CPF já cadastrado no sistema.');
            // }

            /** select city from the chosen state */
            $city_state = $this->City->get_all_cityState($this->input->post('state_name'), $this->input->post('city'));
            
            //* save tb-neighborhood
            $params_neighborhood = [
                'id_city' => $city_state['id'],
                'name' => mb_strtoupper($this->input->post('neighborhood'))
            ];
            
            $this->Neighborhood->add_neighborhood($params_neighborhood);

            /** select neighborhood from the chosen city */
            $neighborhood_city = $this->Neighborhood->get_all_neighborhoodCity($city_state['id'], $this->input->post('neighborhood'));

            //* save tb-place
            $params_place = [
                'name' => $this->input->post('place'),
                'id_neighborhood' => $neighborhood_city['id']
            ];
            
            $this->Places->add_places($params_place);

            /** select place from the chosen neighborhood */
            $place_neighborhood = $this->Places->get_all_placeNeighborhood($neighborhood_city['id'], $this->input->post('place'));

            //* save tb-address
            $params_address = [
                'id_place' => $place_neighborhood['id'],
                'number' => $this->input->post('number'),
                'complement' => $this->input->post('complement'),
                'zipcode' => notformat_zipcode($this->input->post('zipcode'))
            ];
            
            $this->Address->add_address($params_address);

            /** select address from the chosen place */
            $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('zipcode')));
            
            $data_nasc = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('data_nasc'))));

            //* save tb-person
            $params_person = [
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
            
            $this->Person->add_person($params_person);

            /** select person from the chosen person */
            $person_address = $this->Person->get_all_personEmployee($address_place['id'], notformat_cpf($this->input->post('login')));
            
            //* save tb-user-company
            $password = substr(md5(rand(100000000,20000000000)),0,7);

            $params_usercompany = [
                'id_person' => $person_address['id'],
                'id_company' => $this->input->post('id_company'),
                'id_profile' => $this->input->post('id_profile'),
                'login' => notformat_cpf($this->input->post('login')),
                'password' => md5($password),
                'status' => $this->input->post('status'),
                'reset' => '1',
            ];
            
            $this->UserCompany->add_user_company($params_usercompany);

            //* method upload file image
            if ($_FILES["file"]['name'] != null) {
                $avatar = $person_address['id'];
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

                $param_person = [
                    'avatar' => $input_file
                ];

                $this->Person->update_person($avatar, $param_person);
            }
            
            //* send new password to user email
            $email = $this->input->post('email');
            $profile = $this->input->post('id_profile');
            $pass = $password;

            $this->Email->account_opening_email($profile, $email, $pass);
            $this->session->set_flashdata('flash_message', get_phrase('user_company_create'));
            redirect(base_url() .'admin/usuario-empresa', 'refresh');
        } else {
            $page_data['page_name']  = 'user_company/create';
            $page_data['page_title'] = get_phrase('users') .' '. get_phrase('employers');
        }

        $page_data['js'] = load_js(['symee/user-company/script.js']);
        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified user-company.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) { show_404(); }

        $page_data['user_company'] = $this->UserCompany->get_user_company($id);
        
        /*- person -*/
        $id_person = $page_data['user_company']['id_person'];
        $page_data['person'] = $this->Person->get_all_person($id_person);

        /*- company -*/
        $id_company = $page_data['user_company']['id_company'];
        $page_data['company'] = $this->Company->get_all_company($id_company);

        /*- profile -*/
        $id_profile = $page_data['user_company']['id_profile'];
        $page_data['profile'] = $this->Profile->get_all_profile($id_profile);

        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        if (isset($page_data['user_company']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {
                /** select city from the chosen state */
                $city_state = $this->City->get_all_cityState($this->input->post('state_name'), $this->input->post('city'));
                
                //* save tb-neighborhood
                $params_neighborhood = [
                    'id_city' => $city_state['id'],
                    'name' => mb_strtoupper($this->input->post('neighborhood'))
                ];
                
                $this->Neighborhood->update_neighborhood($this->input->post('id_neighborhood'), $params_neighborhood);

                /** select neighborhood from the chosen city */
                $neighborhood_city = $this->Neighborhood->get_all_neighborhoodCity($city_state['id'], $this->input->post('neighborhood'));
                
                //* save tb-place
                $params_place = [
                    'name' => $this->input->post('place'),
                    'id_neighborhood' => $neighborhood_city['id']
                ];
                
                $this->Places->update_places($this->input->post('id_place'), $params_place);
                
                /** select place from the chosen neighborhood */
                $place_neighborhood = $this->Places->get_all_placeNeighborhood($neighborhood_city['id'], $this->input->post('place'));
                
                //* save tb-address
                $params_address = [
                    'id_place' => $place_neighborhood['id'],
                    'number' => $this->input->post('number'),
                    'complement' => $this->input->post('complement'),
                    'zipcode' => notformat_zipcode($this->input->post('zipcode'))
                ];
                
                $this->Address->update_address($this->input->post('id_address'), $params_address);
                
                /** select address from the chosen place */
                $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('zipcode')));
                
                $data_nasc = date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('data_nasc'))));

                //* save tb-person
                $params_person = [
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
                
                $this->Person->update_person($this->input->post('id_person'), $params_person);
                
                /** select person from the chosen person */
                $person_address = $this->Person->get_all_personEmployee($address_place['id'], notformat_cpf($this->input->post('login')));
                
                //* save tb-user-company
                $params_usercompany = [
                    'id_person' => $person_address['id'],
                    'id_company' => $this->input->post('id_company'),
                    'id_profile' => $this->input->post('id_profile'),
                    'login' => notformat_cpf($this->input->post('login')),
                    'password' => $this->input->post('password'),
                    'status' => $this->input->post('status'),
                    'reset' => '0',
                ];
                
                $this->UserCompany->update_user_company($id, $params_usercompany);

                //* method upload file image
                if ($_FILES["file"]['name'] != null) {
                    $avatar = $person_address['id'];
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

                    $param_person = [
                        'avatar' => $input_file
                    ];

                    $this->Person->update_person($avatar, $param_person);
                }

                $this->session->set_flashdata('flash_message', get_phrase('user_company_updated'));
                redirect(base_url() .'admin/usuario-empresa', 'refresh');
            } else {
                $page_data['page_menu']  = 'user_company';
                $page_data['page_name']  = 'user_company/edit';
                $page_data['page_title'] = get_phrase('users') .' '. get_phrase('employers');
            }
        } else {
            show_error('The user_company you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified user-company from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) { show_404(); }

        // check if the user_company exists before trying to delete it
        if (isset($id)) {
            $param = ['status' => '-1'];
            
            $this->Person->update_person($id, $param);
            $this->UserCompany->update_person_user_company($id, $param);

            $this->session->set_flashdata('flash_message', get_phrase('delete_success'));
            redirect(base_url() .'admin/usuario-empresa', 'refresh');
        } else {
            show_error('The user_company you are trying to delete does not exist.');
        }
    }
}