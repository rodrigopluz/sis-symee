<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Employee');
        $this->load->library('session');
    }

    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function create_log($data)
    {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];

        // if ($_SERVER["REMOTE_ADDR"] == '::1') $data_ip = '186.251.111.153';
        // else $data_ip = $_SERVER["REMOTE_ADDR"];
        
        // $location = new SimpleXMLElement(file_get_contents('http://freegeoip.io/xml/'. $_SERVER["REMOTE_ADDR"]));
        $location = simplexml_load_file('http://freegeoip.io/xml/'. $data_ip);

        // print_r($data);
        // print_r($location);
        
        /*
        $data['location'] = $location->city .' , '. $location->country;
        $this->db->insert('log', $data);
        */
    }

    function get_system_settings()
    {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    ////////IMAGE URL//////////
    public function get_image_url_m($type = '', $avatar = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $avatar))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $avatar;
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    public function get_image_url_f($type = '', $avatar = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $avatar))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $avatar;
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    public function get_image_logo($type = '', $id = '')
    {
        if (file_exists('uploads/'. $type .'_logo/'. $id .'.jpg'))
            $logo = base_url() .'uploads/'. $type .'_logo/'. $id .'.jpg';
        else 
            $logo = base_url() .'uploads/no_photo.png';

        return $logo;
    }

    /**
     * get_ip
     */
    public function get_ip()
    {
        $variables = [
            'REMOTE_ADDR',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_X_COMING_FROM',
            'HTTP_COMING_FROM',
            'HTTP_CLIENT_IP'
        ];

        $return = 'Unknown';

        foreach ($variables as $variable) {
            if (isset($_SERVER[$variable])) {
                $return .= $_SERVER[$variable] ." - ";
            }
        }

        return $return;
    }
}
