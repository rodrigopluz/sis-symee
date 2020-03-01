<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Convocation Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Convocation extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get convocation by id
     */
    public function get_convocation($id)
    {
        return $this->db->get_where('convocation', ['id' => $id])->row_array();
    }

    /**
     * Get all convocation
     */
    public function get_all_convocation()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('convocation')->result_array();
    }

    /**
     * function to add new convocation
     */
    public function add_convocation($params)
    {
        $this->db->insert('convocation', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update convocation
     */
    public function update_convocation($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('convocation', $params);
    }

    /**
     * function to delete convocation
     */
    public function delete_convocation($id)
    {
        return $this->db->delete('convocation', ['id' => $id]);
    }
}