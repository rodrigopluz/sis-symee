<?php

if (! defined('BASEPATH')) 
    exit('No direct script access allowed');
    
/**
 * Format String Helper
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 */
function load_js($js)
{
    if (!is_array($js)) {
        return false;
    }
    
    $return = '';

    foreach ($js as $j) {
        $return .= '<script type="text/javascript" src="'. base_url() .'assets/js/'. $j .'"></script>'. "\n";
    }

    return $return;
}