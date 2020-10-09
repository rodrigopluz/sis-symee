<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('FunctionRoles/edit/'. $function_role['id'], ['class' => 'form-content']); ?>
			<div class="form-group  col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('function_role'), 'name', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'value' => set_value('name', $function_role['name'])]); ?>
					<?= form_error('name'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('category'), 'category', ['class' => 'control-label']); ?>
				<div class="">
					<?php foreach ($category as $_category) $category_option[$_category['id']] = $_category['category']; ?>
					<?= form_dropdown('category', $category_option, set_value('id', $function_role['id_function_category']), ['class' => 'form-control', 'id' => 'category']); ?>
					<?= form_error('category'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
				<div class="">
					<?php $status_option = ['1' => 'Ativo', '0' => 'Inativo']; ?>
					<?= form_dropdown('status', $status_option, set_value('status', $function_role['status']), ['class' => 'form-control', 'id' => 'status']); ?>
					<?= form_error('status'); ?>
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