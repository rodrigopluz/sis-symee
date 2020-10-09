<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>">Novo Workday</a>
		</div>
		<?php // if ($workdays): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('work_places'); ?></th>
						<th><?= get_phrase('description'); ?></th>
						<th>Amount Employees</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($workdays as $workday): ?>
						<tr>
							<td><?= $workday->get_id_workplace()->get_id(); ?></td>
							<td><?= $workday['description']; ?></td>
							<td><?= $workday['amount_employees']; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $workday['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $workday['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php // elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any workday.
		<?php // else: ?>
			There are no workday that are currently available.
		<?php // endif; ?>
	</div>
</div>