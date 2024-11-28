<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Companys Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Companys
 */
class Companys extends REST_Controller
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

        $this->load->model('Company');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->Company->get_company($id);
        } else {
            $data = $this->Company->get_all_company();
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
        $data = $this->db->get_where('company', ['cnpj' => $input['cnpj']])->row_array();

        if (!$data) {
            $this->db->insert('company', $input);
            $this->response(['Empresa criado com sucesso'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['CNPJ já registrado no sistema'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();

        $this->db->update('company', $input, ['id' => $id]);
        $this->response(['Empresa alterado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('company', ['id' => $id]);
        $this->response(['Empresa deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}