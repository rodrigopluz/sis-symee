<link rel="stylesheet" href="<?= base_url(); ?>assets/js/dropzone/dropzone.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/select2/select2.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">

<!-- Bottom Scripts -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/gsap/main-gsap.js"></script>
<!-- <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui/js/jquery-ui-1.12.1.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/joinable.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/resizeable.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/symee/symee-api.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/toastr.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/fileinput.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/dropzone/dropzone.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datatables/lodash.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/select2/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.maskMoney.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.multi-select.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/symee/symee-custom.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/scripts-symee.js"></script>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""): ?>
	<script type="text/javascript">
		toastr.success('<?= $this->session->flashdata("flash_message"); ?>');
	</script>
<?php endif; ?>

<?php if ($this->session->flashdata('flash_message_error') != ""): ?>
	<script type="text/javascript">
		toastr.error('<?= $this->session->flashdata("flash_message_error"); ?>');
	</script>
<?php endif; ?>

<!-- DATA TABLE EXPORT CONFIGURATIONS -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var datatable = $("#table_export").dataTable();
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>