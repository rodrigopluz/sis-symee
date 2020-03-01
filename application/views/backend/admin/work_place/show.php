<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Convocations
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('convocation'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Status', 'status', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_status(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Date time send', 'date_time_send', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_date_time_send(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Date time last reponse', 'date_time_last_reponse', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_date_time_last_reponse(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Justification', 'justification', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_justification(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Company response', 'company_response', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_company_response(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Company justification', 'company_justification', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_company_justification(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Attachment', 'attachment', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_attachment(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Description', 'description', array('class' => 'control-label')); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $convocation->get_description(); ?>" disabled>
		</div>
	</div>
</div>