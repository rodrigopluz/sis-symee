<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<!-- <a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>">Novo Profile</a> -->
		</div>
		<?php if ($profiles): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th>#</th>
						<th><?= get_phrase('profile'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($profiles as $profile): ?>
						<tr>
							<td><?= $profile['id']; ?></td>	
							<td><?= $profile['name']; ?></td>
							<td class="text-right">
								<a href="<?= base_url() . 'admin/'. $this->uri->segment(2) .'/edita/'. $profile['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= base_url() . 'admin/'. $this->uri->segment(2) .'/delete/'. $profile['id']; ?>">
									<i class="fa fa-trash fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any profile.
		<?php else: ?>
			<?= get_phrase('text_not_profile'); ?>
		<?php endif; ?>
	</div>
</div>