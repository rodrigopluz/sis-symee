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

/**
 * not format string by - cpf-cnpj
 */
if (!function_exists('notformat_cpfcnpj'))
{
    function notformat_cpfcnpj($document)
    {
        $document = trim($document);
        $document = str_replace(".", "", $document);
        $document = str_replace(",", "", $document);
        $document = str_replace("-", "", $document);
        $document = str_replace("/", "", $document);
        return $document;
    }
}

/**
 * add format string by - cnpj
 */
if (!function_exists('addformat_cnpj'))
{
    function addformat_cnpj($cnpj)
    {
        $cnpj_format = $cnpj[0].$cnpj[1].".";
        $cnpj_format .= $cnpj[2].$cnpj[3].$cnpj[4].".";
        $cnpj_format .= $cnpj[5].$cnpj[6].$cnpj[7]."/";
        $cnpj_format .= $cnpj[8].$cnpj[9].$cnpj[10].$cnpj[11]."-";
        $cnpj_format .= $cnpj[12].$cnpj[13];
        
        return $cnpj_format;
    }
}

/**
 * not format string by - cnpj
 */
if (!function_exists('notformat_cnpj'))
{
    function notformat_cnpj($cnpj)
    {
        return str_replace(array(".","/","-"), array("","",""), $cnpj);
    }
}

/**
 * add format string by - zipcode
 */
if (!function_exists('addformat_zipcode'))
{
    function addformat_zipcode($zipcode)
    {
        $zip_code =  $zipcode[0].$zipcode[1].$zipcode[2].$zipcode[3].$zipcode[4]."-";
        $zip_code .= $zipcode[5].$zipcode[6].$zipcode[7];

        return $zip_code;
    }
}

/**
 * not format string by - zipcode
 */
if (!function_exists('notformat_zipcode'))
{
    function notformat_zipcode($cep)
    {
        return str_replace(array("-"), array(""), $cep);
    }
}

/**
 * add format string by - cpf
 */
if (!function_exists('addformat_cpf'))
{
    function addformat_cpf($cpf)
    {
        $cpf_format = $cpf[0].$cpf[1].$cpf[2].".";
        $cpf_format .= $cpf[3].$cpf[4].$cpf[5].".";
        $cpf_format .= $cpf[6].$cpf[7].$cpf[8]."-";
        $cpf_format .= $cpf[9].$cpf[10];
        
        return $cpf_format;
    }
}

/**
 * not format string by - cpf
 */
if (!function_exists('notformat_cpf'))
{
    function notformat_cpf($cpf)
    {
        return str_replace(array(".","-"), array("",""), $cpf);
    }
}

/**
 * format date pattern pt-br
 */
if (!function_exists('format_dateptbr'))
{
    function format_dateptbr($date)
    {
        return date('d/m/Y', strtotime(str_replace('-', '/', $date)));
    }
}

/**
 * format date pattern mysql
 */
if (!function_exists('format_date'))
{
    function format_date($date)
    {
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
}

/**
 * add format string by - phone
 */
if (!function_exists('addformat_phone'))
{
    function addformat_phone($phone)
    {
        $phone_format = "(". $phone[0].$phone[1].") ";
        $phone_format .= $phone[2].$phone[3].$phone[4].$phone[5].$phone[6].".";
        $phone_format .= $phone[7].$phone[8].$phone[9].$phone[10];

        return $phone_format;
    }
}

/**
 * format date mes
 */
if (!function_exists('date_mes_ptbr'))
{
    function date_mes_ptbr()
    {
        $mes = date('M');
        $mes_extenso = [
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Março',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        ];

        return $mes_extenso[$mes];
    }
}

/**
 * script_tag
 *
 * @description Generates script to a JS file
 * @access public
 * @param mixed scripts hrefs or an array
 * @param string type
 * @param string title
 * @param string media
 * @param boolean should index_page be added to the css path
 * @return string
 */
if (!function_exists('script_tag'))
{
	function script_tag($href = '', $type = 'text/javascript', $title = '', $media = '', $index_page = FALSE)
	{
		$CI =& get_instance();

		$link = '
		<script ';

		if (is_array($href)) {
			foreach ($href as $k=>$v) {
				if ($k == 'src' AND strpos($v, '://') === FALSE) {
					if ($index_page === TRUE) {
						$link .= 'src="'. $CI->config->site_url($v) .'" ';
					}
					else {
						$link .= 'src="'. $CI->config->slash_item('base_url') . $v .'" ';
					}
				}
				else {
					$link .= "$k=\"$v\" ";
				}
			}

			$link .= "/>";
		}
		else {
			if (strpos($href, '://') !== FALSE) {
				$link .= 'src="'. $href .'" ';
			}
			elseif ($index_page === TRUE) {
				$link .= 'src="'. $CI->config->site_url($href) .'" ';
			}
			else {
				$link .= 'src="'. $CI->config->slash_item('base_url') . $href .'" ';
			}

			$link .= 'type="'. $type .'" ';

			if ($media	!= '') {
				$link .= 'media="'. $media .'" ';
			}

			if ($title	!= '') {
				$link .= 'title="'. $title .'" ';
			}

			$link .= '/></script>';
        }
        
		return $link;
	}
}