<hr/>
<div class="row">
	<div class="clearfix">
		<?= form_open('{{ singular }}/edit/' . ${{ singular }}[{{ primaryKey }}], 'class=""'); ?>
{% for column in columns if not column.isPrimaryKey and column.field != 'datetime_created' and column.field != 'datetime_updated' %}
{% set accessor = isCamel ? camel[column.field]['accessor'] : underscore[column.field]['accessor'] %}
			<div class="{{ bootstrap.formGroup }} {{ bootstrap.col6 }}">
{% if column.field in foreignKeys|keys %}
{% set field = foreignKeys[column.field ~ '_singular'] | lower | capitalize | replace({'_': ' '}) %}
{% elseif column.field != 'datetime_created' and column.field != 'datetime_updated' %}
{% set field = column.field | capitalize | replace({'_': ' '}) %}
{% endif %}
				<?= form_label('{{ field }}', '{{ column.field }}', ['class' => '{{ bootstrap.label }}']); ?>
				<div class="">
{% if column.field in foreignKeys|keys %}
					<?php foreach (${{ foreignKeys[column.field] }} as $_{{ foreignKeys[column.field] }}) ${{ foreignKeys[column.field] }}_option[$_{{ foreignKeys[column.field] }}['id']] = $_{{ foreignKeys[column.field] }}['name']; ?>
					<?= form_dropdown('{{ column.field }}', ${{ foreignKeys[column.field] }}_option, set_value('{{ column.field }}', ${{ singular }}['{{ primaryKeys[column.field] }}']), 'class="{{ bootstrap.formControl }}" {{ column.isNull ? '' : 'required' }}'); ?>
{% elseif column.dataType == 'date' or column.dataType == 'datetime' %}
					<input type="date" name="{{ column.field }}" class="{{ bootstrap.formControl }}" {{ column.isNull ? '' : 'required' }} />
{% else %}
					<?= form_input('{{ column.field }}', set_value('{{ column.field }}', ${{ singular }}->{{ accessor }}()), 'class="{{ bootstrap.formControl }}" {{ column.isNull ? '' : 'required' }}'); ?>
{% endif %}
					<?= form_error('{{ column.field }}'); ?>
				</div>
			</div>
{% endfor %}
			<div class="clearfix"></div>
			<div class="{{ bootstrap.textRight }} {{ bootstrap.col12 }}">
				<button type="submit" class="{{ bootstrap.buttonPrimary }}">Submit</button>
				<a class="{{ bootstrap.button }}" href="<?= base_url() .'admin/'. $this->uri->segment(2); ?>">Cancel</a>
			</div>
		<?= form_close(); ?>
	</div>
</div>