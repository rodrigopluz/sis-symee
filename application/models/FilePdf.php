<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * FilePdf Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class FilePdf extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get file_pdf by id
     */
    public function get_file_pdf($id)
    {
        return $this->db->get_where('file_pdf', ['id' => $id])->row_array();
    }

    /**
     * Get all file_pdf
     */
    public function get_all_file_pdf()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('file_pdf')->result_array();
    }

    /**
     * function to add new file_pdf
     */
    public function add_file_pdf($params)
    {
        $this->db->insert('file_pdf', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update file_pdf
     */
    public function update_file_pdf($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('file_pdf', $params);
    }

    /**
     * function to delete file_pdf
     */
    public function delete_file_pdf($id)
    {
        return $this->db->delete('file_pdf', ['id' => $id]);
    }
}