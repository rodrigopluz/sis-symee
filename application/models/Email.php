<?php 

if (!defined('BASEPATH')) 
	exit('No direct script access allowed');

class Email extends CI_Model
{
	function __construct()
    {
		parent::__construct();
		$this->load->helper('dump');
    }

	public function account_opening_email($type = '', $email = '', $password = '')
	{
		$system_name = $this->db->get_where('settings', ['type' => 'system_name'])->row()->description;
		$account_type = $this->db->get_where('profile', ['id' => $type])->row()->name;

		// $password = $this->db->get_where('person', ['email' => $email])->row()->password;
		
		$email_msg  = 'Bem-vindo ao '. $system_name .' - '. $system_title .'<br/>';
		$email_msg .= 'Sua conta é do tipo: '. $account_type .'<br/>';
		$email_msg .= 'Sua senha de acesso temporária: '. $password .'<br/>';
		$email_msg .= 'Clique aqui - '. base_url() .'/login <br/>';
		
		$email_sub = 'E-mail de abertura da conta';
		$email_to =	$email;
		
		$this->do_email($email_msg, $email_sub, $email_to);
	}
	
	/**
	 * reset password send email system-web
	 */
	public function password_reset_email($new_password = '', $email = '', $row)
	{
		if (isset($row->id)) {
			$email_msg = 'Seu perfil de conta é : <strong>'. $row->name_profile .'</strong><br/>';
			$email_msg .= 'Sua senha temporária é : <strong>'. $new_password .'</strong><br/>';
			
			$email_sub = 'Pedido de redefinição de senha';
			$email_to =	$email;

			$this->do_email($email_msg, $email_sub, $email_to);
			return true;
		}
		else {
			return false;
		}
	}

	/*** custom email sender ****/
	private function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL)
	{
		$config = [];
        $config['useragent'] 		= 'Symee';
        $config['mailpath']	 	= '/usr/bin/sendmail'; // or '/usr/sbin/sendmail'
        $config['protocol']	 	= 'smtp';
        $config['smtp_host'] 		= 'ssl://mail.symee.com.br';
        $config['smtp_port'] 		= '465';
        $config['smtp_timeout'] 	= '30';
		$config['smtp_user']	= '';
		$config['smtp_pass']	= '';
        $config['mailtype']	 	= 'html';
        $config['charset']	 	= 'utf-8';
        $config['newline']	 	= "\r\n";
        $config['wordwrap']	 	= TRUE;

        $this->load->library('email');
        $this->email->initialize($config);

		$system_title = $this->db->get_where('settings', ['type' => 'system_title'])->row()->description;
		$system_name  = $this->db->get_where('settings', ['type' => 'system_name'])->row()->description;

		if ($from == NULL)
			$from =	$this->db->get_where('settings', ['type' => 'system_email'])->row()->description;
		
		$this->email->from($from, $system_title .' '. $system_name);
		$this->email->from($from, $system_title .' '. $system_name);
		$this->email->to($to);
		$this->email->subject($sub);
		
		$msg = $msg . '<br/><br/><br/><br/><br/><br/><br/>
			<hr/>
			<center>
				<a href="'. base_url() .'/login">&copy; '. date('Y') .'
					<div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
						'. img(['src' => image(base_url().'uploads/logo.png', null), 'width' => '135', 'alt' => '']) .'
					</div>
					'. $system_name .'
				</a>
			</center>';

		$this->email->message($msg);
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

