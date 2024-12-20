<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagination configuration
 */
$config['page_query_string'] = TRUE;
$config['per_page'] = 5;
$config['query_string_segment'] = 'page';
$config['use_page_numbers'] = TRUE;

/**
 * Styling the pagination
 *
 * The code is below is customized for the Bootstrap CSS/JS Framework
 * You can also include here your customized CSS classes
 */
// $config['full_tag_open'] = '<ul class="pagination">';
// $config['full_tag_close'] = '</ul>';
// $config['num_tag_open'] = '<li>';
// $config['num_tag_close'] = '</li>';
// $config['cur_tag_open'] = '<li class="disabled"><li class="active"><a href=#>';
// $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
// $config['next_tag_open'] = '<li>';
// $config['next_tagl_close'] = '</li>';
// $config['prev_tag_open'] = '<li>';
// $config['prev_tagl_close'] = '</li>';
// $config['first_tag_open'] = '<li>';
// $config['first_tagl_close'] = '</li>';
// $config['last_tag_open'] = '<li>';
// $config['last_tagl_close'] = '</li>';