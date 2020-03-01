<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Employee Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Employee extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get employee by id
     */
    public function get_employee($id)
    {
        $this->db->select('ct.id, ct.name AS city_name, ct.sigla, ct.initial, s.*, cn.*, p.id, p.id_neighborhood, p.name AS place_name, n.id, n.id_city, n.name AS neighborhood_name, a.*, pf.name as pf_name, pe.*, e.*')
                 ->from('employee e')
                 ->join('person pe', 'e.id_person = pe.id', 'left')
                 ->join('profile pf', 'e.id_profile = pf.id', 'left')
                 ->join('address a', 'a.id = pe.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->where(['e.id_person' => $id]);

        $query = $this->db->get()->row_array();

        return $query;
    }

    /**
     * Get all employee
     */
    public function get_all_employee()
    {
        $this->db->select('e.*, pe.name AS person_name, pe.type')
                 ->from('employee e')
                 ->join('person pe', 'e.id_person = pe.id', 'left')
                 ->where(['pe.status' => '1'])
                 ->order_by('e.id', 'desc');

        $query = $this->db->get()->result_array();
        return $query;
    }

    /**
     * function to add new employee
     */
    public function add_employee($params)
    {
        $this->db->insert('employee', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update employee
     */
    public function update_employee($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee', $params);
    }

    /**
     * function to delete employee
     */
    public function delete_employee($id)
    {
        return $this->db->delete('employee', ['id' => $id]);
    }

    /**
     * function to login-user_company
     */
    public function login_employee($user, $pass)
    {
        $this->db->select('*')->from('employee')->where('login', $user);
        $this->db->where('password',md5($pass));
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            return $result[0]->id;
        }

        return false;
    }

    /**
     * get ajax employee entail
     */
    public function get_employee_entail($document)
    {
        $this->db->select('ct.name AS city_name, ct.sigla, ct.initial,
                           s.id_country, s.sigla,
                           cn.name AS country_name,
                           p.id_neighborhood, p.name AS place_name,
                           n.id_city, n.name AS neighborhood_name,
                           a.id_place, a.number, a.complement, a.zipcode,
                           pf.name AS profile_name,
                           pe.id_address, pe.name AS person_name, pe.email, pe.phone, pe.type, pe.cpf_cnpj, pe.sexo, pe.nationality,
                           de.token, de.employee_id, de.status, de.uuid, de.model, de.id AS id_device,
                           e.*')
                 ->from('employee e')
                 ->join('person pe', 'e.id_person = pe.id', 'left')
                 ->join('device de', 'de.employee_id = e.id', 'left')
                 ->join('profile pf', 'e.id_profile = pf.id', 'left')
                 ->join('address a', 'a.id = pe.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->where(['pe.cpf_cnpj' => $document, 'e.status' => '1']);
                 
        $query = $this->db->get()->row_array();

        return $query;
    }

    /**
     * ajax_forgot_password
     */
    public function ajax_forgot_password($email, $login)
    {
        $this->db->select('employee.*,person.name as name_person, person.email as person_email, person.avatar as avatar_person, profile.name as name_profile',false)
                 ->from('person')
                 ->join('employee', 'employee.id_person = person.id', 'left')
                 ->join('profile', 'profile.id = employee.id_profile', 'left')
                 ->where(['email' => $email, 'employee.login' => $login]);

        $query = $this->db->get();
        return $query;
    }

    /**
     * get-employee-device
     */
    public function get_employee_device($employee)
    {
        $this->db->select('e.*, 
                           pe.name AS person_name, 
                           de.token, de.employee_id, de.status, de.uuid, de.model, de.id AS id_device,
                           ct.start_date, ct.end_date, ct.id_company, ct.id_function,
                           cp.business_name,
                           fc.name AS frole_name')
                 ->from('employee e')
                 ->join('person pe', 'e.id_person = pe.id', 'left')
                 ->join('device de', 'de.employee_id = e.id', 'left')
                 ->join('contract ct', 'ct.id_employee = e.id', 'left')
                 ->join('company cp', 'cp.id = ct.id_company', 'left')
                 ->join('function_role fc', 'fc.id = ct.id_function')
                 ->where(['e.id' => $employee, 'e.status' => '1']);

        $query = $this->db->get()->row_array();
        return $query;
    }
}