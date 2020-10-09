<?php

require APPPATH . 'libraries/REST_Controller.php';

/**
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 * 
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 */
class Auth extends REST_Controller
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
        $this->load->model('Employee');
    }

    /**
     * POST - create token. 
     * @return Response
     */
    public function login_post()
    {
        $username = $this->post('login');
        $password = $this->post('password');

        $invalidLogin = ['invalid' => $username];

        if (!$username || !$password) $this->response($invalidLogin, REST_Controller::HTTP_UNAUTHORIZED);

        $id = $this->Employee->login_employee($username, $password);

        if ($id) {
            $data_employee = $this->Employee->get_employee($id);
           
            $this->load->model('Person');
            $data_person = $this->Person->get_person($data_employee['id_person']);
           
            $issuedAt = time();
            $user = [
                'id' => $id,
                'login' => $username,
                'name' => $data_person['name'],
                'timestamp' => $issuedAt,
            ];
            
            $token = AUTHORIZATION::generateToken( $user ); 
            $user['access_token'] = $token;
            $output = [
                'user' => $user,
            ];

            //* salva no banco o token criado
            $this->db->where('id', $id);
            $this->db->set('token', $output['token']);
            $this->db->update('person');

            $this->response($output, REST_Controller::HTTP_OK);
        } else {
            $this->response($invalidLogin, REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
}