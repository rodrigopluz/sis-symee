<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		Cities
	</h1>
	<div class="text-right">
		<a class="btn btn-default" href="<?= base_url('city'); ?>">
			Cancel
		</a>
	</div>
	<div class="form-group ">
		<?= form_label('Nome', 'nome', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_nome(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('States', 'sigla', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_sigla()->get_sigla(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Subst tributaria', 'subst_tributaria', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_subst_tributaria(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Pais id', 'initial', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_initial(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Cod siafi', 'cod_siafi', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_cod_siafi(); ?>" disabled>
		</div>
	</div>
	<div class="form-group ">
		<?= form_label('Cod municipio ibge', 'cod_municipio_ibge', ['class' => 'control-label']); ?>
		<div class="">
			<input type="text" class="form-control" value="<?= $city->get_cod_municipio_ibge(); ?>" disabled>
		</div>
	</div>
</div>