<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<!-- <a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a> -->
		</div>
		<?php if ($employees): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th>#</th>
						<th><?= get_phrase('name'); ?></th>
						<th><?= get_phrase('type'); ?></th>
						<th><?= get_phrase('occupation'); ?></th>
						<th><?= get_phrase('status'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employees as $employee): ?>
						<tr>
							<td><?= $employee['id_person']; ?></td>
							<td><?= $employee['person_name']; ?></td>
							<td><?= $employee['type'] == 'F' ? 'Pessoa Fisica' : 'Pessoa Juridica'; ?></td>
							<td><?= $employee['occupation']; ?></td>
							<td><?= $employee['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $employee['id_person']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<?php if ($this->session->userdata('profile_id') == 1): ?>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $employee['id_person']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any employee.
		<?php else: ?>
			<?= get_phrase('user_employee'); ?>
		<?php endif; ?>
	</div>
</div>