<hr/>
<div class="row">
	<div class="col-md-12 icon-el">
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list_user" data-toggle="tab">
					<i class="fa fa-user"></i>
					<span><?= get_phrase('user'); ?></span>
                </a>
            </li>
			<li class="">
				<a href="#list_address" data-toggle="tab">
					<i class="fa fa-map-signs"></i>
					<span><?= get_phrase('address'); ?></span>
				</a>
			</li>
            <li class="">
				<a href="#list_pass" data-toggle="tab">
                    <i class="fa fa-lock"></i> 
					<?= get_phrase('change_password'); ?>
                </a>
            </li>
			<li class="">
				<a href="#list_photo" data-toggle="tab">
					<i class="fa fa-photo"></i>
					<?= get_phrase('photo'); ?>
				</a>
			</li>
		</ul>
	</div>
	<?= form_open('UserCompanys/edit/' . $user_company['id_person'], ['class' => 'form-content', 'enctype' => 'multipart/form-data']); ?>
		<div class="tab-content">
			<div class="tab-pane box active" id="list_user">
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('name'), 'name', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'name', 'id' => 'name', 'value' => $user_company['name'], 'class' => 'form-control']); ?>
						<?= form_error('name'); ?>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('email'), 'email', ['class' => 'control-label']); ?>
					<div class="">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-send"></i></span>
							<?= form_input(['name' => 'email', 'id' => 'email', 'value' => $user_company['email'], 'class' => 'form-control', 'type' => 'email']); ?>
							<?= form_error('email'); ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('company'), 'id_company', ['class' => 'control-label']); ?>
					<div class="">
						<?php if ($user_company['id_profile'] != 1): ?>
							<?php foreach ($company as $_companies) $companies_option[$_companies['id']] = $_companies['business_name']; ?>
							<?= form_dropdown('id_company', $companies_option, set_value('id_company', $user_company['id_company']), 'class="form-control" required'); ?>
							<?= form_error('id_company'); ?>
						<?php else: ?>
							<?= form_input(['id' => 'id-compay', 'value' => 'Symee Sistema Web', 'class' => 'form-control', 'readonly' => true]); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('profile'), 'id_profile', ['class' => 'control-label']); ?>
					<div class="">
						<?php foreach ($profile as $_profiles) $profiles_option[$_profiles['id']] = $_profiles['name']; ?>
						<?= form_dropdown('id_profile', $profiles_option, set_value('id_profile', $user_company['id_profile']), ['id' => 'id_profile', 'disabled' => true, 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('data_nasc'), '', ['class' => 'control-label']); ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						<?= form_input(['name' => 'data_nasc', 'id' => 'data-nasc', 'value' => date('d/m/Y', strtotime($user_company['data_nasc'])), 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('phone'), '', ['class' => 'control-label']); ?>
					<div class="">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<?= form_input(['name' => 'phone', 'id' => 'phone', 'value' => $user_company['phone'], 'class' => 'form-control mask-phone-cell', 'type' => 'tel']); ?>
						</div>
					</div>
				</div>
				<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<?= form_label(get_phrase('sexo'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?php if ($user_company['sexo'] == 'M') $checked_m = set_radio('sexo', 'M', TRUE); ?>
						<?php if ($user_company['sexo'] == 'F') $checked_f = set_radio('sexo', 'F', TRUE); ?>
						<div class="col-sm-3 radio radio-replace">
							<?= form_radio(['name' => 'sexo', 'type' => 'radio', 'id' => 'male', 'value' => 'M', 'checked' => $checked_m]) ?>
							<?= form_label('Masculino'); ?>
						</div>
						<div class="col-sm-3 radio radio-replace">
							<?= form_radio(['name' => 'sexo', 'type' => 'radio', 'id' => 'female', 'value' => 'F', 'checked' => $checked_f]) ?>
							<?= form_label('Feminino'); ?>
						</div>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('nationality'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'nationality', 'id' => 'nationality', 'value' => $user_company['nationality'], 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
					<div class="">
						<?php $status_option = ['1' => 'Ativo', '0' => 'Inativo']; ?>
						<?= form_dropdown('status', $status_option, $user_company['status'], ['id' => 'status', 'class' => 'form-control']); ?>
					</div>
				</div>
				<?= form_hidden('id_profile', set_value('id_profile', $user_company['id_profile'])); ?>
				<?= form_hidden('id_person', set_value('id_person', $user_company['id_person'])); ?>
				<?= form_hidden('type_pf', set_value('type_pf', $user_company['type'])); ?>
			</div>
			<div class="tab-pane box" id="list_address">
				<div class="box-content">
					<div class="col-md-12">
						<div class="alert alert-default">
							<p><?= get_phrase('info_address'); ?></p>
						</div>
					</div>
					<?= form_hidden('id_address', set_value('id_address', $user_company['id_address'])); ?>
					<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<?= form_label(get_phrase('zipcode'), 'zipcode', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control mask-cep', 'value' => set_value('zipcode', $user_company['zipcode'])]); ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<?= form_hidden('id_place', set_value('id_place', $user_company['id_place'])); ?>
					<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
						<?= form_label(get_phrase('address'), 'place', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'place', 'id' => 'place', 'class' => 'form-control', 'value' => set_value('place', $user_company['place_name'])]); ?>
						</div>
					</div>
					<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<?= form_label(get_phrase('number'), 'number', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'number', 'id' => 'number', 'class' => 'form-control', 'value' => set_value('number', $user_company['number'])]); ?>
						</div>
					</div>
					<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<?= form_label(get_phrase('complement'), 'complement', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'complement', 'id' => 'complement', 'class' => 'form-control', 'value' => set_value('complement', $user_company['complement'])]); ?>
						</div>
					</div>
					<?= form_hidden('id_neighborhood', set_value('id_neighborhood', $user_company['id_neighborhood'])); ?>
					<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-3">
						<?= form_label(get_phrase('neighborhood'), 'neighborhood', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'neighborhood', 'id' => 'neighborhood', 'class' => 'form-control', 'value' => set_value('neighborhood', $user_company['neighborhood_name'])]); ?>
						</div>
					</div>
					<?= form_hidden('id_city', set_value('id_city', $user_company['id_city'])); ?>
					<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
						<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
						<div class="">
							<?= form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control', 'value' => set_value('city', $user_company['city'])]); ?>
						</div>
					</div>
					<?= form_hidden('sigla', set_value('sigla', $user_company['sigla'])); ?>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<?= form_label(get_phrase('state'), 'state', ['class' => 'control-label']); ?>
						<div class="">
							<?php foreach ($state as $_state) $state_option[$_state['sigla']] = $_state['name']; ?>
							<?= form_dropdown('state_name', $state_option, set_value('sigla', $user_company['sigla']), ['class' => 'form-control', 'id' => 'state']); ?>
						</div>
					</div>
					<?= form_hidden('id_country', set_value('id_country', $user_company['id_country'])); ?>
					<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
						<?= form_label(get_phrase('countrys'), 'country', ['class' => 'control-label']); ?>
						<div class="">
							<?php foreach ($country as $_country) $country_option[$_country['id']] = $_country['name']; ?>
							<?= form_dropdown('country_name', $country_option, set_value('id', $user_company['id_country']), ['class' => 'form-control', 'id' => 'country']); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane box" id="list_pass">
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('login'), 'login', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'login', 'id' => 'login', 'value' => $user_company['login'], 'class' => 'form-control']); ?>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('current_password'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'password', 'id' => 'password', 'value' => $user_company['password'], 'class' => 'form-control', 'type' => 'password']); ?>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('new_password'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'new_password', 'id' => 'new-password', 'class' => 'form-control', 'type' => 'password']); ?>
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('confirm_new_password'), '', ['class' => 'control-label']); ?>
					<div class="">
						<?= form_input(['name' => 'confirm_new_password', 'id' => 'confirm-new-password', 'class' => 'form-control', 'type' => 'password']); ?>
					</div>
				</div>
			</div>
			<div class="tab-pane box" id="list_photo">
				<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<?= form_label(get_phrase('photo'), '', ['class' => 'control-label']); ?>
					<div class="">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
								<?php if ($user_company['sexo'] == 'M' && $user_company['avatar'] !== null) { ?>
									<?= img(['src' => image(base_url().'uploads/admin_image/'. $user_company['avatar'], null), 'width' => '135', 'alt' => 'M']); ?>
								<?php } ?>
								
								<?php if ($user_company['sexo'] == 'F' && $user_company['avatar'] !== null) { ?>
									<?= img(['src' => image(base_url().'uploads/admin_image/'. $user_company['avatar'], null), 'width' => '135', 'alt' => 'F']); ?>
								<?php } ?>
								
								<?php if ($user_company['avatar'] == null) { ?>
									<?= img(['src' => image(base_url().'uploads/user.jpg', null), 'width' => '135', 'alt' => '...']); ?>
								<?php } ?>
							</div>
							<div class="form-group">
								<?= form_input(['name' => 'file', 'id' => 'file', 'class' => 'form-control file2 inline btn btn-primary', 'data-label' => "<i class='glyphicon glyphicon-file'></i> ". get_phrase('select_image'), 'accept' => 'image/*', 'type' => 'file']); ?>
							</div>
						</div>
						<?= form_hidden('avatar', set_value('avatar', $user_company['avatar'])); ?>
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
