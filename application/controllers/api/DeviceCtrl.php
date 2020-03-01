<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Device Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class DeviceCtrl
 */
class DeviceCtrl extends REST_Controller
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
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        $this->response('Implementar get', REST_Controller::HTTP_OK);
    }

    /**
     * POST - create register new, all from this method.
     * @return Response
     */
    public function index_post()
    {
        $input = $this->post();

        $result = $this->db->get_where('device', ['uuid' => $input['uuid']])->row_array();

        $input['last_update'] = date('Y-m-d H:i:s', time());

        if (!$result) {
            $this->db->insert('device', $input);
            $result = $this->db->insert_id();
        } else {
            $this->db->where('uuid', $input['uuid']);
            $result = $this->db->update('device', $input);
            //$result = $this->db->set($input)->get_compiled_update('device');
        }      

        $this->response($result, REST_Controller::HTTP_OK);
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $this->response(['Implementar metodo put'], REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->response(['implementar metodo delete'], REST_Controller::HTTP_OK);
    }
}