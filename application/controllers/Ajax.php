<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Ajax Controller
 *
 * @author       : Rodrigo Pereira da Luz
 * e-mail        : rodrigopluz@gmail.com
 * item          : Sistema Web - Symee
 * specification : Class Ajax
 */
class Ajax extends CI_Controller
{
    /**
     * @param Contract
     * @param Company
     * @param Employee
     * @param FunctionRole
     * @param UserCompany
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');

        $this->load->model('Person');
        $this->load->model('Company');
        $this->load->model('Contract');
        $this->load->model('Employee');
        $this->load->model('UserCompany');
        $this->load->model('FunctionRole');
        $this->load->model('FunctionCategory');
        $this->load->model('NotificationHistory');
        $this->load->model('CompanyFunctionCategory');

        $this->load->library('session');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    /**
     * ajax - consulta vinculos
     */
    public function ajax_entail()
    {
        $resp     = [];
        $document = notformat_cpfcnpj($this->input->post('document'));

        if (!isset($document)) {
            show_404();
        }

        //* employee
        $page_data['entail'] = $this->Employee->get_employee_entail($document);

        //* company
        $page_data['company'] = $this->Company->get_company($this->session->userdata('company_id'));

        //* contract-entail
        $company = $page_data['company']['id'];
        $employee = $page_data['entail']['id'];

        $page_data['contract'] = $this->Contract->get_all_contract_query($company, $employee, null);

        $resp = [
            'entail' => $page_data['entail'],
            'company' => $page_data['company'],
            'contract' => $page_data['contract']
        ];

        //* verifica se o usuario-empregado tem um vinculo que estaja ativo, com a empresa que esta fazendo a nova solicitação.
        if ($resp['contract']['id_employee'] == $employee and $resp['contract']['id_company'] == $company and $resp['contract']['status'] == 1) {
            $resp = null;
        }

        echo json_encode($resp);
    }

    /**
     * ajax - search-function
     */
    public function ajax_search_function()
    {
        $result    = [];
        $category  = $this->input->post('category');

        if (!isset($category)) {
            show_404();
        }

        //* function
        $page_data['functions'] = $this->FunctionRole->get_category_function_role($category);

        $result = [
            'status' => 'ok',
            'froles' => $page_data['functions']
        ];

        echo json_encode($result);
    }

