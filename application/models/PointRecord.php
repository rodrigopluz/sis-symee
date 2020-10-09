<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PointRecord Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class PointRecord extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get point_record by id
     */
    public function get_point_record($id)
    {
        return $this->db->get_where('point_record', ['id' => $id])->row_array();
    }

    /**
     * Get all point_record
     */
    public function get_all_point_record()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('point_record')->result_array();
    }

    /**
     * function to add new point_record
     */
    public function add_point_record($params)
    {
        $this->db->insert('point_record', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update point_record
     */
    public function update_point_record($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('point_record', $params);
    }

    /**
     * function to delete point_record
     */
    public function delete_point_record($id)
    {
        return $this->db->delete('point_record', ['id' => $id]);
    }
}