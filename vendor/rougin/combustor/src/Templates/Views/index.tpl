<hr/>
<div class="row">
	<div class="{{ bootstrap.col12 }} clearfix">
		<div class="{{ bootstrap.textRight }}">
			<a class="{{ bootstrap.button }}" href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/novo'; ?>">Novo {{ singular | title }}</a>
		</div>
		<?php if (${{ plural }}): ?>
			<table class="{{ bootstrap.table }}" id="table_export">
				<thead>
					<tr>
{% for column in columns if not column.isPrimaryKey and column.field != 'datetime_created' and column.field != 'datetime_updated' %}
						<th>{{ column.field | replace({'_id': '', '_': ' '}) | title }}</th>
{% endfor %}
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach (${{ plural }} as ${{ singular }}): ?>
						<tr>
{% for column in columns if not column.isPrimaryKey and column.field != 'datetime_created' and column.field != 'datetime_updated' %}
{% set accessor = isCamel ? camel[column.field]['accessor'] : underscore[column.field]['accessor'] %}
{% if column.field in foreignKeys|keys %}
							<td><?= ${{ singular }}->{{ accessor }}()->{{ primaryKeys[column.field] }}(); ?></td>
{% else %}
							<td><?= ${{ singular }}['{{ accessor | replace({'get_':''}) }}']; ?></td>
{% endif %}
{% endfor %}
							<td class="text-right">
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/edita/'. ${{ singular }}['{{ primaryKey }}']; ?>">
									<i class="fa fa-edit fa-lg"></i>
								</a>
								<a href="<?= site_url('admin') .'/'. $this->uri->segment(2) .'/delete/'. ${{ singular }}['{{ primaryKey }}']; ?>">
									<i class="fa fa-trash-o fa-lg"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?= $links; ?>
		<?php elseif ($this->input->get('keyword')): ?>
			Your search - <b><?= $this->input->get('keyword') ?></b> - did not match any {{ singular | lower | replace({'_': ' '}) }}.
		<?php else: ?>
			There are no {{ singular | lower | replace({'_': ' '}) }} that are currently available.
		<?php endif; ?>
	</div>
</div>