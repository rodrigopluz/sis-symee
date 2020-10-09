<!-- (ajax modal - upload-file) -->
<script type="text/javascript">
	const sys_modal = (url) => {
        // showing ajax preloader image
		$('#modal_ajax .modal-body').html(
            '<div style="text-align:center;margin-top:200px;">'+
                '<img src="<?= base_url() ?>assets/images/preloader.gif" />'+
            '</div>'
        );
		
		// loading the ajax modal
		$('#modal_ajax').modal('show', { backdrop: 'true' });
		
		// show ajax response on request success
		$.ajax({
			url: url,
			success: function(response) {
				$('#modal_ajax .modal-body').html(response);
			}
		});
	}
</script>
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= $system_name; ?></h4>
            </div>
            <div class="modal-body" style="overflow:auto;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= get_phrase('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- (ajax modal - close) -->
<script type="text/javascript">
    const sys_modal_close = (url) => {
        // showing modal
        $('#modal_close .modal-body').html(
            '<div style="text-align:center;">'+
                '<img src="<?= base_url() ?>assets/images/preloader.gif" />'+
            '</div>'
        );

        // loading the ajax modal-close
        $('#modal_close').modal('show', { backdrop: 'true' });

        // show response or request success
        $.ajax({
            url: url,
            success: function(response) {
                $('#modal_close .modal-body').html(response);
                $('.main-content form').removeAttr('action');
            }
        });
    }
</script>
<div class="modal fade" id="modal_close">
    <div class="modal-dialog sys_modal_close">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= $system_name; ?></h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<!-- (normal modal) -->
<script type="text/javascript">
	const confirm_modal = (delete_url) => {
		$('#modal-4').modal('show', { backdrop: 'static' });
		document.getElementById('delete_link').setAttribute('href', delete_url);
	}
</script>
<div class="modal fade" id="modal-4">
    <div class="modal-dialog sys_modal_confirm">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
            </div>
            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="#" class="btn btn-danger" id="delete_link"><?= get_phrase('delete'); ?></a>
                <button type="button" class="btn btn-info" data-dismiss="modal"><?= get_phrase('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- modal-closure -->
<div class="modal fade" id="modal-closure" data-backdrop="static">
    <div class="modal-dialog sys_modal_confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirma Encerramento de Contrato</h4>
            </div>
            <div class="modal-body">Tem certeza que deseja encerrar esse contrato?</div>
            <div class="modal-footer">
                <?= form_button_submit(null, get_phrase('yes'), 'class="btn btn-info" id="yes-link" onclick="submitFormClosureYes()"'); ?>
                <?= form_button_submit(null, get_phrase('no'), 'class="btn btn-danger" id="no-link" onclick="submitFormClosureNo()"'); ?>
            </div>
        </div>
    </div>
</div>

<!-- modal alert -->
<div class="modal fade" id="modal-alert" data-backdrop="static">
    <div class="modal-dialog sys_modal_confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= get_phrase('alert'); ?></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><?= get_phrase('ok'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- modal work-days -->
<div class="modal fade" id="work-day" data-backdrop="static">
    <div class="modal-dialog sys_modal_work">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?= get_phrase('calleds') .' - '. get_phrase('work_days'); ?></h4>
            </div>
            <div class="modal-body"></div>
            <div class="clearfix"><br/></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= get_phrase('close'); ?></button>
                <button type="submit" class="btn btn-primary"><?= get_phrase('save'); ?></button>
            </div>
        </div>
    </div>
</div>