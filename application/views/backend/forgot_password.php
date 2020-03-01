<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $system_name = $this->db->get_where('settings', ['type' => 'system_name'])->row()->description; ?>
        <?php $system_title = $this->db->get_where('settings', ['type' => 'system_title'])->row()->description; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="SYMEE Admin Panel" />
        <meta name="author" content="" />

        <title><?= get_phrase('reset_password'); ?> | <?= $system_title; ?></title>

        <link rel="stylesheet" href="<?= base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-v3.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-core.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-theme.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-forms.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">

        <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery-1.11.0.min.js"></script>

        <!--[if lt IE 9]><script type="text/javascript" src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">
    </head>
    <body class="page-body login-page login-form-fall" data-url="http://symee.dev">
        <!-- This is needed when you send requests via Ajax -->
        <script type="text/javascript">
            var baseurl = '<?= base_url(); ?>';
        </script>
        <div class="login-container">
            <div class="login-header login-caret">
                <div class="login-content" style="width:100%;">
                    <a href="<?= base_url(); ?>" class="logo">
                        <img src="<?= base_url(); ?>uploads/logo.png" height="60" alt="" />
                    </a>
                    <p class="description">&nbsp;</p>
                    <p class="description">Digite seu e-mail para redefinir a senha.</p>
                    <!-- progress bar indicator -->
                    <div class="login-progressbar-indicator">
                        <h3>43%</h3>
                        <span>redefinindo a senha...</span>
                    </div>
                </div>
            </div>
            <div class="login-progressbar">
                <div></div>
            </div>
            <div class="login-form">
                <div class="login-content">
                    <div class="form-login-error">
                        <h3>E-mail inválido</h3>
                        <p>Digite o login e um e-mail correto</p>
                    </div>
                    <form method="post" role="form" id="form_forgot_password">
                        <div class="form-forgotpassword-success">
                            <i class="entypo-check"></i>
                            <h3>O e-mail de resgate foi enviado.</h3>
                            <p>Por favor, verifique sua caixa de entrada de e-mail, a instrução de redefinição de senha é enviada!</p>
                        </div>
                        <div class="form-steps">
                            <div class="step current" id="step-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="entypo-mail"></i>
                                        </div>
                                        <?= form_input(['name' => 'email', 'id' => 'email', 'placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off', 'type' => 'email']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block btn-login">
                                        <i class="entypo-right-open-mini"></i>
                                        <?= get_phrase('reset_password'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="login-bottom-links">
                        <a href="<?= base_url(); ?>login" class="link">
                            <i class="entypo-lock"></i>
                            <?= get_phrase('return_to_login_page'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Scripts -->
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/gsap/main-gsap.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/resizeable.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/symee/symee-api.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/symee/symee-forgotpassword.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.inputmask.bundle.min.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/js/symee/symee-custom.js"></script>
    </body>
</html>