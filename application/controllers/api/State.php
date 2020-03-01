<?php

require APPPATH . 'libraries/REST_Controller.php';


/**
 * API - State Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class State
 */
class State extends REST_Controller
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
        $this->load->helper(['jwt', 'authorization']);
        $this->load->model('States'); 
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->States->get_states($id);
        } else {
            $this->db->select('id, sigla');
            $this->db->where('status', 1);
            $this->db->order_by('id', 'ASC');
            $data = $this->db->get('states')->result_array();
        }

        //$data = $this->input->get_request_header('Authorization');
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * SEARCH - list all from this method.
     * @return Response
     */
    public function search_get($string = "")
    {
        $this->db->select('id, sigla, name');
        $this->db->like('sigla',$string);
        $data = $this->db->get('states')->result_array();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * POST - create register new, all from this method.
     * @return Response
     */
    public function index_post()
    {
        $input = $this->post();
        $this->db->insert('States', $input);
        $this->response(['Estado criado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();

        $this->db->update('States', $input, ['id' => $id]);
        $this->response(['Estado alterado com sucesso'], REST_Controller::HTTP_OK);
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('States', ['id' => $id]);
        $this->response(['Estado deletado com sucesso'], REST_Controller::HTTP_OK);
    }
}