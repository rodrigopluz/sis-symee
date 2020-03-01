<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Adress Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Adress
 */
class Adress extends REST_Controller
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

        $this->load->model('Adress');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->Adress->get_adress($id);
        } else {
            $data = $this->Adress->get_all_adress();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * POST - create register new, all from this method.
     * @return Response
     */
    public function index_post()
    {
        $input = $this->post();
        $this->db->insert('Adress', $input);
        $this->response(['Endereço criado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();

        $this->db->update('Adress', $input, ['id' => $id]);
        $this->response(['Endereço alterado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('Adress', ['id' => $id]);
        $this->response(['Endereço deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}