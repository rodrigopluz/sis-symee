<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - UserCompanys Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class UserCompanys
 */
class UserCompanys extends REST_Controller
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

        $this->load->model('UserCompany');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->UserCompany->get_user_company($id);
        } else {
            $data = $this->UserCompany->get_all_user_company();
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
        $data = $this->db->get_where('user_company', ['login' => $input['login']])->row_array();

        if (!$data) {
            $this->db->insert('user_company', $input);
            $this->response(['Usuário criado com sucesso'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['CPF já registrado no sistema'], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();

        $this->db->update('user_company', $input, ['id' => $id]);
        $this->response(['Usuário alterado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('user_company', ['id' => $id]);
        $this->response(['Usuário deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}