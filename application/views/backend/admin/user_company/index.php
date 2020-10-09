<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<?php if ($this->session->userdata('profile_id') == 1) { ?>
			<div class="text-right">
				<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
			</div>
		<?php } ?>
		<?php if ($user_companies): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th>#</th>
						<th><?= get_phrase('name'); ?></th>
						<th><?= get_phrase('company'); ?></th>
						<th><?= get_phrase('profile'); ?></th>
						<th><?= get_phrase('status'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($user_companies as $user_company): ?>
						<tr>
							<td><?= $user_company['id_person']; ?></td>
							<td><?= $user_company['name']; ?></td>
							<?php if ($user_company['id_profile'] != 1): ?>
								<td><?= $user_company['business_name']; ?></td>
							<?php else: ?>
								<td>Symee Sistema Web</td>
							<?php endif; ?>
							<td><?= $user_company['pr_name']; ?></td>
							<td><?= $user_company['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $user_company['id_person']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<?php if ($this->session->userdata('profile_id') == 1): ?>
									<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $user_company['id_person']; ?>">
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
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any user company.
		<?php else: ?>
			Não há nenhum usuário empregador atualmente disponível.
		<?php endif; ?>
	</div>
</div>