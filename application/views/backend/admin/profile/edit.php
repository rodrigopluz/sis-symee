<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('Profiles/edit/'. $profile['id'], ['class' => 'form-content']); ?>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('Categoria', 'name', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'value' => set_value('name', $profile['name'])]); ?>
					<?= form_error('name'); ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('ACL', 'acl', ['class' => 'control-label']); ?>
				<div class=""></div>
			</div>
			<div class="clearfix"></div>
			<div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>