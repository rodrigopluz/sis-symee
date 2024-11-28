<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Contract Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Contract extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get contract by id
     */
    public function get_contract($id)
    {
        $this->db->select('c.*,
                           cp.business_name, cp.cnpj,
                           pe.name AS pe_name, pe.email, pe.phone, pe.type, pe.cpf_cnpj,
                           fr.name AS function_name, fr.id_function_category,
                           fc.category,
                           pu.name AS pu_name,
                           de.token, de.employee_id, de.status, de.uuid, de.model, de.id AS id_device')
            ->from('contract c')
            ->join('company cp', 'cp.id = c.id_company', 'left')
            ->join('employee e', 'e.id = c.id_employee', 'left')
            ->join('person pe', 'pe.id = e.id_person', 'left')
            ->join('device de', 'de.employee_id = e.id', 'left')
            ->join('function_role fr', 'fr.id = c.id_function', 'left')
            ->join('function_category fc', 'fc.id = fr.id_function_category', 'left')
            ->join('user_company u', 'u.id = c.id_user_company', 'left')
            ->join('person pu', 'pu.id = u.id_person', 'left')
            ->where(['c.id' => $id]);

        $query = $this->db->get()->row_array();
        return $query;
    }

    /**
     * Get all contract
     */
    public function get_all_contract()
    {
        $this->db->select('c.*, cp.business_name, cp.cnpj, pe.name AS pe_name, fr.name AS function_name, pu.name AS pu_name')
            ->distinct()
            ->from('contract c')
            ->join('company cp', 'cp.id = c.id_company', 'left')
            ->join('employee e', 'e.id = c.id_employee', 'left')
            ->join('person pe', 'pe.id = e.id_person', 'left')
            ->join('function_role fr', 'fr.id = c.id_function', 'left')
            ->join('user_company u', 'u.id = c.id_user_company', 'left')
            ->join('person pu', 'pu.id = u.id_person', 'left')
            ->order_by('id', 'desc');

        if ($this->session->userdata('profile_id') == 1) {
            $query = $this->db->get_where('contract')->result_array();
        } else {
            $query = $this->db->get_where('contract', ['c.id_company' => $this->session->userdata('company_id')])->result_array();
        }

        return $query;
    }

    /**
     * function to add new contract
     */
    public function add_contract($params)
    {
        $this->db->insert('contract', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update contract
     */
    public function update_contract($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('contract', $params);
    }

    /**
     * function to delete contract
     */
    public function delete_contract($id)
    {
        return $this->db->delete('contract', ['id' => $id]);
    }

    /**
     * get-all-contract-query
     */
    public function get_all_contract_query($id_company, $id_employee, $id_function = null)
    {
        $this->db->select('c.*')
            ->from('contract c')
            ->order_by('c.id', 'desc');

        if ($id_function == null) {
            $query = $this->db->get_where('contract', ['c.id_company' => $id_company, 'c.id_employee' => $id_employee])->row_array();
        } else {
            $query = $this->db->get_where('contract', ['c.id_company' => $id_company, 'c.id_employee' => $id_employee, 'c.id_function' => $id_function]);
        }

        return $query;
    }

    /**
     * get-contract-files by id
     */
    public function get_contract_files($id)
    {
        $this->db->select('c.*,
                           cp.business_name, cp.cnpj,
                           fl.id AS id_file, fl.file_name, fl.id_contract, fl.file_size, fl.file_type')
            ->from('contract c')
            ->join('company cp', 'cp.id = c.id_company', 'left')
            ->join('file_pdf fl', 'fl.id_contract = c.id', 'left')
            ->where(['c.id' => $id]);

        $query = $this->db->get()->result_array();

        return $query;
    }

    /**
     * Get all contract
     */
    public function get_all_contract_by_employee($id_employee)
    {
        $this->db->select('c.*, cp.business_name, cp.cnpj, pe.name AS pe_name, fr.name AS function_name, pu.name AS pu_name, fc.category, count(cv.id) as qtd_convocations')
            ->distinct()
            ->from('contract c')
            ->join('company cp', 'cp.id = c.id_company', 'left')
            ->join('employee e', 'e.id = c.id_employee', 'left')
            ->join('person pe', 'pe.id = e.id_person', 'left')
            ->join('function_role fr', 'fr.id = c.id_function', 'left')
            ->join('function_category fc', 'fr.id_function_category = fc.id', 'left')
            ->join('user_company u', 'u.id = c.id_user_company', 'left')
            ->join('person pu', 'pu.id = u.id_person', 'left')
            ->join('workplace wp', 'wp.id_company = cp.id', 'left')
            ->join('workday wd', 'wd.id_workplace = wp.id', 'left')
            ->join('convocation cv', 'cv.id_workday = wd.id', 'left')
            ->where('c.id_employee' , $id_employee)
            ->group_by('c.id')
            ->order_by('id', 'desc');
        

        $query = $this->db->get()->result_array();

        return $query;
    }

    /**
     * count-contract actives
     */
    public function get_count_contract()
    {
        $this->db->order_by('id', 'desc');
        
        if ($this->session->userdata('profile_id') == 1) {
            $query = $this->db->get_where('contract')->result_array();
        } else {
            $query = $this->db->get_where('contract', ['id_company' => $this->session->userdata('company_id'), 'status' => 1])->result_array();
        }

        return $query;
    }
}
