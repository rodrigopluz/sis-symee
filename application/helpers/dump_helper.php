<?php

/**
 * CodeIgniter Dump Helpers
 * 
 * @package 	CodeIgniter
 * @category 	Helpers
 * @author 		Rodrigo Luz (rodrigopluz@gmail.com)
 * @version 	1.0
 */ 

if (!function_exists('dump')) {
	function dump($var, $show = TRUE, $exit = FALSE) {
		// add formatting
		echo '<pre>';
		var_dump($var);
		echo '</pre>';

		// output
		if ($show == TRUE) {
			echo $output;
		} else {
			return $output;
		}

		// exit ?
		if ($exit == TRUE) {
			exit;
		}
	}
}

/* End of file dump_helpers.php */
/* Location: ./application/helpers/dump_helpers.php */