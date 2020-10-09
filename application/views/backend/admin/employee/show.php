<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Employees
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('employee'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('People', 'id_person', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_id_person()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_status(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Occupation', 'occupation', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_occupation(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Login', 'login', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_login(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Password', 'password', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_password(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Last login', 'last_login', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $employee->get_last_login(); ?>" disabled>
		</div>
	</div>
</div>