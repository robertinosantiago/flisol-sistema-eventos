<h1><?php echo __('Confirmation'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $record['User']['fullname']); ?></p>
<p><?php echo __('Your registration in the site is complete.') ?></p>
<p><?php echo __('Please, login in the system and select the edition of FLISoL of your interest') ?></p>
<ul>
    <li><strong><?php echo __('Name'); ?>:</strong> <?php echo $record['User']['fullname']; ?></li>
    <li><strong><?php echo __('Email'); ?>:</strong> <?php echo $record['User']['email'] ?></li>
</ul>

<p><?php echo __('To access the system, please click on link below.') ?></p>
<p>
    <?php echo $this->Html->link(__('Access the system'), array('controller' => 'Editions', 'action' => 'home', 'full_base' => true)); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Editions', 'action' => 'home', 'full_base' => true), true)); ?></p>

<hr>
<h5><?php echo __('FLISoL - Festival Latino-americano de Instalação de Software Livre'); ?></h5>
<h6><?php echo __('Jandaia do Sul - Paraná - Brasil'); ?></h6>


