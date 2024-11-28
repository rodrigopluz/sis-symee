<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * City Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class City extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get city by id
     */
    public function get_city($id)
    {
        return $this->db->get_where('city', ['id' => $id])->row_array();
    }

    /**
     * Get all city
     */
    public function get_all_city()
    {
        $this->db->order_by('name', 'asc');
        return $this->db->get('city')->result_array();
    }

    /**
     * function to add new city
     */
    public function add_city($params)
    {
        $this->db->insert('city', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update city
     */
    public function update_city($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('city', $params);
    }

    /**
     * function to delete city
     */
    public function delete_city($id)
    {
        return $this->db->delete('city', ['id' => $id]);
    }

    /**
     * get all city by state
     */
    public function get_all_cityState($state, $city)
    {
        return $this->db->get_where('city', ['sigla' => $state, 'name' => $city])->row_array();
    }
}