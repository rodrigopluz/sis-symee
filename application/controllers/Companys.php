<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Companys Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Companys
 */
class Companys extends CI_Controller
{
    /**
     * @param Company
     * @param Address
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

        /** models */
        $this->load->model('Crud');
        $this->load->model('City');
        $this->load->model('Plan');
        $this->load->model('Places');
        $this->load->model('States');
        $this->load->model('Company');
        $this->load->model('Address');
        $this->load->model('Country');
        $this->load->model('Neighborhood');
        $this->load->model('FunctionCategory');
        $this->load->model('CompanyFunctionCategory');

        /** cache control */
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of company.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        if ($this->session->userdata('profile_id') == 1) 
            $page_data['companies'] = $this->Company->get_all_company();
        else 
            $page_data['companies'] = $this->Company->get_session_company($this->session->userdata('company_id'));
        
        $page_data['page_menu']  = 'company';
        $page_data['page_name']  = 'company/index';
        $page_data['page_title'] = get_phrase('company');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified company.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['company'] = $this->Company->get_company($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new company.
     *
     * @return void
     */
    public function create()
    {
        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        /*- plans -*/
        $page_data['plans'] = $this->Plan->get_all_plan();
        
        if (isset($_POST) && count($_POST) > 0) {
            /** select city from the chosen state */
            $city_state = $this->City->get_all_cityState($this->input->post('state_name'), $this->input->post('city'));
            
            //* save tb-neighborhood
            $params_neighborhood = [
                'name' => mb_strtoupper($this->input->post('neighborhood')),
                'id_city' => $city_state['id']
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
                'zipcode' => notformat_zipcode($this->input->post('zipcode')),
                'id_place' => $place_neighborhood['id'],
                'number' => $this->input->post('number'),
                'complement' => $this->input->post('complement')
            ];
            
            $this->Address->add_address($params_address);
            
            /** select address from the chosen place */
            $address_place = $this->Address->get_all_addressPlace($place_neighborhood['id'], notformat_zipcode($this->input->post('zipcode')));

            //* save tb-company
            $params_company = [
                'business_name' => $this->input->post('business_name'),
                'fantasy_name' => $this->input->post('fantasy_name'),
                'cnpj' => notformat_cnpj($this->input->post('cnpj')),
                'state_registration' => $this->input->post('state_registration'),
                'phone' => $this->input->post('phone'),
                'fax' => $this->input->post('fax'),
                'site' => $this->input->post('site'),
                'email' => $this->input->post('email'),
                'id_address' => $address_place['id'],
                'id_plan' => $this->input->post('type')
            ];

            $this->Company->add_company($params_company);

            /** select company from the chosen function_category */
            $company_function = $this->Company->get_insert_id();

            //* save tb-company-function-category
            $params_company_function_category = [
                'id_function_category' => $this->input->post('id_category'),
                'id_company' => $company_function
            ];

            $this->CompanyFunctionCategory->add_company_function_category($params_company_function_category);

            //* after saving the log, saves the image with the saved log id.
            if ($_FILES["file"]['name'] != null) {
                $logo = $company_function;
                $upload_dir = "./uploads/admin_logo";
                $ext = pathinfo($this->input->post('file'), PATHINFO_EXTENSION);
                
                $input_file = $logo .'.'. $ext;

                // Check the upload and do it
                if (!isset($_FILES["file"]) || !is_uploaded_file($_FILES["file"]["tmp_name"]) || $_FILES["file"]["error"] != 0):
                    echo "ERROR: invalid upload";
                    exit(0);
                endif;

                $tmp_file = $_FILES['file']['tmp_name'];
                $filename = $upload_dir .'/'. $input_file;
                move_uploaded_file($tmp_file, $filename);

                $param_company = [
                    'image' => $input_file
                ];

                $this->Company->update_company($logo, $param_company);
            }

            $this->session->set_flashdata('flash_message', get_phrase('company_create'));
            redirect(base_url() . 'admin/empresas', 'refresh');
        } else {
            $page_data['page_name']  = 'company/create';
            $page_data['page_title'] = get_phrase('company');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified company.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        /*- companys -*/
        $page_data['company'] = $this->Company->get_company($id);

        /*- plans -*/
        $page_data['plans'] = $this->Plan->get_all_plan();

        /*- states -*/
        $page_data['state'] = $this->States->get_all_states();

        /*- countrys -*/
        $page_data['country'] = $this->Country->get_all_country();

        /*- activitys -*/
        $page_data['activity'] = $this->CompanyFunctionCategory->get_company_function_category($id);

        if (isset($page_data['company']['id'])) {
            if ($this->input->method() === 'post') {
                //* save tb-neighborhood
                $id_neighborhood = $this->input->post('id_neighborhood');
                $params_neighborhood = [
                    'name' => $this->input->post('neighborhood'),
                    'id_city' => $this->input->post('id_city')
                ];

                $this->Neighborhood->update_neighborhood($id_neighborhood, $params_neighborhood);
                
                //* save tb-place
                $id_place = $this->input->post('id_place');
                $params_place = [
                    'name' => $this->input->post('place'),
                    'id_neighborhood' => $this->input->post('id_neighborhood')
                ];

                $this->Places->update_places($id_place, $params_place);

                //* save tb-address
                $id_address = $this->input->post('id_address');
                $params_address = [
                    'zipcode' => notformat_zipcode($this->input->post('zipcode')),
                    'id_place' => $this->input->post('id_place'),
                    'number' => $this->input->post('number'),
                    'complement' => $this->input->post('complement')
                ];

                $this->Address->update_address($id_address, $params_address);

                //* method upload file image
                if ($_FILES["file"]['name'] != null) {
                    $logo = $id;
                    $upload_dir = "./uploads/admin_logo";                    
                    $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);

                    $input_file = $logo .'.'. $ext;

                    // Check the upload and do it
                    if (!isset($_FILES["file"]) || !is_uploaded_file($_FILES["file"]["tmp_name"]) || $_FILES["file"]["error"] != 0):
                        echo "ERROR: invalid upload";
                        exit(0);
                    endif;

                    $tmp_file = $_FILES['file']['tmp_name'];
                    $filename = $upload_dir .'/'. $input_file;
                    move_uploaded_file($tmp_file, $filename);
                } else {
                    $input_file = $this->input->post('file');
                }

                //* save tb-company
                $params_company = [
                    'business_name' => $this->input->post('business_name'),
                    'fantasy_name' => $this->input->post('fantasy_name'),
                    'cnpj' => notformat_cnpj($this->input->post('cnpj')),
                    'state_registration' => $this->input->post('state_registration'),
                    'phone' => $this->input->post('phone'),
                    'fax' => $this->input->post('fax'),
                    'site' => $this->input->post('site'),
                    'email' => $this->input->post('email'),
                    'whatsapp' => $this->input->post('whatsapp'),
                    'id_address' => $this->input->post('id_address'),
                    'id_plan' => $this->input->post('type'),
                    'image' => $input_file
                ];

                $this->Company->update_company($id, $params_company);

                $this->session->set_flashdata('flash_message', get_phrase('company_updated'));
                redirect(base_url() . 'admin/empresas', 'refresh');
            } else {
                $page_data['page_name']  = 'company/edit';
                $page_data['page_title'] = get_phrase('company');
            }
        } else {
            show_error(get_phrase('edit_company'));
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified company from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) { show_404(); }

        // check if the company exists before trying to delete it
        if (isset($id)) {
            $this->Company->delete_company($id);
            redirect(base_url() . 'admin/empresas', 'refresh');
        } else {
            show_error('The company you are trying to delete does not exist.');
        }
    }
}