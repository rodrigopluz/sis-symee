<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $system_name  = $this->db->get_where('settings', ['type'=>'system_name'])->row()->description; ?>
		<?php $system_title = $this->db->get_where('settings', ['type'=>'system_title'])->row()->description; ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="SYMEE Admin Panel" />
		<meta name="author" content="" />
		<title><?= get_phrase('login'); ?> | <?= $system_title; ?></title>
		<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
		<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
		<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-icons/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
		<link rel="stylesheet" href="assets/css/bootstrap-v3.css">
		<link rel="stylesheet" href="assets/css/symee-core.css">
		<link rel="stylesheet" href="assets/css/symee-theme.css">
		<link rel="stylesheet" href="assets/css/symee-forms.css">
		<link rel="stylesheet" href="assets/css/custom.css">
		<script src="assets/js/jquery/jquery-1.11.0.min.js"></script>
		<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="assets/images/favicon.png">	
	</head>
	<body class="page-body login-page login-form-fall">
		<!-- This is needed when you send requests via Ajax -->
		<script type="text/javascript">
			var baseurl = '<?= base_url(); ?>';
		</script>
		<div class="login-container">
			<div class="login-header login-caret">
				<div class="login-content">
					<a href="<?= base_url(); ?>" class="logo">
						<img src="uploads/logo.png" height="60" alt="" />
					</a>
					<p class="description">&nbsp;</p>
					<p class="description">&nbsp;</p>
					<!-- progress bar indicator -->
					<div class="login-progressbar-indicator">
						<h3>43%</h3>
						<span><?= ucfirst(get_phrase('logging_in')); ?>...</span>
					</div>
				</div>
			</div>
			<div class="login-progressbar">
				<div></div>
			</div>
			<div class="login-form">
				<div class="login-content">
					<div class="form-login-error">
						<h3>Login invalido</h3>
						<p>Digite CPF e senha corretos.</p>
					</div>
					<div class="form-login-error-cancel">
						<h3>Conta cancelado</h3>
						<p>Conta encontra-se cancelada.</p>
					</div>
					<form method="post" role="form" id="form_login">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-user"></i>
								</div>
								<?= form_input(['name' => 'cpf', 'id' => 'cpf', 'placeholder' => 'CPF', 'class' => 'form-control', 'autocomplete' => 'off']); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-key"></i>
								</div>
								<?= form_input(['name' => 'password', 'id' => 'password', 'placeholder' => 'Senha', 'class' => 'form-control', 'autocomplete' => 'off', 'type' => 'password']); ?>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-login">
								<i class="entypo-login"></i> <?= ucfirst(get_phrase('login')); ?>
							</button>
						</div>	
					</form>
					<div class="login-bottom-links">
						<a href="<?= base_url(); ?>login/esqueci-senha" class="link">
							<?= get_phrase('forgot_your_password'); ?>
						</a>
					</div>
					<div class="login-bottom-links">
						<a href="<?= base_url(); ?>login/leitor-qrcode" class="link">
							<i class="fa fa-qrcode"></i>
							<?= get_phrase('hit_point_qrcode'); ?>
						</a>
					</div>
					<div class="login-bottom-links">
						<a href="http://www.symee.com.br" class="link">
							<i class="fa fa-angle-double-left"></i>
							<?= get_phrase('return_site'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Bottom Scripts -->
		<script type="text/javascript" src="assets/js/gsap/main-gsap.js"></script>
		<script type="text/javascript" src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/js/resizeable.js"></script>
		<script type="text/javascript" src="assets/js/symee/symee-api.js"></script>
		<script type="text/javascript" src="assets/js/jquery/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/symee/symee-login.js"></script>
		<script type="text/javascript" src="assets/js/symee/symee-custom.js"></script>
	</body>
</html>