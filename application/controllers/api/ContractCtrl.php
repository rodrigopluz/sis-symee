<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Contract Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Contract
 */
class ContractCtrl extends REST_Controller
{
    /**
     * function __construct.
     * 
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->model('Contract');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->Contract->get_contract($id);
        } else {
            $data = $this->Contract->get_all_contract();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function byEmployeeId_get($id = 0)
    {
        $data = $this->Contract->get_all_contract_by_employee($id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * POST - create register new, all from this method.
     * @return Response
     */
    public function index_post()
    {
        $input = $this->post();
        $this->db->insert('Contract', $input);
        $this->response('Contrato criado com sucesso', REST_Controller::HTTP_OK);
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();
        $result = $this->db->update('contract', $input, ['id' => $id]);
        $this->response('Contrato atualizado com sucesso', REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('Contract', ['id' => $id]);
        $this->response('Contrato deletado com sucesso', REST_Controller::HTTP_OK);
    }
}