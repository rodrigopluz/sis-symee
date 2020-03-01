<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('FunctionCategorys/create', ['class' => 'form-content']); ?>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('category'), 'category', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'category', 'id' => 'category', 'class' => 'form-control', 'value' => '']); ?>
					<?= form_error('category'); ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>