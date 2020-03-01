<hr/>
<div class="row">
	<div class="col-md-12 icon-el">
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#list_person" data-toggle="tab">
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
            	<a href="#list_employee" data-toggle="tab">
					<i class="fa fa-lock"></i>
					<span><?= get_phrase('login'); ?></span>
                </a>
			</li>
			<li class="">
				<a href="#list_photo" data-toggle="tab">
					<i class="fa fa-photo"></i>
					<?= get_phrase('photo'); ?>
				</a>
			</li>
		</ul>
		<?= form_open('Employees/create/', ['class' => 'form-content', 'enctype' => 'multipart/form-data']); ?>
			<div class="tab-content">
				<div class="tab-pane box active row" id="list_person">
					<div class="box-content">
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('name'), 'person-name', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'person_name', 'id' => 'person-name', 'class' => 'form-control', 'value' => '']); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('email'), 'email', ['class' => 'control-label']); ?>
							<div class="">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-send"></i></span>
									<?= form_input(['name' => 'email', 'id' => 'email', 'value' => '', 'class' => 'form-control', 'type' => 'email']); ?>
									<?= form_error('email'); ?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('nationality'), 'nationality', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'nationality', 'id' => 'nationality', 'class' => 'form-control', 'value' => '']); ?>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <?= form_label(get_phrase('data_nasc'), 'data-nasc', ['class' => 'control-label']); ?>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                <?= form_input(['name' => 'data_nasc', 'id' => 'data-nasc', 'value' => '', 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
                            </div>
                        </div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('phone'), 'phone', ['class' => 'control-label']); ?>
							<div class="">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone"></i></span>
									<?= form_input(['name' => 'phone', 'id' => 'phone', 'value' => '', 'class' => 'form-control mask-phone-cell', 'type' => 'tel']); ?>
								</div>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <?= form_label(get_phrase('sexo'), 'sexo', ['class' => 'col-lg-12 row control-label label-sexo']); ?>
							<div class="col-sm-6 radio radio-replace">
								<?= form_radio(['name' => 'sexo', 'type' => 'radio', 'id' => 'male', 'value' => 'M']) ?>
								<?= form_label('Masculino'); ?>
							</div>
							<div class="col-sm-6 radio radio-replace">
								<?= form_radio(['name' => 'sexo', 'type' => 'radio', 'id' => 'female', 'value' => 'F']) ?>
								<?= form_label('Feminino'); ?>
                            </div>
                        </div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label(get_phrase('profile'), 'profile', ['class' => 'control-label']); ?>
							<div class="">
								<?php foreach ($profile as $_profiles) $profiles_option[$_profiles['id']] = $_profiles['name']; ?>
								<?= form_dropdown('id_profile', $profiles_option, $employee['id_profile'], ['id' => 'id_profile', 'class' => 'form-control']); ?>
							</div>
						</div>
						<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
							<div class="">
								<?php $status_option = ['1' => 'Ativo', '0' => 'Inativo']; ?>
								<?= form_dropdown('status', $status_option, set_value('status'), ['class' => 'form-control', 'id' => 'status']); ?>
							</div>
						</div>
						<?= form_input(['type' => 'hidden', 'name' => 'type_pf', 'id' => 'type-pf', 'value' => 'F']); ?>
					</div>
				</div>
				<div class="tab-pane box row" id="list_address">
					<div class="box-content">
						<div class="col-md-12">
							<div class="alert alert-default">
								<p><?= get_phrase('info_address'); ?></p>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('zipcode'), 'zipcode', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'zipcode', 'id' => 'zipcode', 'class' => 'form-control mask-cep', 'value' => '']); ?>
								<?= form_error('zipcode'); ?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('address'), 'place', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'place', 'id' => 'place', 'class' => 'form-control', 'value' => '']); ?>
								<?= form_error('place'); ?>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('number'), 'number', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'number', 'id' => 'number', 'class' => 'form-control', 'value' => '']); ?>
								<?= form_error('number'); ?>
							</div>
						</div>
						<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
							<?= form_label(get_phrase('complement'), 'complement', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'complement', 'id' => 'complement', 'class' => 'form-control', 'value' => '']); ?>
								<?= form_error('complement'); ?>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-3">
							<?= form_label(get_phrase('neighborhood'), 'neighborhood', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'neighborhood', 'id' => 'neighborhood', 'class' => 'form-control', 'value' => '']); ?>
								<?= form_error('neighborhood'); ?>
							</div>
						</div>
						<div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-5">
							<?= form_label(get_phrase('city'), 'city', ['class' => 'control-label']); ?>
							<div class="">
								<?= form_input(['name' => 'city', 'id' => 'city', 'class' => 'form-control', 'value' => '']); ?>
								<?= form_error('city'); ?>
							</div>
						</div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<?= form_label(get_phrase('state'), 'state', ['class' => 'control-label']); ?>
							<div class="">
								<?php $state_option[''] = 'Selecione'; ?>
								<?php foreach ($state as $_state) $state_option[$_state['sigla']] = $_state['name']; ?>
								<?= form_dropdown('state_name', $state_option, set_value('sigla'), ['class' => 'form-control', 'id' => 'state']); ?>
								<?= form_error('state_name'); ?>
							</div>
						</div>
						<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<?= form_label(get_phrase('countrys'), 'country_name', ['class' => 'control-label']); ?>
							<div class="">
								<?php $country_option[''] = 'Selecione'; ?>
								<?php foreach ($country as $_country) $country_option[$_country['id']] = $_country['name']; ?>
								<?= form_dropdown('country_name', $country_option, set_value('id'), ['class' => 'form-control', 'id' => 'country']); ?>
								<?= form_error('country_name'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane box row" id="list_employee">
					<div class="box-content">
						<div class="col-md-12">
							<div class="alert alert-default">
								<p><?= get_phrase('login_cpf'); ?></p>
							</div>
						</div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <?= form_label(get_phrase('login'), 'cpf-cnpj', ['class' => 'control-label']); ?>
                            <div class="">
                                <?= form_input(['name' => 'cpf_cnpj', 'id' => 'cpf-cnpj', 'value' => '', 'class' => 'form-control', 'data-mask' => 'cpf']); ?>
                            </div>
                        </div>
						<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <?= form_label(get_phrase('password'), '', ['class' => 'control-label']); ?>
                            <div class="">
                                <?= form_input(['name' => 'password', 'id' => 'password', 'class' => 'form-control']); ?>
                            </div>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <?= form_label(get_phrase('confirm_password'), '', ['class' => 'control-label']); ?>
                            <div class="">
                                <?= form_input(['name' => 'confirm_password', 'id' => 'confirm-password', 'class' => 'form-control']); ?>
                            </div>
                        </div>
					</div>
				</div>
				<div class="tab-pane box" id="list_photo">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<?= form_label(get_phrase('photo'), '', ['class' => 'control-label']); ?>
						<div class="">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
									<?= img(['src' => image(base_url().'uploads/user.jpg', null), 'width' => '135', 'alt' => '...']); ?>
								</div>
								<div class="form-group">
									<?= form_input(['name' => 'file', 'id' => 'file', 'class' => 'form-control file2 inline btn btn-primary', 'data-label' => "<i class='glyphicon glyphicon-file'></i> ". get_phrase('select_image'), 'accept' => 'image/*', 'type' => 'file']); ?>
								</div>
							</div>
							<?= form_hidden('avatar', null); ?>
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