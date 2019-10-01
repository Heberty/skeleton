<?php
// This laytout will be used ONLY if the www/assets/default.php file does not exist
// To generate the file, run the webpack task

use Mix\Application;
$ui = Application::getDefault()->getUiManager();


$includeAssets = false;

?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="pt_BR" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
        <title><?=$ui->getPageTitle()?> | <?=$ui->getProjectName()?></title>

		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<meta name="robots" content="noindex, nofollow" />
		<!-- end: META -->

		<!-- start: MAIN CSS -->
        <?= \View::factory('admin/stylesheet') ?>
        <!-- end: MAIN CSS -->

		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="<?=$this->url('assets/css/admin/plugins/fullcalendar.css') ?>">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->


		<link href="<?=$this->url('assets/css/admin/plugins/toggles.css')?>" rel="stylesheet" />
		<link href="<?=$this->url('assets/css/admin/plugins/toggles-all.css')?>" rel="stylesheet" />

		<style>
			.select2-container {
				min-width: 200px;
			}
		</style>

        <?=$this->section('head')?>
        <?=\View::globalSection('head')?>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
        <?= $this->section('body') ?>
		<!-- start: HEADER -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->
			<div class="container">
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->
					<a class="navbar-brand" href="<?= $this->routeUrl('admin.dashboard') ?>">
						<?=$ui->getProjectName()?>
					</a>
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">
                        <?php if (false):?>
						<!-- start: TO-DO DROPDOWN -->
						<li class="dropdown">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<i class="clip-list-5"></i>
								<span class="badge"> 12</span>
							</a>
							<ul class="dropdown-menu todo">
								<li>
									<span class="dropdown-menu-title"> You have 12 pending tasks</span>
								</li>
								<li>
									<div class="drop-down-wrapper">
										<ul>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
													<span class="label label-danger" style="opacity: 1;"> today</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
													<span class="label label-danger" style="opacity: 1;"> today</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> Hire developers</span>
													<span class="label label-warning"> tommorow</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc">Staff Meeting</span>
													<span class="label label-warning"> tommorow</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> New frontend layout</span>
													<span class="label label-success"> this week</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> Hire developers</span>
													<span class="label label-success"> this week</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> New frontend layout</span>
													<span class="label label-info"> this month</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> Hire developers</span>
													<span class="label label-info"> this month</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
													<span class="label label-danger" style="opacity: 1;"> today</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
													<span class="label label-danger" style="opacity: 1;"> today</span>
												</a>
											</li>
											<li>
												<a class="todo-actions" href="javascript:void(0)">
													<i class="fa fa-square-o"></i>
													<span class="desc"> Hire developers</span>
													<span class="label label-warning"> tommorow</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="view-all">
									<a href="javascript:void(0)">
										See all tasks <i class="fa fa-arrow-circle-o-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<!-- end: TO-DO DROPDOWN-->
						<!-- start: NOTIFICATION DROPDOWN -->
						<li class="dropdown">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<i class="clip-notification-2"></i>
								<span class="badge"> 11</span>
							</a>
							<ul class="dropdown-menu notifications">
								<li>
									<span class="dropdown-menu-title"> You have 11 notifications</span>
								</li>
								<li>
									<div class="drop-down-wrapper">
										<ul>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-primary"><i class="fa fa-user"></i></span>
													<span class="message"> New user registration</span>
													<span class="time"> 1 min</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> 7 min</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> 8 min</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> 16 min</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-primary"><i class="fa fa-user"></i></span>
													<span class="message"> New user registration</span>
													<span class="time"> 36 min</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-warning"><i class="fa fa-shopping-cart"></i></span>
													<span class="message"> 2 items sold</span>
													<span class="time"> 1 hour</span>
												</a>
											</li>
											<li class="warning">
												<a href="javascript:void(0)">
													<span class="label label-danger"><i class="fa fa-user"></i></span>
													<span class="message"> User deleted account</span>
													<span class="time"> 2 hour</span>
												</a>
											</li>
											<li class="warning">
												<a href="javascript:void(0)">
													<span class="label label-danger"><i class="fa fa-shopping-cart"></i></span>
													<span class="message"> Transaction was canceled</span>
													<span class="time"> 6 hour</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> yesterday</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-primary"><i class="fa fa-user"></i></span>
													<span class="message"> New user registration</span>
													<span class="time"> yesterday</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-primary"><i class="fa fa-user"></i></span>
													<span class="message"> New user registration</span>
													<span class="time"> yesterday</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> yesterday</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0)">
													<span class="label label-success"><i class="fa fa-comment"></i></span>
													<span class="message"> New comment</span>
													<span class="time"> yesterday</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="view-all">
									<a href="javascript:void(0)">
										See all notifications <i class="fa fa-arrow-circle-o-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<!-- end: NOTIFICATION DROPDOWN -->
						<!-- start: MESSAGE DROPDOWN -->
						<li class="dropdown">
							<a class="dropdown-toggle" data-close-others="true" data-hover="dropdown" data-toggle="dropdown" href="#">
								<i class="clip-bubble-3"></i>
								<span class="badge"> 9</span>
							</a>
							<ul class="dropdown-menu posts">
								<li>
									<span class="dropdown-menu-title"> You have 9 messages</span>
								</li>
								<li>
									<div class="drop-down-wrapper">
										<ul>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="./assets/images/avatar-2.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Nicole Bell</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time"> Just Now</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="./assets/images/avatar-1.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Peter Clark</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">2 mins</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="./assets/images/avatar-3.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Steven Thompson</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">8 hrs</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="./assets/images/avatar-1.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Peter Clark</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">9 hrs</span>
														</div>
													</div>
												</a>
											</li>
											<li>
												<a href="javascript:;">
													<div class="clearfix">
														<div class="thread-image">
															<img alt="" src="./assets/images/avatar-5.jpg">
														</div>
														<div class="thread-content">
															<span class="author">Kenneth Ross</span>
															<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</span>
															<span class="time">14 hrs</span>
														</div>
													</div>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="view-all">
									<a href="pages_messages.html">
										See all messages <i class="fa fa-arrow-circle-o-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<!-- end: MESSAGE DROPDOWN -->
                        <?php endif?>
						<!-- start: USER DROPDOWN -->
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
                                <span class="username"><?=$ui->hasUsername() ? $ui->getUsername() : 'Usuário'?></span>
                                <?php if ($ui->hasAnyUserAction()):?>
                                    <i class="clip-chevron-down"></i>
                                <?php endif?>
							</a>
                            <?php if ($ui->hasAnyUserAction()):?>
							<ul class="dropdown-menu">
                                <?php foreach ($ui->getUserActions() as $id => $actionInfo):?>
                                    <?php if ($actionInfo['separator']):?>
                                        <li class="divider"></li>
                                    <?php else:?>
                                    <li>
                                        <a href="<?=$actionInfo['url']?>">
                                            <?php if (!empty($actionInfo['icon'])):?>
                                                <i class="fa fa-<?=$actionInfo['icon']?>"></i>
                                            <?php endif?>
                                            <?=$actionInfo['title']?>
                                        </a>
                                    </li>
                                    <?php endif?>

                                <?php endforeach?>
							</ul>
                            <?php endif?>
						</li>
						<!-- end: USER DROPDOWN -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
                <?=$this->section('sidebar')?>
				<!-- start: SIDEBAR -->
                <?php if ($ui->hasAnyMenu()):?>
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->

					<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu">
                        <?php
                        $menuData = $ui->getMenuData();

                        foreach ($menuData as $menuId => $menu):
                            if (!$menu['visible']) {
                                continue;
                            }
                        ?>
                        <li class="<?=$ui->isMenuActive($menuId) ? 'active open' : ''?>">
							<a href="<?=!empty($menu['link']) && empty($menu['children']) ? $menu['link'] : 'javascript:void(0);'?>">
                                <?php if (!empty($menu['icon'])):?>
                                    <i class="fa fa-<?=$menu['icon']?>"></i>
                                <?php endif?>

								<span class="title">
                                    <?=$menu['name']?>
                                </span>
                                <?php if (!empty($menu['children'])):?>
                                    <i class="icon-arrow"></i>
                                <?php endif?>
                                <?php if (!empty($menu['badge'])):?>
                                    <span class="badge badge-new"><?=$menu['badge']?></span>
                                <?php endif?>
							</a>
                            <?php if (!empty($menu['children'])):?>
                            <ul class="sub-menu">
                                <?php
                                foreach ($menu['children'] as $submenuId => $submenu):
                                    if (!$submenu['visible']) {
                                        continue;
                                    }
                                ?>
								<li class="<?=$ui->isMenuActive($menuId, $submenuId) ? 'active' : ''?>">
									<a href="<?=!empty($submenu['link']) ? $submenu['link'] : 'javascript:void(0);'?>">
                                        <?php if (!empty($submenu['icon'])):?>
                                            <i class="fa fa-<?=$submenu['icon']?>"></i>
                                        <?php endif?>
										<span class="title"> <?=$submenu['name']?> </span>
                                        <?php if (!empty($submenu['badge'])):?>
                                            <span class="badge badge-new"><?=$submenu['badge']?></span>
                                        <?php endif?>
									</a>
								</li>
                                <?php endforeach?>
                            </ul>
                            <?php endif?>
						</li>
                        <?php endforeach?>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
            <?php endif?>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<div class="container">
					<!-- start: PAGE HEADER -->
					<div class="row">
						<div class="col-sm-12">
                            <?php if ($ui->hasAnyCrumb()):?>
							<ol class="breadcrumb">
                                <?php
                                foreach ($ui->getBreadCrumb() as $crumb):
                                    if (empty($crumb['name'])) {
                                        continue;
                                    }
                                ?>
								<li>
                                    <?php if (!empty($crumb['icon'])):?>
                                        <i class="fa fa-<?=$crumb['icon']?>"></i>
                                    <?php endif?>
                                    <?php if (!empty($crumb['link'])):?>
                                        <a href="<?=$crumb['link']?>" title="<?=  htmlentities($crumb['name'], ENT_QUOTES)?>">
                                    <?php endif?>
										<?=$crumb['name']?>
									<?php if (!empty($crumb['link'])):?>
                                        </a>
                                    <?php endif?>
								</li>
                                <?php endforeach?>
							</ol>
                            <?php endif?>
							<div class="page-header">
								<h1>
                                    <?=$ui->getPageTitle()?>
                                    <?php if ($ui->hasPageDescription()):?>
                                        <small><?= $ui->getPageDescription()?></small>
                                    <?php endif?>
                                </h1>
                                <?php /* if ($ui->hasAnyPageAction()):?>
                                    <div class="page-actions">
                                        <?php
                                        $suffix = empty($_GET) ? '' : '?' . http_build_query($_GET);
                                        foreach ($ui->getPageActions() as $id => $action):
                                        ?>
                                        <a href="<?=$action['url'] . $suffix?>" class="btn btn-default action-button">
                                            <?php if (!empty($action['icon'])):?>
                                                <i class="fa fa-<?=$action['icon']?> fa-lg action-button-icon"></i>
                                            <?php endif?>
                                            <?=$action['title']?>
                                        </a>
                                        <?php endforeach?>
                                    </div>
                                <?php endif */ ?>
							</div>
							<!-- end: PAGE TITLE & BREADCRUMB -->
						</div>
					</div>

					<!-- end: PAGE HEADER -->
					<?=$this->content()?>
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
                <?=date('Y')?> &copy; <a href="http://mixinternet.com.br" target="_blank">Mix Internet</a>.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>

		<?= \View::factory('admin/scripts') ?>

		<!-- end: MAIN JAVASCRIPTS -->
		<script>
            (function($) {
                $(document).ready(function() {
                	Main.init();

                    $(".izi-modal").iziModal();

                    $(".bootstrap-switch").each(function(event) {
                        $(this).bootstrapSwitch();
                        $(this).on('switchChange.bootstrapSwitch', function(event, state) {
                            //console.log(this); // DOM element
                            //console.log(event); // jQuery event
                            //console.log(state); // true | false

                            $("[name='"+$(this).data('inputName')+"']").attr("value", state ? 1 : 0);
                        });
                    });


                    /*
                    $(".toggles").each(function(i, e) {
                        var checkbox = '[name="'+$(this).data('name')+'"]';

                        $(this).toggles({
                            checkbox: checkbox,
                            text: {
                                on: $(this).data('textOn'),
                                off: $(this).data('textOff')
                            }
                        }).on('toggle', function(e, active) {
                                $(checkbox).val(active ? 1 : 0);
                            });
                    });
*/


                    $('[data-confirm]').each(function(e){
                        var item  = this;
                        var message = $(this).data('confirm');
                        var type    = $(this).data('confirm-type');
                        var title   = $(this).data('confirm-title');
                        /*var confirmText   = $(this).data('confirm-confirm-text');
                        var confirmColor  = $(this).data('confirm-confirm-color');
                        var cancelText    = $(this).data('confirm-cancel-text');
                        var cancelColor   = $(this).data('confirm-cancel-color');*/

                        if (!title) {
                            title = "Tem certeza?";
                        }

                        $(item).click(function(e) {
                            $el = $(this);
                            sweetAlert({
                                title: title,
                                text: message,
                                type: type,   showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Sim",
                                cancelButtonText: "Cancelar",
                                closeOnConfirm: false
                            }, function() {
                                if ($el.attr('href')) {
                                    window.location.href = $el.attr('href');
                                }

                                if ($el.attr('type') && $el.attr('type') == 'submit') {
                                    $el.parents('form').submit();
                                }
                            });
                            return false;
                        });

                    });

                    $('[data-form-confirm]').each(function(e){
                        var item  = this;
                        var message = $(this).data('form-confirm');
                        var type    = $(this).data('form-confirm-type');
                        var title   = $(this).data('form-confirm-title');
                        /*var confirmText   = $(this).data('confirm-confirm-text');
                        var confirmColor  = $(this).data('confirm-confirm-color');
                        var cancelText    = $(this).data('confirm-cancel-text');
                        var cancelColor   = $(this).data('confirm-cancel-color');*/

                        if (!title) {
                            title = "Tem certeza?";
                        }

                        $(item).click(function(e) {
                            sweetAlert({
                                title: title,
                                text: message,
                                type: type,   showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Sim",
                                cancelButtonText: "Cancelar",
                                closeOnConfirm: false
                            }, function() {
                                $(item).submit();
                            });
                            return false;
                        });

                    });
                    $('.modal-confirm').each(function(){
                        var item = this;
                        $(item).click(function() {
                            return confirm($(item).data('confirm'));
                        });
                    });




                    var PhoneBehaviour = function (val) {
                        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                    };
                    var phoneOptions = {
                        onKeyPress: function(val, e, field, options) {
                            field.mask(PhoneBehaviour.apply({}, arguments), options);
                        }
                    };
                    $('.input-money').mask('000.000.000.000.000,00', {reverse: true});

                    	$('.form-validation').formValidation({
                        framework: 'bootstrap',
                        locale: 'pt_BR',
                        live: 'blur'
                    });


                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        $('iframe.auto-height').each(function() {
                            var self = this;
                            if (self.contentWindow.document.body) {
                                $(self).css('height', self.contentWindow.document.body.offsetHeight + 'px');
                            }
                        });
                    });

                    $('iframe.auto-height').each(function() {
                        var self = this;
                        if (self.contentWindow.document.body) {
                            $(self).css('height', self.contentWindow.document.body.offsetHeight + 'px');
                        }
                    });

                    $('.input-phone').mask(PhoneBehaviour, phoneOptions);
                    $('.input-datetime').datetimepicker({
                        language: 'pt-BR',
                        format: 'dd/mm/yyyy HH:ii'
                    });
                    $('.input-date').datepicker({
                        autoclose: true,
                        language: 'pt-BR',
                        format: 'dd/mm/yyyy',
                        todayHighlight: true
                    }).on('changeDate', function(e) {
                        var de = $(this).attr('name');
                        if (!(/de/.test(de))) {
                            return;
                        }
                        var ate     = de.replace('de', 'ate').replace('[', '\\[').replace(']', '\\]');
                        var $ate    = $('input[name=' + ate + ']');
                        var deDate  = $(this).data('datepicker').getDate();
                        var ateDate = $ate.data('datepicker').getDate();

                        if (ateDate.getTime() < deDate.getTime()) {
                            $ate.val('');
                        }

                        $ate.data("datepicker").setStartDate(e.date);
                   });
                    CKEDITOR.disableAutoInline = true;

                    $('textarea.input-richtext').ckeditor({
                        filebrowserImageBrowseUrl : '<?=$this->url('assets/js/admin/plugins/kcfinder/browse.php?opener=ckeditor&type=images')?>',
                        filebrowserImageUploadUrl : '<?=$this->url('assets/js/admin/plugins/kcfinder/upload.php?opener=ckeditor&type=images')?>'
                    });
                    /*
                    $('.input-habtm, select[multiple]').each(function() {
                        var placeHolder = $(this).attr('placeholder');
                        if (placeHolder == '') {
                            placeHolder = 'Selecione...';
                        }
                        $(this).select2({
                            'placeholder': placeHolder,
                            noResults: 'Nenhum resultado encontrado.',
                            width: 'auto'
                        });
                    });
*/


                    $('.input-habtm').each(function(i, e) {
                        var $habtm = $(e);

                        $habtm.select2({
                            'placeholder': Boolean($habtm.attr('placeholder')) ? $habtm.attr('placeholder') : 'Selecione...',
                            width: '100%',
                            maximumSelectionLength: $habtm.data('maximum'),
                            "language": "pt-BR"
                        }).on("select2:unselecting", function (e) {
                            $(this).data('unselecting', true);
                        }).on('select2:open', function(e) {
                            if ($(this).data('unselecting')) {
                                $(this).select2('close').removeData('unselecting');
                            }
                        }).on('results:message', function(params){
                            this.dropdown._resizeDropdown();
                            this.dropdown._positionDropdown();
                        });

                    });

                    $.fn.addOption = function (value, label) {
                        this.append("<option value=\""+value+"\">" + label + "</option>");
                        return this;
                    };


                    $('[data-search-ajax]').each(function(e) {

                        var $field         = $(this);
                        var defaultMessage = $field.find('option[value=""]').text();
                        var info           = $(this).data();

                        var $depends = $('#search_' + info.searchAjaxDepends);
                        console.log($depends);
                        var initialValue   = $depends.val();


                        $depends.on('change', function() {
                            var value    = $depends.val();

                            if (value === "") {
                                $field.empty().addOption("", defaultMessage);
                                return;
                            }
                            $.ajax({
                                url: "<?=$this->url(\Route::get('admin.ajax_search')->uri())?>/" + info.searchAjaxConfig + "/" + info.searchAjaxField,
                                type: "json",
                                beforeSend: function () {
                                    $field.empty().addOption("", info.searchAjaxLoadingMessage).trigger('change');
                                },
                                success: function(data) {
                                    $field.empty();
                                    if (data.length === 0) {
                                        $field.addOption("", info.searchAjaxEmptyMessage).trigger('change');
                                    }
                                    $field.addOption("", defaultMessage);
                                    for (var i = 0; i < data.length; i++) {
                                        $field.addOption(data[i].value, data[i].label);
                                    }
                                    $field.trigger('change');

                                },
                                method: 'post',
                                data: {
                                    value: value
                                }
                            });
                        });

                    });

                });

  					$('[data-toggle="tooltip"]').tooltip();


                if(typeof $.fn.spectrum !== 'undefined') {
                    $('.colorpicker-element').spectrum({
                        preferredFormat: "hex",
                        allowEmpty: true,
                        showAlpha: true,
                        showInitial: true,
                        showInput: true,
                        showButtons: false
                    });
                }

                $(".select-fontawesome").select2({
                    templateResult: function(select) {
                        var $fa = '<fa class="fa '+select.id+'" style="font-size: 28px; margin-right: 10px; vertical-align: middle;"></fa>';
                        var $label = '<span>'+select.id+'</span>';
                        return $($fa+$label);
                    },
					templateSelection: function(select) {
                        var $fa = '<fa class="fa '+select.id+'" style="margin-right: 10px; vertical-align: middle;"></fa>';
                        var $label = '<span>'+select.id+'</span>';
                        return $($fa+$label);
                    },
                });

            })(jQuery);

		</script>
        <?=$this->section('footer')?>
        <?=$this->globalSection('footer')?>
	<script type="text/javascript" src="/assets/js/admin/bundle.js"></script></body>
	<!-- end: BODY -->
</html>
