<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * {{ title }} Controller
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class {{ title }}
 */
class {{ title }} extends CI_Controller
{
    /**
{% for model in models %}
     * @param {{ model }}
{% endfor %}
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dump');
        $this->load->library('session');

{% for model in models %}
        $this->load->model('{{ model }}');
{% endfor %}

        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
    }

    /**
     * Index a listing of {{ singular | lower | replace({'_': '_'}) }}.
     *
     * @return void
     */
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        
        $page_data['{{ plural }}'] = $this->{{ model }}->get_all_{{ singular }}();

        $page_data['page_menu']  = '{{ singular }}';
        $page_data['page_name']  = '{{ singular }}/index';
        $page_data['page_title'] = get_phrase('{{ singular }}');

        $this->load->view('backend/index', $page_data);
    }

    /**
     * View the specified {{ singular | lower | replace({'_': '-'}) }}.
     * 
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        if ( ! isset($id)) {
            show_404();
        }

        $page_data['{{ singular }}'] = $this->{{ model }}->get_{{ singular }}($id);

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Create the form for creating a new {{ singular | lower | replace({'_': '-'}) }}.
     *
     * @return void
     */
    public function create()
    {
        if (isset($_POST) && count($_POST) > 0) {   
            $params = array(
    {% for column in columns %}
        '{{ column }}' => $this->input->post('{{ column }}'),
    {% endfor %}
            );

            ${{ singular }}_id = $this->{{ model }}->add_{{ singular }}($params);
            redirect('{{ singular }}/index');
        } else {
            $page_data['page_name']  = '{{ singular }}/edit';
            $page_data['page_title'] = get_phrase('{{ singular }}');
        }

        $this->load->view('backend/index', $page_data);   
    }

    /**
     * Edit the form for editing the specified {{ singular | lower | replace({'_': '-'}) }}.
     * 
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        if (!isset($id)) {
            show_404();
        }

        $page_data['{{ singular }}'] = $this->{{ model }}->get_{{ singular }}($id);

{% for column in columns %}
{% if column in foreignKeys|keys %}
        /*- {{ foreignKeys[column] }} -*/
        ${{ column }} = $page_data['{{ singular }}']['{{ column }}'];
        $page_data['{{ foreignKeys[column] }}'] = $this->{{ foreignKeys[column] | capitalize }}->get_all_{{ foreignKeys[column] }}(${{ column }});

{% endif %}
{% endfor %}

        if (isset($page_data['{{ singular }}']['id'])) {
            if (isset($_POST) && count($_POST) > 0) {   
                $params = array(
        {% for column in columns %}
            '{{ column }}' => $this->input->post('{{ column }}'),
        {% endfor %}
        );

                $this->{{ model }}->update_{{ singular }}($id,$params);

                redirect('{{ singular }}/index');
            } else {
                $page_data['page_name']  = '{{ singular }}/edit';
                $page_data['page_title'] = get_phrase('{{ singular }}');
            }
        } else {
            show_error('The {{ singular }} you are trying to edit does not exist.');
        }

        $this->load->view('backend/index', $page_data);
    }

    /**
     * Deletes the specified {{ singular | lower | replace({'_': '-'}) }} from storage.
     * 
     * @param  int $id
     * @return void
     */
    public function delete($id)
    {
        if (!isset($id)) {
            show_404();
        }

        ${{ singular }} = $this->{{ model }}->delete_{{ singular }}($id);

        // check if the {{ singular }} exists before trying to delete it
        if (isset(${{ singular }}['id'])) {
            $this->{{ model }}->delete_{{ singular }}($id);
            redirect('{{ singular }}/index');
        } else {
            show_error('The {{ singular }} you are trying to delete does not exist.');
        }
    }
}