    /**
     * ajax - notification
     */
    public function ajax_call_notification()
    {
        $result = [];

        //* data inputs
        $data = [
            'name' => $this->input->post('name'),
            'role' => $this->input->post('role'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'cnaes' => $this->input->post('cnaes'),
            'token' => $this->input->post('token'),
            'model' => $this->input->post('model'),
            'device' => $this->input->post('device'),
            'company' => $this->input->post('company'),
            'time_hour' => $this->input->post('time_hour'),
            'data_start' => format_date($this->input->post('dt_start')),
            'document' => notformat_cpfcnpj($this->input->post('cpf_cnpj'))
        ];

        //* office-visit tb-employee
        $person = $this->Employee->get_employee_entail($data['document']);

        //* office-visit tb-function-role
        $frole = $this->FunctionRole->get_function_role($data['role']);

        //* query in the contract table if you have the passed parameters
        $id_company = $this->session->userdata('company_id');
        $id_employee = $person['employee_id'];
        $id_function = $data['role'];

        $contract_query = $this->Contract->get_all_contract_query($id_company, $id_employee, $id_function);
        $row = $contract_query->row();

        if (empty($row)) {
            //* save pre-contract
            $contract = [
                'id_company' => $id_company,
                'id_employee' => $id_employee,
                'id_function' => $id_function,
                'id_user_company' => $this->session->userdata('login_user_id'),
                'start_date' => $data['data_start'],
                // 'end_date' => null,
                'time_hour' => $data['time_hour'],
                'status' => '0'
            ];

            $id_contract = $this->Contract->add_contract($contract);
        } else {
            $id_contract = $row->id;
        }

        $type = 'NV';
        $delivered = '1';

        // $this->push_notification_history(
        //     $data['device'],
        //     $id_contract,
        //     $data['document'],
        //     $data['company'],
        //     $frole['name'],
        //     $data['data_start'],
        //     $delivered,
        //     $type,
        //     $data['token']
        // );

        $result = ['status' => 'ok'];
        echo json_encode($result);
    }

    /**
     * ajax-cancela-vinculo
     */
    public function ajax_cancel()
    {
        $id_contract = $this->input->post('id_contract');
        $id_company  = $this->input->post('id_company');
        $id_employee = $this->input->post('id_employee');
        $id_user_company = $this->session->userdata('login_user_id');

        $type = 'NC';
        $delivered = '1';
        $date = date('Y-m-d');
        $params = [
            'status' => '3',
            'end_date' => $date,
            'id_user_company' => $id_user_company
        ];

        $person = $this->Employee->get_employee_device($id_employee);
        $this->Contract->update_contract($id_contract, $params);
        // $this->push_notification_history(
        //     $person['id_device'],
        //     $id_contract,
        //     $person['login'],
        //     $person['business_name'],
        //     $person['frole_name'],
        //     $person['start_date'],
        //     $delivered,
        //     $type,
        //     $person['token']
        // );

        $result = ['status' => 'ok'];
        echo json_encode($result);
    }

    /**
     * ajax-refresh-vinculo
     */
    public function ajax_refresh()
    {
        $id_contract = $this->input->post('id_contract');
        $id_company  = $this->input->post('id_company');
        $id_employee = $this->input->post('id_employee');
        $id_user_company = $this->session->userdata('login_user_id');

        $type = 'NR';
        $delivered = '1';
        $params = [
            'id_user_company' => $id_user_company
        ];

        $person = $this->Employee->get_employee_device($id_employee);
        $this->Contract->update_contract($id_contract, $params);

        // $this->push_notification_history(
        //     $person['id_device'],
        //     $id_contract,
        //     $person['login'],
        //     $person['business_name'],
        //     $person['frole_name'],
        //     $person['start_date'],
        //     $delivered,
        //     $type,
        //     $person['token']
        // );

        $result = ['status' => 'ok'];
        echo json_encode($result);
    }

    /**
     * ajax-close
     */
    public function ajax_close()
    {
        $resp = [];
        $id_contract  = $this->input->post('contract');
        $date_end = format_date($this->input->post('dt_end'));
        $id_user_company = $this->session->userdata('login_user_id');

        if (!isset($id_contract)) {
            show_404();
        }

        $params = [
            'status' => '4',
            'end_date' => $date_end,
            'id_user_company' => $id_user_company
        ];

        $this->Contract->update_contract($id_contract, $params);
        echo json_encode($resp);
    }

    /**
     * get-listener entails
     */
    public function ajax_listener()
    {
        $response = 'Symee';
        echo json_encode($response);
    }

    /**
     * ajax-search
     */
    public function ajax_search()
    {
        $resp  = [];
        $search = $this->input->post('query');

        $query = $this->FunctionCategory->get_like_function_category($search);

        if ($query) {
            foreach ($query as $row) {
                $resp[] = [
                    'id' => $row['id'],
                    'label' => $row['category'],
                    'id_company' => $row['id_company']
                ];
            }
        }

        echo json_encode($resp);
    }

    /**
     * ajax add-activity
     */
    public function ajax_add_activity()
    {
        $id_company = $this->input->post('id_company');
        $id_category = $this->input->post('id_category');

        $params = [
            'id_function_category' => $id_category,
            'id_company' => $id_company
        ];

        $query = $this->CompanyFunctionCategory->add_company_function_category($params);
        $resp = ['status' => 'ok'];

        echo json_encode($resp);
    }

    /**
     * ajax-active-entail
     */
    public function ajax_active()
    {
        $id_company = $this->input->post('id_company');
        $id_category = $this->input->post('id_category');

        //* select relationships 
        $selects = $this->CompanyFunctionCategory->get_company_function_category_type($id_company);
        foreach ($selects as $select) {
            if ($select['type'] == 'P') $select['type'] = 'N';
            else $select['type'] = 'P';

            $params = [
                'id_function_category' => $select['id_function_category'],
                'id_company' => $select['id_company'],
                'type' => $select['type']
            ];

            $query = $this->CompanyFunctionCategory->update_company_function_category($params);
        }

        $result = ['status' => 'ok'];
        echo json_encode($result);
    }

    /**
     * ajax-mac-address
     */
    public function ajax_mac_address()
    {
        $result = [];

        $id_company = $this->input->post('id_company');

        dump($id_company);
        exit;

        $result = ['status' => 'ok'];
        echo json_encode($result);
    }

    /**
     * ajax-email
     */
    public function ajax_email()
    {
        $email = $this->input->post('email');
        $select = $this->Person->ajax_email($email);

        $result = ['status' => 'ok', 'email' => $select['email']];
        echo json_encode($result);
    }

    /**
     * ajax-login
     */
    public function ajax_login_cpf()
    {
        $login = $this->input->post('login');
        $select = $this->Person->ajax_login($login);

        $result = ['status' => 'ok', 'login' => $select['cpf_cnpj']];
        echo json_encode($result);
    }

    /**
     * ajax return company
     */
    public function ajax_company()
    {
        $result = [];
        $id_company = $this->input->post('company');
        $selects = $this->Company->get_session_company($id_company);

        foreach ($selects as $select) {
            $result[] = [
                'status' => 'ok',
                'result' => $select
            ];
        }

        echo json_encode($result[0]);
    }

    /**
     * ajax - jornada-trabalho
     */
    public function ajax_work_day()
    {
        $week = 'w';
        $result = [];
        $dateRange = [];
        $week_number = 'W';

        $dateStart = $this->input->post('inicio');
        $dateStart = implode('-', array_reverse(explode('/', substr($dateStart, 0, 10)))) . substr($dateStart, 10);
        $dateStart = new DateTime($dateStart);

        $dateEnd = $this->input->post('final');
        $dateEnd = implode('-', array_reverse(explode('/', substr($dateEnd, 0, 10)))) . substr($dateEnd, 10);
        $dateEnd = new DateTime($dateEnd);

        while ($dateStart <= $dateEnd) {
            $dateRange[] = $dateStart->format('d/m/Y - ' . $week . ' - ' . $week_number);
            $dateStart = $dateStart->modify('+1day');
        }

        $result = ['status' => 'ok', 'result' => $dateRange];
        echo json_encode($result);
    }
}
