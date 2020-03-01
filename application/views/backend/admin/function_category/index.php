<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register') ?></a>
		</div>
		<?php if ($function_categories): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th>#</th>
						<th><?= get_phrase('category'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($function_categories as $function_category): ?>
						<tr>
							<td><?= $function_category['id']; ?></td>
							<td><?= $function_category['category']; ?></td>
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $function_category['id']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. $function_category['id']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any function category.
		<?php else: ?>
			There are no function category that are currently available.
		<?php endif; ?>
	</div>
</div>