<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
		</div>
		<?php if ($plans): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('plan'); ?></th>
						<th><?= get_phrase('price'); ?></th>
						<th><?= get_phrase('quantity'); ?></th>
						<th><?= get_phrase('collaborator'); ?></th>
						<th><?= get_phrase('description'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($plans as $plan): ?>
						<?php 
						switch ($plan['type']) { 
							case 1: $plan_type = 'Básico'; break;
							case 2: $plan_type = 'Light'; break;
							case 3: $plan_type = 'Smart'; break;
							case 4: $plan_type = 'Ultra'; break;
						}
						?>
						<tr>
							<td><?= $plan_type; ?></td>
							<td><?= $plan['price']; ?></td>
							<td><?= $plan['quantity']; ?></td>
							<td><?= $plan['collaborator']; ?></td>
							<td><?= $plan['description']; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $plan['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $plan['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any plan.
		<?php else: ?>
			There are no plan that are currently available.
		<?php endif; ?>
	</div>
</div>