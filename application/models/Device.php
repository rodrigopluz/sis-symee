<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Device Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Device extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get device by id
     */
    public function get_device($id)
    {
        return $this->db->get_where('device', array('id' => $id))->row_array();
    }

    /**
     * Get all device
     */
    public function get_all_device()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('device')->result_array();
    }

    /**
     * function to add new device
     */
    public function add_device($params)
    {
        $this->db->insert('device', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update device
     */
    public function update_device($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('device', $params);
    }

    /**
     * function to delete device
     */
    public function delete_device($id)
    {
        return $this->db->delete('device', array('id' => $id));
    }
}