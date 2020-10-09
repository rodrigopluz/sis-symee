<hr/>
<div class="row">
	<div class="col-md-12 icon-el">
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list_company" data-toggle="tab">
					<i class="fa fa-building-o"></i>
					<span><?= get_phrase('company'); ?></span>
                </a>
            </li>
            <li class="">
            	<a href="#list_address" data-toggle="tab">
                    <i class="fa fa-map-signs"></i> 
					<span><?= get_phrase('address'); ?></span>
                </a>
			</li>
			<li class="">
				<a href="#list_function" id="cnaes" data-toggle="tab">
					<i class="fa fa-briefcase"></i>
					<span><?= get_phrase('cnaes'); ?></span>
				</a>
			</li>
			<li class="">
				<a href="#list_photo" data-toggle="tab">
					<i class="fa fa-photo"></i>
					<?= get_phrase('logo'); ?>
				</a>
			</li>
		</ul>
		<?= form_open('Companys/edit/'. $company['id'], ['class' => 'form-content', 'enctype' => 'multipart/form-data']); ?>
			<div class="tab-content">
				<div class="tab-pane box active row" id="list_company">
					<div class="box-content">
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('business_name'), 'business-name', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'business_name', 'id' => 'business-name', 'class' => 'form-control', 'value' => set_value('business_name', $company['business_name'])]); ?>
								<?= form_error('business_name'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('fantasy_name'), 'fantasy-name', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'fantasy_name', 'id' => 'fantasy-name', 'class' => 'form-control', 'value' => set_value('fantasy_name', $company['fantasy_name'])]); ?>
								<?= form_error('fantasy_name'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('cnpj'), 'cnpj', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'cnpj', 'id' => 'cnpj', 'class' => 'form-control mask-cnpj', 'value' => set_value('cnpj', $company['cnpj'])]); ?>
								<?= form_error('cnpj'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('state_registration'), 'state-registration', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'state_registration', 'id' => 'state-registration', 'class' => 'form-control', 'value' => set_value('state_registration', $company['state_registration'])]); ?>
								<?= form_error('state_registration'); ?>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('phone'), 'phone', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'phone', 'id' => 'phone', 'class' => 'form-control mask-phone-cell', 'value' => set_value('phone', $company['phone'])]); ?>
								<?= form_error('phone'); ?>
							</div>
						</div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<div class="form-group">
								<?= form_label(get_phrase('whatsapp'), 'whatsapp', ['class' => 'control-label']); ?>
								<div class="">
									<?php if ($company['whatsapp'] == 'S') $checked_s = set_radio('whatsapp', 'S', TRUE); ?>
									<?php if ($company['whatsapp'] == 'N') $checked_n = set_radio('whatsapp', 'N', TRUE); ?>
									<div class="col-sm-6 radio radio-replace">
										<?= form_radio(['name' => 'whatsapp', 'type' => 'radio', 'id' => 'whats-s', 'value' => 'S', 'checked' => $checked_s]); ?>
										<?= form_label(get_phrase('whatsapp_s')); ?>
									</div>
									<div class="col-sm-6 radio radio-replace">
										<?= form_radio(['name' => 'whatsapp', 'type' => 'radio', 'id' => 'whats-n', 'value' => 'N', 'checked' => $checked_n]); ?>
										<?= form_label(get_phrase('whatsapp_n')); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('fax'), 'fax', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'fax', 'id' => 'fax', 'class' => 'form-control mask-phone', 'value' => set_value('fax', $company['fax'])]); ?>
								<?= form_error('fax'); ?>
							</div>
						</div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<?= form_label(get_phrase('plan'), 'type', ['class' => 'control-label']); ?>
							<div class="">
								<?php if ($this->session->userdata('profile_id') < 1) { ?>
									<?php $type_option[''] = 'Selecione'; ?>
									<?php foreach ($plans as $_type) $type_option[$_type['type']] = $_type['plan_name']; ?>
									<?= form_dropdown('type', $type_option, set_value('id_plan', $company['id_plan']), ['id' => 'type', 'class' => 'form-control']); ?>
								<?php } else { ?>
									<?= form_input(['id' => 'type', 'value' => $company['plan_name'], 'class' => 'form-control', 'readonly' => 'readonly']) ?>
									<?= form_hidden('type', set_value('id_plan', $company['id_plan'])); ?>
								<?php } ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('site'), 'site', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'site', 'id' => 'site', 'class' => 'form-control', 'value' => set_value('site', $company['site'])]); ?>
								<?= form_error('site'); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('email'), 'email', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'email', 'id' => 'email', 'class' => 'form-control', 'value' => set_value('email', $company['email'])]); ?>
								<?= form_error('email'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane box row" id="list_address">
					<div class="box-content">
						<div class="col-md-12">
							<div class="alert alert-default">
								<p><?= get_phrase('info_address'); ?></p>
							</div>
						</div>
						<?= form_hidden('id_address', set_value('id_address', $company['id_address'])); ?>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('zipcode'), 'zipcode', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control mask-cep', 'value' => set_value('zipcode', $company['zipcode'])]); ?>
								<?= form_error('zipcode'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<?= form_hidden('id_place', set_value('id_place', $company['id_place'])); ?>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('address'), 'place', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'place', 'id' => 'place', 'class' => 'form-control', 'value' => set_value('place', $company['place_name'])]); ?>
								<?= form_error('place'); ?>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('number'), 'number', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'number', 'id' => 'number', 'class' => 'form-control', 'value' => set_value('number', $company['number'])]); ?>
								<?= form_error('number'); ?>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('complement'), 'complement', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'complement', 'id' => 'complement', 'class' => 'form-control', 'value' => set_value('complement', $company['complement'])]); ?>
								<?= form_error('complement'); ?>
							</div>
						</div>
						<?= form_hidden('id_neighborhood', set_value('id_neighborhood', $company['id_neighborhood'])); ?>
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-3">
							<?= form_label(get_phrase('neighborhood'), 'neighborhood', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'neighborhood', 'id' => 'neighborhood', 'class' => 'form-control', 'value' => set_value('neighborhood', $company['neighborhood_name'])]); ?>
								<?= form_error('neighborhood'); ?>
							</div>
						</div>
						<?= form_hidden('id_city', set_value('id_city', $company['id_city'])); ?>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control', 'value' => set_value('city', $company['city'])]); ?>
								<?= form_error('nome'); ?>
							</div>
						</div>
						<?= form_hidden('sigla', set_value('sigla', $company['sigla'])); ?>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<?= form_label(get_phrase('state'), 'state', ['class' => 'control-label']); ?>
							<div class="">
								<?php foreach ($state as $_state) $state_option[$_state['sigla']] = $_state['name']; ?>
								<?= form_dropdown('state_name', $state_option, set_value('sigla', $company['sigla']), ['class' => 'form-control', 'id' => 'state']); ?>
								<?= form_error('state_name'); ?>
							</div>
						</div>
						<?= form_hidden('id_country', set_value('id_country', $company['id_country'])); ?>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('countrys'), 'country', ['class' => 'control-label']); ?>
							<div class="">
								<?php foreach ($country as $_country) $country_option[$_country['id']] = $_country['name']; ?>
								<?= form_dropdown('country_name', $country_option, set_value('id', $company['id_country']), ['class' => 'form-control', 'id' => 'country']); ?>
								<?= form_error('country_name'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane box" id="list_function">
					<div class="box-content row">
						<div class="col-md-12">
							<div class="alert alert-default">
								<p><?= get_phrase('info_cnaes'); ?></p>
							</div>
						</div>
						<div class="form-group col-lg-11 col-md-11 col-sm-11 col-xs-11">
							<div class="">
								<?= form_input(['name' => 'search_category', 'id' => 'search-category', 'class' => 'form-control', 'placeholder' => 'Busca inteligente', 'value' => '']); ?>
							</div>
						</div>
						<div class="row not-padding text-left form-group col-lg-1 col-md-1 col-sm-1 col-xs-1">
							<a class="btn btn-primary disabled btn-activity not-active">
								<i class="fa fa-search"></i>
								<?= get_phrase('add'); ?>
							</a>
						</div>
						<?= form_hidden('id_company', set_value('id_company', $company['id'])); ?>
						<?= form_hidden('id_category', set_value('id_category','')); ?>
						<?= form_hidden('category', set_value('category', '')); ?>
					</div>
					<div class="clearfix"></div>
					<?php if ($activity): ?>
						<table class="activity_company table table table-striped table-hover" id="table_export">
							<thead>
								<tr>
									<th>#</th>
									<th><?= get_phrase('activity'); ?></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($activity as $row): ?>
									<tr>
										<td><?= $row['id_function_category']; ?></td>
										<td><?= $row['category']; ?></td>
										<td class="text-right">
											<a class="ajax-<?= $row['id_function_category'] ?>-active">
												<?php if ($row['type'] == 'N') { ?><i class="fa fa-square-o fa-lg"></i><?php } ?>
												<?php if ($row['type'] == 'P') { ?><i class="fa fa-check-square-o fa-lg"></i><?php } ?>
											</a>
											<script type="text/javascript">
												$(document).ready(function() {
													//* ajax-active-entail
													$('.ajax-<?= $row['id_function_category'] ?>-active').on('click', function() {
														$.ajax({
															method: 'post',
															dataType: 'json',
															url: baseurl + 'admin/empresas/ajax-active',
															data: { id_category: '<?= $row['id_function_category'] ?>', id_company: '<?= $company['id'] ?>' },
															success: function(data) {
																if (data.status == 'ok') {
																	alert('Ramo de atividade, definido como primario.');
																	location.reload();
																}
															}
														});
													});
												});
											</script>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
				<div class="tab-pane box" id="list_photo">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<?= form_label(get_phrase('logo'), '', ['class' => 'control-label']); ?>
                        <div class="">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
									<?php if ($company['image'] == null) { ?>
										<?= img(['src' => image(base_url().'uploads/no_photo.png', null), 'width' => '135', 'alt' => '...']); ?>
									<?php } else { ?>
										<?= img(['src' => image(base_url().'uploads/admin_logo/'. $company['image'], null), 'width' => '135', 'alt' => '...']); ?>
									<?php } ?>
								</div>
								<div class="form-group">
									<?= form_input(['name' => 'file', 'id' => 'file', 'class' => 'form-control file2 inline btn btn-primary', 'data-label' => "<i class='glyphicon glyphicon-file'></i> ". get_phrase('select_image'), 'accept' => 'image/*', 'type' => 'file']); ?>
								</div>
							</div>
							<?= form_hidden('avatar', set_value('avatar', $company['image'])); ?>
                        </div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="nopadding text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>