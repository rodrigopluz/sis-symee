<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('WorkPlaces/edit/'. $workplace['id'], ['class' => 'form-content']); ?>
			<div class="tab-content">
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('name'), 'name', ['class' => 'control-label']); ?>
					<?= form_input(['name' => 'name', 'id' => 'name', 'value' => set_value('name', $workplace['name']), 'class' => 'form-control', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('company'), 'id_company', ['class' => 'control-label']); ?>
					<?php $companies_option[''] = 'Selecione'; ?>
					<?php foreach ($company as $_companies) $companies_option[$_companies['id']] = $_companies['business_name']; ?>
					<?= form_dropdown('id_company', $companies_option, set_value('id_company', $workplace['id_company']), ['id' => 'id-company', 'class' => 'form-control', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
				</div>
				<div class="clearfix"><br/></div>
				<div class="">
					<?= form_hidden(['name' => 'id_address', 'id' => 'id-address', 'value' => $workplace['id_address']]); ?>
					<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
						<?= form_label(get_phrase('address'), 'place', ['class' => 'control-label']); ?>
						<?= form_input(['name' => 'place', 'id' => 'place', 'value' => $workplace['place_name'], 'readonly' => 'readonly', 'class' => 'form-control']); ?>
					</div>
					<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<?= form_label(get_phrase('number'), 'number', ['class' => 'control-label']); ?>
						<?= form_input(['name' => 'number', 'id' => 'number', 'value' => $workplace['number'], 'readonly' => 'readonly', 'class' => 'form-control']); ?>
					</div>
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-3">
						<?= form_label(get_phrase('neighborhood'), 'neighborhood', ['class' => 'control-label']); ?>
						<?= form_input(['name' => 'neighborhood', 'id' => 'neighborhood', 'value' => $workplace['neighborhood_name'], 'readonly' => 'readonly', 'class' => 'form-control']); ?>
					</div>
					<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
						<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
						<?= form_input(['name' => 'city', 'id' => 'city', 'value' => $workplace['city'], 'readonly' => 'readonly', 'class' => 'form-control']); ?>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<?= form_label(get_phrase('state'), 'state_name', ['class' => 'control-label']); ?>
						<?php $state_option[''] = 'Selecione'; ?>
						<?php foreach ($state as $_state) $state_option[$_state['sigla']] = $_state['name']; ?>
						<?= form_dropdown('state_name', $state_option, set_value('sigla', $workplace['sigla']), ['class' => 'form-control', 'id' => 'state', 'disabled' => true]); ?>
					</div>
					<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<?= form_label(get_phrase('countrys'), 'country_name', ['class' => 'control-label']); ?>
						<?php $country_option[''] = 'Selecione'; ?>
						<?php foreach ($country as $_country) $country_option[$_country['id']] = $_country['name']; ?>
						<?= form_dropdown('country_name', $country_option, set_value('id', $workplace['id_country']), ['class' => 'form-control', 'id' => 'country', 'disabled' => true]); ?>
					</div>
					<div class="clearfix"><br/></div>					
					<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?= form_label(get_phrase('google_maps'), '', ['class' => 'control-label']); ?>
						<div class="clearfix"></div>
						<?= form_hidden(['name' => 'address', 'id' => 'address', 'value' => $workplace['place_name'] .', '. $workplace['number'] .' - '. $workplace['neighborhood_name'] .', '. $workplace['city'] .' - '. $workplace['sigla'] .', '. addformat_zipcode($workplace['zipcode']) .', '. $workplace['initial']]); ?>
						<?= form_input(['name' => 'latitude', 'id' => 'latitude', 'value' => $workplace['latitude'], 'class' => 'form-control latitude', 'readonly' => true, 'style' => 'width:27em;float:left;margin-right:2em']); ?>
						<?= form_input(['name' => 'longitude', 'id' => 'longitude', 'value' => $workplace['longitude'], 'class' => 'form-control longitude', 'readonly' => true, 'style' => 'width:27em;']); ?>
					</div>
				</div>
				<div class="clearfix"><br/></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="mapa" style="height:20em;width:100%;float:left;margin:0 0 0.9em 0;"></div>
				</div>
				<div class="clearfix"><br/></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?= form_label(get_phrase('description'), '', ['class' => 'control-label']); ?>
					<?= form_textarea(['name' => 'information', 'id' => 'information', 'value' => $workplace['information'], 'class' => 'form-control wysihtml5', 'data-stylesheet-url' => base_url().'assets/css/wysihtml5-color.css']); ?>
				</div>
			</div>
			<div class="clearfix"><br/></div>
			<div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary" id="form-work"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>
<?= $js; ?>
<script>
$(document).ready(function() {
	loadOnMap($('#address').val());
});
</script>