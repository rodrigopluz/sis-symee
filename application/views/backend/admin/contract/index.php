<hr/>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
		<div class="text-right">
			<?php if (count($count_contracts) < intval($this->session->userdata('plan_quantity'))): ?>
				<a class="btn btn-default" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>"><?= get_phrase('new_register'); ?></a>
			<?php else: ?>
				<a class="btn btn-default message-entail" href="javascript:;"><?= get_phrase('new_register'); ?></a>
				<script type="text/javascript">
					$('.message-entail').on('click', function() {
						alert('<?= get_phrase('message_entail') ?>');
					});
				</script>
			<?php endif; ?>
		</div>
		<?php if ($contracts): ?>
			<table class="table table table-striped table-hover" id="table_export">
				<thead>
					<tr>
						<th><?= get_phrase('user_person'); ?></th>
						<th><?= get_phrase('function_role'); ?></th>
						<th><?= get_phrase('business_name'); ?></th>
						<th><?= get_phrase('user_company'); ?></th>
						<th><?= get_phrase('data_start'); ?></th>
						<th><?= get_phrase('data_end'); ?></th>
						<th><?= get_phrase('qrcode'); ?></th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($contracts as $contract): ?>
						<tr>
							<td><?= $contract['pe_name']; ?></td>
							<td><?= $contract['function_name']; ?></td>
							<td><?= $contract['business_name']; ?></td>
							<td><?= $contract['pu_name']; ?></td>
							<td><?= format_dateptbr($contract['start_date']); ?></td>
							<td>
								<?php if ($contract['status'] == 4): ?>
									<?= format_dateptbr($contract['end_date']); ?>
								<?php endif; ?>
							</td>
							<td><?= $contract['qrcode']; ?></td>
							<td>
								<?php 
								switch ($contract['status']) {
									case 0: echo 'Convite enviado'; break;
									case 1: echo 'Convite aceito'; break;
									case 2: echo 'Convite recusado'; break;
									case 3: echo 'Contrato cancelado'; break;
									case 4: echo 'Contrato encerrado'; break;
								} 
								?>
							</td>
							<td class="text-right">
								<?php if ($contract['status'] != 3 or $contract['status'] != 1): ?>
									<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. $contract['id']; ?>" title="<?= get_phrase('edit_entail'); ?>">
										<i class="fa fa-edit fa-lg">&nbsp;</i>
									</a>
								<?php endif; ?>
								<?php if ($contract['status'] >= 1): ?>
									<a href="javascript:;" onclick="sys_modal_close('<?= base_url() .'modal/popup/contract/close/'. $contract['id']; ?>');" class="modal-close-<?= $contract['id']; ?>" title="<?= get_phrase('close_entail'); ?>">
										<i class="fa fa-window-close-o fa-lg">&nbsp;</i>
									</a>
								<?php endif; ?>
								<?php if ($contract['status'] < 3): ?>
									<a href="javascript:;" onclick="sys_modal('<?= base_url() .'modal/popup/contract/show/'. $contract['id']; ?>');" class="modal-pdf-<?= $contract['id']; ?>" title="<?= get_phrase('file_pdf'); ?>">
										<i class="fa fa-file-pdf-o fa-lg">&nbsp;</i>
									</a>
								<?php endif; ?>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/contrato-pdf/'. $contract['id']; ?>" target="_blank" title="<?= get_phrase('print_entail'); ?>">
									<i class="fa fa-print fa-lg">&nbsp;</i>
								</a>
								<?php if ($contract['status'] == 0): ?>
									<a href="javascript:;" class="ajax-refresh-<?= $contract['id']; ?>" title="<?= get_phrase('refresh_entail'); ?>">
										<i class="fa fa-repeat fa-lg">&nbsp;</i>
									</a>
									<script type="text/javascript">
										$('.ajax-refresh-<?= $contract['id'] ?>').on('click', function() {
											$("#ajax_loader").show();
											$.ajax({
												method: 'post',
												dataType: 'json',
												url: baseurl + 'admin/vinculos/ajax-refresh',
												data: {
													id_contract: '<?= $contract['id'] ?>',
													id_company: '<?= $contract['id_company'] ?>',
													id_employee: '<?= $contract['id_employee'] ?>'
												},
												success: function(data) {
													$("#ajax_loader").hide();
													if (data.status == 'ok') {
														alert('Vinculo reenviado com sucesso.');
														location.reload();
													}
												}
											});
										});
									</script>
								<?php endif; ?>
								<?php if ($contract['status'] == 0 or $contract['status'] == 1): ?>
									<!--
									<a href="javascript:;" class="ajax-cancel-<?= $contract['id']; ?>" title="<?= get_phrase('cancel_entail'); ?>">
										<i class="fa fa-user-times fa-lg">&nbsp;</i>
									</a>
									<script type="text/javascript">
										$('.ajax-cancel-<?= $contract['id'] ?>').on('click', function() {
											$("#ajax_loader").show();
											$.ajax({
												method: 'post',
												dataType: 'json',
												url: baseurl + 'admin/vinculos/ajax-cancela',
												data: { 
													id_contract: '<?= $contract['id'] ?>',
													id_company: '<?= $contract['id_company'] ?>',
													id_employee: '<?= $contract['id_employee'] ?>'
												},
												success: function(data) {
													$("#ajax_loader").hide();
													if (data.status == 'ok') {
														alert('Vinculo Cancelado.');
														location.reload();
													}
												}
											});
										});
									</script>
									-->
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any contract.
		<?php else: ?>
			<?= get_phrase('text_not_contract'); ?>
		<?php endif; ?>
	</div>
</div>