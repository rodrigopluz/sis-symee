<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EmployeeWorkgroup Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class EmployeeWorkgroup extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get employee_workgroup by id
     */
    public function get_employee_workgroup($id)
    {
        return $this->db->get_where('employee_workgroup', ['id' => $id])->row_array();
    }

    /**
     * Get all employee_workgroup
     */
    public function get_all_employee_workgroup()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('employee_workgroup')->result_array();
    }

    /**
     * function to add new employee_workgroup
     */
    public function add_employee_workgroup($params)
    {
        $this->db->insert('employee_workgroup', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update employee_workgroup
     */
    public function update_employee_workgroup($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('employee_workgroup', $params);
    }

    /**
     * function to delete employee_workgroup
     */
    public function delete_employee_workgroup($id)
    {
        return $this->db->delete('employee_workgroup', ['id' => $id]);
    }
}