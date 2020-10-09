<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserCompany Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class UserCompany extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get user_company by id
     */
    public function get_user_company($id)
    {
        $this->db->select('ct.id, ct.name AS city, ct.sigla, ct.initial, 
                           s.*, cn.*, 
                           p.id, p.id_neighborhood, p.name AS place_name, 
                           n.id, n.id_city, n.name AS neighborhood_name, 
                           a.*, 
                           pr.name as pr_name, 
                           cp.*, pe.*, uc.*')
                 ->distinct()
                 ->from('user_company uc')
                 ->join('profile pr','uc.id_profile = pr.id','left')
                 ->join('company cp','uc.id_company = cp.id','left')
                 ->join('person pe', 'uc.id_person = pe.id', 'left')
                 ->join('address a', 'a.id = pe.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->order_by('uc.id', 'desc');

        $query = $this->db->get_where('user_company', ['uc.id_person' => $id])->row_array();
        return $query;
    }

    /**
     * Get all user_company
     */
    public function get_all_user_company()
    {
        $this->db->select('pr.name as pr_name, cp.business_name, pe.*, uc.*')
                 ->from('user_company uc')
                 ->join('profile pr','uc.id_profile = pr.id','left')
                 ->join('company cp','uc.id_company = cp.id','left')
                 ->join('person pe', 'uc.id_person = pe.id', 'left')
                 ->where(['pe.status' => '1'])
                 ->order_by('uc.id', 'desc');

        $query = $this->db->get()->result_array();
        return $query;
    }

    /**
     * function to add new user_company
     */
    public function add_user_company($params)
    {
        $this->db->insert('user_company', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update user_company
     */
    public function update_user_company($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('user_company', $params);
    }

    /**
     * function to delete user_company
     */
    public function delete_user_company($id)
    {
        return $this->db->delete('user_company', ['id' => $id]);
    }

    /**
     * function to update person_user_company
     */
    public function update_person_user_company($id, $param)
    {
        $this->db->where('id_person', $id);
        return $this->db->update('user_company', $param);
    }

    /**
     * function to validate_login
     */
    public function get_validate_login($credential)
    {
        $this->db->select('company.*,
                           user_company.*,
                           plans.type, plans.plan_name, plans.quantity, plans.collaborator,
                           person.id AS id_person ,person.name AS name_person, person.email AS person_email, person.avatar AS avatar_person, person.status AS status_person,
                           profile.name AS name_profile')
                 ->from('user_company')
                 ->join('person', 'user_company.id_person = person.id', 'left')
                 ->join('company', 'user_company.id_company = company.id', 'left')
                 ->join('plans', 'plans.id = company.id_plan', 'left')
                 ->join('profile', 'user_company.id_profile = profile.id', 'left')
                 ->where($credential);
                 
        $query = $this->db->get();
        return $query;
    }

    /**
     * function to get_session_user_company
     */
    public function get_session_user_company($id)
    {
        $this->db->select('pr.name as pr_name, cp.business_name, pe.*, uc.*')
                 ->distinct()
                 ->from('user_company uc')
                 ->join('profile pr', 'uc.id_profile = pr.id', 'left')
                 ->join('company cp', 'uc.id_company = cp.id', 'left')
                 ->join('person pe', 'uc.id_person = pe.id', 'left')
                 ->order_by('uc.id', 'desc');

        $query = $this->db->get_where('user_company', ['cp.id' => $id])->result_array();
        return $query;
    }
}