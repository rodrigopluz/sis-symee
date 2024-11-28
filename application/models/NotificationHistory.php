<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * NotificationHistory Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class NotificationHistory extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get notification_history by id
     */
    public function get_notification_history($id)
    {
        return $this->db->get_where('notification_history', array('id' => $id))->row_array();
    }

    /**
     * Get all notification_history
     */
    public function get_all_notification_history()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('notification_history')->result_array();
    }

    /**
     * function to add new notification_history
     */
    public function add_notification_history($params)
    {
        $this->db->insert('notification_history', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update notification_history
     */
    public function update_notification_history($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('notification_history', $params);
    }

    /**
     * function to delete notification_history
     */
    public function delete_notification_history($id)
    {
        return $this->db->delete('notification_history', array('id' => $id));
    }

    /**
     * function to get_insert_id
     */
    public function get_insert_id()
    {
        return $this->db->insert_id();
    }
}