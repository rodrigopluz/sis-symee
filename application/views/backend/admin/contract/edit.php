<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('Contracts/edit/' . $contract['id'], ['class' => 'form-content']); ?>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?php if ($contract['end_date']): ?>
					<h4 class="form-group"><?= get_phrase('end_date'); ?></h4>
					<p> <?= format_dateptbr($contract['end_date']); ?></p>
				<?php endif; ?>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('cpf_cnpj'), '', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'cpf_cnpj', 'id' => 'cpf-cnpj', 'value' => set_value('cpf_cnpj', $contract['cpf_cnpj']), 'class' => ($contract['type'] == 'F') ? 'form-control mask-cpf' : 'form-control mask-cnpj', 'readonly' => 'readonly']); ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="table-entails">
				<h4 class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<i class="fa fa-lg fa-list-alt"></i>
					<span class="applicant"><?= ($contract['type'] == 'F') ? 'Candidato' : 'Prestador de Serviço'; ?></span>
				</h4>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(($contract['type'] == 'F') ? get_phrase('name') : get_phrase('company'), 'label-name', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'name', 'id' => 'name', 'value' => set_value('pe_name', $contract['pe_name']), 'class' => 'form-control', 'readonly' => 'readonly']); ?>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('email'), '', ['class' => 'control-label']); ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="entypo-mail"></i></span>
						<?= form_input(['name' => 'email', 'id' => 'email', 'value' => set_value('email', $contract['email']), 'class' => 'form-control', 'readonly' => 'readonly']); ?>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('phone'), '', ['class' => 'control-label']); ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="entypo-mobile"></i></span>
						<?= form_input(['name' => 'phone', 'id' => 'phone', 'value' => set_value('phone', $contract['phone']), 'class' => 'form-control mask-phone', 'readonly' => 'readonly', 'type' => 'tel']); ?>
					</div>
				</div>
				<?= form_hidden('company', set_value('company', $contract['business_name'])); ?>
				<?= form_hidden('device', set_value('device', $contract['id_device'])); ?>
				<?= form_hidden('uuid', set_value('uuid', $contract['uuid'])); ?>
				<?= form_hidden('token', set_value('token', $contract['token'])); ?>
				<?= form_hidden('model', set_value('model', $contract['model'])); ?>
				<div class="clearfix"></div>
				<h4 class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<i class="fa fa-lg fa-building-o"></i>
					<span class="company"><?= get_phrase('company'); ?></span>
				</h4>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('cnaes'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?php $category_option[''] = 'Selecione'; ?>
						<?php foreach ($fcategory as $_category) $category_option[$_category['id_function_category']] = $_category['category']; ?>
						<?= form_dropdown('category', $category_option, set_value('id_function_category', $contract['id_function_category']), ['class' => 'form-control', 'id' => 'category']); ?>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('function_role'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?php $function_option[''] = 'Selecione'; ?>
						<?php foreach ($froles as $_role) $function_option[$_role['id']] = $_role['name']; ?>
						<?= form_dropdown('role', $function_option, set_value('id', $contract['id_function']), ['class' => 'form-control', 'id' => 'role']); ?>
					</div>
				</div>
				<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<?= form_label(get_phrase('data_start'), 'start-date', ['class' => 'control-label']); ?>
					<div class="">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							<?= form_input(['name' => 'start_date', 'id' => 'start-date', 'value' => date('d/m/Y', strtotime($contract['start_date'])), 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
						</div>
					</div>
				</div>
				<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<?= form_label(get_phrase('time_hour'), 'time-hour', ['class' => 'control-label']); ?>
					<div class="">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-money"></i></span>
							<?= form_input(['name' => 'time_hour', 'id' => 'time-hour', 'value' => set_value('time_hour', $contract['time_hour']), 'class' => 'form-control mask-money']); ?>
						</div>
					</div>
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