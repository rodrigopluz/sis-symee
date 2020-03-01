<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Function_Roles
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('function_role'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Name', 'name', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $function_role->get_name(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Status', 'status', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $function_role->get_status(); ?>" disabled>
		</div>
	</div>
</div>