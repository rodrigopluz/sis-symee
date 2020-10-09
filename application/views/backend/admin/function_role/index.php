<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
		</div>
		<?php if ($function_roles): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('function_role'); ?></th>
						<th><?= get_phrase('category'); ?></th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($function_roles as $function_role): ?>
						<tr>
							<td><?= $function_role['name']; ?></td>
							<td><?= $function_role['category']; ?></td>
							<td><?= $function_role['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $function_role['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $function_role['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any function role.
		<?php else: ?>
			<?= get_phrase('text_not_function'); ?>
		<?php endif; ?>
	</div>
</div>