<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('workday/edit/' . $workday[id], 'class=""'); ?>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('Workplace', 'id_workplace', ['class' => 'control-label']); ?>
				<div class="">
					<?php foreach ($workplaces as $_workplaces) $workplaces_option[$_workplaces['id']] = $_workplaces['name']; ?>
					<?= form_dropdown('id_workplace', $workplaces_option, set_value('id_workplace', $workday['get_id']), 'class="form-control" required'); ?>
					<?= form_error('id_workplace'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('End date time', 'end_date_time', ['class' => 'control-label']); ?>
				<div class="">
					<input type="date" name="end_date_time" class="form-control"  />
					<?= form_error('end_date_time'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('Start date time', 'start_date_time', ['class' => 'control-label']); ?>
				<div class="">
					<input type="date" name="start_date_time" class="form-control"  />
					<?= form_error('start_date_time'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('Description', 'description', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input('description', set_value('description', $workday->get_description()), 'class="form-control" '); ?>
					<?= form_error('description'); ?>
				</div>
			</div>
			<div class="form-group  col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?= form_label('Amount employees', 'amount_employees', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_input('amount_employees', set_value('amount_employees', $workday->get_amount_employees()), 'class="form-control" '); ?>
					<?= form_error('amount_employees'); ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button type="submit" class="btn btn-primary">Submit</button>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>">Cancel</a>
			</div>
		<?= form_close(); ?>
	</div>
</div>