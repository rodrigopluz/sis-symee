<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Country Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Country extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get country by id
     */
    public function get_country($id)
    {
        return $this->db->get_where('country', ['id' => $id])->row_array();
    }

    /**
     * Get all country
     */
    public function get_all_country()
    {
        $this->db->order_by('name', 'asc');
        return $this->db->get_where('country', ['status' => '1'])->result_array();
    }

    /**
     * function to add new country
     */
    public function add_country($params)
    {
        $this->db->insert('country', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update country
     */
    public function update_country($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('country', $params);
    }

    /**
     * function to delete country
     */
    public function delete_country($id)
    {
        return $this->db->delete('country', ['id' => $id]);
    }
}