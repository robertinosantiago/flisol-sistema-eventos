<h1><?php echo __('Confirmation'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $fullname); ?></p>
<p><?php echo __('Your registration is complete.') ?></p>
<p><?php echo __('Please, login in the system and select the event for your interest.') ?></p>
<ul>
    <li><strong><?php echo __('Name'); ?>:</strong> <?php echo $fullname; ?></li>
    <li><strong><?php echo __('Email'); ?>:</strong> <?php echo $email ?></li>
</ul>

<p><?php echo __('To access the system, please click on link below.') ?></p>
<p>
    <?php echo $this->Html->link(__('Access the system'), array('controller' => 'Events', 'action' => 'home', 'full_base' => true)); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Events', 'action' => 'home', 'full_base' => true), true)); ?></p>

<hr>
<h5><?php echo __('Sistema de Gerenciamento de Eventos'); ?></h5>
<h6><?php echo __('Universidade Federal do Paraná'); ?></h6>
<h6><?php echo __('Campus Avançado de Jandaia do Sul'); ?></h6>
