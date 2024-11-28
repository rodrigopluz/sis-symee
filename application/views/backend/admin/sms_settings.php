<hr />
<?php $active_sms_service = $this->db->get_where('settings', ['type' => 'active_sms_service'])->row()->description; ?>
<div class="row">
	<div class="col-md-12">
		<div class="tabs-vertical-env">
			<ul class="nav tabs-vertical">
				<li class="active"><a href="#b-profile" data-toggle="tab">Select A SMS Service</a></li>
				<li>
					<a href="#v-home" data-toggle="tab">
						Clickatell Settings
						<?php if ($active_sms_service == 'clickatell'): ?>  
							<span class="badge badge-success"><?= get_phrase('active'); ?></span>
						<?php endif; ?>
					</a>
				</li>
				<li>
					<a href="#v-profile" data-toggle="tab">
						Twilio Settings
						<?php if ($active_sms_service == 'twilio'): ?>  
							<span class="badge badge-success"><?= get_phrase('active'); ?></span>
						<?php endif; ?>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="b-profile">
					<?= form_open(base_url() .'smssettings/sms_settings/active_service', ['class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top']); ?>
						<div class="form-group">
							<?= form_label(get_phrase('select_a_service'), '', ['class' => 'col-sm-3 control-label']); ?>
							<div class="col-sm-5">
								<select name="active_sms_service" class="form-control">
								<option value=""<?php if ($active_sms_service == '') echo 'selected'; ?>>
										<?= get_phrase('not_selected');?>
									</option>
									<option value="clickatell"
										<?php if ($active_sms_service == 'clickatell') echo 'selected'; ?>>
											Clickatell
									</option>
									<option value="twilio"
										<?php if ($active_sms_service == 'twilio') echo 'selected'; ?>>
											Twilio
									</option>
									<option value="disabled"<?php if ($active_sms_service == 'disabled') echo 'selected'; ?>>
										<?= get_phrase('disabled'); ?>
									</option>
							</select>
							</div> 
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-5">
								<button type="submit" class="btn btn-info"><?= get_phrase('save'); ?></button>
							</div>
						</div>
	            	<?= form_close(); ?>
				</div>
				<div class="tab-pane" id="v-home">
					<?= form_open(base_url() .'smssettings/sms_settings/clickatell', ['class' => 'form-horizontal form-groups-bordered validate','target'=>'_top']);?>
						<div class="form-group">
	                      <label  class="col-sm-3 control-label"><?= get_phrase('clickatell_username');?></label>
	                      	<div class="col-sm-5">
	                          	<input type="text" class="form-control" name="clickatell_user" value="<?= $this->db->get_where('settings' , ['type' =>'clickatell_user'])->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-3 control-label"><?= get_phrase('clickatell_password');?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="clickatell_password" value="<?= $this->db->get_where('settings' , ['type' =>'clickatell_password'])->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-3 control-label"><?= get_phrase('clickatell_api_id');?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="clickatell_api_id" value="<?= $this->db->get_where('settings' , ['type' =>'clickatell_api_id'])->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
		                        <button type="submit" class="btn btn-info"><?= get_phrase('save');?></button>
		                    </div>
		                </div>
	                <?= form_close(); ?>
				</div>
				<div class="tab-pane" id="v-profile">
					<?= form_open(base_url() . 'smssettings/sms_settings/twilio', ['class' => 'form-horizontal form-groups-bordered validate','target'=>'_top']);?>
						<div class="form-group">
	                      	<label class="col-sm-3 control-label"><?= get_phrase('twilio_account');?> SID</label>
	                      	<div class="col-sm-5">
	                          	<input type="text" class="form-control" name="twilio_account_sid" value="<?= $this->db->get_where('settings' , ['type' =>'twilio_account_sid'])->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label class="col-sm-3 control-label"><?= get_phrase('authentication_token');?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="twilio_auth_token" value="<?= $this->db->get_where('settings' , ['type' =>'twilio_auth_token'])->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      	<label class="col-sm-3 control-label"><?= get_phrase('registered_phone_number');?></label>
	                        <div class="col-sm-5">
	                            <input type="text" class="form-control" name="twilio_sender_phone_number" value="<?= $this->db->get_where('settings' , ['type' =>'twilio_sender_phone_number'])->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
		                        <button type="submit" class="btn btn-info"><?= get_phrase('save');?></button>
		                    </div>
		                </div>
	                <?= form_close(); ?>
				</div>
			</div>
		</div>	
	</div>
</div>