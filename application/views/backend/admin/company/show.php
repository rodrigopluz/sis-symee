<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Companies
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('company'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Addresses', 'id_adress', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_id_adress()->get_id(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Business name', 'business_name', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_business_name(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Fantasy name', 'fantasy_name', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_fantasy_name(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Cnpj', 'cnpj', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_cnpj(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('State registration', 'state_registration', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_state_registration(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Phone', 'phone', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_phone(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Fax', 'fax', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_fax(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Site', 'site', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_site(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Email', 'email', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $company->get_email(); ?>" disabled>
		</div>
	</div>
</div>