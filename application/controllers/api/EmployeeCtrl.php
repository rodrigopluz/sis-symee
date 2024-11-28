<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * API - Employee Controller
 *
 *  @author       : Symee
 *  e-mail        : contato@symee.com.br
 *  item          : API - Symee
 *  specification : Class Employee
 */
class EmployeeCtrl extends REST_Controller
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

        $this->load->model('Person');
        $this->load->model('Employee');
        $this->load->model('Email');

        $this->load->model('Address');
        $this->load->model('Places');
        $this->load->model('Neighborhood');
        $this->load->model('City');
        $this->load->model('States');
        $this->load->model('Country');
    }

    /**
     * GET - list all from this method.
     * @return Response
     */
    public function index_get($id = 0)
    {
        $token = $this->input->get_request_header('Authorization');
        if (!AUTHORIZATION::verify_token($token)) {
            $this->response('Acesso negado - Token inválido', REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }

        if (!empty($id)) {
            $employee = $this->Employee->get_employee($id);

            $this->load->model('Person');
            $person = $this->Person->get_person($employee['id_person']);

            $this->load->model('Address');
            $address = $this->Address->get_address($person['id_address']);

            $this->load->model('Places');
            $place = $this->Places->get_places($address['id_place']);

            $this->load->model('Neighborhood');
            $neighborhood = $this->Neighborhood->get_neighborhood($place["id_neighborhood"]);

            $this->load->model('City');
            $city = $this->City->get_city($neighborhood['id_city']);

            $this->load->model('States');
            $state = $this->States->get_states($city['sigla']);

            $data = [
                'employee' => $employee,
                'person' => $person,
                'address' => $address,
                'place' => $place,
                'neighborhood' => $neighborhood,
                'city' => $city,
                'state' => $state,
            ];
        } else {
            $employee = $this->Employee->get_all_employee();
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
        $data = $this->db->get_where('employee', ['login' => $input['cpf_cnpj']])->row_array();

        if (!$data) {
            $id_place = $this->getIdPlace($input['state'], $input['city'], $input['neighborhood'], $input['place']);
            $p_address = [
                'id_place' => $id_place,
                'number' => $input['number'],
                'complement' => $input['complement'],
                'zipcode' => notformat_zipcode($input['zipcode']),
            ];
            
            $this->load->model('Address');
            $id_endereco = $this->Address->add_address($p_address);
            if (!$id_endereco) {
                $this->response('Erro ao efetuar cadastro - Problema com endereço!', REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
            
            $data_nasc = date('Y-m-d',strtotime($input['data_nasc']));
            $dadosPessoa = [
                'name' => $input['name'],
                'phone' => $input['phone'],
                'email' => $input['email'],
                'nationality' => $input['nationality'],
                'sexo' => $input['sexo'],
                'type' => $input['type'],
                'cpf_cnpj' => $input['cpf_cnpj'],
                'company_name' => $input['company_name'],
                'data_nasc' => $data_nasc,
                'id_address' => $id_endereco,
                'status' => 1
            ];

            $this->load->model('Person');
            $id_pessoa = $this->Person->add_person($dadosPessoa);
            
            if (!$id_pessoa) {
                $this->response('Erro ao efetuar cadastro - Problema com dados da pessoa!', REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }

            $dadosEmpregado = [
                'id_person' => $id_pessoa,
                'login' => $input['cpf_cnpj'],
                'password' => md5($input['password']),
                'id_profile' => '3',
                'reset' => 0,
                'status' => true,
            ];

            $id_empregado = $this->Employee->add_employee($dadosEmpregado);

            if ($id_empregado) {
                $this->response('Usuário criado com sucesso!', REST_Controller::HTTP_OK);
            } else {
                $this->response('Erro ao efetuar cadastro - Problema com dados de login!', REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response('CPF ou CNPJ já registrado no sistema!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * PUT - edit register, all from this method.
     * @return Response
     */
    public function index_put($id)
    {
        $statusUpdate = true;

        $token = $this->input->get_request_header('Authorization');
        if (!AUTHORIZATION::verify_token($token)) {
            $this->response('Acesso negado - Token inválido', REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }

        $employee = $this->Employee->get_employee($id);
        $id_person = $employee['id_person'];
        $put = $this->put();

        if ($person = $put['person']) {
            $result = $this->Person->update_person($id_person, $person);
            if (!$result) 
                $statusUpdate = false;        
        }

        if ($employee = $put['employee']) {
            if ($employee['password'] = md5($employee['password'])) {
                unset($employee['password2']);
            }

            $result = $this->Employee->update_employee($id, $employee);
            if (!$result) 
                $statusUpdate = false;
        }

        if ($address = $put['address']) {
            //Get the id place
            $person = $this->Person->get_person($id_person);
            $id_address = $person['id_address'];
            $id_place = $this->getIdPlace($address['state'], $address['city'], $address['neighborhood'], $address['place']);
            $p_address = [
                'id_place' => $id_place,
                'number' => $address['number'],
                'complement' => $address['complement'],
                'zipcode' => notformat_zipcode($address['zipcode']),
            ];

            $result = $this->Address->update_address($id_address, $p_address);
            if (!$result)
                $statusUpdate = false;
        }

        if ($statusUpdate) {
            $this->response('Dados alterados com sucesso', REST_Controller::HTTP_OK);
        } else { 
            $this->response('Erro ao atualizar dados', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * DELETE - delete register, all from this method.
     * @return Response
     */
    public function index_delete($id)
    {
        $token = $this->input->get_request_header('Authorization');
        if (!AUTHORIZATION::verify_token($token)) {
            $this->response('Acesso negado - Token inválido', REST_Controller::HTTP_UNAUTHORIZED);
            return;
        }

        $this->db->delete('Employee', ['id' => $id]);
        $this->response(['Usuário deletado com sucesso'], REST_Controller::HTTP_OK);
    }

    public function reset_password_post()
    {
        $dados = $this->post();

        // redefinindo a senha do usuário aqui
        $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);

        $new_password_crypt = md5($new_password);

        // verificando a credencial para admin
        $query = $this->Employee->ajax_forgot_password($dados['email'], $dados['login']);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $this->db->where('id_person', $row->id_person);
            $result = $this->db->update('employee', ['password' => $new_password_crypt, 'reset' => '1']);

            if ($result) {
                // send new password to user email
                $resultEmail = $this->Email->password_reset_email($new_password, $dados['email'], $row);

                $this->response(['E-mail com nova senha enviado! Por favor verifique sua caixa de entrada!'], REST_Controller::HTTP_OK);
            } else {
                $this->response('Não foi possível localizar sua conta, por favor verifique seus dados!', REST_Controller::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response('Não foi possível localizar sua conta, por favor verifique seus dados!', REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Verificar se o Place informado já existe ou cria um novo e retorna o ID
     *
     * $state Sigla do estado
     * $city Nome da cidade
     * $neighborhood Nome do Bairro
     * $place Nome da rua
     * @return id_place ID da rua
     */
    private function getIdPlace($state, $city, $neighborhood, $place)
    {
        $city = $this->City->get_all_cityState($state, $city);

        $p_neighborhood = [
            'id_city' => $city['id'],
            'name' => mb_strtoupper($neighborhood),
        ];

        $neighborhood = $this->Neighborhood->get_all_neighborhoodCity($city['id'], mb_strtoupper($neighborhood));
        $id_neighborhood = !$neighborhood ? $this->Neighborhood->add_neighborhood($p_neighborhood) : $neighborhood['id'];

        $p_place = [
            'name' => $place,
            'id_neighborhood' => $id_neighborhood,
        ];

        $place = $this->Places->get_all_placeNeighborhood($id_neighborhood, $place);
        $id_place = !$place ? $this->Places->add_places($p_place) : $place['id'];

        return $id_place;
    }
}
