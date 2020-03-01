<?php // form_time(['name' => 'time_start', 'id' => 'time-start', 'class' => 'form-control', 'style' => 'width:30%', 'min' => '08:00', 'max' => '18:00']); ?>
<?php // form_time(['name' => 'time_end', 'id' => 'time-end', 'class' => 'form-control', 'style' => 'width:30%', 'min' => '08:59', 'max' => '18:01']); ?>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	<?= form_label(get_phrase('data_start'), null, ['class' => 'control-label']); ?>
	<?= form_input(['name' => 'date_start', 'id' => 'start', 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
</div>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	<?= form_label(get_phrase('data_end'), null, ['class' => 'control-label']); ?>
	<?= form_input(['name' => 'date_end', 'id' => 'end', 'class' => 'form-control datepicker mask-date', 'data-format' => 'dd/mm/yyyy']); ?>
</div>
<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
	<div class="p-0 form-group">
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('monday'), 'monday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'monday', 'type' => 'checkbox', 'id' => 'monday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('tuesday'), 'tuesday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'tuesday', 'type' => 'checkbox', 'id' => 'tuesday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('wednesday'), 'wednesday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'wednesday', 'type' => 'checkbox', 'id' => 'wednesday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('thursday'), 'thursday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'thursday', 'type' => 'checkbox', 'id' => 'thursday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('friday'), 'friday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'friday', 'type' => 'checkbox', 'id' => 'friday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('saturday'), 'saturday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'saturday', 'type' => 'checkbox', 'id' => 'saturday']) ?>
			</div>
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center p-0">
			<div class="checkbox checkbox-replace text-center">
				<?= form_label(get_phrase('sunday'), 'sunday', ['class' => 'control-label mb-3 w-100']); ?>
				<div class="clearfix"><br/></div>
				<?= form_checkbox(['name' => 'sunday', 'type' => 'checkbox', 'id' => 'sunday']) ?>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-4">
	<a href="#" class="btn btn-primary"><i class="fa fa-plus"></i></a>
</div>