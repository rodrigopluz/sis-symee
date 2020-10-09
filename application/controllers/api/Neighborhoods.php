<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Neighborhood Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Neighborhood
 */
class Neighborhoods extends REST_Controller
{
    /**
     * function __construct.
     * 
     * @return Response
     */
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        parent::__construct();
        $this->load->database();

        $this->load->model('Neighborhood');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->Neighborhood->get_Neighborhood($id);
        } else {
            $this->db->order_by('id', 'ASC');
            $data = $this->Neighborhood->get_all_Neighborhood();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function bycity_get($id_city)
    {       
        $this->db->where('id_city', $id_city);
        $this->db->order_by('name', 'ASC');
        $data = $this->db->get('neighborhood')->result_array();
        $this->response($data, REST_Controller::HTTP_OK);
    }
}