<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
		</div>
		<?php if ($workplaces): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('name'); ?></th>
						<th><?= get_phrase('company'); ?></th>
						<th><?= get_phrase('address'); ?></th>
						<th><?= get_phrase('latitude'); ?></th>
						<th><?= get_phrase('longitude'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($workplaces as $workplace): ?>
						<tr>
							<td><?= $workplace['name']; ?></td>
							<td><?= $workplace['business_name']; ?></td>
							<td><?= $workplace['place_name'] .', '. $workplace['number'] .' - '. $workplace['neighborhood_name'] .', '. $workplace['city'] .' - '. $workplace['sigla'] .', '. addformat_zipcode($workplace['zipcode']) .', '. $workplace['initial']; ?></td>
							<td><?= $workplace['latitude']; ?></td>
							<td><?= $workplace['longitude']; ?></td>
							<td class="text-right">
								<a href="javascript:;" onclick="sys_modal_workday('<?= base_url() .'modal/popup_work/work_day/create/'. $workplace['id']; ?>');" class="modal-close-<?= $workplace['id']; ?>" title="<?= get_phrase('work_days'); ?>">
									<i class="fa fa-calendar-check-o fa-lg">&nbsp;</i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $workplace['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $workplace['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any convocation.
		<?php else: ?>
			There are no convocation that are currently available.
		<?php endif; ?>
	</div>
</div>
<?= $js; ?>