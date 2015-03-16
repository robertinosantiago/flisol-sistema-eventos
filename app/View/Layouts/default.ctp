<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php $authUser = $this->Session->read('Auth.User'); ?>
<!DOCTYPE html>
<html lang="en">
    <head prefix="og: http://ogp.me/ns#">
        <meta property="og:title" content="<?php echo $title_for_layout; ?>">
        <meta property="og:locale" content="pt_BR">

        <link rel="canonical" href="<?php echo Router::url(null, true); ?>">
        <meta property="og:url" content="<?php echo Router::url(null, true); ?>">

        <meta property="og:site_name" content="<?php echo __('Sistema de eventos - UFPR - Jandaia do Sul'); ?>">

        <meta name="description" content="<?php echo (isset($description_for_layout) ? $description_for_layout : __('Sistema de eventos - UFPR - Jandaia do Sul')); ?>">
        <meta property="og:description" content="<?php echo (isset($description_for_layout) ? $description_for_layout : __('Sistema de eventos - UFPR - Jandaia do Sul')); ?>">

        <meta property="og:image" content="<?php echo $this->Html->url('/img/logo-ufpr-200x200.png', true); ?>">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="200">
        <meta property="og:image:height" content="200">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="robots" content="index, follow">
        <meta name="keywords" content="jandaia do sul, universidade federal do paraná, universidade, eventos, jornada, semana acadêmica, cursos, ufpr">

        <title><?php echo $title_for_layout; ?></title>

        <!-- Bootstrap -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <?php
        echo $this->Html->meta('icon');

        //Bootstrap
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('common');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>
    <body>
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only"><?php echo __("Toggle navigation"); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'home')); ?>">
                        <?php echo __('Events'); ?>
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <?php if ($authUser): ?>
                        <ul class="nav navbar-nav">
                            <li><?php echo $this->Html->link(__('My participation'), array('controller' => 'Users', 'action' => 'myEditions')); ?></li>
                        </ul>
                    
                        <?php if (isset($authUser) && $authUser['role'] === 'admin'): ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Record'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?php echo $this->Html->link(__('Editions'), array('controller' => 'Editions', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link(__('Users'), array('controller' => 'Users', 'action' => 'index')); ?></li>
                                </ul>
                            </li>
                        </ul>
                        <?php endif; ?>
                    
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('Options'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?php echo $this->Html->link(__('Change password'), array('controller' => 'Users', 'action' => 'changePassword')); ?></li>
                                </ul>
                            </li>
                            <li><?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout')); ?></li>
                        </ul>
                    <?php else: ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li><?php echo $this->Html->link(__('Login'), array('controller' => 'Users', 'action' => 'login')); ?></li>
                        </ul>
                    <?php endif; ?>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <?php if ($authUser): ?>
            <div class="container-fluid navbar-information">
                <div class="container">
                    <div class="pull-right">
                        <span class="label username">
                            <?php echo $authUser['fullname']; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="container content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth', array('element' => 'flash_auth')); ?>
            <?php echo $this->fetch('content'); ?>
        </div>

        <?php echo $this->element('sql_dump'); ?>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            jQuery(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert-removable").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
            });
        </script>

        <?php echo $this->fetch('script'); ?>

        <?php if ($this->fetch('scripts')): ?>
            <?php echo $this->fetch('scripts'); ?>
        <?php endif; ?>
    </body>
</html>
