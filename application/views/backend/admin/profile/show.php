<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Profiles
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('profile'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Name', 'name', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $profile->get_name(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Acl', 'acl', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $profile->get_acl(); ?>" disabled>
		</div>
	</div>
</div>