<?php header('Content-Type:text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Content Management System">
    <meta name="author" content="<?=ADMIN_CLIENT?>">
    <link rel="shortcut icon" href="<?=site_url('assets/admin_assets/img/favicon.ico')?>">

    <title>CMS - <?=ADMIN_PROJECT?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= site_url('assets/admin_assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<?php if($this->session->userdata('theme') != 'default' && $this->session->userdata('logged_in')): ?>
    <link href="<?= site_url('assets/admin_assets/css/nav/bs-' . $this->session->userdata('theme') . '.css'); ?>" rel="stylesheet">
	<?php endif; ?>

    <!-- Custom styles -->
    <link href="<?= site_url('assets/admin_assets/css/ui-lightness/jquery-ui-1.8.23.custom.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('assets/admin_assets/css/tablesorter/theme.blue.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('assets/admin_assets/editor/bootstrap-wysihtml5.css'); ?>" rel="stylesheet"></link>
    <link href="<?= site_url('assets/admin_assets/tagmanager/tagmanager.css'); ?>" rel="stylesheet"></link>
    <link href="<?= site_url('assets/admin_assets/spectrum/spectrum.css'); ?>" rel="stylesheet"></link>
    <link href="<?= site_url('assets/admin_assets/msdropdown/dd.css'); ?>" rel="stylesheet"></link>
    <link href="<?= site_url('assets/admin_assets/css/admin.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Admin preloader -->
    <div id="preloader">
        <div id="status"><span class="glyphicon glyphicon-cloud-download"></span> Loading CMS</div>
    </div>

    <!-- Wrap all page content here -->
    <div id="wrap">

        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <?php if ($this->session->userdata('logged_in') == TRUE): ?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php endif; ?>
                    <a class="navbar-brand" href="<?=site_url('admin')?>"><?=ADMIN_PROJECT?></a>
                </div>
                <?php if ($this->session->userdata('logged_in') == TRUE): ?>
                <div class="collapse navbar-collapse">
					<?php if($this->session->userdata('permissions') != ''): ?>
                    <?php $admin_sections = explode(",", $this->session->userdata('permissions')); ?>
                    <ul class="nav navbar-nav">
						<?php foreach($admin_sections as $admin_section): ?>
							<?php $a_section = explode("/", $admin_section); ?>
							<li <?= ($file == $a_section[1])? 'class="active"' : ''; ?>><a href="<?=site_url('admin/' . $a_section[1])?>"><?=$a_section[0]?></a></li>
						<?php endforeach; ?>
                    </ul>
					<?php endif; ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= $this->gravatar->get_gravatar($this->session->userdata('email'), NULL, 20) ?>" style="margin-top:-3px;margin-right:5px;" alt="Profile picture" class="img-circle">
                                Logged in as <?=$this->session->userdata('name')?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=site_url('admin/settings/profile')?>"><span class="glyphicon glyphicon-user"></span>&nbsp; User info (<small><?=$this->session->userdata('user')?></small>)</a></li>

                                <?php if($this->session->userdata('user') == 'admin' && ADMIN_MULTIUSER): ?>
                                <li><a href="<?=site_url('admin/settings')?>"><span class="glyphicon glyphicon-th-list"></span>&nbsp; Manage users</a></li>
                                <?php endif; ?>

								<li><a href="javascript:;" rel="tooltip" data-title="Time log" data-placement="left"><span class="glyphicon glyphicon-time"></span>&nbsp; <span id="box_timer">--:--:--</span></a></li>

                                <li class="divider"></li>

                                <?php $this->load->config('ga_api'); if($this->config->item('profile_id') != '1234567890'): ?>
                                <li><a href="<?=site_url('admin/analytics')?>"><span class="glyphicon glyphicon-stats"></span>&nbsp; Google Analytics</a></li>
                                <?php endif; ?>

                                <?php if(ADMIN_CLEAR_CACHE): ?>
                                <li><a href="<?=site_url('admin/settings/clear-cache')?>"><span class="glyphicon glyphicon-trash"></span>&nbsp; Clear cached data</a></li>
                                <?php endif; ?>

                                <?php if(ADMIN_DB_BACKUP): ?>
                                <li><a href="<?=site_url('admin/settings/backup-db')?>"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp; Database backup</a></li>
                                <?php endif; ?>

                                <li><a href="javascript:;" data-toggle="modal" data-target="#contact-modal" data-remote="<?=site_url('admin/settings/feedback-admin')?>"><span class="glyphicon glyphicon-send"></span>&nbsp; Send feedback</a></li>
                                <li><a href="<?=site_url('admin/settings/help')?>"><span class="glyphicon glyphicon-book"></span>&nbsp; Help</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=site_url('/')?>" target="_blank"><span class="glyphicon glyphicon-globe"></span>&nbsp; Open website</a></li>
                                <li><a href="<?=site_url('admin/login/logout')?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
                <?php endif; ?>
            </div>
        </div>

        <!-- Begin page content -->
        <div class="container container-body">
            <?= $yield ?>
        </div>
    </div>

    <div id="footer">
        <div class="container">
            <p class="text-muted col-md-4">&copy; <?=ADMIN_CLIENT?> <?=date('Y')?></p>
			<p class="text-muted col-md-4 text-center hidden-xs hidden-sm year_moment"><?=year_moment();?></p>
            <?php if ($this->session->userdata('logged_in') == TRUE): ?>
                <?php if($this->session->userdata('last_login') != '0000-00-00 00:00:00'): ?>
                    <?php $this->load->helper('date'); ?>
                    <p class="text-muted col-md-4 text-right small hidden-xs hidden-sm"><strong>Last login:</strong> <?= unix_to_human(strtotime($this->session->userdata('last_login'))); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

	<div class="modal fade modal-form" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="text-center container"><img src="<?=site_url('assets/admin_assets/img/load_modal.gif')?>" alt="Loading modal" style="padding: 9px;"></div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <script src="<?= site_url('assets/admin_assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/js/jquery.tablesorter.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/js/jquery.tablesorter.pager.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/js/jquery.tablesorter.widgets.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/editor/wysihtml5-0.3.0.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/editor/bootstrap-wysihtml5.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/tagmanager/tagmanager.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/spectrum/spectrum.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/msdropdown/jquery.dd.min.js'); ?>"></script>
    <script src="<?= site_url('assets/admin_assets/js/admin.js'); ?>"></script>
    <script>
	$(function() {
		remember_me_init('ch_<?= url_title(ADMIN_PROJECT, '_', TRUE); ?>', 'user_<?= url_title(ADMIN_PROJECT, '_', TRUE); ?>');
		<? if($this->session->userdata('logged_in')): ?>call_timer(localStorage.seconds);<? else: ?>localStorage.seconds = 0;<? endif; ?>
	});
	</script>
</body>
</html>
