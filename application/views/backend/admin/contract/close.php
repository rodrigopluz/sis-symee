<div class="row">
	<div class="clearfix">
		<div class="box-content">
			<div class="col-md-12">
				<div class="alert alert-default">
					<p><?= get_phrase('info_close_entail'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-content">
	<?= form_hidden('contract', set_value('contract', $this->uri->segment(5))); ?>
	<div class="fallback">
		<div class="form-group">
			<?= form_label(get_phrase('data_end'), 'data-end', ['class' => 'control-label']); ?>
			<div class="">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<?= form_input(['name' => 'data_end', 'id' => 'data-end', 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer" style="padding: 10px 0 0;">
		<?= form_button_submit(null, get_phrase('close_entail'), 'class="btn btn-danger" onclick="submitCloseForm()"'); ?>
	</div>
</div>

