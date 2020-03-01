<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
		</div>
		<?php if ($cities): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('cod_municipio_ibge'); ?></th>
						<th><?= get_phrase('city'); ?></th>
						<th><?= get_phrase('state'); ?></th>
						<th><?= get_phrase('countrys'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($cities as $city): ?>
						<tr>
							<td><?= $city['cod_municipio_ibge']; ?></td>
							<td><?= $city['name']; ?></td>
							<td><?= $city['sigla']; ?></td>
							<td><?= $city['initial']; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $city['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $city['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any city.
		<?php else: ?>
			<?= get_phrase('text_not_city'); ?>
		<?php endif; ?>
	</div>
</div>