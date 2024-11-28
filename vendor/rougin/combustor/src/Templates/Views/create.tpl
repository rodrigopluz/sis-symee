<hr/>
<div class="row">
	<h1>
		<i class="fa fa-lg fa-list"></i> 
		{{ plural | title }}
	</h1>
	<?= form_open('{{ singular }}/create', 'class=""'); ?>
		<div class="{{ bootstrap.textRight }}">
			<button type="submit" class="{{ bootstrap.buttonPrimary }}">
				Submit
			</button>
			<a class="{{ bootstrap.button }}" href="<?= base_url('{{ singular }}'); ?>">
				Cancel
			</a>
		</div>
{% for column in columns if not column.isPrimaryKey and column.field != 'datetime_created' and column.field != 'datetime_updated' %}
		<div class="{{ bootstrap.formGroup }}">
{% if column.field in foreignKeys|keys %}
{% set field = foreignKeys[column.field ~ '_singular'] | lower | capitalize | replace({'_': ' '}) %}
{% elseif column.field != 'datetime_created' and column.field != 'datetime_updated' %}
{% set field = column.field | capitalize | replace({'_': ' '}) %}
{% endif %}
			<?= form_label('{{ field }}', '{{ column.field }}', array('class' => '{{ bootstrap.label }}')); ?>
			<div class="">
{% if column.field in foreignKeys|keys %}
				<?= form_dropdown('{{ column.field }}', ${{ foreignKeys[column.field] }}, set_value('{{ column.field }}'), 'class="{{ bootstrap
					.formControl }}" {{ column.isNull ? '' : 'required' }}'); ?>
{% elseif column.dataType == 'date' or column.dataType == 'datetime' %}
				<input type="date" name="{{ column.field }}" class="{{ bootstrap.formControl }}" {{ column.isNull ? '' : 'required' }} />
{% else %}
				<?= form_input('{{ column.field }}', set_value('{{ column.field }}'), 'class="{{ bootstrap.formControl }}" {{ column.isNull ? '' : 'required' }}'); ?>
{% endif %}
				<?= form_error('{{ column.field }}'); ?>
			</div>
		</div>
{% endfor %}
	<?= form_close(); ?>
</div>