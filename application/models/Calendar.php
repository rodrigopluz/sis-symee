<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Calendar Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Calendar extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get calendar by id
     */
    public function get_calendar($id)
    {
        return $this->db->get_where('calendar', ['id' => $id])->row_array();
    }

    /**
     * Get all calendar
     */
    public function get_all_calendar()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('calendar')->result_array();
    }

    /**
     * function to add new calendar
     */
    public function add_calendar($params)
    {
        $this->db->insert('calendar', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update calendar
     */
    public function update_calendar($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('calendar', $params);
    }

    /**
     * function to delete calendar
     */
    public function delete_calendar($id)
    {
        return $this->db->delete('calendar', ['id' => $id]);
    }
}