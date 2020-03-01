<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Places Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Places extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get places by id
     */
    public function get_places($id)
    {
        return $this->db->get_where('places', ['id' => $id])->row_array();
    }

    /**
     * Get all places
     */
    public function get_all_places()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('places')->result_array();
    }

    /**
     * function to add new places
     */
    public function add_places($params)
    {
        /** verifies that the record no longer exists in the database */
        $query = $this->get_all_placeNeighborhood($params['id_neighborhood'], $params['name']);

        if (!$query) {
            $this->db->insert('places', $params);
        }

        return $this->db->insert_id();
    }

    /**
     * function to update places
     */
    public function update_places($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('places', $params);
    }

    /**
     * function to delete places
     */
    public function delete_places($id)
    {
        return $this->db->delete('places', ['id' => $id]);
    }

    /**
     * get all place by neighborhood
     */
    public function get_all_placeNeighborhood($id_neighborhood, $place)
    {
        return $this->db->get_where('places', ['id_neighborhood' => $id_neighborhood, 'name' => $place])->row_array();
    }
}