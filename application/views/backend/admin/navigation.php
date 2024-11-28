<div class="sidebar-menu">
    <header class="logo-env">
        <div class="logo">
            <a href="<?= base_url(); ?>">
                <?= img(['src' => image(base_url().'uploads/logo.png', null), 'width' => '200', 'alt' => '']); ?>
            </a>
        </div>
        <div class="sidebar-collapse">
            <a href="#" class="sidebar-collapse-icon with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <div class="sidebar-user-info">
        <div class="sui-normal">
            <a href="#" class="user-link">
                <?php if ($this->session->userdata('avatar') != null): ?>
                    <?= img(['src' => image(base_url().'uploads/admin_image/'. $this->session->userdata('avatar'), null), 'width' => '55', 'class' => 'img-circle', 'alt' => '']); ?>
                <?php else: ?>
                    <?= img(['src' => image(base_url().'uploads/user.jpg', null), 'width' => '55', 'class' => 'img-circle', 'alt' => '']); ?>
                <?php endif; ?>
                <span>Bem-vindo,</span>
                <strong><?= $this->session->userdata('name'); ?></strong>
            </a>
        </div>
        <div class="sui-hover inline-links animate-in">
            <a href="<?= base_url(); ?><?= $account_type; ?>/conta">
                <i class="fa fa-info"></i>
                <span><?= get_phrase('edit_profile'); ?></span>
            </a>
            <a href="<?= base_url(); ?><?= $account_type; ?>/conta">
                <i class="fa fa-key"></i>
                <span><?= get_phrase('change_password'); ?></span>
            </a>
            <span class="close-sui-popup">&times;</span>
        </div>
    </div>
    <ul id="main-menu" class="">
        <?php if ($this->session->userdata('reset') == 0): ?>
            <li id="dashboard" class="<?php if ($page_name == 'dashboard') echo 'active'; ?>">
                <a href="<?= base_url(); ?>admin/dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span><?= get_phrase('dashboard'); ?></span>
                </a>
            </li>
            <li id="permissions" class="<?php if ($this->uri->segment(2) == 'usuario-empresa' || $this->uri->segment(2) == 'usuario-empregado' || $this->uri->segment(2) == 'perfis') echo 'opened active'; ?>">
                <a href="#">
                    <i class="fa fa-unlock"></i>
                    <span><?= get_phrase('permissions'); ?></span>
                </a>
                <ul>
                    <?php if ($this->session->userdata('profile_id') <= 2) { ?>
                        <li class="has-sub <?php if ($this->uri->segment(2) == 'usuario-empresa' || $this->uri->segment(2) == 'usuario-empregado') echo 'opened'; ?>">
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span><?= get_phrase('users'); ?></span>
                            </a>
                            <ul>
                                <li class="<?php if ($this->uri->segment(2) == 'usuario-empresa') echo 'active'; ?> ">
                                    <a href="<?= base_url() . $account_type; ?>/usuario-empresa">
                                        <i class="fa fa-building"></i>
                                        <span><?= get_phrase('employer'); ?></span>
                                    </a>
                                </li>
                                <?php if ($this->session->userdata('profile_id') == 1) { ?>
                                    <li class="<?php if ($this->uri->segment(2) == 'usuario-empregado') echo 'active'; ?>">
                                        <a href="<?= base_url() . $account_type?>/usuario-empregado">
                                            <i class="fa fa-users"></i>
                                            <span><?= get_phrase('employee'); ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('profile_id') == 1) { ?>
                        <li class="<?php if ($this->uri->segment(2) == 'perfis') echo 'active'; ?>">
                            <a href="<?= base_url() . $account_type; ?>/perfis">
                                <i class="fa fa-list-alt"></i>
                                <span><?= get_phrase('profile'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li id="companies" class="<?php if ($this->uri->segment(2) == 'empresas') echo 'active'; ?>">
                <a href="<?= base_url(); ?>admin/empresas">
                    <i class="fa fa-building-o"></i>
                    <span><?= get_phrase('companies'); ?></span>
                </a>
            </li>
            <li id="entails" class="<?php if ($this->uri->segment(2) == 'vinculos') echo 'active'; ?>">
                <a href="<?= base_url(); ?>admin/vinculos">
                    <i class="fa fa-file-text"></i>
                    <span><?= get_phrase('entails'); ?></span>
                </a>
            </li>
            <li id="called" class="<?php if ($this->uri->segment(2) == 'locais-trabalho') echo 'opened'; ?>">
                <a href="#">
                    <i class="fa fa-bullhorn"></i>
                    <span><?= get_phrase('calleds'); ?></span>
                </a>
                <ul>
                    <li id="work_places" class="<?php if ($this->uri->segment(2) == 'locais-trabalho') echo 'active'; ?>">
                        <a href="<?= base_url(); ?>admin/locais-trabalho">
                            <i class="fa fa-map-signs"></i>
                            <span><?= get_phrase('work_places'); ?></span>
                        </a>
                    </li>

                </ul>
            </li>
            <li id="qrcode" class="<?php if ($this->uri->segment(2) == 'qrcode') echo 'active'; ?>">
                <a href="javascript:;" id="qrcode-active" onclick="mac_address('<?= $this->session->userdata('company_id'); ?>')">
                    <i class="fa fa-qrcode"></i>
                    <span><?= get_phrase('qrcode'); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <li id="accounts" class="<?php if ($this->uri->segment(2) == 'conta') echo 'active'; ?>">
            <a href="<?= base_url(); ?>admin/conta">
                <i class="fa fa-expeditedssl"></i>
                <span><?= get_phrase('account'); ?></span>
            </a>
        </li>
        <?php if ($this->session->userdata('profile_id') == 1) { ?>
            <li id="settings" class="<?php if ($page_name == 'system_settings' || $page_name == 'manage_language' || $this->uri->segment(2) == 'planos') echo 'opened'; ?>">
                <a href="#">
                    <i class="fa fa-life-buoy"></i>
                    <span><?= get_phrase('settings'); ?></span>
                </a>
                <ul>
                    <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?>">
                        <a href="<?= base_url(); ?>admin/configuracoes-gerais">
                            <i class="fa fa-cog"></i>
                            <span><?= get_phrase('general_settings'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?>">
                        <a href="<?= base_url(); ?>admin/gerenciar-lingua">
                            <i class="fa fa-language"></i>
                            <span><?= get_phrase('manage_language'); ?></span>
                        </a>
                    </li>
                    <li class="<?php if ($this->uri->segment(2) == 'planos') echo 'active'; ?>">
                        <a href="<?= base_url(); ?>admin/planos">
                            <i class="fa fa-th-list"></i>
                            <span><?= get_phrase('plans'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li id="citys" class="<?php if ($this->uri->segment(2) == 'cidades') echo 'active'; ?>">
                <a href="<?= base_url() ?>admin/cidades">
                    <i class="fa fa-thumb-tack"></i>
                    <span><?= get_phrase('city'); ?></span>
                </a>
            </li>
            <li id="cnaes" class="<?php if ($this->uri->segment(2) == 'funcoes' || $this->uri->segment(2) == 'categoria-funcoes') echo 'opened'; ?>">
                <a href="#">
                    <i class="fa fa-server"></i>
                    <span><?= get_phrase('cnaes'); ?></span>
                </a>
                <ul>
                    <li id="category_function" class="<?php if ($this->uri->segment(2) == 'categoria-funcoes') echo 'active'; ?>">
                        <a href="<?= base_url() ?>admin/categoria-funcoes">
                            <i class="fa fa-list-ul"></i>
                            <span><?= get_phrase('category_function'); ?></span>
                        </a>
                    </li>
                    <li id="function_roles" class="<?php if ($this->uri->segment(2) == 'funcoes') echo 'active'; ?>">
                        <a href="<?= base_url() ?>admin/funcoes">
                            <i class="fa fa-briefcase"></i>
                            <span><?= get_phrase('function_role'); ?></span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>