<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<?php if ($this->session->userdata('profile_id') == 1) { ?>
			<div class="text-right">
				<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
			</div>
		<?php } ?>
		<?php if ($companies): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th>#</th>
						<th><?= get_phrase('business_name'); ?> - <?= get_phrase('company'); ?></th>
						<th><?= get_phrase('cnpj'); ?></th>
						<th><?= get_phrase('plan'); ?></th>
						<th><?= get_phrase('phone'); ?></th>
						<th><?= get_phrase('site'); ?></th>
						<th><?= get_phrase('email'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($companies as $company): ?>
						<tr>
							<td><?= $company['id']; ?></td>
							<td><?= $company['business_name']; ?></td>
							<td><?= addformat_cnpj($company['cnpj']); ?></td>
							<td><?= $company['plan_name']; ?></td>
							<td><?= $company['phone']; ?></td>
							<td><?= $company['site']; ?></td>
							<td><?= $company['email']; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $company['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<?php if ($this->session->userdata('profile_id') == 1): ?>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $company['id']; ?>">
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
			Your search - <b><?= $this->input->get('keyword'); ?></b> - did not match any company.
		<?php else: ?>
			<?= get_phrase('text_not_company'); ?>
		<?php endif; ?>
	</div>
</div>
