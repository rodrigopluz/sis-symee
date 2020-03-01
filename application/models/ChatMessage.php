<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ChatMessage Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class ChatMessage extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get chat_message by id
     */
    public function get_chat_message($id)
    {
        return $this->db->get_where('chat_message', ['id' => $id])->row_array();
    }

    /**
     * Get all chat_message
     */
    public function get_all_chat_message()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('chat_message')->result_array();
    }

    /**
     * function to add new chat_message
     */
    public function add_chat_message($params)
    {
        $this->db->insert('chat_message', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update chat_message
     */
    public function update_chat_message($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('chat_message', $params);
    }

    /**
     * function to delete chat_message
     */
    public function delete_chat_message($id)
    {
        return $this->db->delete('chat_message', ['id' => $id]);
    }
}