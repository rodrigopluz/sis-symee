<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Person Model
 *
 * @package  CodeIgniter
 * @category Model
 */
class Person extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get person by id
     */
    public function get_person($id)
    {
        return $this->db->get_where('person', ['id' => $id])->row_array();
    }

    /*
     * Get all person
     */
    public function get_all_person()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('person')->result_array();
    }

    /*
     * function to add new person
     */
    public function add_person($params)
    {
        $this->db->insert('person', $params);
        return $this->db->insert_id();
    }

    /*
     * function to update person
     */
    public function update_person($id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update('person', $params);
    }

    /*
     * function to delete person
     */
    public function delete_person($id)
    {
        return $this->db->delete('person', ['id' => $id]);
    }

    /**
     * get all person by employee
     */
    public function get_all_personEmployee($id_address, $cpf_cnpj)
    {
        return $this->db->get_where('person', ['id_address' => $id_address, 'cpf_cnpj' => $cpf_cnpj])->row_array();
    }

    /**
     * check if cpf already exists
     */
    public function get_all_newperson($cpf, $email = null)
    {
        $this->db->where('email', $email)->or_where('cpf_cnpj', $cpf);
        $query = $this->db->get('person')->row_array();
        
        return $query;
    }

    /**
     * ajax_forgot_password
     */
    public function ajax_forgot_password($email)
    {
        $this->db->select('user_company.*,person.name as name_person,person.email as person_email,person.avatar as avatar_person,profile.name as name_profile',false)
                 ->from('person')
                 ->join('user_company', 'user_company.id_person = person.id', 'left')
                 ->join('profile', 'profile.id = user_company.id_profile', 'left')
                 ->where(['email' => $email]);

        $query = $this->db->get();
        return $query;
    }

    /**
     * ajax_email
     */
    public function ajax_email($email)
    {
        $this->db->where(['email' => $email]);
        $query = $this->db->get('person')->row_array();
        return $query;
    }

    /**
     * ajax_login
     */
    public function ajax_login($login)
    {
        $this->db->where(['cpf_cnpj' => $login]);
        $query = $this->db->get('person')->row_array();
        return $query;
    }
}