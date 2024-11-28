<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Function_Categories
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('function_category'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Category', 'category', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $function_category->get_category(); ?>" disabled>
		</div>
	</div>
</div>