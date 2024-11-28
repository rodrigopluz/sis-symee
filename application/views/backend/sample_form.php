<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title">
            		<i class="entypo-plus-circled"></i>
					<?= get_phrase('add_form'); ?>
            	</div>
            </div>
			<div class="panel-body">
                <?= form_open('admin/student/create/', ['class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data']); ?>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?= get_phrase('value_required'); ?>" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?= get_phrase('name'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="name" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label"><?= get_phrase('email'); ?></label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="email" data-validate="required" data-message-required="<?= get_phrase('valid_email_required'); ?>" value="">
					</div>
				</div>
				<div class="form-group">
					<label for="field-3" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-5">
						<input type="password" class="form-control" name="password" value="">
					</div>
				</div>
                <div class="form-group">
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-default"><?= get_phrase('add_student'); ?></button>
					</div>
				</div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
		