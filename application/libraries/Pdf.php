<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');  
 
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

/**
 * Pdf Library
 *
 *  @author       : Rodrigo Pereira da Luz
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : Sistema Web - Symee
 *  specification : Class Pdf
 */
class Pdf extends Dompdf
{
	public function __construct()
	{
		 parent::__construct();
	} 
}
