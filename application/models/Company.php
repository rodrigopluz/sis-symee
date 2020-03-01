<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Company extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get company by id
     */
    public function get_company($id)
    {
        $this->db->select('a.number, a.zipcode, a.complement, a.id_place, 
                           p.id, p.id_neighborhood, p.name AS place_name, 
                           n.id, n.id_city, n.name AS neighborhood_name, 
                           ct.name AS city, ct.sigla, ct.initial, ct.cod_municipio_ibge, 
                           s.name AS state, s.sigla AS st_sigla, 
                           cn.name AS country, cn.initial,
                           fc.category,
                           pl.plan_name, pl.type,
                           c.*')
                 ->distinct()
                 ->from('company c')
                 ->join('plans pl', 'pl.id = c.id_plan', 'left')
                 ->join('address a', 'a.id = c.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->join('company_function_category cfc', 'cfc.id_company = c.id', 'left')
                 ->join('function_category fc', 'fc.id = cfc.id_function_category', 'left');
        
        $query = $this->db->get_where('company', ['c.id' => $id])->row_array();
        return $query;
    }

    /**
     * Get all company
     */
    public function get_all_company()
    {
        $this->db->select('pl.plan_name, pl.type, c.*')
             ->distinct()
             ->from('company c')
             ->join('plans pl', 'pl.id = c.id_plan', 'left');

        return $this->db->get('company')->result_array();
    }

    /*
     * function to add new company
     */
    public function add_company($params)
    {
        $this->db->insert('company', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update company
     */
    public function update_company($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('company', $params);
    }

    /*
     * function to delete company
     */
    public function delete_company($id)
    {
        return $this->db->delete('company', ['id' => $id]);
    }

    /**
     * function to get_session_company
     */
    public function get_session_company($id)
    {
        $this->db->select('a.*, p.id, p.id_neighborhood, p.name AS place_name, n.id, n.id_city, n.name AS neighborhood_name, ct.id AS city_id, ct.sigla, ct.name AS city_name, s.*, cn.*, c.*')
                 ->distinct()
                 ->from('company c')
                 ->join('address a', 'a.id = c.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left');
                
        $query = $this->db->get_where('company', ['c.id' => $id])->result_array();
        return $query;
    }

    /**
     * function to get_insert_id
     */
    public function get_insert_id()
    {
        return $this->db->insert_id();
    }
}