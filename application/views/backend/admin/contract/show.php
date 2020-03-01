<div class="row">
	<div class="clearfix">
		<div class="box-content">
			<div class="col-md-12">
				<div class="alert alert-default">
					<p><?= get_phrase('info_file_upload'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-content">
	<?= form_hidden('contract', set_value('contract', $this->uri->segment(5))); ?>
	<?= form_open('Modal/upload_file/'. $this->uri->segment(5), ['id' => 'dropzone_example', 'class' => 'dropzone', 'enctype' => 'multipart/form-data']); ?>
		<div class="fallback">
			<?= form_upload(['name' => 'file', 'id' => 'file', 'class' => 'form-control', 'multiple' => true]); ?>
		</div>
	<?= form_close(); ?>
	<div class="clearfix"><br/></div>
	<?php if ($contract): ?>
		<div id="dze_info" class="hidders">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title"><?= get_phrase('title_files'); ?></div>
				</div>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th><?= get_phrase('file_name'); ?></th>
							<th><?= get_phrase('file_size'); ?></th>
							<th><?= get_phrase('file_type'); ?></th>
							<th>Status</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($contract as $row): ?>
							<?php if ($row['id_contract']): ?>
								<tr>
									<td><?= $row['file_name']; ?></td>
									<td><?= $row['file_size']; ?></td>
									<td><?= $row['file_type']; ?></td>
									<td><?= $row['file_status'] == 1 ? '<i class="fa fa-close fa-lg"></i>' : '<i class="fa fa-check fa-lg"></i>'; ?></td>
									<td>
										<a href="<?= site_url('admin') .'/'. $this->uri->segment(1) .'/delete/'. $row['id_file']; ?>">
											<i class="fa fa-trash-o fa-lg"></i>
										</a>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	<?php endif; ?>
</div>
