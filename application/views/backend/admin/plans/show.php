<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Plans
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('plan'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Plan name', 'plan_name', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $plan->get_plan_name(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Price', 'price', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $plan->get_price(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Type', 'type', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $plan->get_type(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Description', 'description', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $plan->get_description(); ?>" disabled>
		</div>
	</div>
</div>