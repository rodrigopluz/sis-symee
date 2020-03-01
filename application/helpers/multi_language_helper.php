<?php  

if (! defined('BASEPATH')) 
	exit('No direct script access allowed');

/**
 * CodeIgniter
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

/*- get_phrase - db language -*/
if (!function_exists('get_phrase')) {
	function get_phrase($phrase = '')
	{
		$CI	=& get_instance();
		$CI->load->database();
		$current_language =	$CI->db->get_where('settings', ['type' => 'language'])->row()->description;
		
		if ($current_language == '') {
			$current_language =	'english';
			$CI->session->set_userdata('current_language', $current_language);
		}

		/** insert blank phrases initially and populating the language db ***/
		$check_phrase =	$CI->db->get_where('language', ['phrase' => $phrase])->row()->phrase;
		if ($check_phrase != $phrase)
			$CI->db->insert('language', ['phrase' => $phrase]);	
		
		// query for finding the phrase from `language` table
		$query = $CI->db->get_where('language', ['phrase' => $phrase]);
		$row   = $query->row();	
		
		// return the current sessioned language field of according phrase, else return uppercase spaced word
		if (isset($row->$current_language) && $row->$current_language != "")
			return $row->$current_language;
		else 
			return ucwords(str_replace('_',' ',$phrase));
	}
}

/*- get_type - db settings -*/
if (!function_exists('get_type')) {
	function get_type($type = '')
	{
		$CI =& get_instance();
		$CI->load->database();
		$current_setting = $CI->db->get_where('settings', ['type' => 'language'])->row()->description;

		if ($current_setting == '') {
			$current_setting = 'english';
			$CI->session->set_userdata('current_setting', $current_setting);
		}

		// query for finding the type from `settings` table
		$query = $CI->db->get_where('settings', ['type' => $type]);
		$row   = $query->row();	
		
		// return the current sessioned settings field of according type, else return uppercase spaced word
		if (isset($row->description) && $row->description != "")
			return $row->description;
		else 
			return ucwords(str_replace('_',' ',$type));
	}
}

// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */