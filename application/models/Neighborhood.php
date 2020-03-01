<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Neighborhood Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Neighborhood extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get neighborhood by id
     */
    public function get_neighborhood($id)
    {
        return $this->db->get_where('neighborhood', ['id' => $id])->row_array();
    }

    /**
     * Get all neighborhood
     */
    public function get_all_neighborhood()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('neighborhood')->result_array();
    }

    /**
     * function to add new neighborhood
     */
    public function add_neighborhood($params)
    {
        /** verifies that the record no longer exists in the database */
        $query = $this->get_all_neighborhoodCity($params['id_city'], $params['name']);

        if (!$query) {
            $this->db->insert('neighborhood', $params);
        }

        return $this->db->insert_id();
    }

    /**
     * function to update neighborhood
     */
    public function update_neighborhood($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('neighborhood', $params);
    }

    /**
     * function to delete neighborhood
     */
    public function delete_neighborhood($id)
    {
        return $this->db->delete('neighborhood', ['id' => $id]);
    }

    /**
     * get all neighborhood by city
     */
    public function get_all_neighborhoodCity($id_city, $neighborhood)
    {
        return $this->db->get_where('neighborhood', ['id_city' => $id_city, 'name' => $neighborhood])->row_array();
    }
}