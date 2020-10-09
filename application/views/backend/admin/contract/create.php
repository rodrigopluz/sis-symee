<hr/>
<div class="row">
	<div class="clearfix">
		<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="alert alert-default">
				<p><?= get_phrase('info_contract'); ?></p>
			</div>
		</div>
		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<?= form_label(get_phrase('type_document'), '', ['class' => 'control-label']); ?>
			<div class="">
				<div class="col-sm-4 radio radio-replace">
					<?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 'pf', 'value' => 'F', 'class' => 'type_fj']); ?>
					<?= form_label('Pessoa Fisica'); ?>
				</div>
				<div class="col-sm-4 radio radio-replace">
					<?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 'pj', 'value' => 'J', 'class' => 'type_fj']); ?>
					<?= form_label('Pessoa Juridica'); ?>
				</div>
			</div>
		</div>
		<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<?= form_label(get_phrase('cpf_cnpj'), '', ['class' => 'control-label']); ?>
			<div class="">
				<?= form_input(['name' => 'cpf_cnpj', 'id' => 'cpf-cnpj', 'class' => 'form-control cpf_cnpj_mask', 'readonly' => 'readonly']); ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="table-entail">
			<h4 class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<i class="fa fa-lg fa-list-alt"></i>
				<span class="applicant"></span>
			</h4>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label('', 'label-name', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'name', 'id' => 'name', 'class' => 'form-control', 'readonly' => 'readonly']); ?>
				</div>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('email'), '', ['class' => 'control-label']); ?>
				<div class="input-group">
					<span class="input-group-addon"><i class="entypo-mail"></i></span>
					<?= form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'readonly' => 'readonly']); ?>
				</div>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('phone'), '', ['class' => 'control-label']); ?>
				<div class="input-group">
					<span class="input-group-addon"><i class="entypo-mobile"></i></span>
					<?= form_input(['name' => 'phone', 'id' => 'phone', 'class' => 'form-control mask-phone', 'readonly' => 'readonly', 'type' => 'tel']); ?>
				</div>
			</div>
			<?= form_hidden('company', set_value('company')); ?>
			<?= form_hidden('device', set_value('device')); ?>
			<?= form_hidden('uuid', set_value('uuid')); ?>
			<?= form_hidden('token', set_value('token')); ?>
			<?= form_hidden('model', set_value('model')); ?>
			<div class="clearfix"></div>
			<h4 class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<i class="fa fa-lg fa-building-o"></i>
				<span class="company"><?= get_phrase('company'); ?></span>
			</h4>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('cnaes'), '', ['class' => 'control-label']); ?>
				<div class="">
					<?php $category_option[''] = 'Selecione'; ?>
					<?php if ($this->session->userdata('profile_id') == 1) { ?>
						<?php foreach ($fcategory as $_category) $category_option[$_category['id']] = $_category['category']; ?>
					<?php } else { ?>
						<?php foreach ($fcategory as $_category) $category_option[$_category['id_function_category']] = $_category['category']; ?>
					<?php } ?>
					<?= form_dropdown('category', $category_option, null, ['class' => 'form-control', 'id' => 'category']); ?>
				</div>
			</div>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('function_role'), '', ['class' => 'control-label']); ?>
				<div class="">
					<?php $function_option[''] = 'Selecione'; ?>
					<?php foreach ($froles as $_role) $function_option[$_role['id_function_category']] = $_role['name']; ?>
					<?= form_dropdown('role', $function_option, null, ['class' => 'form-control', 'id' => 'role', 'disabled' => 'disabled']); ?>
				</div>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?= form_label(get_phrase('data_start'), 'data-start', ['class' => 'control-label']); ?>
				<div class="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<?= form_input(['name' => 'data_start', 'id' => 'data-start', 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
					</div>
				</div>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?= form_label(get_phrase('time_hour'), 'time-hour', ['class' => 'control-label']); ?>
				<div class="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-money"></i></span>
						<?= form_input(['name' => 'time_hour', 'id' => 'time-hour', 'class' => 'form-control mak-money']); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="btns-entail text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary save-entail"'); ?>
			<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
		</div>
	</div>
</div>