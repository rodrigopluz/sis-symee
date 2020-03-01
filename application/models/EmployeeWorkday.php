<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * EmployeeWorkday Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class EmployeeWorkday extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get employee_workday by id
     */
    public function get_employee_workday($id)
    {
        return $this->db->get_where('employee_workday', ['id' => $id])->row_array();
    }

    /**
     * Get all employee_workday
     */
    public function get_all_employee_workday()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('employee_workday')->result_array();
    }

    /**
     * function to add new employee_workday
     */
    public function add_employee_workday($params)
    {
        $this->db->insert('employee_workday', $params);
        return $this->db->insert_id();
    }

    /**
     * function to update employee_workday
     */
    public function update_employee_workday($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('employee_workday', $params);
    }

    /**
     * function to delete employee_workday
     */
    public function delete_employee_workday($id)
    {
        return $this->db->delete('employee_workday', ['id' => $id]);
    }
}