<hr />
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs bordered">
            <?php if ($this->session->userdata('reset') == 0): ?>
                <li class="active">
                    <a href="#list_user" data-toggle="tab">
                        <i class="entypo-user"></i> 
                        <?= get_phrase('manage_profile'); ?>
                    </a>
                </li>
            <?php endif; ?>
            <li class="<?php if ($this->session->userdata('reset') == 1) { ?> active <?php } ?>">
            	<a href="#list_pass" data-toggle="tab">
                    <i class="entypo-lock"></i> 
					<?= get_phrase('change_password'); ?>
                </a>
            </li>
		</ul>
		<div class="tab-content">
            <?php if ($this->session->userdata('reset') == 0): ?>
                <div class="tab-pane box active" id="list_user" style="padding: 5px">
                    <div class="box-content">
                        <?= form_open(base_url() .'ManageProfile/manage_profile/update_profile_info', ['class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data']); ?>
                            <div class="form-group">
                                <?= form_label(get_phrase('name'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?= form_input(['name' => 'name', 'id' => 'name', 'value' => $row['name'], 'class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('email'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="entypo-mail"></i></span>
                                        <?= form_input(['name' => 'email', 'id' => 'email', 'value' => $row['email'], 'class' => 'form-control', 'type' => 'email']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('nationality'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?= form_input(['name' => 'nationality', 'id' => 'nationality', 'value' => $row['nationality'], 'class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('data_nasc'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5 input-group">
                                    <span class="input-group-addon"><i class="entypo-calendar"></i></span>
                                    <?= form_input(['name' => 'data_nasc', 'id' => 'data-nasc', 'value' => date('d/m/Y', strtotime($row['data_nasc'])), 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('sexo'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?php if ($row['sexo'] == 'M') $checked_m = set_radio('sexo', 'M', TRUE); ?>
                                    <?php if ($row['sexo'] == 'F') $checked_f = set_radio('sexo', 'F', TRUE); ?>
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
                            <div class="form-group">
                                <?= form_label(get_phrase('phone'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="entypo-mobile"></i></span>
                                        <?= form_input(['name' => 'phone', 'id' => 'phone', 'value' => $row['phone'], 'class' => 'form-control mask-phone-cell',  'type' => 'tel']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('type'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?php if ($row['type'] == 'F') $checked_pf = set_radio('type', 'F', TRUE); ?>
                                    <?php if ($row['type'] == 'J') $checked_pj = set_radio('type', 'J', TRUE); ?>
                                    <div class="col-sm-4 radio radio-replace">
                                        <?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 'pf', 'value' => 'F', 'class' => 'type_fj', 'checked' => $checked_pf]) ?>
                                        <?= form_label('Pessoa Fisica'); ?>
                                    </div>
                                    <div class="col-sm-4 radio radio-replace">
                                        <?= form_radio(['name' => 'type', 'type' => 'radio', 'id' => 'pj', 'value' => 'J', 'class' => 'type_fj', 'checked' => $checked_pj]) ?>
                                        <?= form_label('Pessoa Juridica'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('cpf_cnpj'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?php if ($row['type'] == 'F') $mask = 'cpf'; ?>
                                    <?php if ($row['type'] == 'J') $mask = 'cnpj'; ?>
                                    <?= form_input(['name' => 'cpf_cnpj', 'id' => 'cpf-cnpj', 'value' => $row['cpf_cnpj'], 'class' => 'form-control', 'data-mask' => $mask]); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('status'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?= form_dropdown('status',['0' => 'Inativo', '1' => 'Ativo'], $row['status'], ['id' => 'status', 'class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= form_label(get_phrase('photo'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
                                            <?php if ($row['sexo'] == 'M' && $row['avatar'] !== null) { ?>
                                                <?= img(['src' => image(base_url().'uploads/admin_image/'. $row['avatar'], null), 'width' => '135', 'alt' => 'M']); ?>
                                            <?php } ?>
                                            
                                            <?php if ($row['sexo'] == 'F' && $row['avatar'] !== null) { ?>
                                                <?= img(['src' => image(base_url().'uploads/admin_image/'. $row['avatar'], null), 'width' => '135', 'alt' => 'F']); ?>
                                            <?php } ?>
                                            
                                            <?php if ($row['avatar'] == null) { ?>
                                                <?= img(['src' => image(base_url().'uploads/user.jpg', null), 'width' => '135', 'alt' => '...']); ?>
                                            <?php } ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new"><?= get_phrase('select_image'); ?></span>
                                                <span class="fileinput-exists"><?= get_phrase('change'); ?></span>
                                                <?= form_input(['name' => 'userfile', 'id' => 'user-file', 'class' => 'file-2', 'accept' => 'image/*', 'type' => 'file']); ?>
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?= get_phrase('remove'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <?= form_button_submit(null, get_phrase('update_profile'), 'class="btn btn-info"'); ?>
                                </div>
                            </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="tab-pane box <?php if ($this->session->userdata('reset') == 1) { ?> active <?php } ?>" id="list_pass" style="padding: 5px">
                <div class="box-content padded">
                    <?= form_open(base_url() .'ManageProfile/manage_profile/change_password', ['class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top']); ?>
                        <div class="form-group">
                            <?= form_label(get_phrase('current_password'), '', ['class' => 'col-sm-3 control-label']); ?>
                            <div class="col-sm-5">
                                <?= form_input(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'type' => 'password', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= form_label(get_phrase('new_password'), '', ['class' => 'col-sm-3 control-label']); ?>
                            <div class="col-sm-5">
                                <?= form_input(['name' => 'new_password', 'id' => 'new-password', 'class' => 'form-control', 'type' => 'password', 'onkeypress' => 'validPasswordForce()', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
                                <div id="erroSenhaForca"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= form_label(get_phrase('confirm_new_password'), '', ['class' => 'col-sm-3 control-label']); ?>
                            <div class="col-sm-5">
                                <?= form_input(['name' => 'confirm_new_password', 'id' => 'confirm-new-password', 'class' => 'form-control', 'type' => 'password', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required')]); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <?= form_button_submit(null, get_phrase('save'), 'class="btn btn-info"'); ?>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
			</div>
		</div>
	</div>
</div>
<?= $js ?>
