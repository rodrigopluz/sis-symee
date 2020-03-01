<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('Citys/create/', ['class' => 'form-content']); ?>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('countrys'), 'pais-id', ['class' => 'control-label']); ?>
				<div class="">
					<?php $country_option[''] = 'Selecione'; ?>
					<?php foreach ($country as $_country) $country_option[$_country['initial']] = $_country['name']; ?>
					<?= form_dropdown('initial', $country_option, set_value('initial'), ['class' => 'form-control', 'id' => 'pais-id']); ?>
					<?= form_error('initial'); ?>
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('state'), 'sigla', ['class' => 'control-label']); ?>
				<div class="">
					<?php $states_option[''] = 'Selecione'; ?>
					<?php foreach ($states as $_states) $states_option[$_states['sigla']] = $_states['name']; ?>
					<?= form_dropdown('sigla', $states_option, set_value('sigla'), ['class' => 'form-control', 'id' => 'sigla']); ?>
					<?= form_error('sigla'); ?>
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'name', 'id' => 'city', 'class' => 'form-control', 'value' => set_value('name')]); ?>
					<?= form_error('nome'); ?>
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('cod_municipio_ibge'), 'cod-municipio-ibge', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input(['name' => 'cod_municipio_ibge', 'id' => 'cod-municipio-ibge', 'class' => 'form-control', 'value' => set_value('cod_municipio_ibge')]); ?>
					<?= form_error('cod_municipio_ibge'); ?>
				</div>
			</div>
			<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label(get_phrase('present'), 'status', ['class' => 'control-label']); ?>
				<div class="">
					<?php $status_option = ['1' => 'Sim', '0' => 'Não']; ?>
					<?= form_dropdown('status', $status_option, $city['status'], ['id' => 'status', 'class' => 'form-control']); ?>
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