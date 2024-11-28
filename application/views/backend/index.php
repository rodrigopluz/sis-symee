<?php
$system_name        = $this->db->get_where('settings', ['type' => 'system_name'])->row()->description;
$system_title       = $this->db->get_where('settings', ['type' => 'system_title'])->row()->description;
$text_align         = $this->db->get_where('settings', ['type' => 'text_align'])->row()->description;
$account_type       = $this->session->userdata('login_type');
$skin_colour        = $this->db->get_where('settings', ['type' => 'skin_colour'])->row()->description;
$active_sms_service = $this->db->get_where('settings', ['type' => 'active_sms_service'])->row()->description;
?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl'; ?>">
	<head>
		<title><?= $page_title; ?> | <?= $system_title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="<?php ?>" />
		<meta name="author" content="<?php ?>" />
		<?php include 'includes_top.php'; ?>
	</head>
	<body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour; ?>">
		<script type="text/javascript">
			var baseurl = '<?= base_url(); ?>';
		</script>
		<?php include 'loading.php'; ?>
		<div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar'; ?>" >
			<?php include $account_type .'/navigation.php'; ?>	
			<div class="main-content">
				<?php include 'header.php'; ?>
	           	<h3>
	           		<i class="entypo-right-circled"></i> 
					<?= $page_title; ?>
	           	</h3>
				<?php include $account_type .'/'. $page_name .'.php'; ?>
				<?php include 'footer.php'; ?>
			</div>
			<?php //include 'chat.php'; ?>
		</div>
	    <?php include 'modal.php'; ?>
		<?php include 'includes_bottom.php'; ?>
	</body>
</html>