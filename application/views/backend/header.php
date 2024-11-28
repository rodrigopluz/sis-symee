<div class="row">
	<div class="col-md-12 col-sm-12 clearfix">
		<ul class="user-info list-inline links-list pull-left">
           	<li class="dropdown language-selector">
                <a class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
					<h3 style="margin-top:1px;"><?= get_type('system_name'); ?> 
						<?php if ($this->session->userdata('profile_id') > 1) { ?>
							- <?= get_phrase('plan') .' '. $this->session->userdata('plan_name'); ?> 
						<?php } ?>
					</h3>
                </a>
			</li>
		</ul>
		<?php if ($this->session->userdata('reset') == 0): ?>
			<ul class="user-info pull-left pull-right-xs pull-none-xsm">
				<li class="notifications dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="entypo-bell"></i>
						<span class="badge badge-info"></span>
					</a>
					<ul class="dropdown-menu">
						<?php if ($entail == 1) { ?>
							<li class="top">
								<p class="small">You have <strong class="badge-info"></strong> new notifications.</p>
							</li>
						<?php } ?>
						<li>
							<ul class="dropdown-menu-list scroller">
								<?php foreach ($entails as $entail) { ?>	
									<li class="unread notification-success">
										<a href="#">
											<i class="entypo-user-add pull-right"></i>
											<span class="line">
												<strong>New user registered</strong>
											</span>
											<span class="line small">30 seconds ago</span>
										</a>
									</li>
								<?php } ?>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		<?php endif; ?>
		<ul class="list-inline links-list pull-right">
			<?php if ($this->session->userdata('profile_id') == 1): ?>
				<li class="dropdown language-selector">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
						<i class="fa fa-globe"></i> 
						<span><?= get_phrase('language'); ?></span>
					</a>
					<ul class="dropdown-menu <?php if ($text_align == 'left-to-right') echo 'pull-left'; else echo 'pull-right'; ?>">
						<?php $languages = $this->db->list_fields('language'); ?>
						<?php $languages = array_slice($languages, 1, 6); ?>
						<?php foreach ($languages as $language) { ?>
							<?php if ($language == 'phrase_id' || $language == 'phrase') continue; ?>
							<li class="<?php if ($this->session->userdata('current_language') == $language) echo 'active'; ?>">
								<a href="<?= base_url(); ?>multilanguage/select_language/<?= $language; ?>">
									<img class="icon-bandeira" src="<?= base_url(); ?>uploads/flag/<?= $language; ?>.png" />	
									<span><?= ucfirst(strtolower($language)); ?></span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php endif; ?>
			<li class="sep"></li>
			<li>
				<a href="<?= base_url(); ?>login/logout">Logout <i class="entypo-logout right"></i></a>
			</li>
		</ul>
	</div>
</div>
<hr class="hr-header" />