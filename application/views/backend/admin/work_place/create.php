<hr/>
<div class="row">
	<div class="col-md-12 icon-el">
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list_workplace" data-toggle="tab">
					<i class="fa fa-map-signs"></i>
					<span><?= get_phrase('work_places'); ?></span>
                </a>
            </li>
            <li class="">
            	<a href="#list_workday" data-toggle="tab">
                    <i class="fa fa-calendar-check-o"></i> 
					<span><?= get_phrase('work_days'); ?></span>
                </a>
			</li>
		</ul>
		<?= form_open('WorkPlaces/create/', ['id' => 'form-validate', 'class' => 'form-content form-groups-bordered validate']); ?>
			<div class="tab-content">
				<div class="tab-pane box active row" id="list_workplace">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<?= form_label(get_phrase('name'), 'name', ['class' => 'control-label']); ?>
						<?= form_input(['name' => 'name', 'id' => 'name', 'value' => '', 'class' => 'form-control', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<?= form_label(get_phrase('company'), 'id_company', ['class' => 'control-label']); ?>
						<?php $companies_option[''] = 'Selecione'; ?>
						<?php foreach ($company as $_companies) $companies_option[$_companies['id']] = $_companies['business_name']; ?>
						<?= form_dropdown('id_company', $companies_option, set_value('id_company'), ['id' => 'id-company', 'class' => 'form-control', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
					</div>
					<div class="clearfix"><br/></div>
					<div id="radio-info" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<?= form_label(get_phrase('work_place_info'), 'work_place_info', ['class' => 'control-label']); ?>
						<div class="col-sm-2 radio radio-replace" id="s-address">
							<?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 's', 'value' => 'S', 'class' => 'type_sim radio']); ?>
							<?= form_label('Sim'); ?>
						</div>
						<div class="col-sm-2 radio radio-replace" id="n-address">
							<?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 'n', 'value' => 'N', 'class' => 'type_nao radio']); ?>
							<?= form_label('Não'); ?>
						</div>
						<div class="clearfix"><br/></div>
						<div class="work-place"></div>
					</div>
					<div class="clearfix"><br/></div>
					<?= form_hidden('latitude', null); ?>
					<?= form_hidden('longitude', null); ?>
					<div class="yes-address">
						<?= form_hidden('id_address', null); ?>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('address'), 'place', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's-map-place', 'id' => 's-map-place', 'class' => 'form-control', 'value' => '']); ?>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('number'), 'number', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's-map-number', 'id' => 's-map-number', 'class' => 'form-control', 'value' => '']); ?>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('complement'), 'complement', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's-map-complement', 'id' => 's-map-complement', 'class' => 'form-control', 'value' => '']); ?>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-3">
							<?= form_label(get_phrase('neighborhood'), 'neighborhood', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's-map-neighborhood', 'id' => 's-map-neighborhood', 'class' => 'form-control', 'value' => '']); ?>
						</div>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's-map-city', 'id' => 's-map-city', 'class' => 'form-control', 'value' => '']); ?>
						</div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<?= form_label(get_phrase('state'), 'state_name', ['class' => 'control-label']); ?>
							<?php $state_option[''] = 'Selecione'; ?>
							<?php foreach ($state as $_state) $state_option[$_state['sigla']] = $_state['name']; ?>
							<?= form_dropdown('state_name', $state_option, set_value('sigla'), ['class' => 'form-control', 'id' => 's-map-state']); ?>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('countrys'), 'country_name', ['class' => 'control-label']); ?>
							<?php $country_option[''] = 'Selecione'; ?>
							<?php foreach ($country as $_country) $country_option[$_country['id']] = $_country['name']; ?>
							<?= form_dropdown('country_name', $country_option, set_value('id'), ['class' => 'form-control', 'id' => 's-map-country']); ?>
						</div>
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<?= form_label(get_phrase('google_maps'), '', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 's_map_latitude', 'id' => 's-map-latitude', 'class' => 'form-control latitude', 'readonly' => true, 'style' => 'width:27em;float:left;margin-right:2em']); ?>
							<?= form_input(['name' => 's_map_longitude', 'id' => 's-map-longitude', 'class' => 'form-control longitude', 'readonly' => true, 'style' => 'width:27em;']); ?>
						</div>
					</div>
					<div class="no-address">
						<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="alert alert-default">
								<p><?= get_phrase('info_convocation'); ?></p>
							</div>
							<?= form_label(get_phrase('address'), '', ['class' => 'control-label']); ?>
							<div class="clearfix"></div>
							<div class="form-group p-0 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?= form_input(['name' => 'address', 'id' => 'address', 'class' => 'form-control', 'value' => '', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
							</div>
							<div class="clearfix"></div>
							<?= form_label(get_phrase('google_maps'), '', ['class' => 'control-label']); ?>
							<?= form_input(['name' => 'n_map_latitude', 'id' => 'n-map-latitude', 'class' => 'form-control latitude', 'readonly' => true, 'style' => 'width:27em;float:left;margin-right:2em']); ?>
							<?= form_input(['name' => 'n_map_longitude', 'id' => 'n-map-longitude', 'class' => 'form-control longitude', 'readonly' => true, 'style' => 'width:27em;']); ?>
							
							<?= form_hidden('n_map_place', null); ?>
							<?= form_hidden('n_map_number', null); ?>
							<?= form_hidden('n_map_neighborhood', null); ?>
							<?= form_hidden('n_map_city', null); ?>
							<?= form_hidden('n_map_state', null); ?>
							<?= form_hidden('n_map_zipcode', null); ?>
							<?= form_hidden('n_map_country', null); ?>
						</div>
					</div>
					<div class="clearfix"><br/></div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="mapa" style="height:20em;width:100%;float:left;margin:0 0 0.9em 0;"></div>
					</div>
					<div class="clearfix"><br/></div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<?= form_label(get_phrase('description'), '', ['class' => 'control-label']); ?>
						<?= form_textarea(['name' => 'information', 'id' => 'information', 'class' => 'form-control wysihtml5', 'data-stylesheet-url' => base_url().'assets/css/wysihtml5-color.css']); ?>
					</div>
				</div>
				<div class="tab-pane box row" id="list_workday">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 min-height">
						<label class="control-label" for="reservation"><?= get_phrase('info_work_day'); ?></label>
						<?= form_hidden('reservation', null); ?>
						<div class="daterangepicker-container" id="reservation"></div>
					</div>
					<div class="clearfix"><br/></div>
					<div id="div-work-day" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<p class="center-text">TODOS OS DIAS</p>
						<table class="table table-striped table-hover" id="table-work-day">
							<thead>
								<tr>
									<th>Dia da Semana</th>
									<th>Data</th>
									<th>Horário inicial</th>
									<th>Horário final</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="tbody"></tbody>
						</table>
					</div>	
				</div>
			</div>
			<div class="clearfix"><br/></div>
			<div class="text-right left col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary" id="form-work"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>
<?= $js; ?>
