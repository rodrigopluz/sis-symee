<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('Plans/create/', ['class' => 'form-content']); ?>
			<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<?= form_label(get_phrase('plan'), 'type', ['class' => 'control-label']); ?>
				<div class="">
					<?php $type_option[''] = 'Selecione'; ?>	
					<?php $type_option = ['1' => 'Básico', '2' => 'Light', '3' => 'Smart', '4' => 'Ultra', '5' => 'Personalizado']; ?>
					<?= form_dropdown('type', $type_option, $plan['type'], ['id' => 'type', 'class' => 'form-control']); ?>
				</div>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<?= form_label(get_phrase('quantity'), 'quantity', ['class' => 'control-label']); ?>
				<div class="input-spinner">
					<button type="button" class="btn btn-default">-</button>
					<?= form_input(['name' => 'quantity', 'id' => 'quantity', 'class' => 'form-control']); ?>
					<button type="button" class="btn btn-default">+</button>
				</div>
			</div>
			<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<?= form_label(get_phrase('price'), 'price', ['class' => 'control-label']); ?>
				<div class="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-money"></i></span>
						<?= form_input(['name' => 'price', 'id' => 'price', 'class' => 'form-control mask-money', 'data-mask' => 'currency', 'data-sign' => get_phrase('simbol_money')]); ?>
					</div>
				</div>
			</div>
			<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<?= form_label(get_phrase('collaborator'), 'collaborator', ['class' => 'control-label']); ?>
				<?php $val = explode(',', $plan['collaborator']); ?>
				<div class="slider slider-blue" data-min="0" data-max="50" data-min-val="<?= $val[0]; ?>" data-max-val="<?= $val[1]; ?>" data-fill="#collaborator"></div>
				<?= form_hidden('collaborator', set_value('collaborator', $plan['collaborator'])); ?>
			</div>
			<div class="clearfix"></div>
			<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_label(get_phrase('description'), 'description', ['class' => 'control-label']); ?>
				<div class="">
					<?= form_textarea(['name' => 'description', 'id' => 'description', 'class' => 'form-control wysihtml5', 'data-stylesheet-url' => base_url().'assets/css/wysihtml5-color.css'], set_value('description', $plan['description'])); ?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="text-right col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?= form_button_submit(null, get_phrase('save'), 'class="btn btn-primary"'); ?>
				<a class="btn btn-default" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>"><?= get_phrase('cancel'); ?></a>
			</div>
		<?= form_close(); ?>
	</div>
</div>