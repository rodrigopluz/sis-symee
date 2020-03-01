<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - City Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class City
 */
class Citys extends REST_Controller
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

        $this->load->model('City');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->City->get_city($id);
        } else {
            $this->db->order_by('id', 'ASC');
            $data = $this->City->get_all_city();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }


    /**
     * GET - list all from this method.
     * @return Response
     */
    public function byuf_get($uf)
    {
        $this->db->where('sigla', $uf);
        $this->db->where('status', 1);
        $this->db->order_by('name', 'ASC');
        $data = $this->db->get('city')->result_array();
        $this->response($data, REST_Controller::HTTP_OK);
    }
}