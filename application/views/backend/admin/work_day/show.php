<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Workdays
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('workday'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Workplaces', 'id_workplace', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $workday->get_id_workplace()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('End date time', 'end_date_time', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $workday->get_end_date_time(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Start date time', 'start_date_time', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $workday->get_start_date_time(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Description', 'description', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $workday->get_description(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Amount employees', 'amount_employees', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $workday->get_amount_employees(); ?>" disabled>
		</div>
	</div>
</div>