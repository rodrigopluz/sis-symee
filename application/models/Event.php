<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Event Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Event extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get event by id
     */
    public function get_event($id)
    {
        return $this->db->get_where('event', ['id' => $id])->row_array();
    }

    /**
     * Get all event
     */
    public function get_all_event()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('event')->result_array();
    }

    /**
     * function to add new event
     */
    public function add_event($params)
    {
        $this->db->insert('event', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update event
     */
    public function update_event($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('event', $params);
    }

    /**
     * function to delete event
     */
    public function delete_event($id)
    {
        return $this->db->delete('event', ['id' => $id]);
    }
}