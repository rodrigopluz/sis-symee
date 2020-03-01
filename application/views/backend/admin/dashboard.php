<div class="row">
    <!-- CALENDAR-->
	<div class="col-md-8">
    	<div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?= ucfirst(strtolower(get_phrase('event_schedule'))); ?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-4">
        <?php if ($this->session->userdata('profile_id') == 1) { ?> 
            <div class="row">
                <!-- general users for profile - superadmin -->
                <div class="col-md-12">
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="<?= $this->db->count_all('person'); ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
                        <h3><?= get_phrase('users'); ?></h3>
                        <p>Total <?= get_phrase('users'); ?></p>
                    </div>
                </div>
                <!-- companys -->
                <div class="col-md-12">
                    <div class="tile-stats tile-green">
                        <div class="icon"><i class="entypo-briefcase"></i></div>
                        <div class="num" data-start="0" data-end="<?= $this->db->count_all('company'); ?>" data-postfix="" data-duration="800" data-delay="0">0</div>
                        <h3><?= get_phrase('companies'); ?></h3>
                        <p>Total <?= get_phrase('companies'); ?></p>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <!-- users company for profile - empregador -->
                <div class="col-md-12">
                    <div class="tile-stats tile-red">
                        <div class="icon"><i class="entypo-users"></i></div>
                        <div class="num" data-start="0" data-end="<?= count($count_contracts); ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
                        <h3><?= get_phrase('contract_users_active'); ?></h3>
                        <p><?= get_phrase('total_users'); ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var calendar = $('#notice_calendar');
        var initialLocaleCode = '<?= get_phrase('language_settings'); ?>';
        
        calendar.fullCalendar({
            header: {
                left: 'title',
                right: 'today prev,next'
            },
            locale: initialLocaleCode,
            // defaultView: 'basicWeek',
            firstDay: 1,
            height: 250,
            editable: false,
            droppable: false,
            events: [
                <?php foreach($notices as $row): ?>
                    {
                        title: "<?= $row['notice_title'];?>",
                        end: new Date(<?= date('Y',$row['create_timestamp']);?>, <?= date('m',$row['create_timestamp'])-1;?>, <?= date('d',$row['create_timestamp']);?>),
                        start: new Date(<?= date('Y',$row['create_timestamp']);?>, <?= date('m',$row['create_timestamp'])-1;?>, <?= date('d',$row['create_timestamp']);?>)
                    },
                <?php endforeach; ?>
            ]
        });

        calendar.fullCalendar('option', 'locale', initialLocaleCode);
    });
</script>
  
