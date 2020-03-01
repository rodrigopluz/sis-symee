<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

/** 
 *  @author       : Rodrigo Pereira da Luz
 *  date          : 06 august, 2019
 *  e-mail        : rodrigopluz@gmail.com
 *  item          : CMS - Projetos RPL
 *  specification : Class Admin
 *  portfolio     : http://
 *  website       : http://
 *  support       : http://
 */
class QRCode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('CI_QRCode');
    }

    /**
	 * default functin, redirects to login page if no admin logged in yet
	 */
    public function index()
    {
    }

    public function QRcode($kodenya = '123456789')
    {
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2     
        );
    }
}