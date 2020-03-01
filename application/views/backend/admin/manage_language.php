<hr/>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs bordered">
        	<?php if (isset($edit_profile)): ?>
			<li class="active">
            	<a href="#edit" data-toggle="tab">
                    <i class="icon-wrench"></i> 
					<?= get_phrase('edit_phrase'); ?>
                </a>
            </li>
            <?php endif; ?>
			<li class="<?php if (!isset($edit_profile)) echo 'active'; ?>">
            	<a href="#list" data-toggle="tab">
                    <i class="entypo-menu"></i> 
					<?= get_phrase('language_list'); ?>
                </a>
            </li>
			<li>
            	<a href="#add" data-toggle="tab">
                    <i class="entypo-plus-circled"></i>
					<?= get_phrase('add_phrase'); ?>
                </a>
            </li>
			<li class="">
            	<a href="#add_lang" data-toggle="tab">
                    <i class="entypo-plus-circled"></i> 
					<?= get_phrase('add_language'); ?>
                </a>
            </li>
		</ul>
		<div class="tab-content">
            <?php if (isset($edit_profile)): ?>
			<div class="tab-pane active" id="edit" style="padding: 5px">
                <div class="">
                    <?php $current_editing_language = $edit_profile; ?>
                    <?= form_open(base_url() .'ManageLanguage/manage_language/update_phrase/'. $current_editing_language, ['id' => 'phrase_form']); ?>
                        <div class="row">
                            <?php $count = 1; ?>
                            <?php $language_phrases = $this->db->query("SELECT id, phrase, $current_editing_language FROM language")->result_array(); ?>
                            <?php foreach ($language_phrases as $row) { ?>
                                <?php $count++; ?>
                                <?php $phrase_id	   = $row['id'];                      // id number of phrase ?>
                                <?php $phrase_language = $row[$current_editing_language]; // phrase of current editing language ?>
                                <div class="col-sm-3">
                                    <div class="tile-stats tile-gray">
                                        <div class="icon"><i class="entypo-mail"></i></div>
                                        <h3><?= $row['phrase']; ?></h3>
                                        <p><?= form_input(['name' => 'phrase'. $phrase_id, 'id' => 'phrase-'. $phrase_id, 'class' => 'form-control', 'value' => $phrase_language]); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <?= form_input(['name' => 'total_phrase', 'value' => $count, 'type' => 'hidden']); ?>
                        <input type="submit" value="<?= get_phrase('update_phrase'); ?>" onClick="document.getElementById('phrase_form').submit();" class="btn btn-blue"/>	
                    <?= form_close(); ?>
                </div>                
			</div>
            <?php endif;?>
            <div class="tab-pane <?php if (!isset($edit_profile)) echo 'active'; ?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                	<thead>
                    	<tr>
                        	<th><?= get_phrase('language'); ?></th>
                        	<th><?= get_phrase('option'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $fields = $this->db->list_fields('language'); ?>
						<?php foreach ($fields as $field) { ?>
							 <?php if ($field == 'id' || $field == 'phrase') continue; ?>
                            <tr>
                                <td><?= ucwords($field); ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>admin/gerenciar-lingua/edita-idioma/<?= $field; ?>" class="btn btn-info"><?= get_phrase('edit_phrase'); ?></a>
                                    <a href="<?= base_url(); ?>admin/gerenciar-lingua/delete_language/<?= $field; ?>" rel="tooltip" data-placement="top" data-original-title="<?= get_phrase('delete_language'); ?>" class="btn btn-gray" onclick="return confirm('Delete Language ?');">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
			</div>
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?= form_open(base_url() .'ManageLanguage/manage_language/add_phrase/', ['class' => 'form-horizontal form-groups-bordered validate']); ?>
                        <div class="padded">
                            <div class="form-group">
                                <?= form_label(get_phrase('phrase'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?= form_input(['name' => 'phrase', 'id' => 'phrase', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required'), 'class' => 'form-control']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <?= form_button_submit(null, get_phrase('add_phrase'), 'class="btn btn-info"'); ?>
                            </div>
						</div>
                    <?= form_close(); ?>
                </div>                
			</div>
			<div class="tab-pane box" id="add_lang" style="padding: 5px">
                <div class="box-content">
                    <?= form_open(base_url() .'ManageLanguage/manage_language/add_language/', ['class' => 'form-horizontal form-groups-bordered validate']); ?>
                        <div class="padded">
                            <div class="form-group">
                                <?= form_label(get_phrase('language'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <?= form_input(['name' => 'language', 'id' => 'language', 'data-validate' => 'required', 'data-message-required' => get_phrase('value_required'), 'class' => 'form-control']); ?>
                                </div>
                            </div>
                            <div class=form-group>
                                <?= form_label(get_phrase('image'), '', ['class' => 'col-sm-3 control-label']); ?>
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="http://placehold.it/200x200" alt="...">
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
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <?= form_button_submit(null, get_phrase('add_language'), 'class="btn btn-info"'); ?>
                            </div>
						</div>
                    <?= form_close(); ?> 
                </div>
			</div>
		</div>
	</div>
</div>