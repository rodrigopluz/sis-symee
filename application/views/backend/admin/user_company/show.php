<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		User_Companies
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('user_company'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('People', 'id_person', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_id_person()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Companies', 'id_company', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_id_company()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Profiles', 'id_profile', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_id_profile()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Login', 'login', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_login(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Password', 'password', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_password(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Last login', 'last_login', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_last_login(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('User companies', 'created_by', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_created_by()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $user_company->get_status(); ?>" disabled>
		</div>
	</div>
</div>