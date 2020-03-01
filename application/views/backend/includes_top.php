<link rel="stylesheet" href="<?= base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-v3.css">
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-v4.css"> -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-core.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-theme.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-forms.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">

<?php $skin_colour = $this->db->get_where('settings', ['type' => 'skin_colour'])->row()->description; ?>
<?php if ($skin_colour != ''): ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/skins/<?= $skin_colour; ?>.css">
<?php endif; ?>
<?php if ($text_align == 'right-to-left'): ?>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/symee-rtl.css">
<?php endif; ?>

<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery-1.12.4.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png">
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-icons/font-awesome-4.7.0/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/css/font-icons/font-awesome-4.4.0/css/font-awesome.min.css"> -->
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/js/vertical-timeline/css/component.css"> -->
<!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/js/datatables/responsive/css/datatables.responsive.css"> -->

<!--Amcharts-->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/fullcalendar/fullcalendar.js"></script>
<!-- <script src="<?= base_url(); ?>assets/js/fullcalendar/locale-all.js" type="text/javascript"></script> -->

<?php if ($this->uri->segment(2) == 'locais-trabalho'): ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByQN0wFfnLCSWglE21nyPakQYoGyzhlF8&amp;sensor=false"></script>
<?php endif; ?>

<script>
    function checkDelete() {
        var chk = confirm("Are You Sure To Delete This !");
        if (chk) { return true; } else { return false; }
    }
</script>