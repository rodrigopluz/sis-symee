<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Chat Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Chat extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get chat by id
     */
    public function get_chat($id)
    {
        return $this->db->get_where('chat', ['id' => $id])->row_array();
    }

    /**
     * Get all chat
     */
    public function get_all_chat()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('chat')->result_array();
    }

    /**
     * function to add new chat
     */
    public function add_chat($params)
    {
        $this->db->insert('chat', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update chat
     */
    public function update_chat($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('chat', $params);
    }

    /**
     * function to delete chat
     */
    public function delete_chat($id)
    {
        return $this->db->delete('chat', ['id' => $id]);
    }
}