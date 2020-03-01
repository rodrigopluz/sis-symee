<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Place Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Place
 */
class Place extends REST_Controller
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

        $this->load->model('Places');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->Place->get_Place($id);
        } else {
            $this->db->order_by('id', 'ASC');
            $data = $this->Place->get_all_Place();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function byneigborhoods_get($id_neigborhoods)
    {       
        $this->db->where('id_neighborhood', $id_neigborhoods);
        $this->db->order_by('name', 'ASC');
        $data = $this->db->get('places')->result_array();
        $this->response($data, REST_Controller::HTTP_OK);
    }
}