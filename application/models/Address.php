<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Address Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Address extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get address by id
     */
    public function get_address($id)
    {
        return $this->db->get_where('address', ['id' => $id])->row_array();
    }

    /**
     * Get all address
     */
    public function get_all_address()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('address')->result_array();
    }

    /**
     * function to add new address
     */
    public function add_address($params)
    {
        /** verifies that the record no longer exists in the database */
        // $query = $this->get_all_addressPlace($params['id_place'], $params['zipcode']);

        // if (!$query) {
        $this->db->insert('address', $params);
        // }

        return $this->db->insert_id();
    }

    /**
     * function to update address
     */
    public function update_address($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('address', $params);
        //return $this->db->update_batch();
    }

    /**
     * function to delete address
     */
    public function delete_address($id)
    {
        return $this->db->delete('address', ['id' => $id]);
    }

    /**
     * get all address by place
     */
    public function get_all_addressPlace($id_place, $zipcode)
    {
        return $this->db->get_where('address', ['id_place' => $id_place, 'zipcode' => $zipcode])->row_array();
    }

    /**
     * get all address by place
     */
    public function get_all_addressPlaceByNumber($id_place, $zipcode, $number)
    {
        return $this->db->get_where('address', ['id_place' => $id_place, 'zipcode' => $zipcode])->row_array();
    }
}