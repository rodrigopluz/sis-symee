<hr />
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <?= get_phrase('system_settings'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?= form_open(base_url() .'SystemSettings/system_settings/do_update', ['target' => '_top', 'class' => 'form-horizontal form-groups-bordered validate']); ?>
                    <div class="form-group">
                        <?= form_label(get_phrase('system_name'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <?= form_input(['name' => 'system_name', 'id' => 'system-name', 'class' => 'form-control', 'value' => $this->db->get_where('settings', ['type' => 'system_name'])->row()->description]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('system_title'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <?= form_input(['name' => 'system_title', 'id' => 'system-title', 'class' => 'form-control', 'value' => $this->db->get_where('settings', ['type' => 'system_title'])->row()->description]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('address'), '', ['class' => 'col-sm-3 control-label']) ?>
                        <div class="col-sm-9">
                            <?= form_input(['name' => 'address', 'id' => 'address', 'class' => 'form-control', 'value' => $this->db->get_where('settings', ['type' => 'address'])->row()->description]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('fax'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?= form_input(['name' => 'phone', 'id' => 'phone', 'class' => 'form-control mask-phone', 'value' => $this->db->get_where('settings', ['type' => 'phone'])->row()->description]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('currency'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                <?= form_input(['name' => 'currency', 'id' => 'currency', 'class' => 'form-control', 'value' => $this->db->get_where('settings', ['type' =>'currency'])->row()->description]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('system_email'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <?= form_input(['name' => 'system_email', 'id' => 'system-email', 'class' => 'form-control', 'value' => $this->db->get_where('settings', ['type' =>'system_email'])->row()->description]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('language'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <?php $current_default_language = $this->db->get_where('settings', ['type' => 'language'])->row()->description; ?>
                            <?php $fields = $this->db->list_fields('language'); ?>
                            <?php foreach ($fields as $field) if ($field == 'phrase_id' || $field == 'phrase') continue; ?>
                            <?= form_dropdown('language', $fields, $current_default_language, ['id' => 'language', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= form_label(get_phrase('text_align'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <?php $options = ['' => 'Selecione', 'left-to-right' => 'left-to-right', 'right-to-left' => 'right-to-left']; ?>
                            <?php $text_align =	$this->db->get_where('settings', ['type'=>'text_align'])->row()->description; ?>
                            <?= form_dropdown('text_align', $options, $text_align, ['id' => 'text-align', 'class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <?= form_button_submit(null, get_phrase('save'), 'class="btn btn-info"'); ?>
                        </div>
                    </div>
                <?= form_close();?>
            </div>
        </div>
    </div>
    <?php $skin = $this->db->get_where('settings', ['type' => 'skin_colour'])->row()->description; ?>
    <div class="col-md-6">
        <?= form_open(base_url() .'SystemSettings/system_settings/upload_logo', ['target' => '_top', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal form-groups-bordered validate']); ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <?= get_phrase('upload_logo'); ?>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?= form_label(get_phrase('photo'), '', ['class' => 'col-sm-3 control-label']); ?>
                        <div class="col-sm-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 135px;" data-trigger="fileinput">
                                    <img src="<?= base_url(); ?>uploads/logo.png" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new"><?= get_phrase('select_image'); ?></span>
                                        <span class="fileinput-exists"><?= get_phrase('change'); ?></span>
                                        <?= form_input(['name' => 'userfile', 'id' => 'user-file', 'accept' => 'image/*', 'type' => 'file']); ?>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?= get_phrase('remove'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <?= form_button_submit(null, get_phrase('upload'), 'class="btn btn-info"'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(".gallery-env").on('click', 'a', function () {
        skin = this.id;
        $.ajax({
            url: '<?= base_url(); ?>SystemSettings/system_settings/change_skin/' + skin,
            success: window.location = '<?= base_url(); ?>SystemSettings/system_settings/'
        });
    });
</script>