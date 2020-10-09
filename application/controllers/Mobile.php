<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 25 may, 2014
 *  e-mail        : rodrigopluz@gmail.com
 *	item          : CMS - Projetos RPL
 *  specification : Mobile app response, JSON formatted data for iOS & android app
 *	portfolio     : http://
 *  website       : http://
 *	support       : http://
 */
class Mobile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();

        // Authenticate data manipulation with the user level security key
        if ($this->validate_auth_key() != 'success') die;
    }
    
    /**
     * generate response to home page with all pixels and advertise_id
     */
    public function get_class()
    {
        $response = $this->db->get('class')->result_array();
        echo json_encode($response);
    }

    /**
     * returns image of user, returns blank image if not found.
     */
    public function get_image_url($type = '', $id = '')
    {
        $type     = $this->input->post('user_type');
        $id       = $this->input->post('user_id');
        $response = [];

        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $response['image_url'] = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $response['image_url'] = base_url() . 'uploads/user.jpg';

        echo json_encode($response);
    }

    /**
     * returns system name and logo as public call
     */
    public function get_system_info()
    {
        $response['system_name'] = $this->db->get_where('settings', ['type' => 'system_name'])->row()->description;
        echo json_encode($response);
    }

    public function get_loggedin_user_profile()
    {
        $response      = [];
        $login_type    = $this->input->post('login_type');
        $login_user_id = $this->input->post('login_user_id');
        $user_profile  = $this->db->get_where($login_type, array($login_type.'_id' => $login_user_id))->result_array();

        foreach ($user_profile as $row) {
            $data['name']      = $row['name'];
            $data['email']     = $row['email'];
            $data['image_url'] = $this->Crud->get_image_url($login_type, $login_user_id);
            break;
        }

        array_push($response , $data);
        echo json_encode($response);
    }

    public function update_user_image()
    {
        $response  = [];
        $user_type = $this->input->post('login_type');
        $user_id   = $this->input->post('login_user_id');

        $directory = 'uploads/' . $user_type .  '_image/' . $user_id . '.jpg';
        move_uploaded_file($_FILES['user_image']['tmp_name'], $directory);

        $response = ['update_status' => 'success'];
        echo json_encode($response);
    }

    public function update_user_info()
    {
        $response  = [];
        $user_type = $this->input->post('login_type');
        $user_id   = $this->input->post('login_user_id');

        $data['name']  = $this->input->post('name');
        $data['email'] = $this->input->post('email');

        $this->db->where( $user_type . '_id' , $user_id);
        $this->db->update( $user_type , $data);

        $response = ['update_status' => 'success'];
        echo json_encode($response);
    }

    public function update_user_password()
    {
        $response  = [];
        $user_type = $this->input->post('login_type');
        $user_id   = $this->input->post('login_user_id');

        $old_password = $this->input->post('old_password');
        $data['password'] = $this->input->post('new_password');

        // verify if old password matches
        $this->db->where($user_type . '_id', $user_id);
        $this->db->where('password', $old_password);
        $verify_query = $this->db->get($user_type);

        if ($verify_query->num_rows() > 0) {
            $this->db->where($user_type . '_id', $user_id);
            $this->db->update($user_type, $data);

            $response = ['update_status' => 'success'];
        }
        else {
            $response = ['update_status' => 'failed'];
        }
        
        echo json_encode($response);
    }

    /**
     * user login matching with db
     */
    public function login()
    {
        $response = [];
        $email    = $this->input->post("email");
        $password = $this->input->post("password");

        // Checking login credential for admin
        $query = $this->db->get_where('admin', ['email' => $email, 'password' => $password]);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $authentication_key        = md5(rand(10000, 1000000));
            $response['status']        = 'success';
            $response['login_type']    = 'admin';
            $response['login_user_id'] = $row->admin_id;
            $response['name']          = $row->name;

            $response['authentication_key'] = $authentication_key;

            // update the new authentication key into user table
            $this->db->where('admin_id', $row->admin_id);
            $this->db->update('admin', ['authentication_key' => $authentication_key]);

            echo json_encode($response);
            return;
        }

        // Checking login credential for student
        // ...

        echo json_encode($response);
    }

    /**
     * forgot password link
     */
    public function reset_password()
    {
        $response           = [];
        $response['status'] = 'false';
        $email              = $_POST["email"];
        $reset_account_type = '';

        //resetting user password here
        $new_password = substr(rand(100000000,20000000000), 0,7);

        // Checking credential for admin
        $query = $this->db->get_where('admin', ['email' => $email]);
        
        if ($query->num_rows() > 0) {
            $reset_account_type = 'admin';
            $this->db->where('email', $email);
            $this->db->update('admin', ['password' => $new_password]);
            $response['status'] = 'true';
        }

        // Checking credential for student
        $query = $this->db->get_where('student', ['email' => $email]);
        if ($query->num_rows() > 0) {
            $reset_account_type = 'student';
            $this->db->where('email', $email);
            $this->db->update('student', ['password' => $new_password]);
            $response['status'] = 'true';
        }

        // Checking credential for teacher
        $query = $this->db->get_where('teacher', ['email' => $email]);
        if ($query->num_rows() > 0) {
            $reset_account_type = 'teacher';
            $this->db->where('email', $email);
            $this->db->update('teacher', ['password' => $new_password]);
            $response['status'] = 'true';
        }
        
        // Checking credential for parent
        $query = $this->db->get_where('parent', ['email' => $email]);
        if ($query->num_rows() > 0) {
            $reset_account_type = 'parent';
            $this->db->where('email', $email);
            $this->db->update('parent', ['password' => $new_password]);
            $response['status'] = 'true';
        }

        // send new password to user email  
        $this->Email->password_reset_email($new_password , $reset_account_type , $email);
        echo json_encode($response);
    }

    /**
     * authentication_key validation
     */
    public function validate_auth_key()
    {
        /*
        * Ignore the authentication and returns success by default to constructor 
        * For pubic calls: login, forget password.
        * Pass post parameter 'authenticate' = 'false' to ignore the user level authentication
        */
        if ($this->input->post('authenticate') == 'false')
            return 'success';

        $response           = [];
        $authentication_key = $this->input->post("authentication_key");
        $user_type          = $this->input->post("user_type");

        $query = $this->db->get_where($user_type, ['authentication_key' => $authentication_key]);
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $response['status']     = 'success';
            $response['login_type'] = 'admin';

            if ( $user_type == 'admin' )
                $response['login_user_id'] = $row->admin_id;
            if ( $user_type == 'teacher' )
                $response['login_user_id'] = $row->teacher_id;
            if ( $user_type == 'student' )
                $response['login_user_id'] = $row->student_id;
            if ( $user_type == 'parent' )
                $response['login_user_id'] = $row->parent_id;

            $response['authentication_key'] = $authentication_key;
        }
        else {
            $response['status'] = 'failed';
        }

        // return json_encode($response);
        return $response['status'];
    }
}




