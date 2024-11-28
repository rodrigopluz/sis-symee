<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * {{ name }} Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class {{ name }} extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get {{ tabela }} by id
     */
    public function get_{{ tabela }}($id)
    {
        return $this->db->get_where('{{ tabela }}', array('id' => $id))->row_array();
    }

    /**
     * Get all {{ tabela }}
     */
    public function get_all_{{ tabela }}()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('{{ tabela }}')->result_array();
    }

    /**
     * function to add new {{ tabela }}
     */
    public function add_{{ tabela }}($params)
    {
        $this->db->insert('{{ tabela }}', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update {{ tabela }}
     */
    public function update_{{ tabela }}($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('{{ tabela }}', $params);
    }

    /**
     * function to delete {{ tabela }}
     */
    public function delete_{{ tabela }}($id)
    {
        return $this->db->delete('{{ tabela }}', array('id' => $id));
    }
}