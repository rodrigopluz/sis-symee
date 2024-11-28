<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * WorkPlace Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class WorkPlace extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get workplace by id
     */
    public function get_workplace($id)
    {
        $this->db->select('ct.id, ct.name AS city, ct.sigla, ct.initial, 
                           p.id, p.id_neighborhood, p.name AS place_name, 
                           n.id, n.id_city, n.name AS neighborhood_name, 
                           s.*, cn.*, a.*, w.*')
                 ->distinct()
                 ->from('workplace w')
                 ->join('address a', 'a.id = w.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->order_by('w.id', 'desc');
        
        $query = $this->db->get_where('workplace', ['w.id' => $id])->row_array();
        return $query;
    }

    /**
     * Get all workplace
     */
    public function get_all_workplace()
    {
        $this->db->select('ct.id, ct.name AS city, ct.sigla, ct.initial, 
                           p.id, p.id_neighborhood, p.name AS place_name, 
                           n.id, n.id_city, n.name AS neighborhood_name, 
                           s.*, cn.*, a.*, cp.*, w.*')
                 ->distinct()
                 ->from('workplace w')
                 ->join('company cp','cp.id = w.id_company','left')
                 ->join('address a', 'a.id = w.id_address', 'left')
                 ->join('places p', 'p.id = a.id_place', 'left')
                 ->join('neighborhood n', 'n.id = p.id_neighborhood', 'left')
                 ->join('city ct', 'ct.id = n.id_city', 'left')
                 ->join('states s', 's.sigla = ct.sigla', 'left')
                 ->join('country cn', 'cn.id = s.id_country', 'left')
                 ->order_by('w.id', 'desc');

        $query = $this->db->get()->result_array();
        return $query;

        // $this->db->order_by('id', 'desc');
        // return $this->db->get('workplace')->result_array();
    }

    /**
     * function to add new workplace
     */
    public function add_workplace($params)
    {
        $this->db->insert('workplace', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update workplace
     */
    public function update_workplace($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('workplace', $params);
    }

    /**
     * function to delete workplace
     */
    public function delete_workplace($id)
    {
        return $this->db->delete('workplace', ['id' => $id]);
    }

    /**
     * function to get_session_workplace
     */
    public function get_session_workplace($id)
    {
        $this->db->select('cp.business_name, w.*')
                 ->distinct()
                 ->from('workplace w')
                 ->join('company cp', 'cp.id = w.id_company', 'left')
                 ->order_by('w.id', 'desc');

        $query = $this->db->get_where('workplace', ['cp.id' => $id])->result_array();
        return $query;
    }
}